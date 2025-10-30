<?php
/**
 * Template Name: Sitemap
 * @package Postali Child
 * @author Postali LLC
**/
get_header(); ?>

<main id="page">
    <section id="hero" class="dk-teal-bg">
        <div class="container">
            <?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?> 
            <div class="columns">
                <div class="column-66 center">
                    <h1>Sitemap</h1>
                </div>
            </div>
        </div>
    </section>
    <section id="panel-1" class="tan-bg">
        <div class="container">
            <div class="columns">
                <div class="column-50 center direction-col">
                    <h2>Pages</h2>
                    <?php 
                    $exclude = [];
                    $args = [
                        'post_type' => 'page',
                        'post_status' => 'publish',
                        'meta_query' => array( 
                            'relation' => 'OR',
                            array(
                                'key'   => '_wp_page_template', 
                                'value' => 'page-ppc-landing.php'
                            ),
                            array(
                                'key'   => '_wp_page_template', 
                                'value' => 'page-ppc-landing-v2.php'
                            )
                        )
                    ];                    
                    $ppc_query = new WP_Query($args);
                    if( $ppc_query->have_posts() ) {
                        while( $ppc_query->have_posts() ) {
                            $ppc_query->the_post();
                            $exclude[] .= get_the_ID();
                        }   
                    } 
                    $list_args = array(
                        'exclude'      => implode(",", $exclude),
                        'title_li'     => '',
                        'sort_column'  => 'menu_order, post_title',
                        'post_type'    => 'page',
                        'post_status'  => 'publish'
                    ); 
                    echo wp_list_pages($list_args); ?>
                </div>
                <div class="column-50 center direction-col">
                    <h2>Blogs</h2>
                    <?php echo wp_get_archives('type=postbypost'); ?>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>