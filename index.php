<?php
   /*
   Plugin Name: WP Ajax Searchbar
   Plugin URI: 
   Description: Adds ajax seaarchbar shortcode
   Version: 1.0
   Author: Denys Hrechanyi
   Author URI: https://hrechanyi.pro/contacts
   License: GPL2
   */

    require 'classes/wp-ajax-searchbar.php';
    require 'classes/wp-ajax-searchbar-admin.php';
    
    
    new WpAjaxSearchbar();
    new WpAjaxSearchbarAdmin();
    

?>