<?php
/**
 * Video Library Custom Post Type
 *
 * @package Postali Child
 * @author Postali LLC
 */

function video_library() {
	$labels = array(
		'name'               => __( 'Videos', 'post type general name' ),
		'singular_name'      => __( 'Video', 'post type singular name' ),
		'add_new'            => __( 'Add New', 'book' ),
		'add_new_item'       => __( 'Add New Video' ),
		'edit_item'          => __( 'Edit Video' ),
		'new_item'           => __( 'New Video' ),
		'all_items'          => __( 'All Videos' ),
		'view_item'          => __( 'View Videos' ),
		'search_items'       => __( 'Search Videos' ),
		'not_found'          => __( 'No Videos found' ),
		'not_found_in_trash' => __( 'No Videos found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Videos'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'All of my Videos',
		'public'        => true,
		'menu_position' => 7,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
		'has_archive'   => true,
		'menu_icon'		=> 'dashicons-nametag',
        'rewrite' => array( 'slug' => 'video-library', 'with_front' => false ), 

	);
	register_post_type( 'video_library', $args );	
}
add_action( 'init', 'video_library' );