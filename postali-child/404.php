<?php
/**
 * Template: 404
 * @package Postali Child
 * @author Postali LLC
**/
get_header(); ?>

<main id="page">
    <section id="hero" class="dk-teal-bg">
        <div class="container">
            <?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?> 
            <div class="columns">
                <div class="column-66 center">
                    <h1>404: Page Missing</h1>
                    <p>This page has been renamed, removed, or doesn’t exist. Click one of the buttons below to get back on track.</p>
                </div>
            </div>
        </div>
    </section>
    <section id="panel-1" class="tan-bg">
        <div class="container">
            <div class="columns">
                <div class="column-full center">
                    <button onclick="history.back()" class="btn">Go Back</button>
                    <a href="/" class="btn">Go Home</a>
                    <a href="/workplace-discrimination/" class="btn">See Workplace Discrimination Topics</a>
                    <a href="/practice-areas/" class="btn">See Other Practice Areas</a>
                    
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>