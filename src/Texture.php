<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib;

/**
 * 图形类
 */
class Texture extends Base
{
    public static function loadImage(string $fileName): \FFI\CData
    {
        return self::ffi()->LoadImage($fileName);
    }
}
