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

    /**
     * 以字节数组形式加载文件数据（读取）
     *
     * @param string $fileName 文件名
     * @param integer $fileSize 文件大小
     * @return \FFI\CData 内存指针
     */
    public static function loadFileData(string $fileName, int &$fileSize): \FFI\CData
    {
        return self::ffi()->LoadFileData($fileName, $fileSize);
    }

    /**
     * 卸载由loadFileData()分配的文件数据
     *
     * @param \FFI\CData $fileData 内存指针
     * @return void
     */
    public static function unloadFileData(\FFI\CData $fileData): void
    {
        self::ffi()->UnloadFileData($fileData);
    }

    /**
     * 将字节数组中的数据保存到文件（写入），成功返回true
     *
     * @param string $fileName 文件名
     * @param \FFI\CData $fileData 内存指针
     * @param integer $fileSize 文件大小
     * @return boolean true/false
     */
    public static function saveFileData(string $fileName, \FFI\CData $fileData, int $fileSize): bool
    {
        return self::ffi()->SaveFileData($fileName, $fileData, $fileSize);
    }

    /**
     * 将数据导出为代码文件（.h），成功返回true
     *
     * @param \FFI\CData $data 内存指针
     * @param integer $dataSize 内存大小
     * @param string $fileName 变量名
     * @return boolean true/false
     */
    public static function exportDataAsCode(\FFI\CData $data, int $dataSize, string $fileName): bool
    {
        return self::ffi()->ExportDataAsCode($data, $dataSize, $fileName);
    }

    /**
     * 从文件中加载文本数据（读取）
     *
     * @param string $fileName 文件名
     * @return string
     */
    public static function loadFileText(string $fileName): string
    {
        return self::ffi()->LoadFileText($fileName);
    }

    /**
     * 卸载由loadFileText()分配的文件文本数据
     *
     * @param string $fileText 文件文本数据
     * @return void
     */
    public static function unloadFileText(string $fileText): void
    {
        self::ffi()->UnloadFileText($fileText);
    }

    /**
     * 将文本数据保存到文件（写入）
     *
     * @param string $fileName 文件名
     * @param string $fileText 文件文本数据
     * @return boolean true/false
     */
    public static function saveFileText(string $fileName, string $fileText): bool
    {
        return self::ffi()->SaveFileText($fileName, $fileText);
    }
}
