<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Seo Plan
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	$args = array(
		'size' => 'seoplan-blog-thumbnail',
		'echo'	=>	false
	);
	$post_thumbnail = seoplan_post_thumbnail( $args );
	$show_post_view = seoplan_get_option( 'general_display_count_post_view' );
	$post_id = get_the_ID();
	$post_view = get_post_meta( $post_id, '_seoplan_count_post_view', true ) ? get_post_meta( $post_id, '_seoplan_count_post_view', true ) : 0;
	if ( ! empty( $post_thumbnail ) )
	{
	?>
	<header class="entry-header <?php echo get_post_format() ? get_post_format() : 'standard'; ?>">
		<?php
		echo sprintf( '<div class="entry-format entry-%s">%s</div>', get_post_format(), $post_thumbnail );
		?>
		<a href="<?php echo get_the_permalink(); ?>" class="view-more"><i class="fa fa-plus" aria-hidden="true"></i></a>
		<?php
		if	( $show_post_view )
		{
			?>
			<span class="post-view"><i class="fa fa-eye" aria-hidden="true"></i> <?php echo $post_view; ?></span>
			<?php
		}
		?>

	</header><!-- .entry-header -->
	<?php
	}
	?>
	<div class="post-info">
		<span class="author">
			<?php
			$user_id = get_the_author_meta('ID');
			$user_info = get_userdata( $user_id );
			$name = sprintf( '%s %s', $user_info->first_name, $user_info->last_name );
			$name = trim( $name );
			$author_bio_avatar_size = apply_filters( 'seoplan_author_avatar_size', 22 );
			echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
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
	<div class="entry-content">
		<h3 class="entry-title">
			<a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a>
		</h3>
		<?php
			the_excerpt();
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php //mytheme_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
