<?php

// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if (!function_exists('chld_thm_cfg_locale_css')):
    function chld_thm_cfg_locale_css($uri)
    {
        if (empty($uri) && is_rtl() && file_exists(get_template_directory() . '/rtl.css'))
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter('locale_stylesheet_uri', 'chld_thm_cfg_locale_css');

// END ENQUEUE PARENT ACTION

/*
 * Custom code from here and below
 */

include "includes/index.php";
include "blocks/index.php";

// Registering Style from SASS
wp_register_style("style-sass", get_template_directory_uri() . "-child/assets/css/style.css", [], true);
/*
//Swipper
wp_register_style("swiper-css", get_template_directory_uri() . "-child/assets/css/swiper-bundle.min.css", [], true);
wp_register_script("swiper-js", get_template_directory_uri() . "-child/assets/js/swiper.js", [], true);
*/

//Slick slider
wp_register_style("slick-css", get_template_directory_uri() . "-child/assets/css/slick.css", [], true);
wp_register_script("slick-js", get_template_directory_uri() . "-child/assets/js/slick.js", array('jquery'), true);

/*
 * wp_head actions
 */
add_action("wp_head", function () {
    wp_enqueue_style('style-sass');
});

/*
 * wp_footer actions
 */
add_action("wp_footer", function () {
    wp_enqueue_script('jquery');
});

/*
 * ACF option menu in WP Dashboard
 */
if (function_exists('acf_add_options_page')) {

    acf_add_options_page(
        array(
            'page_title' => 'Options - General',
            'menu_title' => 'Options',
            'menu_slug' => 'options-settings',
            'capability' => 'edit_posts',
            'redirect' => false
        )
    );

    acf_add_options_sub_page(
        array(
            'page_title' => 'Theme Social Icons Settings',
            'menu_title' => 'Social Icons',
            'parent_slug' => 'options-settings',
        )
    );
} //ACF option menu in WP Dashboard

/*
 * Returning the default speakers avatar image file
 */
function default_speaker_avatar()
{
    if (class_exists('ACF')):
        if (isset(get_field('options_general_group', "option")['avatar_for_speakers']['url'])) {
            return get_field('options_general_group', "option")['avatar_for_speakers']['url'];
        } else {
            return get_template_directory_uri() . "/assets/images/speaker_avatar.jpg";
        }
    else:
        return get_template_directory_uri() . "/assets/images/speaker_avatar.jpg";
    endif;
}

/*
 * Returning the default partners avatar image file
 */
function default_partners_avatar()
{
    if (class_exists('ACF')):
        if (isset(get_field('options_general_group', "option")['avatar_for_partners']['url'])) {
            return get_field('options_general_group', "option")['avatar_for_partners']['url'];
        } else {
            return get_template_directory_uri() . "/assets/images/partners_avatar.jpg";
        }
    else:
        return get_template_directory_uri() . "/assets/images/partners_avatar.jpg";
    endif;
}

/*
 * Returning the default placeholder image file
 */
function default_placeholder_image()
{
    if (class_exists('ACF')):
        if (isset(get_field('options_general_group', "option")['avatar_for_generals']['url'])) {
            return get_field('options_general_group', "option")['avatar_for_generals']['url'];
        } else {
            return get_template_directory_uri() . "/assets/images/default.jpg";
        }
    else:
        return get_template_directory_uri() . "/assets/images/default.jpg";
    endif;
}

/*
 * Changing the Login logo
 */
function my_login_logo()
{
    if (class_exists('ACF')):
        if (get_field('options_general_group', "option")['login_image']): ?>
            <style type="text/css">
                #login h1 a,
                .login h1 a {
                    background-image: url("<?= get_field('options_general_group', "option")['login_image']['url'] ?>");
                    background-size: contain;
                    background-position: center center;
                    background-repeat: no-repeat;
                    padding-bottom: 30px;
                    width: 100%;
                    height: 70px;
                    margin: 0 auto;
                }
            </style>
            <?php
        endif;
    endif;
}
add_action('login_enqueue_scripts', 'my_login_logo');