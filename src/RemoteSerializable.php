<?php
/**
 * Remote serializable
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2025 Pronamic
 * @license   GPL-3.0-or-later
 * @package   Pronamic\WordPress\Mollie
 */

namespace Pronamic\WordPress\Mollie;

/**
 * Remote serializable class
 */
interface RemoteSerializable {
	/**
	 * Remote serialize.
	 *
	 * @return mixed
	 */
	public function remote_serialize();
}
