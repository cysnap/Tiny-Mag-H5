<?php get_header(); ?>
<div class="post-block">
<div class="fuss nova">Querying Results : <strong><?php the_search_query() ?></strong></div>
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

<div class="post" id="post-<?php the_ID(); ?>">
	<div class="post-title">
		<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permalink for : <?php the_title(); ?>"><?php the_title(); ?></a></h2>
	</div>

	<div class="entry clearfix">
		<div class="cat-img">
				<?php
				$the_cat = get_the_category();
				$category_slug = $the_cat[0]->slug;
				$category_name = $the_cat[0]->cat_name;
				$category_description = $the_cat[0]->category_description;
				$category_link = get_category_link( $the_cat[0]->cat_ID );
				?>
				<a href="<?php echo $category_link; ?>" title="<?php echo $category_name; ?>"><img src="<?php img_url();?>/cat-img/<?php echo $category_slug; ?>.gif" /></a>
		</div>
	<?php the_content('',TRUE,''); ?>
	</div>

	<div class="post-bottom clearfix">
			<span class="post-info"><?php the_author(); ?>&nbsp;Posted in &nbsp;: <?php the_time('m-d-Y H:i'); ?>&nbsp;-&nbsp; Topics : <?php foreach((get_the_category()) as $category) {echo $category->cat_name . ' ';}?>&nbsp;-&nbsp;<?php the_views($display = false); ?>&nbsp;views</span>
			<span class="nova-r">
				<?php comments_popup_link('DISCUSSION&nbsp;&raquo;', '1 comment&nbsp;&raquo;', '% comments&nbsp;&raquo;', 'post-comments'); ?>&nbsp;&nbsp;&nbsp;<a class="more-link" href="<?php the_permalink() ?>" title="<?php the_title(); ?>" target="_blank" rel="nofollow">Read More&nbsp;&raquo;</a>
			</span>
	</div>

</div>

<?php endwhile; ?>
<div class="navigation"><div class="previous-entries nova-l"><?php next_posts_link('Next') ?></div> <div class="next-entries nova-r"><?php previous_posts_link('Previous') ?></div></div>
<?php else : ?>
<div class="fuss nova">Nothing found!</div>
<?php endif; ?>
</div>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
