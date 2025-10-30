<?php
/**
 * Theme header.
 *
 * @package Postali Child
 * @author Postali LLC
**/
?><!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-M2W74N2');</script>
<!-- End Google Tag Manager -->

<!-- Add JSON Schema here -->
<?php 
// Global Schema
$global_schema = get_field('global_schema', 'options');
if ( !empty($global_schema) ) :
    echo '<script type="application/ld+json">' . $global_schema . '</script>';
endif;

// Single Page Schema
$single_schema = get_field('single_schema');
if ( !empty($single_schema) ) :
    echo '<script type="application/ld+json">' . $single_schema . '</script>';
endif; ?>

<!-- Preload banner -->
<?php if( is_front_page() ) : ?>
<link rel="preload" as="image" href="/wp-content/uploads/2022/12/header-homepage-scaled.jpg.webp">
<?php endif; ?>
<!-- /Preload banner -->


<!-- preload fonts -->
<!-- <link rel="preload" as="font" type="font/woff" href="/wp-content/themes/postali-child/assets/fonts/lato/lato-regular-webfont.woff" crossorigin>
<link rel="preload" as="font" type="font/woff" href="/wp-content/themes/postali-child/assets/fonts/lato/lato-regular-webfont.woff2" crossorigin>
<link rel="preload" as="font" type="font/woff" href="/wp-content/themes/postali-child/assets/fonts/lato/lato-bold-webfont.woff" crossorigin>
<link rel="preload" as="font" type="font/woff" href="/wp-content/themes/postali-child/assets/fonts/lato/lato-bold-webfont.woff2" crossorigin>
<link rel="preload" as="font" type="font/woff" href="/wp-content/themes/postali-child/assets/fonts/lato/lato-black-webfont.woff" crossorigin>
<link rel="preload" as="font" type="font/woff" href="/wp-content/themes/postali-child/assets/fonts/lato/lato-black-webfont.woff2" crossorigin>

<link rel="preload" as="font" type="font/woff" href="/wp-content/themes/postali-child/assets/fonts/lexend/lexend-bold-webfont.woff" crossorigin>
<link rel="preload" as="font" type="font/woff" href="/wp-content/themes/postali-child/assets/fonts/lexend/lexend-bold-webfont.woff2" crossorigin>

<link rel="preload" as="font" type="font/woff" href="/wp-content/themes/postali-child/assets/fonts/merriweather/merriweather-bolditalic-webfont.woff" crossorigin>
<link rel="preload" as="font" type="font/woff" href="/wp-content/themes/postali-child/assets/fonts/merriweather/merriweather-bolditalic-webfont.woff2" crossorigin> -->
<!-- /preload fonts -->

<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M2W74N2"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	<a class="skip-link" href='#main-content'>Skip to Main Content</a>
	<header>
		<div class="utility-bar">
			<div class="link-wrapper">
				<?php if( have_rows('social_media_platforms', 'options') ) : 
					while( have_rows('social_media_platforms', 'options') ) : 
						the_row(); 
						$social = get_sub_field('social_media'); 
						?>
						<a href="<?php _e( $social['url'] ); ?>" target="_blank" aria-label="follow us on <?php _e( $social['title'] ); ?>" title="follow us on <?php _e( $social['title'] ); ?>" class="social-icon social-icon_<?php _e( strtolower($social['title']) ); ?>"></a>
					<?php endwhile;
				endif; 
				$blog_link = get_field('blog_link', 'options'); 
				$areas_served_link = get_field('areas_served_link', 'options'); ?>
				<a class="single-nav-link" aria-label="read our <?php _e($blog_link['title']); ?>" title="read our <?php _e($blog_link['title']); ?>" href="<?php _e( $blog_link['link'] ); ?>"><?php _e( $blog_link['title']); ?></a>
				<a class="single-nav-link" aria-label="learn about the areas we serve" title="learn about the areas we serve" href="<?php _e( $areas_served_link['link'] ); ?>"><?php _e( $areas_served_link['title']); ?></a>
			</div>
			<form class="navbar-form-search" role="search" method="get" action="/">
				<div class="search-form-container hdn" id="search-input-container">
					<div class="search-input-group">
						<div class="form-group">
						<input type="text" name="s" placeholder="Search for..." id="search-input-5cab7fd94d469" value="" class="form-control">
						</div>
					</div>
				</div>
				<button type="submit" class="btn btn-search" id="search-button" title="search button"><span class="icon-magnifying-glass" aria-hidden="true"></span></button>
			</form>	
		</div>
		<div id="header-top">
			<div class="background-fill"></div>
			<div id="header-top_left">
				<?php get_template_part('block', 'site-logo'); ?>
			</div>
			
			<div id="header-top_right">
				<div id="header-top_menu">
						<?php
							$args = array(
								'container' => false,
								'theme_location' => 'header-nav'
							);
							wp_nav_menu( $args );
						?>			
					<div id="header-top_mobile">
						<div id="menu-icon" class="toggle-nav">
							<span class="line line-1"></span>
							<span class="line line-2"></span>
							<span class="line line-3"></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
