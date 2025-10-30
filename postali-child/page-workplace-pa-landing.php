<?php
/**
 * Template Name: Workplace Discrimination PA Landing
 * @package Postali Child
 * @author Postali LLC
**/

//$pa
get_header();?>

<main id="page">

    <section id="hero" class="default dk-teal-bg">
        <div class="container">
            <div class="columns">
                <div class="column-full direction-col">
                    <?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?>
                    <h4><?php the_field('sub_title'); ?></h4>
                    <h1><?php the_field('title'); ?></h1>
                </div>
                <!-- <span id="main-content"></span> -->
                
            </div>
        </div>
    </section>



    <div id="main-content" class="dk-teal-bg">
        <?php get_template_part('block', 'practice-areas', [ 'data' => [ 'practice-area-type' => 'workplace-discrimination'] ]); ?>
    </div>

</main><!-- #page -->

<?php get_footer();?>