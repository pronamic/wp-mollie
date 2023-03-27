<?php
/**
 * Mollie client test
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2023 Pronamic
 * @license   GPL-3.0-or-later
 * @package   Pronamic\WordPress\Mollie
 */

namespace Pronamic\WordPress\Mollie;

use Exception;
use Yoast\PHPUnitPolyfills\TestCases\TestCase;

/**
 * Mollie client test class
 */
class ClientTest extends TestCase {
	/**
	 * Test user agent.
	 */
	public function test_user_agent() {
		$client = new Client( 'test_1234' );

		$user_agent = $client->get_user_agent();

		$this->assertStringMatchesFormat( 'PronamicMollie/%s uap/FyuVeDDqnKdzdry7 WordPress/%s', $user_agent );
	}
}
