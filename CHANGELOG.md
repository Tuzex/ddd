# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Changed

- **[BC BREAK]** Move `Identifier` to the root directory
- Add a monetary unit model

## [0.4.0] - 2021-11-09

### Changed
- **[BC BREAK]** Remove `UniversalTime` namespace
- **[BC BREAK]** Add `occurredOn` date time to DomainEvent
- **[BC BREAK]** Add `issuedOn` date time to Command
- **[BC BREAK]** Place `Identifier` interface to the Shared namespace
- **[BC BREAK]** Use internal `DomainEvent` aggregate collector instead of static
- Define `AggregateRoot` and `ProcessManager` interfaces
- Create internal `Command` process manager collector

## [0.3.1] - 2021-05-14

### Changed
- Define application entrypoints (command / domain event / query)
- Prepare Query interface

## [0.3.0] - 2021-05-14

### Changed
- **[BC BREAK]** Remove `DomainEventBus` implementation based on [`symfony/messenger`](https://github.com/symfony/messenger)

[Unreleased]: https://github.com/Tuzex/ddd/compare/v0.4.0...HEAD
[0.4.0]: https://github.com/Tuzex/ddd/releases/tag/v0.4.0
[0.3.1]: https://github.com/Tuzex/ddd/releases/tag/v0.3.1
[0.3.0]: https://github.com/Tuzex/ddd/releases/tag/v0.3.0
[0.2.0]: https://github.com/Tuzex/ddd/releases/tag/v0.2.0
[0.1.0]: https://github.com/Tuzex/ddd/releases/tag/v0.1.0
