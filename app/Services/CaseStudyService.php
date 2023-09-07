<?php

namespace App\Services;

use App\Models\CaseStudy;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Spatie\Tags\Tag;

class CaseStudyService
{
  public function __construct()
  {
    //...
  }

  public function init($slug = null, $paginate = null)
  {
  }

  public function findOrFail($slug): CaseStudy
  {
    return CaseStudy::where('slug', $slug)
      ->with('partner')
      ->firstOrFail();
  }

  public function index($offset = 0, $limit = 9): EloquentCollection
  {
    return CaseStudy::where('show_on_main', '=', true)
      ->with('partner')
      ->orderBy('order')
      ->get();
  }

  public function filter(string $filter = null, $offset = 0, $limit = 9): EloquentCollection
  {
    $result = null;

    if ($filter) {
        $result = CaseStudy::withAnyTags([$filter], CaseStudy::TAG_TYPE)
          ->with('partner')
          ->orderBy('order')
          ->offset($offset)
          ->limit($limit)
          ->get();
    }

    if (!$result) {
      $result = $this->all($offset, $limit);
    }

    return $result;
  }

  public function all($offset = 0, $limit = 9): EloquentCollection
  {
    return CaseStudy::with('partner')
      ->orderBy('order')
      ->offset($offset)
      ->limit($limit)
      ->get();
  }
}
