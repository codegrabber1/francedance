<?php
/**
 * Template part for displaying contact form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FranceDance
 */

?>

<article id="mainpage" <?php post_class(); ?>
         style="background-image: url(<?php echo get_the_post_thumbnail_url() ?>)">
    <div class="main_menu clearfix">
        <nav class="clearfix main-nav">
            <div class="container">
                <div class="row">
                    <div class="py-3 enter-block">
                        <div class="mobile-mnu d-md-none d-lg-none clearfix">
                            <a class="toggle-mnu d-lg-none" href="#">
                                <span></span>
                            </a>
                        </div>
		                <?php
		                wp_nav_menu( array(
			                'theme_location' => 'menu-1',
			                'menu_id'        => 'primary-menu',
			                'menu_class'     => 'sf-menu',
			                'container'      => 'ul',
			                'fallback_cb'    => '__return_empty_string',
			                'depth'          => 0
		                ) );
		                ?>
                    </div>
                </div></div>

        </nav>
    </div>
</article><!-- #post-<?php the_ID(); ?> -->
