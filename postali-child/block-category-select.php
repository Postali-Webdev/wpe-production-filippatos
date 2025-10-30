<?php
if( is_category() ) {
	$title = single_cat_title('' , false );
} else {
	$title = "Select a Category";
}

?>
<div id="app-cover">
	<div id="select-box">
		<input type="checkbox" id="options-view-button">
		<div id="select-button" class="brd">
			<div id="selected-value">
				<span class="filter-holder">Topic Filter: <span class="yellow"><?php _e($title); ?></span></span>
			</div>
			<div id="chevrons">
				<span class="icon-tick-down"></span>
			</div>
		</div>
		<div id="options">
		<?php if( $terms = get_terms( array(
			'taxonomy' => 'category', 
			'orderby' => 'name'
		) ) ) : ?>
			<div class="option">
				<a href="/blog/">All Posts</a>
			</div>
			<?php foreach ( $terms as $term ) : if( $term->name !== "Uncategorized" ) : ?>
				<div class="option">
					<a href="/blog/category/<?php echo $term->slug; ?>/"><?php echo $term->name; ?></a>
				</div>
			<?php endif; endforeach; ?>
			<?php endif; ?>
			<div id="option-bg"></div>
		</div>
	</div>
</div> 