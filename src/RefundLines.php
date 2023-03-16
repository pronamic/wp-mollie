<?php
/**
 * Refund Lines
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2023 Pronamic
 * @license   GPL-3.0-or-later
 * @package   Pronamic\WordPress\Mollie
 */

namespace Pronamic\WordPress\Mollie;

use JsonSerializable;

/**
 * Refund Lines class
 */
class RefundLines implements JsonSerializable {
	/**
	 * The lines.
	 *
	 * @var RefundLine[]
	 */
	private array $lines = [];

	/**
	 * New line.
	 *
	 * @param string $id Order line identifier.
	 * @return RefundLine
	 */
	public function new_line( string $id ): RefundLine {
		$line = new RefundLine( $id );

		$this->lines[] = $line;

		return $line;
	}

	/**
	 * JSON serialize.
	 *
	 * @return array
	 */
	public function jsonSerialize(): array {
		$objects = array_map(
			/**
			 * Get JSON for order refund line.
			 *
			 * @param RefundLine $line Order refund line.
			 * @return object
			 */
			function( RefundLine $line ) {
				return $line->jsonSerialize();
			},
			$this->lines
		);

		return $objects;
	}
}
