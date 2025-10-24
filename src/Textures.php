<?php
// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib;

use Kingbes\Raylib\Utils\Image;
use Kingbes\Raylib\Utils\Rectangle;
use Kingbes\Raylib\Utils\Color;
use Kingbes\Raylib\Utils\Vector2;
use Kingbes\Raylib\Utils\Texture;
use Kingbes\Raylib\Utils\RenderTexture;
use Kingbes\Raylib\Utils\NPatchInfo;
use Kingbes\Raylib\Utils\Font;

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
     * @return Image 返回Image对象
     */
    public static function loadImage(string $fileName): Image
    {
        $res = self::ffi()->LoadImage($fileName);
        return new Image($res);
    }

    /**
     * 从RAW文件数据加载图像
     *
     * @param string $fileName 文件名
     * @param int $width 宽度
     * @param int $height 高度
     * @param int $format 格式
     * @param int $headerSize 头部大小
     * @return Image 返回Image对象
     */
    public static function loadImageRaw(string $fileName, int $width, int $height, int $format, int $headerSize): Image
    {
        return new Image(self::ffi()->LoadImageRaw($fileName, $width, $height, $format, $headerSize));
    }

    /**
     * 从文件加载图像序列(帧数据追加到image.data)
     *
     * @param string $fileName 文件名
     * @param int &$frames 帧数引用
     * @return Image 返回Image对象
     */
    public static function loadImageAnim(string $fileName, int &$frames): Image
    {
        $c_frames = self::ffi()->new('int[1]');
        $c_frames[0] = $frames;
        $cc_frames = self::ffi()->cast('int *', $c_frames);
        $res = self::ffi()->LoadImageAnim($fileName, $cc_frames);
        $frames = $cc_frames[0];
        return new Image($res);
    }

    /**
     * 从内存缓冲区加载图像序列
     *
     * @param string $fileType 文件类型
     * @param string $fileData 文件数据
     * @param int $dataSize 数据大小
     * @param int &$frames 帧数引用
     * @return Image 返回Image对象
     */
    public static function loadImageAnimFromMemory(
        string $fileType,
        string $fileData,
        int $dataSize,
        int &$frames
    ): Image {
        $c_frames = self::ffi()->new('int[1]');
        $c_frames[0] = $frames;
        $cc_frames = self::ffi()->cast('int *', $c_frames);
        $res = self::ffi()->LoadImageAnimFromMemory($fileType, $fileData, $dataSize, $cc_frames);
        $frames = $cc_frames[0];
        return new Image($res);
    }

    /**
     * 从内存缓冲区加载图像(fileType指扩展名如.png)
     *
     * @param string $fileType 文件类型
     * @param string $fileData 文件数据
     * @param int $dataSize 数据大小
     * @return Image 返回Image对象
     */
    public static function loadImageFromMemory(string $fileType, string $fileData, int $dataSize): Image
    {
        return new Image(self::ffi()->LoadImageFromMemory($fileType, $fileData, $dataSize));
    }

    /**
     * 从GPU纹理数据加载图像
     *
     * @param Texture $texture Texture2D对象
     * @return Image 返回Image对象
     */
    public static function loadImageFromTexture(Texture $texture): Image
    {
        return new Image(self::ffi()->LoadImageFromTexture($texture->struct()));
    }

    /**
     * 从屏幕缓冲区加载图像(截图)
     *
     * @return Image 返回Image对象
     */
    public static function loadImageFromScreen(): Image
    {
        return new Image(self::ffi()->LoadImageFromScreen());
    }

    /**
     * 检查图像是否有效(数据和参数)
     *
     * @param Image $image Image对象
     * @return bool 返回图像是否有效
     */
    public static function isImageValid(Image $image): bool
    {
        return self::ffi()->IsImageValid($image->struct());
    }

    /**
     * 从CPU内存卸载图像
     *
     * @param Image $image Image对象
     * @return void
     */
    public static function unloadImage(Image $image): void
    {
        self::ffi()->UnloadImage($image->struct());
    }

    /**
     * 导出图像数据到文件，成功返回true
     *
     * @param Image $image Image对象
     * @param string $fileName 文件名
     * @return bool 成功返回true
     */
    public static function exportImage(Image $image, string $fileName): bool
    {
        return self::ffi()->ExportImage($image->struct(), $fileName);
    }

    /**
     * 导出图像到内存缓冲区
     *
     * @param Image $image Image对象
     * @param string $fileType 文件类型
     * @param int &$fileSize 文件大小引用
     * @return string 返回导出的数据
     */
    public static function exportImageToMemory(Image $image, string $fileType, int &$fileSize): string
    {
        $c_fileSize = self::ffi()->new('int[1]');
        $c_fileSize[0] = $fileSize;
        $cc_fileSize = self::ffi()->cast('int *', $c_fileSize);
        $res = self::ffi()->ExportImageToMemory($image->struct(), $fileType, $cc_fileSize);
        $fileSize = $cc_fileSize[0];
        return $res;
    }

    /**
     * 将图像导出为字节数组代码文件，成功返回true
     *
     * @param Image $image Image对象
     * @param string $fileName 文件名
     * @return bool 成功返回true
     */
    public static function exportImageAsCode(Image $image, string $fileName): bool
    {
        return self::ffi()->ExportImageAsCode($image->struct(), $fileName);
    }

    //### 图像生成函数

    /**
     * 生成纯色图像
     *
     * @param int $width 宽度
     * @param int $height 高度
     * @param Color $color 颜色
     * @return Image 返回Image对象
     */
    public static function genImageColor(int $width, int $height, Color $color): Image
    {
        return new Image(self::ffi()->GenImageColor($width, $height, $color->struct()));
    }

    /**
     * 生成线性渐变图像(方向0-360度，0=垂直渐变)
     *
     * @param int $width 宽度
     * @param int $height 高度
     * @param int $direction 方向（角度）
     * @param Color $start 起始颜色
     * @param Color $end 结束颜色
     * @return Image 返回Image对象
     */
    public static function genImageGradientLinear(int $width, int $height, int $direction, Color $start, Color $end): Image
    {
        return new Image(self::ffi()->GenImageGradientLinear($width, $height, $direction, $start->struct(), $end->struct()));
    }

    /**
     * 生成径向渐变图像
     *
     * @param int $width 宽度
     * @param int $height 高度
     * @param float $density 密度
     * @param Color $inner 内部颜色
     * @param Color $outer 外部颜色
     * @return Image 返回Image对象
     */
    public static function genImageGradientRadial(int $width, int $height, float $density, Color $inner, Color $outer): Image
    {
        return new Image(self::ffi()->GenImageGradientRadial($width, $height, $density, $inner->struct(), $outer->struct()));
    }

    /**
     * 生成方形渐变图像
     *
     * @param int $width 宽度
     * @param int $height 高度
     * @param float $density 密度
     * @param Color $inner 内部颜色
     * @param Color $outer 外部颜色
     * @return Image 返回Image对象
     */
    public static function genImageGradientSquare(int $width, int $height, float $density, Color $inner, Color $outer): Image
    {
        return new Image(self::ffi()->GenImageGradientSquare($width, $height, $density, $inner->struct(), $outer->struct()));
    }

    /**
     * 生成棋盘格图像
     *
     * @param int $width 宽度
     * @param int $height 高度
     * @param int $checksX X轴检查数
     * @param int $checksY Y轴检查数
     * @param Color $col1 颜色1
     * @param Color $col2 颜色2
     * @return Image 返回Image对象
     */
    public static function genImageChecked(int $width, int $height, int $checksX, int $checksY, Color $col1, Color $col2): Image
    {
        return new Image(self::ffi()->GenImageChecked($width, $height, $checksX, $checksY, $col1->struct(), $col2->struct()));
    }

    /**
     * 生成白噪点图像
     *
     * @param int $width 宽度
     * @param int $height 高度
     * @param float $factor 因子
     * @return Image 返回Image对象
     */
    public static function genImageWhiteNoise(int $width, int $height, float $factor): Image
    {
        return new Image(self::ffi()->GenImageWhiteNoise($width, $height, $factor));
    }

    /**
     * 生成Perlin噪声图像
     *
     * @param int $width 宽度
     * @param int $height 高度
     * @param int $offsetX X轴偏移
     * @param int $offsetY Y轴偏移
     * @param float $scale 比例
     * @return Image 返回Image对象
     */
    public static function genImagePerlinNoise(int $width, int $height, int $offsetX, int $offsetY, float $scale): Image
    {
        return new Image(self::ffi()->GenImagePerlinNoise($width, $height, $offsetX, $offsetY, $scale));
    }

    /**
     * 生成细胞自动机图像(瓦片尺寸越大细胞越大)
     *
     * @param int $width 宽度
     * @param int $height 高度
     * @param int $tileSize 瓦片大小
     * @return Image 返回Image对象
     */
    public static function genImageCellular(int $width, int $height, int $tileSize): Image
    {
        return new Image(self::ffi()->GenImageCellular($width, $height, $tileSize));
    }

    /**
     * 从文本生成灰度图像
     *
     * @param int $width 宽度
     * @param int $height 高度
     * @param string $text 文本
     * @return Image 返回Image对象
     */
    public static function genImageText(int $width, int $height, string $text): Image
    {
        return new Image(self::ffi()->GenImageText($width, $height, $text));
    }

    //### 图像处理函数

    /**
     * 创建图像副本(用于变换操作)
     *
     * @param Image $image Image对象
     * @return Image 返回Image对象副本
     */
    public static function imageCopy(Image $image): Image
    {
        return new Image(self::ffi()->ImageCopy($image->struct()));
    }

    /**
     * 从图像中截取区域创建新图像
     *
     * @param Image $image Image对象
     * @param Rectangle $rec Rectangle对象
     * @return Image 返回新Image对象
     */
    public static function imageFromImage(Image $image, Rectangle $rec): Image
    {
        return new Image(self::ffi()->ImageFromImage($image->struct(), $rec->struct()));
    }

    /**
     * 从指定通道创建灰度图像
     *
     * @param Image $image Image对象
     * @param int $selectedChannel 选择的通道
     * @return Image 返回新Image对象
     */
    public static function imageFromChannel(Image $image, int $selectedChannel): Image
    {
        return new Image(self::ffi()->ImageFromChannel($image->struct(), $selectedChannel));
    }

    /**
     * 使用默认字体生成文本图像
     *
     * @param string $text 文本
     * @param int $fontSize 字体大小
     * @param Color $color 颜色
     * @return Image 返回Image对象
     */
    public static function imageText(string $text, int $fontSize, Color $color): Image
    {
        return new Image(self::ffi()->ImageText($text, $fontSize, $color->struct()));
    }

    /**
     * 使用自定义字体生成文本图像
     *
     * @param Font $font Font对象   
     * @param string $text 文本
     * @param float $fontSize 字体大小
     * @param float $spacing 字间距
     * @param Color $tint 色调
     * @return Image 返回Image对象
     */
    public static function imageTextEx(Font $font, string $text, float $fontSize, float $spacing, Color $tint): Image
    {
        return new Image(self::ffi()->ImageTextEx($font->struct(), $text, $fontSize, $spacing, $tint->struct()));
    }

    /**
     * 转换图像数据到指定格式
     *
     * @param Image $image Image对象引用
     * @param int $newFormat 新格式
     * @return void
     */
    public static function imageFormat(Image $image, int $newFormat): void
    {
        self::ffi()->ImageFormat($image->struct(), $newFormat);
    }

    /**
     * 将图像转换为2的幂次方尺寸(用颜色填充)
     *
     * @param Image &$image Image对象引用
     * @param Color $fill 填充颜色
     * @return void
     */
    public static function imageToPOT(Image &$image, Color $fill): void
    {
        $c_image = self::ffi()->cast('Image *', $image->struct());
        self::ffi()->ImageToPOT($c_image, $fill->struct());
        $image = new Image($c_image[0]);
        unset($c_image);
    }

    /**
     * 按矩形区域裁剪图像
     *
     * @param Image &$image Image对象引用
     * @param Rectangle $crop 矩形裁剪区域
     * @return void
     */
    public static function imageCrop(Image &$image, Rectangle $crop): void
    {
        $c_image = self::ffi()->cast('Image *', $image->struct());
        self::ffi()->ImageCrop($c_image, $crop->struct());
        $image = new Image($c_image[0]);
        unset($c_image);
    }

    /**
     * 根据alpha通道阈值裁剪图像
     *
     * @param Image &$image Image对象引用
     * @param float $threshold 阈值
     * @return void
     */
    public static function imageAlphaCrop(Image &$image, float $threshold): void
    {
        $c_image = self::ffi()->cast('Image *', $image->struct());
        self::ffi()->ImageAlphaCrop($c_image, $threshold);
        $image = new Image($c_image[0]);
        unset($c_image);
    }

    /**
     * 用指定颜色替换低于阈值的alpha区域
     *
     * @param Image &$image Image对象引用
     * @param Color $color 颜色
     * @param float $threshold 阈值
     * @return void
     */
    public static function imageAlphaClear(Image &$image, Color $color, float $threshold): void
    {
        $c_image = self::ffi()->cast('Image *', $image->struct());
        self::ffi()->ImageAlphaClear($c_image, $color->struct(), $threshold);
        $image = new Image($c_image[0]);
        unset($c_image);
    }

    /**
     * 应用alpha遮罩到图像
     *
     * @param Image &$image Image对象引用
     * @param Image $alphaMask Alpha遮罩图像
     * @return void
     */
    public static function imageAlphaMask(Image &$image, Image $alphaMask): void
    {
        $c_image = self::ffi()->cast('Image *', $image->struct());
        self::ffi()->ImageAlphaMask($c_image, $alphaMask->struct());
        $image = new Image($c_image[0]);
        unset($c_image);
    }

    /**
     * 预乘alpha通道
     *
     * @param Image &$image Image对象引用
     * @return void
     */
    public static function imageAlphaPremultiply(Image &$image): void
    {
        $c_image = self::ffi()->cast('Image *', $image->struct());
        self::ffi()->ImageAlphaPremultiply($c_image);
        $image = new Image($c_image[0]);
        unset($c_image);
    }

    /**
     * 应用高斯模糊(基于盒模糊近似)
     *
     * @param Image &$image Image对象引用
     * @param int $blurSize 模糊大小
     * @return void
     */
    public static function imageBlurGaussian(Image &$image, int $blurSize): void
    {
        $c_image = self::ffi()->cast('Image *', $image->struct());
        self::ffi()->ImageBlurGaussian($c_image, $blurSize);
        $image = new Image($c_image[0]);
        unset($c_image);
    }

    /**
     * 应用自定义卷积核处理图像
     *
     * @param Image &$image Image对象引用
     * @param string $kernel 卷积核
     * @param int $kernelSize 卷积核大小
     * @return void
     */
    public static function imageKernelConvolution(Image &$image, string $kernel, int $kernelSize): void
    {
        $c_image = self::ffi()->cast('Image *', $image->struct());
        self::ffi()->ImageKernelConvolution($c_image, $kernel, $kernelSize);
        $image = new Image($c_image[0]);
        unset($c_image);
    }

    /**
     * 调整图像尺寸(双三次插值算法)
     *
     * @param Image &$image Image对象引用
     * @param int $newWidth 新宽度
     * @param int $newHeight 新高度
     * @return void
     */
    public static function imageResize(Image &$image, int $newWidth, int $newHeight): void
    {
        $c_image = self::ffi()->cast('Image *', $image->struct());
        self::ffi()->ImageResize($c_image, $newWidth, $newHeight);
        $image = new Image($c_image[0]);
        unset($c_image);
    }

    /**
     * 调整图像尺寸(最近邻插值算法)
     *
     * @param Image &$image Image对象引用
     * @param int $newWidth 新宽度
     * @param int $newHeight 新高度
     * @return void
     */
    public static function imageResizeNN(Image &$image, int $newWidth, int $newHeight): void
    {
        $c_image = self::ffi()->cast('Image *', $image->struct());
        self::ffi()->ImageResizeNN($c_image, $newWidth, $newHeight);
        $image = new Image($c_image[0]);
        unset($c_image);
    }

    /**
     * 调整画布尺寸并用颜色填充
     *
     * @param Image &$image Image对象引用
     * @param int $newWidth 新宽度
     * @param int $newHeight 新高度
     * @param int $offsetX X轴偏移
     * @param int $offsetY Y轴偏移
     * @param Color $fill 填充颜色
     * @return void
     */
    public static function imageResizeCanvas(Image &$image, int $newWidth, int $newHeight, int $offsetX, int $offsetY, Color $fill): void
    {
        $c_image = self::ffi()->cast('Image *', $image->struct());
        self::ffi()->ImageResizeCanvas($c_image, $newWidth, $newHeight, $offsetX, $offsetY, $fill->struct());
        $image = new Image($c_image[0]);
        unset($c_image);
    }

    /**
     * 生成图像多级渐远纹理
     *
     * @param Image &$image Image对象引用
     * @return void
     */
    public static function imageMipmaps(Image &$image): void
    {
        $c_image = self::ffi()->cast('Image *', $image->struct());
        self::ffi()->ImageMipmaps($c_image);
        $image = new Image($c_image[0]);
        unset($c_image);
    }

    /**
     * 将图像颜色深度降低至16位或更低(弗洛伊德-斯坦伯格抖动)
     *
     * @param Image &$image Image对象引用
     * @param int $rBpp 红色位深度
     * @param int $gBpp 绿色位深度
     * @param int $bBpp 蓝色位深度
     * @param int $aBpp Alpha位深度
     * @return void
     */
    public static function imageDither(Image &$image, int $rBpp, int $gBpp, int $bBpp, int $aBpp): void
    {
        $c_image = self::ffi()->cast('Image *', $image->struct());
        self::ffi()->ImageDither($c_image, $rBpp, $gBpp, $bBpp, $aBpp);
        $image = new Image($c_image[0]);
        unset($c_image);
    }

    /**
     * 垂直翻转图像
     *
     * @param Image &$image Image对象引用
     * @return void
     */
    public static function imageFlipVertical(Image &$image): void
    {
        $c_image = self::ffi()->cast('Image *', $image->struct());
        self::ffi()->ImageFlipVertical($c_image);
        $image = new Image($c_image[0]);
        unset($c_image);
    }

    /**
     * 水平翻转图像
     *
     * @param Image &$image Image对象引用
     * @return void
     */
    public static function imageFlipHorizontal(Image &$image): void
    {
        $c_image = self::ffi()->cast('Image *', $image->struct());
        self::ffi()->ImageFlipHorizontal($c_image);
        $image = new Image($c_image[0]);
        unset($c_image);
    }

    /**
     * 旋转图像(-359到359度)
     *
     * @param Image &$image Image对象引用
     * @param int $degrees 旋转角度
     * @return void
     */
    public static function imageRotate(Image &$image, int $degrees): void
    {
        $c_image = self::ffi()->cast('Image *', $image->struct());
        self::ffi()->ImageRotate($c_image, $degrees);
        $image = new Image($c_image[0]);
        unset($c_image);
    }

    /**
     * 顺时针旋转90度
     *
     * @param Image &$image Image对象引用
     * @return void
     */
    public static function imageRotateCW(Image &$image): void
    {
        $c_image = self::ffi()->cast('Image *', $image->struct());
        self::ffi()->ImageRotateCW($c_image);
        $image = new Image($c_image[0]);
        unset($c_image);
    }

    /**
     * 逆时针旋转90度
     *
     * @param Image &$image Image对象引用
     * @return void
     */
    public static function imageRotateCCW(Image &$image): void
    {
        $c_image = self::ffi()->cast('Image *', $image->struct());
        self::ffi()->ImageRotateCCW($c_image);
        $image = new Image($c_image[0]);
        unset($c_image);
    }

    /**
     * 给图像着色
     *
     * @param Image &$image Image对象引用
     * @param Color $color 颜色
     * @return void
     */
    public static function imageColorTint(Image &$image, Color $color): void
    {
        $c_image = self::ffi()->cast('Image *', $image->struct());
        self::ffi()->ImageColorTint($c_image, $color->struct());
        $image = new Image($c_image[0]);
        unset($c_image);
    }

    /**
     * 反相图像颜色
     *
     * @param Image &$image Image对象引用
     * @return void
     */
    public static function imageColorInvert(Image &$image): void
    {
        $c_image = self::ffi()->cast('Image *', $image->struct());
        self::ffi()->ImageColorInvert($c_image);
        $image = new Image($c_image[0]);
        unset($c_image);
    }

    /**
     * 将图像转为灰度
     *
     * @param Image &$image Image对象引用
     * @return void
     */
    public static function imageColorGrayscale(Image &$image): void
    {
        $c_image = self::ffi()->cast('Image *', $image->struct());
        self::ffi()->ImageColorGrayscale($c_image);
        $image = new Image($c_image[0]);
        unset($c_image);
    }

    /**
     * 调整图像对比度(-100到100)
     *
     * @param Image &$image Image对象引用
     * @param float $contrast 对比度值
     * @return void
     */
    public static function imageColorContrast(Image &$image, float $contrast): void
    {
        $c_image = self::ffi()->cast('Image *', $image->struct());
        self::ffi()->ImageColorContrast($c_image, $contrast);
        $image = new Image($c_image[0]);
        unset($c_image);
    }

    /**
     * 调整图像亮度(-255到255)
     *
     * @param Image &$image Image对象引用
     * @param int $brightness 亮度值
     * @return void
     */
    public static function imageColorBrightness(Image &$image, int $brightness): void
    {
        $c_image = self::ffi()->cast('Image *', $image->struct());
        self::ffi()->ImageColorBrightness($c_image, $brightness);
        $image = new Image($c_image[0]);
        unset($c_image);
    }

    /**
     * 替换图像中的指定颜色
     *
     * @param Image &$image Image对象引用
     * @param Color $color 原始颜色
     * @param Color $replace 新颜色
     * @return void
     */
    public static function imageColorReplace(Image &$image, Color $color, Color $replace): void
    {
        $c_image = self::ffi()->cast('Image *', $image->struct());
        self::ffi()->ImageColorReplace($c_image, $color->struct(), $replace->struct());
        $image = new Image($c_image[0]);
        unset($c_image);
    }

    /**
     * 从图像加载颜色数组(RGBA 32位)
     *
     * @param Image $image Image对象
     * @return Color[] 返回颜色数组
     */
    public static function loadImageColors(Image $image): array
    {
        $c_image = self::ffi()->cast('Image *', $image->struct());
        $colors = self::ffi()->LoadImageColors($c_image);
        $image = new Image($c_image[0]);
        unset($c_image);
        return $colors;
    }

    /**
     * 从图像加载调色板颜色数组
     *
     * @param Image $image Image对象
     * @param int $maxPaletteSize 调色板最大尺寸
     * @param int &$colorCount 颜色数量引用
     * @return Color[] 返回颜色数组
     */
    public static function loadImagePalette(Image $image, int $maxPaletteSize, int &$colorCount): array
    {
        $c_colorCount = self::ffi()->new('int[1]');
        $c_colorCount[0] = $colorCount;
        $cc_colorCount = self::ffi()->cast('int *', $c_colorCount);
        $colors = self::ffi()->LoadImagePalette($image->struct(), $maxPaletteSize, $cc_colorCount);
        $colorCount = $cc_colorCount[0];
        $arr = [];
        foreach ($colors as $i => $color) {
            $arr[$i] = new Color($color->r, $color->g, $color->b, $color->a);
        }
        unset($c_colorCount);
        unset($cc_colorCount);
        unset($colors);
        return $arr;
    }

    /**
     * 卸载LoadImageColors()加载的颜色数据
     *
     * @param array<int,Color> $colors 颜色数组
     * @return void
     */
    public static function unloadImageColors(array $colors): void
    {
        $c_colors = self::ffi()->new("Color[" . count($colors) . "]");
        foreach ($colors as $i => $color) {
            $c_colors[$i] = $color->struct();
        }
        self::ffi()->UnloadImageColors(self::ffi()->cast('Color *', $c_colors));
        unset($c_colors);
    }

    /**
     * 卸载LoadImagePalette()加载的调色板
     *
     * @param array<int,Color> $colors 调色板颜色数组
     * @return void
     */
    public static function unloadImagePalette(array $colors): void
    {
        $c_colors = self::ffi()->new("Color[" . count($colors) . "]");
        foreach ($colors as $i => $color) {
            $c_colors[$i] = $color->struct();
        }
        self::ffi()->UnloadImagePalette(self::ffi()->cast('Color *', $c_colors));
        unset($c_colors);
    }

    /**
     * 获取图像alpha通道边界矩形
     *
     * @param Image $image Image对象    
     * @param float $threshold 阈值
     * @return Rectangle 返回Rectangle对象
     */
    public static function getImageAlphaBorder(Image $image, float $threshold): Rectangle
    {
        $res = self::ffi()->GetImageAlphaBorder($image->struct(), $threshold);
        return new Rectangle($res->x, $res->y, $res->width, $res->height);
    }

    /**
     * 获取图像(x,y)位置像素颜色
     *
     * @param Image $image Image对象
     * @param int $x X坐标
     * @param int $y Y坐标
     * @return Color 返回Color对象
     */
    public static function getImageColor(Image $image, int $x, int $y): Color
    {
        $res = self::ffi()->GetImageColor($image->struct(), $x, $y);
        return new Color($res->r, $res->g, $res->b, $res->a);
    }

    //### 图像绘制函数
    //> 注意：这些是CPU软件渲染函数

    /**
     * 用指定颜色清除图像背景
     *
     * @param Image &$dst 目标Image对象引用
     * @param Color $color 颜色
     * @return void
     */
    public static function imageClearBackground(Image &$dst, Color $color): void
    {
        $c_dst = self::ffi()->cast('Image *', $dst->struct());
        self::ffi()->ImageClearBackground($c_dst, $color->struct());
        $dst = new Image($c_dst[0]);
        unset($c_dst);
    }

    /**
     * 在图像上绘制像素
     *
     * @param Image &$dst 目标Image对象引用
     * @param int $posX X坐标
     * @param int $posY Y坐标
     * @param Color $color 颜色
     * @return void
     */
    public static function imageDrawPixel(Image &$dst, int $posX, int $posY, Color $color): void
    {
        $c_dst = self::ffi()->cast('Image *', $dst->struct());
        self::ffi()->ImageDrawPixel($c_dst, $posX, $posY, $color->struct());
        $dst = new Image($c_dst[0]);
        unset($c_dst);
    }

    /**
     * 向量版像素绘制
     *
     * @param Image &$dst 目标Image对象引用
     * @param Vector2 $position Vector2位置
     * @param Color $color 颜色
     * @return void
     */
    public static function imageDrawPixelV(Image &$dst, Vector2 $position, Color $color): void
    {
        $c_dst = self::ffi()->cast('Image *', $dst->struct());
        self::ffi()->ImageDrawPixelV($c_dst, $position->struct(), $color->struct());
        $dst = new Image($c_dst[0]);
        unset($c_dst);
    }

    /**
     * 在图像上绘制直线
     *
     * @param Image &$dst 目标Image对象引用
     * @param int $startPosX 起始点X坐标
     * @param int $startPosY 起始点Y坐标
     * @param int $endPosX 结束点X坐标
     * @param int $endPosY 结束点Y坐标
     * @param Color $color 颜色
     * @return void
     */
    public static function imageDrawLine(Image &$dst, int $startPosX, int $startPosY, int $endPosX, int $endPosY, Color $color): void
    {
        $c_dst = self::ffi()->cast('Image *', $dst->struct());
        self::ffi()->ImageDrawLine($c_dst, $startPosX, $startPosY, $endPosX, $endPosY, $color->struct());
        $dst = new Image($c_dst[0]);
        unset($c_dst);
    }

    /**
     * 向量版直线绘制
     *
     * @param Image &$dst 目标Image对象引用
     * @param Vector2 $start 起始Vector2位置
     * @param Vector2 $end 结束Vector2位置
     * @param Color $color 颜色
     * @return void
     */
    public static function imageDrawLineV(Image &$dst, Vector2 $start, Vector2 $end, Color $color): void
    {
        $c_dst = self::ffi()->cast('Image *', $dst->struct());
        self::ffi()->ImageDrawLineV($c_dst, $start->struct(), $end->struct(), $color->struct());
        $dst = new Image($c_dst[0]);
        unset($c_dst);
    }

    /**
     * 绘制带粗细的直线
     *
     * @param Image &$dst 目标Image对象引用
     * @param Vector2 $start 起始Vector2位置
     * @param Vector2 $end 结束Vector2位置
     * @param int $thick 粗细
     * @param Color $color 颜色
     * @return void
     */
    public static function imageDrawLineEx(Image &$dst, Vector2 $start, Vector2 $end, int $thick, Color $color): void
    {
        $c_dst = self::ffi()->cast('Image *', $dst->struct());
        self::ffi()->ImageDrawLineEx($c_dst, $start->struct(), $end->struct(), $thick, $color->struct());
        $dst = new Image($c_dst[0]);
        unset($c_dst);
    }

    /**
     * 绘制实心圆
     *
     * @param Image &$dst 目标Image对象引用
     * @param int $centerX 圆心X坐标
     * @param int $centerY 圆心Y坐标
     * @param int $radius 半径
     * @param Color $color 颜色
     * @return void
     */
    public static function imageDrawCircle(Image &$dst, int $centerX, int $centerY, int $radius, Color $color): void
    {
        $c_dst = self::ffi()->cast('Image *', $dst->struct());
        self::ffi()->ImageDrawCircle($c_dst, $centerX, $centerY, $radius, $color->struct());
        $dst = new Image($c_dst[0]);
        unset($c_dst);
    }

    /**
     * 向量版实心圆绘制
     *
     * @param Image &$dst 目标Image对象引用
     * @param Vector2 $center 圆心Vector2位置
     * @param int $radius 半径
     * @param Color $color 颜色
     * @return void
     */
    public static function imageDrawCircleV(Image &$dst, Vector2 $center, int $radius, Color $color): void
    {
        $c_dst = self::ffi()->cast('Image *', $dst->struct());
        self::ffi()->ImageDrawCircleV($c_dst, $center->struct(), $radius, $color->struct());
        $dst = new Image($c_dst[0]);
        unset($c_dst);
    }

    /**
     * 绘制圆形轮廓
     *
     * @param Image &$dst 目标Image对象引用
     * @param int $centerX 圆心X坐标
     * @param int $centerY 圆心Y坐标
     * @param int $radius 半径
     * @param Color $color 颜色
     * @return void
     */
    public static function imageDrawCircleLines(Image &$dst, int $centerX, int $centerY, int $radius, Color $color): void
    {
        $c_dst = self::ffi()->cast('Image *', $dst->struct());
        self::ffi()->ImageDrawCircleLines($c_dst, $centerX, $centerY, $radius, $color->struct());
        $dst = new Image($c_dst[0]);
        unset($c_dst);
    }

    /**
     * 向量版圆形轮廓绘制
     *
     * @param Image &$dst 目标Image对象引用
     * @param Vector2 $center 圆心Vector2位置
     * @param int $radius 半径
     * @param Color $color 颜色
     * @return void
     */
    public static function imageDrawCircleLinesV(Image &$dst, Vector2 $center, int $radius, Color $color): void
    {
        $c_dst = self::ffi()->cast('Image *', $dst->struct());
        self::ffi()->ImageDrawCircleLinesV($c_dst, $center->struct(), $radius, $color->struct());
        $dst = new Image($c_dst[0]);
        unset($c_dst);
    }

    /**
     * 绘制实心矩形
     *
     * @param Image &$dst 目标Image对象引用
     * @param int $posX X坐标
     * @param int $posY Y坐标
     * @param int $width 宽度
     * @param int $height 高度
     * @param Color $color 颜色
     * @return void
     */
    public static function imageDrawRectangle(Image &$dst, int $posX, int $posY, int $width, int $height, Color $color): void
    {
        $c_dst = self::ffi()->cast('Image *', $dst->struct());
        self::ffi()->ImageDrawRectangle($c_dst, $posX, $posY, $width, $height, $color->struct());
        $dst = new Image($c_dst[0]);
        unset($c_dst);
    }

    /**
     * 向量版矩形绘制
     *
     * @param Image &$dst 目标Image对象引用
     * @param Vector2 $position Vector2位置
     * @param Vector2 $size Vector2大小
     * @param Color $color 颜色
     * @return void
     */
    public static function imageDrawRectangleV(Image &$dst, Vector2 $position, Vector2 $size, Color $color): void
    {
        $c_dst = self::ffi()->cast('Image *', $dst->struct());
        self::ffi()->ImageDrawRectangleV($c_dst, $position->struct(), $size->struct(), $color->struct());
        $dst = new Image($c_dst[0]);
        unset($c_dst);
    }

    /**
     * 矩形对象版绘制
     *
     * @param Image &$dst 目标Image对象引用
     * @param Rectangle $rec Rectangle对象
     * @param Color $color 颜色
     * @return void
     */
    public static function imageDrawRectangleRec(Image &$dst, Rectangle $rec, Color $color): void
    {
        $c_dst = self::ffi()->cast('Image *', $dst->struct());
        self::ffi()->ImageDrawRectangleRec($c_dst, $rec->struct(), $color->struct());
        $dst = new Image($c_dst[0]);
        unset($c_dst);
    }

    /**
     * 绘制矩形轮廓线
     *
     * @param Image &$dst 目标Image对象引用
     * @param Rectangle $rec Rectangle对象
     * @param int $thick 粗细
     * @param Color $color 颜色
     * @return void
     */
    public static function imageDrawRectangleLines(Image &$dst, Rectangle $rec, int $thick, Color $color): void
    {
        $c_dst = self::ffi()->cast('Image *', $dst->struct());
        self::ffi()->ImageDrawRectangleLines($c_dst, $rec->struct(), $thick, $color->struct());
        $dst = new Image($c_dst[0]);
        unset($c_dst);
    }

    /**
     * 绘制实心三角形
     *
     * @param Image &$dst 目标Image对象引用
     * @param Vector2 $v1 Vector2顶点1
     * @param Vector2 $v2 Vector2顶点2
     * @param Vector2 $v3 Vector2顶点3
     * @param Color $color 颜色
     * @return void
     */
    public static function imageDrawTriangle(Image &$dst, Vector2 $v1, Vector2 $v2, Vector2 $v3, Color $color): void
    {
        $c_dst = self::ffi()->cast('Image *', $dst->struct());
        self::ffi()->ImageDrawTriangle($c_dst, $v1->struct(), $v2->struct(), $v3->struct(), $color->struct());
        $dst = new Image($c_dst[0]);
        unset($c_dst);
    }

    /**
     * 绘制颜色插值三角形
     *
     * @param Image &$dst 目标Image对象引用
     * @param Vector2 $v1 Vector2顶点1
     * @param Vector2 $v2 Vector2顶点2
     * @param Vector2 $v3 Vector2顶点3
     * @param Color $c1 Color顶点1颜色
     * @param Color $c2 Color顶点2颜色
     * @param Color $c3 Color顶点3颜色
     * @return void
     */
    public static function imageDrawTriangleEx(Image &$dst, Vector2 $v1, Vector2 $v2, Vector2 $v3, Color $c1, Color $c2, Color $c3): void
    {
        $c_dst = self::ffi()->cast('Image *', $dst->struct());
        self::ffi()->ImageDrawTriangleEx($c_dst, $v1->struct(), $v2->struct(), $v3->struct(), $c1->struct(), $c2->struct(), $c3->struct());
        $dst = new Image($c_dst[0]);
        unset($c_dst);
    }

    /**
     * 绘制三角形轮廓
     *
     * @param Image &$dst 目标Image对象引用
     * @param Vector2 $v1 Vector2顶点1
     * @param Vector2 $v2 Vector2顶点2
     * @param Vector2 $v3 Vector2顶点3
     * @param Color $color 颜色
     * @return void
     */
    public static function imageDrawTriangleLines(Image &$dst, Vector2 $v1, Vector2 $v2, Vector2 $v3, Color $color): void
    {
        $c_dst = self::ffi()->cast('Image *', $dst->struct());
        self::ffi()->ImageDrawTriangleLines($c_dst, $v1->struct(), $v2->struct(), $v3->struct(), $color->struct());
        $dst = new Image($c_dst[0]);
        unset($c_dst);
    }

    /**
     * 绘制三角形扇
     *
     * @param Image &$dst 目标Image对象引用
     * @param Vector2[] $points 点数组(Vector2类型)
     * @param Color $color 颜色
     * @return void
     */
    public static function imageDrawTriangleFan(Image &$dst, array $points, Color $color): void
    {
        $c_dst = self::ffi()->cast('Image *', $dst->struct());
        $c_points = self::ffi()->new("Vector2[" . count($points) . "]");
        foreach ($points as $index => $point) {
            $c_points[$index] = $point->struct();
        }
        self::ffi()->ImageDrawTriangleFan($c_dst, self::ffi()->cast('Vector2 *', $c_points), count($points), $color->struct());
        $dst = new Image($c_dst[0]);
        unset($c_dst);
    }

    /**
     * 绘制三角形带
     *
     * @param Image &$dst 目标Image对象引用
     * @param Vector2[] $points 点数组(Vector2类型)
     * @param Color $color 颜色
     * @return void
     */
    public static function imageDrawTriangleStrip(Image &$dst, array $points, Color $color): void
    {
        $c_dst = self::ffi()->cast('Image *', $dst->struct());
        $c_points = self::ffi()->new("Vector2[" . count($points) . "]");
        foreach ($points as $index => $point) {
            $c_points[$index] = $point->struct();
        }
        self::ffi()->ImageDrawTriangleStrip($c_dst, self::ffi()->cast('Vector2 *', $c_points), count($points), $color->struct());
        $dst = new Image($c_dst[0]);
        unset($c_dst);
    }

    /**
     * 在目标图像上绘制源图像区域(应用色调)
     *
     * @param Image &$dst 目标Image对象引用
     * @param Image $src 源Image对象
     * @param Rectangle $srcRec 源矩形区域
     * @param Rectangle $dstRec 目标矩形区域
     * @param Color $tint 色调颜色
     * @return void
     */
    public static function imageDraw(Image &$dst, Image $src, Rectangle $srcRec, Rectangle $dstRec, Color $tint): void
    {
        $c_dst = self::ffi()->cast('Image *', $dst->struct());
        self::ffi()->ImageDraw($c_dst, $src->struct(), $srcRec->struct(), $dstRec->struct(), $tint->struct());
        $dst = new Image($c_dst[0]);
        unset($c_dst);
    }

    /**
     * 用默认字体绘制文本到图像
     *
     * @param Image &$dst 目标Image对象引用
     * @param string $text 文本内容
     * @param int $posX X坐标
     * @param int $posY Y坐标
     * @param int $fontSize 字体大小
     * @param Color $color 颜色
     * @return void
     */
    public static function imageDrawText(Image &$dst, string $text, int $posX, int $posY, int $fontSize, Color $color): void
    {
        $c_dst = self::ffi()->cast('Image *', $dst->struct());
        self::ffi()->ImageDrawText($c_dst, $text, $posX, $posY, $fontSize, $color->struct());
        $dst = new Image($c_dst[0]);
        unset($c_dst);
    }

    /**
     * 用自定义字体绘制文本到图像
     *
     * @param Image &$dst 目标Image对象引用
     * @param Font $font Font对象
     * @param string $text 文本内容
     * @param Vector2 $position 位置(Vector2类型)
     * @param float $fontSize 字体大小
     * @param float $spacing 字间距
     * @param Color $tint 色调颜色
     * @return void
     */
    public static function imageDrawTextEx(Image &$dst, Font $font, string $text, Vector2 $position, float $fontSize, float $spacing, Color $tint): void    
    {
        $c_dst = self::ffi()->cast('Image *', $dst->struct());
        self::ffi()->ImageDrawTextEx($c_dst, $font->struct(), $text, $position->struct(), $fontSize, $spacing, $tint->struct());
        $dst = new Image($c_dst[0]);
        unset($c_dst);
    }

    //### 纹理加载函数
    //> 注意：这些函数需要GPU访问

    /**
     * 从文件加载纹理到GPU显存(VRAM)
     *
     * @param string $fileName 文件名
     * @return Texture 返回Texture2D对象
     */
    public static function loadTexture(string $fileName): Texture
    {
        return new Texture(self::ffi()->LoadTexture($fileName));
    }

    /**
     * 从图像数据加载纹理
     *
     * @param Image $image Image对象
     * @return Texture 返回Texture2D对象
     */
    public static function loadTextureFromImage(Image $image): Texture
    {
        return new Texture(self::ffi()->LoadTextureFromImage($image->struct()));
    }

    /**
     * 加载立方体贴图(支持多种布局)
     *
     * @param Image $image Image对象
     * @param int $layout 布局类型
     * @return Texture 返回TextureCubemap对象
     */
    public static function loadTextureCubemap(Image $image, int $layout): Texture
    {
        return new Texture(self::ffi()->LoadTextureCubemap($image->struct(), $layout));
    }

    /**
     * 创建渲染纹理(帧缓冲)
     *
     * @param int $width 宽度
     * @param int $height 高度
     * @return RenderTexture 返回RenderTexture2D对象
     */
    public static function loadRenderTexture(int $width, int $height): RenderTexture    
    {
        return new RenderTexture(self::ffi()->LoadRenderTexture($width, $height));
    }

    /**
     * 检查纹理是否有效(已加载到GPU)
     *
     * @param Texture $texture Texture2D对象
     * @return bool 是否有效
     */
    public static function isTextureValid(Texture $texture): bool
    {
        return self::ffi()->IsTextureValid($texture->struct());
    }

    /**
     * 从GPU显存卸载纹理
     *
     * @param Texture $texture Texture2D对象
     * @return void
     */
    public static function unloadTexture(Texture $texture): void
    {
        self::ffi()->UnloadTexture($texture->struct());
    }

    /**
     * 检查渲染纹理是否有效
     *
     * @param RenderTexture $target RenderTexture2D对象
     * @return bool 是否有效
     */
    public static function isRenderTextureValid(RenderTexture $target): bool
    {
        return self::ffi()->IsRenderTextureValid($target->struct());
    }

    /**
     * 卸载渲染纹理
     *
     * @param RenderTexture $target RenderTexture2D对象
     * @return void
     */
    public static function unloadRenderTexture(RenderTexture $target): void
    {
        self::ffi()->UnloadRenderTexture($target->struct());
    }

    /**
     * 更新纹理像素数据
     *
     * @param Texture $texture Texture2D对象
     * @param string $pixels 像素数据
     * @return void
     */
    public static function updateTexture(Texture $texture, string $pixels): void
    {
        self::ffi()->UpdateTexture($texture->struct(), $pixels);
    }

    /**
     * 更新纹理部分区域像素数据
     *
     * @param Texture $texture Texture2D对象
     * @param Rectangle $rec Rectangle对象
     * @param string $pixels 像素数据
     * @return void
     */
    public static function updateTextureRec(Texture $texture, Rectangle $rec, string $pixels): void
    {
        self::ffi()->UpdateTextureRec($texture->struct(), $rec->struct(), $pixels);
    }

    //### 纹理配置函数

    /**
     * 生成纹理多级渐远
     *
     * @param Texture $texture Texture2D对象
     * @return void
     */
    public static function genTextureMipmaps(Texture $texture): void
    {
        self::ffi()->GenTextureMipmaps($texture->struct());
    }

    /**
     * 设置纹理缩放过滤模式
     *
     * @param Texture $texture Texture2D对象
     * @param int $filter 过滤模式
     * @return void
     */
    public static function setTextureFilter(Texture $texture, int $filter): void
    {
        self::ffi()->SetTextureFilter($texture->struct(), $filter);
    }

    /**
     * 设置纹理环绕模式
     *
     * @param Texture $texture Texture2D对象
     * @param int $wrap 环绕模式
     * @return void
     */
    public static function setTextureWrap(Texture $texture, int $wrap): void
    {
        self::ffi()->SetTextureWrap($texture->struct(), $wrap);
    }

    //### 纹理绘制函数

    /**
     * 绘制纹理(整数坐标)
     *
     * @param Texture $texture Texture2D对象
     * @param int $posX X坐标
     * @param int $posY Y坐标
     * @param Color $tint 颜色
     * @return void
     */
    public static function drawTexture(Texture $texture, int $posX, int $posY, Color $tint): void
    {
        self::ffi()->DrawTexture($texture->struct(), $posX, $posY, $tint->struct());
    }

    /**
     * 向量版纹理绘制
     *
     * @param Texture $texture Texture2D对象
     * @param Vector2 $position Vector2对象
     * @param Color $tint 颜色
     * @return void
     */
    public static function drawTextureV(Texture $texture, Vector2 $position, Color $tint): void
    {
        self::ffi()->DrawTextureV($texture->struct(), $position->struct(), $tint->struct());
    }

    /**
     * 扩展参数纹理绘制(旋转/缩放)
     *
     * @param Texture $texture Texture2D对象
     * @param Vector2 $position Vector2对象
     * @param float $rotation 旋转角度
     * @param float $scale 缩放比例
     * @param Color $tint 颜色
     * @return void
     */
    public static function drawTextureEx(Texture $texture, Vector2 $position, float $rotation, float $scale, Color $tint): void
    {
        self::ffi()->DrawTextureEx($texture->struct(), $position->struct(), $rotation, $scale, $tint->struct());
    }

    /**
     * 绘制纹理指定区域
     *
     * @param Texture $texture Texture2D对象
     * @param Rectangle $source Rectangle对象
     * @param Vector2 $position Vector2对象
     * @param Color $tint 颜色
     * @return void
     */
    public static function drawTextureRec(Texture $texture, Rectangle $source, Vector2 $position, Color $tint): void
    {
        self::ffi()->DrawTextureRec($texture->struct(), $source->struct(), $position->struct(), $tint->struct());
    }

    /**
     * 高级参数纹理绘制(支持旋转/原点)
     *
     * @param Texture $texture Texture2D对象
     * @param Rectangle $source Rectangle对象
     * @param Rectangle $dest Rectangle对象
     * @param Vector2 $origin Vector2对象
     * @param float $rotation 旋转角度
     * @param Color $tint 颜色
     * @return void
     */
    public static function drawTexturePro(Texture $texture, Rectangle $source, Rectangle $dest, Vector2 $origin, float $rotation, Color $tint): void
    {
        self::ffi()->DrawTexturePro($texture->struct(), $source->struct(), $dest->struct(), $origin->struct(), $rotation, $tint->struct());
    }

    /**
     * 绘制支持九宫格拉伸的纹理
     *
     * @param Texture $texture Texture2D对象
     * @param NPatchInfo $nPatchInfo NPatchInfo对象
     * @param Rectangle $dest Rectangle对象
     * @param Vector2 $origin Vector2对象
     * @param float $rotation 旋转角度
     * @param Color $tint 颜色
     * @return void
     */
    public static function drawTextureNPatch(Texture $texture, NPatchInfo $nPatchInfo, Rectangle $dest, Vector2 $origin, float $rotation, Color $tint): void
    {
        self::ffi()->DrawTextureNPatch($texture->struct(), $nPatchInfo->struct(), $dest->struct(), $origin->struct(), $rotation, $tint->struct());
    }

    //### 颜色/像素相关函数

    /**
     * 检查两个颜色是否相等
     *
     * @param Color $col1 Color对象
     * @param Color $col2 Color对象
     * @return bool 是否相等
     */
    public static function colorIsEqual(Color $col1, Color $col2): bool
    {
        return self::ffi()->ColorIsEqual($col1->struct(), $col2->struct());
    }

    /**
     * 应用alpha值到颜色(0.0f到1.0f)
     *
     * @param Color $color Color对象
     * @param float $alpha Alpha值
     * @return Color 返回调整后的Color对象
     */
    public static function fade(Color $color, float $alpha): Color
    {
        $res = self::ffi()->Fade($color->struct(), $alpha);
        return new Color($res->r, $res->g, $res->b, $res->a);
    }

    /**
     * 将颜色转为十六进制值(0xRRGGBBAA)
     *
     * @param Color $color Color对象
     * @return int 十六进制颜色值
     */
    public static function colorToInt(Color $color): int
    {
        return self::ffi()->ColorToInt($color->struct());
    }

    /**
     * 将颜色归一化为[0..1]范围
     *
     * @param Color $color Color对象
     * @return Vector4 返回归一化的Vector4对象
     */
    public static function colorNormalize(Color $color): Vector4
    {
        $res = self::ffi()->ColorNormalize($color->struct());
        return new Vector4($res->x, $res->y, $res->z, $res->w);
    }

    /**
     * 从归一化值创建颜色
     *
     * @param Vector4 $normalized Vector4对象
     * @return Color 返回Color对象
     */
    public static function colorFromNormalized(Vector4 $normalized): Color
    {
        $res = self::ffi()->ColorFromNormalized($normalized->struct());
        return new Color($res->r, $res->g, $res->b, $res->a);
    }

    /**
     * 转换颜色到HSV空间(色相0-360度，饱和度/明度0-1)
     *
     * @param Color $color Color对象
     * @return Vector3 返回Vector3对象
     */
    public static function colorToHSV(Color $color): Vector3
    {
        $res = self::ffi()->ColorToHSV($color->struct());
        return new Vector3($res->x, $res->y, $res->z);
    }

    /**
     * 从HSV值创建颜色
     *
     * @param float $hue 色相
     * @param float $saturation 饱和度
     * @param float $value 明度
     * @return Color 返回Color对象
     */
    public static function colorFromHSV(float $hue, float $saturation, float $value): Color
    {
        $res = self::ffi()->ColorFromHSV($hue, $saturation, $value);
        return new Color($res->r, $res->g, $res->b, $res->a);   
    }

    /**
     * 颜色叠加色调
     *
     * @param Color $color Color对象
     * @param Color $tint 色调
     * @return Color 返回调整后的Color对象
     */
    public static function colorTint(Color $color, Color $tint): Color
    {
        $res = self::ffi()->ColorTint($color->struct(), $tint->struct());
        return new Color($res->r, $res->g, $res->b, $res->a);
    }

    /**
     * 调整颜色亮度(-1.0f到1.0f)
     *
     * @param Color $color Color对象
     * @param float $factor 亮度因子
     * @return Color 返回调整后的Color对象
     */
    public static function colorBrightness(Color $color, float $factor): Color
    {
        $res = self::ffi()->ColorBrightness($color->struct(), $factor);
        return new Color($res->r, $res->g, $res->b, $res->a);
    }

    /**
     * 调整颜色对比度(-1.0f到1.0f)
     *
     * @param Color $color Color对象
     * @param float $contrast 对比度值
     * @return Color 返回调整后的Color对象
     */
    public static function colorContrast(Color $color, float $contrast): Color
    {
        $res = self::ffi()->ColorContrast($color->struct(), $contrast);
        return new Color($res->r, $res->g, $res->b, $res->a);
    }

    /**
     * 设置颜色透明度
     *
     * @param Color $color Color对象
     * @param float $alpha Alpha值
     * @return Color 返回调整后的Color对象
     */
    public static function colorAlpha(Color $color, float $alpha): Color
    {
        $res = self::ffi()->ColorAlpha($color->struct(), $alpha);
        return new Color($res->r, $res->g, $res->b, $res->a);
    }

    /**
     * 源颜色与目标颜色alpha混合
     *
     * @param Color $dst 目标颜色
     * @param Color $src 源颜色
     * @param Color $tint 色调
     * @return Color 返回混合后的Color对象
     */
    public static function colorAlphaBlend(Color $dst, Color $src, Color $tint): Color
    {
        $res = self::ffi()->ColorAlphaBlend($dst->struct(), $src->struct(), $tint->struct());
        return new Color($res->r, $res->g, $res->b, $res->a);
    }

    /**
     * 颜色线性插值(插值因子0.0f-1.0f)
     *
     * @param Color $color1 颜色1
     * @param Color $color2 颜色2
     * @param float $factor 插值因子
     * @return Color 返回插值后的Color对象
     */
    public static function colorLerp(Color $color1, Color $color2, float $factor): Color
    {
        $res = self::ffi()->ColorLerp($color1->struct(), $color2->struct(), $factor);
        return new Color($res->r, $res->g, $res->b, $res->a);
    }

    /**
     * 从十六进制值获取颜色
     *
     * @param int $hexValue 十六进制颜色值
     * @return Color 返回Color对象
     */
    public static function getColor(int $hexValue): Color
    {
        $res = self::ffi()->GetColor($hexValue);
        return new Color($res->r, $res->g, $res->b, $res->a);
    }

    /**
     * 从指定格式的像素指针获取颜色
     *
     * @param string $srcPtr 像素数据指针
     * @param int $format 像素格式
     * @return Color 返回Color对象
     */
    public static function getPixelColor(string $srcPtr, int $format): Color
    {
        $res = self::ffi()->GetPixelColor($srcPtr, $format);
        return new Color($res->r, $res->g, $res->b, $res->a);
    }

    /**
     * 将颜色设置到指定格式的像素指针
     *
     * @param string $dstPtr 像素数据指针
     * @param Color $color Color对象
     * @param int $format 像素格式
     * @return void
     */
    public static function setPixelColor(string $dstPtr, Color $color, int $format): void
    {
        self::ffi()->SetPixelColor($dstPtr, $color->struct(), $format); 
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
