<div class="sidebar">

	<ul>
		<?php if (!is_search()) {$search_text = "Search";} else {$search_text = "$s";} ?>

		<li><?php dynamic_sidebar('300x250-Ads'); ?></li>
		<li><?php dynamic_sidebar('sb_banner'); ?></li>
		<?php if (is_category()) { ?>
		<li>
			<h2 class="sidebar-title">MONTHLY TOPLIST</h2>
			<div class="notice nova">
				<ul class="list_page">
					<?php $categories = get_the_category(); foreach ($categories as $category) {get_most_viewed_category($category_id = $category->term_id, $mode = '', $limit = 10, $chars = 0, $display = true); } ?>
				</ul>
			</div>
		</li>
		<?php } ?>

		<?php if (is_day() || is_month() || is_year()) {?>
		<li>
			<?php get_calendar();?>
		</li>

		<?php } ?>

		<?php if ( !is_home() && !is_crawler() ) { ?>
		<li>
			<h2 class="sidebar-title">LATEST</h2>
			<div class="notice nova">
				<ul class="list_page"><?php echo mb_strimwidth(strip_tags(wp_get_archives('type=postbypost&limit=10')), 0, 35,'...') ?></ul>
			</div>
			<div class="clearfix"></div>
		</li>
		<?php } ?>

		<?php if ( is_home() ) { ?>

		<li>
			<h2 class="sidebar-title">WEEKLY TOPLIST</h2>
			<div class="notice">
				<ul> <?php if (function_exists('get_most_viewed')): ?>
					<?php get_most_viewed('post', 15, 0, true, true); ?>
					<?php endif; ?>
				</ul>
			</div>
		</li>

		<li>
			<h2 class="sidebar-title">TAGS CLOUD</h2>
			<div class="tag-cloud notice">
				<?php wp_tag_cloud('smallest=12&largest=12&number=10&format=list&orderby=count&order=DESC'); ?>
				<ul>
				<?php wp_list_categories('number=10&orderby=count&order=DESC&title_li=0&depth=-1'); ?>
				</ul>
			</div>
			<div class="clearfix"></div>
		</li>
		<?php } ?>


		<?php if ( is_single() && !is_attachment()) { ?>
		<li>
			<h2 class="sidebar-title">RELATED</h2>
			<div class="notice nova">
				<ul class="list_page">
				<?php $categories = get_the_category(); foreach ($categories as $category) : ?>
				<?php $posts = get_posts('numberposts=10&category='. $category->term_id); foreach($posts as $post) : ?>
				<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li> <?php endforeach; ?>
				<?php endforeach; ?>
				</ul>
			</div>
		</li>
		<?php }?>

		<?php if ( is_home() ) { ?>
		<li>
			<h2 class="sidebar-title">RECENT DISCUSSION</h2>
			<div class="sidebar-comment"><?php most_recent_comments(); ?></div>
		</li>
		<?php } ?>

	</ul>
</div>
