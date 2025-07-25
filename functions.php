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
    echo "<div class='container mc_news'>";
    echo "<div class='row mt-4'>";

    // Loop through feed items
    foreach ($rss->channel->item as $item) {
        $title = esc_html($item->title);
        $link = esc_url($item->link);
        $date = date("F j, Y", strtotime($item->pubDate));
        $desc = wp_kses_post($item->description);

        echo "<div class='shadow col-lg-4 mb-4 d-flex flex-column justify-content-center'>";
        echo "<img src='/wp-content/uploads/2025/04/a768e926-756c-1959-2e91-81178146a9c4.jpg' class='img-fluid w-100'>";
        echo "<h4 class='fs-5'><a href='$link' target='_blank' class='text-black'>$title</a></h4>";
        echo "<small><em>Published: $date</em></small>";
        echo "<a href='$link' target='_blank' class='btn btn-secondary d-block my-3'>View Newsletter</a>";
        echo "</div>";
    }

    echo "</div>";
    echo "</div>";

    // Return the buffered content
    return ob_get_clean();
}
add_shortcode('mailchimp_news', 'mailchimp_news_shortcode');

function woo_custom_cart_shortcode() {
    if ( ! function_exists( 'WC' ) ) return '';

    $cart_url = wc_get_cart_url();
    $cart_count = WC()->cart->get_cart_contents_count();
    $cart_total = WC()->cart->get_cart_total();

    ob_start();
    ?>
    <a class="woo-cart-link" href="<?php echo esc_url( $cart_url ); ?>">
        <i class="fa-solid fa-cart-shopping"></i> Cart 
        <?php if ( $cart_count > 0 ) : ?>
            (<?php echo esc_html( $cart_count ); ?>)
        <?php endif; ?>
    </a>
    <?php
    return ob_get_clean();
}
add_shortcode('woo_cart_link', 'woo_custom_cart_shortcode');

function enqueue_bootstrap_for_modal() {
    if ( is_front_page() ) {
        // Bootstrap 5 CSS (optional if already included)
        //wp_enqueue_style( 'bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' );

        // Bootstrap 5 JS (required for modal)
        wp_enqueue_script( 'bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array(), null, true );
    }
}
add_action( 'wp_enqueue_scripts', 'enqueue_bootstrap_for_modal' );

function add_mailchimp_modal_popup() {
    if ( is_front_page() ) {
        ?>
        <!-- Mailchimp Modal HTML -->
        <div class="modal fade" id="mailchimpModal" tabindex="-1" aria-labelledby="mailchimpModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content p-4">
              <div class="modal-header border-0">
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body text-center">
                <img src="https://ihtconsultancy.com/wp-content/themes/cb-iht2024/img/iht-logo.svg" alt="Logo" class="mb-4" style="max-width: 150px;">
                <h2 class="mb-3">Subscribe to our Newsletter</h2>

                <!-- Mailchimp Signup Form -->
                <div id="mc_embed_signup">
                  <form action="https://ihtconsultancy.us21.list-manage.com/subscribe/post?u=f6e2824f4c705e0b47cf502bd&amp;id=dc7ce491d3&amp;f_id=00b8fee1f0"
                        method="post" target="_blank" class="validate" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form">
                    <div class="mc-field-group mb-3">
                      <label for="mce-EMAIL" class="form-label">Email address</label>
                      <input type="email" value="" name="EMAIL" class="required email form-control" id="mce-EMAIL" required>
                    </div>
                    <div class="clear">
                      <input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="btn btn-primary">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal Script -->
        <script>
        document.addEventListener('DOMContentLoaded', function () {
          // Check cookie
          if (!document.cookie.includes('mailchimpModalSeen=true')) {
            setTimeout(function () {
              var mailchimpModal = new bootstrap.Modal(document.getElementById('mailchimpModal'));
              mailchimpModal.show();
            }, 3000); // Show after 3 seconds
          }

          // Set cookie on close or form submit
          function setModalCookie() {
            const expiry = new Date();
            expiry.setFullYear(expiry.getFullYear() + 1);
            document.cookie = "mailchimpModalSeen=true; path=/; expires=" + expiry.toUTCString();
          }

          document.getElementById('mailchimpModal').addEventListener('hidden.bs.modal', setModalCookie);

          document.getElementById('mc-embedded-subscribe-form').addEventListener('submit', setModalCookie);
        });
        </script>

        <style>
          #mailchimpModal .modal-content {
            border-radius: 12px;
          }
          #mc_embed_signup {
            max-width: 400px;
            margin: 0 auto;
          }
        </style>
        <?php
    }
}
add_action('wp_footer', 'add_mailchimp_modal_popup');