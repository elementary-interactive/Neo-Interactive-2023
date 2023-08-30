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
            'applicants'    => \App\Models\JobApplicant::class,
            'case_study'    => \App\Models\CaseStudy::class,
            'jobs'          => \App\Models\JobOpportunity::class,
            'leader'        => \App\Models\Leader::class,
            'link'          => \Neon\Models\Link::class,
            'menu'          => \Neon\Models\Menu::class,
            'partner'       => \App\Models\Partner::class,
            'product'       => \App\Models\Product::class,
            'service'       => \App\Models\Service::class,
            'site'          => \Neon\Site\Models\Site::class,
            'user'          => \App\Models\User::class,
        ]);
    }
}
