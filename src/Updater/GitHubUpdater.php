<?php
namespace AmeStyler\Updater;

class GitHubUpdater {
    const GITHUB_REPO = 'https://github.com/yourusername/ame-styler'; // Dummy URL
    const GITHUB_RAW = 'https://raw.githubusercontent.com/yourusername/ame-styler/main/';
    const VERSION = '1.0.0';

    public static function init() {
        add_filter('pre_set_site_transient_update_plugins', [static::class, 'check_for_update']);
        add_filter('plugins_api', [static::class, 'plugins_api'], 10, 3);
    }

    public static function check_for_update($transient) {
        if (empty($transient->checked)) {
            return $transient;
        }
        $plugin = 'ame-styler/ame-styler.php';
        $remote = self::get_remote_info();
        if ($remote && version_compare(self::VERSION, $remote['version'], '<')) {
            $transient->response[$plugin] = (object) [
                'slug' => 'ame-styler',
                'plugin' => $plugin,
                'new_version' => $remote['version'],
                'url' => self::GITHUB_REPO,
                'package' => $remote['zip_url'],
            ];
        }
        return $transient;
    }

    public static function plugins_api($result, $action, $args) {
        if ($action !== 'plugin_information' || $args->slug !== 'ame-styler') {
            return $result;
        }
        $remote = self::get_remote_info();
        if (!$remote) {
            return $result;
        }
        return (object) [
            'name' => 'AME Styler',
            'slug' => 'ame-styler',
            'version' => $remote['version'],
            'author' => '<a href="https://github.com/yourusername">Your Name</a>',
            'homepage' => self::GITHUB_REPO,
            'download_link' => $remote['zip_url'],
            'sections' => [
                'description' => 'Extends Admin Menu Editor with collapsible menu sections and customizable styling.',
            ],
        ];
    }

    private static function get_remote_info() {
        $response = wp_remote_get(self::GITHUB_RAW . 'release.json');
        if (is_wp_error($response)) {
            return false;
        }
        $data = json_decode(wp_remote_retrieve_body($response), true);
        if (!is_array($data) || empty($data['version']) || empty($data['zip_url'])) {
            return false;
        }
        return $data;
    }
}
