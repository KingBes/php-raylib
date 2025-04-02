<?php
// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib;

/**
 * 工具类
 */
class Utils extends Base
{

    /**
     * 颜色
     *
     * @param integer $r
     * @param integer $g
     * @param integer $b
     * @param integer $a
     * @return \FFI\CData
     */
    public static function Color(int $r, int $g, int $b, int $a = 255): \FFI\CData
    {
        $color = self::ffi()->new("struct Color");
        $color->r = $r;
        $color->g = $g;
        $color->b = $b;
        $color->a = $a;
        return $color;
    }

    /**
     * 向量
     *
     * @param float $x
     * @param float $y
     * @return \FFI\CData
     */
    public static function Vector2(float $x, float $y): \FFI\CData
    {
        $vector2 = self::ffi()->new("struct Vector2");
        $vector2->x = $x;
        $vector2->y = $y;
        return $vector2;
    }

    /**
     * 显示跟踪日志消息（LOG_DEBUG、LOG_INFO、LOG_WARNING、LOG_ERROR 等）
     *
     * @param integer $logLevel 日志级别
     * @param string $message 日志消息
     * @return void
     */
    public static function traceLog(int $logLevel, string $message): void
    {
        self::ffi()->TraceLog($logLevel, $message);
    }

    /**
     * 设置当前阈值（最低）日志级别
     *
     * @param integer $logLevel 日志级别
     * @return void
     */
    public static function setTraceLogLevel(int $logLevel): void
    {
        self::ffi()->SetTraceLogLevel($logLevel);
    }

    /**
     * 内部内存分配器
     *
     * @param integer $size 内存大小
     * @return \FFI\CData 内存指针
     */
    public static function memAlloc(int $size): \FFI\CData
    {
        return self::ffi()->MemAlloc($size);
    }

    /**
     * 内部内存重新分配器
     *
     * @param \FFI\CData $ptr 内存指针
     * @param integer $size 内存大小
     * @return \FFI\CData
     */
    public static function memRealloc(\FFI\CData $ptr, int $size): \FFI\CData
    {
        return self::ffi()->MemRealloc($ptr, $size);
    }

    /**
     * 内部内存释放
     *
     * @param \FFI\CData $ptr 内存指针
     * @return void
     */
    public static function memFree(\FFI\CData $ptr): void
    {
        self::ffi()->MemFree($ptr);
    }

    /**
     * 设置自定义跟踪日志回调函数
     *
     * @param \FFI\CData $callback 回调函数指针
     * @return void
     */
    public static function setTraceLogCallback(\FFI\CData $callback): void
    {
        self::ffi()->SetTraceLogCallback($callback);
    }

    /**
     * 设置自定义文件二进制数据加载回调函数
     *
     * @param \FFI\CData $callback 回调函数指针
     * @return void
     */
    public static function setLoadFileDataCallback(\FFI\CData $callback): void
    {
        self::ffi()->SetLoadFileDataCallback($callback);
    }

    /**
     * 设置自定义文件二进制数据保存回调函数
     *
     * @param \FFI\CData $callback 回调函数指针
     * @return void
     */
    public static function setSaveFileDataCallback(\FFI\CData $callback): void
    {
        self::ffi()->SetSaveFileDataCallback($callback);
    }

    /**
     * 设置自定义文件文本数据加载回调函数
     *
     * @param \FFI\CData $callback 回调函数指针
     * @return void
     */
    public static function setLoadFileTextCallback(\FFI\CData $callback): void
    {
        self::ffi()->SetLoadFileTextCallback($callback);
    }

    /**
     * 设置自定义文件文本数据保存回调函数
     *
     * @param \FFI\CData $callback 回调函数指针
     * @return void
     */
    public static function setSaveFileTextCallback(\FFI\CData $callback): void
    {
        self::ffi()->SetSaveFileTextCallback($callback);
    }

    /**
     * 计算CRC32哈希码
     *
     * @param string $data 数据
     * @param int $dataSize 数据大小
     * @return int
     */
    public static function computeCRC32(string $data, int $dataSize): int
    {
        return self::ffi()->ComputeCRC32($data, $dataSize);
    }

    /**
     * 计算MD5哈希码，返回静态int[4]数组（16字节）
     *
     * @param string $data 数据
     * @param int $dataSize 数据大小
     * @return \FFI\CData
     */
    public static function computeMD5(string $data, int $dataSize): \FFI\CData
    {
        return self::ffi()->ComputeMD5($data, $dataSize);
    }

    /**
     * 计算SHA1哈希码，返回静态int[5]数组（20字节）
     *
     * @param string $data 数据
     * @param int $dataSize 数据大小
     * @return \FFI\CData
     */
    public static function computeSHA1(string $data, int $dataSize): \FFI\CData
    {
        return self::ffi()->ComputeSHA1($data, $dataSize);
    }

    /**
     * 从文件加载自动化事件列表，若传入 NULL 则返回空列表，容量为 MAX_AUTOMATION_EVENTS
     *
     * @param string|null $fileName 文件名
     * @return \FFI\CData
     */
    public static function loadAutomationEventList(?string $fileName): \FFI\CData
    {
        return self::ffi()->LoadAutomationEventList($fileName);
    }

    /**
     * 从文件中卸载自动化事件列表
     *
     * @param \FFI\CData $list 自动化事件列表
     * @return void
     */
    public static function unloadAutomationEventList(\FFI\CData $list): void
    {
        self::ffi()->UnloadAutomationEventList($list);
    }

    /**
     * 将自动化事件列表导出为文本文件
     *
     * @param \FFI\CData $list 自动化事件列表
     * @param string $fileName 文件名
     * @return bool
     */
    public static function exportAutomationEventList(\FFI\CData $list, string $fileName): bool
    {
        return self::ffi()->ExportAutomationEventList($list, $fileName);
    }

    /**
     * 置要记录的自动化事件列表
     *
     * @param \FFI\CData $list 自动化事件列表
     * @return void
     */
    public static function setAutomationEventList(\FFI\CData $list): void
    {
        self::ffi()->SetAutomationEventList(\FFI::addr($list));
    }

    /**
     * 设置自动化事件内部的基础帧，开始记录
     *
     * @param int $frame 帧
     * @return void
     */
    public static function setAutomationEventBaseFrame(int $frame): void
    {
        self::ffi()->SetAutomationEventBaseFrame($frame);
    }

    /**
     * 开始记录自动化事件（必须先设置 AutomationEventList）
     *
     * @return void
     */
    public static function startAutomationEventRecording(): void
    {
        self::ffi()->StartAutomationEventRecording();
    }

    /**
     * 停止记录自动化事件
     *
     * @return void
     */
    public static function stopAutomationEventRecording(): void
    {
        self::ffi()->StopAutomationEventRecording();
    }

    /**
     * 播放已记录的自动化事件
     *
     * 注意：这里假设 `AutomationEvent` 在PHP中通过 \FFI\CData 表示
     *
     * @param \FFI\CData $event 自动化事件
     * @return void
     */
    public static function playAutomationEvent(\FFI\CData $event): void
    {
        self::ffi()->PlayAutomationEvent($event);
    }
}
