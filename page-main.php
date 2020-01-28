<?php
/**
 * Template Name: Main page
 * Template post type: post, page
 * Description: A page Template to display content on the main page.
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
            <div id="mainpage" class="owl-carousel">
                <?php
                    while ( have_posts() ) :
                        the_post();

                        get_template_part( 'template-parts/content', 'main' );

                    endwhile; // End of the loop.
                ?>
            </div>
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
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </main><!-- #main -->
</div><!-- #primary -->
<?php
    //get_sidebar();
    get_footer('home');
