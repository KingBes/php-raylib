<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib\Utils;

use Kingbes\Raylib\Base;
use \FFI\CData;

/**
 * 自动化事件列表对象
 * 
 * @property int $capacity 事件列表的容量
 * @property int $count 事件列表中事件的数量
 * @property AutomationEvent[] $events 事件列表
 */
class AutomationEventList extends Base
{
    public int $capacity;
    public int $count;
    public array $events;

    public function __construct(int $capacity, int $count, array $events)
    {
        $this->capacity = $capacity;
        $this->count = $count;
        $this->events = $events;
    }

    /**
     * 自动化事件列表结构体
     *
     * @return CData
     */
    public function struct(): CData
    {
        $struct = self::ffi()->new('AutomationEventList');
        $struct->capacity = $this->capacity;
        $struct->count = $this->count;
        $c_events = self::ffi()->new('AutomationEvent[' . count($this->events) . ']');
        foreach ($this->events as $i => $event) {
            $c_events[$i] = $event->struct();
        }
        $struct->events = self::ffi()->addr($c_events);
        return $struct;
    }
}
