<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Store;
use App\StoreLanguage;
use Auth;
use Schema;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //To Solve Laravel Bug
        Schema::defaultStringLength(191);

        //To Pass Auth User Store ID
        view()->composer('*', function ($view) 
        {
            $storeInfo = Store::where('vendor_id', Auth::id())->first();
            if ($storeInfo != '') {
               $view->with('storeInfo', $storeInfo);
            }else{
                $storeInfo = '';
                $view->with('storeInfo', $storeInfo);
            }
            
        });  

        //To Pass Store Languages
        view()->composer('*', function ($view) 
        {
            $storeInfo = Store::where('vendor_id', Auth::id())->first();
            if ($storeInfo) {
                $store_languages = StoreLanguage::all()->where('store_id', $storeInfo->id);
                
                   $view->with('store_languages', $store_languages);
                
            }else{
                $store_languages = '';
            }
        }); 
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
