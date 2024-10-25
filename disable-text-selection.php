<?php
/**
 * Plugin Name:       Disable Text Selection
 * Plugin URI:        https://wordpress.org/plugins/disable-text-selection/
 * Description:       This plugin safeguards your valuable content by disabling text selection for regular users while allowing full access for administrators and editors.
 * Author:            Gulshan Kumar
 * Author URI:        https://www.gulshankumar.net/
 * Version:           1.0.0
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       disable-text-selection
 * Domain Path:       /languages
 */
// If this file is called directly, abort.
defined('ABSPATH') OR die();

/* Register activation hook. */
register_activation_hook( __FILE__, 'disable_text_selection_activation_hook' );

/**
 * Runs only when the plugin is activated.
 * @since 1.0.0
 */
function disable_text_selection_activation_hook() {

/* Create transient data */
    set_transient( 'disable-text-selection-activation-notice', true, 5 );
}

/* Add admin notice */
add_action( 'admin_notices', 'disable_text_selection_notice' );


/**
 * Admin Notice on Activation.
 * @since 1.0.0
 */
function disable_text_selection_notice() {
    // Check transient, if available display notice
    if ( get_transient( 'disable-text-selection-activation-notice' ) ) {
        // Add inline styles to the previously enqueued CSS file
        $inline_css = 'div#message.updated { display: none; }';
        wp_add_inline_style( 'custom-notice-style', $inline_css );

        ?>
        <div class="updated notice is-dismissible">
            <p><?php esc_html_e( 'Thank you for using Disable Text Selection. Please make sure to clear the Page Cache for the changes to take effect.', 'disable-text-selection' ); ?></p>
        </div>
        <?php
        /* Delete transient, only display this notice once. */
        delete_transient( 'disable-text-selection-activation-notice' );
    }
}
add_action( 'admin_init', 'disable_text_selection_notice' );

// Securely output support links
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'disable_text_selection_add_action_links' );
function disable_text_selection_add_action_links( $links ) {
    $plugin_shortcuts = array(
        sprintf(
            '<a rel="%s" title="%s" href="%s" target="_blank">%s</a>',
            esc_attr( 'nofollow noopener' ),
            esc_attr( 'Hire for Technical Support' ),
            esc_url( 'https://www.gulshankumar.net/contact/' ),
            esc_html__( 'Work with Gulshan', 'disable-text-selection' )
        ),
        sprintf(
            '<a rel="%s" title="%s" href="%s" target="_blank" style="%s">%s</a>',
            esc_attr( 'nofollow noopener' ),
            esc_attr( 'Show your support' ),
            esc_url( 'https://ko-fi.com/gulshan' ),
            esc_attr( 'color:#080;' ),
            esc_html__( 'Buy developer a coffee', 'disable-text-selection' )
        )
    );
    return array_merge( $links, $plugin_shortcuts );
}

// assets
function disable_text_selection_script() {
    // Get the plugin version from the plugin file header
    $plugin_data = get_file_data( __FILE__, [ 'Version' => 'Version' ] );
    $version = $plugin_data['Version'];

    // Check if the current user cannot edit others' posts (applies to roles below editor)
    if ( ! current_user_can( 'edit_others_posts' ) ) { 
        // Enqueue the disable text selection script
        wp_enqueue_script( 
            'disable-text-selection-clamp-script', // Unique handle for the script
            plugin_dir_url( __FILE__ ) . 'js/disable-text-selection.js', 
            [], 
            $version,  // Use the dynamically retrieved version
            true // Load in the footer
        );

        // Check if the noscript message should be shown
        if ( apply_filters( 'disable_text_selection_noscript', true ) ) {
            // Enqueue the style for no-script overlay with media="all"
            wp_enqueue_style( 
                'disable-text-selection-style', // Unique handle for the style
                plugin_dir_url( __FILE__ ) . 'css/no-js-overlay.css', 
                [], 
                $version,  // Use the dynamically retrieved version
                'all' // Explicitly set media to "all"
            );

            // Directly add the <noscript> overlay after the opening body tag
            add_action( 'wp_body_open', function() {
                ?>
                <noscript>
                    <div class="js-disabled-overlay"></div>
                </noscript>
                <?php
            });
        }
    }
}
add_action( 'wp_enqueue_scripts', 'disable_text_selection_script' );
