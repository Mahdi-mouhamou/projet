<?php

namespace App\Providers;

use App\Actions\ValideProgrammeAction;
use Illuminate\Support\ServiceProvider;
use TCG\Voyager\Facades\Voyager;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Voyager::addAction(\App\Actions\ValideProgrammeAction::class);
        Voyager::addAction(\App\Actions\ValidePerimetreAction::class);
        Voyager::addAction(\App\Actions\CoutSismiqueAction::class);
        Voyager::addAction(\App\Actions\CoutGgAction::class);
        Voyager::addAction(\App\Actions\CoutPuitAction::class); 
        Voyager::addAction(\App\Actions\CoutFracturationAction::class);
        Voyager::addAction(\App\Actions\ValideFinanceSAction::class);
        Voyager::addAction(\App\Actions\ValideFinanceGgAction::class);
        Voyager::addAction(\App\Actions\ValideFinancePAction::class);
        Voyager::addAction(\App\Actions\ValideFinanceFAction::class);
        Voyager::addAction(\App\Actions\ValideContratAction::class);
        Voyager::addAction(\App\Actions\ValideEtudeAction::class);
        Voyager::addAction(\App\Actions\AjouterContratAction::class);
        Voyager::addAction(\App\Actions\AjouterEtudeAction::class);
        
    }
}
