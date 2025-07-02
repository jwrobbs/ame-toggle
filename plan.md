# AME Styler Plugin Plan

## Overview
A WordPress plugin that extends Admin Menu Editor (AME) to provide collapsible admin menu sections with accordion behavior and customizable styling. Includes GitHub update functionality and follows PSR-4 namespacing.

## Features
- Collapsible admin menu sections using CSS classes ending with `-ame-styler-header` and `-ame-styler-content`.
- Accordion behavior: only one section open at a time; all collapsed by default.
- Admin options page with 4 color pickers:
  - Text color (default: #FFF)
  - Background color (default: #002244)
  - Text color (hover)
  - Background color (hover)
- Uses jQuery for interactions, WP Settings API, WP color picker, and a GitHub updater class.
- Namespaces: `AmeStyler\Core`, `AmeStyler\Admin`, `AmeStyler\Updater`.
- Only affects menu items with the specified CSS classes, regardless of how they are added.
- No demo content or branding required.
- Plan file kept in the plugin root directory.

## Task List
- [x] Set up plugin folder structure and PSR-4 compliant namespaces
- [x] Add WordPress plugin headers and bootstrap file
- [ ] Implement collapsible/accordion menu JS and CSS (jQuery, default collapsed)
- [ ] Detect and toggle '-ame-styler-header' and '-ame-styler-content' classes
- [ ] Create admin options page with 4 color pickers (WP Settings API)
- [ ] Save and output custom color settings to admin menu
- [ ] Integrate GitHub updater class for automatic updates
- [ ] Ensure PSR-1, PSR-4, PSR-12 compliance
- [ ] Provide working demo and prepare downloadable plugin zip

## Current Goal
Set up plugin folder structure and namespaces
