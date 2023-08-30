<?php

namespace App\Services;

use App\Models\Leader;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class LeaderService
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
    return Leader::where('show_on_main', '=', true)
      ->where('site_id', '=', app('site')->current()->id)
      ->orderBy('order')
      ->get();
  }
}
