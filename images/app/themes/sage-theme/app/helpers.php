<?php

/**
 * Theme helpers.
 */

namespace App;

// Reusable error notice function for admin_head()
function error_activation_admin_notice() {
    echo '<style>#message2{border-left-color:#dc3232;}</style>';
}

function sage_custom_comment( $comment, $args, $depth ) { ?>

    <?php if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

        <li id="comment-<?php comment_ID(); ?>" <?php comment_class( 'media' ); ?>>
        <div class="comment-body">
            <?php _e( 'Pingback:', 'bootstrap4' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'bootstrap4' ), '<span class="edit-link">', '</span>' ); ?>
        </div>

    <?php else : ?>

    <li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
        <article id="div-comment-<?php comment_ID(); ?>" class="comment-body media mb-4">
            <a class="pull-left" href="#">
                <?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
            </a>

            <div class="media-body">
                <div class="media-body-wrap card">

                    <div class="card-header">
                        <h5 class="mt-0"><?php printf( __( '%s <span class="says">says:</span>', 'bootstrap4' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?></h5>
                        <div class="comment-meta">
                            <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
                                <time datetime="<?php comment_time( 'c' ); ?>">
                                    <?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'bootstrap4' ), get_comment_date(), get_comment_time() ); ?>
                                </time>
                            </a>
                            <?php edit_comment_link( __( '<span style="margin-left: 5px;" class="glyphicon glyphicon-edit"></span> Edit', 'bootstrap4' ), '<span class="edit-link">', '</span>' ); ?>
                        </div>
                    </div>

                    <?php if ( '0' == $comment->comment_approved ) : ?>
                        <p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'bootstrap4' ); ?></p>
                    <?php endif; ?>

                    <div class="comment-content card-block">
                        <?php comment_text(); ?>
                    </div><!-- .comment-content -->

                    <?php comment_reply_link(
                        array_merge(
                            $args, array(
                                'add_below' => 'div-comment',
                                'depth' 	=> $depth,
                                'max_depth' => $args['max_depth'],
                                'before' 	=> '<footer class="reply comment-reply card-footer">',
                                'after' 	=> '</footer><!-- .reply -->'
                            )
                        )
                    ); ?>

                </div>
            </div><!-- .media-body -->
        </article><!-- .comment-body -->

    <?php endif; ?>
<?php }