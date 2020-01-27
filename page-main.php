<?php
/**
 * Template Name: Main Page
 * Template post type: post, page
 * Description: A page Template to display content on the maim page.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FranceDance
 * @file    page-main.php
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

                get_template_part( 'template-parts/content', 'main' );

            endwhile; // End of the loop.
            ?>
        </div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
