<?php

namespace App\Services;

use App\Models\Book;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Spatie\Tags\Tag;

class BookService
{
  public function __construct()
  {
    //...
  }

  public function init($slug = null, $paginate = null)
  {
  }

  public function count(string $filter = null): int
  {
    
    if ($filter) {
      $result = Book::withAnyTags([$filter], Book::TAG_TYPE);
    } else {
      $result = Book::where('site_id', '=', app('site')->current()->id);
    }
    return $result->count();
  }

  public function findOrFail($slug): Book
  {
    return Book::where('slug', $slug)
      ->firstOrFail();
  }

  public function index($offset = 0, $limit = 9): EloquentCollection
  {
    return Book::orderBy('created_at', 'desc')
      ->get()
      ->group;
  }

  public function filter(string $filter = null, $offset = 0, $limit = 9): EloquentCollection
  {
    $result = null;

    if ($filter) {
        $result = Book::withAnyTags([$filter], Book::TAG_TYPE)
          ->with('partner')
          ->where('site_id', '=', app('site')->current()->id)
          // ->orderBy('order')
          ->orderBy('created_at', 'desc')
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
    return Book::with('partner')
      ->where('site_id', '=', app('site')->current()->id)
      // ->orderBy('order')
      ->orderBy('created_at', 'desc')
      ->offset($offset)
      ->limit($limit)
      ->get();
  }
}
