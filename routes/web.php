<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\CaseStudyController;
use App\Http\Controllers\JobApplicantController;
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

  Route::get("/works", [CaseStudyController::class, 'index'])
    ->name('en.case_study.index');

  Route::get("/works/{slug}", [CaseStudyController::class, 'show'])
    ->name('en.case_study.show');

  Route::get("/application/thanks", [JobApplicantController::class, 'thanks'])
    ->name('en.apply.thanks');

  Route::get("/application/{slug?}", [JobApplicantController::class, 'show'])
    ->name('en.apply.show');

  Route::post("/application/{slug?}", [JobApplicantController::class, 'store'])
    ->name('en.apply.store');

  Route::get("/privacy", [AppController::class, 'privacy'])
    ->name('en.privacy-policy');
});


Route::group([
  'middleware'  => SiteMiddleware::class
], function () {

  Route::get('/', [AppController::class, 'index'])
    ->name('hu.index');

  Route::get("/munkaink", [CaseStudyController::class, 'index'])
    ->name('hu.case_study.index');

  Route::get("/munkaink/{slug}", [CaseStudyController::class, 'show'])
    ->name('hu.case_study.show');

  Route::get("/jelentkezes/koszonjuk", [JobApplicantController::class, 'thanks'])
    ->name('hu.apply.thanks');

  Route::get("/jelentkezes/{slug?}", [JobApplicantController::class, 'show'])
    ->name('hu.apply.show');

  Route::post("/jelentkezes/{slug?}", [JobApplicantController::class, 'store'])
    ->name('hu.apply.store');

  Route::get("/adatvedelem", [AppController::class, 'privacy'])
    ->name('hu.privacy-policy');
});
