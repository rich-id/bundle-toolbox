<?php declare(strict_types=1);

namespace RichCongress\BundleToolbox\Configuration;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
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
    public const TYPE = PassConfig::TYPE_BEFORE_OPTIMIZATION;
    public const PRIORITY = 0;

    /**
     * @param ContainerBuilder $container
     *
     * @return self
     */
    public static function add(ContainerBuilder $container): self
    {
        $compiler = new static();
        $container->addCompilerPass($compiler, static::TYPE, static::PRIORITY);

        return $compiler;
    }
}
