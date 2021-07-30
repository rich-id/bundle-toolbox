<?php declare(strict_types=1);

namespace RichCongress\BundleToolbox\Configuration\PrependConfiguration;

abstract class AbstractDoctrineMigrationPrependConfiguration extends AbstractPrependConfiguration
{
    protected function prepend(): void
    {
        if (!$this->container->hasExtension('doctrine_migrations')) {
            return;
        }

        $doctrineConfig = $this->getExtensionConfig('doctrine_migrations');
        $doctrineMigrationPaths = $doctrineConfig['migrations_paths'] ?? [];
        $this->prependExtensionConfig('doctrine_migrations', [
            'migrations_paths' => \array_merge($doctrineMigrationPaths, $this->getBindings()),
        ]);
    }

    /** @return array<string, string> */
    abstract protected function getBindings(): array;
}
