<?php
/**
 * Media Mentions Page
 * Template Name: Media Mentions
 * @package Postali Parent
 * @author Postali LLC
 */

$hero_banner = get_field('hero_image');
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
 $custom_query = new WP_Query(
     array(
         'post_type' => 'media_mentions',
         'posts_per_page' => 5,
         'paged'    => $paged,
         'orderby'   => array(
             'date' =>'DESC',
             'menu_order'=>'ASC',
         ),
     )
 );



get_header(); ?>

<main id="page">
    <section id="hero" class="tan-bg">
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
                <div class="column-50 direction-col">
                    <h3 class="assets_left_cta">Need Our Brand Assets?</h3>
                    <h4 class="assets_left_content">Media Contact: 
                        <a class="assets_left_content_link" href="mailto:<?php the_field('email'); ?>" title="Email Postali"><?php the_field('email'); ?></a>
                    </h4>
                </div>
                <div class="column-50 social-container">
                <?php if ( have_rows('social_links') ): ?>
                    <?php while ( have_rows('social_links') ): the_row(); 
                        $social         = get_sub_field('name');
                        $social_url     = get_sub_field('url');
                        $social_icon    = get_sub_field('icon');
                        $icon_alt       = $social_icon ? $social_icon['alt'] : null;
                        $icon_src       = $social_icon ? $social_icon['url'] : null;
                    ?>  
                        <div class="social">
                            <a href="<?php echo $social_url; ?>" target="_blank" class="social-icon social-icon_<?php echo strtolower($social); ?>" title="<?php echo $social; ?>">
                            </a>
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
                <div class="column-full center direction-col">                
                    <h2 class="media-title">Media Coverage</h2>
                    <?php if ( $custom_query -> have_posts() ):
                        while($custom_query->have_posts()) : $custom_query->the_post(); 
                            $image = get_field('image');
                            $image_url = $image ? $image['url'] : null;
                            $image_alt = $image ? $image['alt'] : null;
                            $link = get_field('link');
                            $cta_text = get_field('cta_text');
                            $no_follow = get_field('add_no_follow'); ?>
                    		
                            <div class="media-mention column-66">
                                <?php if ( !empty($image) ) { ?>
                                    <!-- <div class="media-mention_image">
                                        <img src="" alt="" />
                                    </div> -->
                                <?php } ?>
                                <div class="media-mention_info">
                                    <h2 class="title"><?php the_title(); ?></h2>
                                    <div class="desc"><p><?php the_content(); ?></p></div>
                                    <?php if($link) : ?><a class="mention-link" <?php echo ( $no_follow === true) ? "rel='nofollow'" : ''; ?> href="<?php echo $link; ?>" title="<?php the_title(); ?>" target="_blank"><?php echo $cta_text; ?> ></a><?php endif; ?>
                                </div>
                            </div> 

                            <?php endwhile; ?>
                        <?php
                        $total_pages = $custom_query->max_num_pages;

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
        </div>
    </section>
</main>

<?php get_footer();
