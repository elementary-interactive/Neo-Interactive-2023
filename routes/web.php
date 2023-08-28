<?php

use App\Http\Controllers\AppController;
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

  Route::get('/', [AppController::class, 'index'])
    ->name('en.index');
});


Route::group([
  'middleware'  => SiteMiddleware::class
], function () {

  Route::get('/', [AppController::class, 'index'])
    ->name('hu.index');

  Route::get("/munkaink/{slug}", [CaseStudyController::class, 'show'])
    ->name('hu.case_study.show');
});
