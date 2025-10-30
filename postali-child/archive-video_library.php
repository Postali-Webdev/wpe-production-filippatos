<?php
/**
 * Template: Hiring Page
 * @package Postali Child
 * @author Postali LLC
**/

$wp_query = new WP_Query( array(
    'posts_per_page'    => -1,
    'post_type'         => 'video_library', 
    'order'             => 'DESC',
) );

get_header(); ?>

<main id="page">
    <section id="hero" class="dk-teal-bg">
        <div class="container">
            <?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?> 
            <div class="columns">
                <div class="column-full center direction-col">
                    <h1>Video Library</h1>
                </div>
            </div>
        </div>
    </section>
    <section id="panel-1" class="tan-bg">
        <span id="main-content"></span>
        <div class="container">
            <div class="columns">
                <div class="column-full center direction-col">
                    <h2 class="btm-margin">TikTok Videos</h2>
                    <div class="tagembed-widget" style="width:100%;height:100%;overflow:auto;" data-widget-id="290150" website="1"></div><script src="https://widget.tagembed.com/embed.min.js" type="text/javascript"></script>
                </div>
            </div>

            <div class="spacer-60"></div>
            
            <div class="columns youtube">
                <h2>YouTube Videos</h2>
                <div class="spacer-break"></div>
                <?php if( $wp_query->have_posts() ) : ?>
                <?php while( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
                    <div class="column-33">
                        <div class="video-container">
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php the_field('youtube_embed_link'); ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        </div>
                        <div class="spacer-15"></div>
                        <h3><?php the_title(); ?></h3>
                    </div>
                <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>