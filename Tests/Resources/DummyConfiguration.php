<?php declare(strict_types=1);

namespace RichCongress\BundleToolbox\Tests\Resources;

use RichCongress\BundleToolbox\Configuration\AbstractConfiguration;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

/**
 * Class DummyConfiguration
 *
 * @package   RichCongress\BundleToolbox\Tests\Resources
 * @author    Nicolas Guilloux <nguilloux@richcongress.com>
 * @copyright 2014 - 2020 RichCongress (https://www.richcongress.com)
 */
class DummyConfiguration extends AbstractConfiguration
{
    public const CONFIG_NODE = 'bundle_toolbox_test';

    /**
     * @param ArrayNodeDefinition $rootNode
     *
     * @return void
     */
    protected function buildConfiguration(ArrayNodeDefinition $rootNode): void
    {
        $rootNode
            ->children()
                ->booleanNode('test')->defaultFalse()->end()
            ->end();
    }
}
