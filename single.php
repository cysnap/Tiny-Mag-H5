<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="post-single clearfix" id="post-<?php the_ID(); ?>">

	<div class="fuss nova">Navigation: <a href="<?php echo get_settings('home'); ?>" title="首页">HOME</a>&nbsp;&raquo;&nbsp;<?php the_category(' &gt; '); ?>&nbsp;&raquo;&nbsp;<a href="<?php the_permalink() ?>" rel="bookmark" title="Permalink for : <?php the_title(); ?>"><?php the_title(); ?></a></div>

	<article class="meta nova">

		<header class="post-single-title">
			<h2><?php the_title(); ?></h2>
			<span class="post-single-info"><time><?php the_time('Y-m-d H:i'); ?></time>&nbsp;&nbsp;&nbsp;&nbsp;<?php foreach((get_the_category()) as $category) {echo $category->cat_name . ' ';}?>&nbsp;&nbsp;&nbsp;&nbsp;<?php the_views(); ?>&nbsp;views&nbsp;&nbsp;&nbsp;&nbsp;<?php comments_popup_link('Discussion', '1 comment', '% comments'); ?></span>
		</header>

		<div class="entry clearfix">
		<?php if(!is_attachment()) :?>
		<div class="post-single-cat-img">
			<?php
			$the_cat = get_the_category();
			$category_slug = $the_cat[0]->slug;
			$category_name = $the_cat[0]->cat_name;
			$category_description = $the_cat[0]->category_description;
			$category_link = get_category_link( $the_cat[0]->cat_ID );
			?>
			<a href="<?php echo $category_link; ?>" title="<?php echo $category_name; ?>"><img src="<?php img_url();?>/cat-img/<?php echo $category_slug; ?>.gif" /></a>
		</div>
		<?php endif;?>
		<?php the_content(); ?>
		<span>Editor: <?php the_author();?>; Tags: <?php the_tags('',', ',''); ?></span>
		<?php dynamic_sidebar('468x60-Ads'); ?>
		</div>
	</article>

	<?php comments_template(); ?>

	<?php endwhile; else: ?>
	<p>WOW! NOTHING HERE!</p>
	<?php endif; ?>
</div>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
