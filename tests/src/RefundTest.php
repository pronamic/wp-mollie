<?php
/**
 * Mollie refund test
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2024 Pronamic
 * @license   GPL-3.0-or-later
 * @package   Pronamic\WordPress\Pay
 */

namespace Pronamic\WordPress\Mollie;

use Yoast\PHPUnitPolyfills\TestCases\TestCase;

/**
 * Mollie refund test class
 */
class RefundTest extends TestCase {
	/**
	 * Test JSON.
	 */
	public function test_json() {
		$json_file = __DIR__ . '/../json/refund.json';

		$json_data = json_decode( file_get_contents( $json_file, true ) );

		$refund = Refund::from_json( $json_data );

		$this->assertInstanceOf( Refund::class, $refund );
	}
}
