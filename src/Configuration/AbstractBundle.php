<?php declare(strict_types=1);

namespace RichCongress\BundleToolbox\Configuration;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use RichCongress\BundleToolbox\Helper\ClassHelper;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
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
     * @var array<string, string> ['Namespace' => 'path']
     */
    protected static $doctrineAttributeMapping = [];

    /**
     * @param ContainerBuilder $container
     *
     * @return void
     */
    public function build(ContainerBuilder $container): void
    {
        $compilerPasses = ClassHelper::findClassRelativelyToObject($this, 'DependencyInjection/CompilerPass');
        $compilerPasses = array_unique(array_merge($compilerPasses, static::COMPILER_PASSES));

        foreach ($compilerPasses as $compilerPass) {
            if (is_subclass_of($compilerPass, AbstractCompilerPass::class)) {
                $compilerPass::add($container);
                continue;
            }

            $container->addCompilerPass(new $compilerPass());
        }

        $this->addDoctrineAttributeMapping($container);
    }

    private function addDoctrineAttributeMapping(ContainerBuilder $container): void
    {
        if (!\class_exists(DoctrineOrmMappingsPass::class)) {
            return;
        }

        foreach (static::$doctrineAttributeMapping as $namespace => $path) {
            $container->addCompilerPass(
                DoctrineOrmMappingsPass::createAttributeMappingDriver(
                    [$namespace],
                    [$path],
                    reportFieldsWhereDeclared: true,
                )
            );
        }
    }
}
