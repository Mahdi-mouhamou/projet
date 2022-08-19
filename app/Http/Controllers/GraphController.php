<?php

namespace App\Http\Controllers;

use App\Models\Perimetre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class GraphController extends Controller
{
    protected function PuitParmois($id)
    {

        // $perimetre=Perimetre::select('NomPerimetre')->get();
        // dd($perimetre[0]->NomPerimetre);

        // $anne = DB::table('perimetres')->select(DB::raw("YEAR(created_at) as year"))->where('valide', '=', 'oui')->distinct()->get();
        // dd($perimetre);
        // $perimetre=['2022','2023','2012'];
        //         $dataP = [];
        //         foreach ($anne as $peri) {
        //             $nbp = DB::table('perimetres')->select('*')->where(DB::raw("DATE_FORMAT(created_at, '%Y')"), $peri->year)->count();

        //             $dataP['anne'][] = $peri->year;
        //             $dataP['nbp'][] = $nbp;
        //         }
        //         $dataP['chart_data'] = json_encode($dataP);
        //         //  dd($data);
        //         $perimetre = DB::table('perimetres')->select('NomPerimetre')->where('valide', '=', 'oui')->get();

        //         $data = [];
        //         foreach ($perimetre as $peri) {
        //             $puit = DB::table('puits')
        //                 ->join('reservoirs', 'Reservoir_id', '=', 'reservoirs.id')
        //                 ->join('gisements', 'gisements.id', '=', 'reservoirs.Gisement_id')
        //                 ->join('perimetres', 'perimetres.id', '=', 'gisements.perimetre_id')
        //                 ->where('NomPerimetre', '=', $peri->NomPerimetre)
        //                 ->count('puits.id');

        //             $data['perimetre'][] = $peri->NomPerimetre;
        //             $data['puit'][] = $puit;
        //         }
        //         $data['chart_data'] = json_encode($data);
        //         // $perimetre=DB::table('perimetres')->select('NomPerimetre')->where('valide','=','oui')->get();

        //         $dataPuit = [];
        //         foreach ($perimetre as $peri) {
        //             $puitp = DB::table('puits')
        //                 ->join('reservoirs', 'Reservoir_id', '=', 'reservoirs.id')
        //                 ->join('gisements', 'gisements.id', '=', 'reservoirs.Gisement_id')
        //                 ->join('perimetres', 'perimetres.id', '=', 'gisements.perimetre_id')
        //                 ->where('NomPerimetre', '=', $peri->NomPerimetre)
        //                 ->where('Resultat', '=', 'positive')
        //                 ->count('puits.id');

        //             $dataPuit['perimetre'][] = $peri->NomPerimetre;
        //             $dataPuit['puitp'][] = $puitp;
        //         }
        //         $dataPuit['chart_data'] = json_encode($dataPuit);
        //         //  dd($data['puit']);



        //         $con = DB::table('contrats')
        //         ->select('*')
        //         ->where('perimetre_id', '=', $id)->get();

        //        $contratId= $con->pluck('id');
        //         $arrayAnnee = [1 => "Janvier", 2 => "Fevrier", 3 => "Mars", 4 => "Avril", 5 => "Mai", 6 => "Juin", 7 => "Juilet", 8 => "Aout", 9 => "Septembre", 10 => "Octobre", 11 => "Novembre", 12 => "Decembre"];
        //         // MONTHNAME("2017-06-15");
        //         // traitement 2D
        //         $month = DB::table('realisation_sismiques')
        //             ->select(DB::raw("MONTH(AnneeRealisation) as month"))
        //             // ->select('AnneeRealisation','Kilometrage')
        //             ->where('contrat_id', '=', $contratId)
        //             ->where('TypeSismique', '=', '2D')
        //             ->where('Operation', '=', 'Traitement')
        //             ->orderBy('month', 'ASC')
        //             ->distinct()
        //             ->get();

        //         $data2D = [];
        //         $datamois = [];
        //         foreach ($month as $month) {
        //             $T2D = DB::table('realisation_sismiques')
        //                 ->where('contrat_id', '=', $contratId)
        //                 ->where('TypeSismique', '=', '2D')
        //                 ->where('Operation', '=', 'Traitement')
        //                 ->where(DB::raw("MONTH(AnneeRealisation)"), $month->month)
        //                 ->select('Kilometrage')
        //                 ->sum('Kilometrage');
        //             // dd($T2D);

        //             $datamois['month'][] = $month->month;
        //             $data2D['somme'][] = $T2D;
        //         }
        //         if ($datamois == null) {
        //             $data2D['month'] = $arrayAnnee;
        //             $data2D['somme'] = 0;
        //         } else {
        //             foreach ($datamois['month'] as $mois) {
        //                 for ($i = 0; $i < 12; $i++) {
        //                     if ($mois === $i)
        //                         $data2D['month'][] = $arrayAnnee[$i];
        //                 }
        //             }
        //         }


        //         $data2D['chart_data'] = json_encode($data2D);

        //     // Acusistion 2D
        //         $monthAc = DB::table('realisation_sismiques')
        //         ->select(DB::raw("MONTH(AnneeRealisation) as month"))
        //         // ->select('AnneeRealisation','Kilometrage')
        //         ->where('contrat_id', '=', $contratId)
        //         ->where('TypeSismique', '=', '2D')
        //         ->where('Operation', '=', 'Acquisition')
        //         ->orderBy('month', 'ASC')
        //         ->distinct()
        //         ->get();
        //     $data2DAc = [];
        //     $datamoisAc = [];
        //     foreach ($monthAc as $month) {
        //         $T2DA = DB::table('realisation_sismiques')
        //             ->where('contrat_id', '=', $contratId)
        //             ->where('TypeSismique', '=', '2D')
        //             ->where('Operation', '=', 'Acquisition')
        //             ->where(DB::raw("MONTH(AnneeRealisation)"), $month->month)
        //             ->select('Kilometrage')
        //             ->sum('Kilometrage');
        //         // dd($T2D);

        //         $datamoisAc['month'][] = $month->month;
        //         $data2DAc['somme'][] = $T2DA;
        //     }
        //     if ($datamoisAc == null) {
        //         $data2DA['month'] = $arrayAnnee;
        //         $data2DA['somme'] = ['0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'];
        //         // dd($data2DA);
        //         // return view('welcome');
        //     } else {
        //         foreach ($datamoisAc['month'] as $mois) {
        //             for ($i = 0; $i <= 12; $i++) {
        //                 if ($mois === $i)
        //                     $data2DAc['month'][] = $arrayAnnee[$i];
        //             }
        //         }
        //     }
        //     $data2DAc['chart_data'] = json_encode($data2DAc);
        // // dd($data2DAc);
        //     // retraitement 2D
        //     $monthART = DB::table('realisation_sismiques')
        //         ->select(DB::raw("MONTH(AnneeRealisation) as month"))
        //         // ->select('AnneeRealisation','Kilometrage')
        //         ->where('contrat_id', '=', $contratId)
        //         ->where('TypeSismique', '=', '2D')
        //         ->where('Operation', '=', 'Retraitement')
        //         ->orderBy('month', 'ASC')
        //         ->distinct()
        //         ->get();
        //     $data2DART = [];
        //     $datamoisART = [];
        //     foreach ($monthART as $month) {
        //         $T2DRT = DB::table('realisation_sismiques')
        //             ->where('contrat_id', '=', $contratId)
        //             ->where('TypeSismique', '=', '2D')
        //             ->where('Operation', '=', 'Retraitement')
        //             ->where(DB::raw("MONTH(AnneeRealisation)"), $month->month)
        //             ->select('Kilometrage')
        //             ->sum('Kilometrage');
        //         // dd($T2D);

        //         $datamoisART['month'][] = $month->month;
        //         $data2DART['somme'][] = $T2DRT;
        //     }
        //     if ($datamoisART == null) {
        //         $data2DART['month'] = $arrayAnnee;
        //         $data2DART['somme'] = ['0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'];
        //         // dd($data2DA);
        //         // return view('welcome');
        //     } else {
        //         foreach ($datamoisART['month'] as $mois) {
        //             for ($i = 0; $i <= 12; $i++) {
        //                 if ($mois === $i)
        //                     $data2DART['month'][] = $arrayAnnee[$i];
        //             }
        //         }
        //     }
        //     $data2DART['chart_data'] = json_encode($data2DART);



        //         // traitement 3D
        //         $monthA = DB::table('realisation_sismiques')
        //             ->select(DB::raw("MONTH(AnneeRealisation) as month"))
        //             // ->select('AnneeRealisation','Kilometrage')
        //             ->where('contrat_id', '=', $contratId)
        //             ->where('TypeSismique', '=', '3D')
        //             ->where('Operation', '=', 'Traitement')
        //             ->orderBy('month', 'ASC')
        //             ->distinct()
        //             ->get();
        //         $data3DT = [];
        //         $datamoisA = [];
        //         foreach ($monthA as $month) {
        //             $T3DA = DB::table('realisation_sismiques')
        //                 ->where('contrat_id', '=', $contratId)
        //                 ->where('TypeSismique', '=', '3D')
        //                 ->where('Operation', '=', 'Traitement')
        //                 ->where(DB::raw("MONTH(AnneeRealisation)"), $month->month)
        //                 ->select('Kilometrage')
        //                 ->sum('Kilometrage');
        //             // dd($T2D);

        //             $datamoisA['month'][] = $month->month;
        //             $data3DT['somme'][] = $T3DA;
        //         }
        //         if ($datamoisA == null) {
        //             $data3DT['month'] = $arrayAnnee;
        //             $data3DT['somme'] = ['0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'];
        //             // dd($data2DA);
        //             // return view('welcome');
        //         } else {
        //             foreach ($datamoisA['month'] as $mois) {
        //                 for ($i = 0; $i <= 12; $i++) {
        //                     if ($mois === $i)
        //                         $data3DT['month'][] = $arrayAnnee[$i];
        //                 }
        //             }
        //         }
        //         $data3DT['chart_data'] = json_encode($data3DT);
        // // dd($data3DT);
        //         // Acusisi 3D
        //     $monthAc3D = DB::table('realisation_sismiques')
        //         ->select(DB::raw("MONTH(AnneeRealisation) as month"))
        //         // ->select('AnneeRealisation','Kilometrage')
        //         ->where('contrat_id', '=', $contratId)
        //         ->where('TypeSismique', '=', '3D')
        //         ->where('Operation', '=', 'Acquisition')
        //         ->orderBy('month', 'ASC')
        //         ->distinct()
        //         ->get();
        //     $data3DAc = [];
        //     $datamoisAc3D = [];
        //     foreach ($monthAc3D as $month) {
        //         $T3DA = DB::table('realisation_sismiques')
        //             ->where('contrat_id', '=', $contratId)
        //             ->where('TypeSismique', '=', '3D')
        //             ->where('Operation', '=', 'Acquisition')
        //             ->where(DB::raw("MONTH(AnneeRealisation)"), $month->month)
        //             ->select('Kilometrage')
        //             ->sum('Kilometrage');
        //         // dd($T3D);

        //         $datamoisAc3D['month'][] = $month->month;
        //         $data3DAc['somme'][] = $T3DA;
        //     }
        //     if ($datamoisAc3D == null) {
        //         $data3DA['month'] = $arrayAnnee;
        //         $data3DA['somme'] = ['0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'];
        //         // dd($data3DA);
        //         // return view('welcome');
        //     } else {
        //         foreach ($datamoisAc3D['month'] as $mois) {
        //             for ($i = 0; $i <= 12; $i++) {
        //                 if ($mois === $i)
        //                     $data3DAc['month'][] = $arrayAnnee[$i];
        //             }
        //         }
        //     }
        //     $data3DAc['chart_data'] = json_encode($data3DAc);

        //     // Retraitement
        //     $monthRT3D = DB::table('realisation_sismiques')
        //     ->select(DB::raw("MONTH(AnneeRealisation) as month"))
        //     // ->select('AnneeRealisation','Kilometrage')
        //     ->where('contrat_id', '=', $contratId)
        //     ->where('TypeSismique', '=', '3D')
        //     ->where('Operation', '=', 'Retraitement')
        //     ->orderBy('month', 'ASC')
        //     ->distinct()
        //     ->get();
        // $data3DRT = [];
        // $datamoisRT3D = [];
        // foreach ($monthRT3D as $month) {
        //     $RT3DA = DB::table('realisation_sismiques')
        //         ->where('contrat_id', '=', $contratId)
        //         ->where('TypeSismique', '=', '3D')
        //         ->where('Operation', '=', 'Retraitement')
        //         ->where(DB::raw("MONTH(AnneeRealisation)"), $month->month)
        //         ->select('Kilometrage')
        //         ->sum('Kilometrage');
        //     // dd($T3D);

        //     $datamoisRT3D['month'][] = $month->month;
        //     $data3DRT['somme'][] = $RT3DA;
        // }
        // if ($datamoisRT3D == null) {
        //     $data3DRT['month'] = $arrayAnnee;
        //     $data3DRT['somme'] = ['0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'];
        //     // dd($data3DA);
        //     // return view('welcome');
        // } else {
        //     foreach ($datamoisRT3D['month'] as $mois) {
        //         for ($i = 0; $i <= 12; $i++) {
        //             if ($mois === $i)
        //                 $data3DRT['month'][] = $arrayAnnee[$i];
        //         }
        //     }
        // }
        // $data3DRT['chart_data'] = json_encode($data3DRT);

        //         // dd($data3DRT);
        //         return view('graph.PuitMois', [
        //             "data" => $data,
        //             "dataP" => $dataP,
        //             "dataPuit" => $dataPuit,
        //             "data2D" => $data2D,
        //             "data2DAc"=>$data2DAc,
        //             "data2DART"=>$data2DART,
        //             "data3DT" => $data3DT,
        //             "data3DAc"=>$data3DAc,
        //            "data3DRT"=>$data3DRT,
        //            "arrayAnnee"=>$arrayAnnee
        //         ]);
    }
    protected function carte()
    {

        //     $perimetre = DB::table('perimetres')->select('NomPerimetre')->where('valide', '=', 'oui')->get();

        //     $data = [];
        //     foreach ($perimetre as $peri) {
        //         $puit = DB::table('puits')
        //             ->join('reservoirs', 'Reservoir_id', '=', 'reservoirs.id')
        //             ->join('gisements', 'gisements.id', '=', 'reservoirs.Gisement_id')
        //             ->join('perimetres', 'perimetres.id', '=', 'gisements.perimetre_id')
        //             ->where('NomPerimetre', '=', $peri->NomPerimetre)
        //             ->count('puits.id');

        //         $data['perimetre'][] = $peri->NomPerimetre;
        //         $data['puit'][] = $puit;
        //     }
        //     $data['chart_data'] = json_encode($data);
        // return view('carte',[
        //     "data" => $data,
        // ]);
    }
    protected function GlobalGraph()
    {
        // coute dolar realisation physique par perimetere
        // les perimetres
        $perimetre = DB::table('perimetres')->select('NomPerimetre')->where('valide', '=', 'oui')->get();
        $coute = 0;
        $data = [];
        foreach ($perimetre as $peri) {

            // coute des puit
            $financepuit = DB::table('finance_puits')
                ->join('puits', 'puit_id', 'puits.id')
                ->join('reservoirs', 'Reservoir_id', '=', 'reservoirs.id')
                ->join('gisements', 'gisements.id', '=', 'reservoirs.Gisement_id')
                ->join('perimetres', 'perimetres.id', '=', 'gisements.perimetre_id')
                ->where('perimetres.NomPerimetre', '=', $peri->NomPerimetre)
                ->where('finance_puits.valide', '=', 'oui')
                ->select('couteE')
                ->sum('couteE');
            $coute = $coute + $financepuit;

            // coute de sismique 2D
            $finance2D = DB::table('finance_sismiques')
                ->join('realisation_sismiques', 'realisation_sismique_id', 'realisation_sismiques.id')
                ->join('contrats', 'contrats.id', '=', 'realisation_sismiques.contrat_id')
                ->join('perimetres', 'contrats.perimetre_id', '=', 'perimetres.id')
                ->select('couteE')
                ->where('perimetres.NomPerimetre', '=', $peri->NomPerimetre)
                ->where('TypeSismique', '=', '2D')
                ->where('finance_sismiques.valide', '=', 'oui')
                ->sum('couteE');
            $coute = $coute + $finance2D;

            // coute des sismiques 3D
            $finance3D = DB::table('finance_sismiques')
                ->join('realisation_sismiques', 'realisation_sismique_id', 'realisation_sismiques.id')
                ->join('contrats', 'contrats.id', '=', 'realisation_sismiques.contrat_id')
                ->join('perimetres', 'contrats.perimetre_id', '=', 'perimetres.id')
                ->select('couteE')
                ->where('perimetres.NomPerimetre', '=', $peri->NomPerimetre)
                ->where('TypeSismique', '=', '3D')
                ->where('finance_sismiques.valide', '=', 'oui')
                ->sum('couteE');

            $coute = $coute + $finance3D;
            // coute des sismiques methode potentiel

            $financeMth = DB::table('finance_sismiques')
                ->join('realisation_sismiques', 'realisation_sismique_id', 'realisation_sismiques.id')
                ->join('contrats', 'contrats.id', '=', 'realisation_sismiques.contrat_id')
                ->join('perimetres', 'contrats.perimetre_id', '=', 'perimetres.id')
                ->select('couteE')
                ->where('perimetres.NomPerimetre', '=', $peri->NomPerimetre)
                ->where('TypeSismique', '=', 'Methode potentiel')
                ->where('finance_sismiques.valide', '=', 'oui')
                ->sum('couteE');

            $coute = $coute + $financeMth;

            // coute etude gg

            $financeGG = DB::table('finance_ggs')
                ->join('realisation_ggs', 'Realisation_Gg_id', 'realisation_ggs.id')
                ->join('contrats', 'contrats.id', '=', 'realisation_ggs.contrat_id')
                ->join('perimetres', 'contrats.perimetre_id', '=', 'perimetres.id')
                ->where('perimetres.Nomperimetre', '=', $peri->NomPerimetre)
                ->select('couteE')
                ->where('finance_ggs.valide', '=', 'oui')
                ->sum('couteE');

            $coute = $coute + $financeGG;

            // coute fracturation

            $financeFract = DB::table('finance_fracturations')
                ->join('fracturations', 'fracturation_id', 'fracturations.id')
                ->join('puits', 'puit_id', '=', 'puits.id')
                ->join('reservoirs', 'Reservoir_id', '=', 'reservoirs.id')
                ->join('gisements', 'gisements.id', '=', 'reservoirs.Gisement_id')
                ->join('perimetres', 'perimetres.id', '=', 'gisements.perimetre_id')
                ->join('contrats', 'contrats.perimetre_id', '=', 'perimetres.id')
                ->where('perimetres.Nomperimetre', '=', $peri->NomPerimetre)
                ->where('finance_fracturations.valide', '=', 'oui')
                ->select('couteE')
                ->sum('couteE');

            $coute = $coute + $financeFract;

            $data['perimetre'][] = $peri->NomPerimetre;
            $data['coute'][] = $coute;
        }
        $data['chart_data'] = json_encode($data);
        // dd($data);
        // réalisation sismique 2D/3D deux bar retraitements (km) par perimetre

        $perimetre = DB::table('perimetres')->select('NomPerimetre')->where('valide', '=', 'oui')->get();
        $dataSismique = [];
        // $dataSismique3D = [];
        foreach ($perimetre as $peri) {
            $sismique2D = DB::table('realisation_sismiques')
                ->join('contrats', 'contrats.id', '=', 'realisation_sismiques.contrat_id')
                ->join('perimetres', 'contrats.perimetre_id', '=', 'perimetres.id')
                ->select('Kilometrage')
                ->where('perimetres.NomPerimetre', '=', $peri->NomPerimetre)
                ->where('TypeSismique', '=', '2D')
                ->where('Operation', '=', 'Retraitement')
                ->sum('Kilometrage');

            $dataSismique['2D'][] = $sismique2D;

            $sismique3D = DB::table('realisation_sismiques')
                ->join('contrats', 'contrats.id', '=', 'realisation_sismiques.contrat_id')
                ->join('perimetres', 'contrats.perimetre_id', '=', 'perimetres.id')
                ->select('Kilometrage')
                ->where('perimetres.NomPerimetre', '=', $peri->NomPerimetre)
                ->where('TypeSismique', '=', '3D')
                ->where('Operation', '=', 'Retraitement')
                ->sum('Kilometrage');
            $dataSismique['3D'][] = $sismique3D;
            $dataSismique['perimetre'][] = $peri->NomPerimetre;
        }
        $dataSismique['chart_data'] = json_encode($dataSismique);


        return view('graph.globaleGraph', [
            'data' => $data,
            'dataSismique' => $dataSismique,
        ]);
    }

    protected function graphDetaille($id)
    {
        $value = "";
        return view('graph.statistique', [
            'id' => $id,
            "value" => $value
        ]);
    }
    protected function PostgraphDetaille(Request $request)
    {
        $value = $request->statistique;
        $valueId = $request->id;
        // dd($value);
        $id = $request->id;
        // $mahdi="mahdi";

        if ($value === "coute") {
            $perimetre = DB::table('perimetres')->select('NomPerimetre')->where('valide', '=', 'oui')->get();

            $data = [];
            foreach ($perimetre as $peri) {
                $coute = 0;
                // coute des puit
                $financepuit = DB::table('finance_puits')
                    ->join('puits', 'puit_id', 'puits.id')
                    ->join('reservoirs', 'Reservoir_id', '=', 'reservoirs.id')
                    ->join('gisements', 'gisements.id', '=', 'reservoirs.Gisement_id')
                    ->join('perimetres', 'perimetres.id', '=', 'gisements.perimetre_id')
                    ->where('perimetres.NomPerimetre', '=', $peri->NomPerimetre)
                    ->where('finance_puits.valide', '=', 'oui')
                    ->select('couteE')
                    ->sum('couteE');
                $coute = $coute + $financepuit;

                // coute de sismique 2D
                $finance2D = DB::table('finance_sismiques')
                    ->join('realisation_sismiques', 'realisation_sismique_id', 'realisation_sismiques.id')
                    ->join('contrats', 'contrats.id', '=', 'realisation_sismiques.contrat_id')
                    ->join('perimetres', 'contrats.perimetre_id', '=', 'perimetres.id')
                    ->select('couteE')
                    ->where('perimetres.NomPerimetre', '=', $peri->NomPerimetre)
                    ->where('TypeSismique', '=', '2D')
                    ->where('finance_sismiques.valide', '=', 'oui')
                    ->sum('couteE');
                $coute = $coute + $finance2D;

                // coute des sismiques 3D
                $finance3D = DB::table('finance_sismiques')
                    ->join('realisation_sismiques', 'realisation_sismique_id', 'realisation_sismiques.id')
                    ->join('contrats', 'contrats.id', '=', 'realisation_sismiques.contrat_id')
                    ->join('perimetres', 'contrats.perimetre_id', '=', 'perimetres.id')
                    ->select('couteE')
                    ->where('perimetres.NomPerimetre', '=', $peri->NomPerimetre)
                    ->where('TypeSismique', '=', '3D')
                    ->where('finance_sismiques.valide', '=', 'oui')
                    ->sum('couteE');

                $coute = $coute + $finance3D;
                // coute des sismiques methode potentiel

                $financeMth = DB::table('finance_sismiques')
                    ->join('realisation_sismiques', 'realisation_sismique_id', 'realisation_sismiques.id')
                    ->join('contrats', 'contrats.id', '=', 'realisation_sismiques.contrat_id')
                    ->join('perimetres', 'contrats.perimetre_id', '=', 'perimetres.id')
                    ->select('couteE')
                    ->where('perimetres.NomPerimetre', '=', $peri->NomPerimetre)
                    ->where('TypeSismique', '=', 'Methode potentiel')
                    ->where('finance_sismiques.valide', '=', 'oui')
                    ->sum('couteE');

                $coute = $coute + $financeMth;

                // coute etude gg

                $financeGG = DB::table('finance_ggs')
                    ->join('realisation_ggs', 'Realisation_Gg_id', 'realisation_ggs.id')
                    ->join('contrats', 'contrats.id', '=', 'realisation_ggs.contrat_id')
                    ->join('perimetres', 'contrats.perimetre_id', '=', 'perimetres.id')
                    ->where('perimetres.Nomperimetre', '=', $peri->NomPerimetre)
                    ->select('couteE')
                    ->where('finance_ggs.valide', '=', 'oui')
                    ->sum('couteE');

                $coute = $coute + $financeGG;

                // coute fracturation

                $financeFract = DB::table('finance_fracturations')
                    ->join('fracturations', 'fracturation_id', 'fracturations.id')
                    ->join('puits', 'puit_id', '=', 'puits.id')
                    ->join('reservoirs', 'Reservoir_id', '=', 'reservoirs.id')
                    ->join('gisements', 'gisements.id', '=', 'reservoirs.Gisement_id')
                    ->join('perimetres', 'perimetres.id', '=', 'gisements.perimetre_id')
                    ->join('contrats', 'contrats.perimetre_id', '=', 'perimetres.id')
                    ->where('perimetres.Nomperimetre', '=', $peri->NomPerimetre)
                    ->where('finance_fracturations.valide', '=', 'oui')
                    ->select('couteE')
                    ->sum('couteE');

                $coute = $coute + $financeFract;

                $data['perimetre'][] = $peri->NomPerimetre;
                $data['coute'][] = $coute;
                // dd($data['coute']);
            }
            $data['chart_data'] = json_encode($data);
            // dd($data);
            return view('graph.statistique', [
                'data' => $data,
                'id' => $id,
                "value" => $value
            ]);
        } elseif ($request->statistique === "sismique") {
            $perimetre = DB::table('perimetres')->select('NomPerimetre')->where('valide', '=', 'oui')->get();
            $dataSismique = [];
            // $dataSismique3D = [];
            foreach ($perimetre as $peri) {
                $sismique2D = DB::table('realisation_sismiques')
                    ->join('contrats', 'contrats.id', '=', 'realisation_sismiques.contrat_id')
                    ->join('perimetres', 'contrats.perimetre_id', '=', 'perimetres.id')
                    ->select('Kilometrage')
                    ->where('perimetres.NomPerimetre', '=', $peri->NomPerimetre)
                    ->where('TypeSismique', '=', '2D')
                    ->where('Operation', '=', 'Retraitement')
                    ->sum('Kilometrage');

                $dataSismique['2D'][] = $sismique2D;

                $sismique3D = DB::table('realisation_sismiques')
                    ->join('contrats', 'contrats.id', '=', 'realisation_sismiques.contrat_id')
                    ->join('perimetres', 'contrats.perimetre_id', '=', 'perimetres.id')
                    ->select('Kilometrage')
                    ->where('perimetres.NomPerimetre', '=', $peri->NomPerimetre)
                    ->where('TypeSismique', '=', '3D')
                    ->where('Operation', '=', 'Retraitement')
                    ->sum('Kilometrage');
                $dataSismique['3D'][] = $sismique3D;
                $dataSismique['perimetre'][] = $peri->NomPerimetre;
            }


            $dataSismique['chart_data'] = json_encode($dataSismique);
            // dd($dataSismique);
            return view('graph.statistique', [
                'dataSismique' => $dataSismique,
                "value" => $value,
                'id' => $id
            ]);
        } elseif ($request->statistique === "couteSismiquephase") {
            // dd($request->id);
            $phase = ["phase1" => "phase1", "phase2" => "phase2", "phase3" => "phase3"];
            // dd($phase);

            $dataSismique = [];

            foreach ($phase as $phase) {
                $finance2D = DB::table('finance_sismiques')
                    ->join('realisation_sismiques', 'realisation_sismique_id', 'realisation_sismiques.id')
                    ->join('contrats', 'contrats.id', '=', 'realisation_sismiques.contrat_id')
                    ->join('perimetres', 'contrats.perimetre_id', '=', 'perimetres.id')
                    ->select('couteE')
                    ->where('perimetres.id', '=', $request->id)
                    ->where('TypeSismique', '=', '2D')
                    ->where('finance_sismiques.valide', '=', 'oui')
                    ->where('phase', '=', $phase)
                    ->sum('couteE');
                $dataSismique['2D'][] = $finance2D;

                $finance3D = DB::table('finance_sismiques')
                    ->join('realisation_sismiques', 'realisation_sismique_id', 'realisation_sismiques.id')
                    ->join('contrats', 'contrats.id', '=', 'realisation_sismiques.contrat_id')
                    ->join('perimetres', 'contrats.perimetre_id', '=', 'perimetres.id')
                    ->select('couteE')
                    ->where('perimetres.id', '=', $request->id)
                    ->where('TypeSismique', '=', '3D')
                    ->where('finance_sismiques.valide', '=', 'oui')
                    ->where('phase', '=', $phase)
                    ->sum('couteE');
                $dataSismique['3D'][] = $finance3D;

                $dataSismique['phase'][] = $phase;
                // dd($finance3D,$request->id,$phase);
            }
            $dataSismique['chart_data'] = json_encode($dataSismique);
            // dd($dataSismique);
            return view('graph.statistique', [
                'dataSismique' => $dataSismique,
                "value" => $value,
                'id' => $valueId,

            ]);
        } elseif ($request->statistique === "couteSismiqueAnnee") {

            // $arrayAnnee = [1 => "Janvier", 2 => "Fevrier", 3 => "Mars", 4 => "Avril", 5 => "Mai", 6 => "Juin", 7 => "Juilet", 8 => "Aout", 9 => "Septembre", 10 => "Octobre", 11 => "Novembre", 12 => "Decembre"];
            $data = [];
            $year = DB::table('finance_sismiques')
                ->join('realisation_sismiques', 'realisation_sismique_id', 'realisation_sismiques.id')
                ->join('contrats', 'contrats.id', '=', 'realisation_sismiques.contrat_id')
                ->join('perimetres', 'contrats.perimetre_id', '=', 'perimetres.id')
                ->select(DB::raw("YEAR(AnneeRealisation) as year"))
                ->where('perimetres.id', '=', $id)
                ->orderBy('year', 'ASC')
                ->distinct()
                ->get();
            // dd($year);

            // dd($year->count());

            // dd("fd");

            if ($year->count() != 0) {
                foreach ($year as $year) {
                    // dd($year->year);
                    $coute2D = DB::table('finance_sismiques')
                        ->join('realisation_sismiques', 'realisation_sismique_id', 'realisation_sismiques.id')
                        ->join('contrats', 'contrats.id', '=', 'realisation_sismiques.contrat_id')
                        ->join('perimetres', 'contrats.perimetre_id', '=', 'perimetres.id')
                        ->where('perimetres.id', '=', $id)
                        ->where('TypeSismique', '=', '2D')
                        ->where('finance_sismiques.valide', '=', 'oui')
                        ->where(DB::raw("YEAR(AnneeRealisation)"), $year->year)
                        ->select('couteE')
                        ->sum('couteE');
                    // dd($coute2D);
                    $coute3D = DB::table('finance_sismiques')
                        ->join('realisation_sismiques', 'realisation_sismique_id', 'realisation_sismiques.id')
                        ->join('contrats', 'contrats.id', '=', 'realisation_sismiques.contrat_id')
                        ->join('perimetres', 'contrats.perimetre_id', '=', 'perimetres.id')
                        ->where('perimetres.id', '=', $id)
                        ->where('TypeSismique', '=', '3D')
                        ->where(DB::raw("YEAR(AnneeRealisation)"), $year->year)
                        ->where('finance_sismiques.valide', '=', 'oui')
                        ->select('couteE')
                        ->sum('couteE');
                    // $data['year'][] = $year->year;
                    $data['year'][] = $year->year;
                    $data['coute2D'][] = $coute2D;
                    $data['coute3D'][] = $coute3D;
                }
                $data['chart_data'] = json_encode($data);
            } else {

                return view('graph.statistique', [
                    "id" => $valueId,
                    "value" => "",
                    'data' => $data,
                ]);
            }

            //  dd(isEmpty($data['chart_data']));


            // dd($data);

            return view('graph.statistique', [
                'data' => $data,
                "value" => $value,
                'id' => $valueId,

            ]);
        } elseif ($request->statistique === "couteMagnetiquePhase") {
            $phase = ["phase1" => "phase1", "phase2" => "phase2", "phase3" => "phase3"];
            // dd($phase);

            $dataMagnetique = [];

            foreach ($phase as $phase) {
                $coute = 0;
                $finance2D = DB::table('finance_sismiques')
                    ->join('realisation_sismiques', 'realisation_sismique_id', 'realisation_sismiques.id')
                    ->join('contrats', 'contrats.id', '=', 'realisation_sismiques.contrat_id')
                    ->join('perimetres', 'contrats.perimetre_id', '=', 'perimetres.id')
                    ->select('couteE')
                    ->where('perimetres.id', '=', $request->id)
                    ->where('TypeSismique', '=', '2D')
                    ->where('finance_sismiques.valide', '=', 'oui')
                    ->where('phase', '=', $phase)
                    ->sum('couteE');
                $coute = $coute + $finance2D;

                $finance3D = DB::table('finance_sismiques')
                    ->join('realisation_sismiques', 'realisation_sismique_id', 'realisation_sismiques.id')
                    ->join('contrats', 'contrats.id', '=', 'realisation_sismiques.contrat_id')
                    ->join('perimetres', 'contrats.perimetre_id', '=', 'perimetres.id')
                    ->select('couteE')
                    ->where('perimetres.id', '=', $request->id)
                    ->where('TypeSismique', '=', '3D')
                    ->where('finance_sismiques.valide', '=', 'oui')
                    ->where('phase', '=', $phase)
                    ->sum('couteE');
                $coute = $coute + $finance3D;

                $financeM = DB::table('finance_sismiques')
                    ->join('realisation_sismiques', 'realisation_sismique_id', 'realisation_sismiques.id')
                    ->join('contrats', 'contrats.id', '=', 'realisation_sismiques.contrat_id')
                    ->join('perimetres', 'contrats.perimetre_id', '=', 'perimetres.id')
                    ->select('couteE')
                    ->where('perimetres.id', '=', $request->id)
                    ->where('TypeSismique', '=', 'Methode potentiel')
                    ->where('finance_sismiques.valide', '=', 'oui')
                    ->where('phase', '=', $phase)
                    ->sum('couteE');
                $coute = $coute + $financeM;


                $financeGG = DB::table('finance_ggs')
                    ->join('realisation_ggs', 'Realisation_Gg_id', 'realisation_ggs.id')
                    ->join('contrats', 'contrats.id', '=', 'realisation_ggs.contrat_id')
                    ->join('perimetres', 'contrats.perimetre_id', '=', 'perimetres.id')
                    ->select('couteE')
                    ->where('perimetres.id', '=', $request->id)
                    ->where('finance_ggs.valide', '=', 'oui')
                    ->where('phase', '=', $phase)
                    ->sum('couteE');

                $coute = $coute + $financeGG;

                $dataMagnetique['coute'][] = $coute;
                $dataMagnetique['phase'][] = $phase;
                // dd($finance3D,$request->id,$phase);
            }
            $dataMagnetique['chart_data'] = json_encode($dataMagnetique);
            // dd($dataMagnetique);
            return view('graph.statistique', [
                'dataMagnetique' => $dataMagnetique,
                "value" => $value,
                'id' => $valueId,

            ]);
        }
        //coute magentique par annee
        elseif ($request->statistique === "couteMagnetiqueAnnee") {

            // $arrayAnnee = [1 => "Janvier", 2 => "Fevrier", 3 => "Mars", 4 => "Avril", 5 => "Mai", 6 => "Juin", 7 => "Juilet", 8 => "Aout", 9 => "Septembre", 10 => "Octobre", 11 => "Novembre", 12 => "Decembre"];
            $data = [];
            $year = DB::table('finance_sismiques')
                ->join('realisation_sismiques', 'realisation_sismique_id', 'realisation_sismiques.id')
                ->join('contrats', 'contrats.id', '=', 'realisation_sismiques.contrat_id')
                ->join('perimetres', 'contrats.perimetre_id', '=', 'perimetres.id')
                ->select(DB::raw("YEAR(AnneeRealisation) as year"))
                ->where('perimetres.id', '=', $id)
                ->orderBy('year', 'ASC')
                ->distinct()
                ->get();
            // dd($year);

            // dd($year->count());

            // dd("fd");

            if ($year->count() != 0) {
                foreach ($year as $year) {
                    $coute = 0;
                    // dd($year->year);
                    $coute2D = DB::table('finance_sismiques')
                        ->join('realisation_sismiques', 'realisation_sismique_id', 'realisation_sismiques.id')
                        ->join('contrats', 'contrats.id', '=', 'realisation_sismiques.contrat_id')
                        ->join('perimetres', 'contrats.perimetre_id', '=', 'perimetres.id')
                        ->where('perimetres.id', '=', $id)
                        ->where('TypeSismique', '=', '2D')
                        ->where(DB::raw("YEAR(AnneeRealisation)"), $year->year)
                        ->where('finance_sismiques.valide', '=', 'oui')
                        ->select('couteE')
                        ->sum('couteE');
                    // dd($coute2D);
                    $coute = $coute + $coute2D;

                    $coute3D = DB::table('finance_sismiques')
                        ->join('realisation_sismiques', 'realisation_sismique_id', 'realisation_sismiques.id')
                        ->join('contrats', 'contrats.id', '=', 'realisation_sismiques.contrat_id')
                        ->join('perimetres', 'contrats.perimetre_id', '=', 'perimetres.id')
                        ->where('perimetres.id', '=', $id)
                        ->where('TypeSismique', '=', '3D')
                        ->where(DB::raw("YEAR(AnneeRealisation)"), $year->year)
                        ->where('finance_sismiques.valide', '=', 'oui')
                        ->select('couteE')
                        ->sum('couteE');

                    $coute = $coute + $coute3D;

                    $financeM = DB::table('finance_sismiques')
                        ->join('realisation_sismiques', 'realisation_sismique_id', 'realisation_sismiques.id')
                        ->join('contrats', 'contrats.id', '=', 'realisation_sismiques.contrat_id')
                        ->join('perimetres', 'contrats.perimetre_id', '=', 'perimetres.id')
                        ->select('couteE')
                        ->where('perimetres.id', '=', $id)
                        ->where('TypeSismique', '=', 'Methode potentiel')
                        ->where('finance_sismiques.valide', '=', 'oui')
                        ->where(DB::raw("YEAR(AnneeRealisation)"), $year->year)
                        ->sum('couteE');
                    $coute = $coute + $financeM;


                    $financeGG = DB::table('finance_ggs')
                        ->join('realisation_ggs', 'Realisation_Gg_id', 'realisation_ggs.id')
                        ->join('contrats', 'contrats.id', '=', 'realisation_ggs.contrat_id')
                        ->join('perimetres', 'contrats.perimetre_id', '=', 'perimetres.id')
                        ->select('couteE')
                        ->where('perimetres.id', '=', $id)
                        ->where('finance_ggs.valide', '=', 'oui')
                        ->where(DB::raw("YEAR(AnneeRealisation)"), $year->year)
                        ->sum('couteE');

                    $coute = $coute + $financeGG;
                    // $data['year'][] = $year->year;
                    $data['year'][] = $year->year;
                    $data['coute'][] = $coute;
                }
                $data['chart_data'] = json_encode($data);
            } else {

                return view('graph.statistique', [
                    "id" => $valueId,
                    "value" => "",
                    'data' => $data,
                ]);
            }

            //  dd(isEmpty($data['chart_data']));


            // dd($data);

            return view('graph.statistique', [
                'data' => $data,
                "value" => $value,
                'id' => $valueId,

            ]);
        } elseif ($request->statistique === 'perimetreAnne') {
            $data = [];
            $perimetre = Perimetre::select('NomPerimetre')->get();
            // dd($perimetre[0]->NomPerimetre);
            $year = DB::table('perimetres')
                ->join('contrats', 'contrats.perimetre_id', '=', 'perimetres.id')
                ->select(DB::raw("YEAR(DateEntrerVigure) as year"))->where('perimetres.valide', '=', 'oui')->distinct()->get();

            if ($year->count() != 0) {
                foreach ($year as $year) {
                    // dd($year->year);
                    $nbPerimetre = DB::table('perimetres')
                        ->join('contrats', 'contrats.perimetre_id', '=', 'perimetres.id')
                        ->select('*')
                        ->where('perimetres.valide', '=', 'oui')
                        ->where(DB::raw("YEAR(DateEntrerVigure)"), $year->year)
                        ->count();
                    $data['year'][] = $year->year;
                    $data['nbPerimetre'][] = $nbPerimetre;
                }
                $data['chart_data'] = json_encode($data);
                return view('graph.statistique', [
                    'data' => $data,
                    "value" => $value,
                    'id' => $valueId,

                ]);
            } else {
                return view('graph.statistique', [
                    "id" => $valueId,
                    "value" => "",
                    'data' => $data,
                ]);
            }
        } elseif ($request->statistique === 'coutePercentage') {

            $data = [];
            $coute2D = DB::table('finance_sismiques')
                ->join('realisation_sismiques', 'realisation_sismique_id', 'realisation_sismiques.id')
                ->join('contrats', 'contrats.id', '=', 'realisation_sismiques.contrat_id')
                ->join('perimetres', 'contrats.perimetre_id', '=', 'perimetres.id')
                ->where('perimetres.id', '=', $id)
                ->where('TypeSismique', '=', '2D')
                ->where('finance_sismiques.valide', '=', 'oui')
                ->select('couteE')
                ->sum('couteE');

            $data['label'][] = "Sismique 2D";
            $data['coute'][] = $coute2D;

            $coute3D = DB::table('finance_sismiques')
                ->join('realisation_sismiques', 'realisation_sismique_id', 'realisation_sismiques.id')
                ->join('contrats', 'contrats.id', '=', 'realisation_sismiques.contrat_id')
                ->join('perimetres', 'contrats.perimetre_id', '=', 'perimetres.id')
                ->where('perimetres.id', '=', $id)
                ->where('TypeSismique', '=', '3D')
                ->where('finance_sismiques.valide', '=', 'oui')
                ->select('couteE')
                ->sum('couteE');

            $data['label'][] = "Sismique 3D";
            $data['coute'][] = $coute3D;

            $financeGG = DB::table('finance_ggs')
                ->join('realisation_ggs', 'Realisation_Gg_id', 'realisation_ggs.id')
                ->join('contrats', 'contrats.id', '=', 'realisation_ggs.contrat_id')
                ->join('perimetres', 'contrats.perimetre_id', '=', 'perimetres.id')
                ->select('couteE')
                ->where('perimetres.id', '=', $id)
                ->where('finance_ggs.valide', '=', 'oui')
                ->sum('couteE');

            $data['label'][] = "Etude geologique et geotechnique";
            $data['coute'][] = $financeGG;

            $financeM = DB::table('finance_sismiques')
                        ->join('realisation_sismiques', 'realisation_sismique_id', 'realisation_sismiques.id')
                        ->join('contrats', 'contrats.id', '=', 'realisation_sismiques.contrat_id')
                        ->join('perimetres', 'contrats.perimetre_id', '=', 'perimetres.id')
                        ->select('couteE')
                        ->where('perimetres.id', '=', $id)
                        ->where('TypeSismique', '=', 'Methode potentiel')
                        ->where('finance_sismiques.valide', '=', 'oui')
                        ->sum('couteE');
                        
            $data['label'][] = "Methode potentiel";
            $data['coute'][] = $financeM;

            $financeFract = DB::table('finance_fracturations')
            ->join('fracturations', 'fracturation_id', 'fracturations.id')
            ->join('puits', 'puit_id', '=', 'puits.id')
            ->join('reservoirs', 'Reservoir_id', '=', 'reservoirs.id')
            ->join('gisements', 'gisements.id', '=', 'reservoirs.Gisement_id')
            ->join('perimetres', 'perimetres.id', '=', 'gisements.perimetre_id')
            ->where('perimetres.id', '=', $id)
            ->where('finance_fracturations.valide', '=', 'oui')
            ->select('couteE')
            ->sum('couteE');
            $data['label'][] = "Fracturation hydraulique";
            $data['coute'][] = $financeFract;            
            
            $financepuit = DB::table('finance_puits')
            ->join('puits', 'puit_id', 'puits.id')
            ->join('reservoirs', 'Reservoir_id', '=', 'reservoirs.id')
            ->join('gisements', 'gisements.id', '=', 'reservoirs.Gisement_id')
            ->join('perimetres', 'perimetres.id', '=', 'gisements.perimetre_id')
            ->where('perimetres.id', '=', $id)
            ->where('finance_puits.valide', '=', 'oui')
            ->select('couteE')
            ->sum('couteE');
            $data['label'][] = "Puit";
            $data['coute'][] = $financepuit;

            $data['chart_data'] = json_encode($data);
            // dd($data);
            return view('graph.statistique', [
                'data' => $data,
                "value" => $value,
                'id' => $valueId,

            ]);

        }
    }
}
