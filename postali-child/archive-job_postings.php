<?php
/**
 * Template: Hiring Page
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
                    <h1>Job Openings</h1>
                </div>
            </div>
        </div>
    </section>
    <section id="panel-1" class="tan-bg">
        <span id="main-content"></span>
        <div class="container">
            <div class="columns">
                <div class="column-66 center direction-col">
                    <h2>Join Our Team</h2>
                    <?php if( have_posts() ) : ?>
                        <?php while( have_posts() ) : the_post(); ?>
                            <h3><?php the_field('title'); ?></h3>
                            <?php the_field('copy'); ?>
                           <p>If you are interested in joining our team, please send your resume to <a href="mailto:<?php the_field('contact_method'); ?>"><?php the_field('contact_method'); ?></a></p>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <p>We are always excited to meet like-minded legal professionals who share our commitment to justice in the workplace. If you are interested in joining our team, please send your resume to <a href="mailto:employment@filippatoslaw.com">employment@filippatoslaw.com</a>.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>