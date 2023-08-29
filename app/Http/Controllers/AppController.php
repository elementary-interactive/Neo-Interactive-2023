<?php

namespace App\Http\Controllers;

use App\Services\CaseStudyService;
use App\Services\LeaderService;
use App\Services\PartnerService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
use Neon\Services\LinkService;
use Neon\Models\Link;

class AppController extends Controller
{
    /** @var PartnerService
     */
    protected $partner_service;

    /** @var CaseStudyService
     */
    protected $case_study_service;

    /** @var LeaderService
     */
    protected $leader_service;

    public function __construct(PartnerService $partner_service, CaseStudyService $case_study_service, LeaderService $leader_service)
    {
        $this->partner_service    = $partner_service;
        $this->case_study_service = $case_study_service;
        $this->leader_service     = $leader_service;
    }


    public function index(LinkService $page_service, Request $request)
    {
        /** Geting the current page.
         * 
         * @var  Link $page
         */
        $page       = $page_service->find('index');
 
        return View::first(
            $page_service->getViews(Arr::first(site()->domains)),
            [
                'page'          => $page,
                'leaders'       => $this->leader_service->index(),
                'partners'      => $this->partner_service->index(),
                'case_studies'  => $this->case_study_service->index(),
            ]
        );
    }
}
