<?php
/**
 * Rector config.
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2025 Pronamic
 * @license   GPL-3.0-or-later
 * @package   Pronamic\WordPress\Mollie
 */

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Php80\Rector\Class_\ClassPropertyAssignToConstructorPromotionRector;
use Rector\Php81\Rector\Property\ReadOnlyPropertyRector;

return RectorConfig::configure()
	->withPaths(
		[
			__DIR__ . '/src',
			__DIR__ . '/tests',
		]
	)
	->withSkip(
		[
			ClassPropertyAssignToConstructorPromotionRector::class,
			ReadOnlyPropertyRector::class,
		]
	)
	->withPhpSets()
	->withTypeCoverageLevel( 0 );
