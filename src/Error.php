<?php
/**
 * Mollie error.
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2025 Pronamic
 * @license   GPL-3.0-or-later
 * @package   Pronamic\WordPress\Mollie
 */

namespace Pronamic\WordPress\Mollie;

/**
 * Error class
 *
 * @link https://docs.mollie.com/guides/handling-errors
 */
class Error extends \Exception {
	/**
	 * Status.
	 *
	 * @var int
	 */
	private $status;

	/**
	 * Title.
	 *
	 * @var string
	 */
	private $title;

	/**
	 * Detail.
	 *
	 * @var string
	 */
	public $detail;

	/**
	 * Construct Mollie error.
	 *
	 * @param int    $status Status.
	 * @param string $title  Title.
	 * @param string $detail Detail.
	 */
	public function __construct( $status, $title, $detail ) {
		$message = sprintf(
			'%s - %s',
			$title,
			$detail
		);

		parent::__construct( $message, $status );

		$this->status = $status;
		$this->title  = $title;
		$this->detail = $detail;
	}

	/**
	 * Get status.
	 *
	 * @return int
	 */
	public function get_status() {
		return $this->status;
	}

	/**
	 * Get title.
	 *
	 * @return string
	 */
	public function get_title() {
		return $this->title;
	}

	/**
	 * Get title.
	 *
	 * @return string
	 */
	public function get_detail() {
		return $this->detail;
	}
}
