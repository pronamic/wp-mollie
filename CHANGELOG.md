# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [1.2.0] - 2023-03-29
### Changed

- Extended support for refunds.

### Commits

- Set Composer type to WordPress plugin. ([f5ea1bb](https://github.com/pronamic/wp-mollie/commit/f5ea1bbf107755cb1108a9c80d0db7d4d3975349))
- Introduce a `Client->get_payment_reunfds( $payment_id, $parameters )` method. ([88028f6](https://github.com/pronamic/wp-mollie/commit/88028f6090eeb7bf3517a1d7ac52a0048051ce87))
- Don't set type of `metadata` in JSON schema, since it's documented as `mixed`. ([34f1e4f](https://github.com/pronamic/wp-mollie/commit/34f1e4f0d2136f256a0914100ed349753f546c21))
- Added function `Payment->has_refunds()`. ([36b3062](https://github.com/pronamic/wp-mollie/commit/36b3062316c92883d825c629a23afb8e14f6e768))
- Added in3 method constant. ([7966503](https://github.com/pronamic/wp-mollie/commit/796650392facd072663b3cb51ca79dbb7212ebfc))
- Added support for order payment line ID. ([8a3dc0e](https://github.com/pronamic/wp-mollie/commit/8a3dc0e1ab305a799005640d6c5680051b503bb4))
- Added support for `en_GB` locale. ([a735ca4](https://github.com/pronamic/wp-mollie/commit/a735ca471a77834352976284ee8af0f7e6dc1866))

Full set of changes: [`1.1.1...1.2.0`][1.2.0]

[1.2.0]: https://github.com/pronamic/wp-mollie/compare/v1.1.1...v1.2.0

## [1.1.1] - 2023-01-31
### Composer

- Changed `php` from `>=8.0` to `>=7.4`.
Full set of changes: [`1.1.0...1.1.1`][1.1.1]

[1.1.1]: https://github.com/pronamic/wp-mollie/compare/v1.1.0...v1.1.1

## [1.1.0] - 2022-12-22

### Commits

- PHP 8.0 ([ecb8bd1](https://github.com/pronamic/wp-mollie/commit/ecb8bd1e3ae1b04bc848dd741c3547d0192eb57b))
- Coding standards. ([c1f7694](https://github.com/pronamic/wp-mollie/commit/c1f76943b0c46256b12164a8940b872a2ddf8348))

### Composer

- Changed `php` from `>=7.4` to `>=8.0`.
Full set of changes: [`1.0.0...1.1.0`][1.1.0]

[1.1.0]: https://github.com/pronamic/wp-mollie/compare/v1.0.0...v1.1.0

## [1.0.0] - 2022-11-28

### Added

- Initial release, based on https://github.com/pronamic/wp-pronamic-pay-mollie/tree/4.5.0.

[unreleased]: https://github.com/pronamic/wp-mollie/compare/v1.1.0...HEAD
[1.0.0]: https://github.com/pronamic/wp-mollie/releases/tag/v0.0.1
