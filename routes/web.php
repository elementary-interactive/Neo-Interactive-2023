<?php

use App\Http\Controllers\CaseStudyController;
use Illuminate\Support\Facades\Route;
use Neon\Site\Facades\Site;
use Neon\Site\Http\Middleware\SiteMiddleware;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group([
    'prefix'      => 'en',
    'middleware'  => SiteMiddleware::class
  ], function () {

Route::get('/', function() {
    echo 'Hello '.app('site')->current()->locale.' /// DOMAIN';

    echo 'Hello '.app('site')->current()->lablec_szoveg.' /// DOMAIN';
    dump(app('site')->current());
  })
  ->name('en.index');

});


Route::group([
    'middleware'  => SiteMiddleware::class
  ], function () {

    Route::get('/', function() {
        // echo 'Szia '.app('site')->current()->locale.' /// DOMAIN';
        // dump(app()->getLocale());

        return view('web.pages.index');

      })
      ->name('hu.index');

    Route::get("/munkaink/{slug}", [CaseStudyController::class, 'show'])
      ->name('hu.case_study.show');

});