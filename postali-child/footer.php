<?php
/**
 * Theme footer
 *
 * @package Postali Child
 * @author Postali LLC
**/

// ACF Fields
$vanity_phone_number = get_field('phone', 'options');
$actual_phone_number = get_field('actual_phone_number', 'options');

?>
<footer>
    <?php if( !is_page_template('page-contact.php') ) : ?>
    <section id="pre-footer" class="ming-bg">
        <div class="container">
            <div class="columns">
                <div class="column-75 direction-col">
                    <h2><?php the_field('pre_footer_title', 'options'); ?></h2>
                    <div class="cta-wrapper">
                        <a aria-label="call our office at <?php _e( $vanity_phone_number ); ?>" title="call our office at <?php _e( $vanity_phone_number ); ?>"  href="tel:<?php _e( $actual_phone_number ); ?>" class="btn"><?php _e( $vanity_phone_number ); ?></a>
                        <span class="divide"></span>
                        <p><?php the_field('pre_footer_copy', 'options'); ?></p>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
    <!-- Utility Footer -->
    <section id="copyright" class="dk-teal-bg">
        <div class="container">
            <div class="columns column-stretch">
                <div class="column-33">
                    <?php get_template_part('block', 'site-logo'); ?>

                    <span class="subheading-small">Together we win.</span>
                    <span class="spacer-30"></span>
                    
                    <div class="footer-nav">
                        <?php wp_nav_menu( [ 'container' => false, 'theme_location' => 'footer-nav' ] ); ?>
                        <?php if( get_field('footer_award', 'options') ) : 
                            $footer_award = get_field('footer_award', 'options'); ?>
                            <div class="footer-award-wrapper">
                                <img src="<?php _e( $footer_award['url'] ); ?>" alt="<?php _e( $footer_award['alt'] ); ?>">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="column-66">
                    <div class="columns contact-info-wrapper">
                        <?php if( !is_page_template('page-contact.php') ) : ?>
                        <div class="column-50 direction-col contact-info">
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
                            <div class="columns">
                                <iframe src="<?php the_field('map_iframe_embed', 'options'); ?>" title="Embedded Google map" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>

                        <?php if( have_rows( 'office_locations', 'options') ) : ?>
                        <div class="column-50 direction-col contact-info">
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
                            <div class="columns">
                                <iframe src="<?php echo $location_map_url; ?>" title="Embedded Google map" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                            <?php endwhile; ?>
                        </div>
                        <?php endif; ?>

                        <?php endif; ?>
                    </div>
                    <p class="copyright"><?php the_field('copyright', 'options'); ?></p>
                    <div class="footer-resources"><?php wp_nav_menu( [ 'container' => false, 'theme_location' => 'footer-resources' ] ); ?> <p class="copyright-year">Copyright &copy; <?php echo date('Y'); ?> Filippatos PLLC. All rights reserved.</p></div>
                    <?php if(is_page_template('front-page.php')) { ?>
                    <div class="spacer-30"></div>
                    <a href="https://www.postali.com" title="Site design and development by Postali" target="blank" style="margin-bottom:0 !important;"><img src="https://www.postali.com/wp-content/themes/postali-site/img/postali-tag-reversed.png" alt="Postali | Results Driven Marketing" style="display:block; max-width:250px; margin:0;"></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>

</footer>

<?php wp_footer(); ?>

<script type="text/javascript" src="//cdn.callrail.com/companies/476454887/733bb4c1a5ec65de5d9a/12/swap.js"></script>

<!-- intaker chat -->
<script>(function (w,d,s,v,odl){(w[v]=w[v]||{})['odl']=odl;; var f=d.getElementsByTagName(s)[0],j=d.createElement(s);j.async=true; j.src='https://intaker.azureedge.net/widget/chat.min.js'; f.parentNode.insertBefore(j,f); })(window, document, 'script','Intaker', 'filippatoslaw'); </script>


</body>
</html>


