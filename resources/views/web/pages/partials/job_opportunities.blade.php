    <!-- career  -->

    <div class="main-career-container">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12 col-xl-4 career-desc">
            <h2>{!! $attributes['title'] !!}<span class="yellow">.</span></h2>
            <p>{!! $attributes['intro'] !!}</p>
          </div>
          <div class="col-12 col-xl-8">
            <div class="positions">
              @forelse ($job_opportunities as $job)
              <a href="{{ route(site()->locale . '.apply.show', ['slug' => $job->slug]) }}" class="defbtn"><i class="icon-arrow-right"></i>{{ $job->title }}</a>
              @empty
              <a href="{{ route(site()->locale . '.apply.show') }}" class="defbtn"><i class="icon-arrow-right"></i>{{ $attributes['cta_title'] }}</a>
              @endforelse
            </div>
          </div>
        </div>
      </div>
    </div>