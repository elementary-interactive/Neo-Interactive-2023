<?php

namespace App\Services;

use App\Models\Course;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class CourseService
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
      $result = Course::where('slug', $slug)->first();
    }

    return $result;
  }

  public function index(): EloquentCollection
  {
    return Course::where('site_id', '=', app('site')->current()->id)
      ->orderBy('registration_open', 'DESC')
      ->orderBy('order', 'ASC')
      ->get();
  }
}
