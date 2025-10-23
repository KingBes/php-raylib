<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib\Utils;

use Kingbes\Raylib\Base;
use \FFI\CData;

/**
 * 矩阵对象
 * 
 * @property array<float> $firstRow 第一行 4 个元素
 * @property array<float> $secondRow 第二行 4 个元素
 * @property array<float> $thirdRow 第三行 4 个元素
 * @property array<float> $fourthRow 第四行 4 个元素
 */
class Matrix extends Base
{
    private array $firstRow;
    private array $secondRow;
    private array $thirdRow;
    private array $fourthRow;

    /**
     * 矩阵对象
     *
     * @param array<float> $firstRow 第一行 4 个元素
     * @param array<float> $secondRow 第二行 4 个元素
     * @param array<float> $thirdRow 第三行 4 个元素
     * @param array<float> $fourthRow 第四行 4 个元素
     * @return void
     */
    public function __construct(
        array $firstRow,
        array $secondRow,
        array $thirdRow,
        array $fourthRow
    ) {
        $this->firstRow = $firstRow;
        $this->secondRow = $secondRow;
        $this->thirdRow = $thirdRow;
        $this->fourthRow = $fourthRow;
    }

    /**
     * 矩阵对象结构体
     *
     * @return CData
     */
    public function struct(): CData
    {
        $matrix = self::ffi()->new('struct Matrix');
        $matrix->m0 = $this->firstRow[0];
        $matrix->m1 = $this->firstRow[1];
        $matrix->m2 = $this->firstRow[2];
        $matrix->m3 = $this->firstRow[3];
        $matrix->m4 = $this->secondRow[0];
        $matrix->m5 = $this->secondRow[1];
        $matrix->m6 = $this->secondRow[2];
        $matrix->m7 = $this->secondRow[3];
        $matrix->m8 = $this->thirdRow[0];
        $matrix->m9 = $this->thirdRow[1];
        $matrix->m10 = $this->thirdRow[2];
        $matrix->m11 = $this->thirdRow[3];
        $matrix->m12 = $this->fourthRow[0];
        $matrix->m13 = $this->fourthRow[1];
        $matrix->m14 = $this->fourthRow[2];
        $matrix->m15 = $this->fourthRow[3];
        return $matrix;
    }
}
