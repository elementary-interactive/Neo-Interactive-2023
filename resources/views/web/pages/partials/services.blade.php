@if ($services?->count())
    <!-- knowledge -->

    <div class="main-knowledge-container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 knowledge-header">
                    <h2>{!! $attributes['title'] !!}<span class="yellow">.</span></h2>
                </div>
                @foreach ($services as $index => $service)
                <div class="col-12 col-xl-4 knowledge-content">
                    <div class="count">{{ str_pad($index, 2, ' ',  STR_PAD_LEFTT) }}</div>
                    <div class="knowledge-list">
                        <h2>{{ $service->title }}.</h2>
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
