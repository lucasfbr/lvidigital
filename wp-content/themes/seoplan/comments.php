<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Seo Plan
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
		<h3 class="head-title size-36">
			<?php esc_html_e( 'Comments ', 'seoplan' );?><span><?php printf( '(%s)', number_format_i18n( get_comments_number() ) ); ?></span>
		</h3>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'seoplan' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'seoplan' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'seoplan' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

		<ol class="comment-list">
		<?php
		wp_list_comments( array(
			'type'			=>	'comment',
			'avatar_size'	=> 60,
			'callback'		=>	'seoplan_comments',
		) );
		?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'seoplan' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'seoplan' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'seoplan' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php
		endif; // Check for comment navigation.

	endif; // Check for have_comments().


	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'seoplan' ); ?></p>
	<?php
	endif;

	$args = array(
		'title_reply'   => esc_html__( 'Post A Comment', 'seoplan' ),
		'label_submit'  => esc_html__( 'Send Comment', 'seoplan' ),
		'comment_notes_before'	=>	'',
		'comment_notes_after'	=>	'',
		'class_submit'	=>	'btn animation-bottom',
		'fields'               => array(
			'comment_field'	=>	'<div class="row"><div class="col-md-12 col-sm-12 comment-form-comment"><textarea id="comment" name="comment" placeholder="' . esc_html__( 'COMMENT', 'seoplan' ) . '" aria-required="true"></textarea></div></div>',
			'author' => '<div class="row"><div class="col-xs-4">' . '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" placeholder="' . esc_html__( 'YOUR NAME', 'seoplan' ) . '" aria-required="true" required/></div>',
			'email'	=>	'<div class="col-md-4">' . '<input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" placeholder="' . esc_html__( 'YOUR EMAIL', 'seoplan' ) . '" aria-required="true" required /></div>',
			'url'	=>	'<div class="col-md-4">' . '<input id="url" name="url" type="text" value="' . esc_attr(  $commenter['comment_author_url'] ) . '" size="30" placeholder="' . esc_html__( 'YOUR WEBSITE', 'seoplan' ) . '" /></div></div>',
		),
		'comment_field'	=>	'<div class="row"><div class="col-md-12 xol-sm-12 comment-form-comment"><textarea id="comment" name="comment" placeholder="' . esc_html__( 'Comment', 'seoplan' ) . '" aria-required="true"></textarea></div></div>',
	);
	if ( ! is_user_logged_in() )
	{
		$args['comment_field'] = '';
	}
	?>
	<div class="form-comment"><?php comment_form( $args );?></div>

</div><!-- #comments -->
