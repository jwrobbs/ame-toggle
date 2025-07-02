<?php
/**
 * Plugin Name: AME Styler
 * Description: Extends Admin Menu Editor with collapsible menu sections, accordion behavior, and customizable menu styling.
 * Version: 1.0.2
 * Author: Josh Robbs
 * Author URI: https://joshrobbs.com
 * Text Domain: ame-styler
 * Domain Path: /languages
 */

// Require Composer autoloader
require_once __DIR__ . '/vendor/autoload.php';

// Bootstrap plugin
AmeStyler\Core\Plugin::init();
