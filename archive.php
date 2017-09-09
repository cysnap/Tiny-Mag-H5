<?php get_header(); ?>
<div class="fuss nova">
<?php if (is_day()) { ?>Archive：<strong><?php the_time('F j, Y'); ?></strong>
<?php } elseif (is_month()) { ?>Archive：<strong><?php the_time('F Y'); ?></strong>
<?php } elseif (is_year()) { ?>Archive：<strong><?php the_time('Y'); ?></strong>
<?php } elseif (is_tag()) { ?>Posts in Tag : <strong><?php single_tag_title(); ?></strong>
<?php } elseif (is_author()) { ?><?php $curauth = get_userdata(get_query_var('author')); ?>Author : <strong><?php echo $curauth->nickname; ?></strong> - <small>writed <?php the_author_posts(); ?> in total.</small>
<?php } ?></div>

<?php if (is_author()) { ?><div class="entry author-profile">
<div class="author-avatar gravatar nova-l"><?php echo get_avatar($curauth->user_email, '28', $avatar); ?></div>
<div class="author-description comment-content"><blockquote><?php echo $curauth->user_description; ?><br/><strong>URL</strong>: <a href="<?php echo $curauth->user_url; ?>"><?php echo $curauth->user_url; ?></a></blockquote></div>
</div><?php } ?>

<?php if(is_tag()) { ?>
<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" bgcolor="#CCCCCC" style="margin:10px 0;"><tbody>
	<tr bgcolor="#F1F9FC">
		<td width="40%" height="35" align="center" >Title</td>
		<td width="30%" align="center" >Topics</td>
		<td width="30%" align="center" >Times</td>
	</tr>
<?php } ?>

<?php rewind_posts() ?>
<?php while ( have_posts() ) : the_post(); ?>

<?php if(is_tag()) { ?>
<tr bgcolor="#FFFFFF">
	<td width="40%" height="40" align="center"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></td>
	<td width="20%" align="center" ><?php the_category(', ') ?></td>
	<td width="20%" align="center" ><small><?php the_time('F j H:i'); ?></small></td>
</tr>
<?php } elseif(!is_paged()){ ?>

<div class="post meta" id="post-<?php the_ID(); ?>">
	<div class="post-title">
		<h2><a href="<?php the_permalink() ?>" rel="bookmark" ><?php the_title(); ?></a></h2>
		<span class="post-info"><?php the_author(); ?>&nbsp;posted in &nbsp;: <?php the_time('F j, Y H:i:s'); ?>&nbsp;|&nbsp; Category: <?php foreach((get_the_category()) as $category) {echo $category->cat_name . ' ';}?></span>
		<?php edit_post_link(' Edit', '<span class="post-edit">', '</span>'); ?>
	</div>

	<div class="entry clearfix">
		<div class="cat-img">
			<a href="<?php bloginfo('url'); ?>/c/<?php foreach((get_the_category()) as $cat){echo $cat->category_nicename;}?>" title="<?php single_cat_title() ?>"><img src="<?php img_url(); ?>/cat-img/<?php foreach((get_the_category()) as $cat){echo $cat->category_nicename;}?>.gif" alt="<?php single_cat_title() ?>" ></a>
		</div>
	<?php the_content('',TRUE,''); ?>
	</div>
	<div class="post-bottom clearfix"><span class="post-tags"><?php the_tags('', ' - ', ''); ?></span><span class="nova-r"><?php comments_popup_link('Discussion&nbsp;&raquo;', '1 comment&nbsp;&raquo;', '% comments&nbsp;&raquo;', 'post-comments'); ?>&nbsp;&nbsp;&nbsp;<a class="more-link" href="<?php the_permalink() ?>" title="<?php the_title(); ?>" target="_blank" rel="nofollow">Read More&nbsp;&raquo;</a></span></div>
</div>
<div class="meta nova" id="post-<?php the_ID(); ?>">
		<div class="nova-l"><h2><a href="<?php the_permalink() ?>" rel="bookmark" ><?php the_title(); ?></a></h2></div>
		<div class="nova-r"><span><small> (<?php the_author(); ?>&nbsp;- <?php the_time('F j, Y H:i'); ?></small></span></div>
		<div class="clearfix"></div>
</div>

<?php }else{ ?>
<div class="meta nova" id="post-<?php the_ID(); ?>">
		<div class="nova-l"><h2><a href="<?php the_permalink() ?>" rel="bookmark" ><?php the_title(); ?></a></h2></div>
		<div class="nova-r"><span><small> (<?php the_author(); ?>&nbsp;- <?php the_time('F j, Y H:i'); ?></small></span></div>
		</div class="clearfix"></div>
</div>
<?php }?>

<?php endwhile; ?>
<?php if(is_tag()) : ?>
	<tr bgcolor="#F1F9FC">
		<td width="40%" height="23" align="center" >Title</td>
		<td width="30%" align="center" >Topic</td>
		<td width="30%" align="center" >Time</td>
	</tr>
</tbody></table>
<?php endif; pagenavi(); ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
