<?php

namespace App\View\Components;

use Roots\Acorn\View\Component;

class ImagePlain extends Component
{
    public $class;

    public $imgExpand;

    public $imgSize;

    public $imgSrc;

    public $imgSrcset;

    public $imgSizes;

    public $imgAlt;

    public $thumbnail;

    /**
     * Create the component instance.
     *
     * @param  string  $title
     * @return void
     */
    public function __construct($class = 'lazyload', $expand = '', $size = '', $src = '', $srcset = '', $sizes = '', $alt = '')
    {
        $this->class = $class;
        $this->imgExpand = $expand;
        $this->imgSize = $size;
        $this->imgSrc = $this->imageSrc($src, $this->imgSize);
        $this->imgSrcset = $this->imageSrcset($srcset, $this->imgSize) ? $this->imageSrcset($srcset, $this->imgSize) : $this->imageSrc($src, $this->imgSize) . ' 1920w';
        $this->imgSizes = $this->imageSizes($sizes, $this->imgSize) ? $this->imageSizes($sizes, $this->imgSize) : $sizes;
        $this->imgAlt = $alt;
        $this->thumbnail = $this->imageSrc($src, 'thumbnail-10-10');
        
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return $this->view('components.image-plain');
    }

    public function imageSrc($src, $size) {
        return wp_get_attachment_image_url( $src , $size );
    }

    public function imageSrcset($src, $size) {
        return wp_get_attachment_image_srcset( $src , $size );
    }

    public function imageSizes($src, $size) {
        return wp_get_attachment_image_sizes( $src , $size );
    }
}
