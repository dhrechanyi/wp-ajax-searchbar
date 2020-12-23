<div class="wrap wp-ajax-searchbar-plugin-settings">
    <h2>WP AJAX Searchbar Settings</h2>  
    <?php settings_errors(); ?>  
    <p>To render searchbox add <code>[wp_ajax_searchbar]</code> shortcode to the needed part of the website.</p>
    <form method="POST" action="options.php">  
        <?php settings_fields('wp-ajax-searchbar-plugin-settings'); ?>
        <?php do_settings_sections('wp-ajax-searchbar-plugin-settings'); ?>
        
        <div class="input-rows">
            <table>
                <tr>
                    <td>
                        <label for="searchbox_font_color">Searchbox font color</label>
                    </td>
                    <td>
                        <input type="text" class="regular-text" id="searchbox_font_color" name="searchbox_font_color" placeholder="#333333" value="<?php echo esc_attr(get_option('searchbox_font_color')); ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="searchbox_placeholder_color">Searchbox placeholder color</label>
                    </td>
                    <td>
                        <input type="text" class="regular-text" id="searchbox_placeholder_color" name="searchbox_placeholder_color" placeholder="#a0a0a0" value="<?php echo esc_attr(get_option('searchbox_placeholder_color')); ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="searchbox_bg_color">Searchbox background color</label>
                    </td>
                    <td>
                        <input type="text" class="regular-text" id="searchbox_bg_color" name="searchbox_bg_color" placeholder="#ffffff" value="<?php echo esc_attr(get_option('searchbox_bg_color')); ?>">
                    </td>
                </tr>             
                <tr>
                    <td>
                        <label for="searchbox_border_color">Searchbox border color</label>
                    </td>
                    <td>
                        <input type="text" class="regular-text" id="searchbox_border_color" name="searchbox_border_color" placeholder="#ffffff" value="<?php echo esc_attr(get_option('searchbox_border_color')); ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="searchbox_font_size">Searchbox font size (px)</label>
                    </td>
                    <td>
                        <input type="number" step="1" min="1" class="regular-text" id="searchbox_font_size" name="searchbox_font_size" placeholder="16" value="<?php echo esc_attr(get_option('searchbox_font_size')); ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="searchbox_border_radius">Searchbox border radius (px)</label>
                    </td>
                    <td>
                        <input type="number" step="1" min="1" class="regular-text" id="searchbox_border_radius" name="searchbox_border_radius" placeholder="0" value="<?php echo esc_attr(get_option('searchbox_border_radius')); ?>">
                    </td>
                </tr>   
                <tr>
                    <td colspan="2">
                        <hr>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="results_scrollbar_color">Results scrollbar color</label>
                    </td>
                    <td>
                        <input type="text" class="regular-text" id="results_scrollbar_color" name="results_scrollbar_color" placeholder="#0073aa" value="<?php echo esc_attr(get_option('results_scrollbar_color')); ?>">
                    </td>
                </tr>                           
                <tr>
                    <td>
                        <label for="results_font_color">Results font color</label>
                    </td>
                    <td>
                        <input type="text" class="regular-text" id="results_font_color" name="results_font_color" placeholder="#0073aa" value="<?php echo esc_attr(get_option('results_font_color')); ?>">
                    </td>
                </tr>                
                <tr>
                    <td>
                        <label for="results_hover_accent_color">Results hover accent color</label>
                    </td>
                    <td>
                        <input type="text" class="regular-text" id="results_hover_accent_color" name="results_hover_accent_color" placeholder="#0073aa" value="<?php echo esc_attr(get_option('results_hover_accent_color')); ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="results_hover_bg_color">Results hover background color</label>
                    </td>
                    <td>
                        <input type="text" class="regular-text" id="results_hover_bg_color" name="results_hover_bg_color" placeholder="#e2e2e2" value="<?php echo esc_attr(get_option('results_hover_bg_color')); ?>">
                    </td>
                </tr>                
                <tr>
                    <td>
                        <label for="results_hover_font_color">Results hover font color</label>
                    </td>
                    <td>
                        <input type="text" class="regular-text" id="results_hover_font_color" name="results_hover_font_color" placeholder="#0073aa" value="<?php echo esc_attr(get_option('results_hover_font_color')); ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="results_max_height">Results max. height (px)</label>
                    </td>
                    <td>
                        <input type="number" step="1" min="1" class="regular-text" id="results_max_height" name="results_max_height" placeholder="250" value="<?php echo esc_attr(get_option('results_max_height')); ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="results_border_radius">Results border radius (px)</label>
                    </td>
                    <td>
                        <input type="number" step="1" min="1" class="regular-text" id="results_border_radius" name="results_border_radius" placeholder="0" value="<?php echo esc_attr(get_option('results_border_radius')); ?>">
                    </td>
                </tr>               
                <tr>
                    <td>
                        <label for="results_font_size">Results font size (px)</label>
                    </td>
                    <td>
                        <input type="number" step="1" min="1" class="regular-text" id="results_font_size" name="results_font_size" placeholder="16" value="<?php echo esc_attr(get_option('results_font_size')); ?>">
                    </td>
                </tr>    
            </table>

        </div>
        <?php submit_button(); ?>  
    </form> 
</div>

<style>
    .wp-ajax-searchbar-plugin-settings .input-rows {
        margin-top: 30px;
        margin-bottom: 30px;
    }
</style>

<script>
    jQuery(function ($) {
        $('#searchbox_font_color, #searchbox_placeholder_color, #searchbox_bg_color, #searchbox_border_color, #results_scrollbar_color, #results_font_color, #results_font_color, #results_hover_accent_color, #results_hover_bg_color, #results_hover_font_color').spectrum({
            type: "component",
            allowEmpty: true
        });
    })
</script>

