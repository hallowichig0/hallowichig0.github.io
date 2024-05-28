{{--
 * The main template file
 *
 * The template for displaying archive pages
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
        <div class="col-12">
          <div class="page-header mt-4">
            <h1 class="page-title">{!! get_the_archive_title() !!}</h1>
            <div class="archive-description">{!! get_the_archive_description() !!}</div>
					</div>{{-- .archive-title --}}
          @hasposts
            @posts
              @includeFirst(['template-parts.content' . get_post_format()])
            @endposts
            {{-- Pagination --}}
            <ul class="pagination justify-content-center mb-4">
              <li class="page-item">
                {!! get_previous_posts_link('&larr; Newer') !!}
              </li>
              <li class="page-item">
                {!! get_next_posts_link('older &rarr;') !!}
              </li>
            </ul>
          @endhasposts
          @noposts
            @includeFirst(['template-parts.content-none'])
          @endnoposts
        </div> {{-- #first --}}
      </div>{{-- .row --}}
    </section>{{-- .container --}}
  </div>{{-- #content --}}
@endsection
