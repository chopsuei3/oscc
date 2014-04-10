<?php
/**
 * Sundance functions and definitions
 *
 * @package Sundance
 * @since Sundance 1.0
 */

/**
 * Set up the content width value based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 652; /* Default content width */

/**
 * Load Jetpack compatibility file.
 */
require( get_template_directory() . '/inc/jetpack.compat.php' );

/**
 * Adjust the content width based on the presence of active widgets and page templates.
 *
 * @since Sundance 1.0
 */
function sundance_set_content_width() {
	$options = sundance_get_theme_options();
	global $content_width;
	if ( is_page_template( 'full-width-page.php' )
		|| is_attachment()
		|| ( 'off' == $options['show_rss_link']
			&& ''  == $options['twitter_url']
			&& ''  == $options['facebook_url']
			&& ''  == $options['google_url']
			&& ''  == $options['flickr_url']
			&& ! is_active_sidebar( 'sidebar-1' ) )
		)
		$content_width = 874;
}
add_action( 'template_redirect', 'sundance_set_content_width' );

if ( ! function_exists( 'sundance_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since Sundance 1.0
 */
function sundance_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	require( get_template_directory() . '/inc/tweaks.php' );

	/**
	 * Custom Theme Options
	 */
	require( get_template_directory() . '/inc/theme-options/theme-options.php' );

	/**
	 * WordPress.com-specific functions and definitions
	 */
	require( get_template_directory() . '/inc/wpcom.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on Sundance, use a find and replace
	 * to change 'sundance' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'sundance', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'sundance' ),
	) );

	/**
	 * This theme allows users to set a custom background.
	 */
	add_custom_background();

	/**
	 * Add support for the Aside and Gallery Post Formats
	 */
	add_theme_support( 'post-formats', array( 'video' ) );

	add_theme_support( 'print-style' );

	// Add support for custom backgrounds.
	$bg_args = array(
		'default-color' => 'edeaf1',
		'default-image' => get_template_directory_uri() . '/images/bg.jpg'
	);
	$bg_args = apply_filters( 'sundance_custom_background_args', $bg_args );

	// 3.4 check
	if ( wp_get_theme() ) {
		add_theme_support( 'custom-background', $bg_args );
	} else {
		define( 'BACKGROUND_COLOR', $bg_args['default-color'] );
		define( 'BACKGROUND_IMAGE', $bg_args['default-image'] );
		add_custom_background();
		add_action( 'wp_head', 'sundance_custom_background' );
	}

}
endif; // sundance_setup
add_action( 'after_setup_theme', 'sundance_setup' );

/**
 * Implement the Custom Header feature
 */
require( get_template_directory() . '/inc/custom-header.php' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since Sundance 1.0
 */
function sundance_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'sundance' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
add_action( 'widgets_init', 'sundance_widgets_init' );

/**
 * Enqueue scripts
 */
function sundance_scripts() {
	global $post;

	wp_enqueue_style( 'style', get_stylesheet_uri() );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image( $post->ID ) ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
	wp_enqueue_script( 'sundance-small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '20120305', true );

	wp_enqueue_script( 'sundance-fit-vids', get_template_directory_uri() . '/js/jquery.fitvids.js', array( 'jquery' ), '20120213', true );

	wp_enqueue_script( 'sundance-flex-slider', get_template_directory_uri() . '/js/jquery.flexslider.js', array( 'jquery' ), '20120903', true );

	wp_enqueue_script( 'sundance-theme', get_template_directory_uri() . '/js/theme.js', array( 'jquery', 'sundance-fit-vids', 'sundance-flex-slider' ), '20120213', true );

}
add_action( 'wp_enqueue_scripts', 'sundance_scripts' );

/**
 * Register Google Fonts style.
 */
function sundance_register_fonts() {
	$protocol = is_ssl() ? 'https' : 'http';
	wp_register_style(
		'sundance-droid-serif',
		"$protocol://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic",
		array(),
		'20120821'
	);
}
add_action( 'init', 'sundance_register_fonts' );

/**
 * Enqueue Google Fonts style.
 */
function sundance_fonts() {
	wp_enqueue_style( 'sundance-droid-serif');
}
add_action( 'wp_enqueue_scripts', 'sundance_fonts' );

/**
 * Enqueue Google fonts style to admin screen for custom header display.
 */
function sundance_admin_fonts( $hook_suffix ) {
	if ( 'appearance_page_custom-header' != $hook_suffix )
		return;

	wp_enqueue_style( 'sundance-droid-serif');
}
add_action( 'admin_enqueue_scripts', 'sundance_admin_fonts' );

// COMPAT: Pre-3.4 Background style for front-end.
function sundance_custom_background() {
	if ( '' != get_background_color() && '' == get_background_image() ) : ?>
	<style type="text/css">
		body {
			background: none;
		}
	</style>
	<?php endif;

	if ( '' != get_background_image() ) : ?>
	<style type="text/css">
		#page {
			background: url(<?php echo get_template_directory_uri(); ?>/images/bg.jpg) repeat 0 0;
		}
	</style>
	<?php endif;
}

/**
 * Filter the home page posts, and remove any featured post ID's from it. Hooked
 * onto the 'pre_get_posts' action, this changes the parameters of the query
 * before it gets any posts.
 *
 * @global array $featured_post_id
 * @param WP_Query $query
 * @return WP_Query Possibly modified WP_query
 */
function sundance_home_posts( $query = false ) {

	// Bail if not home, not a query, not main query, or no featured posts
	if ( ! is_home() || ! is_a( $query, 'WP_Query' ) || ! $query->is_main_query() || ! sundance_featuring_posts() )
		return $query;

	// Exclude featured posts from the main query
	$query->query_vars['post__not_in'] = sundance_featuring_posts();

	return $query;
}
add_action( 'pre_get_posts', 'sundance_home_posts' );

/**
 * Test to see if any posts meet our conditions for featuring posts.
 * Current conditions are:
 *
 * - sticky posts
 * - with featured thumbnails
 *
 * We store the results of the loop in a transient, to prevent running this
 * extra query on every page load. The results are an array of post ID's that
 * match the result above. This gives us a quick way to loop through featured
 * posts again later without needing to query additional times later.
 */
function sundance_featuring_posts() {
	if ( false === ( $featured_post_ids = get_transient( 'featured_post_ids' ) ) ) {

		// Proceed only if sticky posts exist.
		if ( get_option( 'sticky_posts' ) ) {

			// The Featured Posts query - The need to be sticky post and video post format
			$featured_args = array(
				'post__in'       => get_option( 'sticky_posts' ),
				'post_status'    => 'publish',
				'tax_query'      => array( array(
					'taxonomy'   => 'post_format',
					'field'      => 'slug',
					'terms'      => array( 'post-format-video' )
				) ),
				'posts_per_page' => 10,
				'no_found_rows'  => true
			);

			$featured = new WP_Query( $featured_args );

			// Proceed only if published posts with thumbnails exist
			if ( $featured->have_posts() ) {
				while ( $featured->have_posts() ) {
					$featured->the_post();
					$featured_post_ids[] = $featured->post->ID;
				}

				set_transient( 'featured_post_ids', $featured_post_ids );
			}
		}
	}

	return $featured_post_ids;
}
/**
 * Flush out the transients used in sundance_featured_posts()
 */
function sundance_featured_post_checker_flusher() {
	delete_transient( 'featured_post_ids' );
}
add_action( 'save_post', 'sundance_featured_post_checker_flusher' );