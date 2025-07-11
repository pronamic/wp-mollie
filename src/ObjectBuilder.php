<?php
/**
 * Object builder
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2025 Pronamic
 * @license   GPL-3.0-or-later
 * @package   Pronamic\WordPress\Mollie
 */

namespace Pronamic\WordPress\Mollie;

use JsonSerializable;

/**
 * Object builder class
 */
class ObjectBuilder implements JsonSerializable {
	/**
	 * Data.
	 *
	 * @var mixed[] Data.
	 */
	private $data = [];

	/**
	 * Set optional value.
	 *
	 * @param string $key   Key.
	 * @param mixed  $value Value.
	 * @return void
	 */
	public function set_optional( string $key, mixed $value ) {
		if ( null === $value ) {
			return;
		}

		$this->set_value( $key, $value );
	}

	/**
	 * Set required value.
	 *
	 * @param string $key   Key.
	 * @param mixed  $value Value.
	 * @return void
	 */
	public function set_required( string $key, mixed $value ) {
		$this->set_value( $key, $value );
	}

	/**
	 * Set value.
	 *
	 * @param string $key   Key.
	 * @param mixed  $value Value.
	 * @return void
	 */
	private function set_value( string $key, mixed $value ) {
		$this->data[ $key ] = $value;
	}

	/**
	 * JSON serialize.
	 *
	 * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
	 * @return object
	 */
	public function jsonSerialize(): object {
		return (object) $this->data;
	}
}
