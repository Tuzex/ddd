# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [0.7.0] - 2022-02-19

### Added

- Add `IssueTimeAware` trait for a domain command
- Add `OccurrenceTimeAware` trait for a domain event

### Changed

- **[BC BREAK]** Rename the `DomainCommandAbility` trait to `DomainCommandIssue`

## [0.6.0] - 2022-02-19

### Changed

- **[BC BREAK]** Remove `instant()` method from the `DateTime` value object
- **[BC BREAK]** Place `Core` model to the root directory
- Change `instant` class property mutability in the `DateTime` value object
- Add `UTC` check to the `DateTime` value object

### Removed

- **[BC BREAK]** Remove obsolete `Application` services
- **[BC BREAK]** Remove obsolete `Domain` attribute
- **[BC BREAK]** Remove `DomainCommands` collection class
- **[BC BREAK]** Remove `DomainEvents` collection class
- **[BC BREAK]** Remove `Finance` domain model
- **[BC BREAK]** Remove `Measurement` domain model

## [0.5.0] - 2022-01-31

### Added

- Add a monetary unit model

### Changed

- **[BC BREAK]** Rename `Command` to `DomainCommand`
- **[BC BREAK]** Divide domain into bounded contexts
- **[BC BREAK]** Move `Identifier` to the root directory

### Removed

- **[BC BREAK]** Removed `Query`

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

[Unreleased]: https://github.com/Tuzex/ddd/compare/v0.7.0...HEAD
[0.7.0]: https://github.com/Tuzex/ddd/releases/tag/v0.7.0
[0.6.0]: https://github.com/Tuzex/ddd/releases/tag/v0.6.0
[0.5.0]: https://github.com/Tuzex/ddd/releases/tag/v0.5.0
[0.4.0]: https://github.com/Tuzex/ddd/releases/tag/v0.4.0
[0.3.1]: https://github.com/Tuzex/ddd/releases/tag/v0.3.1
[0.3.0]: https://github.com/Tuzex/ddd/releases/tag/v0.3.0
[0.2.0]: https://github.com/Tuzex/ddd/releases/tag/v0.2.0
[0.1.0]: https://github.com/Tuzex/ddd/releases/tag/v0.1.0
