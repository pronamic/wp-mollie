<?php
/**
 * Mollie sequence.
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2025 Pronamic
 * @license   GPL-3.0-or-later
 * @package   Pronamic\WordPress\Mollie
 */

namespace Pronamic\WordPress\Mollie;

/**
 * Sequence class
 */
class Sequence {
	/**
	 * Constant for one-off payment.
	 *
	 * @var string
	 */
	const ONE_OFF = 'oneoff';

	/**
	 * Constant for the first payment.
	 *
	 * @var string
	 */
	const FIRST = 'first';

	/**
	 * Constant for recurring payments.
	 *
	 * @var string
	 */
	const RECURRING = 'recurring';

	/**
	 * Constant for subscription payments.
	 *
	 * @var string
	 */
	const SUBSCRIPTION = 'subscription';
}
