<?php declare(strict_types=1);

namespace RichCongress\BundleToolbox\Helper;

final class ClassHelper
{
    public static function findClassRelativelyToObject($object, string $relativePath): array
    {
        $reflectionClass = new \ReflectionClass($object);
        $extensionNamespace = $reflectionClass->getNamespaceName();
        $extensionDirectory = dirname($reflectionClass->getFileName());

        $prependNamespace = $extensionNamespace . '\\' . str_replace('/', '\\', $relativePath) . '\\';
        $files = glob($extensionDirectory . '/' . $relativePath . '/*.php');

        $prependClasses = array_map(
            static function (string $path) use ($prependNamespace): string {
                $filename = pathinfo($path)['filename'];

                return $prependNamespace . $filename;
            },
            $files
        );

        return array_filter($prependClasses, 'class_exists');
    }
}
