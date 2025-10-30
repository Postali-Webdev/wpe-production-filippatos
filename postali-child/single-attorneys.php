<?php
/**
 * Attorneys Template
 * @package Postali Child
 * @author Postali LLC
**/

// ACF Fields
$attorney_image = get_field('attorney_image');

get_header();?>

<main id="page">

<section id="hero" class="dk-teal-bg">
    <div class="container">
        <div class="columns">
            <div class="column-50 direction-col">
                <p id="breadcrumbs"><span><span><a href="/">Home</a></span> <span class="divider">|</span> <span><a href="/about/">Our Team</a></span> <span class="divider">|</span><span class="breadcrumb_last" aria-current="page"><?php _e( get_the_title() ); ?></span></span></p>
                <h4><?php the_field('job_title'); ?></h4>
                <h1><?php echo get_the_title(); ?></h1>
                <div class="info">
                    <div class="columns">
                        <img src="/wp-content/uploads/2022/12/contact-pronoun.svg" alt="person icon" title="person icon">
                        <p><?php the_field('pronouns'); ?></p>
                    </div>
                    <div class="columns">
                        <img src="/wp-content/uploads/2022/12/contact-phone.svg" alt="phone icon" title="phone icon">
                        <?php if( get_field('phone') ) : ?>
                            <a aria-label="call attorney <?php _e( get_field('first_name') . ' ' . get_field('last_name')) ?> at <?php _e( accessible_phone_numb( get_field('phone') ) ); _e( get_field('phone_extension') ? ' extension ' . get_field('phone_extension') : '' ); ?>" title="call attorney <?php _e( get_field('first_name') . ' ' . get_field('last_name')) ?> at <?php _e( accessible_phone_numb( get_field('phone') ) ); _e( get_field('phone_extension') ? ' extension ' . get_field('phone_extension') : '' ); ?>"  href="tel:<?php _e( get_field('phone') ); _e( get_field('phone_extension') ? ';' . get_field('phone_extension') : '' ); ?>">
                            <?php _e( readable_phone_numb(get_field('phone')) );
                            _e( get_field('phone_extension') ? ' ext.' . get_field('phone_extension') : '' );
                            ?>
                        </a>
                        <?php else : ?>
                            <a aria-label="call our office at <?php _e( $vanity_phone_number ); ?>" title="call our office at <?php _e( $vanity_phone_number ); ?>"  href="tel:<?php _e( $vanity_phone_number ); ?>"><?php _e( $vanity_phone_number ); ?></a>
                        <?php endif; ?>
                    </div>
                    <div class="columns">
                        <img src="/wp-content/uploads/2022/12/contact-email.svg" alt="letter icon" title="letter icon">
                        <?php if( get_field('email') ) : ?>
                        <a aria-label="email our office at <?php the_field('email');  ?>" title="email our office at <?php the_field('email');  ?>"  href="mailto:<?php the_field('email'); ?>"><?php the_field('email'); ?></a>
                        <?php else : ?>
                            <a aria-label="email our office at <?php the_field('email', 'options');  ?>" title="email our office at <?php the_field('email', 'options');  ?>"  href="mailto:<?php the_field('email', 'options'); ?>"><?php the_field('email', 'options'); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>

<section id="panel-1" class="tan-bg">
    <span id="main-content"></span>
    <div class="container">
        <div class="columns">
            <div class="column-50 block">

                <?php if(get_field('video')) { ?>
                    <div class="responsive-iframe"><iframe title="Bio video" src="<?php the_field('video'); ?>?h=1515d02bf2&amp;badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479" width="1920" height="1080" frameborder="0" allowfullscreen="allowfullscreen"></iframe></div>
                    <div class="spacer-30"></div>
                <?php } ?>

                <?php the_field('copy'); ?>

                <?php if( have_rows('accordion_copy') ) :  ?>
                    <?php while( have_rows('accordion_copy') ) : the_row(); ?>
                        <div class="accordions">
                            <div class="accordions_title">
                                <h3 class="accordion-title"><?php the_sub_field('title'); ?></h3>
                            </div>
                            <div class="accordions_content">
                                <?php the_sub_field('copy'); ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
            <div class="column-50 attorney-wrapper">
                <img class="attorney-img" src="<?php _e($attorney_image['url']); ?>" alt="<?php _e($attorney_image['alt']); ?>" title="<?php _e($attorney_image['title']); ?>">
            </div>
        </div>
    </div>
</section>

<section id="panel-3" class="dk-teal-bg">
    <div class="container">
        <div class="columns">
            <div class="column-75 center">
                <div class="columns">
                    <div class="column-50">
                        <h2><?php the_field('awards_title', 'options'); ?></h2>
                    </div>
                    <div class="column-50">
                        <p> <?php the_field('awards_copy', 'options'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php get_template_part('block', 'awards-slider'); ?>
</section>


</main>

<?php get_footer();?>