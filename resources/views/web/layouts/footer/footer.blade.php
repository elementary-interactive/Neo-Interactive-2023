{{--
    Footer part.
--}}
<footer id="contact">
  <div class="footer-pattern"></div>

  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <h2 class="mb-0">{{ site()->footer_slogan }}<span class="yellow">.</span></h2>
        <h2><a href="mailto:{{ site()->footer_email }}">{{ site()->footer_email }}</a></h2>

        <div class="footer-bottom">
          <div class="contact">
            <p>
              {{ site()->footer_address }}<br>
              <a href="tel:{{ Str::of(site()->footer_phone)->swap([' ' => '']) }}">{{ site()->footer_phone }}</a>
            </p>
          </div>
          <div class="social">
            @if (site()->link_facebook)
            <a href="{{ site()->link_facebook }}" class="defbtn"><i class="icon-arrow-right"></i>FACEBOOK</a>
            @endif
            @if (site()->link_youtube)
            <a href="{{ site()->link_youtube }}" class="defbtn"><i class="icon-arrow-right"></i>youtube</a>
            @endif
            @if (site()->link_linkedin)
            <a href="{{ site()->link_linkedin }}" class="defbtn"><i class="icon-arrow-right"></i>Linkedin</a>
            @endif
          </div>
        </div>
        <div class="legal">
          © {{ now()->year }} Neo Interactive All Rights Reserved.
          @if (site()->locale == 'hu')
          <a href="{{ route(site()->locale.'.privacy-policy') }}" class="pp ul">{{ __('Privacy Policy') }}</a>
          @endif
        </div>
      </div>
    </div>
  </div>
</footer>