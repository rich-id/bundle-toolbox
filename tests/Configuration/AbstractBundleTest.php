<?php declare(strict_types=1);

namespace RichCongress\BundleToolbox\Tests\Configuration;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use PHPUnit\Framework\TestCase;
use RichCongress\BundleToolbox\Tests\Resources\DummyBundle;
use RichCongress\BundleToolbox\Tests\Resources\DummyCompilerPass;
use RichCongress\BundleToolbox\Tests\Resources\DummyRegularCompilerPass;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class AbstractBundleTest
 *
 * @package   RichCongress\BundleToolbox\Tests\Configuration
 * @author    Nicolas Guilloux <nguilloux@richcongress.com>
 * @copyright 2014 - 2020 RichCongress (https://www.richcongress.com)
 *
 * @covers \RichCongress\BundleToolbox\Configuration\AbstractBundle
 */
class AbstractBundleTest extends TestCase
{
    /**
     * @return void
     */
    public function testBuildWithVariousCompilerPass(): void
    {
        $container = new ContainerBuilder();
        $bundle = new DummyBundle();
        $bundle->build($container);

        $filteredPasses = array_filter(
            $container->getCompilerPassConfig()->getPasses(),
            static function (CompilerPassInterface $compilerPass) {
                return $compilerPass instanceof DummyCompilerPass || $compilerPass instanceof DummyRegularCompilerPass;
            }
        );

        self::assertCount(2, $filteredPasses);
    }
}
