{{-- Usage
  <x-image-blur
    size="medium"
    expand="-20"
    sizes="{{ image-id }}"
    src="{{ image-id }}"
    srcset="{{ image-id }}"
    alt="your-alt-text"
  />
--}}
<div class="image-blur">
  <img class="{{ $class }}" data-expand="{{ $imgExpand }}" data-sizes="{{ $imgSizes }}" data-src="{{ $imgSrc }}" data-srcset="{{ $imgSrcset }}" src="{{ $thumbnail }}" alt="{{ $imgAlt }}">
</div>