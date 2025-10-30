<?php
/**
 * Template Name: Blog
 * 
 * @package Postali Child
 * @author Postali LLC
 */

 $categories = get_the_category();
//  $primary_category_name = $categories[0]->name;
 $primary_category_slug = $categories[0]->slug;
 $category_string = '<span class="categories">';
 $category_count = 0;
 $category_total = count($categories);
 foreach( $categories as $category) {
     $category_count++;
     $name = $category->name;
     $slug = $category->slug;
     $category_string .= "<a aria-label='view posts about ${name}' title='view posts about ${name}' href='/blog/category/${slug}/'>${name}</a>";
     if( $category_total > 1 && $category_count > 0 && $category_count !== $category_total) {
         $category_string .= ', ';
     }
 }
 $category_string .= '</span>';
 $post_img = get_field('banner_image');


 $related_page_args = [
    'post_type'         => 'page',
    'post_status'       => 'publish',
    'posts_per_page'    => 1,
    'category_name'       =>  $primary_category_slug,
    'meta_query'        => [
        [
            'key'       => '_wp_page_template',
            'value'     => 'page-pa-parent.php'
        ]
    ]
];
$related_page_query = new WP_Query($related_page_args);

get_header(); ?>

<main id="page">
    <section id="hero" class="dk-teal-bg">
        <div class="container">
            <div class="columns">
                <div class="column-50 direction-col">
                    <?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?> 
                    <h4><?php _e( $category_string ); ?></h4>
                    <h1><?php the_field('title'); ?></h1>
                    <p class="date"><?php echo the_date('F d, Y'); ?></p>
                    
                </div>
                <div class="column-50">
                    <?php if( $post_img ) :  ?><img src="<?php _e( $post_img['url'] ); ?>" alt="<?php _e( $post_img['alt'] ); ?>" title="<?php _e( $post_img['title'] ); ?>"><?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <section id="panel-1" class="tan-bg">
        <span id="main-content"></span>
        <div class="container">
            <div class="columns">
                <div class="column-50 direction-col main-copy">
                    <?php $author = get_field('author');
                    if( $author ) : 
                    $author_pic = get_field('attorney_image', $author); ?>
                        <div class="author">
                            <?php if( $author_pic ) : ?><img class="author-pic" src="<?php _e( $author_pic['url'] ); ?>" alt="author bio pic of <?php _e( get_field('first_name', $author) . ' ' . get_field('middle_initial', $author) . ' ' . get_field('last_name', $author) ) ?>" title="author bio pic of <?php _e( get_field('first_name', $author) . ' ' . get_field('middle_initial', $author) . ' ' . get_field('last_name', $author) ); ?>"><?php endif; ?>
                            <div class="copy-wrapper">
                                <p class="author-name">Written by <a href="<?php _e( get_the_permalink($author) ); ?>"><?php _e( get_field('first_name', $author) . ' ' . get_field('middle_initial', $author) . ' ' . get_field('last_name', $author) ); ?></a></p>
                                <p class="sub-text">Brought to you by Filippatos Employment Law, Litigation & ADR</p>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="author">
                            <img class="author-pic" src="/wp-content/uploads/2023/02/headshot-lily-filippatos.png" alt="author bio pic of Parisis G. Filippatos" title="author bio pic of Parisis G. Filippatos">
                            <div class="copy-wrapper">
                                <p class="author-name">Written by <a href="/about/our-team/lily-filippatos/">Lily Filippatos</a></p>
                                <p class="sub-text">Brought to you by Filippatos Employment Law, Litigation & ADR</p>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php the_field('main_copy'); ?>
                    <div class="spacer-15"></div>
                    <?php the_field('closing_cta'); ?>
                    
                </div>
                
                <aside class="column-50 direction-col">
                        
                    <?php get_template_part('block', 'related-posts'); ?>
                    
                    <div class="related-links">
                    <h4>Related Links</h4>
                        <div class="related-link link-finder">
                            <a href="/blog/category/<?php _e( $primary_category_slug ); ?>/">More Blogs In This Category</a>
                        </div>
                        <?php if( $related_page_query->have_posts() ) : while( $related_page_query->have_posts() ) : $related_page_query->the_post(); ?>
                        <div class="related-link link-finder">
                            <a href="<?php _e( get_the_permalink() );  ?>">Practice Area Related to This Blog</a>
                        </div>
                        <?php endwhile; endif; wp_reset_postdata(); ?>
                        <div class="related-link link-finder">
                            <a href="<?php _e( $author ? get_the_permalink($author) : '/about/our-team/parisis-g-filippatos/' ) ?>">Authors' Bio Page</a>
                        </div>

                        <?php if( have_rows('related_links') ) : ?>
                            <?php while( have_rows('related_links') ) : 
                                the_row(); 
                                $link = get_sub_field('related_link'); ?>
                                <div class="related-link link-finder">
                                    <a href="<?php _e( $link['url'] ); ?>"><?php _e( $link['title'] ); ?></a>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </aside>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
