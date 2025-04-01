<?php
// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib;

/**
 * Text类
 */
class Text extends Base
{
    /**
     * 获取默认字体
     *
     * @return \FFI\CData 默认字体
     */
    public static function getFontDefault(): \FFI\CData
    {
        return self::ffi()->GetFontDefault();
    }

    /**
     * 从文件加载字体到GPU内存 (VRAM)
     *
     * @param string $fileName 字体文件路径
     * @return \FFI\CData 加载的字体
     */
    public static function loadFont(string $fileName): \FFI\CData
    {
        return self::ffi()->LoadFont($fileName);
    }

    /**
     * 从文件加载字体并带有扩展参数，若codepoints为NULL且codepointCount为0则加载默认字符集，字体大小以像素高度提供
     *
     * @param string $fileName 字体文件路径
     * @param int $fontSize 字体大小（像素高度）
     * @param \FFI\CData|null $codepoints 要加载的字符点数组
     * @param int $codepointCount 要加载的字符点数量
     * @return \FFI\CData 加载的字体
     */
    public static function loadFontEx(string $fileName, int $fontSize, ?\FFI\CData $codepoints, int $codepointCount): \FFI\CData
    {
        return self::ffi()->LoadFontEx($fileName, $fontSize, $codepoints, $codepointCount);
    }

    /**
     * 从图像加载字体 (XNA风格)
     *
     * @param \FFI\CData $image 图像
     * @param \FFI\CData $key 键颜色
     * @param int $firstChar 第一个字符的ASCII码
     * @return \FFI\CData 加载的字体
     */
    public static function loadFontFromImage(\FFI\CData $image, \FFI\CData $key, int $firstChar): \FFI\CData
    {
        return self::ffi()->LoadFontFromImage($image, $key, $firstChar);
    }

    /**
     * 从内存缓冲区加载字体，fileType指文件扩展名，例如: '.ttf'
     *
     * @param string $fileType 文件类型（扩展名）
     * @param \FFI\CData $fileData 文件数据
     * @param int $dataSize 数据大小
     * @param int $fontSize 字体大小（像素高度）
     * @param \FFI\CData|null $codepoints 要加载的字符点数组
     * @param int $codepointCount 要加载的字符点数量
     * @return \FFI\CData 加载的字体
     */
    public static function loadFontFromMemory(string $fileType, \FFI\CData $fileData, int $dataSize, int $fontSize, ?\FFI\CData $codepoints, int $codepointCount): \FFI\CData
    {
        return self::ffi()->LoadFontFromMemory($fileType, $fileData, $dataSize, $fontSize, $codepoints, $codepointCount);
    }

    /**
     * 检查字体是否有效 (字体数据已加载，警告: 未检查GPU纹理)
     *
     * @param \FFI\CData $font 要检查的字体
     * @return bool 如果字体有效返回true，否则返回false
     */
    public static function isFontValid(\FFI\CData $font): bool
    {
        return self::ffi()->IsFontValid($font);
    }

    /**
     * 加载字体数据以供后续使用
     *
     * @param \FFI\CData $fileData 文件数据
     * @param int $dataSize 数据大小
     * @param int $fontSize 字体大小（像素高度）
     * @param \FFI\CData|null $codepoints 要加载的字符点数组
     * @param int $codepointCount 要加载的字符点数量
     * @param int $type 字体类型
     * @return \FFI\CData 字体信息
     */
    public static function loadFontData(\FFI\CData $fileData, int $dataSize, int $fontSize, ?\FFI\CData $codepoints, int $codepointCount, int $type): \FFI\CData
    {
        return self::ffi()->LoadFontData($fileData, $dataSize, $fontSize, $codepoints, $codepointCount, $type);
    }

    /**
     * 使用字符信息生成图像字体图集
     *
     * @param \FFI\CData $glyphs 字符信息数组
     * @param \FFI\CData $glyphRecs 输出的字符矩形区域数组
     * @param int $glyphCount 字符数量
     * @param int $fontSize 字体大小（像素高度）
     * @param int $padding 填充
     * @param int $packMethod 打包方法
     * @return \FFI\CData 字体图集图像
     */
    public static function genImageFontAtlas(\FFI\CData $glyphs, \FFI\CData &$glyphRecs, int $glyphCount, int $fontSize, int $padding, int $packMethod): \FFI\CData
    {
        return self::ffi()->GenImageFontAtlas($glyphs, $glyphRecs, $glyphCount, $fontSize, $padding, $packMethod);
    }

    /**
     * 卸载字体字符信息数据 (RAM)
     *
     * @param \FFI\CData $glyphs 字体信息数组
     * @param int $glyphCount 字体信息数量
     * @return void
     */
    public static function unloadFontData(\FFI\CData $glyphs, int $glyphCount): void
    {
        self::ffi()->UnloadFontData($glyphs, $glyphCount);
    }

    /**
     * 从GPU内存 (VRAM) 卸载字体
     *
     * @param \FFI\CData $font 要卸载的字体
     * @return void
     */
    public static function unloadFont(\FFI\CData $font): void
    {
        self::ffi()->UnloadFont($font);
    }

    /**
     * 将字体导出为代码文件，成功返回true
     *
     * @param \FFI\CData $font 要导出的字体
     * @param string $fileName 导出的文件名
     * @return bool 成功导出返回true，否则返回false
     */
    public static function exportFontAsCode(\FFI\CData $font, string $fileName): bool
    {
        return self::ffi()->ExportFontAsCode($font, $fileName);
    }

    /**
     * 绘制FPS计数器
     *
     * @param int $posX 计数器的X坐标
     * @param int $posY 计数器的Y坐标
     * @return void
     */
    public static function drawFPS(int $posX, int $posY): void
    {
        self::ffi()->DrawFPS($posX, $posY);
    }

    /**
     * 绘制文本(使用默认字体)
     *
     * @param string $text 要绘制的文本
     * @param int $posX 文本的X坐标
     * @param int $posY 文本的Y坐标
     * @param int $fontSize 文本的字体大小
     * @param \FFI\CData $color 文本的颜色
     * @return void
     */
    public static function drawText(string $text, int $posX, int $posY, int $fontSize, \FFI\CData $color): void
    {
        self::ffi()->DrawText($text, $posX, $posY, $fontSize, $color);
    }

    /**
     * 使用字体和附加参数绘制文本
     *
     * @param \FFI\CData $font 字体
     * @param string $text 要绘制的文本
     * @param \FFI\CData $position 文本的位置
     * @param float $fontSize 文本的字体大小
     * @param float $spacing 文本的字符间距
     * @param \FFI\CData $tint 文本的颜色
     * @return void
     */
    public static function drawTextEx(\FFI\CData $font, string $text, \FFI\CData $position, float $fontSize, float $spacing, \FFI\CData $tint): void
    {
        self::ffi()->DrawTextEx($font, $text, $position, $fontSize, $spacing, $tint);
    }

    /**
     * 使用字体和专业参数 (旋转) 绘制文本
     *
     * @param \FFI\CData $font 字体
     * @param string $text 要绘制的文本
     * @param \FFI\CData $position 文本的位置
     * @param \FFI\CData $origin 文本的原点
     * @param float $rotation 文本的旋转角度
     * @param float $fontSize 文本的字体大小
     * @param float $spacing 文本的字符间距
     * @param \FFI\CData $tint 文本的颜色
     * @return void
     */
    public static function drawTextPro(\FFI\CData $font, string $text, \FFI\CData $position, \FFI\CData $origin, float $rotation, float $fontSize, float $spacing, \FFI\CData $tint): void
    {
        self::ffi()->DrawTextPro($font, $text, $position, $origin, $rotation, $fontSize, $spacing, $tint);
    }

    /**
     * 绘制一个字符 (代码点)
     *
     * @param \FFI\CData $font 字体
     * @param int $codepoint 字符的代码点
     * @param \FFI\CData $position 字符的位置
     * @param float $fontSize 字符的字体大小
     * @param \FFI\CData $tint 字符的颜色
     * @return void
     */
    public static function drawTextCodepoint(\FFI\CData $font, int $codepoint, \FFI\CData $position, float $fontSize, \FFI\CData $tint): void
    {
        self::ffi()->DrawTextCodepoint($font, $codepoint, $position, $fontSize, $tint);
    }

    /**
     * 绘制多个字符 (代码点)
     *
     * @param \FFI\CData $font 字体
     * @param \FFI\CData $codepoints 字符的代码点数组
     * @param int $codepointCount 字符的数量
     * @param \FFI\CData $position 字符的位置
     * @param float $fontSize 字符的字体大小
     * @param float $spacing 字符之间的间距
     * @param \FFI\CData $tint 字符的颜色
     * @return void
     */
    public static function drawTextCodepoints(\FFI\CData $font, \FFI\CData $codepoints, int $codepointCount, \FFI\CData $position, float $fontSize, float $spacing, \FFI\CData $tint): void
    {
        self::ffi()->DrawTextCodepoints($font, $codepoints, $codepointCount, $position, $fontSize, $spacing, $tint);
    }

    /**
     * 设置绘制带换行符文本时的垂直行间距
     *
     * @param int $spacing 行间距大小
     * @return void
     */
    public static function setTextLineSpacing(int $spacing): void
    {
        self::ffi()->SetTextLineSpacing($spacing);
    }

    /**
     * 测量默认字体下字符串的宽度
     *
     * @param string $text 要测量的文本
     * @param int $fontSize 字体大小（像素）
     * @return int 文本宽度（像素）
     */
    public static function measureText(string $text, int $fontSize): int
    {
        return self::ffi()->MeasureText($text, $fontSize);
    }

    /**
     * 测量指定字体下字符串的大小
     *
     * @param \FFI\CData $font 使用的字体
     * @param string $text 要测量的文本
     * @param float $fontSize 字体大小（像素）
     * @param float $spacing 字符间距
     * @return \FFI\CData 包含文本宽度和高度的向量
     */
    public static function measureTextEx(\FFI\CData $font, string $text, float $fontSize, float $spacing): \FFI\CData
    {
        return self::ffi()->MeasureTextEx($font, $text, $fontSize, $spacing);
    }

    /**
     * 获取字体中代码点 (Unicode字符) 的字形索引位置，若未找到则回退到 '?'
     *
     * @param \FFI\CData $font 使用的字体
     * @param int $codepoint Unicode字符代码点
     * @return int 字形索引位置
     */
    public static function getGlyphIndex(\FFI\CData $font, int $codepoint): int
    {
        return self::ffi()->GetGlyphIndex($font, $codepoint);
    }

    /**
     * 获取字体中代码点 (Unicode字符) 的字形信息数据，若未找到则回退到 '?'
     *
     * @param \FFI\CData $font 使用的字体
     * @param int $codepoint Unicode字符代码点
     * @return \FFI\CData 字形信息
     */
    public static function getGlyphInfo(\FFI\CData $font, int $codepoint): \FFI\CData
    {
        return self::ffi()->GetGlyphInfo($font, $codepoint);
    }

    /**
     * 获取字体图集中代码点 (Unicode字符) 的字形矩形，若未找到则回退到 '?'
     *
     * @param \FFI\CData $font 使用的字体
     * @param int $codepoint Unicode字符代码点
     * @return \FFI\CData 字形在字体图集中的矩形区域
     */
    public static function getGlyphAtlasRec(\FFI\CData $font, int $codepoint): \FFI\CData
    {
        return self::ffi()->GetGlyphAtlasRec($font, $codepoint);
    }

    /**
     * 从代码点数组加载UTF-8编码的文本
     *
     * @param \FFI\CData $codepoints Unicode字符代码点数组
     * @param int $length 数组长度
     * @return string 加载的UTF-8文本
     */
    public static function loadUTF8(\FFI\CData $codepoints, int $length): string
    {
        return (string)self::ffi()->LoadUTF8($codepoints, $length);
    }

    /**
     * 卸载从代码点数组编码的UTF-8文本
     *
     * @param string $text 需要卸载的UTF-8文本
     * @return void
     */
    public static function unloadUTF8(string $text): void
    {
        self::ffi()->UnloadUTF8($text);
    }

    /**
     * 从UTF-8文本字符串加载所有代码点，代码点数量通过参数返回
     *
     * @param string $text UTF-8编码的文本
     * @param int &$count 返回代码点的数量
     * @return \FFI\CData 加载的代码点数组
     */
    public static function loadCodepoints(string $text, int &$count): \FFI\CData
    {
        return self::ffi()->LoadCodepoints($text, $count);
    }

    /**
     * 从内存中卸载代码点数据
     *
     * @param \FFI\CData $codepoints 需要卸载的代码点数组
     * @return void
     */
    public static function unloadCodepoints(\FFI\CData $codepoints): void
    {
        self::ffi()->UnloadCodepoints($codepoints);
    }

    /**
     * 获取UTF-8编码字符串中的代码点总数
     *
     * @param string $text UTF-8编码的文本
     * @return int 代码点的总数
     */
    public static function getCodepointCount(string $text): int
    {
        return self::ffi()->GetCodepointCount($text);
    }

    /**
     * 获取UTF-8编码字符串中的下一个代码点，失败时返回 0x3f('?')
     *
     * @param string $text UTF-8编码的文本
     * @param int &$codepointSize 返回当前代码点的大小（字节数）
     * @return int 下一个代码点或0x3f在失败情况下
     */
    public static function getCodepoint(string $text, int &$codepointSize): int
    {
        return self::ffi()->GetCodepoint($text, $codepointSize);
    }

    /**
     * 获取UTF-8编码字符串中的下一个代码点，失败时返回 0x3f('?')
     *
     * 注：此函数与getCodepoint功能相同。
     *
     * @param string $text UTF-8编码的文本
     * @param int &$codepointSize 返回当前代码点的大小（字节数）
     * @return int 下一个代码点或0x3f在失败情况下
     */
    public static function getCodepointNext(string $text, int &$codepointSize): int
    {
        return self::ffi()->GetCodepointNext($text, $codepointSize);
    }

    /**
     * 获取UTF-8编码字符串中的上一个代码点，失败时返回 0x3f('?')
     *
     * @param string $text UTF-8编码的文本
     * @param int &$codepointSize 返回当前代码点的大小（字节数）
     * @return int 上一个代码点或0x3f在失败情况下
     */
    public static function getCodepointPrevious(string $text, int &$codepointSize): int
    {
        return self::ffi()->GetCodepointPrevious($text, $codepointSize);
    }

    /**
     * 将一个代码点编码为UTF-8字节数组 (数组长度作为参数返回)
     *
     * @param int $codepoint 要编码的Unicode代码点
     * @param int &$utf8Size 返回生成的UTF-8字节数组的长度
     * @return string 编码后的UTF-8字节数组
     */
    public static function codepointToUTF8(int $codepoint, int &$utf8Size): string
    {
        return (string)self::ffi()->CodepointToUTF8($codepoint, $utf8Size);
    }

    /**
     * 将一个字符串复制到另一个字符串，返回复制的字节数
     *
     * @param string &$dst 目标字符串缓冲区
     * @param string $src 源字符串
     * @return int 复制的字节数
     */
    public static function textCopy(string &$dst, string $src): int
    {
        return self::ffi()->TextCopy($dst, $src);
    }

    /**
     * 检查两个文本字符串是否相等
     *
     * @param string $text1 第一个文本字符串
     * @param string $text2 第二个文本字符串
     * @return bool 如果两个字符串内容相同则返回true，否则返回false
     */
    public static function textIsEqual(string $text1, string $text2): bool
    {
        return self::ffi()->TextIsEqual($text1, $text2);
    }

    /**
     * 获取文本长度，检查 '\0' 结尾
     *
     * @param string $text 要测量长度的文本
     * @return int 文本的长度（不包括终止空字符）
     */
    public static function textLength(string $text): int
    {
        return self::ffi()->TextLength($text);
    }

    /**
     * 用变量进行文本格式化 (sprintf() 风格)
     *
     * @param string $text 格式化的模板字符串
     * @param mixed ...$args 可变参数列表
     * @return string 格式化后的文本字符串
     */
    public static function textFormat(string $text, ...$args): string
    {
        return vsprintf($text, $args); // 使用PHP的vsprintf代替C的TextFormat
    }

    /**
     * 获取文本字符串的一部分
     *
     * @param string $text 原始文本
     * @param int $position 开始位置
     * @param int $length 子串长度
     * @return string 子串
     */
    public static function textSubtext(string $text, int $position, int $length): string
    {
        return substr($text, $position, $length); // 使用PHP的substr代替C的TextSubtext
    }

    /**
     * 替换文本字符串 (警告: 必须释放内存!)
     *
     * @param string $text 原始文本
     * @param string $replace 要替换的子串
     * @param string $by 替换为的子串
     * @return string 替换后的新文本字符串
     */
    public static function textReplace(string $text, string $replace, string $by): string
    {
        return str_replace($replace, $by, $text); // 使用PHP的str_replace代替C的TextReplace
    }

    /**
     * 在指定位置插入文本 (警告: 必须释放内存!)
     *
     * @param string $text 原始文本
     * @param string $insert 要插入的文本
     * @param int $position 插入的位置
     * @return string 插入文本后的新字符串
     */
    public static function textInsert(string $text, string $insert, int $position): string
    {
        return substr_replace($text, $insert, $position, 0); // 使用PHP的substr_replace代替C的TextInsert
    }

    /**
     * 用分隔符连接文本字符串
     *
     * @param array $textList 文本字符串数组
     * @param string $delimiter 分隔符
     * @return string 连接后的文本字符串
     */
    public static function textJoin(array $textList, string $delimiter): string
    {
        return implode($delimiter, $textList); // 使用PHP的implode代替C的TextJoin
    }

    /**
     * 将文本拆分为多个字符串
     *
     * @param string $text 要拆分的文本
     * @param string $delimiter 用于拆分文本的分隔符
     * @param int &$count 返回分割后的字符串数量
     * @return array 拆分后的字符串数组
     */
    public static function textSplit(string $text, string $delimiter, int &$count): array
    {
        $result = explode($delimiter, $text, -1, $count); // 使用PHP的explode代替C的TextSplit
        $count = count($result);
        return $result;
    }

    /**
     * 在特定位置追加文本并移动光标!
     *
     * @param string &$text 目标文本字符串
     * @param string $append 要追加的文本
     * @param int &$position 光标位置指针
     * @return void
     */
    public static function textAppend(string &$text, string $append, int &$position): void
    {
        $text .= substr($append, $position);
        $position += strlen($append);
    }

    /**
     * 在字符串中查找第一个文本出现的位置
     *
     * @param string $text 源字符串
     * @param string $find 要查找的子串
     * @return int 找到的第一个匹配项的位置，如果未找到则返回-1
     */
    public static function textFindIndex(string $text, string $find): int
    {
        return strpos($text, $find) !== false ? strpos($text, $find) : -1; // 使用PHP的strpos代替C的TextFindIndex
    }

    /**
     * 获取提供字符串的大写版本
     *
     * @param string $text 要转换为大写的源字符串
     * @return string 大写版本的字符串
     */
    public static function textToUpper(string $text): string
    {
        return strtoupper($text); // 使用PHP的strtoupper代替C的TextToUpper
    }

    /**
     * 获取提供字符串的小写版本
     *
     * @param string $text 要转换为小写的源字符串
     * @return string 小写版本的字符串
     */
    public static function textToLower(string $text): string
    {
        return strtolower($text); // 使用PHP的strtolower代替C的TextToLower
    }

    /**
     * 获取提供字符串的帕斯卡命名法版本
     *
     * @param string $text 要转换的源字符串
     * @return string 帕斯卡命名法版本的字符串
     */
    public static function textToPascal(string $text): string
    {
        return ucfirst(preg_replace('/\s+/', '', ucwords($text))); // 使用PHP的ucfirst和preg_replace代替C的TextToPascal
    }

    /**
     * 获取提供字符串的蛇形命名法版本
     *
     * @param string $text 要转换的源字符串
     * @return string 蛇形命名法版本的字符串
     */
    public static function textToSnake(string $text): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $text)); // 使用PHP的preg_replace和strtolower代替C的TextToSnake
    }

    /**
     * 获取提供字符串的驼峰命名法版本
     *
     * @param string $text 要转换的源字符串
     * @return string 驼峰命名法版本的字符串
     */
    public static function textToCamel(string $text): string
    {
        return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $text)))); // 使用PHP的lcfirst和str_replace代替C的TextToCamel
    }

    /**
     * 从文本中获取整数值 (不支持负值)
     *
     * @param string $text 包含数字的文本
     * @return int 提取的整数值
     */
    public static function textToInteger(string $text): int
    {
        return intval(preg_replace('/[^0-9]/', '', $text)); // 使用PHP的intval和preg_replace代替C的TextToInteger
    }

    /**
     * 从文本中获取浮点数值 (不支持负值)
     *
     * @param string $text 包含数字的文本
     * @return float 提取的浮点数值
     */
    public static function textToFloat(string $text): float
    {
        return floatval(preg_replace('/[^0-9.]/', '', $text)); // 使用PHP的floatval和preg_replace代替C的TextToFloat
    }
}
