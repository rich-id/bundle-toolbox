<?php declare(strict_types=1);

namespace RichCongress\BundleToolbox\Tests\Resources;

use RichCongress\BundleToolbox\Configuration\AbstractCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class DummyCompilerPass
 *
 * @package   RichCongress\BundleToolbox\Tests\Resources
 * @author    Nicolas Guilloux <nguilloux@richcongress.com>
 * @copyright 2014 - 2020 RichCongress (https://www.richcongress.com)
 */
class DummyCompilerPass extends AbstractCompilerPass
{
    public const MANDATORY_SERVICES = ['entity_manager'];

    /**
     * @param ContainerBuilder $container
     *
     * @return void
     */
    public function process(ContainerBuilder $container): void
    {
        // TODO: Implement process() method.
    }
}
