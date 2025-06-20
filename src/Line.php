<?php
/**
 * Line
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2024 Pronamic
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
	 * The order line's unique identifier.
	 *
	 * @var string|null
	 */
	private ?string $id = null;

	/**
	 * The type of product bought, for example, a physical or a digital product.
	 *
	 * @see LineType
	 * @var string|null
	 */
	public ?string $type = null;


	/**
	 * Description.
	 *
	 * @var string
	 */
	private string $description;

	/**
	 * Quantity.
	 *
	 * @var int
	 */
	private int $quantity;

	/**
	 * The price of a single item including VAT in the order line.
	 *
	 * @var Amount
	 */
	private Amount $unit_price;

	/**
	 * Any discounts applied to the order line. For example, if you have a two-for-one sale,
	 * you should pass the amount discounted as a positive amount.
	 *
	 * @var Amount|null
	 */
	public ?Amount $discount_amount = null;

	/**
	 * The total amount of the line, including VAT and discounts. Adding all `totalAmount`
	 * values together should result in the same amount as the amount top level property.
	 *
	 * The total amount should match the following formula: (unitPrice × quantity) - discountAmount
	 *
	 * @var Amount
	 */
	public Amount $total_amount;

	/**
	 * The VAT rate applied to the order line, for example "21.00" for 21%. The `vatRate` should
	 * be passed as a string and not as a float to ensure the correct number of decimals are passed.
	 *
	 * @var Number|null
	 */
	public ?Number $vat_rate = null;

	/**
	 * The amount of value-added tax on the line. The `totalAmount` field includes VAT, so
	 * the `vatAmount` can be calculated with the formula `totalAmount × (vatRate / (100 + vatRate))`.
	 *
	 * @var Amount|null
	 */
	public ?Amount $vat_amount = null;

	/**
	 * SKU.
	 *
	 * @var string|null
	 */
	public ?string $sku = null;

	/**
	 * Image url.
	 *
	 * @var string|null
	 */
	public ?string $image_url = null;

	/**
	 * Product URL.
	 *
	 * @var string|null
	 */
	public ?string $product_url = null;

	/**
	 * Line constructor.
	 *
	 * @param string $description  Description of the order line.
	 * @param int    $quantity     Quantity.
	 * @param Amount $unit_price   Unit price.
	 * @param Amount $total_amount Total amount, including VAT and  discounts.
	 */
	public function __construct( string $description, int $quantity, Amount $unit_price, Amount $total_amount ) {
		$this->description  = $description;
		$this->quantity     = $quantity;
		$this->unit_price   = $unit_price;
		$this->total_amount = $total_amount;
	}

	/**
	 * Get identifier.
	 *
	 * @return string|null
	 */
	public function get_id(): ?string {
		return $this->id;
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
			$object_access->get_property( 'description' ),
			$object_access->get_property( 'quantity' ),
			Amount::from_object( $object_access->get_property( 'unitPrice' ) ),
			Amount::from_object( $object_access->get_property( 'totalAmount' ) ),
		);

		$line->id         = $object_access->get_property( 'id' );
		$line->sku        = $object_access->get_property( 'sku' );
		$line->vat_rate   = Number::from_string( $object_access->get_property( 'vatRate' ) );
		$line->vat_amount = Amount::from_object( $object_access->get_property( 'vatAmount' ) );

		return $line;
	}

	/**
	 * Create line from JSON string.
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

		$object_builder->set_required( 'description', $this->description );
		$object_builder->set_required( 'quantity', $this->quantity );
		$object_builder->set_required( 'unitPrice', $this->unit_price->jsonSerialize() );
		$object_builder->set_required( 'totalAmount', $this->total_amount->jsonSerialize() );

		$object_builder->set_optional( 'id', $this->id );
		$object_builder->set_optional( 'type', $this->type );
		$object_builder->set_optional( 'discountAmount', null === $this->discount_amount ? null : $this->discount_amount->jsonSerialize() );
		$object_builder->set_optional( 'vatRate', null === $this->vat_rate || $this->vat_rate->is_zero() ? null : $this->vat_rate->format( 2, '.', '' ) );
		$object_builder->set_optional( 'vatAmount', null === $this->vat_amount || $this->vat_amount->to_wp()->is_zero() ? null : $this->vat_amount->jsonSerialize() );
		$object_builder->set_optional( 'sku', $this->sku );
		$object_builder->set_optional( 'imageUrl', $this->image_url );
		$object_builder->set_optional( 'productUrl', $this->product_url );

		return $object_builder->jsonSerialize();
	}
}
