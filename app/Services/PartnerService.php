<?php

namespace App\Services;

use App\Models\Partner;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class PartnerService
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
    return Partner::where('show_on_main', '=', true)
      ->orderBy('order')
      ->get();
  }

  public function all(): EloquentCollection
  {
    return Partner::has('news')
      ->orderBy('name')
      ->get();
  }
}
