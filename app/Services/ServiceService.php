<?php

namespace App\Services;

use App\Models\Service;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class ServiceService
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
    return Service::where('site_id', '=', app('site')->current()->id)
      ->orderBy('order')
      ->get();
  }
}
