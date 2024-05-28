<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Comments extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'partials.comments',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'comments_form_args' => $this->commentFormArgs(),
        ];
    }

    /**
     * Returns the post title.
     *
     * @return string
     */
    public function commentFormArgs()
    {
        $args = array(
            'title_reply'        => __( 'Leave a Reply', 'bootstrap4' ),
            'title_reply_to'     => __( 'Leave a Reply to %s', 'bootstrap4' ),
            'title_reply_before' => '<h5 class="card-header">',
            'title_reply_after'  => '</h5><div class="card-body">',
            'comment_field' => '<div class="form-group"><textarea id="comment" name="comment" class="form-control" rows="3"></textarea></div>',
            'label_submit'  => 'Submit',
            'class_submit'  => 'btn btn-primary',
            'submit_field'  => '<div class="form-submit">%1$s %2$s</div></div>',
        );
        return $args;
    }
}