<?php
/**
 * Template Name: About Us
 * @package Postali Child
 * @author Postali LLC
**/

// ACF Fields
$p1_image = get_field('p1_team_photo');
$cases_group = get_field('p1_cases_won');

get_header();?>

<main id="page">

<section id="hero" class="default dk-teal-bg">
    <div class="container">
        <div class="columns">
            <div class="column-full direction-col">
                <?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?> 
                <h4><?php the_field('hero_sub_title'); ?></h4>
                <h1><?php the_field('hero_title'); ?></h1>
            </div>
        </div>
    </div>
</section>

<section id="panel-1">
    <div class="container attorney-slide-wrapper">
        <div class="columns">
            <div class="column-full">
                <?php get_template_part('block', 'attorney-slider'); ?>
            </div>
        </div>
    </div>
</section>

<section id="panel-2" class="tan-bg">
    <span id="main-content"></span>
    <div class="container">
        <div class="columns">
            <div class="column-50">
                <?php the_field('p1_copy'); ?>
            </div>
            <div class="column-50">
                <img src="<?php _e($p1_image['url']); ?>" alt="<?php _e($p1_image['alt']); ?>" title="<?php _e($p1_image['title']); ?>">
            </div>
        </div>
        <?php get_template_part('block', 'cases-won', [ 'data' => ['copy' => $cases_group['copy']] ]); ?>
    </div>
</section>

<section id="panel-3" class="dk-teal-bg">
    <div class="container">
        <div class="columns">
            <div class="column-75 center">
                <div class="columns">
                    <div class="column-50">
                        <h2><?php the_field('awards_title', 'options'); ?></h2>
                    </div>
                    <div class="column-50">
                        <p> <?php the_field('awards_copy', 'options'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php get_template_part('block', 'awards-slider'); ?>
</section>


</main>

<?php get_footer();?>