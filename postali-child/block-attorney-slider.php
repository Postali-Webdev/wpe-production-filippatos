<?php /* Block: Attorney Slider */

$args = [
    'post_type' => 'attorneys',
    'post_status' => 'publish',
    'posts_per_page'     => -1
];

$attorney_query = new WP_Query($args);

if( $attorney_query->have_posts() ) : ?>

<a href="/careers/" class="single-attorney careers-link">
    <span class="career-title">See Yourself Here</span>
    <span class="btn">Job Openings</span>
</a>

<div id="attorney-slider">
    <?php while( $attorney_query->have_posts() ) : $attorney_query->the_post(); 
        // ACF Fields
        $attorney_img = get_field('attorney_image');
        $middle_initial = get_field('middle_initial') ? " " . get_field('middle_initial') . " " : " ";
        $attorney_name = get_field('first_name') . $middle_initial . get_field('last_name');
        $attorney_id = strtolower(str_replace([' ', '.'], ['-', ''], $attorney_name));
    ?>
    <a class="single-attorney" id="single-attorney-<?php esc_html_e($attorney_id); ?>" href="<?php _e( get_the_permalink() ); ?>" >
            <div class="attorney-wrap">
                <img class="attorney-img" src="<?php _e( $attorney_img['url'] ); ?>" title="<?php _e( $attorney_img['title'] ); ?>" alt="<?php _e( $attorney_img['alt'] ); ?>" />
                <p class="name"><?php _e( $attorney_name ); ?></p>
                <p class="title"><?php the_field('job_title'); ?></p>
            </div>
    </a>
    <?php endwhile; ?>
</div>
<?php endif; wp_reset_postdata(); ?>
