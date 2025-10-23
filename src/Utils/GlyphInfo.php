<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib\Utils;

use Kingbes\Raylib\Base;
use \FFI\CData;

/**
 * 字体信息，字体字符的图形信息
 * 
 * @property int $value 字符值（Unicode 编码）
 * @property int $offsetX 水平偏移量
 * @property int $offsetY 垂直偏移量
 * @property int $advanceX 角色前进位置 X
 */
class GlyphInfo extends Base
{
    public readonly int $value; // 字符值（Unicode 编码）
    public readonly int $offsetX; // 水平偏移量
    public readonly int $offsetY; // 垂直偏移量
    public readonly int $advanceX; // 角色前进位置 X
    private CData $data;

    public function __construct(CData $cdata)
    {
        $this->value = $cdata->value;
        $this->offsetX = $cdata->offsetX;
        $this->offsetY = $cdata->offsetY;
        $this->advanceX = $cdata->advanceX;
        $this->data = $cdata->data;
    }

    /**
     * 字体字符的图形信息结构体
     *
     * @return CData
     */
    public function struct(): CData
    {
        return $this->data;
    }
}
