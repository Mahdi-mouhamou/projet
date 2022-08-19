<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HistoriqueEdit;
use App\Models\HistoriqueSup;
use Illuminate\Support\Facades\DB;

class HistoriqueController extends Controller
{
    protected function historique(){

        $hist=DB::table('historique_edits')->select('*')->orderBy('date','desc')->get();
        return view('historique',[
            'hist'=>$hist,
        ]);
    }

    protected function showData($id,$model){
    //    $hist=DB::table('historique_edits')
    //             ->select('data')
    //             ->where('id','=',$id)
    //             ->get();
    $hist=HistoriqueEdit::find($id);
    $hist=collect(json_decode($hist->data,true));
    
    // dd($hist['id']);
    
    return view('showData',[
        'hist'=>$hist,
        'model'=>$model
    ]);
    
    }
    protected function historiqueD(){

        $hist=DB::table('historique_sups')->select('*')->orderBy('date','desc')->get();
        return view('historiqueD',[
            'hist'=>$hist,
        ]);
    }
    protected function showDataD($id,$model){
        //    $hist=DB::table('historique_edits')
        //             ->select('data')
        //             ->where('id','=',$id)
        //             ->get();
        $hist=HistoriqueSup::find($id);
        $hist=collect(json_decode($hist->data,true));
        
        // dd($hist['id']);
        
        return view('showData',[
            'hist'=>$hist,
            'model'=>$model
        ]);
        
        }
    protected function historiqueA(){

            $hist=DB::table('historique_adds')->select('*')->orderBy('date','desc')->get();
            return view('historiqueA',[
                'hist'=>$hist,
            ]);
    }
    protected function historiqueV(){

        $hist=DB::table('historique_validations')->select('*')->orderBy('date','desc')->get();
        return view('historiqueV',[
            'hist'=>$hist,
        ]);
}
}
