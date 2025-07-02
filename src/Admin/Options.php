<?php
namespace AmeStyler\Admin;

class Options {
    const OPTION_NAME = 'ame_styler_options';
    const DEFAULTS = [
        'text_color' => '#FFFFFF',
        'background_color' => '#002244',
        'hover_text_color' => '#FFFFFF',
        'hover_background_color' => '#003366',
    ];

    public static function register() {
        register_setting('ame_styler_group', self::OPTION_NAME, [
            'type' => 'array',
            'sanitize_callback' => [static::class, 'sanitize'],
            'default' => self::DEFAULTS,
        ]);

        add_settings_section(
            'ame_styler_section',
            __('Menu Styler Settings', 'ame-styler'),
            null,
            'ame_styler'
        );

        add_settings_field('text_color', __('Text Color', 'ame-styler'), [static::class, 'color_field'], 'ame_styler', 'ame_styler_section', ['label_for' => 'text_color']);
        add_settings_field('background_color', __('Background Color', 'ame-styler'), [static::class, 'color_field'], 'ame_styler', 'ame_styler_section', ['label_for' => 'background_color']);
        add_settings_field('hover_text_color', __('Text Color (Hover)', 'ame-styler'), [static::class, 'color_field'], 'ame_styler', 'ame_styler_section', ['label_for' => 'hover_text_color']);
        add_settings_field('hover_background_color', __('Background Color (Hover)', 'ame-styler'), [static::class, 'color_field'], 'ame_styler', 'ame_styler_section', ['label_for' => 'hover_background_color']);
    }

    public static function color_field($args) {
        $options = get_option(self::OPTION_NAME, self::DEFAULTS);
        $id = $args['label_for'];
        $value = isset($options[$id]) ? esc_attr($options[$id]) : '';
        echo "<input type='text' id='{$id}' name='" . self::OPTION_NAME . "[{$id}]' value='{$value}' class='ame-styler-color-field' data-default-color='" . esc_attr(self::DEFAULTS[$id]) . "' />";
    }

    public static function add_options_page() {
        add_options_page(
            __('AME Styler', 'ame-styler'),
            __('AME Styler', 'ame-styler'),
            'manage_options',
            'ame_styler',
            [static::class, 'render_options_page']
        );
    }

    public static function render_options_page() {
        ?>
        <div class="wrap">
            <h1><?php _e('AME Styler Settings', 'ame-styler'); ?></h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('ame_styler_group');
                do_settings_sections('ame_styler');
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }

    public static function enqueue_assets($hook) {
        if ($hook !== 'settings_page_ame_styler') {
            return;
        }
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_script('ame-styler-color', plugins_url('../../js/ame-styler-color.js', __FILE__), ['wp-color-picker'], '1.0.0', true);
    }

    public static function output_inline_styles() {
        $options = get_option(self::OPTION_NAME, self::DEFAULTS);
        ?>
        <style id="ame-styler-custom-css">
        .ame-styler-header {
            color: <?php echo esc_html($options['text_color']); ?>;
            background: <?php echo esc_html($options['background_color']); ?>;
        }
        .ame-styler-header:hover {
            color: <?php echo esc_html($options['hover_text_color']); ?>;
            background: <?php echo esc_html($options['hover_background_color']); ?>;
        }
        </style>
        <?php
    }

    public static function sanitize($input) {
        foreach (self::DEFAULTS as $key => $default) {
            if (!isset($input[$key]) || !preg_match('/^#[a-fA-F0-9]{6}$/', $input[$key])) {
                $input[$key] = $default;
            }
        }
        return $input;
    }
}
