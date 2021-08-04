<?php declare(strict_types=1);

namespace RichCongress\BundleToolbox\Tests\Resources;

use RichCongress\BundleToolbox\Configuration\AbstractExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class DummyExtension
 *
 * @package   RichCongress\BundleToolbox\Tests\Resources
 * @author    Nicolas Guilloux <nguilloux@richcongress.com>
 * @copyright 2014 - 2020 RichCongress (https://www.richcongress.com)
 */
class DummyExtension extends AbstractExtension
{
    /**
     * @param array            $configs
     * @param ContainerBuilder $container
     *
     * @return void
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $this->parseConfiguration($container, new DummyConfiguration(), $configs);
    }

    /**
     * @param array            $configs
     * @param ContainerBuilder $container
     *
     * @return void
     */
    public function badLoad(array $configs, ContainerBuilder $container): void
    {
        $this->parseConfiguration($container, new BadDummyConfiguration(), []);
    }
}
