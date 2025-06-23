<?php
/**
 * Mollie amount transformer test.
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2025 Pronamic
 * @license   GPL-3.0-or-later
 * @package   Pronamic\WordPress\Pay
 */

namespace Pronamic\WordPress\Mollie;

use Pronamic\WordPress\Money\Money;
use Yoast\PHPUnitPolyfills\TestCases\TestCase;

/**
 * Title: Mollie amount transformer tests
 * Description:
 * Copyright: 2005-2025 Pronamic
 * Company: Pronamic
 *
 * @author  Reüel van der Steege
 * @version 2.1.0
 * @since   2.1.0
 */
class AmountTransformerTest extends TestCase {
	/**
	 * Test transform.
	 *
	 * @param Money  $pronamic_money    Pronamic money.
	 * @param string $expected_currency Expected currency.
	 * @param string $expected_value    Expected value.
	 * @dataProvider amount_provider
	 */
	public function test_transform( $pronamic_money, $expected_currency, $expected_value ) {
		$amount_transformer = new AmountTransformer();

		$mollie_amount = $amount_transformer->transform_wp_to_mollie( $pronamic_money );

		$this->assertEquals( $expected_currency, $mollie_amount->get_currency() );
		$this->assertEquals( $expected_value, $mollie_amount->get_value() );
	}

	/**
	 * Amount data provider.
	 *
	 * @return array
	 */
	public function amount_provider() {
		return [
			[ new Money( 100, 'EUR' ), 'EUR', '100.00' ],
			[ new Money( 5, 'BHD' ), 'BHD', '5.000' ],
		];
	}
}
