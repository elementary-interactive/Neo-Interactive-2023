<?php

namespace App\Services;

use App\Models\News;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class NewsService
{
  public function __construct()
  {
    //...
  }

  public function find($slug)
  {
    return News::where('slug', $slug)
      ->firstOrFail();
  }

  public function index(): EloquentCollection
  {
    return News::where('site_id', '=', app('site')->current()->id)
      ->orderBy('published_at', 'DESC')
      ->get();
  }

  public function filter(array $filter = null): EloquentCollection
  {
    $result = null;

    if (array_key_exists('filter', $filter)) {
      $result = News::withAnyTags([$filter['filter']], News::TAG_TYPE)
        ->orderBy('published_at', 'DESC')
        ->get();
    }

    if (array_key_exists('partner', $filter)) {
      $result = News::where('partner_id', '=', $filter['partner'])
        ->orderBy('published_at', 'DESC')
        ->get();
    }
    
    if (array_key_exists('year', $filter)) {
      $result = News::whereBetween('published_at', [$filter['year'].'-01-01 00:00:00', $filter['year'].'-12-31 23:59:59'])
        ->orderBy('published_at', 'DESC')
        ->get();
    }

    if (!$result) {
      $result = $this->index();
    }

    return $result;
  }

  public function years(): EloquentCollection
  {
    return News::selectRaw('YEAR(`published_at`) AS year')->distinct()->get();
  }
}
