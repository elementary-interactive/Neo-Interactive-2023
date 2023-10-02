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

  public function find($slug = null)
  {
    $result = null;

    if ($slug)
    {
      $result = JobOpportunity::where('site_id', '=', app('site')->current()->id)
        ->where('slug', $slug)->first();
    }

    return $result;
  }

  public function index(): EloquentCollection
  {
    // return JobOpportunity::where('site_id', '=', app('site')->current()->id)
    //   ->orderBy('order')
    //   ->get();
    return JobOpportunity::orderBy('order')
       ->get();
  }
}
