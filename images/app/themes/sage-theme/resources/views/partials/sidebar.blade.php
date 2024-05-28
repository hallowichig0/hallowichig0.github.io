{{--
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
--}}
@if (is_home() || is_singular( array('post')) || is_archive())
  {{-- Sidebar Widgets Column --}}
  <aside id="secondary" class="widget-area col-sm-12 col-md-4" role="complementary">
    @php dynamic_sidebar('sidebar-blog') @endphp
    @foreach ($widgets as $widget)
      @set($select_widget, $widget['sidebar_blog_select_widget'])
      @if ($select_widget == 'search')
        <x-widget-search title="Search"/>
      @elseif ($select_widget == 'category')
        <x-widget-category title="Categories"/>
      @elseif ($select_widget == 'archive')
        <x-widget-archive title="Archives"/>
      @endif
    @endforeach
  </aside> {{-- #second --}}
@endif