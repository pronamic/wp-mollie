<?php
/**
 * Mollie methods.
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2023 Pronamic
 * @license   GPL-3.0-or-later
 * @package   Pronamic\WordPress\Mollie
 */

namespace Pronamic\WordPress\Mollie;

/**
 * Methods class
 */
class Methods {
	/**
	 * Constant for the Apple Pay method.
	 *
	 * @var string
	 */
	const APPLE_PAY = 'applepay';

	/**
	 * Constant for the Bancontact method.
	 *
	 * @var string
	 */
	const BANCONTACT = 'bancontact';

	/**
	 * Constant for the iDEAL method.
	 *
	 * @var string
	 */
	const IDEAL = 'ideal';

	/**
	 * Constant for the Credit Card method.
	 *
	 * @var string
	 */
	const CREDITCARD = 'creditcard';

	/**
	 * Constant for the Direct Debit method.
	 *
	 * @var string
	 */
	const DIRECT_DEBIT = 'directdebit';

	/**
	 * Constant for the Sofort method.
	 *
	 * @var string
	 */
	const SOFORT = 'sofort';

	/**
	 * Constant for the Bank transfer method.
	 *
	 * @var string
	 */
	const BANKTRANSFER = 'banktransfer';

	/**
	 * Constant for the EPS method.
	 *
	 * @var string
	 */
	const EPS = 'eps';

	/**
	 * Constant for the Giropay method.
	 *
	 * @var string
	 */
	const GIROPAY = 'giropay';

	/**
	 * Constant for the Klarna - Pay Later method.
	 *
	 * @var string
	 */
	const KLARNA_PAY_LATER = 'klarnapaylater';

	/**
	 * Constant for the Klarna - Pay Now method.
	 *
	 * @var string
	 */
	const KLARNA_PAY_NOW = 'klarnapaynow';

	/**
	 * Constant for the Klarna - Slice It method.
	 *
	 * @var string
	 */
	const KLARNA_SLICE_IT = 'klarnasliceit';

	/**
	 * Constant for the PayPal method.
	 *
	 * @var string
	 */
	const PAYPAL = 'paypal';

	/**
	 * Constant for the Paysafecard method.
	 *
	 * @var string
	 */
	const PAYSAFECARD = 'paysafecard';

	/**
	 * Constant for the Gift cards method.
	 *
	 * @link https://www.mollie.com/en/giftcards
	 * @since 1.1.10
	 * @var string
	 */
	const PODIUMCADEAUKAART = 'podiumcadeaukaart';

	/**
	 * Constant for the Przelewy24 method.
	 *
	 * @var string
	 */
	const PRZELEWY24 = 'przelewy24';

	/**
	 * Constant for the KBC/CBC Payment Button method.
	 *
	 * @link https://www.mollie.com/en/kbccbc
	 * @since 1.1.10
	 * @var string
	 */
	const KBC = 'kbc';

	/**
	 * Constant for the Belfius Direct Net method.
	 *
	 * @link https://www.mollie.com/en/belfiusdirectnet
	 * @since 1.1.10
	 * @var string
	 */
	const BELFIUS = 'belfius';

	/**
	 * Constant for the in3 method.
	 *
	 * @link https://www.mollie.com/payments/in3
	 * @var string
	 */
	const IN3 = 'in3';
}
