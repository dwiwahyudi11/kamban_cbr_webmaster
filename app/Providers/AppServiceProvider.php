<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

use App\Diseases;

use Carbon\Carbon;

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
    public function boot(Request $request)
    {
        if(env('SECURE_HTTP')) {
            URL::forceScheme('https');
        }

        view()->composer('layouts.*', function($view) use ($request){
            $navDiseases = Diseases::select('id', 'nama_penyakit')
                                    ->orderBy('nama_penyakit', 'asc')
                                    ->get();

            $view->with('navDiseases', $navDiseases);
        });
    }
}
