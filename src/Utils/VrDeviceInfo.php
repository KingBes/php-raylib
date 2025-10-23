<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib\Utils;

use Kingbes\Raylib\Base;
use \FFI\CData;

/**
 * VR设备信息对象 虚拟现实设备信息、头戴式显示器设备参数
 * 
 * @property int $hResolution 水平分辨率
 * @property int $vResolution 垂直分辨率
 * @property float $hScreenSize 水平屏幕尺寸
 * @property float $vScreenSize 垂直屏幕尺寸
 * @property float $eyeToScreenDistance 眼睛到屏幕距离
 * @property float $lensSeparationDistance 镜头分离距离
 * @property float $interpupillaryDistance 瞳距
 * @property array<float> $lensDistortionValues 镜头畸变值 4个值
 * @property array<float> $chromaAbCorrection 色度畸变修正值 4个值
 */
class VrDeviceInfo extends Base
{
    public int $hResolution;
    public int $vResolution;
    public float $hScreenSize;
    public float $vScreenSize;
    public float $eyeToScreenDistance;
    public float $lensSeparationDistance;
    public float $interpupillaryDistance;
    public array $lensDistortionValues;
    public array $chromaAbCorrection;

    /**
     * VR设备信息对象
     *
     * @param int $hResolution 水平分辨率
     * @param int $vResolution 垂直分辨率
     * @param float $hScreenSize 水平屏幕尺寸
     * @param float $vScreenSize 垂直屏幕尺寸
     * @param float $eyeToScreenDistance 眼睛到屏幕距离
     * @param float $lensSeparationDistance 镜头分离距离
     * @param float $interpupillaryDistance 瞳距
     * @param array<float> $lensDistortionValues 镜头畸变值 4个值
     * @param array<float> $chromaAbCorrection 色度畸变修正值 4个值
     */
    public function __construct(
        int $hResolution,
        int $vResolution,
        float $hScreenSize,
        float $vScreenSize,
        float $eyeToScreenDistance,
        float $lensSeparationDistance,
        float $interpupillaryDistance,
        array $lensDistortionValues,
        array $chromaAbCorrection
    ) {
        $this->hResolution = $hResolution;
        $this->vResolution = $vResolution;
        $this->hScreenSize = $hScreenSize;
        $this->vScreenSize = $vScreenSize;
        $this->eyeToScreenDistance = $eyeToScreenDistance;
        $this->lensSeparationDistance = $lensSeparationDistance;
        $this->interpupillaryDistance = $interpupillaryDistance;
        $this->lensDistortionValues = $lensDistortionValues;
        $this->chromaAbCorrection = $chromaAbCorrection;
    }

    /**
     * VR设备信息结构体
     *
     * @return CData
     */
    public function struct(): CData
    {
        $struct = self::ffi()->new('struct VrDeviceInfo');
        $struct->hResolution = $this->hResolution;
        $struct->vResolution = $this->vResolution;
        $struct->hScreenSize = $this->hScreenSize;
        $struct->vScreenSize = $this->vScreenSize;
        $struct->eyeToScreenDistance = $this->eyeToScreenDistance;
        $struct->lensSeparationDistance = $this->lensSeparationDistance;
        $struct->interpupillaryDistance = $this->interpupillaryDistance;
        $c_lensDistortionValues = self::ffi()->new('float[4]');
        foreach ($this->lensDistortionValues as $key => $value) {
            $c_float = self::ffi()->new('float');
            $c_float->cdata = (float)$value;
            $c_lensDistortionValues[$key] = $c_float;
        }
        $struct->lensDistortionValues = $c_lensDistortionValues;
        $c_chromaAbCorrection = self::ffi()->new('float[4]');
        foreach ($this->chromaAbCorrection as $key => $value) {
            $c_float = self::ffi()->new('float');
            $c_float->cdata = (float)$value;
            $c_chromaAbCorrection[$key] = $c_float;
        }
        $struct->chromaAbCorrection = $c_chromaAbCorrection;
        return $struct;
    }
}
