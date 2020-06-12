<?php declare(strict_types=1);

namespace RichCongress\BundleToolbox\Configuration;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class AbstractConfiguration
 *
 * @package   RichCongress\BundleToolbox\Configuration
 * @author    Nicolas Guilloux <nguilloux@richcongress.com>
 * @copyright 2014 - 2020 RichCongress (https://www.richcongress.com)
 */
abstract class AbstractConfiguration implements ConfigurationInterface
{
    public const CONFIG_NODE = '';

    /**
     * @return TreeBuilder|void
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        if (static::CONFIG_NODE === '') {
            throw new \InvalidArgumentException('You need to define the constant CONFIG_NODE for the class ' . static::class);
        }

        $treeBuilder = new TreeBuilder(self::CONFIG_NODE);
        $rootNode = \method_exists(TreeBuilder::class, 'getRootNode')
            ? $treeBuilder->getRootNode()
            : $treeBuilder->root(self::CONFIG_NODE);

        $this->buildConfiguration($rootNode);

        return $treeBuilder;
    }

    /**
     * @param ArrayNodeDefinition $rootNode
     *
     * @return void
     */
    abstract protected function buildConfiguration(ArrayNodeDefinition $rootNode): void;
}
