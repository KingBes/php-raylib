<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib;

/**
 * 抽象类 Base
 */
abstract class Base
{
    // private \FFI $ffi;
    private static \FFI $ffi;

    /**
     * 获取 FFI 实例
     *
     * @return \FFI
     * @throws RuntimeException Missing Raylib dependencies.
     */
    public static function ffi(): \FFI
    {
        if (!isset(self::$ffi)) {
            $headerPath = __DIR__ . '/Raylib.h';
            $dllPath = realpath(dirname(__DIR__) . '/build/lib/windows/raylib.dll');

            if (!file_exists($headerPath) || !$dllPath) {
                throw new \RuntimeException("Missing Raylib dependencies.");
            }

            $libHeader = file_get_contents($headerPath);
            self::$ffi = \FFI::cdef($libHeader, $dllPath);
        }
        return self::$ffi;
    }
}
