<div class="menu-bar">
    <div class="brand-logo">
      <a href="{{ route(site()->locale.'.index') }}"><img src="{{ Vite::asset('resources/images/neo_logo.svg') }}" alt="NEO"></a>
    </div>
    <div class="menu-btn d-xl-none">
      <div class="menu-icon">
        <span class="menu-icon__line"></span>
        <span class="menu-icon__line menu-icon__line-middle"></span>
        <span class="menu-icon__line menu-icon__line-bottom"></span>
      </div>
    </div>
    <nav>
      <div class="nav-content">
        <div class="nav-list-container">
          <ul class="nav-list">
            @foreach ($links as $link)
            <li class="nav-list-item">
              <a href="{{ $link->href }}">{{ $link->title }}</a>
            </li>
            @endforeach
            <li class="nav-list-item">
              <a href="#contact">{{ __("Contact") }}</a>
            </li>
            @if (site()->link_hellogreenweb)
            <li class="nav-list-item only-desktop">
              <a class="green" href="{{ site()->link_hellogreenweb }}">HELLOGREENWEB.HU <i class="icon-icon-open-external-link"></i></a>
            </li>
            @endif
          </ul>
        </div>

        <div class="nav-mobilemenu">
          @if (site()->link_hellogreenweb)
          <div class="nav-mobilemenu-item">
            <a href="{{ site()->link_hellogreenweb }}" class="defbtn"><i class="icon-arrow-right"></i>hellogreenweb.hu</a>
          </div>
          @endif
          @if (site()->link_facebook)
          <div class="nav-mobilemenu-item">
            <a href="{{ site()->link_facebook }}" class="defbtn"><i class="icon-arrow-right"></i>FACEBOOK</a>
          </div>
          @endif
          @if (site()->link_youtube)
          <div class="nav-mobilemenu-item">
            <a href="{{ site()->link_youtube }}" class="defbtn"><i class="icon-arrow-right"></i>youtube</a>
          </div>
          @endif
          @if (site()->link_linkedin)
          <div class="nav-mobilemenu-item">
            <a href="{{ site()->link_linkedin }}" class="defbtn"><i class="icon-arrow-right"></i>Linkedin</a>
          </div>
          @endif
        </div>

      </div>
    </nav>
    <div class="lang-container">
      @if (site()->locale == 'hu')
      <a href="{{ route('en.index') }}">EN</a>
      @else
      <a href="{{ route('hu.index') }}">HU</a>
      @endif
    </div>
  </div>