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
        wp_enqueue_style('wpdo-css', WPDO_PLUGIN_DIR . '/assets/css/bootstrap.min.css');
        wp_enqueue_style('dashicons');
        // wp_enqueue_script('wpdo-js', WPDO_PLUGIN_DIR . '/assets/js/main.js', array('jquery'), null, true);
        wp_enqueue_script('wpdo-js', WPDO_PLUGIN_DIR . '/assets/js/bootstrap.min.js');
        wp_enqueue_script('jquery');
        wp_enqueue_script('wpdo-js', WPDO_PLUGIN_DIR . '/assets/js/popper.min.js');
    }
    add_action('wp_enqueue_scripts', 'wpdo_plugin_scripts');
}

function add_custom_buttons_after_product_image()
{
    global $product; ?>

    <div class="custom-buttons">
        <!-- <button id="button1" class="btn btn-primary">Button 1</button> -->
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
            Images
        </button>
        <button class="button2">Button 2</button>
        <button class="button3">Button 3</button>
        <button class="button4">Button 4</button>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Images</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closebtn">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="product-gallery">
                        <table class="gallery-table">
                            <tbody>
                                <?php
                                // Get the gallery image IDs
                                $gallery_image_ids = $product->get_gallery_image_ids();

                                // Loop through the gallery image IDs
                                foreach ($gallery_image_ids as $gallery_image_id) {
                                    // Get the thumbnail URL
                                    $thumbnail_url = wp_get_attachment_image_url($gallery_image_id, 'medium');

                                    // Get the image title (name)
                                    $image_title = get_the_title($gallery_image_id);

                                    // Get the full-size image URL for download
                                    $image_url = wp_get_attachment_url($gallery_image_id);

                                    // Output the gallery item within a table row
                                    ?>
                                    <tr class="gallery-item">
                                        <td><?php echo $image_title; ?></td>
                                        <td><img src="<?php echo $thumbnail_url; ?>" alt="<?php echo $image_title; ?>"
                                                width="100px"></td>
                                        <td><a href="<?php echo $image_url; ?>" download><i
                                                    class="dashicons dashicons-download"></i></a>
                                        </td>
                                    </tr>
                        </div>
                        <?php
                                }
                                ?>
                    </tbody>
                    </table>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
    </div>
    <?php
}
add_action('woocommerce_before_single_product_summary', 'add_custom_buttons_after_product_image');

function menu_settings_cb()
{
    echo '<h1>Wpdo Thumbnails Buttons Settings</h1>';
}

function sub_menu_settings_cb()
{
    echo '<h1>All Buttons</h1>';
    ?>
    <form action="" method="post">
        <label for="button_name">Button Name:</label>
        <input type="text" id="button_name" name="button_name" placeholder="Enter button name"><br><br>

        <label for="button_link">Button Link:</label>
        <input type="url" id="button_link" name="button_link" placeholder="Enter button link"><br><br>

        <input type="submit" value="Submit">
    </form>
    <?php
}
function add_custom_menu_page()
{
    add_menu_page('Wpdo Thumbnails Buttons', 'Wpdo Buttons', 'manage_options', 'wpdo-settings', 'menu_settings_cb', 'dashicons-admin-site-alt2', 30);
}
function add_custom_menu_page_two()
{
    add_submenu_page(
        'wpdo-settings',
        'All Buttons',
        'Button 01',
        'manage_options',
        'wpdo-settings-button-01',
        'sub_menu_settings_cb'
    );
}

add_action('admin_menu', 'add_custom_menu_page');
add_action('admin_menu', 'add_custom_menu_page_two');

// MY CODE 

