@if ($products?->count())
        <!-- Making brands -->

        <div class="main-making-brands-container">
            <div class="container-fluid">
                <div class="row making-brands-content">
                    <div class="col-12 col-xl-4">
                        <h2>{!! $attributes['title'] !!}<span class="yellow">.</span></h2>
                        <p>{!! $attributes['intro'] !!}</p>
                    </div>
                    <div class="col-12 col-xl-8 d-none d-xl-block">
                        <div class="pattern"></div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-6 col-md-4 col-xl-3">
                            <a href="{{ $product->link }}" target="_blank" class="making-brands-card"
                                @if ($product->image) style="background-image: url('{{ $product->getFirstMediaUrl(App\Models\Product::MEDIA_COLLECTION, 'thumb') }}')" @endif>
                                <div class="label">{{ $product->title }}</div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif