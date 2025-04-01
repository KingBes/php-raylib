<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib;

/**
 * 图形类
 */
class Texture extends Base
{
    /**
     * 从文件加载图像到CPU内存 (RAM)
     *
     * @param string $fileName 文件名
     * @return \FFI\CData 返回一个 Image 结构体的 CData 对象
     */
    public static function loadImage(string $fileName): \FFI\CData
    {
        return self::ffi()->LoadImage($fileName);
    }

    /**
     * 从原始文件数据加载图像
     *
     * @param string $fileName 文件名
     * @param int $width 宽度
     * @param int $height 高度
     * @param int $format 格式
     * @param int $headerSize 头大小
     * @return \FFI\CData 返回一个 Image 结构体的 CData 对象
     */
    public static function loadImageRaw(string $fileName, int $width, int $height, int $format, int $headerSize): \FFI\CData
    {
        return self::ffi()->LoadImageRaw($fileName, $width, $height, $format, $headerSize);
    }

    /**
     * 从文件加载图像序列 (帧追加到image.data)
     *
     * @param string $fileName 文件名
     * @param int &$frames 帧数引用
     * @return \FFI\CData 返回一个 Image 结构体的 CData 对象
     */
    public static function loadImageAnim(string $fileName, int &$frames): \FFI\CData
    {
        return self::ffi()->LoadImageAnim($fileName, $frames);
    }

    /**
     * 从内存缓冲区加载图像序列
     *
     * @param string $fileType 文件类型
     * @param string $fileData 文件数据
     * @param int $dataSize 数据大小
     * @param int &$frames 帧数引用
     * @return \FFI\CData 返回一个 Image 结构体的 CData 对象
     */
    public static function loadImageAnimFromMemory(string $fileType, string $fileData, int $dataSize, int &$frames): \FFI\CData
    {
        return self::ffi()->LoadImageAnimFromMemory($fileType, $fileData, $dataSize, $frames);
    }

    /**
     * 从内存缓冲区加载图像，fileType指文件扩展名，例如: '.png'
     *
     * @param string $fileType 文件类型
     * @param string $fileData 文件数据
     * @param int $dataSize 数据大小
     * @return \FFI\CData 返回一个 Image 结构体的 CData 对象
     */
    public static function loadImageFromMemory(string $fileType, string $fileData, int $dataSize): \FFI\CData
    {
        return self::ffi()->LoadImageFromMemory($fileType, $fileData, $dataSize);
    }

    /**
     * 从GPU纹理数据加载图像
     *
     * @param \FFI\CData $texture Texture2D 纹理
     * @return \FFI\CData 返回一个 Image 结构体的 CData 对象
     */
    public static function loadImageFromTexture(\FFI\CData $texture): \FFI\CData
    {
        return self::ffi()->LoadImageFromTexture($texture);
    }

    /**
     * 从屏幕缓冲区加载图像 (截图)
     *
     * @return \FFI\CData 返回一个 Image 结构体的 CData 对象
     */
    public static function loadImageFromScreen(): \FFI\CData
    {
        return self::ffi()->LoadImageFromScreen();
    }

    /**
     * 检查图像是否有效 (数据和参数)
     *
     * @param \FFI\CData $image 图像
     * @return bool
     */
    public static function isImageValid(\FFI\CData $image): bool
    {
        return self::ffi()->IsImageValid($image);
    }

    /**
     * 从CPU内存 (RAM) 卸载图像
     *
     * @param \FFI\CData $image 图像
     */
    public static function unloadImage(\FFI\CData $image): void
    {
        self::ffi()->UnloadImage($image);
    }

    /**
     * 将图像数据导出到文件，成功返回true
     *
     * @param \FFI\CData $image 图像
     * @param string $fileName 文件名
     * @return bool
     */
    public static function exportImage(\FFI\CData $image, string $fileName): bool
    {
        return self::ffi()->ExportImage($image, $fileName);
    }

    /**
     * 将图像导出到内存缓冲区
     *
     * @param \FFI\CData $image 图像
     * @param string $fileType 文件类型
     * @param int &$fileSize 文件大小引用
     * @return string
     */
    public static function exportImageToMemory(\FFI\CData $image, string $fileType, int &$fileSize): string
    {
        return self::ffi()->ExportImageToMemory($image, $fileType, $fileSize);
    }

    /**
     * 将图像导出为定义字节数组的代码文件，成功返回true
     *
     * @param \FFI\CData $image 图像
     * @param string $fileName 文件名
     * @return bool
     */
    public static function exportImageAsCode(\FFI\CData $image, string $fileName): bool
    {
        return self::ffi()->ExportImageAsCode($image, $fileName);
    }

    /**
     * 生成图像: 纯色
     *
     * @param int $width 宽度
     * @param int $height 高度
     * @param \FFI\CData $color Color 颜色
     * @return \FFI\CData 返回一个 Image 结构体的 CData 对象
     */
    public static function genImageColor(int $width, int $height, \FFI\CData $color): \FFI\CData
    {
        return self::ffi()->GenImageColor($width, $height, $color);
    }

    /**
     * 生成图像: 线性渐变，方向为度数 [0..360]，0=垂直渐变
     *
     * @param int $width 宽度
     * @param int $height 高度
     * @param int $direction 方向
     * @param \FFI\CData $start 开始颜色
     * @param \FFI\CData $end 结束颜色
     * @return \FFI\CData 返回一个 Image 结构体的 CData 对象
     */
    public static function genImageGradientLinear(int $width, int $height, int $direction, \FFI\CData $start, \FFI\CData $end): \FFI\CData
    {
        return self::ffi()->GenImageGradientLinear($width, $height, $direction, $start, $end);
    }

    /**
     * 生成图像: 径向渐变
     *
     * @param int $width 宽度
     * @param int $height 高度
     * @param float $density 密度
     * @param \FFI\CData $inner 内部颜色
     * @param \FFI\CData $outer 外部颜色
     * @return \FFI\CData 返回一个 Image 结构体的 CData 对象
     */
    public static function genImageGradientRadial(int $width, int $height, float $density, \FFI\CData $inner, \FFI\CData $outer): \FFI\CData
    {
        return self::ffi()->GenImageGradientRadial($width, $height, $density, $inner, $outer);
    }

    /**
     * 生成图像: 方形渐变
     *
     * @param int $width 宽度
     * @param int $height 高度
     * @param float $density 密度
     * @param \FFI\CData $inner 内部颜色
     * @param \FFI\CData $outer 外部颜色
     * @return \FFI\CData 返回一个 Image 结构体的 CData 对象
     */
    public static function genImageGradientSquare(int $width, int $height, float $density, \FFI\CData $inner, \FFI\CData $outer): \FFI\CData
    {
        return self::ffi()->GenImageGradientSquare($width, $height, $density, $inner, $outer);
    }

    /**
     * 生成图像: 棋盘格
     *
     * @param int $width 宽度
     * @param int $height 高度
     * @param int $checksX 检查X
     * @param int $checksY 检查Y
     * @param \FFI\CData $col1 颜色1
     * @param \FFI\CData $col2 颜色2
     * @return \FFI\CData 返回一个 Image 结构体的 CData 对象
     */
    public static function genImageChecked(int $width, int $height, int $checksX, int $checksY, \FFI\CData $col1, \FFI\CData $col2): \FFI\CData
    {
        return self::ffi()->GenImageChecked($width, $height, $checksX, $checksY, $col1, $col2);
    }

    /**
     * 生成图像: 白噪声
     *
     * @param int $width 宽度
     * @param int $height 高度
     * @param float $factor 因子
     * @return \FFI\CData 返回一个 Image 结构体的 CData 对象
     */
    public static function genImageWhiteNoise(int $width, int $height, float $factor): \FFI\CData
    {
        return self::ffi()->GenImageWhiteNoise($width, $height, $factor);
    }

    /**
     * 生成图像: 细胞算法，更大的tileSize意味着更大的细胞
     *
     * @param int $width 宽度
     * @param int $height 高度
     * @param int $tileSize 瓷砖大小
     * @return \FFI\CData 返回一个 Image 结构体的 CData 对象
     */
    public static function genImageCellular(int $width, int $height, int $tileSize): \FFI\CData
    {
        return self::ffi()->GenImageCellular($width, $height, $tileSize);
    }

    /**
     * 生成图像: 从文本数据生成灰度图像
     *
     * @param int $width 宽度
     * @param int $height 高度
     * @param string $text 文本
     * @return \FFI\CData 返回一个 Image 结构体的 CData 对象
     */
    public static function genImageText(int $width, int $height, string $text): \FFI\CData
    {
        return self::ffi()->GenImageText($width, $height, $text);
    }

    /**
     * 创建图像副本 (用于变换操作)
     *
     * @param \FFI\CData $image 图像
     * @return \FFI\CData
     */
    public static function imageCopy(\FFI\CData $image): \FFI\CData
    {
        return self::ffi()->ImageCopy($image);
    }

    /**
     * 从另一个图像的一部分创建图像
     *
     * @param \FFI\CData $image 图像
     * @param \FFI\CData $rec 矩形
     * @return \FFI\CData
     */
    public static function imageFromImage(\FFI\CData $image, \FFI\CData $rec): \FFI\CData
    {
        return self::ffi()->ImageFromImage($image, $rec);
    }

    /**
     * 从另一个图像的选定通道创建图像 (灰度图)
     *
     * @param \FFI\CData $image 图像
     * @param int $selectedChannel 选定通道
     * @return \FFI\CData
     */
    public static function imageFromChannel(\FFI\CData $image, int $selectedChannel): \FFI\CData
    {
        return self::ffi()->ImageFromChannel($image, $selectedChannel);
    }

    /**
     * 从文本创建图像 (默认字体)
     *
     * @param string $text 文本
     * @param int $fontSize 字体大小
     * @param \FFI\CData $color 颜色
     * @return \FFI\CData
     */
    public static function imageText(string $text, int $fontSize, \FFI\CData $color): \FFI\CData
    {
        return self::ffi()->ImageText($text, $fontSize, $color);
    }

    /**
     * 将图像数据转换为所需格式
     *
     * @param \FFI\CData $image 图像
     * @param int $newFormat 新格式
     * @return void
     */
    public static function imageFormat(\FFI\CData &$image, int $newFormat): void
    {
        self::ffi()->ImageFormat($image, $newFormat);
    }

    /**
     * 获取图像alpha边界矩形
     *
     * @param \FFI\CData $image 图像
     * @param float $threshold 阈值
     * @return \FFI\CData
     */
    public static function getImageAlphaBorder(\FFI\CData $image, float $threshold): \FFI\CData
    {
        return self::ffi()->GetImageAlphaBorder($image, $threshold);
    }

    /**
     * 获取图像在 (x, y) 位置的像素颜色
     *
     * @param \FFI\CData $image 图像
     * @param int $x x坐标
     * @param int $y y坐标
     * @return \FFI\CData
     */
    public static function getImageColor(\FFI\CData $image, int $x, int $y): \FFI\CData
    {
        return self::ffi()->GetImageColor($image, $x, $y);
    }

    /**
     * 用给定颜色清除图像背景
     *
     * @param \FFI\CData $dst 目标图像指针
     * @param \FFI\CData $color 要用于清除背景的颜色
     * @return void
     */
    public static function imageClearBackground(\FFI\CData &$dst, \FFI\CData $color): void
    {
        self::ffi()->ImageClearBackground($dst, $color);
    }

    /**
     * 在图像内绘制像素
     *
     * @param \FFI\CData $dst 目标图像指针
     * @param int $posX 像素的X坐标
     * @param int $posY 像素的Y坐标
     * @param \FFI\CData $color 像素的颜色
     * @return void
     */
    public static function imageDrawPixel(\FFI\CData &$dst, int $posX, int $posY, \FFI\CData $color): void
    {
        self::ffi()->ImageDrawPixel($dst, $posX, $posY, $color);
    }

    /**
     * 在图像内绘制像素 (向量版本)
     *
     * @param \FFI\CData $dst 目标图像指针
     * @param \FFI\CData $position 像素的位置向量
     * @param \FFI\CData $color 像素的颜色
     * @return void
     */
    public static function imageDrawPixelV(\FFI\CData &$dst, \FFI\CData $position, \FFI\CData $color): void
    {
        self::ffi()->ImageDrawPixelV($dst, $position, $color);
    }

    /**
     * 在图像内绘制线条
     *
     * @param \FFI\CData $dst 目标图像指针
     * @param int $startPosX 线条起点的X坐标
     * @param int $startPosY 线条起点的Y坐标
     * @param int $endPosX 线条终点的X坐标
     * @param int $endPosY 线条终点的Y坐标
     * @param \FFI\CData $color 线条的颜色
     * @return void
     */
    public static function imageDrawLine(\FFI\CData &$dst, int $startPosX, int $startPosY, int $endPosX, int $endPosY, \FFI\CData $color): void
    {
        self::ffi()->ImageDrawLine($dst, $startPosX, $startPosY, $endPosX, $endPosY, $color);
    }

    /**
     * 在图像内绘制填充的圆形
     *
     * @param \FFI\CData $dst 目标图像指针
     * @param int $centerX 圆心的X坐标
     * @param int $centerY 圆心的Y坐标
     * @param int $radius 圆形的半径
     * @param \FFI\CData $color 圆形的颜色
     * @return void
     */
    public static function imageDrawCircle(\FFI\CData &$dst, int $centerX, int $centerY, int $radius, \FFI\CData $color): void
    {
        self::ffi()->ImageDrawCircle($dst, $centerX, $centerY, $radius, $color);
    }

    /**
     * 在图像 (目标) 内绘制源图像 (对源图像应用色调)
     *
     * @param \FFI\CData $dst 目标图像指针
     * @param \FFI\CData $src 源图像
     * @param \FFI\CData $srcRec 源图像区域
     * @param \FFI\CData $dstRec 目标图像区域
     * @param \FFI\CData $tint 应用于源图像的色调
     * @return void
     */
    public static function imageDraw(\FFI\CData &$dst, \FFI\CData $src, \FFI\CData $srcRec, \FFI\CData $dstRec, \FFI\CData $tint): void
    {
        self::ffi()->ImageDraw($dst, $src, $srcRec, $dstRec, $tint);
    }

    /**
     * 在图像 (目标) 内绘制文本 (使用默认字体)
     *
     * @param \FFI\CData $dst 目标图像指针
     * @param string $text 要绘制的文本
     * @param int $posX 文本开始位置的X坐标
     * @param int $posY 文本开始位置的Y坐标
     * @param int $fontSize 字体大小
     * @param \FFI\CData $color 文本颜色
     * @return void
     */
    public static function imageDrawText(\FFI\CData &$dst, string $text, int $posX, int $posY, int $fontSize, \FFI\CData $color): void
    {
        self::ffi()->ImageDrawText($dst, $text, $posX, $posY, $fontSize, $color);
    }

    /**
     * 在图像 (目标) 内绘制文本 (自定义精灵字体)
     *
     * @param \FFI\CData $dst 目标图像指针
     * @param \FFI\CData $font 字体
     * @param string $text 要绘制的文本
     * @param \FFI\CData $position 文本位置向量
     * @param float $fontSize 字体大小
     * @param float $spacing 字符间距
     * @param \FFI\CData $tint 色调
     * @return void
     */
    public static function imageDrawTextEx(\FFI\CData &$dst, \FFI\CData $font, string $text, \FFI\CData $position, float $fontSize, float $spacing, \FFI\CData $tint): void
    {
        self::ffi()->ImageDrawTextEx($dst, $font, $text, $position, $fontSize, $spacing, $tint);
    }

    /**
     * 从文件加载纹理到GPU内存 (VRAM)
     *
     * @param string $fileName 纹理文件的路径
     * @return \FFI\CData 加载的纹理对象
     */
    public static function loadTexture(string $fileName): \FFI\CData
    {
        return self::ffi()->LoadTexture($fileName);
    }

    /**
     * 从图像数据加载纹理
     *
     * @param \FFI\CData $image 包含图像数据的Image结构体
     * @return \FFI\CData 加载的纹理对象
     */
    public static function loadTextureFromImage(\FFI\CData $image): \FFI\CData
    {
        return self::ffi()->LoadTextureFromImage($image);
    }

    /**
     * 从图像加载立方体贴图，支持多种图像立方体贴图布局
     *
     * @param \FFI\CData $image 包含图像数据的Image结构体
     * @param int $layout 立方体贴图布局类型
     * @return \FFI\CData 加载的立方体贴图对象
     */
    public static function loadTextureCubemap(\FFI\CData $image, int $layout): \FFI\CData
    {
        return self::ffi()->LoadTextureCubemap($image, $layout);
    }

    /**
     * 加载用于渲染的纹理 (帧缓冲区)
     *
     * @param int $width 渲染纹理的宽度
     * @param int $height 渲染纹理的高度
     * @return \FFI\CData 加载的渲染纹理对象
     */
    public static function loadRenderTexture(int $width, int $height): \FFI\CData
    {
        return self::ffi()->LoadRenderTexture($width, $height);
    }

    /**
     * 检查纹理是否有效 (已加载到GPU)
     *
     * @param \FFI\CData $texture 要检查的纹理对象
     * @return bool 如果纹理有效则返回true，否则返回false
     */
    public static function isTextureValid(\FFI\CData $texture): bool
    {
        return self::ffi()->IsTextureValid($texture);
    }

    /**
     * 从GPU内存 (VRAM) 卸载纹理
     *
     * @param \FFI\CData $texture 要卸载的纹理对象
     * @return void
     */
    public static function unloadTexture(\FFI\CData $texture): void
    {
        self::ffi()->UnloadTexture($texture);
    }

    /**
     * 检查渲染纹理是否有效 (已加载到GPU)
     *
     * @param \FFI\CData $target 要检查的渲染纹理对象
     * @return bool 如果渲染纹理有效则返回true，否则返回false
     */
    public static function isRenderTextureValid(\FFI\CData $target): bool
    {
        return self::ffi()->IsRenderTextureValid($target);
    }

    /**
     * 从GPU内存 (VRAM) 卸载渲染纹理
     *
     * @param \FFI\CData $target 要卸载的渲染纹理对象
     * @return void
     */
    public static function unloadRenderTexture(\FFI\CData $target): void
    {
        self::ffi()->UnloadRenderTexture($target);
    }

    /**
     * 用新数据更新GPU纹理
     *
     * @param \FFI\CData $texture 要更新的纹理对象
     * @param \FFI\CData $pixels 新像素数据指针
     * @return void
     */
    public static function updateTexture(\FFI\CData $texture, \FFI\CData $pixels): void
    {
        self::ffi()->UpdateTexture($texture, $pixels);
    }

    /**
     * 用新数据更新GPU纹理的矩形区域
     *
     * @param \FFI\CData $texture 要更新的纹理对象
     * @param \FFI\CData $rec 更新的矩形区域
     * @param \FFI\CData $pixels 新像素数据指针
     * @return void
     */
    public static function updateTextureRec(\FFI\CData $texture, \FFI\CData $rec, \FFI\CData $pixels): void
    {
        self::ffi()->UpdateTextureRec($texture, $rec, $pixels);
    }

    /**
     * 绘制一个Texture2D
     *
     * @param \FFI\CData $texture 要绘制的纹理
     * @param int $posX X轴位置
     * @param int $posY Y轴位置
     * @param \FFI\CData $tint 应用于纹理的颜色混合
     * @return void
     */
    public static function drawTexture(\FFI\CData $texture, int $posX, int $posY, \FFI\CData $tint): void
    {
        self::ffi()->DrawTexture($texture, $posX, $posY, $tint);
    }

    /**
     * 以Vector2定义的位置绘制一个Texture2D
     *
     * @param \FFI\CData $texture 要绘制的纹理
     * @param \FFI\CData $position 位置向量
     * @param \FFI\CData $tint 应用于纹理的颜色混合
     * @return void
     */
    public static function drawTextureV(\FFI\CData $texture, \FFI\CData $position, \FFI\CData $tint): void
    {
        self::ffi()->DrawTextureV($texture, $position, $tint);
    }

    /**
     * 用扩展参数绘制一个Texture2D
     *
     * @param \FFI\CData $texture 要绘制的纹理
     * @param \FFI\CData $position 位置向量
     * @param float $rotation 旋转角度（度）
     * @param float $scale 缩放比例
     * @param \FFI\CData $tint 应用于纹理的颜色混合
     * @return void
     */
    public static function drawTextureEx(\FFI\CData $texture, \FFI\CData $position, float $rotation, float $scale, \FFI\CData $tint): void
    {
        self::ffi()->DrawTextureEx($texture, $position, $rotation, $scale, $tint);
    }

    /**
     * 绘制由矩形定义的纹理的一部分
     *
     * @param \FFI\CData $texture 要绘制的纹理
     * @param \FFI\CData $source 来源矩形，定义了要绘制的纹理区域
     * @param \FFI\CData $position 位置向量
     * @param \FFI\CData $tint 应用于纹理的颜色混合
     * @return void
     */
    public static function drawTextureRec(\FFI\CData $texture, \FFI\CData $source, \FFI\CData $position, \FFI\CData $tint): void
    {
        self::ffi()->DrawTextureRec($texture, $source, $position, $tint);
    }

    /**
     * 用'pro'参数绘制由矩形定义的纹理的一部分
     *
     * @param \FFI\CData $texture 要绘制的纹理
     * @param \FFI\CData $source 来源矩形，定义了要绘制的纹理区域
     * @param \FFI\CData $dest 目标矩形，定义了在屏幕上显示的区域
     * @param \FFI\CData $origin 旋转中心点
     * @param float $rotation 旋转角度（度）
     * @param \FFI\CData $tint 应用于纹理的颜色混合
     * @return void
     */
    public static function drawTexturePro(\FFI\CData $texture, \FFI\CData $source, \FFI\CData $dest, \FFI\CData $origin, float $rotation, \FFI\CData $tint): void
    {
        self::ffi()->DrawTexturePro($texture, $source, $dest, $origin, $rotation, $tint);
    }

    /**
     * 绘制一个可以很好地拉伸或收缩的纹理（或其一部分）
     *
     * @param \FFI\CData $texture 要绘制的纹理
     * @param \FFI\CData $nPatchInfo N-Patch信息，描述如何拉伸或收缩
     * @param \FFI\CData $dest 目标矩形，定义了在屏幕上显示的区域
     * @param \FFI\CData $origin 旋转中心点
     * @param float $rotation 旋转角度（度）
     * @param \FFI\CData $tint 应用于纹理的颜色混合
     * @return void
     */
    public static function drawTextureNPatch(\FFI\CData $texture, \FFI\CData $nPatchInfo, \FFI\CData $dest, \FFI\CData $origin, float $rotation, \FFI\CData $tint): void
    {
        self::ffi()->DrawTextureNPatch($texture, $nPatchInfo, $dest, $origin, $rotation, $tint);
    }

    /**
     * 检查两种颜色是否相等
     *
     * @param \FFI\CData $col1 第一种颜色
     * @param \FFI\CData $col2 第二种颜色
     * @return bool 如果两种颜色相等则返回true，否则返回false
     */
    public static function colorIsEqual(\FFI\CData $col1, \FFI\CData $col2): bool
    {
        return self::ffi()->ColorIsEqual($col1, $col2);
    }

    /**
     * 获取应用了透明度的颜色，透明度取值范围为 0.0f 到 1.0f
     *
     * @param \FFI\CData $color 原始颜色
     * @param float $alpha 透明度值
     * @return \FFI\CData 应用了透明度后的颜色
     */
    public static function fade(\FFI\CData $color, float $alpha): \FFI\CData
    {
        return self::ffi()->Fade($color, $alpha);
    }

    /**
     * 获取颜色的十六进制值 (0xRRGGBBAA)
     *
     * @param \FFI\CData $color 颜色
     * @return int 十六进制表示的颜色值
     */
    public static function colorToInt(\FFI\CData $color): int
    {
        return self::ffi()->ColorToInt($color);
    }

    /**
     * 获取颜色归一化后的浮点值 [0..1]
     *
     * @param \FFI\CData $color 颜色
     * @return \FFI\CData 归一化后的颜色分量
     */
    public static function colorNormalize(\FFI\CData $color): \FFI\CData
    {
        return self::ffi()->ColorNormalize($color);
    }

    /**
     * 从归一化的值 [0..1] 获取颜色
     *
     * @param \FFI\CData $normalized 归一化后的颜色分量
     * @return \FFI\CData 对应的颜色
     */
    public static function colorFromNormalized(\FFI\CData $normalized): \FFI\CData
    {
        return self::ffi()->ColorFromNormalized($normalized);
    }

    /**
     * 获取颜色的 HSV 值，色调 [0..360]，饱和度/明度 [0..1]
     *
     * @param \FFI\CData $color 颜色
     * @return \FFI\CData HSV 表示的颜色值
     */
    public static function colorToHSV(\FFI\CData $color): \FFI\CData
    {
        return self::ffi()->ColorToHSV($color);
    }

    /**
     * 从 HSV 值获取颜色，色调 [0..360]，饱和度/明度 [0..1]
     *
     * @param float $hue 色调
     * @param float $saturation 饱和度
     * @param float $value 明度
     * @return \FFI\CData 对应的颜色
     */
    public static function colorFromHSV(float $hue, float $saturation, float $value): \FFI\CData
    {
        return self::ffi()->ColorFromHSV($hue, $saturation, $value);
    }

    /**
     * 获取与另一种颜色相乘后的颜色
     *
     * @param \FFI\CData $color 原始颜色
     * @param \FFI\CData $tint 相乘的颜色
     * @return \FFI\CData 相乘后的颜色
     */
    public static function colorTint(\FFI\CData $color, \FFI\CData $tint): \FFI\CData
    {
        return self::ffi()->ColorTint($color, $tint);
    }

    /**
     * 获取经过亮度校正后的颜色，亮度因子取值范围为 -1.0f 到 1.0f
     *
     * @param \FFI\CData $color 原始颜色
     * @param float $factor 亮度因子
     * @return \FFI\CData 校正后的颜色
     */
    public static function colorBrightness(\FFI\CData $color, float $factor): \FFI\CData
    {
        return self::ffi()->ColorBrightness($color, $factor);
    }

    /**
     * 获取经过对比度校正后的颜色，对比度值介于 -1.0f 和 1.0f 之间
     *
     * @param \FFI\CData $color 原始颜色
     * @param float $contrast 对比度值
     * @return \FFI\CData 校正后的颜色
     */
    public static function colorContrast(\FFI\CData $color, float $contrast): \FFI\CData
    {
        return self::ffi()->ColorContrast($color, $contrast);
    }

    /**
     * 获取应用了透明度的颜色，透明度取值范围为 0.0f 到 1.0f
     *
     * @param \FFI\CData $color 原始颜色
     * @param float $alpha 透明度值
     * @return \FFI\CData 应用了透明度后的颜色
     */
    public static function colorAlpha(\FFI\CData $color, float $alpha): \FFI\CData
    {
        return self::ffi()->ColorAlpha($color, $alpha);
    }

    /**
     * 获取源颜色以指定色调与目标颜色进行 alpha 混合后的颜色
     *
     * @param \FFI\CData $dst 目标颜色
     * @param \FFI\CData $src 源颜色
     * @param \FFI\CData $tint 色调
     * @return \FFI\CData 混合后的颜色
     */
    public static function colorAlphaBlend(\FFI\CData $dst, \FFI\CData $src, \FFI\CData $tint): \FFI\CData
    {
        return self::ffi()->ColorAlphaBlend($dst, $src, $tint);
    }

    /**
     * 获取两种颜色之间的线性插值颜色，插值因子 [0.0f..1.0f]
     *
     * @param \FFI\CData $color1 第一种颜色
     * @param \FFI\CData $color2 第二种颜色
     * @param float $factor 插值因子
     * @return \FFI\CData 线性插值后的颜色
     */
    public static function colorLerp(\FFI\CData $color1, \FFI\CData $color2, float $factor): \FFI\CData
    {
        return self::ffi()->ColorLerp($color1, $color2, $factor);
    }

    /**
     * 从十六进制值获取颜色结构体
     *
     * @param int $hexValue 十六进制颜色值
     * @return \FFI\CData 对应的颜色
     */
    public static function getColor(int $hexValue): \FFI\CData
    {
        return self::ffi()->GetColor($hexValue);
    }

    /**
     * 从特定格式的源像素指针获取颜色
     *
     * @param \FFI\CData $srcPtr 源像素指针
     * @param int $format 像素格式
     * @return \FFI\CData 获取到的颜色
     */
    public static function getPixelColor(\FFI\CData $srcPtr, int $format): \FFI\CData
    {
        return self::ffi()->GetPixelColor($srcPtr, $format);
    }

    /**
     * 将格式化后的颜色设置到目标像素指针
     *
     * @param \FFI\CData $dstPtr 目标像素指针
     * @param \FFI\CData $color 颜色
     * @param int $format 像素格式
     * @return void
     */
    public static function setPixelColor(\FFI\CData $dstPtr, \FFI\CData $color, int $format): void
    {
        self::ffi()->SetPixelColor($dstPtr, $color, $format);
    }

    /**
     * 获取特定格式的像素数据大小（以字节为单位）
     *
     * @param int $width 宽度
     * @param int $height 高度
     * @param int $format 像素格式
     * @return int 像素数据大小
     */
    public static function getPixelDataSize(int $width, int $height, int $format): int
    {
        return self::ffi()->GetPixelDataSize($width, $height, $format);
    }
}
