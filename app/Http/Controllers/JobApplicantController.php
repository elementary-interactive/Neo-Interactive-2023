<?php

namespace App\Http\Controllers;

use App\Models\CaseStudy;
use App\Models\JobApplicant;
use App\Models\JobOpportunity;
use App\Services\CaseStudyService;
use App\Services\JobOpportunitiesService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;

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
        $page           = $page_service->find('jelentkezes');
        $page->template = 'job_opportunity';

        /** @var JobOpportunity $job
         */
        $job            = $this->job_service->find($slug);

        return View::first(
            $page_service->getViews(Arr::first(site()->domains)),
            [
                'page'          => $page,
                'job'           => $job ?: $page->content[0],
                'form'          => $page->content[1],
            ]
        );
    }

    public function thanks(Request $request)
    {
        return view('web.pages.job_opportunity_thanks');
    }

    public function store(LinkService $page_service, Request $request, string $slug = null): RedirectResponse
    {
        /** Geting the current page.
         * 
         * @var  Link $page
         */
        $page           = $page_service->find('jelentkezes');
        $page->template = 'job_opportunity';

        /** @var JobOpportunity $job
         */
        $job            = $this->job_service->find($slug);

        $validator = Validator::make($request->all(), [
            'name'      => 'required|max:255',
            'email'     => 'required|email|max:255',
            'file'      => 'required|file',
            'privacy'   => 'required'
        ], [
            'name.required'     => __('Please tell us your name!'),
            'email.required'    => __('Please tell us your e-mail address!'),
            'email.email'       => __('Please tell us A VALID  e-mail address!'),
            'file.required'     => __('Please upload your CV!'),
            'file.file'         => __('Please upload your CV!'),
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $applicant = new JobApplicant($validator->safe()->only(['name', 'email']));
        $applicant->file_path = $request->file->store('cv');
        $applicant->file_name = $request->file->getClientOriginalName().'.'.$request->file->getClientOriginalExtension();
        $applicant->save();

        if ($job)
        {
            $applicant->jobOpportunity()->save($job);
        }

        // return View::first(
        //     $page_service->getViews(Arr::first(site()->domains)),
        //     [
        //         'page'          => $page,
        //         'job'           => $job ?: $page->content[0],
        //         'form'          => $page->content[1],
        //     ]
        // );
        return redirect()
            ->route(site()->locale.'.apply.thanks');
    }
}
