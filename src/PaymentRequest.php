<?php
/**
 * Mollie payment request.
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2025 Pronamic
 * @license   GPL-3.0-or-later
 * @package   Pronamic\WordPress\Mollie
 */

namespace Pronamic\WordPress\Mollie;

use DateTimeInterface;
use JsonSerializable;

/**
 * Payment request class
 */
class PaymentRequest implements JsonSerializable, RemoteSerializable {
	/**
	 * The description of the payment you're creating. This will be shown to the consumer on their
	 * card or bank statement when possible.
	 *
	 * @link https://www.mollie.com/nl/docs/reference/payments/create
	 * @var string
	 */
	#[RemoteApiProperty( 'description' )]
	public string $description;

	/**
	 * The amount in EURO that you want to charge, e.g. `{"currency":"EUR", "value":"100.00"}`
	 * if you would want to charge € 100,00.
	 *
	 * @link https://www.mollie.com/nl/docs/reference/payments/create
	 * @var Amount
	 */
	#[RemoteApiProperty( 'amount' )]
	public Amount $amount;

	/**
	 * The URL the consumer will be redirected to after the payment process. It could make sense
	 * for the redirectURL to contain a unique identifier – like your order ID – so you can show
	 * the right page referencing the order when the consumer returns.
	 *
	 * The parameter can be omitted for recurring payments (sequenceType: `recurring`)
	 * and for Apple Pay payments with an `applePayPaymentToken`.
	 *
	 * @link https://www.mollie.com/nl/docs/reference/payments/create
	 * @var string|null
	 */
	#[RemoteApiProperty( 'redirectUrl' )]
	public ?string $redirect_url = null;

	/**
	 * The URL your customer will be redirected to when the customer explicitly cancels the payment. If this URL is not provided, the customer will be redirected to the redirectUrl instead — see above.
	 *
	 * Mollie will always give you status updates via webhooks, including for the canceled status. This parameter is therefore entirely optional, but can be useful when implementing a dedicated customer-facing flow to handle payment cancellations.
	 *
	 * @link https://docs.mollie.com/reference/create-payment
	 * @var string|null
	 */
	#[RemoteApiProperty( 'cancelUrl' )]
	public ?string $cancel_url = null;

	/**
	 * Use this parameter to set a webhook URL for this payment only. Mollie will ignore any webhook
	 * set in your website profile for this payment.
	 *
	 * @link https://www.mollie.com/nl/docs/reference/payments/create
	 * @var string|null
	 */
	#[RemoteApiProperty( 'webhookUrl' )]
	public ?string $webhook_url = null;

	/**
	 * Optionally provide the order lines for the payment. Each line contains details such as a description of the item ordered and its price.
	 *
	 * All lines must have the same currency as the payment.
	 *
	 * Required for payment methods `billie`, `in3`, `klarna`, `riverty` and `voucher`.
	 *
	 * @var Lines|null
	 */
	#[RemoteApiProperty( 'lines' )]
	public ?Lines $lines = null;

	/**
	 * The customer's billing address details. We advise to provide these details to improve fraud protection and conversion.
	 *
	 * Should include `email` or a valid postal address consisting of `streetAndNumber`, `postalCode`, `city` and `country`.
	 *
	 * Required for payment method `in3`, `klarna`, `billie` and `riverty`.
	 *
	 * @var Address|null
	 */
	#[RemoteApiProperty( 'billingAddress' )]
	public ?Address $billing_address = null;

	/**
	 * The customer's shipping address details. We advise to provide these details to improve fraud protection and conversion.
	 *
	 * Should include `email` or a valid postal address consisting of `streetAndNumber`, `postalCode`, `city` and `country`.
	 *
	 * @var Address|null
	 */
	#[RemoteApiProperty( 'shippingAddress' )]
	public ?Address $shipping_address = null;

	/**
	 * Allows you to preset the language to be used in the hosted payment pages shown to the customer. Setting a locale is highly recommended and will greatly improve your conversion rate. When this parameter is omitted the browser language will be used instead if supported by the payment method. You can provide any xx_XX format ISO 15897 locale, but our hosted payment pages currently only support the specified languages.
	 *
	 * For bank transfer payments specifically, the locale will determine the target bank account the customer has to transfer the money to. We have dedicated bank accounts for Belgium, Germany, and The Netherlands. Having the customer use a local bank account greatly increases the conversion and speed of payment.
	 *
	 * @link https://www.mollie.com/nl/docs/reference/payments/create
	 * @var string|null
	 */
	#[RemoteApiProperty( 'locale' )]
	public ?string $locale = null;

	/**
	 * Normally, a payment method selection screen is shown. However, when using this parameter,
	 * your customer will skip the selection screen and will be sent directly to the chosen payment
	 * method. The parameter enables you to fully integrate the payment method selection into your
	 * website, however note Mollie's country based conversion optimization is lost.
	 *
	 * @link https://www.mollie.com/nl/docs/reference/payments/create
	 * @var string|null
	 */
	#[RemoteApiProperty( 'method' )]
	public ?string $method = null;

	/**
	 * An iDEAL issuer ID, for example ideal_INGNL2A. The returned payment URL will deep-link into
	 * the specific banking website (ING Bank, in this example). For a list of issuers, refer to the
	 * Issuers API.
	 *
	 * @link https://www.mollie.com/nl/docs/reference/payments/create
	 * @var string|null
	 */
	#[RemoteApiProperty( 'issuer' )]
	public ?string $issuer = null;

	/**
	 * Provide any data you like in JSON notation, and we will save the data alongside the payment.
	 * Whenever you fetch the payment with our API, we'll also include the metadata. You can use up
	 * to 1kB of JSON.
	 *
	 * @link https://www.mollie.com/nl/docs/reference/payments/create
	 * @link https://en.wikipedia.org/wiki/Metadata
	 * @var mixed|null
	 */
	#[RemoteApiProperty( 'metadata' )]
	public $metadata = null;

	/**
	 * The date the payment should expire, in YYYY-MM-DD format. Please note: the minimum date
	 * is tomorrow and the maximum date is 100 days after tomorrow.
	 *
	 * @link https://docs.mollie.com/reference/v2/payments-api/create-payment
	 * @var DateTimeInterface|null
	 */
	#[RemoteApiProperty( 'dueDate' )]
	public ?DateTimeInterface $due_date = null;

	/**
	 * Customer ID for Mollie checkout.
	 *
	 * @link https://www.mollie.com/nl/docs/checkout
	 * @var string|null
	 */
	#[RemoteApiProperty( 'customerId' )]
	public ?string $customer_id = null;

	/**
	 * Sequence type for Mollie Recurring.
	 *
	 * @link https://docs.mollie.com/payments/recurring#:~:text=sequenceType
	 * @link https://docs.mollie.com/reference/v2/payments-api/create-payment#:~:text=sequenceType
	 * @since 1.1.9
	 * @var string|null
	 */
	#[RemoteApiProperty( 'sequenceType' )]
	public ?string $sequence_type = null;

	/**
	 * Mandate ID.
	 *
	 * When creating recurring payments, the ID of a specific Mandate may be
	 * supplied to indicate which of the consumer’s accounts should be
	 * credited.
	 *
	 * @link https://docs.mollie.com/reference/v2/payments-api/create-payment#:~:text=mandateId
	 * @link https://docs.mollie.com/reference/v2/payments-api/get-payment#:~:text=mandateId
	 * @var string|null
	 */
	#[RemoteApiProperty( 'mandateId' )]
	public $mandate_id;

	/**
	 * Card token for Credit Card.
	 *
	 * The card token from Mollie Components. The token contains the card information (such as
	 * card holder, card number, and expiry date) needed to complete the payment.
	 *
	 * @var string|null
	 */
	#[RemoteApiProperty( 'cardToken' )]
	public ?string $card_token = null;

	/**
	 * Consumer name for SEPA Direct Debit.
	 *
	 * Beneficiary name of the account holder. Only available if one-off payments are enabled
	 * on your account. Will pre-fill the beneficiary name in the checkout screen if present.
	 *
	 * @var string|null
	 */
	#[RemoteApiProperty( 'consumerName' )]
	public $consumer_name;

	/**
	 * Consumer account for SEPA Direct Debit.
	 *
	 * IBAN of the account holder. Only available if one-off payments are enabled on your account.
	 * Will pre-fill the IBAN in the checkout screen if present.
	 *
	 * @var string|null
	 */
	#[RemoteApiProperty( 'consumerAccount' )]
	public $consumer_account;

	/**
	 * Create Mollie payment request object.
	 *
	 * @param Amount $amount      The amount that you want to charge.
	 * @param string $description The description of the payment you’re creating.
	 */
	public function __construct( $amount, $description ) {
		$this->amount      = $amount;
		$this->description = $description;
	}

	/**
	 * Remote serialize.
	 *
	 * @return object
	 */
	public function remote_serialize(): object {
		return ( new RemoteSerializer() )->serialize( $this );
	}

	/**
	 * JSON serialize.
	 *
	 * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
	 * @return object
	 */
	public function jsonSerialize(): object {
		return $this->remote_serialize();
	}
}
