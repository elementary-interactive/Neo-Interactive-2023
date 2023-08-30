@if ($leaders?->count())
    <!-- leadership -->

    <div class="main-leadership-container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-xl-4">
                    <div class="leadership-headline">
                        <h2>{!! $attributes['title'] !!}<span class="yellow">.</span></h2>
                        <img src="{{ Vite::asset('resources/images/main/leadership_rt.svg') }}" alt=""
                            class="d-none d-xl-block">
                        <img src="{{ Vite::asset('resources/images/main/leadership_rt_mobile.svg') }}" alt=""
                            class="d-block d-xl-none">
                    </div>
                </div>

                <div class="col-12 col-xl-8 leadership-content">
                    @foreach ($leaders as $leader)
                        <div class="leadership-card">
                            <img src="{{ $leader->getFirstMediaUrl(App\Models\Leader::MEDIA_COLLECTION, 'thumb') }}"
                                alt="">
                            <div class="name">{{ $leader->name }}</div>
                            <div class="position">{{ $leader->position }}</div>
                            <div class="social">
                                @if ($leader->link_facebook)
                                    <a href="{{ $leader->link_facebook }}" target="_blank" class="yellow"><i
                                            class="icon-twitter"></i></a>
                                @endif
                                @if ($leader->link_linkedin)
                                    <a href="{{ $leader->link_linkedin }}" target="_blank" class="yellow"><i
                                            class="icon-linkedin"></i></a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif
