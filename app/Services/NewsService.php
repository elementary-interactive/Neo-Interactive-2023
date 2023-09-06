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
      ->where('site_id', '=', app('site')->current()->id)
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

    if ($filter['tag']) {
      $result = News::withAnyTags([$filter['tag']], News::TAG_TYPE)
        ->where('site_id', '=', app('site')->current()->id)
        ->orderBy('published_at', 'DESC')
        ->get();
    }

    if ($filter['partner']) {
      $result = News::whereHas('partner', function($query) use ($filter) {
        $query->where('slug', '=', $filter['partner']);
      })
        ->where('site_id', '=', app('site')->current()->id)
        ->orderBy('published_at', 'DESC')
        ->get();
    }
    
    if ($filter['year']) {
      $result = News::whereBetween('published_at', [$filter['year'].'-01-01 00:00:00', $filter['year'].'-12-31 23:59:59'])
        ->where('site_id', '=', app('site')->current()->id)
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
    return News::where('site_id', '=', app('site')->current()->id)
      ->selectRaw('YEAR(`published_at`) AS year')->distinct()
      ->orderBy('year', 'DESC')
      ->get();
  }
}
