<div class="main-testimony-container" id="we-are-neo">
    <div class="testimony-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h2>{{ $attributes['main_title'] }}<span class="yellow">.</span><br>
                        {{ $attributes['main_subtitle'] }}</h2>
                    <div class="testimony-btn">
                        <a href="#actionable-knowledge" class="defbtn"><i class="icon-arrow-right"></i>{{ $attributes['main_cta1_title'] }}</a>
                    </div>
                    <div>
                        <a href="" class="defbtn open-popup"><i class="icon-arrow-right"></i>{{ $attributes['main_cta2_title'] }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="showreel" style="background-image: url('{{ Vite::asset('resources/images/main/showreel.png') }}')">
        <a href="" class="defbtn white"><i class="icon-play"></i>{{ $attributes['main_cta-showreel_title'] }}</a>
    </div>
</div>

<!-- our mission popup -->

<div class="our-mission-popup">
    <div class="our-mission-back">
      <a href="" class="defbtn close-popup"><i class="icon-arrow-left"></i>{{ $attributes['popup_cta-back_title'] }}</a>
    </div>
    <div class="our-mission-content">
      <div class="content-wrapper">
        <h2>{{ $attributes['popup_title'] }}</h2>
        <h3>{{ $attributes['popup_subtitle'] }}</h3>
        {!! attributes['popup_content'] !!}
      </div>

    </div>
  </div>
