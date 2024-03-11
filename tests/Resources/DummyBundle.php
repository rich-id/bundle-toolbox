<?php declare(strict_types=1);

namespace RichCongress\BundleToolbox\Tests\Resources;

use RichCongress\BundleToolbox\Configuration\AbstractBundle;

/**
 * Class DummyBundle
 *
 * @package   RichCongress\BundleToolbox\Tests\Resources
 * @author    Nicolas Guilloux <nguilloux@richcongress.com>
 * @copyright 2014 - 2020 RichCongress (https://www.richcongress.com)
 */
class DummyBundle extends AbstractBundle
{
    public const COMPILER_PASSES = [
        DummyCompilerPass::class,
        DummyRegularCompilerPass::class
    ];

    protected static $doctrineAttributeMapping = [
        'test1' => 'test',
        'test2' => 'test',
    ];
}
