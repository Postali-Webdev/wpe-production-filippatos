<?php
/**
 * Template: Default
 * @package Postali Child
 * @author Postali LLC
**/
get_header(); ?>

<main id="page">
    <section id="hero" class="dk-teal-bg">
        <div class="container">
            <?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?> 
            <div class="columns">
                <div class="column-66 center direction-col">
                    <h1>Search Results for</h1>
                    <h4 class="search-term"><?php _e( get_search_query() ); ?></h4>
                </div>
            </div>
        </div>
    </section>
    <section id="panel-1" class="tan-bg">
        <span id="main-content"></span>
        <div class="container">
            <div class="columns">
                <div class="column-66 center direction-col">
                    <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
                        <article class="search-result">
                            <h2><a href="<?php _e( get_the_permalink() ); ?>"><?php _e( get_the_title() ); ?></a></h2>
                            <p class="copy">
                                <?php 
                                    if ( has_excerpt() ) {
                                        the_excerpt();
                                    } else {
                                        excerpt_function($post->ID, $_GET['s']);
                                    } 
                                ?>
                            </p>
                        </article>
                    <?php endwhile; ?> 
                    <?php _e( get_pagination() ); ?>
                    <?php else : ?>
                        <p class="subtitle"><?php printf( esc_html__( 'Our apologies but there\'s nothing that matches your search for "%s"', 'postali' ), get_search_query() ); ?></p>
                        <div class="cta-wrapper">
                            <a href="/" class="btn"><span>Return to Home</span></a>
                            <?php echo(get_search_form()); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>