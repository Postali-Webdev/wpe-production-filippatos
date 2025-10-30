<?php /* Block: Related Posts */

//$number_posts = $args['data']['number_posts'] ? $args['data']['number_posts'] : 5;

if( is_single() ) {
    $number_posts = 2;
} else {
    $number_posts = 5;
}

$categories = get_the_category();


if( $categories ) {
    $category_id = $categories[0]->cat_ID; 
} else {
    $category_id = 0;
}



?>

<?php $args = array( 
    'post_type'         => 'post',
    'post_status'       => 'publish',
    'posts_per_page'    => $number_posts, 
    'cat'          => $category_id,
    'post__not_in'      => array( $post->ID )
);

$related_posts = new WP_Query( $args );
?>

<?php if( $related_posts->have_posts() ) : ?>
    
    <h4 class="related-blogs-title">Related Blogs</h4>
    
    <div class="featured-posts-container grid-<?php esc_html_e( $related_posts->found_posts ); ?>">
        <?php while( $related_posts->have_posts() ) : $related_posts->the_post(); 
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
                    <p class="date"><?php echo the_date('F d, Y'); ?></p>
                    <p class="category"><?php _e( $category_string ); ?></p>
                    <h3 class="blog-title"><a href="<?php the_permalink(); ?>" title="learn more about <?php the_field('title'); ?>"><?php the_field('title'); ?></a></h3>
                </div>
            </article>
        <?php endwhile; ?>
    </div>
<?php endif; wp_reset_postdata();?>    