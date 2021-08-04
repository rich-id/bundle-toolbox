<?php declare(strict_types=1);

namespace RichCongress\BundleToolbox\Tests\Configuration;

use PHPUnit\Framework\TestCase;
use RichCongress\BundleToolbox\Tests\Resources\DummyCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class AbstractCompilerPassTest
 *
 * @package   RichCongress\BundleToolbox\Tests\Configuration
 * @author    Nicolas Guilloux <nguilloux@richcongress.com>
 * @copyright 2014 - 2020 RichConvoidgress (https://www.richcongress.com)
 *
 * @covers \RichCongress\BundleToolbox\Configuration\AbstractCompilerPass
 */
class AbstractCompilerPassTest extends TestCase
{
    /**
     * @return void
     */
    public function testAddCompilerToContainerBuilder(): void
    {
        $container = new ContainerBuilder();
        $compiler = DummyCompilerPass::add($container);

        self::assertNotNull($compiler);
    }

    /**
     * @return void
     */
    public function testCheckMandatoryServicesFailure(): void
    {
        $container = new ContainerBuilder();

        self::assertFalse(DummyCompilerPass::checkMandatoryServices($container));
    }

    /**
     * @return void
     */
    public function testCheckMandatoryServicesSuccess(): void
    {
        $container = new ContainerBuilder();
        $container->set('entity_manager', new static());

        self::assertTrue(DummyCompilerPass::checkMandatoryServices($container));
    }
}
