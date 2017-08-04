<?php
/*
Template Name: All Topics
*/
?>
<?php get_header(); ?>
	<div class="fuss nova">ALL TOPICS</div>
	<div class="post meta archives-icon">
	<?php
	$args = array ('orderby' => 'name');
	$categories = get_categories( $args );
	foreach ( $categories as $category ) {
		echo '<a href="' . get_category_link( $category->term_id ) . '" title="' . $category->name  . '"><img src="'; img_url(); echo '/cat-img/' . $category->category_nicename . '.gif" alt="' . $category->name . '"></a>';
	}
?>
	</div>

	<div class="fuss nova">ALL TAGS</div>
	<div class="post meta"><?php wp_tag_cloud('smallest=11&largest=18&format=flat&orderby=count&order=DESC'); ?></div>
</div>

<div class="sidebar">
	<ul>
		<li><?php dynamic_sidebar( 'sb_banner' ); ?></li>
	</ul>
</div>
<?php get_footer(); ?>
