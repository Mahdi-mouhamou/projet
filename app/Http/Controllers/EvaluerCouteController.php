<?php

namespace App\Http\Controllers;

use App\Models\RealisationSismique;
use Illuminate\Http\Request;
use Exception;
use Carbon\Carbon;
use App\Models\Programme;
use App\Models\Perimetre;
use App\Models\Puit;
use App\Models\RealisationGg;
use Doctrine\DBAL\Schema\View;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\DB;
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
class EvaluerCouteController extends  \TCG\Voyager\Http\Controllers\VoyagerBaseController
{
   protected function couteSismique(){

    $prog = RealisationSismique::where('id', \request("id"))->first();

    $id=\request("id");
    // dd($id);
    define($id,$id);
    // dd($id);
    return redirect(route('voyager.finance-sismiques.create'))->with('status',$id);
    // return view('voyager::finance-sismiques.browse');
    }



    protected function couteGg(){
        $prog = RealisationGg::where('id', \request("id"))->first();

        $id=\request("id");
        // dd($id);
        return redirect(route('voyager.finance-ggs.create'))->with('status',$id);
    }
    protected function   coutePuit(){
        $prog = Puit::where('id', \request("id"))->first();

        $id=\request("id");
        // dd($id);
        return redirect(route('voyager.finance-puits.create'))->with('status',$id);
    }
  
    protected function   couteFracturation(){
        $prog = Puit::where('id', \request("id"))->first();

        $id=\request("id");
        // dd($id);
        return redirect(route('voyager.finance-fracturations.create'))->with('status',$id);
    }
}
