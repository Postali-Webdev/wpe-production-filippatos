<?php /* Block: Cases Won */ 
$copy = $args['data']['copy'];
$total_results_amount = get_field('total_case_results_value', 'options');
$total_results_img = get_field('case_results_counter_image', 'options');
$all_cases_amounts = [];
$visible_results_args = [
    'post_type'         => 'results',
    'post_status'       => 'publish',
    // 'posts_per_page'    => 3,
    'meta_key'          => 'case_amount',
    'orderby'           => 'meta_value_num',
    'order'             => 'DESC',
    'meta_query'        => [
        [
            'key'       => 'case_amount',
            'value'     => 1000000,
            'type'      => 'numeric',
            'compare'   => '>=' 
        ]
    ]
];

$visible_results_query = new WP_Query($visible_results_args);

$all_results_args = [
    'post_type'         => 'results',
    'post_status'       => 'publish',
    'posts_per_page'    => -1,
    'meta_key'          => 'case_amount',
    'orderby'           => 'meta_value_num',
    'order'             => 'DESC'
];

$all_results_query = new WP_Query($all_results_args);
$total_amount = 0;
$total_count = 0;
$first_amount = 0;
if( $all_results_query->have_posts() ) {
    while( $all_results_query->have_posts() ) {
        $total_count++;
        $all_results_query->the_post();
        $total_amount = $total_amount + get_field('case_amount');
        $all_cases_amounts[] .= get_field('case_amount');
        if( $total_count ==  1) {
            $first_amount = get_field('case_amount');
        }
    }
}

function number_shorten($number, $precision = 3, $divisors = null) {
    // Setup default $divisors if not provided
  if (!isset($divisors)) {
      $divisors = array(
          pow(1000, 0) => '', // 1000^0 == 1
          pow(1000, 1) => 'K', // Thousand
          pow(1000, 2) => 'MM', // Million
          pow(1000, 3) => 'B', // Billion
          pow(1000, 4) => 'T', // Trillion
          pow(1000, 5) => 'Qa', // Quadrillion
          pow(1000, 6) => 'Qi', // Quintillion
      );    
  }

  // Loop through each $divisor and find the
  // lowest amount that matches
  foreach ($divisors as $divisor => $shorthand) {
      if (abs($number) < ($divisor * 1000)) {
          // We found a match!
          break;
      }
  }

  // We found our match, or there were no matches.
  // Either way, use the last defined value for $divisor.
  return number_format($number / $divisor, $precision) . $shorthand;
} 

?>

<?php if( $visible_results_query->have_posts() ) : 
    $count = 0; ?>
<div class="columns cases-won-wrapper">
    <div class="column-50 direction-col total-panel">
        <div class="subheading-small">Together We Win</div>
        <h2>Cases Won for Clients:<br> <span data-amount="<?php _e($first_amount); ?>" class="card-total-result">$<?php _e( number_format($total_results_amount, 0) ) ?></span> and counting.</h2>
        <p> <?php _e($copy); ?></p>


        
        <div class="results-counter" style="background-image: url('<?php esc_html_e($total_results_img['url']); ?>');">
            <div class="total">
                <p>$<?php echo number_shorten($total_results_amount, 0); ?></p>
            </div>
            <div class="case-amounts-wrapper">
                <div class="case-amounts-scroller">
                    <?php                     
                    foreach( $all_cases_amounts as $amount ) {
                        echo "<p>$" . number_shorten($amount, 0) . "</p>";
                    } ?>
                </div>
            </div>
        </div>





    </div>
    <div class="column-50 direction-col stacking-panel">
    <?php while( $visible_results_query->have_posts() ) : $visible_results_query->the_post(); 
    $count++;
    $amount = get_field('case_amount');?>
        <div class="result result-<?php _e($count); ?>" data-post-id="<?php _e( get_the_ID() ); ?>">
            <p data-amount="<?php _e($amount); ?>" class="amount">$<?php _e( number_format($amount, 0) ) ?></p>
            <h3><?php the_field('case_title'); ?></h3> 
            <p class="description"><?php the_field('case_description'); ?></p>
        </div>
    <?php endwhile; ?>
        <div class="result all-results">
            <h3>See The Rest of Our Results</h3>
            <?php if( !is_page_template( 'page-results-reviews.php' ) ) : ?>
                <a href="/results/" class="btn">See All Results</a>
            <?php else : ?>
                <a href="#all-results" class="btn" id="show-results">See All Results</a>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php endif; wp_reset_postdata(); ?>