<?php
/**
 * Mollie bank transfer payment request test.
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2025 Pronamic
 * @license   GPL-3.0-or-later
 * @package   Pronamic\WordPress\Pay
 */

namespace Pronamic\WordPress\Mollie;

use Yoast\PHPUnitPolyfills\TestCases\TestCase;

/**
 * Bank transfer payment request test
 */
class BankTransferPaymentRequestTest extends TestCase {
	/**
	 * Test due date.
	 *
	 * @throws \Exception Throws exception on date error.
	 */
	public function test_due_date() {
		$request = new BankTransferPaymentRequest(
			new Amount( 'EUR', '100.00' ),
			'Test'
		);

		$request->redirect_url = 'https://example.com/mollie-redirect/';
		$request->webhook_url  = 'https://example.com/mollie-webhook/';
		$request->method       = Methods::BANKTRANSFER;
		$request->locale       = Locales::NL_NL;

		$due_date = new \DateTime( '+12 days' );

		$request->due_date = $due_date;

		$this->assertEquals(
			[
				'amount'      => $request->amount->jsonSerialize(),
				'description' => 'Test',
				'redirectUrl' => 'https://example.com/mollie-redirect/',
				'webhookUrl'  => 'https://example.com/mollie-webhook/',
				'method'      => 'banktransfer',
				'locale'      => 'nl_NL',
				'dueDate'     => $due_date->format( 'Y-m-d' ),
			],
			(array) $request->jsonSerialize()
		);
	}
}
