<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib;

/**
 * Utils类
 */
class Utils extends Base
{
    /**
     * 颜色对象
     *
     * @param integer $r red
     * @param integer $g green
     * @param integer $b blue
     * @param integer $a alpha
     * @return \FFI\CData
     */
    public static function color(int $r, int $g, int $b, int $a = 255): \FFI\CData
    {
        $color = self::ffi()->new('struct Color');
        $color->r = $r;
        $color->g = $g;
        $color->b = $b;
        $color->a = $a;
        return $color;
    }

    /**
     * 矩形对象2
     *
     * @param float $x x坐标
     * @param float $y y坐标
     * @return \FFI\CData
     */
    public static function vector2(float $x, float $y): \FFI\CData
    {
        $vector2 = self::ffi()->new('struct Vector2');
        $vector2->x = $x;
        $vector2->y = $y;
        return $vector2;
    }

    /**
     * 矩形对象3
     *
     * @param float $x x坐标
     * @param float $y y坐标
     * @param float $z z坐标
     * @return \FFI\CData
     */
    public static function vector3(float $x, float $y, float $z): \FFI\CData
    {
        $vector3 = self::ffi()->new('struct Vector3');
        $vector3->x = $x;
        $vector3->y = $y;
        $vector3->z = $z;
        return $vector3;
    }

    /**
     * 矩形对象4
     *
     * @param float $x x坐标
     * @param float $y y坐标
     * @param float $z z坐标
     * @param float $w w坐标
     * @return \FFI\CData
     */
    public static function vector4(float $x, float $y, float $z, float $w): \FFI\CData
    {
        $vector4 = self::ffi()->new('struct Vector4');
        $vector4->x = $x;
        $vector4->y = $y;
        $vector4->z = $z;
        $vector4->w = $w;
        return $vector4;
    }

    /**
     * 矩形对象 4x4组件
     *
     * @param float $m0 
     * @param float $m1
     * @param float $m2
     * @param float $m3
     * @param float $m4
     * @param float $m5
     * @param float $m6
     * @param float $m7
     * @param float $m8
     * @param float $m9
     * @param float $m10
     * @param float $m11
     * @param float $m12
     * @param float $m13
     * @param float $m14
     * @param float $m15
     * @return \FFI\CData
     */
    public static function matrix(float $m0, float $m1, float $m2, float $m3, float $m4, float $m5, float $m6, float $m7, float $m8, float $m9, float $m10, float $m11, float $m12, float $m13, float $m14, float $m15): \FFI\CData
    {
        $matrix = self::ffi()->new('struct Matrix');
        $matrix->m0 = $m0;
        $matrix->m1 = $m1;
        $matrix->m2 = $m2;
        $matrix->m3 = $m3;
        $matrix->m4 = $m4;
        $matrix->m5 = $m5;
        $matrix->m6 = $m6;
        $matrix->m7 = $m7;
        $matrix->m8 = $m8;
        $matrix->m9 = $m9;
        $matrix->m10 = $m10;
        $matrix->m11 = $m11;
        $matrix->m12 = $m12;
        $matrix->m13 = $m13;
        $matrix->m14 = $m14;
        return $matrix;
    }

    /**
     * 矩形对象
     *
     * @param float $x x坐标
     * @param float $y y坐标
     * @param float $width 宽度
     * @param float $height 高度
     * @return \FFI\CData
     */
    public static function rectangle(float $x, float $y, float $width, float $height): \FFI\CData
    {
        $rectangle = self::ffi()->new('struct Rectangle');
        $rectangle->x = $x;
        $rectangle->y = $y;
        $rectangle->width = $width;
        $rectangle->height = $height;
        return $rectangle;
    }

    /**
     * 纹理对象
     *
     * @param integer $id 纹理ID
     * @param integer $width 纹理宽度
     * @param integer $height 纹理高度
     * @param integer $mipmaps 纹理mipmaps数量
     * @param integer $format 纹理格式
     * @return \FFI\CData
     */
    public static function texture(int $id, int $width, int $height, int $mipmaps, int $format): \FFI\CData
    {
        $texture = self::ffi()->new('struct Texture2D');
        $texture->id = $id;
        $texture->width = $width;
        $texture->height = $height;
        $texture->mipmaps = $mipmaps;
        $texture->format = $format;
        return $texture;
    }

    /**
     * 渲染纹理对象
     *
     * @param integer $id 渲染纹理ID
     * @param \FFI\CData $texture 彩色缓冲附件纹理
     * @param \FFI\CData $depth 深度缓冲附件纹理
     * @return \FFI\CData
     */
    public static function renderTexture(int $id, \FFI\CData $texture, \FFI\CData $depth): \FFI\CData
    {
        $renderTexture = self::ffi()->new('struct RenderTexture');
        $renderTexture->id = $id;
        $renderTexture->texture = $texture;
        $renderTexture->depth = $depth;
        return $renderTexture;
    }

    /**
     * 补丁信息对象
     *
     * @param \FFI\CData $source 纹理源矩形
     * @param integer $left 左边框偏移
     * @param integer $top 上边框偏移
     * @param integer $right 右边框偏移
     * @param integer $bottom 下边框偏移
     * @param integer $layout 布局类型
     * @return \FFI\CData
     */
    public static function nPatchInfo(\FFI\CData $source, int $left, int $top, int $right, int $bottom, int $layout): \FFI\CData
    {
        $nPatchInfo = self::ffi()->new('struct NPatchInfo');
        $nPatchInfo->source = $source;
        $nPatchInfo->left = $left;
        $nPatchInfo->top = $top;
        $nPatchInfo->right = $right;
        $nPatchInfo->bottom = $bottom;
        $nPatchInfo->layout = $layout;
        return $nPatchInfo;
    }

    /**
     * 字形信息对象
     *
     * @param integer $value 字符值（Unicode）
     * @param integer $offsetX 绘图时字符偏移量X
     * @param integer $offsetY 绘图时字符偏移量Y
     * @param integer $advanceX 字符前进位置X
     * @param \FFI\CData $image 字符图像对象
     * @return \FFI\CData
     */
    public static function glyphInfo(int $value, int $offsetX, int $offsetY, int $advanceX, \FFI\CData $image): \FFI\CData
    {
        $glyphInfo = self::ffi()->new('struct GlyphInfo');
        $glyphInfo->value = $value;
        $glyphInfo->offsetX = $offsetX;
        $glyphInfo->offsetY = $offsetY;
        $glyphInfo->advanceX = $advanceX;
        $glyphInfo->image = $image;
        return $glyphInfo;
    }

    /**
     * 字体对象
     *
     * @param integer $baseSize 基本大小（默认字符高度）
     * @param integer $glyphCount 字形字符的数目
     * @param integer $glyphPadding 字形字符周围的填充
     * @param \FFI\CData $texture 包含字形的纹理图集对象
     * @param \FFI\CData $recs 纹理中的矩形用于字形对象
     * @param \FFI\CData $glyphs 字形信息数据对象
     * @return \FFI\CData
     */
    public static function font(int $baseSize, int $glyphCount, int $glyphPadding, \FFI\CData $texture, \FFI\CData &$recs, \FFI\CData &$glyphs): \FFI\CData
    {
        $font = self::ffi()->new('struct Font');
        $font->baseSize = $baseSize;
        $font->glyphCount = $glyphCount;
        $font->glyphPadding = $glyphPadding;
        $font->texture = $texture;
        $font->recs = $recs;
        $font->glyphs = $glyphs;
        return $font;
    }

    /**
     * 3D相机，定义3d空间中的位置/方向
     *
     * @param \FFI\CData $position 相机的位置
     * @param \FFI\CData $target 相机的目标位置
     * @param \FFI\CData $up 相机的上方向
     * @param float $fovy 相机的视野角度（垂直方向）
     * @param integer $projection 相机的投影类型（0-透视投影，1-正交投影）
     * @return \FFI\CData
     */
    public static function camera3D(\FFI\CData $position, \FFI\CData $target, \FFI\CData $up, float $fovy, int $projection): \FFI\CData
    {
        $camera = self::ffi()->new('struct Camera3D');
        $camera->position = $position;
        $camera->target = $target;
        $camera->up = $up;
        $camera->fovy = $fovy;
        $camera->projection = $projection;
        return $camera;
    }

    /**
     * 2D相机，定义2d空间中的位置/方向
     *
     * @param \FFI\CData $offset 相机的偏移量
     * @param \FFI\CData $target 相机的目标位置
     * @param float $rotation 相机的旋转角度
     * @param float $zoom 相机的缩放比例
     * @return \FFI\CData
     */
    public static function camera2D(\FFI\CData $offset, \FFI\CData $target, float $rotation, float $zoom): \FFI\CData
    {
        $camera = self::ffi()->new('struct Camera2D');
        $camera->offset = $offset;
        $camera->target = $target;
        $camera->rotation = $rotation;
        $camera->zoom = $zoom;
        return $camera;
    }

    /**
     * 着色器对象
     *
     * @param integer $id 着色器ID
     * @param array $locs 着色器位置数组 （RL最大着色器位置）
     * @return \FFI\CData
     */
    public static function shader(int $id, array $locs): \FFI\CData
    {
        $locsCount = count($locs);
        $locsArray = self::ffi()->new('int[' . $locsCount . ']');
        foreach ($locs as $i => $loc) {
            $locsArray[$i] = $loc;
        }
        $shader = self::ffi()->new('struct Shader');
        $shader->id = $id;
        $shader->locs = $locsArray;
        return $shader;
    }

    /**
     * 材料图块对象
     *
     * @param \FFI\CData $texture 材质贴图纹理
     * @param \FFI\CData $color 材质贴图颜色
     * @param float $value 材质贴图值
     * @return \FFI\CData
     */
    public static function materialMap(\FFI\CData $texture, \FFI\CData $color, float $value): \FFI\CData
    {
        $materialMap = self::ffi()->new('struct MaterialMap');
        $materialMap->texture = $texture;
        $materialMap->color = $color;
        $materialMap->value = $value;
        return $materialMap;
    }
}
