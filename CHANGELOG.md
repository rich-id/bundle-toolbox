# Changelog

## 1.2.4

- Add `AbstractCompilerPass::getSortedReferencesByTag` to easily get the references directly from a tag and sort them

## 1.2.3

- Add `AbstractDoctrineTypesPrependConfiguration` to easily add types to doctrine

## 1.2.2

- Add `AbstractCompilerPass::getReferencesByTag` to easily get the references directly from a tag

## 1.2.1

- Fixes a bug with `Configuration::getKey()`.

## 1.2.0

- Add compiler passes automatic detection
- Add AbstractPrependConfiguration
- Add prepend configuration automatic detection
- Add doctrine mappings support in AbstractBundle

## 1.1.2

- Add a more handy function in AbstractConfiguration

## 1.1.1

- Remove useless dependencies, that could produce some Composer issues.
- Move from Travis to Github Actions

## 1.1.0

- Add `AbstractCompilerPass::checkMandatoryServices` to quickly checks if the services listed in th e`MANDATORY_SERVICES` constant exists in the container.
- Add `AbstractConfiguration::getKey` and `AbstractConfiguration::get` to easily retrieve a configuration. It allows also more traceability of the configuration usage.

## 1.0.0

- Add `AbstractCompilerPass`
- Add `AbstractConfiguration`
- Add `AbstractExtension`
- Add `AbstractBundle`
