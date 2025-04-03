<?php
// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib;

/**
 * Textures类
 */
class Textures extends Base
{
    //### 图像加载函数
    //> 注意：这些函数不需要GPU访问

    /**
     * 从文件加载图像到CPU内存(RAM)
     *
     * @param string $fileName 文件名
     * @return \FFI\CData 返回Image对象
     */
    public static function loadImage(string $fileName): \FFI\CData
    {
        return self::ffi()->LoadImage($fileName);
    }

    /**
     * 从RAW文件数据加载图像
     *
     * @param string $fileName 文件名
     * @param int $width 宽度
     * @param int $height 高度
     * @param int $format 格式
     * @param int $headerSize 头部大小
     * @return \FFI\CData 返回Image对象
     */
    public static function loadImageRaw(string $fileName, int $width, int $height, int $format, int $headerSize): \FFI\CData
    {
        return self::ffi()->LoadImageRaw($fileName, $width, $height, $format, $headerSize);
    }

    /**
     * 从文件加载图像序列(帧数据追加到image.data)
     *
     * @param string $fileName 文件名
     * @param int &$frames 帧数引用
     * @return \FFI\CData 返回Image对象
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
     * @return \FFI\CData 返回Image对象
     */
    public static function loadImageAnimFromMemory(string $fileType, string $fileData, int $dataSize, int &$frames): \FFI\CData
    {
        return self::ffi()->LoadImageAnimFromMemory($fileType, $fileData, $dataSize, $frames);
    }

    /**
     * 从内存缓冲区加载图像(fileType指扩展名如.png)
     *
     * @param string $fileType 文件类型
     * @param string $fileData 文件数据
     * @param int $dataSize 数据大小
     * @return \FFI\CData 返回Image对象
     */
    public static function loadImageFromMemory(string $fileType, string $fileData, int $dataSize): \FFI\CData
    {
        return self::ffi()->LoadImageFromMemory($fileType, $fileData, $dataSize);
    }

    /**
     * 从GPU纹理数据加载图像
     *
     * @param \FFI\CData $texture Texture2D对象
     * @return \FFI\CData 返回Image对象
     */
    public static function loadImageFromTexture(\FFI\CData $texture): \FFI\CData
    {
        return self::ffi()->LoadImageFromTexture($texture);
    }

    /**
     * 从屏幕缓冲区加载图像(截图)
     *
     * @return \FFI\CData 返回Image对象
     */
    public static function loadImageFromScreen(): \FFI\CData
    {
        return self::ffi()->LoadImageFromScreen();
    }

    /**
     * 检查图像是否有效(数据和参数)
     *
     * @param \FFI\CData $image Image对象
     * @return bool 返回图像是否有效
     */
    public static function isImageValid(\FFI\CData $image): bool
    {
        return self::ffi()->IsImageValid($image);
    }

    /**
     * 从CPU内存卸载图像
     *
     * @param \FFI\CData $image Image对象
     * @return void
     */
    public static function unloadImage(\FFI\CData $image): void
    {
        self::ffi()->UnloadImage($image);
    }

    /**
     * 导出图像数据到文件，成功返回true
     *
     * @param \FFI\CData $image Image对象
     * @param string $fileName 文件名
     * @return bool 成功返回true
     */
    public static function exportImage(\FFI\CData $image, string $fileName): bool
    {
        return self::ffi()->ExportImage($image, $fileName);
    }

    /**
     * 导出图像到内存缓冲区
     *
     * @param \FFI\CData $image Image对象
     * @param string $fileType 文件类型
     * @param int &$fileSize 文件大小引用
     * @return string 返回导出的数据
     */
    public static function exportImageToMemory(\FFI\CData $image, string $fileType, int &$fileSize): string
    {
        return self::ffi()->ExportImageToMemory($image, $fileType, $fileSize);
    }

    /**
     * 将图像导出为字节数组代码文件，成功返回true
     *
     * @param \FFI\CData $image Image对象
     * @param string $fileName 文件名
     * @return bool 成功返回true
     */
    public static function exportImageAsCode(\FFI\CData $image, string $fileName): bool
    {
        return self::ffi()->ExportImageAsCode($image, $fileName);
    }

    //### 图像生成函数

    /**
     * 生成纯色图像
     *
     * @param int $width 宽度
     * @param int $height 高度
     * @param \FFI\CData $color 颜色
     * @return \FFI\CData 返回Image对象
     */
    public static function genImageColor(int $width, int $height, \FFI\CData $color): \FFI\CData
    {
        return self::ffi()->GenImageColor($width, $height, $color);
    }

    /**
     * 生成线性渐变图像(方向0-360度，0=垂直渐变)
     *
     * @param int $width 宽度
     * @param int $height 高度
     * @param int $direction 方向（角度）
     * @param \FFI\CData $start 起始颜色
     * @param \FFI\CData $end 结束颜色
     * @return \FFI\CData 返回Image对象
     */
    public static function genImageGradientLinear(int $width, int $height, int $direction, \FFI\CData $start, \FFI\CData $end): \FFI\CData
    {
        return self::ffi()->GenImageGradientLinear($width, $height, $direction, $start, $end);
    }

    /**
     * 生成径向渐变图像
     *
     * @param int $width 宽度
     * @param int $height 高度
     * @param float $density 密度
     * @param \FFI\CData $inner 内部颜色
     * @param \FFI\CData $outer 外部颜色
     * @return \FFI\CData 返回Image对象
     */
    public static function genImageGradientRadial(int $width, int $height, float $density, \FFI\CData $inner, \FFI\CData $outer): \FFI\CData
    {
        return self::ffi()->GenImageGradientRadial($width, $height, $density, $inner, $outer);
    }

    /**
     * 生成方形渐变图像
     *
     * @param int $width 宽度
     * @param int $height 高度
     * @param float $density 密度
     * @param \FFI\CData $inner 内部颜色
     * @param \FFI\CData $outer 外部颜色
     * @return \FFI\CData 返回Image对象
     */
    public static function genImageGradientSquare(int $width, int $height, float $density, \FFI\CData $inner, \FFI\CData $outer): \FFI\CData
    {
        return self::ffi()->GenImageGradientSquare($width, $height, $density, $inner, $outer);
    }

    /**
     * 生成棋盘格图像
     *
     * @param int $width 宽度
     * @param int $height 高度
     * @param int $checksX X轴检查数
     * @param int $checksY Y轴检查数
     * @param \FFI\CData $col1 颜色1
     * @param \FFI\CData $col2 颜色2
     * @return \FFI\CData 返回Image对象
     */
    public static function genImageChecked(int $width, int $height, int $checksX, int $checksY, \FFI\CData $col1, \FFI\CData $col2): \FFI\CData
    {
        return self::ffi()->GenImageChecked($width, $height, $checksX, $checksY, $col1, $col2);
    }

    /**
     * 生成白噪点图像
     *
     * @param int $width 宽度
     * @param int $height 高度
     * @param float $factor 因子
     * @return \FFI\CData 返回Image对象
     */
    public static function genImageWhiteNoise(int $width, int $height, float $factor): \FFI\CData
    {
        return self::ffi()->GenImageWhiteNoise($width, $height, $factor);
    }

    /**
     * 生成Perlin噪声图像
     *
     * @param int $width 宽度
     * @param int $height 高度
     * @param int $offsetX X轴偏移
     * @param int $offsetY Y轴偏移
     * @param float $scale 比例
     * @return \FFI\CData 返回Image对象
     */
    public static function genImagePerlinNoise(int $width, int $height, int $offsetX, int $offsetY, float $scale): \FFI\CData
    {
        return self::ffi()->GenImagePerlinNoise($width, $height, $offsetX, $offsetY, $scale);
    }

    /**
     * 生成细胞自动机图像(瓦片尺寸越大细胞越大)
     *
     * @param int $width 宽度
     * @param int $height 高度
     * @param int $tileSize 瓦片大小
     * @return \FFI\CData 返回Image对象
     */
    public static function genImageCellular(int $width, int $height, int $tileSize): \FFI\CData
    {
        return self::ffi()->GenImageCellular($width, $height, $tileSize);
    }

    /**
     * 从文本生成灰度图像
     *
     * @param int $width 宽度
     * @param int $height 高度
     * @param string $text 文本
     * @return \FFI\CData 返回Image对象
     */
    public static function genImageText(int $width, int $height, string $text): \FFI\CData
    {
        return self::ffi()->GenImageText($width, $height, $text);
    }

    //### 图像处理函数

    /**
     * 创建图像副本(用于变换操作)
     *
     * @param \FFI\CData $image Image对象
     * @return \FFI\CData 返回Image对象副本
     */
    public static function imageCopy(\FFI\CData $image): \FFI\CData
    {
        return self::ffi()->ImageCopy($image);
    }

    /**
     * 从图像中截取区域创建新图像
     *
     * @param \FFI\CData $image Image对象
     * @param \FFI\CData $rec Rectangle对象
     * @return \FFI\CData 返回新Image对象
     */
    public static function imageFromImage(\FFI\CData $image, \FFI\CData $rec): \FFI\CData
    {
        return self::ffi()->ImageFromImage($image, $rec);
    }

    /**
     * 从指定通道创建灰度图像
     *
     * @param \FFI\CData $image Image对象
     * * @param int $selectedChannel 选择的通道
     * @return \FFI\CData 返回新Image对象
     */
    public static function imageFromChannel(\FFI\CData $image, int $selectedChannel): \FFI\CData
    {
        return self::ffi()->ImageFromChannel($image, $selectedChannel);
    }

    /**
     * 使用默认字体生成文本图像
     *
     * @param string $text 文本
     * @param int $fontSize 字体大小
     * @param \FFI\CData $color 颜色
     * @return \FFI\CData 返回Image对象
     */
    public static function imageText(string $text, int $fontSize, \FFI\CData $color): \FFI\CData
    {
        return self::ffi()->ImageText($text, $fontSize, $color);
    }

    /**
     * 使用自定义字体生成文本图像
     *
     * @param \FFI\CData $font Font对象
     * @param string $text 文本
     * @param float $fontSize 字体大小
     * @param float $spacing 字间距
     * @param \FFI\CData $tint 色调
     * @return \FFI\CData 返回Image对象
     */
    public static function imageTextEx(\FFI\CData $font, string $text, float $fontSize, float $spacing, \FFI\CData $tint): \FFI\CData
    {
        return self::ffi()->ImageTextEx($font, $text, $fontSize, $spacing, $tint);
    }

    /**
     * 转换图像数据到指定格式
     *
     * @param \FFI\CData &$image Image对象引用
     * @param int $newFormat 新格式
     * @return void
     */
    public static function imageFormat(\FFI\CData &$image, int $newFormat): void
    {
        self::ffi()->ImageFormat($image, $newFormat);
    }

    /**
     * 将图像转换为2的幂次方尺寸(用颜色填充)
     *
     * @param \FFI\CData &$image Image对象引用
     * @param \FFI\CData $fill 填充颜色
     * @return void
     */
    public static function imageToPOT(\FFI\CData &$image, \FFI\CData $fill): void
    {
        self::ffi()->ImageToPOT($image, $fill);
    }

    /**
     * 按矩形区域裁剪图像
     *
     * @param \FFI\CData &$image Image对象引用
     * @param \FFI\CData $crop 矩形裁剪区域
     * @return void
     */
    public static function imageCrop(\FFI\CData &$image, \FFI\CData $crop): void
    {
        self::ffi()->ImageCrop($image, $crop);
    }

    /**
     * 根据alpha通道阈值裁剪图像
     *
     * @param \FFI\CData &$image Image对象引用
     * @param float $threshold 阈值
     * @return void
     */
    public static function imageAlphaCrop(\FFI\CData &$image, float $threshold): void
    {
        self::ffi()->ImageAlphaCrop($image, $threshold);
    }

    /**
     * 用指定颜色替换低于阈值的alpha区域
     *
     * @param \FFI\CData &$image Image对象引用
     * @param \FFI\CData $color 颜色
     * @param float $threshold 阈值
     * @return void
     */
    public static function imageAlphaClear(\FFI\CData &$image, \FFI\CData $color, float $threshold): void
    {
        self::ffi()->ImageAlphaClear($image, $color, $threshold);
    }

    /**
     * 应用alpha遮罩到图像
     *
     * @param \FFI\CData &$image Image对象引用
     * @param \FFI\CData $alphaMask Alpha遮罩图像
     * @return void
     */
    public static function imageAlphaMask(\FFI\CData &$image, \FFI\CData $alphaMask): void
    {
        self::ffi()->ImageAlphaMask($image, $alphaMask);
    }

    /**
     * 预乘alpha通道
     *
     * @param \FFI\CData &$image Image对象引用
     * @return void
     */
    public static function imageAlphaPremultiply(\FFI\CData &$image): void
    {
        self::ffi()->ImageAlphaPremultiply($image);
    }

    /**
     * 应用高斯模糊(基于盒模糊近似)
     *
     * @param \FFI\CData &$image Image对象引用
     * @param int $blurSize 模糊大小
     * @return void
     */
    public static function imageBlurGaussian(\FFI\CData &$image, int $blurSize): void
    {
        self::ffi()->ImageBlurGaussian($image, $blurSize);
    }

    /**
     * 应用自定义卷积核处理图像
     *
     * @param \FFI\CData &$image Image对象引用
     * @param string $kernel 卷积核
     * @param int $kernelSize 卷积核大小
     * @return void
     */
    public static function imageKernelConvolution(\FFI\CData &$image, string $kernel, int $kernelSize): void
    {
        self::ffi()->ImageKernelConvolution($image, $kernel, $kernelSize);
    }

    /**
     * 调整图像尺寸(双三次插值算法)
     *
     * @param \FFI\CData &$image Image对象引用
     * @param int $newWidth 新宽度
     * @param int $newHeight 新高度
     * @return void
     */
    public static function imageResize(\FFI\CData &$image, int $newWidth, int $newHeight): void
    {
        self::ffi()->ImageResize($image, $newWidth, $newHeight);
    }

    /**
     * 调整图像尺寸(最近邻插值算法)
     *
     * @param \FFI\CData &$image Image对象引用
     * @param int $newWidth 新宽度
     * @param int $newHeight 新高度
     * @return void
     */
    public static function imageResizeNN(\FFI\CData &$image, int $newWidth, int $newHeight): void
    {
        self::ffi()->ImageResizeNN($image, $newWidth, $newHeight);
    }

    /**
     * 调整画布尺寸并用颜色填充
     *
     * @param \FFI\CData &$image Image对象引用
     * @param int $newWidth 新宽度
     * @param int $newHeight 新高度
     * @param int $offsetX X轴偏移
     * @param int $offsetY Y轴偏移
     * @param \FFI\CData $fill 填充颜色
     * @return void
     */
    public static function imageResizeCanvas(\FFI\CData &$image, int $newWidth, int $newHeight, int $offsetX, int $offsetY, \FFI\CData $fill): void
    {
        self::ffi()->ImageResizeCanvas($image, $newWidth, $newHeight, $offsetX, $offsetY, $fill);
    }

    /**
     * 生成图像多级渐远纹理
     *
     * @param \FFI\CData &$image Image对象引用
     * @return void
     */
    public static function imageMipmaps(\FFI\CData &$image): void
    {
        self::ffi()->ImageMipmaps($image);
    }

    /**
     * 将图像颜色深度降低至16位或更低(弗洛伊德-斯坦伯格抖动)
     *
     * @param \FFI\CData &$image Image对象引用
     * @param int $rBpp 红色位深度
     * @param int $gBpp 绿色位深度
     * @param int $bBpp 蓝色位深度
     * @param int $aBpp Alpha位深度
     * @return void
     */
    public static function imageDither(\FFI\CData &$image, int $rBpp, int $gBpp, int $bBpp, int $aBpp): void
    {
        self::ffi()->ImageDither($image, $rBpp, $gBpp, $bBpp, $aBpp);
    }

    /**
     * 垂直翻转图像
     *
     * @param \FFI\CData &$image Image对象引用
     * @return void
     */
    public static function imageFlipVertical(\FFI\CData &$image): void
    {
        self::ffi()->ImageFlipVertical($image);
    }

    /**
     * 水平翻转图像
     *
     * @param \FFI\CData &$image Image对象引用
     * @return void
     */
    public static function imageFlipHorizontal(\FFI\CData &$image): void
    {
        self::ffi()->ImageFlipHorizontal($image);
    }

    /**
     * 旋转图像(-359到359度)
     *
     * @param \FFI\CData &$image Image对象引用
     * @param int $degrees 旋转角度
     * @return void
     */
    public static function imageRotate(\FFI\CData &$image, int $degrees): void
    {
        self::ffi()->ImageRotate($image, $degrees);
    }

    /**
     * 顺时针旋转90度
     *
     * @param \FFI\CData &$image Image对象引用
     * @return void
     */
    public static function imageRotateCW(\FFI\CData &$image): void
    {
        self::ffi()->ImageRotateCW($image);
    }

    /**
     * 逆时针旋转90度
     *
     * @param \FFI\CData &$image Image对象引用
     * @return void
     */
    public static function imageRotateCCW(\FFI\CData &$image): void
    {
        self::ffi()->ImageRotateCCW($image);
    }

    /**
     * 给图像着色
     *
     * @param \FFI\CData &$image Image对象引用
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function imageColorTint(\FFI\CData &$image, \FFI\CData $color): void
    {
        self::ffi()->ImageColorTint($image, $color);
    }

    /**
     * 反相图像颜色
     *
     * @param \FFI\CData &$image Image对象引用
     * @return void
     */
    public static function imageColorInvert(\FFI\CData &$image): void
    {
        self::ffi()->ImageColorInvert($image);
    }

    /**
     * 将图像转为灰度
     *
     * @param \FFI\CData &$image Image对象引用
     * @return void
     */
    public static function imageColorGrayscale(\FFI\CData &$image): void
    {
        self::ffi()->ImageColorGrayscale($image);
    }

    /**
     * 调整图像对比度(-100到100)
     *
     * @param \FFI\CData &$image Image对象引用
     * @param float $contrast 对比度值
     * @return void
     */
    public static function imageColorContrast(\FFI\CData &$image, float $contrast): void
    {
        self::ffi()->ImageColorContrast($image, $contrast);
    }

    /**
     * 调整图像亮度(-255到255)
     *
     * @param \FFI\CData &$image Image对象引用
     * @param int $brightness 亮度值
     * @return void
     */
    public static function imageColorBrightness(\FFI\CData &$image, int $brightness): void
    {
        self::ffi()->ImageColorBrightness($image, $brightness);
    }

    /**
     * 替换图像中的指定颜色
     *
     * @param \FFI\CData &$image Image对象引用
     * @param \FFI\CData $color 原始颜色
     * @param \FFI\CData $replace 新颜色
     * @return void
     */
    public static function imageColorReplace(\FFI\CData &$image, \FFI\CData $color, \FFI\CData $replace): void
    {
        self::ffi()->ImageColorReplace($image, $color, $replace);
    }

    /**
     * 从图像加载颜色数组(RGBA 32位)
     *
     * @param \FFI\CData $image Image对象
     * @return \FFI\CData 返回颜色数组
     */
    public static function loadImageColors(\FFI\CData $image): \FFI\CData
    {
        return self::ffi()->LoadImageColors($image);
    }

    /**
     * 从图像加载调色板颜色数组
     *
     * @param \FFI\CData $image Image对象
     * @param int $maxPaletteSize 调色板最大尺寸
     * @param int &$colorCount 颜色数量引用
     * @return \FFI\CData 返回颜色数组
     */
    public static function loadImagePalette(\FFI\CData $image, int $maxPaletteSize, int &$colorCount): \FFI\CData
    {
        return self::ffi()->LoadImagePalette($image, $maxPaletteSize, $colorCount);
    }

    /**
     * 卸载LoadImageColors()加载的颜色数据
     *
     * @param \FFI\CData $colors 颜色数组
     * @return void
     */
    public static function unloadImageColors(\FFI\CData $colors): void
    {
        self::ffi()->UnloadImageColors($colors);
    }

    /**
     * 卸载LoadImagePalette()加载的调色板
     *
     * @param \FFI\CData $colors 调色板颜色数组
     * @return void
     */
    public static function unloadImagePalette(\FFI\CData $colors): void
    {
        self::ffi()->UnloadImagePalette($colors);
    }

    /**
     * 获取图像alpha通道边界矩形
     *
     * @param \FFI\CData $image Image对象
     * @param float $threshold 阈值
     * @return \FFI\CData 返回Rectangle对象
     */
    public static function getImageAlphaBorder(\FFI\CData $image, float $threshold): \FFI\CData
    {
        return self::ffi()->GetImageAlphaBorder($image, $threshold);
    }

    /**
     * 获取图像(x,y)位置像素颜色
     *
     * @param \FFI\CData $image Image对象
     * @param int $x X坐标
     * @param int $y Y坐标
     * @return \FFI\CData 返回Color对象
     */
    public static function getImageColor(\FFI\CData $image, int $x, int $y): \FFI\CData
    {
        return self::ffi()->GetImageColor($image, $x, $y);
    }

    //### 图像绘制函数
    //> 注意：这些是CPU软件渲染函数

    /**
     * 用指定颜色清除图像背景
     *
     * @param \FFI\CData &$dst 目标Image对象引用
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function imageClearBackground(\FFI\CData &$dst, \FFI\CData $color): void
    {
        self::ffi()->ImageClearBackground($dst, $color);
    }

    /**
     * 在图像上绘制像素
     *
     * @param \FFI\CData &$dst 目标Image对象引用
     * @param int $posX X坐标
     * @param int $posY Y坐标
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function imageDrawPixel(\FFI\CData &$dst, int $posX, int $posY, \FFI\CData $color): void
    {
        self::ffi()->ImageDrawPixel($dst, $posX, $posY, $color);
    }

    /**
     * 向量版像素绘制
     *
     * @param \FFI\CData &$dst 目标Image对象引用
     * @param \FFI\CData $position Vector2位置
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function imageDrawPixelV(\FFI\CData &$dst, \FFI\CData $position, \FFI\CData $color): void
    {
        self::ffi()->ImageDrawPixelV($dst, $position, $color);
    }

    /**
     * 在图像上绘制直线
     *
     * @param \FFI\CData &$dst 目标Image对象引用
     * @param int $startPosX 起始点X坐标
     * @param int $startPosY 起始点Y坐标
     * @param int $endPosX 结束点X坐标
     * @param int $endPosY 结束点Y坐标
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function imageDrawLine(\FFI\CData &$dst, int $startPosX, int $startPosY, int $endPosX, int $endPosY, \FFI\CData $color): void
    {
        self::ffi()->ImageDrawLine($dst, $startPosX, $startPosY, $endPosX, $endPosY, $color);
    }

    /**
     * 向量版直线绘制
     *
     * @param \FFI\CData &$dst 目标Image对象引用
     * @param \FFI\CData $start 起始Vector2位置
     * @param \FFI\CData $end 结束Vector2位置
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function imageDrawLineV(\FFI\CData &$dst, \FFI\CData $start, \FFI\CData $end, \FFI\CData $color): void
    {
        self::ffi()->ImageDrawLineV($dst, $start, $end, $color);
    }

    /**
     * 绘制带粗细的直线
     *
     * @param \FFI\CData &$dst 目标Image对象引用
     * @param \FFI\CData $start 起始Vector2位置
     * @param \FFI\CData $end 结束Vector2位置
     * @param int $thick 粗细
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function imageDrawLineEx(\FFI\CData &$dst, \FFI\CData $start, \FFI\CData $end, int $thick, \FFI\CData $color): void
    {
        self::ffi()->ImageDrawLineEx($dst, $start, $end, $thick, $color);
    }

    /**
     * 绘制实心圆
     *
     * @param \FFI\CData &$dst 目标Image对象引用
     * @param int $centerX 圆心X坐标
     * @param int $centerY 圆心Y坐标
     * @param int $radius 半径
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function imageDrawCircle(\FFI\CData &$dst, int $centerX, int $centerY, int $radius, \FFI\CData $color): void
    {
        self::ffi()->ImageDrawCircle($dst, $centerX, $centerY, $radius, $color);
    }

    /**
     * 向量版实心圆绘制
     *
     * @param \FFI\CData &$dst 目标Image对象引用
     * @param \FFI\CData $center 圆心Vector2位置
     * @param int $radius 半径
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function imageDrawCircleV(\FFI\CData &$dst, \FFI\CData $center, int $radius, \FFI\CData $color): void
    {
        self::ffi()->ImageDrawCircleV($dst, $center, $radius, $color);
    }

    /**
     * 绘制圆形轮廓
     *
     * @param \FFI\CData &$dst 目标Image对象引用
     * @param int $centerX 圆心X坐标
     * @param int $centerY 圆心Y坐标
     * @param int $radius 半径
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function imageDrawCircleLines(\FFI\CData &$dst, int $centerX, int $centerY, int $radius, \FFI\CData $color): void
    {
        self::ffi()->ImageDrawCircleLines($dst, $centerX, $centerY, $radius, $color);
    }

    /**
     * 向量版圆形轮廓绘制
     *
     * @param \FFI\CData &$dst 目标Image对象引用
     * @param \FFI\CData $center 圆心Vector2位置
     * @param int $radius 半径
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function imageDrawCircleLinesV(\FFI\CData &$dst, \FFI\CData $center, int $radius, \FFI\CData $color): void
    {
        self::ffi()->ImageDrawCircleLinesV($dst, $center, $radius, $color);
    }

    /**
     * 绘制实心矩形
     *
     * @param \FFI\CData &$dst 目标Image对象引用
     * @param int $posX X坐标
     * @param int $posY Y坐标
     * @param int $width 宽度
     * @param int $height 高度
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function imageDrawRectangle(\FFI\CData &$dst, int $posX, int $posY, int $width, int $height, \FFI\CData $color): void
    {
        self::ffi()->ImageDrawRectangle($dst, $posX, $posY, $width, $height, $color);
    }

    /**
     * 向量版矩形绘制
     *
     * @param \FFI\CData &$dst 目标Image对象引用
     * @param \FFI\CData $position Vector2位置
     * @param \FFI\CData $size Vector2大小
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function imageDrawRectangleV(\FFI\CData &$dst, \FFI\CData $position, \FFI\CData $size, \FFI\CData $color): void
    {
        self::ffi()->ImageDrawRectangleV($dst, $position, $size, $color);
    }

    /**
     * 矩形对象版绘制
     *
     * @param \FFI\CData &$dst 目标Image对象引用
     * @param \FFI\CData $rec Rectangle对象
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function imageDrawRectangleRec(\FFI\CData &$dst, \FFI\CData $rec, \FFI\CData $color): void
    {
        self::ffi()->ImageDrawRectangleRec($dst, $rec, $color);
    }

    /**
     * 绘制矩形轮廓线
     *
     * @param \FFI\CData &$dst 目标Image对象引用
     * @param \FFI\CData $rec Rectangle对象
     * @param int $thick 粗细
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function imageDrawRectangleLines(\FFI\CData &$dst, \FFI\CData $rec, int $thick, \FFI\CData $color): void
    {
        self::ffi()->ImageDrawRectangleLines($dst, $rec, $thick, $color);
    }

    /**
     * 绘制实心三角形
     *
     * @param \FFI\CData &$dst 目标Image对象引用
     * @param \FFI\CData $v1 Vector2顶点1
     * @param \FFI\CData $v2 Vector2顶点2
     * @param \FFI\CData $v3 Vector2顶点3
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function imageDrawTriangle(\FFI\CData &$dst, \FFI\CData $v1, \FFI\CData $v2, \FFI\CData $v3, \FFI\CData $color): void
    {
        self::ffi()->ImageDrawTriangle($dst, $v1, $v2, $v3, $color);
    }

    /**
     * 绘制颜色插值三角形
     *
     * @param \FFI\CData &$dst 目标Image对象引用
     * @param \FFI\CData $v1 Vector2顶点1
     * @param \FFI\CData $v2 Vector2顶点2
     * @param \FFI\CData $v3 Vector2顶点3
     * @param \FFI\CData $c1 Color顶点1颜色
     * @param \FFI\CData $c2 Color顶点2颜色
     * @param \FFI\CData $c3 Color顶点3颜色
     * @return void
     */
    public static function imageDrawTriangleEx(\FFI\CData &$dst, \FFI\CData $v1, \FFI\CData $v2, \FFI\CData $v3, \FFI\CData $c1, \FFI\CData $c2, \FFI\CData $c3): void
    {
        self::ffi()->ImageDrawTriangleEx($dst, $v1, $v2, $v3, $c1, $c2, $c3);
    }

    /**
     * 绘制三角形轮廓
     *
     * @param \FFI\CData &$dst 目标Image对象引用
     * @param \FFI\CData $v1 Vector2顶点1
     * @param \FFI\CData $v2 Vector2顶点2
     * @param \FFI\CData $v3 Vector2顶点3
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function imageDrawTriangleLines(\FFI\CData &$dst, \FFI\CData $v1, \FFI\CData $v2, \FFI\CData $v3, \FFI\CData $color): void
    {
        self::ffi()->ImageDrawTriangleLines($dst, $v1, $v2, $v3, $color);
    }

    /**
     * 绘制三角形扇
     *
     * @param \FFI\CData &$dst 目标Image对象引用
     * @param \FFI\CData $points 点数组(Vector2类型)
     * @param int $pointCount 点的数量
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function imageDrawTriangleFan(\FFI\CData &$dst, \FFI\CData $points, int $pointCount, \FFI\CData $color): void
    {
        self::ffi()->ImageDrawTriangleFan($dst, $points, $pointCount, $color);
    }

    /**
     * 绘制三角形带
     *
     * @param \FFI\CData &$dst 目标Image对象引用
     * @param \FFI\CData $points 点数组(Vector2类型)
     * @param int $pointCount 点的数量
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function imageDrawTriangleStrip(\FFI\CData &$dst, \FFI\CData $points, int $pointCount, \FFI\CData $color): void
    {
        self::ffi()->ImageDrawTriangleStrip($dst, $points, $pointCount, $color);
    }

    /**
     * 在目标图像上绘制源图像区域(应用色调)
     *
     * @param \FFI\CData &$dst 目标Image对象引用
     * @param \FFI\CData $src 源Image对象
     * @param \FFI\CData $srcRec 源矩形区域
     * @param \FFI\CData $dstRec 目标矩形区域
     * @param \FFI\CData $tint 色调颜色
     * @return void
     */
    public static function imageDraw(\FFI\CData &$dst, \FFI\CData $src, \FFI\CData $srcRec, \FFI\CData $dstRec, \FFI\CData $tint): void
    {
        self::ffi()->ImageDraw($dst, $src, $srcRec, $dstRec, $tint);
    }

    /**
     * 用默认字体绘制文本到图像
     *
     * @param \FFI\CData &$dst 目标Image对象引用
     * @param string $text 文本内容
     * @param int $posX X坐标
     * @param int $posY Y坐标
     * @param int $fontSize 字体大小
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function imageDrawText(\FFI\CData &$dst, string $text, int $posX, int $posY, int $fontSize, \FFI\CData $color): void
    {
        self::ffi()->ImageDrawText($dst, $text, $posX, $posY, $fontSize, $color);
    }

    /**
     * 用自定义字体绘制文本到图像
     *
     * @param \FFI\CData &$dst 目标Image对象引用
     * @param \FFI\CData $font Font对象
     * @param string $text 文本内容
     * @param \FFI\CData $position 位置(Vector2类型)
     * @param float $fontSize 字体大小
     * @param float $spacing 字间距
     * @param \FFI\CData $tint 色调颜色
     * @return void
     */
    public static function imageDrawTextEx(\FFI\CData &$dst, \FFI\CData $font, string $text, \FFI\CData $position, float $fontSize, float $spacing, \FFI\CData $tint): void
    {
        self::ffi()->ImageDrawTextEx($dst, $font, $text, $position, $fontSize, $spacing, $tint);
    }

    //### 纹理加载函数
    //> 注意：这些函数需要GPU访问

    /**
     * 从文件加载纹理到GPU显存(VRAM)
     *
     * @param string $fileName 文件名
     * @return \FFI\CData 返回Texture2D对象
     */
    public static function loadTexture(string $fileName): \FFI\CData
    {
        return self::ffi()->LoadTexture($fileName);
    }

    /**
     * 从图像数据加载纹理
     *
     * @param \FFI\CData $image Image对象
     * @return \FFI\CData 返回Texture2D对象
     */
    public static function loadTextureFromImage(\FFI\CData $image): \FFI\CData
    {
        return self::ffi()->LoadTextureFromImage($image);
    }

    /**
     * 加载立方体贴图(支持多种布局)
     *
     * @param \FFI\CData $image Image对象
     * @param int $layout 布局类型
     * @return \FFI\CData 返回TextureCubemap对象
     */
    public static function loadTextureCubemap(\FFI\CData $image, int $layout): \FFI\CData
    {
        return self::ffi()->LoadTextureCubemap($image, $layout);
    }

    /**
     * 创建渲染纹理(帧缓冲)
     *
     * @param int $width 宽度
     * @param int $height 高度
     * @return \FFI\CData 返回RenderTexture2D对象
     */
    public static function loadRenderTexture(int $width, int $height): \FFI\CData
    {
        return self::ffi()->LoadRenderTexture($width, $height);
    }

    /**
     * 检查纹理是否有效(已加载到GPU)
     *
     * @param \FFI\CData $texture Texture2D对象
     * @return bool 是否有效
     */
    public static function isTextureValid(\FFI\CData $texture): bool
    {
        return self::ffi()->IsTextureValid($texture);
    }

    /**
     * 从GPU显存卸载纹理
     *
     * @param \FFI\CData $texture Texture2D对象
     * @return void
     */
    public static function unloadTexture(\FFI\CData $texture): void
    {
        self::ffi()->UnloadTexture($texture);
    }

    /**
     * 检查渲染纹理是否有效
     *
     * @param \FFI\CData $target RenderTexture2D对象
     * @return bool 是否有效
     */
    public static function isRenderTextureValid(\FFI\CData $target): bool
    {
        return self::ffi()->IsRenderTextureValid($target);
    }

    /**
     * 卸载渲染纹理
     *
     * @param \FFI\CData $target RenderTexture2D对象
     * @return void
     */
    public static function unloadRenderTexture(\FFI\CData $target): void
    {
        self::ffi()->UnloadRenderTexture($target);
    }

    /**
     * 更新纹理像素数据
     *
     * @param \FFI\CData $texture Texture2D对象
     * @param string $pixels 像素数据
     * @return void
     */
    public static function updateTexture(\FFI\CData $texture, string $pixels): void
    {
        self::ffi()->UpdateTexture($texture, $pixels);
    }

    /**
     * 更新纹理部分区域像素数据
     *
     * @param \FFI\CData $texture Texture2D对象
     * @param \FFI\CData $rec Rectangle对象
     * @param string $pixels 像素数据
     * @return void
     */
    public static function updateTextureRec(\FFI\CData $texture, \FFI\CData $rec, string $pixels): void
    {
        self::ffi()->UpdateTextureRec($texture, $rec, $pixels);
    }

    //### 纹理配置函数

    /**
     * 生成纹理多级渐远
     *
     * @param \FFI\CData &$texture Texture2D对象引用
     * @return void
     */
    public static function genTextureMipmaps(\FFI\CData &$texture): void
    {
        self::ffi()->GenTextureMipmaps($texture);
    }

    /**
     * 设置纹理缩放过滤模式
     *
     * @param \FFI\CData $texture Texture2D对象
     * @param int $filter 过滤模式
     * @return void
     */
    public static function setTextureFilter(\FFI\CData $texture, int $filter): void
    {
        self::ffi()->SetTextureFilter($texture, $filter);
    }

    /**
     * 设置纹理环绕模式
     *
     * @param \FFI\CData $texture Texture2D对象
     * @param int $wrap 环绕模式
     * @return void
     */
    public static function setTextureWrap(\FFI\CData $texture, int $wrap): void
    {
        self::ffi()->SetTextureWrap($texture, $wrap);
    }

    //### 纹理绘制函数

    /**
     * 绘制纹理(整数坐标)
     *
     * @param \FFI\CData $texture Texture2D对象
     * @param int $posX X坐标
     * @param int $posY Y坐标
     * @param \FFI\CData $tint 颜色
     * @return void
     */
    public static function drawTexture(\FFI\CData $texture, int $posX, int $posY, \FFI\CData $tint): void
    {
        self::ffi()->DrawTexture($texture, $posX, $posY, $tint);
    }

    /**
     * 向量版纹理绘制
     *
     * @param \FFI\CData $texture Texture2D对象
     * @param \FFI\CData $position Vector2对象
     * @param \FFI\CData $tint 颜色
     * @return void
     */
    public static function drawTextureV(\FFI\CData $texture, \FFI\CData $position, \FFI\CData $tint): void
    {
        self::ffi()->DrawTextureV($texture, $position, $tint);
    }

    /**
     * 扩展参数纹理绘制(旋转/缩放)
     *
     * @param \FFI\CData $texture Texture2D对象
     * @param \FFI\CData $position Vector2对象
     * @param float $rotation 旋转角度
     * @param float $scale 缩放比例
     * @param \FFI\CData $tint 颜色
     * @return void
     */
    public static function drawTextureEx(\FFI\CData $texture, \FFI\CData $position, float $rotation, float $scale, \FFI\CData $tint): void
    {
        self::ffi()->DrawTextureEx($texture, $position, $rotation, $scale, $tint);
    }

    /**
     * 绘制纹理指定区域
     *
     * @param \FFI\CData $texture Texture2D对象
     * @param \FFI\CData $source Rectangle对象
     * @param \FFI\CData $position Vector2对象
     * @param \FFI\CData $tint 颜色
     * @return void
     */
    public static function drawTextureRec(\FFI\CData $texture, \FFI\CData $source, \FFI\CData $position, \FFI\CData $tint): void
    {
        self::ffi()->DrawTextureRec($texture, $source, $position, $tint);
    }

    /**
     * 高级参数纹理绘制(支持旋转/原点)
     *
     * @param \FFI\CData $texture Texture2D对象
     * @param \FFI\CData $source Rectangle对象
     * @param \FFI\CData $dest Rectangle对象
     * @param \FFI\CData $origin Vector2对象
     * @param float $rotation 旋转角度
     * @param \FFI\CData $tint 颜色
     * @return void
     */
    public static function drawTexturePro(\FFI\CData $texture, \FFI\CData $source, \FFI\CData $dest, \FFI\CData $origin, float $rotation, \FFI\CData $tint): void
    {
        self::ffi()->DrawTexturePro($texture, $source, $dest, $origin, $rotation, $tint);
    }

    /**
     * 绘制支持九宫格拉伸的纹理
     *
     * @param \FFI\CData $texture Texture2D对象
     * @param \FFI\CData $nPatchInfo NPatchInfo对象
     * @param \FFI\CData $dest Rectangle对象
     * @param \FFI\CData $origin Vector2对象
     * @param float $rotation 旋转角度
     * @param \FFI\CData $tint 颜色
     * @return void
     */
    public static function drawTextureNPatch(\FFI\CData $texture, \FFI\CData $nPatchInfo, \FFI\CData $dest, \FFI\CData $origin, float $rotation, \FFI\CData $tint): void
    {
        self::ffi()->DrawTextureNPatch($texture, $nPatchInfo, $dest, $origin, $rotation, $tint);
    }

    //### 颜色/像素相关函数

    /**
     * 检查两个颜色是否相等
     *
     * @param \FFI\CData $col1 Color对象
     * @param \FFI\CData $col2 Color对象
     * @return bool 是否相等
     */
    public static function colorIsEqual(\FFI\CData $col1, \FFI\CData $col2): bool
    {
        return self::ffi()->ColorIsEqual($col1, $col2);
    }

    /**
     * 应用alpha值到颜色(0.0f到1.0f)
     *
     * @param \FFI\CData $color Color对象
     * @param float $alpha Alpha值
     * @return \FFI\CData 返回调整后的Color对象
     */
    public static function fade(\FFI\CData $color, float $alpha): \FFI\CData
    {
        return self::ffi()->Fade($color, $alpha);
    }

    /**
     * 将颜色转为十六进制值(0xRRGGBBAA)
     *
     * @param \FFI\CData $color Color对象
     * @return int 十六进制颜色值
     */
    public static function colorToInt(\FFI\CData $color): int
    {
        return self::ffi()->ColorToInt($color);
    }

    /**
     * 将颜色归一化为[0..1]范围
     *
     * @param \FFI\CData $color Color对象
     * @return \FFI\CData 返回归一化的Vector4对象
     */
    public static function colorNormalize(\FFI\CData $color): \FFI\CData
    {
        return self::ffi()->ColorNormalize($color);
    }

    /**
     * 从归一化值创建颜色
     *
     * @param \FFI\CData $normalized Vector4对象
     * @return \FFI\CData 返回Color对象
     */
    public static function colorFromNormalized(\FFI\CData $normalized): \FFI\CData
    {
        return self::ffi()->ColorFromNormalized($normalized);
    }

    /**
     * 转换颜色到HSV空间(色相0-360度，饱和度/明度0-1)
     *
     * @param \FFI\CData $color Color对象
     * @return \FFI\CData 返回Vector3对象
     */
    public static function colorToHSV(\FFI\CData $color): \FFI\CData
    {
        return self::ffi()->ColorToHSV($color);
    }

    /**
     * 从HSV值创建颜色
     *
     * @param float $hue 色相
     * @param float $saturation 饱和度
     * @param float $value 明度
     * @return \FFI\CData 返回Color对象
     */
    public static function colorFromHSV(float $hue, float $saturation, float $value): \FFI\CData
    {
        return self::ffi()->ColorFromHSV($hue, $saturation, $value);
    }

    /**
     * 颜色叠加色调
     *
     * @param \FFI\CData $color Color对象
     * @param \FFI\CData $tint 色调
     * @return \FFI\CData 返回调整后的Color对象
     */
    public static function colorTint(\FFI\CData $color, \FFI\CData $tint): \FFI\CData
    {
        return self::ffi()->ColorTint($color, $tint);
    }

    /**
     * 调整颜色亮度(-1.0f到1.0f)
     *
     * @param \FFI\CData $color Color对象
     * @param float $factor 亮度因子
     * @return \FFI\CData 返回调整后的Color对象
     */
    public static function colorBrightness(\FFI\CData $color, float $factor): \FFI\CData
    {
        return self::ffi()->ColorBrightness($color, $factor);
    }

    /**
     * 调整颜色对比度(-1.0f到1.0f)
     *
     * @param \FFI\CData $color Color对象
     * @param float $contrast 对比度值
     * @return \FFI\CData 返回调整后的Color对象
     */
    public static function colorContrast(\FFI\CData $color, float $contrast): \FFI\CData
    {
        return self::ffi()->ColorContrast($color, $contrast);
    }

    /**
     * 设置颜色透明度
     *
     * @param \FFI\CData $color Color对象
     * @param float $alpha Alpha值
     * @return \FFI\CData 返回调整后的Color对象
     */
    public static function colorAlpha(\FFI\CData $color, float $alpha): \FFI\CData
    {
        return self::ffi()->ColorAlpha($color, $alpha);
    }

    /**
     * 源颜色与目标颜色alpha混合
     *
     * @param \FFI\CData $dst 目标颜色
     * @param \FFI\CData $src 源颜色
     * @param \FFI\CData $tint 色调
     * @return \FFI\CData 返回混合后的Color对象
     */
    public static function colorAlphaBlend(\FFI\CData $dst, \FFI\CData $src, \FFI\CData $tint): \FFI\CData
    {
        return self::ffi()->ColorAlphaBlend($dst, $src, $tint);
    }

    /**
     * 颜色线性插值(插值因子0.0f-1.0f)
     *
     * @param \FFI\CData $color1 颜色1
     * @param \FFI\CData $color2 颜色2
     * @param float $factor 插值因子
     * @return \FFI\CData 返回插值后的Color对象
     */
    public static function colorLerp(\FFI\CData $color1, \FFI\CData $color2, float $factor): \FFI\CData
    {
        return self::ffi()->ColorLerp($color1, $color2, $factor);
    }

    /**
     * 从十六进制值获取颜色
     *
     * @param int $hexValue 十六进制颜色值
     * @return \FFI\CData 返回Color对象
     */
    public static function getColor(int $hexValue): \FFI\CData
    {
        return self::ffi()->GetColor($hexValue);
    }

    /**
     * 从指定格式的像素指针获取颜色
     *
     * @param string $srcPtr 像素数据指针
     * @param int $format 像素格式
     * @return \FFI\CData 返回Color对象
     */
    public static function getPixelColor(string $srcPtr, int $format): \FFI\CData
    {
        return self::ffi()->GetPixelColor($srcPtr, $format);
    }

    /**
     * 将颜色设置到指定格式的像素指针
     *
     * @param string $dstPtr 像素数据指针
     * @param \FFI\CData $color Color对象
     * @param int $format 像素格式
     * @return void
     */
    public static function setPixelColor(string $dstPtr, \FFI\CData $color, int $format): void
    {
        self::ffi()->SetPixelColor($dstPtr, $color, $format);
    }

    /**
     * 计算指定格式的像素数据大小(字节)
     *
     * @param int $width 宽度
     * @param int $height 高度
     * @param int $format 像素格式
     * @return int 像素数据大小（字节）
     */
    public static function getPixelDataSize(int $width, int $height, int $format): int
    {
        return self::ffi()->GetPixelDataSize($width, $height, $format);
    }
}
