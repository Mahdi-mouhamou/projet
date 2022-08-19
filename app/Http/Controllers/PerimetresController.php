<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Puit;
use App\Models\Avenant;
use App\Models\Contrat;
use App\Models\Journal;
use App\Models\Gisement;
use App\Models\FinanceGg;
use App\Models\Perimetre;
use App\Models\Programme;
use App\Models\Reservoir;
use App\Models\FinancePuit;
use App\Models\Fracturation;
use Illuminate\Http\Request;
use App\Models\HistoriqueAdd;
use App\Models\HistoriqueSup;
use App\Models\RealisationGg;
use App\Models\HistoriqueEdit;
use Doctrine\DBAL\Schema\View;
use App\Models\FinanceSismique;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\DB;
use App\Models\FinanceFracturation;
use App\Models\RealisationSismique;
use App\Models\HistoriqueValidation;
use Illuminate\Support\Facades\Auth;
use Database\Seeders\PostsTableSeeder;
use TCG\Voyager\Events\BreadDataAdded;
use TCG\Voyager\Events\BreadDataDeleted;
use TCG\Voyager\Events\BreadDataUpdated;
use TCG\Voyager\Events\BreadDataRestored;
use TCG\Voyager\Events\BreadImagesDeleted;
use Illuminate\Database\Eloquent\SoftDeletes;
use TCG\Voyager\Database\Schema\SchemaManager;
use \TCG\Voyager\Http\Controllers\VoyagerBaseController;
use TCG\Voyager\Http\Controllers\Traits\BreadRelationshipParser;

class PerimetresController extends \TCG\Voyager\Http\Controllers\VoyagerBaseController
{
    use BreadRelationshipParser;

    //***************************************
    //               ____
    //              |  _ \
    //              | |_) |
    //              |  _ <
    //              | |_) |
    //              |____/
    //
    //      Browse our Data Type (B)READ
    //
    //****************************************

    public function index(Request $request)
    {
        // GET THE SLUG, ex. 'posts', 'pages', etc.

        $slug = $this->getSlug($request);

        // dd($slug);
        // GET THE DataType based on the slug
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('browse', app($dataType->model_name));

        $getter = $dataType->server_side ? 'paginate' : 'get';

        $search = (object) ['value' => $request->get('s'), 'key' => $request->get('key'), 'filter' => $request->get('filter')];

        $searchNames = [];
        if ($dataType->server_side) {
            $searchNames = $dataType->browseRows->mapWithKeys(function ($row) {
                return [$row['field'] => $row->getTranslatedAttribute('display_name')];
            });
        }

        $orderBy = $request->get('order_by', $dataType->order_column);
        $sortOrder = $request->get('sort_order', $dataType->order_direction);
        $usesSoftDeletes = false;
        $showSoftDeleted = false;

        // Next Get or Paginate the actual content from the MODEL that corresponds to the slug DataType
        if (strlen($dataType->model_name) != 0) {
            $model = app($dataType->model_name);

            $query = $model::select($dataType->name . '.*');

            if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope' . ucfirst($dataType->scope))) {
                $query->{$dataType->scope}();
            }

            // Use withTrashed() if model uses SoftDeletes and if toggle is selected
            if ($model && in_array(SoftDeletes::class, class_uses_recursive($model)) && Auth::user()->can('delete', app($dataType->model_name))) {
                $usesSoftDeletes = true;

                if ($request->get('showSoftDeleted')) {
                    $showSoftDeleted = true;
                    $query = $query->withTrashed();
                }
            }

            // If a column has a relationship associated with it, we do not want to show that field
            $this->removeRelationshipField($dataType, 'browse');

            if ($search->value != '' && $search->key && $search->filter) {
                $search_filter = ($search->filter == 'equals') ? '=' : 'LIKE';
                $search_value = ($search->filter == 'equals') ? $search->value : '%' . $search->value . '%';

                $searchField = $dataType->name . '.' . $search->key;
                if ($row = $this->findSearchableRelationshipRow($dataType->rows->where('type', 'relationship'), $search->key)) {
                    $query->whereIn(
                        $searchField,
                        $row->details->model::where($row->details->label, $search_filter, $search_value)->pluck('id')->toArray()
                    );
                } else {
                    if ($dataType->browseRows->pluck('field')->contains($search->key)) {
                        $query->where($searchField, $search_filter, $search_value);
                    }
                }
            }

            $row = $dataType->rows->where('field', $orderBy)->firstWhere('type', 'relationship');
            if ($orderBy && (in_array($orderBy, $dataType->fields()) || !empty($row))) {
                $querySortOrder = (!empty($sortOrder)) ? $sortOrder : 'desc';
                if (!empty($row)) {
                    $query->select([
                        $dataType->name . '.*',
                        'joined.' . $row->details->label . ' as ' . $orderBy,
                    ])->leftJoin(
                        $row->details->table . ' as joined',
                        $dataType->name . '.' . $row->details->column,
                        'joined.' . $row->details->key
                    );
                }

                $dataTypeContent = call_user_func([
                    $query->orderBy($orderBy, $querySortOrder),
                    $getter,
                ]);
            } elseif ($model->timestamps) {
                $dataTypeContent = call_user_func([$query->latest($model::CREATED_AT), $getter]);
            } else {
                $dataTypeContent = call_user_func([$query->orderBy($model->getKeyName(), 'DESC'), $getter]);
            }

            // Replace relationships' keys for labels and create READ links if a slug is provided.
            $dataTypeContent = $this->resolveRelations($dataTypeContent, $dataType);
        } else {
            // If Model doesn't exist, get data from table name
            $dataTypeContent = call_user_func([DB::table($dataType->name), $getter]);
            $model = false;
        }

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($model);

        // Eagerload Relations
        $this->eagerLoadRelations($dataTypeContent, $dataType, 'browse', $isModelTranslatable);

        // Check if server side pagination is enabled
        $isServerSide = isset($dataType->server_side) && $dataType->server_side;

        // Check if a default search key is set
        $defaultSearchKey = $dataType->default_search_key ?? null;

        // Actions
        $actions = [];
        if (!empty($dataTypeContent->first())) {
            foreach (Voyager::actions() as $action) {
                $action = new $action($dataType, $dataTypeContent->first());

                if ($action->shouldActionDisplayOnDataType()) {
                    $actions[] = $action;
                }
            }
        }

        // Define showCheckboxColumn
        $showCheckboxColumn = false;
        if (Auth::user()->can('delete', app($dataType->model_name))) {
            $showCheckboxColumn = true;
        } else {
            foreach ($actions as $action) {
                if (method_exists($action, 'massAction')) {
                    $showCheckboxColumn = true;
                }
            }
        }

        // Define orderColumn
        $orderColumn = [];
        if ($orderBy) {
            $index = $dataType->browseRows->where('field', $orderBy)->keys()->first() + ($showCheckboxColumn ? 1 : 0);
            $orderColumn = [[$index, $sortOrder ?? 'desc']];
        }

        // Define list of columns that can be sorted server side
        $sortableColumns = $this->getSortableColumns($dataType->browseRows);

        $view = 'voyager::bread.browse';

        if (view()->exists("voyager::$slug.browse")) {
            $view = "voyager::$slug.browse";
        }

        $prog = DB::table('programmes')
            ->select('ValideB')
            ->where('ValideB', '=', 'non')
            ->get();

        $prog = count($prog);
        // dd($prog);


        // $d=$db->toJson();
        // $d=json_decode($db,true);
        // for ($i = 0; $i < count($d); $i++){
        //     if ($d[$i]['ValideB']==='non'){
        //       $db->update(['valideB' => 'oui']);
        //     }
        //   }
        // dd($db);


        return Voyager::view($view, compact(
            'actions',
            'dataType',
            'dataTypeContent',
            'isModelTranslatable',
            'search',
            'orderBy',
            'orderColumn',
            'sortableColumns',
            'sortOrder',
            'searchNames',
            'isServerSide',
            'defaultSearchKey',
            'usesSoftDeletes',
            'showSoftDeleted',
            'showCheckboxColumn',
            'prog'
        ));
    }

    //***************************************
    //                _____
    //               |  __ \
    //               | |__) |
    //               |  _  /
    //               | | \ \
    //               |_|  \_\
    //
    //  Read an item of our Data Type B(R)EAD
    //
    //****************************************

    public function show(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        $isSoftDeleted = false;

        if (strlen($dataType->model_name) != 0) {
            $model = app($dataType->model_name);
            $query = $model->query();

            // Use withTrashed() if model uses SoftDeletes and if toggle is selected
            if ($model && in_array(SoftDeletes::class, class_uses_recursive($model))) {
                $query = $query->withTrashed();
            }
            if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope' . ucfirst($dataType->scope))) {
                $query = $query->{$dataType->scope}();
            }
            $dataTypeContent = call_user_func([$query, 'findOrFail'], $id);
            if ($dataTypeContent->deleted_at) {
                $isSoftDeleted = true;
            }
        } else {
            // If Model doest exist, get data from table name
            $dataTypeContent = DB::table($dataType->name)->where('id', $id)->first();
        }

        // Replace relationships' keys for labels and create READ links if a slug is provided.
        $dataTypeContent = $this->resolveRelations($dataTypeContent, $dataType, true);

        // If a column has a relationship associated with it, we do not want to show that field
        $this->removeRelationshipField($dataType, 'read');

        // Check permission
        $this->authorize('read', $dataTypeContent);

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($dataTypeContent);

        // Eagerload Relations
        $this->eagerLoadRelations($dataTypeContent, $dataType, 'read', $isModelTranslatable);

        $view = 'voyager::bread.read';

        if (view()->exists("voyager::$slug.read")) {
            $view = "voyager::$slug.read";
        }



        return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable', 'isSoftDeleted'));
    }

    //***************************************
    //                ______
    //               |  ____|
    //               | |__
    //               |  __|
    //               | |____
    //               |______|
    //
    //  Edit an item of our Data Type BR(E)AD
    //
    //****************************************

    public function edit(Request $request, $id)
    {

        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        if (strlen($dataType->model_name) != 0) {
            $model = app($dataType->model_name);
            $query = $model->query();

            // Use withTrashed() if model uses SoftDeletes and if toggle is selected
            if ($model && in_array(SoftDeletes::class, class_uses_recursive($model))) {
                $query = $query->withTrashed();
            }
            if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope' . ucfirst($dataType->scope))) {
                $query = $query->{$dataType->scope}();
            }
            $dataTypeContent = call_user_func([$query, 'findOrFail'], $id);
        } else {
            // If Model doest exist, get data from table name
            $dataTypeContent = DB::table($dataType->name)->where('id', $id)->first();
        }

        foreach ($dataType->editRows as $key => $row) {
            $dataType->editRows[$key]['col_width'] = isset($row->details->width) ? $row->details->width : 100;
        }

        // If a column has a relationship associated with it, we do not want to show that field
        $this->removeRelationshipField($dataType, 'edit');

        // Check permission
        $this->authorize('edit', $dataTypeContent);

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($dataTypeContent);

        // Eagerload Relations
        $this->eagerLoadRelations($dataTypeContent, $dataType, 'edit', $isModelTranslatable);

        $view = 'voyager::bread.edit-add';

        if (view()->exists("voyager::$slug.edit-add")) {
            $view = "voyager::$slug.edit-add";
        }



        return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable'));
    }

    // POST BR(E)AD
    public function update(Request $request, $id)
    {
        $prog = Perimetre::where('id', '=', $id)->first();
        $prog->Valide = "non";
        $prog->save();

        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Compatibility with Model binding.
        $id = $id instanceof \Illuminate\Database\Eloquent\Model ? $id->{$id->getKeyName()} : $id;
        $model = app($dataType->model_name);
        $query = $model->query();
        if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope' . ucfirst($dataType->scope))) {
            $query = $query->{$dataType->scope}();
        }
        if ($model && in_array(SoftDeletes::class, class_uses_recursive($model))) {
            $query = $query->withTrashed();
        }

        $data = $query->findOrFail($id);
        // $db=$data->toJson();
        // $mytime = Carbon::now();
        // $journal=Journal::create([
        //     'data'=>$db,
        //     'user'=>auth()->user()->email,
        //     'operation'=>'Edit',
        //     'date'=>$mytime,
        //     'model'=>$dataType->model_name
        // ]);
        // ici on sauvgarde dans historique
        $db = $data->toJson();
        $mytime = Carbon::now()->format('Y/m/d H:i:s');
        $str = $dataType->model_name;
        $ch = str_split($str, 11);
        $chaine = $ch[1];
        $historique = HistoriqueEdit::create([
            'model' => $chaine,
            'operation' => 'Edit',
            'data' => $db,
            'user' => auth()->user()->email,
            'date' => $mytime,
        ]);
        //    dd($historique);
        // Check permission
        $this->authorize('edit', $data);

        // Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->editRows, $dataType->name, $id)->validate();

        // Get fields with images to remove before updating and make a copy of $data
        $to_remove = $dataType->editRows->where('type', 'image')
            ->filter(function ($item, $key) use ($request) {
                return $request->hasFile($item->field);
            });
        $original_data = clone ($data);

        $this->insertUpdateData($request, $slug, $dataType->editRows, $data);

        // Delete Images
        $this->deleteBreadImages($original_data, $to_remove);

        event(new BreadDataUpdated($dataType, $data));

        // dd($k,$data);
        if (auth()->user()->can('browse', app($dataType->model_name))) {
            $redirect = redirect()->route("voyager.{$dataType->slug}.index");
        } else {
            $redirect = redirect()->back();
        }


        return $redirect->with([
            'message'    => __('voyager::generic.successfully_updated') . " {$dataType->getTranslatedAttribute('display_name_singular')}",
            'alert-type' => 'success',
        ]);
    }

    //***************************************
    //
    //                   /\
    //                  /  \
    //                 / /\ \
    //                / ____ \
    //               /_/    \_\
    //
    //
    // Add a new item of our Data Type BRE(A)D
    //
    //****************************************

    public function create(Request $request)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('add', app($dataType->model_name));

        $dataTypeContent = (strlen($dataType->model_name) != 0)
            ? new $dataType->model_name()
            : false;

        foreach ($dataType->addRows as $key => $row) {
            $dataType->addRows[$key]['col_width'] = $row->details->width ?? 100;
        }

        // If a column has a relationship associated with it, we do not want to show that field
        $this->removeRelationshipField($dataType, 'add');

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($dataTypeContent);

        // Eagerload Relations
        $this->eagerLoadRelations($dataTypeContent, $dataType, 'add', $isModelTranslatable);

        $view = 'voyager::bread.edit-add';

        if (view()->exists("voyager::$slug.edit-add")) {
            $view = "voyager::$slug.edit-add";
        }

        return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable'));
    }

    /**
     * POST BRE(A)D - Store data.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('add', app($dataType->model_name));

        // Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->addRows)->validate();
        $data = $this->insertUpdateData($request, $slug, $dataType->addRows, new $dataType->model_name());
        // dd($data);
        // dd($dataType->model_name);
        // dd($request);
        // $db=$data->toJson();
        $mytime = Carbon::now()->format('Y/m/d H:i:s');
        $str = $dataType->model_name;
        $ch = str_split($str, 11);
        $chaine = $ch[1];
        $historique = HistoriqueAdd::create([
            'model' => $chaine,
            'operation' => 'add',
            'data' => $data->id,
            'user' => auth()->user()->email,
            'date' => $mytime,
        ]);
        // dd($historique);
        event(new BreadDataAdded($dataType, $data));

        if (!$request->has('_tagging')) {
            if (auth()->user()->can('browse', $data)) {
                $redirect = redirect()->route("voyager.{$dataType->slug}.index");
            } else {
                $redirect = redirect()->back();
            }

            return $redirect->with([
                'message'    => __('voyager::generic.successfully_added_new') . " {$dataType->getTranslatedAttribute('display_name_singular')}",
                'alert-type' => 'success',
            ]);
        } else {
            return response()->json(['success' => true, 'data' => $data]);
        }
    }

    //***************************************
    //                _____
    //               |  __ \
    //               | |  | |
    //               | |  | |
    //               | |__| |
    //               |_____/
    //
    //         Delete an item BREA(D)
    //
    //****************************************

    public function destroy(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();
        // dd($dataType);
        // Init array of IDs
        $ids = [];
        if (empty($id)) {
            // Bulk delete, get IDs from POST
            $ids = explode(',', $request->ids);
        } else {
            // Single item delete, get ID from URL
            $ids[] = $id;
        }
        foreach ($ids as $id) {
            $data = call_user_func([$dataType->model_name, 'findOrFail'], $id);
            
            $db = $data->toJson();
            $mytime = Carbon::now()->format('Y/m/d H:i:s');
            $str = $dataType->model_name;
            $ch = str_split($str, 11);
            $chaine = $ch[1];
            $historique = HistoriqueSup::create([
                'model' => $chaine,
                'operation' => 'Delete',
                'data' => $db,
                'user' => auth()->user()->email,
                'date' => $mytime,
            ]);

            // Check permission
            $this->authorize('delete', $data);

            $contart = Contrat::where('perimetre_id', $data->id)->first();
            
            if (is_null($contart)) {
            } else {
            $db = $contart->toJson();
            $mytime = Carbon::now()->format('Y/m/d H:i:s');
            $historique = HistoriqueSup::create([
                'model' => "Contart",
                'operation' => 'Delete',
                'data' => $db,
                'user' => auth()->user()->email,
                'date' => $mytime,
            ]);
            $avenant = Avenant::where('contrat_id', $contart->id)->get();
            if (is_null($avenant)) {
            } else {
            foreach ($avenant as $avenant) {
        
                $av = $avenant->toJson();

                $mytime = Carbon::now()->format('Y/m/d H:i:s');
                $historique = HistoriqueSup::create([
                    'model' => 'Avenant',
                    'operation' => 'Delete',
                    'data' => $av,
                    'user' => auth()->user()->email,
                    'date' => $mytime,
                ]);
                $av = Avenant::where('id', $avenant->id)->delete();
            }
        }
            $programme = Programme::where('contrat_id', $contart->id)->get();
            if (is_null($programme)) {
            } else {
            foreach ($programme as $programme) {
        
                $pg = $programme->toJson();

                $mytime = Carbon::now()->format('Y/m/d H:i:s');
                $historique = HistoriqueSup::create([
                    'model' => 'POD',
                    'operation' => 'Delete',
                    'data' => $pg,
                    'user' => auth()->user()->email,
                    'date' => $mytime,
                ]);
                $prg = Programme::where('id', $programme->id)->delete();
            }
        }
        
            $realisationS=RealisationSismique::where('contrat_id',$contart->id)->get();
            if (is_null($realisationS)) {
            } else {
                foreach ($realisationS as $realisationS) {
        
                    $rs = $realisationS->toJson();
    
                    $mytime = Carbon::now()->format('Y/m/d H:i:s');
                    $historique = HistoriqueSup::create([
                        'model' => 'Sismique',
                        'operation' => 'Delete',
                        'data' => $rs,
                        'user' => auth()->user()->email,
                        'date' => $mytime,
                    ]);
            $FinanceS=FinanceSismique::where('realisation_sismique_id',$realisationS->id)->first();
            if (is_null($FinanceS)) {
            } else {
                         $fin = $FinanceS->toJson();
    
            $mytime = Carbon::now()->format('Y/m/d H:i:s');
            $historique = HistoriqueSup::create([
                'model' => 'financeSism',
                'operation' => 'Delete',
                'data' => $fin,
                'user' => auth()->user()->email,
                'date' => $mytime,
            ]);
            $FinanceS->delete();
            $realisation=RealisationSismique::where('id',$realisationS->id)->delete();  
            }
 
            }
        }
        

        $realisationG=RealisationGg::where('contrat_id',$contart->id)->get();
        if (is_null($realisationG)) {
        } else {
            foreach ($realisationG as $realisationG) {
    
                $rg = $realisationG->toJson();

                $mytime = Carbon::now()->format('Y/m/d H:i:s');
                $historique = HistoriqueSup::create([
                    'model' => 'Gg',
                    'operation' => 'Delete',
                    'data' => $rg,
                    'user' => auth()->user()->email,
                    'date' => $mytime,
                ]);
        $FinanceG=FinanceGg::where('Realisation_Gg_id',$realisationG->id)->first();
        if (is_null($FinanceG)) {
        } else {
   $fin = $FinanceG->toJson();

        $mytime = Carbon::now()->format('Y/m/d H:i:s');
        $historique = HistoriqueSup::create([
            'model' => 'financeGg',
            'operation' => 'Delete',
            'data' => $fin,
            'user' => auth()->user()->email,
            'date' => $mytime,
        ]);
        $FinanceG->delete();
        $realisation=RealisationGg::where('id',$realisationG->id)->delete();
        }
     
        }
    }


    $contart->delete();


        }
            $Gisement = Gisement::where('perimetre_id', $data->id)->get();
            // dd($Gisement[1]);    
            if (is_null($Gisement)) {
            } else {
                foreach ($Gisement as $Gisement) {
                    $gis = $Gisement->toJson();

                    $mytime = Carbon::now()->format('Y/m/d H:i:s');
                    $historique = HistoriqueSup::create([
                        'model' => 'Gisement',
                        'operation' => 'Delete',
                        'data' => $gis,
                        'user' => auth()->user()->email,
                        'date' => $mytime,
                    ]);
                    // dd($Gisement[$i]->id);

                    $reservoir = Reservoir::where('Gisement_id', $Gisement->id)->get();
                    if (is_null($reservoir)) {
                    } else {
                        foreach ($reservoir as $reservoir) {

                            $reserv = $reservoir->toJson();

                            $mytime = Carbon::now()->format('Y/m/d H:i:s');
                            $historique = HistoriqueSup::create([
                                'model' => 'reservoir',
                                'operation' => 'Delete',
                                'data' => $reserv,
                                'user' => auth()->user()->email,
                                'date' => $mytime,
                            ]);
                            $puit = Puit::where('Reservoir_id', $reservoir->id)->get();
                            if (is_null($puit)) {
                            } else {
                                foreach ($puit as $puit) {
        
                                    $p = $puit->toJson();
        
                                    $mytime = Carbon::now()->format('Y/m/d H:i:s');
                                    $historique = HistoriqueSup::create([
                                        'model' => 'puit',
                                        'operation' => 'Delete',
                                        'data' => $p,
                                        'user' => auth()->user()->email,
                                        'date' => $mytime,
                                    ]);
                                   

                                    $finPuit=FinancePuit::where('puit_id',$puit->id)->first();
                                   
                                    if (is_null($finPuit)) {
                                    } else {
                                    $p = $finPuit->toJson();
                                    $mytime = Carbon::now()->format('Y/m/d H:i:s');
                                    $historique = HistoriqueSup::create([
                                        'model' => 'financepuit',
                                        'operation' => 'Delete',
                                        'data' => $p,
                                        'user' => auth()->user()->email,
                                        'date' => $mytime,
                                    ]);

                                    $finPuit=FinancePuit::where('puit_id',$puit->id)->delete();
                                }
                                    $pu = Puit::where('id', $puit->id)->delete();
                                
                                    

                                    $Fracturation=Fracturation::where('puit_id',$puit->id)->first();
                                    if (is_null($Fracturation)) {
                                    } else {
                                    $fract = $Fracturation->toJson();
                                    $mytime = Carbon::now()->format('Y/m/d H:i:s');
                                    $historique = HistoriqueSup::create([
                                        'model' => 'fracturatio',
                                        'operation' => 'Delete',
                                        'data' => $fract,
                                        'user' => auth()->user()->email,
                                        'date' => $mytime,
                                    ]);
                                    $finFrac=FinanceFracturation::where('fracturation_id',$Fracturation->id)->first();
                                    if (is_null($finFrac)) {
                                    } else {  $finfract = $finFrac->toJson();
                                    $mytime = Carbon::now()->format('Y/m/d H:i:s');
                                    $historique = HistoriqueSup::create([
                                        'model' => 'financefrac',
                                        'operation' => 'Delete',
                                        'data' => $finfract,
                                        'user' => auth()->user()->email,
                                        'date' => $mytime,
                                    ]);
                                    $finFrac->delete();
                                }
                                  
                                    $Fracturation->delete();
                                    }
                                }  
                            }
                            $re = Reservoir::where('id', $reservoir->id)->delete();
                        }
                    }
                
                    $gi=Gisement::where('id', $Gisement->id)->delete();

                }

            }







            $model = app($dataType->model_name);
            if (!($model && in_array(SoftDeletes::class, class_uses_recursive($model)))) {
                $this->cleanup($dataType, $data);
            }
        }

        $displayName = count($ids) > 1 ? $dataType->getTranslatedAttribute('display_name_plural') : $dataType->getTranslatedAttribute('display_name_singular');

        $res = $data->destroy($ids);
        // dd($res);
        $data = $res
            ? [
                'message'    => __('voyager::generic.successfully_deleted') . " {$displayName}",
                'alert-type' => 'success',
            ]
            : [
                'message'    => __('voyager::generic.error_deleting') . " {$displayName}",
                'alert-type' => 'error',
            ];

        if ($res) {
            event(new BreadDataDeleted($dataType, $data));
        }
        // dd($data);
        return redirect()->route("voyager.{$dataType->slug}.index")->with($data);
    }

    public function restore(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $model = app($dataType->model_name);
        $this->authorize('delete', $model);

        // Get record
        $query = $model->withTrashed();
        if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope' . ucfirst($dataType->scope))) {
            $query = $query->{$dataType->scope}();
        }
        $data = $query->findOrFail($id);

        $displayName = $dataType->getTranslatedAttribute('display_name_singular');

        $res = $data->restore($id);
        $data = $res
            ? [
                'message'    => __('voyager::generic.successfully_restored') . " {$displayName}",
                'alert-type' => 'success',
            ]
            : [
                'message'    => __('voyager::generic.error_restoring') . " {$displayName}",
                'alert-type' => 'error',
            ];

        if ($res) {
            event(new BreadDataRestored($dataType, $data));
        }

        return redirect()->route("voyager.{$dataType->slug}.index")->with($data);
    }

    //***************************************
    //
    //  Delete uploaded file
    //
    //****************************************

    public function remove_media(Request $request)
    {
        try {
            // GET THE SLUG, ex. 'posts', 'pages', etc.
            $slug = $request->get('slug');

            // GET file name
            $filename = $request->get('filename');

            // GET record id
            $id = $request->get('id');

            // GET field name
            $field = $request->get('field');

            // GET multi value
            $multi = $request->get('multi');

            $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

            // Load model and find record
            $model = app($dataType->model_name);
            $data = $model::find([$id])->first();

            // Check if field exists
            if (!isset($data->{$field})) {
                throw new Exception(__('voyager::generic.field_does_not_exist'), 400);
            }

            // Check permission
            $this->authorize('edit', $data);

            if (@json_decode($multi)) {
                // Check if valid json
                if (is_null(@json_decode($data->{$field}))) {
                    throw new Exception(__('voyager::json.invalid'), 500);
                }

                // Decode field value
                $fieldData = @json_decode($data->{$field}, true);
                $key = null;

                // Check if we're dealing with a nested array for the case of multiple files
                if (is_array($fieldData[0])) {
                    foreach ($fieldData as $index => $file) {
                        // file type has a different structure than images
                        if (!empty($file['original_name'])) {
                            if ($file['original_name'] == $filename) {
                                $key = $index;
                                break;
                            }
                        } else {
                            $file = array_flip($file);
                            if (array_key_exists($filename, $file)) {
                                $key = $index;
                                break;
                            }
                        }
                    }
                } else {
                    $key = array_search($filename, $fieldData);
                }

                // Check if file was found in array
                if (is_null($key) || $key === false) {
                    throw new Exception(__('voyager::media.file_does_not_exist'), 400);
                }

                $fileToRemove = $fieldData[$key]['download_link'] ?? $fieldData[$key];

                // Remove file from array
                unset($fieldData[$key]);

                // Generate json and update field
                $data->{$field} = empty($fieldData) ? null : json_encode(array_values($fieldData));
            } else {
                if ($filename == $data->{$field}) {
                    $fileToRemove = $data->{$field};

                    $data->{$field} = null;
                } else {
                    throw new Exception(__('voyager::media.file_does_not_exist'), 400);
                }
            }

            $row = $dataType->rows->where('field', $field)->first();

            // Remove file from filesystem
            if (in_array($row->type, ['image', 'multiple_images'])) {
                $this->deleteBreadImages($data, [$row], $fileToRemove);
            } else {
                $this->deleteFileIfExists($fileToRemove);
            }

            $data->save();

            return response()->json([
                'data' => [
                    'status'  => 200,
                    'message' => __('voyager::media.file_removed'),
                ],
            ]);
        } catch (Exception $e) {
            $code = 500;
            $message = __('voyager::generic.internal_error');

            if ($e->getCode()) {
                $code = $e->getCode();
            }

            if ($e->getMessage()) {
                $message = $e->getMessage();
            }

            return response()->json([
                'data' => [
                    'status'  => $code,
                    'message' => $message,
                ],
            ], $code);
        }
    }

    /**
     * Remove translations, images and files related to a BREAD item.
     *
     * @param \Illuminate\Database\Eloquent\Model $dataType
     * @param \Illuminate\Database\Eloquent\Model $data
     *
     * @return void
     */
    protected function cleanup($dataType, $data)
    {
        // Delete Translations, if present
        if (is_bread_translatable($data)) {
            $data->deleteAttributeTranslations($data->getTranslatableAttributes());
        }

        // Delete Images
        $this->deleteBreadImages($data, $dataType->deleteRows->whereIn('type', ['image', 'multiple_images']));

        // Delete Files
        foreach ($dataType->deleteRows->where('type', 'file') as $row) {
            if (isset($data->{$row->field})) {
                foreach (json_decode($data->{$row->field}) as $file) {
                    $this->deleteFileIfExists($file->download_link);
                }
            }
        }

        // Delete media-picker files
        $dataType->rows->where('type', 'media_picker')->where('details.delete_files', true)->each(function ($row) use ($data) {
            $content = $data->{$row->field};
            if (isset($content)) {
                if (!is_array($content)) {
                    $content = json_decode($content);
                }
                if (is_array($content)) {
                    foreach ($content as $file) {
                        $this->deleteFileIfExists($file);
                    }
                } else {
                    $this->deleteFileIfExists($content);
                }
            }
        });
    }

    /**
     * Delete all images related to a BREAD item.
     *
     * @param \Illuminate\Database\Eloquent\Model $data
     * @param \Illuminate\Database\Eloquent\Model $rows
     *
     * @return void
     */
    public function deleteBreadImages($data, $rows, $single_image = null)
    {
        $imagesDeleted = false;

        foreach ($rows as $row) {
            if ($row->type == 'multiple_images') {
                $images_to_remove = json_decode($data->getOriginal($row->field), true) ?? [];
            } else {
                $images_to_remove = [$data->getOriginal($row->field)];
            }

            foreach ($images_to_remove as $image) {
                // Remove only $single_image if we are removing from bread edit
                if ($image != config('voyager.user.default_avatar') && (is_null($single_image) || $single_image == $image)) {
                    $this->deleteFileIfExists($image);
                    $imagesDeleted = true;

                    if (isset($row->details->thumbnails)) {
                        foreach ($row->details->thumbnails as $thumbnail) {
                            $ext = explode('.', $image);
                            $extension = '.' . $ext[count($ext) - 1];

                            $path = str_replace($extension, '', $image);

                            $thumb_name = $thumbnail->name;

                            $this->deleteFileIfExists($path . '-' . $thumb_name . $extension);
                        }
                    }
                }
            }
        }

        if ($imagesDeleted) {
            event(new BreadImagesDeleted($data, $rows));
        }
    }

    /**
     * Order BREAD items.
     *
     * @param string $table
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function order(Request $request)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('edit', app($dataType->model_name));

        if (empty($dataType->order_column) || empty($dataType->order_display_column)) {
            return redirect()
                ->route("voyager.{$dataType->slug}.index")
                ->with([
                    'message'    => __('voyager::bread.ordering_not_set'),
                    'alert-type' => 'error',
                ]);
        }

        $model = app($dataType->model_name);
        $query = $model->query();
        if ($model && in_array(SoftDeletes::class, class_uses_recursive($model))) {
            $query = $query->withTrashed();
        }
        $results = $query->orderBy($dataType->order_column, $dataType->order_direction)->get();

        $display_column = $dataType->order_display_column;

        $dataRow = Voyager::model('DataRow')->whereDataTypeId($dataType->id)->whereField($display_column)->first();

        $view = 'voyager::bread.order';

        if (view()->exists("voyager::$slug.order")) {
            $view = "voyager::$slug.order";
        }

        return Voyager::view($view, compact(
            'dataType',
            'display_column',
            'dataRow',
            'results'
        ));
    }

    public function update_order(Request $request)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('edit', app($dataType->model_name));

        $model = app($dataType->model_name);

        $order = json_decode($request->input('order'));
        $column = $dataType->order_column;
        foreach ($order as $key => $item) {
            if ($model && in_array(SoftDeletes::class, class_uses_recursive($model))) {
                $i = $model->withTrashed()->findOrFail($item->id);
            } else {
                $i = $model->findOrFail($item->id);
            }
            $i->$column = ($key + 1);
            $i->save();
        }
    }

    public function action(Request $request)
    {
        $slug = $this->getSlug($request);
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        $action = new $request->action($dataType, null);

        return $action->massAction(explode(',', $request->ids), $request->headers->get('referer'));
    }

    /**
     * Get BREAD relations data.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function relation(Request $request)
    {
        $slug = $this->getSlug($request);
        $page = $request->input('page');
        $on_page = 50;
        $search = $request->input('search', false);
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        $method = $request->input('method', 'add');

        $model = app($dataType->model_name);
        if ($method != 'add') {
            $model = $model->find($request->input('id'));
        }

        $this->authorize($method, $model);

        $rows = $dataType->{$method . 'Rows'};
        foreach ($rows as $key => $row) {
            if ($row->field === $request->input('type')) {
                $options = $row->details;
                $model = app($options->model);
                $skip = $on_page * ($page - 1);

                $additional_attributes = $model->additional_attributes ?? [];

                // Apply local scope if it is defined in the relationship-options
                if (isset($options->scope) && $options->scope != '' && method_exists($model, 'scope' . ucfirst($options->scope))) {
                    $model = $model->{$options->scope}();
                }

                // If search query, use LIKE to filter results depending on field label
                if ($search) {
                    // If we are using additional_attribute as label
                    if (in_array($options->label, $additional_attributes)) {
                        $relationshipOptions = $model->get();
                        $relationshipOptions = $relationshipOptions->filter(function ($model) use ($search, $options) {
                            return stripos($model->{$options->label}, $search) !== false;
                        });
                        $total_count = $relationshipOptions->count();
                        $relationshipOptions = $relationshipOptions->forPage($page, $on_page);
                    } else {
                        $total_count = $model->where($options->label, 'LIKE', '%' . $search . '%')->count();
                        $relationshipOptions = $model->take($on_page)->skip($skip)
                            ->where($options->label, 'LIKE', '%' . $search . '%')
                            ->get();
                    }
                } else {
                    $total_count = $model->count();
                    $relationshipOptions = $model->take($on_page)->skip($skip)->get();
                }

                $results = [];

                if (!$row->required && !$search && $page == 1) {
                    $results[] = [
                        'id'   => '',
                        'text' => __('voyager::generic.none'),
                    ];
                }

                // Sort results
                if (!empty($options->sort->field)) {
                    if (!empty($options->sort->direction) && strtolower($options->sort->direction) == 'desc') {
                        $relationshipOptions = $relationshipOptions->sortByDesc($options->sort->field);
                    } else {
                        $relationshipOptions = $relationshipOptions->sortBy($options->sort->field);
                    }
                }

                foreach ($relationshipOptions as $relationshipOption) {
                    $results[] = [
                        'id'   => $relationshipOption->{$options->key},
                        'text' => $relationshipOption->{$options->label},
                    ];
                }

                return response()->json([
                    'results'    => $results,
                    'pagination' => [
                        'more' => ($total_count > ($skip + $on_page)),
                    ],
                ]);
            }
        }

        // No result found, return empty array
        return response()->json([], 404);
    }

    protected function findSearchableRelationshipRow($relationshipRows, $searchKey)
    {
        return $relationshipRows->filter(function ($item) use ($searchKey) {
            if ($item->details->column != $searchKey) {
                return false;
            }
            if ($item->details->type != 'belongsTo') {
                return false;
            }

            return !$this->relationIsUsingAccessorAsLabel($item->details);
        })->first();
    }

    protected function getSortableColumns($rows)
    {
        return $rows->filter(function ($item) {
            if ($item->type != 'relationship') {
                return true;
            }
            if ($item->details->type != 'belongsTo') {
                return false;
            }

            return !$this->relationIsUsingAccessorAsLabel($item->details);
        })
            ->pluck('field')
            ->toArray();
    }

    protected function relationIsUsingAccessorAsLabel($details)
    {
        return in_array($details->label, app($details->model)->additional_attributes ?? []);
    }

    protected function valide()
    {


        $prog = Perimetre::where('id', \request("id"))->first();
        $prog->Valide = "oui";
        $mytime = Carbon::now();
        $prog->dateValidation = $mytime;
        $prog->save();
        $mytime = Carbon::now()->format('Y/m/d H:i:s');

            $historique=HistoriqueValidation::create([
            'model'=>'Perimetre',
            'operation'=>'validation',
            'data'=>$prog->id,
            'user'=>auth()->user()->email,
            'date'=>$mytime,
        ]);
        return redirect(route('voyager.perimetres.index'));
    }
}
