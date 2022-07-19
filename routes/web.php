<?php

use TCG\Voyager\Facades\Voyager;
use App\Models\RealisationSismique;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProgrammesController;
use App\Http\Controllers\FicheSyntheseController;

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

    Voyager::routes();
});
