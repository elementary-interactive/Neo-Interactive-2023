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

    public function show(Request $request, string $slug = null)
    {
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
}
