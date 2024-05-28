{{--
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
--}}
@global($post)
<article id="post-{{ get_the_ID() }}" @php post_class() @endphp>
  
  {{-- Preview Image --}}
  @if (has_post_thumbnail())
    {{--
     * To apply lazysizes with blurred effect. Use get_the_post_thumbnail_url instead
     * and apply the html structure of blurred effect.
    --}}
    @thumbnail($post->ID, 'post-thumbnails')
  @endif

  <hr>

  {{-- Date/Time --}}
  <p>
    Posted on @published('F d, Y') at @published('h:m A')
  </p>

  <hr>

  {{-- Post Content --}}
  <div class="entry-content">
    @content
    {!! wp_link_pages(['before' => '<div class="page-links">' . __('Pages:', 'sage'), 'after' => '</div>']) !!}
  </div>
  <hr>

</article>