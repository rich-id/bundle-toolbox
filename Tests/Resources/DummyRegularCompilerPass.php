<?php declare(strict_types=1);

namespace RichCongress\BundleToolbox\Tests\Resources;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class DummyRegularCompilerPass
 *
 * @package   RichCongress\BundleToolbox\Tests\Resources
 * @author    Nicolas Guilloux <nguilloux@richcongress.com>
 * @copyright 2014 - 2020 RichCongress (https://www.richcongress.com)
 */
class DummyRegularCompilerPass implements CompilerPassInterface
{
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
