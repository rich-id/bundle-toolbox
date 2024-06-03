# RichCongress Bundle Toolbox

This version of the bundle requires Symfony 6.0+ and PHP 8.1+.

[![Package version](https://img.shields.io/packagist/v/richcongress/bundle-toolbox)](https://packagist.org/packages/richcongress/bundle-toolbox)
[![Build Status](https://img.shields.io/travis/richcongress/bundle-toolbox.svg?branch=master)](https://travis-ci.org/richcongress/bundle-toolbox?branch=master)
[![Coverage Status](https://coveralls.io/repos/github/richcongress/bundle-toolbox/badge.svg?branch=master)](https://coveralls.io/github/richcongress/bundle-toolbox?branch=master)
[![contributions welcome](https://img.shields.io/badge/contributions-welcome-brightgreen.svg?style=flat)](https://github.com/richcongress/bundle-toolbox/issues)
[![License](https://img.shields.io/badge/license-MIT-red.svg)](LICENSE.md)

The bundle toolbox provides a set of abstract classes and tools to avoid code redundancy between the bundles.


# Installation

Create a new bundle, and add this bundle as a dependency.

```bash
composer require richcongress/bundle-toolbox
```


# Quick start

## Configuration

When creating a new Configuration, use the `AbstractConfiguration`, set correctly the `CONFIG_NODE` constant, and set the `buildConfiguration` function. The argument is the root node of your configuration.

```php
class Configuration extends AbstractConfiguration
{
    public const CONFIG_NODE = 'bundle_toolbox_test';

    protected function buildConfiguration(ArrayNodeDefinition $rootNode): void
    {
        $rootNode
            ->children()
                ->booleanNode('test')->defaultFalse()->end()
            ->end();
    }
}
```

From your bundle, you could use the `get` static function to quickly retrieve the bundle configuration.

```php
$this->specificConfiguration = Configuration::get($parameterBag, 'your_sub_configuration');
```

## Extension

When creating the Extension, extends from `AbstractExtension`. You now have a new function available, `parseConfiguration` which process the configuration and load it in the ParameterBag of your container.

```php

class BundleExtension extends AbstractExtension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $this->parseConfiguration($container, new Configuration(), $configs);
    }
}
```

## CompilerPass

When creating a new CompilerPass, use the `AbstractCompilerPass` and add them from the `build()` function of your bundle.

```php
public function build(ContainerBuilder $container): void
{
    CompilerPass::add($container);
}
```

You can also configure its Type and Priority using respectively the constants `TYPE` and `PRIORITY`.

You can use the `MANDATORY_SERVICES` constant to check quickly if the required services exists:

```php
public const MANDATORY_SERVICES = ['service1', 'service2', 'service3'];

public function process(ContainerBuilder $container): void
{
    if (!self::checkMandatoryServices($container)) {
        return;
    }

    // ...
}
```

## Bundle

When creating a new Bundle, use the `AbstractBundle`. If you want to add a CompilerPass, simply add it to the `COMPILER_PASSES` constant. If the compiler is an instance of `AbstractCompilerPass`, it will use the `add` method. If not, it will be added to the container using the default values.

# Versioning

The bundle toolbox follows [semantic versioning](https://semver.org/). In short the scheme is MAJOR.MINOR.PATCH where
1. MAJOR is bumped when there is a breaking change,
2. MINOR is bumped when a new feature is added in a backward-compatible way,
3. PATCH is bumped when a bug is fixed in a backward-compatible way.

Versions bellow 1.0.0 are considered experimental and breaking changes may occur at any time.


# Contributing

Contributions are welcomed! There are many ways to contribute, and we appreciate all of them. Here are some of the major ones:

* [Bug Reports](https://github.com/richcongress/bundle-toolbox/issues): While we strive for quality software, bugs can happen and we can't fix issues we're not aware of. So please report even if you're not sure about it or just want to ask a question. If anything the issue might indicate that the documentation can still be improved!
* [Feature Request](https://github.com/richcongress/bundle-toolbox/issues): You have a use case not covered by the current api? Want to suggest a change or add something? We'd be glad to read about it and start a discussion to try to find the best possible solution.
* [Pull Request](https://github.com/richcongress/bundle-toolbox/merge_requests): Want to contribute code or documentation? We'd love that! If you need help to get started, GitHub as [documentation](https://help.github.com/articles/about-pull-requests/) on pull requests. We use the ["fork and pull model"](https://help.github.com/articles/about-collaborative-development-models/) were contributors push changes to their personnal fork and then create pull requests to the main repository. Please make your pull requests against the `master` branch.

As a reminder, all contributors are expected to follow our [Code of Conduct](CODE_OF_CONDUCT.md).


# Hacking

You might use Docker and `docker-compose` to hack the project. Check out the following commands.

```bash
# Start the project
docker-compose up -d

# Install dependencies
docker-compose exec application composer install

# Run tests
docker-compose exec application bin/phpunit

# Run a bash within the container
docker-compose exec application bash
```


# 6. License

The bundle toolbox is distributed under the terms of the MIT license.

See [LICENSE](LICENSE.md) for details.
