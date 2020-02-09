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
<!--        <div class="wrrap">-->
            <?php
                $mainslider = new WP_Query( array ( 'post_type' => 'mainslider' ) );
                if( $mainslider->have_posts() ):
            ?>
            <div id="mainpage" class="owl-carousel">
                <?php
                    while( $mainslider->have_posts() ) : $mainslider->the_post();
                    the_post_thumbnail( 'full' );
                    //get_template_part( 'template-parts/content', 'main' );
                    endwhile;
                ?>
            </div>
            <?php
                endif; wp_reset_query();;
            ?>
            <div class="main_menu clearfix">
                <nav class="clearfix main-nav">
	                <div class="enter-block">
                        <div class="header-logo">
                            <p>
                                <?php if( mcw_get_option( 'mcw_logo_url' ) ):?>
                                    <img src="<?php echo mcw_get_option( 'mcw_logo_url' )?>" alt="<?php bloginfo('name')?>">
                                <?php endif; ?>
                            </p>
                        </div>
                        <div class="mobile-mnu d-lg-none clearfix">
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
                </nav>
            </div>
<!--        </div>-->
    </main><!-- #main -->
</div><!-- #primary -->
<?php
    get_footer('home');

