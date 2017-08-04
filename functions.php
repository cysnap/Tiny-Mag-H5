<?php

remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

function most_commented_posts($no_posts = 10, $show_pass_post = false, $duration='30') {
global $wpdb;
$request = "SELECT ID, post_title, COUNT($wpdb->comments.comment_post_ID) AS 'comment_count' FROM $wpdb->posts, $wpdb->comments";
$request .= " WHERE comment_approved = '1' AND $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND post_status = 'publish'";
if(!$show_pass_post) $request .= " AND post_password =''";
if($duration !="") { $request .= " AND DATE_SUB(CURDATE(),INTERVAL ".$duration." DAY) < post_date ";
}
$request .= " GROUP BY $wpdb->comments.comment_post_ID ORDER BY comment_count DESC LIMIT $no_posts";
$posts = $wpdb->get_results($request);
$output = '';
if ($posts) {
foreach ($posts as $post) {
$post_title = stripslashes($post->post_title);
$comment_count = $post->comment_count;
$permalink = get_permalink($post->ID);
$output .= '<li><span class="sidebar-count">(' . $comment_count.')</span><a href="' . $permalink . '" title="' . $post_title.'" >' . $post_title . '</a></li>' ;
}
} else {
$output .=  "None found";
}
echo $output;
}

function most_recent_comments() {
	global $wpdb;
	$query = "SELECT * from $wpdb->comments WHERE comment_approved= '1'
	ORDER BY comment_date DESC LIMIT 0 ,10";
	$comments = $wpdb->get_results($query);
	if ($comments) {
		foreach ($comments as $comment) {
			$url = '<a href="'. get_permalink($comment->comment_post_ID).'#comment-'.$comment->comment_ID .'">'.get_the_title($comment->comment_post_ID).'</a>';
			echo '<dl><dt>';
			echo strip_tags($comment->comment_content,'');
			echo '</dt><dd><span>';
			echo $comment->comment_author;
			echo ' 在 ';
			echo $comment->comment_date;
			echo ' 对新闻：</span>';
			echo $url;
			echo '<span> 发表的评论</span></dd></dl>';
		}
	}
}

// No Self Pings
function no_self_ping( &$links ) {
	$home = get_option( 'home' );
	foreach ( $links as $l => $link )
		if ( 0 === strpos( $link, $home ) )
			unset($links[$l]);
}
add_action( 'pre_ping', 'no_self_ping' );

function pagenavi(){
	global $wp_query;
	$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
	$total = $wp_query->max_num_pages;
	$links = '<div class="page_navi">';
	//$links .= '<span class="page-numbers pages">第 '. $current .' 页，共 '. $total .' 页</span>';
	if ( $total == 1 ) return;
	if ( $current > 1 )	$links .= pagenavi_link( $current - 1, '&laquo; Previous');
	if ( $current > 5 ) $links .= pagenavi_link( 1, '1').'<span class="page-numbers dots">...</span>';
	for( $i = $current - 3; $i <= $current + 3; $i++ ) {
		if ( $i > 0 && $i <= $total ) $i == $current ? $links .= '<span class="page-numbers current">'.$i.'</span>' : $links .= pagenavi_link( $i, $i );
	}
	if ( $current < $total - 4 ) $links .= '<span class="page-numbers dots">...</span>';
	if ( $current < $total ) $links .= pagenavi_link( $current + 1, 'Next &raquo;');
	$links .= '</div>';
	echo $links;
}
function pagenavi_link($page, $n) {
	return '<a href="' . esc_url(get_pagenum_link($page)) . '" class="page-numbers">'.$n.'</a>';
}

function remove_media_menu() {
	global $submenu;
	unset($submenu['upload.php'][5]);
	global $menu;
	unset($menu[10]);
}
add_action('admin_head', 'remove_media_menu');

function remove_all_media_buttons()
{
    remove_all_actions('media_buttons');
}
add_action('admin_init', 'remove_all_media_buttons');

function is_crawler() {
	$userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);
	$spiders = array('Googlebot', 'Baiduspider',  'Yahoo! Slurp', 'YodaoBot',  'msnbot' );
	foreach ($spiders as $spider) {
		$spider = strtolower($spider);
		if (strpos($userAgent, $spider) !== false) { return true; }
	}
	return false;
}

function filter_where($where = '') {
    // Posts in the last 30 days
    $where .= " AND post_date > '" . date('m-d-Y', strtotime('-21 days')) . "'";
    return $where;
  }

function video_tag(){
	if (has_tag('video')){
	echo '<span class="has_vid">&nbsp;</span>';
	}
}

// add more buttons to the html editor
function appthemes_add_quicktags() {
?>
    <script type="text/javascript">
    QTags.addButton( 'eg_full_img', 'full_img', '<img class="aligncenter" src="https://img.maxbeta.com/uploads/<?php echo date('Y/m'); ?>/" alt="">', '', '', '', 201 );
    </script>
<?php
}
add_action( 'admin_print_footer_scripts', 'appthemes_add_quicktags' );


//RedBuild Taxonomies ,no parents category
add_action( 'init', 'build_taxonomies', 0 );
function build_taxonomies() {
  register_taxonomy( 'category', 'post', array(
		'hierarchical' => true,
	 	'update_count_callback' => '_update_post_term_count',
		'query_var' => 'category_name',
		'rewrite' => did_action( 'init' ) ? array(
					'hierarchical' => false,
					'slug' => get_option('category_base') ? get_option('category_base') : 'category',
					'with_front' => false) : false,
		'public' => true,
		'show_ui' => true,
		'_builtin' => true,
	) );
}

//Menu Register
function register_my_menus() {
  register_nav_menus(
    array('header-menu' => __( 'Header Menu' ) )
  );
}
add_action( 'init', 'register_my_menus' );

//remove header menu's classes and ids
add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1);
add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1);
add_filter('page_css_class', 'my_css_attributes_filter', 100, 1);
function my_css_attributes_filter($var) {
	return is_array($var) ? array_intersect($var, array('current-menu-item')) : '';
}

//image server location
function img_url(){
	echo 'https://img.maxbeta.com';
}

function disable_embeds_init() {

    // Remove the REST API endpoint.
    remove_action('rest_api_init', 'wp_oembed_register_route');

    // Turn off oEmbed auto discovery.
    // Don't filter oEmbed results.
    remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);

    // Remove oEmbed discovery links.
    remove_action('wp_head', 'wp_oembed_add_discovery_links');

    // Remove oEmbed-specific JavaScript from the front-end and back-end.
    remove_action('wp_head', 'wp_oembed_add_host_js');
}

add_action('init', 'disable_embeds_init', 9999);

// add widget support
if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name' => '468x60-Ads',
		'id'   => '468x60-Ads',
		'description'   => 'This is a 468x60 Ads code area',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => ''
	));

	register_sidebar(array(
		'name' => 'SideBar Banner',
		'id'   => 'sb_banner',
		'description'   => 'SideBar Banner Widget',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => ''
	));

	register_sidebar(array(
		'name' => '300x250 ADS',
		'id'   => '300x250-Ads',
		'description'   => 'SideBar Ads Widget',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => ''
	));

}

?>
