<?php get_header(); ?>

<div class="post-block">
	<?php wp_reset_query(); ?>
	<?php $rcmdcounter = 0; ?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<?php $rcmdcounter++; ?>
	<div class="post">
		<div class="post-title">
			<?php if(is_sticky()) : ?>
			<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>" target="_blank"><?php the_title(); ?></a><?php _e('<span style="color:red;">[Sticky] </span>'); ?></h2>
			<?php else: ?>
			<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>" target="_blank"><?php the_title(); ?></a><?php video_tag(); ?><?php $diff = strtotime(date('Y-m-d H:i:s'))-strtotime(get_the_time('Y-m-d H:i:s')); if ($diff <= -25100){ ?><img alt="NEW" src="<?php echo get_stylesheet_directory_uri(); ?>/images/new-icon.gif"><?php } ?></h2>
			<?php endif; ?>
			<span class="post-count"><?php echo($rcmdcounter); ?>#</span>
		</div>

		<div class="entry clearfix">
			<div class="nova-r">
				<?php
					$key = "cover_s";
					$cover_s_meta = get_post_meta($post->ID,$key,TRUE);
					if ($cover_s_meta != ""):
				?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img alt="<?php the_title(); ?>" src="<?php echo $cover_s_meta;?>&w=120&h=92&crop-to-fit"></a>
				<?php else: ?>
				<?php
				$the_cat = get_the_category();
				$category_slug = $the_cat[0]->slug;
				$category_name = $the_cat[0]->cat_name;
				$category_description = $the_cat[0]->category_description;
				$category_link = get_category_link( $the_cat[0]->cat_ID );
				?>
				<a href="<?php echo $category_link; ?>" title="<?php echo $category_name; ?>"><img alt="<?php echo $category_name; ?>" src="<?php img_url();?>/cat-img/<?php echo $category_slug; ?>.gif" /></a>
				<?php endif; ?>
			</div>
		<?php the_content('',TRUE,'');?>

		</div>

		<div class="post-bottom clearfix">
			<span class="post-info"><?php the_author(); ?>&nbsp;-&nbsp;<time><?php the_time('M j, Y @ G:i'); ?></time>&nbsp;-&nbsp;Topics : <?php foreach((get_the_category()) as $category) {echo $category->cat_name . ' ';}?>-&nbsp;<?php the_views($display = false); ?>&nbsp;views</span>
			<span class="nova-r">
				<?php comments_popup_link('Discussion&nbsp;&raquo;', '1 comment&nbsp;&raquo;', '% comments&nbsp;&raquo;', 'post-comments'); ?>&nbsp;&nbsp;&nbsp;<a class="more-link" href="<?php the_permalink() ?>" title="<?php the_title(); ?>" target="_blank" rel="nofollow">Read More&nbsp;&raquo;</a>
			</span>
		</div>
	</div>

	<?php endwhile; ?>
	</div>
	<?php pagenavi(); else : ?>
	<div class="fuss nova">Nothing Here!</div>
	<?php endif; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
