#include "raylib.h"

//---------------- 设置导出名 `EXPORT` (全大写可加下划线、可自定义,例如 ASD_API)
#ifdef _WIN32
#define EXPORT __declspec(dllexport)
#else
#define EXPORT
#endif
// ---------------

/**
 * @brief 初始化窗口
 * @param int width 窗口宽度
 * @param int height 窗口高度
 * @param const char * title 窗口标题
 * @return void
 */
EXPORT void InitWindow(int width, int height, const char *title);
EXPORT bool WindowShouldClose();
int main()
{

    InitWindow(640, 480, "中文");
    while (!WindowShouldClose())
    {
        BeginDrawing();
        ClearBackground(RAYWHITE);
        DrawText("你好", 190, 200, 20, DARKGRAY);
        EndDrawing();
    }
    CloseWindow();
    return 0;
}