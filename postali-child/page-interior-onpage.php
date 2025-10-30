<?php
/**
 * Interior with sidebar
 * Template Name: Interior - On Page Nav 
 * @package Postali Parent
 * @author Postali LLC
 */
get_header(); ?>

<script src="/wp-content/themes/postali-child/assets/js/src/smooth-scroll-custom.js"></script>
<script src="/wp-content/themes/postali-child/assets/js/src/interior-on-page.js"></script>

<div class="body-container">

<?php if (has_post_thumbnail( $post->ID ) ): ?>
  <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
<?php endif; ?>

    <section id="hero" class="dk-teal-bg" style="background-image: url('<?php echo $image[0]; ?>')">
        <div class="container">
            <?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?> 
            <div class="columns">
                <div class="column-66 intro-container">
                    <div class="container">
                        <h1><?php the_title(); ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="sidebar-links">
    <?php if( have_rows('content_block') ): ?>
    <? $i=1; ?>
    <p>ON THIS PAGE:</P>
    <ul>
    <?php while( have_rows('content_block') ): the_row(); ?>  
        <?php 
        $title = get_sub_field('on_page_nav_title') ? get_sub_field('on_page_nav_title') : get_sub_field('block_title');
        if ($title) { ?>
            <li><a href="#panel_<?php echo $i; ?>"><?php echo $title; ?></a></li>
        <?php } ?>
    <?php $i++; ?>
    <?php endwhile; ?>
    </ul>
    <?php endif; ?> 
    </div>

    <div class="mobile-sidebar-links">
        <?php if( have_rows('content_block') ): ?>
        <? $i=1; ?>
        <ul>
            <li>
                <a class="expand"><span>On This Page</span> &nbsp; <span class="icon-expand"></span></a>
                <div class="detail">
                    <div class="links">
                    <?php while( have_rows('content_block') ): the_row(); ?>      
                        <?php if (get_sub_field('block_title')) { ?>
                            <a href="#panel_<?php echo $i; ?>"><?php the_sub_field('block_title'); ?></a>
                        <?php } ?>
                    <?php $i++; ?>
                    <?php endwhile; ?>
                    </div>
                </div>
            </li>
        </ul>
        <?php endif; ?> 
    </div>

    <section class="main-content-container">
        <span id="main-content"></span>
    	<div class="container">
            <div class="columns">
                <div class="column-75 block">
                <?php if( have_rows('content_block') ): ?>
                <? $n=1; ?>
                <?php while( have_rows('content_block') ): the_row(); ?>  
                    <div class="content-block" id="panel_<?php echo $n; ?>">
                        <h2><?php the_sub_field('block_title'); ?></h2>
                        <?php the_sub_field('main_content'); ?>
                        <?php if (get_sub_field('include_accordions')) { ?>
                            <?php if( have_rows('accordions') ): ?>
                            <div class="accordions">
                            <?php while( have_rows('accordions') ): the_row(); ?>  
                                <div class="accordions_title">
                                    <h3><?php the_sub_field('accordion_title'); ?></h3><span></span>
                                </div>
                                <div class="accordions_content">
                                    <?php the_sub_field('accordion_content'); ?>
                                </div>
                            <?php endwhile; ?>
                            </div>
                            <?php endif; ?>
                        <?php } ?>
                    </div>
                <?php $n++; ?>
                <?php endwhile; ?>
                <?php endif; ?> 
                </div>
			</div>
		</div>
    </section>

</div>
		
<?php get_footer(); ?>