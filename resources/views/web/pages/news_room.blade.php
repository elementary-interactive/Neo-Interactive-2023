@extends('web.layouts.default')

@section('title')
    @push('og')
        @include('web.layouts.head.og', [
            'og' => [
                'title' => $page->og_title,
                'description' => $page->og_description,
                'image' => $page->og_image,
                'type' => 'website',
                'url' => \Request::url(),
            ],
        ])
    @endpush

    @push('meta')
        @include('web.layouts.head.meta', [
            'meta' => [
                'title' => $page->og_title,
                'description' => $page->og_description,
                // 'image'             => '',
                // 'type'              => 'website',
                // 'url'               => \Request::url()
            ],
        ])
    @endpush

@section('body')
    <!-- newsroom -->

    <div class="newsroom-container default-padding menu-top-margin">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>{{ $page->title }}<span class="yellow">.</span></h1>

                    <div class="row">
                        <div class="col-12 col-xl-5 newsroom-filter">
                          <div class="filter-label">{{ $form->title }}</div>
                          <div class="dropdown">
                            <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                              {{ $form->date_label }}
                            </button> 
                            <ul class="dropdown-menu">
                              @foreach ($years as $year)
                                <li><a class="dropdown-item" href="{{ route(site()->locale . '.news.index', ['year' => $year->year]) }}">{{ $year->year }}</a></li>
                              @endforeach
                            </ul>
                          </div>
                          <div class="dropdown">
                            <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                              {{ $form->partner_label }}
                            </button>
                            <ul class="dropdown-menu">
                              @foreach ($partners as $partner)
                                <li><a class="dropdown-item" href="{{ route(site()->locale . '.news.index', ['partner' => $partner->slug]) }}">{{ $partner?->name }}</a></li>
                              @endforeach
                            </ul>
                          </div>
                          <div class="dropdown">
                            <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                              {{ $form->tag_label }}
                            </button>
                            <ul class="dropdown-menu">
                              @foreach ($tags as $tag)
                                <li><a class="dropdown-item" href="{{ route(site()->locale . '.news.index', ['filter' => $tag->getTranslation('slug', site()->locale)]) }}">{{ $tag->getTranslation('name', site()->locale) }}</a></li>
                              @endforeach
                            </ul>
                          </div>
                        </div>
                      </div>

                    @if ($news?->count())
                        <div class="newsroom-cards">
                          @foreach ($news as $article)
                            <a href="{{ route(site()->locale . '.news.show', ['slug' => $article->slug]) }}" class="newsroom-card">
                                <div class="newsroom-card-inner" style="background-image: url('{{ $article->getFirstMediaUrl(App\Models\News::MEDIA_COLLECTION, 'thumb') }}')">
                                </div>
                                <div class="date">{{ __('Posted at :date', ['date' => $article->published_at->format('Y. n. j. H:i') ]) }}</div>
                                <h3>{{ $article->title }}</h3>
                            </a>
                           @endforeach
                        </div>
                        <div class="ajax-loading"><img src="https://loading.io/icon/wgstn7" /></div>
                    @endif

                    
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
  var SITEURL = "{{ route(site()->locale . '.news.load') }}";
  var page = 0; //track user scroll as page number, right now page number is 1

  // load_more(page); //initial content load
  
  $(window).scroll(function() { //detect page scroll
     if($(window).scrollTop() + $(window).height() >= $(document).height()) { //if user scrolled from top to bottom of the page
     page += 9; //page number increment
     load_more(page); //load content   
     }
   });     
   function load_more(page){
       $.ajax({
          url: SITEURL + "?offset=" + page,
          type: "get",
          datatype: "html",
          beforeSend: function()
          {
             $('.ajax-loading').show();
           }
       })
       .done(function(data)
       {
           if (data.length == 0)
           {
           console.log(data.length);
           //notify user if nothing to load
           $('.ajax-loading').html("No more records!");
           
           return;
         }
         $('.ajax-loading').hide(); //hide loading animation once data is received
         $("#results").append(data); //append data into #results element          
          console.log('data.length');
      })
      .fail(function(jqXHR, ajaxOptions, thrownError)
      {
         alert('No response from server');
      });
   }
</script>
@endpush