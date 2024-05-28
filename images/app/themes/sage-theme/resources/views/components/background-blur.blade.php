{{-- Usage
  <x-background-blur
    size="full"
    expand="-20"
    minheight="put specific value. Note put `px` or `%` at the end of minheight value. Example minheight="100px"
    sizes="{{ image-id }}"
    src="{{ image-id }}"
    srcset="{{ image-id }}"
  ></x-background-blur>
  
  Note: If blur is overlapped, just add additional <div> tag wrapper before x-background-blur. Apply overflow: hidden; on the <div> tag wrapper.
--}}
<div class="background-blur {{ $class }}" data-expand="{{ $imgExpand }}" data-size="{{ $imgSizes }}" data-bgset="{{ $imgSrcset }}" style="background-image: url({{ $thumbnail }}); {{ $minHeight }}">
  {!! $message ?? $slot !!}
</div>
