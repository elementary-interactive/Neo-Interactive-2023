@if ($partners?->count())
    <!-- partners -->

    <div class="main-partners-container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="partners-items">
                        @foreach ($partners as $partner)
                            <div class="partners-item">
                                {{ $partner->getFirstMedia(App\Models\Partner::MEDIA_COLLECTION) }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
