<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib;

/**
 * 键盘按键
 * 
 * @property int None 无按键（NULL） 0
 * @property int SingleQuote 单引号键 (') 39
 * @property int Comma 逗号键 (,) 44
 * @property int Minus 减号键 (-) 45
 * @property int Period 句号键 (.) 46
 * @property int Slash 斜杠键 (/) 47
 * @property int Zero 数字0键 (0) 48
 * @property int One 数字1键 (1) 49
 * @property int Two 数字2键 (2) 50
 * @property int Three 数字3键 (3) 51
 * @property int Four 数字4键 (4) 52
 * @property int Five 数字5键 (5) 53
 * @property int Six 数字6键 (6) 54
 * @property int Seven 数字7键 (7) 55
 * @property int Eight 数字8键 (8) 56
 * @property int Nine 数字9键 (9) 57
 * @property int Semicolon 分号键 (;) 59
 * @property int Equal 等号键 (=) 61
 * @property int A 字母键 A | a 65
 * @property int B 字母键 B | b 66
 * @property int C 字母键 C | c 67
 * @property int D 字母键 D | d 68
 * @property int E 字母键 E | e 69
 * @property int F 字母键 F | f 70
 * @property int G 字母键 G | g 71
 * @property int H 字母键 H | h 72
 * @property int I 字母键 I | i 73
 * @property int J 字母键 J | j 74
 * @property int K 字母键 K | k 75
 * @property int L 字母键 L | l 76
 * @property int M 字母键 M | m 77
 * @property int N 字母键 N | n 78
 * @property int O 字母键 O | o 79
 * @property int P 字母键 P | p 80
 * @property int Q 字母键 Q | q 81
 * @property int R 字母键 R | r 82
 * @property int S 字母键 S | s 83
 * @property int T 字母键 T | t 84
 * @property int U 字母键 U | u 85
 * @property int V 字母键 V | v 86
 * @property int W 字母键 W | w 87
 * @property int X 字母键 X | x 88
 * @property int Y 字母键 Y | y 89
 * @property int Z 字母键 Z | z 90
 * @property int LeftBracket 左方括号键 ([) 91
 * @property int Backslash 反斜杠键 (\) 92
 * @property int RightBracket 右方括号键 (]) 93
 * @property int GraveAccent 重音键 (`) 96
 * @property int Space 空格键 (Space) 32
 * @property int Esc 键 (Esc) 256
 * @property int Enter 回车键 (Enter) 257
 * @property int Tab 键 (Tab) 258
 * @property int Backspace 退格键 (Backspace) 259
 * @property int Insert 插入键 (Insert) 260
 * @property int Delete 删除键 (Delete) 261
 * @property int Right 方向键 右 (Right) 262
 * @property int Left 方向键 左 (Left) 263
 * @property int Down 方向键 下 (Down) 264
 * @property int Up 方向键 上 (Up) 265
 * @property int PageUp 页面上键 (Page Up) 266
 * @property int PageDown 页面下键 (Page Down) 267
 * @property int Home 首页键 (Home) 268
 * @property int End 尾页键 (End) 269
 * @property int CapsLock 大写锁定键 (Caps Lock) 280
 * @property int NumLock 数字锁定键 (Num Lock) 281
 * @property int ScrollLock 滚动锁定键 (Scroll Lock) 282
 * @property int PrintScreen 打印屏幕键 (Print Screen) 283
 * @property int Pause 暂停键 (Pause) 284
 * @property int F1 键 (F1) 290
 * @property int F2 键 (F2) 291
 * @property int F3 键 (F3) 292
 * @property int F4 键 (F4) 293
 * @property int F5 键 (F5) 294
 * @property int F6 键 (F6) 295
 * @property int F7 键 (F7) 296
 * @property int F8 键 (F8) 297
 * @property int F9 键 (F9) 298
 * @property int F10 键 (F10) 299
 * @property int F11 键 (F11) 300
 * @property int F12 键 (F12) 301
 * @property int LeftShift 左 Shift 键 (Left Shift) 340
 * @property int LeftControl 左 Control 键 (Left Control) 341
 * @property int LeftAlt 左 Alt 键 (Left Alt) 342
 * @property int LeftSuper 左 Super 键 (Left Super) 343
 * @property int RightShift 右 Shift 键 (Right Shift) 344
 * @property int RightControl 右 Control 键 (Right Control) 345
 * @property int RightAlt 右 Alt 键 (Right Alt) 346
 * @property int RightSuper 右 Super 键 (Right Super) 347
 * @property int KBMenu 键盘菜单键 (KB Menu) 348
 * @property int KBPad0 小键盘 0 键 (KB Pad 0) 320
 * @property int KBPad1 小键盘 1 键 (KB Pad 1) 321
 * @property int KBPad2 小键盘 2 键 (KB Pad 2) 322
 * @property int KBPad3 小键盘 3 键 (KB Pad 3) 323
 * @property int KBPad4 小键盘 4 键 (KB Pad 4) 324
 * @property int KBPad5 小键盘 5 键 (KB Pad 5) 325
 * @property int KBPad6 小键盘 6 键 (KB Pad 6) 326
 * @property int KBPad7 小键盘 7 键 (KB Pad 7) 327
 * @property int KBPad8 小键盘 8 键 (KB Pad 8) 328
 * @property int KBPad9 小键盘 9 键 (KB Pad 9) 329
 * @property int KBPadDecimal 小键盘 小数点键 (Keypad .) 330
 * @property int KBPadDivide 小键盘 除号键 (Keypad /) 331
 * @property int KBPadMultiply 小键盘 乘号键 (Keypad *) 332
 * @property int KBPadSubtract 小键盘 减号键 (Keypad -) 333
 * @property int KBPadAdd 小键盘 加号键 (Keypad +) 334
 * @property int KBPadEnter 小键盘 回车键 (Keypad Enter) 335
 * @property int KBPadEqual 小键盘 等号键 (Keypad =) 336
 * @property int AndroidBack 安卓返回按钮 4
 * @property int AndroidMenu 安卓菜单按钮 5
 * @property int AndroidVolumeUp 安卓音量上按钮 24
 * @property int AndroidVolumeDown 安卓音量下按钮 25
 */
enum KeyBoard: int
{
    case None = 0;
    case SingleQuote = 39;
    case Comma = 44; 
    case Minus = 45;
    case Period = 46;
    case Slash = 47;
    case Zero = 48;
    case One = 49;
    case Two = 50;
    case Three = 51;
    case Four = 52;
    case Five = 53;
    case Six = 54;
    case Seven = 55;
    case Eight = 56;
    case Nine = 57;
    case Semicolon = 59;
    case Equal = 61;
    case A = 65;
    case B = 66;
    case C = 67;
    case D = 68;
    case E = 69;
    case F = 70;
    case G = 71;
    case H = 72;
    case I = 73;
    case J = 74;
    case K = 75;
    case L = 76;
    case M = 77;
    case N = 78;
    case O = 79;
    case P = 80;
    case Q = 81;
    case R = 82;
    case S = 83;
    case T = 84;
    case U = 85;
    case V = 86;
    case W = 87;
    case X = 88;
    case Y = 89;
    case Z = 90;
    case LeftBracket = 91;
    case Backslash = 92;
    case RightBracket = 93;
    case GraveAccent = 96;
    case Space = 32;
    case Esc = 256;
    case Enter = 257;
    case Tab = 258;
    case Backspace = 259;
    case Insert = 260;
    case Delete = 261;
    case Right = 262;
    case Left = 263;
    case Down = 264;
    case Up = 265;
    case PageUp = 266;
    case PageDown = 267;
    case Home = 268;
    case End = 269;
    case CapsLock = 280;
    case NumLock = 281;
    case ScrollLock = 282;
    case PrintScreen = 283;
    case Pause = 284;
    case F1 = 290;
    case F2 = 291;
    case F3 = 292;
    case F4 = 293;
    case F5 = 294;
    case F6 = 295;
    case F7 = 296;
    case F8 = 297;
    case F9 = 298;
    case F10 = 299;
    case F11 = 300;
    case F12 = 301;
    case LeftShift = 340;
    case LeftControl = 341;
    case LeftAlt = 342;
    case LeftSuper = 343;
    case RightShift = 344;
    case RightControl = 345;
    case RightAlt = 346;
    case RightSuper = 347;
    case KBMenu = 348;
    case KBPad0 = 320;
    case KBPad1 = 321;
    case KBPad2 = 322;
    case KBPad3 = 323;
    case KBPad4 = 324;
    case KBPad5 = 325;
    case KBPad6 = 326;
    case KBPad7 = 327;
    case KBPad8 = 328;
    case KBPad9 = 329;
    case KBPadDecimal = 330;
    case KBPadDivide = 331;
    case KBPadMultiply = 332;
    case KBPadSubtract = 333;
    case KBPadAdd = 334;
    case KBPadEnter = 335;
    case KBPadEqual = 336;
    case AndroidBack = 4;
    case AndroidMenu = 5;
    case AndroidVolumeUp = 24;
    case AndroidVolumeDown = 25;
}
