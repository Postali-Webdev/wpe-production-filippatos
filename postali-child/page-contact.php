<?php
/**
 * Template Name: Contact
 * @package Postali Child
 * @author Postali LLC
**/

// ACF Fields
$banner_img = get_field('hero_banner_image');
$zoom_cta_group = get_field('zoom_cta');
$zoom_cta = $zoom_cta_group['button'];
$form_cta_group = get_field('form_cta');
$form_cta = $form_cta_group['button'];

get_header();?>

<main id="page">
    <section id="hero" class="banner dk-teal-bg">
        <div class="container">
            <div class="columns">
                <div class="column-full direction-col">
                    <?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?> 
                    <p class="subheading-small"><?php the_field('sub_title'); ?></p>
                    <h1><?php the_field('hero_title'); ?></h1>
                    <div class="contact-info-container" id="main-content">
                        <div class="columns">
                            <div class="column-50 direction-col">
                                <div class="columns">
                                    <h4>White Plains, NY</h4>
                                </div>
                                <div class="columns">
                                    <img src="/wp-content/uploads/2022/12/contact-phone.svg" alt="phone icon" title="phone icon">
                                    <a aria-label="call our office at <?php _e( $vanity_phone_number ); ?>" title="call our office at <?php _e( $vanity_phone_number ); ?>"  href="tel:<?php _e( $actual_phone_number ); ?>"><?php _e( $vanity_phone_number ); ?></a>
                                </div>
                                <div class="columns">
                                    <img src="/wp-content/uploads/2022/12/contact-email.svg" alt="letter icon" title="letter icon">
                                    <a aria-label="email our office at <?php the_field('email', 'options');  ?>" title="email our office at <?php the_field('email', 'options');  ?>"  href="mailto:<?php the_field('email', 'options'); ?>"><?php the_field('email', 'options'); ?></a>
                                </div>
                                <div class="columns">
                                    <img src="/wp-content/uploads/2022/12/contact-location.svg" alt="map pin icon" title="map pin icon">
                                    <div class="directions">
                                        <p><?php the_field('address', 'options'); ?></p>
                                        <a aria-label="directions to our office" title="directions to our office"  href="<?php the_field('gmb_directions_url', 'options') ?>" target="_blank">Directions</a>
                                    </div>
                                </div>
                            </div>
                            <div class="column-50">
                                <iframe src="<?php the_field('map_iframe_embed', 'options'); ?>" title="Embedded Google map" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>

                        <?php if( have_rows( 'office_locations', 'options') ) : ?>
                        <div class="columns">
                            <div class="column-50">
                                <?php while( have_rows( 'office_locations', 'options') ) : the_row(); 
                                $location_name = get_sub_field('location_name');
                                $location_phone = get_sub_field('phone_number'); 
                                $location_address = get_sub_field('address'); 
                                $location_directions = get_sub_field('gmb_directions_url'); 
                                $location_map_url = get_sub_field('map_url'); ?>
                                <div class="columns">
                                    <h4><?php _e( $location_name ); ?></h4>
                                </div>
                                <div class="columns">
                                    <img src="/wp-content/uploads/2022/12/contact-phone.svg" alt="phone icon" title="phone icon">
                                    <a aria-label="call our office at <?php _e( $location_phone ); ?>" title="call our office at <?php _e( $location_phone ); ?>"  href="tel:<?php _e( $location_phone ); ?>"><?php _e( $location_phone ); ?></a>
                                </div>
                                <div class="columns">
                                    <img src="/wp-content/uploads/2022/12/contact-location.svg" alt="map pin icon" title="map pin icon">
                                    <div class="directions">
                                        <p><?php echo $location_address; ?></p>
                                        <a aria-label="directions to our office" title="directions to our office"  href="<?php echo $location_directions; ?>" target="_blank">Directions</a>
                                    </div>
                                </div>
                            </div>
                            <div class="column-50">
                                <div class="columns">
                                    <iframe src="<?php echo $location_map_url; ?>" title="Embedded Google map" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>
                            </div>
                            <?php endwhile; ?>
                        </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
        <img class="banner-img" src="<? _e( $banner_img['url'] ); ?>" alt="<? _e( $banner_img['alt'] ); ?>" title="<? _e( $banner_img['title'] ); ?>" />
    </section>

    <section id="panel-1" class="tan-bg">
        <div class="container">
            <div class="columns">
                <div class="column-50">
                    <div class="clio-form-wrapper">
                        <?php echo do_shortcode('[grow-contact-form]'); ?>
                    </div>
                </div>
                
                <!-- comment out zoom and form CTA
                <div class="column-50 direction-col">
                    <div class="zoom-contact">
                        <h2><?php _e($zoom_cta_group['title']); ?></h2>
                        <p><?php _e($zoom_cta_group['copy']); ?></p>
                        <a target="_blank" title="set up a zoom call" href="<?php _e($zoom_cta['url']); ?>" class="btn"><?php _e($zoom_cta['title']); ?></a>
                    </div>
                        <h2><?php _e($form_cta_group['title']); ?></h2>
                        <p><?php _e($form_cta_group['copy']); ?></p>
                        <a target="_blank" title="fill out our contact form online" href="<?php _e($form_cta['url']); ?>" class="btn"><?php _e($form_cta['title']); ?></a>
                    </div> 
                </div> -->
            </div>
        </div>
    </section>



</main><!-- #page -->

<?php get_footer();?>