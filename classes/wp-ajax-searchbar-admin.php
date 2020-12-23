<?php


class WpAjaxSearchbarAdmin {
    
    public $settings_slug = 'wp-ajax-searchbar-settings';
    
    public function __construct() {
        add_action('admin_menu', [$this, 'addPluginAdminMenu'], 9);
        add_action('admin_init', [$this, 'registerSettings']);
        add_action('admin_init', [$this, 'injectAssets']);
    }
    
    public function addPluginAdminMenu() {
        add_menu_page($this->settings_slug, 'WP AJAX Searchbar', 'administrator', $this->settings_slug, [$this, 'renderPluginSettingPage'], 'dashicons-search', 81);
        
    }
    
    public function injectAssets() {
        wp_register_style('wp_ajax_searchbar_admin_colorpicker_css', WP_PLUGIN_URL . '/wp-ajax-searchbar/assets/css/spectrum.min.css');
        wp_enqueue_style('wp_ajax_searchbar_admin_colorpicker_css');
        
        wp_register_script('wp_ajax_searchbar_admin_colorpicker_js', WP_PLUGIN_URL . '/wp-ajax-searchbar/assets/js/spectrum.min.js', ['jquery']);
        
        wp_enqueue_script('jquery');
        wp_enqueue_script('wp_ajax_searchbar_admin_colorpicker_js');
    }
    
    public function renderPluginSettingPage() {
        require_once WP_PLUGIN_DIR . '/wp-ajax-searchbar/views/settings-page.php';
    }
     
    public function registerSettings() {
        register_setting('wp-ajax-searchbar-plugin-settings', 'searchbox_font_size');
        register_setting('wp-ajax-searchbar-plugin-settings', 'searchbox_font_color');
        register_setting('wp-ajax-searchbar-plugin-settings', 'searchbox_placeholder_color');
        register_setting('wp-ajax-searchbar-plugin-settings', 'searchbox_bg_color');
        register_setting('wp-ajax-searchbar-plugin-settings', 'searchbox_border_radius');
        register_setting('wp-ajax-searchbar-plugin-settings', 'searchbox_border_color');
        register_setting('wp-ajax-searchbar-plugin-settings', 'results_max_height');
        register_setting('wp-ajax-searchbar-plugin-settings', 'results_scrollbar_color');
        register_setting('wp-ajax-searchbar-plugin-settings', 'results_border_radius');
        register_setting('wp-ajax-searchbar-plugin-settings', 'results_font_size');
        register_setting('wp-ajax-searchbar-plugin-settings', 'results_font_color');
        register_setting('wp-ajax-searchbar-plugin-settings', 'results_hover_accent_color');
        register_setting('wp-ajax-searchbar-plugin-settings', 'results_hover_bg_color');
        register_setting('wp-ajax-searchbar-plugin-settings', 'results_hover_font_color');
    }   
}