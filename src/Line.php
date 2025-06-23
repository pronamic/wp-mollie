<?php
/**
 * Line
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2025 Pronamic
 * @license   GPL-3.0-or-later
 * @package   Pronamic\WordPress\Mollie
 */

namespace Pronamic\WordPress\Mollie;

use JsonSerializable;
use Pronamic\WordPress\Number\Number;

/**
 * Line class
 */
class Line implements JsonSerializable {
	/**
	 * The type of product purchased. For example, a physical or a digital product.
	 *
	 * The tip payment line type is not available when creating a payment.
	 *
	 * Possible values: `physical` `digital` `shipping_fee` `discount` `store_credit` `gift_card` `surcharge` `tip` (default: `physical`)
	 *
	 * @see LineType
	 * @var string|null
	 */
	#[RemoteApiProperty( 'type' )]
	public ?string $type = null;

	/**
	 * A description of the line item. For example LEGO 4440 Forest Police Station.
	 *
	 * @var string
	 */
	#[RemoteApiProperty( 'description' )]
	public string $description;

	/**
	 * The number of items.
	 *
	 * @var int
	 */
	#[RemoteApiProperty( 'quantity' )]
	public int $quantity;

	/**
	 * The unit for the quantity. For example pcs, kg, or cm.
	 *
	 * @var string|null
	 */
	#[RemoteApiProperty( 'quantityUnit' )]
	public ?string $quantity_unit = null;

	/**
	 * The price of a single item including VAT.
	 *
	 * For example: `{"currency":"EUR", "value":"89.00"}` if the box of LEGO costs €89.00 each.
	 *
	 * For types `discount`, `store_credit`, and `gift_card`, the unit price must be negative.
	 *
	 * The unit price can be zero in case of free items.
	 *
	 * @var Amount
	 */
	#[RemoteApiProperty( 'unitPrice' )]
	public Amount $unit_price;

	/**
	 * Any line-specific discounts, as a positive amount. Not relevant if the line itself is already a discount type.
	 *
	 * @var Amount|null
	 */
	#[RemoteApiProperty( 'discountAmount' )]
	private ?Amount $discount_amount = null;

	/**
	 * The total amount of the line, including VAT and discounts. Adding all `totalAmount`
	 * values together should result in the same amount as the amount top level property.
	 *
	 * The total amount should match the following formula: (unitPrice × quantity) - discountAmount
	 *
	 * @var Amount
	 */
	#[RemoteApiProperty( 'totalAmount' )]
	public Amount $total_amount;

	/**
	 * The VAT rate applied to the order line, for example "21.00" for 21%. The `vatRate` should
	 * be passed as a string and not as a float to ensure the correct number of decimals are passed.
	 *
	 * @var Number|null
	 */
	#[RemoteApiProperty( 'vatRate' )]
	public ?Number $vat_rate = null;

	/**
	 * The amount of value-added tax on the line. The `totalAmount` field includes VAT, so
	 * the `vatAmount` can be calculated with the formula `totalAmount × (vatRate / (100 + vatRate))`.
	 *
	 * @var Amount|null
	 */
	#[RemoteApiProperty( 'vatAmount' )]
	public ?Amount $vat_amount;

	/**
	 * The SKU, EAN, ISBN or UPC of the product sold.
	 *
	 * @var string|null
	 */
	#[RemoteApiProperty( 'sku' )]
	public ?string $sku = null;

	/**
	 * An array with the voucher categories, in case of a line eligible for a voucher. See the Integrating Vouchers guide for more information.
	 *
	 * @var string[]|null
	 */
	#[RemoteApiProperty( 'categories' )]
	public ?array $categories = null;

	/**
	 * A link pointing to an image of the product sold.
	 *
	 * @var string|null
	 */
	#[RemoteApiProperty( 'imageUrl' )]
	public ?string $image_url = null;

	/**
	 * A link pointing to the product page in your web shop of the product sold.
	 *
	 * @var string|null
	 */
	#[RemoteApiProperty( 'productUrl' )]
	public ?string $product_url = null;

	/**
	 * Line constructor.
	 *
	 * @param string $description  A description of the line item.
	 * @param int    $quantity     The number of items.
	 * @param Amount $unit_price   The price of a single item including VAT.
	 * @param Amount $total_amount The total amount of the line, including VAT and discounts.
	 */
	public function __construct( string $description, int $quantity, Amount $unit_price, Amount $total_amount ) {
		$this->description  = $description;
		$this->quantity     = $quantity;
		$this->unit_price   = $unit_price;
		$this->total_amount = $total_amount;
	}

	/**
	 * Create line from object.
	 *
	 * @param object $value Object.
	 * @return Line
	 */
	public static function from_object( object $value ) {
		$object_access = new ObjectAccess( $value );

		$line = new self(
			$object_access->get_property( 'name' ),
			$object_access->get_property( 'quantity' ),
			Amount::from_object( $object_access->get_property( 'unitPrice' ) ),
			Amount::from_object( $object_access->get_property( 'totalAmount' ) )
		);

		$line->sku = $object_access->get_property( 'sku' );

		return $line;
	}

	/**
	 * Create amount from JSON string.
	 *
	 * @param object $json JSON object.
	 * @return Line
	 * @throws \InvalidArgumentException Throws invalid argument exception when input JSON is not an object.
	 */
	public static function from_json( $json ) {
		if ( ! is_object( $json ) ) {
			throw new \InvalidArgumentException( 'JSON value must be an object.' );
		}

		return self::from_object( $json );
	}

	/**
	 * JSON serialize.
	 *
	 * @return object
	 */
	public function jsonSerialize(): object {
		$object_builder = new ObjectBuilder();

		$object_builder->set_optional( 'type', $this->type );

		$object_builder->set_required( 'description', $this->description );
		$object_builder->set_required( 'quantity', $this->quantity );
		$object_builder->set_required( 'unitPrice', $this->unit_price->jsonSerialize() );

		$object_builder->set_optional( 'discountAmount', null === $this->discount_amount ? null : $this->discount_amount->jsonSerialize() );
		$object_builder->set_optional( 'totalAmount', $this->total_amount->jsonSerialize() );
		$object_builder->set_optional( 'vatRate', $this->vat_rate->format( 2, '.', '' ) );
		$object_builder->set_optional( 'vatAmount', $this->vat_amount->jsonSerialize() );
		$object_builder->set_optional( 'sku', $this->sku );
		$object_builder->set_optional( 'imageUrl', $this->image_url );
		$object_builder->set_optional( 'productUrl', $this->product_url );

		return $object_builder->jsonSerialize();
	}
}
