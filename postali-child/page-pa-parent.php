<?php
/**
 * Template Name: Practice Area Parent
 * @package Postali Child
 * @author Postali LLC
**/

// ACF Fields
$pa_type =  get_field('global_practice_area_type');
$banner_img = get_field('hero_banner_image');
$pa_icon = get_field('global_pa_icon');
$pa_url = $pa_type['value'] == "workplace-discrimination" ? "/workplace-discrimination/" : "/practice-areas/";

$pa_args = [
    'post_type'         => 'page',
    'post_status'       => 'publish',
    'posts_per_page'    => 7,
    'post__not_in'      => [get_the_ID()],
    'meta_query'        => [
        [
            'key'       => '_wp_page_template',
            'value'     => 'page-pa-parent.php'
        ],
        [
            'key'       => 'global_practice_area_type',
            'value'     => $pa_type['value']
        ]
    ]
];

$pa_query = new WP_Query($pa_args);

get_header();?>

<main id="page" class="dk-teal-bg">
    <seciton id="hero">
        <div class="container">
            <div class="columns">
                <div class="column-50 direction-col">
                    <?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?> 
                    <p class="subheading-small"><?php _e( $pa_type['label'] !== 'General' ? $pa_type['label'] : 'Other Practice Areas'); ?></p>
                    <h1><?php the_field('hero_title'); ?></h1>
                    <p><?php the_field('hero_intro_copy'); ?></p>
                    <div class="cta-block">
                        <p><?php the_field('hero_cta_copy'); ?></p>
                        <a aria-label="call our office at <?php _e( $vanity_phone_number ); ?>" title="call our office at <?php _e( $vanity_phone_number ); ?>"  href="tel:<?php _e( $actual_phone_number ); ?>" class="btn"><?php _e( $vanity_phone_number ); ?></a>
                    </div>
                </div>
                <img class="pa-icon" src="<? _e( $pa_icon['url'] ); ?>" alt="<? _e( $pa_icon['alt'] ); ?>" title="<? _e( $pa_icon['title'] ); ?>" />
            </div>
        </div>
        <img class="banner-img" src="<? _e( $banner_img['url'] ); ?>" alt="<? _e( $banner_img['alt'] ); ?>" title="<? _e( $banner_img['title'] ); ?>" />
    </seciton>

    <section id="panel-1" class="tan-bg">
        <span id="main-content"></span>
        <div class="container">
            <div class="columns">
                <div class="column-50 copy-wrapper direction-col">
                    <?php the_field('p1_page_copy'); ?>
                </div>
                <?php if( $pa_query->have_posts() ) : ?>
                <aside class="column-50 direction-col other-pas-wrapper">
                    <h4>More About <?php _e( $pa_type['label'] !== 'General' ? $pa_type['label'] : 'Other Practice Areas'); ?></h4>
                    <?php while( $pa_query->have_posts() ) : 
                        $pa_query->the_post(); ?>
                        <div class="practice-area link-finder">
                            <a href="<?php _e( get_the_permalink() ); ?>"><?php the_field('global_short_title'); ?></a>
                        </div>
                    <?php endwhile; ?>
                    <div class="practice-area link-finder all-pas">
                            <a href="<?php esc_html_e($pa_url); ?>">See More</a>
                        </div>
                </aside>
                <?php endif; wp_reset_postdata(); ?>
                <div class="column-full">
                    <?php get_template_part('block', 'related-posts'); ?>
                </div>
            </div>
        </div>
    </section>


</main>

<?php get_footer();?>