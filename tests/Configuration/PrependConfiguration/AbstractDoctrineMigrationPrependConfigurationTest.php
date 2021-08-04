<?php declare(strict_types=1);

namespace RichCongress\BundleToolbox\Tests\Configuration\PrependConfiguration;


use Doctrine\Bundle\DoctrineBundle\DependencyInjection\DoctrineExtension;
use Doctrine\Bundle\MigrationsBundle\DependencyInjection\DoctrineMigrationsExtension;
use PHPUnit\Framework\TestCase;
use RichCongress\BundleToolbox\Tests\Resources\DummyExtension;
use RichCongress\BundleToolbox\Tests\Resources\PrependConfiguration\DummyDoctrineMigrationPrependConfiguration;
use RichCongress\BundleToolbox\Tests\Resources\PrependConfiguration\DummyPrependConfiguration;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * @covers \RichCongress\BundleToolbox\Configuration\PrependConfiguration\AbstractDoctrineMigrationPrependConfiguration
 */
final class AbstractDoctrineMigrationPrependConfigurationTest extends TestCase
{
    public function testPrependNoExtension(): void
    {
        $container = new ContainerBuilder();
        $prepend = new DummyDoctrineMigrationPrependConfiguration();
        $prepend($container);

        self::assertFalse($container->hasExtension('doctrine_migrations'));
    }

    public function testPrepend(): void
    {
        $container = new ContainerBuilder();
        $container->registerExtension(new DoctrineMigrationsExtension());

        $prepend = new DummyDoctrineMigrationPrependConfiguration();
        $prepend($container);

        self::assertEquals(
            [
                'migrations_paths' => [
                    'test' => 'test',
                ]
            ],
            $container->getExtensionConfig('doctrine_migrations')[0]
        );
    }

    public function testPrependAdd(): void
    {
        $container = new ContainerBuilder();
        $container->registerExtension(new DoctrineMigrationsExtension());
        $container->prependExtensionConfig('doctrine_migrations', [
            'migrations_paths' => [
                'original_value' => 'test',
            ]
        ]);

        $prepend = new DummyDoctrineMigrationPrependConfiguration();
        $prepend($container);

        self::assertEquals(
            [
                'migrations_paths' => [
                    'original_value' => 'test',
                    'test' => 'test',
                ]
            ],
            $container->getExtensionConfig('doctrine_migrations')[0]
        );
    }
}
