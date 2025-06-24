<?php
/**
 * Remote serializer
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2025 Pronamic
 * @license   GPL-3.0-or-later
 * @package   Pronamic\WordPress\Mollie
 */

namespace Pronamic\WordPress\Mollie;

use DateTimeInterface;
use ReflectionObject;

/**
 * Remote serializer class
 */
final class RemoteSerializer {
	/**
	 * Serialize.
	 *
	 * @param object $item Item.
	 * @return object
	 */
	public function serialize( $item ) {
		$data = [];

		$reflection_object = new ReflectionObject( $item );

		$properties = $reflection_object->getProperties();

		foreach ( $properties as $property ) {
			$value = $property->getValue( $item );

			if ( null === $value ) {
				continue;
			}

			$attributes = $property->getAttributes( RemoteApiProperty::class );

			foreach ( $attributes as $attribute ) {
				$remote_api_property = $attribute->newInstance();

				$data[ $remote_api_property->name ] = $this->get_value( $value );
			}
		}

		return (object) $data;
	}

	/**
	 * Get value.
	 *
	 * @param mixed $value Value.
	 * @return mixed
	 */
	private function get_value( mixed $value ) {
		if ( $value instanceof RemoteSerializable ) {
			return $value->remote_serialize();
		}

		if ( $value instanceof DateTimeInterface ) {
			return $value->format( 'Y-m-d' );
		}

		if ( \is_array( $value ) ) {
			return \array_map( $this->get_value( ... ), $value );
		}

		return $value;
	}
}
