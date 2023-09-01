<?php

namespace App\Http\Controllers;

use App\Models\CaseStudy;
use App\Models\JobApplicant;
use App\Models\Course;
use App\Models\CourseParticipant;
use App\Services\CaseStudyService;
use App\Services\CourseService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;

use Neon\Services\LinkService;
use Neon\Models\Link;
use Spatie\Tags\Tag;

class CourseController extends Controller
{
    protected $course_service;

    public function __construct(CourseService $course_service)
    {
        $this->course_service = $course_service;
    }

    public function index(LinkService $page_service, Request $request)
    {
        /** Geting the current page.
         * 
         * @var  Link $page
         */
        $page           = $page_service->find('kepzesek');
        $page->template = 'courses';

        /** @var Course $course
         */
        $courses            = $this->course_service->index();

        return View::first(
            $page_service->getViews(Arr::first(site()->domains)),
            [
                'page'          => $page,
                'block'         => $page->content->first(),
                'courses'       => $courses
            ]
        );
    }

    public function show(LinkService $page_service, Request $request, string $slug = null)
    {
        /** Geting the current page.
         * 
         * @var  Link $page
         */
        $page           = $page_service->find('kepzes');
        $page->template = 'course';

        /** @var Course $course
         */
        $course            = $this->course_service->find($slug);

        if ((!is_null($course) && $course->registration_open) || is_null($slug))
        {
            $page->template = 'course_form';
        }

        return View::first(
            $page_service->getViews(Arr::first(site()->domains)),
            [
                'page'          => $page,
                'course'        => $course,
                'block'         => $page->content[0],
                'form'          => $page->content[1],
                'randoms'       => Course::where('id', '!=', $course?->id)->inRandomOrder()->limit(3)->get(),
            ]
        );
    }

    public function thanks(Request $request)
    {
        return view('web.pages.courses_thanks');
    }

    public function store(LinkService $page_service, Request $request, string $slug = null): RedirectResponse
    {
        /** Geting the current page.
         * 
         * @var  Link $page
         */
        $page           = $page_service->find('kepzes');
        $page->template = 'course_form';

        /** @var Course $course
         */
        $course            = $this->course_service->find($slug);

        $validator = Validator::make($request->all(), [
            'name'      => 'required|max:255',
            'phone'     => 'required',
            'email'     => 'required|email|max:255',
            'privacy'   => 'required'
        ], [
            'name.required'     => __('Please tell us your name!'),
            'phone.required'    => __('We need you phone number!'),
            'email.required'    => __('Please tell us your e-mail address!'),
            'email.email'       => __('Please tell us A VALID  e-mail address!')
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $participant = new CourseParticipant($validator->safe()->only(['name', 'phone', 'email']));

        if ($course)
        {
            $participant->course()->associate($course);
        }
        
        $participant->save();

        // return View::first(
        //     $page_service->getViews(Arr::first(site()->domains)),
        //     [
        //         'page'          => $page,
        //         'job'           => $course ?: $page->content[0],
        //         'form'          => $page->content[1],
        //     ]
        // );
        return redirect()
            ->route(site()->locale.'.courses.thanks');
    }
}
