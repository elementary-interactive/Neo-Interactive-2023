@if ($services?->count())
    <!-- knowledge -->

    <div class="main-knowledge-container" id="actionable-knowledge">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 knowledge-header">
                    <h2>{!! $attributes['title'] !!}<span class="yellow">.</span></h2>
                </div>
                @foreach ($services as $index => $service)
                <div class="col-12 col-xl-4 knowledge-content">
                    <div class="count">{{ str_pad($index + 1, 2, '0',  STR_PAD_LEFT) }}</div>
                    <div class="knowledge-list">
                        <div class="knowledge-hl">
                            <h2>{{ $service->title }}.</h2>
                            @if ($index > 0)
                            <img src="{{ Vite::asset('resources/images/main/know_0'.($index + 1).'.svg') }}" alt="" class="know-0{{ $index + 1}}">
                            @endif
                        </div>
                        <ul>
                            @foreach (explode(',', $service->keywords) as $keyword)
                            <li>{{ trim($keyword) }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
