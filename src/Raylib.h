// 彩色，4分量，R8G8B8A8 （32bit）
typedef struct Color {
    unsigned char r;        // Color red value
    unsigned char g;        // Color green value
    unsigned char b;        // Color blue value
    unsigned char a;        // Color alpha value
} Color;

// ------窗口相关函数-------------------------------------

/**
 * @brief 初始化窗口和OpenGL上下文
 * 
 * @param width int 窗口宽度
 * @param height int 窗口高度
 * @param title const char* 窗口标题
 * @return void
 */
void InitWindow(int width, int height, const char *title);

/**
 * @brief 关闭窗口并卸载OpenGL上下文
 * 
 * @return void
 */
void CloseWindow();

/**
 * @brief 检查应用程序是否应该关闭（按下ESC键或点击窗口关闭图标）
 *
 * @return bool
 */
bool WindowShouldClose();

/**
 * 切换窗口状态：无边框窗口模式，调整窗口以匹配显示器分辨率
 * 
 * @return void
 */
void ToggleBorderlessWindowed();

// ------窗口相关函数end-------------------------------------


// ------绘图相关函数-------------------------------------

/**
 * @brief 设置画布（帧缓冲区）以开始绘图
 * 
 * @return void
 */
void BeginDrawing();

/**
 * @brief 结束画布绘图并交换缓冲区（双缓冲）
 * 
 * @return void
 */
void EndDrawing();

// ------绘图相关函数end-------------------------------------


// ------文本绘制函数-------------------------------------

/**
 * @brief 绘制文本(使用默认字体)
 * 
 * @param text const char* 要绘制的文本
 * @param posX int 文本的X坐标
 * @param posY int 文本的Y坐标
 * @param fontSize int 文本的字体大小
 * @param color Color 文本的颜色
 * @return void
 */
void DrawText(const char *text, int posX, int posY, int fontSize, Color color);

// ------文本绘制函数-------------------------------------

