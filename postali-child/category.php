<?php
/**
 * Template Category
 * 
 * @package Postali Child
 * @author Postali LLC
 */

get_header(); ?>

<main id="page">
    <section id="hero" class="default dk-teal-bg">
        <div class="container">
            <div class="columns">
                <div class="column-50 direction-col">
                    <?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?> 
                    <h4>See Our Expertise</h4>
                    <h1>Legal Blog</h1>
                    <?php get_template_part('block', 'category-select'); ?>
                </div>
            </div>
        </div>
    </section>
    <section id="panel-1" class="tan-bg">
        <div class="container">
            <div class="columns">
                <div class="column-full direction-col">
                    <?php if( have_posts() ) : ?>
                        <div class="blog-grid">
                            <?php while( have_posts() ) : 
                                the_post(); 
                                $categories = get_the_category();
                                $category_string = '<span class="categories">';
                                $category_count = 0;
                                $category_total = count($categories);
                                foreach( $categories as $category) {
                                    $category_count++;
                                    $name = $category->name;
                                    $slug = $category->slug;
                                    $category_string .= "<a class='category-link' aria-label='view posts about ${name}' title='view posts about ${name}' href='/blog/category/${slug}/'>${name}</a>";
                                    if( $category_total > 1 && $category_count > 0 && $category_count !== $category_total) {
                                        $category_string .= ', ';
                                    }
                                }
                                $category_string .= '</span>';
                                $post_img = get_field('banner_image');?>
                            <article class="post link-finder">
                                <?php if( $post_img ) :  ?><img src="<?php _e( $post_img['url'] ); ?>" alt="<?php _e( $post_img['alt'] ); ?>" title="<?php _e( $post_img['title'] ); ?>"><?php endif; ?>
                                <div class="copy">
                                    <p><?php echo the_date('F d, Y'); ?></p>
                                    <p class="category"><strong>Category: </strong><?php _e( $category_string ); ?></p>
                                    <h3 class="blog-title"><a href="<?php the_permalink(); ?>" title="learn more about <?php the_field('title'); ?>"><?php the_field('title'); ?></a></h3>
                                </div>
                            </article>

                            <?php endwhile; ?>
                        </div>
                        <?php _e( get_pagination() ); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
