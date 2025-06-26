<?php
/**
 * Address
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2025 Pronamic
 * @license   GPL-3.0-or-later
 * @package   Pronamic\WordPress\Mollie
 */

namespace Pronamic\WordPress\Mollie;

use JsonSerializable;

/**
 * Address class
 *
 * @link https://docs.mollie.com/reference/v2/orders-api/create-order
 * @link https://docs.mollie.com/overview/common-data-types#address-object
 */
class Address implements JsonSerializable, RemoteSerializable {
	/**
	 * The title of the person, for example Mr. or Mrs.
	 *
	 * @var string|null
	 */
	#[RemoteApiProperty( 'title' )]
	public ?string $title = null;

	/**
	 * The given name (first name) of the person should be at least two characters and cannot contain only numbers.
	 *
	 * Required for payment methods `billie`, `in3`, `klarna` and `riverty`.
	 *
	 * @var string
	 */
	#[RemoteApiProperty( 'givenName' )]
	public ?string $given_name = null;

	/**
	 * The given family name (surname) of the person should be at least two characters and cannot contain only numbers.
	 *
	 * Required for payment methods `billie`, `in3`, `klarna` and `riverty`.
	 *
	 * @var string
	 */
	#[RemoteApiProperty( 'familyName' )]
	public ?string $family_name = null;

	/**
	 * The name of the organization, in case the addressee is an organization.
	 *
	 * @var string|null
	 */
	#[RemoteApiProperty( 'organizationName' )]
	public ?string $organization_name = null;

	/**
	 * A street and street number.
	 *
	 * Required for payment methods `billie`, `in3`, `klarna` and `riverty`.
	 *
	 * @var string|null
	 */
	#[RemoteApiProperty( 'streetAndNumber' )]
	public ?string $street_and_number = null;

	/**
	 * Any additional addressing details, for example an apartment number.
	 *
	 * @var string|null
	 */
	#[RemoteApiProperty( 'streetAdditional' )]
	public ?string $street_additional = null;

	/**
	 * A postal code. This field may be required if the provided country has a postal code system.
	 *
	 * Required for payment methods `billie`, `in3`, `klarna` and `riverty`.
	 *
	 * @var string|null
	 */
	#[RemoteApiProperty( 'postalCode' )]
	public ?string $postal_code = null;

	/**
	 * A valid e-mail address.
	 *
	 * If you provide the email address for a `banktransfer` payment, we will automatically send the instructions email upon payment creation. The language of the email will follow the locale parameter of the payment.
	 *
	 * Required for payment methods `billie`, `in3`, `klarna` and `riverty`.
	 *
	 * @var string|null
	 */
	#[RemoteApiProperty( 'email' )]
	public ?string $email = null;

	/**
	 * If provided, it must be in the E.164 format. For example: +31208202070.
	 *
	 * @link https://en.wikipedia.org/wiki/E.164
	 * @var string|null
	 */
	#[RemoteApiProperty( 'phone' )]
	public ?string $phone = null;

	/**
	 * A city name.
	 *
	 * Required for payment methods `billie`, `in3`, `klarna` and `riverty`.
	 *
	 * @var string|null
	 */
	#[RemoteApiProperty( 'city' )]
	public ?string $city = null;

	/**
	 * The top-level administrative subdivision of the country. For example: Noord-Holland.
	 *
	 * @var string|null
	 */
	#[RemoteApiProperty( 'region' )]
	public ?string $region = null;

	/**
	 * A country code in ISO 3166-1 alpha-2 format.
	 *
	 * Required for payment methods `billie`, `in3`, `klarna` and `riverty`.
	 *
	 * @link https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2
	 * @var string
	 */
	#[RemoteApiProperty( 'country' )]
	public ?string $country = null;

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
