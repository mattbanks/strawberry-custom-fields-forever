<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package _mbbasetheme
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', '_mbbasetheme' ),
				'after'  => '</div>',
			) );
		?>

		<?php
			// Display our custom data
			$phone_number = get_post_meta( $post->ID, '_cmb_phone_number', true );
			$email = get_post_meta( $post->ID, '_cmb_email', true );
		?>
		<h2>Phone Number:</h2>
		<p><?php echo $phone_number; ?></p>

		<h2>Email Addresses:</h2>
		<p><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></p>

	</div><!-- .entry-content -->
	<footer class="entry-footer">
		<?php edit_post_link( __( 'Edit', '_mbbasetheme' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
