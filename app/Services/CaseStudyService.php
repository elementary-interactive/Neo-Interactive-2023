<?php

namespace App\Services;

use App\Models\CaseStudy;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class CaseStudyService
{
  public function __construct()
  {
    //...
  }

  public function init($slug = null, $paginate = null)
  {
  }

  public function index(): EloquentCollection
  {
    return CaseStudy::where('show_on_main', '=', true)
      ->orderBy('order')
      ->get();
  }
}
