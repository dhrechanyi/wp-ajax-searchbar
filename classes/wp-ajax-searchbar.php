<?php


class WpAjaxSearchbar {
    
    private $debug = false;
    
    public function __construct(){
        add_action('init', [$this, 'injectAssets']);
        add_action('wp_ajax_wp_ajax_searchbar_run_query', [$this, 'runSearchQuery']);
        add_action('wp_ajax_nopriv_wp_ajax_searchbar_run_query', [$this, 'runSearchQuery']);
        
        add_shortcode('wp_ajax_searchbar', [$this, 'renderSearchBar']);
    }
    
    public function injectAssets() {
        wp_register_style('wp_ajax_searchbar_css', WP_PLUGIN_URL . '/wp-ajax-searchbar/assets/css/styles.css');
        wp_enqueue_style('wp_ajax_searchbar_css');
        
        if(strlen(esc_attr(get_option('searchbox_font_size')))) {
            wp_add_inline_style( 'wp_ajax_searchbar_css', '.wp-ajax-searchbar-plugin .wrapper .input-box .input-field { font-size: ' . esc_attr(get_option('searchbox_font_size')) . 'px !important; }');
        }        
        
        if(strlen(esc_attr(get_option('searchbox_font_color')))) {
            wp_add_inline_style( 'wp_ajax_searchbar_css', '.wp-ajax-searchbar-plugin .wrapper .input-box .input-field { color: ' . esc_attr(get_option('searchbox_font_color')) . ' !important; }');
        }
        
        if(strlen(esc_attr(get_option('searchbox_placeholder_color')))) {
            wp_add_inline_style( 'wp_ajax_searchbar_css', '.wp-ajax-searchbar-plugin .wrapper .input-box .input-field::placeholder { color: ' . esc_attr(get_option('searchbox_placeholder_color')) . ' !important; }');
        }   
        
        if(strlen(esc_attr(get_option('searchbox_bg_color')))) {
            wp_add_inline_style( 'wp_ajax_searchbar_css', '.wp-ajax-searchbar-plugin .wrapper .input-box .input-field { background-color: ' . esc_attr(get_option('searchbox_bg_color')) . ' !important; }');
        } 
        
        if(strlen(esc_attr(get_option('searchbox_border_radius')))) {
            wp_add_inline_style( 'wp_ajax_searchbar_css', '.wp-ajax-searchbar-plugin .wrapper .input-box .input-field { border-radius: ' . esc_attr(get_option('searchbox_border_radius')) . 'px !important; }');
        }
        
        if(strlen(esc_attr(get_option('searchbox_border_color')))) {
            wp_add_inline_style( 'wp_ajax_searchbar_css', '.wp-ajax-searchbar-plugin .wrapper .input-box .input-field { border-color: ' . esc_attr(get_option('searchbox_border_color')) . ' !important; }');
        }
        
        if(strlen(esc_attr(get_option('results_max_height')))) {
            wp_add_inline_style( 'wp_ajax_searchbar_css', '.wp-ajax-searchbar-plugin .wrapper .autocomplete-box { max-height: ' . esc_attr(get_option('results_max_height')) . 'px !important; }');
        }
        
        if(strlen(esc_attr(get_option('results_scrollbar_color')))) {
            wp_add_inline_style( 'wp_ajax_searchbar_css', '.wp-ajax-searchbar-plugin .wrapper .autocomplete-box::-webkit-scrollbar-thumb { background-color: ' . esc_attr(get_option('results_scrollbar_color')) . ' !important; }');
        }
        
        if(strlen(esc_attr(get_option('results_border_radius')))) {
            wp_add_inline_style( 'wp_ajax_searchbar_css', '.wp-ajax-searchbar-plugin .wrapper .autocomplete-box { border-radius: ' . esc_attr(get_option('results_border_radius')) . 'px !important; }');
        }
        
        if(strlen(esc_attr(get_option('results_font_size')))) {
            wp_add_inline_style( 'wp_ajax_searchbar_css', '.wp-ajax-searchbar-plugin .wrapper .autocomplete-box ul li a { font-size: ' . esc_attr(get_option('results_font_size')) . 'px !important; }');
        }
        
        if(strlen(esc_attr(get_option('results_font_color')))) {
            wp_add_inline_style( 'wp_ajax_searchbar_css', '.wp-ajax-searchbar-plugin .wrapper .autocomplete-box ul li a { color: ' . esc_attr(get_option('results_font_color')) . ' !important; }');
        } 
        
        if(strlen(esc_attr(get_option('results_hover_accent_color')))) {
            wp_add_inline_style( 'wp_ajax_searchbar_css', '.wp-ajax-searchbar-plugin .wrapper .autocomplete-box ul a:hover { border-color: ' . esc_attr(get_option('results_hover_accent_color')) . ' !important; }');
        }
        
        if(strlen(esc_attr(get_option('results_hover_bg_color')))) {
            wp_add_inline_style( 'wp_ajax_searchbar_css', '.wp-ajax-searchbar-plugin .wrapper .autocomplete-box ul a:hover { background-color: ' . esc_attr(get_option('results_hover_bg_color')) . ' !important; }');
        }
        
        if(strlen(esc_attr(get_option('results_hover_font_color')))) {
            wp_add_inline_style( 'wp_ajax_searchbar_css', '.wp-ajax-searchbar-plugin .wrapper .autocomplete-box ul a:hover { color: ' . esc_attr(get_option('results_hover_font_color')) . ' !important; }');
        }
        
        wp_register_script('wp_ajax_searchbar_vue_js', WP_PLUGIN_URL . '/wp-ajax-searchbar/assets/js/' . ($this->debug ? 'vue.min' : 'vue') . '.js', ['jquery']);
        
        wp_register_script('wp_ajax_searchbar_js', WP_PLUGIN_URL . '/wp-ajax-searchbar/assets/js/scripts.js', ['jquery', 'wp_ajax_searchbar_vue_js']);
        wp_localize_script('wp_ajax_searchbar_js', '__wp_ajax_searchbar', ['ajax_url' => admin_url( 'admin-ajax.php' )]);
        
        wp_enqueue_script('jquery');
        wp_enqueue_script('wp_ajax_searchbar_vue_js');
        wp_enqueue_script('wp_ajax_searchbar_js');
    }
        
    public function runSearchQuery() {
        if (!wp_verify_nonce($_REQUEST['nonce'], 'wp_ajax_searchbar_nonce')) {
            die('Not allowed');
        }
        
        $response = [];
        
        if(!empty($_REQUEST['search_query'])) {
            $query = new WP_Query([
                'post_type'         => ['page', 'post', 'product_pages'],
                'post_status'       => ['publish'],
                'posts_per_page'    => -1,
                'orderby'           => 'title',
                'order'             => 'ASC',
                's'                 => strip_tags($_REQUEST['search_query'])
            ]);
            
            if(!empty($query->posts)) {
                foreach($query->posts as $post) {
                    if(get_option('page_on_front') == $post->ID) {
                        continue;    
                    }
                    
                    $response[] = [
                        'id'    => $post->ID,
                        'title' => $post->post_title,
                        'url'   => get_permalink($post)
                    ];   
                }
            }
        }
        
        die(json_encode($response));
    }
    
    public function renderSearchBar() {
        require_once WP_PLUGIN_DIR . '/wp-ajax-searchbar/views/search-box.php';
    }
    
}