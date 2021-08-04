<?php declare(strict_types=1);

namespace RichCongress\BundleToolbox\Tests\Configuration\PrependConfiguration;

use PHPUnit\Framework\TestCase;
use RichCongress\BundleToolbox\Tests\Resources\DummyExtension;
use RichCongress\BundleToolbox\Tests\Resources\PrependConfiguration\DummyPrependConfiguration;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * @covers \RichCongress\BundleToolbox\Configuration\PrependConfiguration\AbstractPrependConfiguration
 */
final class AbstractPrependConfigurationTest extends TestCase
{
    public function testPrepend(): void
    {
        $container = new ContainerBuilder();
        $container->registerExtension(new DummyExtension());
        $container->prependExtensionConfig('dummy', ['old' => true]);

        $prepend = new DummyPrependConfiguration();
        $prepend($container);

        self::assertFalse($container->hasExtension('not_existing'));
        self::assertEquals(
            [
                'old' => true,
                'new' => true,
            ],
            $container->getExtensionConfig('dummy')[0]
        );
    }

    public function testPrependOverride(): void
    {
        $container = new ContainerBuilder();
        $container->registerExtension(new DummyExtension());
        $container->prependExtensionConfig('dummy', ['old' => true, 'new' => false]);

        $prepend = new DummyPrependConfiguration();
        $prepend($container);

        self::assertFalse($container->hasExtension('not_existing'));
        self::assertEquals(
            [
                'old' => true,
                'new' => true,
            ],
            $container->getExtensionConfig('dummy')[0]
        );
    }
}
