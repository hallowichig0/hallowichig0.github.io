<form id="searchform" method="get" class="searchform" action="{{ home_url('/') }}">
  <div class="input-group">
      <input type="search" class="search-field form-control" name="s" placeholder="{!! esc_attr_x('Search for...', 'placeholder', 'sage') !!}" value="{{ get_search_query() }}">
      <span class="input-group-btn">
        <input class="btn btn-secondary" type="submit" value="{{ esc_attr_x('Search', 'submit button', 'sage') }}">
      </span>
  </div>
</form>