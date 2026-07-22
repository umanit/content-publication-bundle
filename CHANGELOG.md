# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [2.0.0] - 2026-07-22

### Added

- Add return types void to load(), prepend(), setConfigAsParameters()
- Add return types and fix $disabledFirewalls type hint in
  PublishFilterSubscriber

### Removed

- Remove docblock ORM/Assert annotations from PublishableTrait, add
  missing PHP attribute Assert constraints (#[Assert\NotBlank],
  #[Assert\Expression]) now that docblocks are ignored in ORM 3.x

### Fixed

- Fix PublishFilter::addFilterConstraint(): handle both ORM 2 (array)
  and ORM 3 (object) fieldMappings format for columnName access

### Changed

- Bump php constraint to ^8.2
- Widen symfony/framework-bundle to ^5.4|^6.0|^7.0
- Widen doctrine/doctrine-bundle to ^2.7|^3.0
- Widen doctrine/orm to ^2.13|^3.0
- Replace deprecated psr-0 autoload with psr-4, remove target-dir

## [1.0.3] - 2024-04-04

### Fixed

- Defines the current date as a dynamic parameter in the `PublishFilter` to allow for filter cacheability

## [1.0.2] - 2023-04-13

### Removed

- Removes DateTime assertion from `PublishableTrait` as strong typecasting made it redundant

## [1.0.1] - 2023-02-02

### Removed

- Asserts as attributes are removed from the trait, to avoid double declaration and still
  provide PHP 7.4 support

## [1.0.0] - 2023-01-18

### Added

- Adds initial CHANGELOG
- Adds support for PHP >= 7.4
- Adds support for Symfony >= 5.4
- Adds typing
- Adds attributes alongside existing annotations

### Removed

- Removes support for PHP < 7.4
- Removes support for Symfony < 5.4

## [0.2.0] - 2020-09-07

Last release of v0.

[Unreleased]: https://github.com/umanit/content-publication-bundle/compare/2.0.0...HEAD

[2.0.0]: https://github.com/umanit/content-publication-bundle/compare/1.0.3...2.0.0

[1.0.3]: https://github.com/umanit/content-publication-bundle/compare/1.0.2...1.0.3

[1.0.2]: https://github.com/umanit/content-publication-bundle/compare/1.0.1...1.0.2

[1.0.1]: https://github.com/umanit/content-publication-bundle/compare/1.0.0...1.0.1

[1.0.0]: https://github.com/umanit/content-publication-bundle/compare/0.2...1.0.0

[0.2.0]: https://github.com/umanit/content-publication-bundle/releases/tag/0.2
