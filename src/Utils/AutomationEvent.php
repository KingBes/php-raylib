<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib\Utils;

use Kingbes\Raylib\Base;
use \FFI\CData;

/**
 * 自动化事件对象
 * 
 * @property int $frame 事件发生的帧数
 * @property int $type 事件类型
 * @property array<int> $params 事件参数，数组长度必须为4
 */
class AutomationEvent extends Base
{
    public int $frame;
    public int $type;
    public array $params;

    /**
     * 自动化事件对象
     *
     * @param integer $frame 事件发生的帧数
     * @param integer $type 事件类型
     * @param array<int> $params 事件参数，数组长度必须为4
     */
    public function __construct(int $frame, int $type, array $params)
    {
        $this->frame = $frame;
        $this->type = $type;
        $this->params = $params;
    }

    /**
     * 自动化事件结构体
     *
     * @return CData
     */
    public function struct(): CData
    {
        $struct = self::ffi()->new('AutomationEvent');
        $struct->frame = $this->frame;
        $struct->type = $this->type;
        $c_params = self::ffi()->new('int[4]');
        foreach ($this->params as $i => $param) {
            $c_params[$i] = $param;
        }
        $struct->params = $c_params;
        return $struct;
    }
}
