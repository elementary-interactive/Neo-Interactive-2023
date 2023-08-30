<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
   
 
        Relation::enforceMorphMap([
            'site'          => \Neon\Site\Models\Site::class,
            'link'          => \Neon\Models\Link::class,
            'menu'          => \Neon\Models\Menu::class,
            'partner'       => \App\Models\Partner::class,
            'leader'        => \App\Models\Leader::class,
            'case_study'    => \App\Models\CaseStudy::class,
            'product'       => \App\Models\Product::class,
            'user'          => \App\Models\User::class,
        ]);
    }
}
