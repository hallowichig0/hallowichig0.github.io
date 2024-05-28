{{--
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
--}}
@extends('layouts.app')

@section('content')
  {{-- Page Content --}}
  <div id="content" class="site-content">
    <section class="container">
      <div class="row">
        <div class="col-12">
          @hasposts
            <div class="page-header mt-4">
              <h1 class="page-title">{!! __( 'Search Results for:', 'sage' ) !!} <span>{{ get_search_query() }}</span></h1>
            </div>{{-- .search-result --}}
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
            <div class="search-form-no-resul mt-4">
              {!! get_search_form(false) !!}
            </div>
          @endnoposts
        </div> {{-- #first --}}
      </div>{{-- .row --}}
    </section>{{-- .container --}}
  </div>{{-- #content --}}
@endsection
