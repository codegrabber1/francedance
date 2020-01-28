<?php
/**
 * Template Name: Contact
 * Template post type: post, page
 * Description: A page Template to display content on the maim page.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FranceDance
 * @file    page-contact.php
 * @author  codegrabber <[makecodework@gmail.com]>
 */

get_header();
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
        <div class="wrrap">
            <?php
            while ( have_posts() ) :
                the_post();

                get_template_part( 'template-parts/content', 'contact' );

            endwhile; // End of the loop.
            ?>
        </div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
