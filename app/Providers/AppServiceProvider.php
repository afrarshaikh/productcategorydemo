<?php

namespace App\Providers;

use Illuminate\Support\Str;
use Illuminate\Support\ServiceProvider;

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
        Str::macro('getNextAutoNumber',function($modelName,$prefix){
            $modelName = ucwords(trim($modelName));
            $model = 'App\\' . $modelName;
            if ($modelName != "" && class_exists($model)) {
                $model_last_data = $model::select(['id'])->orderBy('id', 'desc')->first();
                $last_id = 0;
                if(isset($model_last_data->id)){
                    $last_id = $model_last_data->id;
                }
                $next_possible_id = str_pad($last_id + 1, 4, "0", STR_PAD_LEFT);
                return $prefix."-".$next_possible_id;
            }

        });
    }
}
