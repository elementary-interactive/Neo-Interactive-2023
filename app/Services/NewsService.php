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

  public function count(array $filter = null): int
  {
    $result = null;

    if ($filter['tag']) {
      $result = News::withAnyTags([$filter['tag']], News::TAG_TYPE)
        ->where('site_id', '=', app('site')->current()->id)
        ->orderBy('published_at', 'DESC')
        ->count();
    }

    if ($filter['partner']) {
      $result = News::whereHas('partner', function($query) use ($filter) {
        $query->where('slug', '=', $filter['partner']);
      })
        ->where('site_id', '=', app('site')->current()->id)
        ->orderBy('published_at', 'DESC')
        ->count();
    }
    
    if ($filter['year']) {
      $result = News::whereBetween('published_at', [$filter['year'].'-01-01 00:00:00', $filter['year'].'-12-31 23:59:59'])
        ->where('site_id', '=', app('site')->current()->id)
        ->orderBy('published_at', 'DESC')
        ->count();
    }

    if (is_null($result))
    {
      $result = News::all()->count();
    }
    
    return $result;
  }

  public function find($slug)
  {
    return News::where('slug', $slug)
      ->where('site_id', '=', app('site')->current()->id)
      ->firstOrFail();
  }

  public function random(News $except, $limit = 3): EloquentCollection
  {
    return News::where('site_id', '=', app('site')->current()->id)
      ->where('id', '!=', $except?->id)
      ->inRandomOrder()
      ->limit($limit)
      ->get();
  }
  
  public function index($offset = 0, $limit = 9): EloquentCollection
  {
    return News::where('site_id', '=', app('site')->current()->id)
      ->orderBy('published_at', 'DESC')
      ->offset($offset)
      ->limit($limit)
      ->get();
  }

  public function filter(array $filter = null, $offset = 0, $limit = 9): EloquentCollection
  {
    $result = null;

    if ($filter['tag']) {
      $result = News::withAnyTags([$filter['tag']], News::TAG_TYPE)
        ->where('site_id', '=', app('site')->current()->id)
        ->orderBy('published_at', 'DESC')
        ->offset($offset)
        ->limit($limit)
        ->get();
    }

    if ($filter['partner']) {
      $result = News::whereHas('partner', function($query) use ($filter) {
        $query->where('slug', '=', $filter['partner']);
      })
        ->where('site_id', '=', app('site')->current()->id)
        ->orderBy('published_at', 'DESC')
        ->offset($offset)
        ->limit($limit)
        ->get();
    }
    
    if ($filter['year']) {
      $result = News::whereBetween('published_at', [$filter['year'].'-01-01 00:00:00', $filter['year'].'-12-31 23:59:59'])
        ->where('site_id', '=', app('site')->current()->id)
        ->orderBy('published_at', 'DESC')
        ->offset($offset)
        ->limit($limit)
        ->get();
    }

    if (!$result) {
      $result = $this->index($offset, $limit);
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
