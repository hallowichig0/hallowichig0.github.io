{{--
 * Template for displaying all blog post
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
--}}
@extends('layouts.app')

@section('content')
  {{-- Page Content --}}
  <div id="content" class="site-content">
    <section class="container">
      <div class="row">
        <div class="col-12 {{ $switch_sidebar == false ? 'col-md-12' : 'col-md-8' }}">
          <h1 class="page-title">{!! $title !!}</h1>
          @hasposts
            @posts
              @includeFirst(['template-parts.content-home'])
            @endposts
            {{-- Pagination --}}
            @if (is_home())
              <ul class="pagination justify-content-center mb-4">
                <li class="page-item">
                  {!! get_previous_posts_link('&larr; Newer') !!}
                </li>
                <li class="page-item">
                  {!! get_next_posts_link('older &rarr;') !!}
                </li>
              </ul>
            @endif
          @endhasposts
          @noposts
            @includeFirst(['template-parts.content-none'])
          @endnoposts
        </div> {{-- #first --}}
        @if (is_home())
          @istrue($switch_sidebar)
            @include('partials.sidebar')
          @endistrue
        @endif
      </div>{{-- .row --}}
    </section>{{-- .container --}}
  </div>{{-- #content --}}
@endsection
