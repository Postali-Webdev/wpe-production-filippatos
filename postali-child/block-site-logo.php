<?php /* Block: Site Logo */ ?>
<div class="logo-container">
    <?php the_custom_logo(); ?>
    <div>
        <a href="/" title="navigate to home page">
            <p class="title"><?php the_field('logo_title', 'options'); ?></p>
            <p class="sub-title"><?php the_field('logo_sub_title', 'options'); ?></p>
        </a>
    </div>
</div>