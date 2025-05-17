#include "raylib.h"
#include "webview.h"
#include <stddef.h>
#include <stdio.h>
#include <stdbool.h>

int main()
{
    printf("程序开始...\n");
    InitWindow(800, 600, "Hello Webview!");

    void *window = GetWindowHandle();

    webview_t w = webview_create(false, window);

    webview_navigate(w,"https://bilibili.com");

    webview_run(w);

    webview_terminate(w);

    return 0;
}