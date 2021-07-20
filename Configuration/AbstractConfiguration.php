<?php declare(strict_types=1);

namespace RichCongress\BundleToolbox\Configuration;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\NodeBuilder;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

/**
 * Class AbstractConfiguration
 *
 * @package   RichCongress\BundleToolbox\Configuration
 * @author    Nicolas Guilloux <nguilloux@richcongress.com>
 * @copyright 2014 - 2020 RichCongress (https://www.richcongress.com)
 */
abstract class AbstractConfiguration implements ConfigurationInterface
{
    protected const CONFIG_NODE = '';

    /**
     * @return TreeBuilder|void
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $configNode = static::getConfigNode();
        $treeBuilder = new TreeBuilder($configNode);
        $rootNode = \method_exists(TreeBuilder::class, 'getRootNode')
            ? $treeBuilder->getRootNode()
            : $treeBuilder->root($configNode);

        $this->buildConfiguration($rootNode);

        return $treeBuilder;
    }

    /**
     * @param ArrayNodeDefinition $rootNode
     *
     * @return void
     */
    protected function buildConfiguration(ArrayNodeDefinition $rootNode): void
    {
        $children = $rootNode->children();
        $this->buildConfig($children);
    }

    protected function buildConfig(NodeBuilder $nodeBuilder): void
    {
        // Overrides to add children
    }

    public static function getKey(string $key): string
    {
        return sprintf('%s.%s', self::getConfigNode(), $key);
    }

    /**
     * @param string                $key
     * @param ParameterBagInterface $parameterBag
     *
     * @return string|array|int|bool|mixed
     */
    public static function get(string $key, ParameterBagInterface $parameterBag)
    {
        return $parameterBag->get(static::getKey($key));
    }

    public static function getConfigNode(): string
    {
        if (static::CONFIG_NODE === '') {
            throw new \InvalidArgumentException('You need to define the constant CONFIG_NODE for the class ' . static::class);
        }

        return static::CONFIG_NODE;
    }
}
