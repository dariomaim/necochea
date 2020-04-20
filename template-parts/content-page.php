<?php
/**
* Template part for displaying page content in page.php
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
*
* @package necochea
*/

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('content'); ?>>
	<?php the_title( '<h1 class="content__title">', '</h1>' ); ?>

	<?php necochea_post_thumbnail(); ?>

	<div class="content__body">
		<?php
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'necochea' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .content__body -->
</article><!-- .content -->
