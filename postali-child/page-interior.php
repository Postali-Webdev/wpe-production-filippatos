<?php
/**
 * Law Category Interior Page
 * Template Name: Interior
 * @package Postali Parent
 * @author Postali LLC
 */
get_header(); ?>

<main id="page">
	<section id="hero" class="default dk-teal-bg">
        <div class="container">
            <?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?> 
            <div class="columns">
                <div class="column-66 direction-col">
                    <?php if(is_page('1928')) { ?>
                    <h4>Connect With Us On Social Media</h4>
                    <?php } ?>
                    <h1><?php the_title(); ?></h1>
                </div>
            </div>
        </div>
    </section>

	<section id="panel-1" class="tan-bg">
        <div class="container">
            <div class="columns">
                <div class="column-full direction-col">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </section>
	
</main>
	
<?php get_footer(); ?>