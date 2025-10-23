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
     * @return CData Vector2 零向量2
     */
    public static function vector2Zero(): CData
    {
        return self::ffi()->Vector2Zero();
    }

    /**
     * 返回一个单位向量2
     *
     * @return CData Vector2 单位向量2
     */
    public static function vector2One(): CData
    {
        return self::ffi()->Vector2One();
    }

    /**
     * 向量2加法
     *
     * @param CData Vector2 $Vector2_1 向量2
     * @param CData Vector2 $Vector2_2 向量2
     * @return CData Vector2 向量2加法结果
     */
    public static function vector2Add(CData $Vector2_1, CData $Vector2_2): CData
    {
        return self::ffi()->Vector2Add($Vector2_1, $Vector2_2);
    }

    /**
     * 向量2加法（值）
     *
     * @param CData Vector2 $Vector2 向量2
     * @param float $add 要添加的值
     * @return CData Vector2 向量2加法结果
     */
    public static function vector2AddValue(CData $Vector2, float $add): CData
    {
        return self::ffi()->Vector2AddValue($Vector2, $add);
    }

    /**
     * 向量2减法
     *
     * @param CData Vector2 $Vector2_1 向量2
     * @param CData Vector2 $Vector2_2 向量2
     * @return CData Vector2 向量2减法结果
     */
    public static function vector2Subtract(CData $Vector2_1, CData $Vector2_2): CData
    {
        return self::ffi()->Vector2Subtract($Vector2_1, $Vector2_2);
    }

    /**
     * 向量2减法（值）
     *
     * @param CData Vector2 $Vector2 向量2
     * @param float $subtract 要减去的值
     * @return CData Vector2 向量2减法结果
     */
    public static function vector2SubtractValue(CData $Vector2, float $subtract): CData
    {
        return self::ffi()->Vector2SubtractValue($Vector2, $subtract);
    }

    /**
     * 向量2长度
     *
     * @param CData Vector2 $Vector2 向量2
     * @return float 向量2长度
     */
    public static function vector2Length(CData $Vector2): float
    {
        return self::ffi()->Vector2Length($Vector2);
    }

    /**
     * 向量2长度平方
     *
     * @param CData Vector2 $Vector2 向量2
     * @return float 向量2长度平方
     */
    public static function vector2LengthSqr(CData $Vector2): float
    {
        return self::ffi()->Vector2LengthSqr($Vector2);
    }

    /**
     * 向量2点积
     *
     * @param CData Vector2 $Vector2_1 向量2
     * @param CData Vector2 $Vector2_2 向量2
     * @return float 向量2点积
     */
    public static function vector2DotProduct(CData $Vector2_1, CData $Vector2_2): float
    {
        return self::ffi()->Vector2DotProduct($Vector2_1, $Vector2_2);
    }

    /**
     * 向量2距离
     *
     * @param CData Vector2 $Vector2_1 向量2
     * @param CData Vector2 $Vector2_2 向量2
     * @return float 向量2距离
     */
    public static function vector2Distance(CData $Vector2_1, CData $Vector2_2): float
    {
        return self::ffi()->Vector2Distance($Vector2_1, $Vector2_2);
    }

    /**
     * 向量2距离平方
     *
     * @param CData Vector2 $Vector2_1 向量2
     * @param CData Vector2 $Vector2_2 向量2
     * @return float 向量2距离平方
     */
    public static function vector2DistanceSqr(CData $Vector2_1, CData $Vector2_2): float
    {
        return self::ffi()->Vector2DistanceSqr($Vector2_1, $Vector2_2);
    }

    /**
     * 向量2角度
     *
     * @param CData Vector2 $Vector2_1 向量2
     * @param CData Vector2 $Vector2_2 向量2
     * @return float 向量2角度
     */
    public static function vector2Angle(CData $Vector2_1, CData $Vector2_2): float
    {
        return self::ffi()->Vector2Angle($Vector2_1, $Vector2_2);
    }

    /**
     * 向量2线角度
     *
     * @param CData Vector2 $Vector2_start 向量2
     * @param CData Vector2 $Vector2_end 向量2
     * @return float 向量2线角度
     */
    public static function vector2LineAngle(CData $Vector2_start, CData $Vector2_end): float
    {
        return self::ffi()->Vector2LineAngle($Vector2_start, $Vector2_end);
    }

    /**
     * 向量2缩放
     *
     * @param CData Vector2 $Vector2 向量2
     * @param float $scale 缩放值
     * @return CData Vector2 向量2缩放结果
     */
    public static function vector2Scale(CData $Vector2, float $scale): CData
    {
        return self::ffi()->Vector2Scale($Vector2, $scale);
    }

    /**
     * 向量2乘法
     *
     * @param CData Vector2 $Vector2_1 向量2
     * @param CData Vector2 $Vector2_2 向量2
     * @return CData Vector2 向量2乘法结果
     */
    public static function vector2Multiply(CData $Vector2_1, CData $Vector2_2): CData
    {
        return self::ffi()->Vector2Multiply($Vector2_1, $Vector2_2);
    }

    /**
     * 向量2取反
     *
     * @param CData Vector2 $Vector2 向量2
     * @return CData Vector2 向量2取反结果
     */
    public static function vector2Negate(CData $Vector2): CData
    {
        return self::ffi()->Vector2Negate($Vector2);
    }

    /**
     * 向量2除法
     *
     * @param CData Vector2 $Vector2_1 向量2
     * @param CData Vector2 $Vector2_2 向量2
     * @return CData Vector2 向量2除法结果
     */
    public static function vector2Divide(CData $Vector2_1, CData $Vector2_2): CData
    {
        return self::ffi()->Vector2Divide($Vector2_1, $Vector2_2);
    }

    /**
     * 向量2归一化
     *
     * @param CData Vector2 $Vector2 向量2
     * @return CData Vector2 向量2归一化结果
     */
    public static function vector2Normalize(CData $Vector2): CData
    {
        return self::ffi()->Vector2Normalize($Vector2);
    }

    /**
     * 向量2变换
     *
     * @param CData Vector2 $Vector2 向量2
     * @param CData Matrix $Matrix 矩阵
     * @return CData Vector2 向量2变换结果
     */
    public static function vector2Transform(CData $Vector2, CData $Matrix): CData
    {
        return self::ffi()->Vector2Transform($Vector2, $Matrix);
    }

    /**
     * 向量2插值
     *
     * @param CData Vector2 $Vector2_1 向量2
     * @param CData Vector2 $Vector2_2 向量2
     * @param float $t 插值参数
     * @return CData Vector2 向量2插值结果
     */
    public static function vector2Lerp(CData $Vector2_1, CData $Vector2_2, float $t): CData
    {
        return self::ffi()->Vector2Lerp($Vector2_1, $Vector2_2, $t);
    }

    /**
     * 向量2反射
     *
     * @param CData Vector2 $Vector2 向量2
     * @param CData Vector2 $Normal 向量2
     * @return CData Vector2 向量2反射结果
     */
    public static function vector2Reflect(CData $Vector2, CData $Normal): CData
    {
        return self::ffi()->Vector2Reflect($Vector2, $Normal);
    }

    /**
     * 向量2最小
     *
     * @param CData Vector2 $Vector2_1 向量2
     * @param CData Vector2 $Vector2_2 向量2
     * @return CData Vector2 向量2最小结果
     */
    public static function vector2Min(CData $Vector2_1, CData $Vector2_2): CData
    {
        return self::ffi()->Vector2Min($Vector2_1, $Vector2_2);
    }

    /**
     * 向量2最大
     *
     * @param CData Vector2 $Vector2_1 向量2
     * @param CData Vector2 $Vector2_2 向量2
     * @return CData Vector2 向量2最大结果
     */
    public static function vector2Max(CData $Vector2_1, CData $Vector2_2): CData
    {
        return self::ffi()->Vector2Max($Vector2_1, $Vector2_2);
    }

    /**
     * 向量2旋转
     *
     * @param CData Vector2 $Vector2 向量2
     * @param float $angle 角度
     * @return CData Vector2 向量2旋转结果
     */
    public static function vector2Rotate(CData $Vector2, float $angle): CData
    {
        return self::ffi()->Vector2Rotate($Vector2, $angle);
    }

    /**
     * 向量2移动 towards
     *
     * @param CData Vector2 $Vector2 向量2
     * @param CData Vector2 $Target 向量2
     * @param float $maxDistanceDelta 最大距离
     * @return CData Vector2 向量2移动 towards 结果
     */
    public static function vector2MoveTowards(CData $Vector2, CData $Target, float $maxDistanceDelta): CData
    {
        return self::ffi()->Vector2MoveTowards($Vector2, $Target, $maxDistanceDelta);
    }

    /**
     * 向量2取反
     *
     * @param CData Vector2 $Vector2 向量2
     * @return CData Vector2 向量2取反结果
     */
    public static function vector2Invert(CData $Vector2): CData
    {
        return self::ffi()->Vector2Invert($Vector2);
    }

    /**
     * 向量2 限制在范围内
     *
     * @param CData Vector2 $Vector2 向量2
     * @param CData Vector2 $Min 向量2
     * @param CData Vector2 $Max 向量2
     * @return CData Vector2 向量2 限制在范围内 结果
     */
    public static function vector2Clamp(CData $Vector2, CData $Min, CData $Max): CData
    {
        return self::ffi()->Vector2Clamp($Vector2, $Min, $Max);
    }

    /**
     * 向量2 限制在范围内
     *
     * @param CData Vector2 $Vector2 向量2
     * @param float $Min 最小值
     * @param float $Max 最大值
     * @return CData Vector2 向量2 限制在范围内 结果
     */
    public static function vector2ClampValue(CData $Vector2, float $Min, float $Max): CData
    {
        return self::ffi()->Vector2ClampValue($Vector2, $Min, $Max);
    }

    /**
     * 向量2 是否相等
     *
     * @param CData Vector2 $Vector2_1 向量2
     * @param CData Vector2 $Vector2_2 向量2
     * @return bool 向量2 是否相等 结果
     */
    public static function vector2Equals(CData $Vector2_1, CData $Vector2_2): bool
    {
        return self::ffi()->Vector2Equals($Vector2_1, $Vector2_2) == 1;
    }

    /**
     * 向量2 折射
     *
     * @param CData Vector2 $Vector2 向量2
     * @param CData Vector2 $Normal 向量2
     * @param float $indexRatio 折射率_ratio
     * @return CData Vector2 向量2 折射 结果
     */
    public static function vector2Refract(CData $Vector2, CData $Normal, float $indexRatio): CData
    {
        return self::ffi()->Vector2Refract($Vector2, $Normal, $indexRatio);
    }

    /**
     * 向量3 零向量
     *
     * @return CData Vector3 向量3 零向量 结果
     */
    public static function vector3Zero(): CData
    {
        return self::ffi()->Vector3Zero();
    }

    /**
     * 向量3 单位向量
     *
     * @return CData Vector3 向量3 单位向量 结果
     */
    public static function vector3One(): CData
    {
        return self::ffi()->Vector3One();
    }

    /**
     * 向量3 加法
     *
     * @param CData Vector3 $Vector3_1 向量3
     * @param CData Vector3 $Vector3_2 向量3
     * @return CData Vector3 向量3 加法 结果
     */
    public static function vector3Add(CData $Vector3_1, CData $Vector3_2): CData
    {
        return self::ffi()->Vector3Add($Vector3_1, $Vector3_2);
    }

    /**
     * 向量3 加法
     *
     * @param CData Vector3 $Vector3 向量3
     * @param float $Value 值
     * @return CData Vector3 向量3 加法 结果
     */
    public static function vector3AddValue(CData $Vector3, float $Value): CData
    {
        return self::ffi()->Vector3AddValue($Vector3, $Value);
    }

    /**
     * 向量3 减法
     *
     * @param CData Vector3 $Vector3_1 向量3
     * @param CData Vector3 $Vector3_2 向量3
     * @return CData Vector3 向量3 减法 结果
     */
    public static function vector3Subtract(CData $Vector3_1, CData $Vector3_2): CData
    {
        return self::ffi()->Vector3Subtract($Vector3_1, $Vector3_2);
    }

    /**
     * 向量3 减法
     *
     * @param CData Vector3 $Vector3 向量3
     * @param float $sub 值
     * @return CData Vector3 向量3 减法 结果
     */
    public static function vector3SubtractValue(CData $Vector3, float $sub): CData
    {
        return self::ffi()->Vector3SubtractValue($Vector3, $sub);
    }

    /**
     * 向量3 乘法
     *
     * @param CData Vector3 $Vector3 向量3
     * @param float $scalar 值
     * @return CData Vector3 向量3 乘法 结果
     */
    public static function vector3Scale(CData $Vector3, float $scalar): CData
    {
        return self::ffi()->Vector3Scale($Vector3, $scalar);
    }

    /**
     * 向量3 乘法
     *
     * @param CData Vector3 $Vector3_1 向量3
     * @param CData Vector3 $Vector3_2 向量3
     * @return CData Vector3 向量3 乘法 结果
     */
    public static function vector3Multiply(CData $Vector3_1, CData $Vector3_2): CData
    {
        return self::ffi()->Vector3Multiply($Vector3_1, $Vector3_2);
    }

    /**
     * 向量3 叉乘
     *
     * @param CData Vector3 $Vector3_1 向量3
     * @param CData Vector3 $Vector3_2 向量3
     * @return CData Vector3 向量3 叉乘 结果
     */
    public static function vector3CrossProduct(CData $Vector3_1, CData $Vector3_2): CData
    {
        return self::ffi()->Vector3CrossProduct($Vector3_1, $Vector3_2);
    }

    /**
     * 向量3 垂直向量
     *
     * @param CData Vector3 $Vector3 向量3
     * @return CData Vector3 向量3 垂直向量 结果
     */
    public static function vector3Perpendicular(CData $Vector3): CData
    {
        return self::ffi()->Vector3Perpendicular($Vector3);
    }

    /**
     * 向量3 长度
     *
     * @param CData Vector3 $Vector3 向量3
     * @return float 向量3 长度 结果
     */
    public static function vector3Length(CData $Vector3): float
    {
        return self::ffi()->Vector3Length($Vector3);
    }

    /**
     * 向量3 长度平方
     *
     * @param CData Vector3 $Vector3 向量3
     * @return float 向量3 长度平方 结果
     */
    public static function vector3LengthSqr(CData $Vector3): float
    {
        return self::ffi()->Vector3LengthSqr($Vector3);
    }

    /**
     * 向量3 点乘
     *
     * @param CData Vector3 $Vector3_1 向量3
     * @param CData Vector3 $Vector3_2 向量3
     * @return float 向量3 点乘 结果
     */
    public static function vector3DotProduct(CData $Vector3_1, CData $Vector3_2): float
    {
        return self::ffi()->Vector3DotProduct($Vector3_1, $Vector3_2);
    }

    /**
     * 向量3 距离
     *
     * @param CData Vector3 $Vector3_1 向量3
     * @param CData Vector3 $Vector3_2 向量3
     * @return float 向量3 距离 结果
     */
    public static function vector3Distance(CData $Vector3_1, CData $Vector3_2): float
    {
        return self::ffi()->Vector3Distance($Vector3_1, $Vector3_2);
    }

    /**
     * 向量3 距离平方
     *
     * @param CData Vector3 $Vector3_1 向量3
     * @param CData Vector3 $Vector3_2 向量3
     * @return float 向量3 距离平方 结果
     */
    public static function vector3DistanceSqr(CData $Vector3_1, CData $Vector3_2): float
    {
        return self::ffi()->Vector3DistanceSqr($Vector3_1, $Vector3_2);
    }

    /**
     * 向量3 角度
     *
     * @param CData Vector3 $Vector3_1 向量3
     * @param CData Vector3 $Vector3_2 向量3
     * @return float 向量3 角度 结果
     */
    public static function vector3Angle(CData $Vector3_1, CData $Vector3_2): float
    {
        return self::ffi()->Vector3Angle($Vector3_1, $Vector3_2);
    }

    /**
     * 向量3 取反
     *
     * @param CData Vector3 $Vector3 向量3
     * @return CData Vector3 向量3 取反 结果
     */
    public static function vector3Negate(CData $Vector3): CData
    {
        return self::ffi()->Vector3Negate($Vector3);
    }

    /**
     * 向量3 除法
     *
     * @param CData Vector3 $Vector3 向量3
     * @param float $div 值
     * @return CData Vector3 向量3 除法 结果
     */
    public static function vector3Divide(CData $Vector3, float $div): CData
    {
        return self::ffi()->Vector3Divide($Vector3, $div);
    }

    /**
     * 向量3 归一化
     *
     * @param CData Vector3 $Vector3 向量3
     * @return CData Vector3 向量3 归一化 结果
     */
    public static function vector3Normalize(CData $Vector3): CData
    {
        return self::ffi()->Vector3Normalize($Vector3);
    }

    /**
     * 向量3 投影
     *
     * @param CData Vector3 $Vector3 向量3
     * @param CData Vector3 $onNormal 向量3
     * @return CData Vector3 向量3 投影 结果
     */
    public static function vector3Project(CData $Vector3, CData $onNormal): CData
    {
        return self::ffi()->Vector3Project($Vector3, $onNormal);
    }

    /**
     * 向量3 拒绝
     *
     * @param CData Vector3 $Vector3 向量3
     * @param CData Vector3 $onNormal 向量3
     * @return CData Vector3 向量3 拒绝 结果
     */
    public static function vector3Reject(CData $Vector3, CData $onNormal): CData
    {
        return self::ffi()->Vector3Reject($Vector3, $onNormal);
    }

    /**
     * 向量3 正交归一化
     *
     * @param CData Vector3 $Vector3 向量3
     * @return CData Vector3 向量3 正交归一化 结果
     */
    public static function vector3OrthoNormalize(CData $Vector3): CData
    {
        return self::ffi()->Vector3OrthoNormalize($Vector3);
    }

    /**
     * 向量3 变换
     *
     * @param CData Vector3 $Vector3 向量3
     * @param CData Matrix $matrix 矩阵
     * @return CData Vector3 向量3 变换 结果
     */
    public static function vector3Transform(CData $Vector3, CData $matrix): CData
    {
        return self::ffi()->Vector3Transform($Vector3, $matrix);
    }

    /**
     * 向量3 四元数旋转
     *
     * @param CData Vector3 $Vector3 向量3
     * @param CData Quaternion $quaternion 四元数
     * @return CData Vector3 向量3 四元数旋转 结果
     */
    public static function vector3RotateByQuaternion(CData $Vector3, CData $quaternion): CData
    {
        return self::ffi()->Vector3RotateByQuaternion($Vector3, $quaternion);
    }

    /**
     * 向量3 轴角旋转
     *
     * @param CData Vector3 $Vector3 向量3
     * @param CData Vector3 $axis 向量3
     * @param float $angle 角度
     * @return CData Vector3 向量3 轴角旋转 结果
     */
    public static function vector3RotateByAxisAngle(CData $Vector3, CData $axis, float $angle): CData
    {
        return self::ffi()->Vector3RotateByAxisAngle($Vector3, $axis, $angle);
    }

    /**
     * 向量3 移动方向
     *
     * @param CData Vector3 $Vector3 向量3
     * @param CData Vector3 $target 向量3
     * @param float $maxDistanceDelta 最大距离增量
     * @return CData Vector3 向量3 移动方向 结果
     */
    public static function vector3MoveTowards(CData $Vector3, CData $target, float $maxDistanceDelta): CData
    {
        return self::ffi()->Vector3MoveTowards($Vector3, $target, $maxDistanceDelta);
    }

    /**
     * 向量3 线性插值
     *
     * @param CData Vector3 $Vector3 向量3
     * @param CData Vector3 $target 向量3
     * @param float $t 插值参数
     * @return CData Vector3 向量3 线性插值 结果
     */
    public static function vector3Lerp(CData $Vector3, CData $target, float $t): CData
    {
        return self::ffi()->Vector3Lerp($Vector3, $target, $t);
    }

    /**
     * 向量3 三次 Hermite 插值
     *
     * @param CData Vector3 $Vector3 向量3
     * @param CData Vector3 $target 向量3
     * @param float $t 插值参数
     * @return CData Vector3 向量3 三次 Hermite 插值 结果
     */
    public static function vector3CubicHermite(CData $Vector3, CData $target, float $t): CData
    {
        return self::ffi()->Vector3CubicHermite($Vector3, $target, $t);
    }

    /**
     * 向量3 反射
     *
     * @param CData Vector3 $Vector3 向量3
     * @param CData Vector3 $onNormal 向量3
     * @return CData Vector3 向量3 反射 结果
     */
    public static function vector3Reflect(CData $Vector3, CData $onNormal): CData
    {
        return self::ffi()->Vector3Reflect($Vector3, $onNormal);
    }

    /**
     * 向量3 最小
     *
     * @param CData Vector3 $Vector3 向量3
     * @param CData Vector3 $target 向量3
     * @return CData Vector3 向量3 最小 结果
     */
    public static function vector3Min(CData $Vector3, CData $target): CData
    {
        return self::ffi()->Vector3Min($Vector3, $target);
    }

    /**
     * 向量3 最大
     *
     * @param CData Vector3 $Vector3 向量3
     * @param CData Vector3 $target 向量3
     * @return CData Vector3 向量3 最大 结果
     */
    public static function vector3Max(CData $Vector3, CData $target): CData
    {
        return self::ffi()->Vector3Max($Vector3, $target);
    }

    /**
     * 向量3 重心坐标
     *
     * @param CData Vector3 $Vector3 向量3
     * @param CData Vector3 $v1 向量3
     * @param CData Vector3 $v2 向量3
     * @param CData Vector3 $v3 向量3
     * @return CData Vector3 向量3 重心坐标 结果
     */
    public static function vector3Barycenter(CData $Vector3, CData $v1, CData $v2, CData $v3): CData
    {
        return self::ffi()->Vector3Barycenter($Vector3, $v1, $v2, $v3);
    }

    /**
     * 向量3 投影
     *
     * @param CData Vector3 $Vector3 向量3
     * @param CData Vector3 $source 向量3
     * @param CData Vector3 $target 向量3
     * @return CData Vector3 向量3 投影 结果
     */
    public static function vector3Project(CData $Vector3, CData $source, CData $target): CData
    {
        return self::ffi()->Vector3Project($Vector3, $source, $target);
    }

    /**
     * 向量3 拒绝
     *
     * @param CData Vector3 $Vector3 向量3
     * @param CData Vector3 $onNormal 向量3
     * @return CData Vector3 向量3 拒绝 结果
     */
    public static function vector3Reject(CData $Vector3, CData $onNormal): CData
    {
        return self::ffi()->Vector3Reject($Vector3, $onNormal);
    }

    /**
     * 向量3 正交化归一化
     *
     * @param CData Vector3 $Vector3 向量3
     * @param CData Vector3 $v1 向量3
     * @param CData Vector3 $v2 向量3
     * @param CData Vector3 $v3 向量3
     * @return CData Vector3 向量3 正交化归一化 结果
     */
    public static function vector3OrthoNormalize(CData $Vector3, CData $v1, CData $v2, CData $v3): CData
    {
        return self::ffi()->Vector3OrthoNormalize($Vector3, $v1, $v2, $v3);
    }

    /**
     * 向量3 变换
     *
     * @param CData Vector3 $Vector3 向量3
     * @param CData Matrix $matrix 矩阵
     * @return CData Vector3 向量3 变换 结果
     */
    public static function vector3Transform(CData $Vector3, CData $matrix): CData
    {
        return self::ffi()->Vector3Transform($Vector3, $matrix);
    }

    /**
     * 向量3 四元数旋转
     *
     * @param CData Vector3 $Vector3 向量3
     * @param CData Quaternion $quaternion 四元数
     * @return CData Vector3 向量3 四元数旋转 结果
     */
    public static function vector3RotateByQuaternion(CData $Vector3, CData $quaternion): CData
    {
        return self::ffi()->Vector3RotateByQuaternion($Vector3, $quaternion);
    }

    /**
     * 向量3 轴角旋转
     *
     * @param CData Vector3 $Vector3 向量3
     * @param CData Vector3 $axis 向量3
     * @param float $angle 角度
     * @return CData Vector3 向量3 轴角旋转 结果
     */
    public static function vector3RotateByAxisAngle(CData $Vector3, CData $axis, float $angle): CData
    {
        return self::ffi()->Vector3RotateByAxisAngle($Vector3, $axis, $angle);
    }

    /**
     * 向量3 移动 towards
     *
     * @param CData Vector3 $Vector3 向量3
     * @param CData Vector3 $target 向量3
     * @param float $maxDistanceDelta 最大距离增量
     * @return CData Vector3 向量3 移动 towards 结果
     */
    public static function vector3MoveTowards(CData $Vector3, CData $target, float $maxDistanceDelta): CData
    {
        return self::ffi()->Vector3MoveTowards($Vector3, $target, $maxDistanceDelta);
    }

    /**
     * 向量3 线性插值
     *
     * @param CData Vector3 $Vector3 向量3
     * @param CData Vector3 $target 向量3
     * @param float $amount 插值比例
     * @return CData Vector3 向量3 线性插值 结果
     */
    public static function vector3Lerp(CData $Vector3, CData $target, float $amount): CData
    {
        return self::ffi()->Vector3Lerp($Vector3, $target, $amount);
    }

    /**
     * 向量3 三次 Hermite 插值
     *
     * @param CData Vector3 $Vector3 向量3
     * @param CData Vector3 $start 向量3
     * @param CData Vector3 $end 向量3
     * @param CData Vector3 $startTangent 向量3
     * @param CData Vector3 $endTangent 向量3
     * @param float $amount 插值比例
     * @return CData Vector3 向量3 三次 Hermite 插值 结果
     */
    public static function vector3CubicHermite(CData $Vector3, CData $start, CData $end, CData $startTangent, CData $endTangent, float $amount): CData
    {
        return self::ffi()->Vector3CubicHermite($Vector3, $start, $end, $startTangent, $endTangent, $amount);
    }

    /**
     * 向量3 反射
     *
     * @param CData Vector3 $Vector3 向量3
     * @param CData Vector3 $onNormal 向量3
     * @return CData Vector3 向量3 反射 结果
     */
    public static function vector3Reflect(CData $Vector3, CData $onNormal): CData
    {
        return self::ffi()->Vector3Reflect($Vector3, $onNormal);
    }

    /**
     * 向量3 最小
     *
     * @param CData Vector3 $Vector3_1 向量3
     * @param CData Vector3 $Vector3_2 向量3
     * @return CData Vector3 向量3 最小 结果
     */
    public static function vector3Min(CData $Vector3_1, CData $Vector3_2): CData
    {
        return self::ffi()->Vector3Min($Vector3_1, $Vector3_2);
    }

    /**
     * 向量3 最大
     *
     * @param CData Vector3 $Vector3_1 向量3
     * @param CData Vector3 $Vector3_2 向量3
     * @return CData Vector3 向量3 最大 结果
     */
    public static function vector3Max(CData $Vector3_1, CData $Vector3_2): CData
    {
        return self::ffi()->Vector3Max($Vector3_1, $Vector3_2);
    }

    /**
     * 向量3 重心坐标
     *
     * @param CData Vector3 $Vector3_p 向量3
     * @param CData Vector3 $Vector3_a 向量3
     * @param CData Vector3 $Vector3_b 向量3
     * @param CData Vector3 $Vector3_c 向量3
     * @return CData Vector3 向量3 重心坐标 结果
     */
    public static function vector3Barycenter(CData $Vector3_p, CData $Vector3_a, CData $Vector3_b, CData $Vector3_c): CData
    {
        return self::ffi()->Vector3Barycenter($Vector3_p, $Vector3_a, $Vector3_b, $Vector3_c);
    }

    /**
     * 向量3 反投影
     *
     * @param CData Vector3 $Vector3 向量3
     * @param CData Matrix $matrix 矩阵
     * @param CData Rectangle $viewport 矩形
     * @return CData Vector3 向量3 反投影 结果
     */
    public static function vector3Unproject(CData $Vector3, CData $matrix, CData $viewport): CData
    {
        return self::ffi()->Vector3Unproject($Vector3, $matrix, $viewport);
    }

    /**
     * 向量3 转换为 float 对象
     *
     * @param CData Vector3 $Vector3 向量3
     * @return CData float3 浮点数对象
     */
    public static function vector3ToFloatV(CData $Vector3): CData
    {
        return self::ffi()->Vector3ToFloatV($Vector3);
    }

    /**
     * 向量3 反方向
     *
     * @param CData Vector3 $Vector3 向量3
     * @return CData Vector3 向量3 反方向 结果
     */
    public static function vector3Invert(CData $Vector3): CData
    {
        return self::ffi()->Vector3Invert($Vector3);
    }

    /**
     * 向量3 范围
     *
     * @param CData Vector3 $Vector3 向量3
     * @param CData Vector3 $min 向量3
     * @param CData Vector3 $max 向量3
     * @return CData Vector3 向量3 范围 结果
     */
    public static function vector3Clamp(CData $Vector3, CData $min, CData $max): CData
    {
        return self::ffi()->Vector3Clamp($Vector3, $min, $max);
    }

    /**
     * 向量3 范围值
     *
     * @param CData Vector3 $Vector3 向量3
     * @param float $min 最小值
     * @param float $max 最大值
     * @return CData Vector3 向量3 范围值 结果
     */
    public static function vector3ClampValue(CData $Vector3, float $min, float $max): CData
    {
        return self::ffi()->Vector3ClampValue($Vector3, $min, $max);
    }

    /**
     * 向量3 是否相等
     *
     * @param CData Vector3 $Vector3_1 向量3
     * @param CData Vector3 $Vector3_2 向量3
     * @return bool 向量3 是否相等 结果
     */
    public static function vector3Equals(CData $Vector3_1, CData $Vector3_2): bool
    {
        return self::ffi()->Vector3Equals($Vector3_1, $Vector3_2) == 1;
    }

    /**
     * 向量3 折射
     *
     * @param CData Vector3 $Vector3 向量3
     * @param CData Vector3 $onNormal 向量3
     * @param float $refractionIndex 折射索引
     * @return CData Vector3 向量3 折射 结果
     */
    public static function vector3Refract(CData $Vector3, CData $onNormal, float $refractionIndex): CData
    {
        return self::ffi()->Vector3Refract($Vector3, $onNormal, $refractionIndex);
    }

    /**
     * 向量4 零
     *
     * @return CData Vector4 向量4 零 结果
     */
    public static function vector4Zero(): CData
    {
        return self::ffi()->Vector4Zero();
    }

    /**
     * 向量4 一
     *
     * @return CData Vector4 向量4 一 结果
     */
    public static function vector4One(): CData
    {
        return self::ffi()->Vector4One();
    }

    /**
     * 向量4 加法
     *
     * @param CData Vector4 $Vector4_1 向量4
     * @param CData Vector4 $Vector4_2 向量4
     * @return CData Vector4 向量4 加法 结果
     */
    public static function vector4Add(CData $Vector4_1, CData $Vector4_2): CData
    {
        return self::ffi()->Vector4Add($Vector4_1, $Vector4_2);
    }

    /**
     * 向量4 加法值
     *
     * @param CData Vector4 $Vector4 向量4
     * @param float $value 值
     * @return CData Vector4 向量4 加法值 结果
     */
    public static function vector4AddValue(CData $Vector4, float $value): CData
    {
        return self::ffi()->Vector4AddValue($Vector4, $value);
    }

    /**
     * 向量4 减法
     *
     * @param CData Vector4 $Vector4_1 向量4
     * @param CData Vector4 $Vector4_2 向量4
     * @return CData Vector4 向量4 减法 结果
     */
    public static function vector4Subtract(CData $Vector4_1, CData $Vector4_2): CData
    {
        return self::ffi()->Vector4Subtract($Vector4_1, $Vector4_2);
    }

    /**
     * 向量4 减法值
     *
     * @param CData Vector4 $Vector4 向量4
     * @param float $value 值
     * @return CData Vector4 向量4 减法值 结果
     */
    public static function vector4SubtractValue(CData $Vector4, float $value): CData
    {
        return self::ffi()->Vector4SubtractValue($Vector4, $value);
    }

    /**
     * 向量4 长度
     *
     * @param CData Vector4 $Vector4 向量4
     * @return float 向量4 长度 结果
     */
    public static function vector4Length(CData $Vector4): float
    {
        return self::ffi()->Vector4Length($Vector4);
    }

    /**
     * 向量4 长度平方
     *
     * @param CData Vector4 $Vector4 向量4
     * @return float 向量4 长度平方 结果
     */
    public static function vector4LengthSqr(CData $Vector4): float
    {
        return self::ffi()->Vector4LengthSqr($Vector4);
    }

    /**
     * 向量4 点积
     *
     * @param CData Vector4 $Vector4_1 向量4
     * @param CData Vector4 $Vector4_2 向量4
     * @return float 向量4 点积 结果
     */
    public static function vector4DotProduct(CData $Vector4_1, CData $Vector4_2): float
    {
        return self::ffi()->Vector4DotProduct($Vector4_1, $Vector4_2);
    }

    /**
     * 向量4 距离
     *
     * @param CData Vector4 $Vector4_1 向量4
     * @param CData Vector4 $Vector4_2 向量4
     * @return float 向量4 距离 结果
     */
    public static function vector4Distance(CData $Vector4_1, CData $Vector4_2): float
    {
        return self::ffi()->Vector4Distance($Vector4_1, $Vector4_2);
    }

    /**
     * 向量4 距离平方
     *
     * @param CData Vector4 $Vector4_1 向量4
     * @param CData Vector4 $Vector4_2 向量4
     * @return float 向量4 距离平方 结果
     */
    public static function vector4DistanceSqr(CData $Vector4_1, CData $Vector4_2): float
    {
        return self::ffi()->Vector4DistanceSqr($Vector4_1, $Vector4_2);
    }

    /**
     * 向量4 缩放
     *
     * @param CData Vector4 $Vector4 向量4
     * @param float $scalar 标量
     * @return CData Vector4 向量4 缩放 结果
     */
    public static function vector4Scale(CData $Vector4, float $scalar): CData
    {
        return self::ffi()->Vector4Scale($Vector4, $scalar);
    }

    /**
     * 向量4 乘法
     *
     * @param CData Vector4 $Vector4_1 向量4
     * @param CData Vector4 $Vector4_2 向量4
     * @return CData Vector4 向量4 乘法 结果
     */
    public static function vector4Multiply(CData $Vector4_1, CData $Vector4_2): CData
    {
        return self::ffi()->Vector4Multiply($Vector4_1, $Vector4_2);
    }

    /**
     * 向量4 取反
     *
     * @param CData Vector4 $Vector4 向量4
     * @return CData Vector4 向量4 取反 结果
     */
    public static function vector4Negate(CData $Vector4): CData
    {
        return self::ffi()->Vector4Negate($Vector4);
    }

    /**
     * 向量4 除法
     *
     * @param CData Vector4 $Vector4_1 向量4
     * @param CData Vector4 $Vector4_2 向量4
     * @return CData Vector4 向量4 除法 结果
     */
    public static function vector4Divide(CData $Vector4_1, CData $Vector4_2): CData
    {
        return self::ffi()->Vector4Divide($Vector4_1, $Vector4_2);
    }

    /**
     * 向量4 归一化
     *
     * @param CData Vector4 $Vector4 向量4
     * @return CData Vector4 向量4 归一化 结果
     */
    public static function vector4Normalize(CData $Vector4): CData
    {
        return self::ffi()->Vector4Normalize($Vector4);
    }

    /**
     * 向量4 最小值
     *
     * @param CData Vector4 $Vector4_1 向量4
     * @param CData Vector4 $Vector4_2 向量4
     * @return CData Vector4 向量4 最小值 结果
     */
    public static function vector4Min(CData $Vector4_1, CData $Vector4_2): CData
    {
        return self::ffi()->Vector4Min($Vector4_1, $Vector4_2);
    }

    /**
     * 向量4 最大值
     *
     * @param CData Vector4 $Vector4_1 向量4
     * @param CData Vector4 $Vector4_2 向量4
     * @return CData Vector4 向量4 最大值 结果
     */
    public static function vector4Max(CData $Vector4_1, CData $Vector4_2): CData
    {
        return self::ffi()->Vector4Max($Vector4_1, $Vector4_2);
    }

    /**
     * 向量4 插值
     *
     * @param CData Vector4 $Vector4_1 向量4
     * @param CData Vector4 $Vector4_2 向量4
     * @param float $amount 插值参数
     * @return CData Vector4 向量4 插值 结果
     */
    public static function vector4Lerp(CData $Vector4_1, CData $Vector4_2, float $amount): CData
    {
        return self::ffi()->Vector4Lerp($Vector4_1, $Vector4_2, $amount);
    }

    /**
     * 向量4 移动方向
     *
     * @param CData Vector4 $Vector4_1 向量4
     * @param CData Vector4 $Vector4_2 向量4
     * @param float $maxDistanceDelta 最大移动距离
     * @return CData Vector4 向量4 移动方向 结果
     */
    public static function vector4MoveTowards(CData $Vector4_1, CData $Vector4_2, float $maxDistanceDelta): CData
    {
        return self::ffi()->Vector4MoveTowards($Vector4_1, $Vector4_2, $maxDistanceDelta);
    }

    /**
     * 向量4 取反
     *
     * @param CData Vector4 $Vector4 向量4
     * @return CData Vector4 向量4 取反 结果
     */
    public static function vector4Invert(CData $Vector4): CData
    {
        return self::ffi()->Vector4Invert($Vector4);
    }

    /**
     * 向量4 是否相等
     *
     * @param CData Vector4 $Vector4_1 向量4
     * @param CData Vector4 $Vector4_2 向量4
     * @return bool 向量4 是否相等 结果
     */
    public static function vector4Equals(CData $Vector4_1, CData $Vector4_2): bool
    {
        return self::ffi()->Vector4Equals($Vector4_1, $Vector4_2) == 1;
    }

    /**
     * 矩阵4 行列式
     *
     * @param CData Matrix $Matrix 矩阵4
     * @return float 矩阵4 行列式 结果
     */
    public static function matrixDeterminant(CData $Matrix): float
    {
        return self::ffi()->MatrixDeterminant($Matrix);
    }

    /**
     * 矩阵4 迹
     *
     * @param CData Matrix $Matrix 矩阵4
     * @return float 矩阵4 迹 结果
     */
    public static function matrixTrace(CData $Matrix): float
    {
        return self::ffi()->MatrixTrace($Matrix);
    }

    /**
     * 矩阵4 转置
     *
     * @param CData Matrix $Matrix 矩阵4
     * @return CData Matrix 矩阵4 转置 结果
     */
    public static function matrixTranspose(CData $Matrix): CData
    {
        return self::ffi()->MatrixTranspose($Matrix);
    }

    /**
     * 矩阵4 取反
     *
     * @param CData Matrix $Matrix 矩阵4
     * @return CData Matrix 矩阵4 取反 结果
     */
    public static function matrixInvert(CData $Matrix): CData
    {
        return self::ffi()->MatrixInvert($Matrix);
    }

    /**
     * 矩阵4 单位矩阵
     *
     * @return CData Matrix 矩阵4 单位矩阵 结果
     */
    public static function matrixIdentity(): CData
    {
        return self::ffi()->MatrixIdentity();
    }

    /**
     * 矩阵4 加法
     *
     * @param CData Matrix $Matrix_left 矩阵4
     * @param CData Matrix $Matrix_right 矩阵4
     * @return CData Matrix 矩阵4 加法 结果
     */
    public static function matrixAdd(CData $Matrix_left, CData $Matrix_right): CData
    {
        return self::ffi()->MatrixAdd($Matrix_left, $Matrix_right);
    }

    /**
     * 矩阵4 减法
     *
     * @param CData Matrix $Matrix_left 矩阵4
     * @param CData Matrix $Matrix_right 矩阵4
     * @return CData Matrix 矩阵4 减法 结果
     */
    public static function matrixSubtract(CData $Matrix_left, CData $Matrix_right): CData
    {
        return self::ffi()->MatrixSubtract($Matrix_left, $Matrix_right);
    }

    /**
     * 矩阵4 乘法
     *
     * @param CData Matrix $Matrix_left 矩阵4
     * @param CData Matrix $Matrix_right 矩阵4
     * @return CData Matrix 矩阵4 乘法 结果
     */
    public static function matrixMultiply(CData $Matrix_left, CData $Matrix_right): CData
    {
        return self::ffi()->MatrixMultiply($Matrix_left, $Matrix_right);
    }

    /**
     * 矩阵4 平移
     *
     * @param float $x 平移X轴
     * @param float $y 平移Y轴
     * @param float $z 平移Z轴
     * @return CData Matrix 矩阵4 平移 结果
     */
    public static function matrixTranslate(float $x, float $y, float $z): CData
    {
        return self::ffi()->MatrixTranslate($x, $y, $z);
    }

    /**
     * 矩阵4 旋转
     *
     * @param CData Vector3 $axis 旋转轴
     * @param float $angle 旋转角度
     * @return CData Matrix 矩阵4 旋转 结果
     */
    public static function matrixRotate(CData $axis, float $angle): CData
    {
        return self::ffi()->MatrixRotate($axis, $angle);
    }

    /**
     * 矩阵4 旋转X轴
     *
     * @param float $angle 旋转角度
     * @return CData Matrix 矩阵4 旋转X轴 结果
     */
    public static function matrixRotateX(float $angle): CData
    {
        return self::ffi()->MatrixRotateX($angle);
    }

    /**
     * 矩阵4 旋转Y轴
     *
     * @param float $angle 旋转角度
     * @return CData Matrix 矩阵4 旋转Y轴 结果
     */
    public static function matrixRotateY(float $angle): CData
    {
        return self::ffi()->MatrixRotateY($angle);
    }

    /**
     * 矩阵4 旋转Z轴
     *
     * @param float $angle 旋转角度
     * @return CData Matrix 矩阵4 旋转Z轴 结果
     */
    public static function matrixRotateZ(float $angle): CData
    {
        return self::ffi()->MatrixRotateZ($angle);
    }

    /**
     * 矩阵4 旋转XYZ轴
     *
     * @param CData Vector3 $Vector3_angle 旋转XYZ轴角度
     * @return CData Matrix 矩阵4 旋转XYZ轴 结果
     */
    public static function matrixRotateXYZ(CData $Vector3_angle): CData
    {
        return self::ffi()->MatrixRotateXYZ($Vector3_angle);
    }

    /**
     * 矩阵4 旋转ZYX轴
     *
     * @param CData Vector3 $Vector3_angle 旋转ZYX轴角度
     * @return CData Matrix 矩阵4 旋转ZYX轴 结果
     */
    public static function matrixRotateZYX(CData $Vector3_angle): CData
    {
        return self::ffi()->MatrixRotateZYX($Vector3_angle);
    }

    /**
     * 矩阵4 缩放
     *
     * @param float $x 缩放X轴
     * @param float $y 缩放Y轴
     * @param float $z 缩放Z轴
     * @return CData Matrix 矩阵4 缩放 结果
     */
    public static function matrixScale(float $x, float $y, float $z): CData
    {
        return self::ffi()->MatrixScale($x, $y, $z);
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
     * @return CData Matrix 矩阵4 透视投影 结果
     */
    public static function matrixFrustum(float $left, float $right, float $bottom, float $top, float $nearPlane, float $farPlane): CData
    {
        return self::ffi()->MatrixFrustum($left, $right, $bottom, $top, $nearPlane, $farPlane);
    }

    /**
     * 矩阵4 透视投影
     *
     * @param float $fovY 垂直视野角度
     * @param float $aspect 宽高比
     * @param float $nearPlane 近裁剪平面
     * @param float $farPlane 远裁剪平面
     * @return CData Matrix 矩阵4 透视投影 结果
     */
    public static function matrixPerspective(float $fovY, float $aspect, float $nearPlane, float $farPlane): CData
    {
        return self::ffi()->MatrixPerspective($fovY, $aspect, $nearPlane, $farPlane);
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
     * @return CData Matrix 矩阵4 正交投影 结果
     */
    public static function matrixOrtho(float $left, float $right, float $bottom, float $top, float $nearPlane, float $farPlane): CData
    {
        return self::ffi()->MatrixOrtho($left, $right, $bottom, $top, $nearPlane, $farPlane);
    }

    /**
     * 矩阵4 观察矩阵
     *
     * @param CData Vector3 $Vector3_eye 相机位置
     * @param CData Vector3 $Vector3_target 相机目标
     * @param CData Vector3 $Vector3_up 相机上方向
     * @return CData Matrix 矩阵4 观察矩阵 结果
     */
    public static function matrixLookAt(CData $Vector3_eye, CData $Vector3_target, CData $Vector3_up): CData
    {
        return self::ffi()->MatrixLookAt($Vector3_eye, $Vector3_target, $Vector3_up);
    }

    /**
     * 矩阵4 转换为浮点数对象
     *
     * @param CData Matrix $Matrix 矩阵4
     * @return CData 浮点数对象
     */
    public static function matrixToFloatV(CData $Matrix): CData
    {
        return self::ffi()->MatrixToFloatV($Matrix);
    }

    /**
     * 四元数 加法
     *
     * @param CData Quaternion $Quaternion_a 四元数a
     * @param CData Quaternion $Quaternion_b 四元数b
     * @return CData Quaternion 四元数 加法 结果
     */
    public static function quaternionAdd(CData $Quaternion_a, CData $Quaternion_b): CData
    {
        return self::ffi()->QuaternionAdd($Quaternion_a, $Quaternion_b);
    }

    /**
     * 四元数 加法
     *
     * @param CData Quaternion $Quaternion_a 四元数a
     * @param float $add 四元数b值
     * @return CData Quaternion 四元数 加法 结果
     */
    public static function quaternionAddValue(CData $Quaternion_a, float $add): CData
    {
        return self::ffi()->QuaternionAddValue($Quaternion_a, $add);
    }

    /**
     * 四元数 减法
     *
     * @param CData Quaternion $Quaternion_a 四元数a
     * @param CData Quaternion $Quaternion_b 四元数b
     * @return CData Quaternion 四元数 减法 结果
     */
    public static function quaternionSubtract(CData $Quaternion_a, CData $Quaternion_b): CData
    {
        return self::ffi()->QuaternionSubtract($Quaternion_a, $Quaternion_b);
    }

    /**
     * 四元数 减法
     *
     * @param CData Quaternion $Quaternion_a 四元数a
     * @param float $subtract 四元数b值
     * @return CData Quaternion 四元数 减法 结果
     */
    public static function quaternionSubtractValue(CData $Quaternion_a, float $subtract): CData
    {
        return self::ffi()->QuaternionSubtractValue($Quaternion_a, $subtract);
    }

    /**
     * 四元数 身份
     *
     * @return CData Quaternion 四元数 身份 结果
     */
    public static function quaternionIdentity(): CData
    {
        return self::ffi()->QuaternionIdentity();
    }

    /**
     * 四元数 长度
     *
     * @param CData Quaternion $Quaternion 四元数
     * @return float 四元数 长度 结果
     */
    public static function quaternionLength(CData $Quaternion): float
    {
        return self::ffi()->QuaternionLength($Quaternion);
    }

    /**
     * 四元数 归一化
     *
     * @param CData Quaternion $Quaternion 四元数
     * @return CData Quaternion 四元数 归一化 结果
     */
    public static function quaternionNormalize(CData $Quaternion): CData
    {
        return self::ffi()->QuaternionNormalize($Quaternion);
    }

    /**
     * 四元数 反相
     *
     * @param CData Quaternion $Quaternion 四元数
     * @return CData Quaternion 四元数 反相 结果
     */
    public static function quaternionInvert(CData $Quaternion): CData
    {
        return self::ffi()->QuaternionInvert($Quaternion);
    }

    /**
     * 四元数 乘法
     *
     * @param CData Quaternion $Quaternion_a 四元数a
     * @param CData Quaternion $Quaternion_b 四元数b
     * @return CData Quaternion 四元数 乘法 结果
     */
    public static function quaternionMultiply(CData $Quaternion_a, CData $Quaternion_b): CData
    {
        return self::ffi()->QuaternionMultiply($Quaternion_a, $Quaternion_b);
    }

    /**
     * 四元数 乘法
     *
     * @param CData Quaternion $Quaternion 四元数
     * @param float $scale 缩放值
     * @return CData Quaternion 四元数 乘法 结果
     */
    public static function quaternionScale(CData $Quaternion, float $scale): CData
    {
        return self::ffi()->QuaternionScale($Quaternion, $scale);
    }

    /**
     * 四元数 除法
     *
     * @param CData Quaternion $Quaternion_a 四元数a
     * @param CData Quaternion $Quaternion_b 四元数b
     * @return CData Quaternion 四元数 除法 结果
     */
    public static function quaternionDivide(CData $Quaternion_a, CData $Quaternion_b): CData
    {
        return self::ffi()->QuaternionDivide($Quaternion_a, $Quaternion_b);
    }

    /**
     * 四元数 插值
     *
     * @param CData Quaternion $Quaternion_a 四元数a
     * @param CData Quaternion $Quaternion_b 四元数b
     * @param float $amount 插值比例
     * @return CData Quaternion 四元数 插值 结果
     */
    public static function quaternionLerp(CData $Quaternion_a, CData $Quaternion_b, float $amount): CData
    {
        return self::ffi()->QuaternionLerp($Quaternion_a, $Quaternion_b, $amount);
    }

    /**
     * 四元数 归一化插值
     *
     * @param CData Quaternion $Quaternion_a 四元数a
     * @param CData Quaternion $Quaternion_b 四元数b
     * @param float $amount 插值比例
     * @return CData Quaternion 四元数 归一化插值 结果
     */
    public static function quaternionNlerp(CData $Quaternion_a, CData $Quaternion_b, float $amount): CData
    {
        return self::ffi()->QuaternionNlerp($Quaternion_a, $Quaternion_b, $amount);
    }

    /**
     * 四元数 球面线性插值
     *
     * @param CData Quaternion $Quaternion_a 四元数a
     * @param CData Quaternion $Quaternion_b 四元数b
     * @param float $amount 插值比例
     * @return CData Quaternion 四元数 球面线性插值 结果
     */
    public static function quaternionSlerp(CData $Quaternion_a, CData $Quaternion_b, float $amount): CData
    {
        return self::ffi()->QuaternionSlerp($Quaternion_a, $Quaternion_b, $amount);
    }

    /**
     * 四元数 三次Hermite插值
     * 
     * @param CData Quaternion $Quaternion_q1 四元数a
     * @param CData Quaternion $Quaternion_outTangent1 四元数a的外切线
     * @param CData Quaternion $Quaternion_q2 四元数b
     * @param CData Quaternion $Quaternion_inTangent2 四元数b的内切线
     * @param float $t 插值比例
     * @return CData Quaternion 四元数 三次Hermite插值 结果
     */
    public static function quaternionCubicHermiteSpline(CData $Quaternion_q1, CData $Quaternion_outTangent1, CData $Quaternion_q2, CData $Quaternion_inTangent2, float $t): CData
    {
        return self::ffi()->QuaternionCubicHermiteSpline($Quaternion_q1, $Quaternion_outTangent1, $Quaternion_q2, $Quaternion_inTangent2, $t);
    }

    /**
     * 四元数 从向量3到向量3
     *
     * @param CData Vector3 $Vector3_from 向量3a
     * @param CData Vector3 $Vector3_to 向量3b
     * @return CData Quaternion 四元数 从向量3到向量3 结果
     */
    public static function quaternionFromVector3ToVector3(CData $Vector3_from, CData $Vector3_to): CData
    {
        return self::ffi()->QuaternionFromVector3ToVector3($Vector3_from, $Vector3_to);
    }

    /**
     * 四元数 从矩阵
     *
     * @param CData Matrix $Matrix 矩阵
     * @return CData Quaternion 四元数 从矩阵 结果
     */
    public static function quaternionFromMatrix(CData $Matrix): CData
    {
        return self::ffi()->QuaternionFromMatrix($Matrix);
    }

    /**
     * 四元数 转换为矩阵
     *
     * @param CData Quaternion $Quaternion 四元数
     * @return CData Matrix 矩阵 结果
     */
    public static function quaternionToMatrix(CData $Quaternion): CData
    {
        return self::ffi()->QuaternionToMatrix($Quaternion);
    }

    /**
     * 四元数 从轴角
     *
     * @param CData Vector3 $Vector3_axis 轴向量
     * @param float $angle 旋转角度（弧度）
     * @return CData Quaternion 四元数 从轴角 结果
     */
    public static function quaternionFromAxisAngle(CData $Vector3_axis, float $angle): CData
    {
        return self::ffi()->QuaternionFromAxisAngle($Vector3_axis, $angle);
    }

    /**
     * 四元数 转换为轴角
     *
     * @param CData Quaternion $Quaternion 四元数
     * @param CData Vector3 $Vector3_axis 轴向量 结果
     * @param void 
     */
    public static function quaternionToAxisAngle(CData $Quaternion, CData &$Vector3_outAxis, float &$outAngle): void
    {
        $Vector3_outAxis = self::ffi()::addr($Vector3_outAxis);
        $c_outAngle = self::ffi()->new('float[1]');
        $c_outAngle[0] = $outAngle;
        $outAngle = self::ffi()::addr($c_outAngle);
        self::ffi()->QuaternionToAxisAngle($Quaternion, $Vector3_outAxis, $outAngle);
    }

    /**
     * 四元数 从欧拉角
     *
     * @param float $pitch 俯仰角（弧度）
     * @param float $yaw 偏航角（弧度）
     * @param float $roll 滚转角（弧度）
     * @return CData Quaternion 四元数 从欧拉角 结果
     */
    public static function quaternionFromEuler(float $pitch, float $yaw, float $roll): CData
    {
        return self::ffi()->QuaternionFromEuler($pitch, $yaw, $roll);
    }

    /**
     * 四元数 转换为欧拉角
     *
     * @param CData Quaternion $Quaternion 四元数
     * @return CData Vector3 欧拉角 结果
     */
    public static function quaternionToEuler(CData $Quaternion): CData
    {
        return self::ffi()->QuaternionToEuler($Quaternion);
    }

    /**
     * 四元数 变换向量3
     *
     * @param CData Quaternion $Quaternion 四元数
     * @param CData Matrix $mat 变换矩阵
     * @return CData Vector3 变换后的向量3 结果
     */
    public static function quaternionTransform(CData $Quaternion, CData $mat): CData
    {
        return self::ffi()->QuaternionTransform($Quaternion, $mat);
    }

    /**
     * 四元数 相等判断
     *
     * @param CData Quaternion $Quaternion_a 四元数a
     * @param CData Quaternion $Quaternion_b 四元数b
     * @return bool 是否相等 结果
     */
    public static function quaternionEquals(CData $Quaternion_a, CData $Quaternion_b): bool
    {
        return self::ffi()->QuaternionEquals($Quaternion_a, $Quaternion_b) == 1;
    }

    /**
     * 四元数 分解矩阵
     *
     * @param CData Matrix $mat 矩阵
     * @param CData Vector3 $translation 平移向量 结果
     * @param CData Quaternion $rotation 旋转四元数 结果
     * @param CData Vector3 $scale 缩放向量 结果
     * @return void
     */
    public static function matrixDecompose(CData $mat, CData &$translation, CData &$rotation, CData &$scale): void
    {
        $translation = self::ffi()::addr($translation);
        $rotation = self::ffi()::addr($rotation);
        $scale = self::ffi()::addr($scale);
        self::ffi()->MatrixDecompose($mat, $translation, $rotation, $scale);
    }
}
