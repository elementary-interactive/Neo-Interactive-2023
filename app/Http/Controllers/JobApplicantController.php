<?php

namespace App\Http\Controllers;

use App\Models\CaseStudy;
use App\Models\JobOpportunity;
use App\Services\CaseStudyService;
use App\Services\JobOpportunitiesService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;

use Neon\Services\LinkService;
use Neon\Models\Link;
use Spatie\Tags\Tag;

class JobApplicantController extends Controller
{
    protected $job_service;

    public function __construct(JobOpportunitiesService $job_service)
    {
        $this->job_service = $job_service;
    }

    public function show(LinkService $page_service, Request $request, string $slug = null)
    {
        /** Geting the current page.
         * 
         * @var  Link $page
         */
        $page           = $page_service->static('jelentkezes');
        $page->template = 'job_opportunity';

        /** @var JobOpportunity $job
         */
        $job            = $this->job_service->find($slug);
 
        return View::first(
            $page_service->getViews(Arr::first(site()->domains)),
            [
                'page'          => $page,
                'job'           => $job,
            ]
        );
    }
}
