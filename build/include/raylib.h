/**********************************************************************************************
*
*   raylib v5.5 - A simple and easy-to-use library to enjoy videogames programming (www.raylib.com)
*
*   FEATURES:
*       - NO external dependencies, all required libraries included with raylib
*       - Multiplatform: Windows, Linux, FreeBSD, OpenBSD, NetBSD, DragonFly,
*                        MacOS, Haiku, Android, Raspberry Pi, DRM native, HTML5.
*       - Written in plain C code (C99) in PascalCase/camelCase notation
*       - Hardware accelerated with OpenGL (1.1, 2.1, 3.3, 4.3, ES2, ES3 - choose at compile)
*       - Unique OpenGL abstraction layer (usable as standalone module): [rlgl]
*       - Multiple Fonts formats supported (TTF, OTF, FNT, BDF, Sprite fonts)
*       - Outstanding texture formats support, including compressed formats (DXT, ETC, ASTC)
*       - Full 3d support for 3d Shapes, Models, Billboards, Heightmaps and more!
*       - Flexible Materials system, supporting classic maps and PBR maps
*       - Animated 3D models supported (skeletal bones animation) (IQM, M3D, GLTF)
*       - Shaders support, including Model shaders and Postprocessing shaders
*       - Powerful math module for Vector, Matrix and Quaternion operations: [raymath]
*       - Audio loading and playing with streaming support (WAV, OGG, MP3, FLAC, QOA, XM, MOD)
*       - VR stereo rendering with configurable HMD device parameters
*       - Bindings to multiple programming languages available!
*
*   NOTES:
*       - One default Font is loaded on InitWindow()->LoadFontDefault() [core, text]
*       - One default Texture2D is loaded on rlglInit(), 1x1 white pixel R8G8B8A8 [rlgl] (OpenGL 3.3 or ES2)
*       - One default Shader is loaded on rlglInit()->rlLoadShaderDefault() [rlgl] (OpenGL 3.3 or ES2)
*       - One default RenderBatch is loaded on rlglInit()->rlLoadRenderBatch() [rlgl] (OpenGL 3.3 or ES2)
*
*   DEPENDENCIES (included):
*       [rcore][GLFW] rglfw (Camilla Löwy - github.com/glfw/glfw) for window/context management and input
*       [rcore][RGFW] rgfw (ColleagueRiley - github.com/ColleagueRiley/RGFW) for window/context management and input
*       [rlgl] glad/glad_gles2 (David Herberth - github.com/Dav1dde/glad) for OpenGL 3.3 extensions loading
*       [raudio] miniaudio (David Reid - github.com/mackron/miniaudio) for audio device/context management
*
*   OPTIONAL DEPENDENCIES (included):
*       [rcore] msf_gif (Miles Fogle) for GIF recording
*       [rcore] sinfl (Micha Mettke) for DEFLATE decompression algorithm
*       [rcore] sdefl (Micha Mettke) for DEFLATE compression algorithm
*       [rcore] rprand (Ramon Snatamaria) for pseudo-random numbers generation
*       [rtextures] qoi (Dominic Szablewski - https://phoboslab.org) for QOI image manage
*       [rtextures] stb_image (Sean Barret) for images loading (BMP, TGA, PNG, JPEG, HDR...)
*       [rtextures] stb_image_write (Sean Barret) for image writing (BMP, TGA, PNG, JPG)
*       [rtextures] stb_image_resize2 (Sean Barret) for image resizing algorithms
*       [rtextures] stb_perlin (Sean Barret) for Perlin Noise image generation
*       [rtext] stb_truetype (Sean Barret) for ttf fonts loading
*       [rtext] stb_rect_pack (Sean Barret) for rectangles packing
*       [rmodels] par_shapes (Philip Rideout) for parametric 3d shapes generation
*       [rmodels] tinyobj_loader_c (Syoyo Fujita) for models loading (OBJ, MTL)
*       [rmodels] cgltf (Johannes Kuhlmann) for models loading (glTF)
*       [rmodels] m3d (bzt) for models loading (M3D, https://bztsrc.gitlab.io/model3d)
*       [rmodels] vox_loader (Johann Nadalutti) for models loading (VOX)
*       [raudio] dr_wav (David Reid) for WAV audio file loading
*       [raudio] dr_flac (David Reid) for FLAC audio file loading
*       [raudio] dr_mp3 (David Reid) for MP3 audio file loading
*       [raudio] stb_vorbis (Sean Barret) for OGG audio loading
*       [raudio] jar_xm (Joshua Reisenauer) for XM audio module loading
*       [raudio] jar_mod (Joshua Reisenauer) for MOD audio module loading
*       [raudio] qoa (Dominic Szablewski - https://phoboslab.org) for QOA audio manage
*
*
*   LICENSE: zlib/libpng
*
*   raylib is licensed under an unmodified zlib/libpng license, which is an OSI-certified,
*   BSD-like license that allows static linking with closed source software:
*
*   Copyright (c) 2013-2024 Ramon Santamaria (@raysan5)
*
*   This software is provided "as-is", without any express or implied warranty. In no event
*   will the authors be held liable for any damages arising from the use of this software.
*
*   Permission is granted to anyone to use this software for any purpose, including commercial
*   applications, and to alter it and redistribute it freely, subject to the following restrictions:
*
*     1. The origin of this software must not be misrepresented; you must not claim that you
*     wrote the original software. If you use this software in a product, an acknowledgment
*     in the product documentation would be appreciated but is not required.
*
*     2. Altered source versions must be plainly marked as such, and must not be misrepresented
*     as being the original software.
*
*     3. This notice may not be removed or altered from any source distribution.
*
**********************************************************************************************/

#ifndef RAYLIB_H
#define RAYLIB_H

#include <stdarg.h>     // Required for: va_list - Only used by TraceLogCallback

#define RAYLIB_VERSION_MAJOR 5
#define RAYLIB_VERSION_MINOR 5
#define RAYLIB_VERSION_PATCH 0
#define RAYLIB_VERSION  "5.5"

// Function specifiers in case library is build/used as a shared library
// NOTE: Microsoft specifiers to tell compiler that symbols are imported/exported from a .dll
// NOTE: visibility("default") attribute makes symbols "visible" when compiled with -fvisibility=hidden
#if defined(_WIN32)
    #if defined(__TINYC__)
        #define __declspec(x) __attribute__((x))
    #endif
    #if defined(BUILD_LIBTYPE_SHARED)
        #define RLAPI __declspec(dllexport)     // We are building the library as a Win32 shared library (.dll)
    #elif defined(USE_LIBTYPE_SHARED)
        #define RLAPI __declspec(dllimport)     // We are using the library as a Win32 shared library (.dll)
    #endif
#else
    #if defined(BUILD_LIBTYPE_SHARED)
        #define RLAPI __attribute__((visibility("default"))) // We are building as a Unix shared library (.so/.dylib)
    #endif
#endif

#ifndef RLAPI
    #define RLAPI       // Functions defined as 'extern' by default (implicit specifiers)
#endif

//----------------------------------------------------------------------------------
// Some basic Defines
//----------------------------------------------------------------------------------
#ifndef PI
    #define PI 3.14159265358979323846f
#endif
#ifndef DEG2RAD
    #define DEG2RAD (PI/180.0f)
#endif
#ifndef RAD2DEG
    #define RAD2DEG (180.0f/PI)
#endif

// Allow custom memory allocators
// NOTE: Require recompiling raylib sources
#ifndef RL_MALLOC
    #define RL_MALLOC(sz)       malloc(sz)
#endif
#ifndef RL_CALLOC
    #define RL_CALLOC(n,sz)     calloc(n,sz)
#endif
#ifndef RL_REALLOC
    #define RL_REALLOC(ptr,sz)  realloc(ptr,sz)
#endif
#ifndef RL_FREE
    #define RL_FREE(ptr)        free(ptr)
#endif

// NOTE: MSVC C++ compiler does not support compound literals (C99 feature)
// Plain structures in C++ (without constructors) can be initialized with { }
// This is called aggregate initialization (C++11 feature)
#if defined(__cplusplus)
    #define CLITERAL(type)      type
#else
    #define CLITERAL(type)      (type)
#endif

// Some compilers (mostly macos clang) default to C++98,
// where aggregate initialization can't be used
// So, give a more clear error stating how to fix this
#if !defined(_MSC_VER) && (defined(__cplusplus) && __cplusplus < 201103L)
    #error "C++11 or later is required. Add -std=c++11"
#endif

// NOTE: We set some defines with some data types declared by raylib
// Other modules (raymath, rlgl) also require some of those types, so,
// to be able to use those other modules as standalone (not depending on raylib)
// this defines are very useful for internal check and avoid type (re)definitions
#define RL_COLOR_TYPE
#define RL_RECTANGLE_TYPE
#define RL_VECTOR2_TYPE
#define RL_VECTOR3_TYPE
#define RL_VECTOR4_TYPE
#define RL_QUATERNION_TYPE
#define RL_MATRIX_TYPE

// Some Basic Colors
// NOTE: Custom raylib color palette for amazing visuals on WHITE background
#define LIGHTGRAY  CLITERAL(Color){ 200, 200, 200, 255 }   // Light Gray
#define GRAY       CLITERAL(Color){ 130, 130, 130, 255 }   // Gray
#define DARKGRAY   CLITERAL(Color){ 80, 80, 80, 255 }      // Dark Gray
#define YELLOW     CLITERAL(Color){ 253, 249, 0, 255 }     // Yellow
#define GOLD       CLITERAL(Color){ 255, 203, 0, 255 }     // Gold
#define ORANGE     CLITERAL(Color){ 255, 161, 0, 255 }     // Orange
#define PINK       CLITERAL(Color){ 255, 109, 194, 255 }   // Pink
#define RED        CLITERAL(Color){ 230, 41, 55, 255 }     // Red
#define MAROON     CLITERAL(Color){ 190, 33, 55, 255 }     // Maroon
#define GREEN      CLITERAL(Color){ 0, 228, 48, 255 }      // Green
#define LIME       CLITERAL(Color){ 0, 158, 47, 255 }      // Lime
#define DARKGREEN  CLITERAL(Color){ 0, 117, 44, 255 }      // Dark Green
#define SKYBLUE    CLITERAL(Color){ 102, 191, 255, 255 }   // Sky Blue
#define BLUE       CLITERAL(Color){ 0, 121, 241, 255 }     // Blue
#define DARKBLUE   CLITERAL(Color){ 0, 82, 172, 255 }      // Dark Blue
#define PURPLE     CLITERAL(Color){ 200, 122, 255, 255 }   // Purple
#define VIOLET     CLITERAL(Color){ 135, 60, 190, 255 }    // Violet
#define DARKPURPLE CLITERAL(Color){ 112, 31, 126, 255 }    // Dark Purple
#define BEIGE      CLITERAL(Color){ 211, 176, 131, 255 }   // Beige
#define BROWN      CLITERAL(Color){ 127, 106, 79, 255 }    // Brown
#define DARKBROWN  CLITERAL(Color){ 76, 63, 47, 255 }      // Dark Brown

#define WHITE      CLITERAL(Color){ 255, 255, 255, 255 }   // White
#define BLACK      CLITERAL(Color){ 0, 0, 0, 255 }         // Black
#define BLANK      CLITERAL(Color){ 0, 0, 0, 0 }           // Blank (Transparent)
#define MAGENTA    CLITERAL(Color){ 255, 0, 255, 255 }     // Magenta
#define RAYWHITE   CLITERAL(Color){ 245, 245, 245, 255 }   // My own White (raylib logo)

//----------------------------------------------------------------------------------
// Structures Definition
//----------------------------------------------------------------------------------
// Boolean type
#if (defined(__STDC__) && __STDC_VERSION__ >= 199901L) || (defined(_MSC_VER) && _MSC_VER >= 1800)
    #include <stdbool.h>
#elif !defined(__cplusplus) && !defined(bool)
    typedef enum bool { false = 0, true = !false } bool;
    #define RL_BOOL_TYPE
#endif

// Vector2, 2 components
typedef struct Vector2 {
    float x;                // Vector x component
    float y;                // Vector y component
} Vector2;

// Vector3, 3 components
typedef struct Vector3 {
    float x;                // Vector x component
    float y;                // Vector y component
    float z;                // Vector z component
} Vector3;

// Vector4, 4 components
typedef struct Vector4 {
    float x;                // Vector x component
    float y;                // Vector y component
    float z;                // Vector z component
    float w;                // Vector w component
} Vector4;

// Quaternion, 4 components (Vector4 alias)
typedef Vector4 Quaternion;

// Matrix, 4x4 components, column major, OpenGL style, right-handed
typedef struct Matrix {
    float m0, m4, m8, m12;  // Matrix first row (4 components)
    float m1, m5, m9, m13;  // Matrix second row (4 components)
    float m2, m6, m10, m14; // Matrix third row (4 components)
    float m3, m7, m11, m15; // Matrix fourth row (4 components)
} Matrix;

// Color, 4 components, R8G8B8A8 (32bit)
typedef struct Color {
    unsigned char r;        // Color red value
    unsigned char g;        // Color green value
    unsigned char b;        // Color blue value
    unsigned char a;        // Color alpha value
} Color;

// Rectangle, 4 components
typedef struct Rectangle {
    float x;                // Rectangle top-left corner position x
    float y;                // Rectangle top-left corner position y
    float width;            // Rectangle width
    float height;           // Rectangle height
} Rectangle;

// Image, pixel data stored in CPU memory (RAM)
typedef struct Image {
    void *data;             // Image raw data
    int width;              // Image base width
    int height;             // Image base height
    int mipmaps;            // Mipmap levels, 1 by default
    int format;             // Data format (PixelFormat type)
} Image;

// Texture, tex data stored in GPU memory (VRAM)
typedef struct Texture {
    unsigned int id;        // OpenGL texture id
    int width;              // Texture base width
    int height;             // Texture base height
    int mipmaps;            // Mipmap levels, 1 by default
    int format;             // Data format (PixelFormat type)
} Texture;

// Texture2D, same as Texture
typedef Texture Texture2D;

// TextureCubemap, same as Texture
typedef Texture TextureCubemap;

// RenderTexture, fbo for texture rendering
typedef struct RenderTexture {
    unsigned int id;        // OpenGL framebuffer object id
    Texture texture;        // Color buffer attachment texture
    Texture depth;          // Depth buffer attachment texture
} RenderTexture;

// RenderTexture2D, same as RenderTexture
typedef RenderTexture RenderTexture2D;

// NPatchInfo, n-patch layout info
typedef struct NPatchInfo {
    Rectangle source;       // Texture source rectangle
    int left;               // Left border offset
    int top;                // Top border offset
    int right;              // Right border offset
    int bottom;             // Bottom border offset
    int layout;             // Layout of the n-patch: 3x3, 1x3 or 3x1
} NPatchInfo;

// GlyphInfo, font characters glyphs info
typedef struct GlyphInfo {
    int value;              // Character value (Unicode)
    int offsetX;            // Character offset X when drawing
    int offsetY;            // Character offset Y when drawing
    int advanceX;           // Character advance position X
    Image image;            // Character image data
} GlyphInfo;

// Font, font texture and GlyphInfo array data
typedef struct Font {
    int baseSize;           // Base size (default chars height)
    int glyphCount;         // Number of glyph characters
    int glyphPadding;       // Padding around the glyph characters
    Texture2D texture;      // Texture atlas containing the glyphs
    Rectangle *recs;        // Rectangles in texture for the glyphs
    GlyphInfo *glyphs;      // Glyphs info data
} Font;

// Camera, defines position/orientation in 3d space
typedef struct Camera3D {
    Vector3 position;       // Camera position
    Vector3 target;         // Camera target it looks-at
    Vector3 up;             // Camera up vector (rotation over its axis)
    float fovy;             // Camera field-of-view aperture in Y (degrees) in perspective, used as near plane width in orthographic
    int projection;         // Camera projection: CAMERA_PERSPECTIVE or CAMERA_ORTHOGRAPHIC
} Camera3D;

typedef Camera3D Camera;    // Camera type fallback, defaults to Camera3D

// Camera2D, defines position/orientation in 2d space
typedef struct Camera2D {
    Vector2 offset;         // Camera offset (displacement from target)
    Vector2 target;         // Camera target (rotation and zoom origin)
    float rotation;         // Camera rotation in degrees
    float zoom;             // Camera zoom (scaling), should be 1.0f by default
} Camera2D;

// Mesh, vertex data and vao/vbo
typedef struct Mesh {
    int vertexCount;        // Number of vertices stored in arrays
    int triangleCount;      // Number of triangles stored (indexed or not)

    // Vertex attributes data
    float *vertices;        // Vertex position (XYZ - 3 components per vertex) (shader-location = 0)
    float *texcoords;       // Vertex texture coordinates (UV - 2 components per vertex) (shader-location = 1)
    float *texcoords2;      // Vertex texture second coordinates (UV - 2 components per vertex) (shader-location = 5)
    float *normals;         // Vertex normals (XYZ - 3 components per vertex) (shader-location = 2)
    float *tangents;        // Vertex tangents (XYZW - 4 components per vertex) (shader-location = 4)
    unsigned char *colors;      // Vertex colors (RGBA - 4 components per vertex) (shader-location = 3)
    unsigned short *indices;    // Vertex indices (in case vertex data comes indexed)

    // Animation vertex data
    float *animVertices;    // Animated vertex positions (after bones transformations)
    float *animNormals;     // Animated normals (after bones transformations)
    unsigned char *boneIds; // Vertex bone ids, max 255 bone ids, up to 4 bones influence by vertex (skinning) (shader-location = 6)
    float *boneWeights;     // Vertex bone weight, up to 4 bones influence by vertex (skinning) (shader-location = 7)
    Matrix *boneMatrices;   // Bones animated transformation matrices
    int boneCount;          // Number of bones

    // OpenGL identifiers
    unsigned int vaoId;     // OpenGL Vertex Array Object id
    unsigned int *vboId;    // OpenGL Vertex Buffer Objects id (default vertex data)
} Mesh;

// Shader
typedef struct Shader {
    unsigned int id;        // Shader program id
    int *locs;              // Shader locations array (RL_MAX_SHADER_LOCATIONS)
} Shader;

// MaterialMap
typedef struct MaterialMap {
    Texture2D texture;      // Material map texture
    Color color;            // Material map color
    float value;            // Material map value
} MaterialMap;

// Material, includes shader and maps
typedef struct Material {
    Shader shader;          // Material shader
    MaterialMap *maps;      // Material maps array (MAX_MATERIAL_MAPS)
    float params[4];        // Material generic parameters (if required)
} Material;

// Transform, vertex transformation data
typedef struct Transform {
    Vector3 translation;    // Translation
    Quaternion rotation;    // Rotation
    Vector3 scale;          // Scale
} Transform;

// Bone, skeletal animation bone
typedef struct BoneInfo {
    char name[32];          // Bone name
    int parent;             // Bone parent
} BoneInfo;

// Model, meshes, materials and animation data
typedef struct Model {
    Matrix transform;       // Local transform matrix

    int meshCount;          // Number of meshes
    int materialCount;      // Number of materials
    Mesh *meshes;           // Meshes array
    Material *materials;    // Materials array
    int *meshMaterial;      // Mesh material number

    // Animation data
    int boneCount;          // Number of bones
    BoneInfo *bones;        // Bones information (skeleton)
    Transform *bindPose;    // Bones base transformation (pose)
} Model;

// ModelAnimation
typedef struct ModelAnimation {
    int boneCount;          // Number of bones
    int frameCount;         // Number of animation frames
    BoneInfo *bones;        // Bones information (skeleton)
    Transform **framePoses; // Poses array by frame
    char name[32];          // Animation name
} ModelAnimation;

// Ray, ray for raycasting
typedef struct Ray {
    Vector3 position;       // Ray position (origin)
    Vector3 direction;      // Ray direction (normalized)
} Ray;

// RayCollision, ray hit information
typedef struct RayCollision {
    bool hit;               // Did the ray hit something?
    float distance;         // Distance to the nearest hit
    Vector3 point;          // Point of the nearest hit
    Vector3 normal;         // Surface normal of hit
} RayCollision;

// BoundingBox
typedef struct BoundingBox {
    Vector3 min;            // Minimum vertex box-corner
    Vector3 max;            // Maximum vertex box-corner
} BoundingBox;

// Wave, audio wave data
typedef struct Wave {
    unsigned int frameCount;    // Total number of frames (considering channels)
    unsigned int sampleRate;    // Frequency (samples per second)
    unsigned int sampleSize;    // Bit depth (bits per sample): 8, 16, 32 (24 not supported)
    unsigned int channels;      // Number of channels (1-mono, 2-stereo, ...)
    void *data;                 // Buffer data pointer
} Wave;

// Opaque structs declaration
// NOTE: Actual structs are defined internally in raudio module
typedef struct rAudioBuffer rAudioBuffer;
typedef struct rAudioProcessor rAudioProcessor;

// AudioStream, custom audio stream
typedef struct AudioStream {
    rAudioBuffer *buffer;       // Pointer to internal data used by the audio system
    rAudioProcessor *processor; // Pointer to internal data processor, useful for audio effects

    unsigned int sampleRate;    // Frequency (samples per second)
    unsigned int sampleSize;    // Bit depth (bits per sample): 8, 16, 32 (24 not supported)
    unsigned int channels;      // Number of channels (1-mono, 2-stereo, ...)
} AudioStream;

// Sound
typedef struct Sound {
    AudioStream stream;         // Audio stream
    unsigned int frameCount;    // Total number of frames (considering channels)
} Sound;

// Music, audio stream, anything longer than ~10 seconds should be streamed
typedef struct Music {
    AudioStream stream;         // Audio stream
    unsigned int frameCount;    // Total number of frames (considering channels)
    bool looping;               // Music looping enable

    int ctxType;                // Type of music context (audio filetype)
    void *ctxData;              // Audio context data, depends on type
} Music;

// VrDeviceInfo, Head-Mounted-Display device parameters
typedef struct VrDeviceInfo {
    int hResolution;                // Horizontal resolution in pixels
    int vResolution;                // Vertical resolution in pixels
    float hScreenSize;              // Horizontal size in meters
    float vScreenSize;              // Vertical size in meters
    float eyeToScreenDistance;      // Distance between eye and display in meters
    float lensSeparationDistance;   // Lens separation distance in meters
    float interpupillaryDistance;   // IPD (distance between pupils) in meters
    float lensDistortionValues[4];  // Lens distortion constant parameters
    float chromaAbCorrection[4];    // Chromatic aberration correction parameters
} VrDeviceInfo;

// VrStereoConfig, VR stereo rendering configuration for simulator
typedef struct VrStereoConfig {
    Matrix projection[2];           // VR projection matrices (per eye)
    Matrix viewOffset[2];           // VR view offset matrices (per eye)
    float leftLensCenter[2];        // VR left lens center
    float rightLensCenter[2];       // VR right lens center
    float leftScreenCenter[2];      // VR left screen center
    float rightScreenCenter[2];     // VR right screen center
    float scale[2];                 // VR distortion scale
    float scaleIn[2];               // VR distortion scale in
} VrStereoConfig;

// File path list
typedef struct FilePathList {
    unsigned int capacity;          // Filepaths max entries
    unsigned int count;             // Filepaths entries count
    char **paths;                   // Filepaths entries
} FilePathList;

// Automation event
typedef struct AutomationEvent {
    unsigned int frame;             // Event frame
    unsigned int type;              // Event type (AutomationEventType)
    int params[4];                  // Event parameters (if required)
} AutomationEvent;

// Automation event list
typedef struct AutomationEventList {
    unsigned int capacity;          // Events max entries (MAX_AUTOMATION_EVENTS)
    unsigned int count;             // Events entries count
    AutomationEvent *events;        // Events entries
} AutomationEventList;

//----------------------------------------------------------------------------------
// 枚举定义
//----------------------------------------------------------------------------------
// 系统/窗口配置标志
// 注意: 每个位代表一种状态 (使用位掩码操作)
// 默认情况下，所有标志都设置为 0
typedef enum {
    FLAG_VSYNC_HINT         = 0x00000040,   // 设置以尝试在GPU上启用垂直同步
    FLAG_FULLSCREEN_MODE    = 0x00000002,   // 设置以全屏模式运行程序
    FLAG_WINDOW_RESIZABLE   = 0x00000004,   // 设置以允许窗口可调整大小
    FLAG_WINDOW_UNDECORATED = 0x00000008,   // 设置以禁用窗口装饰 (边框和按钮)
    FLAG_WINDOW_HIDDEN      = 0x00000080,   // 设置以隐藏窗口
    FLAG_WINDOW_MINIMIZED   = 0x00000200,   // 设置以最小化窗口 (图标化)
    FLAG_WINDOW_MAXIMIZED   = 0x00000400,   // 设置以最大化窗口 (扩展到显示器)
    FLAG_WINDOW_UNFOCUSED   = 0x00000800,   // 设置窗口为非聚焦状态
    FLAG_WINDOW_TOPMOST     = 0x00001000,   // 设置窗口始终置顶
    FLAG_WINDOW_ALWAYS_RUN  = 0x00000100,   // 设置以允许窗口在最小化时继续运行
    FLAG_WINDOW_TRANSPARENT = 0x00000010,   // 设置以允许透明帧缓冲区
    FLAG_WINDOW_HIGHDPI     = 0x00002000,   // 设置以支持高DPI
    FLAG_WINDOW_MOUSE_PASSTHROUGH = 0x00004000, // 设置以支持鼠标穿透，仅在FLAG_WINDOW_UNDECORATED时支持
    FLAG_BORDERLESS_WINDOWED_MODE = 0x00008000, // 设置以无边框窗口模式运行程序
    FLAG_MSAA_4X_HINT       = 0x00000020,   // 设置以尝试启用4倍多重采样抗锯齿
    FLAG_INTERLACED_HINT    = 0x00010000    // 设置以尝试启用隔行视频格式 (适用于V3D)
} ConfigFlags;

// Trace log level
// NOTE: Organized by priority level
typedef enum {
    LOG_ALL = 0,        // Display all logs
    LOG_TRACE,          // Trace logging, intended for internal use only
    LOG_DEBUG,          // Debug logging, used for internal debugging, it should be disabled on release builds
    LOG_INFO,           // Info logging, used for program execution info
    LOG_WARNING,        // Warning logging, used on recoverable failures
    LOG_ERROR,          // Error logging, used on unrecoverable failures
    LOG_FATAL,          // Fatal logging, used to abort program: exit(EXIT_FAILURE)
    LOG_NONE            // Disable logging
} TraceLogLevel;

// Keyboard keys (US keyboard layout)
// NOTE: Use GetKeyPressed() to allow redefining
// required keys for alternative layouts
typedef enum {
    KEY_NULL            = 0,        // Key: NULL, used for no key pressed
    // Alphanumeric keys
    KEY_APOSTROPHE      = 39,       // Key: '
    KEY_COMMA           = 44,       // Key: ,
    KEY_MINUS           = 45,       // Key: -
    KEY_PERIOD          = 46,       // Key: .
    KEY_SLASH           = 47,       // Key: /
    KEY_ZERO            = 48,       // Key: 0
    KEY_ONE             = 49,       // Key: 1
    KEY_TWO             = 50,       // Key: 2
    KEY_THREE           = 51,       // Key: 3
    KEY_FOUR            = 52,       // Key: 4
    KEY_FIVE            = 53,       // Key: 5
    KEY_SIX             = 54,       // Key: 6
    KEY_SEVEN           = 55,       // Key: 7
    KEY_EIGHT           = 56,       // Key: 8
    KEY_NINE            = 57,       // Key: 9
    KEY_SEMICOLON       = 59,       // Key: ;
    KEY_EQUAL           = 61,       // Key: =
    KEY_A               = 65,       // Key: A | a
    KEY_B               = 66,       // Key: B | b
    KEY_C               = 67,       // Key: C | c
    KEY_D               = 68,       // Key: D | d
    KEY_E               = 69,       // Key: E | e
    KEY_F               = 70,       // Key: F | f
    KEY_G               = 71,       // Key: G | g
    KEY_H               = 72,       // Key: H | h
    KEY_I               = 73,       // Key: I | i
    KEY_J               = 74,       // Key: J | j
    KEY_K               = 75,       // Key: K | k
    KEY_L               = 76,       // Key: L | l
    KEY_M               = 77,       // Key: M | m
    KEY_N               = 78,       // Key: N | n
    KEY_O               = 79,       // Key: O | o
    KEY_P               = 80,       // Key: P | p
    KEY_Q               = 81,       // Key: Q | q
    KEY_R               = 82,       // Key: R | r
    KEY_S               = 83,       // Key: S | s
    KEY_T               = 84,       // Key: T | t
    KEY_U               = 85,       // Key: U | u
    KEY_V               = 86,       // Key: V | v
    KEY_W               = 87,       // Key: W | w
    KEY_X               = 88,       // Key: X | x
    KEY_Y               = 89,       // Key: Y | y
    KEY_Z               = 90,       // Key: Z | z
    KEY_LEFT_BRACKET    = 91,       // Key: [
    KEY_BACKSLASH       = 92,       // Key: '\'
    KEY_RIGHT_BRACKET   = 93,       // Key: ]
    KEY_GRAVE           = 96,       // Key: `
    // Function keys
    KEY_SPACE           = 32,       // Key: Space
    KEY_ESCAPE          = 256,      // Key: Esc
    KEY_ENTER           = 257,      // Key: Enter
    KEY_TAB             = 258,      // Key: Tab
    KEY_BACKSPACE       = 259,      // Key: Backspace
    KEY_INSERT          = 260,      // Key: Ins
    KEY_DELETE          = 261,      // Key: Del
    KEY_RIGHT           = 262,      // Key: Cursor right
    KEY_LEFT            = 263,      // Key: Cursor left
    KEY_DOWN            = 264,      // Key: Cursor down
    KEY_UP              = 265,      // Key: Cursor up
    KEY_PAGE_UP         = 266,      // Key: Page up
    KEY_PAGE_DOWN       = 267,      // Key: Page down
    KEY_HOME            = 268,      // Key: Home
    KEY_END             = 269,      // Key: End
    KEY_CAPS_LOCK       = 280,      // Key: Caps lock
    KEY_SCROLL_LOCK     = 281,      // Key: Scroll down
    KEY_NUM_LOCK        = 282,      // Key: Num lock
    KEY_PRINT_SCREEN    = 283,      // Key: Print screen
    KEY_PAUSE           = 284,      // Key: Pause
    KEY_F1              = 290,      // Key: F1
    KEY_F2              = 291,      // Key: F2
    KEY_F3              = 292,      // Key: F3
    KEY_F4              = 293,      // Key: F4
    KEY_F5              = 294,      // Key: F5
    KEY_F6              = 295,      // Key: F6
    KEY_F7              = 296,      // Key: F7
    KEY_F8              = 297,      // Key: F8
    KEY_F9              = 298,      // Key: F9
    KEY_F10             = 299,      // Key: F10
    KEY_F11             = 300,      // Key: F11
    KEY_F12             = 301,      // Key: F12
    KEY_LEFT_SHIFT      = 340,      // Key: Shift left
    KEY_LEFT_CONTROL    = 341,      // Key: Control left
    KEY_LEFT_ALT        = 342,      // Key: Alt left
    KEY_LEFT_SUPER      = 343,      // Key: Super left
    KEY_RIGHT_SHIFT     = 344,      // Key: Shift right
    KEY_RIGHT_CONTROL   = 345,      // Key: Control right
    KEY_RIGHT_ALT       = 346,      // Key: Alt right
    KEY_RIGHT_SUPER     = 347,      // Key: Super right
    KEY_KB_MENU         = 348,      // Key: KB menu
    // Keypad keys
    KEY_KP_0            = 320,      // Key: Keypad 0
    KEY_KP_1            = 321,      // Key: Keypad 1
    KEY_KP_2            = 322,      // Key: Keypad 2
    KEY_KP_3            = 323,      // Key: Keypad 3
    KEY_KP_4            = 324,      // Key: Keypad 4
    KEY_KP_5            = 325,      // Key: Keypad 5
    KEY_KP_6            = 326,      // Key: Keypad 6
    KEY_KP_7            = 327,      // Key: Keypad 7
    KEY_KP_8            = 328,      // Key: Keypad 8
    KEY_KP_9            = 329,      // Key: Keypad 9
    KEY_KP_DECIMAL      = 330,      // Key: Keypad .
    KEY_KP_DIVIDE       = 331,      // Key: Keypad /
    KEY_KP_MULTIPLY     = 332,      // Key: Keypad *
    KEY_KP_SUBTRACT     = 333,      // Key: Keypad -
    KEY_KP_ADD          = 334,      // Key: Keypad +
    KEY_KP_ENTER        = 335,      // Key: Keypad Enter
    KEY_KP_EQUAL        = 336,      // Key: Keypad =
    // Android key buttons
    KEY_BACK            = 4,        // Key: Android back button
    KEY_MENU            = 5,        // Key: Android menu button
    KEY_VOLUME_UP       = 24,       // Key: Android volume up button
    KEY_VOLUME_DOWN     = 25        // Key: Android volume down button
} KeyboardKey;

// Add backwards compatibility support for deprecated names
#define MOUSE_LEFT_BUTTON   MOUSE_BUTTON_LEFT
#define MOUSE_RIGHT_BUTTON  MOUSE_BUTTON_RIGHT
#define MOUSE_MIDDLE_BUTTON MOUSE_BUTTON_MIDDLE

// Mouse buttons
typedef enum {
    MOUSE_BUTTON_LEFT    = 0,       // Mouse button left
    MOUSE_BUTTON_RIGHT   = 1,       // Mouse button right
    MOUSE_BUTTON_MIDDLE  = 2,       // Mouse button middle (pressed wheel)
    MOUSE_BUTTON_SIDE    = 3,       // Mouse button side (advanced mouse device)
    MOUSE_BUTTON_EXTRA   = 4,       // Mouse button extra (advanced mouse device)
    MOUSE_BUTTON_FORWARD = 5,       // Mouse button forward (advanced mouse device)
    MOUSE_BUTTON_BACK    = 6,       // Mouse button back (advanced mouse device)
} MouseButton;

// Mouse cursor
typedef enum {
    MOUSE_CURSOR_DEFAULT       = 0,     // Default pointer shape
    MOUSE_CURSOR_ARROW         = 1,     // Arrow shape
    MOUSE_CURSOR_IBEAM         = 2,     // Text writing cursor shape
    MOUSE_CURSOR_CROSSHAIR     = 3,     // Cross shape
    MOUSE_CURSOR_POINTING_HAND = 4,     // Pointing hand cursor
    MOUSE_CURSOR_RESIZE_EW     = 5,     // Horizontal resize/move arrow shape
    MOUSE_CURSOR_RESIZE_NS     = 6,     // Vertical resize/move arrow shape
    MOUSE_CURSOR_RESIZE_NWSE   = 7,     // Top-left to bottom-right diagonal resize/move arrow shape
    MOUSE_CURSOR_RESIZE_NESW   = 8,     // The top-right to bottom-left diagonal resize/move arrow shape
    MOUSE_CURSOR_RESIZE_ALL    = 9,     // The omnidirectional resize/move cursor shape
    MOUSE_CURSOR_NOT_ALLOWED   = 10     // The operation-not-allowed shape
} MouseCursor;

// Gamepad buttons
typedef enum {
    GAMEPAD_BUTTON_UNKNOWN = 0,         // Unknown button, just for error checking
    GAMEPAD_BUTTON_LEFT_FACE_UP,        // Gamepad left DPAD up button
    GAMEPAD_BUTTON_LEFT_FACE_RIGHT,     // Gamepad left DPAD right button
    GAMEPAD_BUTTON_LEFT_FACE_DOWN,      // Gamepad left DPAD down button
    GAMEPAD_BUTTON_LEFT_FACE_LEFT,      // Gamepad left DPAD left button
    GAMEPAD_BUTTON_RIGHT_FACE_UP,       // Gamepad right button up (i.e. PS3: Triangle, Xbox: Y)
    GAMEPAD_BUTTON_RIGHT_FACE_RIGHT,    // Gamepad right button right (i.e. PS3: Circle, Xbox: B)
    GAMEPAD_BUTTON_RIGHT_FACE_DOWN,     // Gamepad right button down (i.e. PS3: Cross, Xbox: A)
    GAMEPAD_BUTTON_RIGHT_FACE_LEFT,     // Gamepad right button left (i.e. PS3: Square, Xbox: X)
    GAMEPAD_BUTTON_LEFT_TRIGGER_1,      // Gamepad top/back trigger left (first), it could be a trailing button
    GAMEPAD_BUTTON_LEFT_TRIGGER_2,      // Gamepad top/back trigger left (second), it could be a trailing button
    GAMEPAD_BUTTON_RIGHT_TRIGGER_1,     // Gamepad top/back trigger right (first), it could be a trailing button
    GAMEPAD_BUTTON_RIGHT_TRIGGER_2,     // Gamepad top/back trigger right (second), it could be a trailing button
    GAMEPAD_BUTTON_MIDDLE_LEFT,         // Gamepad center buttons, left one (i.e. PS3: Select)
    GAMEPAD_BUTTON_MIDDLE,              // Gamepad center buttons, middle one (i.e. PS3: PS, Xbox: XBOX)
    GAMEPAD_BUTTON_MIDDLE_RIGHT,        // Gamepad center buttons, right one (i.e. PS3: Start)
    GAMEPAD_BUTTON_LEFT_THUMB,          // Gamepad joystick pressed button left
    GAMEPAD_BUTTON_RIGHT_THUMB          // Gamepad joystick pressed button right
} GamepadButton;

// Gamepad axis
typedef enum {
    GAMEPAD_AXIS_LEFT_X        = 0,     // Gamepad left stick X axis
    GAMEPAD_AXIS_LEFT_Y        = 1,     // Gamepad left stick Y axis
    GAMEPAD_AXIS_RIGHT_X       = 2,     // Gamepad right stick X axis
    GAMEPAD_AXIS_RIGHT_Y       = 3,     // Gamepad right stick Y axis
    GAMEPAD_AXIS_LEFT_TRIGGER  = 4,     // Gamepad back trigger left, pressure level: [1..-1]
    GAMEPAD_AXIS_RIGHT_TRIGGER = 5      // Gamepad back trigger right, pressure level: [1..-1]
} GamepadAxis;

// Material map index
typedef enum {
    MATERIAL_MAP_ALBEDO = 0,        // Albedo material (same as: MATERIAL_MAP_DIFFUSE)
    MATERIAL_MAP_METALNESS,         // Metalness material (same as: MATERIAL_MAP_SPECULAR)
    MATERIAL_MAP_NORMAL,            // Normal material
    MATERIAL_MAP_ROUGHNESS,         // Roughness material
    MATERIAL_MAP_OCCLUSION,         // Ambient occlusion material
    MATERIAL_MAP_EMISSION,          // Emission material
    MATERIAL_MAP_HEIGHT,            // Heightmap material
    MATERIAL_MAP_CUBEMAP,           // Cubemap material (NOTE: Uses GL_TEXTURE_CUBE_MAP)
    MATERIAL_MAP_IRRADIANCE,        // Irradiance material (NOTE: Uses GL_TEXTURE_CUBE_MAP)
    MATERIAL_MAP_PREFILTER,         // Prefilter material (NOTE: Uses GL_TEXTURE_CUBE_MAP)
    MATERIAL_MAP_BRDF               // Brdf material
} MaterialMapIndex;

#define MATERIAL_MAP_DIFFUSE      MATERIAL_MAP_ALBEDO
#define MATERIAL_MAP_SPECULAR     MATERIAL_MAP_METALNESS

// Shader location index
typedef enum {
    SHADER_LOC_VERTEX_POSITION = 0, // Shader location: vertex attribute: position
    SHADER_LOC_VERTEX_TEXCOORD01,   // Shader location: vertex attribute: texcoord01
    SHADER_LOC_VERTEX_TEXCOORD02,   // Shader location: vertex attribute: texcoord02
    SHADER_LOC_VERTEX_NORMAL,       // Shader location: vertex attribute: normal
    SHADER_LOC_VERTEX_TANGENT,      // Shader location: vertex attribute: tangent
    SHADER_LOC_VERTEX_COLOR,        // Shader location: vertex attribute: color
    SHADER_LOC_MATRIX_MVP,          // Shader location: matrix uniform: model-view-projection
    SHADER_LOC_MATRIX_VIEW,         // Shader location: matrix uniform: view (camera transform)
    SHADER_LOC_MATRIX_PROJECTION,   // Shader location: matrix uniform: projection
    SHADER_LOC_MATRIX_MODEL,        // Shader location: matrix uniform: model (transform)
    SHADER_LOC_MATRIX_NORMAL,       // Shader location: matrix uniform: normal
    SHADER_LOC_VECTOR_VIEW,         // Shader location: vector uniform: view
    SHADER_LOC_COLOR_DIFFUSE,       // Shader location: vector uniform: diffuse color
    SHADER_LOC_COLOR_SPECULAR,      // Shader location: vector uniform: specular color
    SHADER_LOC_COLOR_AMBIENT,       // Shader location: vector uniform: ambient color
    SHADER_LOC_MAP_ALBEDO,          // Shader location: sampler2d texture: albedo (same as: SHADER_LOC_MAP_DIFFUSE)
    SHADER_LOC_MAP_METALNESS,       // Shader location: sampler2d texture: metalness (same as: SHADER_LOC_MAP_SPECULAR)
    SHADER_LOC_MAP_NORMAL,          // Shader location: sampler2d texture: normal
    SHADER_LOC_MAP_ROUGHNESS,       // Shader location: sampler2d texture: roughness
    SHADER_LOC_MAP_OCCLUSION,       // Shader location: sampler2d texture: occlusion
    SHADER_LOC_MAP_EMISSION,        // Shader location: sampler2d texture: emission
    SHADER_LOC_MAP_HEIGHT,          // Shader location: sampler2d texture: height
    SHADER_LOC_MAP_CUBEMAP,         // Shader location: samplerCube texture: cubemap
    SHADER_LOC_MAP_IRRADIANCE,      // Shader location: samplerCube texture: irradiance
    SHADER_LOC_MAP_PREFILTER,       // Shader location: samplerCube texture: prefilter
    SHADER_LOC_MAP_BRDF,            // Shader location: sampler2d texture: brdf
    SHADER_LOC_VERTEX_BONEIDS,      // Shader location: vertex attribute: boneIds
    SHADER_LOC_VERTEX_BONEWEIGHTS,  // Shader location: vertex attribute: boneWeights
    SHADER_LOC_BONE_MATRICES        // Shader location: array of matrices uniform: boneMatrices
} ShaderLocationIndex;

#define SHADER_LOC_MAP_DIFFUSE      SHADER_LOC_MAP_ALBEDO
#define SHADER_LOC_MAP_SPECULAR     SHADER_LOC_MAP_METALNESS

// Shader uniform data type
typedef enum {
    SHADER_UNIFORM_FLOAT = 0,       // Shader uniform type: float
    SHADER_UNIFORM_VEC2,            // Shader uniform type: vec2 (2 float)
    SHADER_UNIFORM_VEC3,            // Shader uniform type: vec3 (3 float)
    SHADER_UNIFORM_VEC4,            // Shader uniform type: vec4 (4 float)
    SHADER_UNIFORM_INT,             // Shader uniform type: int
    SHADER_UNIFORM_IVEC2,           // Shader uniform type: ivec2 (2 int)
    SHADER_UNIFORM_IVEC3,           // Shader uniform type: ivec3 (3 int)
    SHADER_UNIFORM_IVEC4,           // Shader uniform type: ivec4 (4 int)
    SHADER_UNIFORM_SAMPLER2D        // Shader uniform type: sampler2d
} ShaderUniformDataType;

// Shader attribute data types
typedef enum {
    SHADER_ATTRIB_FLOAT = 0,        // Shader attribute type: float
    SHADER_ATTRIB_VEC2,             // Shader attribute type: vec2 (2 float)
    SHADER_ATTRIB_VEC3,             // Shader attribute type: vec3 (3 float)
    SHADER_ATTRIB_VEC4              // Shader attribute type: vec4 (4 float)
} ShaderAttributeDataType;

// Pixel formats
// NOTE: Support depends on OpenGL version and platform
typedef enum {
    PIXELFORMAT_UNCOMPRESSED_GRAYSCALE = 1, // 8 bit per pixel (no alpha)
    PIXELFORMAT_UNCOMPRESSED_GRAY_ALPHA,    // 8*2 bpp (2 channels)
    PIXELFORMAT_UNCOMPRESSED_R5G6B5,        // 16 bpp
    PIXELFORMAT_UNCOMPRESSED_R8G8B8,        // 24 bpp
    PIXELFORMAT_UNCOMPRESSED_R5G5B5A1,      // 16 bpp (1 bit alpha)
    PIXELFORMAT_UNCOMPRESSED_R4G4B4A4,      // 16 bpp (4 bit alpha)
    PIXELFORMAT_UNCOMPRESSED_R8G8B8A8,      // 32 bpp
    PIXELFORMAT_UNCOMPRESSED_R32,           // 32 bpp (1 channel - float)
    PIXELFORMAT_UNCOMPRESSED_R32G32B32,     // 32*3 bpp (3 channels - float)
    PIXELFORMAT_UNCOMPRESSED_R32G32B32A32,  // 32*4 bpp (4 channels - float)
    PIXELFORMAT_UNCOMPRESSED_R16,           // 16 bpp (1 channel - half float)
    PIXELFORMAT_UNCOMPRESSED_R16G16B16,     // 16*3 bpp (3 channels - half float)
    PIXELFORMAT_UNCOMPRESSED_R16G16B16A16,  // 16*4 bpp (4 channels - half float)
    PIXELFORMAT_COMPRESSED_DXT1_RGB,        // 4 bpp (no alpha)
    PIXELFORMAT_COMPRESSED_DXT1_RGBA,       // 4 bpp (1 bit alpha)
    PIXELFORMAT_COMPRESSED_DXT3_RGBA,       // 8 bpp
    PIXELFORMAT_COMPRESSED_DXT5_RGBA,       // 8 bpp
    PIXELFORMAT_COMPRESSED_ETC1_RGB,        // 4 bpp
    PIXELFORMAT_COMPRESSED_ETC2_RGB,        // 4 bpp
    PIXELFORMAT_COMPRESSED_ETC2_EAC_RGBA,   // 8 bpp
    PIXELFORMAT_COMPRESSED_PVRT_RGB,        // 4 bpp
    PIXELFORMAT_COMPRESSED_PVRT_RGBA,       // 4 bpp
    PIXELFORMAT_COMPRESSED_ASTC_4x4_RGBA,   // 8 bpp
    PIXELFORMAT_COMPRESSED_ASTC_8x8_RGBA    // 2 bpp
} PixelFormat;

// Texture parameters: filter mode
// NOTE 1: Filtering considers mipmaps if available in the texture
// NOTE 2: Filter is accordingly set for minification and magnification
typedef enum {
    TEXTURE_FILTER_POINT = 0,               // No filter, just pixel approximation
    TEXTURE_FILTER_BILINEAR,                // Linear filtering
    TEXTURE_FILTER_TRILINEAR,               // Trilinear filtering (linear with mipmaps)
    TEXTURE_FILTER_ANISOTROPIC_4X,          // Anisotropic filtering 4x
    TEXTURE_FILTER_ANISOTROPIC_8X,          // Anisotropic filtering 8x
    TEXTURE_FILTER_ANISOTROPIC_16X,         // Anisotropic filtering 16x
} TextureFilter;

// Texture parameters: wrap mode
typedef enum {
    TEXTURE_WRAP_REPEAT = 0,                // Repeats texture in tiled mode
    TEXTURE_WRAP_CLAMP,                     // Clamps texture to edge pixel in tiled mode
    TEXTURE_WRAP_MIRROR_REPEAT,             // Mirrors and repeats the texture in tiled mode
    TEXTURE_WRAP_MIRROR_CLAMP               // Mirrors and clamps to border the texture in tiled mode
} TextureWrap;

// Cubemap layouts
typedef enum {
    CUBEMAP_LAYOUT_AUTO_DETECT = 0,         // Automatically detect layout type
    CUBEMAP_LAYOUT_LINE_VERTICAL,           // Layout is defined by a vertical line with faces
    CUBEMAP_LAYOUT_LINE_HORIZONTAL,         // Layout is defined by a horizontal line with faces
    CUBEMAP_LAYOUT_CROSS_THREE_BY_FOUR,     // Layout is defined by a 3x4 cross with cubemap faces
    CUBEMAP_LAYOUT_CROSS_FOUR_BY_THREE     // Layout is defined by a 4x3 cross with cubemap faces
} CubemapLayout;

// Font type, defines generation method
typedef enum {
    FONT_DEFAULT = 0,               // Default font generation, anti-aliased
    FONT_BITMAP,                    // Bitmap font generation, no anti-aliasing
    FONT_SDF                        // SDF font generation, requires external shader
} FontType;

// Color blending modes (pre-defined)
typedef enum {
    BLEND_ALPHA = 0,                // Blend textures considering alpha (default)
    BLEND_ADDITIVE,                 // Blend textures adding colors
    BLEND_MULTIPLIED,               // Blend textures multiplying colors
    BLEND_ADD_COLORS,               // Blend textures adding colors (alternative)
    BLEND_SUBTRACT_COLORS,          // Blend textures subtracting colors (alternative)
    BLEND_ALPHA_PREMULTIPLY,        // Blend premultiplied textures considering alpha
    BLEND_CUSTOM,                   // Blend textures using custom src/dst factors (use rlSetBlendFactors())
    BLEND_CUSTOM_SEPARATE           // Blend textures using custom rgb/alpha separate src/dst factors (use rlSetBlendFactorsSeparate())
} BlendMode;

// Gesture
// NOTE: Provided as bit-wise flags to enable only desired gestures
typedef enum {
    GESTURE_NONE        = 0,        // No gesture
    GESTURE_TAP         = 1,        // Tap gesture
    GESTURE_DOUBLETAP   = 2,        // Double tap gesture
    GESTURE_HOLD        = 4,        // Hold gesture
    GESTURE_DRAG        = 8,        // Drag gesture
    GESTURE_SWIPE_RIGHT = 16,       // Swipe right gesture
    GESTURE_SWIPE_LEFT  = 32,       // Swipe left gesture
    GESTURE_SWIPE_UP    = 64,       // Swipe up gesture
    GESTURE_SWIPE_DOWN  = 128,      // Swipe down gesture
    GESTURE_PINCH_IN    = 256,      // Pinch in gesture
    GESTURE_PINCH_OUT   = 512       // Pinch out gesture
} Gesture;

// Camera system modes
typedef enum {
    CAMERA_CUSTOM = 0,              // Camera custom, controlled by user (UpdateCamera() does nothing)
    CAMERA_FREE,                    // Camera free mode
    CAMERA_ORBITAL,                 // Camera orbital, around target, zoom supported
    CAMERA_FIRST_PERSON,            // Camera first person
    CAMERA_THIRD_PERSON             // Camera third person
} CameraMode;

// Camera projection
typedef enum {
    CAMERA_PERSPECTIVE = 0,         // Perspective projection
    CAMERA_ORTHOGRAPHIC             // Orthographic projection
} CameraProjection;

// N-patch layout
typedef enum {
    NPATCH_NINE_PATCH = 0,          // Npatch layout: 3x3 tiles
    NPATCH_THREE_PATCH_VERTICAL,    // Npatch layout: 1x3 tiles
    NPATCH_THREE_PATCH_HORIZONTAL   // Npatch layout: 3x1 tiles
} NPatchLayout;

// Callbacks to hook some internal functions
// WARNING: These callbacks are intended for advanced users
typedef void (*TraceLogCallback)(int logLevel, const char *text, va_list args);  // Logging: Redirect trace log messages
typedef unsigned char *(*LoadFileDataCallback)(const char *fileName, int *dataSize);    // FileIO: Load binary data
typedef bool (*SaveFileDataCallback)(const char *fileName, void *data, int dataSize);   // FileIO: Save binary data
typedef char *(*LoadFileTextCallback)(const char *fileName);            // FileIO: Load text data
typedef bool (*SaveFileTextCallback)(const char *fileName, char *text); // FileIO: Save text data

//------------------------------------------------------------------------------------
// Global Variables Definition
//------------------------------------------------------------------------------------
// It's lonely here...

//------------------------------------------------------------------------------------
// Window and Graphics Device Functions (Module: core)
//------------------------------------------------------------------------------------

#if defined(__cplusplus)
extern "C" {            // Prevents name mangling of functions
#endif

// 窗口相关函数
// 初始化窗口和OpenGL上下文
RLAPI void InitWindow(int width, int height, const char *title);
// 关闭窗口并卸载OpenGL上下文
RLAPI void CloseWindow(void);
// 检查应用程序是否应该关闭（按下ESC键或点击窗口关闭图标）
RLAPI bool WindowShouldClose(void);
// 检查窗口是否已成功初始化
RLAPI bool IsWindowReady(void);
// 检查窗口当前是否为全屏模式
RLAPI bool IsWindowFullscreen(void);
// 检查窗口当前是否隐藏
RLAPI bool IsWindowHidden(void);
// 检查窗口当前是否最小化
RLAPI bool IsWindowMinimized(void);
// 检查窗口当前是否最大化
RLAPI bool IsWindowMaximized(void);
// 检查窗口当前是否获得焦点
RLAPI bool IsWindowFocused(void);
// 检查窗口在上一帧是否被调整大小
RLAPI bool IsWindowResized(void);
// 检查是否启用了一个特定的窗口标志
RLAPI bool IsWindowState(unsigned int flag);
// 使用标志设置窗口配置状态
RLAPI void SetWindowState(unsigned int flags);
// 清除窗口配置状态标志
RLAPI void ClearWindowState(unsigned int flags);
// 切换窗口状态：全屏/窗口模式，调整显示器以匹配窗口分辨率
RLAPI void ToggleFullscreen(void);
// 切换窗口状态：无边框窗口模式，调整窗口以匹配显示器分辨率
RLAPI void ToggleBorderlessWindowed(void);
// 设置窗口状态：最大化（如果窗口可调整大小）
RLAPI void MaximizeWindow(void);
// 设置窗口状态：最小化（如果窗口可调整大小）
RLAPI void MinimizeWindow(void);
// 设置窗口状态：非最小化/最大化
RLAPI void RestoreWindow(void);
// 设置窗口图标（单张图像，RGBA 32位）
RLAPI void SetWindowIcon(Image image);
// 设置窗口图标（多张图像，RGBA 32位）
RLAPI void SetWindowIcons(Image *images, int count);
// 设置窗口标题
RLAPI void SetWindowTitle(const char *title);
// 设置窗口在屏幕上的位置
RLAPI void SetWindowPosition(int x, int y);
// 设置当前窗口所在的显示器
RLAPI void SetWindowMonitor(int monitor);
// 设置窗口的最小尺寸（适用于可调整大小的窗口）
RLAPI void SetWindowMinSize(int width, int height);
// 设置窗口的最大尺寸（适用于可调整大小的窗口）
RLAPI void SetWindowMaxSize(int width, int height);
// 设置窗口尺寸
RLAPI void SetWindowSize(int width, int height);
// 设置窗口透明度 [0.0f..1.0f]
RLAPI void SetWindowOpacity(float opacity);
// 设置窗口获得焦点
RLAPI void SetWindowFocused(void);
// 获取原生窗口句柄
RLAPI void *GetWindowHandle(void);
// 获取当前屏幕宽度
RLAPI int GetScreenWidth(void);
// 获取当前屏幕高度
RLAPI int GetScreenHeight(void);
// 获取当前渲染宽度（考虑高DPI）
RLAPI int GetRenderWidth(void);
// 获取当前渲染高度（考虑高DPI）
RLAPI int GetRenderHeight(void);
// 获取连接的显示器数量
RLAPI int GetMonitorCount(void);
// 获取窗口所在的当前显示器
RLAPI int GetCurrentMonitor(void);
// 获取指定显示器的位置
RLAPI Vector2 GetMonitorPosition(int monitor);
// 获取指定显示器的宽度（显示器当前使用的视频模式）
RLAPI int GetMonitorWidth(int monitor);
// 获取指定显示器的高度（显示器当前使用的视频模式）
RLAPI int GetMonitorHeight(int monitor);
// 获取指定显示器的物理宽度（毫米）
RLAPI int GetMonitorPhysicalWidth(int monitor);
// 获取指定显示器的物理高度（毫米）
RLAPI int GetMonitorPhysicalHeight(int monitor);
// 获取指定显示器的刷新率
RLAPI int GetMonitorRefreshRate(int monitor);
// 获取窗口在显示器上的XY位置
RLAPI Vector2 GetWindowPosition(void);
// 获取窗口的缩放DPI因子
RLAPI Vector2 GetWindowScaleDPI(void);
// 获取指定显示器的可读UTF-8编码名称
RLAPI const char *GetMonitorName(int monitor);
// 设置剪贴板的文本内容
RLAPI void SetClipboardText(const char *text);
// 获取剪贴板的文本内容
RLAPI const char *GetClipboardText(void);
// 获取剪贴板的图像内容
RLAPI Image GetClipboardImage(void);
// 启用在EndDrawing()时等待事件，不自动轮询事件
RLAPI void EnableEventWaiting(void);
// 禁用在EndDrawing()时等待事件，自动轮询事件
RLAPI void DisableEventWaiting(void);

// 与光标相关的函数
RLAPI void ShowCursor(void);                                      // 显示光标
RLAPI void HideCursor(void);                                      // 隐藏光标
RLAPI bool IsCursorHidden(void);                                  // 检查光标是否不可见
RLAPI void EnableCursor(void);                                    // 启用光标（解锁光标）
RLAPI void DisableCursor(void);                                   // 禁用光标（锁定光标）
RLAPI bool IsCursorOnScreen(void);                                // 检查光标是否在屏幕上

// 绘图相关函数
RLAPI void ClearBackground(Color color);                          // 设置背景颜色（帧缓冲区清除颜色）
RLAPI void BeginDrawing(void);                                    // 设置画布（帧缓冲区）以开始绘图
RLAPI void EndDrawing(void);                                      // 结束画布绘图并交换缓冲区（双缓冲）
RLAPI void BeginMode2D(Camera2D camera);                          // 使用自定义相机开始2D模式绘图
RLAPI void EndMode2D(void);                                       // 结束自定义相机的2D模式绘图
RLAPI void BeginMode3D(Camera3D camera);                          // 使用自定义相机开始3D模式绘图
RLAPI void EndMode3D(void);                                       // 结束3D模式绘图并返回默认的2D正交模式
RLAPI void BeginTextureMode(RenderTexture2D target);              // 开始向渲染纹理绘图
RLAPI void EndTextureMode(void);                                  // 结束向渲染纹理绘图
RLAPI void BeginShaderMode(Shader shader);                        // 开始使用自定义着色器绘图
RLAPI void EndShaderMode(void);                                   // 结束自定义着色器绘图（使用默认着色器）
RLAPI void BeginBlendMode(int mode);                              // 开始混合模式（alpha、加法、乘法、减法、自定义）
RLAPI void EndBlendMode(void);                                    // 结束混合模式（重置为默认：alpha混合）
RLAPI void BeginScissorMode(int x, int y, int width, int height); // 开始裁剪模式（定义后续绘图的屏幕区域）
RLAPI void EndScissorMode(void);                                  // 结束裁剪模式
RLAPI void BeginVrStereoMode(VrStereoConfig config);              // 开始立体渲染（需要VR模拟器）
RLAPI void EndVrStereoMode(void);                                 // 结束立体渲染（需要VR模拟器）

// VR模拟器的VR立体配置函数
// 为VR模拟器设备参数加载VR立体配置
RLAPI VrStereoConfig LoadVrStereoConfig(VrDeviceInfo device);
// 卸载VR立体配置
RLAPI void UnloadVrStereoConfig(VrStereoConfig config);

// 着色器管理函数
// 注意: OpenGL 1.1 不支持着色器功能
// 从文件加载着色器并绑定默认位置
RLAPI Shader LoadShader(const char *vsFileName, const char *fsFileName);
// 从代码字符串加载着色器并绑定默认位置
RLAPI Shader LoadShaderFromMemory(const char *vsCode, const char *fsCode);
// 检查着色器是否有效（已加载到 GPU）
RLAPI bool IsShaderValid(Shader shader);
// 获取着色器统一变量的位置
RLAPI int GetShaderLocation(Shader shader, const char *uniformName);
// 获取着色器属性的位置
RLAPI int GetShaderLocationAttrib(Shader shader, const char *attribName);
// 设置着色器统一变量的值
RLAPI void SetShaderValue(Shader shader, int locIndex, const void *value, int uniformType);
// 设置着色器统一变量的值向量
RLAPI void SetShaderValueV(Shader shader, int locIndex, const void *value, int uniformType, int count);
// 设置着色器统一变量的值（4x4 矩阵）
RLAPI void SetShaderValueMatrix(Shader shader, int locIndex, Matrix mat);
// 设置着色器统一变量的纹理值（采样器 2D）
RLAPI void SetShaderValueTexture(Shader shader, int locIndex, Texture2D texture);
// 从 GPU 内存（VRAM）中卸载着色器
RLAPI void UnloadShader(Shader shader);

// 与屏幕空间相关的函数
#define GetMouseRay GetScreenToWorldRay     // 为兼容旧版本 raylib 的代码技巧
// 从屏幕位置（如鼠标位置）获取一条射线（即射线追踪）
RLAPI Ray GetScreenToWorldRay(Vector2 position, Camera camera);
// 在视口内从屏幕位置（如鼠标位置）获取一条射线（即射线追踪）
RLAPI Ray GetScreenToWorldRayEx(Vector2 position, Camera camera, int width, int height);
// 获取 3D 世界空间位置在屏幕空间中的位置
RLAPI Vector2 GetWorldToScreen(Vector3 position, Camera camera);
// 获取 3D 世界空间位置在指定视口尺寸下的屏幕空间位置
RLAPI Vector2 GetWorldToScreenEx(Vector3 position, Camera camera, int width, int height);
// 获取 2D 相机世界空间位置在屏幕空间中的位置
RLAPI Vector2 GetWorldToScreen2D(Vector2 position, Camera2D camera);
// 获取 2D 相机屏幕空间位置在世界空间中的位置
RLAPI Vector2 GetScreenToWorld2D(Vector2 position, Camera2D camera);
// 获取相机的变换矩阵（视图矩阵）
RLAPI Matrix GetCameraMatrix(Camera camera);
// 获取 2D 相机的变换矩阵
RLAPI Matrix GetCameraMatrix2D(Camera2D camera);

// 与时间相关的函数
RLAPI void SetTargetFPS(int fps);                                 // 设置目标帧率（最大值）
RLAPI float GetFrameTime(void);                                   // 获取上一帧绘制所用的时间（以秒为单位，即增量时间）
RLAPI double GetTime(void);                                       // 获取自InitWindow()调用以来经过的时间（以秒为单位）
RLAPI int GetFPS(void);                                           // 获取当前帧率

// 自定义帧控制函数
// 注意: 这些函数供需要完全控制帧处理的高级用户使用
// 默认情况下，EndDrawing() 完成以下工作: 绘制所有内容 + 交换屏幕缓冲区 + 管理帧计时 + 轮询输入事件
// 若要避免这种行为并手动控制帧处理过程，请在 config.h 中启用: SUPPORT_CUSTOM_FRAME_CONTROL
RLAPI void SwapScreenBuffer(void);                                // 交换后缓冲区和前缓冲区（屏幕绘制）
RLAPI void PollInputEvents(void);                                 // 注册所有输入事件
RLAPI void WaitTime(double seconds);                              // 等待一段时间（暂停程序执行）

// 随机值生成函数
RLAPI void SetRandomSeed(unsigned int seed);                      // 设置随机数生成器的种子
RLAPI int GetRandomValue(int min, int max);                       // 获取一个介于 min 和 max 之间的随机值（包含两端）
RLAPI int *LoadRandomSequence(unsigned int count, int min, int max); // 加载随机值序列，无重复值
RLAPI void UnloadRandomSequence(int *sequence);                   // 卸载随机值序列

// 杂项函数
RLAPI void TakeScreenshot(const char *fileName);                  // 对当前屏幕进行截图（文件名扩展名定义格式）
RLAPI void SetConfigFlags(unsigned int flags);                    // 设置初始化配置标志（查看 FLAGS）
RLAPI void OpenURL(const char *url);                              // 使用默认系统浏览器打开 URL（如果可用）

// 注意: 以下函数在 [utils] 模块中实现
//------------------------------------------------------------------
RLAPI void TraceLog(int logLevel, const char *text, ...);         // 显示跟踪日志消息（LOG_DEBUG、LOG_INFO、LOG_WARNING、LOG_ERROR 等）
RLAPI void SetTraceLogLevel(int logLevel);                        // 设置当前阈值（最低）日志级别
RLAPI void *MemAlloc(unsigned int size);                          // 内部内存分配器
RLAPI void *MemRealloc(void *ptr, unsigned int size);             // 内部内存重新分配器
RLAPI void MemFree(void *ptr);                                    // 内部内存释放

// 设置自定义回调函数
// 警告: 回调函数的设置仅适用于高级用户
RLAPI void SetTraceLogCallback(TraceLogCallback callback);         // 设置自定义跟踪日志回调函数
RLAPI void SetLoadFileDataCallback(LoadFileDataCallback callback); // 设置自定义文件二进制数据加载回调函数
RLAPI void SetSaveFileDataCallback(SaveFileDataCallback callback); // 设置自定义文件二进制数据保存回调函数
RLAPI void SetLoadFileTextCallback(LoadFileTextCallback callback); // 设置自定义文件文本数据加载回调函数
RLAPI void SetSaveFileTextCallback(SaveFileTextCallback callback); // 设置自定义文件文本数据保存回调函数

// 文件管理函数
RLAPI unsigned char *LoadFileData(const char *fileName, int *dataSize); // 以字节数组形式加载文件数据（读取）
RLAPI void UnloadFileData(unsigned char *data);                   // 卸载由LoadFileData()分配的文件数据
RLAPI bool SaveFileData(const char *fileName, void *data, int dataSize); // 将字节数组中的数据保存到文件（写入），成功返回true
RLAPI bool ExportDataAsCode(const unsigned char *data, int dataSize, const char *fileName); // 将数据导出为代码文件（.h），成功返回true
RLAPI char *LoadFileText(const char *fileName);                   // 从文件中加载文本数据（读取），返回以'\0'结尾的字符串
RLAPI void UnloadFileText(char *text);                            // 卸载由LoadFileText()分配的文件文本数据
RLAPI bool SaveFileText(const char *fileName, char *text);        // 将文本数据保存到文件（写入），字符串必须以'\0'结尾，成功返回true
//------------------------------------------------------------------

// 文件系统函数
RLAPI bool FileExists(const char *fileName);                      // 检查文件是否存在
RLAPI bool DirectoryExists(const char *dirPath);                  // 检查目录路径是否存在
RLAPI bool IsFileExtension(const char *fileName, const char *ext); // 检查文件扩展名（包括点号：.png, .wav）
RLAPI int GetFileLength(const char *fileName);                    // 获取文件的字节长度（注意: GetFileSize()与windows.h冲突）
RLAPI const char *GetFileExtension(const char *fileName);         // 获取文件名中扩展名的指针（包括点号: '.png'）
RLAPI const char *GetFileName(const char *filePath);              // 获取路径字符串中的文件名指针
RLAPI const char *GetFileNameWithoutExt(const char *filePath);    // 获取不带扩展名的文件名（使用静态字符串）
RLAPI const char *GetDirectoryPath(const char *filePath);         // 获取包含路径的文件名的完整路径（使用静态字符串）
RLAPI const char *GetPrevDirectoryPath(const char *dirPath);      // 获取给定路径的上一级目录路径（使用静态字符串）
RLAPI const char *GetWorkingDirectory(void);                      // 获取当前工作目录（使用静态字符串）
RLAPI const char *GetApplicationDirectory(void);                  // 获取运行中应用程序的目录（使用静态字符串）
RLAPI int MakeDirectory(const char *dirPath);                     // 创建目录（包括请求的完整路径），成功返回0
RLAPI bool ChangeDirectory(const char *dir);                      // 更改工作目录，成功返回true
RLAPI bool IsPathFile(const char *path);                          // 检查给定路径是文件还是目录
RLAPI bool IsFileNameValid(const char *fileName);                 // 检查文件名是否对平台/操作系统有效
RLAPI FilePathList LoadDirectoryFiles(const char *dirPath);       // 加载目录中的文件路径
RLAPI FilePathList LoadDirectoryFilesEx(const char *basePath, const char *filter, bool scanSubdirs); // 加载目录中的文件路径，并进行扩展名过滤和递归目录扫描。在过滤字符串中使用 'DIR' 可将目录包含在结果中
RLAPI void UnloadDirectoryFiles(FilePathList files);              // 卸载文件路径
RLAPI bool IsFileDropped(void);                                   // 检查是否有文件被拖放到窗口中
RLAPI FilePathList LoadDroppedFiles(void);                        // 加载被拖放的文件路径
RLAPI void UnloadDroppedFiles(FilePathList files);                // 卸载被拖放的文件路径
RLAPI long GetFileModTime(const char *fileName);                  // 获取文件的修改时间（最后写入时间）

// 压缩/编码功能
RLAPI unsigned char *CompressData(const unsigned char *data, int dataSize, int *compDataSize);        // 压缩数据（DEFLATE算法），内存必须使用MemFree()释放
RLAPI unsigned char *DecompressData(const unsigned char *compData, int compDataSize, int *dataSize);  // 解压缩数据（DEFLATE算法），内存必须使用MemFree()释放
RLAPI char *EncodeDataBase64(const unsigned char *data, int dataSize, int *outputSize);               // 将数据编码为Base64字符串，内存必须使用MemFree()释放
RLAPI unsigned char *DecodeDataBase64(const unsigned char *data, int *outputSize);                    // 解码Base64字符串数据，内存必须使用MemFree()释放
RLAPI unsigned int ComputeCRC32(unsigned char *data, int dataSize);     // 计算CRC32哈希码
RLAPI unsigned int *ComputeMD5(unsigned char *data, int dataSize);      // 计算MD5哈希码，返回静态int[4]数组（16字节）
RLAPI unsigned int *ComputeSHA1(unsigned char *data, int dataSize);      // 计算SHA1哈希码，返回静态int[5]数组（20字节）

// 自动化事件功能
// 从文件加载自动化事件列表，若传入 NULL 则返回空列表，容量为 MAX_AUTOMATION_EVENTS
RLAPI AutomationEventList LoadAutomationEventList(const char *fileName);
// 从文件中卸载自动化事件列表
RLAPI void UnloadAutomationEventList(AutomationEventList list);
// 将自动化事件列表导出为文本文件
RLAPI bool ExportAutomationEventList(AutomationEventList list, const char *fileName);
// 设置要记录的自动化事件列表
RLAPI void SetAutomationEventList(AutomationEventList *list);
// 设置自动化事件内部的基础帧，开始记录
RLAPI void SetAutomationEventBaseFrame(int frame);
// 开始记录自动化事件（必须先设置 AutomationEventList）
RLAPI void StartAutomationEventRecording(void);
// 停止记录自动化事件
RLAPI void StopAutomationEventRecording(void);
// 播放已记录的自动化事件
RLAPI void PlayAutomationEvent(AutomationEvent event);
//------------------------------------------------------------------------------------

// 输入处理函数 (模块: core)
//------------------------------------------------------------------------------------

// 与输入相关的函数：键盘
// 检查某个键是否被按下一次
RLAPI bool IsKeyPressed(int key);                             
// 检查某个键是否再次被按下
RLAPI bool IsKeyPressedRepeat(int key);                       
// 检查某个键是否正在被按下
RLAPI bool IsKeyDown(int key);                                
// 检查某个键是否被释放一次
RLAPI bool IsKeyReleased(int key);                            
// 检查某个键是否未被按下
RLAPI bool IsKeyUp(int key);                                  
// 获取按下的键（键码），多次调用以处理排队的键，队列空时返回 0
RLAPI int GetKeyPressed(void);                                
// 获取按下的字符（Unicode），多次调用以处理排队的字符，队列空时返回 0
RLAPI int GetCharPressed(void);                               
// 设置一个自定义键来退出程序（默认是 ESC）
RLAPI void SetExitKey(int key);                               

// 与输入相关的函数：游戏手柄
// 检查某个游戏手柄是否可用
RLAPI bool IsGamepadAvailable(int gamepad);                                        
// 获取游戏手柄的内部名称 ID
RLAPI const char *GetGamepadName(int gamepad);                                     
// 检查游戏手柄的某个按钮是否被按下一次
RLAPI bool IsGamepadButtonPressed(int gamepad, int button);                        
// 检查游戏手柄的某个按钮是否正在被按下
RLAPI bool IsGamepadButtonDown(int gamepad, int button);                           
// 检查游戏手柄的某个按钮是否被释放一次
RLAPI bool IsGamepadButtonReleased(int gamepad, int button);                       
// 检查游戏手柄的某个按钮是否未被按下
RLAPI bool IsGamepadButtonUp(int gamepad, int button);                             
// 获取最后按下的游戏手柄按钮
RLAPI int GetGamepadButtonPressed(void);                                           
// 获取某个游戏手柄的轴数量
RLAPI int GetGamepadAxisCount(int gamepad);                                        
// 获取某个游戏手柄的某个轴的移动值
RLAPI float GetGamepadAxisMovement(int gamepad, int axis);                         
// 设置内部游戏手柄映射（SDL_GameControllerDB）
RLAPI int SetGamepadMappings(const char *mappings);                                
// 设置游戏手柄两个马达的震动（持续时间以秒为单位）
RLAPI void SetGamepadVibration(int gamepad, float leftMotor, float rightMotor, float duration); 

// 与输入相关的函数：鼠标
// 检查某个鼠标按钮是否被按下一次
RLAPI bool IsMouseButtonPressed(int button);                  
// 检查某个鼠标按钮是否正在被按下
RLAPI bool IsMouseButtonDown(int button);                     
// 检查某个鼠标按钮是否被释放一次
RLAPI bool IsMouseButtonReleased(int button);                 
// 检查某个鼠标按钮是否未被按下
RLAPI bool IsMouseButtonUp(int button);                       
// 获取鼠标的 X 坐标
RLAPI int GetMouseX(void);                                    
// 获取鼠标的 Y 坐标
RLAPI int GetMouseY(void);                                    
// 获取鼠标的 XY 坐标
RLAPI Vector2 GetMousePosition(void);                         
// 获取两帧之间鼠标的移动增量
RLAPI Vector2 GetMouseDelta(void);                            
// 设置鼠标的 XY 坐标
RLAPI void SetMousePosition(int x, int y);                    
// 设置鼠标的偏移量
RLAPI void SetMouseOffset(int offsetX, int offsetY);          
// 设置鼠标的缩放比例
RLAPI void SetMouseScale(float scaleX, float scaleY);         
// 获取鼠标滚轮在 X 或 Y 方向上的最大移动量
RLAPI float GetMouseWheelMove(void);                          
// 获取鼠标滚轮在 X 和 Y 方向上的移动量
RLAPI Vector2 GetMouseWheelMoveV(void);                       
// 设置鼠标光标样式
RLAPI void SetMouseCursor(int cursor);                        

// 与输入相关的函数：触摸
// 获取触摸点 0 的 X 坐标（相对于屏幕尺寸）
RLAPI int GetTouchX(void);                                    
// 获取触摸点 0 的 Y 坐标（相对于屏幕尺寸）
RLAPI int GetTouchY(void);                                    
// 获取指定触摸点索引的 XY 坐标（相对于屏幕尺寸）
RLAPI Vector2 GetTouchPosition(int index);                    
// 获取指定索引的触摸点标识符
RLAPI int GetTouchPointId(int index);                         
// 获取触摸点的数量
RLAPI int GetTouchPointCount(void);

//------------------------------------------------------------------------------------
// 手势和触摸处理函数 (模块: rgestures)
//------------------------------------------------------------------------------------
// 使用标志启用一组手势
RLAPI void SetGesturesEnabled(unsigned int flags);
// 检查是否检测到某个手势
RLAPI bool IsGestureDetected(unsigned int gesture);
// 获取最新检测到的手势
RLAPI int GetGestureDetected(void);
// 获取手势按住的持续时间（以秒为单位）
RLAPI float GetGestureHoldDuration(void);
// 获取手势拖动向量
RLAPI Vector2 GetGestureDragVector(void);
// 获取手势拖动角度
RLAPI float GetGestureDragAngle(void);
// 获取手势捏合的增量
RLAPI Vector2 GetGesturePinchVector(void);
// 获取手势捏合角度
RLAPI float GetGesturePinchAngle(void);


// 样条线绘制函数
// 绘制线性样条线，至少需要2个点
RLAPI void DrawSplineLinear(const Vector2 *points, int pointCount, float thick, Color color);
// 绘制B样条线，至少需要4个点
RLAPI void DrawSplineBasis(const Vector2 *points, int pointCount, float thick, Color color);
// 绘制Catmull-Rom样条线，至少需要4个点
RLAPI void DrawSplineCatmullRom(const Vector2 *points, int pointCount, float thick, Color color);
// 绘制二次贝塞尔样条线，至少需要3个点（1个控制点）：[p1, c2, p3, c4...]
RLAPI void DrawSplineBezierQuadratic(const Vector2 *points, int pointCount, float thick, Color color);
// 绘制三次贝塞尔样条线，至少需要4个点（2个控制点）：[p1, c2, c3, p4, c5, c6...]
RLAPI void DrawSplineBezierCubic(const Vector2 *points, int pointCount, float thick, Color color);
// 绘制线性样条线段，需要2个点
RLAPI void DrawSplineSegmentLinear(Vector2 p1, Vector2 p2, float thick, Color color);
// 绘制B样条线段，需要4个点
RLAPI void DrawSplineSegmentBasis(Vector2 p1, Vector2 p2, Vector2 p3, Vector2 p4, float thick, Color color);
// 绘制Catmull-Rom样条线段，需要4个点
RLAPI void DrawSplineSegmentCatmullRom(Vector2 p1, Vector2 p2, Vector2 p3, Vector2 p4, float thick, Color color);
// 绘制二次贝塞尔样条线段，需要2个点和1个控制点
RLAPI void DrawSplineSegmentBezierQuadratic(Vector2 p1, Vector2 c2, Vector2 p3, float thick, Color color);
// 绘制三次贝塞尔样条线段，需要2个点和2个控制点
RLAPI void DrawSplineSegmentBezierCubic(Vector2 p1, Vector2 c2, Vector2 c3, Vector2 p4, float thick, Color color);

// 样条线段点评估函数，给定t值范围为 [0.0f .. 1.0f]
// 获取（评估）线性样条线上的点
RLAPI Vector2 GetSplinePointLinear(Vector2 startPos, Vector2 endPos, float t);
// 获取（评估）B样条线上的点
RLAPI Vector2 GetSplinePointBasis(Vector2 p1, Vector2 p2, Vector2 p3, Vector2 p4, float t);
// 获取（评估）Catmull-Rom样条线上的点
RLAPI Vector2 GetSplinePointCatmullRom(Vector2 p1, Vector2 p2, Vector2 p3, Vector2 p4, float t);
// 获取（评估）二次贝塞尔样条线上的点
RLAPI Vector2 GetSplinePointBezierQuad(Vector2 p1, Vector2 c2, Vector2 p3, float t);
// 获取（评估）三次贝塞尔样条线上的点
RLAPI Vector2 GetSplinePointBezierCubic(Vector2 p1, Vector2 c2, Vector2 c3, Vector2 p4, float t);

// 基本形状碰撞检测函数
// 检查两个矩形之间是否发生碰撞
RLAPI bool CheckCollisionRecs(Rectangle rec1, Rectangle rec2);
// 检查两个圆之间是否发生碰撞
RLAPI bool CheckCollisionCircles(Vector2 center1, float radius1, Vector2 center2, float radius2);
// 检查圆和矩形之间是否发生碰撞
RLAPI bool CheckCollisionCircleRec(Vector2 center, float radius, Rectangle rec);
// 检查圆是否与由两点 [p1] 和 [p2] 构成的直线发生碰撞
RLAPI bool CheckCollisionCircleLine(Vector2 center, float radius, Vector2 p1, Vector2 p2);
// 检查点是否在矩形内部
RLAPI bool CheckCollisionPointRec(Vector2 point, Rectangle rec);
// 检查点是否在圆内部
RLAPI bool CheckCollisionPointCircle(Vector2 point, Vector2 center, float radius);
// 检查点是否在三角形内部
RLAPI bool CheckCollisionPointTriangle(Vector2 point, Vector2 p1, Vector2 p2, Vector2 p3);
// 检查点是否在由两点 [p1] 和 [p2] 构成的直线上，允许一定的像素误差 [threshold]
RLAPI bool CheckCollisionPointLine(Vector2 point, Vector2 p1, Vector2 p2, int threshold);
// 检查点是否在由顶点数组描述的多边形内部
RLAPI bool CheckCollisionPointPoly(Vector2 point, const Vector2 *points, int pointCount);
// 检查由两个点定义的两条直线是否发生碰撞，通过引用返回碰撞点
RLAPI bool CheckCollisionLines(Vector2 startPos1, Vector2 endPos1, Vector2 startPos2, Vector2 endPos2, Vector2 *collisionPoint);
// 获取两个矩形碰撞后的重叠矩形
RLAPI Rectangle GetCollisionRec(Rectangle rec1, Rectangle rec2);

//------------------------------------------------------------------------------------
// 纹理加载和绘制函数 (模块: 纹理)
//------------------------------------------------------------------------------------

// 图像加载函数
// 注意: 这些函数不需要GPU访问
RLAPI Image LoadImage(const char *fileName);                                                             // 从文件加载图像到CPU内存 (RAM)
RLAPI Image LoadImageRaw(const char *fileName, int width, int height, int format, int headerSize);       // 从原始文件数据加载图像
RLAPI Image LoadImageAnim(const char *fileName, int *frames);                                            // 从文件加载图像序列 (帧追加到image.data)
RLAPI Image LoadImageAnimFromMemory(const char *fileType, const unsigned char *fileData, int dataSize, int *frames); // 从内存缓冲区加载图像序列
RLAPI Image LoadImageFromMemory(const char *fileType, const unsigned char *fileData, int dataSize);      // 从内存缓冲区加载图像，fileType指文件扩展名，例如: '.png'
RLAPI Image LoadImageFromTexture(Texture2D texture);                                                     // 从GPU纹理数据加载图像
RLAPI Image LoadImageFromScreen(void);                                                                   // 从屏幕缓冲区加载图像 (截图)
RLAPI bool IsImageValid(Image image);                                                                    // 检查图像是否有效 (数据和参数)
RLAPI void UnloadImage(Image image);                                                                     // 从CPU内存 (RAM) 卸载图像
RLAPI bool ExportImage(Image image, const char *fileName);                                               // 将图像数据导出到文件，成功返回true
RLAPI unsigned char *ExportImageToMemory(Image image, const char *fileType, int *fileSize);              // 将图像导出到内存缓冲区
RLAPI bool ExportImageAsCode(Image image, const char *fileName);                                         // 将图像导出为定义字节数组的代码文件，成功返回true

// 图像生成函数
RLAPI Image GenImageColor(int width, int height, Color color);                                           // 生成图像: 纯色
RLAPI Image GenImageGradientLinear(int width, int height, int direction, Color start, Color end);        // 生成图像: 线性渐变，方向为度数 [0..360]，0=垂直渐变
RLAPI Image GenImageGradientRadial(int width, int height, float density, Color inner, Color outer);      // 生成图像: 径向渐变
RLAPI Image GenImageGradientSquare(int width, int height, float density, Color inner, Color outer);      // 生成图像: 方形渐变
RLAPI Image GenImageChecked(int width, int height, int checksX, int checksY, Color col1, Color col2);    // 生成图像: 棋盘格
RLAPI Image GenImageWhiteNoise(int width, int height, float factor);                                     // 生成图像: 白噪声
RLAPI Image GenImagePerlinNoise(int width, int height, int offsetX, int offsetY, float scale);           // 生成图像: 柏林噪声
RLAPI Image GenImageCellular(int width, int height, int tileSize);                                       // 生成图像: 细胞算法，更大的tileSize意味着更大的细胞
RLAPI Image GenImageText(int width, int height, const char *text);                                       // 生成图像: 从文本数据生成灰度图像

// 图像操作函数
RLAPI Image ImageCopy(Image image);                                                                      // 创建图像副本 (用于变换操作)
RLAPI Image ImageFromImage(Image image, Rectangle rec);                                                  // 从另一个图像的一部分创建图像
RLAPI Image ImageFromChannel(Image image, int selectedChannel);                                          // 从另一个图像的选定通道创建图像 (灰度图)
RLAPI Image ImageText(const char *text, int fontSize, Color color);                                      // 从文本创建图像 (默认字体)
RLAPI Image ImageTextEx(Font font, const char *text, float fontSize, float spacing, Color tint);         // 从文本创建图像 (自定义精灵字体)
RLAPI void ImageFormat(Image *image, int newFormat);                                                     // 将图像数据转换为所需格式
RLAPI void ImageToPOT(Image *image, Color fill);                                                         // 将图像转换为2的幂次方大小 (POT)
RLAPI void ImageCrop(Image *image, Rectangle crop);                                                      // 将图像裁剪到定义的矩形
RLAPI void ImageAlphaCrop(Image *image, float threshold);                                                // 根据alpha值裁剪图像
RLAPI void ImageAlphaClear(Image *image, Color color, float threshold);                                  // 将alpha通道清除为所需颜色
RLAPI void ImageAlphaMask(Image *image, Image alphaMask);                                                // 对图像应用alpha遮罩
RLAPI void ImageAlphaPremultiply(Image *image);                                                          // 预乘alpha通道
RLAPI void ImageBlurGaussian(Image *image, int blurSize);                                                // 使用盒式模糊近似应用高斯模糊
RLAPI void ImageKernelConvolution(Image *image, const float *kernel, int kernelSize);                    // 对图像应用自定义方形卷积核
RLAPI void ImageResize(Image *image, int newWidth, int newHeight);                                       // 调整图像大小 (双三次缩放算法)
RLAPI void ImageResizeNN(Image *image, int newWidth,int newHeight);                                      // 调整图像大小 (最近邻缩放算法)
RLAPI void ImageResizeCanvas(Image *image, int newWidth, int newHeight, int offsetX, int offsetY, Color fill); // 调整画布大小并用颜色填充
RLAPI void ImageMipmaps(Image *image);                                                                   // 为提供的图像计算所有mipmap级别
RLAPI void ImageDither(Image *image, int rBpp, int gBpp, int bBpp, int aBpp);                            // 将图像数据抖动到16位或更低 (Floyd-Steinberg抖动)
RLAPI void ImageFlipVertical(Image *image);                                                              // 垂直翻转图像
RLAPI void ImageFlipHorizontal(Image *image);                                                            // 水平翻转图像
RLAPI void ImageRotate(Image *image, int degrees);                                                       // 按输入角度旋转图像 (度数 -359 到 359)
RLAPI void ImageRotateCW(Image *image);                                                                  // 顺时针旋转图像90度
RLAPI void ImageRotateCCW(Image *image);                                                                 // 逆时针旋转图像90度
RLAPI void ImageColorTint(Image *image, Color color);                                                    // 修改图像颜色: 着色
RLAPI void ImageColorInvert(Image *image);                                                               // 修改图像颜色: 反转
RLAPI void ImageColorGrayscale(Image *image);                                                            // 修改图像颜色: 灰度化
RLAPI void ImageColorContrast(Image *image, float contrast);                                             // 修改图像颜色: 对比度 (-100 到 100)
RLAPI void ImageColorBrightness(Image *image, int brightness);                                           // 修改图像颜色: 亮度 (-255 到 255)
RLAPI void ImageColorReplace(Image *image, Color color, Color replace);                                  // 修改图像颜色: 替换颜色
RLAPI Color *LoadImageColors(Image image);                                                               // 从图像加载颜色数据作为Color数组 (RGBA - 32位)
RLAPI Color *LoadImagePalette(Image image, int maxPaletteSize, int *colorCount);                         // 从图像加载颜色调色板作为Color数组 (RGBA - 32位)
RLAPI void UnloadImageColors(Color *colors);                                                             // 卸载使用LoadImageColors()加载的颜色数据
RLAPI void UnloadImagePalette(Color *colors);                                                            // 卸载使用LoadImagePalette()加载的颜色调色板
RLAPI Rectangle GetImageAlphaBorder(Image image, float threshold);                                       // 获取图像alpha边界矩形
RLAPI Color GetImageColor(Image image, int x, int y);                                                    // 获取图像在 (x, y) 位置的像素颜色

// 图像绘制函数
// 注意: 图像软件渲染函数 (CPU)
RLAPI void ImageClearBackground(Image *dst, Color color);                                                // 用给定颜色清除图像背景
RLAPI void ImageDrawPixel(Image *dst, int posX, int posY, Color color);                                  // 在图像内绘制像素
RLAPI void ImageDrawPixelV(Image *dst, Vector2 position, Color color);                                   // 在图像内绘制像素 (向量版本)
RLAPI void ImageDrawLine(Image *dst, int startPosX, int startPosY, int endPosX, int endPosY, Color color); // 在图像内绘制线条
RLAPI void ImageDrawLineV(Image *dst, Vector2 start, Vector2 end, Color color);                          // 在图像内绘制线条 (向量版本)
RLAPI void ImageDrawLineEx(Image *dst, Vector2 start, Vector2 end, int thick, Color color);              // 在图像内绘制定义厚度的线条
RLAPI void ImageDrawCircle(Image *dst, int centerX, int centerY, int radius, Color color);               // 在图像内绘制填充的圆形
RLAPI void ImageDrawCircleV(Image *dst, Vector2 center, int radius, Color color);                        // 在图像内绘制填充的圆形 (向量版本)
RLAPI void ImageDrawCircleLines(Image *dst, int centerX, int centerY, int radius, Color color);          // 在图像内绘制圆形轮廓
RLAPI void ImageDrawCircleLinesV(Image *dst, Vector2 center, int radius, Color color);                   // 在图像内绘制圆形轮廓 (向量版本)
RLAPI void ImageDrawRectangle(Image *dst, int posX, int posY, int width, int height, Color color);       // 在图像内绘制矩形
RLAPI void ImageDrawRectangleV(Image *dst, Vector2 position, Vector2 size, Color color);                 // 在图像内绘制矩形 (向量版本)
RLAPI void ImageDrawRectangleRec(Image *dst, Rectangle rec, Color color);                                // 在图像内绘制矩形
RLAPI void ImageDrawRectangleLines(Image *dst, Rectangle rec, int thick, Color color);                   // 在图像内绘制矩形线条
RLAPI void ImageDrawTriangle(Image *dst, Vector2 v1, Vector2 v2, Vector2 v3, Color color);               // 在图像内绘制三角形
RLAPI void ImageDrawTriangleEx(Image *dst, Vector2 v1, Vector2 v2, Vector2 v3, Color c1, Color c2, Color c3); // 在图像内绘制带有插值颜色的三角形
RLAPI void ImageDrawTriangleLines(Image *dst, Vector2 v1, Vector2 v2, Vector2 v3, Color color);          // 在图像内绘制三角形轮廓
RLAPI void ImageDrawTriangleFan(Image *dst, Vector2 *points, int pointCount, Color color);               // 在图像内绘制由点定义的三角形扇 (第一个顶点是中心)
RLAPI void ImageDrawTriangleStrip(Image *dst, Vector2 *points, int pointCount, Color color);             // 在图像内绘制由点定义的三角形条带
RLAPI void ImageDraw(Image *dst, Image src, Rectangle srcRec, Rectangle dstRec, Color tint);             // 在目标图像内绘制源图像 (对源图像应用色调)
RLAPI void ImageDrawText(Image *dst, const char *text, int posX, int posY, int fontSize, Color color);   // 在图像 (目标) 内绘制文本 (使用默认字体)
RLAPI void ImageDrawTextEx(Image *dst, Font font, const char *text, Vector2 position, float fontSize, float spacing, Color tint); // 在图像 (目标) 内绘制文本 (自定义精灵字体)

// 纹理加载函数
// 注意: 这些函数需要访问GPU
RLAPI Texture2D LoadTexture(const char *fileName);                                                       // 从文件加载纹理到GPU内存 (VRAM)
RLAPI Texture2D LoadTextureFromImage(Image image);                                                       // 从图像数据加载纹理
RLAPI TextureCubemap LoadTextureCubemap(Image image, int layout);                                        // 从图像加载立方体贴图，支持多种图像立方体贴图布局
RLAPI RenderTexture2D LoadRenderTexture(int width, int height);                                          // 加载用于渲染的纹理 (帧缓冲区)
RLAPI bool IsTextureValid(Texture2D texture);                                                            // 检查纹理是否有效 (已加载到GPU)
RLAPI void UnloadTexture(Texture2D texture);                                                             // 从GPU内存 (VRAM) 卸载纹理
RLAPI bool IsRenderTextureValid(RenderTexture2D target);                                                 // 检查渲染纹理是否有效 (已加载到GPU)
RLAPI void UnloadRenderTexture(RenderTexture2D target);                                                  // 从GPU内存 (VRAM) 卸载渲染纹理
RLAPI void UpdateTexture(Texture2D texture, const void *pixels);                                         // 用新数据更新GPU纹理
RLAPI void UpdateTextureRec(Texture2D texture, Rectangle rec, const void *pixels);                       // 用新数据更新GPU纹理的矩形区域

// 纹理配置函数
RLAPI void GenTextureMipmaps(Texture2D *texture);                                                        // 为纹理生成GPU多级渐远纹理
RLAPI void SetTextureFilter(Texture2D texture, int filter);                                              // 设置纹理缩放过滤模式
RLAPI void SetTextureWrap(Texture2D texture, int wrap);                                                  // 设置纹理环绕模式

// 纹理绘制函数
RLAPI void DrawTexture(Texture2D texture, int posX, int posY, Color tint);                               // 绘制一个Texture2D
RLAPI void DrawTextureV(Texture2D texture, Vector2 position, Color tint);                                // 以Vector2定义的位置绘制一个Texture2D
RLAPI void DrawTextureEx(Texture2D texture, Vector2 position, float rotation, float scale, Color tint);  // 用扩展参数绘制一个Texture2D
RLAPI void DrawTextureRec(Texture2D texture, Rectangle source, Vector2 position, Color tint);            // 绘制由矩形定义的纹理的一部分
RLAPI void DrawTexturePro(Texture2D texture, Rectangle source, Rectangle dest, Vector2 origin, float rotation, Color tint); // 用'pro'参数绘制由矩形定义的纹理的一部分
RLAPI void DrawTextureNPatch(Texture2D texture, NPatchInfo nPatchInfo, Rectangle dest, Vector2 origin, float rotation, Color tint); // 绘制一个可以很好地拉伸或收缩的纹理（或其一部分）

// 颜色/像素相关函数
// 检查两种颜色是否相等
RLAPI bool ColorIsEqual(Color col1, Color col2);
// 获取应用了透明度的颜色，透明度取值范围为 0.0f 到 1.0f
RLAPI Color Fade(Color color, float alpha);
// 获取颜色的十六进制值 (0xRRGGBBAA)
RLAPI int ColorToInt(Color color);
// 获取颜色归一化后的浮点值 [0..1]
RLAPI Vector4 ColorNormalize(Color color);
// 从归一化的值 [0..1] 获取颜色
RLAPI Color ColorFromNormalized(Vector4 normalized);
// 获取颜色的 HSV 值，色调 [0..360]，饱和度/明度 [0..1]
RLAPI Vector3 ColorToHSV(Color color);
// 从 HSV 值获取颜色，色调 [0..360]，饱和度/明度 [0..1]
RLAPI Color ColorFromHSV(float hue, float saturation, float value);
// 获取与另一种颜色相乘后的颜色
RLAPI Color ColorTint(Color color, Color tint);
// 获取经过亮度校正后的颜色，亮度因子取值范围为 -1.0f 到 1.0f
RLAPI Color ColorBrightness(Color color, float factor);
// 获取经过对比度校正后的颜色，对比度值介于 -1.0f 和 1.0f 之间
RLAPI Color ColorContrast(Color color, float contrast);
// 获取应用了透明度的颜色，透明度取值范围为 0.0f 到 1.0f
RLAPI Color ColorAlpha(Color color, float alpha);
// 获取源颜色以指定色调与目标颜色进行 alpha 混合后的颜色
RLAPI Color ColorAlphaBlend(Color dst, Color src, Color tint);
// 获取两种颜色之间的线性插值颜色，插值因子 [0.0f..1.0f]
RLAPI Color ColorLerp(Color color1, Color color2, float factor);
// 从十六进制值获取颜色结构体
RLAPI Color GetColor(unsigned int hexValue);
// 从特定格式的源像素指针获取颜色
RLAPI Color GetPixelColor(void *srcPtr, int format);
// 将格式化后的颜色设置到目标像素指针
RLAPI void SetPixelColor(void *dstPtr, Color color, int format);
// 获取特定格式的像素数据大小（以字节为单位）
RLAPI int GetPixelDataSize(int width, int height, int format);


//------------------------------------------------------------------------------------
// 字体加载和文本绘制函数 (模块: 文本)
//------------------------------------------------------------------------------------

// 字体加载/卸载函数
// 获取默认字体
RLAPI Font GetFontDefault(void);
// 从文件加载字体到GPU内存 (VRAM)
RLAPI Font LoadFont(const char *fileName);
// 从文件加载字体并带有扩展参数，若codepoints为NULL且codepointCount为0则加载默认字符集，字体大小以像素高度提供
RLAPI Font LoadFontEx(const char *fileName, int fontSize, int *codepoints, int codepointCount);
// 从图像加载字体 (XNA风格)
RLAPI Font LoadFontFromImage(Image image, Color key, int firstChar);
// 从内存缓冲区加载字体，fileType指文件扩展名，例如: '.ttf'
RLAPI Font LoadFontFromMemory(const char *fileType, const unsigned char *fileData, int dataSize, int fontSize, int *codepoints, int codepointCount);
// 检查字体是否有效 (字体数据已加载，警告: 未检查GPU纹理)
RLAPI bool IsFontValid(Font font);
// 加载字体数据以供后续使用
RLAPI GlyphInfo *LoadFontData(const unsigned char *fileData, int dataSize, int fontSize, int *codepoints, int codepointCount, int type);
// 使用字符信息生成图像字体图集
RLAPI Image GenImageFontAtlas(const GlyphInfo *glyphs, Rectangle **glyphRecs, int glyphCount, int fontSize, int padding, int packMethod);
// 卸载字体字符信息数据 (RAM)
RLAPI void UnloadFontData(GlyphInfo *glyphs, int glyphCount);
// 从GPU内存 (VRAM) 卸载字体
RLAPI void UnloadFont(Font font);
// 将字体导出为代码文件，成功返回true
RLAPI bool ExportFontAsCode(Font font, const char *fileName);

// 文本绘制函数
// 绘制当前帧率
RLAPI void DrawFPS(int posX, int posY);
// 绘制文本 (使用默认字体)
RLAPI void DrawText(const char *text, int posX, int posY, int fontSize, Color color);
// 使用字体和附加参数绘制文本
RLAPI void DrawTextEx(Font font, const char *text, Vector2 position, float fontSize, float spacing, Color tint);
// 使用字体和专业参数 (旋转) 绘制文本
RLAPI void DrawTextPro(Font font, const char *text, Vector2 position, Vector2 origin, float rotation, float fontSize, float spacing, Color tint);
// 绘制一个字符 (代码点)
RLAPI void DrawTextCodepoint(Font font, int codepoint, Vector2 position, float fontSize, Color tint);
// 绘制多个字符 (代码点)
RLAPI void DrawTextCodepoints(Font font, const int *codepoints, int codepointCount, Vector2 position, float fontSize, float spacing, Color tint);

// 文本字体信息函数
// 设置绘制带换行符文本时的垂直行间距
RLAPI void SetTextLineSpacing(int spacing);
// 测量默认字体下字符串的宽度
RLAPI int MeasureText(const char *text, int fontSize);
// 测量指定字体下字符串的大小
RLAPI Vector2 MeasureTextEx(Font font, const char *text, float fontSize, float spacing);
// 获取字体中代码点 (Unicode字符) 的字形索引位置，若未找到则回退到 '?'
RLAPI int GetGlyphIndex(Font font, int codepoint);
// 获取字体中代码点 (Unicode字符) 的字形信息数据，若未找到则回退到 '?'
RLAPI GlyphInfo GetGlyphInfo(Font font, int codepoint);
// 获取字体图集中代码点 (Unicode字符) 的字形矩形，若未找到则回退到 '?'
RLAPI Rectangle GetGlyphAtlasRec(Font font, int codepoint);

// 文本代码点管理函数 (Unicode字符)
// 从代码点数组加载UTF-8编码的文本
RLAPI char *LoadUTF8(const int *codepoints, int length);
// 卸载从代码点数组编码的UTF-8文本
RLAPI void UnloadUTF8(char *text);
// 从UTF-8文本字符串加载所有代码点，代码点数量通过参数返回
RLAPI int *LoadCodepoints(const char *text, int *count);
// 从内存中卸载代码点数据
RLAPI void UnloadCodepoints(int *codepoints);
// 获取UTF-8编码字符串中的代码点总数
RLAPI int GetCodepointCount(const char *text);
// 获取UTF-8编码字符串中的下一个代码点，失败时返回 0x3f('?')
RLAPI int GetCodepoint(const char *text, int *codepointSize);
// 获取UTF-8编码字符串中的下一个代码点，失败时返回 0x3f('?')
RLAPI int GetCodepointNext(const char *text, int *codepointSize);
// 获取UTF-8编码字符串中的上一个代码点，失败时返回 0x3f('?')
RLAPI int GetCodepointPrevious(const char *text, int *codepointSize);
// 将一个代码点编码为UTF-8字节数组 (数组长度作为参数返回)
RLAPI const char *CodepointToUTF8(int codepoint, int *utf8Size);

// 文本字符串管理函数 (非UTF-8字符串，仅字节字符)
// 注意: 某些字符串会在内部为返回的字符串分配内存，请小心使用!
// 将一个字符串复制到另一个字符串，返回复制的字节数
RLAPI int TextCopy(char *dst, const char *src);
// 检查两个文本字符串是否相等
RLAPI bool TextIsEqual(const char *text1, const char *text2);
// 获取文本长度，检查 '\0' 结尾
RLAPI unsigned int TextLength(const char *text);
// 用变量进行文本格式化 (sprintf() 风格)
RLAPI const char *TextFormat(const char *text, ...);
// 获取文本字符串的一部分
RLAPI const char *TextSubtext(const char *text, int position, int length);
// 替换文本字符串 (警告: 必须释放内存!)
RLAPI char *TextReplace(const char *text, const char *replace, const char *by);
// 在指定位置插入文本 (警告: 必须释放内存!)
RLAPI char *TextInsert(const char *text, const char *insert, int position);
// 用分隔符连接文本字符串
RLAPI const char *TextJoin(const char **textList, int count, const char *delimiter);
// 将文本拆分为多个字符串
RLAPI const char **TextSplit(const char *text, char delimiter, int *count);
// 在特定位置追加文本并移动光标!
RLAPI void TextAppend(char *text, const char *append, int *position);
// 在字符串中查找第一个文本出现的位置
RLAPI int TextFindIndex(const char *text, const char *find);
// 获取提供字符串的大写版本
RLAPI const char *TextToUpper(const char *text);
// 获取提供字符串的小写版本
RLAPI const char *TextToLower(const char *text);
// 获取提供字符串的帕斯卡命名法版本
RLAPI const char *TextToPascal(const char *text);
// 获取提供字符串的蛇形命名法版本
RLAPI const char *TextToSnake(const char *text);
// 获取提供字符串的驼峰命名法版本
RLAPI const char *TextToCamel(const char *text);
// 从文本中获取整数值 (不支持负值)
RLAPI int TextToInteger(const char *text);
// 从文本中获取浮点数值 (不支持负值)
RLAPI float TextToFloat(const char *text);


//------------------------------------------------------------------------------------
// 基础3D形状绘制函数 (模块: 模型)
//------------------------------------------------------------------------------------

// 基础几何3D形状绘制函数
// 在3D世界空间中绘制一条线
RLAPI void DrawLine3D(Vector3 startPos, Vector3 endPos, Color color);
// 在3D空间中绘制一个点，实际上是一条小线段
RLAPI void DrawPoint3D(Vector3 position, Color color);
// 在3D世界空间中绘制一个圆
RLAPI void DrawCircle3D(Vector3 center, float radius, Vector3 rotationAxis, float rotationAngle, Color color);
// 绘制一个填充颜色的三角形（顶点按逆时针顺序排列！）
RLAPI void DrawTriangle3D(Vector3 v1, Vector3 v2, Vector3 v3, Color color);
// 绘制由点定义的三角形条带
RLAPI void DrawTriangleStrip3D(const Vector3 *points, int pointCount, Color color);
// 绘制立方体
RLAPI void DrawCube(Vector3 position, float width, float height, float length, Color color);
// 绘制立方体（向量版本）
RLAPI void DrawCubeV(Vector3 position, Vector3 size, Color color);
// 绘制立方体的线框
RLAPI void DrawCubeWires(Vector3 position, float width, float height, float length, Color color);
// 绘制立方体的线框（向量版本）
RLAPI void DrawCubeWiresV(Vector3 position, Vector3 size, Color color);
// 绘制球体
RLAPI void DrawSphere(Vector3 centerPos, float radius, Color color);
// 绘制具有扩展参数的球体
RLAPI void DrawSphereEx(Vector3 centerPos, float radius, int rings, int slices, Color color);
// 绘制球体的线框
RLAPI void DrawSphereWires(Vector3 centerPos, float radius, int rings, int slices, Color color);
// 绘制圆柱体/圆锥体
RLAPI void DrawCylinder(Vector3 position, float radiusTop, float radiusBottom, float height, int slices, Color color);
// 绘制一个圆柱体，底面在startPos，顶面在endPos
RLAPI void DrawCylinderEx(Vector3 startPos, Vector3 endPos, float startRadius, float endRadius, int sides, Color color);
// 绘制圆柱体/圆锥体的线框
RLAPI void DrawCylinderWires(Vector3 position, float radiusTop, float radiusBottom, float height, int slices, Color color);
// 绘制一个圆柱体的线框，底面在startPos，顶面在endPos
RLAPI void DrawCylinderWiresEx(Vector3 startPos, Vector3 endPos, float startRadius, float endRadius, int sides, Color color);
// 绘制一个胶囊体，其球形帽的中心分别在startPos和endPos
RLAPI void DrawCapsule(Vector3 startPos, Vector3 endPos, float radius, int slices, int rings, Color color);
// 绘制胶囊体的线框，其球形帽的中心分别在startPos和endPos
RLAPI void DrawCapsuleWires(Vector3 startPos, Vector3 endPos, float radius, int slices, int rings, Color color);
// 绘制一个XZ平面
RLAPI void DrawPlane(Vector3 centerPos, Vector2 size, Color color);
// 绘制一条射线
RLAPI void DrawRay(Ray ray, Color color);
// 绘制一个网格（以(0, 0, 0)为中心）
RLAPI void DrawGrid(int slices, float spacing);

//------------------------------------------------------------------------------------
// 3D模型加载和绘制函数 (模块: models)
//------------------------------------------------------------------------------------

// 模型管理函数
// 从文件加载模型（网格和材质）
RLAPI Model LoadModel(const char *fileName);
// 从生成的网格加载模型（默认材质）
RLAPI Model LoadModelFromMesh(Mesh mesh);
// 检查模型是否有效（已加载到GPU，VAO/VBO）
RLAPI bool IsModelValid(Model model);
// 从内存（RAM和/或VRAM）卸载模型（包括网格）
RLAPI void UnloadModel(Model model);
// 计算模型的边界框限制（考虑所有网格）
RLAPI BoundingBox GetModelBoundingBox(Model model);

// 模型绘制函数
// 绘制一个模型（如果设置了纹理）
RLAPI void DrawModel(Model model, Vector3 position, float scale, Color tint);
// 用扩展参数绘制一个模型
RLAPI void DrawModelEx(Model model, Vector3 position, Vector3 rotationAxis, float rotationAngle, Vector3 scale, Color tint);
// 绘制模型的线框（如果设置了纹理）
RLAPI void DrawModelWires(Model model, Vector3 position, float scale, Color tint);
// 用扩展参数绘制模型的线框（如果设置了纹理）
RLAPI void DrawModelWiresEx(Model model, Vector3 position, Vector3 rotationAxis, float rotationAngle, Vector3 scale, Color tint);
// 将模型绘制为点
RLAPI void DrawModelPoints(Model model, Vector3 position, float scale, Color tint);
// 用扩展参数将模型绘制为点
RLAPI void DrawModelPointsEx(Model model, Vector3 position, Vector3 rotationAxis, float rotationAngle, Vector3 scale, Color tint);
// 绘制边界框（线框）
RLAPI void DrawBoundingBox(BoundingBox box, Color color);
// 绘制一个广告牌纹理
RLAPI void DrawBillboard(Camera camera, Texture2D texture, Vector3 position, float scale, Color tint);
// 绘制由源矩形定义的广告牌纹理
RLAPI void DrawBillboardRec(Camera camera, Texture2D texture, Rectangle source, Vector3 position, Vector2 size, Color tint);
// 绘制由源矩形和旋转定义的广告牌纹理
RLAPI void DrawBillboardPro(Camera camera, Texture2D texture, Rectangle source, Vector3 position, Vector3 up, Vector2 size, Vector2 origin, float rotation, Color tint);

// 网格管理函数
// 将网格顶点数据上传到GPU并提供VAO/VBO ID
RLAPI void UploadMesh(Mesh *mesh, bool dynamic);
// 更新GPU中特定缓冲区索引的网格顶点数据
RLAPI void UpdateMeshBuffer(Mesh mesh, int index, const void *data, int dataSize, int offset);
// 从CPU和GPU卸载网格数据
RLAPI void UnloadMesh(Mesh mesh);
// 用材质和变换绘制一个3D网格
RLAPI void DrawMesh(Mesh mesh, Material material, Matrix transform);
// 用材质和不同的变换绘制多个网格实例
RLAPI void DrawMeshInstanced(Mesh mesh, Material material, const Matrix *transforms, int instances);
// 计算网格的边界框限制
RLAPI BoundingBox GetMeshBoundingBox(Mesh mesh);
// 计算网格的切线
RLAPI void GenMeshTangents(Mesh *mesh);
// 将网格数据导出到文件，成功返回true
RLAPI bool ExportMesh(Mesh mesh, const char *fileName);
// 将网格导出为定义多个顶点属性数组的代码文件（.h）
RLAPI bool ExportMeshAsCode(Mesh mesh, const char *fileName);

// 网格生成函数
// 生成多边形网格
RLAPI Mesh GenMeshPoly(int sides, float radius);
// 生成平面网格（带有细分）
RLAPI Mesh GenMeshPlane(float width, float length, int resX, int resZ);
// 生成长方体网格
RLAPI Mesh GenMeshCube(float width, float height, float length);
// 生成球体网格（标准球体）
RLAPI Mesh GenMeshSphere(float radius, int rings, int slices);
// 生成半球体网格（无底部盖子）
RLAPI Mesh GenMeshHemiSphere(float radius, int rings, int slices);
// 生成圆柱体网格
RLAPI Mesh GenMeshCylinder(float radius, float height, int slices);
// 生成圆锥/棱锥网格
RLAPI Mesh GenMeshCone(float radius, float height, int slices);
// 生成圆环体网格
RLAPI Mesh GenMeshTorus(float radius, float size, int radSeg, int sides);
// 生成三叶结网格
RLAPI Mesh GenMeshKnot(float radius, float size, int radSeg, int sides);
// 根据图像数据生成高度图网格
RLAPI Mesh GenMeshHeightmap(Image heightmap, Vector3 size);
// 根据图像数据生成基于立方体的地图网格
RLAPI Mesh GenMeshCubicmap(Image cubicmap, Vector3 cubeSize);

// 材质加载/卸载函数
// 从模型文件加载材质
RLAPI Material *LoadMaterials(const char *fileName, int *materialCount);
// 加载默认材质（支持：漫反射、镜面反射、法线贴图）
RLAPI Material LoadMaterialDefault(void);
// 检查材质是否有效（已分配着色器，贴图纹理已加载到GPU）
RLAPI bool IsMaterialValid(Material material);
// 从GPU内存（VRAM）卸载材质
RLAPI void UnloadMaterial(Material material);
// 为材质贴图类型设置纹理（MATERIAL_MAP_DIFFUSE, MATERIAL_MAP_SPECULAR...）
RLAPI void SetMaterialTexture(Material *material, int mapType, Texture2D texture);
// 为网格设置材质
RLAPI void SetModelMeshMaterial(Model *model, int meshId, int materialId);

// 模型动画加载/卸载函数
// 从文件加载模型动画
RLAPI ModelAnimation *LoadModelAnimations(const char *fileName, int *animCount);
// 更新模型动画姿势（CPU）
RLAPI void UpdateModelAnimation(Model model, ModelAnimation anim, int frame);
// 更新模型动画网格骨骼矩阵（GPU蒙皮）
RLAPI void UpdateModelAnimationBones(Model model, ModelAnimation anim, int frame);
// 卸载动画数据
RLAPI void UnloadModelAnimation(ModelAnimation anim);
// 卸载动画数组数据
RLAPI void UnloadModelAnimations(ModelAnimation *animations, int animCount);
// 检查模型动画骨骼是否匹配
RLAPI bool IsModelAnimationValid(Model model, ModelAnimation anim);

// 碰撞检测函数
// 检查两个球体之间的碰撞
RLAPI bool CheckCollisionSpheres(Vector3 center1, float radius1, Vector3 center2, float radius2);
// 检查两个边界框之间的碰撞
RLAPI bool CheckCollisionBoxes(BoundingBox box1, BoundingBox box2);
// 检查边界框和球体之间的碰撞
RLAPI bool CheckCollisionBoxSphere(BoundingBox box, Vector3 center, float radius);
// 获取射线和球体之间的碰撞信息
RLAPI RayCollision GetRayCollisionSphere(Ray ray, Vector3 center, float radius);
// 获取射线和边界框之间的碰撞信息
RLAPI RayCollision GetRayCollisionBox(Ray ray, BoundingBox box);
// 获取射线和网格之间的碰撞信息
RLAPI RayCollision GetRayCollisionMesh(Ray ray, Mesh mesh, Matrix transform);
// 获取射线和三角形之间的碰撞信息
RLAPI RayCollision GetRayCollisionTriangle(Ray ray, Vector3 p1, Vector3 p2, Vector3 p3);
// 获取射线和四边形之间的碰撞信息
RLAPI RayCollision GetRayCollisionQuad(Ray ray, Vector3 p1, Vector3 p2, Vector3 p3, Vector3 p4);

//------------------------------------------------------------------------------------
// 音频加载和播放函数 (模块: 音频)
//------------------------------------------------------------------------------------
// 音频回调函数指针类型定义，用于处理音频数据
typedef void (*AudioCallback)(void *bufferData, unsigned int frames);

// 音频设备管理函数
RLAPI void InitAudioDevice(void);                                     // 初始化音频设备和上下文
RLAPI void CloseAudioDevice(void);                                    // 关闭音频设备和上下文
RLAPI bool IsAudioDeviceReady(void);                                  // 检查音频设备是否已成功初始化
RLAPI void SetMasterVolume(float volume);                             // 设置主音量 (监听器)
RLAPI float GetMasterVolume(void);                                    // 获取主音量 (监听器)

// 波形/声音加载/卸载函数
RLAPI Wave LoadWave(const char *fileName);                            // 从文件加载波形数据
RLAPI Wave LoadWaveFromMemory(const char *fileType, const unsigned char *fileData, int dataSize); // 从内存缓冲区加载波形，fileType 指文件扩展名，例如: '.wav'
RLAPI bool IsWaveValid(Wave wave);                                    // 检查波形数据是否有效 (数据已加载且参数正确)
RLAPI Sound LoadSound(const char *fileName);                          // 从文件加载声音
RLAPI Sound LoadSoundFromWave(Wave wave);                             // 从波形数据加载声音
RLAPI Sound LoadSoundAlias(Sound source);                             // 创建一个新的声音，与源声音共享相同的采样数据，不拥有声音数据
RLAPI bool IsSoundValid(Sound sound);                                 // 检查声音是否有效 (数据已加载且缓冲区已初始化)
RLAPI void UpdateSound(Sound sound, const void *data, int sampleCount); // 用新数据更新声音缓冲区
RLAPI void UnloadWave(Wave wave);                                     // 卸载波形数据
RLAPI void UnloadSound(Sound sound);                                  // 卸载声音
RLAPI void UnloadSoundAlias(Sound alias);                             // 卸载声音别名 (不释放采样数据)
RLAPI bool ExportWave(Wave wave, const char *fileName);               // 将波形数据导出到文件，成功返回 true
RLAPI bool ExportWaveAsCode(Wave wave, const char *fileName);         // 将波形采样数据导出为代码文件 (.h)，成功返回 true

// 波形/声音管理函数
RLAPI void PlaySound(Sound sound);                                    // 播放声音
RLAPI void StopSound(Sound sound);                                    // 停止播放声音
RLAPI void PauseSound(Sound sound);                                   // 暂停声音
RLAPI void ResumeSound(Sound sound);                                  // 恢复暂停的声音
RLAPI bool IsSoundPlaying(Sound sound);                               // 检查声音是否正在播放
RLAPI void SetSoundVolume(Sound sound, float volume);                 // 设置声音的音量 (1.0 为最大级别)
RLAPI void SetSoundPitch(Sound sound, float pitch);                   // 设置声音的音调 (1.0 为基础级别)
RLAPI void SetSoundPan(Sound sound, float pan);                       // 设置声音的声像 (0.5 为中心)
RLAPI Wave WaveCopy(Wave wave);                                       // 将波形复制到一个新的波形
RLAPI void WaveCrop(Wave *wave, int initFrame, int finalFrame);       // 将波形裁剪到定义的帧范围
RLAPI void WaveFormat(Wave *wave, int sampleRate, int sampleSize, int channels); // 将波形数据转换为所需格式
RLAPI float *LoadWaveSamples(Wave wave);                              // 从波形加载采样数据作为 32 位浮点数据数组
RLAPI void UnloadWaveSamples(float *samples);                         // 卸载使用 LoadWaveSamples() 加载的采样数据

// 音乐管理函数
RLAPI Music LoadMusicStream(const char *fileName);                    // 从文件加载音乐流
RLAPI Music LoadMusicStreamFromMemory(const char *fileType, const unsigned char *data, int dataSize); // 从数据加载音乐流
RLAPI bool IsMusicValid(Music music);                                 // 检查音乐流是否有效 (上下文和缓冲区已初始化)
RLAPI void UnloadMusicStream(Music music);                            // 卸载音乐流
RLAPI void PlayMusicStream(Music music);                              // 开始播放音乐
RLAPI bool IsMusicStreamPlaying(Music music);                         // 检查音乐是否正在播放
RLAPI void UpdateMusicStream(Music music);                            // 更新音乐流的缓冲区
RLAPI void StopMusicStream(Music music);                              // 停止播放音乐
RLAPI void PauseMusicStream(Music music);                             // 暂停播放音乐
RLAPI void ResumeMusicStream(Music music);                            // 恢复暂停的音乐播放
RLAPI void SeekMusicStream(Music music, float position);              // 将音乐定位到指定位置 (以秒为单位)
RLAPI void SetMusicVolume(Music music, float volume);                 // 设置音乐的音量 (1.0 为最大级别)
RLAPI void SetMusicPitch(Music music, float pitch);                   // 设置音乐的音调 (1.0 为基础级别)
RLAPI void SetMusicPan(Music music, float pan);                       // 设置音乐的声像 (0.5 为中心)
RLAPI float GetMusicTimeLength(Music music);                          // 获取音乐的总时长 (以秒为单位)
RLAPI float GetMusicTimePlayed(Music music);                          // 获取当前音乐已播放的时长 (以秒为单位)

// 音频流管理函数
RLAPI AudioStream LoadAudioStream(unsigned int sampleRate, unsigned int sampleSize, unsigned int channels); // 加载音频流 (用于流式传输原始音频 PCM 数据)
RLAPI bool IsAudioStreamValid(AudioStream stream);                    // 检查音频流是否有效 (缓冲区已初始化)
RLAPI void UnloadAudioStream(AudioStream stream);                     // 卸载音频流并释放内存
RLAPI void UpdateAudioStream(AudioStream stream, const void *data, int frameCount); // 用数据更新音频流缓冲区
RLAPI bool IsAudioStreamProcessed(AudioStream stream);                // 检查是否有音频流缓冲区需要重新填充
RLAPI void PlayAudioStream(AudioStream stream);                       // 播放音频流
RLAPI void PauseAudioStream(AudioStream stream);                      // 暂停音频流
RLAPI void ResumeAudioStream(AudioStream stream);                     // 恢复音频流
RLAPI bool IsAudioStreamPlaying(AudioStream stream);                  // 检查音频流是否正在播放
RLAPI void StopAudioStream(AudioStream stream);                       // 停止音频流
RLAPI void SetAudioStreamVolume(AudioStream stream, float volume);    // 设置音频流的音量 (1.0 为最大级别)
RLAPI void SetAudioStreamPitch(AudioStream stream, float pitch);      // 设置音频流的音调 (1.0 为基础级别)
RLAPI void SetAudioStreamPan(AudioStream stream, float pan);          // 设置音频流的声像 (0.5 为中心)
RLAPI void SetAudioStreamBufferSizeDefault(int size);                 // 设置新音频流的默认缓冲区大小
RLAPI void SetAudioStreamCallback(AudioStream stream, AudioCallback callback); // 音频线程回调，用于请求新数据

RLAPI void AttachAudioStreamProcessor(AudioStream stream, AudioCallback processor); // 将音频流处理器附加到流，接收的样本为 'float' 类型
RLAPI void DetachAudioStreamProcessor(AudioStream stream, AudioCallback processor); // 从流中分离音频流处理器

RLAPI void AttachAudioMixedProcessor(AudioCallback processor); // 将音频流处理器附加到整个音频管道，接收的样本为 'float' 类型
RLAPI void DetachAudioMixedProcessor(AudioCallback processor); // 从整个音频管道中分离音频流处理器
#if defined(__cplusplus)
}
#endif

#endif // RAYLIB_H
