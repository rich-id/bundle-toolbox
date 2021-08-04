<?php declare(strict_types=1);

namespace RichCongress\BundleToolbox\Tests\Resources\PrependConfiguration;

use RichCongress\BundleToolbox\Configuration\PrependConfiguration\AbstractPrependConfiguration;

final class BadPrependConfiguration extends AbstractPrependConfiguration
{
    protected function prepend(): void
    {
        throw new \LogicException('FAIL!');
    }
}
