:: 关闭命令回显，执行时不显示命令本身
@echo on
:: 设置局部环境变量，确保脚本内的变量不影响外部环境
setlocal

echo Prepare directories...
:: 获取当前脚本所在目录路径（含结尾反斜杠）
set script_dir=%~dp0
:: 去掉路径末尾的反斜杠（例如将 C:\test\ 改为 C:\test）
set script_dir=%script_dir:~0,-1%
:: 设置源码目录为脚本目录
set src_dir=%script_dir%
:: 设置构建目录为脚本目录下的build子目录
set build_dir=%script_dir%\build
:: 创建构建目录（如果不存在）
mkdir "%build_dir%"

:: 显示目录信息
echo Webview directory: %src_dir%
echo Build directory: %build_dir%

:: 如果更新了nuget包，需要在此修改版本号
set nuget_version=2.1.0.3240.44
echo Using Nuget Package microsoft.web.webview2.%nuget_version%
:: 检查nuget包目录是否存在
if not exist "%script_dir%\microsoft.web.webview2.%nuget_version%" (
    :: 使用nuget安装指定版本的WebView2包到脚本目录
    nuget.exe install Microsoft.Web.Webview2 -Version %nuget_version% -OutputDirectory %script_dir%
    echo Nuget package installed
)

echo Looking for vswhere.exe...
:: 尝试在Program Files(x86)中查找vswhere.exe
set "vswhere=%ProgramFiles(x86)%\Microsoft Visual Studio\Installer\vswhere.exe"
:: 如果找不到，尝试在Program Files目录查找
if not exist "%vswhere%" set "vswhere=%ProgramFiles%\Microsoft Visual Studio\Installer\vswhere.exe"
if not exist "%vswhere%" (
    echo ERROR: Failed to find vswhere.exe
    exit /b 1
)
echo Found %vswhere%

echo Looking for VC...
:: 使用vswhere查找最新安装的VC工具路径
for /f "usebackq tokens=*" %%i in (`"%vswhere%" -latest -products * -requires Microsoft.VisualStudio.Component.VC.Tools.x86.x64 -property installationPath`) do (
  set vc_dir=%%i
)
:: 验证VC工具是否有效
if not exist "%vc_dir%\Common7\Tools\vsdevcmd.bat" (
    echo ERROR: Failed to find VC tools x86/x64
    exit /b 1
)
echo Found %vc_dir%

:: 编译器警告设置
:: 4100: 未引用的形式参数（禁用此警告）
set warning_params=/W4 /wd4100

:: 如果DLL不存在则开始构建
if not exist "%src_dir%\dll\x64\webview.dll" (
    :: 创建x86/x64目录结构
    mkdir "%src_dir%\dll\x86"
    mkdir "%src_dir%\dll\x64"
    :: 复制WebView2Loader.dll到相应目录
    copy  "%script_dir%\microsoft.web.webview2.%nuget_version%\build\native\x64\WebView2Loader.dll" "%src_dir%\dll\x64"
    copy  "%script_dir%\microsoft.web.webview2.%nuget_version%\build\native\x86\WebView2Loader.dll" "%src_dir%\dll\x86"

    :: 设置x86编译环境
    call "%vc_dir%\Common7\Tools\vsdevcmd.bat" -arch=x86 -host_arch=x64

    echo Building webview.dll ^(x86^)
    :: 使用CL编译器编译x86版本DLL
    cl %warning_params% ^
        /D "WEBVIEW_API=__declspec(dllexport)" ^  :: 定义导出宏
        /I "%script_dir%\microsoft.web.webview2.%nuget_version%\build\native\include" ^ :: 包含头文件目录
        /std:c++17 /EHsc "/Fo%build_dir%"\ ^      :: 指定C++17标准，设置输出目录
        "%src_dir%\webview.cc" /link /DLL "/OUT:%src_dir%\dll\x86\webview_php_ffi.dll" || exit /b

    :: 设置x64编译环境
    call "%vc_dir%\Common7\Tools\vsdevcmd.bat" -arch=x64 -host_arch=x64
    echo Building webview.dll ^(x64^)
    :: 编译x64版本DLL
    cl %warning_params% ^
        /D "WEBVIEW_API=__declspec(dllexport)" ^
        /I "%script_dir%\microsoft.web.webview2.%nuget_version%\build\native\include" ^
        /std:c++17 /EHsc "/Fo%build_dir%"\ ^
        "%src_dir%\webview.cc" /link /DLL "/OUT:%src_dir%\dll\x64\webview_php_ffi.dll" || exit /b
)

:: 将生成的DLL复制到构建目录
if not exist "%build_dir%\webview_php_ffi.dll" (
    copy "%src_dir%\dll\x64\webview_php_ffi.dll" %build_dir%
)
:: 复制WebView2Loader.dll到构建目录
if not exist "%build_dir%\WebView2Loader.dll" (
    copy "%script_dir%\microsoft.web.webview2.%nuget_version%\build\native\x64\WebView2Loader.dll" "%build_dir%"
)