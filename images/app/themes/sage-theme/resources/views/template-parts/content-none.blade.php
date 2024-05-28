{{--
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
--}}

<section class="no-results not-found">
	{{-- .page-content --}}
	<div class="page-content">
		@if ( is_search() )
      <x-alert type="info">
        {!! __('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'sage') !!}
			</x-alert>
		@else
      <x-alert type="info">
        {!! __('No content assiged yet.', 'sage') !!}
      </x-alert>
		@endif
	</div>
</section>
{{-- .no-results --}}