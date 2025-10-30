<?php
/**
 * Template Name: Results & Reviews Archive
 * @package Postali Child
 * @author Postali LLC
**/

// ACF Fields
$cases_group = get_field('cases');

$top_reviews_args = [
    'post_type'         => 'testimonials',
    'post_status'       => 'publish',
    'posts_per_page'    => 6
    
];
$top_reviews_query = new WP_Query( $top_reviews_args );



get_header();?>

<main id="page">

    <section id="hero" class="default dk-teal-bg">
        <div class="container">
            <div class="columns">
                <div class="column-full direction-col">
                    <?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?> 
                    <h4>See Our Success</h4>
                    <h1><?php the_field('hero_title'); ?></h1>

                    <div class="columns filter-icon-wrapper">
                        <div class="column-50">
                            <div class="filter-wrapper">
                                <select name="view-filter" id="view-filter">
                                    <option value="" selected disabled> See Just Reviews or Results</option>
                                    <option value="reviews">Reviews</option>
                                    <option value="results">Results</option>
                                    <option value="all">View All</option>
                                </select>
                            </div>
                        </div>
                        <div class="column-50">
                            <a target="_blank" title="read google reviews" href="https://www.google.com/search?q=filippatos+law+llc&oq=filippatos+law+llc&aqs=chrome..69i57j69i64j69i60l3.5816j0j1&sourceid=chrome&ie=UTF-8#lrd=0x89c2953107b1cefd:0xcc1ff59ef4fdc762,1,,,,"><img src="/wp-content/uploads/2022/12/google-reviews-5-stars.svg" alt="google 5 star review logo" title="google 5 star review logo"></a>
                        </div>
                    </div>
                   
                </div>
                
            </div>
        </div>
    </section>

    <div id="results">
        <section id="panel-1" class="tan-bg">
            <span id="main-content"></span>
            <div class="container">
                <div class="columns">
                    <div class="column-full">
                        <?php get_template_part( 'block', 'cases-won', [ 'data' => ['copy' => $cases_group['copy']] ] ); ?>
                    </div>
                </div>
            </div>
        </section>

        <section id="more-results-panel" class="dk-teal-bg">
            <span id="all-results"></span>
            <div class="container">
                <div class="columns">
                    <div class="column-50">
                        <h1>Our <span class="terracotta">Results</span></h1>    
                    </div>
                    <div class="column-50">
                        <p><?php _e( $cases_group['copy'] ); ?></p>
                    </div>
                    <div class="column-full">
                        <div class="all-results-grid">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <section id="reviews" class="tan-bg">
        <div class="container">
            <div class="columns">
                <div class="column-full">
                    <h2>Our Reviews</h2>
                    <a href="/review/" target="_blank" class="btn">Leave a Review</a>
                </div>
                <div class="column-full">
                <?php if( $top_reviews_query->have_posts() ) : ?>
                <div class="reviews-grid masonry-grid">
                    <?php while( $top_reviews_query->have_posts() ) : $top_reviews_query->the_post(); ?>
                        <div class="review grid-item" data-post-id="<?php _e( get_the_ID() ); ?>">
                            <span class="star-rating">★ ★ ★ ★ ★</span>
                            <h3><?php the_field('testimonial_title'); ?></h3>
                            <p><?php the_field('testimonial_description'); ?></p>
                            <span class="author-wrapper">
                                <?php if( get_field('testimonial_author') ) : ?>
                                <span class="author"><?php the_field( 'testimonial_author' ); ?></span> 
                                <span class="divider">|</span> 
                                <?php endif; ?>
                                <span class="review-source"><?php the_field('testimonial_review_source'); ?></span>
                            </span>
                        </div>
                    <?php endwhile; ?>
                </div>
                <button class="btn" title="load-more-reviews" id="load-more-reviews">Load More</button>
                <?php endif; wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
    </section>


</main>

<?php get_footer();?>