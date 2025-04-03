<?php
// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib;

/**
 * Text类
 */
class Text extends Base
{
    //### 字体加载/卸载函数

    /**
     * 获取默认字体
     *
     * @return \FFI\CData 返回Font对象
     */
    public static function getFontDefault(): \FFI\CData
    {
        return self::ffi()->GetFontDefault();
    }

    /**
     * 从文件加载字体到GPU显存(VRAM)
     *
     * @param string $fileName 文件名
     * @return \FFI\CData 返回Font对象
     */
    public static function loadFont(string $fileName): \FFI\CData
    {
        return self::ffi()->LoadFont($fileName);
    }

    /**
     * 扩展参数加载字体（codepoints传NULL且codepointCount为0时加载默认字符集，字号单位为像素高度）
     *
     * @param string $fileName 文件名
     * @param int $fontSize 字体大小
     * @param array|null &$codepoints 字符点数组引用
     * @param int $codepointCount 字符点数量
     * @return \FFI\CData 返回Font对象
     */
    public static function loadFontEx(string $fileName, int $fontSize, ?array &$codepoints = null, int $codepointCount = 0): \FFI\CData
    {
        if ($codepoints === null) {
            $codepoints = [];
            $codepointCount = 0;
        }
        return self::ffi()->LoadFontEx($fileName, $fontSize, $codepoints, $codepointCount);
    }

    /**
     * 从图像加载字体(XNA风格)
     *
     * @param \FFI\CData $image Image对象
     * @param \FFI\CData $key 颜色键
     * @param int $firstChar 第一个字符
     * @return \FFI\CData 返回Font对象
     */
    public static function loadFontFromImage(\FFI\CData $image, \FFI\CData $key, int $firstChar): \FFI\CData
    {
        return self::ffi()->LoadFontFromImage($image, $key, $firstChar);
    }

    /**
     * 从内存缓冲区加载字体(fileType指扩展名如.ttf)
     *
     * @param string $fileType 文件类型
     * @param string $fileData 文件数据
     * @param int $dataSize 数据大小
     * @param int $fontSize 字体大小
     * @param array|null &$codepoints 字符点数组引用
     * @param int $codepointCount 字符点数量
     * @return \FFI\CData 返回Font对象
     */
    public static function loadFontFromMemory(string $fileType, string $fileData, int $dataSize, int $fontSize, ?array &$codepoints = null, int $codepointCount = 0): \FFI\CData
    {
        if ($codepoints === null) {
            $codepoints = [];
            $codepointCount = 0;
        }
        return self::ffi()->LoadFontFromMemory($fileType, $fileData, $dataSize, $fontSize, $codepoints, $codepointCount);
    }

    /**
     * 检查字体是否有效（仅检查字体数据，不检查GPU纹理）
     *
     * @param \FFI\CData $font Font对象
     * @return bool 是否有效
     */
    public static function isFontValid(\FFI\CData $font): bool
    {
        return self::ffi()->IsFontValid($font);
    }

    /**
     * 加载字体数据供后续使用
     *
     * @param string $fileData 文件数据
     * @param int $dataSize 数据大小
     * @param int $fontSize 字体大小
     * @param array|null &$codepoints 字符点数组引用
     * @param int $codepointCount 字符点数量
     * @param int $type 字体类型
     * @return \FFI\CData 返回GlyphInfo对象数组
     */
    public static function loadFontData(string $fileData, int $dataSize, int $fontSize, ?array &$codepoints = null, int $codepointCount = 0, int $type = 0): \FFI\CData
    {
        if ($codepoints === null) {
            $codepoints = [];
            $codepointCount = 0;
        }
        return self::ffi()->LoadFontData($fileData, $dataSize, $fontSize, $codepoints, $codepointCount, $type);
    }

    /**
     * 根据字形信息生成字体图集
     *
     * @param \FFI\CData $glyphs GlyphInfo对象数组
     * @param \FFI\CData $glyphRecs Rectangle对象数组引用
     * @param int $glyphCount 字形数量
     * @param int $fontSize 字体大小
     * @param int $padding 填充
     * @param int $packMethod 打包方法
     * @return \FFI\CData 返回Image对象
     */
    public static function genImageFontAtlas(\FFI\CData $glyphs, \FFI\CData &$glyphRecs, int $glyphCount, int $fontSize, int $padding, int $packMethod): \FFI\CData
    {
        return self::ffi()->GenImageFontAtlas($glyphs, $glyphRecs, $glyphCount, $fontSize, $padding, $packMethod);
    }

    /**
     * 卸载字体字形数据(RAM)
     *
     * @param \FFI\CData $glyphs GlyphInfo对象数组
     * @param int $glyphCount 字形数量
     * @return void
     */
    public static function unloadFontData(\FFI\CData $glyphs, int $glyphCount): void
    {
        self::ffi()->UnloadFontData($glyphs, $glyphCount);
    }

    /**
     * 从GPU显存卸载字体
     *
     * @param \FFI\CData $font Font对象
     * @return void
     */
    public static function unloadFont(\FFI\CData $font): void
    {
        self::ffi()->UnloadFont($font);
    }

    /**
     * 将字体导出为代码文件，成功返回true
     *
     * @param \FFI\CData $font Font对象
     * @param string $fileName 文件名
     * @return bool 成功与否
     */
    public static function exportFontAsCode(\FFI\CData $font, string $fileName): bool
    {
        return self::ffi()->ExportFontAsCode($font, $fileName);
    }

    //### 文本绘制函数

    /**
     * 绘制当前FPS
     *
     * @param int $posX X坐标
     * @param int $posY Y坐标
     * @return void
     */
    public static function drawFPS(int $posX, int $posY): void
    {
        self::ffi()->DrawFPS($posX, $posY);
    }

    /**
     * 使用默认字体绘制文本
     *
     * @param string $text 文本内容
     * @param int $posX X坐标
     * @param int $posY Y坐标
     * @param int $fontSize 字体大小
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawText(string $text, int $posX, int $posY, int $fontSize, \FFI\CData $color): void
    {
        self::ffi()->DrawText($text, $posX, $posY, $fontSize, $color);
    }

    /**
     * 使用字体和额外参数绘制文本
     *
     * @param \FFI\CData $font Font对象
     * @param string $text 文本内容
     * @param \FFI\CData $position Vector2对象
     * @param float $fontSize 字体大小
     * @param float $spacing 字间距
     * @param \FFI\CData $tint 颜色
     * @return void
     */
    public static function drawTextEx(\FFI\CData $font, string $text, \FFI\CData $position, float $fontSize, float $spacing, \FFI\CData $tint): void
    {
        self::ffi()->DrawTextEx($font, $text, $position, $fontSize, $spacing, $tint);
    }

    /**
     * 使用字体和高级参数绘制文本（支持旋转）
     *
     * @param \FFI\CData $font Font对象
     * @param string $text 文本内容
     * @param \FFI\CData $position Vector2对象
     * @param \FFI\CData $origin Vector2对象
     * @param float $rotation 旋转角度
     * @param float $fontSize 字体大小
     * @param float $spacing 字间距
     * @param \FFI\CData $tint 颜色
     * @return void
     */
    public static function drawTextPro(\FFI\CData $font, string $text, \FFI\CData $position, \FFI\CData $origin, float $rotation, float $fontSize, float $spacing, \FFI\CData $tint): void
    {
        self::ffi()->DrawTextPro($font, $text, $position, $origin, $rotation, $fontSize, $spacing, $tint);
    }

    /**
     * 绘制单个字符（码位）
     *
     * @param \FFI\CData $font Font对象
     * @param int $codepoint 码位
     * @param \FFI\CData $position Vector2对象
     * @param float $fontSize 字体大小
     * @param \FFI\CData $tint 颜色
     * @return void
     */
    public static function drawTextCodepoint(\FFI\CData $font, int $codepoint, \FFI\CData $position, float $fontSize, \FFI\CData $tint): void
    {
        self::ffi()->DrawTextCodepoint($font, $codepoint, $position, $fontSize, $tint);
    }

    /**
     * 绘制多个字符（码位）
     *
     * @param \FFI\CData $font Font对象
     * @param array $codepoints 码位数组
     * @param int $codepointCount 码位数量
     * @param \FFI\CData $position Vector2对象
     * @param float $fontSize 字体大小
     * @param float $spacing 字间距
     * @param \FFI\CData $tint 颜色
     * @return void
     */
    public static function drawTextCodepoints(\FFI\CData $font, array $codepoints, int $codepointCount, \FFI\CData $position, float $fontSize, float $spacing, \FFI\CData $tint): void
    {
        // 将PHP数组转换为C指针
        $cCodepoints = self::ffi()->new("int[$codepointCount]");
        foreach ($codepoints as $i => $cp) {
            $cCodepoints[$i] = $cp;
        }
        self::ffi()->DrawTextCodepoints($font, $cCodepoints, $codepointCount, $position, $fontSize, $spacing, $tint);
    }

    //### 字体信息函数

    /**
     * 设置换行时的垂直行间距
     *
     * @param int $spacing 行间距
     * @return void
     */
    public static function setTextLineSpacing(int $spacing): void
    {
        self::ffi()->SetTextLineSpacing($spacing);
    }

    /**
     * 测量默认字体文本宽度
     *
     * @param string $text 文本内容
     * @param int $fontSize 字体大小
     * @return int 文本宽度
     */
    public static function measureText(string $text, int $fontSize): int
    {
        return self::ffi()->MeasureText($text, $fontSize);
    }

    /**
     * 测量指定字体文本尺寸
     *
     * @param \FFI\CData $font Font对象
     * @param string $text 文本内容
     * @param float $fontSize 字体大小
     * @param float $spacing 字间距
     * @return \FFI\CData 返回Vector2对象
     */
    public static function measureTextEx(\FFI\CData $font, string $text, float $fontSize, float $spacing): \FFI\CData
    {
        return self::ffi()->MeasureTextEx($font, $text, $fontSize, $spacing);
    }

    /**
     * 获取字符码位对应的字形索引（未找到返回'?'索引）
     *
     * @param \FFI\CData $font Font对象
     * @param int $codepoint 码位
     * @return int 字形索引
     */
    public static function getGlyphIndex(\FFI\CData $font, int $codepoint): int
    {
        return self::ffi()->GetGlyphIndex($font, $codepoint);
    }

    /**
     * 获取字符码位的字形信息（未找到返回'?'信息）
     *
     * @param \FFI\CData $font Font对象
     * @param int $codepoint 码位
     * @return \FFI\CData 返回GlyphInfo对象
     */
    public static function getGlyphInfo(\FFI\CData $font, int $codepoint): \FFI\CData
    {
        return self::ffi()->GetGlyphInfo($font, $codepoint);
    }

    /**
     * 获取字符码位在图集中的矩形区域（未找到返回'?'区域）
     *
     * @param \FFI\CData $font Font对象
     * @param int $codepoint 码位
     * @return \FFI\CData 返回Rectangle对象
     */
    public static function getGlyphAtlasRec(\FFI\CData $font, int $codepoint): \FFI\CData
    {
        return self::ffi()->GetGlyphAtlasRec($font, $codepoint);
    }

    //### 码位管理函数（Unicode字符）

    /**
     * 从码位数组生成UTF-8编码文本
     *
     * @param array $codepoints 码位数组
     * @param int $length 数组长度
     * @return string UTF-8编码文本
     */
    public static function loadUTF8(array $codepoints, int $length): string
    {
        // 将PHP数组转换为C指针
        $cCodepoints = self::ffi()->new("int[$length]");
        foreach ($codepoints as $i => $cp) {
            $cCodepoints[$i] = $cp;
        }
        $utf8Text = self::ffi()->LoadUTF8($cCodepoints, $length);
        return \FFI::string($utf8Text);
    }

    /**
     * 卸载UTF-8编码文本
     *
     * @param string $text UTF-8编码文本
     * @return void
     */
    public static function unloadUTF8(string $text): void
    {
        // 注意：在FFI中处理字符串时，通常不需要手动释放内存，除非特别需要
        // 这里假设原生函数内部处理了内存管理
        self::ffi()->UnloadUTF8($text);
    }

    /**
     * 从UTF-8文本加载所有码位（通过参数返回数量）
     *
     * @param string $text UTF-8文本
     * @return array 返回码位数组和数量
     */
    public static function loadCodepoints(string $text): array
    {
        $count = 0;
        $codepoints = self::ffi()->LoadCodepoints($text, \FFI::addr($count));
        $result = [];
        for ($i = 0; $i < $count; $i++) {
            $result[] = $codepoints[$i];
        }
        self::unloadCodepoints($codepoints); // 卸载码位数据，避免内存泄漏
        return [$result, $count];
    }

    /**
     * 卸载码位数据
     *
     * @param \FFI\CData $codepoints 码位数组
     * @return void
     */
    public static function unloadCodepoints(\FFI\CData $codepoints): void
    {
        self::ffi()->UnloadCodepoints($codepoints);
    }

    /**
     * 获取UTF-8文本的码位总数
     *
     * @param string $text UTF-8文本
     * @return int 码位总数
     */
    public static function getCodepointCount(string $text): int
    {
        return self::ffi()->GetCodepointCount($text);
    }

    /**
     * 获取当前码位（失败返回0x3f '?'）
     *
     * @param string $text UTF-8文本
     * @param int|null &$codepointSize 码位大小引用
     * @return int 当前码位
     */
    public static function getCodepoint(string $text, ?int &$codepointSize = null): int
    {
        if ($codepointSize === null) {
            $codepointSize = 0;
        }
        return self::ffi()->GetCodepoint($text, \FFI::addr($codepointSize));
    }

    /**
     * 获取下一个码位（失败返回0x3f '?'）
     *
     * @param string $text UTF-8文本
     * @param int|null &$codepointSize 码位大小引用
     * @return int 下一个码位
     */
    public static function getCodepointNext(string $text, ?int &$codepointSize = null): int
    {
        if ($codepointSize === null) {
            $codepointSize = 0;
        }
        return self::ffi()->GetCodepointNext($text, \FFI::addr($codepointSize));
    }

    /**
     * 获取前一个码位（失败返回0x3f '?'）
     *
     * @param string $text UTF-8文本
     * @param int|null &$codepointSize 码位大小引用
     * @return int 前一个码位
     */
    public static function getCodepointPrevious(string $text, ?int &$codepointSize = null): int
    {
        if ($codepointSize === null) {
            $codepointSize = 0;
        }
        return self::ffi()->GetCodepointPrevious($text, \FFI::addr($codepointSize));
    }

    /**
     * 将码位编码为UTF-8字节数组（通过参数返回数组长度）
     *
     * @param int $codepoint 码位
     * @param int|null &$utf8Size UTF-8字节长度引用
     * @return string UTF-8字节数组
     */
    public static function codepointToUTF8(int $codepoint, ?int &$utf8Size = null): string
    {
        if ($utf8Size === null) {
            $utf8Size = 0;
        }
        $utf8Bytes = self::ffi()->CodepointToUTF8($codepoint, \FFI::addr($utf8Size));
        return \FFI::string($utf8Bytes, $utf8Size);
    }
}
