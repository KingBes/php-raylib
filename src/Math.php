<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib;

use FFI\CData;
use Kingbes\Raylib\Utils\Vector2;
use Kingbes\Raylib\Utils\Matrix;
use Kingbes\Raylib\Utils\Vector3;
use Kingbes\Raylib\Utils\Vector4;

/**
 * 数学类
 */
class Math extends Base
{
    /**
     * 将一个值限制在最小值和最大值之间
     *
     * @param float $value 要限制的值
     * @param float $min 最小值
     * @param float $max 最大值
     * @return float 限制在最小值和最大值之间的值
     */
    public static function clamp(float $value, float $min, float $max): float
    {
        return self::ffi()->Clamp($value, $min, $max);
    }

    /**
     * 线性插值
     *
     * @param float $start 开始值
     * @param float $end 结束值
     * @param float $amount 插值比例（0到1之间）
     * @return float 插值结果
     */
    public static function lerp(float $start, float $end, float $amount): float
    {
        return self::ffi()->Lerp($start, $end, $amount);
    }

    /**
     * 归一化一个值
     *
     * @param float $value 要归一化的值
     * @param float $start 最小值
     * @param float $end 最大值
     * @return float 归一化结果（0到1之间）
     */
    public static function normalize(float $value, float $start, float $end): float
    {
        return self::ffi()->Normalize($value, $start, $end);
    }

    /**
     * 重新映射一个值到新的范围
     *
     * @param float $value 要重新映射的值
     * @param float $start1 原始范围的最小值
     * @param float $end1 原始范围的最大值
     * @param float $start2 新范围的最小值
     * @param float $end2 新范围的最大值
     * @return float 重新映射到新范围的值
     */
    public static function remap(float $value, float $start1, float $end1, float $start2, float $end2): float
    {
        return self::ffi()->Remap($value, $start1, $end1, $start2, $end2);
    }

    /**
     * 包装一个值到指定的范围
     *
     * @param float $value 要包装的值
     * @param float $start 最小值
     * @param float $end 最大值
     * @return float 包装到指定范围的值
     */
    public static function wrap(float $value, float $start, float $end): float
    {
        return self::ffi()->Wrap($value, $start, $end);
    }

    /**
     * 检查两个浮点数是否相等（考虑精度问题）
     *
     * @param float $a 第一个浮点数
     * @param float $b 第二个浮点数
     * @return bool 如果两个浮点数在范围内相等，则返回true，否则返回false
     */
    public static function floatEquals(float $a, float $b): bool
    {
        return self::ffi()->FloatEquals($a, $b) === 1;
    }

    /**
     * 返回一个零向量2
     *
     * @return Vector2 Vector2 零向量2
     */
    public static function vector2Zero(): Vector2
    {
        $res = self::ffi()->Vector2Zero();
        return new Vector2($res->x, $res->y);
    }

    /**
     * 返回一个单位向量2
     *
     * @return Vector2 单位向量2
     */
    public static function vector2One(): Vector2
    {
        $res = self::ffi()->Vector2One();
        return new Vector2($res->x, $res->y);
    }

    /**
     * 向量2加法
     *
     * @param Vector2 $Vector2_1 向量2
     * @param Vector2 $Vector2_2 向量2
     * @return Vector2 向量2加法结果
     */
    public static function vector2Add(Vector2 $Vector2_1, Vector2 $Vector2_2): Vector2
    {
        $res = self::ffi()->Vector2Add($Vector2_1->struct(), $Vector2_2->struct());
        return new Vector2($res->x, $res->y);
    }

    /**
     * 向量2加法（值）
     *
     * @param Vector2 Vector2 $Vector2 向量2
     * @param float $add 要添加的值
     * @return Vector2 向量2加法结果
     */
    public static function vector2AddValue(Vector2 $Vector2, float $add): Vector2
    {
        $res = self::ffi()->Vector2AddValue($Vector2->struct(), $add);
        return new Vector2($res->x, $res->y);
    }

    /**
     * 向量2减法
     *
     * @param Vector2 $Vector2_1 向量2
     * @param Vector2 $Vector2_2 向量2
     * @return Vector2 向量2减法结果
     */
    public static function vector2Subtract(Vector2 $Vector2_1, Vector2 $Vector2_2): Vector2
    {
        $res = self::ffi()->Vector2Subtract($Vector2_1->struct(), $Vector2_2->struct());
        return new Vector2($res->x, $res->y);
    }

    /**
     * 向量2减法（值）
     *
     * @param Vector2 $Vector2 向量2
     * @param float $subtract 要减去的值
     * @return Vector2 向量2减法结果
     */
    public static function vector2SubtractValue(Vector2 $Vector2, float $subtract): Vector2
    {
        $res = self::ffi()->Vector2SubtractValue($Vector2->struct(), $subtract);
        return new Vector2($res->x, $res->y);
    }

    /**
     * 向量2长度
     *
     * @param Vector2 $Vector2 向量2    
     * @return float 向量2长度
     */
    public static function vector2Length(Vector2 $Vector2): float
    {
        return self::ffi()->Vector2Length($Vector2->struct());
    }

    /**
     * 向量2长度平方
     *
     * @param Vector2 $Vector2 向量2
     * @return float 向量2长度平方
     */
    public static function vector2LengthSqr(Vector2 $Vector2): float
    {
        return self::ffi()->Vector2LengthSqr($Vector2->struct());
    }

    /**
     * 向量2点积
     *
     * @param Vector2 $Vector2_1 向量2
     * @param Vector2 $Vector2_2 向量2
     * @return float 向量2点积
     */
    public static function vector2DotProduct(Vector2 $Vector2_1, Vector2 $Vector2_2): float
    {
        return self::ffi()->Vector2DotProduct($Vector2_1->struct(), $Vector2_2->struct());
    }

    /**
     * 向量2距离
     *
     * @param Vector2 $Vector2_1 向量2
     * @param Vector2 $Vector2_2 向量2
     * @return float 向量2距离
     */
    public static function vector2Distance(Vector2 $Vector2_1, Vector2 $Vector2_2): float
    {
        return self::ffi()->Vector2Distance($Vector2_1->struct(), $Vector2_2->struct());
    }

    /**
     * 向量2距离平方
     *
     * @param Vector2 $Vector2_1 向量2
     * @param Vector2 $Vector2_2 向量2
     * @return float 向量2距离平方
     */
    public static function vector2DistanceSqr(Vector2 $Vector2_1, Vector2 $Vector2_2): float
    {
        return self::ffi()->Vector2DistanceSqr($Vector2_1->struct(), $Vector2_2->struct());
    }

    /**
     * 向量2角度
     *
     * @param Vector2 $Vector2_1 向量2
     * @param Vector2 $Vector2_2 向量2
     * @return float 向量2角度
     */
    public static function vector2Angle(Vector2 $Vector2_1, Vector2 $Vector2_2): float
    {
        return self::ffi()->Vector2Angle($Vector2_1->struct(), $Vector2_2->struct());
    }

    /**
     * 向量2线角度
     *
     * @param Vector2 $Vector2_start 向量2
     * @param Vector2 $Vector2_end 向量2    
     * @return float 向量2线角度
     */
    public static function vector2LineAngle(Vector2 $Vector2_start, Vector2 $Vector2_end): float
    {
        return self::ffi()->Vector2LineAngle($Vector2_start->struct(), $Vector2_end->struct());
    }

    /**
     * 向量2缩放
     *
     * @param Vector2 $Vector2 向量2
     * @param float $scale 缩放值
     * @return Vector2 向量2缩放结果
     */
    public static function vector2Scale(Vector2 $Vector2, float $scale): Vector2
    {
        $res = self::ffi()->Vector2Scale($Vector2->struct(), $scale);
        return new Vector2($res->x, $res->y);
    }

    /**
     * 向量2乘法
     *
     * @param Vector2 $Vector2_1 向量2
     * @param Vector2 $Vector2_2 向量2
     * @return Vector2 向量2乘法结果
     */
    public static function vector2Multiply(Vector2 $Vector2_1, Vector2 $Vector2_2): Vector2
    {
        $res = self::ffi()->Vector2Multiply($Vector2_1->struct(), $Vector2_2->struct());
        return new Vector2($res->x, $res->y);
    }

    /**
     * 向量2取反
     *
     * @param Vector2 $Vector2 向量2
     * @return Vector2 向量2取反结果
     */
    public static function vector2Negate(Vector2 $Vector2): Vector2
    {
        $res = self::ffi()->Vector2Negate($Vector2->struct());
        return new Vector2($res->x, $res->y);
    }

    /**
     * 向量2除法
     *
     * @param Vector2 $Vector2_1 向量2
     * @param Vector2 $Vector2_2 向量2
     * @return Vector2 向量2除法结果
     */
    public static function vector2Divide(Vector2 $Vector2_1, Vector2 $Vector2_2): Vector2
    {
        $res = self::ffi()->Vector2Divide($Vector2_1->struct(), $Vector2_2->struct());
        return new Vector2($res->x, $res->y);
    }

    /**
     * 向量2归一化
     *
     * @param Vector2 $Vector2 向量2
     * @return Vector2 向量2归一化结果
     */
    public static function vector2Normalize(Vector2 $Vector2): Vector2
    {
        $res = self::ffi()->Vector2Normalize($Vector2->struct());
        return new Vector2($res->x, $res->y);
    }

    /**
     * 向量2变换
     *
     * @param Vector2 $Vector2 向量2
     * @param Matrix $Matrix 矩阵
     * @return Vector2 向量2变换结果
     */
    public static function vector2Transform(Vector2 $Vector2, Matrix $Matrix): Vector2
    {
        $res = self::ffi()->Vector2Transform($Vector2->struct(), $Matrix->struct());
        return new Vector2($res->x, $res->y);
    }

    /**
     * 向量2插值
     *
     * @param Vector2 $Vector2_1 向量2
     * @param Vector2 $Vector2_2 向量2
     * @param float $t 插值参数
     * @return Vector2 向量2插值结果
     */
    public static function vector2Lerp(Vector2 $Vector2_1, Vector2 $Vector2_2, float $t): Vector2
    {
        $res = self::ffi()->Vector2Lerp($Vector2_1->struct(), $Vector2_2->struct(), $t);
        return new Vector2($res->x, $res->y);
    }

    /**
     * 向量2反射
     *
     * @param Vector2 $Vector2 向量2
     * @param Vector2 $Normal 向量2
     * @return Vector2 向量2反射结果
     */
    public static function vector2Reflect(Vector2 $Vector2, Vector2 $Normal): Vector2
    {
        $res = self::ffi()->Vector2Reflect($Vector2->struct(), $Normal->struct());
        return new Vector2($res->x, $res->y);
    }

    /**
     * 向量2最小
     *
     * @param Vector2 $Vector2_1 向量2
     * @param Vector2 $Vector2_2 向量2
     * @return Vector2 向量2最小结果
     */
    public static function vector2Min(Vector2 $Vector2_1, Vector2 $Vector2_2): Vector2
    {
        $res = self::ffi()->Vector2Min($Vector2_1->struct(), $Vector2_2->struct());
        return new Vector2($res->x, $res->y);
    }

    /**
     * 向量2最大
     *
     * @param Vector2 $Vector2_1 向量2
     * @param Vector2 $Vector2_2 向量2
     * @return Vector2 向量2最大结果
     */
    public static function vector2Max(Vector2 $Vector2_1, Vector2 $Vector2_2): Vector2
    {
        $res = self::ffi()->Vector2Max($Vector2_1->struct(), $Vector2_2->struct());
        return new Vector2($res->x, $res->y);
    }

    /**
     * 向量2旋转
     *
     * @param Vector2 $Vector2 向量2
     * @param float $angle 角度
     * @return Vector2 向量2旋转结果
     */
    public static function vector2Rotate(Vector2 $Vector2, float $angle): Vector2
    {
        $res = self::ffi()->Vector2Rotate($Vector2->struct(), $angle);
        return new Vector2($res->x, $res->y);
    }

    /**
     * 向量2移动 towards
     *
     * @param Vector2 $Vector2 向量2
     * @param Vector2 $Target 向量2
     * @param float $maxDistanceDelta 最大距离
     * @return Vector2 向量2移动 towards 结果
     */
    public static function vector2MoveTowards(Vector2 $Vector2, Vector2 $Target, float $maxDistanceDelta): Vector2
    {
        $res = self::ffi()->Vector2MoveTowards($Vector2->struct(), $Target->struct(), $maxDistanceDelta);
        return new Vector2($res->x, $res->y);
    }

    /**
     * 向量2取反
     *
     * @param Vector2 $Vector2 向量2
     * @return Vector2 向量2取反结果
     */
    public static function vector2Invert(Vector2 $Vector2): Vector2
    {
        $res = self::ffi()->Vector2Invert($Vector2->struct());
        return new Vector2($res->x, $res->y);
    }

    /**
     * 向量2 限制在范围内
     *
     * @param Vector2 $Vector2 向量2
     * @param Vector2 $Min 向量2
     * @param Vector2 $Max 向量2
     * @return Vector2 向量2 限制在范围内 结果
     */
    public static function vector2Clamp(Vector2 $Vector2, Vector2 $Min, Vector2 $Max): Vector2
    {
        $res = self::ffi()->Vector2Clamp($Vector2->struct(), $Min->struct(), $Max->struct());
        return new Vector2($res->x, $res->y);
    }

    /**
     * 向量2 限制在范围内
     *
     * @param Vector2 $Vector2 向量2
     * @param float $Min 最小值
     * @param float $Max 最大值
     * @return Vector2 向量2 限制在范围内 结果
     */
    public static function vector2ClampValue(Vector2 $Vector2, float $Min, float $Max): Vector2
    {
        $res = self::ffi()->Vector2ClampValue($Vector2->struct(), $Min, $Max);
        return new Vector2($res->x, $res->y);
    }

    /**
     * 向量2 是否相等
     *
     * @param Vector2 $Vector2_1 向量2
     * @param Vector2 $Vector2_2 向量2
     * @return bool 向量2 是否相等 结果
     */
    public static function vector2Equals(Vector2 $Vector2_1, Vector2 $Vector2_2): bool
    {
        return self::ffi()->Vector2Equals($Vector2_1->struct(), $Vector2_2->struct()) == 1;
    }

    /**
     * 向量2 折射
     *
     * @param Vector2 $Vector2 向量2
     * @param Vector2 $Normal 向量2
     * @param float $indexRatio 折射率_ratio
     * @return Vector2 向量2 折射 结果
     */
    public static function vector2Refract(Vector2 $Vector2, Vector2 $Normal, float $indexRatio): Vector2
    {
        $res = self::ffi()->Vector2Refract($Vector2->struct(), $Normal->struct(), $indexRatio);
        return new Vector2($res->x, $res->y);
    }

    /**
     * 向量3 零向量
     *
     * @return Vector3 向量3 零向量 结果
     */
    public static function vector3Zero(): Vector3
    {
        return self::ffi()->Vector3Zero();
    }

    /**
     * 向量3 单位向量
     *
     * @return Vector3 向量3 单位向量 结果
     */
    public static function vector3One(): Vector3
    {
        return self::ffi()->Vector3One();
    }

    /**
     * 向量3 加法
     *
     * @param Vector3 $Vector3_1 向量3  
     * @param Vector3 $Vector3_2 向量3
     * @return Vector3 向量3 加法 结果
     */
    public static function vector3Add(Vector3 $Vector3_1, Vector3 $Vector3_2): Vector3
    {
        $res = self::ffi()->Vector3Add($Vector3_1->struct(), $Vector3_2->struct());
        return new Vector3($res->x, $res->y, $res->z);
    }

    /**
     * 向量3 加法
     *
     * @param Vector3 $Vector3 向量3
     * @param float $Value 值
     * @return Vector3 向量3 加法 结果
     */
    public static function vector3AddValue(Vector3 $Vector3, float $Value): Vector3
    {
        $res = self::ffi()->Vector3AddValue($Vector3->struct(), $Value);
        return new Vector3($res->x, $res->y, $res->z);
    }

    /**
     * 向量3 减法
     *
     * @param Vector3 $Vector3_1 向量3
     * @param Vector3 $Vector3_2 向量3  
     * @return Vector3 向量3 减法 结果
     */
    public static function vector3Subtract(Vector3 $Vector3_1, Vector3 $Vector3_2): Vector3
    {
        $res = self::ffi()->Vector3Subtract($Vector3_1->struct(), $Vector3_2->struct());
        return new Vector3($res->x, $res->y, $res->z);
    }

    /**
     * 向量3 减法
     *
     * @param Vector3 $Vector3 向量3
     * @param float $sub 值
     * @return Vector3 向量3 减法 结果
     */
    public static function vector3SubtractValue(Vector3 $Vector3, float $sub): Vector3
    {
        $res = self::ffi()->Vector3SubtractValue($Vector3->struct(), $sub);
        return new Vector3($res->x, $res->y, $res->z);
    }

    /**
     * 向量3 乘法
     *
     * @param Vector3 $Vector3 向量3
     * @param float $scalar 值
     * @return Vector3 向量3 乘法 结果
     */
    public static function vector3Scale(Vector3 $Vector3, float $scalar): Vector3
    {
        $res = self::ffi()->Vector3Scale($Vector3->struct(), $scalar);
        return new Vector3($res->x, $res->y, $res->z);
    }

    /**
     * 向量3 乘法
     *
     * @param Vector3 $Vector3_1 向量3
     * @param Vector3 $Vector3_2 向量3
     * @return Vector3 向量3 乘法 结果
     */
    public static function vector3Multiply(Vector3 $Vector3_1, Vector3 $Vector3_2): Vector3
    {
        $res = self::ffi()->Vector3Multiply($Vector3_1->struct(), $Vector3_2->struct());
        return new Vector3($res->x, $res->y, $res->z);
    }

    /**
     * 向量3 叉乘
     *
     * @param Vector3 $Vector3_1 向量3
     * @param Vector3 $Vector3_2 向量3
     * @return Vector3 向量3 叉乘 结果
     */
    public static function vector3CrossProduct(Vector3 $Vector3_1, Vector3 $Vector3_2): Vector3
    {
        $res = self::ffi()->Vector3CrossProduct($Vector3_1->struct(), $Vector3_2->struct());
        return new Vector3($res->x, $res->y, $res->z);
    }

    /**
     * 向量3 垂直向量
     *
     * @param Vector3 $Vector3 向量3
     * @return Vector3 向量3 垂直向量 结果
     */
    public static function vector3Perpendicular(Vector3 $Vector3): Vector3
    {
        $res = self::ffi()->Vector3Perpendicular($Vector3->struct());
        return new Vector3($res->x, $res->y, $res->z);
    }

    /**
     * 向量3 长度
     *
     * @param Vector3 $Vector3 向量3
     * @return float 向量3 长度 结果
     */
    public static function vector3Length(Vector3 $Vector3): float
    {
        return self::ffi()->Vector3Length($Vector3->struct());
    }

    /**
     * 向量3 长度平方
     *
     * @param Vector3 $Vector3 向量3
     * @return float 向量3 长度平方 结果
     */
    public static function vector3LengthSqr(Vector3 $Vector3): float
    {
        return self::ffi()->Vector3LengthSqr($Vector3->struct());
    }

    /**
     * 向量3 点乘
     *
     * @param Vector3 $Vector3_1 向量3
     * @param Vector3 $Vector3_2 向量3
     * @return float 向量3 点乘 结果
     */
    public static function vector3DotProduct(Vector3 $Vector3_1, Vector3 $Vector3_2): float
    {
        return self::ffi()->Vector3DotProduct($Vector3_1->struct(), $Vector3_2->struct());
    }

    /**
     * 向量3 距离
     *
     * @param Vector3 $Vector3_1 向量3
     * @param Vector3 $Vector3_2 向量3
     * @return float 向量3 距离 结果
     */
    public static function vector3Distance(Vector3 $Vector3_1, Vector3 $Vector3_2): float
    {
        return self::ffi()->Vector3Distance($Vector3_1->struct(), $Vector3_2->struct());
    }

    /**
     * 向量3 距离平方
     *
     * @param Vector3 $Vector3_1 向量3
     * @param Vector3 $Vector3_2 向量3
     * @return float 向量3 距离平方 结果
     */
    public static function vector3DistanceSqr(Vector3 $Vector3_1, Vector3 $Vector3_2): float
    {
        return self::ffi()->Vector3DistanceSqr($Vector3_1->struct(), $Vector3_2->struct());
    }

    /**
     * 向量3 角度
     *
     * @param Vector3 $Vector3_1 向量3
     * @param Vector3 $Vector3_2 向量3
     * @return float 向量3 角度 结果
     */
    public static function vector3Angle(Vector3 $Vector3_1, Vector3 $Vector3_2): float
    {
        return self::ffi()->Vector3Angle($Vector3_1->struct(), $Vector3_2->struct());
    }

    /**
     * 向量3 取反
     *
     * @param Vector3 $Vector3 向量3
     * @return Vector3 向量3 取反 结果
     */
    public static function vector3Negate(Vector3 $Vector3): Vector3
    {
        $res = self::ffi()->Vector3Negate($Vector3->struct());
        return new Vector3($res->x, $res->y, $res->z);
    }

    /**
     * 向量3 除法
     *
     * @param Vector3 $Vector3 向量3
     * @param float $div 值
     * @return Vector3 向量3 除法 结果
     */
    public static function vector3Divide(Vector3 $Vector3, float $div): Vector3
    {
        $res = self::ffi()->Vector3Divide($Vector3->struct(), $div);
        return new Vector3($res->x, $res->y, $res->z);
    }

    /**
     * 向量3 归一化
     *
     * @param Vector3 $Vector3 向量3
     * @return Vector3 向量3 归一化 结果
     */
    public static function vector3Normalize(Vector3 $Vector3): Vector3
    {
        $res = self::ffi()->Vector3Normalize($Vector3->struct());
        return new Vector3($res->x, $res->y, $res->z);
    }

    /**
     * 向量3 投影
     *
     * @param Vector3 $Vector3 向量3
     * @param Vector3 $onNormal 向量3
     * @return Vector3 向量3 投影 结果
     */
    public static function vector3Project(Vector3 $Vector3, Vector3 $onNormal): Vector3
    {
        $res = self::ffi()->Vector3Project($Vector3->struct(), $onNormal->struct());
        return new Vector3($res->x, $res->y, $res->z);
    }

    /**
     * 向量3 拒绝
     *
     * @param Vector3 $Vector3 向量3
     * @param Vector3 $onNormal 向量3
     * @return Vector3 向量3 拒绝 结果
     */
    public static function vector3Reject(Vector3 $Vector3, Vector3 $onNormal): Vector3
    {
        $res = self::ffi()->Vector3Reject($Vector3->struct(), $onNormal->struct());
        return new Vector3($res->x, $res->y, $res->z);
    }

    /**
     * 向量3 正交归一化
     *
     * @param Vector3 $Vector3 向量3
     * @return Vector3 向量3 正交归一化 结果
     */
    public static function vector3OrthoNormalize(Vector3 $Vector3): Vector3
    {
        $res = self::ffi()->Vector3OrthoNormalize($Vector3->struct());
        return new Vector3($res->x, $res->y, $res->z);
    }

    /**
     * 向量3 变换
     *
     * @param Vector3 $Vector3 向量3
     * @param Matrix $matrix 矩阵
     * @return Vector3 向量3 变换 结果
     */
    public static function vector3Transform(Vector3 $Vector3, Matrix $matrix): Vector3
    {
        $res = self::ffi()->Vector3Transform($Vector3->struct(), $matrix->struct());
        return new Vector3($res->x, $res->y, $res->z);
    }

    /**
     * 向量3 四元数旋转
     *
     * @param Vector3 $Vector3 向量3
     * @param Vector4 $quaternion 四元数
     * @return Vector3 向量3 四元数旋转 结果
     */
    public static function vector3RotateByQuaternion(Vector3 $Vector3, Vector4 $quaternion): Vector3
    {
        $res = self::ffi()->Vector3RotateByQuaternion($Vector3->struct(), $quaternion->struct());
        return new Vector3($res->x, $res->y, $res->z);
    }

    /**
     * 向量3 轴角旋转
     *
     * @param Vector3 $Vector3 向量3
     * @param Vector3 $axis 向量3
     * @param float $angle 角度
     * @return Vector3 向量3 轴角旋转 结果
     */
    public static function vector3RotateByAxisAngle(Vector3 $Vector3, Vector3 $axis, float $angle): Vector3
    {
        $res = self::ffi()->Vector3RotateByAxisAngle($Vector3->struct(), $axis->struct(), $angle);
        return new Vector3($res->x, $res->y, $res->z);
    }

    /**
     * 向量3 移动方向
     *
     * @param Vector3 $Vector3 向量3
     * @param Vector3 $target 向量3
     * @param float $maxDistanceDelta 最大距离增量
     * @return Vector3 向量3 移动方向 结果
     */
    public static function vector3MoveTowards(Vector3 $Vector3, Vector3 $target, float $maxDistanceDelta): Vector3
    {
        $res = self::ffi()->Vector3MoveTowards($Vector3->struct(), $target->struct(), $maxDistanceDelta);
        return new Vector3($res->x, $res->y, $res->z);
    }

    /**
     * 向量3 线性插值
     *
     * @param Vector3 $Vector3 向量3
     * @param Vector3 $target 向量3
     * @param float $t 插值参数
     * @return Vector3 向量3 线性插值 结果
     */
    public static function vector3Lerp(Vector3 $Vector3, Vector3 $target, float $t): Vector3
    {
        $res = self::ffi()->Vector3Lerp($Vector3->struct(), $target->struct(), $t);
        return new Vector3($res->x, $res->y, $res->z);
    }

    /**
     * 向量3 三次 Hermite 插值
     *
     * @param Vector3 $Vector3 向量3
     * @param Vector3 $target 向量3
     * @param float $t 插值参数
     * @return Vector3 向量3 三次 Hermite 插值 结果 
     */
    public static function vector3CubicHermite(Vector3 $Vector3, Vector3 $target, float $t): Vector3
    {
        $res = self::ffi()->Vector3CubicHermite($Vector3->struct(), $target->struct(), $t);
        return new Vector3($res->x, $res->y, $res->z);
    }

    /**
     * 向量3 反射
     *
     * @param Vector3 $Vector3 向量3
     * @param Vector3 $onNormal 向量3
     * @return Vector3 向量3 反射 结果
     */
    public static function vector3Reflect(Vector3 $Vector3, Vector3 $onNormal): Vector3
    {
        $res = self::ffi()->Vector3Reflect($Vector3->struct(), $onNormal->struct());
        return new Vector3($res->x, $res->y, $res->z);
    }

    /**
     * 向量3 最小
     *
     * @param Vector3 $Vector3 向量3
     * @param Vector3 $target 向量3
     * @return Vector3 向量3 最小 结果
     */
    public static function vector3Min(Vector3 $Vector3, Vector3 $target): Vector3
    {
        $res = self::ffi()->Vector3Min($Vector3->struct(), $target->struct());
        return new Vector3($res->x, $res->y, $res->z);
    }

    /**
     * 向量3 最大
     *
     * @param Vector3 $Vector3 向量3
     * @param Vector3 $target 向量3
     * @return Vector3 向量3 最大 结果
     */
    public static function vector3Max(Vector3 $Vector3, Vector3 $target): Vector3
    {
        $res = self::ffi()->Vector3Max($Vector3->struct(), $target->struct());
        return new Vector3($res->x, $res->y, $res->z);
    }

    /**
     * 向量3 重心坐标
     *
     * @param Vector3 $Vector3 向量3
     * @param Vector3 $v1 向量3
     * @param Vector3 $v2 向量3
     * @param Vector3 $v3 向量3
     * @return Vector3 向量3 重心坐标 结果
     */
    public static function vector3Barycenter(Vector3 $Vector3, Vector3 $v1, Vector3 $v2, Vector3 $v3): Vector3
    {
        $res = self::ffi()->Vector3Barycenter($Vector3->struct(), $v1->struct(), $v2->struct(), $v3->struct());
        return new Vector3($res->x, $res->y, $res->z);
    }

    /**
     * 向量3 投影
     *
     * @param Vector3 $Vector3 向量3
     * @param Vector3 $source 向量3
     * @param Vector3 $target 向量3
     * @return Vector3 向量3 投影 结果
     */
    public static function vector3Project(Vector3 $Vector3, Vector3 $source, Vector3 $target): Vector3
    {
        $res = self::ffi()->Vector3Project($Vector3->struct(), $source->struct(), $target->struct());
        return new Vector3($res->x, $res->y, $res->z);
    }

    /**
     * 向量3 拒绝
     *
     * @param Vector3 $Vector3 向量3
     * @param Vector3 $onNormal 向量3
     * @return Vector3 向量3 拒绝 结果
     */
    public static function vector3Reject(Vector3 $Vector3, Vector3 $onNormal): Vector3
    {
        $res = self::ffi()->Vector3Reject($Vector3->struct(), $onNormal->struct());
        return new Vector3($res->x, $res->y, $res->z);
    }

    /**
     * 向量3 正交化归一化
     *
     * @param Vector3 $Vector3 向量3
     * @param Vector3 $v1 向量3
     * @param Vector3 $v2 向量3
     * @param Vector3 $v3 向量3
     * @return Vector3 向量3 正交化归一化 结果
     */
    public static function vector3OrthoNormalize(Vector3 $Vector3, Vector3 $v1, Vector3 $v2, Vector3 $v3): Vector3
    {
        $res = self::ffi()->Vector3OrthoNormalize($Vector3->struct(), $v1->struct(), $v2->struct(), $v3->struct());
        return new Vector3($res->x, $res->y, $res->z);
    }

    /**
     * 向量3 变换
     *
     * @param Vector3 $Vector3 向量3
     * @param Matrix $matrix 矩阵
     * @return Vector3 向量3 变换 结果
     */
    public static function vector3Transform(Vector3 $Vector3, Matrix $matrix): Vector3
    {
        $res = self::ffi()->Vector3Transform($Vector3->struct(), $matrix->struct());
        return new Vector3($res->x, $res->y, $res->z);
    }

    /**
     * 向量3 四元数旋转
     *
     * @param Vector3 $Vector3 向量3
     * @param Vector4 $quaternion 四元数
     * @return Vector3 向量3 四元数旋转 结果
     */
    public static function vector3RotateByQuaternion(Vector3 $Vector3, Vector4 $quaternion): Vector3
    {
        $res = self::ffi()->Vector3RotateByQuaternion($Vector3->struct(), $quaternion->struct());
        return new Vector3($res->x, $res->y, $res->z);
    }

    /**
     * 向量3 轴角旋转
     *
     * @param Vector3 $Vector3 向量3        
     * @param Vector3 $axis 向量3
     * @param float $angle 角度
     * @return Vector3 向量3 轴角旋转 结果
     */
    public static function vector3RotateByAxisAngle(Vector3 $Vector3, Vector3 $axis, float $angle): Vector3
    {
        $res = self::ffi()->Vector3RotateByAxisAngle($Vector3->struct(), $axis->struct(), $angle);
        return new Vector3($res->x, $res->y, $res->z);
    }

    /**
     * 向量3 移动 towards
     *
     * @param Vector3 $Vector3 向量3
     * @param Vector3 $target 向量3
     * @param float $maxDistanceDelta 最大距离增量
     * @return Vector3 向量3 移动 towards 结果
     */
    public static function vector3MoveTowards(Vector3 $Vector3, Vector3 $target, float $maxDistanceDelta): Vector3
    {
        $res = self::ffi()->Vector3MoveTowards($Vector3->struct(), $target->struct(), $maxDistanceDelta);
        return new Vector3($res->x, $res->y, $res->z);
    }

    /**
     * 向量3 线性插值
     *
     * @param Vector3 $Vector3 向量3
     * @param Vector3 $target 向量3
     * @param float $amount 插值比例
     * @return Vector3 向量3 线性插值 结果
     */
    public static function vector3Lerp(Vector3 $Vector3, Vector3 $target, float $amount): Vector3
    {
        $res = self::ffi()->Vector3Lerp($Vector3->struct(), $target->struct(), $amount);
        return new Vector3($res->x, $res->y, $res->z);
    }

    /**
     * 向量3 三次 Hermite 插值
     *
     * @param Vector3 $Vector3 向量3
     * @param Vector3 $start 向量3
     * @param Vector3 $end 向量3
     * @param Vector3 $startTangent 向量3
     * @param Vector3 $endTangent 向量3
     * @param float $amount 插值比例
     * @return Vector3 向量3 三次 Hermite 插值 结果
     */
    public static function vector3CubicHermite(Vector3 $Vector3, Vector3 $start, Vector3 $end, Vector3 $startTangent, Vector3 $endTangent, float $amount): Vector3
    {
        $res = self::ffi()->Vector3CubicHermite($Vector3->struct(), $start->struct(), $end->struct(), $startTangent->struct(), $endTangent->struct(), $amount);
        return new Vector3($res->x, $res->y, $res->z);
    }

    /**
     * 向量3 反射
     *
     * @param Vector3 $Vector3 向量3
     * @param Vector3 $onNormal 向量3
     * @return Vector3 向量3 反射 结果
     */
    public static function vector3Reflect(Vector3 $Vector3, Vector3 $onNormal): Vector3
    {
        $res = self::ffi()->Vector3Reflect($Vector3->struct(), $onNormal->struct());
        return new Vector3($res->x, $res->y, $res->z);
    }

    /**
     * 向量3 最小
     *
     * @param Vector3 $Vector3_1 向量3
     * @param Vector3 $Vector3_2 向量3
     * @return Vector3 向量3 最小 结果
     */
    public static function vector3Min(Vector3 $Vector3_1, Vector3 $Vector3_2): Vector3
    {
        $res = self::ffi()->Vector3Min($Vector3_1->struct(), $Vector3_2->struct());
        return new Vector3($res->x, $res->y, $res->z);
    }

    /**
     * 向量3 最大
     *
     * @param Vector3 $Vector3_1 向量3
     * @param Vector3 $Vector3_2 向量3
     * @return Vector3 向量3 最大 结果
     */
    public static function vector3Max(Vector3 $Vector3_1, Vector3 $Vector3_2): Vector3
    {
        $res = self::ffi()->Vector3Max($Vector3_1->struct(), $Vector3_2->struct());
        return new Vector3($res->x, $res->y, $res->z);
    }

    /**
     * 向量3 重心坐标
     *
     * @param Vector3 $Vector3_p 向量3
     * @param Vector3 $Vector3_a 向量3
     * @param Vector3 $Vector3_b 向量3
     * @param Vector3 $Vector3_c 向量3
     * @return Vector3 向量3 重心坐标 结果
     */
    public static function vector3Barycenter(Vector3 $Vector3_p, Vector3 $Vector3_a, Vector3 $Vector3_b, Vector3 $Vector3_c): Vector3
    {
        $res = self::ffi()->Vector3Barycenter($Vector3_p->struct(), $Vector3_a->struct(), $Vector3_b->struct(), $Vector3_c->struct());
        return new Vector3($res->x, $res->y, $res->z);
    }

    /**
     * 向量3 反投影
     *
     * @param Vector3 $Vector3 向量3
     * @param Matrix $matrix 矩阵
     * @param Rectangle $viewport 矩形
     * @return Vector3 向量3 反投影 结果
     */
    public static function vector3Unproject(Vector3 $Vector3, Matrix $matrix, Rectangle $viewport): Vector3
    {
        $res = self::ffi()->Vector3Unproject($Vector3->struct(), $matrix->struct(), $viewport->struct());
        return new Vector3($res->x, $res->y, $res->z);
    }

    /**
     * 向量3 转换为 float 对象
     *
     * @param Vector3 $Vector3 向量3
     * @return CData float3 浮点数对象
     */
    public static function vector3ToFloatV(Vector3 $Vector3): CData
    {
        return self::ffi()->Vector3ToFloatV($Vector3->struct());
    }

    /**
     * 向量3 反方向
     *
     * @param Vector3 $Vector3 向量3
     * @return Vector3 向量3 反方向 结果
     */
    public static function vector3Invert(Vector3 $Vector3): Vector3
    {
        $res = self::ffi()->Vector3Invert($Vector3->struct());
        return new Vector3($res->x, $res->y, $res->z);
    }

    /**
     * 向量3 范围
     *
     * @param Vector3 $Vector3 向量3
     * @param Vector3 $min 向量3
     * @param Vector3 $max 向量3
     * @return Vector3 向量3 范围 结果
     */
    public static function vector3Clamp(Vector3 $Vector3, Vector3 $min, Vector3 $max): Vector3
    {
        $res = self::ffi()->Vector3Clamp($Vector3->struct(), $min->struct(), $max->struct());
        return new Vector3($res->x, $res->y, $res->z);
    }

    /**
     * 向量3 范围值
     *
     * @param Vector3 $Vector3 向量3
     * @param float $min 最小值
     * @param float $max 最大值
     * @return Vector3 向量3 范围值 结果
     */
    public static function vector3ClampValue(Vector3 $Vector3, float $min, float $max): Vector3
    {
        $res = self::ffi()->Vector3ClampValue($Vector3->struct(), $min, $max);
        return new Vector3($res->x, $res->y, $res->z);
    }

    /**
     * 向量3 是否相等
     *
     * @param Vector3 $Vector3_1 向量3
     * @param Vector3 $Vector3_2 向量3
     * @return bool 向量3 是否相等 结果
     */
    public static function vector3Equals(Vector3 $Vector3_1, Vector3 $Vector3_2): bool
    {
        return self::ffi()->Vector3Equals($Vector3_1->struct(), $Vector3_2->struct()) == 1;
    }

    /**
     * 向量3 折射
     *
     * @param Vector3 $Vector3 向量3
     * @param Vector3 $onNormal 向量3
     * @param float $refractionIndex 折射索引
     * @return Vector3 向量3 折射 结果
     */
    public static function vector3Refract(Vector3 $Vector3, Vector3 $onNormal, float $refractionIndex): Vector3
    {
        $res = self::ffi()->Vector3Refract($Vector3->struct(), $onNormal->struct(), $refractionIndex);
        return new Vector3($res->x, $res->y, $res->z);
    }

    /**
     * 向量4 零
     *
     * @return Vector4 向量4 零 结果
     */
    public static function vector4Zero(): Vector4
    {
        $res = self::ffi()->Vector4Zero();
        return new Vector4($res->x, $res->y, $res->z, $res->w);
    }

    /**
     * 向量4 一
     *
     * @return Vector4 向量4 一 结果
     */
    public static function vector4One(): Vector4
    {
        $res = self::ffi()->Vector4One();
        return new Vector4($res->x, $res->y, $res->z, $res->w);
    }

    /**
     * 向量4 加法
     *
     * @param Vector4 $Vector4_1 向量4
     * @param Vector4 $Vector4_2 向量4
     * @return Vector4 向量4 加法 结果
     */
    public static function vector4Add(Vector4 $Vector4_1, Vector4 $Vector4_2): Vector4
    {
        $res = self::ffi()->Vector4Add($Vector4_1->struct(), $Vector4_2->struct());
        return new Vector4($res->x, $res->y, $res->z, $res->w);
    }

    /**
     * 向量4 加法值
     *
     * @param Vector4 $Vector4 向量4
     * @param float $value 值
     * @return Vector4 向量4 加法值 结果
     */
    public static function vector4AddValue(Vector4 $Vector4, float $value): Vector4
    {
        $res = self::ffi()->Vector4AddValue($Vector4->struct(), $value);
        return new Vector4($res->x, $res->y, $res->z, $res->w);
    }

    /**
     * 向量4 减法
     *
     * @param Vector4 $Vector4_1 向量4
     * @param Vector4 $Vector4_2 向量4
     * @return Vector4 向量4 减法 结果
     */
    public static function vector4Subtract(Vector4 $Vector4_1, Vector4 $Vector4_2): Vector4
    {
        $res = self::ffi()->Vector4Subtract($Vector4_1->struct(), $Vector4_2->struct());
        return new Vector4($res->x, $res->y, $res->z, $res->w);
    }

    /**
     * 向量4 减法值
     *
     * @param Vector4 $Vector4 向量4
     * @param float $value 值
     * @return Vector4 向量4 减法值 结果
     */
    public static function vector4SubtractValue(Vector4 $Vector4, float $value): Vector4
    {
        $res = self::ffi()->Vector4SubtractValue($Vector4->struct(), $value);
        return new Vector4($res->x, $res->y, $res->z, $res->w);
    }

    /**
     * 向量4 长度
     *
     * @param Vector4 $Vector4 向量4
     * @return float 向量4 长度 结果
     */
    public static function vector4Length(Vector4 $Vector4): float
    {
        return self::ffi()->Vector4Length($Vector4->struct());
    }

    /**
     * 向量4 长度平方
     *
     * @param Vector4 $Vector4 向量4
     * @return float 向量4 长度平方 结果
     */
    public static function vector4LengthSqr(Vector4 $Vector4): float
    {
        return self::ffi()->Vector4LengthSqr($Vector4->struct());
    }

    /**
     * 向量4 点积
     *
     * @param Vector4 $Vector4_1 向量4
     * @param Vector4 $Vector4_2 向量4
     * @return float 向量4 点积 结果
     */
    public static function vector4DotProduct(Vector4 $Vector4_1, Vector4 $Vector4_2): float
    {
        return self::ffi()->Vector4DotProduct($Vector4_1->struct(), $Vector4_2->struct());
    }

    /**
     * 向量4 距离
     *
     * @param Vector4 $Vector4_1 向量4
     * @param Vector4 $Vector4_2 向量4
     * @return float 向量4 距离 结果
     */
    public static function vector4Distance(Vector4 $Vector4_1, Vector4 $Vector4_2): float
    {
        return self::ffi()->Vector4Distance($Vector4_1->struct(), $Vector4_2->struct());
    }

    /**
     * 向量4 距离平方
     *
     * @param Vector4 $Vector4_1 向量4
     * @param Vector4 $Vector4_2 向量4
     * @return float 向量4 距离平方 结果
     */
    public static function vector4DistanceSqr(Vector4 $Vector4_1, Vector4 $Vector4_2): float
    {
        return self::ffi()->Vector4DistanceSqr($Vector4_1->struct(), $Vector4_2->struct());
    }

    /**
     * 向量4 缩放
     *
     * @param Vector4 $Vector4 向量4
     * @param float $scalar 标量
     * @return Vector4 向量4 缩放 结果
     */
    public static function vector4Scale(Vector4 $Vector4, float $scalar): Vector4
    {
        $res = self::ffi()->Vector4Scale($Vector4->struct(), $scalar);
        return new Vector4($res->x, $res->y, $res->z, $res->w);
    }

    /**
     * 向量4 乘法
     *
     * @param Vector4 $Vector4_1 向量4
     * @param Vector4 $Vector4_2 向量4
     * @return Vector4 向量4 乘法 结果
     */
    public static function vector4Multiply(Vector4 $Vector4_1, Vector4 $Vector4_2): Vector4
    {
        $res = self::ffi()->Vector4Multiply($Vector4_1->struct(), $Vector4_2->struct());
        return new Vector4($res->x, $res->y, $res->z, $res->w);
    }

    /**
     * 向量4 取反
     *
     * @param Vector4 $Vector4 向量4
     * @return Vector4 向量4 取反 结果
     */
    public static function vector4Negate(Vector4 $Vector4): Vector4
    {
        $res = self::ffi()->Vector4Negate($Vector4->struct());
        return new Vector4($res->x, $res->y, $res->z, $res->w);
    }

    /**
     * 向量4 除法
     *
     * @param Vector4 $Vector4_1 向量4
     * @param Vector4 $Vector4_2 向量4
     * @return Vector4 向量4 除法 结果
     */
    public static function vector4Divide(Vector4 $Vector4_1, Vector4 $Vector4_2): Vector4
    {
        $res = self::ffi()->Vector4Divide($Vector4_1->struct(), $Vector4_2->struct());
        return new Vector4($res->x, $res->y, $res->z, $res->w);
    }

    /**
     * 向量4 归一化
     *
     * @param Vector4 $Vector4 向量4
     * @return Vector4 向量4 归一化 结果
     */
    public static function vector4Normalize(Vector4 $Vector4): Vector4
    {
        $res = self::ffi()->Vector4Normalize($Vector4->struct());
        return new Vector4($res->x, $res->y, $res->z, $res->w);
    }

    /**
     * 向量4 最小值
     *
     * @param Vector4 $Vector4_1 向量4
     * @param Vector4 $Vector4_2 向量4
     * @return Vector4 向量4 最小值 结果
     */
    public static function vector4Min(Vector4 $Vector4_1, Vector4 $Vector4_2): Vector4
    {
        $res = self::ffi()->Vector4Min($Vector4_1->struct(), $Vector4_2->struct());
        return new Vector4($res->x, $res->y, $res->z, $res->w);
    }

    /**
     * 向量4 最大值
     *
     * @param Vector4 $Vector4_1 向量4
     * @param Vector4 $Vector4_2 向量4
     * @return Vector4 向量4 最大值 结果
     */
    public static function vector4Max(Vector4 $Vector4_1, Vector4 $Vector4_2): Vector4
    {
        $res = self::ffi()->Vector4Max($Vector4_1->struct(), $Vector4_2->struct());
        return new Vector4($res->x, $res->y, $res->z, $res->w);
    }

    /**
     * 向量4 插值
     *
     * @param Vector4 $Vector4_1 向量4
     * @param Vector4 $Vector4_2 向量4
     * @param float $amount 插值参数
     * @return Vector4 向量4 插值 结果
     */
    public static function vector4Lerp(Vector4 $Vector4_1, Vector4 $Vector4_2, float $amount): Vector4
    {
        $res = self::ffi()->Vector4Lerp($Vector4_1->struct(), $Vector4_2->struct(), $amount);
        return new Vector4($res->x, $res->y, $res->z, $res->w);
    }

    /**
     * 向量4 移动方向
     *
     * @param Vector4 $Vector4_1 向量4
     * @param Vector4 $Vector4_2 向量4
     * @param float $maxDistanceDelta 最大移动距离
     * @return Vector4 向量4 移动方向 结果
     */
    public static function vector4MoveTowards(Vector4 $Vector4_1, Vector4 $Vector4_2, float $maxDistanceDelta): Vector4
    {
        $res = self::ffi()->Vector4MoveTowards($Vector4_1->struct(), $Vector4_2->struct(), $maxDistanceDelta);
        return new Vector4($res->x, $res->y, $res->z, $res->w);
    }

    /**
     * 向量4 取反
     *
     * @param Vector4 $Vector4 向量4        
     * @return Vector4 向量4 取反 结果
     */
    public static function vector4Invert(Vector4 $Vector4): Vector4
    {
        $res = self::ffi()->Vector4Invert($Vector4->struct());
        return new Vector4($res->x, $res->y, $res->z, $res->w);
    }

    /**
     * 向量4 是否相等
     *
     * @param Vector4 $Vector4_1 向量4
     * @param Vector4 $Vector4_2 向量4
     * @return bool 向量4 是否相等 结果
     */
    public static function vector4Equals(Vector4 $Vector4_1, Vector4 $Vector4_2): bool
    {
        return self::ffi()->Vector4Equals($Vector4_1->struct(), $Vector4_2->struct()) == 1;
    }

    /**
     * 矩阵4 行列式
     *
     * @param Matrix $Matrix 矩阵4
     * @return float 矩阵4 行列式 结果
     */
    public static function matrixDeterminant(Matrix $Matrix): float
    {
        return self::ffi()->MatrixDeterminant($Matrix->struct());
    }

    /**
     * 矩阵4 迹
     *
     * @param Matrix $Matrix 矩阵4
     * @return float 矩阵4 迹 结果
     */
    public static function matrixTrace(Matrix $Matrix): float
    {
        return self::ffi()->MatrixTrace($Matrix->struct());
    }

    /**
     * 矩阵4 转置
     *
     * @param Matrix $Matrix 矩阵4
     * @return Matrix 矩阵4 转置 结果
     */
    public static function matrixTranspose(Matrix $Matrix): Matrix
    {
        $res = self::ffi()->MatrixTranspose($Matrix->struct());
        return new Matrix(
            [$res->m0, $res->m4, $res->m8, $res->m12],
            [$res->m1, $res->m5, $res->m9, $res->m13],
            [$res->m2, $res->m6, $res->m10, $res->m14],
            [$res->m3, $res->m7, $res->m11, $res->m15]
        );
    }

    /**
     * 矩阵4 取反
     *
     * @param CData Matrix $Matrix 矩阵4
     * @return CData Matrix 矩阵4 取反 结果
     */
    public static function matrixInvert(Matrix $Matrix): Matrix
    {
        $res = self::ffi()->MatrixInvert($Matrix->struct());
        return new Matrix(
            [$res->m0, $res->m4, $res->m8, $res->m12],
            [$res->m1, $res->m5, $res->m9, $res->m13],
            [$res->m2, $res->m6, $res->m10, $res->m14],
            [$res->m3, $res->m7, $res->m11, $res->m15]
        );
    }

    /**
     * 矩阵4 单位矩阵
     *
     * @return Matrix 矩阵4 单位矩阵 结果
     */
    public static function matrixIdentity(): Matrix
    {
        $res = self::ffi()->MatrixIdentity();
        return new Matrix(
            [$res->m0, $res->m4, $res->m8, $res->m12],
            [$res->m1, $res->m5, $res->m9, $res->m13],
            [$res->m2, $res->m6, $res->m10, $res->m14],
            [$res->m3, $res->m7, $res->m11, $res->m15]
        );
    }

    /**
     * 矩阵4 加法
     *
     * @param Matrix $Matrix_left 矩阵4
     * @param Matrix $Matrix_right 矩阵4
     * @return Matrix 矩阵4 加法 结果 
     */
    public static function matrixAdd(Matrix $Matrix_left, Matrix $Matrix_right): Matrix
    {
        $res = self::ffi()->MatrixAdd($Matrix_left->struct(), $Matrix_right->struct());
        return new Matrix(
            [$res->m0, $res->m4, $res->m8, $res->m12],
            [$res->m1, $res->m5, $res->m9, $res->m13],
            [$res->m2, $res->m6, $res->m10, $res->m14],
            [$res->m3, $res->m7, $res->m11, $res->m15]
        );
    }

    /**
     * 矩阵4 减法
     *
     * @param Matrix $Matrix_left 矩阵4
     * @param Matrix $Matrix_right 矩阵4
     * @return Matrix 矩阵4 减法 结果
     */
    public static function matrixSubtract(Matrix $Matrix_left, Matrix $Matrix_right): Matrix
    {
        $res = self::ffi()->MatrixSubtract($Matrix_left->struct(), $Matrix_right->struct());
        return new Matrix(
            [$res->m0, $res->m4, $res->m8, $res->m12],
            [$res->m1, $res->m5, $res->m9, $res->m13],
            [$res->m2, $res->m6, $res->m10, $res->m14],
            [$res->m3, $res->m7, $res->m11, $res->m15]
        );
    }

    /**
     * 矩阵4 乘法
     *
     * @param Matrix $Matrix_left 矩阵4
     * @param Matrix $Matrix_right 矩阵4
     * @return Matrix 矩阵4 乘法 结果
     */
    public static function matrixMultiply(Matrix $Matrix_left, Matrix $Matrix_right): Matrix
    {
        $res = self::ffi()->MatrixMultiply($Matrix_left->struct(), $Matrix_right->struct());
        return new Matrix(
            [$res->m0, $res->m4, $res->m8, $res->m12],
            [$res->m1, $res->m5, $res->m9, $res->m13],
            [$res->m2, $res->m6, $res->m10, $res->m14],
            [$res->m3, $res->m7, $res->m11, $res->m15]
        );
    }

    /**
     * 矩阵4 平移
     *
     * @param float $x 平移X轴
     * @param float $y 平移Y轴
     * @param float $z 平移Z轴
     * @return Matrix 矩阵4 平移 结果
     */
    public static function matrixTranslate(float $x, float $y, float $z): Matrix
    {
        $res = self::ffi()->MatrixTranslate($x, $y, $z);
        return new Matrix(
            [$res->m0, $res->m4, $res->m8, $res->m12],
            [$res->m1, $res->m5, $res->m9, $res->m13],
            [$res->m2, $res->m6, $res->m10, $res->m14],
            [$res->m3, $res->m7, $res->m11, $res->m15]
        );
    }

    /**
     * 矩阵4 旋转
     *
     * @param Vector3 $axis 旋转轴
     * @param float $angle 旋转角度
     * @return Matrix 矩阵4 旋转 结果
     */
    public static function matrixRotate(Vector3 $axis, float $angle): Matrix
    {
        $res = self::ffi()->MatrixRotate($axis->struct(), $angle);
        return new Matrix(
            [$res->m0, $res->m4, $res->m8, $res->m12],
            [$res->m1, $res->m5, $res->m9, $res->m13],
            [$res->m2, $res->m6, $res->m10, $res->m14],
            [$res->m3, $res->m7, $res->m11, $res->m15]
        );
    }

    /**
     * 矩阵4 旋转X轴
     *
     * @param float $angle 旋转角度
     * @return Matrix 矩阵4 旋转X轴 结果
     */
    public static function matrixRotateX(float $angle): Matrix
    {
        $res = self::ffi()->MatrixRotateX($angle);
        return new Matrix(
            [$res->m0, $res->m4, $res->m8, $res->m12],
            [$res->m1, $res->m5, $res->m9, $res->m13],
            [$res->m2, $res->m6, $res->m10, $res->m14],
            [$res->m3, $res->m7, $res->m11, $res->m15]
        );
    }

    /**
     * 矩阵4 旋转Y轴
     *
     * @param float $angle 旋转角度
     * @return Matrix 矩阵4 旋转Y轴 结果
     */
    public static function matrixRotateY(float $angle): Matrix
    {
        $res = self::ffi()->MatrixRotateY($angle);
        return new Matrix(
            [$res->m0, $res->m4, $res->m8, $res->m12],
            [$res->m1, $res->m5, $res->m9, $res->m13],
            [$res->m2, $res->m6, $res->m10, $res->m14],
            [$res->m3, $res->m7, $res->m11, $res->m15]
        );
    }

    /**
     * 矩阵4 旋转Z轴
     *
     * @param float $angle 旋转角度
     * @return Matrix 矩阵4 旋转Z轴 结果
     */
    public static function matrixRotateZ(float $angle): Matrix
    {
        $res = self::ffi()->MatrixRotateZ($angle);
        return new Matrix(
            [$res->m0, $res->m4, $res->m8, $res->m12],
            [$res->m1, $res->m5, $res->m9, $res->m13],
            [$res->m2, $res->m6, $res->m10, $res->m14],
            [$res->m3, $res->m7, $res->m11, $res->m15]
        );
    }

    /**
     * 矩阵4 旋转XYZ轴
     *
     * @param Vector3 $Vector3_angle 旋转XYZ轴角度
     * @return Matrix 矩阵4 旋转XYZ轴 结果
     */
    public static function matrixRotateXYZ(Vector3 $Vector3_angle): Matrix
    {
        $res = self::ffi()->MatrixRotateXYZ($Vector3_angle->struct());
        return new Matrix(
            [$res->m0, $res->m4, $res->m8, $res->m12],
            [$res->m1, $res->m5, $res->m9, $res->m13],
            [$res->m2, $res->m6, $res->m10, $res->m14],
            [$res->m3, $res->m7, $res->m11, $res->m15]
        );
    }

    /**
     * 矩阵4 旋转ZYX轴
     *
     * @param Vector3 $Vector3_angle 旋转ZYX轴角度
     * @return Matrix 矩阵4 旋转ZYX轴 结果
     */
    public static function matrixRotateZYX(Vector3 $Vector3_angle): Matrix
    {
        $res = self::ffi()->MatrixRotateZYX($Vector3_angle->struct());
        return new Matrix(
            [$res->m0, $res->m4, $res->m8, $res->m12],
            [$res->m1, $res->m5, $res->m9, $res->m13],
            [$res->m2, $res->m6, $res->m10, $res->m14],
            [$res->m3, $res->m7, $res->m11, $res->m15]
        );
    }

    /**
     * 矩阵4 缩放
     *
     * @param float $x 缩放X轴
     * @param float $y 缩放Y轴
     * @param float $z 缩放Z轴
     * @return Matrix 矩阵4 缩放 结果
     */
    public static function matrixScale(float $x, float $y, float $z): Matrix
    {
        $res = self::ffi()->MatrixScale($x, $y, $z);
        return new Matrix(
            [$res->m0, $res->m4, $res->m8, $res->m12],
            [$res->m1, $res->m5, $res->m9, $res->m13],
            [$res->m2, $res->m6, $res->m10, $res->m14],
            [$res->m3, $res->m7, $res->m11, $res->m15]
        );
    }

    /**
     * 矩阵4 透视投影
     *
     * @param float $left 左裁剪平面
     * @param float $right 右裁剪平面
     * @param float $bottom 下裁剪平面
     * @param float $top 上裁剪平面
     * @param float $nearPlane 近裁剪平面
     * @param float $farPlane 远裁剪平面
     * @return Matrix 矩阵4 透视投影 结果
     */
    public static function matrixFrustum(float $left, float $right, float $bottom, float $top, float $nearPlane, float $farPlane): Matrix
    {
        $res = self::ffi()->MatrixFrustum($left, $right, $bottom, $top, $nearPlane, $farPlane);
        return new Matrix(
            [$res->m0, $res->m4, $res->m8, $res->m12],
            [$res->m1, $res->m5, $res->m9, $res->m13],
            [$res->m2, $res->m6, $res->m10, $res->m14],
            [$res->m3, $res->m7, $res->m11, $res->m15]
        );
    }

    /**
     * 矩阵4 透视投影
     *
     * @param float $fovY 垂直视野角度
     * @param float $aspect 宽高比
     * @param float $nearPlane 近裁剪平面
     * @param float $farPlane 远裁剪平面
     * @return Matrix 矩阵4 透视投影 结果
     */
    public static function matrixPerspective(float $fovY, float $aspect, float $nearPlane, float $farPlane): Matrix
    {
        $res = self::ffi()->MatrixPerspective($fovY, $aspect, $nearPlane, $farPlane);
        return new Matrix(
            [$res->m0, $res->m4, $res->m8, $res->m12],
            [$res->m1, $res->m5, $res->m9, $res->m13],
            [$res->m2, $res->m6, $res->m10, $res->m14],
            [$res->m3, $res->m7, $res->m11, $res->m15]
        );
    }

    /**
     * 矩阵4 正交投影
     *
     * @param float $left 左裁剪平面
     * @param float $right 右裁剪平面
     * @param float $bottom 下裁剪平面
     * @param float $top 上裁剪平面
     * @param float $nearPlane 近裁剪平面
     * @param float $farPlane 远裁剪平面
     * @return Matrix 矩阵4 正交投影 结果
     */
    public static function matrixOrtho(float $left, float $right, float $bottom, float $top, float $nearPlane, float $farPlane): Matrix
    {
        $res = self::ffi()->MatrixOrtho($left, $right, $bottom, $top, $nearPlane, $farPlane);
        return new Matrix(
            [$res->m0, $res->m4, $res->m8, $res->m12],
            [$res->m1, $res->m5, $res->m9, $res->m13],
            [$res->m2, $res->m6, $res->m10, $res->m14],
            [$res->m3, $res->m7, $res->m11, $res->m15]
        );
    }

    /**
     * 矩阵4 观察矩阵
     *
     * @param Vector3 $Vector3_eye 相机位置
     * @param Vector3 $Vector3_target 相机目标
     * @param Vector3 $Vector3_up 相机上方向
     * @return Matrix 矩阵4 观察矩阵 结果
     */
    public static function matrixLookAt(Vector3 $Vector3_eye, Vector3 $Vector3_target, Vector3 $Vector3_up): Matrix
    {
        $res = self::ffi()->MatrixLookAt($Vector3_eye->struct(), $Vector3_target->struct(), $Vector3_up->struct());
        return new Matrix(
            [$res->m0, $res->m4, $res->m8, $res->m12],
            [$res->m1, $res->m5, $res->m9, $res->m13],
            [$res->m2, $res->m6, $res->m10, $res->m14],
            [$res->m3, $res->m7, $res->m11, $res->m15]
        );
    }

    /**
     * 矩阵4 转换为浮点数对象
     *
     * @param Matrix $Matrix 矩阵4
     * @return CData 浮点数对象
     */
    public static function matrixToFloatV(Matrix $Matrix): CData
    {
        return self::ffi()->MatrixToFloatV($Matrix->struct());
    }

    /**
     * 四元数 加法
     *
     * @param Vector4 Quaternion $Quaternion_a 四元数a
     * @param Vector4 Quaternion $Quaternion_b 四元数b
     * @return Vector4 Quaternion 四元数 加法 结果
     */
    public static function quaternionAdd(Vector4 $Quaternion_a, Vector4 $Quaternion_b): Vector4
    {
        $res = self::ffi()->QuaternionAdd($Quaternion_a->struct(), $Quaternion_b->struct());
        return new Vector4(
            $res->x,
            $res->y,
            $res->z,
            $res->w,
        );
    }

    /**
     * 四元数 加法
     *
     * @param Vector4 Quaternion $Quaternion_a 四元数a
     * @param float $add 四元数b值
     * @return Vector4 Quaternion 四元数 加法 结果
     */
    public static function quaternionAddValue(Vector4 $Quaternion_a, float $add): Vector4
    {
        $res = self::ffi()->QuaternionAddValue($Quaternion_a->struct(), $add);
        return new Vector4(
            $res->x,
            $res->y,
            $res->z,
            $res->w,
        );
    }

    /**
     * 四元数 减法
     *
     * @param Vector4 Quaternion $Quaternion_a 四元数a
     * @param Vector4 Quaternion $Quaternion_b 四元数b
     * @return Vector4 Quaternion 四元数 减法 结果
     */
    public static function quaternionSubtract(Vector4 $Quaternion_a, Vector4 $Quaternion_b): Vector4
    {
        $res = self::ffi()->QuaternionSubtract($Quaternion_a->struct(), $Quaternion_b->struct());
        return new Vector4(
            $res->x,
            $res->y,
            $res->z,
            $res->w,
        );
    }

    /**
     * 四元数 减法
     *
     * @param Vector4 Quaternion $Quaternion_a 四元数a
     * @param float $subtract 四元数b值
     * @return Vector4 Quaternion 四元数 减法 结果
     */
    public static function quaternionSubtractValue(Vector4 $Quaternion_a, float $subtract): Vector4
    {
        $res = self::ffi()->QuaternionSubtractValue($Quaternion_a->struct(), $subtract);
        return new Vector4(
            $res->x,
            $res->y,
            $res->z,
            $res->w,
        );
    }

    /**
     * 四元数 身份
     *
     * @return Vector4 Quaternion 四元数 身份 结果
     */
    public static function quaternionIdentity(): Vector4
    {
        $res = self::ffi()->QuaternionIdentity();
        return new Vector4(
            $res->x,
            $res->y,
            $res->z,
            $res->w,
        );
    }

    /**
     * 四元数 长度
     *
     * @param Vector4 Quaternion $Quaternion 四元数
     * @return float 四元数 长度 结果
     */
    public static function quaternionLength(Vector4 $Quaternion): float
    {
        return self::ffi()->QuaternionLength($Quaternion->struct());
    }

    /**
     * 四元数 归一化
     *
     * @param Vector4 Quaternion $Quaternion 四元数
     * @return Vector4 Quaternion 四元数 归一化 结果
     */
    public static function quaternionNormalize(Vector4 $Quaternion): Vector4
    {
        $res = self::ffi()->QuaternionNormalize($Quaternion->struct());
        return new Vector4(
            $res->x,
            $res->y,
            $res->z,
            $res->w,
        );
    }

    /**
     * 四元数 反相
     *
     * @param Vector4 Quaternion $Quaternion 四元数
     * @return Vector4 Quaternion 四元数 反相 结果
     */
    public static function quaternionInvert(Vector4 $Quaternion): Vector4
    {
        $res = self::ffi()->QuaternionInvert($Quaternion->struct());
        return new Vector4(
            $res->x,
            $res->y,
            $res->z,
            $res->w,
        );
    }

    /**
     * 四元数 乘法
     *
     * @param Vector4 Quaternion $Quaternion_a 四元数a
     * @param Vector4 Quaternion $Quaternion_b 四元数b
     * @return Vector4 Quaternion 四元数 乘法 结果
     */
    public static function quaternionMultiply(Vector4 $Quaternion_a, Vector4 $Quaternion_b): Vector4
    {
        $res = self::ffi()->QuaternionMultiply($Quaternion_a->struct(), $Quaternion_b->struct());
        return new Vector4(
            $res->x,
            $res->y,
            $res->z,
            $res->w,
        );
    }

    /**
     * 四元数 乘法
     *
     * @param Vector4 Quaternion $Quaternion 四元数
     * @param float $scale 缩放值
     * @return Vector4 Quaternion 四元数 乘法 结果
     */
    public static function quaternionScale(Vector4 $Quaternion, float $scale): Vector4
    {
        $res = self::ffi()->QuaternionScale($Quaternion->struct(), $scale);
        return new Vector4(
            $res->x,
            $res->y,
            $res->z,
            $res->w,
        );
    }

    /**
     * 四元数 除法
     *
     * @param Vector4 Quaternion $Quaternion_a 四元数a
     * @param Vector4 Quaternion $Quaternion_b 四元数b
     * @return Vector4 Quaternion 四元数 除法 结果
     */
    public static function quaternionDivide(Vector4 $Quaternion_a, Vector4 $Quaternion_b): Vector4
    {
        $res = self::ffi()->QuaternionDivide($Quaternion_a->struct(), $Quaternion_b->struct());
        return new Vector4(
            $res->x,
            $res->y,
            $res->z,
            $res->w,
        );
    }

    /**
     * 四元数 插值
     *
     * @param Vector4 Quaternion $Quaternion_a 四元数a
     * @param Vector4 Quaternion $Quaternion_b 四元数b
     * @param float $amount 插值比例
     * @return Vector4 Quaternion 四元数 插值 结果
     */
    public static function quaternionLerp(Vector4 $Quaternion_a, Vector4 $Quaternion_b, float $amount): Vector4
    {
        $res = self::ffi()->QuaternionLerp($Quaternion_a->struct(), $Quaternion_b->struct(), $amount);
        return new Vector4(
            $res->x,
            $res->y,
            $res->z,
            $res->w,
        );
    }

    /**
     * 四元数 归一化插值
     *
     * @param Vector4 Quaternion $Quaternion_a 四元数a
     * @param Vector4 Quaternion $Quaternion_b 四元数b
     * @param float $amount 插值比例
     * @return Vector4 Quaternion 四元数 归一化插值 结果
     */
    public static function quaternionNlerp(Vector4 $Quaternion_a, Vector4 $Quaternion_b, float $amount): Vector4
    {
        $res = self::ffi()->QuaternionNlerp($Quaternion_a->struct(), $Quaternion_b->struct(), $amount);
        return new Vector4(
            $res->x,
            $res->y,
            $res->z,
            $res->w,
        );
    }

    /**
     * 四元数 球面线性插值
     *
     * @param Vector4 Quaternion $Quaternion_a 四元数a
     * @param Vector4 Quaternion $Quaternion_b 四元数b
     * @param float $amount 插值比例
     * @return Vector4 Quaternion 四元数 球面线性插值 结果
     */
    public static function quaternionSlerp(Vector4 $Quaternion_a, Vector4 $Quaternion_b, float $amount): Vector4
    {
        $res = self::ffi()->QuaternionSlerp($Quaternion_a->struct(), $Quaternion_b->struct(), $amount);
        return new Vector4(
            $res->x,
            $res->y,
            $res->z,
            $res->w,
        );
    }

    /**
     * 四元数 三次Hermite插值
     * 
     * @param Vector4 Quaternion $Quaternion_q1 四元数a
     * @param Vector4 Quaternion $Quaternion_outTangent1 四元数a的外切线
     * @param Vector4 Quaternion $Quaternion_q2 四元数b
     * @param Vector4 Quaternion $Quaternion_inTangent2 四元数b的内切线
     * @param float $t 插值比例
     * @return Vector4 Quaternion 四元数 三次Hermite插值 结果
     */
    public static function quaternionCubicHermiteSpline(Vector4 $Quaternion_q1, Vector4 $Quaternion_outTangent1, Vector4 $Quaternion_q2, Vector4 $Quaternion_inTangent2, float $t): Vector4
    {
        $res = self::ffi()->QuaternionCubicHermiteSpline($Quaternion_q1->struct(), $Quaternion_outTangent1->struct(), $Quaternion_q2->struct(), $Quaternion_inTangent2->struct(), $t);
        return new Vector4(
            $res->x,
            $res->y,
            $res->z,
            $res->w,
        );
    }

    /**
     * 四元数 从向量3到向量3
     *
     * @param Vector3 $Vector3_from 向量3a
     * @param Vector3 $Vector3_to 向量3b
     * @return Vector4 Quaternion 四元数 从向量3到向量3 结果
     */
    public static function quaternionFromVector3ToVector3(Vector3 $Vector3_from, Vector3 $Vector3_to): Vector4
    {
        $res = self::ffi()->QuaternionFromVector3ToVector3($Vector3_from->struct(), $Vector3_to->struct());
        return new Vector4(
            $res->x,
            $res->y,
            $res->z,
            $res->w,
        );
    }

    /**
     * 四元数 从矩阵
     *
     * @param Matrix $Matrix 矩阵
     * @return Vector4 Quaternion 四元数 从矩阵 结果
     */
    public static function quaternionFromMatrix(Matrix $Matrix): Vector4
    {
        $res = self::ffi()->QuaternionFromMatrix($Matrix->struct());
        return new Vector4(
            $res->x,
            $res->y,
            $res->z,
            $res->w,
        );
    }

    /**
     * 四元数 转换为矩阵
     *
     * @param Vector4 Quaternion $Quaternion 四元数
     * @return Matrix 矩阵 结果
     */
    public static function quaternionToMatrix(Vector4 $Quaternion): Matrix
    {
        $res = self::ffi()->QuaternionToMatrix($Quaternion->struct());
        return new Matrix(
            [$res->m0, $res->m4, $res->m8, $res->m12],
            [$res->m1, $res->m5, $res->m9, $res->m13],
            [$res->m2, $res->m6, $res->m10, $res->m14],
            [$res->m3, $res->m7, $res->m11, $res->m15],
        );
    }

    /**
     * 四元数 从轴角
     *
     * @param Vector3 $Vector3_axis 轴向量
     * @param float $angle 旋转角度（弧度）
     * @return Vector4 Quaternion 四元数 从轴角 结果
     */
    public static function quaternionFromAxisAngle(Vector3 $Vector3_axis, float $angle): Vector4
    {
        $res = self::ffi()->QuaternionFromAxisAngle($Vector3_axis->struct(), $angle);
        return new Vector4(
            $res->x,
            $res->y,
            $res->z,
            $res->w,
        );
    }

    /**
     * 四元数 转换为轴角
     *
     * @param Vector4 Quaternion $Quaternion 四元数
     * @param Vector3 $Vector3_outAxis 轴向量 结果
     * @param float $outAngle 旋转角度（弧度） 结果
     */
    public static function quaternionToAxisAngle(Vector4 $Quaternion, Vector3 &$Vector3_outAxis, float &$outAngle): void
    {
        $Vector3_outAxis = self::ffi()->cast('Vector3 *', $Vector3_outAxis);
        $c_outAngle = self::ffi()->new('float[1]');
        $c_outAngle[0] = $outAngle;
        $outAngle = self::ffi()->cast('float', $c_outAngle);
        self::ffi()->QuaternionToAxisAngle($Quaternion->struct(), $Vector3_outAxis, $outAngle);
        $Vector3_outAxis = new Vector3(
            $Vector3_outAxis[0]->x,
            $Vector3_outAxis[0]->y,
            $Vector3_outAxis[0]->z,
        );
        $outAngle = $c_outAngle[0];
        unset($c_outAngle);
        unset($Vector3_outAxis);
    }

    /**
     * 四元数 从欧拉角
     *
     * @param float $pitch 俯仰角（弧度）
     * @param float $yaw 偏航角（弧度）
     * @param float $roll 滚转角（弧度）
     * @return Vector4 Quaternion 四元数 从欧拉角 结果
     */
    public static function quaternionFromEuler(float $pitch, float $yaw, float $roll): Vector4
    {
        $res = self::ffi()->QuaternionFromEuler($pitch, $yaw, $roll);
        return new Vector4(
            $res->x,
            $res->y,
            $res->z,
            $res->w,
        );
    }

    /**
     * 四元数 转换为欧拉角
     *
     * @param Vector4 Quaternion $Quaternion 四元数
     * @return Vector3 欧拉角 结果
     */
    public static function quaternionToEuler(Vector4 $Quaternion): Vector3
    {
        $res = self::ffi()->QuaternionToEuler($Quaternion->struct());
        return new Vector3(
            $res->x,
            $res->y,
            $res->z,
        );
    }

    /**
     * 四元数 变换向量3
     *
     * @param Vector4 Quaternion $Quaternion 四元数
     * @param Matrix $mat 变换矩阵
     * @return Vector3 变换后的向量3 结果
     */
    public static function quaternionTransform(Vector4 $Quaternion, Matrix $mat): Vector3
    {
        $res = self::ffi()->QuaternionTransform($Quaternion->struct(), $mat->struct());
        return new Vector3(
            $res->x,
            $res->y,
            $res->z,
        );
    }

    /**
     * 四元数 相等判断
     *
     * @param Vector4 Quaternion $Quaternion_a 四元数a
     * @param Vector4 Quaternion $Quaternion_b 四元数b
     * @return bool 是否相等 结果
     */
    public static function quaternionEquals(Vector4 $Quaternion_a, Vector4 $Quaternion_b): bool
    {
        return self::ffi()->QuaternionEquals($Quaternion_a->struct(), $Quaternion_b->struct()) == 1;
    }

    /**
     * 四元数 分解矩阵
     *
     * @param Matrix $mat 矩阵
     * @param Vector3 $translation 平移向量 结果
     * @param Vector4 $rotation 旋转四元数 结果
     * @param Vector3 $scale 缩放向量 结果
     * @return void
     */
    public static function matrixDecompose(Matrix $mat, Vector3 &$translation, Vector4 &$rotation, Vector3 &$scale): void
    {
        $translation = self::ffi()->cast('Vector3 *', $translation->struct());
        $rotation = self::ffi()->cast('Vector4 *', $rotation->struct());
        $scale = self::ffi()->cast('Vector3 *', $scale->struct());
        self::ffi()->MatrixDecompose($mat, $translation, $rotation, $scale);
        $translation = new Vector3(
            $translation[0]->x,
            $translation[0]->y,
            $translation[0]->z,
        );
        $rotation = new Vector4(
            $rotation[0]->x,
            $rotation[0]->y,
            $rotation[0]->z,
            $rotation[0]->w,
        );
        $scale = new Vector3(
            $scale[0]->x,
            $scale[0]->y,
            $scale[0]->z,
        );
        unset($translation);
        unset($rotation);
        unset($scale);
    }
}
