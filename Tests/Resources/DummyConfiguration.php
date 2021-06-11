<?php declare(strict_types=1);

namespace RichCongress\BundleToolbox\Tests\Resources;

use RichCongress\BundleToolbox\Configuration\AbstractConfiguration;
use Symfony\Component\Config\Definition\Builder\NodeBuilder;

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

    protected function buildConfig(NodeBuilder $nodeBuilder): void
    {
        $nodeBuilder
            ->booleanNode('test')->defaultFalse()->end()
            ->arrayNode('array_test')
                ->normalizeKeys(false)
                ->useAttributeAsKey('key')
                ->scalarPrototype()->end()
            ->end();
    }
}
