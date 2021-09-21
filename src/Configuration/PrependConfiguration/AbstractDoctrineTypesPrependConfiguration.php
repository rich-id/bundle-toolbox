<?php declare(strict_types=1);

namespace RichCongress\BundleToolbox\Configuration\PrependConfiguration;

abstract class AbstractDoctrineTypesPrependConfiguration extends AbstractPrependConfiguration
{
    protected function prepend(): void
    {
        if (!$this->container->hasExtension('doctrine')) {
            return;
        }

        $doctrineConfig = $this->getExtensionConfig('doctrine');
        $doctrineDbal = $doctrineConfig['dbal'] ?? [];

        $this->prependExtensionConfig('doctrine', [
            'dbal' => \array_merge_recursive(
                $doctrineDbal,
                [ 'types' => $this->getTypesWithAlias() ]
            )
        ]);
    }

    /** @return array<string, string> */
    protected function getTypesWithAlias(): array
    {
        $types = $this->getTypes();

        return \array_combine($types, $types);
    }

    /** @return array<string> */
    abstract protected function getTypes(): array;
}
