{{-- Loading Animation --}}
<div class="pre-loader">
  <div class="loader"></div>
  <p>Please wait while loading...</p>
</div>
<header id="header" class="header">
  <nav class="navbar nav-top" style="background-color:#ffffff">
    <div class="container px-sm-0">
      <div class="navbar-nav flex-row align-items-center">
        @if (has_custom_logo())
          <a class="site-logo-link" href="{{ home_url('/') }}">
            {!! $header_logo !!}
          </a>
          @if(get_bloginfo('name'))
            <h1 class="ps-3 mb-0" style="color:#000000">
              {{ get_bloginfo('name') }}
            </h1>
          @endif
        @else
          <a class="navbar-brand col-md-6 px-0" style="color:#000000" class="navbar-brand" href="{{ home_url('/') }}">
            <h3 class="font-weight-bold" style="margin-bottom:0.3rem;">{{ $sitename }}</h3>
            @if(get_bloginfo('description'))
              <h6 class="mb-0" style="color:#000000">
                {{ get_bloginfo('description') }}
              </h6>
            @endif
          </a>
        @endif
      </div>
      {{-- Social Media --}}
      <div class="navbar-nav ml-sm-auto social-media">
        @notempty($social_media)
          @set($social_classes, '')
          <div class="navbar-brand col-md-6 px-0 py-0 social-menu">
            @foreach ($social_media as $item)
              @set($select_media, $item['header_social_media_select'])
              @set($link_media, $item['header_social_media_link'])
              @if ($select_media == 'fb')
                @set($social_classes, 'fa-brands fa-facebook-f social-icon-fb')
              @elseif ($select_media == 'instagram')
                @set($social_classes, 'fa-brands fa-instagram social-icon-instagram')
              @elseif ($select_media == 'twitter')
                @set($social_classes, 'fa-brands fa-twitter social-icon-twitter')
              @endif
              <a href="{{ $link_media }}" target="_blank"> <i class="social-icon fa {{ $social_classes }}" aria-hidden="true"></i></a>
            @endforeach 
          </div>
        @endnotempty
      </div>
    </div>
  </nav>
  {{-- Navigation --}}
  <nav class="navbar navbar-expand-lg nav-bottom" style="background-color: #343a40">
    <div class="container">
      <button class="navbar-toggler collapsed navbar-toggler-right shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
        <span class="icon-bar top-bar"></span>
        <span class="icon-bar middle-bar"></span>
        <span class="icon-bar bottom-bar"></span>
      </button>
      @if (has_nav_menu('primary-menu'))
        {!! wp_nav_menu($primary_menu) !!}
      @endif
    </div>
  </nav>
</header>
