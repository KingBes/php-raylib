<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib;

/**
 * 窗口标志
 * 
 * @property int VsyncHint 尝试在GPU上启用垂直同步 64 
 * @property int FullscreenMode 窗口全屏模式 2
 * @property int Resizable 可调整大小窗口 4 
 * @property int Undecorated 无装饰窗口 8
 * @property int Hidden 隐藏窗口 128
 * @property int Minimized 最小化窗口（图标化） 512
 * @property int Maximized 最大化窗口（扩展到监视器） 1024
 * @property int Unfocused 窗口非聚焦状态 2048
 * @property int AlwaysOnTop 窗口总在顶部 4096
 * @property int AlwaysRun 允许窗口在最小化时继续运行 256 
 * @property int Transparent 透明窗口 16
 * @property int HighDpi 支持高分辨率显示 8192
 * @property int MousePassthrough 支持鼠标穿透，仅在 8 启用时有效 16384
 * @property int BorderlessWindow 无边框窗口模式 32768
 * @property int Msaa4xHint 尝试启用4倍多重采样抗锯齿（MSAA） 32
 * @property int InterlacedHint 尝试启用隔行视频格式（适用于V3D） 65536
 */
enum WindowFlags: int
{
    case VsyncHint = 64;
    case FullscreenMode = 2;
    case Resizable = 4;
    case Undecorated = 8;
    case Hidden = 128;
    case Minimized = 512;
    case Maximized = 1024;
    case Unfocused = 2048;
    case AlwaysOnTop = 4096;
    case AlwaysRun = 256;
    case Transparent = 16;
    case HighDpi = 8192;
    case MousePassthrough = 16384;
    case BorderlessWindow = 32768;
    case Msaa4xHint = 32;
    case InterlacedHint = 65536;
}
