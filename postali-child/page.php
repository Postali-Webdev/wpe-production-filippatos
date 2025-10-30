<?php
/**
 * Template: Default
 * @package Postali Child
 * @author Postali LLC
**/
get_header(); ?>

<main id="page">
    <section id="hero" class="dk-teal-bg">
        <div class="container">
            <?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?> 
            <div class="columns">
                <div class="column-66 center direction-col">
                    <h1><?php the_field('hero_title'); ?></h1>
                    <?php if( get_field('hero_intro_copy') ) : ?>
                        <p><?php the_field('hero_intro_copy'); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <section id="panel-1" class="tan-bg">
        <span id="main-content"></span>
        <div class="container">
            <div class="columns">
                <div class="column-66 center direction-col">
                    <?php the_field('page_copy'); ?>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>