{{--
 * The template for displaying all single posts and attachments
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
--}}
@extends('layouts.app')

@section('content')
  @posts
    {{-- Page Content --}}
    <div id="content" class="site-content">
      <section class="container">
        {{-- Title --}}
        <h1 class="entry-title mt-4">
          @if ( is_single() )
            @title
          @else
            <a href="@permalink" rel="bookmark">@title</a>
          @endif
          {{-- Author --}}
          <small>
            by
            <a href="@authorurl">@author</a>
          </small>
        </h1>
        {{-- Breadcrumb --}}
        @if (function_exists('bcn_display'))
          @php bcn_display() @endphp
        @endif
        <div class="row">
          <div class="col-12 {{ $switch_sidebar == false ? 'col-md-12' : 'col-md-8' }}">
            @includeFirst(['template-parts.content-single'])
            @php the_post_navigation() @endphp
            {{-- If comments are open or we have at least one comment, load up the comment template. --}}
            @php(comments_template())
          </div> {{-- #first --}}
          @istrue($switch_sidebar)
            @include('partials.sidebar')
          @endistrue
        </div>{{-- .row --}}
      </section>{{-- .container --}}
    </div>{{-- #content --}}
  @endposts
@endsection