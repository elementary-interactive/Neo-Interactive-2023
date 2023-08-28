{{--
    Footer part.
--}}
<footer>
  <div class="footer-wrapper">
    <h4>{{ app('site')->current()->lablec_cegnev }}</h4>
    <ul class="general">
      <li class="copy me-2">{!! app('site')->current()->lablec_copyright !!}</li>
      <li>{!! app('site')->current()->lablec_tax !!}</li>
    </ul>
    <ul class="contact-info">
      @if (app('site')->current()->lablec_email)
      <li>email: <a href="mailto:{{ app('site')->current()->lablec_email }}">{{ app('site')->current()->lablec_email }}</a></li>
      @endif
      @if (app('site')->current()->lablec_phone)
      <li>mobil: <a href="tel:{{ app('site')->current()->lablec_phone }}">{{ app('site')->current()->lablec_phone }}</a></li>
      @endif
    </ul>
    <div class="info">{!! app('site')->current()->lablec_disclaimer !!}</div>
  </div>
</footer>

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
              Budapest, Gombocz Zoltán u. 9 H-1118<br>
              <a href="tel:+3612345678">+36 1 234 5678</a>
            </p>
          </div>
          <div class="social">
            <a href="" class="defbtn"><i class="icon-arrow-right"></i>FACEBOOK</a>
            <a href="" class="defbtn"><i class="icon-arrow-right"></i>youtube</a>
            <a href="" class="defbtn"><i class="icon-arrow-right"></i>Linkedin</a>
          </div>
        </div>
        <div class="legal">
          © {{ now()->year() }} Neo Interactive All Rights Reserved.
          <a href="" class="pp ul">Privacy Policy</a>
        </div>
      </div>
    </div>
  </div>
</footer>