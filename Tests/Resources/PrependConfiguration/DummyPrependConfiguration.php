<?php declare(strict_types=1);

namespace RichCongress\BundleToolbox\Tests\Resources\PrependConfiguration;

use RichCongress\BundleToolbox\Configuration\PrependConfiguration\AbstractPrependConfiguration;

final class DummyPrependConfiguration extends AbstractPrependConfiguration
{
    public static $flag = false;

    protected function prepend(): void
    {
        static::$flag = true;
    }
}
