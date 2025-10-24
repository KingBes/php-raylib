<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib\Utils;

use Kingbes\Raylib\Base;
use \FFI\CData;

/**
 * n 块区域对象
 * 
 * @property int $left 左边界
 * @property int $top 上边界
 * @property int $right 右边界
 * @property int $bottom 下边界
 * @property int $layout n 块区域的布局：0=>3×3 1=>1×3 2=>3×1
 */
class NPatchInfo extends Base
{
    public int $left; // 左边界
    public int $top; // 上边界
    public int $right; // 右边界
    public int $bottom; // 下边界
    public int $layout; // n 块区域的布局：0=>3×3 1=>1×3 2=>3×1
    private CData $data;

    public function __construct(CData $cdata)
    {
        $this->left = $cdata->left;
        $this->top = $cdata->top;
        $this->right = $cdata->right;
        $this->bottom = $cdata->bottom;
        $this->layout = $cdata->layout;
        $this->data = $cdata;
    }

    /**
     * n 块区域结构体
     *
     * @return CData
     */
    public function struct(): CData
    {
        $this->data->left = $this->left;
        $this->data->top = $this->top;
        $this->data->right = $this->right;
        $this->data->bottom = $this->bottom;
        $this->data->layout = $this->layout;
        return $this->data;
    }
}
