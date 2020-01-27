<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FranceDance
 */

?>

<article id="mainpage" <?php post_class(); ?>
         style="background-image: url(<?php echo get_the_post_thumbnail_url() ?>)">
    <div class="main_menu clearfix">
        <?php if( !is_home()):?>
        <nav id="site-navigation" class="main-navigation">
            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'francedance' ); ?></button>
            <?php
            wp_nav_menu( array(
                'theme_location' => 'menu-1',
                'menu_id'        => 'primary-menu',
            ) );
            ?>
        </nav>
        <?php endif; wp_reset_query();?>
    </div>

</article><!-- #post-<?php the_ID(); ?> -->
