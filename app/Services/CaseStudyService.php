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

  public function index(): EloquentCollection
  {
    return CaseStudy::where('show_on_main', '=', true)
      ->with('partner')
      ->orderBy('order')
      ->get();
  }

  public function filter(string $filter = null): EloquentCollection
  {
    $result = null;

    if ($filter) {
      // $tag = Tag::find($filter);
      // dd($tag);
      // if ($tag) {
        $result = CaseStudy::withAnyTags([$filter], CaseStudy::TAG_TYPE)
          ->with('partner')
          ->orderBy('order')
          ->get();
      // }
    }

    if (!$result) {
      $result = $this->all();
    }

    return $result;
  }

  public function all(): EloquentCollection
  {
    return CaseStudy::with('partner')
      ->orderBy('order')
      ->get();
  }
}
