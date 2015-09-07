<?php
/**
 * Adds a magic tag for ACF's get_field
 *
 * @author    Josh Pollock <Josh@JoshPress.net>
 * @license   GPL-2.0+
 * @link
 * @copyright 2015 Josh Pollock for CalderaWP LLC.
 */

namespace calderawp\filter\acf;


class acf_field {

	public function __construct() {
		add_filter( 'caldera_magic_tag-acf_field', array( $this, 'do_magic' ) );
	}

	/**
	 * Process with get_field()
	 *
	 * @uses "caldera_magic_tag-acf_field" filter
	 *
	 * @param array $params
	 *
	 * @return bool
	 */
	public function do_magic( $params ) {
		if ( function_exists( 'get_field' ) ) {

			$params = explode( ':', $params );

			if( isset( $params[1] ) ){
				$post = get_post( $params[0] );
				$field = $params[1];

			}else{
				global $post;
				$field = $params[0];

			}

			if ( is_object( $post ) && isset( $post->ID) ) {
				$post_id =  $post->ID;
			}else{
				$post_id = false;
			}

			return get_field( $field, $post_id );
		}

	}

}
