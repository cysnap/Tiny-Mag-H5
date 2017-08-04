</main>
<footer>
	<div class="footer-credits">
	<span>&copy; Copyright 2009 - <?php echo $showtime=date("Y");?> <a href="<?php echo get_settings('home'); ?>"><?php bloginfo('name'); ?></a>； <?php echo get_num_queries();?> Queries in <?php timer_stop(1);?> Seconds.</span>
	<span>HELLO WORLD, I MADE THIS SITE FOR LEARNING WORDPRESS!</span>
	</div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
