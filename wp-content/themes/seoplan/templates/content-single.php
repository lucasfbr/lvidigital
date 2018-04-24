<?php
/**
 * Output single post content
 */
?>
<article id="post-<?php get_the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <div class="post-info top">
            <div class="author-time">
                <span class="author">
                    <?php
                    $user_id = get_the_author_meta('ID');
                    $user_info = get_userdata( $user_id );
                    $name = sprintf( '%s %s', $user_info->first_name, $user_info->last_name );
                    $name = trim( $name );
                    $author_bio_avatar_size = apply_filters( 'seoplan_author_avatar_size', 42 );
                    if ( get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size ) )
                    {
                        echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
                    }
                    ?>
                    <?php
                    if ( ! empty( $name ) )
                    {
                        ?>
                        <span><?php esc_html_e( 'by', 'seoplan' ); ?></span>
                        <?php
                    }
                    ?>
                    <a class="author-name" href="<?php echo get_author_posts_url( $user_id ); ?>" title="<?php echo esc_attr( sprintf( __( 'View all posts of %s', 'seoplan' ), $name ) ); ?>" rel="author">
                        <?php echo esc_html( $name ); ?>
                    </a>
                </span>
                <span class="post-time">
                    <span class="icon"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
                    <span class="time"><?php esc_html_e( 'Posted', 'seoplan' ); ?> <?php echo get_the_date( 'M d, Y' ); ?></span>
                </span>
            </div>
            <h1 class="post-name head-title size-32"><?php the_title(); ?></h1>
            <ul class="post-share">
                <li>
                    <a class="facebook" href="<?php echo esc_url( sprintf( 'http://www.facebook.com/sharer.php?u=%s', get_the_permalink() ) ); ?>" title="<?php echo esc_attr( 'Facebook', 'seoplan' ); ?>" target="_blank">
                        <i class="fa fa-facebook" aria-hidden="true"></i>
                    </a>
                </li>
                <li>
                    <a class="twitter" href="<?php echo esc_url( sprintf( 'http://twitter.com/home/?status=%s - %s', get_the_title(), get_the_permalink() ) ); ?>" title="<?php echo esc_attr( 'Twitter', 'seoplan' ); ?>">
                        <i class="fa fa-twitter" aria-hidden="true"></i>
                    </a>
                </li>
                <li>
                    <a class="google-plus" href="<?php echo esc_url( sprintf( 'https://plus.google.com/share?url=%s', get_the_permalink() ) ); ?>" title="<?php echo esc_attr( 'Google Plus', 'seoplan' ); ?>" onclick="javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
                        <i class="fa fa-google-plus" aria-hidden="true"></i>
                    </a>
                </li>
                <li>
                    <a class="pinterest" href="<?php echo esc_url( sprintf( 'http://pinterest.com/pin/create/button/?url=%s', get_the_permalink() ) ); ?>" target="_blank">
                        <i class="fa fa-pinterest" aria-hidden="true"></i>
                    </a>
                </li>
            </ul>
        </div>
    <?php
    $layout = seoplan_get_layout();
    $size = 'seoplan-blog-single-thumbnail-1';
    $related_posts_show = 3;
    if ( $layout && ( 'left-sidebar' == $layout || 'right-sidebar' == $layout ) )
    {
        $size = 'seoplan-blog-single-thumbnail-2';
        $related_posts_show = 2;
    }
    $args = array(
        'size' => $size,
    );
    if ( 'video' == get_post_format() )
    {
        $args['video_height'] = 520;
    }
    seoplan_post_thumbnail( $args );
    ?>
    </header>
    <div class="post-content clearfix">
        <?php the_content(); ?>
    </div>
    <?php
    wp_link_pages( array(
        'before' => '<div class="page-links"><label>' . esc_html__( 'Pages:', 'seoplan' ) . '</label>',
        'after'  => '</div>'
    ) );
    ?>
    <div class="post-info bottom">
        <?php
        $tags = get_the_tags();
        $count = 0;
        $tag_ids = array();
        $comment_count = get_comments_number();
        ?>
        <?php
        if ( ! empty( $tags ) || ( comments_open() && $comment_count > 0 )  )
        {
        ?>
            <div class="tag-comment">
                <ul class="tags">
                <?php
                if ( ! empty( $tags ) )
                {
                    foreach ( $tags as $tag )
                    {
                        $seperator = ', ';
                        $tag_ids[] = $tag->term_id;
                        ?>
                        <li>
                            <a href="<?php echo esc_url( get_category_link( $tag->term_id ) ); ?>" title="<?php echo esc_html( $tag->name );?>"><?php echo esc_html( $tag->name );?></a>
                        </li>
                        <?php
                    }
                }
                ?>
                </ul>
                <span class="post-comment">
                <span class="icon"><i class="ti-comment-alt"></i></span>
                <span>
                <?php
                if ( comments_open() )
                {
                    if ( $comment_count == 0 )
                    {
                        esc_html_e( 'No Comments', 'seoplan' );
                    }
                    elseif ( $comment_count > 1 )
                    {
                        echo esc_html( $comment_count ) . esc_html__( ' Comments', 'seoplan' );
                    }
                    else
                    {
                        esc_html_e( '1 Comment', 'seoplan' );
                    }
                }
                ?>
                </span>
            </span>
            </div>
        <?php
        }
        ?>
    </div> <!-- end .post-info.bottom -->
    <div class="toolbar row">
        <?php
        $next_post = get_next_post();
        $prev_post = get_previous_post();
        if ( ! empty( $prev_post ) )
        {
            ?>
            <div class="col-xs-6 prev-post">
                <a href="<?php echo get_permalink( $prev_post->ID ); ?>"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> <?php esc_html_e( 'Prev Post', 'seoplan' ); ?></a>
                <h4><?php echo esc_html( $prev_post->post_title ); ?></h4>
            </div>
            <?php
        }
        if ( ! empty( $next_post ) )
        {
            ?>
            <div class="col-xs-6 next-post">
                <a href="<?php echo get_permalink( $next_post->ID ); ?>"><?php esc_html_e( 'Next Post', 'seoplan' ); ?> <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                <h4><?php echo esc_html( $next_post->post_title ); ?></h4>
            </div>
            <?php
        }
        ?>

    </div><!-- end .toolbar -->
    <?php
    if ( ! empty( $tag_ids ) )
    {
    ?>
        <div class="related-post type2">
            <div class="blog-list">
            <?php
                $args = array(
                    'tag__in' => $tag_ids,
                    'post__not_in' => array(get_the_ID()),
                    'posts_per_page' => $related_posts_show
                );
                $my_query = new WP_Query($args);

                if ($my_query->have_posts()) {
                    ?>
                    <div class="title-wrap">
                        <h2 class="head-title"><?php esc_html_e('You May Also Like...', 'seoplan'); ?></h2>
                        <span class="line"></span>
                    </div>
                    <?php
                    set_query_var('in_element', 'related_posts');
                    ?>
                    <div class="row">
                        <?php
                        while ($my_query->have_posts()) : $my_query->the_post();
                            get_template_part('templates/content', 'related');
                        endwhile;
                        ?>
                    </div>
                    <?php
                }
                wp_reset_query();
            ?>
            </div>
        </div>
    <?php
    }
    ?>
</article>

