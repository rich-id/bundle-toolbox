<?php declare(strict_types=1);

namespace RichCongress\BundleToolbox\Configuration;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class AbstractCompilerPass
 *
 * @package   RichCongress\BundleToolbox\Configuration
 * @author    Nicolas Guilloux <nguilloux@richcongress.com>
 * @copyright 2014 - 2020 RichCongress (https://www.richcongress.com)
 */
abstract class AbstractCompilerPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     *
     * @return self
     */
    public static function add(ContainerBuilder $container): self
    {
        $compiler = new static();
        $container->addCompilerPass($compiler);

        return $compiler;
    }
}
