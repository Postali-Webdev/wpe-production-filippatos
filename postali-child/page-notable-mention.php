<?php
/**
 * Template Name: Notable Mention
 * 
 * @package Postali Child
 * @author Postali LLC
 */

get_header(); ?>

<main id="page">
    <section id="hero" class="dk-teal-bg default">
        <div class="container">
            <div class="columns">
                <div class="column-50 direction-col">
                    <?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?> 
                    <h4>Notable Mention</h4>
                    <h1><?php the_title(); ?></h1>
                    <p class="date"><?php echo the_date('F d, Y'); ?></p>
                    
                </div>
            </div>
        </div>
    </section>
    <section id="panel-1" class="tan-bg">
        <span id="main-content"></span>
        <div class="container">
            <div class="columns">
                <div class="column-75 direction-col main-copy">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
