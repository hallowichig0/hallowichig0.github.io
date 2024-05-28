{{-- Usage
  <x-image-progressive
    width="optional. can leave as blank"
    height="optional. can leave as blank"
    maxwidth="samle value of width attr or put specific value. Note put `px` or `%` at the end of maxwidth value. Example maxwidth="100px"
    size="medium" expand="-20" sizes="{{ image-id }}"
    src="{{ image-id }}" srcset="{{ image-id }}"
    alt="your-alt-text"
  />
--}}
<div class="progressivePlain" style="{{ $maxWidth }}">
  <div class="progressivePlain-fill" style="{{ $paddingBottom }}"></div>
  <div class="progressivePlain-container"> 
    <img class="progressivePlain-img progressivePlain-original of-cover {{ $class }}" data-expand="{{ $imgExpand }}" data-sizes="{{ $imgSizes }}" data-src="{{ $imgSrc }}" data-srcset="{{ $imgSrcset }}" alt="{{ $imgAlt }}"/>
    <img class="progressivePlain-img progressivePlain-thumbnail" src="{{ $thumbnail }}">
  </div>
</div>