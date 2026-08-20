<?php
/**
 * Custom Events Custom Post Type
 *
 * @package Postali Parent
 * @author Postali LLC
 */

function create_custom_post_type_events() {

// set up labels
    $labels = array(
        'name' => 'Events',
        'singular_name' => 'Event',
        'add_new' => 'Add New Event',
        'add_new_item' => 'Add New Event',
        'edit_item' => 'Edit Events',
        'new_item' => 'New Events',
        'all_items' => 'All Events',
        'view_item' => 'View Events',
        'search_items' => 'Search  Events',
        'not_found' =>  'No Events Found',
        'not_found_in_trash' => 'No Events found in Trash', 
        'parent_item_colon' => '',
        'menu_name' => 'Community Events',

    );
    //register post type
    register_post_type( 'Events', array(
        'labels' => $labels,
        'menu_icon' => 'dashicons-buddicons-community',
        'has_archive' => false,
        'public' => true,
        'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
        'exclude_from_search' => true,
        'capability_type' => 'post',
        )
    );

}
add_action( 'init', 'create_custom_post_type_events' );