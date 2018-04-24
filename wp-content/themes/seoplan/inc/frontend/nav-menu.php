<?php
/**
 * Customize nav menu
 */

/**
 * Add more nav menu items
 *
 * @since  1.0.0
 *
 * @param  $items string Items list
 * @param  $args object  Menu options
 *
 * @return string
 */
/**
 * Display numeric pagination
 *
 * @since 1.0
 * @return void
 */
function seoplan_numeric_pagination()
{
    global $wp_query;

    if( $wp_query->max_num_pages < 2 )
    {
        return;
    }

    ?>
    <nav class="navigation numeric-navigation" role="navigation">
        <?php
        $big = 999999999;
        $args = array(
            'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'mid_size'  =>  1,
            'end_size'  =>  0,
            'prev_next' => true,
            'prev_text' => '<i class="fa fa-long-arrow-left" aria-hidden="true"></i>',
            'next_text' => '<i class="fa fa-long-arrow-right" aria-hidden="true"></i>',
            'current'   => max( 1, get_query_var( 'paged' ) ),
            'type'      => 'list',
            'total'     => $wp_query->max_num_pages,
        );

        echo paginate_links( $args );
        ?>
    </nav>
    <?php
}