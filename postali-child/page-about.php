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

<section class="community-involvement tan-bg">
    <div class="container">
        <div class="columns">
            <div class="column-33 intro-block">
                <div class="top-copy">
                    <h2><?php the_field('ci_panel_headline'); ?></h2>
                    <p><?php the_field('ci_intro_copy'); ?></p>
                </div>
                <?php 
                $image = get_field('ci_panel_image');
                if( !empty( $image ) ): ?>
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                <?php endif; ?>
            </div>
            <div class="column-66">
                <?php if( have_rows('ci_organizations') ): ?>
                <ul>
                <?php while( have_rows('ci_organizations') ): the_row(); ?>  
                    <?php 
                    $link = get_sub_field('link');
                    if( $link ): 
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                        <li>
                            <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a><br>
                            <p><?php the_sub_field('copy'); ?></p>
                        </li>
                    <?php endif; ?>
                <?php endwhile; ?>
                </ul>
                <?php endif; ?> 
            </div>
        </div>
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