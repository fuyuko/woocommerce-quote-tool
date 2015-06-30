<?php   
    /* 
    Plugin Name: WooCommerce Quote Tool
    Plugin URI: https://github.com/fuyuko/woocommerce-quote-tool
    Description: Plugin description 
    Author: Fuyuko Gratton 
    Version: 0.1
    Author URI: http://fuyuko.net/
    */ 

if ( ! defined( 'ABSPATH' ) ) { 
    exit; // Exit if accessed directly
}


/**
 * Activation Setup
 **/
register_activation_hook( __FILE__, 'woocommerce_quote_tool_activate' );
function woocommerce_quote_tool_activate(){
    //define the quote product text to display
    //update_option('woocommerce_quote_tool_text', 'Please Contact Us To Order This Product');
} 


/**
 * Deactivation Setup
 **/
register_deactivation_hook( __FILE__, 'woocommerce_quote_tool_deactivate' );
function woocommerce_quote_tool_deactivate(){
   //delete_option('woocommerce_quote_tool_text');
} 

/**
 * For WooCommerce Extension Plugin - Check if WooCommerce is active
 **/
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

   	/**
     * BACKEND INSTALLED PLUGIN PAGE - additional links below the plugin title
     **/
    add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'quote_tool_plugin_action_links' );
    function quote_tool_plugin_action_links( $links ) {
       //$links[] = '<a href="'. esc_url( get_admin_url(null, 'admin.php?page=wc-settings&tab=products&section=quote_tool') ) .'">Settings</a>';
       return $links;
    }

    /**
    * The normal WooCommerce template loader searches the following locations in order, until a match is found:
    *  1. your theme / template path / template name
    *  2. your theme / template name
    *  3. default path / template name
    *
    * The new order of search will be:
    *  1. your theme / template path / template name
    *  2. your theme / template name
    *  3. your plugin / woocommerce / template name
    *  4. default path / template name
    **/
    add_filter( 'woocommerce_locate_template', 'myplugin_woocommerce_locate_template', 10, 3 );
    function myplugin_plugin_path() { // gets the absolute path to this plugin directory
        return untrailingslashit( plugin_dir_path( __FILE__ ) );    
    }     
    function myplugin_woocommerce_locate_template( $template, $template_name, $template_path ) {
         
        global $woocommerce;
         
        $_template = $template;
         
        if ( ! $template_path ) $template_path = $woocommerce->template_url;
         
        $plugin_path  = myplugin_plugin_path() . '/woocommerce/';
         
        // Look within passed path within the theme - this is priority
        $template = locate_template( 
            array(
                $template_path . $template_name,
                $template_name
            )
        );

        // Modification: Get the template from this plugin, if it exists
        if ( ! $template && file_exists( $plugin_path . $template_name ) ){
            $template = $plugin_path . $template_name; 
        }
         
        // Use default template
        if ( ! $template ) $template = $_template;
         
        // Return what we found
        return $template;   
    }

    /**
     * FUNCTION OVERWRITE - wc_get_template_part (return template part overwritten in this plugin)
    */
    add_filter('wc_get_template_part', 'myplugin_woocommerce_get_template_part', 10, 3);
    function myplugin_woocommerce_get_template_part($template, $slug, $name){

        $plugin_path  = myplugin_plugin_path() . '/woocommerce/';

        if(file_exists( $plugin_path . $slug . "-" . $name . ".php")){
            $template =  $plugin_path . $slug . "-" . $name . ".php";
        }
        return $template;
    }


    /**
     * TEXT OVERWRITE - customize add to cart button text in single product page
    */
    add_filter( 'woocommerce_product_single_add_to_cart_text', 'quote_tool_button_text' );  
    function quote_tool_button_text() {    
            return __( 'Request A Quote For This Product', 'woocommerce' );     
    }

    /**
     * TEXT OVERWRITE - customize add to cart button text in product archive page
    */
    add_filter( 'woocommerce_product_add_to_cart_text', 'quote_tool_archive_custom_cart_button_text' );    
    function quote_tool_archive_custom_cart_button_text() {     
            return __( 'Request A Quote', 'woocommerce' );     
    }

    
  
}


?>