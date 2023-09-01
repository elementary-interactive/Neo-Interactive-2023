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

  public function filter(string $filter = null): EloquentCollection
  {
    $result = null;

    if ($filter) {
      $result = News::withAnyTags([$filter], News::TAG_TYPE)
        ->orderBy('published_at', 'DESC')
        ->get();
    }

    if (!$result) {
      $result = $this->index();
    }

    return $result;
  }
}
