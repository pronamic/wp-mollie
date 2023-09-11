<?php
/**
 * Payment Details
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2023 Pronamic
 * @license   GPL-3.0-or-later
 * @package   Pronamic\WordPress\Mollie
 */

namespace Pronamic\WordPress\Mollie;

/**
 * Payment details class
 */
class PaymentDetails {
	/**
	 * Create payment detailsfrom JSON.
	 *
	 * @link https://docs.mollie.com/reference/v2/payments-api/get-payment
	 * @param string      $method Payment method.
	 * @param object|null $json   JSON object.
	 * @return PaymentDetails|null
	 */
	public static function from_json( $method, $json ) {
		if ( null === $json ) {
			return null;
		}

		$details = new PaymentDetails();

		$data = (array) $json;

		foreach ( $data as $key => $value ) {
			$details->{$key} = $value;
		}

		return $details;
	}
}
