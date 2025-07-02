<?php
/**
 * Plugin Name: AME Styler
 * Description: Extends Admin Menu Editor with collapsible menu sections, accordion behavior, and customizable menu styling.
 * Version: 1.0.0
 * Author: Your Name
 * Text Domain: ame-styler
 * Domain Path: /languages
 * Requires at least: 5.0
 * Requires PHP: 7.2
 */

// Require Composer autoloader
require_once __DIR__ . '/vendor/autoload.php';

// Bootstrap plugin
AmeStyler\Core\Plugin::init();
