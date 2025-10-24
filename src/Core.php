<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib;

use \FFI\CData;
use Kingbes\Raylib\Utils\Image;
use Kingbes\Raylib\Utils\Vector2;
use Kingbes\Raylib\Utils\Color;
use Kingbes\Raylib\Utils\Camera2D;
use Kingbes\Raylib\Utils\Camera3D;
use Kingbes\Raylib\Utils\Texture;
use Kingbes\Raylib\Utils\RenderTexture;
use Kingbes\Raylib\Utils\Shader;
use Kingbes\Raylib\Utils\VrStereoConfig;
// use Kingbes\Raylib\Utils\VrDeviceInfo;
use Kingbes\Raylib\Utils\Ray;
use Kingbes\Raylib\Utils\Matrix;
use Kingbes\Raylib\Utils\Vector3;
use Kingbes\Raylib\Utils\FilePathList;
use Kingbes\Raylib\Utils\AutomationEventList;
use Kingbes\Raylib\Utils\AutomationEvent;

/**
 * Core类
 */
class Core extends Base
{
    // 窗口相关函数

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
     * 检查应用是否应关闭（按下ESC键或点击窗口关闭图标）
     *
     * @return bool
     */
    public static function windowShouldClose(): bool
    {
        return self::ffi()->WindowShouldClose();
    }

    /**
     * 检查窗口是否已成功初始化
     *
     * @return bool
     */
    public static function isWindowReady(): bool
    {
        return self::ffi()->IsWindowReady();
    }

    /**
     * 检查窗口当前是否处于全屏模式
     *
     * @return bool
     */
    public static function isWindowFullscreen(): bool
    {
        return self::ffi()->IsWindowFullscreen();
    }

    /**
     * 检查窗口当前是否隐藏
     *
     * @return bool
     */
    public static function isWindowHidden(): bool
    {
        return self::ffi()->IsWindowHidden();
    }

    /**
     * 检查窗口当前是否最小化
     *
     * @return bool
     */
    public static function isWindowMinimized(): bool
    {
        return self::ffi()->IsWindowMinimized();
    }

    /**
     * 检查窗口当前是否最大化
     *
     * @return bool
     */
    public static function isWindowMaximized(): bool
    {
        return self::ffi()->IsWindowMaximized();
    }

    /**
     * 检查窗口当前是否获得焦点
     *
     * @return bool
     */
    public static function isWindowFocused(): bool
    {
        return self::ffi()->IsWindowFocused();
    }

    /**
     * 检查窗口是否在上一帧被调整大小
     *
     * @return bool
     */
    public static function isWindowResized(): bool
    {
        return self::ffi()->IsWindowResized();
    }

    /**
     * 检查是否启用了特定窗口标志
     *
     * @param integer $flag 窗口状态标志
     * @return bool
     */
    public static function isWindowState(int $flag): bool
    {
        return self::ffi()->IsWindowState($flag);
    }

    /**
     * 使用标志设置窗口配置状态
     *
     * @param integer $flags 状态标志
     * @return void
     */
    public static function setWindowState(int $flags): void
    {
        self::ffi()->SetWindowState($flags);
    }

    /**
     * 清除窗口配置状态标志
     *
     * @param integer $flags 状态标志
     * @return void
     */
    public static function clearWindowState(int $flags): void
    {
        self::ffi()->ClearWindowState($flags);
    }

    /**
     * 切换全屏/窗口化模式（根据窗口分辨率调整显示器）
     *
     * @return void
     */
    public static function toggleFullscreen(): void
    {
        self::ffi()->ToggleFullscreen();
    }

    /**
     * 切换无边框窗口模式（根据显示器分辨率调整窗口）
     *
     * @return void
     */
    public static function toggleBorderlessWindowed(): void
    {
        self::ffi()->ToggleBorderlessWindowed();
    }

    /**
     * 最大化窗口（如果可调整大小）
     *
     * @return void
     */
    public static function maximizeWindow(): void
    {
        self::ffi()->MaximizeWindow();
    }

    /**
     * 最小化窗口（如果可调整大小）
     *
     * @return void
     */
    public static function minimizeWindow(): void
    {
        self::ffi()->MinimizeWindow();
    }

    /**
     * 恢复窗口（取消最小化/最大化状态）
     *
     * @return void
     */
    public static function restoreWindow(): void
    {
        self::ffi()->RestoreWindow();
    }

    /**
     * 设置窗口图标（单张RGBA 32位图像）
     *
     * @param Image $image 图像数据
     * @return void
     */
    public static function setWindowIcon(Image $image): void
    {
        self::ffi()->SetWindowIcon($image->struct());
    }

    /**
     * 设置窗口图标（多张RGBA 32位图像）
     *
     * @param Image[] $images 图像数组
     * @return void
     */
    public static function setWindowIcons(array $images): void
    {
        $c_images = self::ffi()->new('struct Image[' . count($images) . ']');
        for ($i = 0; $i < count($images); $i++) {
            $c_images[$i] = $images[$i]->struct();
        }
        self::ffi()->SetWindowIcons(
            self::ffi()->cast('struct Image *', $c_images),
            count($images)
        );
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
     * 设置窗口在屏幕上的位置
     *
     * @param integer $x X坐标
     * @param integer $y Y坐标
     * @return void
     */
    public static function setWindowPosition(int $x, int $y): void
    {
        self::ffi()->SetWindowPosition($x, $y);
    }

    /**
     * 设置当前窗口的显示器
     *
     * @param integer $monitor 显示器编号
     * @return void
     */
    public static function setWindowMonitor(int $monitor): void
    {
        self::ffi()->SetWindowMonitor($monitor);
    }

    /**
     * 设置窗口最小尺寸（用于FLAG_WINDOW_RESIZABLE）
     *
     * @param integer $width 最小宽度
     * @param integer $height 最小高度
     * @return void
     */
    public static function setWindowMinSize(int $width, int $height): void
    {
        self::ffi()->SetWindowMinSize($width, $height);
    }

    /**
     * 设置窗口最大尺寸（用于FLAG_WINDOW_RESIZABLE）
     *
     * @param integer $width 最大宽度
     * @param integer $height 最大高度
     * @return void
     */
    public static function setWindowMaxSize(int $width, int $height): void
    {
        self::ffi()->SetWindowMaxSize($width, $height);
    }

    /**
     * 设置窗口尺寸
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
     * 设置窗口不透明度 [0.0f..1.0f]
     *
     * @param float $opacity 不透明度
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
     * @return CData 原生窗口句柄
     */
    public static function getWindowHandle(): CData
    {
        return self::ffi()->GetWindowHandle();
    }

    /**
     * 获取当前屏幕宽度
     *
     * @return integer 屏幕宽度
     */
    public static function getScreenWidth(): int
    {
        return self::ffi()->GetScreenWidth();
    }

    /**
     * 获取当前屏幕高度
     *
     * @return integer 屏幕高度
     */
    public static function getScreenHeight(): int
    {
        return self::ffi()->GetScreenHeight();
    }

    /**
     * 获取当前渲染宽度（考虑HiDPI）
     *
     * @return integer 渲染宽度
     */
    public static function getRenderWidth(): int
    {
        return self::ffi()->GetRenderWidth();
    }

    /**
     * 获取当前渲染高度（考虑HiDPI）
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
     * @return integer 当前显示器编号
     */
    public static function getCurrentMonitor(): int
    {
        return self::ffi()->GetCurrentMonitor();
    }

    /**
     * 获取指定显示器的位置
     *
     * @param integer $monitor 显示器编号
     * @return Vector2 显示器位置
     */
    public static function getMonitorPosition(int $monitor): Vector2
    {
        $pos = self::ffi()->GetMonitorPosition($monitor);
        return new Vector2($pos->x, $pos->y);
    }

    /**
     * 获取指定显示器的宽度（当前使用的视频模式）
     *
     * @param integer $monitor 显示器编号
     * @return integer 显示器宽度
     */
    public static function getMonitorWidth(int $monitor): int
    {
        return self::ffi()->GetMonitorWidth($monitor);
    }

    /**
     * 获取指定显示器的高度（当前使用的视频模式）
     *
     * @param integer $monitor 显示器编号
     * @return integer 显示器高度
     */
    public static function getMonitorHeight(int $monitor): int
    {
        return self::ffi()->GetMonitorHeight($monitor);
    }

    /**
     * 获取指定显示器的物理宽度（毫米）
     *
     * @param integer $monitor 显示器编号
     * @return integer 显示器物理宽度
     */
    public static function getMonitorPhysicalWidth(int $monitor): int
    {
        return self::ffi()->GetMonitorPhysicalWidth($monitor);
    }

    /**
     * 获取指定显示器的物理高度（毫米）
     *
     * @param integer $monitor 显示器编号
     * @return integer 显示器物理高度
     */
    public static function getMonitorPhysicalHeight(int $monitor): int
    {
        return self::ffi()->GetMonitorPhysicalHeight($monitor);
    }

    /**
     * 获取指定显示器的刷新率
     *
     * @param integer $monitor 显示器编号
     * @return integer 显示器刷新率
     */
    public static function getMonitorRefreshRate(int $monitor): int
    {
        return self::ffi()->GetMonitorRefreshRate($monitor);
    }

    /**
     * 获取窗口在显示器上的XY位置
     *
     * @return Vector2 窗口位置
     */
    public static function getWindowPosition(): Vector2
    {
        $pos = self::ffi()->GetWindowPosition();
        return new Vector2($pos->x, $pos->y);
    }

    /**
     * 获取窗口DPI缩放因子
     *
     * @return Vector2 DPI缩放因子
     */
    public static function getWindowScaleDPI(): Vector2
    {
        $dpi = self::ffi()->GetWindowScaleDPI();
        return new Vector2($dpi->x, $dpi->y);
    }

    /**
     * 获取指定显示器的UTF-8编码可读名称
     *
     * @param integer $monitor 显示器编号
     * @return string 显示器名称
     */
    public static function getMonitorName(int $monitor): string
    {
        return self::ffi()->GetMonitorName($monitor);
    }

    /**
     * 设置剪贴板文本内容
     *
     * @param string $text 文本内容
     * @return void
     */
    public static function setClipboardText(string $text): void
    {
        self::ffi()->SetClipboardText($text);
    }

    /**
     * 获取剪贴板文本内容
     *
     * @return string 剪贴板文本内容
     */
    public static function getClipboardText(): string
    {
        return self::ffi()->GetClipboardText();
    }

    /**
     * 获取剪贴板图像
     *
     * @return Image 剪贴板图像数据
     */
    public static function getClipboardImage(): Image
    {
        return new Image(self::ffi()->GetClipboardImage());
    }

    /**
     * 启用在EndDrawing()时等待事件（禁用自动事件轮询）
     *
     * @return void
     */
    public static function enableEventWaiting(): void
    {
        self::ffi()->EnableEventWaiting();
    }

    /**
     * 禁用等待事件（启用自动事件轮询）
     *
     * @return void
     */
    public static function disableEventWaiting(): void
    {
        self::ffi()->DisableEventWaiting();
    }

    //### 光标相关函数

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
     * @return bool
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
     * @return bool
     */
    public static function isCursorOnScreen(): bool
    {
        return self::ffi()->IsCursorOnScreen();
    }

    //### 绘图相关函数

    /**
     * 设置背景颜色（帧缓冲清除颜色）
     *
     * @param Color $color 背景颜色
     * @return void
     */
    public static function clearBackground(Color $color): void
    {
        self::ffi()->ClearBackground($color->struct());
    }

    /**
     * 初始化绘图画布（帧缓冲）
     *
     * @return void
     */
    public static function beginDrawing(): void
    {
        self::ffi()->BeginDrawing();
    }

    /**
     * 结束画布绘制并交换缓冲（双缓冲）
     *
     * @return void
     */
    public static function endDrawing(): void
    {
        self::ffi()->EndDrawing();
    }

    /**
     * 开启自定义2D相机模式
     *
     * @param Camera2D $camera 相机配置
     * @return void
     */
    public static function beginMode2D(Camera2D $camera): void
    {
        self::ffi()->BeginMode2D($camera->struct());
    }

    /**
     * 结束2D相机模式
     *
     * @return void
     */
    public static function endMode2D(): void
    {
        self::ffi()->EndMode2D();
    }

    /**
     * 开启自定义3D相机模式
     *
     * @param Camera3D $camera 相机配置
     * @return void
     */
    public static function beginMode3D(Camera3D $camera): void
    {
        self::ffi()->BeginMode3D($camera->struct());
    }

    /**
     * 结束3D模式并返回默认2D正交模式
     *
     * @return void
     */
    public static function endMode3D(): void
    {
        self::ffi()->EndMode3D();
    }

    /**
     * 开始绘制到渲染纹理
     *
     * @param RenderTexture $target 渲染纹理目标
     * @return void
     */
    public static function beginTextureMode(RenderTexture $target): void
    {
        self::ffi()->BeginTextureMode($target->struct());
    }

    /**
     * 结束渲染纹理绘制
     *
     * @return void
     */
    public static function endTextureMode(): void
    {
        self::ffi()->EndTextureMode();
    }

    /**
     * 开启自定义着色器绘制
     *
     * @param Shader $shader 着色器
     * @return void
     */
    public static function beginShaderMode(Shader $shader): void
    {
        self::ffi()->BeginShaderMode($shader->struct());
    }

    /**
     * 结束自定义着色器绘制（使用默认着色器）
     *
     * @return void
     */
    public static function endShaderMode(): void
    {
        self::ffi()->EndShaderMode();
    }

    /**
     * 开启混合模式（透明、叠加、相乘、相减、自定义）
     *
     * @param integer $mode 混合模式
     * @return void
     */
    public static function beginBlendMode(int $mode): void
    {
        self::ffi()->BeginBlendMode($mode);
    }

    /**
     * 结束混合模式（重置为默认透明混合）
     *
     * @return void
     */
    public static function endBlendMode(): void
    {
        self::ffi()->EndBlendMode();
    }

    /**
     * 开启裁剪模式（定义后续绘制的屏幕区域）
     *
     * @param integer $x X坐标
     * @param integer $y Y坐标
     * @param integer $width 宽度
     * @param integer $height 高度
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
     * 开启VR立体渲染（需要VR模拟器）
     *
     * @param VrStereoConfig $config VR立体配置
     * @return void
     */
    public static function beginVrStereoMode(VrStereoConfig $config): void
    {
        self::ffi()->BeginVrStereoMode($config->struct());
    }

    /**
     * 结束VR立体渲染
     *
     * @return void
     */
    public static function endVrStereoMode(): void
    {
        self::ffi()->EndVrStereoMode();
    }

    //### VR立体配置函数（用于VR模拟器）

    // /**
    //  * 加载VR模拟器设备的立体配置
    //  *
    //  * @param VrDeviceInfo $device VR设备信息
    //  * @return VrStereoConfig VR立体配置
    //  */
    // public static function loadVrStereoConfig(VrDeviceInfo $device): VrStereoConfig
    // {
    //     $res = self::ffi()->LoadVrStereoConfig($device->struct());
    //     return new VrStereoConfig(
    //         [new Matrix($res->projection[0]->)]
    //     );
    // }

    // /**
    //  * 卸载VR立体配置
    //  *
    //  * @param VrStereoConfig $config VR立体配置
    //  * @return void
    //  */
    // public static function unloadVrStereoConfig(VrStereoConfig $config): void
    // {
    //     self::ffi()->UnloadVrStereoConfig($config->struct());
    // }

    //### 着色器管理函数
    //> 注意：OpenGL 1.1不支持着色器功能

    /**
     * 从文件加载着色器并绑定默认位置
     *
     * @param string $vsFileName 顶点着色器文件路径
     * @param string $fsFileName 片段着色器文件路径
     * @return Shader 着色器对象
     */
    public static function loadShader(string $vsFileName, string $fsFileName): Shader
    {
        return new Shader(self::ffi()->LoadShader($vsFileName, $fsFileName));
    }

    /**
     * 从代码字符串加载着色器并绑定默认位置
     *
     * @param string $vsCode 顶点着色器代码
     * @param string $fsCode 片段着色器代码
     * @return Shader 着色器对象
     */
    public static function loadShaderFromMemory(string $vsCode, string $fsCode): Shader
    {
        return new Shader(self::ffi()->LoadShaderFromMemory($vsCode, $fsCode));
    }

    /**
     * 检查着色器是否有效（已加载到GPU）
     *
     * @param Shader $shader 着色器对象
     * @return bool 是否有效
     */
    public static function isShaderValid(Shader $shader): bool
    {
        return self::ffi()->IsShaderValid($shader->struct());
    }

    /**
     * 获取着色器uniform位置
     *
     * @param Shader $shader 着色器对象
     * @param string $uniformName uniform名称
     * @return int uniform位置
     */
    public static function getShaderLocation(Shader $shader, string $uniformName): int
    {
        return self::ffi()->GetShaderLocation($shader->struct(), $uniformName);
    }

    /**
     * 获取着色器属性位置
     *
     * @param Shader $shader 着色器对象
     * @param string $attribName 属性名称
     * @return int 属性位置
     */
    public static function getShaderLocationAttrib(Shader $shader, string $attribName): int
    {
        return self::ffi()->GetShaderLocationAttrib($shader->struct(), $attribName);
    }

    /**
     * 设置着色器uniform值
     *
     * @param Shader $shader 着色器对象
     * @param int $locIndex uniform位置索引
     * @param string $value 值
     * @param int $uniformType uniform类型
     * @return void
     */
    public static function setShaderValue(Shader $shader, int $locIndex, string $value, int $uniformType): void
    {
        $c_value = self::ffi()->new('char[' . strlen($value) . ']');
        self::ffi()::memcpy($c_value, $value, strlen($value));
        self::ffi()->SetShaderValue(
            $shader->struct(),
            $locIndex,
            self::ffi()->cast('void*', $c_value),
            $uniformType
        );
    }

    /**
     * 设置着色器uniform值（向量）
     *
     * @param Shader $shader 着色器对象
     * @param int $locIndex uniform位置索引
     * @param string $value 值
     * @param int $uniformType uniform类型
     * @param int $count 向量元素数量
     * @return void
     */
    public static function setShaderValueV(Shader $shader, int $locIndex, string $value, int $uniformType, int $count): void
    {
        $c_value = self::ffi()->new('char[' . strlen($value) . ']');
        self::ffi()::memcpy($c_value, $value, strlen($value));
        self::ffi()->SetShaderValueV(
            $shader->struct(),
            $locIndex,
            self::ffi()->cast('void*', $c_value),
            $uniformType,
            $count
        );
    }

    /**
     * 设置着色器uniform值（4x4矩阵）
     *
     * @param Shader $shader 着色器对象
     * @param int $locIndex uniform位置索引
     * @param Matrix $mat 矩阵
     * @return void
     */
    public static function setShaderValueMatrix(Shader $shader, int $locIndex, Matrix $mat): void
    {
        self::ffi()->SetShaderValueMatrix($shader->struct(), $locIndex, $mat->struct());
    }

    /**
     * 设置着色器纹理uniform值（sampler2d）
     *
     * @param Shader $shader 着色器对象
     * @param int $locIndex uniform位置索引
     * @param Texture $texture 纹理
     * @return void
     */
    public static function setShaderValueTexture(Shader $shader, int $locIndex, Texture $texture): void
    {
        self::ffi()->SetShaderValueTexture($shader->struct(), $locIndex, $texture->struct());
    }

    /**
     * 从GPU显存卸载着色器
     *
     * @param Shader $shader 着色器对象
     * @return void
     */
    public static function unloadShader(Shader $shader): void
    {
        self::ffi()->UnloadShader($shader->struct());
    }

    //### 屏幕空间相关函数

    /**
     * 获取屏幕位置（如鼠标）对应的世界空间射线
     *
     * @param Vector2 $position 屏幕位置
     * @param Camera3D $camera 相机配置
     * @return Ray 射线对象
     */
    public static function getScreenToWorldRay(Vector2 $position, Camera3D $camera): Ray
    {
        $c_ray = self::ffi()->GetScreenToWorldRay($position->struct(), $camera->struct());
        return new Ray(
            new Vector3($c_ray->position->x, $c_ray->position->y, $c_ray->position->z),
            new Vector3($c_ray->direction->x, $c_ray->direction->y, $c_ray->direction->z)
        );
    }

    /**
     * 在视口中获取屏幕位置对应的世界空间射线
     *
     * @param Vector2 $position 屏幕位置
     * @param Camera3D $camera 相机配置
     * @param int $width 视口宽度
     * @param int $height 视口高度
     * @return Ray 射线对象
     */
    public static function getScreenToWorldRayEx(Vector2 $position, Camera3D $camera, int $width, int $height): Ray
    {
        $c_ray = self::ffi()->GetScreenToWorldRayEx($position->struct(), $camera->struct(), $width, $height);
        return new Ray(
            new Vector3($c_ray->position->x, $c_ray->position->y, $c_ray->position->z),
            new Vector3($c_ray->direction->x, $c_ray->direction->y, $c_ray->direction->z)
        );
    }

    /**
     * 将3D世界坐标转换为屏幕空间坐标
     *
     * @param Vector3 $position 3D世界坐标
     * @param Camera3D $camera 相机配置
     * @return Vector2 2D屏幕坐标
     */
    public static function getWorldToScreen(Vector3 $position, Camera3D $camera): Vector2
    {
        $c_vec2 = self::ffi()->GetWorldToScreen(
            $position->struct(),
            $camera->struct()
        );
        return new Vector2($c_vec2->x, $c_vec2->y);
    }

    /**
     * 在视口中将3D世界坐标转换为屏幕空间坐标
     *
     * @param Vector3 $position 3D世界坐标
     * @param Camera3D $camera 相机配置
     * @param int $width 视口宽度
     * @param int $height 视口高度
     * @return Vector2 2D屏幕坐标
     */
    public static function getWorldToScreenEx(Vector3 $position, Camera3D $camera, int $width, int $height): Vector2
    {
        $c_vec2 = self::ffi()->GetWorldToScreenEx(
            $position->struct(),
            $camera->struct(),
            $width,
            $height
        );
        return new Vector2($c_vec2->x, $c_vec2->y);
    }

    /**
     * 将2D相机世界坐标转换为屏幕空间坐标
     *
     * @param Vector2 $position 2D世界坐标
     * @param Camera2D $camera 2D相机配置
     * @return Vector2 2D屏幕坐标
     */
    public static function getWorldToScreen2D(Vector2 $position, Camera2D $camera): Vector2
    {
        $c_vec2 = self::ffi()->GetWorldToScreen2D($position->struct(), $camera->struct());
        return new Vector2($c_vec2->x, $c_vec2->y);
    }

    /**
     * 将2D相机屏幕坐标转换为世界空间坐标
     *
     * @param Vector2 $position 2D屏幕坐标
     * @param Camera2D $camera 2D相机配置
     * @return Vector2 2D世界坐标   
     */
    public static function getScreenToWorld2D(Vector2 $position, Camera2D $camera): Vector2
    {
        $c_vec2 = self::ffi()->GetScreenToWorld2D($position->struct(), $camera->struct());
        return new Vector2($c_vec2->x, $c_vec2->y);
    }

    /**
     * 获取相机变换矩阵（视图矩阵）
     *
     * @param Camera3D $camera 相机配置
     * @return Matrix 矩阵对象
     */
    public static function getCameraMatrix(Camera3D $camera): Matrix
    {
        $c_matrix = self::ffi()->GetCameraMatrix($camera->struct());
        return new Matrix(
            [$c_matrix->m0, $c_matrix->m1, $c_matrix->m2, $c_matrix->m3],
            [$c_matrix->m4, $c_matrix->m5, $c_matrix->m6, $c_matrix->m7],
            [$c_matrix->m8, $c_matrix->m9, $c_matrix->m10, $c_matrix->m11],
            [$c_matrix->m12, $c_matrix->m13, $c_matrix->m14, $c_matrix->m15]
        );
    }

    /**
     * 获取2D相机变换矩阵
     *
     * @param Camera2D $camera 2D相机配置
     * @return Matrix 矩阵对象
     */
    public static function getCameraMatrix2D(Camera2D $camera): Matrix
    {
        $c_matrix = self::ffi()->GetCameraMatrix2D($camera->struct());
        return new Matrix(
            [$c_matrix->m0, $c_matrix->m1, $c_matrix->m2, $c_matrix->m3],
            [$c_matrix->m4, $c_matrix->m5, $c_matrix->m6, $c_matrix->m7],
            [$c_matrix->m8, $c_matrix->m9, $c_matrix->m10, $c_matrix->m11],
            [$c_matrix->m12, $c_matrix->m13, $c_matrix->m14, $c_matrix->m15]
        );
    }

    //### 时间相关函数

    /**
     * 设置目标FPS（最大值）
     *
     * @param int $fps 每秒帧数
     * @return void
     */
    public static function setTargetFPS(int $fps): void
    {
        self::ffi()->SetTargetFPS($fps);
    }

    /**
     * 获取上一帧的绘制时间（增量时间）
     *
     * @return float 增量时间
     */
    public static function getFrameTime(): float
    {
        return self::ffi()->GetFrameTime();
    }

    /**
     * 获取自InitWindow()以来的运行时间（秒）
     *
     * @return double 运行时间
     */
    public static function getTime(): float
    {
        return self::ffi()->GetTime();
    }

    /**
     * 获取当前FPS
     *
     * @return int 当前每秒帧数
     */
    public static function getFPS(): int
    {
        return self::ffi()->GetFPS();
    }

    //### 自定义帧控制函数
    //> 注意：这些函数供需要完全控制帧处理的高级用户使用\n默认情况下EndDrawing()会自动处理：绘制内容+交换缓冲+帧时间管理+轮询输入事件\n要手动控制帧流程，请在config.h中启用SUPPORT_CUSTOM_FRAME_CONTROL

    /**
     * 交换前后缓冲（屏幕绘制）
     *
     * @return void
     */
    public static function swapScreenBuffer(): void
    {
        self::ffi()->SwapScreenBuffer();
    }

    /**
     * 轮询所有输入事件
     *
     * @return void
     */
    public static function pollInputEvents(): void
    {
        self::ffi()->PollInputEvents();
    }

    /**
     * 等待指定时间（暂停程序执行）
     *
     * @param float $seconds 等待的秒数
     * @return void
     */
    public static function waitTime(float $seconds): void
    {
        self::ffi()->WaitTime($seconds);
    }


    //### 随机数生成函数

    /**
     * 设置随机数生成器种子
     *
     * @param int $seed 随机数种子
     * @return void
     */
    public static function setRandomSeed(int $seed): void
    {
        self::ffi()->SetRandomSeed($seed);
    }

    /**
     * 获取[min, max]范围内的随机值（包含两端）
     *
     * @param int $min 最小值
     * @param int $max 最大值
     * @return int 随机值
     */
    public static function getRandomValue(int $min, int $max): int
    {
        return self::ffi()->GetRandomValue($min, $max);
    }

    /**
     * 加载不重复的随机数序列
     *
     * @param int $count 序列中的数字数量
     * @param int $min 序列中最小值
     * @param int $max 序列中最大值
     * @return array<int,int> 随机数序列
     */
    public static function loadRandomSequence(int $count, int $min, int $max): array
    {
        $res = self::ffi()->LoadRandomSequence($count, $min, $max);
        $arr = [];
        foreach ($res as $i => $val) {
            $arr[$i] = (int)$val;
        }
        return $arr;
    }

    /**
     * 卸载随机数序列
     *
     * @param array<int,int> $sequence 随机数序列
     * @return void
     */
    public static function unloadRandomSequence(array $sequence): void
    {
        $c_ints = self::ffi()->new("int [" . count($sequence) . "]");
        foreach ($sequence as $i => $val) {
            $c_ints[$i] = $val;
        }
        self::ffi()->UnloadRandomSequence(self::ffi()->cast("int *", $c_ints));
    }

    //### 杂项函数

    /**
     * 截取屏幕截图（文件名扩展名决定格式）
     *
     * @param string $fileName 文件名，包含路径和扩展名
     * @return void
     */
    public static function takeScreenshot(string $fileName): void
    {
        self::ffi()->TakeScreenshot($fileName);
    }

    /**
     * 设置初始化配置标志（参考FLAGS）
     *
     * @param int $flags 配置标志
     * @return void
     */
    public static function setConfigFlags(int $flags): void
    {
        self::ffi()->SetConfigFlags($flags);
    }

    /**
     * 用默认浏览器打开URL（如果可用）
     *
     * @param string $url 要打开的URL
     * @return void
     */
    public static function openURL(string $url): void
    {
        self::ffi()->OpenURL($url);
    }

    /**
     * 输出日志信息（LOG_DEBUG, LOG_INFO, LOG_WARNING, LOG_ERROR...）
     *
     * @param int $logLevel 日志级别
     * @param string $text 日志文本
     * @param mixed ...$args 可变参数列表，用于格式化字符串
     * @return void
     */
    public static function traceLog(int $logLevel, string $text, ...$args): void
    {
        // 使用 vsprintf 进行字符串格式化，如果需要支持可变参数的话
        $formattedText = vsprintf($text, $args);
        self::ffi()->TraceLog($logLevel, $formattedText);
    }

    /**
     * 设置最低日志级别
     *
     * @param int $logLevel 最低日志级别
     * @return void
     */
    public static function setTraceLogLevel(int $logLevel): void
    {
        self::ffi()->SetTraceLogLevel($logLevel);
    }

    /**
     * 内部内存分配器
     *
     * @param int $size 要分配的内存大小
     * @return CData 分配的内存块
     */
    public static function memAlloc(int $size): CData
    {
        return self::ffi()->MemAlloc($size);
    }

    /**
     * 内部内存重新分配器
     *
     * @param CData $ptr 已分配的内存指针
     * @param int $size 新的内存大小
     * @return CData 重新分配的内存块
     */
    public static function memRealloc(CData $ptr, int $size): CData
    {
        return self::ffi()->MemRealloc($ptr, $size);
    }

    /**
     * 内部内存释放器
     *
     * @param CData $ptr 要释放的内存指针
     * @return void
     */
    public static function memFree(CData $ptr): void
    {
        self::ffi()->MemFree($ptr);
    }

    //### 设置自定义回调
    //> 警告：回调设置仅供高级用户使用

    /**
     * 设置自定义日志回调
     *
     * @param callable $callback 回调函数，接受日志级别、消息和可变参数列表作为参数
     * @return void
     */
    public static function setTraceLogCallback(callable $callback): void
    {
        $callbackWrapper = function ($logLevel, $text, $args) use ($callback) {
            $callback($logLevel, $text, $args);
        };
        self::ffi()->SetTraceLogCallback($callbackWrapper);
    }

    /**
     * 设置自定义二进制文件加载回调
     *
     * @param callable $callback 回调函数，接受文件路径作为参数，返回读取的数据和数据长度
     * @return void
     */
    public static function setLoadFileDataCallback(callable $callback): void
    {
        $callbackWrapper = function ($fileName, $dataSize) use ($callback) {
            return $callback($fileName, $dataSize);
        };
        self::ffi()->SetLoadFileDataCallback($callbackWrapper);
    }

    /**
     * 设置自定义二进制文件保存回调
     *
     * @param callable $callback 回调函数，接受文件路径、数据和数据长度作为参数，返回是否成功
     * @return void
     */
    public static function setSaveFileDataCallback(callable $callback): void
    {
        $callbackWrapper = function ($fileName, $data, $dataSize) use ($callback) {
            return $callback($fileName, $data, $dataSize);
        };
        self::ffi()->SetSaveFileDataCallback($callbackWrapper);
    }

    /**
     * 设置自定义文本文件加载回调
     *
     * @param callable $callback 回调函数，接受文件路径作为参数，返回读取的文本内容
     * @return void
     */
    public static function setLoadFileTextCallback(callable $callback): void
    {
        $callbackWrapper = function ($fileName) use ($callback) {
            return $callback($fileName);
        };
        self::ffi()->SetLoadFileTextCallback($callbackWrapper);
    }

    /**
     * 设置自定义文本文件保存回调
     *
     * @param callable $callback 回调函数，接受文件路径和文本内容作为参数，返回是否成功
     * @return void
     */
    public static function setSaveFileTextCallback(callable $callback): void
    {
        $callbackWrapper = function ($fileName, $text) use ($callback) {
            return $callback($fileName, $text);
        };

        self::ffi()->SetSaveFileTextCallback($callbackWrapper);
    }

    //### 文件管理函数

    /**
     * 以字节数组形式加载文件数据（读取）
     *
     * @param string $fileName 文件路径
     * @return array 包含文件数据（作为字符串）和数据大小
     */
    public static function loadFileData(string $fileName): array
    {
        $dataSize = self::ffi()->new("int[1]");
        $data = self::ffi()->LoadFileData($fileName, $dataSize);
        return [
            'data' => $data,
            'size' => $dataSize[0]
        ];
    }

    /**
     * 卸载由LoadFileData()分配的文件数据
     *
     * @param CData $data 要释放的数据指针
     * @return void
     */
    public static function unloadFileData(CData $data): void
    {
        self::ffi()->UnloadFileData($data);
    }

    /**
     * 将字节数组数据保存到文件（写入），成功返回true
     *
     * @param string $fileName 文件路径
     * @param string $data 数据
     * @param int $dataSize 数据大小
     * @return bool 操作是否成功
     */
    public static function saveFileData(string $fileName, string $data): bool
    {
        $c_data = self::ffi()->new("char [" . strlen($data) + 1 . "]");
        self::ffi()::memcpy($c_data, $data, strlen($data));
        return self::ffi()->SaveFileData($fileName, $c_data, strlen($data));
    }

    /**
     * 将数据导出为代码文件(.h)，成功返回true
     *
     * @param string $data 数据指针
     * @param int $dataSize 数据大小
     * @param string $fileName 文件路径
     * @return bool 操作是否成功
     */
    public static function exportDataAsCode(string $data, int $dataSize, string $fileName): bool
    {
        $c_data = self::ffi()->new("char [" . strlen($data) + 1 . "]");
        self::ffi()::memcpy($c_data, $data, strlen($data));
        return self::ffi()->ExportDataAsCode($c_data, $dataSize, $fileName);
    }

    /**
     * 加载文本文件数据（读取），返回'\0'终止的字符串
     *
     * @param string $fileName 文件路径
     * @return string 文本内容
     */
    public static function loadFileText(string $fileName): string
    {
        return (string)self::ffi()->LoadFileText($fileName);
    }

    /**
     * 卸载由LoadFileText()分配的文本数据
     *
     * @param string $text 要释放的文本指针
     * @return void
     */
    public static function unloadFileText(string $text): void
    {
        $c_text = self::ffi()->new("char [" . strlen($text) + 1 . "]");
        self::ffi()::memcpy($c_text, $text, strlen($text));
        self::ffi()->UnloadFileText($c_text);
    }

    /**
     * 保存文本数据到文件（写入），字符串需'\0'终止，成功返回true
     *
     * @param string $fileName 文件路径
     * @param string $text 文本内容
     * @return bool 操作是否成功
     */
    public static function saveFileText(string $fileName, string $text): bool
    {
        $c_text = self::ffi()->new("char [" . strlen($text) + 1 . "]");
        self::ffi()::memcpy($c_text, $text, strlen($text));
        return self::ffi()->SaveFileText($fileName, $c_text);
    }

    //### 文件系统函数

    /**
     * 检查文件是否存在
     *
     * @param string $fileName 文件路径
     * @return bool 文件是否存在
     */
    public static function fileExists(string $fileName): bool
    {
        return self::ffi()->FileExists($fileName);
    }

    /**
     * 检查目录路径是否存在
     *
     * @param string $dirPath 目录路径
     * @return bool 目录是否存在
     */
    public static function directoryExists(string $dirPath): bool
    {
        return self::ffi()->DirectoryExists($dirPath);
    }

    /**
     * 检查文件扩展名（需包含点：.png, .wav）
     *
     * @param string $fileName 文件路径
     * @param string $ext 扩展名
     * @return bool 是否匹配
     */
    public static function isFileExtension(string $fileName, string $ext): bool
    {
        return self::ffi()->IsFileExtension($fileName, $ext);
    }

    /**
     * 获取文件字节长度（注意：GetFileSize与windows.h冲突）
     *
     * @param string $fileName 文件路径
     * @return int 文件大小
     */
    public static function getFileLength(string $fileName): int
    {
        return self::ffi()->GetFileLength($fileName);
    }

    /**
     * 获取文件名扩展名指针（包含点：'.png'）
     *
     * @param string $fileName 文件路径
     * @return string 文件扩展名
     */
    public static function getFileExtension(string $fileName): string
    {
        return (string)self::ffi()->GetFileExtension($fileName);
    }

    /**
     * 获取路径中的文件名指针
     *
     * @param string $filePath 文件路径
     * @return string 文件名
     */
    public static function getFileName(string $filePath): string
    {
        return (string)self::ffi()->GetFileName($filePath);
    }

    /**
     * 获取不带扩展名的文件名（使用静态字符串）
     *
     * @param string $filePath 文件路径
     * @return string 文件名（无扩展名）
     */
    public static function getFileNameWithoutExt(string $filePath): string
    {
        return (string)self::ffi()->GetFileNameWithoutExt($filePath);
    }

    /**
     * 获取完整路径（使用静态字符串）
     *
     * @param string $filePath 文件路径
     * @return string 目录路径
     */
    public static function getDirectoryPath(string $filePath): string
    {
        return (string)self::ffi()->GetDirectoryPath($filePath);
    }

    /**
     * 获取上级目录路径（使用静态字符串）
     *
     * @param string $dirPath 目录路径
     * @return string 上级目录路径
     */
    public static function getPrevDirectoryPath(string $dirPath): string
    {
        return (string)self::ffi()->GetPrevDirectoryPath($dirPath);
    }

    /**
     * 获取当前工作目录（使用静态字符串）
     *
     * @return string 当前工作目录
     */
    public static function getWorkingDirectory(): string
    {
        return (string)self::ffi()->GetWorkingDirectory();
    }

    /**
     * 获取应用程序所在目录（使用静态字符串）
     *
     * @return string 应用程序目录
     */
    public static function getApplicationDirectory(): string
    {
        return (string)self::ffi()->GetApplicationDirectory();
    }

    /**
     * 创建目录（完整路径），成功返回0
     *
     * @param string $dirPath 目录路径
     * @return int 错误码（0表示成功）
     */
    public static function makeDirectory(string $dirPath): int
    {
        return self::ffi()->MakeDirectory($dirPath);
    }

    /**
     * 更改工作目录，成功返回true
     *
     * @param string $dir 新的工作目录
     * @return bool 操作是否成功
     */
    public static function changeDirectory(string $dir): bool
    {
        return self::ffi()->ChangeDirectory($dir);
    }

    /**
     * 检查路径是文件还是目录
     *
     * @param string $path 路径
     * @return bool 是否为文件
     */
    public static function isPathFile(string $path): bool
    {
        return self::ffi()->IsPathFile($path);
    }

    /**
     * 检查文件名在平台/OS中是否有效
     *
     * @param string $fileName 文件名
     * @return bool 是否有效
     */
    public static function isFileNameValid(string $fileName): bool
    {
        return self::ffi()->IsFileNameValid($fileName);
    }

    /**
     * 加载目录文件路径列表
     *
     * @param string $dirPath 目录路径
     * @return FilePathList 文件路径列表结构
     */
    public static function loadDirectoryFiles(string $dirPath): FilePathList
    {
        return new FilePathList(self::ffi()->LoadDirectoryFiles($dirPath));
    }

    /**
     * 加载带扩展名过滤和递归扫描的目录文件路径，使用'DIR'过滤包含目录
     *
     * @param string $basePath 基础路径
     * @param string $filter 过滤器
     * @param bool $scanSubdirs 是否递归子目录
     * @return FilePathList 文件路径列表结构
     */
    public static function loadDirectoryFilesEx(string $basePath, string $filter, bool $scanSubdirs): FilePathList
    {
        return new FilePathList(self::ffi()->LoadDirectoryFilesEx($basePath, $filter, $scanSubdirs));
    }

    /**
     * 卸载文件路径列表
     *
     * @param FilePathList $files 文件路径列表结构
     * @return void
     */
    public static function unloadDirectoryFiles(FilePathList $files): void
    {
        self::ffi()->UnloadDirectoryFiles($files->struct());
    }

    /**
     * 检查是否有文件被拖入窗口
     *
     * @return bool 是否有文件被拖入
     */
    public static function isFileDropped(): bool
    {
        return self::ffi()->IsFileDropped();
    }

    /**
     * 加载被拖放的文件路径
     *
     * @return FilePathList 文件路径列表结构
     */
    public static function loadDroppedFiles(): FilePathList
    {
        return new FilePathList(self::ffi()->LoadDroppedFiles());
    }

    /**
     * 卸载被拖放的文件路径
     *
     * @param FilePathList $files 文件路径列表结构
     * @return void
     */
    public static function unloadDroppedFiles(FilePathList $files): void
    {
        self::ffi()->UnloadDroppedFiles($files->struct());
    }

    /**
     * 获取文件修改时间（最后写入时间）
     *
     * @param string $fileName 文件路径
     * @return long 文件修改时间戳
     */
    public static function getFileModTime(string $fileName): int
    {
        return self::ffi()->GetFileModTime($fileName);
    }

    //### 压缩/编码功能

    /**
     * 压缩数据（DEFLATE算法），需用MemFree()释放
     *
     * @param \FFI\CData $data 要压缩的数据
     * @param int $dataSize 数据大小
     * @return array 返回一个数组，包含压缩后的数据和压缩后数据大小
     */
    public static function compressData(\FFI\CData $data, int $dataSize): array
    {
        $compDataSize = \FFI::new('int');
        $compressedData = self::ffi()->CompressData($data, $dataSize, $compDataSize);
        return [$compressedData, $compDataSize[0]];
    }

    /**
     * 解压数据（DEFLATE算法），需用MemFree()释放
     *
     * @param \FFI\CData $compData 要解压的数据
     * @param int $compDataSize 压缩数据大小
     * @return array 返回一个数组，包含解压后的数据和解压后数据大小
     */
    public static function decompressData(\FFI\CData $compData, int $compDataSize): array
    {
        $dataSize = \FFI::new('int');
        $decompressedData = self::ffi()->DecompressData($compData, $compDataSize, $dataSize);
        return [$decompressedData, $dataSize[0]];
    }

    /**
     * 将数据编码为Base64字符串，需用MemFree()释放
     *
     * @param \FFI\CData $data 要编码的数据
     * @param int $dataSize 数据大小
     * @return array 返回一个数组，包含Base64编码后的字符串和输出大小
     */
    public static function encodeDataBase64(\FFI\CData $data, int $dataSize): array
    {
        $outputSize = \FFI::new('int');
        $encodedData = self::ffi()->EncodeDataBase64($data, $dataSize, $outputSize);
        return [(string)$encodedData, $outputSize[0]];
    }

    /**
     * 解码Base64字符串数据，需用MemFree()释放
     *
     * @param \FFI\CData $data 要解码的数据
     * @return array 返回一个数组，包含解码后的数据和输出大小
     */
    public static function decodeDataBase64(\FFI\CData $data): array
    {
        $outputSize = \FFI::new('int');
        $decodedData = self::ffi()->DecodeDataBase64($data, $outputSize);
        return [$decodedData, $outputSize[0]];
    }

    /**
     * 计算CRC32哈希值
     *
     * @param \FFI\CData $data 要计算哈希的数据
     * @param int $dataSize 数据大小
     * @return unsigned int CRC32哈希值
     */
    public static function computeCRC32(\FFI\CData $data, int $dataSize): int
    {
        return self::ffi()->ComputeCRC32($data, $dataSize);
    }

    /**
     * 计算MD5哈希值，返回静态int[4]（16字节）
     *
     * @param \FFI\CData $data 要计算哈希的数据
     * @param int $dataSize 数据大小
     * @return array MD5哈希值数组
     */
    public static function computeMD5(\FFI\CData $data, int $dataSize): array
    {
        $hash = self::ffi()->ComputeMD5($data, $dataSize);
        // Convert the hash from C array to PHP array
        return [
            $hash[0],
            $hash[1],
            $hash[2],
            $hash[3]
        ];
    }

    /**
     * 计算SHA1哈希值，返回静态int[5]（20字节）
     *
     * @param \FFI\CData $data 要计算哈希的数据
     * @param int $dataSize 数据大小
     * @return array SHA1哈希值数组
     */
    public static function computeSHA1(\FFI\CData $data, int $dataSize): array
    {
        $hash = self::ffi()->ComputeSHA1($data, $dataSize);
        // Convert the hash from C array to PHP array
        return [
            $hash[0],
            $hash[1],
            $hash[2],
            $hash[3],
            $hash[4]
        ];
    }

    //### 自动化事件功能

    /**
     * 从文件加载自动化事件列表，NULL表示空列表，容量=MAX_AUTOMATION_EVENTS
     *
     * @param string $fileName 文件路径
     * @return AutomationEventList 自动化事件列表结构
     */
    public static function loadAutomationEventList(string $fileName): AutomationEventList
    {
        $list = self::ffi()->LoadAutomationEventList($fileName);
        $arr = [];
        for ($i = 0; $i < $list->count; $i++) {
            $params = [];
            for ($j = 0; $j < count($list->events[$i]->params); $j++) {
                $params[] = $list->events[$i]->params[$j];
            }
            $arr[] = new AutomationEvent($list->events[$i]->type, $list->events[$i]->frame, $list->events[$i]->value, $params);
        }
        return new AutomationEventList($list->capacity, $list->count, $arr);
    }

    /**
     * 卸载自动化事件列表
     *
     * @param AutomationEventList $list 自动化事件列表结构
     * @return void
     */
    public static function unloadAutomationEventList(AutomationEventList $list): void
    {
        self::ffi()->UnloadAutomationEventList($list->struct());
    }

    /**
     * 将自动化事件列表导出为文本文件
     *
     * @param AutomationEventList $list 自动化事件列表结构
     * @param string $fileName 导出文件路径
     * @return bool 操作是否成功
     */
    public static function exportAutomationEventList(AutomationEventList $list, string $fileName): bool
    {
        return self::ffi()->ExportAutomationEventList($list->struct(), $fileName);
    }

    /**
     * 设置要记录的自动化事件列表
     *
     * @param AutomationEventList $list 自动化事件列表结构
     * @return void
     */
    public static function setAutomationEventList(AutomationEventList $list): void
    {
        self::ffi()->SetAutomationEventList($list->struct());
    }

    /**
     * 设置自动化事件记录的基准帧
     *
     * @param int $frame 基准帧
     * @return void
     */
    public static function setAutomationEventBaseFrame(int $frame): void
    {
        self::ffi()->SetAutomationEventBaseFrame($frame);
    }

    /**
     * 开始记录自动化事件（需先设置列表）
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
     * 执行记录的自动化事件
     *
     * @param AutomationEvent $event 自动化事件结构
     * @return void
     */
    public static function playAutomationEvent(AutomationEvent $event): void
    {
        self::ffi()->PlayAutomationEvent($event->struct());
    }

    //### 键盘输入相关函数

    /**
     * 检查按键是否被按下一次
     *
     * @param int $key 按键代码
     * @return bool 按键是否被按下一次
     */
    public static function isKeyPressed(int $key): bool
    {
        return self::ffi()->IsKeyPressed($key);
    }

    /**
     * 检查按键是否被重复按下（支持重复触发）
     *
     * @param int $key 按键代码
     * @return bool 按键是否被重复按下
     */
    public static function isKeyPressedRepeat(int $key): bool
    {
        return self::ffi()->IsKeyPressedRepeat($key);
    }

    /**
     * 检查按键是否正被按住
     *
     * @param int $key 按键代码
     * @return bool 按键是否正在被按住
     */
    public static function isKeyDown(int $key): bool
    {
        return self::ffi()->IsKeyDown($key);
    }

    /**
     * 检查按键是否被释放一次
     *
     * @param int $key 按键代码
     * @return bool 按键是否被释放一次
     */
    public static function isKeyReleased(int $key): bool
    {
        return self::ffi()->IsKeyReleased($key);
    }

    /**
     * 检查按键是否未被按下
     *
     * @param int $key 按键代码
     * @return bool 按键是否未被按下
     */
    public static function isKeyUp(int $key): bool
    {
        return self::ffi()->IsKeyUp($key);
    }

    /**
     * 获取队列中的按下按键（键码），队列空时返回0
     *
     * @return int 按键代码或0（如果队列为空）
     */
    public static function getKeyPressed(): int
    {
        return self::ffi()->GetKeyPressed();
    }

    /**
     * 获取队列中的输入字符（Unicode），队列空时返回0
     *
     * @return int Unicode字符代码或0（如果队列为空）
     */
    public static function getCharPressed(): int
    {
        return self::ffi()->GetCharPressed();
    }

    /**
     * 设置自定义退出键（默认ESC）
     *
     * @param int $key 自定义退出按键代码
     * @return void
     */
    public static function setExitKey(int $key): void
    {
        self::ffi()->SetExitKey($key);
    }

    //### 游戏手柄输入相关函数

    /**
     * 检查指定索引的游戏手柄是否可用
     *
     * @param int $gamepad 游戏手柄索引
     * @return bool 游戏手柄是否可用
     */
    public static function isGamepadAvailable(int $gamepad): bool
    {
        return self::ffi()->IsGamepadAvailable($gamepad);
    }

    /**
     * 获取游戏手柄内部名称标识
     *
     * @param int $gamepad 游戏手柄索引
     * @return string 游戏手柄名称
     */
    public static function getGamepadName(int $gamepad): string
    {
        return (string)self::ffi()->GetGamepadName($gamepad);
    }

    /**
     * 检查游戏手柄按钮是否被按下一次
     *
     * @param int $gamepad 游戏手柄索引
     * @param int $button 按钮代码
     * @return bool 按钮是否被按下一次
     */
    public static function isGamepadButtonPressed(int $gamepad, int $button): bool
    {
        return self::ffi()->IsGamepadButtonPressed($gamepad, $button);
    }

    /**
     * 检查游戏手柄按钮是否正被按住
     *
     * @param int $gamepad 游戏手柄索引
     * @param int $button 按钮代码
     * @return bool 按钮是否正在被按住
     */
    public static function isGamepadButtonDown(int $gamepad, int $button): bool
    {
        return self::ffi()->IsGamepadButtonDown($gamepad, $button);
    }

    /**
     * 检查游戏手柄按钮是否被释放一次
     *
     * @param int $gamepad 游戏手柄索引
     * @param int $button 按钮代码
     * @return bool 按钮是否被释放一次
     */
    public static function isGamepadButtonReleased(int $gamepad, int $button): bool
    {
        return self::ffi()->IsGamepadButtonReleased($gamepad, $button);
    }

    /**
     * 检查游戏手柄按钮是否未被按下
     *
     * @param int $gamepad 游戏手柄索引
     * @param int $button 按钮代码
     * @return bool 按钮是否未被按下
     */
    public static function isGamepadButtonUp(int $gamepad, int $button): bool
    {
        return self::ffi()->IsGamepadButtonUp($gamepad, $button);
    }

    /**
     * 获取最后按下的游戏手柄按钮
     *
     * @return int 最后按下的按钮代码，无按键时返回0
     */
    public static function getGamepadButtonPressed(): int
    {
        return self::ffi()->GetGamepadButtonPressed();
    }

    /**
     * 获取游戏手柄的轴数量
     *
     * @param int $gamepad 游戏手柄索引
     * @return int 轴的数量
     */
    public static function getGamepadAxisCount(int $gamepad): int
    {
        return self::ffi()->GetGamepadAxisCount($gamepad);
    }

    /**
     * 获取游戏手柄轴的移动值（范围-1.0到1.0）
     *
     * @param int $gamepad 游戏手柄索引
     * @param int $axis 轴索引
     * @return float 移动值
     */
    public static function getGamepadAxisMovement(int $gamepad, int $axis): float
    {
        return self::ffi()->GetGamepadAxisMovement($gamepad, $axis);
    }

    /**
     * 设置自定义游戏手柄映射（SDL_GameControllerDB格式）
     *
     * @param string $mappings 映射字符串
     * @return int 成功加载的映射数
     */
    public static function setGamepadMappings(string $mappings): int
    {
        return self::ffi()->SetGamepadMappings($mappings);
    }

    /**
     * 设置游戏手柄震动（左右马达强度，持续秒数）
     *
     * @param int $gamepad 游戏手柄索引
     * @param float $leftMotor 左马达强度（0.0到1.0）
     * @param float $rightMotor 右马达强度（0.0到1.0）
     * @param float $duration 持续时间（秒）
     * @return void
     */
    public static function setGamepadVibration(int $gamepad, float $leftMotor, float $rightMotor, float $duration): void
    {
        self::ffi()->SetGamepadVibration($gamepad, $leftMotor, $rightMotor, $duration);
    }

    //### 鼠标输入相关函数

    /**
     * 检查鼠标按钮是否被按下一次
     *
     * @param int $button 按钮代码
     * @return bool 按钮是否被按下一次
     */
    public static function isMouseButtonPressed(int $button): bool
    {
        return self::ffi()->IsMouseButtonPressed($button);
    }

    /**
     * 检查鼠标按钮是否正被按住
     *
     * @param int $button 按钮代码
     * @return bool 按钮是否正在被按住
     */
    public static function isMouseButtonDown(int $button): bool
    {
        return self::ffi()->IsMouseButtonDown($button);
    }

    /**
     * 检查鼠标按钮是否被释放一次
     *
     * @param int $button 按钮代码
     * @return bool 按钮是否被释放一次
     */
    public static function isMouseButtonReleased(int $button): bool
    {
        return self::ffi()->IsMouseButtonReleased($button);
    }

    /**
     * 检查鼠标按钮是否未被按下
     *
     * @param int $button 按钮代码
     * @return bool 按钮是否未被按下
     */
    public static function isMouseButtonUp(int $button): bool
    {
        return self::ffi()->IsMouseButtonUp($button);
    }

    /**
     * 获取鼠标X坐标（屏幕坐标系）
     *
     * @return int X坐标
     */
    public static function getMouseX(): int
    {
        return self::ffi()->GetMouseX();
    }

    /**
     * 获取鼠标Y坐标（屏幕坐标系）
     *
     * @return int Y坐标
     */
    public static function getMouseY(): int
    {
        return self::ffi()->GetMouseY();
    }

    /**
     * 获取鼠标XY坐标（Vector2类型）
     *
     * @return Vector2 Vector2类型的坐标结构
     */
    public static function getMousePosition(): Vector2
    {
        $v2 = self::ffi()->GetMousePosition();
        return new Vector2($v2->x, $v2->y);
    }

    /**
     * 获取帧间鼠标移动增量
     *
     * @return Vector2 Vector2类型的增量结构
     */
    public static function getMouseDelta(): Vector2
    {
        $v2 = self::ffi()->GetMouseDelta();
        return new Vector2($v2->x, $v2->y);
    }

    /**
     * 设置鼠标位置（屏幕坐标系）
     *
     * @param int $x X坐标
     * @param int $y Y坐标
     * @return void
     */
    public static function setMousePosition(int $x, int $y): void
    {
        self::ffi()->SetMousePosition($x, $y);
    }

    /**
     * 设置鼠标坐标偏移量
     *
     * @param int $offsetX X轴偏移量
     * @param int $offsetY Y轴偏移量
     * @return void
     */
    public static function setMouseOffset(int $offsetX, int $offsetY): void
    {
        self::ffi()->SetMouseOffset($offsetX, $offsetY);
    }

    /**
     * 设置鼠标移动缩放比例
     *
     * @param float $scaleX X轴缩放比例
     * @param float $scaleY Y轴缩放比例
     * @return void
     */
    public static function setMouseScale(float $scaleX, float $scaleY): void
    {
        self::ffi()->SetMouseScale($scaleX, $scaleY);
    }

    /**
     * 获取鼠标滚轮垂直滚动量
     *
     * @return float 垂直滚动量
     */
    public static function getMouseWheelMove(): float
    {
        return self::ffi()->GetMouseWheelMove();
    }

    /**
     * 获取鼠标滚轮XY双向滚动量（Vector2类型）
     *
     * @return Vector2 Vector2类型的滚动量结构
     */
    public static function getMouseWheelMoveV(): Vector2
    {
        $v2 = self::ffi()->GetMouseWheelMoveV();
        return new Vector2($v2->x, $v2->y);
    }

    /**
     * 设置鼠标图标样式
     *
     * @param int $cursor 鼠标图标样式代码
     * @return void
     */
    public static function setMouseCursor(int $cursor): void
    {
        self::ffi()->SetMouseCursor($cursor);
    }

    //### 触摸输入相关函数

    /**
     * 获取触摸点0的X坐标（屏幕坐标系）
     *
     * @return int X坐标
     */
    public static function getTouchX(): int
    {
        return self::ffi()->GetTouchX();
    }

    /**
     * 获取触摸点0的Y坐标（屏幕坐标系）
     *
     * @return int Y坐标
     */
    public static function getTouchY(): int
    {
        return self::ffi()->GetTouchY();
    }

    /**
     * 获取指定索引触摸点的坐标
     *
     * @param int $index 触摸点索引
     * @return Vector2 Vector2类型的坐标结构
     */
    public static function getTouchPosition(int $index): Vector2
    {
        $v2 = self::ffi()->GetTouchPosition($index);
        return new Vector2($v2->x, $v2->y);
    }

    /**
     * 获取指定索引触摸点的唯一ID
     *
     * @param int $index 触摸点索引
     * @return int 唯一ID
     */
    public static function getTouchPointId(int $index): int
    {
        return self::ffi()->GetTouchPointId($index);
    }

    /**
     * 获取当前活跃触摸点数量
     *
     * @return int 活跃触摸点数量
     */
    public static function getTouchPointCount(): int
    {
        return self::ffi()->GetTouchPointCount();
    }

    //### 手势识别函数（模块：rgestures）

    /**
     * 启用指定类型的手势检测（按位标志组合）
     *
     * @param int $flags 手势标志组合
     * @return void
     */
    public static function setGesturesEnabled(int $flags): void
    {
        self::ffi()->SetGesturesEnabled($flags);
    }

    /**
     * 检查特定手势是否被检测到
     *
     * @param int $gesture 手势代码
     * @return bool 手势是否被检测到
     */
    public static function isGestureDetected(int $gesture): bool
    {
        return self::ffi()->IsGestureDetected($gesture);
    }

    /**
     * 获取最新检测到的手势类型
     *
     * @return int 最新检测到的手势类型
     */
    public static function getGestureDetected(): int
    {
        return self::ffi()->GetGestureDetected();
    }

    /**
     * 获取长按手势的持续时间（秒）
     *
     * @return float 长按手势的持续时间
     */
    public static function getGestureHoldDuration(): float
    {
        return self::ffi()->GetGestureHoldDuration();
    }

    /**
     * 获取拖拽手势的移动向量
     *
     * @return Vector2 Vector2类型的移动向量结构
     */
    public static function getGestureDragVector(): Vector2
    {
        $v2 = self::ffi()->GetGestureDragVector();
        return new Vector2($v2->x, $v2->y);
    }

    /**
     * 获取拖拽手势的移动角度（弧度）
     *
     * @return float 移动角度（弧度）
     */
    public static function getGestureDragAngle(): float
    {
        return self::ffi()->GetGestureDragAngle();
    }

    /**
     * 获取捏合手势的缩放向量（手指间距变化）
     *
     * @return Vector2 Vector2类型的缩放向量结构
     */
    public static function getGesturePinchVector(): Vector2
    {
        $v2 = self::ffi()->GetGesturePinchVector();
        return new Vector2($v2->x, $v2->y);
    }

    /**
     * 获取捏合手势的旋转角度（弧度）
     *
     * @return float 旋转角度（弧度）
     */
    public static function getGesturePinchAngle(): float
    {
        return self::ffi()->GetGesturePinchAngle();
    }

    //### 相机系统函数（模块：rcamera）

    /**
     * 根据选定模式更新相机位置（第一人称/第三人称等）
     *
     * @param Camera3D $camera 相机对象指针
     * @param int $mode 更新模式
     * @return void
     */
    public static function updateCamera(Camera3D $camera, int $mode): void
    {
        $c_camera = self::ffi()::addr($camera->struct());
        self::ffi()->UpdateCamera($c_camera, $mode);
    }

    /**
     * 高级相机控制（自定义移动/旋转/缩放）
     *
     * @param Camera3D $camera 相机对象指针
     * @param Vector3 $movement 移动向量（Vector3类型）
     * @param Vector3 $rotation 旋转向量（Vector3类型）
     * @param float $zoom 缩放值
     * @return void
     */
    public static function updateCameraPro(Camera3D &$camera, Vector3 $movement, Vector3 $rotation, float $zoom): void
    {
        $c_camera = self::ffi()->cast("struct Camera3D *", $camera->struct());
        self::ffi()->UpdateCameraPro(
            $c_camera,
            $movement->struct(),
            $rotation->struct(),
            $zoom
        );
        $camera->position = new Vector3(
            $c_camera[0]->position->x,
            $c_camera[0]->position->y,
            $c_camera[0]->position->z
        );
        $camera->target = new Vector3(
            $c_camera[0]->target->x,
            $c_camera[0]->target->y,
            $c_camera[0]->target->z
        );
        $camera->up = new Vector3(
            $c_camera[0]->up->x,
            $c_camera[0]->up->y,
            $c_camera[0]->up->z
        );
        $camera->fovy = $c_camera[0]->fovy;
        $camera->projection = $c_camera[0]->projection == 1;
    }
}
