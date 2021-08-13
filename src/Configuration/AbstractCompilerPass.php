<?php declare(strict_types=1);

namespace RichCongress\BundleToolbox\Configuration;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

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
    public const MANDATORY_SERVICES = [];

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

    /**
     * @param ContainerBuilder $container
     *
     * @return bool
     */
    public static function checkMandatoryServices(ContainerBuilder $container): bool
    {
        foreach ((array) static::MANDATORY_SERVICES as $serviceId) {
            if (!$container->has($serviceId)) {
                return false;
            }
        }

        return true;
    }

    /** @return Reference[] */
    protected static function getReferencesByTag(ContainerBuilder $container, string $tag): array
    {
        $serviceConfigs = $container->findTaggedServiceIds($tag);
        $serviceIds = array_keys($serviceConfigs);

        return array_map(
            static function (string $serviceId): Reference {
                return new Reference($serviceId);
            },
            $serviceIds
        );
    }
}
