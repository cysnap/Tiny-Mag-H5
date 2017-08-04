<?php
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('.');
	if ( post_password_required() ) { ?>
	<div class="fuss nova">Protected</div>
<?php return; } ?>

<div class="comment-main">

	<h3 class="comments-title" id="respond">DISCUSSION</h3>

	<?php if ('open' == $post->comment_status) : ?>

		<?php if ( get_option('comment_registration') && !$user_ID ) : ?>

			<div class="fuss nova">You must<a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>">LOG IN</a> first!</div>

		<?php else : ?>

			<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post">
				<?php if ( $user_ID ) : ?>
					<p class="c-form">You are login as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/"><?php echo $user_identity; ?></a>. <?php wp_loginout(); ?></p>
				<?php else : ?>
					<p>
						<label for="author"><small>Nick：</small></label><input type="text" name="author" class="comments-input" id="author" value="<?php echo $comment_author; ?>" size="10" tabindex="1" />&nbsp;&nbsp;
						<label for="email"><small>Email：</small></label>
						<input type="text" name="email" class="comments-input" id="email" value="<?php echo $comment_author_email; ?>" size="10" tabindex="2" />
					</p>

				<?php endif; ?>
					<p>
						<textarea onkeydown="if(event.ctrlKey&&event.keyCode==13){document.getElementById('submit').click();return false};" name="comment" id="comment-textarea" class="form-textarea" cols="100%" rows="5" tabindex="4"></textarea>
					</p>
					<p>
						<input id="submit" name="submit" type="submit" class="form-submit" tabindex="5" value="SUBMIT" />
						<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
						<span><small>(So you agree with the <a href="/about?ref=comment_bottom#policy" target="_blank" rel="nofollow">rules</a>)</small></span>
					</p>
				<?php do_action('comment_form', $post->ID); ?>
			</form>

		<?php endif; ?>

	<?php else : ?>
		<div class="fuss nova">DISCUSSION CLOSED, SO SORRY!</div>
	<?php endif; ?>


	<div id="comments">

		<?php if ($comments) : ?>

			<h3 class="comments-title"><?php comments_number('NO COMMENT', '1 COMMENT', '% COMMENTS' );?> <span class="comments-o"><?php comments_rss_link('RSS for this discussion.'); ?></span></h3>

			<div class="comment-list">
				<?php foreach ($comments as $comment) : ?>
				<?php if ( get_comment_type() == "comment" ) : ?>
					<div class="comment-main-content" id="comment-<?php comment_ID() ?>" >
						<div class="commentmeta"><span id="commentauthor-<?php comment_ID() ?>"> <?php comment_author() ?> </span><span>Posted in <?php comment_date('F j, Y l') ?> <?php comment_time() ?><?php if ($comment->comment_approved == '0') : ?>[Moderating!]<?php endif; ?> </span> </div>
						<div id="commentText-<?php comment_ID() ?>" ><?php comment_text() ?></div>
						<div class="comment-bottom"><span><a href="javascript:void(0);" onclick="reply('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'comment-textarea');">[REPLY]</a></span></div>
					</div>
				<?php endif; ?>
				<?php endforeach; ?>
			</div>

		<?php endif; ?>

	</div>

</div>
