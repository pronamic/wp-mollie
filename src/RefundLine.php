<?php
/**
 * Refund Line
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2023 Pronamic
 * @license   GPL-3.0-or-later
 * @package   Pronamic\WordPress\Mollie
 */

namespace Pronamic\WordPress\Mollie;

use JsonSchema\Constraints\Constraint;
use JsonSchema\Exception\InvalidArgumentException;
use JsonSchema\Validator;
use JsonSerializable;
use stdClass;

/**
 * Refund line class
 */
class RefundLine implements JsonSerializable {
	/**
	 * The order line's unique identifier.
	 *
	 * @var string
	 */
	private string $id;

	/**
	 * Quantity.
	 *
	 * @var int
	 */
	private int $quantity;

	/**
	 * The amount that you want to refund. In almost all cases, Mollie can determine the amount automatically. The
	 * amount is required only if you are partially refunding an order line which has a non-zero discount amount.
	 *
	 * @var Amount
	 */
	private Amount $amount;

	/**
	 * Refund line constructor.
	 *
	 * @param string $id Order line identifier.
	 */
	public function __construct( string $id ) {
		$this->id       = $id;
		$this->quantity = 0;
		$this->amount   = new Amount( 'EUR', 0 );
	}

	/**
	 * Get identifier.
	 *
	 * @return string
	 */
	public function get_id(): string {
		return $this->id;
	}

	/**
	 * Set identifier.
	 *
	 * @param string $id Identifier.
	 */
	public function set_id( string $id ): void {
		$this->id = $id;
	}

	/**
	 * Get quantity.
	 *
	 * @return int
	 */
	public function get_quantity(): int {
		return $this->quantity;
	}

	/**
	 * Set quantity.
	 *
	 * @param int $quantity Quantity to refund.
	 */
	public function set_quantity( int $quantity ): void {
		$this->quantity = $quantity;
	}

	/**
	 * Get amount.
	 *
	 * @return Amount
	 */
	public function get_amount(): Amount {
		return $this->amount;
	}

	/**
	 * Set amount.
	 *
	 * @param Amount $amount Amount to refund.
	 */
	public function set_amount( Amount $amount ): void {
		$this->amount = $amount;
	}

	/**
	 * Create refund line from object.
	 *
	 * @param stdClass $object Object.
	 * @return RefundLine
	 */
	public static function from_object( stdClass $object ) {
		$object_access = new ObjectAccess( $object );

		$line = new self(
			$object_access->get_property( 'id' )
		);

		$line->set_quantity( $object_access->get_property( 'quantity' ) );
		$line->set_amount( $object_access->get_property( 'amount' ) );

		return $line;
	}

	/**
	 * Create amount from JSON string.
	 *
	 * @param object $json JSON object.
	 * @return RefundLine
	 * @throws InvalidArgumentException Throws invalid argument exception when input JSON is not an object.
	 */
	public static function from_json( $json ) {
		if ( ! is_object( $json ) ) {
			throw new InvalidArgumentException( 'JSON value must be an object.' );
		}

		$validator = new Validator();

		$validator->validate(
			$json,
			(object) [
				'$ref' => 'file://' . realpath( __DIR__ . '/../json-schemas/refund-line.json' ),
			],
			Constraint::CHECK_MODE_EXCEPTIONS
		);

		return self::from_object( $json );
	}

	/**
	 * JSON serialize.
	 *
	 * @return object
	 */
	public function jsonSerialize(): object {
		$object_builder = new ObjectBuilder();

		$object_builder->set_required( 'id', $this->id );
		$object_builder->set_optional( 'quantity', $this->quantity );
		$object_builder->set_optional( 'amount', $this->amount->jsonSerialize() );

		return $object_builder->jsonSerialize();
	}
}
