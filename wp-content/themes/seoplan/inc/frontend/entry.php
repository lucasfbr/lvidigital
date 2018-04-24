<?php
/**
 *  Custom seoplan template tag
 *  @package Seo Plan
 */

if ( ! function_exists( 'seoplan_post_thumbnail' ) )
{
    /**
     * Display an optional post thumbnail
     */
    function seoplan_post_thumbnail( $args = array() )
    {
        $output = '';
        $post_type = get_post_format();
        $class = 'format-' . $post_type;
        $size = 'wpf-blog-large-thumb';
        $echo = true;
        if ( isset( $args['echo'] ) )
        {
            $echo = $args['echo'];
        }

        if ( isset( $args['size'] ) )
        {
            $size = $args['size'];
        }

        switch ( $post_type )
        {
            case 'image':
                $image = seoplan_get_image( array(
                    'size'     => $size,
                    'format'   => 'src',
                    'meta_key' => 'seoplan_image',
                    'echo'     => false,
                ) );

                if ( ! $image ) {
                    break;
                }

                if ( is_singular() )
                {
                    $image_meta = seoplan_get_post_meta( 'seoplan_image' );
                    if ( $image_meta )
                    {
                        $image_meta_src = wp_get_attachment_image_src( $image_meta, $size );
                        if ( $image_meta_src )
                        {
                            $image = $image_meta_src[0];
                        }
                    }
                    $output = sprintf(
                        '<img src="%s" alt="%s">',
                        the_title_attribute( 'echo=0' ),
                        esc_url( $image )
                    );
                }
                else
                {
                    $output = sprintf(
                        '<a class="entry-image" href="%1$s" title="%2$s"><img src="%3$s" alt="%2$s"></a>',
                        esc_url( get_permalink() ),
                        the_title_attribute( 'echo=0' ),
                        esc_url( $image )
                    );
                    $output .= '<a class="format-type-layer" href="' . get_the_permalink() . '"><i class="fa fa-picture-o" aria-hidden="true"></i></a>';
                }

                break;
            case 'video':
                if( is_singular() && !  is_page_template( 'template-full-width.php' ) )
                {
                    $video = seoplan_get_post_meta( 'seoplan_video' );
                    if ( ! $video )
                    {
                        break;
                    }

                    // If URL: show oEmbed HTML
                    if ( filter_var( $video, FILTER_VALIDATE_URL ) )
                    {
                        $video_height = 360;
                        if ( isset( $args['video_height'] ) )
                        {
                            $video_height = $args['video_height'];
                        }
                        $atts = array(
                            'width'     =>  $size,
                            'height'    =>  $video_height
                        );

                        if ( $oembed = @wp_oembed_get( $video, $atts ) )
                        {
                            $output .= $oembed;
                        }
                        else
                        {
                            $atts['src'] = $video;
                            if ( has_post_thumbnail() )
                            {
                                $atts['poster'] = seoplan_get_image( array(
                                    'size'     => $size,
                                    'format'   => 'src',
                                    'meta_key' => 'seoplan_image',
                                    'echo'     => 0,
                                ) );
                            }

                            $output .= wp_video_shortcode( $atts );
                        }

                    }
                    // If embed code: just display
                    else
                    {
                        $output .= $video;
                    }
                }
                else
                {
                    $image = seoplan_get_image( array(
                        'size'     => $size,
                        'format'   => 'src',
                        'meta_key' => 'seoplan_image',
                        'echo'     => false,
                    ) );

                    if ( ! $image ) {
                        break;
                    }

                    $output = sprintf(
                        '<a class="entry-image" href="%1$s" title="%2$s"><img src="%3$s" alt="%2$s"></a>',
                        esc_url( get_permalink() ),
                        the_title_attribute( 'echo=0' ),
                        esc_url( $image )
                    );

                    $output .= '<a class="format-type-layer" href="' . get_the_permalink() . '"><i class="flaticon-interface" aria-hidden="true"></i></a>';
                }
                break;
            case 'gallery':
                if ( is_page_template( 'template-full-width.php' ) )
                {
                    $image = seoplan_get_image( array(
                        'size'     => $size,
                        'format'   => 'src',
                        'meta_key' => 'seoplan_image',
                        'echo'     => false,
                    ) );

                    if ( ! $image ) {
                        break;
                    }

                    $output = sprintf(
                        '<a class="entry-image" href="%1$s" title="%2$s"><img src="%3$s" alt="%2$s"></a>',
                        esc_url( get_permalink() ),
                        the_title_attribute( 'echo=0' ),
                        esc_url( $image )
                    );
                    $output .= '<a class="format-type-layer" href="' . get_the_permalink() . '"></a>';
                }
                else
                {
                    $images = seoplan_get_post_meta( 'seoplan_images', "type=image&size=$size" );

                    if ( empty( $images ) )
                    {
                        break;
                    }

                    $gallery = array();
                    foreach ( $images as $image )
                    {
                        $gallery[] = '<li>' . '<img src="' . esc_url( $image['url'] ) .'" alt="' . the_title_attribute( 'echo=0' ) . '">' . '</li>';
                    }
                    $output .= '<div class="post-format-images-carousel entry-gallery"><ul class="slides">' . implode( '', $gallery ) . '</ul></div>';
                }

                break;

            default :
                $thumb = seoplan_get_image( array(
                    'size'     => $size,
                    'meta_key' => 'seoplan_image',
                    'echo'     => false,
                ) );
                if ( empty( $thumb ) ) {
                    break;
                }

                $output .= $thumb;
                break;
        }

        if ( $echo )
        {
            if ( ! empty( $output ) )
            {
                echo "<div class='entry-format $class'>$output</div>";
            }
        }
        else
        {
            return $output;
        }
    }
}

/**
 * Function get post meta
 *
 * @since  1.0
 *
 * @param  $key string
 * @param  $args array
 * @param  $post_id int
 *
 * @return mixed
 */
function seoplan_get_post_meta( $key, $args = array(), $post_id = null )
{
    if ( function_exists( 'rwmb_meta' ) )
    {
        return rwmb_meta( $key, $args, $post_id );
    }

    /**
     * Use Meta Box plugin function
     */
    $post_id = empty( $post_id ) ? get_the_ID() : $post_id;
    $args    = wp_parse_args(
        $args, array(
            'type' => 'text',
        )
    );

    // Set 'multiple' for fields based on 'type'
    if ( ! isset( $args['multiple'] ) )
    {
        $args['multiple'] = in_array( $args['type'], array( 'checkbox_list', 'file', 'file_advanced', 'image', 'image_advanced', 'plupload_image', 'thickbox_image' ) );
    }

    $meta = get_post_meta( $post_id, $key, !$args['multiple'] );

    // Get uploaded files info
    if ( in_array( $args['type'], array( 'file', 'file_advanced' ) ) )
    {
        if ( is_array( $meta ) && !empty( $meta ) )
        {
            $files = array();
            foreach ( $meta as $id ) {
                if ( get_attached_file( $id ) ) {
                    $files[$id] = seoplan_file_info( $id );
                }
            }
            $meta = $files;
        }
    }

    // Get uploaded images info
    elseif ( in_array( $args['type'], array( 'image', 'plupload_image', 'thickbox_image', 'image_advanced' ) ) )
    {
        global $wpdb;

        $meta = $wpdb->get_col(
            $wpdb->prepare(
                "SELECT meta_value FROM $wpdb->postmeta
					WHERE post_id = %d AND meta_key = '%s'
					ORDER BY meta_id ASC
				", $post_id, $key
            )
        );

        if ( is_array( $meta ) && !empty( $meta ) )
        {
            $images = array();
            foreach ( $meta as $id )
            {
                $images[$id] = seoplan_file_info( $id, $args );
            }
            $meta = $images;
        }

    }

    // Get terms
    elseif ( 'taxonomy_advanced' == $args['type'] )
    {
        if ( !empty( $args['taxonomy'] ) ) {
            $term_ids = array_map( 'intval', array_filter( explode( ',', $meta . ',' ) ) );

            // Allow to pass more arguments to "get_terms"
            $func_args = wp_parse_args(
                array(
                    'include'    => $term_ids,
                    'hide_empty' => false,
                ), $args
            );
            unset( $func_args['type'], $func_args['taxonomy'], $func_args['multiple'] );
            $meta = get_terms( $args['taxonomy'], $func_args );
        }
        else
        {
            $meta = array();
        }
    }

    // Get post terms
    elseif ( 'taxonomy' == $args['type'] )
    {
        $meta = empty( $args['taxonomy'] ) ? array() : wp_get_post_terms( $post_id, $args['taxonomy'] );
    }

    return $meta;
}

/**
 * Get blog type
 */
function seoplan_blog_type( $content_class )
{
    if ( is_home() || is_archive() || is_search() )
    {
        $content_class[] = 'blog-list';
    }
    return $content_class;
}
add_filter( 'seoplan_main_content_class', 'seoplan_blog_type' );

/**
 * Filter the except length to 20 characters.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function seoplan_custom_permalink_length( $length )
{
    $setting_length = intval( seoplan_get_option( 'general_custom_permalink' ) );
    if( $setting_length > 0 )
    {
        $length = $setting_length;
    }

    return $length;
}

add_filter( 'excerpt_length', 'seoplan_custom_permalink_length' );

/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function seoplan_custom_excerpt_more( $more )
{
    return '';
}
add_filter( 'excerpt_more', 'seoplan_custom_excerpt_more' );

if ( ! function_exists( 'seoplan_comments' ) )
{
    /**
     * Function will make change HTML layout on each comment
     * @param  $comment array
     * @param  $args    array
     * @param  $depth   int
     *
     * @return mixed
     */
    function seoplan_comments( $comment, $args, $depth )
    {
        $GLOBALS['comment'] = $comment;
        extract( $args, EXTR_SKIP );

        if ( 'div' == $args['style'] )
        {
            $tag = 'div';
            $add_below = 'comment';
        }
        else {
            $tag = 'li';
            $add_below = 'div-comment';
        }
        ?>

        <<?php echo esc_html( $tag ) ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID() ?>">
        <?php if ( 'div' != $args['style'] ) : ?>
        <article id="div-comment-<?php comment_ID() ?>" class="comment-body comment-item row">
    <?php endif; ?>

        <div class="comment-author vcard c-avatar col-xs-2 col-md-1">
            <div class="avatar">
            <?php
            if ( $args['avatar_size'] != 0 )
            {
                echo get_avatar( $comment, $args['avatar_size'] );
            }
            ?>
            </div>
        </div>
        <div class="comment-meta commentmetadata c-content col-xs-10 col-md-11">
            <div class="comment-content-wrap">
                <div class="comment-user-info">
                    <div class="user-time-post">
                        <span class="user">
                            <?php echo get_comment_author(); ?>
                            <?php
                            edit_comment_link( esc_html__( 'Edit', 'seoplan' ), '  ', '' );
                            comment_reply_link(
                                array_merge( $args, array(
                                        'add_below' => $add_below,
                                        'depth' => $depth,
                                        'max_depth' => $args['max_depth'],
                                        'reply_text' => esc_html__( 'Reply', 'seoplan' ),
                                    )
                                )
                            );
                            ?>
                        </span>
                        <a class="time" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
                            <?php printf( ' %s', get_comment_date( 'M d, Y' ) ); ?>
                        </a>
                        <?php if ( $comment->comment_approved == '0' ) : ?>
                            <em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'seoplan' ); ?></em>
                        <?php endif; ?>
                    </div><!-- end .user-time-post -->
                </div>
                <div class="comment-content">
                    <?php comment_text(); ?>
                </div>
            </div>

        </div>
        <?php if ( 'div' != $args['style'] ) : ?>
        </article>
    <?php endif; ?>
        <?php
    }
}

if ( ! function_exists( 'seoplan_language_switcher' ) ) :
    /**
     * Print HTML of language switcher
     * It requires plugin WPML installed
     */
    function seoplan_language_switcher() {
        $languages = function_exists( 'icl_get_languages' ) ? icl_get_languages() : apply_filters( 'seoplan_languages', array() );

        if ( empty( $languages ) ) {
            return;
        }

        $lang_list = array();
        $current   = '';

        foreach ( (array) $languages as $code => $language ) {
            $flag = '';
            if ( $language['country_flag_url'] )
            {
                $flag = sprintf( '<img src="%s" alt="%s" height="16" width="24" />', esc_url( $language['country_flag_url'] ), esc_attr( $language['language_code'] ) );
            }
            if ( ! $language['active'] ) {
                $lang_list[] = sprintf(
                    '<li class="%s"><a href="%s"><span>%s</span>%s</a></li>',
                    esc_attr( $code ),
                    esc_url( $language['url'] ),
                    esc_html( $language['translated_name'] ),
                    $flag
                );
            } else {
                $current = $language;
                array_unshift( $lang_list, sprintf(
                    '<li class="%s"><a href="%s"><span>%s</span>%s</a></li>',
                    esc_attr( $code ),
                    esc_url( $language['url'] ),
                    esc_html( $language['translated_name'] ),
                    $flag
                ) );
            }
        }
        ?>
        <div class="language dropdown-wrap">
            <span class="label-icon">
                <i class="fa fa-globe" aria-hidden="true"></i>
            </span>
            <div class="dropdown">
                <ul class="laguage-select dropdown-content">
                    <?php echo implode( "\n\t", $lang_list ); ?>
                </ul>
            </div>
        </div>
        <?php
    }
endif;