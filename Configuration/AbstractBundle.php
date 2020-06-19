<?php declare(strict_types=1);

namespace RichCongress\BundleToolbox\Configuration;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class AbstractBundle
 *
 * @package   RichCongress\BundleToolbox\Configuration
 * @author    Nicolas Guilloux <nguilloux@richcongress.com>
 * @copyright 2014 - 2020 RichCongress (https://www.richcongress.com)
 */
abstract class AbstractBundle extends Bundle
{
    public const COMPILER_PASSES = [];

    /**
     * @param ContainerBuilder $container
     *
     * @return void
     */
    public function build(ContainerBuilder $container): void
    {
        foreach (static::COMPILER_PASSES as $compilerPass) {
            if (is_subclass_of($compilerPass, AbstractCompilerPass::class)) {
                $compilerPass::add($container);
                continue;
            }

            $container->addCompilerPass(new $compilerPass());
        }
    }
}
