{{--
 * Template part for displaying all posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
--}}
@global($post)
<article id="post-{{ get_the_ID() }}" @php post_class() @endphp>

  {{-- Blog Post --}}
  <div class="card mb-4">
      {{-- Preview Image --}}
      @if (has_post_thumbnail())
        {{--
         * To apply lazysizes with blurred effect. Use get_the_post_thumbnail_url instead
         * and apply the html structure of blurred effect.
        --}}
        @thumbnail($post->ID, 'post-thumbnails')
      @endif
      <div class="card-body">
        {{-- Title --}}
        <h2 class="entry-title card-title"><a href="@permalink" rel="bookmark">@title</a></h2>
        {{-- This is the short post content --}}
        <p class="card-text">@excerpt</p>
        {{-- Get the link to this post --}}
        <a href="@permalink" class="btn btn-primary">Read More &rarr;</a>
      </div>
      <div class="card-footer text-muted">
          <p class="mb-0">
            {{-- Date/Time --}}
            Posted on @published('F d, Y') by
            {{-- Author --}}
            <a href="@authorurl">@author</a>
          </p>
      </div>
  </div>

</article>