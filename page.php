<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="post meta" id="post-<?php the_ID(); ?>">
<h2><?php the_title(); ?></h2>
<div class="entry clearfix">
<?php the_content('Read More'); ?>
<?php link_pages('<p>Pages: ', '</p>', 'number'); ?>
</div>
</div>
<?php endwhile; endif; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
