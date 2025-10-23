<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib\Utils;

use Kingbes\Raylib\Base;
use \FFI\CData;

/**
 * VrStereoConfig，用于模拟器的虚拟现实立体渲染配置
 * 
 * @property array<Matrix> $projection 投影矩阵 2个值
 * @property array<Matrix> $viewOffset 视图偏移矩阵 2个值
 * @property array<float> $leftLensCenter 左镜头中心 2个值
 * @property array<float> $rightLensCenter 右镜头中心 2个值
 * @property array<float> $leftScreenCenter 左屏幕中心 2个值
 * @property array<float> $rightScreenCenter 右屏幕中心 2个值
 * @property array<float> $scale 缩放比例 2个值
 * @property array<float> $scaleIn 缩放比例 2个值
 */
class VrStereoConfig extends Base
{
    public array $projection;
    public array $viewOffset;
    public array $leftLensCenter;
    public array $rightLensCenter;
    public array $leftScreenCenter;
    public array $rightScreenCenter;
    public array $scale;
    public array $scaleIn;

    /**
     * 构造函数
     *
     * @param array<Matrix> $projection 投影矩阵 2个值
     * @param array<Matrix> $viewOffset 视图偏移矩阵 2个值
     * @param array<float> $leftLensCenter 左镜头中心 2个值
     * @param array<float> $rightLensCenter 右镜头中心 2个值
     * @param array<float> $leftScreenCenter 左屏幕中心 2个值
     * @param array<float> $rightScreenCenter 右屏幕中心 2个值
     * @param array<float> $scale 缩放比例 2个值
     * @param array<float> $scaleIn 缩放比例 2个值
     */
    public function __construct(
        array $projection,
        array $viewOffset,
        array $leftLensCenter,
        array $rightLensCenter,
        array $leftScreenCenter,
        array $rightScreenCenter,
        array $scale,
        array $scaleIn,
    ) {
        $this->projection = $projection;
        $this->viewOffset = $viewOffset;
        $this->leftLensCenter = $leftLensCenter;
        $this->rightLensCenter = $rightLensCenter;
        $this->leftScreenCenter = $leftScreenCenter;
        $this->rightScreenCenter = $rightScreenCenter;
        $this->scale = $scale;
        $this->scaleIn = $scaleIn;
    }

    public function struct(): CData
    {
        $struct = self::ffi()->new('struct VrStereoConfig');
        $c_projection = self::ffi()->new('Matrix[2]');
        foreach ($this->projection as $key => $value) {
            $c_projection[$key] = $value->struct();
        }
        $struct->projection = $c_projection;
        $c_viewOffset = self::ffi()->new('Matrix[2]');
        foreach ($this->viewOffset as $key => $value) {
            $c_viewOffset[$key] = $value->struct();
        }
        $struct->viewOffset = $c_viewOffset;
        $c_leftLensCenter = self::ffi()->new('float[2]');
        foreach ($this->leftLensCenter as $key => $value) {
            $c_float = self::ffi()->new('float');
            $c_float->cdata = (float)$value;
            $c_leftLensCenter[$key] = $c_float;
        }
        $struct->leftLensCenter = $c_leftLensCenter;
        $c_rightLensCenter = self::ffi()->new('float[2]');
        foreach ($this->rightLensCenter as $key => $value) {
            $c_float = self::ffi()->new('float');
            $c_float->cdata = (float)$value;
            $c_rightLensCenter[$key] = $c_float;
        }
        $struct->rightLensCenter = $c_rightLensCenter;
        $c_leftScreenCenter = self::ffi()->new('float[2]');
        foreach ($this->leftScreenCenter as $key => $value) {
            $c_float = self::ffi()->new('float');
            $c_float->cdata = (float)$value;
            $c_leftScreenCenter[$key] = $c_float;
        }
        $struct->leftScreenCenter = $c_leftScreenCenter;
        $c_rightScreenCenter = self::ffi()->new('float[2]');
        foreach ($this->rightScreenCenter as $key => $value) {
            $c_float = self::ffi()->new('float');
            $c_float->cdata = (float)$value;
            $c_rightScreenCenter[$key] = $c_float;
        }
        $struct->rightScreenCenter = $c_rightScreenCenter;
        $c_scale = self::ffi()->new('float[2]');
        foreach ($this->scale as $key => $value) {
            $c_float = self::ffi()->new('float');
            $c_float->cdata = (float)$value;
            $c_scale[$key] = $c_float;
        }
        $struct->scale = $c_scale;
        $c_scaleIn = self::ffi()->new('float[2]');
        foreach ($this->scaleIn as $key => $value) {
            $c_float = self::ffi()->new('float');
            $c_float->cdata = (float)$value;
            $c_scaleIn[$key] = $c_float;
        }
        $struct->scaleIn = $c_scaleIn;
        return $struct;
    }
}
