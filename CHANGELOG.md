# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

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

[Unreleased]: https://github.com/umanit/content-publication-bundle/compare/1.0.2...HEAD

[1.0.2]: https://github.com/umanit/content-publication-bundle/compare/1.0.1...1.0.2

[1.0.1]: https://github.com/umanit/content-publication-bundle/compare/1.0.0...1.0.1

[1.0.0]: https://github.com/umanit/content-publication-bundle/compare/0.2...1.0.0

[0.2.0]: https://github.com/umanit/content-publication-bundle/releases/tag/0.2
