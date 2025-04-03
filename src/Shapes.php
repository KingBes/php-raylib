<?php
// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib;

/**
 * Shapes类
 */
class Shapes extends Base
{
    //### 设置形状绘制使用的纹理和矩形
    //> 注意：当使用基本形状和单一字体时，此功能可能有用，\n定义字体字符的白色矩形可以在单次绘制调用中完成所有绘制

    /**
     * 设置形状绘制使用的纹理和源矩形
     *
     * @param \FFI\CData $texture 纹理对象
     * @param \FFI\CData $source 源矩形对象
     * @return void
     */
    public static function setShapesTexture(\FFI\CData $texture, \FFI\CData $source): void
    {
        self::ffi()->SetShapesTexture($texture, $source);
    }

    /**
     * 获取形状绘制使用的纹理
     *
     * @return \FFI\CData 返回纹理对象
     */
    public static function getShapesTexture(): \FFI\CData
    {
        return self::ffi()->GetShapesTexture();
    }

    /**
     * 获取形状绘制使用的纹理源矩形
     *
     * @return \FFI\CData 返回源矩形对象
     */
    public static function getShapesTextureRectangle(): \FFI\CData
    {
        return self::ffi()->GetShapesTextureRectangle();
    }

    //### 基本形状绘制函数

    /**
     * 绘制像素（几何方式绘制，慎用性能影响）
     *
     * @param integer $posX X坐标位置
     * @param integer $posY Y坐标位置
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawPixel(int $posX, int $posY, \FFI\CData $color): void
    {
        self::ffi()->DrawPixel($posX, $posY, $color);
    }

    /**
     * 向量版像素绘制（几何方式）
     *
     * @param \FFI\CData $position 位置向量
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawPixelV(\FFI\CData $position, \FFI\CData $color): void
    {
        self::ffi()->DrawPixelV($position, $color);
    }

    /**
     * 绘制直线（两点式）
     *
     * @param integer $startPosX 起始点X坐标
     * @param integer $startPosY 起始点Y坐标
     * @param integer $endPosX 结束点X坐标
     * @param integer $endPosY 结束点Y坐标
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawLine(int $startPosX, int $startPosY, int $endPosX, int $endPosY, \FFI\CData $color): void
    {
        self::ffi()->DrawLine($startPosX, $startPosY, $endPosX, $endPosY, $color);
    }

    /**
     * 向量版直线绘制（使用GL线条）
     *
     * @param \FFI\CData $startPos 起始点向量
     * @param \FFI\CData $endPos 结束点向量
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawLineV(\FFI\CData $startPos, \FFI\CData $endPos, \FFI\CData $color): void
    {
        self::ffi()->DrawLineV($startPos, $endPos, $color);
    }

    /**
     * 绘制带粗细的直线（使用三角形/四边形）
     *
     * @param \FFI\CData $startPos 起始点向量
     * @param \FFI\CData $endPos 结束点向量
     * @param float $thick 粗细
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawLineEx(\FFI\CData $startPos, \FFI\CData $endPos, float $thick, \FFI\CData $color): void
    {
        self::ffi()->DrawLineEx($startPos, $endPos, $thick, $color);
    }

    /**
     * 绘制连续折线（使用GL线条）
     *
     * @param \FFI\CData $points 点集
     * @param integer $pointCount 点的数量
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawLineStrip(\FFI\CData $points, int $pointCount, \FFI\CData $color): void
    {
        self::ffi()->DrawLineStrip($points, $pointCount, $color);
    }

    /**
     * 绘制三次贝塞尔曲线路径的线段
     *
     * @param \FFI\CData $startPos 起始点向量
     * @param \FFI\CData $endPos 结束点向量
     * @param float $thick 粗细
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawLineBezier(\FFI\CData $startPos, \FFI\CData $endPos, float $thick, \FFI\CData $color): void
    {
        self::ffi()->DrawLineBezier($startPos, $endPos, $thick, $color);
    }

    /**
     * 绘制实心圆形（整数坐标中心）
     *
     * @param integer $centerX 圆心X坐标
     * @param integer $centerY 圆心Y坐标
     * @param float $radius 半径
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawCircle(int $centerX, int $centerY, float $radius, \FFI\CData $color): void
    {
        self::ffi()->DrawCircle($centerX, $centerY, $radius, $color);
    }

    /**
     * 绘制圆形扇形区域
     *
     * @param \FFI\CData $center 圆心
     * @param float $radius 半径
     * @param float $startAngle 开始角度
     * @param float $endAngle 结束角度
     * @param integer $segments 扇形分段数量
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawCircleSector(\FFI\CData $center, float $radius, float $startAngle, float $endAngle, int $segments, \FFI\CData $color): void
    {
        self::ffi()->DrawCircleSector($center, $radius, $startAngle, $endAngle, $segments, $color);
    }

    /**
     * 绘制圆形扇形轮廓线
     *
     * @param \FFI\CData $center 圆心
     * @param float $radius 半径
     * @param float $startAngle 开始角度
     * @param float $endAngle 结束角度
     * @param integer $segments 扇形分段数量
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawCircleSectorLines(\FFI\CData $center, float $radius, float $startAngle, float $endAngle, int $segments, \FFI\CData $color): void
    {
        self::ffi()->DrawCircleSectorLines($center, $radius, $startAngle, $endAngle, $segments, $color);
    }

    /**
     * 绘制渐变填充圆形（整数坐标中心）
     *
     * @param integer $centerX 圆心X坐标
     * @param integer $centerY 圆心Y坐标
     * @param float $radius 半径
     * @param \FFI\CData $inner 内部颜色
     * @param \FFI\CData $outer 外部颜色
     * @return void
     */
    public static function drawCircleGradient(int $centerX, int $centerY, float $radius, \FFI\CData $inner, \FFI\CData $outer): void
    {
        self::ffi()->DrawCircleGradient($centerX, $centerY, $radius, $inner, $outer);
    }

    /**
     * 向量版实心圆形
     *
     * @param \FFI\CData $center 圆心向量
     * @param float $radius 半径
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawCircleV(\FFI\CData $center, float $radius, \FFI\CData $color): void
    {
        self::ffi()->DrawCircleV($center, $radius, $color);
    }

    /**
     * 绘制圆形轮廓线（整数坐标中心）
     *
     * @param integer $centerX 圆心X坐标
     * @param integer $centerY 圆心Y坐标
     * @param float $radius 半径
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawCircleLines(int $centerX, int $centerY, float $radius, \FFI\CData $color): void
    {
        self::ffi()->DrawCircleLines($centerX, $centerY, $radius, $color);
    }

    /**
     * 向量版圆形轮廓线
     *
     * @param \FFI\CData $center 圆心向量
     * @param float $radius 半径
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawCircleLinesV(\FFI\CData $center, float $radius, \FFI\CData $color): void
    {
        self::ffi()->DrawCircleLinesV($center, $radius, $color);
    }

    /**
     * 绘制实心椭圆（水平/垂直半径）
     *
     * @param integer $centerX 中心点X坐标
     * @param integer $centerY 中心点Y坐标
     * @param float $radiusH 水平半径
     * @param float $radiusV 垂直半径
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawEllipse(int $centerX, int $centerY, float $radiusH, float $radiusV, \FFI\CData $color): void
    {
        self::ffi()->DrawEllipse($centerX, $centerY, $radiusH, $radiusV, $color);
    }

    /**
     * 绘制椭圆轮廓线
     *
     * @param integer $centerX 中心点X坐标
     * @param integer $centerY 中心点Y坐标
     * @param float $radiusH 水平半径
     * @param float $radiusV 垂直半径
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawEllipseLines(int $centerX, int $centerY, float $radiusH, float $radiusV, \FFI\CData $color): void
    {
        self::ffi()->DrawEllipseLines($centerX, $centerY, $radiusH, $radiusV, $color);
    }

    /**
     * 绘制环形区域
     *
     * @param \FFI\CData $center 圆心
     * @param float $innerRadius 内圈半径
     * @param float $outerRadius 外圈半径
     * @param float $startAngle 开始角度
     * @param float $endAngle 结束角度
     * @param integer $segments 扇形分段数量
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawRing(\FFI\CData $center, float $innerRadius, float $outerRadius, float $startAngle, float $endAngle, int $segments, \FFI\CData $color): void
    {
        self::ffi()->DrawRing($center, $innerRadius, $outerRadius, $startAngle, $endAngle, $segments, $color);
    }

    /**
     * 绘制环形轮廓线
     *
     * @param \FFI\CData $center 圆心
     * @param float $innerRadius 内圈半径
     * @param float $outerRadius 外圈半径
     * @param float $startAngle 开始角度
     * @param float $endAngle 结束角度
     * @param integer $segments 扇形分段数量
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawRingLines(\FFI\CData $center, float $innerRadius, float $outerRadius, float $startAngle, float $endAngle, int $segments, \FFI\CData $color): void
    {
        self::ffi()->DrawRingLines($center, $innerRadius, $outerRadius, $startAngle, $endAngle, $segments, $color);
    }

    /**
     * 绘制实心矩形（整数坐标）
     *
     * @param integer $posX X坐标位置
     * @param integer $posY Y坐标位置
     * @param integer $width 宽度
     * @param integer $height 高度
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawRectangle(int $posX, int $posY, int $width, int $height, \FFI\CData $color): void
    {
        self::ffi()->DrawRectangle($posX, $posY, $width, $height, $color);
    }

    /**
     * 向量版实心矩形
     *
     * @param \FFI\CData $position 位置向量
     * @param \FFI\CData $size 尺寸向量
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawRectangleV(\FFI\CData $position, \FFI\CData $size, \FFI\CData $color): void
    {
        self::ffi()->DrawRectangleV($position, $size, $color);
    }

    /**
     * 矩形对象版实心绘制
     *
     * @param \FFI\CData $rec 矩形对象
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawRectangleRec(\FFI\CData $rec, \FFI\CData $color): void
    {
        self::ffi()->DrawRectangleRec($rec, $color);
    }

    /**
     * 高级参数矩形绘制（支持旋转和原点）
     *
     * @param \FFI\CData $rec 矩形对象
     * @param \FFI\CData $origin 原点位置
     * @param float $rotation 旋转角度
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawRectanglePro(\FFI\CData $rec, \FFI\CData $origin, float $rotation, \FFI\CData $color): void
    {
        self::ffi()->DrawRectanglePro($rec, $origin, $rotation, $color);
    }

    /**
     * 垂直渐变填充矩形
     *
     * @param integer $posX X坐标位置
     * @param integer $posY Y坐标位置
     * @param integer $width 宽度
     * @param integer $height 高度
     * @param \FFI\CData $top 顶部颜色
     * @param \FFI\CData $bottom 底部颜色
     * @return void
     */
    public static function drawRectangleGradientV(int $posX, int $posY, int $width, int $height, \FFI\CData $top, \FFI\CData $bottom): void
    {
        self::ffi()->DrawRectangleGradientV($posX, $posY, $width, $height, $top, $bottom);
    }

    /**
     * 水平渐变填充矩形
     *
     * @param integer $posX X坐标位置
     * @param integer $posY Y坐标位置
     * @param integer $width 宽度
     * @param integer $height 高度
     * @param \FFI\CData $left 左边颜色
     * @param \FFI\CData $right 右边颜色
     * @return void
     */
    public static function drawRectangleGradientH(int $posX, int $posY, int $width, int $height, \FFI\CData $left, \FFI\CData $right): void
    {
        self::ffi()->DrawRectangleGradientH($posX, $posY, $width, $height, $left, $right);
    }

    /**
     * 四角颜色渐变填充矩形
     *
     * @param \FFI\CData $rec 矩形对象
     * @param \FFI\CData $topLeft 左上颜色
     * @param \FFI\CData $bottomLeft 左下颜色
     * @param \FFI\CData $topRight 右上颜色
     * @param \FFI\CData $bottomRight 右下颜色
     * @return void
     */
    public static function drawRectangleGradientEx(\FFI\CData $rec, \FFI\CData $topLeft, \FFI\CData $bottomLeft, \FFI\CData $topRight, \FFI\CData $bottomRight): void
    {
        self::ffi()->DrawRectangleGradientEx($rec, $topLeft, $bottomLeft, $topRight, $bottomRight);
    }

    /**
     * 绘制矩形轮廓线（整数坐标）
     *
     * @param integer $posX X坐标位置
     * @param integer $posY Y坐标位置
     * @param integer $width 宽度
     * @param integer $height 高度
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawRectangleLines(int $posX, int $posY, int $width, int $height, \FFI\CData $color): void
    {
        self::ffi()->DrawRectangleLines($posX, $posY, $width, $height, $color);
    }

    /**
     * 扩展参数矩形轮廓线（支持线宽）
     *
     * @param \FFI\CData $rec 矩形对象
     * @param float $lineThick 轮廓线宽度
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawRectangleLinesEx(\FFI\CData $rec, float $lineThick, \FFI\CData $color): void
    {
        self::ffi()->DrawRectangleLinesEx($rec, $lineThick, $color);
    }

    /**
     * 绘制圆角矩形（可调圆角半径）
     *
     * @param \FFI\CData $rec 矩形对象
     * @param float $roundness 圆角程度
     * @param integer $segments 分段数
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawRectangleRounded(\FFI\CData $rec, float $roundness, int $segments, \FFI\CData $color): void
    {
        self::ffi()->DrawRectangleRounded($rec, $roundness, $segments, $color);
    }

    /**
     * 绘制圆角矩形轮廓线
     *
     * @param \FFI\CData $rec 矩形对象
     * @param float $roundness 圆角程度
     * @param integer $segments 分段数
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawRectangleRoundedLines(\FFI\CData $rec, float $roundness, int $segments, \FFI\CData $color): void
    {
        self::ffi()->DrawRectangleRoundedLines($rec, $roundness, $segments, $color);
    }

    /**
     * 扩展参数圆角矩形轮廓线
     *
     * @param \FFI\CData $rec 矩形对象
     * @param float $roundness 圆角程度
     * @param integer $segments 分段数
     * @param float $lineThick 轮廓线宽度
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawRectangleRoundedLinesEx(\FFI\CData $rec, float $roundness, int $segments, float $lineThick, \FFI\CData $color): void
    {
        self::ffi()->DrawRectangleRoundedLinesEx($rec, $roundness, $segments, $lineThick, $color);
    }

    /**
     * 绘制实心三角形（顶点逆时针顺序）
     *
     * @param \FFI\CData $v1 顶点1
     * @param \FFI\CData $v2 顶点2
     * @param \FFI\CData $v3 顶点3
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawTriangle(\FFI\CData $v1, \FFI\CData $v2, \FFI\CData $v3, \FFI\CData $color): void
    {
        self::ffi()->DrawTriangle($v1, $v2, $v3, $color);
    }

    /**
     * 绘制三角形轮廓线
     *
     * @param \FFI\CData $v1 顶点1
     * @param \FFI\CData $v2 顶点2
     * @param \FFI\CData $v3 顶点3
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawTriangleLines(\FFI\CData $v1, \FFI\CData $v2, \FFI\CData $v3, \FFI\CData $color): void
    {
        self::ffi()->DrawTriangleLines($v1, $v2, $v3, $color);
    }

    /**
     * 绘制三角形扇（第一个顶点为中心）
     *
     * @param \FFI\CData $points 点集
     * @param integer $pointCount 点的数量
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawTriangleFan(\FFI\CData $points, int $pointCount, \FFI\CData $color): void
    {
        self::ffi()->DrawTriangleFan($points, $pointCount, $color);
    }

    /**
     * 绘制三角形带
     *
     * @param \FFI\CData $points 点集
     * @param integer $pointCount 点的数量
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawTriangleStrip(\FFI\CData $points, int $pointCount, \FFI\CData $color): void
    {
        self::ffi()->DrawTriangleStrip($points, $pointCount, $color);
    }

    /**
     * 绘制正多边形（向量中心版）
     *
     * @param \FFI\CData $center 中心点
     * @param integer $sides 边数
     * @param float $radius 半径
     * @param float $rotation 旋转角度
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawPoly(\FFI\CData $center, int $sides, float $radius, float $rotation, \FFI\CData $color): void
    {
        self::ffi()->DrawPoly($center, $sides, $radius, $rotation, $color);
    }

    /**
     * 绘制正多边形轮廓线
     *
     * @param \FFI\CData $center 中心点
     * @param integer $sides 边数
     * @param float $radius 半径
     * @param float $rotation 旋转角度
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawPolyLines(\FFI\CData $center, int $sides, float $radius, float $rotation, \FFI\CData $color): void
    {
        self::ffi()->DrawPolyLines($center, $sides, $radius, $rotation, $color);
    }

    /**
     * 扩展参数多边形轮廓线
     *
     * @param \FFI\CData $center 中心点
     * @param integer $sides 边数
     * @param float $radius 半径
     * @param float $rotation 旋转角度
     * @param float $lineThick 轮廓线宽度
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawPolyLinesEx(\FFI\CData $center, int $sides, float $radius, float $rotation, float $lineThick, \FFI\CData $color): void
    {
        self::ffi()->DrawPolyLinesEx($center, $sides, $radius, $rotation, $lineThick, $color);
    }

    //### 样条曲线绘制函数

    /**
     * 绘制线性样条（至少2个点）
     *
     * @param \FFI\CData $points 点集
     * @param integer $pointCount 点的数量
     * @param float $thick 粗细
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawSplineLinear(\FFI\CData $points, int $pointCount, float $thick, \FFI\CData $color): void
    {
        self::ffi()->DrawSplineLinear($points, $pointCount, $thick, $color);
    }

    /**
     * 绘制B样条曲线（至少4个点）
     *
     * @param \FFI\CData $points 点集
     * @param integer $pointCount 点的数量
     * @param float $thick 粗细
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawSplineBasis(\FFI\CData $points, int $pointCount, float $thick, \FFI\CData $color): void
    {
        self::ffi()->DrawSplineBasis($points, $pointCount, $thick, $color);
    }

    /**
     * 绘制Catmull-Rom样条（至少4个点）
     *
     * @param \FFI\CData $points 点集
     * @param integer $pointCount 点的数量
     * @param float $thick 粗细
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawSplineCatmullRom(\FFI\CData $points, int $pointCount, float $thick, \FFI\CData $color): void
    {
        self::ffi()->DrawSplineCatmullRom($points, $pointCount, $thick, $color);
    }

    /**
     * 绘制二次贝塞尔样条（至少3个点，1个控制点）
     *
     * @param \FFI\CData $points 点集
     * @param integer $pointCount 点的数量
     * @param float $thick 粗细
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawSplineBezierQuadratic(\FFI\CData $points, int $pointCount, float $thick, \FFI\CData $color): void
    {
        self::ffi()->DrawSplineBezierQuadratic($points, $pointCount, $thick, $color);
    }

    /**
     * 绘制三次贝塞尔样条（至少4个点，2个控制点）
     *
     * @param \FFI\CData $points 点集
     * @param integer $pointCount 点的数量
     * @param float $thick 粗细
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawSplineBezierCubic(\FFI\CData $points, int $pointCount, float $thick, \FFI\CData $color): void
    {
        self::ffi()->DrawSplineBezierCubic($points, $pointCount, $thick, $color);
    }

    /**
     * 绘制线性样条段（2个点）
     *
     * @param \FFI\CData $p1 起始点
     * @param \FFI\CData $p2 结束点
     * @param float $thick 粗细
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawSplineSegmentLinear(\FFI\CData $p1, \FFI\CData $p2, float $thick, \FFI\CData $color): void
    {
        self::ffi()->DrawSplineSegmentLinear($p1, $p2, $thick, $color);
    }

    /**
     * 绘制B样条段（4个点）
     *
     * @param \FFI\CData $p1 第一个点
     * @param \FFI\CData $p2 第二个点
     * @param \FFI\CData $p3 第三个点
     * @param \FFI\CData $p4 第四个点
     * @param float $thick 粗细
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawSplineSegmentBasis(\FFI\CData $p1, \FFI\CData $p2, \FFI\CData $p3, \FFI\CData $p4, float $thick, \FFI\CData $color): void
    {
        self::ffi()->DrawSplineSegmentBasis($p1, $p2, $p3, $p4, $thick, $color);
    }

    /**
     * 绘制Catmull-Rom样条段（4个点）
     *
     * @param \FFI\CData $p1 第一个点
     * @param \FFI\CData $p2 第二个点
     * @param \FFI\CData $p3 第三个点
     * @param \FFI\CData $p4 第四个点
     * @param float $thick 粗细
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawSplineSegmentCatmullRom(\FFI\CData $p1, \FFI\CData $p2, \FFI\CData $p3, \FFI\CData $p4, float $thick, \FFI\CData $color): void
    {
        self::ffi()->DrawSplineSegmentCatmullRom($p1, $p2, $p3, $p4, $thick, $color);
    }

    /**
     * 绘制二次贝塞尔段（2个点+1控制点）
     *
     * @param \FFI\CData $p1 起始点
     * @param \FFI\CData $c2 控制点
     * @param \FFI\CData $p3 结束点
     * @param float $thick 粗细
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawSplineSegmentBezierQuadratic(\FFI\CData $p1, \FFI\CData $c2, \FFI\CData $p3, float $thick, \FFI\CData $color): void
    {
        self::ffi()->DrawSplineSegmentBezierQuadratic($p1, $c2, $p3, $thick, $color);
    }

    /**
     * 绘制三次贝塞尔段（2个点+2控制点）
     *
     * @param \FFI\CData $p1 起始点
     * @param \FFI\CData $c2 第一控制点
     * @param \FFI\CData $c3 第二控制点
     * @param \FFI\CData $p4 结束点
     * @param float $thick 粗细
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawSplineSegmentBezierCubic(\FFI\CData $p1, \FFI\CData $c2, \FFI\CData $c3, \FFI\CData $p4, float $thick, \FFI\CData $color): void
    {
        self::ffi()->DrawSplineSegmentBezierCubic($p1, $c2, $c3, $p4, $thick, $color);
    }

    //### 样条曲线点插值计算函数（t范围[0.0f, 1.0f]）

    /**
     * 线性样条点插值计算
     *
     * @param \FFI\CData $startPos 起始点
     * @param \FFI\CData $endPos 结束点
     * @param float $t 插值参数
     * @return \FFI\CData 返回插值点
     */
    public static function getSplinePointLinear(\FFI\CData $startPos, \FFI\CData $endPos, float $t): \FFI\CData
    {
        return self::ffi()->GetSplinePointLinear($startPos, $endPos, $t);
    }

    /**
     * B样条点插值计算
     *
     * @param \FFI\CData $p1 第一个控制点
     * @param \FFI\CData $p2 第二个控制点
     * @param \FFI\CData $p3 第三个控制点
     * @param \FFI\CData $p4 第四个控制点
     * @param float $t 插值参数
     * @return \FFI\CData 返回插值点
     */
    public static function getSplinePointBasis(\FFI\CData $p1, \FFI\CData $p2, \FFI\CData $p3, \FFI\CData $p4, float $t): \FFI\CData
    {
        return self::ffi()->GetSplinePointBasis($p1, $p2, $p3, $p4, $t);
    }

    /**
     * Catmull-Rom样条点插值计算
     *
     * @param \FFI\CData $p1 第一个控制点
     * @param \FFI\CData $p2 第二个控制点
     * @param \FFI\CData $p3 第三个控制点
     * @param \FFI\CData $p4 第四个控制点
     * @param float $t 插值参数
     * @return \FFI\CData 返回插值点
     */
    public static function getSplinePointCatmullRom(\FFI\CData $p1, \FFI\CData $p2, \FFI\CData $p3, \FFI\CData $p4, float $t): \FFI\CData
    {
        return self::ffi()->GetSplinePointCatmullRom($p1, $p2, $p3, $p4, $t);
    }

    /**
     * 二次贝塞尔点插值计算
     *
     * @param \FFI\CData $p1 起始点
     * @param \FFI\CData $c2 控制点
     * @param \FFI\CData $p3 结束点
     * @param float $t 插值参数
     * @return \FFI\CData 返回插值点
     */
    public static function getSplinePointBezierQuad(\FFI\CData $p1, \FFI\CData $c2, \FFI\CData $p3, float $t): \FFI\CData
    {
        return self::ffi()->GetSplinePointBezierQuad($p1, $c2, $p3, $t);
    }

    /**
     * 三次贝塞尔点插值计算
     *
     * @param \FFI\CData $p1 起始点
     * @param \FFI\CData $c2 第一控制点
     * @param \FFI\CData $c3 第二控制点
     * @param \FFI\CData $p4 结束点
     * @param float $t 插值参数
     * @return \FFI\CData 返回插值点
     */
    public static function getSplinePointBezierCubic(\FFI\CData $p1, \FFI\CData $c2, \FFI\CData $c3, \FFI\CData $p4, float $t): \FFI\CData
    {
        return self::ffi()->GetSplinePointBezierCubic($p1, $c2, $c3, $p4, $t);
    }

    //### 基本形状碰撞检测函数

    /**
     * 检测两个矩形是否碰撞
     *
     * @param \FFI\CData $rec1 矩形1
     * @param \FFI\CData $rec2 矩形2
     * @return bool 返回是否碰撞
     */
    public static function checkCollisionRecs(\FFI\CData $rec1, \FFI\CData $rec2): bool
    {
        return self::ffi()->CheckCollisionRecs($rec1, $rec2);
    }

    /**
     * 检测两个圆形是否碰撞
     *
     * @param \FFI\CData $center1 圆心1
     * @param float $radius1 半径1
     * @param \FFI\CData $center2 圆心2
     * @param float $radius2 半径2
     * @return bool 返回是否碰撞
     */
    public static function checkCollisionCircles(\FFI\CData $center1, float $radius1, \FFI\CData $center2, float $radius2): bool
    {
        return self::ffi()->CheckCollisionCircles($center1, $radius1, $center2, $radius2);
    }

    /**
     * 检测圆形与矩形是否碰撞
     *
     * @param \FFI\CData $center 圆心
     * @param float $radius 半径
     * @param \FFI\CData $rec 矩形
     * @return bool 返回是否碰撞
     */
    public static function checkCollisionCircleRec(\FFI\CData $center, float $radius, \FFI\CData $rec): bool
    {
        return self::ffi()->CheckCollisionCircleRec($center, $radius, $rec);
    }

    /**
     * 检测圆形与线段是否碰撞
     *
     * @param \FFI\CData $center 圆心
     * @param float $radius 半径
     * @param \FFI\CData $p1 线段起点
     * @param \FFI\CData $p2 线段终点
     * @return bool 返回是否碰撞
     */
    public static function checkCollisionCircleLine(\FFI\CData $center, float $radius, \FFI\CData $p1, \FFI\CData $p2): bool
    {
        return self::ffi()->CheckCollisionCircleLine($center, $radius, $p1, $p2);
    }

    /**
     * 检测点是否在矩形内
     *
     * @param \FFI\CData $point 点
     * @param \FFI\CData $rec 矩形
     * @return bool 返回是否在矩形内
     */
    public static function checkCollisionPointRec(\FFI\CData $point, \FFI\CData $rec): bool
    {
        return self::ffi()->CheckCollisionPointRec($point, $rec);
    }

    /**
     * 检测点是否在圆形内
     *
     * @param \FFI\CData $point 点
     * @param \FFI\CData $center 圆心
     * @param float $radius 半径
     * @return bool 返回是否在圆形内
     */
    public static function checkCollisionPointCircle(\FFI\CData $point, \FFI\CData $center, float $radius): bool
    {
        return self::ffi()->CheckCollisionPointCircle($point, $center, $radius);
    }

    /**
     * 检测点是否在三角形内
     *
     * @param \FFI\CData $point 点
     * @param \FFI\CData $p1 顶点1
     * @param \FFI\CData $p2 顶点2
     * @param \FFI\CData $p3 顶点3
     * @return bool 返回是否在三角形内
     */
    public static function checkCollisionPointTriangle(\FFI\CData $point, \FFI\CData $p1, \FFI\CData $p2, \FFI\CData $p3): bool
    {
        return self::ffi()->CheckCollisionPointTriangle($point, $p1, $p2, $p3);
    }

    /**
     * 检测点是否在线段上（带像素阈值）
     *
     * @param \FFI\CData $point 点
     * @param \FFI\CData $p1 线段起点
     * @param \FFI\CData $p2 线段终点
     * @param integer $threshold 像素阈值
     * @return bool 返回是否在线段上
     */
    public static function checkCollisionPointLine(\FFI\CData $point, \FFI\CData $p1, \FFI\CData $p2, int $threshold): bool
    {
        return self::ffi()->CheckCollisionPointLine($point, $p1, $p2, $threshold);
    }

    /**
     * 检测点是否在多边形内
     *
     * @param \FFI\CData $point 点
     * @param \FFI\CData $points 多边形点集
     * @param integer $pointCount 点的数量
     * @return bool 返回是否在多边形内
     */
    public static function checkCollisionPointPoly(\FFI\CData $point, \FFI\CData $points, int $pointCount): bool
    {
        return self::ffi()->CheckCollisionPointPoly($point, $points, $pointCount);
    }

    /**
     * 检测两线段是否相交，返回碰撞点
     *
     * @param \FFI\CData $startPos1 线段1起点
     * @param \FFI\CData $endPos1 线段1终点
     * @param \FFI\CData $startPos2 线段2起点
     * @param \FFI\CData $endPos2 线段2终点
     * @param \FFI\CData $collisionPoint 输出参数，用于存储碰撞点
     * @return bool 返回是否相交
     */
    public static function checkCollisionLines(\FFI\CData $startPos1, \FFI\CData $endPos1, \FFI\CData $startPos2, \FFI\CData $endPos2, \FFI\CData $collisionPoint): bool
    {
        return self::ffi()->CheckCollisionLines($startPos1, $endPos1, $startPos2, $endPos2, $collisionPoint);
    }

    /**
     * 获取两个矩形的碰撞重叠区域
     *
     * @param \FFI\CData $rec1 矩形1
     * @param \FFI\CData $rec2 矩形2
     * @return \FFI\CData 返回碰撞重叠区域
     */
    public static function getCollisionRec(\FFI\CData $rec1, \FFI\CData $rec2): \FFI\CData
    {
        return self::ffi()->GetCollisionRec($rec1, $rec2);
    }
}
