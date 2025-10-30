<?php /* Block: Recent Posts*/ ?>

<?php $args = array( 
    'post_type'         => 'post',
    'post_status'       =>'publish',
    'posts_per_page'    => 5,
    'orderby'           => 'date',
    'order'             => 'DESC'
);

$recent_posts = new WP_Query( $args );
?>

<?php if( $recent_posts->have_posts() ) : ?>
    <div class="featured-posts-container grid-<?php esc_html_e( $recent_posts->found_posts ); ?>">
        <?php while( $recent_posts->have_posts() ) : $recent_posts->the_post(); 
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
        $post_img = get_field('banner_image');
        ?>
            <article class="featured-post link-finder">
            <?php if( $post_img ) :  ?><img src="<?php _e( $post_img['url'] ); ?>" alt="<?php _e( $post_img['alt'] ); ?>" title="<?php _e( $post_img['title'] ); ?>"><?php endif; ?>
                <div class="copy">
                    <p class="date"><?php echo the_date('M d, Y'); ?></p>
                    <p class="category"><?php _e( $category_string ); ?></p>
                    <h3 class="blog-title"><a href="<?php the_permalink(); ?>" title="learn more about <?php the_field('title'); ?>"><?php the_field('title'); ?></a></h3>
                </div>
            </article>
        <?php endwhile; ?>
    </div>
<?php endif; wp_reset_postdata();?>    


