<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package FranceDance
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'francedance' ); ?></a>
	<header id="masthead" class="site-header">
        <div class="header-logo">
            <?php if( mcw_get_option( 'mcw_logo_url' ) ):?>
                <img src="<?php echo mcw_get_option( 'mcw_logo_url' )?>" alt="<?php bloginfo('name')?>">	               <?php endif; ?>
        </div>
		<nav id="site-navigation" class="main-navigation">
            <div class="mobile-mnu d-md-none d-lg-none clearfix">
                <a class="toggle-mnu d-lg-none" href="#">
                    <span></span>
                </a>
            </div>
			<?php
			wp_nav_menu( array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'primary-menu',
				'menu_class'     => 'inline-menu',
				'container'      => 'ul',
			) );
			?>
		</nav>
	</header>

	<div id="content" class="site-content">
        <div class="wrapper">