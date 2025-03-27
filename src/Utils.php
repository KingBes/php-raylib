<?php
// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib;

/**
 * 工具类
 */
class utils extends Base
{

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
}
