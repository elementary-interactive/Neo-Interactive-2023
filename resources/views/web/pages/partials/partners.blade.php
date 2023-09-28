@if ($partners?->count())
    <!-- partners -->

    <div class="main-partners-container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="partners-items">
                        @foreach ($partners as $partner)
                            @if ($partner->getFirstMedia(App\Models\Partner::MEDIA_COLLECTION))
                                @if ($partner->link)
                                    <a class="partners-item" href="{{ $partner->link }}">
                                @endif
                                {{ $partner->getFirstMedia(App\Models\Partner::MEDIA_COLLECTION) }}
                                @if ($partner->link)
                                    </a>
                                @endif
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
