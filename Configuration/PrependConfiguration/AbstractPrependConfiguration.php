<?php declare(strict_types=1);

namespace RichCongress\BundleToolbox\Configuration\PrependConfiguration;

use Symfony\Component\DependencyInjection\ContainerBuilder;

abstract class AbstractPrependConfiguration
{
    /** @var ContainerBuilder */
    protected $container;

    public function __invoke(ContainerBuilder $container): void
    {
        $this->container = $container;
        $this->prepend();
    }

    abstract protected function prepend(): void;

    protected function getExtensionConfig(string $mainKey): array
    {
        $config = $this->container->getExtensionConfig($mainKey);

        return \array_pop($config) ?? [];
    }

    protected function prependExtensionConfig(string $extensionName, array $config): array
    {
        $oldConfig = $this->getExtensionConfig($extensionName);
        $newConfig = array_merge($oldConfig, $config);
        $this->container->prependExtensionConfig($extensionName, $newConfig);

        return $newConfig;
    }
}
