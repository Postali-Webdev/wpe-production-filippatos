<?php
/**
 * Template Name: Other PA Landing
 * @package Postali Child
 * @author Postali LLC
**/

//$pa
get_header();?>

<main id="page">

    <section id="hero" class="default tan-bg">
        <div class="container">
            <div class="columns">
                <div class="column-full direction-col">
                    <?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?>
                    <h4><?php the_field('sub_title'); ?></h4>
                    <h1><?php the_field('title'); ?></h1>
                </div>
            </div>
        </div>
    </section>
    <div id="main-content" class="tan-bg">
        <?php get_template_part('block', 'practice-areas', [ 'data' => [ 'practice-area-type' => 'general'] ]); ?>
    </div>

</main><!-- #page -->

<?php get_footer();?>