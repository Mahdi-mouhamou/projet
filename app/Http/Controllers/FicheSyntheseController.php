<?php

namespace App\Http\Controllers;

use App\Models\Avenant;
use App\Models\Contrat;
use App\Models\Perimetre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class FicheSyntheseController extends Controller
{
    protected function index()
    {
        $perimetre = Perimetre::orderBy('id','desc')->get();
        $routeName=Route::currentRouteName();
        // $currentPath= Route::getFacadeRoot()->current()->uri();
        // dd($routeName);
        return view('ficheSynthese', [
            'perimetre' => $perimetre,
            'routeName'=>$routeName
        ]);
    }
    protected function detaille($id)
    {
        $perimetre = DB::table('perimetres')
            ->select('NomPerimetre')
            ->where('contrat_id', '=', $id)
            ->get();

        $contrat = DB::table('contrats')
            ->select('*')
            ->where('id', '=', $id)->get();

        //    $contratId= $contrat->pluck('id');
        //    dd($perId[0]);
        $avenant = DB::table('avenants')
            ->select('*')
            ->where('contrat_id', '=', $id)
            ->get();
        $programme = DB::table('programmes')
            ->select('*')
            ->where('contrat_id', '=', $id)
            ->get();
        //  dd($avenant);
        $contrat = $contrat->toJson();
        $perimetre = $perimetre->toJson();
        $avenant = $avenant->toJson();
        // dd($contrat);
        return view('fichedetaille', [
            'contrat' => $contrat,
            'avenant' => $avenant,
            'programme' => $programme,
            'perimetre' => $perimetre
        ]);
    }

    protected function phase1()
    {
        $contrat = Contrat::all();
        return view('vendor.voyager.realisation-sismiques.phase1', [
            'contrat' => $contrat
        ]);
    }
    protected function phase1Detaille($id)
    {
        $programme = DB::table('programmes')
            ->select('*')
            ->where('contrat_id', '=', $id)
            ->where('phase', '=', 'phase1')
            ->get();
        //   dd($programme);
        // $programme=$programme->toJson();
        return view('vendor.voyager.realisation-sismiques.phaseDetaille', [
            'programme' => $programme
        ]);
    }
    protected function phase2()
    {
        $contrat = Contrat::all();
        return view('vendor.voyager.realisation-sismiques.phase2', [
            'contrat' => $contrat
        ]);
    }
    protected function phase2Detaille($id)
    {
        $programme = DB::table('programmes')
            ->select('*')
            ->where('contrat_id', '=', $id)
            ->where('phase', '=', 'phase2')
            ->get();

        // $programme=$programme->toJson();
        return view('vendor.voyager.realisation-sismiques.phaseDetaille', [
            'programme' => $programme
        ]);
    }
    protected function phase3()
    {
        $contrat = Contrat::all();
        return view('vendor.voyager.realisation-sismiques.phase3', [
            'contrat' => $contrat
        ]);
    }
    protected function phase3Detaille($id)
    {
        $programme = DB::table('programmes')
            ->select('*')
            ->where('contrat_id', '=', $id)
            ->where('phase', '=', 'phase3')
            ->get();

        // $programme=$programme->toJson();
        return view('vendor.voyager.realisation-sismiques.phaseDetaille', [
            'programme' => $programme
        ]);
    }
    protected function Resultat()
    {
        $perimetre = Perimetre::orderBy('id','desc')->get();
        return view('resultat', [
            'perimetre' => $perimetre,
        ]);
    }

    protected function resultatPhase1($id, $phase)
    {


        $programme = DB::table('programmes')
            ->select('*')
            ->where('contrat_id', '=', $id)
            ->where('phase', '=', $phase)
            ->get();
        // dd($programme);
        $programme = $programme->toJson();
        $programme = json_decode($programme, 'true');
        //  $D2=$programme->AcusSismique2D;
        foreach ($programme as $value) {

            $somme2D = $value['TraitSismique2D'] + $value['AcusSismique2D'] + $value['RtraitSismique2D'];
            $somme3D = $value['TraitSismique3D'] + $value['AcusSismique3D'] + $value['RtraitSismique3D'];
            $nbPuitE = $value['NbPuitExploration'];
            $nbPuitD = $value['NbPuitDeliniation'];
            $methodePotentiel = $value['MethodePotentiel'];
            // $FractHydraulique=$value['FractHydraulique'];
            $EtudeGG = $value['EtudeGG'];
        }
        $realisation2D = DB::table('realisation_sismiques')
            ->select('Kilometrage')
            ->where('phase', '=', $phase)
            ->where('TypeSismique', '=', '2D')
            ->where('contrat_id', '=', $id)
            ->sum('Kilometrage');


        $realisation3D = DB::table('realisation_sismiques')
            ->select('Kilometrage')
            ->where('phase', '=', $phase)
            ->where('TypeSismique', '=', '3D')
            ->where('contrat_id', '=', $id)
            ->sum('Kilometrage');


        $realisationPot = DB::table('realisation_sismiques')
            ->select('Kilometrage')
            ->where('phase', '=', $phase)
            ->where('TypeSismique', '=', 'Methode potentiel')
            ->where('contrat_id', '=', $id)
            ->sum('Kilometrage');


        $realisationGg = DB::table('realisation_ggs')
            ->select('*')
            ->where('phase', '=', $phase)
            ->where('contrat_id', '=', $id)
            ->count('id');

        //  dd($realisation2D);


        $puitE = DB::table('puits')
            ->join('reservoirs', 'Reservoir_id', '=', 'reservoirs.id')
            ->join('gisements', 'gisements.id', '=', 'reservoirs.Gisement_id')
            ->join('perimetres', 'perimetres.id', '=', 'gisements.perimetre_id')
            ->join('contrats', 'contrats.id', '=', 'perimetres.contrat_id')
            // ->select('SiglePuit','contrats.id')
            ->where('contrats.id', '=', $id)
            ->where('puits.phase', '=', $phase)
            ->where('puits.TypePuit', '=', 'Exploration')
            ->count('puits.id');


        $puitD = DB::table('puits')
            ->join('reservoirs', 'Reservoir_id', '=', 'reservoirs.id')
            ->join('gisements', 'gisements.id', '=', 'reservoirs.Gisement_id')
            ->join('perimetres', 'perimetres.id', '=', 'gisements.perimetre_id')
            ->join('contrats', 'contrats.id', '=', 'perimetres.contrat_id')
            // ->select('SiglePuit','contrats.id')
            ->where('contrats.id', '=', $id)
            ->where('puits.phase', '=', $phase)
            ->where('puits.TypePuit', '=', 'Delination')
            ->count('puits.id');
        $phaseD = $phase;
        // dd($puit);

        $effectif2D = $somme2D - $realisation2D;
        $effectif3D = $somme3D - $realisation3D;
        $effectifpot = $methodePotentiel - $realisationPot;
        $effectifGg = $EtudeGG - $realisationGg;
        $effectifPuitE = $nbPuitE - $puitE;
        $effectifPuitD = $nbPuitD - $puitD;
        // dd($effectif2D);

        return view('resultatD', [
            'phase' => $phaseD,
            'realisation2D' => $realisation2D,
            'realisation3D' => $realisation3D,
            'realisationPot' => $realisationPot,
            'realisationGg' => $realisationGg,
            'puitE' => $puitE,
            'puitD' => $puitD,
            'effectif2D' => $effectif2D,
            'effectif3D' => $effectif3D,
            'effectifpot' => $effectifpot,
            'effectifGg' => $effectifGg,
            'effectifPuitE' => $effectifPuitE,
            'effectifPuitD' => $effectifPuitD
        ]);
    }


    protected function detailleRenseignement($id){

        $perimetre = DB::table('perimetres')
            ->select('*')
            ->where('id', '=', $id)
            ->get();
        $perId= $perimetre->pluck('id');
        // dd($perId);
        $gisement=DB::table('gisements')
                    ->select('NomGisement','Superficie')
                    ->where('perimetre_id','=',$perId)
                    ->get();
        // dd($gisement);
        return view('renseignement',[
        'perimetre'=>$perimetre,
        'gisement'=>$gisement
        ]);
    }



}
