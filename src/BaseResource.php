<?php
/**
 * Base Resource
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2025 Pronamic
 * @license   GPL-3.0-or-later
 * @package   Pronamic\WordPress\Mollie
 */

namespace Pronamic\WordPress\Mollie;

/**
 * Base resource class
 *
 * @link https://github.com/mollie/mollie-api-php/blob/v2.25.0/src/Resources/BaseResource.php
 */
abstract class BaseResource {
	/**
	 * The resource unique identifier.
	 *
	 * @var string
	 */
	private $id;

	/**
	 * Construct base resource.
	 *
	 * @param string $id Identifier.
	 */
	public function __construct( $id ) {
		$this->id = $id;
	}

	/**
	 * Get identifier.
	 *
	 * @return string
	 */
	public function get_id() {
		return $this->id;
	}
}
