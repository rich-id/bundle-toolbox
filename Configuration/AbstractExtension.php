<?php declare(strict_types=1);

namespace RichCongress\BundleToolbox\Configuration;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;

/**
 * Class AbstractExtension
 *
 * @package   RichCongress\BundleToolbox\Configuration
 * @author    Nicolas Guilloux <nguilloux@richcongress.com>
 * @copyright 2014 - 2020 RichCongress (https://www.richcongress.com)
 */
abstract class AbstractExtension extends Extension
{
    /**
     * @param ContainerBuilder      $container
     * @param AbstractConfiguration $configuration
     * @param array                 $configs
     *
     * @return void
     */
    protected function parseConfiguration(
        ContainerBuilder $container,
        AbstractConfiguration $configuration,
        array $configs
    ): void
    {
        $bundleConfig = $this->processConfiguration($configuration, $configs);

        $container->setParameter($configuration::CONFIG_NODE, $bundleConfig);
        $this->setParameters($container, $configuration::CONFIG_NODE, $bundleConfig);
    }

    /**
     * @param ContainerBuilder $container
     * @param string           $name
     * @param array            $config
     *
     * @return void
     */
    protected function setParameters(ContainerBuilder $container, $name, array $config): void
    {
        foreach ($config as $key => $parameter) {
            $container->setParameter($name . '.' . $key, $parameter);

            if (is_array($parameter)) {
                $this->setParameters($container, $name . '.' . $key, $parameter);
            }
        }
    }
}
