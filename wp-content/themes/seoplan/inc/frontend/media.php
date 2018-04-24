<?php
/**
 * Register google fonts
 *
 * @return string
 */
function seoplan_fonts_url()
{
    $fonts_url = '';

    /* Translators: If there are characters in your language that are not
    * supported by Montserrat, translate this to 'off'. Do not translate
    * into your own language.
    */

    $poppins = _x( 'on', 'Poppins font: on or off', 'seoplan' );
    /* Translators: If there are characters in your language that are not
    * supported by Montserrat, translate this to 'off'. Do not translate
    * into your own language.
    */
    $monsterat = _x( 'on', 'Montserrat font: on or off', 'seoplan' );

    /* Translators: If there are characters in your language that are not
    * supported by Montserrat, translate this to 'off'. Do not translate
    * into your own language.
    */
    $varela = _x( 'on', 'Varela Round font: on or off', 'seoplan' );

    if ( 'off' !== $monsterat || 'off' !== $monsterat || 'off' !== $varela )
    {
        $font_families = array();

        if ( 'off' !== $poppins )
            $font_families[] = 'Poppins:400,600,700';

        if ( 'off' !== $monsterat )
            $font_families[] = 'Montserrat:400,700';

        if ( 'off' !== $varela )
            $font_families[] = 'Varela Round';

        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );

        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    }

    return esc_url_raw( $fonts_url );
}

/**
 * Display or get post image
 *
 * @param $args array
 *
 * @return void|string
 */
function seoplan_get_image( $args = array() )
{
    $default = apply_filters(
        'seoplan_get_image_args',
        array(
            'post_id'  => get_the_ID(),
            'attr'     => '',
            'format'   => 'html', // html or src
            'scan'     => true,
            'echo'     => true,
            'size'     => 'thumbnail',
            'meta_key' => '',
            'default'  => '',
        )
    );

    $args = wp_parse_args( $args, $default );

    if ( ! $args['post_id'] )
    {
        $args['post_id'] = get_the_ID();
    }

    // Get image from cache
    $key         = md5( serialize( $args ) );
    $image_cache = wp_cache_get( $args['post_id'], 'seoplan_get_image' );

    if ( ! is_array( $image_cache ) )
    {
        $image_cache = array();
    }

    if ( empty( $image_cache[$key] ) )
    {
        // Get post thumbnail
        if ( has_post_thumbnail( $args['post_id'] ) )
        {
            $id   = get_post_thumbnail_id();
            $html = wp_get_attachment_image( $id, $args['size'], false, $args['attr'] );
            list( $src ) = wp_get_attachment_image_src( $id, $args['size'], false );
        }

        // Get the first image in the custom field
        if ( ! isset( $html, $src ) && $args['meta_key'] )
        {
            $id = get_post_meta( $args['post_id'], $args['meta_key'], true );

            // Check if this post has attached images
            if ( $id )
            {
                var_dump( $id );
                $html = wp_get_attachment_image( $id, $args['size'], false, $args['attr'] );
                list( $src ) = wp_get_attachment_image_src( $id, $args['size'], false );
            }
        }

        // Get the first attached image
        if ( ! isset( $html, $src ) )
        {
            $image_ids = array_keys( get_children( array(
                'post_parent'    => $args['post_id'],
                'post_type'      => 'attachment',
                'post_mime_type' => 'image',
                'orderby'        => 'menu_order',
                'order'          => 'ASC',
            ) ) );

            // Check if this post has attached images
            if ( ! empty( $image_ids ) )
            {
                $id   = $image_ids[0];
                $html = wp_get_attachment_image( $id, $args['size'], false, $args['attr'] );
                list( $src ) = wp_get_attachment_image_src( $id, $args['size'], false );
            }
        }

        // Get the first image in the post content
        if ( ! isset( $html, $src ) && ( $args['scan'] ) )
        {
            preg_match( '|<img.*?src=[\'"](.*?)[\'"].*?>|i', get_post_field( 'post_content', $args['post_id'] ), $matches );

            if ( ! empty( $matches ) )
            {
                $html = $matches[0];
                $src  = $matches[1];
            }
        }

        // Use default when nothing found
        if ( ! isset( $html, $src ) && ! empty( $args['default'] ) )
        {
            if ( is_array( $args['default'] ) )
            {
                $html = @$args['html'];
                $src  = @$args['src'];
            }
            else
            {
                $html = $src = $args['default'];
            }
        }

        // Still no images found?
        if ( ! isset( $html, $src ) )
            return false;

        $output = 'html' === strtolower( $args['format'] ) ? $html : $src;

        $image_cache[$key] = $output;
        wp_cache_set( $args['post_id'], $image_cache, 'seoplan_get_image' );
    }
    // If image already cached
    else
    {
        $output = $image_cache[$key];
    }

    $output = apply_filters( 'seoplan_get_image', $output, $args );

    if ( ! $args['echo'] )
        return $output;

    echo $output;
}

/**
 * Get uploaded file information
 *
 * @param int   $file_id Attachment image ID (post ID). Required.
 * @param array $args    Array of arguments (for size).
 *
 * @return array|bool False if file not found. Array of image info on success
 */
function seoplan_file_info( $file_id, $args = array() )
{
    $args = wp_parse_args( $args, array(
        'size' => 'thumbnail',
    ) );

    $img_src = wp_get_attachment_image_src( $file_id, $args['size'] );
    if ( ! $img_src )
    {
        return false;
    }

    $attachment = get_post( $file_id );
    $path       = get_attached_file( $file_id );
    return array(
        'ID'          => $file_id,
        'name'        => basename( $path ),
        'path'        => $path,
        'url'         => $img_src[0],
        'width'       => $img_src[1],
        'height'      => $img_src[2],
        'full_url'    => wp_get_attachment_url( $file_id ),
        'title'       => $attachment->post_title,
        'caption'     => $attachment->post_excerpt,
        'description' => $attachment->post_content,
        'alt'         => get_post_meta( $file_id, '_wp_attachment_image_alt', true ),
    );
}
