<?php
/**
 * Lines
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2025 Pronamic
 * @license   GPL-3.0-or-later
 * @package   Pronamic\WordPress\Mollie
 */

namespace Pronamic\WordPress\Mollie;

use JsonSerializable;

/**
 * Lines class
 */
class Lines implements JsonSerializable {
	/**
	 * The lines.
	 *
	 * @var Line[]
	 */
	private array $lines = [];

	/**
	 * New line.
	 *
	 * @param string $description  A description of the line item.
	 * @param int    $quantity     Quantity.
	 * @param Amount $unit_price   Unit price.
	 * @param Amount $total_amount Total amount, including VAT and  discounts.
	 */
	public function new_line( string $description, int $quantity, Amount $unit_price, Amount $total_amount ): Line {
		$line = new Line(
			$description,
			$quantity,
			$unit_price,
			$total_amount
		);

		$this->lines[] = $line;

		return $line;
	}

	/**
	 * JSON serialize.
	 *
	 * @return object[]
	 */
	public function jsonSerialize(): array {
		$objects = array_map(
			/**
			 * Get JSON for payment line.
			 *
			 * @param Line $line Payment line.
			 * @return object
			 */
			fn( Line $line ) => $line->jsonSerialize(),
			$this->lines
		);

		return $objects;
	}
}
