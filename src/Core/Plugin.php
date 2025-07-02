<?php
namespace AmeStyler\Core;

class Plugin {
    public static function init() {
        // Initialize admin options, scripts, styles, and updater
        add_action('admin_init', [static::class, 'register_settings']);
        add_action('admin_menu', [static::class, 'add_options_page']);
        add_action('admin_enqueue_scripts', [static::class, 'enqueue_assets']);
        add_action('admin_footer', [static::class, 'output_inline_styles']);
        \AmeStyler\Updater\GitHubUpdater::init();
        add_action('admin_enqueue_scripts', [static::class, 'enqueue_menu_script']);
    }

    public static function register_settings() {
        \AmeStyler\Admin\Options::register();
    }

    public static function add_options_page() {
        \AmeStyler\Admin\Options::add_options_page();
    }

    public static function enqueue_assets($hook) {
        \AmeStyler\Admin\Options::enqueue_assets($hook);
    }

    public static function output_inline_styles() {
        \AmeStyler\Admin\Options::output_inline_styles();
    }

    public static function enqueue_menu_script($hook) {
        // Only enqueue on admin pages
        wp_enqueue_script(
            'ame-styler-menu',
            plugins_url('../js/ame-styler-menu.js', __FILE__),
            ['jquery'],
            '1.0.0',
            true
        );
        wp_enqueue_style(
            'ame-styler-menu',
            plugins_url('../css/ame-styler-menu.css', __FILE__),
            [],
            '1.0.0'
        );
    }
}
