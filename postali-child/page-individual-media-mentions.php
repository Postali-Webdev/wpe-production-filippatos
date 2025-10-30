<?php
/**
 * Template Name: Individual Case Media Mentions
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
                    <h1><?php the_field('hero_title'); ?></h1>
                    <?php if( get_field('hero_intro_copy') ) : ?>
                        <p><?php the_field('hero_intro_copy'); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <section id="panel-1" class="tan-bg">
        <span id="main-content"></span>
        <div class="container">
            <div class="columns">
                <div class="column-66 center direction-col block">
                    <?php if( have_rows('body_content') ) : ?>
                        <?php while( have_rows('body_content') ) : the_row();?>

                            <?php if( get_row_layout() == 'copy_block' ) {
                                $copy_block = '';
                                if( get_sub_field('adjust_margins') ) {
                                    $custom_margins = get_sub_field('custom_margins');
                                    $margin_top = $custom_margins['top'] ? $custom_margins['top'] : 0;
                                    $margin_right = $custom_margins['right'] ? $custom_margins['right'] : 0;
                                    $margin_bottom = $custom_margins['bottom'] ? $custom_margins['bottom'] : 0;
                                    $margin_left = $custom_margins['left'] ? $custom_margins['left'] : 0;
                                    $copy_block .= "<div class='copy-block' style='margin: {$margin_top}px {$margin_right}px {$margin_bottom}px {$margin_left}px;'>";
                                } else {
                                    $copy_block .= "<div class='copy-block'>";
                                }
                                $copy_block .= get_sub_field('copy') . "</div>";
                                echo $copy_block;
                            } 
                            
                            if( get_row_layout() == 'media_mention_block') :
                                $title = get_sub_field('title');
                                $image = get_sub_field('image');
                                $video = get_sub_field('video_embed_url');
                                $copy = get_sub_field('copy');
                                $cta = get_sub_field('cta');
                                $no_follow = get_sub_field('add_no_follow');
                            ?>
                                <div class="media-mention">
                                    <?php if ( !empty($image) ) : ?>
                                    <div class="media-mention_image">
                                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                    </div>
                                    <?php endif; ?>

                                    <?php if ( !empty($video) ) : ?>
                                    <div class="responsive-iframe">
                                        <iframe src="<?php esc_html_e($video); ?>" title="watch video about <?php echo $title; ?>" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; web-share" allowfullscreen></iframe>
                                    </div>
                                    <?php endif; ?>

                                    <div class="media-mention_info">
                                        <h3 class="title"><?php echo $title; ?></h3>
                                        <div class="desc"><p><?php echo $copy; ?></p></div>
                                        <?php if($cta) : ?><a class="mention-link" <?php echo ( $no_follow === true) ? "rel='nofollow'" : ''; ?> href="<?php echo $cta['url']; ?>" title="<?php echo $cta['title']; ?>" target="_blank"><?php echo $cta['title']; ?> ></a><?php endif; ?>
                                    </div>
                                
                                </div>
                            <?php endif; ?>


                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>