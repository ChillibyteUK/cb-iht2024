<?php
/**
 * Understrap Child Theme functions and definitions
 *
 * @package UnderstrapChild
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

define('CB_THEME_DIR', WP_CONTENT_DIR . '/themes/cb-iht2024');

require_once CB_THEME_DIR . '/inc/cb-theme.php';

/**
 * Removes the parent themes stylesheet and scripts from inc/enqueue.php
 */
function understrap_remove_scripts() {
	wp_dequeue_style( 'understrap-styles' );
	wp_deregister_style( 'understrap-styles' );

	wp_dequeue_script( 'understrap-scripts' );
	wp_deregister_script( 'understrap-scripts' );
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

/**
 * Enqueue our stylesheet and javascript file
 */
function theme_enqueue_styles() {

	// Get the theme data.
	$the_theme     = wp_get_theme();
	$theme_version = $the_theme->get( 'Version' );

	$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	// Grab asset urls.
	$theme_styles  = "/css/child-theme{$suffix}.css";
	$theme_scripts = "/js/child-theme{$suffix}.js";
	
	$css_version = $theme_version . '.' . filemtime( get_stylesheet_directory() . $theme_styles );

	wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . $theme_styles, array(), $css_version );
	wp_enqueue_script( 'jquery' );
	
	$js_version = $theme_version . '.' . filemtime( get_stylesheet_directory() . $theme_scripts );
	
	wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . $theme_scripts, array(), $js_version, true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

/**
 * Load the child theme's text domain
 */
function add_child_theme_textdomain() {
	load_child_theme_textdomain( 'cb-iht2024', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );

/**
 * Overrides the theme_mod to default to Bootstrap 5
 *
 * This function uses the `theme_mod_{$name}` hook and
 * can be duplicated to override other theme settings.
 *
 * @return string
 */
function understrap_default_bootstrap_version() {
	return 'bootstrap5';
}
add_filter( 'theme_mod_understrap_bootstrap_version', 'understrap_default_bootstrap_version', 20 );

/**
 * Loads javascript for showing customizer warning dialog.
 */
function understrap_child_customize_controls_js() {
	wp_enqueue_script(
		'understrap_child_customizer',
		get_stylesheet_directory_uri() . '/js/customizer-controls.js',
		array( 'customize-preview' ),
		'20130508',
		true
	);
}
add_action( 'customize_controls_enqueue_scripts', 'understrap_child_customize_controls_js' );

function mailchimp_news_shortcode() {
    // Start output buffering
    ob_start();

    // Mailchimp RSS feed URL
    $feed_url = "https://us21.campaign-archive.com/feed?u=f6e2824f4c705e0b47cf502bd&id=dc7ce491d3";

    // Fetch the feed content
    $feed_content = @file_get_contents($feed_url);

    if ($feed_content === false) {
        echo "<p>Error: Unable to fetch the Mailchimp RSS feed.</p>";
        return ob_get_clean();
    }

    // Parse the RSS feed using SimpleXML
    $rss = @simplexml_load_string($feed_content);

    if ($rss === false) {
        echo "<p>Error: Unable to parse the Mailchimp RSS feed.</p>";
        return ob_get_clean();
    }

    // Display feed content
    echo "<div class='row mc_news'>";

    // Loop through feed items
    foreach ($rss->channel->item as $item) {
        $title = esc_html($item->title);
        $link = esc_url($item->link);
        $date = date("F j, Y", strtotime($item->pubDate));
        $desc = wp_kses_post($item->description);

        echo "<div class='col-lg-4'>";
        echo "<img src='/wp-content/uploads/2025/04/a768e926-756c-1959-2e91-81178146a9c4.jpg' class='img-fluid w-100'>";
        echo "<h4><a href='$link' target='_blank'>$title</a></h4>";
        echo "<small><em>Published: $date</em></small>";
        echo "</div>";
    }

    echo "</div>";

    // Return the buffered content
    return ob_get_clean();
}
add_shortcode('mailchimp_news', 'mailchimp_news_shortcode');