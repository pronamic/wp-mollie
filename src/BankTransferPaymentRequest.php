<?php
/**
 * Mollie bank transfer payment request.
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2025 Pronamic
 * @license   GPL-3.0-or-later
 * @package   Pronamic\WordPress\Mollie
 */

namespace Pronamic\WordPress\Mollie;

use DateTimeInterface;

/**
 * Bank transfer payment request class
 */
class BankTransferPaymentRequest extends PaymentRequest {
	/**
	 * The date the payment should expire, in YYYY-MM-DD format. Please note: the minimum date
	 * is tomorrow and the maximum date is 100 days after tomorrow.
	 *
	 * @link https://docs.mollie.com/reference/v2/payments-api/create-payment
	 * @var DateTimeInterface|null
	 */
	#[RemoteApiProperty( 'dueDate' )]
	public ?DateTimeInterface $due_date = null;
}
