<?php

namespace App\Http\Controllers;

use App\Models\CaseStudy;
use App\Services\CaseStudyService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;

use Neon\Services\LinkService;
use Neon\Models\Link;
use Spatie\Tags\Tag;

class CaseStudyController extends Controller
{
    protected $case_study_service;

    public function __construct(CaseStudyService $case_study_service)
    {
        $this->case_study_service = $case_study_service;
    }

    public function show(LinkService $page_service, Request $request, string $slug = null)
    {
        /** Geting the current page.
         * 
         * @var  Link $page
         */
        $page           = $page_service->static('munka');
        $page->template = 'case_study';

        /** @var CaseStudy $case_study
         */
        $case_study     = $this->case_study_service->findOrFail($slug);
 
        return View::first(
            $page_service->getViews(Arr::first(site()->domains)),
            [
                'page'          => $page,
                'filters'       => Tag::withType(CaseStudy::TAG_TYPE)->get(),
                'case_study'    => $case_study,
                'media'         => $case_study->getMedia(CaseStudy::MEDIA_COLLECTION)
            ]
        );
    }

    public function index(LinkService $page_service, Request $request)
    {
        /** Geting the current page.
         * 
         * @var  Link $page
         */
        $page           = $page_service->find('munkaink');
        $page->template = 'case_studies';
 
        return View::first(
            $page_service->getViews(Arr::first(site()->domains)),
            [
                'page'          => $page,
                'filters'       => Tag::withType(CaseStudy::TAG_TYPE)->get(),
                'case_studies'  => $this->case_study_service->filter($request->query('filter')),
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
        $case_studies = $this->case_study_service->filter($request->query('filter'), $request->get('offset'));

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
