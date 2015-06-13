<?php
/**
 * Settings
 *
 * @package     EDD\Empty Cart\Functions
 * @since       1.0.0
 */

function edd_empty_cart_settings( $settings ) {

	$empty_cart_settings = array(
		array(
			'id'    => 'edd_empty_cart_settings',
			'name'  => '<strong>' . __( 'Empty Cart Settings', 'edd-empty-cart' ) . '</strong>',
			'desc'  => __( 'Configure Empty Cart Settings', 'edd-empty-cart' ),
			'type'  => 'header',
		),
		array(
			'id'   => 'edd_empty_cart_title',
			'name' => __( 'Empty Cart Title', 'edd-empty-cart' ),
			'desc' => __( 'The title of the content displayed on the checkout page when there are no items in the cart. Leave blank for no title.', 'edd-empty-cart' ),
			'type' => 'text',
			'size' => 'regular',
			'std'  => __( 'Your cart is empty.', 'edd-empty-cart' ),
		),
		array(
			'id'   => 'edd_empty_cart_content',
			'name' => __( 'Empty Cart Content', 'edd-empty-cart' ),
			'desc' => __( 'The content displayed directly below the Empty Cart Title. Leave blank for no content.', 'edd-empty-cart' ),
			'type' => 'rich_editor',
			'std'  => __( 'It appears you do not have any items in your cart. Perhaps you would be interested in one of the items below.', 'edd-empty-cart' ),
		),
		array(
			'id'   => 'edd_empty_cart_downloads_shortcode',
			'name' => __( 'Empty Cart Downloads Shortcode', 'edd-empty-cart' ),
			'desc' => sprintf( __( 'The exact %1$s shortcode %2$s to output in the empty cart. Configure the shortcode just as you would in a post or page. Leave blank to show no %3$s.', 'edd-empty-cart' ), '<strong>[downloads]</strong>', '(<a href="http://docs.easydigitaldownloads.com/article/224-downloads" target="_blank">?</a>)', edd_get_label_plural() ),
			'type' => 'text',
			'size' => 'large',
			'std'  => '[downloads]',
		),
	);

	return array_merge( $settings, $empty_cart_settings );
}
add_filter( 'edd_settings_extensions', 'edd_empty_cart_settings', 999, 1 );