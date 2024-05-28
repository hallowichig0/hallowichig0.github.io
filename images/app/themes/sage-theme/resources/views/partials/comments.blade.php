@if (! post_password_required())
  <section id="comments" class="comments-area">
    @if (have_comments())
      <h2 comments-title>
        {!! sprintf(_nx('One response to &ldquo;%2$s&rdquo;', '%1$s responses to &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'sage'), number_format_i18n(get_comments_number()), '<span>' . get_the_title() . '</span>') !!}
      </h2>

      <ul class="comment-list">
        {!! wp_list_comments(['callback' => 'App\sage_custom_comment', 'avatar_size' => 50, 'short_ping' => true]) !!}
      </ul>

      @if (get_comment_pages_count() > 1 && get_option('page_comments'))
        <nav>
          <ul class="pager">
            @if (get_previous_comments_link())
              <li class="previous">
                {!! get_previous_comments_link(__('&larr; Older comments', 'sage')) !!}
              </li>
            @endif

            @if (get_next_comments_link())
              <li class="next">
                {!! get_next_comments_link(__('Newer comments &rarr;', 'sage')) !!}
              </li>
            @endif
          </ul>
        </nav>
      @endif
    @endif
    {{-- If comments are closed and there are comments, let's leave a little note, shall we? --}}
    @if (! comments_open() && get_comments_number() != '0' && post_type_supports(get_post_type(), 'comments'))
      <x-alert type="warning">
        {!! __('Comments are closed.', 'sage') !!}
      </x-alert>
    @endif
    {{-- Comments Form --}}
    <div class="card my-4">
      @php comment_form($comments_form_args) @endphp
    </div>
  </section>
@endif
