<?php /* Block: Awards Slider */

if( have_rows('awards', 'options') ) : 
    $total_awards = count(get_field('awards', 'options'));
    $count = 0; ?>
    <div class="awards-wrapper">
        <?php while( have_rows('awards', 'options') ) : the_row();
            $count++;
            // ACF Fields
            $logo = get_sub_field('logo');
            $description = get_sub_field('description');
        ?>

            <?php if( $count == 1 ) : ?><div id="top-awards-slider"><?php endif; ?>
            <?php if( $count == ceil( $total_awards / 2 ) + 1) : ?><div dir="rtl" id="bottom-awards-slider"><?php endif; ?>
                <div class="award">
                    <?php $image_metadata = wp_get_attachment_metadata( $logo['id'] );
                    $image_filename = $image_metadata['file']; 
                    $image_name = pathinfo($image_filename);?>
                    <img class="award-icon" id="<?php echo $image_name['filename']; ?>" src="<?php _e( $logo['url'] ); ?>" title="<?php _e( $logo['title'] ); ?>" alt="<?php _e( $logo['alt'] ); ?>" />
                    <div id="award-details-<?php _e($count); ?>" aria-hidden="true" role="dialog" class="more-info lity-hide">
                        <p><?php _e( $description ); ?></p>
                    </div>
                    <a data-lity href="#award-details-<?php _e($count); ?>" class="btn plus" aria-label="read more" aria-haspopup="dialog"></a>
                </div>
            <?php if( $count == ceil( $total_awards / 2 ) ) : ?></div><?php endif; ?>
            <?php if( $count == $total_awards ) : ?></div><?php endif; ?>
        <?php endwhile; ?>
    </div>
    
<?php endif; ?>