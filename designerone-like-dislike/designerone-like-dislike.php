<?php
/**
 * Plugin Name: DesignerOne Like/Dislike
 * Plugin URI: https://nasir-saeed-portfolio.netlify.app/
 * Author: Nasir Saeed
 * Author URI: https://nasir-saeed-portfolio.netlify.app/
 * Description: Post Like and Dislike 
 * Version: 1.0.0
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       design-one
 */

if (!defined('WPINC')) {
    die;
}

if (!defined('WPDO_PLUGIN_VERSION')) {
    define('WPDO_PLUGIN_VERSION', '1.0.0');
}

if (!defined('WPDO_PLUGIN_DIR')) {
    define('WPDO_PLUGIN_DIR', plugin_dir_url(__FILE__));
}

if (!function_exists('wpdo_plugin_scripts')) {
    function wpdo_plugin_scripts()
    {
        wp_enqueue_style('wpdo-css', WPDO_PLUGIN_DIR . '/assets/css/style.css');
        wp_enqueue_script('wpdo-js', WPDO_PLUGIN_DIR . '/assets/js/main.js');
    }
    add_action('wp_enqueue_scripts', 'wpdo_plugin_scripts');
}


function wpdo_settings_page_html()
{
    if(!is_admin()){
        return;
    }?>
        <div class="wrap">
            <form action="options.php" method="post">
                <?php
                    settings_fields('wpdo-settings');
                    do_settings_sections('wpdo-settings');
                    submit_button('Save Changes');
                ?>
            </form>
        </div>
    <?
}

function wpdo_register_menu_page()
{
    add_menu_page('WPDO Like System', 'WPDO Settings', 'manage_options', 'wpdo-settings', 'wpdo_settings_page_html', 'dashicons-thumbs-up', 30);
}
add_action('admin_menu ', 'wpdo_register_menu_page');

function wpdo_plugin_settings()
{
    register_setting('wpdo_settings','wpdo_like_btn_label');
    register_setting('wpdo_settings','wpdo_dislike_btn_label');

    // register a new section in the "reading" page
    add_settings_section(
        'wpdo__label_settings_section',
        'WPDO Button Labels',
        'wpdo_plugin_settings_section_cb',
        'wpdo_settings'
    );

    // register a new field in the "wpdo_settings_section" section, inside the "reading" page
    add_settings_field(
        'wpdo_like_label_field',
        'Like Button Label',
        'wpdo_like_label_field_cb',
        'wpdo_settings',
        'wpdo__label_settings_section'
    );

}

add_action('admin_init', 'wpdo_plugin_settings');

function wpdo_plugin_settings_section_cb(){
    echo '<p>Define Button Labels</p>';
}
function wpdo_like_label_field_cb(){
    $setting = get_option('wpdo_like_btn_label');
	?>
	<input type="text" name="wpdo_like_btn_label" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
    <?php
    
}?>