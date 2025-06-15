<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Categorie;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Partager $categories avec toutes les vues
        View::composer('*', function ($view) {
            $categories = Categorie::all();
            $view->with('categories', $categories);
        });
    }
}
