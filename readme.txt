=== WooCommerce Quote Tool ===
Contributors: fuyuko
Donate link: http://fuyuko.net/donation/
Tags: 
Requires at least: 4.2.2
Tested up to: 4.2.2
Stable tag: 
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
WC requires at least: 2.3.9
WC tested up to: 2.3.9
 
Short plugin description
 
== Description ==
 
Long plugin description
 
= Features =
 
 
= Notes =
 
 
== Installation ==
 
Starndard Wordpress Plugin install.
 
1. Upload `woocommerce-quote-tool.zip` using Wordpress plugin upload feature, or unzip the file and upload the content to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
 
== Frequently Asked Questions ==
 
 
== Screenshots ==
 
1. screenshot1.png description
 
== Changelog ==
== 0.0 ==
Project under development. Incomplete as of this initial commit.

woocommerce-quote-tool.php = overwrite woocommerce templates, overwrite woo commerce template parts, overwrite add to cart button text in single product page and product archive page
woocommerce/content-product.php = removed action "woocommerce_template_loop_price"
woocommerce/cart/cart-totals.php = removed entire table displaying cart totals
woocommerce/cart/cart.php = removed product price, product subtotal from each product listed in the cart
woocommerce/checkout/form-checkout.php = the checkout form title changed from "Your Order" to "Items For Quote Request"
woocommerce/checkout/review-order.php = product total column, product subtotal column, and cart total section removed
woocommerce/signle-product/price.php = removed content of offers div
woocommerce/single-product/add-to-cart/variable.php = "display:  none;" applied to .single_variation_wrap and .single_variation

