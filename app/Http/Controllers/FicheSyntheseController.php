<?php

namespace App\Http\Controllers;

use App\Models\Avenant;
use App\Models\Contrat;
use App\Models\Historique;
use App\Models\HistoriqueAdd;
use App\Models\HistoriqueEdit;
use App\Models\Journal;
use App\Models\Perimetre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class FicheSyntheseController extends Controller
{
    protected function index()
    {
        $perimetre = Perimetre::orderBy('id','desc')
        ->where('valide','=','oui')->get();
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

        // dd("rf");
        $perimetre = DB::table('perimetres')
            ->select('NomPerimetre')
            ->where('valide','=','oui')
            ->where('id','=',$id)
            ->get();
// dd($perimetre);
        $contrat = DB::table('contrats')
            ->select('*')
            ->where('valide','=','oui')
            ->where('perimetre_id', '=', $id)->get();
        // dd($contrat);
       if($contrat->count()==0){
        $avenant="";
        $programme="";
        $programme1="";
        $programme1="";
        $effectif2DA="";
        $effectif2DT="";
        $effectif2DRT="";
        $effectif3DA="";
        $effectif3DT="";
        $effectif3DRT="";
        $effectifpot = "";
        $effectifGg = "";
        $effectifPuitE = "";
        $effectifPuitD = "";
        $programme2="";
        $effectif2DAP2="";
        $effectif2DTP2="";
        $effectif2DRTP2="";
        $effectif3DAP2="";
        $effectif3DTP2="";
        $effectif3DRTP2="";
        $effectifpotP2 = "";
        $effectifGgP2 = "";
        $effectifPuitEP2 = "";
        $effectifPuitDP2 = "";
        $programme3="";
        return view('fichedetaille', [
            'contrat' => $contrat,
            'avenant' => $avenant,
            'programme1' => $programme1,
            'programme2' => $programme2,
            'programme3' => $programme3,
            'perimetre' => $perimetre,
            // 'realisation2DA' => $realisation2DA,
            // 'realisation2DT' => $realisation2DT,
            // 'realisation2DRT' => $realisation2DRT,
            // 'realisation3DA' => $realisation3DA,
            // 'realisation3DT' => $realisation3DT,
            // 'realisation3DRT' => $realisation3DRT,
            // 'realisationPot' => $realisationPot,
            // 'realisationGg' => $realisationGg,
            // 'puitE' => $puitE,
            // 'puitD' => $puitD,
            'effectif2DA' => $effectif2DA,
            'effectif2DT' => $effectif2DT,
            'effectif2DRT' => $effectif2DRT,
            'effectif3DA' => $effectif3DA,
            'effectif3DT' => $effectif3DT,
            'effectif3DRT' => $effectif3DRT,
            'effectifpot' => $effectifpot,
            'effectifGg' => $effectifGg,
            'effectifPuitE' => $effectifPuitE,
            'effectifPuitD' => $effectifPuitD ,
            'effectif2DAP2' => $effectif2DAP2,
            'effectif2DTP2' => $effectif2DTP2,
            'effectif2DRTP2' => $effectif2DRTP2,
            'effectif3DAP2' => $effectif3DAP2,
            'effectif3DTP2' => $effectif3DTP2,
            'effectif3DRTP2' => $effectif3DRTP2,
            'effectifpotP2' => $effectifpotP2,
            'effectifGgP2' => $effectifGgP2,
            'effectifPuitEP2' => $effectifPuitEP2,
            'effectifPuitDP2' => $effectifPuitDP2
        ]);
       }else{
        $contratId= $contrat->pluck('id');
        //    dd($perId[0]);
        $avenant = DB::table('avenants')
            ->select('*')
            ->where('contrat_id', '=', $contratId)
            ->get();
        if($avenant->isEmpty()){
            $avenant="";
        }
        else
        {
         $avenant = $avenant->toJson();
        }

        $programme1 = DB::table('programmes')
            ->select('*')
            ->where('contrat_id', '=', $contratId)
            ->where('phase','=','phase1')
            ->get();
       
        if($programme1->isEmpty()){
                $programme1="";
                $effectif2DA="";
                $effectif2DT="";
                $effectif2DRT="";
                $effectif3DA="";
                $effectif3DT="";
                $effectif3DRT="";
                $effectifpot = "";
                $effectifGg = "";
                $effectifPuitE = "";
                $effectifPuitD = "";
            }
            else
            {
             $programme1 = $programme1->toJson();
             $programme = json_decode($programme1, 'true');


             if($programme==null)
             {
                 // dd("dsdf");
                 $programme="";
             }
             else{
            $AcusSismique2D= $programme[0]['AcusSismique2D'];
            $TraitSismique2D= $programme[0]['TraitSismique2D'];
            $RtraitSismique2D= $programme[0]['RtraitSismique2D'];
     
            $AcusSismique3D= $programme[0]['AcusSismique3D'];
            $TraitSismique3D= $programme[0]['TraitSismique3D'];
            $RtraitSismique3D= $programme[0]['RtraitSismique3D'];
     
            $nbPuitE= $programme[0]['NbPuitExploration'];
            $nbPuitD= $programme[0]['NbPuitDeliniation'];
     
            $methodePotentiel= $programme[0]['MethodePotentiel'];
     
            $FractHydraulique=$programme[0]['FractHydraulique'];
            $EtudeGG=$programme[0]['EtudeGG'];   
             }
             $realisation2DA = DB::table('realisation_sismiques')
             ->select('Kilometrage')
             ->where('phase', '=', 'phase1')
             ->where('TypeSismique','=', '2D')
             ->where('Operation', '=','Acquisition')
             ->where('contrat_id', '=', $contratId)
             ->sum('Kilometrage');
 
             
         $realisation2DT = DB::table('realisation_sismiques')
             ->select('Kilometrage')
             ->where('phase', '=', 'phase1')
             ->where('TypeSismique', '=', '2D')
             ->where('Operation', '=', 'Traitement')
             ->where('contrat_id', '=', $contratId)
             ->sum('Kilometrage');
 
         $realisation2DRT = DB::table('realisation_sismiques')
             ->select('Kilometrage')
             ->where('phase', '=', 'phase1')
             ->where('TypeSismique', '=', '2D')
             ->where('Operation', '=', 'Retraitement')
             ->where('contrat_id', '=', $contratId)
             ->sum('Kilometrage');
             // dd($realisation2DA,$realisation2DT,$realisation2DRT);
       
             $realisation3DA = DB::table('realisation_sismiques')
             ->select('Kilometrage')
             ->where('phase', '=', 'phase1')
             ->where('TypeSismique','=', '3D')
             ->where('Operation', '=','Acquisition')
             ->where('contrat_id', '=', $contratId)
             ->sum('Kilometrage');
 
             
         $realisation3DT = DB::table('realisation_sismiques')
             ->select('Kilometrage')
             ->where('phase', '=', 'phase1')
             ->where('TypeSismique', '=', '3D')
             ->where('Operation', '=', 'Traitement')
             ->where('contrat_id', '=', $contratId)
             ->sum('Kilometrage');
 
         $realisation3DRT = DB::table('realisation_sismiques')
             ->select('Kilometrage')
             ->where('phase', '=', 'phase1')
             ->where('TypeSismique', '=', '3D')
             ->where('Operation', '=', 'Retraitement')
             ->where('contrat_id', '=', $contratId)
             ->sum('Kilometrage');
 
         $realisationPot = DB::table('realisation_sismiques')
             ->select('Kilometrage')
             ->where('phase', '=', 'phase1')
             ->where('TypeSismique', '=', 'Methode potentiel')
             ->where('Operation', '=','Acquisition')
             ->where('contrat_id', '=', $contratId)
             ->sum('Kilometrage');
 
 
         $realisationGg = DB::table('realisation_ggs')
             ->select('*')
             ->where('phase', '=', 'phase1')
             ->where('contrat_id', '=', $contratId)
             ->count('id');
 
         //  dd($realisation2D);
 
 
         $puitE = DB::table('puits')
             ->join('reservoirs', 'Reservoir_id', '=', 'reservoirs.id')
             ->join('gisements', 'gisements.id', '=', 'reservoirs.Gisement_id')
             ->join('perimetres', 'perimetres.id', '=', 'gisements.perimetre_id')
             ->join('contrats', 'contrats.perimetre_id', '=', 'perimetres.id')
             // ->select('SiglePuit','contrats.id')
             ->where('contrats.id', '=', $contratId)
             ->where('puits.phase', '=', 'phase1')
             ->where('puits.TypePuit', '=', 'Exploration')
             ->count('puits.id');
             // dd($puitE);
 
         $puitD = DB::table('puits')
             ->join('reservoirs', 'Reservoir_id', '=', 'reservoirs.id')
             ->join('gisements', 'gisements.id', '=', 'reservoirs.Gisement_id')
             ->join('perimetres', 'perimetres.id', '=', 'gisements.perimetre_id')
             ->join('contrats', 'contrats.perimetre_id', '=', 'perimetres.id')
             // ->select('SiglePuit','contrats.id')
             ->where('contrats.id', '=', $contratId)
             ->where('puits.phase', '=', 'phase1')
             ->where('puits.TypePuit', '=', 'Delination')
             ->count('puits.id');
         // dd($puitD);
 
         if($programme==null){
             // dd("ffdf");
             $programme="";
             $effectif2DA="";
             $effectif2DT="";
             $effectif2DRT="";
             $effectif3DA="";
             $effectif3DT="";
             $effectif3DRT="";
             $effectifpot = "";
             $effectifGg = "";
             $effectifPuitE = "";
             $effectifPuitD = "";
             }
         else{
         $effectif2DA = $AcusSismique2D - $realisation2DA;
         if($effectif2DA<0){$effectif2DA="honoré";}

         $effectif2DT = $TraitSismique2D - $realisation2DT;
         if($effectif2DT<0){$effectif2DT="honoré";}

         $effectif2DRT = $RtraitSismique2D - $realisation2DRT;
         if($effectif2DRT<0){$effectif2DRT="honoré";}

         $effectif3DA = $AcusSismique3D - $realisation3DA;
         if($effectif3DA<0){$effectif3DA="honoré";}

         $effectif3DT = $TraitSismique3D - $realisation3DT;
         if($effectif3DT<0){$effectif3DT="honoré";}

         $effectif3DRT = $RtraitSismique3D - $realisation3DRT;
         if($effectif3DRT<0){$effectif3DRT="honoré";}

         $effectifpot = $methodePotentiel - $realisationPot;
         $effectifGg = $EtudeGG - $realisationGg;
         $effectifPuitE = $nbPuitE - $puitE;
         $effectifPuitD = $nbPuitD - $puitD;
         }

            }
             $programme2 = DB::table('programmes')
            ->select('*')
            ->where('contrat_id', '=', $contratId)
            ->where('phase','=','phase2')
            ->get();
        if($programme2->isEmpty()){
                $programme2="";
             $effectif2DAP2="";
             $effectif2DTP2="";
             $effectif2DRTP2="";
             $effectif3DAP2="";
             $effectif3DTP2="";
             $effectif3DRTP2="";
             $effectifpotP2 = "";
             $effectifGgP2 = "";
             $effectifPuitEP2 = "";
             $effectifPuitDP2 = "";
            }
            else
            {
                
             $programme2 = $programme2->toJson();
             $programme = json_decode($programme2, 'true');


             if($programme==null)
             {
                 // dd("dsdf");
                 $programme="";
             }
             else{
            $AcusSismique2DP2= $programme[0]['AcusSismique2D'];
            $TraitSismique2DP2= $programme[0]['TraitSismique2D'];
            $RtraitSismique2DP2= $programme[0]['RtraitSismique2D'];
     
            $AcusSismique3DP2= $programme[0]['AcusSismique3D'];
            $TraitSismique3DP2= $programme[0]['TraitSismique3D'];
            $RtraitSismique3DP2= $programme[0]['RtraitSismique3D'];
     
            $nbPuitEP2= $programme[0]['NbPuitExploration'];
            $nbPuitDP2= $programme[0]['NbPuitDeliniation'];
     
            $methodePotentielP2= $programme[0]['MethodePotentiel'];
     
            $FractHydrauliqueP2=$programme[0]['FractHydraulique'];
            $EtudeGGP2=$programme[0]['EtudeGG'];   
             }
             $realisation2DAP2 = DB::table('realisation_sismiques')
             ->select('Kilometrage')
             ->where('phase', '=', 'phase2')
             ->where('TypeSismique','=', '2D')
             ->where('Operation', '=','Acquisition')
             ->where('contrat_id', '=', $contratId)
             ->sum('Kilometrage');
 
             
         $realisation2DTP2 = DB::table('realisation_sismiques')
             ->select('Kilometrage')
             ->where('phase', '=', 'phase2')
             ->where('TypeSismique', '=', '2D')
             ->where('Operation', '=', 'Traitement')
             ->where('contrat_id', '=', $contratId)
             ->sum('Kilometrage');
 
         $realisation2DRTP2 = DB::table('realisation_sismiques')
             ->select('Kilometrage')
             ->where('phase', '=', 'phase2')
             ->where('TypeSismique', '=', '2D')
             ->where('Operation', '=', 'Retraitement')
             ->where('contrat_id', '=', $contratId)
             ->sum('Kilometrage');
             // dd($realisation2DA,$realisation2DT,$realisation2DRT);
       
             $realisation3DAP2 = DB::table('realisation_sismiques')
             ->select('Kilometrage')
             ->where('phase', '=', 'phase2')
             ->where('TypeSismique','=', '3D')
             ->where('Operation', '=','Acquisition')
             ->where('contrat_id', '=', $contratId)
             ->sum('Kilometrage');
 
             
         $realisation3DTP2 = DB::table('realisation_sismiques')
             ->select('Kilometrage')
             ->where('phase', '=', 'phase2')
             ->where('TypeSismique', '=', '3D')
             ->where('Operation', '=', 'Traitement')
             ->where('contrat_id', '=', $contratId)
             ->sum('Kilometrage');
 
         $realisation3DRTP2 = DB::table('realisation_sismiques')
             ->select('Kilometrage')
             ->where('phase', '=', 'phase2')
             ->where('TypeSismique', '=', '3D')
             ->where('Operation', '=', 'Retraitement')
             ->where('contrat_id', '=', $contratId)
             ->sum('Kilometrage');
 
         $realisationPotP2 = DB::table('realisation_sismiques')
             ->select('Kilometrage')
             ->where('phase', '=', 'phase2')
             ->where('TypeSismique', '=', 'Methode potentiel')
             ->where('Operation', '=','Acquisition')
             ->where('contrat_id', '=', $contratId)
             ->sum('Kilometrage');
 
 
         $realisationGgP2 = DB::table('realisation_ggs')
             ->select('*')
             ->where('phase', '=', 'phase2')
             ->where('contrat_id', '=', $contratId)
             ->count('id');
 
         //  dd($realisation2D);
 
 
         $puitEP2 = DB::table('puits')
             ->join('reservoirs', 'Reservoir_id', '=', 'reservoirs.id')
             ->join('gisements', 'gisements.id', '=', 'reservoirs.Gisement_id')
             ->join('perimetres', 'perimetres.id', '=', 'gisements.perimetre_id')
             ->join('contrats', 'contrats.perimetre_id', '=', 'perimetres.id')
             // ->select('SiglePuit','contrats.id')
             ->where('contrats.id', '=', $contratId)
             ->where('puits.phase', '=', 'phase2')
             ->where('puits.TypePuit', '=', 'Exploration')
             ->count('puits.id');
             // dd($puitE);
 
         $puitDP2 = DB::table('puits')
             ->join('reservoirs', 'Reservoir_id', '=', 'reservoirs.id')
             ->join('gisements', 'gisements.id', '=', 'reservoirs.Gisement_id')
             ->join('perimetres', 'perimetres.id', '=', 'gisements.perimetre_id')
             ->join('contrats', 'contrats.perimetre_id', '=', 'perimetres.id')
             // ->select('SiglePuit','contrats.id')
             ->where('contrats.id', '=', $contratId)
             ->where('puits.phase', '=', 'phase2')
             ->where('puits.TypePuit', '=', 'Delination')
             ->count('puits.id');
         // dd($puitD);
 
         if($programme==null){
             // dd("ffdf");
             $programme="";
             $effectif2DAP2="";
             $effectif2DTP2="";
             $effectif2DRTP2="";
             $effectif3DAP2="";
             $effectif3DTP2="";
             $effectif3DRTP2="";
             $effectifpotP2 = "";
             $effectifGgP2 = "";
             $effectifPuitEP2 = "";
             $effectifPuitDP2 = "";
             }
         else{
         $effectif2DAP2 = $AcusSismique2DP2 - $realisation2DAP2;
        if($effectif2DAP2<0){$effectif2DAP2="honoré";}

         $effectif2DTP2 = $TraitSismique2DP2 - $realisation2DTP2;
         if($effectif2DTP2<0){$effectif2DTP2="honoré";}

         $effectif2DRTP2 = $RtraitSismique2DP2 - $realisation2DRTP2;
        if($effectif2DRTP2<0){$effectif2DRTP2="honoré";}
 
         $effectif3DAP2 = $AcusSismique3DP2 - $realisation3DAP2;
         if($effectif3DAP2<0){$effectif3DAP2="honoré";}

         $effectif3DTP2 = $TraitSismique3DP2 - $realisation3DTP2;
         if($effectif3DTP2<0){$effectif3DTP2="honoré";}

         $effectif3DRTP2 = $RtraitSismique3DP2 - $realisation3DRTP2;
         if($effectif3DRTP2<0){$effectif3DRTP2="honoré";}
 
         $effectifpotP2 = $methodePotentielP2 - $realisationPotP2;
         $effectifGgP2 = $EtudeGGP2 - $realisationGgP2;
         $effectifPuitEP2 = $nbPuitEP2 - $puitEP2;
         $effectifPuitDP2 = $nbPuitDP2 - $puitDP2;
         }

             
            }
            $programme3 = DB::table('programmes')
            ->select('*')
            ->where('contrat_id', '=', $contratId)
            ->where('phase','=','phase3')
            ->get();
           
        if($programme3->isEmpty()){
                $programme3="";
            }
            else
            {
             $programme3 = $programme3->toJson();
            }
        $contrat = $contrat->toJson();
        $perimetre = $perimetre->toJson();
        return view('fichedetaille', [
            'contrat' => $contrat,
            'avenant' => $avenant,
            'programme1' => $programme1,
            'programme2' => $programme2,
            'programme3' => $programme3,
            'perimetre' => $perimetre,
            // 'realisation2DA' => $realisation2DA,
            // 'realisation2DT' => $realisation2DT,
            // 'realisation2DRT' => $realisation2DRT,
            // 'realisation3DA' => $realisation3DA,
            // 'realisation3DT' => $realisation3DT,
            // 'realisation3DRT' => $realisation3DRT,
            // 'realisationPot' => $realisationPot,
            // 'realisationGg' => $realisationGg,
            // 'puitE' => $puitE,
            // 'puitD' => $puitD,
            'effectif2DA' => $effectif2DA,
            'effectif2DT' => $effectif2DT,
            'effectif2DRT' => $effectif2DRT,
            'effectif3DA' => $effectif3DA,
            'effectif3DT' => $effectif3DT,
            'effectif3DRT' => $effectif3DRT,
            'effectifpot' => $effectifpot,
            'effectifGg' => $effectifGg,
            'effectifPuitE' => $effectifPuitE,
            'effectifPuitD' => $effectifPuitD ,
            'effectif2DAP2' => $effectif2DAP2,
            'effectif2DTP2' => $effectif2DTP2,
            'effectif2DRTP2' => $effectif2DRTP2,
            'effectif3DAP2' => $effectif3DAP2,
            'effectif3DTP2' => $effectif3DTP2,
            'effectif3DRTP2' => $effectif3DRTP2,
            'effectifpotP2' => $effectifpotP2,
            'effectifGgP2' => $effectifGgP2,
            'effectifPuitEP2' => $effectifPuitEP2,
            'effectifPuitDP2' => $effectifPuitDP2
        ]);
       }
       
        // dd($contrat);
       
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
        return view('vendor.voyager.programmes.PrgDetaille', [
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

        $perimetre = DB::table('perimetres')
        ->select('NomPerimetre')
        ->where('id','=',$id)
        ->get();

        $contrat = DB::table('contrats')
        ->select('*')
        ->where('perimetre_id', '=', $id)->get();
        if($contrat->isEmpty()){
            $contratId=null;
           }else
        {
         $contratId= $contrat->pluck('id');
       
        }
        $programme = DB::table('programmes')
            ->select('*')
            ->where('contrat_id', '=', $contratId)
            ->where('phase', '=', $phase)
            ->get();
        // 
        $programme = $programme->toJson();
        $programme = json_decode($programme, 'true');


        if($programme==null)
        {
            // dd("dsdf");
            $programme="";
        }
        else{
       $AcusSismique2D= $programme[0]['AcusSismique2D'];
       $TraitSismique2D= $programme[0]['TraitSismique2D'];
       $RtraitSismique2D= $programme[0]['RtraitSismique2D'];

       $AcusSismique3D= $programme[0]['AcusSismique3D'];
       $TraitSismique3D= $programme[0]['TraitSismique3D'];
       $RtraitSismique3D= $programme[0]['RtraitSismique3D'];

       $nbPuitE= $programme[0]['NbPuitExploration'];
       $nbPuitD= $programme[0]['NbPuitDeliniation'];

       $methodePotentiel= $programme[0]['MethodePotentiel'];

       $FractHydraulique=$programme[0]['FractHydraulique'];
       $EtudeGG=$programme[0]['EtudeGG'];   
        }
        // dd($programme[0]['id']);
        //  $D2=$programme->AcusSismique2D;
        //  dd($D2);
        // foreach ($programme as $value) {

        //     $somme2D = $value['TraitSismique2D'] + $value['AcusSismique2D'] + $value['RtraitSismique2D'];
        //     $somme3D = $value['TraitSismique3D'] + $value['AcusSismique3D'] + $value['RtraitSismique3D'];
        //     $nbPuitE = $value['NbPuitExploration'];
        //     $nbPuitD = $value['NbPuitDeliniation'];
        //     $methodePotentiel = $value['MethodePotentiel'];
        //     // $FractHydraulique=$value['FractHydraulique'];
        //     $EtudeGG = $value['EtudeGG'];
        // }



    //    dd($nbPuitE);


        // dd($AcusSismique2D);
        $realisation2DA = DB::table('realisation_sismiques')
            ->select('Kilometrage')
            ->where('phase', '=', $phase)
            ->where('TypeSismique','=', '2D')
            ->where('Operation', '=','Acquisition')
            ->where('contrat_id', '=', $contratId)
            ->sum('Kilometrage');

            
        $realisation2DT = DB::table('realisation_sismiques')
            ->select('Kilometrage')
            ->where('phase', '=', $phase)
            ->where('TypeSismique', '=', '2D')
            ->where('Operation', '=', 'Traitement')
            ->where('contrat_id', '=', $contratId)
            ->sum('Kilometrage');

        $realisation2DRT = DB::table('realisation_sismiques')
            ->select('Kilometrage')
            ->where('phase', '=', $phase)
            ->where('TypeSismique', '=', '2D')
            ->where('Operation', '=', 'Retraitement')
            ->where('contrat_id', '=', $contratId)
            ->sum('Kilometrage');
            // dd($realisation2DA,$realisation2DT,$realisation2DRT);
      
            $realisation3DA = DB::table('realisation_sismiques')
            ->select('Kilometrage')
            ->where('phase', '=', $phase)
            ->where('TypeSismique','=', '3D')
            ->where('Operation', '=','Acquisition')
            ->where('contrat_id', '=', $contratId)
            ->sum('Kilometrage');

            
        $realisation3DT = DB::table('realisation_sismiques')
            ->select('Kilometrage')
            ->where('phase', '=', $phase)
            ->where('TypeSismique', '=', '3D')
            ->where('Operation', '=', 'Traitement')
            ->where('contrat_id', '=', $contratId)
            ->sum('Kilometrage');

        $realisation3DRT = DB::table('realisation_sismiques')
            ->select('Kilometrage')
            ->where('phase', '=', $phase)
            ->where('TypeSismique', '=', '3D')
            ->where('Operation', '=', 'Retraitement')
            ->where('contrat_id', '=', $contratId)
            ->sum('Kilometrage');

        $realisationPot = DB::table('realisation_sismiques')
            ->select('Kilometrage')
            ->where('phase', '=', $phase)
            ->where('TypeSismique', '=', 'Methode potentiel')
            ->where('Operation', '=','Acquisition')
            ->where('contrat_id', '=', $contratId)
            ->sum('Kilometrage');


        $realisationGg = DB::table('realisation_ggs')
            ->select('*')
            ->where('phase', '=', $phase)
            ->where('contrat_id', '=', $contratId)
            ->count('id');

        //  dd($realisation2D);


        $puitE = DB::table('puits')
            ->join('reservoirs', 'Reservoir_id', '=', 'reservoirs.id')
            ->join('gisements', 'gisements.id', '=', 'reservoirs.Gisement_id')
            ->join('perimetres', 'perimetres.id', '=', 'gisements.perimetre_id')
            ->join('contrats', 'contrats.perimetre_id', '=', 'perimetres.id')
            // ->select('SiglePuit','contrats.id')
            ->where('contrats.id', '=', $contratId)
            ->where('puits.phase', '=', $phase)
            ->where('puits.TypePuit', '=', 'Exploration')
            ->count('puits.id');
            // dd($puitE);

        $puitD = DB::table('puits')
            ->join('reservoirs', 'Reservoir_id', '=', 'reservoirs.id')
            ->join('gisements', 'gisements.id', '=', 'reservoirs.Gisement_id')
            ->join('perimetres', 'perimetres.id', '=', 'gisements.perimetre_id')
            ->join('contrats', 'contrats.perimetre_id', '=', 'perimetres.id')
            // ->select('SiglePuit','contrats.id')
            ->where('contrats.id', '=', $contratId)
            ->where('puits.phase', '=', $phase)
            ->where('puits.TypePuit', '=', 'Delination')
            ->count('puits.id');
        $phaseD = $phase;
        // dd($puitD);

        if($programme==null){
            // dd("ffdf");
            $programme="";
            $effectif2DA="";
            $effectif2DT="";
            $effectif2DRT="";
            $effectif3DA="";
            $effectif3DT="";
            $effectif3DRT="";
            $effectifpot = "";
            $effectifGg = "";
            $effectifPuitE = "";
            $effectifPuitD = "";
            }
        else{
            $effectif2DA = $AcusSismique2D - $realisation2DA;
            if($effectif2DA<0){$effectif2DA="honoré";}
   
            $effectif2DT = $TraitSismique2D - $realisation2DT;
            if($effectif2DT<0){$effectif2DT="honoré";}
   
            $effectif2DRT = $RtraitSismique2D - $realisation2DRT;
            if($effectif2DRT<0){$effectif2DRT="honoré";}
   
            $effectif3DA = $AcusSismique3D - $realisation3DA;
            if($effectif3DA<0){$effectif3DA="honoré";}
   
            $effectif3DT = $TraitSismique3D - $realisation3DT;
            if($effectif3DT<0){$effectif3DT="honoré";}
   
            $effectif3DRT = $RtraitSismique3D - $realisation3DRT;
            if($effectif3DRT<0){$effectif3DRT="honoré";}

        $effectifpot = $methodePotentiel - $realisationPot;
        $effectifGg = $EtudeGG - $realisationGg;
        $effectifPuitE = $nbPuitE - $puitE;
        $effectifPuitD = $nbPuitD - $puitD;
        }
       
        // dd($effectif2D);

        return view('resultatD', [
            'phase' => $phaseD,
            'realisation2DA' => $realisation2DA,
            'realisation2DT' => $realisation2DT,
            'realisation2DRT' => $realisation2DRT,
            'realisation3DA' => $realisation3DA,
            'realisation3DT' => $realisation3DT,
            'realisation3DRT' => $realisation3DRT,
            'realisationPot' => $realisationPot,
            'realisationGg' => $realisationGg,
            'puitE' => $puitE,
            'puitD' => $puitD,
            'effectif2DA' => $effectif2DA,
            'effectif2DT' => $effectif2DT,
            'effectif2DRT' => $effectif2DRT,
            'effectif3DA' => $effectif3DA,
            'effectif3DT' => $effectif3DT,
            'effectif3DRT' => $effectif3DRT,
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
        $reservoir=DB::table('reservoirs')
        ->join('gisements','reservoirs.Gisement_id','gisements.id')
        ->select('*')
        ->where('perimetre_id','=',$perId)
        ->get();

        // dd($reservoir);
        // dd($gisement);
        return view('renseignement',[
        'perimetre'=>$perimetre,
        'gisement'=>$gisement,
        'reservoir'=>$reservoir
        ]);
    }

    protected function FicheRealisation($id){


        $perimetre = DB::table('perimetres')
        ->select('NomPerimetre')
        ->where('id','=',$id)
        ->get();

        $contrat = DB::table('contrats')
        ->select('*')
        ->where('perimetre_id', '=', $id)->get();
        if($contrat->isEmpty()){
            $contratId=null;
    
           }else
        {
         $contratId= $contrat->pluck('id');
        }

        $Traitement2D=DB::table('realisation_sismiques')
        ->select('NomCub','AnneeRealisation','CompagnieServise','Kilometrage','Operation')
        ->where('contrat_id','=',$contratId)
        ->where('TypeSismique','=','2D')
        ->where('Operation','=','Traitement')
        ->get();

        // $Traitement=DB::table('realisation_sismiques')
        // ->select('Operation')
        // ->where('contrat_id','=',$id)
        // ->where('TypeSismique','=','2D')
        // ->where('Operation','=','Traitement')
        // ->first();

        $ReTraitement2D=DB::table('realisation_sismiques')
        ->select('NomCub','AnneeRealisation','CompagnieServise','Kilometrage')
        ->where('contrat_id','=',$contratId)
        ->where('TypeSismique','=','2D')
        ->where('Operation','=','Retraitement')
        ->get();


        $Acquisition2D=DB::table('realisation_sismiques')
        ->select('NomCub','AnneeRealisation','CompagnieServise','Kilometrage')
        ->where('contrat_id','=',$contratId)
        ->where('TypeSismique','=','2D')
        ->where('Operation','=','Acquisition')
        ->get();
        

        $Traitement3D=DB::table('realisation_sismiques')
        ->select('NomCub','AnneeRealisation','CompagnieServise','Kilometrage')
        ->where('contrat_id','=',$contratId)
        ->where('TypeSismique','=','3D')
        ->where('Operation','=','Traitement')
        ->get();

        $ReTraitement3D=DB::table('realisation_sismiques')
        ->select('NomCub','AnneeRealisation','CompagnieServise','Kilometrage')
        ->where('contrat_id','=',$contratId)
        ->where('TypeSismique','=','3D')
        ->where('Operation','=','Retraitement')
        ->get();


        $Acquisition3D=DB::table('realisation_sismiques')
        ->select('NomCub','AnneeRealisation','CompagnieServise','Kilometrage')
        ->where('contrat_id','=',$contratId)
        ->where('TypeSismique','=','3D')
        ->where('Operation','=','Acquisition')
        ->get();

        $Etudemth=DB::table('realisation_sismiques')
        ->select('NomCub','AnneeRealisation','CompagnieServise','Kilometrage')
        ->where('contrat_id','=',$contratId)
        ->where('TypeSismique','=','Methode potentiel')
        ->where('Operation','=','Etude')
        ->get();

        $Acquisitionmth=DB::table('realisation_sismiques')
        ->select('NomCub','AnneeRealisation','CompagnieServise','Kilometrage')
        ->where('contrat_id','=',$contratId)
        ->where('TypeSismique','=','Methode potentiel')
        ->where('Operation','=','Acquisition')
        ->get();
        
        $total2D=DB::table('realisation_sismiques')
        ->select('NomCub','AnneeRealisation','CompagnieServise','Kilometrage')
        ->where('contrat_id','=',$contratId)
        ->where('TypeSismique','=','2D')
        ->sum('Kilometrage');

        $total3D=DB::table('realisation_sismiques')
        ->select('NomCub','AnneeRealisation','CompagnieServise','Kilometrage')
        ->where('contrat_id','=',$contratId)
        ->where('TypeSismique','=','3D')
        ->sum('Kilometrage');

        $totalmth=DB::table('realisation_sismiques')
        ->select('NomCub','AnneeRealisation','CompagnieServise','Kilometrage')
        ->where('contrat_id','=',$contratId)
        ->where('TypeSismique','=','Methode potentiel')
        ->sum('Kilometrage');

        $EtudeGG=DB::table('realisation_ggs')
        ->select('Designation','EffortPropre','CompangnieServise','AnneeRealisation')
        ->where('contrat_id','=',$contratId)
        // ->where('TypeSismique','=','Methode potentiel');
        // ->sum('Kilometrage');
        ->get();

        $EtudeGGsum=DB::table('realisation_ggs')
        ->select('Designation','EffortPropre','CompangnieServise','AnneeRealisation')
        ->where('contrat_id','=',$contratId)
        // ->where('TypeSismique','=','Methode potentiel');
        ->count('id');


        $FractHydraulique = DB::table('fracturations')
            ->join('puits','puit_id','=','puits.id')
            ->join('reservoirs', 'Reservoir_id', '=', 'reservoirs.id')
            ->join('gisements', 'gisements.id', '=', 'reservoirs.Gisement_id')
            ->join('perimetres', 'perimetres.id', '=', 'gisements.perimetre_id')
            ->join('contrats', 'contrats.perimetre_id', '=', 'perimetres.id')
            ->where('contrats.id', '=', $contratId)
            ->select('SiglePuit','anneRelaisation','NomReservoir','DebitInitial','DebitFinal','EffortPropre')
            ->get();
        // dd($FractHydraulique);


        $puit = DB::table('puits')
        ->join('reservoirs', 'Reservoir_id', '=', 'reservoirs.id')
        ->join('gisements', 'gisements.id', '=', 'reservoirs.Gisement_id')
        ->join('perimetres', 'perimetres.id', '=', 'gisements.perimetre_id')
        ->join('contrats', 'contrats.perimetre_id', '=', 'perimetres.id')
        ->where('contrats.id', '=', $contratId)
        ->select('SiglePuit','AnneeSondage','TypePuit','Resultat','ObjectifPetrolier','EtatPuit')
        // ->select('*')
        ->get();
        // dd($puit);


        return view('FicheRealisation',[
            'realisation2D'=>$Traitement2D,
            'ReTraitement2D'=>$ReTraitement2D,
            'Acquisition2D'=>$Acquisition2D,
            'realisation3D'=>$Traitement3D,
            'ReTraitement3D'=>$ReTraitement3D,
            'Acquisition3D'=>$Acquisition3D,
            'realisationmth'=>$Etudemth,
            'Acquisitionmth'=>$Acquisitionmth,
            'total2D'=>$total2D,
            'total3D'=>$total3D,
            'totalmth'=>$totalmth,
            'EtudeGG'=>$EtudeGG,
            'EtudeGGsum'=>$EtudeGGsum,
            'Fracturation'=>$FractHydraulique,
            'puit'=>$puit,
            // 'Traitement'=>$Traitement

        ]);
    }

    protected function FicheFinance($id){

        $perimetre = DB::table('perimetres')
        ->select('NomPerimetre')
        ->where('id','=',$id)
        ->get();

        $contrat = DB::table('contrats')
        ->select('*')
        ->where('perimetre_id', '=', $id)->get();
        if($contrat->isEmpty()){
            $contratId=null;
    
           }else
        {
         $contratId= $contrat->pluck('id');
       
        }

        $Traitement2D=DB::table('finance_sismiques')
        ->join('realisation_sismiques','realisation_sismique_id','realisation_sismiques.id')
        ->select('NomCub','AnneeRealisation','CompagnieServise','Kilometrage','couteE','couteD')
        ->where('contrat_id','=',$contratId)
        ->where('TypeSismique','=','2D')
        ->where('Operation','=','Traitement')
        ->where('finance_sismiques.valide','=','oui')
        ->get();
        // dd($Traitement2D);

        $ReTraitement2D=DB::table('finance_sismiques')
        ->join('realisation_sismiques','realisation_sismique_id','realisation_sismiques.id')
        ->select('NomCub','AnneeRealisation','CompagnieServise','Kilometrage','couteE','couteD')
        ->where('contrat_id','=',$contratId)
        ->where('TypeSismique','=','2D')
        ->where('Operation','=','Retraitement')
        ->where('finance_sismiques.valide','=','oui')
        ->get();

        $Acquisition2D=DB::table('finance_sismiques')
        ->join('realisation_sismiques','realisation_sismique_id','realisation_sismiques.id')
        ->select('NomCub','AnneeRealisation','CompagnieServise','Kilometrage','couteE','couteD')
        ->where('contrat_id','=',$contratId)
        ->where('TypeSismique','=','2D')
        ->where('Operation','=','Acquisition')
        ->where('finance_sismiques.valide','=','oui')
        ->get();

        // finance 3D

        $Traitement3D=DB::table('finance_sismiques')
        ->join('realisation_sismiques','realisation_sismique_id','realisation_sismiques.id')
        ->select('NomCub','AnneeRealisation','CompagnieServise','Kilometrage','couteE','couteD')
        ->where('contrat_id','=',$contratId)
        ->where('TypeSismique','=','3D')
        ->where('Operation','=','Traitement')
        ->where('finance_sismiques.valide','=','oui')
        ->get();

        $ReTraitement3D=DB::table('finance_sismiques')
        ->join('realisation_sismiques','realisation_sismique_id','realisation_sismiques.id')
        ->select('NomCub','AnneeRealisation','CompagnieServise','Kilometrage','couteE','couteD')
        ->where('contrat_id','=',$contratId)
        ->where('TypeSismique','=','3D')
        ->where('Operation','=','Retraitement')
        ->where('finance_sismiques.valide','=','oui')
        ->get();

        $Acquisition3D=DB::table('finance_sismiques')
        ->join('realisation_sismiques','realisation_sismique_id','realisation_sismiques.id')
        ->select('NomCub','AnneeRealisation','CompagnieServise','Kilometrage','couteE','couteD')
        ->where('contrat_id','=',$contratId)
        ->where('TypeSismique','=','3D')
        ->where('Operation','=','Acquisition')
        ->where('finance_sismiques.valide','=','oui')
        ->get();

        // finance methode potentiel

        $Etudemth=DB::table('finance_sismiques')
        ->join('realisation_sismiques','realisation_sismique_id','realisation_sismiques.id')
        ->select('NomCub','AnneeRealisation','CompagnieServise','Kilometrage','couteE','couteD')
        ->where('contrat_id','=',$contratId)
        ->where('TypeSismique','=','Methode potentiel')
        ->where('Operation','=','Etude')
        ->where('finance_sismiques.valide','=','oui')
        ->get();

        // $ReTraitementmth=DB::table('finance_sismiques')
        // ->join('realisation_sismiques','realisation_sismique_id','realisation_sismiques.id')
        // ->select('NomCub','AnneeRealisation','CompagnieServise','Kilometrage','couteE','couteD')
        // ->where('contrat_id','=',$contratId)
        // ->where('TypeSismique','=','Methode potentiel')
        // ->where('Operation','=','Retraitement')
        // ->where('finance_sismiques.valide','=','oui')
        // ->get();

        $Acquisitionmth=DB::table('finance_sismiques')
        ->join('realisation_sismiques','realisation_sismique_id','realisation_sismiques.id')
        ->select('NomCub','AnneeRealisation','CompagnieServise','Kilometrage','couteE','couteD')
        ->where('contrat_id','=',$contratId)
        ->where('TypeSismique','=','Methode potentiel')
        ->where('Operation','=','Acquisition')
        ->where('finance_sismiques.valide','=','oui')
        ->get();

        // finance gg

        $EtudeGG=DB::table('finance_ggs')
        ->join('realisation_ggs','Realisation_Gg_id','realisation_ggs.id')
        ->select('Designation','EffortPropre','CompangnieServise','AnneeRealisation','couteE','couteD')
        ->where('contrat_id','=',$contratId)
        ->where('finance_ggs.valide','=','oui')
        ->get();
        // dd($EtudeGG);

        $FractHydraulique = DB::table('finance_fracturations')
        ->join('fracturations','fracturation_id','fracturations.id')
        ->join('puits','puit_id','=','puits.id')
        ->join('reservoirs', 'Reservoir_id', '=', 'reservoirs.id')
        ->join('gisements', 'gisements.id', '=', 'reservoirs.Gisement_id')
        ->join('perimetres', 'perimetres.id', '=', 'gisements.perimetre_id')
        ->join('contrats', 'contrats.perimetre_id', '=', 'perimetres.id')
        ->where('contrats.id', '=', $contratId)
        ->where('finance_fracturations.valide','=','oui')
        ->select('SiglePuit','anneRelaisation','NomReservoir','DebitInitial','DebitFinal','EffortPropre','couteE','couteD')
        ->get();

        $FractHydrauliqueE = DB::table('finance_fracturations')
        ->join('fracturations','fracturation_id','fracturations.id')
        ->join('puits','puit_id','=','puits.id')
        ->join('reservoirs', 'Reservoir_id', '=', 'reservoirs.id')
        ->join('gisements', 'gisements.id', '=', 'reservoirs.Gisement_id')
        ->join('perimetres', 'perimetres.id', '=', 'gisements.perimetre_id')
        ->join('contrats', 'contrats.perimetre_id', '=', 'perimetres.id')
        ->where('contrats.id', '=', $contratId)
        ->where('finance_fracturations.valide','=','oui')
        ->select('couteE')
        ->sum('couteE');

        $FractHydrauliqueD = DB::table('finance_fracturations')
        ->join('fracturations','fracturation_id','fracturations.id')
        ->join('puits','puit_id','=','puits.id')
        ->join('reservoirs', 'Reservoir_id', '=', 'reservoirs.id')
        ->join('gisements', 'gisements.id', '=', 'reservoirs.Gisement_id')
        ->join('perimetres', 'perimetres.id', '=', 'gisements.perimetre_id')
        ->join('contrats', 'contrats.perimetre_id', '=', 'perimetres.id')
        ->where('contrats.id', '=', $contratId)
        ->where('finance_fracturations.valide','=','oui')
        ->select('couteD')
        ->sum('couteD');
        // dd($FractHydraulique);

        // FINANCE puit

        $puit = DB::table('finance_puits')
        ->join('puits','puit_id','puits.id')
        ->join('reservoirs', 'Reservoir_id', '=', 'reservoirs.id')
        ->join('gisements', 'gisements.id', '=', 'reservoirs.Gisement_id')
        ->join('perimetres', 'perimetres.id', '=', 'gisements.perimetre_id')
        ->join('contrats', 'contrats.perimetre_id', '=', 'perimetres.id')
        ->where('contrats.id', '=', $contratId)
        ->where('finance_puits.valide','=','oui')
        ->select('SiglePuit','AnneeSondage','TypePuit','Resultat','ObjectifPetrolier','EtatPuit','couteE','couteD')
        // ->select('*')
        ->get();

        $puitE = DB::table('finance_puits')
        ->join('puits','puit_id','puits.id')
        ->join('reservoirs', 'Reservoir_id', '=', 'reservoirs.id')
        ->join('gisements', 'gisements.id', '=', 'reservoirs.Gisement_id')
        ->join('perimetres', 'perimetres.id', '=', 'gisements.perimetre_id')
        ->join('contrats', 'contrats.perimetre_id', '=', 'perimetres.id')
        ->where('contrats.id', '=', $contratId)
        ->where('finance_puits.valide','=','oui')
        ->select('couteE')
        // ->select('*')
        ->sum('couteE');

        $puitD = DB::table('finance_puits')
        ->join('puits','puit_id','puits.id')
        ->join('reservoirs', 'Reservoir_id', '=', 'reservoirs.id')
        ->join('gisements', 'gisements.id', '=', 'reservoirs.Gisement_id')
        ->join('perimetres', 'perimetres.id', '=', 'gisements.perimetre_id')
        ->join('contrats', 'contrats.perimetre_id', '=', 'perimetres.id')
        ->where('contrats.id', '=', $contratId)
        ->where('finance_puits.valide','=','oui')
        ->select('couteD')
        ->sum('couteD');

        $total2D=DB::table('finance_sismiques')
        ->join('realisation_sismiques','realisation_sismique_id','realisation_sismiques.id')
        ->select('Kilometrage')
        ->where('contrat_id','=',$contratId)
        ->where('TypeSismique','=','2D')
        ->where('finance_sismiques.valide','=','oui')
        ->sum('kilometrage');

        $total2DD=DB::table('finance_sismiques')
        ->join('realisation_sismiques','realisation_sismique_id','realisation_sismiques.id')
        ->select('couteD')
        ->where('contrat_id','=',$contratId)
        ->where('TypeSismique','=','2D')
        ->where('finance_sismiques.valide','=','oui')
        ->sum('couteD');

        $total2DE=DB::table('finance_sismiques')
        ->join('realisation_sismiques','realisation_sismique_id','realisation_sismiques.id')
        ->select('couteE')
        ->where('contrat_id','=',$contratId)
        ->where('TypeSismique','=','2D')
        ->where('finance_sismiques.valide','=','oui')
        ->sum('couteE');


        $total3D=DB::table('finance_sismiques')
        ->join('realisation_sismiques','realisation_sismique_id','realisation_sismiques.id')
        ->select('Kilometrage')
        ->where('contrat_id','=',$contratId)
        ->where('TypeSismique','=','3D')
        ->where('finance_sismiques.valide','=','oui')
        ->sum('kilometrage');

        $total3DD=DB::table('finance_sismiques')
        ->join('realisation_sismiques','realisation_sismique_id','realisation_sismiques.id')
        ->select('couteD')
        ->where('contrat_id','=',$contratId)
        ->where('TypeSismique','=','3D')
        ->where('finance_sismiques.valide','=','oui')
        ->sum('couteD');

        $total3DE=DB::table('finance_sismiques')
        ->join('realisation_sismiques','realisation_sismique_id','realisation_sismiques.id')
        ->select('couteE')
        ->where('contrat_id','=',$contratId)
        ->where('TypeSismique','=','3D')
        ->where('finance_sismiques.valide','=','oui')
        ->sum('couteE');

        $totalmth=DB::table('finance_sismiques')
        ->join('realisation_sismiques','realisation_sismique_id','realisation_sismiques.id')
        ->select('Kilometrage')
        ->where('contrat_id','=',$contratId)
        ->where('TypeSismique','=','Methode potentiel')
        ->where('finance_sismiques.valide','=','oui')
        ->sum('kilometrage');

        $totalmthD=DB::table('finance_sismiques')
        ->join('realisation_sismiques','realisation_sismique_id','realisation_sismiques.id')
        ->select('couteD')
        ->where('contrat_id','=',$contratId)
        ->where('TypeSismique','=','Methode potentiel')
        ->where('finance_sismiques.valide','=','oui')
        ->sum('couteD');

        $totalmthE=DB::table('finance_sismiques')
        ->join('realisation_sismiques','realisation_sismique_id','realisation_sismiques.id')
        ->select('couteE')
        ->where('contrat_id','=',$contratId)
        ->where('TypeSismique','=','Methode potentiel')
        ->where('finance_sismiques.valide','=','oui')
        ->sum('couteE');

        $EtudeGGsum=DB::table('finance_ggs')
        ->join('realisation_ggs','Realisation_Gg_id','realisation_ggs.id')
        ->select('EffortPropre')
        ->where('contrat_id','=',$contratId)
        ->sum('EffortPropre');

        $EtudeGGE=DB::table('finance_ggs')
        ->join('realisation_ggs','Realisation_Gg_id','realisation_ggs.id')
        ->select('couteE')
        ->where('contrat_id','=',$contratId)
        ->where('finance_ggs.valide','=','oui')
        ->sum('couteE');

        $EtudeGGD=DB::table('finance_ggs')
        ->join('realisation_ggs','Realisation_Gg_id','realisation_ggs.id')
        ->select('couteD')
        ->where('contrat_id','=',$contratId)
        ->where('finance_ggs.valide','=','oui')
        ->sum('couteD');

        // $perimetre=DB::table('perimetres')
        // ->select('id','NomPerimetre')
        // ->get();
        
        // $reservoir=DB::table('reservoirs')
        // ->select('id','NomReservoir','Gisement_id')
        // ->get();

       
        // $gisement=DB::table('gisements')
        // ->select('id','NomGisement','perimetre_id')
        // ->get();
        // dd($perimetre,$gisement,$reservoir);
        // dd($total2D);

        // $reservoir=DB::table('reservoirs')
        // ->join('gisements', 'gisements.id', '=', 'reservoirs.Gisement_id')
        // ->join('perimetres', 'perimetres.id', '=', 'gisements.perimetre_id')
        // ->select('*')
        // ->get();

        // dd($reservoir);


        return view('FicheFinance',[
            'realisation2D'=>$Traitement2D,
            'ReTraitement2D'=>$ReTraitement2D,
            'Acquisition2D'=>$Acquisition2D,
            'realisation3D'=>$Traitement3D,
            'ReTraitement3D'=>$ReTraitement3D,
            'Acquisition3D'=>$Acquisition3D,
            'realisationmth'=>$Etudemth,
            'Acquisitionmth'=>$Acquisitionmth,
            'total2D'=>$total2D,
            'total2DE'=>$total2DE,
            'total2DD'=>$total2DD,
            'total3D'=>$total3D,
            'total3DE'=>$total3DE,
            'total3DD'=>$total3DD,
            'totalmth'=>$totalmth,
            'totalmthD'=>$totalmthD,
            'totalmthE'=>$totalmthE,
            'EtudeGG'=>$EtudeGG,
            'EtudeGGD'=>$EtudeGGD,
            'EtudeGGE'=>$EtudeGGE,
            'EtudeGGsum'=>$EtudeGGsum,
            'Fracturation'=>$FractHydraulique,
            'FracturationE'=>$FractHydrauliqueE,
            'FracturationD'=>$FractHydrauliqueD,
            'puit'=>$puit,
            'puitE'=>$puitE,
            'puitD'=>$puitD,
           

        ]);

    }
    protected function FicheEtudeAvancement($id){
        $etude=DB::table('etude_avancements')
                ->join('perimetres','perimetres.id','etude_avancements.perimetre_id')
                ->where('perimetres.id','=',$id)
                ->select('*')
                ->get();
        // dd($etude->totalVolumeHuile);
        // if($etude->count()==0){

        // }else{
            $puitPos = DB::table('puits')
            ->join('reservoirs', 'Reservoir_id', '=', 'reservoirs.id')
            ->join('gisements', 'gisements.id', '=', 'reservoirs.Gisement_id')
            ->join('perimetres', 'perimetres.id', '=', 'gisements.perimetre_id')
            ->where('puits.valide','=','oui')
            ->where('perimetres.id','=',$id)
            ->where('puits.Resultat','=','positive')
            ->select('*')
            ->count();            
            // dd($puitPos);
            $puitNeg = DB::table('puits')
            ->join('reservoirs', 'Reservoir_id', '=', 'reservoirs.id')
            ->join('gisements', 'gisements.id', '=', 'reservoirs.Gisement_id')
            ->join('perimetres', 'perimetres.id', '=', 'gisements.perimetre_id')
            ->where('puits.valide','=','oui')
            ->where('perimetres.id','=',$id)
            ->where('puits.Resultat','=','negative')
            ->select('*')
            ->count();            
            
            $puitDec = DB::table('puits')
            ->join('reservoirs', 'Reservoir_id', '=', 'reservoirs.id')
            ->join('gisements', 'gisements.id', '=', 'reservoirs.Gisement_id')
            ->join('perimetres', 'perimetres.id', '=', 'gisements.perimetre_id')
            ->where('puits.valide','=','oui')
            ->where('perimetres.id','=',$id)
            ->where('puits.TypePuit','=','En decouverte')
            ->select('*')
            ->count();
            
            $nbResevoir = DB::table('reservoirs')
            ->join('gisements', 'gisements.id', '=', 'reservoirs.Gisement_id')
            ->join('perimetres', 'perimetres.id', '=', 'gisements.perimetre_id')
            ->where('perimetres.id','=',$id)
            ->select('*')
            ->count();
            // dd($nbResevoir);

            return view('EtudeAvancement',[
                'etude'=>$etude,
                'nbResevoir'=>$nbResevoir,
                'puitDec'=>$puitDec,
                'puitPos'=>$puitPos,
                'puitNeg'=>$puitNeg
            ]);
        // }
    }
       
        
}
