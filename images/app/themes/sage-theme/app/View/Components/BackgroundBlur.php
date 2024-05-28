<?php

namespace App\View\Components;

use Roots\Acorn\View\Component;

class BackgroundBlur extends Component
{
    public $class;

    public $imgExpand;

    public $imgSize;

    public $imgSrc;

    public $imgSrcset;

    public $imgSizes;

    public $thumbnail;

    public $minHeight;

    public $message;

    /**
     * Create the component instance.
     *
     * @param  string  $title
     * @return void
     */
    public function __construct($class = 'lazyload', $expand = '', $size = '', $src = '', $srcset = '', $sizes = '', $minheight = '', $message = null)
    {
        $this->class = $class;
        $this->imgExpand = $expand;
        $this->imgSize = $size;
        $this->imgSrc = $this->imageSrc($src, $this->imgSize);
        $this->imgSrcset = $this->imageSrcset($srcset, $this->imgSize) ? $this->imageSrcset($srcset, $this->imgSize) : $this->imageSrc($src, $this->imgSize) . ' 1920w';
        $this->imgSizes = $this->imageSizes($sizes, $this->imgSize) ? $this->imageSizes($sizes, $this->imgSize) : $sizes;
        $this->thumbnail = $this->imageSrc($src, 'thumbnail-10-10');
        $this->minHeight = $this->imageMinHeight($minheight);
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return $this->view('components.background-blur');
    }

    public function imageMinHeight($minHeight) {
        $output = '';
        if(!empty($minHeight)){
            $output .= 'min-height: ' . $minHeight . ';';
        }
        return $output;
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