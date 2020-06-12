<?php declare(strict_types=1);

namespace RichCongress\BundleToolbox\Tests\Configuration;

use RichCongress\Bundle\UnitBundle\TestCase\TestCase;
use RichCongress\BundleToolbox\Tests\Resources\DummyConfiguration;
use RichCongress\BundleToolbox\Tests\Resources\DummyExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class AbstractExtensionTest
 *
 * @package   RichCongress\BundleToolbox\Tests\Configuration
 * @author    Nicolas Guilloux <nguilloux@richcongress.com>
 * @copyright 2014 - 2020 RichCongress (https://www.richcongress.com)
 *
 * @covers \RichCongress\BundleToolbox\Configuration\AbstractExtension
 */
class AbstractExtensionTest extends TestCase
{
    /**
     * @var DummyExtension
     */
    protected $extension;

    /**
     * @return void
     */
    protected function beforeTest(): void
    {
        $this->extension = new DummyExtension();
    }

    /**
     * @return void
     */
    public function testExtensionLoadConfigurationCorrectly(): void
    {
        $container = new ContainerBuilder();
        $this->extension->load([], $container);

        self::assertEquals(['test' => false], $container->getParameter(DummyConfiguration::CONFIG_NODE));
        self::assertFalse($container->getParameter(DummyConfiguration::CONFIG_NODE . '.test'));
    }

    /**
     * @return void
     */
    public function testExtensionFailsToLoadConfiguration(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('You need to define the constant CONFIG_NODE for the class RichCongress\BundleToolbox\Tests\Resources\BadDummyConfiguration');

        $container = new ContainerBuilder();
        $this->extension->badLoad([], $container);
    }
}
