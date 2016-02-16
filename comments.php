<?php
/*
	The template for displaying Comments.
*/
?>
	<div id="comments">
	<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'nona' ); ?></p>
	</div><!-- #comments -->
	<?php
			/* Stop the rest of comments.php from being processed,
			 * but don't kill the script entirely -- we still have
			 * to fully load the template.
			 */
			return;
		endif;

	// If comments are closed and there are no comments, let's leave a little note, shall we?
	if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="nocomments"><?php _e( 'Comments are closed.', 'nona' ); ?></p>
	<?php endif; ?>

	<?php /*
		Output the comment form :
		- - - - - - - - - - - - - - - - -
		parse in the comment arguments to alter the output
		http://codex.wordpress.org/Function_Reference/comment_form
	*/
	comment_form(); ?>

	<?php if ( have_comments() ) : ?>
		<h5 id="comments-title">
			<?php
				printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'nona' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h5>

		<ol class="commentlist">
			<?php
				/*
					Display The Comments
					- - - - - - - - - - - - - - - - - - -
					Loop through and list the comments. Tell wp_list_comments() to use nona_comment()
					to format the comments. If you want to overload this in a child theme then you can
					define nona_comment() and that will be used instead.

				 	See nona_comment() in functionsl/nona-comments.php for more.
				 	http://codex.wordpress.org/Function_Reference/wp_list_comments
				 */
				wp_list_comments( array( 'callback' => 'nona_comment' ) );
			?>
		</ol>

		<!-- Paginate Comments -->
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav id="comment-nav-below">
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'nona' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'nona' ) ); ?></div>
		</nav>
		<?php endif; ?>

	<?php endif; // have_comments() ?>

</div><!-- #comments -->
