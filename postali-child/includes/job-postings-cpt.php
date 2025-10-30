<?php
/**
 * Job Postings Custom Post Type
 *
 * @package Postali Child
 * @author Postali LLC
 */

function job_postings() {
	$labels = array(
		'name'               => __( 'Job Postings', 'post type general name' ),
		'singular_name'      => __( 'Job Post', 'post type singular name' ),
		'add_new'            => __( 'Add New', 'book' ),
		'add_new_item'       => __( 'Add New Job Post' ),
		'edit_item'          => __( 'Edit Job Post' ),
		'new_item'           => __( 'New Job Post' ),
		'all_items'          => __( 'All Job Postings' ),
		'view_item'          => __( 'View Job Postings' ),
		'search_items'       => __( 'Search Job Postings' ),
		'not_found'          => __( 'No Job Postings found' ),
		'not_found_in_trash' => __( 'No Job Postings found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Job Postings'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'All of my Job Posts',
		'public'        => true,
		'menu_position' => 7,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
		'has_archive'   => true,
		'menu_icon'		=> 'dashicons-nametag',
        'rewrite' => array( 'slug' => 'careers', 'with_front' => false ), 

	);
	register_post_type( 'job_postings', $args );	
}
add_action( 'init', 'job_postings' );