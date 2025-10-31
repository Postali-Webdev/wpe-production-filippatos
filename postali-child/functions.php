<?php
/**
 * Theme functions.
 *
 * @package Postali Child
 * @author Postali LLC
 */
	require_once dirname( __FILE__ ) . '/includes/admin.php';
	require_once dirname( __FILE__ ) . '/includes/utility.php';
    require_once dirname( __FILE__ ) . '/includes/video-library-cpt.php'; // Custom Post Type video library
	require_once dirname( __FILE__ ) . '/includes/case-results-cpt.php'; // Custom Post Type Case Results
	require_once dirname( __FILE__ ) . '/includes/testimonials-cpt.php'; // Custom Post Type Testimonials
    require_once dirname( __FILE__ ) . '/includes/media-mentions-cpt.php'; // Custom Post Type Media Mentions
    require_once dirname( __FILE__ ) . '/includes/job-postings-cpt.php'; // Custom Post Type Media Mentions
	require_once dirname( __FILE__ ) . '/includes/attorneys-cpt.php'; // Custom Post Type Attorneys
	//require_once dirname( __FILE__ ) . '/includes/social-share.php'; // Social Media Sharing

	// Global ACF Options
	$vanity_phone_number = get_field('vanity_phone_number', 'options');
	$actual_phone_number = get_field('actual_phone_number', 'options');
	
	// Global Functions
	function readable_phone_numb( $number ) {
		if(  preg_match( '/^(\d{3})(\d{3})(\d{4})$/', $number,  $matches ) ) {
			return '(' .  $matches[1] . ') ' .$matches[2] . '-' . $matches[3];
		}
	}

	function accessible_phone_numb( $number ) {
		if(  preg_match( '/^(\d{3})(\d{3})(\d{4})$/', $number,  $matches ) ) {
			return $matches[1] . '.' .$matches[2] . '.' . $matches[3];
		}
	}

	add_action('wp_enqueue_scripts', 'postali_parent');
	function postali_parent() {
		wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/assets/css/styles.css' ); // Enqueue parent theme styles
	
	}  

	add_action('wp_enqueue_scripts', 'postali_child');
	function postali_child() {

		wp_enqueue_style( 'child-styles', get_stylesheet_directory_uri() . '/style.css' ); // Enqueue Child theme style sheet (theme info)
		wp_enqueue_style( 'styles', get_stylesheet_directory_uri() . '/assets/css/styles.css'); // Enqueue child theme styles.css
		wp_enqueue_style( 'slick-css', get_stylesheet_directory_uri() . '/assets/css/slick.css'); // Enqueue child theme styles.css
		
		// Compiled .js using Grunt.js
		wp_register_script('custom-scripts', get_stylesheet_directory_uri() . '/assets/js/scripts.min.js',array('jquery'), null, true); 
		wp_enqueue_script('custom-scripts');

		wp_register_script('isotope-script', get_stylesheet_directory_uri() . '/assets/js/lib/isotope.pkgd.min.js',array('jquery'), null, true); 
		wp_enqueue_script('isotope-script');
	
		wp_register_script('nodefer-script', get_stylesheet_directory_uri() . '/assets/js/nodefer-scripts.min.js',array('jquery'), null, true); 
		wp_enqueue_script('nodefer-script');

		wp_register_script('slick-slider', get_stylesheet_directory_uri() . '/assets/js/slick.min.js',array('jquery'), null, true); 
		wp_enqueue_script('slick-slider');

		wp_register_script('slick-custom', get_stylesheet_directory_uri() . '/assets/js/slick-custom.min.js',array('jquery'), null, true); 
		wp_enqueue_script('slick-custom');
		
		wp_register_script('lity-script', get_stylesheet_directory_uri() . '/assets/js/lity.min.js',array('jquery'), null, true); 
		wp_enqueue_script('lity-script');

		// initialize ajax scripts   page-results-reviews.php
		if ( is_page_template('page-results-reviews.php') ) {
			wp_register_script( 'ajax-script', get_stylesheet_directory_uri() . '/assets/js/ajax-scripts.min.js', array('jquery') );
			wp_localize_script( 'ajax-script', 'ajax_filter_results_reviews', array('ajaxurl' => admin_url( 'admin-ajax.php' )));
			wp_enqueue_script( 'ajax-script' );
		}
	}

    // gravity forms homepage jump
    add_filter(  'gform_confirmation_anchor' ,  '__return_false' );

	// Register Site Navigations
	function postali_child_register_nav_menus() {
		register_nav_menus(
			array(
				'header-nav' => __( 'Header Navigation', 'postali' ),
				'footer-nav' => __( 'Footer Navigation', 'postali' ),
				'footer-resources' => __( 'Footer Resources', 'postali' ),

			)
		);
	}
	add_action( 'init', 'postali_child_register_nav_menus' );

	// Add Custom Logo Support
	add_theme_support( 'custom-logo' );

	function postali_custom_logo_setup() {
		$defaults = array(
			'flex-height' => true,
			'flex-width'  => true,
			'header-text' => array( 'site-title', 'site-description' ),
		);
		add_theme_support( 'custom-logo', $defaults );
	}
	add_action( 'after_setup_theme', 'postali_custom_logo_setup' );

	// ACF Options Pages
	if( function_exists('acf_add_options_page') ) {
		
		acf_add_options_page(array(
			'page_title'    => 'Instructions',
			'menu_title'    => 'Instructions',
			'menu_slug'     => 'theme-instructions',
			'capability'    => 'edit_posts',
			'icon_url'      => 'dashicons-smiley', // Add this line and replace the second inverted commas with class of the icon you like
			'redirect'      => false
		));

		acf_add_options_page(array(
			'page_title'    => 'Global Settings',
			'menu_title'    => 'Global Settings',
			'menu_slug'     => 'global-settings',
			'capability'    => 'edit_posts',
			'icon_url'      => 'dashicons-admin-site', // Add this line and replace the second inverted commas with class of the icon you like
			'redirect'      => false
		));

		acf_add_options_page(array(
			'page_title'    => 'Awards',
			'menu_title'    => 'Awards',
			'menu_slug'     => 'awards',
			'capability'    => 'edit_posts',
			'icon_url'      => 'dashicons-awards', // Add this line and replace the second inverted commas with class of the icon you like
			'redirect'      => false
		));

        acf_add_options_page(array(
			'page_title'    => 'Global Schema',
			'menu_title'    => 'Global Schema',
			'menu_slug'     => 'global_schema',
			'capability'    => 'edit_posts',
			'icon_url'      => 'dashicons-media-code',
			'redirect'      => false
		));

	}

	// Save newly created fields to child theme
	add_filter('acf/settings/save_json', 'my_acf_json_save_point');
 
	function my_acf_json_save_point( $path ) {
		
		// update path
		$path = get_stylesheet_directory() . '/acf-json';
		
		// return
		return $path;
	
	}
	
	// Add ability to add SVG to Wordpress Media Library
	function cc_mime_types($mimes) {
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}
	add_filter('upload_mimes', 'cc_mime_types');
	
	//add SVG to allowed file uploads
	function add_file_types_to_uploads($file_types){

		$new_filetypes = array();
		$new_filetypes['svg'] = 'image/svg+xml';
		$file_types = array_merge($file_types, $new_filetypes );

		return $file_types;
	}
	add_action('upload_mimes', 'add_file_types_to_uploads');


	// Widget Logic Conditionals
	function is_child($parent) {
		global $post;
			return $post->post_parent == $parent;
		}
		
		// Widget Logic Conditionals (ancestor) 
		function is_tree( $pid ) {
		global $post;
		
		if ( is_page($pid) )
		return true;
		
		$anc = get_post_ancestors( $post->ID );
		foreach ( $anc as $ancestor ) {
			if( is_page() && $ancestor == $pid ) {
				return true;
				}
		}
		return false;
	}

	// Display Current Year as shortcode - [year]
	function year_shortcode () {
		$year = date_i18n ('Y');
		return $year;
		}
	add_shortcode ('year', 'year_shortcode');
	
	// WP Backend Menu area taller
	add_action('admin_head', 'taller_menus');

	function taller_menus() {
	echo '<style>
		.posttypediv div.tabs-panel {
			max-height:500px !important;
		}
	</style>';
	}

	// Customize the logo on the wp-login.php page
	function my_login_logo() { ?>
		<style type="text/css">
			#login h1 a, .login h1 a {
			background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/img/logo.png);
			height:45px;
			width:204px;
			background-size: 204px 45px;
			background-repeat: no-repeat;
			padding-bottom: 30px;
			}
		</style>
	<?php }
	add_action( 'login_enqueue_scripts', 'my_login_logo' );
	// Contact Form 7 Submission Page Redirect
	add_action( 'wp_footer', 'mycustom_wp_footer' );
	
	function mycustom_wp_footer() {
	?>
	<script type="text/javascript">
	document.addEventListener( 'wpcf7mailsent', function( event ) {
		location = '/form-success/';
	}, false );
	</script>
	<?php
	}

	// Add Search Bar to Top Nav
	function mainmenu_navsearch($items, $args) {
		if ($args->theme_location == 'header-nav') {
			ob_start();
			?>
			<div class="mobile-menu-additions">
				<div class="link-wrapper">
					<?php 
					$blog_link = get_field('blog_link', 'options'); 
					$areas_served_link = get_field('areas_served_link', 'options'); ?>
					<li class="menu-item"><a class="single-nav-link" aria-label="read our <?php _e($blog_link['title']); ?>" title="read our <?php _e($blog_link['title']); ?>" href="<?php _e( $blog_link['link'] ); ?>"><?php _e( $blog_link['title']); ?></a></li>
					<li class="menu-item"><a class="single-nav-link" aria-label="learn about the areas we serve" title="learn about the areas we serve" href="<?php _e( $areas_served_link['link'] ); ?>"><?php _e( $areas_served_link['title']); ?></a></li>
				</div>
				<form class="navbar-form-search" role="search" method="get" action="/">
					<div class="search-form-container hdn" id="search-input-container">
						<div class="search-input-group">
							<div class="form-group">
							<input type="text" name="s" placeholder="Search for..." id="search-input-5cab7fd94d469" value="" class="form-control">
							</div>
						</div>
					</div>
					<button type="submit" class="btn btn-search" id="search-button"><span class="icon-magnifying-glass" aria-hidden="true"></span></button>
				</form>	
				<?php 
				if( have_rows('social_media_platforms', 'options') ) : ?>
				<div class="social-wrapper">
					<?php while( have_rows('social_media_platforms', 'options') ) : 
						the_row(); 
						$social = get_sub_field('social_media'); 
						?>
						<a href="<?php _e( $social['url'] ); ?>" target="_blank" aria-label="follow us on <?php _e( $social['title'] ); ?>" title="follow us on <?php _e( $social['title'] ); ?>" class="social-icon social-icon_<?php _e( strtolower($social['title']) ); ?>"></a>
					<?php endwhile; ?>
				</div>
				<?php endif; ?>
			</div>
			<?php
			$new_items = ob_get_clean();

			$items .= $new_items;
		}
		return $items;
	}
	add_filter('wp_nav_menu_items', 'mainmenu_navsearch', 10, 2);

	// Add template column to page list in wp-admin
	function page_column_views( $defaults ) {
		$defaults['page-layout'] = __('Template');
		return $defaults;
	}
	add_filter( 'manage_pages_columns', 'page_column_views' );

	function page_custom_column_views( $column_name, $id ) {
		if ( $column_name === 'page-layout' ) {
			$set_template = get_post_meta( get_the_ID(), '_wp_page_template', true );
			if ( $set_template == 'default' ) {
				echo 'Default';
			}
			$templates = get_page_templates();
			ksort( $templates );
			foreach ( array_keys( $templates ) as $template ) :
				if ( $set_template == $templates[$template] ) echo $template;
			endforeach;
		}
	}
	add_action( 'manage_pages_custom_column', 'page_custom_column_views', 5, 2 );

	// add shared categories to pages
	function add_categories_to_pages() {
		register_taxonomy_for_object_type( 'category', 'page' );
	}
	add_action( 'init', 'add_categories_to_pages' );

	function get_pagination() {
		return '<div class="pagination">' . paginate_links( array(
			'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
			'current'      => max( 1, get_query_var( 'paged' ) ),
			'format'       => '?paged=%#%',
			'show_all'     => false,
			'type'         => 'plain',
			'end_size'     => 2,
			'mid_size'     => 1,
			'prev_next'    => true,
			'prev_text'    => __( '<span></span>', 'textdomain' ),
			'next_text'    => __( '<span></span>', 'textdomain' ),
			'add_args'     => false,
			'add_fragment' => '',
		) ) . '</div>';
	}

	// Add alternate excerpt extracted from ACF metadata
	function excerpt_function($ID, $searchTerms) {
		global $wpdb;
		$thisPost = get_post_meta($ID);
		foreach ($thisPost as $key => $value) {
			if ( false !== stripos($value[0], $searchTerms) && $key !== '_wp_page_template' ) {
				$found = substr(strip_tags($value[0]), 0, 150);
				echo $found . '... ';
			}
		}
	}

	// Allows other pages to be nested under /about/ which is used for the attorneys cpt slug front
	function attorney_about_slug_rewrite($rules) {
		$my_rules = [];
		foreach ($rules as $pattern => $rewrite) {
			if (strpos($pattern, 'about/') === 0) {
				$my_rules[$pattern] = $rewrite;
				unset($rules[$pattern]);
			}
		}
		$output = [];
		foreach ($rules as $pattern => $rewrite) {
			$output[$pattern] = $rewrite;
			if ($pattern === '(.?.+?)(?:/([0-9]+))?/?$') {
				foreach ($my_rules as $my_key => $my_rule) {
					$output[$my_key] = $my_rule;
				}
			}
		}
		return $output;
	}
	add_filter('rewrite_rules_array', 'attorney_about_slug_rewrite');

	// Remove text from search btn (icon added in style to replace)
	function my_search_form_text($text) {
		$text = str_replace('Search', '', $text); //set as value the text you want
		return $text;
	}
	add_filter('get_search_form', 'my_search_form_text');

	//Ajax load all results
	function ajax_load_all_results(){
		//exclude the posts that are called on page load
		$excludePosts = $_POST['offset'] ? $_POST['offset'] : 0;
		global $wp_query;
		
		$all_results_args = [
			'post_type'         => 'results',
			'post_status'       => 'publish',
			'posts_per_page'    => 999,
			'post__not_in' 		=> $excludePosts,
			'meta_key'          => 'case_amount',
			'orderby'           => 'meta_value_num',
			'order'             => 'DESC'
		];

		$all_results_query = new WP_Query($all_results_args);
		$response = '';
		if( $all_results_query->have_posts() ) {
			while( $all_results_query->have_posts() ) :
			     $all_results_query->the_post(); 
				$amount = number_format(get_field('case_amount'), 0);
				$title = get_field('case_title');
				$description = get_field('case_description');
				
				$response .= "
				<div class='result grid-item'>
					<h3>${title}</h3> 
					<p class='amount'>$${amount}</p>
					<p class='description'>${description}</p>
				</div>
				";
			endwhile;
			
		} else {
			$response .= "
				<p class='subtitle'>There are currently no more results to view.</p>
			";
		}
		echo $response;
		wp_die();
	}
	add_action('wp_ajax_nopriv_load_all_results', 'ajax_load_all_results');
	add_action('wp_ajax_load_all_results', 'ajax_load_all_results');

	//Ajax load more reviews
	function load_more_reviews(){
		global $wp_query;
		$excludePosts = $_POST['offset'] ? $_POST['offset'] : 0;
		$more_reviews_args = [
			'post_type'         => 'testimonials',
			'post_status'       => 'publish',
			'posts_per_page'    => 999,
			'post__not_in' 		=> $excludePosts
		];

		$more_reviews_query = new WP_Query($more_reviews_args);
		$response = '';
		if( $more_reviews_query->have_posts() ) {
			while( $more_reviews_query->have_posts() ) :
			    $more_reviews_query->the_post(); 
				$title = get_field('testimonial_title');
				$description = get_field('testimonial_description');
				$author = get_field('testimonial_author');
				$review_source = get_field('testimonial_review_source');
				
				$response .= "
				<div class='review grid-item'>
					<span class='star-rating'>★ ★ ★ ★ ★</span>
					<h3>${title}</h3>
					<p>${description}</p>
					<span class='author-wrapper'>";

				if( $author ) {
					$response .= "<span class='author'>${author}</span> 
					<span class='divider'>|</span>";
				}

				$response .= "<span class='review-source'>${review_source}</span>
				</span>
			</div>";

			endwhile;
			
		} else {
			$response .= "<p class='subtitle'>There are currently no more reviews.</p>";
		}
		echo $response;
		wp_die();
	}
	add_action('wp_ajax_nopriv_load_more_reviews', 'load_more_reviews');
	add_action('wp_ajax_load_more_reviews', 'load_more_reviews');

	function klf_acf_input_admin_footer() { ?>
		<script type="text/javascript">
			(function($) {
				acf.add_filter('color_picker_args', function( args, $field ){
				// add the hexadecimal codes here for the colors you want to appear as swatches
				args.palettes = ["#fff", "#000", "#666", "#F8FCFD", "#26383D", "#407074", "#E76D60", "#F0EAE4"];
				// return colors
				return args;
			});
			
			})(jQuery);
		</script>
		<?php }
		add_action('acf/input/admin_footer', 'klf_acf_input_admin_footer');
/**
 * Disable Theme/Plugin File Editors in WP Admin
 * - Hides the submenu items
 * - Blocks direct access to editor screens
 */
function postali_disable_file_editors_menu() {
    // Remove Theme File Editor from Appearance menu
    remove_submenu_page( 'themes.php', 'theme-editor.php' );
    // Optional: also remove Plugin File Editor from Plugins menu
    remove_submenu_page( 'plugins.php', 'plugin-editor.php' );
}
add_action( 'admin_menu', 'postali_disable_file_editors_menu', 999 );

// Block direct access to the editors even if someone knows the URL
function postali_block_file_editors_direct_access() {
    wp_die( __( 'File editing through the WordPress admin is disabled.' ), 403 );
}
add_action( 'load-theme-editor.php', 'postali_block_file_editors_direct_access' );
add_action( 'load-plugin-editor.php', 'postali_block_file_editors_direct_access' );

/**
 * Disable the Additional CSS panel in the Customizer.
 * Primary method: remove the custom_css component early in load.
 */
function postali_disable_customizer_additional_css_component( $components ) {
    $key = array_search( 'custom_css', $components, true );
    if ( false !== $key ) {
        unset( $components[ $key ] );
    }
    return $components;
}
add_filter( 'customize_loaded_components', 'postali_disable_customizer_additional_css_component' );

/**
 * Fallback: remove the Additional CSS section if it's present.
 */
function postali_remove_customizer_additional_css_section( $wp_customize ) {
    if ( method_exists( $wp_customize, 'remove_section' ) ) {
        $wp_customize->remove_section( 'custom_css' );
    }
}
add_action( 'customize_register', 'postali_remove_customizer_additional_css_section', 20 );
?>