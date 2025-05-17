g++ webview.cc ^
-I./webview2/include ^
-Os --std=c++14 -static -DWEBVIEW_STATIC ^
-mwindows -Ilibs ^
-Wl,--gc-sections -ffunction-sections -fdata-sections ^
-ladvapi32 -lole32 -lshell32 -lshlwapi -luser32 -lversion ^
-shared -o webview.a