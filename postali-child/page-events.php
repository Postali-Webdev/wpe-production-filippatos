<?php
/**
 * Media Mentions Page
 * Template Name: Community Events 
 * @package Postali Parent
 * @author Postali LLC
 */

function postali_limit_event_copy($content, $paragraph_limit = 2) {
    if (empty($content)) {
        return '';
    }

    preg_match_all('/<p\b[^>]*>.*?<\/p>/is', $content, $matches);
    $paragraphs = $matches[0];

    if (empty($paragraphs)) {
        return $content;
    }

    $visible_paragraphs = array_slice($paragraphs, 0, $paragraph_limit);
    $remaining_paragraphs = array_slice($paragraphs, $paragraph_limit);

    $output = implode('', $visible_paragraphs);

    if (!empty($remaining_paragraphs)) {
        $output .= '<p class="read-more">Read more +</p><span class="rest">' . implode('', $remaining_paragraphs) . '</span>';
    }

    return $output;
}

$hero_banner = get_field('hero_image');
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

// Get today's date in YYYY-MM-DD format
$today = current_time('Ymd'); 

$upcoming_posts = new WP_Query(
    array(
        'post_type'      => 'events',
        'posts_per_page' => -1,
        'meta_query'     => array(
            array(
                'key'     => 'event_actual_date', 
                'value'   => $today,
                'compare' => '>', // Use '>=' to include today
                'type'    => 'DATE',
            ),
        )
    )
);

$past_posts = new WP_Query(
    array(
        'post_type' => 'events',
        'posts_per_page' => 4,
        'paged'    => $paged,
        'meta_query'     => array(
        array(
            'key'     => 'event_actual_date', 
            'value'   => $today,
            'compare' => '<=', // Use '>=' to include today
            'type'    => 'DATE',
        ),
    ),
    'orderby'        => 'meta_value',
    'order'          => 'DESC',
    )
);

get_header(); ?>

<main id="page">
    <section id="hero" class="ming-bg">
        <div class="columns">
            <div class="column-50 img-container">
                <img src="<?php esc_html_e($hero_banner['url']); ?>" alt="<?php esc_html_e($hero_banner['alt']); ?>">
            </div>
            <div class="column-50 intro-container">
                <div class="container">
                    <h1><?php the_title(); ?></h1>
                    <?php the_field('media_intro'); ?>
                </div>
            </div>
        </div>
    </section>

    <section id="panel-1" class="dk-teal-bg">
        <div class="container">
            <div class="columns">
                <h2>Upcoming Events</h2>
                <div class="spacer-break"></div>
                
                <div class="upcoming-events">
                <?php if ( $upcoming_posts->have_posts() ): ?>
                <?php while($upcoming_posts->have_posts()) : $upcoming_posts->the_post(); ?>
                <div class="event">
                    <div class="column-33 photo">
                    <?php if( have_rows('event_photos') ) : ?>
                    <?php while( have_rows('event_photos') ) : the_row(); ?>
                        <div class="img">
                            <?php 
                            $image = get_sub_field('photo');
                            if( !empty( $image ) ): ?>
                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                    <?php endif; ?>
                    </div>
                    
                    <div class="column-66 content">
                        <div class="media-mention_info">
                            <h2 class="title"><?php the_title(); ?></h2>
                            <h3><?php the_field('event_display_date'); ?></h3>
                            <div class="desc"><?php echo postali_limit_event_copy(get_field('event_copy'), 2); ?></div>
                        </div>
                    </div> 
                </div>
                <?php endwhile; ?>
                <?php endif; ?>
                </div>

            </div>
        </div>
    </section>

    <section id="panel-2" class="tan-bg">
        <span id="main-content"></span>
        <div class="container">
            <div class="columns">
                    <?php if ( $past_posts -> have_posts() ):
                        while($past_posts->have_posts()) : $past_posts->the_post(); 
                            $image = get_field('image');
                            $image_url = $image ? $image['url'] : null;
                            $image_alt = $image ? $image['alt'] : null;
                            $link = get_field('link');
                            $cta_text = get_field('cta_text');
                            $no_follow = get_field('add_no_follow'); ?>

                            <div class="event">
                                <div class="column-50 photo">
                                <?php if( have_rows('event_photos') ) : ?>
                                <?php while( have_rows('event_photos') ) : the_row(); ?>

                                    <?php $count = 0;
                                    $photos = get_field('event_photos');
                                    if (is_array($photos)) {
                                    $count = count($photos);
                                    }

                                    if ($count > 1) { ?>
                                        <div class="img two">
                                            <?php 
                                            $image = get_sub_field('photo');
                                            if( !empty( $image ) ): ?>
                                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                            <?php endif; ?>
                                        </div>
                                    <? } else { ?>
                                        <div class="img">
                                            <?php 
                                            $image = get_sub_field('photo');
                                            if( !empty( $image ) ): ?>
                                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                            <?php endif; ?>
                                        </div>
                                    <? } ?>

                                <?php endwhile; ?>
                                <?php endif; ?>
                                </div>
                                
                                <div class="media-mention column-50 content">
                                    <div class="media-mention_info">
                                        <h2 class="title"><?php the_title(); ?></h2>
                                        <h3><?php the_field('event_display_date'); ?></h3>
                                        <div class="desc"><?php echo postali_limit_event_copy(get_field('event_copy'), 2); ?></div>
                                    </div>
                                </div> 
                            </div>

                            <?php endwhile; ?>
                        <?php
                        $total_pages = $past_posts->max_num_pages;

                        if ($total_pages > 1){
                    
                            $current_page = max(1, get_query_var('paged'));
             
                            echo '<div class="pagination">' . paginate_links( array(
                                'base' => get_pagenum_link(1) . '%_%',
                                'current' => $current_page,
                                'format'       => '?paged=%#%',
                                'show_all'     => false,
                                'type'         => 'plain',
                                'end_size'     => 2,
                                'mid_size'     => 1,
                                'prev_next'    => true,
                                'prev_text'    => __( '<span></span>', 'textdomain' ),
                                'next_text'    => __( '<span></span>', 'textdomain' ),
                                'add_args'     => false,
                                'total' => $total_pages,
                                'add_fragment' => '',
                            ) ) . '</div>';
                        }    ?>
                    <?php endif; 
                    wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
</main>

<?php get_footer();
