<?php declare(strict_types=1);

namespace RichCongress\BundleToolbox\Tests\Configuration;

use RichCongress\Bundle\UnitBundle\TestCase\TestCase;
use RichCongress\BundleToolbox\Tests\Resources\BadDummyConfiguration;
use RichCongress\BundleToolbox\Tests\Resources\DummyConfiguration;
use Symfony\Component\Config\Definition\ArrayNode;
use Symfony\Component\Config\Definition\BooleanNode;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\BooleanNodeDefinition;

/**
 * Class AbstractConfigurationTest
 *
 * @package   RichCongress\BundleToolbox\Tests\Configuration
 * @author    Nicolas Guilloux <nguilloux@richcongress.com>
 * @copyright 2014 - 2020 RichCongress (https://www.richcongress.com)
 *
 * @covers \RichCongress\BundleToolbox\Configuration\AbstractConfiguration
 */
class AbstractConfigurationTest extends TestCase
{
    /**
     * @return void
     */
    public function testBadConfigurationNoConfigNode(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('You need to define the constant CONFIG_NODE for the class RichCongress\BundleToolbox\Tests\Resources\BadDummyConfiguration');

        $config = new BadDummyConfiguration();
        $config->getConfigTreeBuilder();
    }

    /**
     * @return void
     */
    public function testConfigurationSucess(): void
    {
        $config = new DummyConfiguration();
        $treeBuilder = $config->getConfigTreeBuilder();
        $childsNode = $treeBuilder->getRootNode()->getChildNodeDefinitions();

        self::assertCount(2, $childsNode);
        self::assertInstanceOf(BooleanNodeDefinition::class, current($childsNode));
        self::assertInstanceOf(ArrayNodeDefinition::class, next($childsNode));
    }
}
