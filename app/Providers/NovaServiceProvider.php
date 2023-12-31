<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;

use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Menu\Menu as NovaMenu;
use Laravel\Nova\Menu\MenuItem as NovaMenuItem;
use Laravel\Nova\Menu\MenuSection as NovaMenuSection;

use App\Nova\Admin;
use App\Nova\Attribute;
use App\Nova\Book;
use App\Nova\CaseStudy;
use App\Nova\Course;
use App\Nova\CourseParticipant;
use App\Nova\Link;
use App\Nova\Menu;
use App\Nova\Product;
use App\Nova\Site;
use App\Nova\Dashboards\Main;
use App\Nova\JobApplicant;
use App\Nova\JobOpportunity;
use App\Nova\Leader;
use App\Nova\News;
use App\Nova\Partner;
use App\Nova\Service;
use App\Nova\Tags;
use ClassicO\NovaMediaLibrary\NovaMediaLibrary;
use Laravel\Nova\Badge;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    parent::boot();

    Nova::withBreadcrumbs();

    Nova::mainMenu(function (Request $request) {
      return [
        NovaMenuSection::dashboard(Main::class)->icon('chart-bar'),

        NovaMenuSection::make(__('Administer'), [
          NovaMenuItem::resource(Admin::class)
            ->canSee(function (NovaRequest $request) {
              return $request->user()?->can('viewAny', \Neon\Admin\Models\Admin::class);
            }),
          NovaMenuItem::resource(Attribute::class)
            ->canSee(function (NovaRequest $request) {
              return $request->user()?->can('viewAny', \Neon\Attributable\Models\Attribute::class);
            }),
        ])
          ->icon('adjustments')
          ->collapsable(),

        NovaMenuSection::make(__('Website'), [
          NovaMenuItem::resource(Site::class)
            ->canSee(function (NovaRequest $request) {
              return config('site.driver', 'file') == 'database' && $request->user()?->can('viewAny', \Neon\Site\Models\Site::class);
            }),
          NovaMenuItem::resource(Menu::class)
            ->canSee(function (NovaRequest $request) {
              return $request->user()?->can('viewAny', \Neon\Models\Menu::class);
            }),
          NovaMenuItem::resource(Link::class)
            ->canSee(function (NovaRequest $request) {
              return $request->user()?->can('viewAny', \Neon\Models\Link::class);
            }),
        ])
          ->icon('globe')
          ->collapsable(),

        NovaMenuSection::make(__('Resources'), [
          NovaMenuItem::resource(Leader::class), // Vezetőség
          NovaMenuItem::resource(Service::class), // Szolgáltatásaink
          NovaMenuItem::resource(Product::class), // Termékeink
          NovaMenuItem::resource(Partner::class), // Ügyfelek
          NovaMenuItem::resource(CaseStudy::class), // Case Study
          NovaMenuItem::resource(Book::class), // Case Study
          NovaMenuItem::resource(News::class), // Hírek
          NovaMenuItem::resource(Tags::class), // Címkék

          // NovaMenuItem::resource(NovaMediaLibrary::class),
          /** Here comes all the menu items...
         * 
         * ...
         * 
         * ...
         * 
         */
        ])->collapsable(),
        NovaMenuSection::make('Állásajánlatok', [
          NovaMenuItem::resource(JobOpportunity::class), // Állásajánlatok
          NovaMenuItem::resource(JobApplicant::class) // Állásajánlat jelentkezések
            ->withBadgeIf('New!', 'info', fn() => JobApplicant::newModel()->count() > 0),
        ])
          ->icon('briefcase')
          ->collapsable(),
        NovaMenuSection::make('Kurzusok', [
          NovaMenuItem::resource(Course::class), //- "Kurzusok" vagy mi a faszom.
          NovaMenuItem::resource(CourseParticipant::class)
            ->withBadgeIf('New!', 'info', fn() => CourseParticipant::newModel()->count() > 0),
        ])
          ->icon('calendar')
          ->collapsable(),
      ];
    });

    Nova::footer(function ($request) {
      return view('nova::partials.footer')->render();
    });
  }

  /**
   * Register the Nova routes.
   *
   * @return void
   */
  protected function routes()
  {
    Nova::routes()
      ->withAuthenticationRoutes()
      ->withPasswordResetRoutes()
      ->register();
  }

  /**
   * Register the Nova gate.
   *
   * This gate determines who can access Nova in non-local environments.
   *
   * @return void
   */
  protected function gate()
  {
    Gate::define('viewNova', function ($user) {
      return true;
      // return in_array($user->email, [
      //   //
      // ]);
    });
  }

  /**
   * Get the dashboards that should be listed in the Nova sidebar.
   *
   * @return array
   */
  protected function dashboards()
  {
    return [
      new \App\Nova\Dashboards\Main,
    ];
  }

  /**
   * Get the tools that should be listed in the Nova sidebar.
   *
   * @return array
   */
  public function tools()
  {
    return [];
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