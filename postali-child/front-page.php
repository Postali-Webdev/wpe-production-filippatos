<?php
/**
 * Template Name: Front Page
 * @package Postali Child
 * @author Postali LLC
**/

// ACF Fields
$banner_img_arr = get_field('hero_banner_image');
$count_banner = count($banner_img_arr);
$banner_img = $banner_img_arr[rand(0, $count_banner - 1)]['image'];

$p1_about_btn = get_field('about_cta');
$p1_video_btn_group = get_field('watch_video_button');
$p3_left_featured_review = get_field('p3_left_featured_testimonial');
$p3_right_featured_review = get_field('p3_right_featured_testimonial');
$p4_banner = get_field('p4_section_banner');

$left_review_description = get_field('testimonial_short_description', $p3_left_featured_review->ID) ? get_field('testimonial_short_description', $p3_left_featured_review->ID) : get_field('testimonial_description', $p3_left_featured_review->ID);
$right_review_description = get_field('testimonial_short_description', $p3_right_featured_review->ID) ? get_field('testimonial_short_description', $p3_right_featured_review->ID) : get_field('testimonial_description', $p3_right_featured_review->ID);


$primary_pa_args = [
    'post_type'         => 'page',
    'posts_per_page'    => 6,
    'post_status'       => 'publish',
    'order'             => 'ASC',
    'meta_query'        => [
        [
            'key'       => '_wp_page_template',
            'value'     => 'page-pa-parent.php'
        ],
        [
            'key'       => 'global_add_to_homepage',
            'value'     => true
        ],
        [
            'key'       => 'global_practice_area_type',
            'value'     => 'workplace-discrimination'
        ]
    ]
];
$practice_area_query = new WP_Query($primary_pa_args);

$other_pa_args = [
    'post_type'         => 'page',
    'posts_per_page'    => 6,
    'post_status'       => 'publish',
    'order'             => 'ASC',
    'meta_query'        => [
        [
            'key'       => '_wp_page_template',
            'value'     => 'page-pa-parent.php'
        ],
        [
            'key'       => 'global_add_to_homepage',
            'value'     => true
        ],
        [
            'key'       => 'global_practice_area_type',
            'value'     => 'general'
        ]
    ]
];
$general_pa_query = new WP_Query($other_pa_args);

get_header();

?>

<main id="front-page">

    <section id="hero" class="dk-teal-bg">
        <div class="container">
            <div class="columns">
                <div class="column-75 direction-col">
                    <div class="hero-wrapper">
                        <h1><?php the_field('hero_title'); ?></h1>
                        <h4><?php the_field('hero_sub_title'); ?></h4>
                        <div class="cta-wrapper">
                            <a aria-label="call our office at <?php _e( $vanity_phone_number ); ?>" title="call our office at <?php _e( $vanity_phone_number ); ?>"  href="tel:<?php _e( $actual_phone_number ); ?>" class="btn"><?php _e( $vanity_phone_number ); ?></a>
                            <span class="divide"></span>
                            <p><?php the_field('hero_cta_text'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="spacer-30"></div>
                    <div class="column-50">
                        <p><?php the_field('hero_form_cta_text'); ?></p>
                        <div class="form-box">
                            <?php echo do_shortcode(' [gravityform id="3" title="false"] '); ?>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <img class="banner-img" src="<? _e( $banner_img['url'] ); ?>" alt="<? _e( $banner_img['alt'] ); ?>" title="<? _e( $banner_img['title'] ); ?>" />
    </section>

    <section id="panel-1">
        <div class="container attorney-slide-wrapper">
            <h2>Meet Our Team</h2>
            <div class="spacer-30"></div>
            <div class="columns">
                <div class="column-full">
                    <?php get_template_part('block', 'attorney-slider'); ?>
                </div>
            </div>
        </div>


        <div class="spacer-60"></div>

        <div class="container">
            <div class="columns touts">
                <div class="column-50 tout">
                    <p class="small"><img src="/wp-content/uploads/2024/04/filippatos-banner.svg" alt="banner icon"> Landmark Success</p>
                    <div class="tout-box"> 
                        <?php
                        $landmark_amount = get_field('landmark_success_amount');
                        $landmark_headline = get_field('landmark_success_headline');
                        $landmark_url = get_field('landmark_success_url');
                        ?>
                        <a href="<?php echo esc_url( $landmark_url ); ?>">
                            <div class="highlight"><?php echo esc_html($landmark_amount); ?></div><p class="large"><?php echo esc_html( $landmark_headline ); ?></p><img src="/wp-content/uploads/2022/12/bubble-arrow-right.svg" alt="" class="tout-arrow">
                        </a>
                    </div>
                </div>
                <div class="column-50 tout">
                    <p class="small"><img src="/wp-content/uploads/2024/04/filippatos-star.svg" alt="star icon"> Notable Mention</p>
                    <div class="tout-box">
                    <?php
                        $notable_date = get_field('notable_success_date');
                        $notable_headline = get_field('notable_success_headline');
                        $notable_url = get_field('notable_mention_url');
                        ?>
                        <a href="<?php echo esc_url( $notable_url ); ?>">
                            <div class="highlight"><?php echo esc_html( $notable_date ); ?></div><p class="large"><?php echo esc_html( $notable_headline ); ?></p><img src="/wp-content/uploads/2022/12/bubble-arrow-right.svg" alt="" class="tout-arrow">
                        </a>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="spacer-60"></div>


        <div class="tan-bg" id="main-content">
            <div class="container">
                <div class="columns intro-firm-values">
                    <div class="column-50 direction-col">
                        <h2><?php the_field('p1_title'); ?></h2>
                        <h4><?php the_field('p1_sub_title'); ?></h4>
                        <a aria-label="<?php _e( $p1_about_btn['title'] ); ?>" title="<?php _e( $p1_about_btn['title'] ); ?>" href="<?php _e( $p1_about_btn['url'] ); ?>" class="btn"><?php _e( $p1_about_btn['title'] ); ?></a>

                        <div class="tout-box alt"> 
                        <a href="<?php the_field('when_to_contact_link'); ?>">
                            <p><?php the_field('when_to_contact_copy'); ?></p><img src="/wp-content/uploads/2022/12/bubble-arrow-right.svg" alt="" class="tout-arrow">
                        </a>
                    </div>
                    </div>
                    <div class="column-50 direction-col">
                        <?php the_field('p1_copy'); ?>
                        <h3><?php the_field('p1_blog_headline'); ?></h3> 
                        <div class="subheading-small"><?php the_field('p1_blog_subheadline'); ?></div>
                        <div class="spacer-30"></div>
                        <?php if( have_rows('p1_blogs') ): ?>
                        <ul id="p1_posts">
                        <?php while( have_rows('p1_blogs') ): the_row(); ?>
                            <?php $post_object = get_sub_field('blog_post'); ?>
                            <?php if( $post_object ): ?>
                                <?php // override $post
                                $post = $post_object;
                                setup_postdata( $post );
                                ?>
                                <li><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></li>
                                <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
                            <?php endif; ?>
                        <?php endwhile; ?>
                        </ul>
                        <?php endif; ?>
                        <div class="spacer-30"></div>
                        <a aria-label="More Blogs" title="More Blogs" href="/blog/" class="btn">View More Blogs</a>
                    </div>
                </div>
                <?php if( have_rows('p1_firm_values') ) : $count = 0;?>
                <div class="columns firm-values">
                    <?php while( have_rows('p1_firm_values') ) : the_row(); $count++;
                    $icon = get_sub_field('icon'); ?>
                    <div class="value column-33 direction-col">
                        <img src="<?php _e( $icon['url'] ); ?>" title="<?php _e( $icon['title'] ); ?>" alt="<?php _e( $icon['alt'] ); ?>" />
                        <h4 class="title"><?php the_sub_field('title'); ?></h4>
                        <p class="intro-text"><?php the_sub_field('intro_text'); ?></p>
                        <a aria-label="<?php the_sub_field('button_text'); ?>" title="<?php the_sub_field('button_text'); ?>" href="<?php the_sub_field('button_page_link'); ?>" class="btn"><?php the_sub_field('button_text'); ?></a>
                    </div>
                    <?php endwhile; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section id="panel-2" class="dk-teal-bg">
        <div class="container">
            <div class="columns">
                <div class="column-50 direction-col">
                    <h2><?php the_field('p2_title'); ?></h2>
                </div>
                <div class="column-50 direction-col">
                    <p><?php the_field('p2_copy'); ?></p>
                </div>
                <?php if( $practice_area_query->have_posts() ) : ?>
                <div class="practice-areas-grid">
                    <?php while( $practice_area_query->have_posts() ) :
                        $practice_area_query->the_post(); 
                        $pa_icon = get_field('global_pa_icon');
                        $title = get_field('global_short_title') ? get_field('global_short_title') : get_field('hero_title');?>
                        <div class="practice-area link-finder">
                            <div class="columns">
                                <img src="<?php _e($pa_icon['url']); ?>" alt="<?php _e($pa_icon['alt']); ?>" title="<?php _e($pa_icon['title']); ?>">
                                <div class="copy">
                                    <h3 class="title"><a aria-label="learn more about <?php echo $title; ?>" title="learn more about <?php echo $title; ?>" href="<?php _e( get_the_permalink() ); ?>"><?php echo $title; ?></a></h3>
                                    <p><?php the_field('global_short_description'); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; wp_reset_postdata();?>
                </div>
                <a aria-label="see all workplace discrimination practice areas" title="see all workplace discrimination practice areas" href="/practice-areas/" class="btn all-pa-btn">See All Workplace Discrimination Areas</a>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section id="panel-3" class="tan-bg">
        <div class="container">
            <div class="columns">
                <div class="column-33 direction-col">
                    <h2><?php the_field('p3_title'); ?></h2>
                    <p><?php the_field('p3_copy'); ?></p>
                </div>
                <div class="column-66 other-pa-grid">
                    <?php if( $general_pa_query->have_posts() ) : ?>
                    <div class="practice-areas-grid">
                        <?php while( $general_pa_query->have_posts() ) :
                            $general_pa_query->the_post(); 
                            $pa_icon = get_field('global_pa_icon');
                            $title = get_field('global_short_title') ? get_field('global_short_title') : get_field('hero_title');
                            ?>
                            <div class="practice-area link-finder">
                                <h3 class="general-pa title"><a aria-label="learn more about <?php _e($title); ?>" title="learn more about <?php _e($title); ?>" href="<?php _e( get_the_permalink() ); ?>"><?php _e($title); ?></a></h3>
                            </div>
                        <?php endwhile; wp_reset_postdata();?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="columns featured-review-wrapper">
                <div class="column-full direction-col center">
                    <span class="star-rating">★ ★ ★ ★ ★</span>
                    <div class="featured-review-grid">
                        <div class="featured-review">
                            <p class="review">"<?php echo $left_review_description; ?>"</p>
                            <span class="author-wrapper"><span class="author"><?php the_field( 'testimonial_author', $p3_left_featured_review->ID ); ?></span></span>
                        </div>
                        <div class="featured-review">
                            <p class="review">"<?php echo $right_review_description; ?>"</p>
                            <span class="author-wrapper"><span class="author"><?php the_field( 'testimonial_author', $p3_right_featured_review->ID ); ?></span></span>
                        </div>
                    </div>
                    <a class="btn" aria-label="see all reviews" title="see all reviews" href="/results/">See All Reviews</a>
                </div>
            </div>
        </div>
    </section>

    <section id="why-hire" class="tan-bg">
        <div class="container">
            <div class="columns">
                <div class="column-50 left">
                    <?php the_field('wh_copy_left'); ?>
                </div>
                <div class="column-50 video">
                    <?php the_field('wh_copy_right'); ?>
                </div>
            </div>
        </div>
    </section>

    <section id="panel-4" class="dk-teal-bg">
        <img src="<?php _e( $p4_banner['url'] ); ?>" alt="<?php _e( $p4_banner['alt'] ); ?>" title="<?php _e( $p4_banner['title'] ); ?>" class="p4-banner">
        <div class="container">
            <div class="columns">
                <div class="column-100 center awards-copy">
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

    <section id="panel-5" class="tan-bg">
        <div class="container">
            <div class="columns">
                <div class="column-full">
                    <h2>Our Most Recent Blogs</h2>
                    <?php get_template_part('block', 'recent-posts'); ?>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer();?>