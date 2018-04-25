<?php
/**
 * Get posts
 * @param $atts array arguments settings
 */
function seoplan_get_posts( $atts )
{
    $query_args = array(
        'orderby' => $atts['order_by'],
        'order' => $atts['order'],
        'posts_per_page' => $atts['per_page'],
        'post_type' => 'post',
        'ignore_sticky_posts' => true,
    );

    if ( ! empty( $atts['category'] ) )
    {
        $query_args['category_name'] = $atts['category'];
    }

    ob_start();

    $query = new WP_Query($query_args);

    while ($query->have_posts()) : $query->the_post();

        get_template_part( 'templates/content', 'standard' );

    endwhile;

    wp_reset_postdata();

    $output = ob_get_clean();

    return $output;
}

/**
 * Get post categories
 *
 * @return array|string
 */
function seoplan_get_post_categories( $taxonomy = 'category' )
{
    $cats[__( 'All', 'pika' )] = '';
    $categories = get_terms( $taxonomy );
    if( $categories  )
    {
        foreach ( $categories as $category )
        {
            $cats[$category->name] = $category->slug;
        }
    }
    return $cats;
}

/**
 * Function gets testimonials
 * @param $args array argument attributes
 * @return $output string list testimonials
 */
function seoplan_get_testimonials( $atts )
{

    $args = array(
        'post_type'             =>  'seoplan_testimonial',
        'post_status'           => 'publish',
        'ignore_sticky_posts'   => 1,
        'posts_per_page'        => $atts['per_page']
    );

    if ( $atts['category'] )
    {
        $args['tax_query'] =  array(
            array(
                'taxonomy' => 'seoplan_testimonial_category',
                'terms'    => $atts['category'],
                'field'    => 'slug',
            )
        );
    }
    $paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
    $args['paged'] = $paged;
    ob_start();
    $testimonials = new WP_Query( $args );
    if ( $testimonials->have_posts() )
    {

        while ($testimonials->have_posts()) : $testimonials->the_post();
            if ( 'two_cols' == $atts['layout'] )
            {
                get_template_part( 'templates/testimonial/content' );
            }
            else
            {
                get_template_part( 'templates/testimonial/content', '2' );
            }
        endwhile;

    }

    wp_reset_postdata();

    $output = ob_get_clean();
    return $output;
}

/**
 * Function get list all case studies categories
 * @return array $cats
 */
function seoplan_get_list_case_study_categories()
{
    $terms = seoplan_get_case_study_categories();
    $cats[__( 'All', 'seoplan' )] = '';
    foreach ( $terms as $term )
    {
        $term_name = sprintf( '##%s##  %s', $term->term_id, $term->name );
        $cats[ $term_name ] = $term->slug;
    }
    return $cats;
}

/**
 * Function get all testimonials categories
 * @return $term Term quots terms
 */
function seoplan_get_case_study_categories()
{
    $terms = get_terms(  array(
        'taxonomy'      =>  'case_study_category',
        'hide_empty'    =>  true,
        'orderby'       =>  'term_id',
        'order'         => 'DESC'
    ) );
    return $terms;
}

/**
 * Function get list all testimonials categories
 * @return array $cats
 */
function seoplan_get_list_testimonial_categories()
{
    $terms = seoplan_get_testimonial_categories();
    $cats[__( 'All', 'seoplan' )] = '';
    foreach ( $terms as $term )
    {
        $term_name = sprintf( '##%s##  %s', $term->term_id, $term->name );
        $cats[ $term_name ] = $term->slug;
    }
    return $cats;
}

/**
 * Function get all testimonials categories
 * @return $term Term quots terms
 */
function seoplan_get_testimonial_categories()
{
    $terms = get_terms(  array(
        'taxonomy'      =>  'seoplan_testimonial_category',
        'hide_empty'    =>  true,
        'orderby'       =>  'term_id',
        'order'         => 'DESC'
    ) );
    return $terms;
}

/**
 * Function gets list case studies
 * @param $args array argument attributes
 * @return $output string list case studies
 */
function seoplan_get_list_case_studies( $atts )
{
    global $case_study_loop;

    $args = array(
        'post_type'             =>  'case_study',
        'post_status'           => 'publish',
        'ignore_sticky_posts'   => 1,
        'posts_per_page'        => $atts['per_page']
    );

    if ( $atts['category'] )
    {
        $args['tax_query'] =  array(
            array(
                'taxonomy' => 'case_study_category',
                'terms'    => $atts['category'],
                'field'    => 'slug',
            )
        );
    }
    $args['orderby'] = $atts['orderby'];
    $args['order']   = $atts['order'];

    $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
    $args['paged'] = $paged;
    ob_start();
    $case_studies = new WP_Query( $args );
    $case_study_loop['columns'] = $atts['columns'];

    if ( $case_studies->have_posts() )
    {

        while ($case_studies->have_posts()) : $case_studies->the_post();
            get_template_part('templates/case-study/content', 'standard');
        endwhile;

    }

    wp_reset_postdata();

    $output = ob_get_clean();
    return $output;
}

/**
 * Function gets case studies
 * @param $args array argument attributes
 * @return $output string list case studies
 */
function seoplan_get_case_studies( $atts )
{
    global $case_study_loop;

    $args = array(
        'post_type'             =>  'case_study',
        'post_status'           => 'publish',
        'ignore_sticky_posts'   => 1,
        'posts_per_page'        => $atts['per_page']
    );

    if( is_single( get_the_ID() ) )
    {
        $args['post__not_in'] = array( get_the_ID() );
    }
    if ( isset( $atts['category'] ) && $atts['category'] )
    {
        $args['tax_query'] =  array(
            array(
                'taxonomy' => 'case_study_category',
                'terms'    => $atts['category'],
                'field'    => 'slug',
            )
        );
    }

    $args['orderby'] = $atts['orderby'];
    $args['order']   = $atts['order'];

    $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
    $args['paged'] = $paged;
    ob_start();
    $case_studies = new WP_Query( $args );
    $case_study_loop['columns'] = $atts['columns'];

    if ( $case_studies->have_posts() )
    {
        while ($case_studies->have_posts()) : $case_studies->the_post();
            get_template_part('templates/case-study/content', 'case_study');
        endwhile;

        ?>
        <div class="col-xs-12">
            <div class="pager">
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
                    'total'     => $case_studies->max_num_pages,
                );

                echo paginate_links( $args );
                ?>
            </div>
        </div>
        <?php
    }

    wp_reset_postdata();

    $output = ob_get_clean();
    return $output;
}