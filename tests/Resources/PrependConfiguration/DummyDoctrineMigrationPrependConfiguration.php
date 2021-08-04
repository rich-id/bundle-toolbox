<?php declare(strict_types=1);

namespace RichCongress\BundleToolbox\Tests\Resources\PrependConfiguration;

use RichCongress\BundleToolbox\Configuration\PrependConfiguration\AbstractDoctrineMigrationPrependConfiguration;

final class DummyDoctrineMigrationPrependConfiguration extends AbstractDoctrineMigrationPrependConfiguration
{
    protected function getBindings(): array
    {
        return ['test' => 'test'];
    }
}
