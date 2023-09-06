@if ($partners?->count())
    <!-- partners -->

    <div class="main-partners-container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="partners-items">
                        @foreach ($partners as $partner)
                            @if ($partner->getFirstMedia(App\Models\Partner::MEDIA_COLLECTION))
                            <a class="partners-item" href="{{ $partner->link }}">
                                {{ $partner->getFirstMedia(App\Models\Partner::MEDIA_COLLECTION) }}
                            </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
