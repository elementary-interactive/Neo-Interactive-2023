<?php

namespace App\Services;

use App\Models\JobOpportunity;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class JobOpportunitiesService
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
    return JobOpportunity::where('site_id', '=', app('site')->current()->id)
      ->orderBy('order')
      ->get();
  }
}
