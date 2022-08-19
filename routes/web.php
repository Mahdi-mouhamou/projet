<?php

use App\Models\FinanceSismique;
use TCG\Voyager\Facades\Voyager;
use App\Models\RealisationSismique;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GraphController;
use App\Http\Controllers\ContratController;
use App\Http\Controllers\EtudeAvencementController;
use App\Http\Controllers\FinanceGgController;
use App\Http\Controllers\HistoriqueController;
use App\Http\Controllers\PerimetresController;
use App\Http\Controllers\ProgrammesController;
use App\Http\Controllers\EvaluerCouteController;
use App\Http\Controllers\FinancePuitsController;
use App\Http\Controllers\FicheSyntheseController;
use App\Http\Controllers\FinanceSismiquesController;
use App\Http\Controllers\FinanceFracturationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'admin'], function () {
   
    Route::get('programmes/valide',[ProgrammesController::class,'valide'])->name('Programme.valide');
    Route::get('programmes/termine',[ProgrammesController::class,'termine'])->name('Programme.termine');
   
    Route::get('fiche-synthese',[FicheSyntheseController::class,'index'])->name('fiche.index');
    Route::get('fiche-synthese-{id}',[FicheSyntheseController::class,'detaille'])->name('fiche.detaille');
   
    Route::get('realisation-sismiques/Phase1',[FicheSyntheseController::class,'phase1'])->name('phase1');
    Route::get('realisation-sismiques/Phase1-{id}',[FicheSyntheseController::class,'phase1Detaille'])->name('phase1.detaille');
    Route::get('realisation-sismiques/Phase2',[FicheSyntheseController::class,'phase2'])->name('phase2');
    Route::get('realisation-sismiques/Phase2-{id}',[FicheSyntheseController::class,'phase2Detaille'])->name('phase2.detaille');
    Route::get('realisation-sismiques/Phase3',[FicheSyntheseController::class,'phase3'])->name('phase3');
    Route::get('realisation-sismiques/Phase3-{id}',[FicheSyntheseController::class,'phase3Detaille'])->name('phase3.detaille');
   
    Route::get('Resultat',[FicheSyntheseController::class,'Resultat'])->name('resultat');
    Route::get('Resultat/Phase-{id}-{phase}',[FicheSyntheseController::class,'resultatPhase1'])->name('resultatPhase');
   
    Route::get('fiche-renseignement',[FicheSyntheseController::class,'index'])->name('renseignement');
    Route::get('fiche-renseignement-{id}',[FicheSyntheseController::class,'detailleRenseignement'])->name('detailleRenseignement');

    Route::get('perimetres/valide',[PerimetresController::class,'valide'])->name('Perimetre.valide');

    // Route::get('realisation-sismiques/Evaluer-coute',[EvaluerCouteController::class,'couteSismique'])->name('couteSismique');
    // Route::get('realisation-ggs/Evaluer-coute',[EvaluerCouteController::class,'couteGg'])->name('couteGg');
    // Route::get('puits/Evaluer-coute',[EvaluerCouteController::class,'coutePuit'])->name('coutePuit');
    // Route::get('fracturations/Evaluer-coute',[EvaluerCouteController::class,'couteFracturation'])->name('couteFracturation');
   
    Route::get('FicheRealisation',[FicheSyntheseController::class,'index'])->name('FicheRealisation');
    Route::get('FicheRealisation-{id}',[FicheSyntheseController::class,'FicheRealisation'])->name('detailleFicheRealisation');

    Route::get('FicheEtudeAvancement',[FicheSyntheseController::class,'index'])->name('FicheEtudeAvancement');
    Route::get('FicheEtudeAvancement-{id}',[FicheSyntheseController::class,'FicheEtudeAvancement'])->name('detailleFicheEtudeAvancement');
    
    Route::get('fichefinance',[FicheSyntheseController::class,'index'])->name('FicheFinance');
    Route::get('fichefinance-{id}',[FicheSyntheseController::class,'FicheFinance'])->name('detailleFicheFinance');

    Route::get('contrats/valide',[ContratController::class,'valide'])->name('contart.valide');
    Route::get('etude-avancements/valide',[EtudeAvencementController::class,'valide'])->name('etude.valide');


    // validation du finance

    Route::get('finance-sismiques/valide',[FinanceSismiquesController::class,'valide'])->name('fin.valide');
    Route::get('finance-ggs/valide',[FinanceGgController::class,'valide'])->name('finG.valide');
    Route::get('finance-puits/valide',[FinancePuitsController::class,'valide'])->name('finP.valide');
    Route::get('finance-fracturations/valide',[FinanceFracturationController::class,'valide'])->name('finF.valide');
    
    Route::get('historique-edit',[HistoriqueController::class,'historique'])->name('historique');
    Route::get('historique-edit-{id}-{model}',[HistoriqueController::class,'showData'])->name('showData');
   
    Route::get('historique-Delete',[HistoriqueController::class,'historiqueD'])->name('historiqueD');
    Route::get('historique-Delete-{id}-{model}',[HistoriqueController::class,'showDataD'])->name('showDataD');
    Route::get('historique-Add',[HistoriqueController::class,'historiqueA'])->name('historiqueA');
    Route::get('historique-validation',[HistoriqueController::class,'historiqueV'])->name('historiqueV');
   
    // Route::get('contrats',[ContratController::class,'create'])->name('AddContrat');


  
    Route::get('statistique',[FicheSyntheseController::class,'index'])->name('statistique');
    Route::get('graph-{id}',[GraphController::class,'graphDetaille'])->name('graphDetaille');
    Route::post('graph',[GraphController::class,'PostgraphDetaille'])->name('post.graphDetaille');
    Route::get('statistique/globale',[GraphController::class,'GlobalGraph'])->name('GlobalGraph');


    Voyager::routes();
});
