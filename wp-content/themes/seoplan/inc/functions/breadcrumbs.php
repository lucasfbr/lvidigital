<?php
/**
 * Display breadcrumbs for posts, pages, archive page with the microdata that search engines understand
 *
 * @see http://support.google.com/webmasters/bin/answer.py?hl=en&answer=185417
 *
 * @param array|string $args
 *
 * @return void
 */
function seoplan_breadcrumbs( $args = '' )
{
	if ( is_front_page() )
		return;

	$args = wp_parse_args( $args, array(
		'separator'         => '&rsaquo;',
		'home_label'        => esc_html__( 'Home', 'seoplan' ),
		'home_class'        => 'home',
		'before'            => '<span class="before">' . esc_html__( 'You are here: ', 'seoplan' ) . '</span>',
		'before_item'       => '',
		'after_item'        => '',
		'taxonomy'          => 'category',
		'display_last_item' => true,
	) );

	$args = apply_filters( 'seoplan_breadcrumbs_args', $args );

	$items = array();

	// HTML template for each item
	$item_tpl = $args['before_item'] . '
		<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
			<a href="%s" itemprop="url"><span itemprop="title">%s</span></a>
		</span>
	' . $args['after_item'];
	$item_text_tpl = $args['before_item'] . '
		<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
			<span itemprop="title">%s</span>
		</span>
	' . $args['after_item'];

	// Home
	if ( ! $args['home_class'] )
	{
		$items[] = sprintf( $item_tpl, esc_url( home_url() ), $args['home_label'] );
	}
	else
	{
		$items[] = $args['before_item'] . sprintf(
			'<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
				<a class="%s" href="%s" itemprop="url"><span itemprop="title">%s</span></a>
			</span>' . $args['after_item'],
			esc_attr( $args['home_class'] ),
			esc_url( home_url() ),
			$args['home_label']
		);
	}

	if ( is_home() )
	{
		// Do nothing
	}
	elseif ( is_singular() )
	{

	    if ( is_singular( 'case_study' ) )
        {
            $args['taxonomy'] = 'case_study_category';
        }
        // Terms
        $terms   = get_the_terms( get_the_ID(), $args['taxonomy'] );
        if ( $terms )
        {
            $term    = current( $terms );
            $terms   = seoplan_get_term_parents( $term->term_id, $args['taxonomy'] );
            $terms[] = $term->term_id;
            foreach ( $terms as $term_id )
            {
                $term    = get_term( $term_id, $args['taxonomy'] );
                $items[] = sprintf( $item_tpl, get_term_link( $term, $args['taxonomy'] ), $term->name );
            }
            if ( $args['display_last_item'] )
                $items[] = sprintf( $item_text_tpl, get_the_title() );
        }
	}
	elseif ( is_page() )
	{
		$pages = seoplan_get_post_parents( get_queried_object_id() );
		foreach ( $pages as $page )
		{
			$items[] = sprintf( $item_tpl, get_permalink( $page ), get_the_title( $page ) );
		}
		if ( $args['display_last_item'] )
			$items[] = sprintf( $item_text_tpl, get_the_title() );
	}
	elseif ( is_tax() || is_category() || is_tag() )
	{
		$current_term = get_queried_object();
		$terms        = seoplan_get_term_parents( get_queried_object_id(), $current_term->taxonomy );
		foreach ( $terms as $term_id )
		{
			$term    = get_term( $term_id, $current_term->taxonomy );
			$items[] = sprintf( $item_tpl, get_category_link( $term_id ), $term->name );
		}
		if ( $args['display_last_item'] )
			$items[] = sprintf( $item_text_tpl, $current_term->name );
	}
	elseif ( is_search() )
	{
		$items[] = sprintf( $item_text_tpl, sprintf( esc_html__( 'Search results for &quot;%s&quot;', 'seoplan' ), get_search_query() ) );
	}
	elseif ( is_404() )
	{
		$items[] = sprintf( $item_text_tpl, esc_html__( 'Not Found', 'seoplan' ) );
	}
	elseif ( is_author() )
	{
		// Queue the first post, that way we know what author we're dealing with (if that is the case).
		the_post();
		$items[] = sprintf(
			$item_text_tpl,
			sprintf(
				esc_html__( 'Author Archives: %s', 'seoplan' ),
				'<span class="vcard"><a class="url fn n" href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>'
			)
		);
		rewind_posts();
	}
	elseif ( is_day() )
	{
		$items[] = sprintf(
			$item_text_tpl,
			sprintf( esc_html__( 'Daily Archives: %s', 'seoplan' ), get_the_date() )
		);
	}
	elseif ( is_month() )
	{
		$items[] = sprintf(
			$item_text_tpl,
			sprintf( esc_html__( 'Monthly Archives: %s', 'seoplan' ), get_the_date( 'F Y' ) )
		);
	}
	elseif ( is_year() )
	{
		$items[] = sprintf(
			$item_text_tpl,
			sprintf( esc_html__( 'Yearly Archives: %s', 'seoplan' ), get_the_date( 'Y' ) )
		);
	}
	else
	{
		$items[] = sprintf(
			$item_text_tpl,
			sprintf( esc_html__( 'Archives', 'seoplan' ) )
		);
	}

	echo $args['before'] . implode( $args['separator'], $items );
}

/**
 * Searches for term parents' IDs of hierarchical taxonomies, including current term.
 * This function is similar to the WordPress function get_category_parents() but handles any type of taxonomy.
 * Modified from Hybrid Framework
 *
 * @param int|string    $term_id  The term ID
 * @param object|string $taxonomy The taxonomy of the term whose parents we want.
 *
 * @return array Array of parent terms' IDs.
 */
function seoplan_get_term_parents( $term_id = '', $taxonomy = 'category' )
{
	// Set up some default arrays.
	$list = array();

	// If no term ID or taxonomy is given, return an empty array.
	if ( empty( $term_id ) || empty( $taxonomy ) )
	{
		return $list;
	}

	do
	{
		$list[] = $term_id;

		// Get next parent term
		$term    = get_term( $term_id, $taxonomy );
		$term_id = $term->parent;
	} while ( $term_id );

	// Reverse the array to put them in the proper order for the trail.
	$list = array_reverse( $list );
	array_pop( $list );

	return $list;
}

/**
 * Gets parent posts' IDs of any post type, include current post
 * Modified from Hybrid Framework
 *
 * @param int|string $post_id ID of the post whose parents we want.
 *
 * @return array Array of parent posts' IDs.
 */
function seoplan_get_post_parents( $post_id = '' )
{
	// Set up some default array.
	$list = array();

	// If no post ID is given, return an empty array.
	if ( empty( $post_id ) )
	{
		return $list;
	}

	do
	{
		$list[] = $post_id;

		// Get next parent post
		$post    = get_post( $post_id );
		$post_id = $post->post_parent;
	}
	while ( $post_id );

	// Reverse the array to put them in the proper order for the trail.
	$list = array_reverse( $list );
	array_pop( $list );

	return $list;
}
