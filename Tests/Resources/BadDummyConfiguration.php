<?php declare(strict_types=1);

namespace RichCongress\BundleToolbox\Tests\Resources;

use RichCongress\BundleToolbox\Configuration\AbstractConfiguration;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

/**
 * Class BadDummyConfiguration
 *
 * @package   RichCongress\BundleToolbox\Tests\Resources
 * @author    Nicolas Guilloux <nguilloux@richcongress.com>
 * @copyright 2014 - 2020 RichCongress (https://www.richcongress.com)
 */
class BadDummyConfiguration extends AbstractConfiguration
{
    /**
     * @param ArrayNodeDefinition $rootNode
     *
     * @return void
     */
    protected function buildConfiguration(ArrayNodeDefinition $rootNode): void
    {
        // Empty, should throw an error before reaching this function
    }
}
