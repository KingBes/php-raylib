<?php
// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib;

/**
 * Core类
 */
class Core extends Base
{
    /**
     * 初始化窗口和OpenGL上下文
     *
     * @param integer $width 宽度
     * @param integer $height 高度
     * @param string $title 标题
     * @return void
     */
    public static function initWindow(int $width, int $height, string $title): void
    {
        self::ffi()->InitWindow($width, $height, $title);
    }

    /**
     * 关闭窗口并卸载OpenGL上下文
     *
     * @return void
     */
    public static function closeWindow(): void
    {
        self::ffi()->CloseWindow();
    }

    /**
     * 检查应用程序是否应该关闭（按下ESC键或点击窗口关闭图标）
     *
     * @return boolean
     */
    public static function windowShouldClose(): bool
    {
        return self::ffi()->WindowShouldClose();
    }

    /**
     * 检查窗口是否已成功初始化
     *
     * @return boolean
     */
    public static function isWindowReady(): bool
    {
        return self::ffi()->IsWindowReady();
    }

    /**
     * 检查窗口当前是否为全屏模式
     *
     * @return boolean
     */
    public static function isWindowFullscreen(): bool
    {
        return self::ffi()->IsWindowFullscreen();
    }

    /**
     * 检查窗口当前是否为隐藏模式
     *
     * @return boolean
     */
    public static function isWindowHidden(): bool
    {
        return self::ffi()->IsWindowHidden();
    }

    /**
     * 检查窗口当前是否为最小化模式
     *
     * @return boolean
     */
    public static function isWindowMinimized(): bool
    {
        return self::ffi()->IsWindowMinimized();
    }

    /**
     * 检查窗口当前是否为最大化模式
     *
     * @return boolean
     */
    public static function isWindowMaximized(): bool
    {
        return self::ffi()->IsWindowMaximized();
    }

    /**
     * 检查窗口是否处于焦点状态
     *
     * @return boolean
     */
    public static function isWindowFocused(): bool
    {
        return self::ffi()->IsWindowFocused();
    }

    /**
     * 检查窗口在上一帧是否被调整大小
     *
     * @return boolean
     */
    public static function isWindowResized(): bool
    {
        return self::ffi()->IsWindowResized();
    }

    /**
     * 检查窗口是否处于给定状态
     *
     * @param integer $flag 状态
     * @return boolean
     */
    public static function isWindowState(int $flag): bool
    {
        return self::ffi()->IsWindowState($flag);
    }

    /**
     * 设置窗口的状态
     *
     * @param integer $flag 状态
     * @return void
     */
    public static function setWindowState(int $flag): void
    {
        self::ffi()->SetWindowState($flag);
    }

    /**
     * 清除窗口的状态
     *
     * @param integer $flag 状态
     * @return void
     */
    public static function clearWindowState(int $flag): void
    {
        self::ffi()->ClearWindowState($flag);
    }

    /**
     * 切换窗口的全屏/窗口模式
     *
     * @return void
     */
    public static function toggleFullscreen(): void
    {
        self::ffi()->ToggleFullscreen();
    }

    /**
     * 切换窗口状态：无边框窗口模式，调整窗口以匹配显示器分辨率
     *
     * @return void
     */
    public static function toggleBorderlessWindowed(): void
    {
        self::ffi()->ToggleBorderlessWindowed();
    }

    /**
     * 设置窗口状态：最大化（如果窗口可调整大小）
     *
     * @return void
     */
    public static function maximizeWindow(): void
    {
        self::ffi()->MaximizeWindow();
    }

    /**
     * 设置窗口状态：最小化（如果窗口可调整大小）
     *
     * @return void
     */
    public static function minimizeWindow(): void
    {
        self::ffi()->MinimizeWindow();
    }

    /**
     * 设置窗口状态：非最小化/最大化
     *
     * @return void
     */
    public static function restoreWindow(): void
    {
        self::ffi()->RestoreWindow();
    }

    /**
     * 设置窗口图标（单张图像，RGBA 32位）
     *
     * @param \FFI\CData $image 图像
     * @return void
     */
    public static function setWindowIcon(\FFI\CData $image): void
    {
        self::ffi()->SetWindowIcon($image);
    }

    /**
     * 设置窗口图标（多张图像，RGBA 32位）
     *
     * @param array $images 要设置的图像数组
     * @return void
     */
    public static function setWindowIcons(array $images): void
    {
        $count = count($images);
        $c_voids = self::ffi()->new("void[" . $count . "]");
        foreach ($images as $key => $image) {
            $c_voids[$key] = $image;
        }
        self::ffi()->SetWindowIcon($image, $count);
    }

    /**
     * 设置窗口标题
     *
     * @param string $title 标题
     * @return void
     */
    public static function setWindowTitle(string $title): void
    {
        self::ffi()->SetWindowTitle($title);
    }

    /**
     * 设置窗口位置
     *
     * @param integer $x 位置x
     * @param integer $y 位置y
     * @return void
     */
    public static function setWindowPosition(int $x, int $y): void
    {
        self::ffi()->SetWindowPosition($x, $y);
    }

    /**
     * 设置当前窗口所在的显示器
     *
     * @param integer $monitor 显示器
     * @return void
     */
    public static function setWindowMonitor(int $monitor): void
    {
        self::ffi()->SetWindowMonitor($monitor);
    }

    /**
     * 设置窗口的最小尺寸（适用于可调整大小的窗口）
     *
     * @param integer $width 宽度
     * @param integer $height 高度
     * @return void
     */
    public static function setWindowMinSize(int $width, int $height): void
    {
        self::ffi()->SetWindowMinSize($width, $height);
    }

    /**
     * 设置窗口的最大尺寸（适用于可调整大小的窗口）
     *
     * @param integer $width 宽度
     * @param integer $height 高度
     * @return void
     */
    public static function setWindowMaxSize(int $width, int $height): void
    {
        self::ffi()->SetWindowMaxSize($width, $height);
    }

    /**
     * 设置窗口的大小
     *
     * @param integer $width 宽度
     * @param integer $height 高度
     * @return void
     */
    public static function setWindowSize(int $width, int $height): void
    {
        self::ffi()->SetWindowSize($width, $height);
    }

    /**
     * 设置窗口的透明度（0.0f到1.0f之间）
     *
     * @param float $opacity 透明度
     * @return void
     */
    public static function setWindowOpacity(float $opacity): void
    {
        self::ffi()->SetWindowOpacity($opacity);
    }

    /**
     * 设置窗口获得焦点
     *
     * @return void
     */
    public static function setWindowFocused(): void
    {
        self::ffi()->SetWindowFocused();
    }

    /**
     * 获取原生窗口句柄
     *
     * @return \FFI\CData
     */
    public static function getWindowHandle(): \FFI\CData
    {
        return self::ffi()->GetWindowHandle();
    }

    /**
     * 获取当前屏幕宽度（相对于当前显示器）
     *
     * @return int
     */
    public static function getScreenWidth(): int
    {
        return self::ffi()->GetScreenWidth();
    }

    /**
     * 获取当前屏幕高度（相对于当前显示器）
     *
     * @return int
     */
    public static function getScreenHeight(): int
    {
        return self::ffi()->GetScreenHeight();
    }

    /**
     * 获取当前渲染宽度（考虑高DPI）
     *
     * @return integer 渲染宽度
     */
    public static function getRenderWidth(): int
    {
        return self::ffi()->GetRenderWidth();
    }

    /**
     * 获取当前渲染高度（考虑高DPI）
     *
     * @return integer 渲染高度
     */
    public static function getRenderHeight(): int
    {
        return self::ffi()->GetRenderHeight();
    }

    /**
     * 获取连接的显示器数量
     *
     * @return integer 显示器数量
     */
    public static function getMonitorCount(): int
    {
        return self::ffi()->GetMonitorCount();
    }

    /**
     * 获取窗口所在的当前显示器
     *
     * @return integer 显示器索引
     */
    public static function getCurrentMonitor(): int
    {
        return self::ffi()->GetCurrentMonitor();
    }

    /**
     * 获取指定显示器的位置
     *
     * @param integer $monitor 显示器索引
     * @return \FFI\CData 显示器位置
     */
    public static function getMonitorPosition(int $monitor): \FFI\CData
    {
        return self::ffi()->GetMonitorPosition($monitor);
    }

    /**
     * 获取指定显示器的宽度（显示器当前使用的视频模式）
     *
     * @param integer $monitor 显示器索引
     * @return integer 显示器宽度
     */
    public static function getMonitorWidth(int $monitor): int
    {
        return self::ffi()->GetMonitorWidth($monitor);
    }

    /**
     * 获取指定显示器的高度（显示器当前使用的视频模式）
     *
     * @param integer $monitor 显示器索引
     * @return integer 显示器高度
     */
    public static function getMonitorHeight(int $monitor): int
    {
        return self::ffi()->GetMonitorHeight($monitor);
    }

    /**
     * 获取指定显示器的物理宽度（显示器的实际物理宽度）
     *
     * @param integer $monitor 显示器索引
     * @return integer 显示器物理宽度
     */
    public static function getMonitorPhysicalWidth(int $monitor): int
    {
        return self::ffi()->GetMonitorPhysicalWidth($monitor);
    }

    /**
     * 获取指定显示器的物理高度（显示器的实际物理高度）
     *
     * @param integer $monitor 显示器索引
     * @return integer 显示器物理高度
     */
    public static function getMonitorPhysicalHeight(int $monitor): int
    {
        return self::ffi()->GetMonitorPhysicalHeight($monitor);
    }

    /**
     * 获取指定显示器的刷新率
     *
     * @param integer $monitor 显示器索引
     * @return integer 显示器刷新率
     */
    public static function getMonitorRefreshRate(int $monitor): int
    {
        return self::ffi()->GetMonitorRefreshRate($monitor);
    }

    /**
     * 获取窗口在显示器上的XY位置
     *
     * @return \FFI\CData 窗口位置
     */
    public static function getWindowPosition(): \FFI\CData
    {
        return self::ffi()->GetWindowPosition();
    }

    /**
     * 获取窗口的缩放DPI因子
     *
     * @return \FFI\CData 缩放DPI因子
     */
    public static function getWindowScaleDPI(): \FFI\CData
    {
        return self::ffi()->GetWindowScaleDPI();
    }

    /**
     * 获取指定显示器的可读UTF-8编码名称
     *
     * @param integer $monitor 显示器索引
     * @return string 显示器名称
     */
    public static function getMonitorName(int $monitor): string
    {
        return self::ffi()->GetMonitorName($monitor);
    }

    /**
     * 设置剪贴板的文本内容
     *
     * @param string $text 文本内容
     * @return void
     */
    public static function setClipboardText(string $text): void
    {
        self::ffi()->SetClipboardText($text);
    }

    /**
     * 获取剪贴板的文本内容
     *
     * @return string 文本内容
     */
    public static function getClipboardText(): string
    {
        return self::ffi()->GetClipboardText();
    }

    /**
     * 获取剪贴板的图像内容
     *
     * @return \FFI\CData 剪贴板图像内容
     */
    public static function getClipboardImage(): \FFI\CData
    {
        return self::ffi()->GetClipboardImage();
    }

    /**
     * 启用在EndDrawing()时等待事件，不自动轮询事件
     *
     * @return void
     */
    public static function enableEventWaiting(): void
    {
        self::ffi()->EnableEventWaiting();
    }

    /**
     * 禁用在EndDrawing()时等待事件，自动轮询事件
     *
     * @return void
     */
    public static function disableEventWaiting(): void
    {
        self::ffi()->DisableEventWaiting();
    }


    /**
     * 交换后缓冲区和前缓冲区（屏幕绘制）
     *
     * @return void
     */
    public static function swapScreenBuffer(): void
    {
        self::ffi()->SwapScreenBuffer();
    }

    /**
     * 注册所有输入事件
     *
     * @return void
     */
    public static function pollInputEvents(): void
    {
        self::ffi()->PollInputEvents();
    }

    /**
     * 等待一段时间（暂停程序执行）
     *
     * @param float $time 等待时间（以秒为单位）
     * @return void
     */
    public static function waitTime(float $time): void
    {
        self::ffi()->WaitTime($time);
    }

    /**
     * 显示光标
     *
     * @return void
     */
    public static function showCursor(): void
    {
        self::ffi()->ShowCursor();
    }

    /**
     * 隐藏光标
     *
     * @return void
     */
    public static function hideCursor(): void
    {
        self::ffi()->HideCursor();
    }

    /**
     * 检查光标是否不可见
     *
     * @return boolean
     */
    public static function isCursorHidden(): bool
    {
        return self::ffi()->IsCursorHidden();
    }

    /**
     * 启用光标（解锁光标）
     *
     * @return void
     */
    public static function enableCursor(): void
    {
        self::ffi()->EnableCursor();
    }

    /**
     * 禁用光标（锁定光标）
     *
     * @return void
     */
    public static function disableCursor(): void
    {
        self::ffi()->DisableCursor();
    }

    /**
     * 检查光标是否在屏幕上
     *
     * @return void
     */
    public static function isCursorOnScreen(): void
    {
        self::ffi()->IsCursorOnScreen();
    }

    /**
     * 设置背景颜色（帧缓冲区清除颜色）
     *
     * @param \FFI\CData $color 颜色
     * @return void
     */
    public static function clearBackground(\FFI\CData $color): void
    {
        self::ffi()->ClearBackground($color);
    }

    /**
     * 设置画布（帧缓冲区）以开始绘图
     *
     * @return void
     */
    public static function beginDrawing(): void
    {
        self::ffi()->BeginDrawing();
    }

    /**
     * 结束画布绘图并交换缓冲区（双缓冲）
     *
     * @return void
     */
    public static function endDrawing(): void
    {
        self::ffi()->EndDrawing();
    }

    /**
     * 开始使用自定义相机开始2D模式绘图
     *
     * @param \FFI\CData $camera 相机2d
     * @return void
     */
    public static function beginMode2D(\FFI\CData $camera): void
    {
        self::ffi()->BeginMode2D($camera);
    }

    /**
     * 结束2D模式绘图
     *
     * @return void
     */
    public static function endMode2D(): void
    {
        self::ffi()->EndMode2D();
    }

    /**
     * 开始使用自定义相机开始3D模式绘图
     *
     * @param \FFI\CData $camera 相机3d
     * @return void
     */
    public static function beginMode3D(\FFI\CData $camera): void
    {
        self::ffi()->BeginMode3D($camera);
    }

    /**
     * 结束3D模式绘图
     *
     * @return void
     */
    public static function endMode3D(): void
    {
        self::ffi()->EndMode3D();
    }

    /**
     * 开始向渲染纹理绘图
     *
     * @param \FFI\CData $texture 渲染纹理2d
     * @return void
     */
    public static function beginTextureMode(\FFI\CData $texture): void
    {
        self::ffi()->BeginTextureMode($texture);
    }

    /**
     * 结束向渲染纹理绘图
     *
     * @return void
     */
    public static function endTextureMode(): void
    {
        self::ffi()->EndTextureMode();
    }

    /**
     * 开始使用自定义着色器绘图
     *
     * @param \FFI\CData $shader 着色器
     * @return void
     */
    public static function beginShaderMode(\FFI\CData $shader): void
    {
        self::ffi()->BeginShaderMode($shader);
    }

    /**
     * 结束使用自定义着色器绘图
     *
     * @return void
     */
    public static function endShaderMode(): void
    {
        self::ffi()->EndShaderMode();
    }

    /**
     * 开始混合模式（alpha、加法、乘法、减法、自定义）
     *
     * @param integer $mode 混合模式
     * @return void
     */
    public static function beginBlendMode(int $mode): void
    {
        self::ffi()->BeginBlendMode($mode);
    }

    /**
     * 结束混合模式
     *
     * @return void
     */
    public static function endBlendMode(): void
    {
        self::ffi()->EndBlendMode();
    }

    /**
     * 开始裁剪模式（定义后续绘图的屏幕区域）
     *
     * @param integer $x 裁剪区域的左上角x坐标
     * @param integer $y 裁剪区域的左上角y坐标
     * @param integer $width 裁剪区域的宽度
     * @param integer $height 裁剪区域的高度
     * @return void
     */
    public static function beginScissorMode(int $x, int $y, int $width, int $height): void
    {
        self::ffi()->BeginScissorMode($x, $y, $width, $height);
    }

    /**
     * 结束裁剪模式
     *
     * @return void
     */
    public static function endScissorMode(): void
    {
        self::ffi()->EndScissorMode();
    }

    /**
     * 开始立体渲染（需要VR模拟器）
     *
     * @param \FFI\CData $config 立体渲染配置
     * @return void
     */
    public static function beginVrStereoMode(\FFI\CData $config): void
    {
        self::ffi()->BeginVrStereoMode($config);
    }

    /**
     * 结束立体渲染（需要VR模拟器）
     *
     * @return void
     */
    public static function endVrStereoMode(): void
    {
        self::ffi()->EndVrStereoMode();
    }

    /**
     * 为VR模拟器设备参数加载VR立体配置
     *
     * @param \FFI\CData $device 设备信息
     * @return \FFI\CData 立体渲染配置
     */
    public static function loadVrStereoConfig(\FFI\CData $device): \FFI\CData
    {
        return self::ffi()->LoadVrStereoConfig($device);
    }

    /**
     * 卸载VR立体配置
     *
     * @param \FFI\CData $config 立体渲染配置
     * @return void
     */
    public static function unloadVrStereoConfig(\FFI\CData $config): void
    {
        self::ffi()->UnloadVrStereoConfig($config);
    }

    /**
     * 从文件加载着色器并绑定默认位置
     *
     * @param string $vsFileName 顶点着色器文件路径
     * @param string $fsFileName 片段着色器文件路径
     * @return \FFI\CData
     */
    public static function loadShader(string $vsFileName, string $fsFileName): \FFI\CData
    {
        return self::ffi()->LoadShader($vsFileName, $fsFileName);
    }

    /**
     * 从代码字符串加载着色器并绑定默认位置
     *
     * @param string $vsCode 顶点着色器代码
     * @param string $fsCode 片段着色器代码
     * @return \FFI\CData
     */
    public static function loadShaderFromMemory(string $vsCode, string $fsCode): \FFI\CData
    {
        return self::ffi()->LoadShaderFromMemory($vsCode, $fsCode);
    }

    /**
     * 检查着色器是否有效（已加载到 GPU）
     *
     * @param \FFI\CData $shader 着色器
     * @return boolean
     */
    public static function isShaderValid(\FFI\CData $shader): bool
    {
        return self::ffi()->IsShaderValid($shader);
    }

    /**
     * 获取着色器统一变量的位置
     *
     * @param \FFI\CData $shader 着色器
     * @param string $name 变量名称
     * @return integer
     */
    public static function getShaderLocation(\FFI\CData $shader, string $name): int
    {
        return self::ffi()->GetShaderLocation($shader, $name);
    }

    /**
     * 获取着色器属性的位置
     *
     * @param \FFI\CData $shader 着色器
     * @param string $name 属性名称
     * @return integer
     */
    public static function getShaderLocationAttrib(\FFI\CData $shader, string $name): int
    {
        return self::ffi()->GetShaderLocationAttrib($shader, $name);
    }

    /**
     * 设置着色器统一变量的值
     *
     * @param \FFI\CData $shader 着色器
     * @param integer $location 变量位置
     * @param string $value 变量值
     * @param integer $uniformType 统一类型
     * @return void
     */
    public static function setShaderValue(\FFI\CData $shader, int $location, string $value, int $uniformType): void
    {
        self::ffi()->SetShaderValue($shader, $location, $value, $uniformType);
    }

    /**
     * 设置着色器统一变量的值向量
     *
     * @param \FFI\CData $shader 着色器
     * @param integer $location 变量位置
     * @param string $value 变量值
     * @param integer $uniformType 统一类型
     * @param integer $count 变量数量
     * @return void
     */
    public static function setShaderValueV(\FFI\CData $shader, int $location, string $value, int $uniformType, int $count): void
    {
        self::ffi()->SetShaderValueV($shader, $location, $value, $uniformType, $count);
    }

    /**
     * 设置着色器统一变量的值（4x4 矩阵）
     *
     * @param \FFI\CData $shader 着色器
     * @param integer $location 变量位置
     * @param \FFI\CData $mat 矩阵值
     * @return void
     */
    public static function setShaderValueMatrix(\FFI\CData $shader, int $location, \FFI\CData $mat): void
    {
        self::ffi()->SetShaderValueMatrix($shader, $location, $mat);
    }

    /**
     * 设置着色器统一变量的纹理值（采样器 2D）
     *
     * @param \FFI\CData $shader 着色器
     * @param integer $location 变量位置
     * @param \FFI\CData $texture 纹理值2d
     * @return void
     */
    public static function setShaderValueTexture(\FFI\CData $shader, int $location, \FFI\CData $texture): void
    {
        self::ffi()->SetShaderValueTexture($shader, $location, $texture);
    }

    /**
     * 从 GPU 内存（VRAM）中卸载着色器
     *
     * @param \FFI\CData $shader 着色器
     * @return void
     */
    public static function unloadShader(\FFI\CData $shader): void
    {
        self::ffi()->UnloadShader($shader);
    }

    /**
     * 从屏幕位置（如鼠标位置）获取一条射线（即射线追踪）
     *
     * @param \FFI\CData $postion 屏幕位置
     * @param \FFI\CData $camera 相机2d
     * @return \FFI\CData 射线
     */
    public static function getScreenToWorldRay(\FFI\CData $postion, \FFI\CData $camera): \FFI\CData
    {
        return self::ffi()->GetScreenToWorldRay($postion, $camera);
    }

    /**
     * 在视口内从屏幕位置（如鼠标位置）获取一条射线（即射线追踪）
     *
     * @param \FFI\CData $postion 屏幕位置
     * @param \FFI\CData $camera 相机
     * @param integer $width 视口宽度
     * @param integer $height 视口高度
     * @return \FFI\CData 射线
     */
    public static function getScreenToWorldRayEx(\FFI\CData $postion, \FFI\CData $camera, int $width, int $height): \FFI\CData
    {
        return self::ffi()->GetScreenToWorldRayEx($postion, $camera, $width, $height);
    }

    /**
     * 获取 3D 世界空间位置在屏幕空间中的位置
     *
     * @param \FFI\CData $postion 世界空间位置
     * @param \FFI\CData $camera 相机
     * @return \FFI\CData 屏幕空间位置
     */
    public static function getWorldToScreen(\FFI\CData $postion, \FFI\CData $camera): \FFI\CData
    {
        return self::ffi()->GetWorldToScreen($postion, $camera);
    }

    /**
     * 获取 3D 世界空间位置在指定视口尺寸下的屏幕空间位置
     *
     * @param \FFI\CData $postion 世界空间位置
     * @param \FFI\CData $camera 相机
     * @param integer $width 视口宽度
     * @param integer $height 视口高度
     * @return \FFI\CData 屏幕空间位置
     */
    public static function getWorldToScreenEx(\FFI\CData $postion, \FFI\CData $camera, int $width, int $height): \FFI\CData
    {
        return self::ffi()->GetWorldToScreenEx($postion, $camera, $width, $height);
    }

    /**
     * 获取 2D 相机世界空间位置在屏幕空间中的位置
     *
     * @param \FFI\CData $postion 世界空间位置
     * @param \FFI\CData $camera 相机2d
     * @return \FFI\CData 屏幕空间位置
     */
    public static function getWorldToScreen2D(\FFI\CData $postion, \FFI\CData $camera): \FFI\CData
    {
        return self::ffi()->GetWorldToScreen2D($postion, $camera);
    }

    /**
     * 获取 2D 相机屏幕空间位置在世界空间中的位置
     *
     * @param \FFI\CData $postion 屏幕空间位置
     * @param \FFI\CData $camera 相机2d
     * @return \FFI\CData 世界空间位置
     */
    public static function getScreenToWorld2D(\FFI\CData $postion, \FFI\CData $camera): \FFI\CData
    {
        return self::ffi()->GetScreenToWorld2D($postion, $camera);
    }

    /**
     * 获取相机的变换矩阵（视图矩阵）
     *
     * @param \FFI\CData $camera 相机
     * @return \FFI\CData 变换矩阵
     */
    public static function getCameraMatrix(\FFI\CData $camera): \FFI\CData
    {
        return self::ffi()->GetCameraMatrix($camera);
    }

    /**
     * 获取 2D 相机的变换矩阵
     *
     * @param \FFI\CData $camera 相机2d
     * @return \FFI\CData 变换矩阵
     */
    public static function getCameraMatrix2D(\FFI\CData $camera): \FFI\CData
    {
        return self::ffi()->GetCameraMatrix2D($camera);
    }

    /**
     * 设置目标帧率（最大值）
     *
     * @param integer $fps
     * @return void
     */
    public static function setTargetFPS(int $fps): void
    {
        self::ffi()->SetTargetFPS($fps);
    }

    /**
     * 获取上一帧绘制所用的时间（以秒为单位，即增量时间）
     *
     * @return float
     */
    public static function getFrameTime(): float
    {
        return self::ffi()->GetFrameTime();
    }

    /**
     * 获取自initWindow()调用以来经过的时间（以秒为单位）
     *
     * @return float
     */
    public static function getTime(): float
    {
        return self::ffi()->GetTime();
    }

    /**
     * 获取当前帧率
     *
     * @return integer
     */
    public static function getFPS(): int
    {
        return self::ffi()->GetFPS();
    }



    /**
     * 设置随机数生成器的种子
     *
     * @param integer $seed 种子值
     * @return void
     */
    public static function setRandomSeed(int $seed): void
    {
        self::ffi()->SetRandomSeed($seed);
    }

    /**
     * 加载随机值序列，无重复值
     *
     * @param integer $min 最小值
     * @param integer $max 最大值
     * @return \FFI\CData 随机值序列
     */
    public static function getRandomValue(int $min, int $max): \FFI\CData
    {
        return self::ffi()->GetRandomValue($min, $max);
    }

    /**
     * 卸载随机值序列
     *
     * @param \FFI\CData $sequence
     * @return void
     */
    public static function unloadRandomSequence(\FFI\CData $sequence): void
    {
        self::ffi()->UnloadRandomSequence($sequence);
    }

    /**
     * 对当前屏幕进行截图（文件名扩展名定义格式）
     *
     * @param string $fileName 截图文件名
     * @return void
     */
    public static function takeScreenshot(string $fileName): void
    {
        self::ffi()->TakeScreenshot($fileName);
    }

    /**
     * 设置初始化配置标志（查看 FLAGS）
     *
     * @param integer $flags 配置标志
     * @return void
     */
    public static function setConfigFlags(int $flags): void
    {
        self::ffi()->SetConfigFlags($flags);
    }

    /**
     * 使用默认系统浏览器打开 URL（如果可用）
     *
     * @param string $url
     * @return void
     */
    public static function openURL(string $url): void
    {
        self::ffi()->OpenURL($url);
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

    /**
     * 检查文件是否存在
     *
     * @param string $fileName 文件名
     * @return boolean true/false
     */
    public static function fileExists(string $fileName): bool
    {
        return self::ffi()->FileExists($fileName);
    }

    /**
     * 检查目录是否存在
     *
     * @param string $directory 目录名
     * @return boolean true/false
     */
    public static function directoryExists(string $directory): bool
    {
        return self::ffi()->DirectoryExists($directory);
    }

    /**
     * 检查文件扩展名（包括点号：.png, .wav）
     *
     * @param string $fileName 文件名
     * @param string $extension 文件扩展名
     * @return boolean true/false
     */
    public static function isFileExtension(string $fileName, string $extension): bool
    {
        return self::ffi()->IsFileExtension($fileName, $extension);
    }

    /**
     * 获取文件的字节长度（注意: GetFileSize()与windows.h冲突）
     *
     * @param string $fileName 文件名
     * @return integer 文件大小
     */
    public static function getFileLength(string $fileName): int
    {
        return self::ffi()->GetFileLength($fileName);
    }

    /**
     * 获取文件名中扩展名的指针（包括点号: '.png'）
     *
     * @param string $fileName 文件名
     * @return string 文件扩展名
     */
    public static function getFileExtension(string $fileName): string
    {
        return self::ffi()->GetFileExtension($fileName);
    }

    /**
     * 获取路径字符串中的文件名指针
     *
     * @param string $fileName 文件名
     * @return string 文件名
     */
    public static function getFileName(string $fileName): string
    {
        return self::ffi()->GetFileName($fileName);
    }

    /**
     * 获取不带扩展名的文件名（使用静态字符串）
     *
     * @param string $filePath 文件名
     * @return string 文件名
     */
    public static function getFileNameWithoutExt(string $filePath): string
    {
        return self::ffi()->GetFileNameWithoutExt($filePath);
    }

    /**
     * 获取包含路径的文件名的完整路径（使用静态字符串）
     *
     * @param string $filePath 文件名
     * @return string 文件名
     */
    public static function getDirectoryPath(string $filePath): string
    {
        return self::ffi()->GetDirectoryPath($filePath);
    }

    /**
     * 获取给定路径的上一级目录路径（使用静态字符串）
     *
     * @param string $filePath 文件名
     * @return string 文件名
     */
    public static function getPrevDirectoryPath(string $filePath): string
    {
        return self::ffi()->GetPrevDirectoryPath($filePath);
    }

    /**
     * 获取当前工作目录（使用静态字符串）
     *
     * @return string
     */
    public static function getWorkingDirectory(): string
    {
        return self::ffi()->GetWorkingDirectory();
    }

    /**
     * 获取运行中应用程序的目录（使用静态字符串）
     *
     * @return string
     */
    public static function getApplicationDirectory(): string
    {
        return self::ffi()->GetApplicationDirectory();
    }
    /**
     * 创建目录（包括请求的完整路径），成功返回0
     *
     * @param string $dirPath 目录路径
     * @return int
     */
    public static function makeDirectory(string $dirPath): int
    {
        return self::ffi()->MakeDirectory($dirPath);
    }

    /**
     * 更改工作目录，成功返回true
     *
     * @param string $dir 目录
     * @return bool
     */
    public static function changeDirectory(string $dir): bool
    {
        return self::ffi()->ChangeDirectory($dir);
    }

    /**
     * 检查给定路径是文件还是目录
     *
     * @param string $path 路径
     * @return bool
     */
    public static function isPathFile(string $path): bool
    {
        return self::ffi()->IsPathFile($path);
    }

    /**
     * 检查文件名是否对平台/操作系统有效
     *
     * @param string $fileName 文件名
     * @return bool
     */
    public static function isFileNameValid(string $fileName): bool
    {
        return self::ffi()->IsFileNameValid($fileName);
    }

    /**
     * 加载目录中的文件路径
     *
     * @param string $dirPath 目录路径
     * @return \FFI\CData
     */
    public static function loadDirectoryFiles(string $dirPath): \FFI\CData
    {
        return self::ffi()->LoadDirectoryFiles($dirPath);
    }

    /**
     * 加载目录中的文件路径，并进行扩展名过滤和递归目录扫描。在过滤字符串中使用 'DIR' 可将目录包含在结果中
     *
     * @param string $basePath 目录路径
     * @param string $filter 过滤字符串
     * @param bool $scanSubdirs 是否扫描子目录
     * @return \FFI\CData
     */
    public static function loadDirectoryFilesEx(string $basePath, string $filter, bool $scanSubdirs): \FFI\CData
    {
        return self::ffi()->LoadDirectoryFilesEx($basePath, $filter, $scanSubdirs);
    }

    /**
     * 卸载文件路径
     *
     * @param \FFI\CData $files 文件路径列表
     * @return void
     */
    public static function unloadDirectoryFiles(\FFI\CData $files): void
    {
        self::ffi()->UnloadDirectoryFiles($files);
    }

    /**
     * 检查是否有文件被拖放到窗口中
     *
     * @return bool
     */
    public static function isFileDropped(): bool
    {
        return self::ffi()->IsFileDropped();
    }

    /**
     * 加载被拖放的文件路径
     *
     * @return \FFI\CData
     */
    public static function loadDroppedFiles(): \FFI\CData
    {
        return self::ffi()->LoadDroppedFiles();
    }

    /**
     * 卸载被拖放的文件路径
     *
     * @param \FFI\CData $files 文件路径列表
     * @return void
     */
    public static function unloadDroppedFiles(\FFI\CData $files): void
    {
        self::ffi()->UnloadDroppedFiles($files);
    }

    /**
     * 获取文件的修改时间（最后写入时间）
     *
     * @param string $fileName 文件名
     * @return int
     */
    public static function getFileModTime(string $fileName): int
    {
        return self::ffi()->GetFileModTime($fileName);
    }

    /**
     * 压缩数据（DEFLATE算法），内存必须使用MemFree()释放
     *
     * @param string $data 数据
     * @param int $dataSize 数据大小
     * @param int &$compDataSize 压缩数据大小
     * @return \FFI\CData
     */
    public static function compressData(string $data, int $dataSize, int &$compDataSize): \FFI\CData
    {
        return self::ffi()->CompressData($data, $dataSize, \FFI::addr(\FFI::new('int')));
    }

    /**
     * 解压缩数据（DEFLATE算法），内存必须使用MemFree()释放
     *
     * @param string $compData 压缩数据
     * @param int $compDataSize 压缩数据大小
     * @param int &$dataSize 数据大小
     * @return \FFI\CData
     */
    public static function decompressData(string $compData, int $compDataSize, int &$dataSize): \FFI\CData
    {
        return self::ffi()->DecompressData($compData, $compDataSize, \FFI::addr(\FFI::new('int')));
    }

    /**
     * 将数据编码为Base64字符串，内存必须使用MemFree()释放
     *
     * @param string $data 数据
     * @param int $dataSize 数据大小
     * @param int &$outputSize 输出大小
     * @return \FFI\CData
     */
    public static function encodeDataBase64(string $data, int $dataSize, int &$outputSize): \FFI\CData
    {
        return self::ffi()->EncodeDataBase64($data, $dataSize, \FFI::addr(\FFI::new('int')));
    }

    /**
     * 解码Base64字符串数据，内存必须使用MemFree()释放
     *
     * @param string $data 数据
     * @param int &$outputSize 输出大小
     * @return \FFI\CData
     */
    public static function decodeDataBase64(string $data, int &$outputSize): \FFI\CData
    {
        return self::ffi()->DecodeDataBase64($data, \FFI::addr(\FFI::new('int')));
    }

    /**
     * 检查某个键是否被按下一次
     *
     * @param int $key 键
     * @return bool
     */
    public static function isKeyPressed(int $key): bool
    {
        return self::ffi()->IsKeyPressed($key);
    }

    /**
     * 检查某个键是否再次被按下
     *
     * @param int $key 键
     * @return bool
     */
    public static function isKeyPressedRepeat(int $key): bool
    {
        return self::ffi()->IsKeyPressedRepeat($key);
    }

    /**
     * 检查某个键是否正在被按下
     *
     * @param int $key 键
     * @return bool
     */
    public static function isKeyDown(int $key): bool
    {
        return self::ffi()->IsKeyDown($key);
    }

    /**
     * 检查某个键是否被释放一次
     *
     * @param int $key 键
     * @return bool
     */
    public static function isKeyReleased(int $key): bool
    {
        return self::ffi()->IsKeyReleased($key);
    }

    /**
     * 检查某个键是否未被按下
     *
     * @param int $key 键
     * @return bool
     */
    public static function isKeyUp(int $key): bool
    {
        return self::ffi()->IsKeyUp($key);
    }

    /**
     * 获取按下的键（键码），多次调用以处理排队的键，队列空时返回 0
     *
     * @return int
     */
    public static function getKeyPressed(): int
    {
        return self::ffi()->GetKeyPressed();
    }

    /**
     * 获取按下的字符（Unicode），多次调用以处理排队的字符，队列空时返回 0
     *
     * @return int
     */
    public static function getCharPressed(): int
    {
        return self::ffi()->GetCharPressed();
    }

    /**
     * 设置一个自定义键来退出程序（默认是 ESC）
     *
     * @param int $key 键
     * @return void
     */
    public static function setExitKey(int $key): void
    {
        self::ffi()->SetExitKey($key);
    }

    /**
     * 检查某个游戏手柄是否可用
     *
     * @param int $gamepad 游戏手柄
     * @return bool
     */
    public static function isGamepadAvailable(int $gamepad): bool
    {
        return self::ffi()->IsGamepadAvailable($gamepad);
    }

    /**
     * 获取游戏手柄的内部名称 ID
     *
     * @param int $gamepad 游戏手柄
     * @return string
     */
    public static function getGamepadName(int $gamepad): string
    {
        return self::ffi()->GetGamepadName($gamepad);
    }

    /**
     * 检查游戏手柄的某个按钮是否被按下一次
     *
     * @param int $gamepad 游戏手柄
     * @param int $button 按钮
     * @return bool
     */
    public static function isGamepadButtonPressed(int $gamepad, int $button): bool
    {
        return self::ffi()->IsGamepadButtonPressed($gamepad, $button);
    }

    /**
     * 检查游戏手柄的某个按钮是否正在被按下
     *
     * @param int $gamepad 游戏手柄
     * @param int $button 按钮
     * @return bool
     */
    public static function isGamepadButtonDown(int $gamepad, int $button): bool
    {
        return self::ffi()->IsGamepadButtonDown($gamepad, $button);
    }

    /**
     * 检查游戏手柄的某个按钮是否被释放一次
     *
     * @param int $gamepad 游戏手柄
     * @param int $button 按钮
     * @return bool
     */
    public static function isGamepadButtonReleased(int $gamepad, int $button): bool
    {
        return self::ffi()->IsGamepadButtonReleased($gamepad, $button);
    }

    /**
     * 检查游戏手柄的某个按钮是否未被按下
     *
     * @param int $gamepad 游戏手柄
     * @param int $button 按钮
     * @return bool
     */
    public static function isGamepadButtonUp(int $gamepad, int $button): bool
    {
        return self::ffi()->IsGamepadButtonUp($gamepad, $button);
    }

    /**
     * 获取最后按下的游戏手柄按钮
     *
     * @return int
     */
    public static function getGamepadButtonPressed(): int
    {
        return self::ffi()->GetGamepadButtonPressed();
    }

    /**
     * 获取某个游戏手柄的轴数量
     *
     * @param int $gamepad 游戏手柄
     * @return int
     */
    public static function getGamepadAxisCount(int $gamepad): int
    {
        return self::ffi()->GetGamepadAxisCount($gamepad);
    }

    /**
     * 获取某个游戏手柄的某个轴的移动值
     *
     * @param int $gamepad 游戏手柄
     * @param int $axis 轴
     * @return float
     */
    public static function getGamepadAxisMovement(int $gamepad, int $axis): float
    {
        return self::ffi()->GetGamepadAxisMovement($gamepad, $axis);
    }

    /**
     * 设置内部游戏手柄映射（SDL_GameControllerDB）
     *
     * @param string $mappings 映射
     * @return int
     */
    public static function setGamepadMappings(string $mappings): int
    {
        return self::ffi()->SetGamepadMappings($mappings);
    }

    /**
     * 设置游戏手柄两个马达的震动（持续时间以秒为单位）
     *
     * @param int $gamepad 游戏手柄
     * @param float $leftMotor 左马达
     * @param float $rightMotor 右马达
     * @param float $duration 持续时间
     * @return void
     */
    public static function setGamepadVibration(int $gamepad, float $leftMotor, float $rightMotor, float $duration): void
    {
        self::ffi()->SetGamepadVibration($gamepad, $leftMotor, $rightMotor, $duration);
    }

    /**
     * 检查某个鼠标按钮是否被按下一次
     *
     * @param int $button 按钮
     * @return bool
     */
    public static function isMouseButtonPressed(int $button): bool
    {
        return self::ffi()->IsMouseButtonPressed($button);
    }

    /**
     * 检查某个鼠标按钮是否正在被按下
     *
     * @param int $button 按钮
     * @return bool
     */
    public static function isMouseButtonDown(int $button): bool
    {
        return self::ffi()->IsMouseButtonDown($button);
    }

    /**
     * 检查某个鼠标按钮是否被释放一次
     *
     * @param int $button 按钮
     * @return bool
     */
    public static function isMouseButtonReleased(int $button): bool
    {
        return self::ffi()->IsMouseButtonReleased($button);
    }

    /**
     * 检查某个鼠标按钮是否未被按下
     *
     * @param int $button 按钮
     * @return bool
     */
    public static function isMouseButtonUp(int $button): bool
    {
        return self::ffi()->IsMouseButtonUp($button);
    }

    /**
     * 获取鼠标的 X 坐标
     *
     * @return int
     */
    public static function getMouseX(): int
    {
        return self::ffi()->GetMouseX();
    }

    /**
     * 获取鼠标的 Y 坐标
     *
     * @return int
     */
    public static function getMouseY(): int
    {
        return self::ffi()->GetMouseY();
    }

    /**
     * 获取鼠标的 XY 坐标
     *
     * @return \FFI\CData 返回一个 Vector2 结构体的 CData 对象
     */
    public static function getMousePosition(): \FFI\CData
    {
        return self::ffi()->GetMousePosition();
    }

    /**
     * 获取两帧之间鼠标的移动增量
     *
     * @return \FFI\CData 返回一个 Vector2 结构体的 CData 对象
     */
    public static function getMouseDelta(): \FFI\CData
    {
        return self::ffi()->GetMouseDelta();
    }

    /**
     * 设置鼠标的 XY 坐标
     *
     * @param int $x x坐标
     * @param int $y y坐标
     * @return void
     */
    public static function setMousePosition(int $x, int $y): void
    {
        self::ffi()->SetMousePosition($x, $y);
    }

    /**
     * 设置鼠标的偏移量
     *
     * @param int $offsetX x方向偏移量
     * @param int $offsetY y方向偏移量
     * @return void
     */
    public static function setMouseOffset(int $offsetX, int $offsetY): void
    {
        self::ffi()->SetMouseOffset($offsetX, $offsetY);
    }

    /**
     * 设置鼠标的缩放比例
     *
     * @param float $scaleX x方向缩放比例
     * @param float $scaleY y方向缩放比例
     * @return void
     */
    public static function setMouseScale(float $scaleX, float $scaleY): void
    {
        self::ffi()->SetMouseScale($scaleX, $scaleY);
    }

    /**
     * 获取鼠标滚轮在 X 或 Y 方向上的最大移动量
     *
     * @return float
     */
    public static function getMouseWheelMove(): float
    {
        return self::ffi()->GetMouseWheelMove();
    }

    /**
     * 获取鼠标滚轮在 X 和 Y 方向上的移动量
     *
     * @return \FFI\CData 返回一个 Vector2 结构体的 CData 对象
     */
    public static function getMouseWheelMoveV(): \FFI\CData
    {
        return self::ffi()->GetMouseWheelMoveV();
    }

    /**
     * 设置鼠标光标样式
     *
     * @param int $cursor 光标样式
     * @return void
     */
    public static function setMouseCursor(int $cursor): void
    {
        self::ffi()->SetMouseCursor($cursor);
    }

    /**
     * 获取触摸点 0 的 X 坐标（相对于屏幕尺寸）
     *
     * @return int
     */
    public static function getTouchX(): int
    {
        return self::ffi()->GetTouchX();
    }

    /**
     * 获取触摸点 0 的 Y 坐标（相对于屏幕尺寸）
     *
     * @return int
     */
    public static function getTouchY(): int
    {
        return self::ffi()->GetTouchY();
    }

    /**
     * 获取指定触摸点索引的 XY 坐标（相对于屏幕尺寸）
     *
     * @param int $index 触摸点索引
     * @return \FFI\CData 返回一个 Vector2 结构体的 CData 对象
     */
    public static function getTouchPosition(int $index): \FFI\CData
    {
        return self::ffi()->GetTouchPosition($index);
    }

    /**
     * 获取指定索引的触摸点标识符
     *
     * @param int $index 触摸点索引
     * @return int
     */
    public static function getTouchPointId(int $index): int
    {
        return self::ffi()->GetTouchPointId($index);
    }

    /**
     * 获取触摸点的数量
     *
     * @return int
     */
    public static function getTouchPointCount(): int
    {
        return self::ffi()->GetTouchPointCount();
    }
    /**
     * 使用标志启用一组手势
     *
     * @param int $flags 标志
     * @return void
     */
    public static function setGesturesEnabled(int $flags): void
    {
        self::ffi()->SetGesturesEnabled($flags);
    }

    /**
     * 检查是否检测到某个手势
     *
     * @param int $gesture 手势
     * @return bool
     */
    public static function isGestureDetected(int $gesture): bool
    {
        return self::ffi()->IsGestureDetected($gesture);
    }

    /**
     * 获取最新检测到的手势
     *
     * @return int
     */
    public static function getGestureDetected(): int
    {
        return self::ffi()->GetGestureDetected();
    }

    /**
     * 获取手势按住的持续时间（以秒为单位）
     *
     * @return float
     */
    public static function getGestureHoldDuration(): float
    {
        return self::ffi()->GetGestureHoldDuration();
    }

    /**
     * 获取手势拖动向量
     *
     * @return \FFI\CData 返回一个 Vector2 结构体的 CData 对象
     */
    public static function getGestureDragVector(): \FFI\CData
    {
        return self::ffi()->GetGestureDragVector();
    }

    /**
     * 获取手势拖动角度
     *
     * @return float
     */
    public static function getGestureDragAngle(): float
    {
        return self::ffi()->GetGestureDragAngle();
    }

    /**
     * 获取手势捏合的增量
     *
     * @return \FFI\CData 返回一个 Vector2 结构体的 CData 对象
     */
    public static function getGesturePinchVector(): \FFI\CData
    {
        return self::ffi()->GetGesturePinchVector();
    }

    /**
     * 获取手势捏合角度
     *
     * @return float
     */
    public static function getGesturePinchAngle(): float
    {
        return self::ffi()->GetGesturePinchAngle();
    }
}
