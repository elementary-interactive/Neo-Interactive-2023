<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\CaseStudy;
use App\Services\BookService;
use App\Services\CaseStudyService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;

use Neon\Services\LinkService;
use Neon\Models\Link;
use Spatie\Tags\Tag;

class BookController extends Controller
{
    protected $book_service;

    public function __construct(BookService $book_service)
    {
        $this->book_service = $book_service;
    }

    public function show(LinkService $page_service, Request $request, string $slug = null)
    {
        /** Geting the current page.
         * 
         * @var  Link $page
         */
        $page           = $page_service->static('book');
        $page->template = 'book';

        /** @var Book $book
         */
        $book     = $this->book_service->findOrFail($slug);
 
        return View::first(
            $page_service->getViews(Arr::first(site()->domains)),
            [
                'page'          => $page,
                'book'          => $book,
                'media'         => $book->getMedia(Book::MEDIA_COLLECTION)
            ]
        );
    }

    public function index(LinkService $page_service, Request $request)
    {
        /** Geting the current page.
         * 
         * @var  Link $page
         */
        $page           = $page_service->find('books');
        $page->template = 'books';
 
        return View::first(
            $page_service->getViews(Arr::first(site()->domains)),
            [
                'page'          => $page,
                'groups'        => Book::$groups,
                'books'         => $this->book_service->index(),
            ]
        );
    }

    public function load(Request $request)
    {
        
        /** @var array
         */
        $result = [];

        /** @var Collection Result of queried case studies.
         */
        $case_studies = $this->book_service->filter($request->query('filter'), $request->get('offset'));

        foreach ($case_studies as $case_study) {
            $result[] = (object) [
                'href'  => route(site()->locale . '.case_study.show', ['slug' => $case_study->slug]),
                'iurl'  => $case_study->getFirstMediaUrl(\App\Models\CaseStudy::MEDIA_COLLECTION, 'thumb'),
                'name'  => $case_study->partner->name,
                'ttle'  => $case_study->title
            ];
        }

        return response()
            ->json($result);
    }
}
