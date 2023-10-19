<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\URL;

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
        // URL::forceScheme('https');
 
        Relation::enforceMorphMap([
            'applicants'        => \App\Models\JobApplicant::class,
            'attibute'          => \Neon\Attributable\Models\Attribute::class,
            'attibute_value'    => \Neon\Attributable\Models\AttributeValue::class,
            'book'              => \App\Models\Book::class,
            'case_study'        => \App\Models\CaseStudy::class,
            'course'            => \App\Models\Course::class,
            'jobs'              => \App\Models\JobOpportunity::class,
            'leader'            => \App\Models\Leader::class,
            'link'              => \Neon\Models\Link::class,
            'menu'              => \Neon\Models\Menu::class,
            'menu_item'         => \Neon\Models\MenuItem::class,
            'news'              => \App\Models\News::class,
            'partner'           => \App\Models\Partner::class,
            'product'           => \App\Models\Product::class,
            'service'           => \App\Models\Service::class,
            'site'              => \Neon\Site\Models\Site::class,
            'site_dependency'   => \Neon\Site\Models\SiteDependencies::class,
            'tag'               => \Spatie\Tags\Tag::class,
            'user'              => \App\Models\User::class,
        ]);
    }
}
