{{--
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
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
        <h1>@title</h1>
        {{-- Breadcrumb --}}
        @if (function_exists('bcn_display'))
          @php bcn_display() @endphp
        @endif
        <div class="row">
          @includeFirst(['template-parts.content-page'])
        </div><!-- .row -->
      </section><!-- .container -->
    </div><!-- #content -->
  @endposts
@endsection