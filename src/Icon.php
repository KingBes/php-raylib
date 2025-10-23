<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib;

/**
 * 图标枚举类
 * 
 * 此类定义了Raylib库中所有可用的图标常量，用于GUI元素和界面组件
 * 每个图标都有对应的整数值，可以在绘制GUI时使用
 * 
 * @property int None 无图标 0
 * @property int FolderFileOpen 文件夹文件打开图标 1
 * @property int FileSaveClassic 文件保存经典图标 2
 * @property int FolderOpen 文件夹打开图标 3
 * @property int FolderSave 文件夹保存图标 4
 * @property int FileOpen 文件打开图标 5
 * @property int FileSave 文件保存图标 6
 * @property int FileExport 文件导出图标 7
 * @property int FileAdd 文件添加图标 8
 * @property int FileDelete 文件删除图标 9
 * @property int FileTypeText 文件文本图标 10
 * @property int FileTypeAudio 文件音频图标 11
 * @property int FileTypeImage 文件图片图标 12
 * @property int FileTypePlay 文件播放图标 13
 * @property int FileTypeVideo 文件视频图标 14
 * @property int FileTypeInfo 文件信息图标 15
 * @property int FileCopy 文件复制图标 16
 * @property int FileCut 文件剪切图标 17
 * @property int FilePaste 文件粘贴图标 18
 * @property int CursorHand 鼠标手图标 19
 * @property int CursorPointer 鼠标指针图标 20
 * @property int CursorClassic 鼠标经典图标 21
 * @property int Pencil 铅笔图标 22
 * @property int PencilBig 大铅笔图标 23
 * @property int BrushClassic 经典画笔图标 24
 * @property int BrushPainter 画笔图标 25
 * @property int WaterDrop 水滴图标 26
 * @property int ColorPicker 颜色选择器图标 27
 * @property int Rubber 橡皮图标 28
 * @property int ColorBucket 颜色桶图标 29
 * @property int TextT 文本T图标 30
 * @property int TextA 文本A图标 31
 * @property int Scale 缩放图标 32
 * @property int Resize 调整大小图标 33
 * @property int FilterPoint 点过滤图标 34
 * @property int FilterBilinear 双线性过滤图标 35
 * @property int Crop 裁剪图标 36
 * @property int CropAlpha 裁剪Alpha图标 37
 * @property int SquareToggle 方形切换图标 38
 * @property int Symmetry 对称图标 39
 * @property int SymmetryHorizontal 水平对称图标 40
 * @property int SymmetryVertical 垂直对称图标 41
 * @property int Lens 镜头图标 42
 * @property int LensBig 大镜头图标 43
 * @property int EyeOn 眼睛开启图标 44
 * @property int EyeOff 眼睛关闭图标 45
 * @property int FilterTop 顶部过滤图标 46
 * @property int Filter 过滤图标 47
 * @property int TargetPoint 目标点图标 48
 * @property int TargetSmall 目标小图标 49
 * @property int TargetBig 目标大图标 50
 * @property int TargetMove 目标移动图标 51
 * @property int CursorMove 光标移动图标 52
 * @property int CursorScale 光标缩放图标 53
 * @property int CursorScaleRight 光标缩放右图标 54
 * @property int CursorScaleLeft 光标缩放左图标 55
 * @property int Undo 撤销图标 56
 * @property int Redo 重做图标 57
 * @property int Reredo 重新重做图标 58
 * @property int Mutate 变异图标 59
 * @property int Rotate 旋转图标 60
 * @property int Repeat 重复图标 61
 * @property int Shuffle 洗牌图标 62
 * @property int EmptyBox 空框图标 63
 * @property int Target 目标图标 64
 * @property int TargetSmallFill 目标小填充图标 65
 * @property int TargetBigFill 目标大填充图标 66
 * @property int TargetMoveFill 目标移动填充图标 67
 * @property int CursorMoveFill 光标移动填充图标 68
 * @property int CursorScaleFill 光标缩放填充图标 69
 * @property int CursorScaleRightFill 光标缩放右填充图标 70
 * @property int CursorScaleLeftFill 光标缩放左填充图标 71
 * @property int UndoFill 撤销填充图标 72
 * @property int RedoFill 重做填充图标 73
 * @property int ReredoFill 重新重做填充图标 74
 * @property int MutateFill 变异填充图标 75
 * @property int RotateFill 旋转填充图标 76
 * @property int RepeatFill 重复填充图标 77
 * @property int ShuffleFill 洗牌填充图标 78
 * @property int EmptyBoxFill 空框填充图标 79
 * @property int Box 框图标 80
 * @property int BoxTop 顶部框图标 81
 * @property int BoxTopRight 顶部右框图标 82
 * @property int BoxRight 右框图标 83
 * @property int BoxBottomRight 底部右框图标 84
 * @property int BoxBottom 底部框图标 85
 * @property int BoxBottomLeft 底部左框图标 86
 * @property int BoxLeft 左框图标 87
 * @property int BoxTopLeft 顶部左框图标 88
 * @property int BoxCenter 中心框图标 89
 * @property int BoxCircleMask 圆形框图标 90
 * @property int Pot 锅图标 91
 * @property int AlphaMultiply 透明度乘法图标 92
 * @property int AlphaClear 透明度清除图标 93
 * @property int Dithering 抖动图标 94
 * @property int Mipmaps 贴图图标 95
 * @property int BoxGrid 框网格图标 96
 * @property int Grid 网格图标 97
 * @property int BoxCornersSmall 小框角图标 98
 * @property int BoxCornersBig 大框角图标 99
 * @property int FourBoxes 四框图标 100
 * @property int GridFill 网格填充图标 101
 * @property int BoxMultisize 多框图标 102
 * @property int ZoomSmall 小缩放图标 103
 * @property int ZoomMedium 中缩放图标 104
 * @property int ZoomBig 大缩放图标 105
 * @property int ZoomAll 全部缩放图标 106
 * @property int ZoomCenter 中心缩放图标 107
 * @property int BoxDotsSmall 小框点图标 108
 * @property int BoxDotsBig 大框点图标 109
 * @property int BoxConcentric 同心圆框图标 110
 * @property int BoxGridBig 大框网格图标 111
 * @property int OkTick 确认勾选图标 112
 * @property int Cross 交叉图标 113
 * @property int ArrowLeft 左箭头图标 114
 * @property int ArrowRight 右箭头图标 115
 * @property int ArrowDown 下箭头图标 116
 * @property int ArrowUp 上箭头图标 117
 * @property int ArrowLeftFill 左箭头填充图标 118
 * @property int ArrowRightFill 右箭头填充图标 119
 * @property int ArrowDownFill 下箭头填充图标 120
 * @property int ArrowUpFill 上箭头填充图标 121
 * @property int Audio 音频图标 122
 * @property int Fx 音效图标 123
 * @property int Wave 波形图标 124
 * @property int WaveSinus 正弦波图标 125
 * @property int WaveSquare 方波图标 126
 * @property int WaveTriangular 三角波图标 127
 * @property int CrossSmall 小交叉图标 128
 * @property int PlayerPrevious 播放器上一曲图标 129
 * @property int PlayerPlayBack 播放器回放图标 130
 * @property int PlayerPlay 播放器播放图标 131
 * @property int PlayerPause 播放器暂停图标 132
 * @property int PlayerStop 播放器停止图标 133
 * @property int PlayerNext 播放器下一曲图标 134
 * @property int PlayerRecord 播放器录制图标 135
 * @property int Magnet 磁铁图标 136
 * @property int LockClose 锁关闭图标 137
 * @property int LockOpen 锁打开图标 138
 * @property int Clock 时钟图标 139
 * @property int Tools 工具图标 140
 * @property int Gear 齿轮图标 141
 * @property int GearBig 大齿轮图标 142
 * @property int Bin 垃圾桶图标 143
 * @property int HandPointer 手指指针图标 144
 * @property int Laser 激光图标 145
 * @property int Coin 硬币图标 146
 * @property int Explosion 爆炸图标 147
 * @property int OneUp 加分图标 148
 * @property int Player 玩家图标 149
 * @property int PlayerJump 玩家跳跃图标 150
 * @property int Key 钥匙图标 151
 * @property int Demon 恶魔图标 152
 * @property int TextPopup 文本弹窗图标 153
 * @property int GearEx 扩展齿轮图标 154
 * @property int Crack 裂缝图标 155
 * @property int CrackPoints 裂缝点图标 156
 * @property int Star 星星图标 157
 * @property int Door 门图标 158
 * @property int Exit 出口图标 159
 * @property int Mode2D 2D模式图标 160
 * @property int Mode3D 3D模式图标 161
 * @property int Cube 立方体图标 162
 * @property int CubeFaceTop 立方体顶面图标 163
 * @property int CubeFaceLeft 立方体左面图标 164
 * @property int CubeFaceFront 立方体正面图标 165
 * @property int CubeFaceBottom 立方体底面图标 166
 * @property int CubeFaceRight 立方体右面图标 167
 * @property int CubeFaceBack 立方体背面图标 168
 * @property int Camera 相机图标 169
 * @property int Special 特殊图标 170
 * @property int LinkNet 网络链接图标 171
 * @property int LinkBoxes 盒子链接图标 172
 * @property int LinkMulti 多链接图标 173
 * @property int Link 链接图标 174
 * @property int LinkBroke 断开链接图标 175
 * @property int TextNotes 文本笔记图标 176
 * @property int Notebook 笔记本图标 177
 * @property int Suitcase 手提箱图标 178
 * @property int SuitcaseZip 带拉链手提箱图标 179
 * @property int Mailbox 邮箱图标 180
 * @property int Monitor 显示器图标 181
 * @property int Printer 打印机图标 182
 * @property int PhotoCamera 照相机图标 183
 * @property int PhotoCameraFlash 带闪光灯照相机图标 184
 * @property int House 房子图标 185
 * @property int Heart 爱心图标 186
 * @property int Corner 角落图标 187
 * @property int VerticalBars 竖条图标 188
 * @property int VerticalBarsFill 填充竖条图标 189
 * @property int LifeBars 生命条图标 190
 * @property int Info 信息图标 191
 * @property int Crossline 十字线图标 192
 * @property int Help 帮助图标 193
 * @property int FiletypeAlpha Alpha文件类型图标 194
 * @property int FiletypeHome 主页文件类型图标 195
 * @property int LayersVisible 可见图层图标 196
 * @property int Layers 图层图标 197
 * @property int Window 窗口图标 198
 * @property int Hidpi 高DPI图标 199
 * @property int FiletypeBinary 二进制文件类型图标 200
 * @property int Hex 十六进制图标 201
 * @property int Shield 盾牌图标 202
 * @property int FileNew 新建文件图标 203
 * @property int FolderAdd 新建文件夹图标 204
 * @property int Alarm 闹钟图标 205
 * @property int Cpu CPU图标 206
 * @property int Rom ROM图标 207
 * @property int StepOver 单步跳过图标 208
 * @property int StepInto 单步进入图标 209
 * @property int StepOut 单步跳出图标 210
 * @property int Restart 重启图标 211
 * @property int BreakpointOn 断点开启图标 212
 * @property int BreakpointOff 断点关闭图标 213
 * @property int BurgerMenu 汉堡菜单图标 214
 * @property int CaseSensitive 大小写敏感图标 215
 * @property int RegExp 正则表达式图标 216
 * @property int Folder 文件夹图标 217
 * @property int File 文件图标 218
 * @property int SandTimer 沙漏图标 219
 * @property int Warning 警告图标 220
 * @property int HelpBox 帮助框图标 221
 * @property int InfoBox 信息框图标 222
 * @property int Priority 优先级图标 223
 * @property int LayersIso 等距图层图标 224
 * @property int Layers2 图层2图标 225
 * @property int Mlayers 多层图标 226
 * @property int Maps 地图图标 227
 * @property int Hot 热门图标 228
 * @property int Label 标签图标 229
 * @property int NameId 名称ID图标 230
 * @property int IconSlicing 图标切片图标 231
 * @property int IconManualControl 图标手动控制图标 232
 * @property int IconCollision 图标碰撞图标 233
 * @property int Icon234 未分类图标234 234
 * @property int Icon235 未分类图标235 235
 * @property int Icon236 未分类图标236 236
 * @property int Icon237 未分类图标237 237
 * @property int Icon238 未分类图标238 238
 * @property int Icon239 未分类图标239 239
 * @property int Icon240 未分类图标240 240
 * @property int Icon241 未分类图标241 241
 * @property int Icon242 未分类图标242 242
 * @property int Icon243 未分类图标243 243
 * @property int Icon244 未分类图标244 244
 * @property int Icon245 未分类图标245 245
 * @property int Icon246 未分类图标246 246
 * @property int Icon247 未分类图标247 247
 * @property int Icon248 未分类图标248 248
 * @property int Icon249 未分类图标249 249
 * @property int Icon250 未分类图标250 250
 * @property int Icon251 未分类图标251 251
 * @property int Icon252 未分类图标252 252
 * @property int Icon253 未分类图标253 253
 * @property int Icon254 未分类图标254 254
 * @property int Icon255 未分类图标255 255
 */
enum Icon: int
{
    // ========== 文件操作图标 ==========
    case None = 0;
    case FolderFileOpen = 1;
    case FileSaveClassic = 2;
    case FolderOpen = 3;
    case FolderSave = 4;
    case FileOpen = 5;
    case FileSave = 6;
    case FileExport = 7;
    case FileAdd = 8;
    case FileDelete = 9;
    case FileTypeText = 10;
    case FileTypeAudio = 11;
    case FileTypeImage = 12;
    case FileTypePlay = 13;
    case FileTypeVideo = 14;
    case FileTypeInfo = 15;
    case FileCopy = 16;
    case FileCut = 17;
    case FilePaste = 18;

    // ========== 光标图标 ==========
    case CursorHand = 19;
    case CursorPointer = 20;
    case CursorClassic = 21;

    // ========== 绘图工具图标 ==========
    case Pencil = 22;
    case PencilBig = 23;
    case BrushClassic = 24;
    case BrushPainter = 25;
    case WaterDrop = 26;
    case ColorPicker = 27;
    case Rubber = 28;
    case ColorBucket = 29;
    case TextT = 30;
    case TextA = 31;
    case Scale = 32;
    case Resize = 33;
    case FilterPoint = 34;
    case FilterBilinear = 35;
    case Crop = 36;
    case CropAlpha = 37;
    case SquareToggle = 38;
    case Symmetry = 39;
    case SymmetryHorizontal = 40;
    case SymmetryVertical = 41;
    case Lens = 42;
    case LensBig = 43;
    case EyeOn = 44;
    case EyeOff = 45;
    case FilterTop = 46;
    case Filter = 47;

    // ========== 目标和光标工具图标 ==========
    case TargetPoint = 48;
    case TargetSmall = 49;
    case TargetBig = 50;
    case TargetMove = 51;
    case CursorMove = 52;
    case CursorScale = 53;
    case CursorScaleRight = 54;
    case CursorScaleLeft = 55;
    case Undo = 56;
    case Redo = 57;
    case Reredo = 58;
    case Mutate = 59;
    case Rotate = 60;
    case Repeat = 61;
    case Shuffle = 62;
    case EmptyBox = 63;
    
    // ========== 填充版本图标 ==========
    case Target = 64;
    case TargetSmallFill = 65;
    case TargetBigFill = 66;
    case TargetMoveFill = 67;
    case CursorMoveFill = 68;
    case CursorScaleFill = 69;
    case CursorScaleRightFill = 70;
    case CursorScaleLeftFill = 71;
    case UndoFill = 72;
    case RedoFill = 73;
    case ReredoFill = 74;
    case MutateFill = 75;
    case RotateFill = 76;
    case RepeatFill = 77;
    case ShuffleFill = 78;
    case EmptyBoxSmall = 79;
    
    // ========== 盒子和网格图标 ==========
    case Box = 80;
    case BoxTop = 81;
    case BoxTopRight = 82;
    case BoxRight = 83;
    case BoxBottomRight = 84;
    case BoxBottom = 85;
    case BoxBottomLeft = 86;
    case BoxLeft = 87;
    case BoxTopLeft = 88;
    case BoxCenter = 89;
    case BoxCircleMask = 90;
    case Pot = 91;
    case AlphaMultiply = 92;
    case AlphaClear = 93;
    case Dithering = 94;
    case Mipmaps = 95;
    case BoxGrid = 96;
    case Grid = 97;
    case BoxCornersSmall = 98;
    case BoxCornersBig = 99;
    case FourBoxes = 100;
    case GridFill = 101;
    case BoxMultisize = 102;
    
    // ========== 缩放图标 ==========
    case ZoomSmall = 103;
    case ZoomMedium = 104;
    case ZoomBig = 105;
    case ZoomAll = 106;
    case ZoomCenter = 107;
    case BoxDotsSmall = 108;
    case BoxDotsBig = 109;
    case BoxConcentric = 110;
    case BoxGridBig = 111;
    
    // ========== 基本UI图标 ==========
    case OkTick = 112;
    case Cross = 113;
    
    // ========== 箭头图标 ==========
    case ArrowLeft = 114;
    case ArrowRight = 115;
    case ArrowDown = 116;
    case ArrowUp = 117;
    case ArrowLeftFill = 118;
    case ArrowRightFill = 119;
    case ArrowDownFill = 120;
    case ArrowUpFill = 121;
    
    // ========== 音频图标 ==========
    case Audio = 122;
    case Fx = 123;
    case Wave = 124;
    case WaveSinus = 125;
    case WaveSquare = 126;
    case WaveTriangular = 127;
    case CrossSmall = 128;
    
    // ========== 播放器控制图标 ==========
    case PlayerPrevious = 129;
    case PlayerPlayBack = 130;
    case PlayerPlay = 131;
    case PlayerPause = 132;
    case PlayerStop = 133;
    case PlayerNext = 134;
    case PlayerRecord = 135;
    
    // ========== 工具和物品图标 ==========
    case Magnet = 136;
    case LockClose = 137;
    case LockOpen = 138;
    case Clock = 139;
    case Tools = 140;
    case Gear = 141;
    case GearBig = 142;
    case Bin = 143;
    case HandPointer = 144;
    case Laser = 145;
    case Coin = 146;
    case Explosion = 147;
    case OneUp = 148;
    case Player = 149;
    case PlayerJump = 150;
    case Key = 151;
    case Demon = 152;
    case TextPopup = 153;
    case GearEx = 154;
    case Crack = 155;
    case CrackPoints = 156;
    case Star = 157;
    case Door = 158;
    case Exit = 159;
    
    // ========== 3D相关图标 ==========
    case Mode2D = 160;
    case Mode3D = 161;
    case Cube = 162;
    case CubeFaceTop = 163;
    case CubeFaceLeft = 164;
    case CubeFaceFront = 165;
    case CubeFaceBottom = 166;
    case CubeFaceRight = 167;
    case CubeFaceBack = 168;
    case Camera = 169;
    case Special = 170;
    
    // ========== 链接图标 ==========
    case LinkNet = 171;
    case LinkBoxes = 172;   
    case LinkMulti = 173;
    case Link = 174;
    case LinkBroke = 175;
    
    // ========== 文档和设备图标 ==========
    case TextNotes = 176;
    case Notebook = 177;
    case Suitcase = 178;
    case SuitcaseZip = 179;
    case Mailbox = 180;
    case Monitor = 181;
    case Printer = 182;
    case PhotoCamera = 183;
    case PhotoCameraFlash = 184;
    case House = 185;
    case Heart = 186;
    case Corner = 187;
    case VerticalBars = 188;
    case VerticalBarsFill = 189;
    case LifeBars = 190;
    case Info = 191;
    case Crossline = 192;
    case Help = 193;
    case FiletypeAlpha = 194;
    case FiletypeHome = 195;
    case LayersVisible = 196;
    case Layers = 197;
    case Window = 198;
    case Hidpi = 199;
    case FiletypeBinary = 200;
    case Hex = 201;
    case Shield = 202;
    case FileNew = 203;
    case FolderAdd = 204;
    case Alarm = 205;
    case Cpu = 206;
    case Rom = 207;
    
    // ========== 调试图标 ==========
    case StepOver = 208;
    case StepInto = 209;
    case StepOut = 210;
    case Restart = 211;
    case BreakpointOn = 212;
    case BreakpointOff = 213;
    
    // ========== 其他UI图标 ==========
    case BurgerMenu = 214;
    case CaseSensitive = 215;
    case RegExp = 216;
    case Folder = 217;
    case File = 218;
    case SandTimer = 219;
    case Warning = 220;
    case HelpBox = 221;
    case InfoBox = 222;
    case Priority = 223;
    case LayersIso = 224;
    case Layers2 = 225;
    case Mlayers = 226;
    case Maps = 227;
    case Hot = 228;
    case Label = 229;
    case NameId = 230;
    case IconSlicing = 231;
    case IconManualControl = 232;
    case IconCollision = 233;
    
    // ========== 未分类图标 ==========
    case Icon234 = 234;
    case Icon235 = 235;
    case Icon236 = 236;
    case Icon237 = 237;
    case Icon238 = 238;
    case Icon239 = 239;
    case Icon240 = 240;
    case Icon241 = 241;
    case Icon242 = 242;
    case Icon243 = 243;
    case Icon244 = 244;
    case Icon245 = 245;
    case Icon246 = 246;
    case Icon247 = 247;
    case Icon248 = 248;
    case Icon249 = 249;
    case Icon250 = 250;
    case Icon251 = 251;
    case Icon252 = 252;
    case Icon253 = 253;
    case Icon254 = 254;
    case Icon255 = 255;
}