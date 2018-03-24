<?php get_header(); ?>
<div class="fuss nova">Navigation：<a href="<?php echo get_settings('home'); ?>" title="HOME">HOME&nbsp;&raquo;&nbsp;</a><a href="/archives" title="TOPICS">TOPICS&nbsp;&raquo;</a>&nbsp; <?php the_category(', ') ?>&nbsp;
</div>

<div class="entry meta"><blockquote> <?php echo category_description(); ?></blockquote> </div>
<?php if(is_paged()) : pagenavi(); endif; ?>
<div class="post-block">
<?php rewind_posts() ?>
<?php while ( have_posts() ) : the_post(); ?>

<div class="post" id="post-<?php the_ID(); ?>">
	<div class="post-title">
		<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permalink for: <?php the_title(); ?>"><?php the_title(); ?></a></h2>
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
				<a href="<?php echo $category_link; ?>" title="<?php echo $category_name; ?>"><img src="<?php img_url(); ?>/cat-img/<?php echo $category_slug; ?>.gif" /></a>
		</div>
	<?php the_content('',TRUE,''); ?>
	</div>

	<div class="post-bottom clearfix">
			<span class="post-info"><?php the_author(); ?>&nbsp;发表于 &nbsp;: <?php the_time('F j, Y H:i'); ?>&nbsp;-&nbsp; 主题 : <?php foreach((get_the_category()) as $category) {echo $category->cat_name . ' ';}?></span>
			<span class="nova-r">
				<?php comments_popup_link('Discussion&nbsp;&raquo;', '1 comment&nbsp;&raquo;', '% comments&nbsp;&raquo;', 'post-comments'); ?>&nbsp;&nbsp;&nbsp;<a class="more-link" href="<?php the_permalink() ?>" title="<?php the_title(); ?>" target="_blank" rel="nofollow">查看全文&nbsp;&raquo;</a>
			</span>
	</div>

</div>


<?php endwhile; ?>
</div>
<?php pagenavi(); ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
