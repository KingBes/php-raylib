<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib;

use \FFI\CData;

/**
 * Gui类
 */
class Gui extends Base
{

    public static function button(CData $bounds, string $text): int
    {
        return self::ffi()->GuiButton($bounds, $text);
    }

    public static function messageBox(
        CData $bounds,
        string $title,
        string $message,
        string $buttons
    ): int {
        return self::ffi()->GuiMessageBox($bounds, $title, $message, $buttons);
    }
}
