<?php
// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib;

/**
 * Gestures类
 */
class Gestures extends Base
{
    /**
     * 绘制线性样条线，至少需要2个点
     *
     * @param \FFI\CData $points 点数组
     * @param int $pointCount 点数量
     * @param float $thick 线宽
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawSplineLinear(\FFI\CData $points, int $pointCount, float $thick, \FFI\CData $color): void
    {
        self::ffi()->DrawSplineLinear($points, $pointCount, $thick, $color);
    }

    /**
     * 绘制B样条线，至少需要4个点
     *
     * @param \FFI\CData $points 点数组
     * @param int $pointCount 点数量
     * @param float $thick 线宽
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawSplineBasis(\FFI\CData $points, int $pointCount, float $thick, \FFI\CData $color): void
    {
        self::ffi()->DrawSplineBasis($points, $pointCount, $thick, $color);
    }

    /**
     * 绘制Catmull-Rom样条线，至少需要4个点
     *
     * @param \FFI\CData $points 点数组
     * @param int $pointCount 点数量
     * @param float $thick 线宽
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawSplineCatmullRom(\FFI\CData $points, int $pointCount, float $thick, \FFI\CData $color): void
    {
        self::ffi()->DrawSplineCatmullRom($points, $pointCount, $thick, $color);
    }

    /**
     * 绘制二次贝塞尔样条线，至少需要3个点（1个控制点）：[p1, c2, p3, c4...]
     *
     * @param \FFI\CData $points 点数组
     * @param int $pointCount 点数量
     * @param float $thick 线宽
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawSplineBezierQuadratic(\FFI\CData $points, int $pointCount, float $thick, \FFI\CData $color): void
    {
        self::ffi()->DrawSplineBezierQuadratic($points, $pointCount, $thick, $color);
    }

    /**
     * 绘制三次贝塞尔样条线，至少需要4个点（2个控制点）：[p1, c2, c3, p4, c5, c6...]
     *
     * @param \FFI\CData $points 点数组
     * @param int $pointCount 点数量
     * @param float $thick 线宽
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawSplineBezierCubic(\FFI\CData $points, int $pointCount, float $thick, \FFI\CData $color): void
    {
        self::ffi()->DrawSplineBezierCubic($points, $pointCount, $thick, $color);
    }

    /**
     * 绘制线性样条线段，需要2个点
     *
     * @param \FFI\CData $p1 点1
     * @param \FFI\CData $p2 点2
     * @param float $thick 线宽
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawSplineSegmentLinear(\FFI\CData $p1, \FFI\CData $p2, float $thick, \FFI\CData $color): void
    {
        self::ffi()->DrawSplineSegmentLinear($p1, $p2, $thick, $color);
    }

    /**
     * 绘制B样条线段，需要4个点
     *
     * @param \FFI\CData $p1 点1
     * @param \FFI\CData $p2 点2
     * @param \FFI\CData $p3 点3
     * @param \FFI\CData $p4 点4
     * @param float $thick 线宽
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawSplineSegmentBasis(\FFI\CData $p1, \FFI\CData $p2, \FFI\CData $p3, \FFI\CData $p4, float $thick, \FFI\CData $color): void
    {
        self::ffi()->DrawSplineSegmentBasis($p1, $p2, $p3, $p4, $thick, $color);
    }

    /**
     * 绘制Catmull-Rom样条线段，需要4个点
     *
     * @param \FFI\CData $p1 点1
     * @param \FFI\CData $p2 点2
     * @param \FFI\CData $p3 点3
     * @param \FFI\CData $p4 点4
     * @param float $thick 线宽
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawSplineSegmentCatmullRom(\FFI\CData $p1, \FFI\CData $p2, \FFI\CData $p3, \FFI\CData $p4, float $thick, \FFI\CData $color): void
    {
        self::ffi()->DrawSplineSegmentCatmullRom($p1, $p2, $p3, $p4, $thick, $color);
    }

    /**
     * 绘制二次贝塞尔样条线段，需要2个点和1个控制点
     *
     * @param \FFI\CData $p1 点1
     * @param \FFI\CData $c2 控制点2
     * @param \FFI\CData $p3 点3
     * @param float $thick 线宽
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawSplineSegmentBezierQuadratic(\FFI\CData $p1, \FFI\CData $c2, \FFI\CData $p3, float $thick, \FFI\CData $color): void
    {
        self::ffi()->DrawSplineSegmentBezierQuadratic($p1, $c2, $p3, $thick, $color);
    }

    /**
     * 绘制三次贝塞尔样条线段，需要2个点和2个控制点
     *
     * @param \FFI\CData $p1 点1
     * @param \FFI\CData $c2 控制点2
     * @param \FFI\CData $c3 控制点3
     * @param \FFI\CData $p4 点4
     * @param float $thick 线宽
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function drawSplineSegmentBezierCubic(\FFI\CData $p1, \FFI\CData $c2, \FFI\CData $c3, \FFI\CData $p4, float $thick, \FFI\CData $color): void
    {
        self::ffi()->DrawSplineSegmentBezierCubic($p1, $c2, $c3, $p4, $thick, $color);
    }

    // 样条线段点评估函数

    /**
     * 获取（评估）线性样条线上的点
     *
     * @param \FFI\CData $startPos 开始点
     * @param \FFI\CData $endPos 结束点
     * @param float $t t值
     * @return \FFI\CData 返回一个 Vector2 结构体的 CData 对象
     */
    public static function getSplinePointLinear(\FFI\CData $startPos, \FFI\CData $endPos, float $t): \FFI\CData
    {
        return self::ffi()->GetSplinePointLinear($startPos, $endPos, $t);
    }

    /**
     * 获取（评估）B样条线上的点
     *
     * @param \FFI\CData $p1 点1
     * @param \FFI\CData $p2 点2
     * @param \FFI\CData $p3 点3
     * @param \FFI\CData $p4 点4
     * @param float $t t值
     * @return \FFI\CData 返回一个 Vector2 结构体的 CData 对象
     */
    public static function getSplinePointBasis(\FFI\CData $p1, \FFI\CData $p2, \FFI\CData $p3, \FFI\CData $p4, float $t): \FFI\CData
    {
        return self::ffi()->GetSplinePointBasis($p1, $p2, $p3, $p4, $t);
    }

    /**
     * 获取（评估）Catmull-Rom样条线上的点
     *
     * @param \FFI\CData $p1 Vector2 p1
     * @param \FFI\CData $p2 Vector2 p2
     * @param \FFI\CData $p3 Vector2 p3
     * @param \FFI\CData $p4 Vector2 p4
     * @param float $t t值
     * @return \FFI\CData 返回一个 Vector2 结构体的 CData 对象
     */
    public static function getSplinePointCatmullRom(\FFI\CData $p1, \FFI\CData $p2, \FFI\CData $p3, \FFI\CData $p4, float $t): \FFI\CData
    {
        return self::ffi()->GetSplinePointCatmullRom($p1, $p2, $p3, $p4, $t);
    }

    /**
     * 获取（评估）二次贝塞尔样条线上的点
     *
     * @param \FFI\CData $p1 Vector2 p1
     * @param \FFI\CData $c2 Vector2 c2
     * @param \FFI\CData $p3 Vector2 p3
     * @param float $t t值
     * @return \FFI\CData 返回一个 Vector2 结构体的 CData 对象
     */
    public static function getSplinePointBezierQuad(\FFI\CData $p1, \FFI\CData $c2, \FFI\CData $p3, float $t): \FFI\CData
    {
        return self::ffi()->GetSplinePointBezierQuad($p1, $c2, $p3, $t);
    }

    /**
     * 获取（评估）三次贝塞尔样条线上的点
     *
     * @param \FFI\CData $p1 Vector2 p1
     * @param \FFI\CData $c2 Vector2 c2
     * @param \FFI\CData $c3 Vector2 c3
     * @param \FFI\CData $p4 Vector2 p4
     * @param float $t t值
     * @return \FFI\CData 返回一个 Vector2 结构体的 CData 对象
     */
    public static function getSplinePointBezierCubic(\FFI\CData $p1, \FFI\CData $c2, \FFI\CData $c3, \FFI\CData $p4, float $t): \FFI\CData
    {
        return self::ffi()->GetSplinePointBezierCubic($p1, $c2, $c3, $p4, $t);
    }

    /**
     * 检查两个矩形之间是否发生碰撞
     *
     * @param \FFI\CData $rec1 Rectangle rec1
     * @param \FFI\CData $rec2 Rectangle rec2
     * @return bool
     */
    public static function checkCollisionRecs(\FFI\CData $rec1, \FFI\CData $rec2): bool
    {
        return self::ffi()->CheckCollisionRecs($rec1, $rec2);
    }

    /**
     * 检查两个圆之间是否发生碰撞
     *
     * @param \FFI\CData $center1 Vector2 center1
     * @param float $radius1 半径1
     * @param \FFI\CData $center2 Vector2 center2
     * @param float $radius2 半径2
     * @return bool
     */
    public static function checkCollisionCircles(\FFI\CData $center1, float $radius1, \FFI\CData $center2, float $radius2): bool
    {
        return self::ffi()->CheckCollisionCircles($center1, $radius1, $center2, $radius2);
    }

    /**
     * 检查圆和矩形之间是否发生碰撞
     *
     * @param \FFI\CData $center Vector2 中心
     * @param float $radius 半径
     * @param \FFI\CData $rec Rectangle 矩形
     * @return bool
     */
    public static function checkCollisionCircleRec(\FFI\CData $center, float $radius, \FFI\CData $rec): bool
    {
        return self::ffi()->CheckCollisionCircleRec($center, $radius, $rec);
    }

    /**
     * 检查圆是否与由两点 [p1] 和 [p2] 构成的直线发生碰撞
     *
     * @param \FFI\CData $center Vector2 中心
     * @param float $radius 半径
     * @param \FFI\CData $p1 Vector2 p1
     * @param \FFI\CData $p2 Vector2 p2
     * @return bool
     */
    public static function checkCollisionCircleLine(\FFI\CData $center, float $radius, \FFI\CData $p1, \FFI\CData $p2): bool
    {
        return self::ffi()->CheckCollisionCircleLine($center, $radius, $p1, $p2);
    }

    /**
     * 检查点是否在矩形内部
     *
     * @param \FFI\CData $point Vector2 点
     * @param \FFI\CData $rec Rectangle 矩形
     * @return bool
     */
    public static function checkCollisionPointRec(\FFI\CData $point, \FFI\CData $rec): bool
    {
        return self::ffi()->CheckCollisionPointRec($point, $rec);
    }

    /**
     * 检查点是否在圆内部
     *
     * @param \FFI\CData $point Vector2 点
     * @param \FFI\CData $center Vector2 中心
     * @param float $radius 半径
     * @return bool
     */
    public static function checkCollisionPointCircle(\FFI\CData $point, \FFI\CData $center, float $radius): bool
    {
        return self::ffi()->CheckCollisionPointCircle($point, $center, $radius);
    }

    /**
     * 检查点是否在三角形内部
     *
     * @param \FFI\CData $point Vector2 点
     * @param \FFI\CData $p1 Vector2 p1
     * @param \FFI\CData $p2 Vector2 p2
     * @param \FFI\CData $p3 Vector2 p3
     * @return bool
     */
    public static function checkCollisionPointTriangle(\FFI\CData $point, \FFI\CData $p1, \FFI\CData $p2, \FFI\CData $p3): bool
    {
        return self::ffi()->CheckCollisionPointTriangle($point, $p1, $p2, $p3);
    }

    /**
     * 检查点是否在由两点 [p1] 和 [p2] 构成的直线上，允许一定的像素误差 [threshold]
     *
     * @param \FFI\CData $point Vector2 点
     * @param \FFI\CData $p1 Vector2 p1
     * @param \FFI\CData $p2 Vector2 p2
     * @param int $threshold 阈值
     * @return bool
     */
    public static function checkCollisionPointLine(\FFI\CData $point, \FFI\CData $p1, \FFI\CData $p2, int $threshold): bool
    {
        return self::ffi()->CheckCollisionPointLine($point, $p1, $p2, $threshold);
    }

    /**
     * 检查点是否在由顶点数组描述的多边形内部
     *
     * @param \FFI\CData $point Vector2 点
     * @param \FFI\CData $points Vector2* 点数组
     * @param int $pointCount 点数量
     * @return bool
     */
    public static function checkCollisionPointPoly(\FFI\CData $point, \FFI\CData $points, int $pointCount): bool
    {
        return self::ffi()->CheckCollisionPointPoly($point, $points, $pointCount);
    }

    /**
     * 检查由两个点定义的两条直线是否发生碰撞，通过引用返回碰撞点
     *
     * @param \FFI\CData $startPos1 Vector2 startPos1
     * @param \FFI\CData $endPos1 Vector2 endPos1
     * @param \FFI\CData $startPos2 Vector2 startPos2
     * @param \FFI\CData $endPos2 Vector2 endPos2
     * @param \FFI\CData $collisionPoint Vector2* 碰撞点
     * @return bool
     */
    public static function checkCollisionLines(\FFI\CData $startPos1, \FFI\CData $endPos1, \FFI\CData $startPos2, \FFI\CData $endPos2, \FFI\CData $collisionPoint): bool
    {
        return self::ffi()->CheckCollisionLines($startPos1, $endPos1, $startPos2, $endPos2, $collisionPoint);
    }

    /**
     * 获取两个矩形碰撞后的重叠矩形
     *
     * @param \FFI\CData $rec1 Rectangle rec1
     * @param \FFI\CData $rec2 Rectangle rec2
     * @return \FFI\CData 返回一个 Rectangle 结构体的 CData 对象
     */
    public static function getCollisionRec(\FFI\CData $rec1, \FFI\CData $rec2): \FFI\CData
    {
        return self::ffi()->GetCollisionRec($rec1, $rec2);
    }
}
