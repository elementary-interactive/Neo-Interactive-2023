<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Services\NewsService;
use App\Services\PartnerService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\View;
use Neon\Services\LinkService;
use Spatie\Tags\Tag;

class NewsController extends Controller
{
    /** @var NewsService */
    protected $news_service;

    /** @var PartnerService */
    protected $partner_service;

    public function __construct(NewsService $news_service, PartnerService $partner_service)
    {
        $this->news_service     = $news_service;
        $this->partner_service  = $partner_service;
    }

    public function index(LinkService $page_service, Request $request)
    {
        /** Geting the current page.
         * 
         * @var  Link $page
         */
        $page           = $page_service->find('hirek');
        $page->template = 'news_room';

        $news           = $this->news_service->filter([
            'tag'       => $request->query('filter'),
            'year'      => $request->query('year'),
            'partner'   => $request->query('partner')
        ]);

        return View::first(
            $page_service->getViews(Arr::first(site()->domains)),
            [
                'page'       => $page,
                'form'       => $page->content->first(),
                'tags'       => Tag::withType(News::TAG_TYPE)->get(),
                'years'      => $this->news_service->years(),
                'partners'   => $this->partner_service->all(),
                'news'       => $news
            ]
        );
    }

    public function show(LinkService $page_service, Request $request, string $slug = null)
    {
        /** Geting the current page.
         * 
         * @var  Link $page
         */
        $page           = $page_service->find('hir');
        $page->template = 'news';

        /** @var News $news
         */
        $news            = $this->news_service->find($slug);

        return View::first(
            $page_service->getViews(Arr::first(site()->domains)),
            [
                'page'       => $page,
                'news'       => $news,
                // 'block'      => $page->content[0],
                'tags'       => Tag::withType(News::TAG_TYPE)->get(),
                'randoms'    => News::where('id', '!=', $news?->id)->inRandomOrder()->limit(3)->get(),
            ]
        );
    }

    /** Load news via ajax...
     *
     */
    public function load(Request $request)
    {
        $news           = $this->news_service->filter([
            'tag'       => $request->query('filter'),
            'year'      => $request->query('year'),
            'partner'   => $request->query('partner')
        ], $request->get('offset'));

        return response()->json($news, 204);
    }
}
