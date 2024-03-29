<?php declare(strict_types=1);

namespace RichCongress\BundleToolbox\Tests\Helper;

use PHPUnit\Framework\TestCase;
use RichCongress\BundleToolbox\Helper\ClassHelper;
use RichCongress\BundleToolbox\RichCongressBundleToolboxBundle;
use RichCongress\BundleToolbox\Tests\Flag;
use RichCongress\BundleToolbox\Tests\Resources\DummyExtension;
use RichCongress\BundleToolbox\Tests\Resources\PrependConfiguration\BadPrependConfiguration;
use RichCongress\BundleToolbox\Tests\Resources\PrependConfiguration\DummyDoctrineMigrationPrependConfiguration;
use RichCongress\BundleToolbox\Tests\Resources\PrependConfiguration\DummyPrependConfiguration;

/**
 * @covers \RichCongress\BundleToolbox\Helper\ClassHelper
 */
final class ClassHelperTest extends TestCase
{
    public function testFindClassRelativelyToObject(): void
    {
        $found = ClassHelper::findClassRelativelyToObject(DummyExtension::class, 'PrependConfiguration');

        self::assertCount(3, $found);
        self::assertContains(BadPrependConfiguration::class, $found);
        self::assertContains(DummyDoctrineMigrationPrependConfiguration::class, $found);
        self::assertContains(DummyPrependConfiguration::class, $found);
    }

    public function testFindClassRelativelyToObjectForComplexePath(): void
    {
        $found = ClassHelper::findClassRelativelyToObject(Flag::class, 'Resources/PrependConfiguration');

        self::assertCount(3, $found);
        self::assertContains(BadPrependConfiguration::class, $found);
        self::assertContains(DummyDoctrineMigrationPrependConfiguration::class, $found);
        self::assertContains(DummyPrependConfiguration::class, $found);
    }
}
