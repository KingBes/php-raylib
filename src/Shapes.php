<?php
// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib;

use Kingbes\Raylib\Utils\Texture;
use Kingbes\Raylib\Utils\Rectangle;
use Kingbes\Raylib\Utils\Color;
use Kingbes\Raylib\Utils\Vector2;

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
     * @param Texture $texture 纹理对象
     * @param Rectangle $source 源矩形对象
     * @return void
     */
    public static function setShapesTexture(Texture $texture, Rectangle $source): void
    {
        self::ffi()->SetShapesTexture($texture->struct(), $source->struct());
    }

    /**
     * 获取形状绘制使用的纹理
     *
     * @return Texture 返回纹理对象
     */
    public static function getShapesTexture(): Texture
    {
        return new Texture(self::ffi()->GetShapesTexture());
    }

    /**
     * 获取形状绘制使用的纹理源矩形
     *
     * @return Rectangle 返回源矩形对象    
     */
    public static function getShapesTextureRectangle(): Rectangle
    {
        $res = self::ffi()->GetShapesTextureRectangle();
        return new Rectangle($res->x, $res->y, $res->width, $res->height);
    }

    //### 基本形状绘制函数

    /**
     * 绘制像素（几何方式绘制，慎用性能影响）
     *
     * @param integer $posX X坐标位置
     * @param integer $posY Y坐标位置
     * @param Color $color 颜色
     * @return void
     */
    public static function drawPixel(int $posX, int $posY, Color $color): void
    {
        self::ffi()->DrawPixel($posX, $posY, $color->struct());
    }

    /**
     * 向量版像素绘制（几何方式）
     *
     * @param Vector2 $position 位置向量
     * @param Color $color 颜色
     * @return void
     */
    public static function drawPixelV(Vector2 $position, Color $color): void
    {
        self::ffi()->DrawPixelV($position->struct(), $color->struct());
    }

    /**
     * 绘制直线（两点式）
     *
     * @param integer $startPosX 起始点X坐标
     * @param integer $startPosY 起始点Y坐标
     * @param integer $endPosX 结束点X坐标
     * @param integer $endPosY 结束点Y坐标
     * @param Color $color 颜色
     * @return void
     */
    public static function drawLine(int $startPosX, int $startPosY, int $endPosX, int $endPosY, Color $color): void
    {
        self::ffi()->DrawLine($startPosX, $startPosY, $endPosX, $endPosY, $color->struct());
    }

    /**
     * 向量版直线绘制（使用GL线条）
     *
     * @param Vector2 $startPos 起始点向量
     * @param Vector2 $endPos 结束点向量
     * @param Color $color 颜色
     * @return void
     */
    public static function drawLineV(Vector2 $startPos, Vector2 $endPos, Color $color): void
    {
        self::ffi()->DrawLineV($startPos->struct(), $endPos->struct(), $color->struct());
    }

    /**
     * 绘制带粗细的直线（使用三角形/四边形）
     *
     * @param Vector2 $startPos 起始点向量
     * @param Vector2 $endPos 结束点向量
     * @param float $thick 粗细
     * @param Color $color 颜色
     * @return void
     */
    public static function drawLineEx(Vector2 $startPos, Vector2 $endPos, float $thick, Color $color): void
    {
        self::ffi()->DrawLineEx($startPos->struct(), $endPos->struct(), $thick, $color->struct());
    }

    /**
     * 绘制连续折线（使用GL线条）
     *
     * @param Vector2[] $points 点集
     * @param integer $pointCount 点的数量
     * @param Color $color 颜色
     * @return void
     */
    public static function drawLineStrip(array $points, int $pointCount, Color $color): void
    {
        $c_points = self::ffi()->new('struct Vector2[' . count($points) . ']');
        foreach ($points as $key => $value) {
            $c_points[$key] = $value->struct();
        }
        self::ffi()->DrawLineStrip(
            self::ffi()->cast('struct Vector2*', $c_points),
            $pointCount,
            $color->struct()
        );
    }

    /**
     * 绘制三次贝塞尔曲线路径的线段
     *
     * @param Vector2 $startPos 起始点向量
     * @param Vector2 $endPos 结束点向量
     * @param float $thick 粗细
     * @param Color $color 颜色
     * @return void
     */
    public static function drawLineBezier(Vector2 $startPos, Vector2 $endPos, float $thick, Color $color): void
    {
        self::ffi()->DrawLineBezier($startPos->struct(), $endPos->struct(), $thick, $color->struct());
    }

    /**
     * 绘制实心圆形（整数坐标中心）
     *
     * @param integer $centerX 圆心X坐标
     * @param integer $centerY 圆心Y坐标
     * @param float $radius 半径
     * @param Color $color 颜色
     * @return void
     */
    public static function drawCircle(int $centerX, int $centerY, float $radius, Color $color): void
    {
        self::ffi()->DrawCircle($centerX, $centerY, $radius, $color->struct());
    }

    /**
     * 绘制圆形扇形区域
     *
     * @param Vector2 $center 圆心向量
     * @param float $radius 半径
     * @param float $startAngle 开始角度
     * @param float $endAngle 结束角度
     * @param integer $segments 扇形分段数量
     * @param Color $color 颜色
     * @return void
     */
    public static function drawCircleSector(Vector2 $center, float $radius, float $startAngle, float $endAngle, int $segments, Color $color): void
    {
        self::ffi()->DrawCircleSector($center->struct(), $radius, $startAngle, $endAngle, $segments, $color->struct());
    }

    /**
     * 绘制圆形扇形轮廓线
     *
     * @param Vector2 $center 圆心向量
     * @param float $radius 半径
     * @param float $startAngle 开始角度
     * @param float $endAngle 结束角度
     * @param integer $segments 扇形分段数量
     * @param Color $color 颜色
     * @return void
     */
    public static function drawCircleSectorLines(Vector2 $center, float $radius, float $startAngle, float $endAngle, int $segments, Color $color): void
    {
        self::ffi()->DrawCircleSectorLines($center->struct(), $radius, $startAngle, $endAngle, $segments, $color->struct());
    }

    /**
     * 绘制渐变填充圆形（整数坐标中心）
     *
     * @param integer $centerX 圆心X坐标
     * @param integer $centerY 圆心Y坐标
     * @param float $radius 半径
     * @param Color $inner 内部颜色
     * @param Color $outer 外部颜色
     * @return void
     */
    public static function drawCircleGradient(int $centerX, int $centerY, float $radius, Color $inner, Color $outer): void
    {
        self::ffi()->DrawCircleGradient($centerX, $centerY, $radius, $inner->struct(), $outer->struct());
    }

    /**
     * 向量版实心圆形
     *
     * @param Vector2 $center 圆心向量
     * @param float $radius 半径
     * @param Color $color 颜色
     * @return void
     */
    public static function drawCircleV(Vector2 $center, float $radius, Color $color): void
    {
        self::ffi()->DrawCircleV($center->struct(), $radius, $color->struct());
    }

    /**
     * 绘制圆形轮廓线（整数坐标中心）
     *
     * @param integer $centerX 圆心X坐标
     * @param integer $centerY 圆心Y坐标
     * @param float $radius 半径
     * @param Color $color 颜色
     * @return void
     */
    public static function drawCircleLines(int $centerX, int $centerY, float $radius, Color $color): void
    {
        self::ffi()->DrawCircleLines($centerX, $centerY, $radius, $color->struct());
    }

    /**
     * 向量版圆形轮廓线
     *
     * @param Vector2 $center 圆心向量
     * @param float $radius 半径
     * @param Color $color 颜色
     * @return void
     */
    public static function drawCircleLinesV(Vector2 $center, float $radius, Color $color): void
    {
        self::ffi()->DrawCircleLinesV($center->struct(), $radius, $color->struct());
    }

    /**
     * 绘制实心椭圆（水平/垂直半径）
     *
     * @param integer $centerX 中心点X坐标
     * @param integer $centerY 中心点Y坐标
     * @param float $radiusH 水平半径
     * @param float $radiusV 垂直半径
     * @param Color $color 颜色
     * @return void
     */
    public static function drawEllipse(int $centerX, int $centerY, float $radiusH, float $radiusV, Color $color): void
    {
        self::ffi()->DrawEllipse($centerX, $centerY, $radiusH, $radiusV, $color->struct());
    }

    /**
     * 绘制椭圆轮廓线
     *
     * @param integer $centerX 中心点X坐标
     * @param integer $centerY 中心点Y坐标
     * @param float $radiusH 水平半径
     * @param float $radiusV 垂直半径
     * @param Color $color 颜色
     * @return void
     */
    public static function drawEllipseLines(int $centerX, int $centerY, float $radiusH, float $radiusV, Color $color): void
    {
        self::ffi()->DrawEllipseLines($centerX, $centerY, $radiusH, $radiusV, $color->struct());
    }

    /**
     * 绘制环形区域
     *
     * @param Vector2 $center 圆心向量
     * @param float $innerRadius 内圈半径
     * @param float $outerRadius 外圈半径
     * @param float $startAngle 开始角度
     * @param float $endAngle 结束角度
     * @param integer $segments 扇形分段数量
     * @param Color $color 颜色
     * @return void
     */
    public static function drawRing(Vector2 $center, float $innerRadius, float $outerRadius, float $startAngle, float $endAngle, int $segments, Color $color): void
    {
        self::ffi()->DrawRing($center->struct(), $innerRadius, $outerRadius, $startAngle, $endAngle, $segments, $color->struct());
    }

    /**
     * 绘制环形轮廓线
     *
     * @param Vector2 $center 圆心向量
     * @param float $innerRadius 内圈半径
     * @param float $outerRadius 外圈半径
     * @param float $startAngle 开始角度
     * @param float $endAngle 结束角度
     * @param integer $segments 扇形分段数量
     * @param Color $color 颜色
     * @return void
     */
    public static function drawRingLines(Vector2 $center, float $innerRadius, float $outerRadius, float $startAngle, float $endAngle, int $segments, Color $color): void
    {
        self::ffi()->DrawRingLines($center->struct(), $innerRadius, $outerRadius, $startAngle, $endAngle, $segments, $color->struct());
    }

    /**
     * 绘制实心矩形（整数坐标）
     *
     * @param integer $posX X坐标位置
     * @param integer $posY Y坐标位置
     * @param integer $width 宽度
     * @param integer $height 高度
     * @param Color $color 颜色
     * @return void
     */
    public static function drawRectangle(int $posX, int $posY, int $width, int $height, Color $color): void
    {
        self::ffi()->DrawRectangle($posX, $posY, $width, $height, $color->struct());
    }

    /**
     * 向量版实心矩形
     *
     * @param Vector2 $position 位置向量
     * @param Vector2 $size 尺寸向量
     * @param Color $color 颜色
     * @return void
     */
    public static function drawRectangleV(Vector2 $position, Vector2 $size, Color $color): void
    {
        self::ffi()->DrawRectangleV($position->struct(), $size->struct(), $color->struct());
    }

    /**
     * 矩形对象版实心绘制
     *
     * @param Rectangle $rec 矩形对象
     * @param Color $color 颜色
     * @return void
     */
    public static function drawRectangleRec(Rectangle $rec, Color $color): void
    {
        self::ffi()->DrawRectangleRec($rec->struct(), $color->struct());
    }

    /**
     * 高级参数矩形绘制（支持旋转和原点）
     *
     * @param Rectangle $rec 矩形对象
     * @param Vector2 $origin 原点位置
     * @param float $rotation 旋转角度
     * @param Color $color 颜色
     * @return void
     */
    public static function drawRectanglePro(Rectangle $rec, Vector2 $origin, float $rotation, Color $color): void
    {
        self::ffi()->DrawRectanglePro($rec->struct(), $origin->struct(), $rotation, $color->struct());
    }

    /**
     * 垂直渐变填充矩形
     *
     * @param integer $posX X坐标位置
     * @param integer $posY Y坐标位置
     * @param integer $width 宽度
     * @param integer $height 高度
     * @param Color $top 顶部颜色
     * @param Color $bottom 底部颜色
     * @return void
     */
    public static function drawRectangleGradientV(int $posX, int $posY, int $width, int $height, Color $top, Color $bottom): void
    {
        self::ffi()->DrawRectangleGradientV($posX, $posY, $width, $height, $top->struct(), $bottom->struct());
    }

    /**
     * 水平渐变填充矩形
     *
     * @param integer $posX X坐标位置
     * @param integer $posY Y坐标位置
     * @param integer $width 宽度
     * @param integer $height 高度
     * @param Color $left 左边颜色
     * @param Color $right 右边颜色
     * @return void
     */
    public static function drawRectangleGradientH(int $posX, int $posY, int $width, int $height, Color $left, Color $right): void
    {
        self::ffi()->DrawRectangleGradientH($posX, $posY, $width, $height, $left->struct(), $right->struct());
    }

    /**
     * 四角颜色渐变填充矩形
     *
     * @param Rectangle $rec 矩形对象
     * @param Color $topLeft 左上颜色
     * @param Color $bottomLeft 左下颜色
     * @param Color $topRight 右上颜色
     * @param Color $bottomRight 右下颜色
     * @return void
     */
    public static function drawRectangleGradientEx(Rectangle $rec, Color $topLeft, Color $bottomLeft, Color $topRight, Color $bottomRight): void
    {
        self::ffi()->DrawRectangleGradientEx($rec->struct(), $topLeft->struct(), $bottomLeft->struct(), $topRight->struct(), $bottomRight->struct());
    }

    /**
     * 绘制矩形轮廓线（整数坐标）
     *
     * @param integer $posX X坐标位置
     * @param integer $posY Y坐标位置
     * @param integer $width 宽度
     * @param integer $height 高度
     * @param Color $color 颜色
     * @return void
     */
    public static function drawRectangleLines(int $posX, int $posY, int $width, int $height, Color $color): void
    {
        self::ffi()->DrawRectangleLines($posX, $posY, $width, $height, $color->struct());
    }

    /**
     * 扩展参数矩形轮廓线（支持线宽）
     *
     * @param Rectangle $rec 矩形对象
     * @param float $lineThick 轮廓线宽度
     * @param Color $color 颜色
     * @return void
     */
    public static function drawRectangleLinesEx(Rectangle $rec, float $lineThick, Color $color): void
    {
        self::ffi()->DrawRectangleLinesEx($rec->struct(), $lineThick, $color->struct());
    }

    /**
     * 绘制圆角矩形（可调圆角半径）
     *
     * @param Rectangle $rec 矩形对象
     * @param float $roundness 圆角程度
     * @param integer $segments 分段数
     * @param Color $color 颜色
     * @return void
     */
    public static function drawRectangleRounded(Rectangle $rec, float $roundness, int $segments, Color $color): void
    {
        self::ffi()->DrawRectangleRounded($rec->struct(), $roundness, $segments, $color->struct());
    }

    /**
     * 绘制圆角矩形轮廓线
     *
     * @param Rectangle $rec 矩形对象
     * @param float $roundness 圆角程度
     * @param integer $segments 分段数
     * @param Color $color 颜色
     * @return void
     */
    public static function drawRectangleRoundedLines(Rectangle $rec, float $roundness, int $segments, Color $color): void
    {
        self::ffi()->DrawRectangleRoundedLines($rec->struct(), $roundness, $segments, $color->struct());
    }

    /**
     * 扩展参数圆角矩形轮廓线
     *
     * @param Rectangle $rec 矩形对象
     * @param float $roundness 圆角程度
     * @param integer $segments 分段数
     * @param float $lineThick 轮廓线宽度
     * @param Color $color 颜色
     * @return void
     */
    public static function drawRectangleRoundedLinesEx(Rectangle $rec, float $roundness, int $segments, float $lineThick, Color $color): void
    {
        self::ffi()->DrawRectangleRoundedLinesEx($rec->struct(), $roundness, $segments, $lineThick, $color->struct());
    }

    /**
     * 绘制实心三角形（顶点逆时针顺序）
     *
     * @param Vector2 $v1 顶点1
     * @param Vector2 $v2 顶点2
     * @param Vector2 $v3 顶点3
     * @param Color $color 颜色
     * @return void
     */
    public static function drawTriangle(Vector2 $v1, Vector2 $v2, Vector2 $v3, Color $color): void
    {
        self::ffi()->DrawTriangle($v1->struct(), $v2->struct(), $v3->struct(), $color->struct());
    }

    /**
     * 绘制三角形轮廓线
     *
     * @param Vector2 $v1 顶点1
     * @param Vector2 $v2 顶点2
     * @param Vector2 $v3 顶点3
     * @param Color $color 颜色
     * @return void
     */
    public static function drawTriangleLines(Vector2 $v1, Vector2 $v2, Vector2 $v3, Color $color): void
    {
        self::ffi()->DrawTriangleLines($v1->struct(), $v2->struct(), $v3->struct(), $color->struct());
    }

    /**
     * 绘制三角形扇（第一个顶点为中心）
     *
     * @param Vector2[] $points 点集
     * @param Color $color 颜色
     * @return void
     */
    public static function drawTriangleFan(array $points, Color $color): void
    {
        $c_points = self::ffi()->new('Vector2[' . count($points) . ']');
        foreach ($points as $i => $point) {
            $c_points[$i] = $point->struct();
        }
        self::ffi()->DrawTriangleFan(self::ffi()->cast('Vector2*', $c_points), count($points), $color->struct());
    }

    /**
     * 绘制三角形带
     *
     * @param Vector2[] $points 点集
     * @param Color $color 颜色
     * @return void
     */
    public static function drawTriangleStrip(array $points, Color $color): void
    {
        $c_points = self::ffi()->new('Vector2[' . count($points) . ']');
        foreach ($points as $i => $point) {
            $c_points[$i] = $point->struct();
        }
        self::ffi()->DrawTriangleStrip(self::ffi()->cast('Vector2*', $c_points), count($points), $color->struct());
    }

    /**
     * 绘制正多边形（向量中心版）
     *
     * @param Vector2 $center 中心点
     * @param integer $sides 边数
     * @param float $radius 半径
     * @param float $rotation 旋转角度
     * @param Color $color 颜色
     * @return void
     */
    public static function drawPoly(Vector2 $center, int $sides, float $radius, float $rotation, Color $color): void
    {
        self::ffi()->DrawPoly($center->struct(), $sides, $radius, $rotation, $color->struct());
    }

    /**
     * 绘制正多边形轮廓线
     *
     * @param Vector2 $center 中心点
     * @param integer $sides 边数
     * @param float $radius 半径
     * @param float $rotation 旋转角度
     * @param Color $color 颜色
     * @return void
     */
    public static function drawPolyLines(Vector2 $center, int $sides, float $radius, float $rotation, Color $color): void
    {
        self::ffi()->DrawPolyLines($center->struct(), $sides, $radius, $rotation, $color->struct());
    }

    /**
     * 扩展参数多边形轮廓线
     *
     * @param Vector2 $center 中心点
     * @param integer $sides 边数
     * @param float $radius 半径
     * @param float $rotation 旋转角度
     * @param float $lineThick 轮廓线宽度
     * @param Color $color 颜色
     * @return void
     */
    public static function drawPolyLinesEx(Vector2 $center, int $sides, float $radius, float $rotation, float $lineThick, Color $color): void
    {
        self::ffi()->DrawPolyLinesEx($center->struct(), $sides, $radius, $rotation, $lineThick, $color->struct());
    }

    //### 样条曲线绘制函数

    /**
     * 绘制线性样条（至少2个点）
     *
     * @param Vector2[] $points 点集
     * @param integer $pointCount 点的数量
     * @param float $thick 粗细
     * @param Color $color 颜色
     * @return void
     */
    public static function drawSplineLinear(array $points, int $pointCount, float $thick, Color $color): void
    {
        $c_points = self::ffi()->new('Vector2[' . count($points) . ']');
        foreach ($points as $i => $point) {
            $c_points[$i] = $point->struct();
        }
        self::ffi()->DrawSplineLinear(self::ffi()->cast('Vector2*', $c_points), $pointCount, $thick, $color->struct());
    }

    /**
     * 绘制B样条曲线（至少4个点）
     *
     * @param Vector2[] $points 点集
     * @param float $thick 粗细
     * @param Color $color 颜色
     * @return void
     */
    public static function drawSplineBasis(array $points, float $thick, Color $color): void
    {
        $c_points = self::ffi()->new('Vector2[' . count($points) . ']');
        foreach ($points as $i => $point) {
            $c_points[$i] = $point->struct();
        }
        self::ffi()->DrawSplineBasis(self::ffi()->cast('Vector2*', $c_points), count($points), $thick, $color->struct());
    }

    /**
     * 绘制Catmull-Rom样条（至少4个点）
     *
     * @param Vector2[] $points 点集
     * @param float $thick 粗细
     * @param Color $color 颜色
     * @return void
     */
    public static function drawSplineCatmullRom(array $points, float $thick, Color $color): void
    {
        $c_points = self::ffi()->new('Vector2[' . count($points) . ']');
        foreach ($points as $i => $point) {
            $c_points[$i] = $point->struct();
        }
        self::ffi()->DrawSplineCatmullRom(self::ffi()->cast('Vector2*', $c_points), count($points), $thick, $color->struct());
    }

    /**
     * 绘制二次贝塞尔样条（至少3个点，1个控制点）
     *
     * @param Vector2[] $points 点集
     * @param float $thick 粗细
     * @param Color $color 颜色
     * @return void
     */
    public static function drawSplineBezierQuadratic(array $points, float $thick, Color $color): void
    {
        $c_points = self::ffi()->new('Vector2[' . count($points) . ']');
        foreach ($points as $i => $point) {
            $c_points[$i] = $point->struct();
        }
        self::ffi()->DrawSplineBezierQuadratic(self::ffi()->cast('Vector2*', $c_points), count($points), $thick, $color->struct());
    }

    /**
     * 绘制三次贝塞尔样条（至少4个点，2个控制点）
     *
     * @param Vector2[] $points 点集
     * @param float $thick 粗细
     * @param Color $color 颜色
     * @return void
     */
    public static function drawSplineBezierCubic(array $points, float $thick, Color $color): void
    {
        $c_points = self::ffi()->new('Vector2[' . count($points) . ']');
        foreach ($points as $i => $point) {
            $c_points[$i] = $point->struct();
        }
        self::ffi()->DrawSplineBezierCubic(self::ffi()->cast('Vector2*', $c_points), count($points), $thick, $color->struct());
    }

    /**
     * 绘制线性样条段（2个点）
     *
     * @param Vector2 $p1 起始点
     * @param Vector2 $p2 结束点
     * @param float $thick 粗细
     * @param Color $color 颜色
     * @return void
     */
    public static function drawSplineSegmentLinear(Vector2 $p1, Vector2 $p2, float $thick, Color $color): void
    {
        self::ffi()->DrawSplineSegmentLinear($p1->struct(), $p2->struct(), $thick, $color->struct());
    }

    /**
     * 绘制B样条段（4个点）
     *
     * @param Vector2 $p1 第一个点
     * @param Vector2 $p2 第二个点
     * @param Vector2 $p3 第三个点
     * @param Vector2 $p4 第四个点
     * @param float $thick 粗细
     * @param Color $color 颜色
     * @return void
     */
    public static function drawSplineSegmentBasis(Vector2 $p1, Vector2 $p2, Vector2 $p3, Vector2 $p4, float $thick, Color $color): void
    {
        self::ffi()->DrawSplineSegmentBasis($p1->struct(), $p2->struct(), $p3->struct(), $p4->struct(), $thick, $color->struct());
    }

    /**
     * 绘制Catmull-Rom样条段（4个点）
     *
     * @param Vector2 $p1 第一个点
     * @param Vector2 $p2 第二个点
     * @param Vector2 $p3 第三个点
     * @param Vector2 $p4 第四个点
     * @param float $thick 粗细
     * @param Color $color 颜色
     * @return void
     */
    public static function drawSplineSegmentCatmullRom(Vector2 $p1, Vector2 $p2, Vector2 $p3, Vector2 $p4, float $thick, Color $color): void
    {
        self::ffi()->DrawSplineSegmentCatmullRom($p1->struct(), $p2->struct(), $p3->struct(), $p4->struct(), $thick, $color->struct());
    }

    /**
     * 绘制二次贝塞尔段（2个点+1控制点）
     *
     * @param Vector2 $p1 起始点
     * @param Vector2 $c2 控制点
     * @param Vector2 $p3 结束点
     * @param float $thick 粗细
     * @param Color $color 颜色
     * @return void
     */
    public static function drawSplineSegmentBezierQuadratic(Vector2 $p1, Vector2 $c2, Vector2 $p3, float $thick, Color $color): void
    {
        self::ffi()->DrawSplineSegmentBezierQuadratic($p1->struct(), $c2->struct(), $p3->struct(), $thick, $color->struct());
    }

    /**
     * 绘制三次贝塞尔段（2个点+2控制点）
     *
     * @param Vector2 $p1 起始点
     * @param Vector2 $c2 第一控制点
     * @param Vector2 $c3 第二控制点
     * @param Vector2 $p4 结束点
     * @param float $thick 粗细
     * @param Color $color 颜色
     * @return void
     */
    public static function drawSplineSegmentBezierCubic(Vector2 $p1, Vector2 $c2, Vector2 $c3, Vector2 $p4, float $thick, Color $color): void
    {
        self::ffi()->DrawSplineSegmentBezierCubic($p1->struct(), $c2->struct(), $c3->struct(), $p4->struct(), $thick, $color->struct());
    }

    //### 样条曲线点插值计算函数（t范围[0.0f, 1.0f]）

    /**
     * 线性样条点插值计算
     *
     * @param Vector2 $startPos 起始点
     * @param Vector2 $endPos 结束点
     * @param float $t 插值参数
     * @return Vector2 返回插值点
     */
    public static function getSplinePointLinear(Vector2 $startPos, Vector2 $endPos, float $t): Vector2
    {
        return new Vector2(self::ffi()->GetSplinePointLinear($startPos->struct(), $endPos->struct(), $t));
    }

    /**
     * B样条点插值计算
     *
     * @param Vector2 $p1 第一个控制点
     * @param Vector2 $p2 第二个控制点
     * @param Vector2 $p3 第三个控制点
     * @param Vector2 $p4 第四个控制点
     * @param float $t 插值参数
     * @return Vector2 返回插值点
     */
    public static function getSplinePointBasis(Vector2 $p1, Vector2 $p2, Vector2 $p3, Vector2 $p4, float $t): Vector2
    {
        $res = self::ffi()->GetSplinePointBasis($p1->struct(), $p2->struct(), $p3->struct(), $p4->struct(), $t);
        return new Vector2($res->x, $res->y);
    }

    /**
     * Catmull-Rom样条点插值计算
     *
     * @param Vector2 $p1 第一个控制点
     * @param Vector2 $p2 第二个控制点
     * @param Vector2 $p3 第三个控制点
     * @param Vector2 $p4 第四个控制点
     * @param float $t 插值参数
     * @return Vector2 返回插值点
     */
    public static function getSplinePointCatmullRom(Vector2 $p1, Vector2 $p2, Vector2 $p3, Vector2 $p4, float $t): Vector2
    {
        $res = self::ffi()->GetSplinePointCatmullRom($p1->struct(), $p2->struct(), $p3->struct(), $p4->struct(), $t);
        return new Vector2($res->x, $res->y);
    }

    /**
     * 二次贝塞尔点插值计算
     *
     * @param Vector2 $p1 起始点
     * @param Vector2 $c2 控制点
     * @param Vector2 $p3 结束点
     * @param float $t 插值参数
     * @return Vector2 返回插值点
     */
    public static function getSplinePointBezierQuad(Vector2 $p1, Vector2 $c2, Vector2 $p3, float $t): Vector2
    {
        $res = self::ffi()->GetSplinePointBezierQuad($p1->struct(), $c2->struct(), $p3->struct(), $t);
        return new Vector2($res->x, $res->y);
    }

    /**
     * 三次贝塞尔点插值计算
     *
     * @param Vector2 $p1 起始点
     * @param Vector2 $c2 第一控制点
     * @param Vector2 $c3 第二控制点
     * @param Vector2 $p4 结束点
     * @param float $t 插值参数
     * @return Vector2 返回插值点
     */
    public static function getSplinePointBezierCubic(Vector2 $p1, Vector2 $c2, Vector2 $c3, Vector2 $p4, float $t): Vector2
    {
        $res = self::ffi()->GetSplinePointBezierCubic($p1->struct(), $c2->struct(), $c3->struct(), $p4->struct(), $t);
        return new Vector2($res->x, $res->y);
    }

    //### 基本形状碰撞检测函数

    /**
     * 检测两个矩形是否碰撞
     *
     * @param Rectangle $rec1 矩形1
     * @param Rectangle $rec2 矩形2
     * @return bool 返回是否碰撞
     */
    public static function checkCollisionRecs(Rectangle $rec1, Rectangle $rec2): bool
    {
        return self::ffi()->CheckCollisionRecs($rec1->struct(), $rec2->struct());
    }

    /**
     * 检测两个圆形是否碰撞
     *
     * @param Vector2 $center1 圆心1
     * @param float $radius1 半径1
     * @param Vector2 $center2 圆心2
     * @param float $radius2 半径2
     * @return bool 返回是否碰撞
     */
    public static function checkCollisionCircles(Vector2 $center1, float $radius1, Vector2 $center2, float $radius2): bool
    {
        return self::ffi()->CheckCollisionCircles($center1->struct(), $radius1, $center2->struct(), $radius2);
    }

    /**
     * 检测圆形与矩形是否碰撞
     *
     * @param Vector2 $center 圆心
     * @param float $radius 半径
     * @param Rectangle $rec 矩形
     * @return bool 返回是否碰撞
     */
    public static function checkCollisionCircleRec(Vector2 $center, float $radius, Rectangle $rec): bool
    {
        return self::ffi()->CheckCollisionCircleRec($center->struct(), $radius, $rec->struct());
    }

    /**
     * 检测圆形与线段是否碰撞
     *
     * @param Vector2 $center 圆心
     * @param float $radius 半径
     * @param Vector2 $p1 线段起点
     * @param Vector2 $p2 线段终点
     * @return bool 返回是否碰撞
     */
    public static function checkCollisionCircleLine(Vector2 $center, float $radius, Vector2 $p1, Vector2 $p2): bool
    {
        return self::ffi()->CheckCollisionCircleLine($center->struct(), $radius, $p1->struct(), $p2->struct());
    }

    /**
     * 检测点是否在矩形内
     *
     * @param Vector2 $point 点
     * @param Rectangle $rec 矩形
     * @return bool 返回是否在矩形内
     */
    public static function checkCollisionPointRec(Vector2 $point, Rectangle $rec): bool
    {
        return self::ffi()->CheckCollisionPointRec($point->struct(), $rec->struct());
    }

    /**
     * 检测点是否在圆形内
     *
     * @param Vector2 $point 点
     * @param Vector2 $center 圆心
     * @param float $radius 半径
     * @return bool 返回是否在圆形内
     */
    public static function checkCollisionPointCircle(Vector2 $point, Vector2 $center, float $radius): bool
    {
        return self::ffi()->CheckCollisionPointCircle($point->struct(), $center->struct(), $radius);
    }

    /**
     * 检测点是否在三角形内
     *
     * @param Vector2 $point 点
     * @param Vector2 $p1 顶点1
     * @param Vector2 $p2 顶点2
     * @param Vector2 $p3 顶点3
     * @return bool 返回是否在三角形内
     */
    public static function checkCollisionPointTriangle(Vector2 $point, Vector2 $p1, Vector2 $p2, Vector2 $p3): bool
    {
        return self::ffi()->CheckCollisionPointTriangle($point->struct(), $p1->struct(), $p2->struct(), $p3->struct());
    }

    /**
     * 检测点是否在线段上（带像素阈值）
     *
     * @param Vector2 $point 点
     * @param Vector2 $p1 线段起点
     * @param Vector2 $p2 线段终点
     * @param integer $threshold 像素阈值
     * @return bool 返回是否在线段上
     */
    public static function checkCollisionPointLine(Vector2 $point, Vector2 $p1, Vector2 $p2, int $threshold): bool
    {
        return self::ffi()->CheckCollisionPointLine($point->struct(), $p1->struct(), $p2->struct(), $threshold);
    }

    /**
     * 检测点是否在多边形内
     *
     * @param Vector2 $point 点
     * @param Vector2 $points 多边形点集    
     * @param integer $pointCount 点的数量
     * @return bool 返回是否在多边形内
     */
    public static function checkCollisionPointPoly(Vector2 $point, Vector2 $points, int $pointCount): bool
    {
        return self::ffi()->CheckCollisionPointPoly($point->struct(), $points->struct(), $pointCount);
    }

    /**
     * 检测两线段是否相交，返回碰撞点
     *
     * @param Vector2 $startPos1 线段1起点
     * @param Vector2 $endPos1 线段1终点
     * @param Vector2 $startPos2 线段2起点
     * @param Vector2 $endPos2 线段2终点
     * @param Vector2 $collisionPoint 输出参数，用于存储碰撞点
     * @return bool 返回是否相交
     */
    public static function checkCollisionLines(Vector2 $startPos1, Vector2 $endPos1, Vector2 $startPos2, Vector2 $endPos2, Vector2 $collisionPoint): bool
    {
        return self::ffi()->CheckCollisionLines($startPos1->struct(), $endPos1->struct(), $startPos2->struct(), $endPos2->struct(), $collisionPoint->struct());
    }

    /**
     * 获取两个矩形的碰撞重叠区域
     *
     * @param Rectangle $rec1 矩形1
     * @param Rectangle $rec2 矩形2
     * @return Rectangle 返回碰撞重叠区域
     */
    public static function getCollisionRec(Rectangle $rec1, Rectangle $rec2): Rectangle
    {
        $res = self::ffi()->GetCollisionRec($rec1->struct(), $rec2->struct());
        return new Rectangle($res->x, $res->y, $res->width, $res->height);
    }
}
