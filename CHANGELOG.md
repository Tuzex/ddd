# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [0.8.1] - 2022-06-20

### Added

- Create `FixedUniversalIds` class

### Changed

- **[BC BREAK]** Move the abstract class `Id` to the root domain directory
- **[BC BREAK]** Rename the `Identifier` directory to the `Id`
- **[BC BREAK]** Use `Instant` instead of `DateTime` in the `PresetClock`

## [0.8.0] - 2022-05-07

### Added

- Add `DateTime` static factory to `Instant`
- Add `Symfony UID` library to dependencies
- Implement `UniversalIds`  via the `Symfony UID`
- Add `Doctrine ORM` as dependency
- Model abstract `Doctrine ORM` repository for aggregates
- Add extension methods to `Doctrine` types
- Add the `UniversalId` doctrine type
- Define the `UniversalIds` interface

### Changed

- **[BC BREAK]** Fix `Doctrine` type paths
- **[BC BREAK]** Add a name prefix of existing `Doctrine` types
- **[BC BREAK]** Change `Identifiers` method name
- **[BC BREAK]** Rename `Time` methods in `TimeAware` traits
- Change `UniversalId` value property visibility
- Use `ATOM` pattern to format the `DateTime`
- Add messages to `UniversalId` constructor asserts

## [0.7.3] - 2022-03-04

### Added

- Implement a specific IDs

### Changed

- Rework the Identifier factory

## [0.7.2] - 2022-03-03

### Added

- Implement an abstract ID
- Define the interface for the identifier factory
- Add the ability to compare identifiers

## [0.7.1] - 2022-02-20

### Removed

- Remove `id` getter from `AggregateRoot` interface
- Remove `issuedOn` getter from `DomainCommand` interface
- Remove `occurredOn` getter from `DomainEvent` interface

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

[Unreleased]: https://github.com/Tuzex/ddd/compare/v0.8.1...HEAD
[0.8.1]: https://github.com/Tuzex/ddd/releases/tag/v0.8.1
[0.8.0]: https://github.com/Tuzex/ddd/releases/tag/v0.8.0
[0.7.4]: https://github.com/Tuzex/ddd/releases/tag/v0.7.4
[0.7.3]: https://github.com/Tuzex/ddd/releases/tag/v0.7.3
[0.7.2]: https://github.com/Tuzex/ddd/releases/tag/v0.7.2
[0.7.1]: https://github.com/Tuzex/ddd/releases/tag/v0.7.1
[0.7.0]: https://github.com/Tuzex/ddd/releases/tag/v0.7.0
[0.6.0]: https://github.com/Tuzex/ddd/releases/tag/v0.6.0
[0.5.0]: https://github.com/Tuzex/ddd/releases/tag/v0.5.0
[0.4.0]: https://github.com/Tuzex/ddd/releases/tag/v0.4.0
[0.3.1]: https://github.com/Tuzex/ddd/releases/tag/v0.3.1
[0.3.0]: https://github.com/Tuzex/ddd/releases/tag/v0.3.0
[0.2.0]: https://github.com/Tuzex/ddd/releases/tag/v0.2.0
[0.1.0]: https://github.com/Tuzex/ddd/releases/tag/v0.1.0
