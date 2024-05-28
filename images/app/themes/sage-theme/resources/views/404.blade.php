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
          <section class="error-404 not-found">
            <header class="page-header">
              <h1 class="page-title">{!! __('Oops! That page can&rsquo;t be found.', 'sage') !!}</h1>
            </header><!-- .page-header -->
            <div class="page-content">
              <p class="mb-4">{!! __('It looks like nothing was found at this location. Maybe try the search below?', 'sage') !!}</p>
              {!! get_search_form(false) !!}
            </div>{{-- .page-content --}}
          </section>{{-- .error-404 --}}
        </div> {{-- #first --}}
      </div>{{-- .row --}}
    </section>{{-- .container --}}
  </div>{{-- #content --}}
@endsection
