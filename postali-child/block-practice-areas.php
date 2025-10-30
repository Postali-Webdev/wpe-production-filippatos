<?php /* Block: Practice Areas */ 


$current_page_id = get_the_ID();

$practice_area_type = $args['data']['practice-area-type'];

$args = [
    'post_type'         => 'page',
    'posts_per_page'    => -1,
    'post_status'       => 'publish',
    'post_parent'       => $current_page_id,
    'order'             => 'ASC',
    'meta_query'        => [
        [
            'key'       => '_wp_page_template',
            'value'     => 'page-pa-parent.php'
        ],
        [
            'key'       => 'global_practice_area_type',
            'value'     => $practice_area_type
        ]
    ]
];
$practice_areas_query = new WP_Query($args);

if( $practice_areas_query->have_posts() ) :
?>
    <div class="pa-grid masonry-grid iso-masonry-grid">
        <?php while( $practice_areas_query->have_posts() ) : 
            $practice_areas_query->the_post(); 
            $pa_icon = get_field('global_pa_icon'); 
            $child_args = [
                'post_type'         => 'page',
                'posts_per_page'    => -1,
                'post_parent'       => $post->ID
            ];
            $pa_child_query = new WP_Query($child_args);
            $title = get_field('global_short_title') ? get_field('global_short_title') : get_field('hero_title');
            ?>
            <?php if( $pa_child_query->have_posts() ) : ?>
                <div class="practice-area grid-item iso-grid-item">                
            <?php else : ?>
                <a class="practice-area parent-link grid-item iso-grid-item" aria-label="learn more about <?php _e($title); ?>" title="learn more about <?php _e($title); ?>" href="<?php _e( get_the_permalink() ); ?>">
            <?php endif; ?>
            
                <?php if( $pa_child_query->have_posts() ) : ?>
                    <a class="parent-link" aria-label="learn more about <?php _e($title); ?>" title="learn more about <?php _e($title); ?>" href="<?php _e( get_the_permalink() ); ?>">
                <?php endif; ?>
                    <div class="copy-container">
                        <h3>
                            <?php _e($title); ?>
                        </h3>
                        <p><?php the_field('global_short_description'); ?></p>
                    </div>
                    <div class="icon-container">
                        <img class="icon" src="<?php _e($pa_icon['url']); ?>" alt="<?php _e($pa_icon['alt']); ?>" title="<?php _e($pa_icon['title']); ?>">
                        <div class="arrow-wrapper">
                            <img class="arrow-icon" src="/wp-content/uploads/2022/12/bubble-arrow-right.svg" alt="arrow icon" title="arrow icon">
                        </div>
                    </div>
                    <?php if( $pa_child_query->have_posts() ) : ?>
                            </a>
                    <?php endif; ?>

                    <?php if( $pa_child_query->have_posts() ) : 
                        while( $pa_child_query->have_posts() ) : 
                        $pa_child_query->the_post(); ?>
                        <a aria-label="<?php _e( get_the_title() ); ?>" title="learn more about <?php _e( get_the_title() ); ?>" href="<?php _e( get_the_permalink() ); ?>">
                            <div class="child-pa">
                                <p><?php _e( get_the_title() ); ?></p>
                            </div>
                        </a>
                        <?php endwhile;
                    endif; wp_reset_postdata(); ?>
                <?php if( $pa_child_query->have_posts() ) : ?>
                    </div>
                <?php else : ?>
                    </a>
                <?php endif; ?>
            
        <?php endwhile; ?>
    </div>
<?php endif; wp_reset_postdata(); ?>