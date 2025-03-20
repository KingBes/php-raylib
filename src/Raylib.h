// Vector2, 2 components
typedef struct Vector2
{
    float x; // Vector x component
    float y; // Vector y component
} Vector2;

// Vector3, 3 components
typedef struct Vector3
{
    float x; // Vector x component
    float y; // Vector y component
    float z; // Vector z component
} Vector3;

// Vector4, 4 components
typedef struct Vector4
{
    float x; // Vector x component
    float y; // Vector y component
    float z; // Vector z component
    float w; // Vector w component
} Vector4;

// Quaternion, 4 components (Vector4 alias)
typedef Vector4 Quaternion;

// Matrix, 4x4 components, column major, OpenGL style, right-handed
typedef struct Matrix
{
    float m0, m4, m8, m12;  // Matrix first row (4 components)
    float m1, m5, m9, m13;  // Matrix second row (4 components)
    float m2, m6, m10, m14; // Matrix third row (4 components)
    float m3, m7, m11, m15; // Matrix fourth row (4 components)
} Matrix;

// Color, 4 components, R8G8B8A8 (32bit)
typedef struct Color
{
    unsigned char r; // Color red value
    unsigned char g; // Color green value
    unsigned char b; // Color blue value
    unsigned char a; // Color alpha value
} Color;

// Rectangle, 4 components
typedef struct Rectangle
{
    float x;      // Rectangle top-left corner position x
    float y;      // Rectangle top-left corner position y
    float width;  // Rectangle width
    float height; // Rectangle height
} Rectangle;

// Image, pixel data stored in CPU memory (RAM)
typedef struct Image
{
    void *data;  // Image raw data
    int width;   // Image base width
    int height;  // Image base height
    int mipmaps; // Mipmap levels, 1 by default
    int format;  // Data format (PixelFormat type)
} Image;

// Texture, tex data stored in GPU memory (VRAM)
typedef struct Texture
{
    unsigned int id; // OpenGL texture id
    int width;       // Texture base width
    int height;      // Texture base height
    int mipmaps;     // Mipmap levels, 1 by default
    int format;      // Data format (PixelFormat type)
} Texture;

// Texture2D, same as Texture
typedef Texture Texture2D;

// TextureCubemap, same as Texture
typedef Texture TextureCubemap;

// RenderTexture, fbo for texture rendering
typedef struct RenderTexture
{
    unsigned int id; // OpenGL framebuffer object id
    Texture texture; // Color buffer attachment texture
    Texture depth;   // Depth buffer attachment texture
} RenderTexture;

// RenderTexture2D, same as RenderTexture
typedef RenderTexture RenderTexture2D;

// NPatchInfo, n-patch layout info
typedef struct NPatchInfo
{
    Rectangle source; // Texture source rectangle
    int left;         // Left border offset
    int top;          // Top border offset
    int right;        // Right border offset
    int bottom;       // Bottom border offset
    int layout;       // Layout of the n-patch: 3x3, 1x3 or 3x1
} NPatchInfo;

// GlyphInfo, font characters glyphs info
typedef struct GlyphInfo
{
    int value;    // Character value (Unicode)
    int offsetX;  // Character offset X when drawing
    int offsetY;  // Character offset Y when drawing
    int advanceX; // Character advance position X
    Image image;  // Character image data
} GlyphInfo;

// Font, font texture and GlyphInfo array data
typedef struct Font
{
    int baseSize;      // Base size (default chars height)
    int glyphCount;    // Number of glyph characters
    int glyphPadding;  // Padding around the glyph characters
    Texture2D texture; // Texture atlas containing the glyphs
    Rectangle *recs;   // Rectangles in texture for the glyphs
    GlyphInfo *glyphs; // Glyphs info data
} Font;

// Camera, defines position/orientation in 3d space
typedef struct Camera3D
{
    Vector3 position; // Camera position
    Vector3 target;   // Camera target it looks-at
    Vector3 up;       // Camera up vector (rotation over its axis)
    float fovy;       // Camera field-of-view aperture in Y (degrees) in perspective, used as near plane width in orthographic
    int projection;   // Camera projection: CAMERA_PERSPECTIVE or CAMERA_ORTHOGRAPHIC
} Camera3D;

typedef Camera3D Camera; // Camera type fallback, defaults to Camera3D

// Camera2D, defines position/orientation in 2d space
typedef struct Camera2D
{
    Vector2 offset; // Camera offset (displacement from target)
    Vector2 target; // Camera target (rotation and zoom origin)
    float rotation; // Camera rotation in degrees
    float zoom;     // Camera zoom (scaling), should be 1.0f by default
} Camera2D;

// Mesh, vertex data and vao/vbo
typedef struct Mesh
{
    int vertexCount;   // Number of vertices stored in arrays
    int triangleCount; // Number of triangles stored (indexed or not)

    // Vertex attributes data
    float *vertices;         // Vertex position (XYZ - 3 components per vertex) (shader-location = 0)
    float *texcoords;        // Vertex texture coordinates (UV - 2 components per vertex) (shader-location = 1)
    float *texcoords2;       // Vertex texture second coordinates (UV - 2 components per vertex) (shader-location = 5)
    float *normals;          // Vertex normals (XYZ - 3 components per vertex) (shader-location = 2)
    float *tangents;         // Vertex tangents (XYZW - 4 components per vertex) (shader-location = 4)
    unsigned char *colors;   // Vertex colors (RGBA - 4 components per vertex) (shader-location = 3)
    unsigned short *indices; // Vertex indices (in case vertex data comes indexed)

    // Animation vertex data
    float *animVertices;    // Animated vertex positions (after bones transformations)
    float *animNormals;     // Animated normals (after bones transformations)
    unsigned char *boneIds; // Vertex bone ids, max 255 bone ids, up to 4 bones influence by vertex (skinning) (shader-location = 6)
    float *boneWeights;     // Vertex bone weight, up to 4 bones influence by vertex (skinning) (shader-location = 7)
    Matrix *boneMatrices;   // Bones animated transformation matrices
    int boneCount;          // Number of bones

    // OpenGL identifiers
    unsigned int vaoId;  // OpenGL Vertex Array Object id
    unsigned int *vboId; // OpenGL Vertex Buffer Objects id (default vertex data)
} Mesh;

// Shader
typedef struct Shader
{
    unsigned int id; // Shader program id
    int *locs;       // Shader locations array (RL_MAX_SHADER_LOCATIONS)
} Shader;

// MaterialMap
typedef struct MaterialMap
{
    Texture2D texture; // Material map texture
    Color color;       // Material map color
    float value;       // Material map value
} MaterialMap;

// Material, includes shader and maps
typedef struct Material
{
    Shader shader;     // Material shader
    MaterialMap *maps; // Material maps array (MAX_MATERIAL_MAPS)
    float params[4];   // Material generic parameters (if required)
} Material;

// Transform, vertex transformation data
typedef struct Transform
{
    Vector3 translation; // Translation
    Quaternion rotation; // Rotation
    Vector3 scale;       // Scale
} Transform;

// Bone, skeletal animation bone
typedef struct BoneInfo
{
    char name[32]; // Bone name
    int parent;    // Bone parent
} BoneInfo;

// Model, meshes, materials and animation data
typedef struct Model
{
    Matrix transform; // Local transform matrix

    int meshCount;       // Number of meshes
    int materialCount;   // Number of materials
    Mesh *meshes;        // Meshes array
    Material *materials; // Materials array
    int *meshMaterial;   // Mesh material number

    // Animation data
    int boneCount;       // Number of bones
    BoneInfo *bones;     // Bones information (skeleton)
    Transform *bindPose; // Bones base transformation (pose)
} Model;

// ModelAnimation
typedef struct ModelAnimation
{
    int boneCount;          // Number of bones
    int frameCount;         // Number of animation frames
    BoneInfo *bones;        // Bones information (skeleton)
    Transform **framePoses; // Poses array by frame
    char name[32];          // Animation name
} ModelAnimation;

// Ray, ray for raycasting
typedef struct Ray
{
    Vector3 position;  // Ray position (origin)
    Vector3 direction; // Ray direction (normalized)
} Ray;

// RayCollision, ray hit information
typedef struct RayCollision
{
    bool hit;       // Did the ray hit something?
    float distance; // Distance to the nearest hit
    Vector3 point;  // Point of the nearest hit
    Vector3 normal; // Surface normal of hit
} RayCollision;

// BoundingBox
typedef struct BoundingBox
{
    Vector3 min; // Minimum vertex box-corner
    Vector3 max; // Maximum vertex box-corner
} BoundingBox;

// Wave, audio wave data
typedef struct Wave
{
    unsigned int frameCount; // Total number of frames (considering channels)
    unsigned int sampleRate; // Frequency (samples per second)
    unsigned int sampleSize; // Bit depth (bits per sample): 8, 16, 32 (24 not supported)
    unsigned int channels;   // Number of channels (1-mono, 2-stereo, ...)
    void *data;              // Buffer data pointer
} Wave;

// Opaque structs declaration
// NOTE: Actual structs are defined internally in raudio module
typedef struct rAudioBuffer rAudioBuffer;
typedef struct rAudioProcessor rAudioProcessor;

// AudioStream, custom audio stream
typedef struct AudioStream
{
    rAudioBuffer *buffer;       // Pointer to internal data used by the audio system
    rAudioProcessor *processor; // Pointer to internal data processor, useful for audio effects

    unsigned int sampleRate; // Frequency (samples per second)
    unsigned int sampleSize; // Bit depth (bits per sample): 8, 16, 32 (24 not supported)
    unsigned int channels;   // Number of channels (1-mono, 2-stereo, ...)
} AudioStream;

// Sound
typedef struct Sound
{
    AudioStream stream;      // Audio stream
    unsigned int frameCount; // Total number of frames (considering channels)
} Sound;

// Music, audio stream, anything longer than ~10 seconds should be streamed
typedef struct Music
{
    AudioStream stream;      // Audio stream
    unsigned int frameCount; // Total number of frames (considering channels)
    bool looping;            // Music looping enable

    int ctxType;   // Type of music context (audio filetype)
    void *ctxData; // Audio context data, depends on type
} Music;

// VrDeviceInfo, Head-Mounted-Display device parameters
typedef struct VrDeviceInfo
{
    int hResolution;               // Horizontal resolution in pixels
    int vResolution;               // Vertical resolution in pixels
    float hScreenSize;             // Horizontal size in meters
    float vScreenSize;             // Vertical size in meters
    float eyeToScreenDistance;     // Distance between eye and display in meters
    float lensSeparationDistance;  // Lens separation distance in meters
    float interpupillaryDistance;  // IPD (distance between pupils) in meters
    float lensDistortionValues[4]; // Lens distortion constant parameters
    float chromaAbCorrection[4];   // Chromatic aberration correction parameters
} VrDeviceInfo;

// VrStereoConfig, VR stereo rendering configuration for simulator
typedef struct VrStereoConfig
{
    Matrix projection[2];       // VR projection matrices (per eye)
    Matrix viewOffset[2];       // VR view offset matrices (per eye)
    float leftLensCenter[2];    // VR left lens center
    float rightLensCenter[2];   // VR right lens center
    float leftScreenCenter[2];  // VR left screen center
    float rightScreenCenter[2]; // VR right screen center
    float scale[2];             // VR distortion scale
    float scaleIn[2];           // VR distortion scale in
} VrStereoConfig;

// File path list
typedef struct FilePathList
{
    unsigned int capacity; // Filepaths max entries
    unsigned int count;    // Filepaths entries count
    char **paths;          // Filepaths entries
} FilePathList;

// Automation event
typedef struct AutomationEvent
{
    unsigned int frame; // Event frame
    unsigned int type;  // Event type (AutomationEventType)
    int params[4];      // Event parameters (if required)
} AutomationEvent;

// Automation event list
typedef struct AutomationEventList
{
    unsigned int capacity;   // Events max entries (MAX_AUTOMATION_EVENTS)
    unsigned int count;      // Events entries count
    AutomationEvent *events; // Events entries
} AutomationEventList;

//----------------------------------------------------------------------------------
// 枚举定义
//----------------------------------------------------------------------------------
// 系统/窗口配置标志
// 注意: 每个位代表一种状态 (使用位掩码操作)
// 默认情况下，所有标志都设置为 0
typedef enum
{
    FLAG_VSYNC_HINT = 0x00000040,               // 设置以尝试在GPU上启用垂直同步
    FLAG_FULLSCREEN_MODE = 0x00000002,          // 设置以全屏模式运行程序
    FLAG_WINDOW_RESIZABLE = 0x00000004,         // 设置以允许窗口可调整大小
    FLAG_WINDOW_UNDECORATED = 0x00000008,       // 设置以禁用窗口装饰 (边框和按钮)
    FLAG_WINDOW_HIDDEN = 0x00000080,            // 设置以隐藏窗口
    FLAG_WINDOW_MINIMIZED = 0x00000200,         // 设置以最小化窗口 (图标化)
    FLAG_WINDOW_MAXIMIZED = 0x00000400,         // 设置以最大化窗口 (扩展到显示器)
    FLAG_WINDOW_UNFOCUSED = 0x00000800,         // 设置窗口为非聚焦状态
    FLAG_WINDOW_TOPMOST = 0x00001000,           // 设置窗口始终置顶
    FLAG_WINDOW_ALWAYS_RUN = 0x00000100,        // 设置以允许窗口在最小化时继续运行
    FLAG_WINDOW_TRANSPARENT = 0x00000010,       // 设置以允许透明帧缓冲区
    FLAG_WINDOW_HIGHDPI = 0x00002000,           // 设置以支持高DPI
    FLAG_WINDOW_MOUSE_PASSTHROUGH = 0x00004000, // 设置以支持鼠标穿透，仅在FLAG_WINDOW_UNDECORATED时支持
    FLAG_BORDERLESS_WINDOWED_MODE = 0x00008000, // 设置以无边框窗口模式运行程序
    FLAG_MSAA_4X_HINT = 0x00000020,             // 设置以尝试启用4倍多重采样抗锯齿
    FLAG_INTERLACED_HINT = 0x00010000           // 设置以尝试启用隔行视频格式 (适用于V3D)
} ConfigFlags;

// Trace log level
// NOTE: Organized by priority level
typedef enum
{
    LOG_ALL = 0, // Display all logs
    LOG_TRACE,   // Trace logging, intended for internal use only
    LOG_DEBUG,   // Debug logging, used for internal debugging, it should be disabled on release builds
    LOG_INFO,    // Info logging, used for program execution info
    LOG_WARNING, // Warning logging, used on recoverable failures
    LOG_ERROR,   // Error logging, used on unrecoverable failures
    LOG_FATAL,   // Fatal logging, used to abort program: exit(EXIT_FAILURE)
    LOG_NONE     // Disable logging
} TraceLogLevel;

// Keyboard keys (US keyboard layout)
// NOTE: Use GetKeyPressed() to allow redefining
// required keys for alternative layouts
typedef enum
{
    KEY_NULL = 0, // Key: NULL, used for no key pressed
    // Alphanumeric keys
    KEY_APOSTROPHE = 39,    // Key: '
    KEY_COMMA = 44,         // Key: ,
    KEY_MINUS = 45,         // Key: -
    KEY_PERIOD = 46,        // Key: .
    KEY_SLASH = 47,         // Key: /
    KEY_ZERO = 48,          // Key: 0
    KEY_ONE = 49,           // Key: 1
    KEY_TWO = 50,           // Key: 2
    KEY_THREE = 51,         // Key: 3
    KEY_FOUR = 52,          // Key: 4
    KEY_FIVE = 53,          // Key: 5
    KEY_SIX = 54,           // Key: 6
    KEY_SEVEN = 55,         // Key: 7
    KEY_EIGHT = 56,         // Key: 8
    KEY_NINE = 57,          // Key: 9
    KEY_SEMICOLON = 59,     // Key: ;
    KEY_EQUAL = 61,         // Key: =
    KEY_A = 65,             // Key: A | a
    KEY_B = 66,             // Key: B | b
    KEY_C = 67,             // Key: C | c
    KEY_D = 68,             // Key: D | d
    KEY_E = 69,             // Key: E | e
    KEY_F = 70,             // Key: F | f
    KEY_G = 71,             // Key: G | g
    KEY_H = 72,             // Key: H | h
    KEY_I = 73,             // Key: I | i
    KEY_J = 74,             // Key: J | j
    KEY_K = 75,             // Key: K | k
    KEY_L = 76,             // Key: L | l
    KEY_M = 77,             // Key: M | m
    KEY_N = 78,             // Key: N | n
    KEY_O = 79,             // Key: O | o
    KEY_P = 80,             // Key: P | p
    KEY_Q = 81,             // Key: Q | q
    KEY_R = 82,             // Key: R | r
    KEY_S = 83,             // Key: S | s
    KEY_T = 84,             // Key: T | t
    KEY_U = 85,             // Key: U | u
    KEY_V = 86,             // Key: V | v
    KEY_W = 87,             // Key: W | w
    KEY_X = 88,             // Key: X | x
    KEY_Y = 89,             // Key: Y | y
    KEY_Z = 90,             // Key: Z | z
    KEY_LEFT_BRACKET = 91,  // Key: [
    KEY_BACKSLASH = 92,     // Key: '\'
    KEY_RIGHT_BRACKET = 93, // Key: ]
    KEY_GRAVE = 96,         // Key: `
    // Function keys
    KEY_SPACE = 32,          // Key: Space
    KEY_ESCAPE = 256,        // Key: Esc
    KEY_ENTER = 257,         // Key: Enter
    KEY_TAB = 258,           // Key: Tab
    KEY_BACKSPACE = 259,     // Key: Backspace
    KEY_INSERT = 260,        // Key: Ins
    KEY_DELETE = 261,        // Key: Del
    KEY_RIGHT = 262,         // Key: Cursor right
    KEY_LEFT = 263,          // Key: Cursor left
    KEY_DOWN = 264,          // Key: Cursor down
    KEY_UP = 265,            // Key: Cursor up
    KEY_PAGE_UP = 266,       // Key: Page up
    KEY_PAGE_DOWN = 267,     // Key: Page down
    KEY_HOME = 268,          // Key: Home
    KEY_END = 269,           // Key: End
    KEY_CAPS_LOCK = 280,     // Key: Caps lock
    KEY_SCROLL_LOCK = 281,   // Key: Scroll down
    KEY_NUM_LOCK = 282,      // Key: Num lock
    KEY_PRINT_SCREEN = 283,  // Key: Print screen
    KEY_PAUSE = 284,         // Key: Pause
    KEY_F1 = 290,            // Key: F1
    KEY_F2 = 291,            // Key: F2
    KEY_F3 = 292,            // Key: F3
    KEY_F4 = 293,            // Key: F4
    KEY_F5 = 294,            // Key: F5
    KEY_F6 = 295,            // Key: F6
    KEY_F7 = 296,            // Key: F7
    KEY_F8 = 297,            // Key: F8
    KEY_F9 = 298,            // Key: F9
    KEY_F10 = 299,           // Key: F10
    KEY_F11 = 300,           // Key: F11
    KEY_F12 = 301,           // Key: F12
    KEY_LEFT_SHIFT = 340,    // Key: Shift left
    KEY_LEFT_CONTROL = 341,  // Key: Control left
    KEY_LEFT_ALT = 342,      // Key: Alt left
    KEY_LEFT_SUPER = 343,    // Key: Super left
    KEY_RIGHT_SHIFT = 344,   // Key: Shift right
    KEY_RIGHT_CONTROL = 345, // Key: Control right
    KEY_RIGHT_ALT = 346,     // Key: Alt right
    KEY_RIGHT_SUPER = 347,   // Key: Super right
    KEY_KB_MENU = 348,       // Key: KB menu
    // Keypad keys
    KEY_KP_0 = 320,        // Key: Keypad 0
    KEY_KP_1 = 321,        // Key: Keypad 1
    KEY_KP_2 = 322,        // Key: Keypad 2
    KEY_KP_3 = 323,        // Key: Keypad 3
    KEY_KP_4 = 324,        // Key: Keypad 4
    KEY_KP_5 = 325,        // Key: Keypad 5
    KEY_KP_6 = 326,        // Key: Keypad 6
    KEY_KP_7 = 327,        // Key: Keypad 7
    KEY_KP_8 = 328,        // Key: Keypad 8
    KEY_KP_9 = 329,        // Key: Keypad 9
    KEY_KP_DECIMAL = 330,  // Key: Keypad .
    KEY_KP_DIVIDE = 331,   // Key: Keypad /
    KEY_KP_MULTIPLY = 332, // Key: Keypad *
    KEY_KP_SUBTRACT = 333, // Key: Keypad -
    KEY_KP_ADD = 334,      // Key: Keypad +
    KEY_KP_ENTER = 335,    // Key: Keypad Enter
    KEY_KP_EQUAL = 336,    // Key: Keypad =
    // Android key buttons
    KEY_BACK = 4,        // Key: Android back button
    KEY_MENU = 5,        // Key: Android menu button
    KEY_VOLUME_UP = 24,  // Key: Android volume up button
    KEY_VOLUME_DOWN = 25 // Key: Android volume down button
} KeyboardKey;

// Add backwards compatibility support for deprecated names
#define MOUSE_LEFT_BUTTON MOUSE_BUTTON_LEFT
#define MOUSE_RIGHT_BUTTON MOUSE_BUTTON_RIGHT
#define MOUSE_MIDDLE_BUTTON MOUSE_BUTTON_MIDDLE

// Mouse buttons
typedef enum
{
    MOUSE_BUTTON_LEFT = 0,    // Mouse button left
    MOUSE_BUTTON_RIGHT = 1,   // Mouse button right
    MOUSE_BUTTON_MIDDLE = 2,  // Mouse button middle (pressed wheel)
    MOUSE_BUTTON_SIDE = 3,    // Mouse button side (advanced mouse device)
    MOUSE_BUTTON_EXTRA = 4,   // Mouse button extra (advanced mouse device)
    MOUSE_BUTTON_FORWARD = 5, // Mouse button forward (advanced mouse device)
    MOUSE_BUTTON_BACK = 6,    // Mouse button back (advanced mouse device)
} MouseButton;

// Mouse cursor
typedef enum
{
    MOUSE_CURSOR_DEFAULT = 0,       // Default pointer shape
    MOUSE_CURSOR_ARROW = 1,         // Arrow shape
    MOUSE_CURSOR_IBEAM = 2,         // Text writing cursor shape
    MOUSE_CURSOR_CROSSHAIR = 3,     // Cross shape
    MOUSE_CURSOR_POINTING_HAND = 4, // Pointing hand cursor
    MOUSE_CURSOR_RESIZE_EW = 5,     // Horizontal resize/move arrow shape
    MOUSE_CURSOR_RESIZE_NS = 6,     // Vertical resize/move arrow shape
    MOUSE_CURSOR_RESIZE_NWSE = 7,   // Top-left to bottom-right diagonal resize/move arrow shape
    MOUSE_CURSOR_RESIZE_NESW = 8,   // The top-right to bottom-left diagonal resize/move arrow shape
    MOUSE_CURSOR_RESIZE_ALL = 9,    // The omnidirectional resize/move cursor shape
    MOUSE_CURSOR_NOT_ALLOWED = 10   // The operation-not-allowed shape
} MouseCursor;

// Gamepad buttons
typedef enum
{
    GAMEPAD_BUTTON_UNKNOWN = 0,      // Unknown button, just for error checking
    GAMEPAD_BUTTON_LEFT_FACE_UP,     // Gamepad left DPAD up button
    GAMEPAD_BUTTON_LEFT_FACE_RIGHT,  // Gamepad left DPAD right button
    GAMEPAD_BUTTON_LEFT_FACE_DOWN,   // Gamepad left DPAD down button
    GAMEPAD_BUTTON_LEFT_FACE_LEFT,   // Gamepad left DPAD left button
    GAMEPAD_BUTTON_RIGHT_FACE_UP,    // Gamepad right button up (i.e. PS3: Triangle, Xbox: Y)
    GAMEPAD_BUTTON_RIGHT_FACE_RIGHT, // Gamepad right button right (i.e. PS3: Circle, Xbox: B)
    GAMEPAD_BUTTON_RIGHT_FACE_DOWN,  // Gamepad right button down (i.e. PS3: Cross, Xbox: A)
    GAMEPAD_BUTTON_RIGHT_FACE_LEFT,  // Gamepad right button left (i.e. PS3: Square, Xbox: X)
    GAMEPAD_BUTTON_LEFT_TRIGGER_1,   // Gamepad top/back trigger left (first), it could be a trailing button
    GAMEPAD_BUTTON_LEFT_TRIGGER_2,   // Gamepad top/back trigger left (second), it could be a trailing button
    GAMEPAD_BUTTON_RIGHT_TRIGGER_1,  // Gamepad top/back trigger right (first), it could be a trailing button
    GAMEPAD_BUTTON_RIGHT_TRIGGER_2,  // Gamepad top/back trigger right (second), it could be a trailing button
    GAMEPAD_BUTTON_MIDDLE_LEFT,      // Gamepad center buttons, left one (i.e. PS3: Select)
    GAMEPAD_BUTTON_MIDDLE,           // Gamepad center buttons, middle one (i.e. PS3: PS, Xbox: XBOX)
    GAMEPAD_BUTTON_MIDDLE_RIGHT,     // Gamepad center buttons, right one (i.e. PS3: Start)
    GAMEPAD_BUTTON_LEFT_THUMB,       // Gamepad joystick pressed button left
    GAMEPAD_BUTTON_RIGHT_THUMB       // Gamepad joystick pressed button right
} GamepadButton;

// Gamepad axis
typedef enum
{
    GAMEPAD_AXIS_LEFT_X = 0,       // Gamepad left stick X axis
    GAMEPAD_AXIS_LEFT_Y = 1,       // Gamepad left stick Y axis
    GAMEPAD_AXIS_RIGHT_X = 2,      // Gamepad right stick X axis
    GAMEPAD_AXIS_RIGHT_Y = 3,      // Gamepad right stick Y axis
    GAMEPAD_AXIS_LEFT_TRIGGER = 4, // Gamepad back trigger left, pressure level: [1..-1]
    GAMEPAD_AXIS_RIGHT_TRIGGER = 5 // Gamepad back trigger right, pressure level: [1..-1]
} GamepadAxis;

// Material map index
typedef enum
{
    MATERIAL_MAP_ALBEDO = 0, // Albedo material (same as: MATERIAL_MAP_DIFFUSE)
    MATERIAL_MAP_METALNESS,  // Metalness material (same as: MATERIAL_MAP_SPECULAR)
    MATERIAL_MAP_NORMAL,     // Normal material
    MATERIAL_MAP_ROUGHNESS,  // Roughness material
    MATERIAL_MAP_OCCLUSION,  // Ambient occlusion material
    MATERIAL_MAP_EMISSION,   // Emission material
    MATERIAL_MAP_HEIGHT,     // Heightmap material
    MATERIAL_MAP_CUBEMAP,    // Cubemap material (NOTE: Uses GL_TEXTURE_CUBE_MAP)
    MATERIAL_MAP_IRRADIANCE, // Irradiance material (NOTE: Uses GL_TEXTURE_CUBE_MAP)
    MATERIAL_MAP_PREFILTER,  // Prefilter material (NOTE: Uses GL_TEXTURE_CUBE_MAP)
    MATERIAL_MAP_BRDF        // Brdf material
} MaterialMapIndex;

#define MATERIAL_MAP_DIFFUSE MATERIAL_MAP_ALBEDO
#define MATERIAL_MAP_SPECULAR MATERIAL_MAP_METALNESS

// Shader location index
typedef enum
{
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

#define SHADER_LOC_MAP_DIFFUSE SHADER_LOC_MAP_ALBEDO
#define SHADER_LOC_MAP_SPECULAR SHADER_LOC_MAP_METALNESS

// Shader uniform data type
typedef enum
{
    SHADER_UNIFORM_FLOAT = 0, // Shader uniform type: float
    SHADER_UNIFORM_VEC2,      // Shader uniform type: vec2 (2 float)
    SHADER_UNIFORM_VEC3,      // Shader uniform type: vec3 (3 float)
    SHADER_UNIFORM_VEC4,      // Shader uniform type: vec4 (4 float)
    SHADER_UNIFORM_INT,       // Shader uniform type: int
    SHADER_UNIFORM_IVEC2,     // Shader uniform type: ivec2 (2 int)
    SHADER_UNIFORM_IVEC3,     // Shader uniform type: ivec3 (3 int)
    SHADER_UNIFORM_IVEC4,     // Shader uniform type: ivec4 (4 int)
    SHADER_UNIFORM_SAMPLER2D  // Shader uniform type: sampler2d
} ShaderUniformDataType;

// Shader attribute data types
typedef enum
{
    SHADER_ATTRIB_FLOAT = 0, // Shader attribute type: float
    SHADER_ATTRIB_VEC2,      // Shader attribute type: vec2 (2 float)
    SHADER_ATTRIB_VEC3,      // Shader attribute type: vec3 (3 float)
    SHADER_ATTRIB_VEC4       // Shader attribute type: vec4 (4 float)
} ShaderAttributeDataType;

// Pixel formats
// NOTE: Support depends on OpenGL version and platform
typedef enum
{
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
typedef enum
{
    TEXTURE_FILTER_POINT = 0,       // No filter, just pixel approximation
    TEXTURE_FILTER_BILINEAR,        // Linear filtering
    TEXTURE_FILTER_TRILINEAR,       // Trilinear filtering (linear with mipmaps)
    TEXTURE_FILTER_ANISOTROPIC_4X,  // Anisotropic filtering 4x
    TEXTURE_FILTER_ANISOTROPIC_8X,  // Anisotropic filtering 8x
    TEXTURE_FILTER_ANISOTROPIC_16X, // Anisotropic filtering 16x
} TextureFilter;

// Texture parameters: wrap mode
typedef enum
{
    TEXTURE_WRAP_REPEAT = 0,    // Repeats texture in tiled mode
    TEXTURE_WRAP_CLAMP,         // Clamps texture to edge pixel in tiled mode
    TEXTURE_WRAP_MIRROR_REPEAT, // Mirrors and repeats the texture in tiled mode
    TEXTURE_WRAP_MIRROR_CLAMP   // Mirrors and clamps to border the texture in tiled mode
} TextureWrap;

// Cubemap layouts
typedef enum
{
    CUBEMAP_LAYOUT_AUTO_DETECT = 0,     // Automatically detect layout type
    CUBEMAP_LAYOUT_LINE_VERTICAL,       // Layout is defined by a vertical line with faces
    CUBEMAP_LAYOUT_LINE_HORIZONTAL,     // Layout is defined by a horizontal line with faces
    CUBEMAP_LAYOUT_CROSS_THREE_BY_FOUR, // Layout is defined by a 3x4 cross with cubemap faces
    CUBEMAP_LAYOUT_CROSS_FOUR_BY_THREE  // Layout is defined by a 4x3 cross with cubemap faces
} CubemapLayout;

// Font type, defines generation method
typedef enum
{
    FONT_DEFAULT = 0, // Default font generation, anti-aliased
    FONT_BITMAP,      // Bitmap font generation, no anti-aliasing
    FONT_SDF          // SDF font generation, requires external shader
} FontType;

// Color blending modes (pre-defined)
typedef enum
{
    BLEND_ALPHA = 0,         // Blend textures considering alpha (default)
    BLEND_ADDITIVE,          // Blend textures adding colors
    BLEND_MULTIPLIED,        // Blend textures multiplying colors
    BLEND_ADD_COLORS,        // Blend textures adding colors (alternative)
    BLEND_SUBTRACT_COLORS,   // Blend textures subtracting colors (alternative)
    BLEND_ALPHA_PREMULTIPLY, // Blend premultiplied textures considering alpha
    BLEND_CUSTOM,            // Blend textures using custom src/dst factors (use rlSetBlendFactors())
    BLEND_CUSTOM_SEPARATE    // Blend textures using custom rgb/alpha separate src/dst factors (use rlSetBlendFactorsSeparate())
} BlendMode;

// Gesture
// NOTE: Provided as bit-wise flags to enable only desired gestures
typedef enum
{
    GESTURE_NONE = 0,         // No gesture
    GESTURE_TAP = 1,          // Tap gesture
    GESTURE_DOUBLETAP = 2,    // Double tap gesture
    GESTURE_HOLD = 4,         // Hold gesture
    GESTURE_DRAG = 8,         // Drag gesture
    GESTURE_SWIPE_RIGHT = 16, // Swipe right gesture
    GESTURE_SWIPE_LEFT = 32,  // Swipe left gesture
    GESTURE_SWIPE_UP = 64,    // Swipe up gesture
    GESTURE_SWIPE_DOWN = 128, // Swipe down gesture
    GESTURE_PINCH_IN = 256,   // Pinch in gesture
    GESTURE_PINCH_OUT = 512   // Pinch out gesture
} Gesture;

// Camera system modes
typedef enum
{
    CAMERA_CUSTOM = 0,   // Camera custom, controlled by user (UpdateCamera() does nothing)
    CAMERA_FREE,         // Camera free mode
    CAMERA_ORBITAL,      // Camera orbital, around target, zoom supported
    CAMERA_FIRST_PERSON, // Camera first person
    CAMERA_THIRD_PERSON  // Camera third person
} CameraMode;

// Camera projection
typedef enum
{
    CAMERA_PERSPECTIVE = 0, // Perspective projection
    CAMERA_ORTHOGRAPHIC     // Orthographic projection
} CameraProjection;

// N-patch layout
typedef enum
{
    NPATCH_NINE_PATCH = 0,        // Npatch layout: 3x3 tiles
    NPATCH_THREE_PATCH_VERTICAL,  // Npatch layout: 1x3 tiles
    NPATCH_THREE_PATCH_HORIZONTAL // Npatch layout: 3x1 tiles
} NPatchLayout;

typedef char* va_list;

// Callbacks to hook some internal functions
// WARNING: These callbacks are intended for advanced users
typedef void (*TraceLogCallback)(int logLevel, const char *text, va_list args);       // Logging: Redirect trace log messages
typedef unsigned char *(*LoadFileDataCallback)(const char *fileName, int *dataSize);  // FileIO: Load binary data
typedef bool (*SaveFileDataCallback)(const char *fileName, void *data, int dataSize); // FileIO: Save binary data
typedef char *(*LoadFileTextCallback)(const char *fileName);                          // FileIO: Load text data
typedef bool (*SaveFileTextCallback)(const char *fileName, char *text);               // FileIO: Save text data

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
 * @brief 检查窗口是否已成功初始化
 *
 * @return bool
 */
bool IsWindowReady();

/**
 * @brief 检查窗口当前是否为全屏模式
 *
 * @return bool
 */
bool IsWindowFullscreen();

/**
 * @brief 检查窗口当前是否为隐藏模式
 *
 * @return bool
 */
bool IsWindowHidden();

/**
 * @brief 检查窗口当前是否为最小化模式
 *
 * @return bool
 */
bool IsWindowMinimized();

/**
 * @brief 检查窗口当前是否为最大化模式
 *
 * @return bool
 */
bool IsWindowMaximized();

/**
 * @brief 检查窗口当前是否处于焦点状态
 *
 * @return bool
 */
bool IsWindowFocused();

/**
 * @brief 检查窗口在上一帧是否被调整大小
 *
 * @return bool
 */
bool IsWindowResized();

/**
 * @brief 检查是否启用了一个特定的窗口标志
 *
 * @param flag unsigned int 要检查的窗口标志
 * @return bool
 */
bool IsWindowState(unsigned int flag);

/**
 * @brief 使用标志设置窗口配置状态
 *
 * @param flags unsigned int 要设置的窗口标志
 * @return void
 */
void SetWindowState(unsigned int flags);

/**
 * @brief 清除窗口配置状态标志
 *
 * @param flags unsigned int 要清除的窗口标志
 * @return void
 */
void ClearWindowState(unsigned int flags);

/**
 * @brief 切换窗口状态：全屏/窗口模式，调整显示器以匹配窗口分辨率
 *
 * @return void
 */
void ToggleFullscreen();

/**
 * 切换窗口状态：无边框窗口模式，调整窗口以匹配显示器分辨率
 *
 * @return void
 */
void ToggleBorderlessWindowed();

/**
 * @brief 设置窗口状态：最大化（如果窗口可调整大小）
 *
 * @return void
 */
void MaximizeWindow();

/**
 * @brief 设置窗口状态：最小化（如果窗口可调整大小）
 *
 * @return void
 */
void MinimizeWindow(void);

/**
 * @brief 设置窗口状态：非最小化/最大化
 *
 * @return void
 */
void RestoreWindow(void);

/**
 * @brief 设置窗口图标（单张图像，RGBA 32位）
 *
 * @param image Image 要设置的图像
 * @return void
 */
void SetWindowIcon(Image image);

/**
 * @brief 设置窗口图标（多张图像，RGBA 32位）
 *
 * @param images Image* 要设置的图像数组
 * @param count int 图像数组的大小
 * @return void
 */
void SetWindowIcons(Image *images, int count);

/**
 * @brief 设置窗口标题
 *
 * @param title const char* 要设置的标题
 * @return void
 */
void SetWindowTitle(const char *title);

/**
 * @brief 设置窗口在屏幕上的位置
 *
 * @param x int 窗口的X坐标
 * @param y int 窗口的Y坐标
 * @return void
 */
void SetWindowPosition(int x, int y);

/**
 * @brief 设置当前窗口所在的显示器
 *
 * @param monitor int 显示器的索引
 * @return void
 */
void SetWindowMonitor(int monitor);

/**
 * @brief 设置窗口的最小尺寸（适用于可调整大小的窗口）
 *
 * @param width int 最小宽度
 * @param height int 最小高度
 * @return void
 */
void SetWindowMinSize(int width, int height);

/**
 * @brief 设置窗口的最大尺寸（适用于可调整大小的窗口）
 *
 * @param width int 最大宽度
 * @param height int 最大高度
 * @return void
 */
void SetWindowMaxSize(int width, int height);

/**
 * @brief 设置窗口的大小
 *
 * @param width int 宽度
 * @param height int 高度
 * @return void
 */
void SetWindowSize(int width, int height);

/**
 * @brief 设置窗口的透明度
 *
 * @param opacity float 透明度（0.0f到1.0f）
 * @return void
 */
void SetWindowOpacity(float opacity);

/**
 * @brief 设置窗口获得焦点
 *
 * @return void
 */
void SetWindowFocused(void);

/**
 * @brief 获取原生窗口句柄
 *
 * @return void* 原生窗口句柄
 */
void *GetWindowHandle(void);

/**
 * @brief 获取当前屏幕宽度
 *
 * @return int 屏幕宽度
 */
int GetScreenWidth(void);

/**
 * @brief 获取当前屏幕高度
 *
 * @return int 屏幕高度
 */
int GetScreenHeight(void);

/**
 * @brief 获取当前渲染宽度（考虑高DPI）
 *
 * @return int 渲染宽度
 */
int GetRenderWidth(void);

/**
 * @brief 获取当前渲染高度（考虑高DPI）
 *
 * @return int 渲染高度
 */
int GetRenderHeight(void);

/**
 * @brief 获取连接的显示器数量
 *
 * @return int 显示器数量
 */
int GetMonitorCount(void);

/**
 * @brief 获取窗口所在的当前显示器
 *
 * @return int 显示器索引
 */
int GetCurrentMonitor(void);

/**
 * @brief 获取指定显示器的位置
 *
 * @param monitor int 显示器索引
 * @return Vector2 显示器位置
 */
Vector2 GetMonitorPosition(int monitor);

/**
 * @brief 获取指定显示器的宽度（显示器当前使用的视频模式）
 *
 * @param monitor int 显示器索引
 * @return int 显示器宽度
 */
int GetMonitorWidth(int monitor);

/**
 * @brief 获取指定显示器的高度（显示器当前使用的视频模式）
 *
 * @param monitor int 显示器索引
 * @return int 显示器高度
 */
int GetMonitorHeight(int monitor);

/**
 * @brief 获取指定显示器的物理宽度（以毫米为单位）
 *
 * @param monitor int 显示器索引
 * @return int 显示器物理宽度
 */
int GetMonitorPhysicalWidth(int monitor);

/**
 * @brief 获取指定显示器的物理高度（以毫米为单位）
 *
 * @param monitor int 显示器索引
 * @return int 显示器物理高度
 */
int GetMonitorPhysicalHeight(int monitor);

/**
 * @brief 获取指定显示器的刷新率
 *
 * @param monitor int 显示器索引
 * @return int 显示器刷新率
 */
int GetMonitorRefreshRate(int monitor);

/**
 * @brief 获取窗口在显示器上的XY位置
 *
 * @return Vector2 窗口位置
 */
Vector2 GetWindowPosition(void);

/**
 * @brief 获取窗口的缩放DPI因子
 *
 * @return Vector2 缩放DPI因子
 */
Vector2 GetWindowScaleDPI(void);

/**
 * @brief 获取指定显示器的可读UTF-8编码名称
 *
 * @param monitor int 显示器索引
 * @return const char* 显示器名称
 */
const char *GetMonitorName(int monitor);

/**
 * @brief 设置剪贴板的文本内容
 *
 * @param text const char* 要设置的文本内容
 */
void SetClipboardText(const char *text);

/**
 * @brief 获取剪贴板的文本内容
 *
 * @return const char* 剪贴板文本内容
 */
const char *GetClipboardText(void);

/**
 * @brief 获取剪贴板的图像内容
 *
 * @return Image 剪贴板图像内容
 */
Image GetClipboardImage(void);

/**
 * @brief 启用在EndDrawing()时等待事件，不自动轮询事件
 */
void EnableEventWaiting(void);

/**
 * @brief 禁用在EndDrawing()时等待事件，自动轮询事件
 *
 * @return void
 */
void DisableEventWaiting(void);

// ------窗口相关函数end-------------------------------------

// ------与光标相关的函数-------------------------------------

/**
 * @brief 显示光标
 *
 * @return void
 */
void ShowCursor(void);

/**
 * @brief 隐藏光标
 *
 * @return void
 */
void HideCursor(void);

/**
 * @brief 检查光标是否不可见
 *
 * @return bool
 */
bool IsCursorHidden(void);

/**
 * @brief 启用光标（解锁光标）
 *
 * @return void
 */
void EnableCursor(void);

/**
 * @brief 禁用光标（锁定光标）
 *
 * @return void
 */
void DisableCursor(void);

/**
 * @brief 检查光标是否在屏幕上
 *
 * @return bool
 */
bool IsCursorOnScreen(void);

// ------与光标相关的函数end-------------------------------------

// ------绘图相关函数-------------------------------------

/**
 * @brief 设置背景颜色（帧缓冲区清除颜色）
 *
 * @param color Color 背景颜色
 * @return void
 */
void ClearBackground(Color color);

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

/**
 * @brief 开始使用自定义相机开始2D模式绘图
 *
 * @param camera Camera2D 相机
 * @return void
 */
void BeginMode2D(Camera2D camera);

/**
 * @brief 结束2D模式绘图
 *
 * @return void
 */
void EndMode2D(void);

/**
 * @brief 开始使用自定义相机开始3D模式绘图
 *
 * @param camera Camera3D 相机
 * @return void
 */
void BeginMode3D(Camera3D camera);

/**
 * @brief 结束3D模式绘图
 *
 * @return void
 */
void EndMode3D(void);

/**
 * @brief 开始向渲染纹理绘图
 *
 * @param target RenderTexture2D 渲染纹理
 * @return void
 */
void BeginTextureMode(RenderTexture2D target);

/**
 * @brief 结束向渲染纹理绘图
 */
void EndTextureMode(void);

/**
 * @brief 开始使用自定义着色器绘图
 *
 * @param shader Shader 着色器
 * @return void
 */
void BeginShaderMode(Shader shader);

/**
 * @brief 结束使用自定义着色器绘图
 *
 * @return void
 */
void EndShaderMode(void);

/**
 * @brief 开始混合模式（alpha、加法、乘法、减法、自定义）
 *
 * @param mode int 混合模式
 * @return void
 */
void BeginBlendMode(int mode);

/**
 * @brief 结束混合模式
 *
 * @return void
 */
void EndBlendMode(void);

/**
 * @brief 开始裁剪模式（定义后续绘图的屏幕区域）
 *
 * @param x int 裁剪区域的X坐标
 * @param y int 裁剪区域的Y坐标
 * @param width int 裁剪区域的宽度
 * @param height int 裁剪区域的高度
 * @return void
 */
void BeginScissorMode(int x, int y, int width, int height);

/**
 * @brief 结束裁剪模式
 *
 * @return void
 */
void EndScissorMode(void);

/**
 * @brief 开始立体渲染（需要VR模拟器）
 *
 * @param config VrStereoConfig 立体渲染配置
 * @return void
 */
void BeginVrStereoMode(VrStereoConfig config);

/**
 * @brief 结束立体渲染（需要VR模拟器）
 *
 * @return void
 */
void EndVrStereoMode(void);

// ------绘图相关函数end-------------------------------------

// ------VR模拟器的VR立体配置函数-------------------------------------

/**
 * @brief 为VR模拟器设备参数加载VR立体配置
 *
 * @param device VrDeviceInfo 设备信息
 * @return VrStereoConfig 配置
 */
VrStereoConfig LoadVrStereoConfig(VrDeviceInfo device);

/**
 * @brief 卸载VR立体配置
 *
 * @param config VrStereoConfig 配置
 * @return void
 */
void UnloadVrStereoConfig(VrStereoConfig config);

// ------VR模拟器的VR立体配置函数end-------------------------------------

// ------着色器管理函数-------------------------------------
// 注意: OpenGL 1.1 不支持着色器功能

/**
 * @brief 从文件加载着色器并绑定默认位置
 *
 * @param vsFileName const char * vs文件名
 * @param fsFileName const char * fs文件名
 * @return Shader
 */
Shader LoadShader(const char *vsFileName, const char *fsFileName);

/**
 * @brief 从代码字符串加载着色器并绑定默认位置
 *
 * @param vsCode const char * vs代码
 * @param fsCode const char * fs代码
 * @return Shader
 */
Shader LoadShaderFromMemory(const char *vsCode, const char *fsCode);

/**
 * @brief 检查着色器是否有效（已加载到 GPU）
 *
 * @param shader Shader 着色器
 * @return true
 * @return false
 */
bool IsShaderValid(Shader shader);

/**
 * @brief 获取着色器统一变量的位置
 *
 * @param shader Shader 着色器
 * @param uniformName const char * 统一变量名称
 * @return int
 */
int GetShaderLocation(Shader shader, const char *uniformName);

/**
 * @brief 获取着色器属性的位置
 *
 * @param shader Shader 着色器
 * @param attribName const char * 属性名称
 * @return int
 */
int GetShaderLocationAttrib(Shader shader, const char *attribName);

/**
 * @brief 设置着色器统一变量的值
 *
 * @param shader Shader 着色器
 * @param locIndex int 位置索引
 * @param value const void * 值
 * @param uniformType int 统一类型
 * @return void
 */
void SetShaderValue(Shader shader, int locIndex, const void *value, int uniformType);

/**
 * @brief 设置着色器统一变量的值向量
 *
 * @param shader Shader 着色器
 * @param locIndex int 位置索引
 * @param value const void * 值
 * @param uniformType int 统一类型
 * @param count int 计数
 * @return void
 */
void SetShaderValueV(Shader shader, int locIndex, const void *value, int uniformType, int count);

/**
 * @brief 设置着色器统一变量的值（4x4 矩阵）
 *
 * @param shader Shader 着色器
 * @param locIndex int 位置索引
 * @param mat Matrix 矩阵
 * @return void
 */
void SetShaderValueMatrix(Shader shader, int locIndex, Matrix mat);

/**
 * @brief 设置着色器统一变量的纹理值（采样器 2D）
 *
 * @param shader Shader 着色器
 * @param locIndex int 位置索引
 * @param texture Texture2D 纹理
 * @return void
 */
void SetShaderValueTexture(Shader shader, int locIndex, Texture2D texture);

/**
 * @brief 从 GPU 内存（VRAM）中卸载着色器
 *
 * @param shader Shader 着色器
 * @return void
 */
void UnloadShader(Shader shader);

// ------着色器管理函数end-------------------------------------

// ------与屏幕空间相关的函数-------------------------------------

/**
 * @brief 从屏幕位置（如鼠标位置）获取一条射线（即射线追踪）
 *
 * @param position Vector2 屏幕位置
 * @param camera Camera 相机
 * @return Ray
 */
Ray GetScreenToWorldRay(Vector2 position, Camera camera);

/**
 * @brief 在视口内从屏幕位置（如鼠标位置）获取一条射线（即射线追踪）
 *
 * @param position Vector2 屏幕位置
 * @param camera Camera 相机
 * @param width int 宽
 * @param height int 高
 * @return Ray
 */
Ray GetScreenToWorldRayEx(Vector2 position, Camera camera, int width, int height);

/**
 * @brief 获取 3D 世界空间位置在屏幕空间中的位置
 *
 * @param position Vector3 世界空间位置
 * @param camera Camera 相机
 * @return Vector2
 */
Vector2 GetWorldToScreen(Vector3 position, Camera camera);

/**
 * @brief 获取 3D 世界空间位置在指定视口尺寸下的屏幕空间位置
 *
 * @param position Vector3 世界空间位置
 * @param camera Camera 相机
 * @param width int 宽
 * @param height int 高
 * @return Vector2
 */
Vector2 GetWorldToScreenEx(Vector3 position, Camera camera, int width, int height);

/**
 * @brief 获取 2D 相机世界空间位置在屏幕空间中的位置
 *
 * @param position Vector2 世界空间位置
 * @param camera Camera2D 相机
 * @return Vector2
 */
Vector2 GetWorldToScreen2D(Vector2 position, Camera2D camera);

/**
 * @brief 获取 2D 相机屏幕空间位置在世界空间中的位置
 *
 * @param position Vector2 屏幕空间位置
 * @param camera Camera2D 相机
 * @return Vector2
 */
Vector2 GetScreenToWorld2D(Vector2 position, Camera2D camera);

/**
 * @brief 获取相机的变换矩阵（视图矩阵）
 *
 * @param camera Camera 相机
 * @return Matrix
 */
Matrix GetCameraMatrix(Camera camera);

/**
 * @brief 获取 2D 相机的变换矩阵
 *
 * @param camera Camera2D 相机
 * @return Matrix
 */
Matrix GetCameraMatrix2D(Camera2D camera);

// ------与屏幕空间相关的函数end-------------------------------------

// ------与时间相关的函数-------------------------------------

/**
 * @brief 设置目标帧率（最大值）
 *
 * @param fps
 */
void SetTargetFPS(int fps);

/**
 * @brief 获取上一帧绘制所用的时间（以秒为单位，即增量时间）
 *
 * @return float
 */
float GetFrameTime(void);

/**
 * @brief 获取自InitWindow()调用以来经过的时间（以秒为单位）
 *
 * @return double
 */
double GetTime(void);

/**
 * @brief 获取当前帧率
 *
 * @return int
 */
int GetFPS(void);

// ------与时间相关的函数end-------------------------------------

// ------自定义帧控制函数-------------------------------------
// 注意: 这些函数供需要完全控制帧处理的高级用户使用
// 默认情况下，EndDrawing() 完成以下工作: 绘制所有内容 + 交换屏幕缓冲区 + 管理帧计时 + 轮询输入事件
// 若要避免这种行为并手动控制帧处理过程，请在 config.h 中启用: SUPPORT_CUSTOM_FRAME_CONTROL

/**
 * @brief 交换后缓冲区和前缓冲区（屏幕绘制）
 *
 * @return void
 */
void SwapScreenBuffer(void);

/**
 * @brief 注册所有输入事件
 *
 * @return void
 */
void PollInputEvents(void);

/**
 * @brief 等待一段时间（暂停程序执行）
 *
 * @param seconds double 秒数
 * @return void
 */
void WaitTime(double seconds);

// ------自定义帧控制函数end-------------------------------------

// ------随机值生成函数-------------------------------------

/**
 * @brief 设置随机数生成器的种子
 *
 * @param seed
 * @return void
 */
void SetRandomSeed(unsigned int seed);

/**
 * @brief 获取一个介于 min 和 max 之间的随机值（包含两端）
 *
 * @param min int 最小值
 * @param max int 最大值
 * @return int
 */
int GetRandomValue(int min, int max);

/**
 * @brief 加载随机值序列，无重复值
 *
 * @param count unsigned int 数量
 * @param min int 最小值
 * @param max int 最大值
 * @return int*
 */
int *LoadRandomSequence(unsigned int count, int min, int max);

/**
 * @brief 卸载随机值序列
 *
 * @param sequence int* 序列
 * @return void
 */
void UnloadRandomSequence(int *sequence);

// ------随机值生成函数end-------------------------------------

// ------杂项函数-------------------------------------

/**
 * @brief 对当前屏幕进行截图（文件名扩展名定义格式）
 *
 * @param fileName const char * 文件名
 * @return void
 */
void TakeScreenshot(const char *fileName);

/**
 * @brief 设置初始化配置标志（查看 FLAGS）
 *
 * @param flags unsigned int 标志
 * @return void
 */
void SetConfigFlags(unsigned int flags);

/**
 * @brief 使用默认系统浏览器打开 URL（如果可用）
 *
 * @param url const char* URL
 */
void OpenURL(const char *url);

// ------杂项函数end-------------------------------------

// ------注意: 以下函数在 [utils] 模块中实现-------------------------------------

/**
 * @brief 显示跟踪日志消息（LOG_DEBUG、LOG_INFO、LOG_WARNING、LOG_ERROR 等）
 *
 * @param logLevel int 日志级别
 * @param text const char* 日志文本
 * @param ...
 * @return void
 */
void TraceLog(int logLevel, const char *text, ...);

/**
 * @brief 设置当前阈值（最低）日志级别
 *
 * @param logLevel int 日志级别
 * @return void
 */
void SetTraceLogLevel(int logLevel);

/**
 * @brief 内部内存分配器
 *
 * @param size unsigned int 大小
 * @return void*
 */
void *MemAlloc(unsigned int size);

/**
 * @brief 内部内存重新分配器
 *
 * @param ptr void*
 * @param size unsigned int 大小
 * @return void*
 */
void *MemRealloc(void *ptr, unsigned int size);

/**
 * @brief 内部内存释放
 *
 * @param ptr void*
 * @return void
 */
void MemFree(void *ptr);

// ------注意: 以下函数在 [utils] 模块中实现end-------------------------------------

// ------设置自定义回调函数-------------------------------------
// 警告: 回调函数的设置仅适用于高级用户

/**
 * @brief 设置自定义跟踪日志回调函数
 *
 * @param callback TraceLogCallback 回调函数
 * @return void
 */
void SetTraceLogCallback(TraceLogCallback callback);

/**
 * @brief 设置自定义文件二进制数据加载回调函数
 *
 * @param callback LoadFileDataCallback 回调函数
 * @return void
 */
void SetLoadFileDataCallback(LoadFileDataCallback callback);

/**
 * @brief 设置自定义文件二进制数据保存回调函数
 *
 * @param callback SaveFileDataCallback 回调函数
 * @return void
 */
void SetSaveFileDataCallback(SaveFileDataCallback callback);

/**
 * @brief 设置自定义文件文本数据加载回调函数
 *
 * @param callback LoadFileTextCallback 回调函数
 * @return void
 */
void SetLoadFileTextCallback(LoadFileTextCallback callback);

/**
 * @brief 设置自定义文件文本数据保存回调函数
 *
 * @param callback SaveFileTextCallback 回调函数
 */
void SetSaveFileTextCallback(SaveFileTextCallback callback);

// ------设置自定义回调函数end-------------------------------------

// ------文件管理函数-------------------------------------

/**
 * @brief 以字节数组形式加载文件数据（读取）
 *
 * @param fileName const char* 文件名
 * @param dataSize int* 数据大小
 * @return unsigned char*
 */
unsigned char *LoadFileData(const char *fileName, int *dataSize);

/**
 * @brief 卸载由LoadFileData()分配的文件数据
 *
 * @param data unsigned char* 数据
 * @return void
 */
void UnloadFileData(unsigned char *data);

/**
 * @brief 将字节数组中的数据保存到文件（写入），成功返回true
 *
 * @param fileName const char* 文件名
 * @param data void* 数据
 * @param dataSize int 数据大小
 * @return true
 * @return false
 */
bool SaveFileData(const char *fileName, void *data, int dataSize);

/**
 * @brief 将数据导出为代码文件（.h），成功返回true
 *
 * @param data const unsigned char* 数据
 * @param dataSize int 数据大小
 * @param fileName const char* 文件名
 * @return true
 * @return false
 */
bool ExportDataAsCode(const unsigned char *data, int dataSize, const char *fileName);

/**
 * @brief 从文件中加载文本数据（读取），返回以'\0'结尾的字符串
 *
 * @param fileName const char* 文件名
 * @return char*
 */
char *LoadFileText(const char *fileName);

/**
 * @brief 卸载由LoadFileText()分配的文件文本数据
 *
 * @param text char* 文本
 */
void UnloadFileText(char *text);

/**
 * @brief 将文本数据保存到文件（写入），字符串必须以'\0'结尾，成功返回true
 *
 * @param fileName const char* 文件名
 * @param text char* 文本
 * @return true
 * @return false
 */
bool SaveFileText(const char *fileName, char *text);

// ------文件管理函数end-------------------------------------

// ------文件系统函数-------------------------------------

/**
 * @brief 检查文件是否存在
 *
 * @param fileName const char* 文件名
 * @return true
 * @return false
 */
bool FileExists(const char *fileName);

/**
 * @brief 检查目录是否存在
 *
 * @param dirPath const char* 目录路径
 * @return true
 * @return false
 */
bool DirectoryExists(const char *dirPath);

/**
 * @brief 检查文件扩展名（包括点号：.png, .wav）
 *
 * @param fileName const char* 文件名
 * @param ext const char* 扩展名
 * @return true
 * @return false
 */
bool IsFileExtension(const char *fileName, const char *ext);

/**
 * @brief 获取文件的字节长度（注意: GetFileSize()与windows.h冲突）
 *
 * @param fileName const char* 文件名
 * @return int
 */
int GetFileLength(const char *fileName);

/**
 * @brief 获取文件名中扩展名的指针（包括点号: '.png'）
 *
 * @param fileName const char* 文件名
 * @return const char*
 */
const char *GetFileExtension(const char *fileName);

/**
 * @brief 获取路径字符串中的文件名指针
 *
 * @param filePath const char* 文件路径
 * @return const char*
 */
const char *GetFileName(const char *filePath);

/**
 * @brief 获取不带扩展名的文件名（使用静态字符串）
 *
 * @param filePath const char* 文件路径
 * @return const char*
 */
const char *GetFileNameWithoutExt(const char *filePath);

/**
 * @brief 获取包含路径的文件名的完整路径（使用静态字符串）
 *
 * @param filePath const char* 文件路径
 * @return const char*
 */
const char *GetDirectoryPath(const char *filePath);

/**
 * @brief 获取给定路径的上一级目录路径（使用静态字符串）
 *
 * @param dirPath const char* 目录路径
 * @return const char*
 */
const char *GetPrevDirectoryPath(const char *dirPath);

/**
 * @brief 获取当前工作目录（使用静态字符串）
 *
 * @return const char*
 */
const char *GetWorkingDirectory(void);

/**
 * @brief 获取运行中应用程序的目录（使用静态字符串）
 *
 * @return const char*
 */
const char *GetApplicationDirectory(void);

/**
 * @brief 创建目录（包括请求的完整路径），成功返回0
 *
 * @param dirPath const char* 目录路径
 * @return int
 */
int MakeDirectory(const char *dirPath);

/**
 * @brief 更改工作目录，成功返回true
 *
 * @param dir const char* 目录
 * @return true
 * @return false
 */
bool ChangeDirectory(const char *dir);

/**
 * @brief 检查给定路径是文件还是目录
 *
 * @param path const char* 路径
 * @return true
 * @return false
 */
bool IsPathFile(const char *path);

/**
 * @brief 检查文件名是否对平台/操作系统有效
 *
 * @param fileName const char* 文件名
 * @return true
 * @return false
 */
bool IsFileNameValid(const char *fileName);

/**
 * @brief 加载目录中的文件路径
 *
 * @param dirPath const char* 目录路径
 * @return FilePathList
 */
FilePathList LoadDirectoryFiles(const char *dirPath);

/**
 * @brief 加载目录中的文件路径，并进行扩展名过滤和递归目录扫描。在过滤字符串中使用 'DIR' 可将目录包含在结果中
 *
 * @param basePath const char* 目录路径
 * @param filter const char* 过滤字符串
 * @param scanSubdirs bool 是否扫描子目录
 * @return FilePathList
 */
FilePathList LoadDirectoryFilesEx(const char *basePath, const char *filter, bool scanSubdirs);

/**
 * @brief 卸载文件路径
 *
 * @param files FilePathList 文件路径列表
 * @return void
 */
void UnloadDirectoryFiles(FilePathList files);

/**
 * @brief 检查是否有文件被拖放到窗口中
 *
 * @return true
 * @return false
 */
bool IsFileDropped(void);

/**
 * @brief 加载被拖放的文件路径
 *
 * @return FilePathList
 */
FilePathList LoadDroppedFiles(void);

/**
 * @brief 卸载被拖放的文件路径
 *
 * @param files FilePathList 文件路径列表
 * @return void
 */
void UnloadDroppedFiles(FilePathList files);

/**
 * @brief 获取文件的修改时间（最后写入时间）
 *
 * @param fileName const char* 文件名
 * @return long
 */
long GetFileModTime(const char *fileName);

// ------文件系统函数end-------------------------------------

// ------压缩/编码功能-------------------------------------

/**
 * @brief 压缩数据（DEFLATE算法），内存必须使用MemFree()释放
 *
 * @param data const unsigned char* 数据
 * @param dataSize int 数据大小
 * @param compDataSize int* 压缩数据大小
 * @return unsigned char*
 */
unsigned char *CompressData(const unsigned char *data, int dataSize, int *compDataSize);

/**
 * @brief 解压缩数据（DEFLATE算法），内存必须使用MemFree()释放
 *
 * @param compData const unsigned char* 压缩数据
 * @param compDataSize int 压缩数据大小
 * @param dataSize int* 数据大小
 * @return unsigned char*
 */
unsigned char *DecompressData(const unsigned char *compData, int compDataSize, int *dataSize);

/**
 * @brief 将数据编码为Base64字符串，内存必须使用MemFree()释放
 *
 * @param data const unsigned char* 数据
 * @param dataSize int 数据大小
 * @param outputSize int* 输出大小
 * @return char*
 */
char *EncodeDataBase64(const unsigned char *data, int dataSize, int *outputSize);

/**
 * @brief 解码Base64字符串数据，内存必须使用MemFree()释放
 *
 * @param data const unsigned char* 数据
 * @param outputSize int* 输出大小
 * @return unsigned char*
 */
unsigned char *DecodeDataBase64(const unsigned char *data, int *outputSize);

/**
 * @brief 计算CRC32哈希码
 *
 * @param data const unsigned char* 数据
 * @param dataSize int 数据大小
 * @return unsigned int
 */
unsigned int ComputeCRC32(unsigned char *data, int dataSize);

/**
 * @brief 计算MD5哈希码，返回静态int[4]数组（16字节）
 *
 * @param data const unsigned char* 数据
 * @param dataSize int 数据大小
 * @return unsigned int*
 */
unsigned int *ComputeMD5(unsigned char *data, int dataSize);

/**
 * @brief 计算SHA1哈希码，返回静态int[5]数组（20字节）
 *
 * @param data const unsigned char* 数据
 * @param dataSize int 数据大小
 * @return unsigned int*
 */
unsigned int *ComputeSHA1(unsigned char *data, int dataSize);

// ------压缩/编码功能end-------------------------------------

// ------自动化事件功能-------------------------------------

/**
 * @brief 从文件加载自动化事件列表，若传入 NULL 则返回空列表，容量为 MAX_AUTOMATION_EVENTS
 *
 * @param fileName const char* 文件名
 * @return AutomationEventList
 */
AutomationEventList LoadAutomationEventList(const char *fileName);

/**
 * @brief 从文件中卸载自动化事件列表
 *
 * @param list AutomationEventList 自动化事件列表
 */
void UnloadAutomationEventList(AutomationEventList list);

/**
 * @brief 将自动化事件列表导出为文本文件
 *
 * @param list AutomationEventList 自动化事件列表
 * @param fileName const char* 文件名
 * @return true
 * @return false
 */
bool ExportAutomationEventList(AutomationEventList list, const char *fileName);

/**
 * @brief 置要记录的自动化事件列表
 *
 * @param list AutomationEventList 自动化事件列表
 */
void SetAutomationEventList(AutomationEventList *list);

/**
 * @brief 设置自动化事件内部的基础帧，开始记录
 *
 * @param frame int 帧
 * @return void
 */
void SetAutomationEventBaseFrame(int frame);

/**
 * @brief 开始记录自动化事件（必须先设置 AutomationEventList）
 *
 * @return void
 */
void StartAutomationEventRecording(void);

/**
 * @brief 停止记录自动化事件
 *
 * @return void
 */
void StopAutomationEventRecording(void);

/**
 * @brief 播放已记录的自动化事件
 *
 * @param list AutomationEventList 自动化事件列表
 * @return void
 */
void PlayAutomationEvent(AutomationEvent event);

// ------自动化事件功能end-------------------------------------

// ------输入处理函数 (模块: core)-------------------------------------
// 与输入相关的函数：键盘

/**
 * @brief 检查某个键是否被按下一次
 *
 * @param key int 键
 * @return true
 * @return false
 */
bool IsKeyPressed(int key);

/**
 * @brief 检查某个键是否再次被按下
 *
 * @param key int 键
 * @return true
 * @return false
 */
bool IsKeyPressedRepeat(int key);

/**
 * @brief 检查某个键是否正在被按下
 *
 * @param key int 键
 * @return true
 * @return false
 */
bool IsKeyDown(int key);

/**
 * @brief 检查某个键是否被释放一次
 *
 * @param key int 键
 * @return true
 * @return false
 */
bool IsKeyReleased(int key);

/**
 * @brief 检查某个键是否未被按下
 *
 * @param key int 键
 * @return true
 * @return false
 */
bool IsKeyUp(int key);

/**
 * @brief 获取按下的键（键码），多次调用以处理排队的键，队列空时返回 0
 *
 * @return int
 */
int GetKeyPressed(void);

/**
 * @brief 获取按下的字符（Unicode），多次调用以处理排队的字符，队列空时返回 0
 *
 * @return int
 */
int GetCharPressed(void);

/**
 * @brief 设置一个自定义键来退出程序（默认是 ESC）
 *
 * @param key
 */
void SetExitKey(int key);

// ------输入处理函数 (模块: core)end-------------------------------------

// ------与输入相关的函数：游戏手柄-------------------------------------

/**
 * @brief 检查某个游戏手柄是否可用
 *
 * @param gamepad int 游戏手柄
 * @return true
 * @return false
 */
bool IsGamepadAvailable(int gamepad);

/**
 * @brief 获取游戏手柄的内部名称 ID
 *
 * @param gamepad int 游戏手柄
 * @return const char*
 */
const char *GetGamepadName(int gamepad);

/**
 * @brief 检查游戏手柄的某个按钮是否被按下一次
 *
 * @param gamepad int 游戏手柄
 * @param button int 按钮
 * @return true
 * @return false
 */
bool IsGamepadButtonPressed(int gamepad, int button);

/**
 * @brief 检查游戏手柄的某个按钮是否正在被按下
 *
 * @param gamepad int 游戏手柄
 * @param button int 按钮
 * @return true
 * @return false
 */
bool IsGamepadButtonDown(int gamepad, int button);

/**
 * @brief 检查游戏手柄的某个按钮是否被释放一次
 *
 * @param gamepad int 游戏手柄
 * @param button int 按钮
 * @return true
 * @return false
 */
bool IsGamepadButtonReleased(int gamepad, int button);

/**
 * @brief 检查游戏手柄的某个按钮是否未被按下
 *
 * @param gamepad int 游戏手柄
 * @param button int 按钮
 * @return true
 * @return false
 */
bool IsGamepadButtonUp(int gamepad, int button);

/**
 * @brief 获取最后按下的游戏手柄按钮
 *
 * @return int
 */
int GetGamepadButtonPressed(void);

/**
 * @brief 获取某个游戏手柄的轴数量
 *
 * @param gamepad
 * @return int
 */
int GetGamepadAxisCount(int gamepad);

/**
 * @brief 获取某个游戏手柄的某个轴的移动值
 *
 * @param gamepad int 游戏手柄
 * @param axis int 轴
 * @return float
 */
float GetGamepadAxisMovement(int gamepad, int axis);

/**
 * @brief 设置内部游戏手柄映射（SDL_GameControllerDB）
 *
 * @param mappings const char* 映射
 * @return int
 */
int SetGamepadMappings(const char *mappings);

/**
 * @brief 设置游戏手柄两个马达的震动（持续时间以秒为单位）
 *
 * @param gamepad int 游戏手柄
 * @param leftMotor float 左马达
 * @param rightMotor float 右马达
 * @param duration float 持续时间
 * @return void
 */
void SetGamepadVibration(int gamepad, float leftMotor, float rightMotor, float duration);

// ------与输入相关的函数：游戏手柄end-------------------------------------

// ------与输入相关的函数：鼠标-------------------------------------

/**
 * @brief 检查某个鼠标按钮是否被按下一次
 *
 * @param button int 按钮
 * @return true
 * @return false
 */
bool IsMouseButtonPressed(int button);

/**
 * @brief 检查某个鼠标按钮是否正在被按下
 *
 * @param button int 按钮
 * @return true
 * @return false
 */
bool IsMouseButtonDown(int button);

/**
 * @brief 检查某个鼠标按钮是否被释放一次
 *
 * @param button int 按钮
 * @return true
 * @return false
 */
bool IsMouseButtonReleased(int button);

/**
 * @brief 检查某个鼠标按钮是否未被按下
 *
 * @param button int 按钮
 * @return true
 * @return false
 */
bool IsMouseButtonUp(int button);

/**
 * @brief 获取鼠标的 X 坐标
 *
 * @return int
 */
int GetMouseX(void);

/**
 * @brief 获取鼠标的 Y 坐标
 *
 * @return int
 */
int GetMouseY(void);

/**
 * @brief 获取鼠标的 XY 坐标
 *
 * @return Vector2
 */
Vector2 GetMousePosition(void);

/**
 * @brief 获取两帧之间鼠标的移动增量
 *
 * @return Vector2
 */
Vector2 GetMouseDelta(void);

/**
 * @brief 设置鼠标的 XY 坐标
 *
 * @param x int x
 * @param y int y
 * @return void
 */
void SetMousePosition(int x, int y);

/**
 * @brief 设置鼠标的偏移量
 *
 * @param offsetX int 偏移量
 * @param offsetY int 偏移量
 * @return void
 */
void SetMouseOffset(int offsetX, int offsetY);

/**
 * @brief 设置鼠标的缩放比例
 *
 * @param scaleX float 缩放比例
 * @param scaleY float 缩放比例
 */
void SetMouseScale(float scaleX, float scaleY);

/**
 * @brief 获取鼠标滚轮在 X 或 Y 方向上的最大移动量
 *
 * @return float
 */
float GetMouseWheelMove(void);

/**
 * @brief 获取鼠标滚轮在 X 和 Y 方向上的移动量
 *
 * @return Vector2
 */
Vector2 GetMouseWheelMoveV(void);

/**
 * @brief 设置鼠标光标样式
 *
 * @param cursor int 光标样式
 * @return void
 */
void SetMouseCursor(int cursor);

// ------与输入相关的函数：鼠标end-------------------------------------

// ------与输入相关的函数：触摸-------------------------------------

/**
 * @brief 获取触摸点 0 的 X 坐标（相对于屏幕尺寸）
 *
 * @return int
 */
int GetTouchX(void);

/**
 * @brief 获取触摸点 0 的 Y 坐标（相对于屏幕尺寸）
 *
 * @return int
 */
int GetTouchY(void);

/**
 * @brief 获取指定触摸点索引的 XY 坐标（相对于屏幕尺寸）
 *
 * @param index int 触摸点索引
 * @return Vector2
 */
Vector2 GetTouchPosition(int index);

/**
 * @brief 获取指定索引的触摸点标识符
 *
 * @param index int 触摸点索引
 * @return int
 */
int GetTouchPointId(int index);

/**
 * @brief 获取触摸点的数量
 *
 * @return int
 */
int GetTouchPointCount(void);

// ------与输入相关的函数：触摸end-------------------------------------

// ------手势和触摸处理函数 (模块: rgestures)-------------------------------------

/**
 * @brief 使用标志启用一组手势
 *
 * @param flags unsigned int 标志
 * @return void
 */
void SetGesturesEnabled(unsigned int flags);

/**
 * @brief 检查是否检测到某个手势
 *
 * @param gesture unsigned int 手势
 * @return true
 * @return false
 */
bool IsGestureDetected(unsigned int gesture);

/**
 * @brief 获取最新检测到的手势
 *
 * @return int
 */
int GetGestureDetected(void);

/**
 * @brief 获取手势按住的持续时间（以秒为单位）
 *
 * @return float
 */
float GetGestureHoldDuration(void);

/**
 * @brief 获取手势拖动向量
 *
 * @return Vector2
 */
Vector2 GetGestureDragVector(void);

/**
 * @brief 获取手势拖动角度
 *
 * @return float
 */
float GetGestureDragAngle(void);

/**
 * @brief 获取手势捏合的增量
 *
 * @return Vector2
 */
Vector2 GetGesturePinchVector(void);

/**
 * @brief 获取手势捏合角度
 *
 * @return float
 */
float GetGesturePinchAngle(void);

// ------手势和触摸处理函数 (模块: rgestures)end-------------------------------------

// ------样条线绘制函数-------------------------------------

/**
 * @brief 绘制线性样条线，至少需要2个点
 *
 * @param points Vector2* 点数组
 * @param pointCount int 点数量
 * @param thick float 线宽
 * @param color Color 颜色
 * @return void
 */
void DrawSplineLinear(const Vector2 *points, int pointCount, float thick, Color color);

/**
 * @brief 绘制B样条线，至少需要4个点
 *
 * @param points Vector2* 点数组
 * @param pointCount int 点数量
 * @param thick float 线宽
 * @param color Color 颜色
 * @return void
 */
void DrawSplineBasis(const Vector2 *points, int pointCount, float thick, Color color);

/**
 * @brief 绘制Catmull-Rom样条线，至少需要4个点
 *
 * @param points Vector2* 点数组
 * @param pointCount int 点数量
 * @param thick float 线宽
 * @param color Color 颜色
 * @return void
 */
void DrawSplineCatmullRom(const Vector2 *points, int pointCount, float thick, Color color);

/**
 * @brief 绘制二次贝塞尔样条线，至少需要3个点（1个控制点）：[p1, c2, p3, c4...]
 *
 * @param points Vector2* 点数组
 * @param pointCount int 点数量
 * @param thick float 线宽
 * @param color Color 颜色
 * @return void
 */
void DrawSplineBezierQuadratic(const Vector2 *points, int pointCount, float thick, Color color);

/**
 * @brief 绘制三次贝塞尔样条线，至少需要4个点（2个控制点）：[p1, c2, c3, p4, c5, c6...]
 *
 * @param points Vector2* 点数组
 * @param pointCount int 点数量
 * @param thick float 线宽
 * @param color Color 颜色
 * @return void
 */
void DrawSplineBezierCubic(const Vector2 *points, int pointCount, float thick, Color color);

/**
 * @brief 绘制线性样条线段，需要2个点
 *
 * @param p1 Vector2 p1
 * @param p2 Vector2 p2
 * @param thick float 线宽
 * @param color Color 颜色
 * @return void
 */
void DrawSplineSegmentLinear(Vector2 p1, Vector2 p2, float thick, Color color);

/**
 * @brief 绘制B样条线段，需要4个点
 *
 * @param p1 Vector2 p1
 * @param p2 Vector2 p2
 * @param p3 Vector2 p3
 * @param p4 Vector2 p4
 * @param thick float 线宽
 * @param color Color 颜色
 * @return void
 */
void DrawSplineSegmentBasis(Vector2 p1, Vector2 p2, Vector2 p3, Vector2 p4, float thick, Color color);

/**
 * @brief 绘制Catmull-Rom样条线段，需要4个点
 *
 * @param p1 Vector2 p1
 * @param p2 Vector2 p2
 * @param p3 Vector2 p3
 * @param p4  Vector2 p4
 * @param thick float 线宽
 * @param color Color 颜色
 * @return void
 */
void DrawSplineSegmentCatmullRom(Vector2 p1, Vector2 p2, Vector2 p3, Vector2 p4, float thick, Color color);

/**
 * @brief 绘制二次贝塞尔样条线段，需要2个点和1个控制点
 *
 * @param p1 Vector2 p1
 * @param c2 Vector2 c2
 * @param p3 Vector2 p3
 * @param thick float 线宽
 * @param color Color 颜色
 * @return void
 */
void DrawSplineSegmentBezierQuadratic(Vector2 p1, Vector2 c2, Vector2 p3, float thick, Color color);

/**
 * @brief 绘制三次贝塞尔样条线段，需要2个点和2个控制点
 *
 * @param p1 Vector2 p1
 * @param c2 Vector2 c2
 * @param c3 Vector2 c3
 * @param p4 Vector2 p4
 * @param thick float 线宽
 * @param color Color 颜色
 */
void DrawSplineSegmentBezierCubic(Vector2 p1, Vector2 c2, Vector2 c3, Vector2 p4, float thick, Color color);

// 样条线段点评估函数，给定t值范围为 [0.0f .. 1.0f]

/**
 * @brief 获取（评估）线性样条线上的点
 *
 * @param startPos Vector2 开始点
 * @param endPos Vector2 结束点
 * @param t float t值
 * @return Vector2
 */
Vector2 GetSplinePointLinear(Vector2 startPos, Vector2 endPos, float t);

/**
 * @brief 获取（评估）B样条线上的点
 *
 * @param p1 Vector2 p1
 * @param p2 Vector2 p2
 * @param p3 Vector2 p3
 * @param p4 Vector2 p4
 * @param t float t值
 * @return Vector2
 */
Vector2 GetSplinePointBasis(Vector2 p1, Vector2 p2, Vector2 p3, Vector2 p4, float t);

/**
 * @brief 获取（评估）Catmull-Rom样条线上的点
 *
 * @param p1 Vector2 p1
 * @param p2 Vector2 p2
 * @param p3 Vector2 p3
 * @param p4 Vector2 p4
 * @param t float t值
 * @return Vector2
 */
Vector2 GetSplinePointCatmullRom(Vector2 p1, Vector2 p2, Vector2 p3, Vector2 p4, float t);

/**
 * @brief 获取（评估）二次贝塞尔样条线上的点
 *
 * @param p1 Vector2 p1
 * @param c2 Vector2 c2
 * @param p3 Vector2 p3
 * @param t float t值
 * @return Vector2
 */
Vector2 GetSplinePointBezierQuad(Vector2 p1, Vector2 c2, Vector2 p3, float t);

/**
 * @brief 获取（评估）三次贝塞尔样条线上的点
 *
 * @param p1 Vector2 p1
 * @param c2 Vector2 c2
 * @param c3 Vector2 c3
 * @param p4 Vector2 p4
 * @param t float t值
 * @return Vector2
 */
Vector2 GetSplinePointBezierCubic(Vector2 p1, Vector2 c2, Vector2 c3, Vector2 p4, float t);

// ------样条线绘制函数end-------------------------------------

// ------基本形状碰撞检测函数-------------------------------------

/**
 * @brief 检查两个矩形之间是否发生碰撞
 *
 * @param rec1 Rectangle rec1
 * @param rec2 Rectangle rec2
 * @return true
 * @return false
 */
bool CheckCollisionRecs(Rectangle rec1, Rectangle rec2);

/**
 * @brief 检查两个圆之间是否发生碰撞
 *
 * @param center1 Vector2 center1
 * @param radius1 float radius1
 * @param center2 Vector2 center2
 * @param radius2 float radius2
 * @return true
 * @return false
 */
bool CheckCollisionCircles(Vector2 center1, float radius1, Vector2 center2, float radius2);

/**
 * @brief 检查圆和矩形之间是否发生碰撞
 *
 * @param center Vector2 中间
 * @param radius float 半径
 * @param rec Rectangle 矩形
 * @return true
 * @return false
 */
bool CheckCollisionCircleRec(Vector2 center, float radius, Rectangle rec);

/**
 * @brief 检查圆是否与由两点 [p1] 和 [p2] 构成的直线发生碰撞
 *
 * @param center Vector2 中心
 * @param radius float 半径
 * @param p1 Vector2 p1
 * @param p2 Vector2 p2
 * @return true
 * @return false
 */
bool CheckCollisionCircleLine(Vector2 center, float radius, Vector2 p1, Vector2 p2);

/**
 * @brief 检查点是否在矩形内部
 *
 * @param point Vector2 点
 * @param rec Rectangle 矩形
 * @return true
 * @return false
 */
bool CheckCollisionPointRec(Vector2 point, Rectangle rec);

/**
 * @brief 检查点是否在圆内部
 *
 * @param point Vector2 点
 * @param center Vector2 中心
 * @param radius float 半径
 * @return true
 * @return false
 */
bool CheckCollisionPointCircle(Vector2 point, Vector2 center, float radius);

/**
 * @brief 检查点是否在三角形内部
 *
 * @param point Vector2 点
 * @param p1 Vector2 p1
 * @param p2 Vector2 p2
 * @param p3 Vector2 p3
 * @return true
 * @return false
 */
bool CheckCollisionPointTriangle(Vector2 point, Vector2 p1, Vector2 p2, Vector2 p3);

/**
 * @brief 检查点是否在由两点 [p1] 和 [p2] 构成的直线上，允许一定的像素误差 [threshold]
 *
 * @param point Vector2 点
 * @param p1 Vector2 p1
 * @param p2 Vector2 p2
 * @param threshold int 阈值
 * @return true
 * @return false
 */
bool CheckCollisionPointLine(Vector2 point, Vector2 p1, Vector2 p2, int threshold);

/**
 * @brief 检查点是否在由顶点数组描述的多边形内部
 *
 * @param point Vector2 点
 * @param points Vector2* 点数组
 * @param pointCount int 点数量
 * @return true
 * @return false
 */
bool CheckCollisionPointPoly(Vector2 point, const Vector2 *points, int pointCount);

/**
 * @brief 检查由两个点定义的两条直线是否发生碰撞，通过引用返回碰撞点
 *
 * @param startPos1 Vector2 startPos1
 * @param endPos1 Vector2 endPos1
 * @param startPos2 Vector2 startPos2
 * @param endPos2 Vector2 endPos2
 * @param collisionPoint Vector2* 碰撞点
 * @return true
 * @return false
 */
bool CheckCollisionLines(Vector2 startPos1, Vector2 endPos1, Vector2 startPos2, Vector2 endPos2, Vector2 *collisionPoint);

/**
 * @brief 获取两个矩形碰撞后的重叠矩形
 *
 * @param rec1 Rectangle rec1
 * @param rec2 Rectangle rec2
 * @return Rectangle
 */
Rectangle GetCollisionRec(Rectangle rec1, Rectangle rec2);

// ------基本形状碰撞检测函数end-------------------------------------

// ------图像加载函数-------------------------------------
// 注意: 这些函数不需要GPU访问

/**
 * @brief 从文件加载图像到CPU内存 (RAM)
 *
 * @param fileName const char* 文件名
 * @return Image
 */
Image LoadImage(const char *fileName);

/**
 * @brief 从原始文件数据加载图像
 *
 * @param fileName const char* 文件名
 * @param width int 宽度
 * @param height int 高度
 * @param format int 格式
 * @param headerSize int 头大小
 * @return Image
 */
Image LoadImageRaw(const char *fileName, int width, int height, int format, int headerSize);

/**
 * @brief 从文件加载图像序列 (帧追加到image.data)
 *
 * @param fileName const char* 文件名
 * @param frames int* 帧
 * @return Image
 */
Image LoadImageAnim(const char *fileName, int *frames);

/**
 * @brief 从内存缓冲区加载图像序列
 *
 * @param fileType const char* 文件类型
 * @param fileData const unsigned char* 文件数据
 * @param dataSize int 数据大小
 * @param frames int* 帧
 * @return Image
 */
Image LoadImageAnimFromMemory(const char *fileType, const unsigned char *fileData, int dataSize, int *frames);

/**
 * @brief 从内存缓冲区加载图像，fileType指文件扩展名，例如: '.png'
 *
 * @param fileType const char* 文件类型
 * @param fileData const unsigned char* 文件数据
 * @param dataSize int 数据大小
 * @return Image
 */
Image LoadImageFromMemory(const char *fileType, const unsigned char *fileData, int dataSize);

/**
 * @brief 从GPU纹理数据加载图像
 *
 * @param texture Texture2D 纹理
 * @return Image
 */
Image LoadImageFromTexture(Texture2D texture);

/**
 * @brief 从屏幕缓冲区加载图像 (截图)
 *
 * @return Image
 */
Image LoadImageFromScreen(void);

/**
 * @brief 检查图像是否有效 (数据和参数)
 *
 * @param image Image 图像
 * @return true
 * @return false
 */
bool IsImageValid(Image image);

/**
 * @brief 从CPU内存 (RAM) 卸载图像
 *
 * @param image Image 图像
 */
void UnloadImage(Image image);

/**
 * @brief 将图像数据导出到文件，成功返回true
 *
 * @param image Image 图像
 * @param fileName const char* 文件名
 * @return true
 * @return false
 */
bool ExportImage(Image image, const char *fileName);

/**
 * @brief 将图像导出到内存缓冲区
 *
 * @param image Image 图像
 * @param fileType const char* 文件类型
 * @param fileSize int* 文件大小
 * @return unsigned char*
 */
unsigned char *ExportImageToMemory(Image image, const char *fileType, int *fileSize);

/**
 * @brief 将图像导出为定义字节数组的代码文件，成功返回true
 *
 * @param image Image 图像
 * @param fileName const char* 文件名
 * @return true
 * @return false
 */
bool ExportImageAsCode(Image image, const char *fileName);

// ------图像加载函数end-------------------------------------

// ------图像生成函数-------------------------------------

/**
 * @brief 生成图像: 纯色
 *
 * @param width int 宽度
 * @param height int 高度
 * @param color Color 颜色
 * @return Image
 */
Image GenImageColor(int width, int height, Color color);

/**
 * @brief 生成图像: 线性渐变，方向为度数 [0..360]，0=垂直渐变
 *
 * @param width int 宽度
 * @param height int 高度
 * @param direction int 方向
 * @param start Color 开始
 * @param end Color 结束
 * @return Image
 */
Image GenImageGradientLinear(int width, int height, int direction, Color start, Color end);

/**
 * @brief 生成图像: 径向渐变
 *
 * @param width int 宽度
 * @param height int 高度
 * @param density float 密度
 * @param inner Color 内部
 * @param outer Color 外部
 * @return Image
 */
Image GenImageGradientRadial(int width, int height, float density, Color inner, Color outer);

/**
 * @brief 生成图像: 方形渐变
 *
 * @param width int 宽度
 * @param height int 高度
 * @param density float 密度
 * @param inner Color 内部
 * @param outer Color 外部
 * @return Image
 */
Image GenImageGradientSquare(int width, int height, float density, Color inner, Color outer);

/**
 * @brief 生成图像: 棋盘格
 *
 * @param width int 宽度
 * @param height int 高度
 * @param checksX int 检查X
 * @param checksY int 检查Y
 * @param col1 Color 颜色1
 * @param col2 Color 颜色2
 * @return Image
 */
Image GenImageChecked(int width, int height, int checksX, int checksY, Color col1, Color col2);

/**
 * @brief 生成图像: 白噪声
 *
 * @param width int 宽度
 * @param height int 高度
 * @param factor float 因子
 * @return Image
 */
Image GenImageWhiteNoise(int width, int height, float factor);

/**
 * @brief 生成图像: 细胞算法，更大的tileSize意味着更大的细胞
 *
 * @param width int 宽度
 * @param height int 高度
 * @param tileSize int 瓷砖大小
 * @return Image
 */
Image GenImageCellular(int width, int height, int tileSize);

/**
 * @brief 生成图像: 从文本数据生成灰度图像
 *
 * @param width int 宽度
 * @param height int 高度
 * @param text const char* 文本
 * @return Image
 */
Image GenImageText(int width, int height, const char *text);

// ------图像生成函数end-------------------------------------

// ------图像操作函数-------------------------------------

/**
 * @brief 创建图像副本 (用于变换操作)
 *
 * @param image Image 图像
 * @return Image
 */
Image ImageCopy(Image image);

/**
 * @brief 从另一个图像的一部分创建图像
 *
 * @param image Image 图像
 * @param rec Rectangle 矩形
 * @return Image
 */
Image ImageFromImage(Image image, Rectangle rec);

/**
 * @brief 从另一个图像的选定通道创建图像 (灰度图)
 *
 * @param image Image 图像
 * @param selectedChannel int 选定通道
 * @return Image
 */
Image ImageFromChannel(Image image, int selectedChannel);

/**
 * @brief 从文本创建图像 (默认字体)
 *
 * @param text const char* 文本
 * @param fontSize int 字体大小
 * @param color Color 颜色
 * @return Image
 */
Image ImageText(const char *text, int fontSize, Color color);

/**
 * @brief 从文本创建图像 (自定义精灵字体)
 *
 * @param font Font 字体
 * @param text const char* 文本
 * @param fontSize int 字体大小
 * @param spacing float 间距
 * @param tint Color 色调
 * @return Image
 */
Image ImageTextEx(Font font, const char *text, float fontSize, float spacing, Color tint);

/**
 * @brief 将图像数据转换为所需格
 *
 * @param image Image 图像
 * @param newFormat int 新格式
 * @return void
 */
void ImageFormat(Image *image, int newFormat);

/**
 * @brief 将图像转换为2的幂次方大小 (POT)
 *
 * @param image Image 图像
 * @param fill Color 填充
 */
void ImageToPOT(Image *image, Color fill);

/**
 * @brief 将图像裁剪到定义的矩形
 *
 * @param image Image 图像
 * @param crop Rectangle 矩形
 * @return void
 */
void ImageCrop(Image *image, Rectangle crop);

/**
 * @brief 根据alpha值裁剪图像
 *
 * @param image Image 图像
 * @param threshold float 阈值
 */
void ImageAlphaCrop(Image *image, float threshold);

/**
 * @brief 将alpha通道清除为所需颜色
 *
 * @param image Image 图像
 * @param color Color 颜色
 * @param threshold float 阈值
 */
void ImageAlphaClear(Image *image, Color color, float threshold);

/**
 * @brief 对图像应用alpha遮罩
 *
 * @param image Image 图像
 * @param alphaMask Image 阿尔法面具
 * @return void
 */
void ImageAlphaMask(Image *image, Image alphaMask);

/**
 * @brief 预乘alpha通道
 *
 * @param image Image 图像
 * @return void
 */
void ImageAlphaPremultiply(Image *image);

/**
 * @brief 使用盒式模糊近似应用高斯模糊
 *
 * @param image Image 图像
 * @param blurSize int 模糊大小
 * @return void
 */
void ImageBlurGaussian(Image *image, int blurSize);

/**
 * @brief 对图像应用自定义方形卷积核
 *
 * @param image Image 图像
 * @param kernel const float* 内核
 * @param kernelSize int 内核大小
 */
void ImageKernelConvolution(Image *image, const float *kernel, int kernelSize);

/**
 * @brief 调整图像大小 (双三次缩放算法)
 *
 * @param image Image 图像
 * @param newWidth int 新宽度
 * @param newHeight int 新高度
 * @return void
 */
void ImageResize(Image *image, int newWidth, int newHeight);

/**
 * @brief 调整图像大小 (最近邻缩放算法)
 *
 * @param image Image 图像
 * @param newWidth int 新宽度
 * @param newHeight int 新高度
 * @return void
 */
void ImageResizeNN(Image *image, int newWidth, int newHeight);

/**
 * @brief 调整画布大小并用颜色填充
 *
 * @param image Image 图像
 * @param newWidth int 新宽度
 * @param newHeight int 新高度
 * @param offsetX int 偏移X
 * @param offsetY int 偏移Y
 * @param fill Color 填充
 * @return void
 */
void ImageResizeCanvas(Image *image, int newWidth, int newHeight, int offsetX, int offsetY, Color fill);

/**
 * @brief 为提供的图像计算所有mipmap级别
 *
 * @param image Image 图像
 * @return void
 */
void ImageMipmaps(Image *image);

/**
 * @brief 将图像数据抖动到16位或更低 (Floyd-Steinberg抖动)
 *
 * @param image Image 图像
 * @param rBpp int rBpp
 * @param gBpp int gBpp
 * @param bBpp int bBpp
 * @param aBpp int aBpp
 */
void ImageDither(Image *image, int rBpp, int gBpp, int bBpp, int aBpp);

/**
 * @brief 垂直翻转图像
 *
 * @param image Image 图像
 * @return void
 */
void ImageFlipVertical(Image *image);

/**
 * @brief 水平翻转图像
 *
 * @param image Image 图像
 * @return void
 */
void ImageFlipHorizontal(Image *image);

/**
 * @brief 按输入角度旋转图像 (度数 -359 到 359)
 *
 * @param image Image 图像
 * @param degrees int 度数
 * @return void
 */
void ImageRotate(Image *image, int degrees);

/**
 * @brief 顺时针旋转图像90度
 *
 * @param image Image 图像
 * @return void
 */
void ImageRotateCW(Image *image);

/**
 * @brief 逆时针旋转图像90度
 *
 * @param image Image 图像
 */
void ImageRotateCCW(Image *image);

/**
 * @brief 修改图像颜色: 着色
 *
 * @param image Image 图像
 * @param color Color 颜色
 */
void ImageColorTint(Image *image, Color color);

/**
 * @brief 修改图像颜色: 反转
 *
 * @param image Image 图像
 * @return void
 */
void ImageColorInvert(Image *image);

/**
 * @brief 修改图像颜色: 灰度化
 *
 * @param image Image 图像
 * @return void
 */
void ImageColorGrayscale(Image *image);

/**
 * @brief 修改图像颜色: 对比度 (-100 到 100)
 *
 * @param image Image 图像
 * @param contrast float 对比度
 */
void ImageColorContrast(Image *image, float contrast);

/**
 * @brief 修改图像颜色: 亮度 (-255 到 255)
 *
 * @param image Image 图像
 * @param brightness int 亮度
 */
void ImageColorBrightness(Image *image, int brightness);

/**
 * @brief 修改图像颜色: 替换颜色
 *
 * @param image Image 图像
 * @param color Color 颜色
 * @param replace Color 替换
 * @return void
 */
void ImageColorReplace(Image *image, Color color, Color replace);

/**
 * @brief 从图像加载颜色数据作为Color数组 (RGBA - 32位)
 *
 * @param image Image 图像
 * @return Color*
 */
Color *LoadImageColors(Image image);

/**
 * @brief 从图像加载颜色调色板作为Color数组 (RGBA - 32位)
 *
 * @param image Image 图像
 * @param maxPaletteSize int 最大调色板大小
 * @param colorCount int* 颜色计数
 * @return Color*
 */
Color *LoadImagePalette(Image image, int maxPaletteSize, int *colorCount);

/**
 * @brief 卸载使用LoadImageColors()加载的颜色数据
 *
 * @param colors Color* 颜色
 * @return void
 */
void UnloadImageColors(Color *colors);

/**
 * @brief 卸载使用LoadImagePalette()加载的颜色调色板
 *
 * @param colors Color* 颜色
 * @return void
 */
void UnloadImagePalette(Color *colors);

/**
 * @brief 获取图像alpha边界矩形
 *
 * @param image Image 图像
 * @param threshold float 阈值
 * @return Rectangle
 */
Rectangle GetImageAlphaBorder(Image image, float threshold);

/**
 * @brief 获取图像在 (x, y) 位置的像素颜色
 *
 * @param image Image 图像
 * @param x int x
 * @param y int y
 * @return Color
 */
Color GetImageColor(Image image, int x, int y);

// ------图像操作函数end-------------------------------------

// ------图像绘制函数-------------------------------------
// 注意: 图像软件渲染函数 (CPU)

/**
 * @brief 用给定颜色清除图像背景
 *
 * @param dst Image* 目标图像指针
 * @param color Color 要用于清除背景的颜色
 * @return void
 */
void ImageClearBackground(Image *dst, Color color);

/**
 * @brief 在图像内绘制像素
 *
 * @param dst Image* 目标图像指针
 * @param posX int 像素的X坐标
 * @param posY int 像素的Y坐标
 * @param color Color 像素的颜色
 * @return void
 */
void ImageDrawPixel(Image *dst, int posX, int posY, Color color);

/**
 * @brief 在图像内绘制像素 (向量版本)
 *
 * @param dst Image* 目标图像指针
 * @param position Vector2 像素的位置向量
 * @param color Color 像素的颜色
 * @return void
 */
void ImageDrawPixelV(Image *dst, Vector2 position, Color color);

/**
 * @brief 在图像内绘制线条
 *
 * @param dst Image* 目标图像指针
 * @param startPosX int 线条起点的X坐标
 * @param startPosY int 线条起点的Y坐标
 * @param endPosX int 线条终点的X坐标
 * @param endPosY int 线条终点的Y坐标
 * @param color Color 线条的颜色
 * @return void
 */
void ImageDrawLine(Image *dst, int startPosX, int startPosY, int endPosX, int endPosY, Color color);

/**
 * @brief 在图像内绘制线条 (向量版本)
 *
 * @param dst Image* 目标图像指针
 * @param start Vector2 线条起点位置向量
 * @param end Vector2 线条终点位置向量
 * @param color Color 线条的颜色
 * @return void
 */
void ImageDrawLineV(Image *dst, Vector2 start, Vector2 end, Color color);

/**
 * @brief 在图像内绘制定义厚度的线条
 *
 * @param dst Image* 目标图像指针
 * @param start Vector2 线条起点位置向量
 * @param end Vector2 线条终点位置向量
 * @param thick int 线条的厚度
 * @param color Color 线条的颜色
 * @return void
 */
void ImageDrawLineEx(Image *dst, Vector2 start, Vector2 end, int thick, Color color);

/**
 * @brief 在图像内绘制填充的圆形
 *
 * @param dst Image* 目标图像指针
 * @param centerX int 圆心的X坐标
 * @param centerY int 圆心的Y坐标
 * @param radius int 圆形的半径
 * @param color Color 圆形的颜色
 * @return void
 */
void ImageDrawCircle(Image *dst, int centerX, int centerY, int radius, Color color);

/**
 * @brief 在图像内绘制填充的圆形 (向量版本)
 *
 * @param dst Image* 目标图像指针
 * @param center Vector2 圆心位置向量
 * @param radius int 圆形的半径
 * @param color Color 圆形的颜色
 * @return void
 */
void ImageDrawCircleV(Image *dst, Vector2 center, int radius, Color color);

/**
 * @brief 在图像内绘制圆形轮廓
 *
 * @param dst Image* 目标图像指针
 * @param centerX int 圆心的X坐标
 * @param centerY int 圆心的Y坐标
 * @param radius int 圆形的半径
 * @param color Color 圆形轮廓的颜色
 * @return void
 */
void ImageDrawCircleLines(Image *dst, int centerX, int centerY, int radius, Color color);

/**
 * @brief 在图像内绘制圆形轮廓 (向量版本)
 *
 * @param dst Image* 目标图像指针
 * @param center Vector2 圆心位置向量
 * @param radius int 圆形的半径
 * @param color Color 圆形轮廓的颜色
 * @return void
 */
void ImageDrawCircleLinesV(Image *dst, Vector2 center, int radius, Color color);

/**
 * @brief 在图像内绘制矩形
 *
 * @param dst Image* 目标图像指针
 * @param posX int 矩形左上角的X坐标
 * @param posY int 矩形左上角的Y坐标
 * @param width int 矩形的宽度
 * @param height int 矩形的高度
 * @param color Color 矩形的颜色
 * @return void
 */
void ImageDrawRectangle(Image *dst, int posX, int posY, int width, int height, Color color);

/**
 * @brief 在图像内绘制矩形 (向量版本)
 *
 * @param dst Image* 目标图像指针
 * @param position Vector2 矩形左上角的位置向量
 * @param size Vector2 矩形的尺寸向量
 * @param color Color 矩形的颜色
 * @return void
 */
void ImageDrawRectangleV(Image *dst, Vector2 position, Vector2 size, Color color);

/**
 * @brief 在图像内绘制矩形
 *
 * @param dst Image* 目标图像指针
 * @param rec Rectangle 要绘制的矩形结构体
 * @param color Color 矩形的颜色
 * @return void
 */
void ImageDrawRectangleRec(Image *dst, Rectangle rec, Color color);

/**
 * @brief 在图像内绘制矩形线条
 *
 * @param dst Image* 目标图像指针
 * @param rec Rectangle 要绘制的矩形结构体
 * @param thick int 矩形边框的厚度
 * @param color Color 矩形边框的颜色
 * @return void
 */
void ImageDrawRectangleLines(Image *dst, Rectangle rec, int thick, Color color);

/**
 * @brief 在图像内绘制三角形
 *
 * @param dst Image* 目标图像指针
 * @param v1 Vector2 第一个顶点的位置向量
 * @param v2 Vector2 第二个顶点的位置向量
 * @param v3 Vector2 第三个顶点的位置向量
 * @param color Color 三角形的颜色
 * @return void
 */
void ImageDrawTriangle(Image *dst, Vector2 v1, Vector2 v2, Vector2 v3, Color color);

/**
 * @brief 在图像内绘制带有插值颜色的三角形
 *
 * @param dst Image* 目标图像指针
 * @param v1 Vector2 第一个顶点的位置向量
 * @param v2 Vector2 第二个顶点的位置向量
 * @param v3 Vector2 第三个顶点的位置向量
 * @param c1 Color 第一个顶点的颜色
 * @param c2 Color 第二个顶点的颜色
 * @param c3 Color 第三个顶点的颜色
 * @return void
 */
void ImageDrawTriangleEx(Image *dst, Vector2 v1, Vector2 v2, Vector2 v3, Color c1, Color c2, Color c3);

/**
 * @brief 在图像内绘制三角形轮廓
 *
 * @param dst Image* 目标图像指针
 * @param v1 Vector2 第一个顶点的位置向量
 * @param v2 Vector2 第二个顶点的位置向量
 * @param v3 Vector2 第三个顶点的位置向量
 * @param color Color 三角形轮廓的颜色
 * @return void
 */
void ImageDrawTriangleLines(Image *dst, Vector2 v1, Vector2 v2, Vector2 v3, Color color);

/**
 * @brief 在图像内绘制由点定义的三角形扇 (第一个顶点是中心)
 *
 * @param dst Image* 目标图像指针
 * @param points Vector2* 定义三角形扇的点数组
 * @param pointCount int 点的数量
 * @param color Color 三角形扇的颜色
 * @return void
 */
void ImageDrawTriangleFan(Image *dst, Vector2 *points, int pointCount, Color color);

/**
 * @brief 在图像内绘制由点定义的三角形条带
 *
 * @param dst Image* 目标图像指针
 * @param points Vector2* 定义三角形条带的点数组
 * @param pointCount int 点的数量
 * @param color Color 三角形条带的颜色
 * @return void
 */
void ImageDrawTriangleStrip(Image *dst, Vector2 *points, int pointCount, Color color);

/**
 * @brief 在目标图像内绘制源图像 (对源图像应用色调)
 *
 * @param dst Image* 目标图像指针
 * @param src Image 源图像
 * @param srcRec Rectangle 源图像区域
 * @param dstRec Rectangle 目标图像区域
 * @param tint Color 应用于源图像的色调
 * @return void
 */
void ImageDraw(Image *dst, Image src, Rectangle srcRec, Rectangle dstRec, Color tint);

/**
 * @brief 在图像 (目标) 内绘制文本 (使用默认字体)
 *
 * @param dst Image* 目标图像指针
 * @param text const char* 要绘制的文本
 * @param posX int 文本开始位置的X坐标
 * @param posY int 文本开始位置的Y坐标
 * @param fontSize int 字体大小
 * @param color Color 文本颜色
 * @return void
 */
void ImageDrawText(Image *dst, const char *text, int posX, int posY, int fontSize, Color color);

/**
 * @brief 在图像 (目标) 内绘制文本 (自定义精灵字体)
 *
 * @param dst Image* 目标图像指针
 * @param font Font 字体
 * @param text const char* 要绘制的文本
 * @param position Vector2 文本位置向量
 * @param fontSize float 字体大小
 * @param spacing float 字符间距
 * @param tint Color 色调
 * @return void
 */
void ImageDrawTextEx(Image *dst, Font font, const char *text, Vector2 position, float fontSize, float spacing, Color tint);

// ------图像绘制函数end-------------------------------------

// ------纹理加载函数-------------------------------------
// 注意: 这些函数需要访问GPU

/**
 * @brief 从文件加载纹理到GPU内存 (VRAM)
 *
 * @param fileName const char* 纹理文件的路径
 * @return Texture2D 加载的纹理对象
 */
Texture2D LoadTexture(const char *fileName);

/**
 * @brief 从图像数据加载纹理
 *
 * @param image Image 包含图像数据的Image结构体
 * @return Texture2D 加载的纹理对象
 */
Texture2D LoadTextureFromImage(Image image);

/**
 * @brief 从图像加载立方体贴图，支持多种图像立方体贴图布局
 *
 * @param image Image 包含图像数据的Image结构体
 * @param layout int 立方体贴图布局类型
 * @return TextureCubemap 加载的立方体贴图对象
 */
TextureCubemap LoadTextureCubemap(Image image, int layout);

/**
 * @brief 加载用于渲染的纹理 (帧缓冲区)
 *
 * @param width int 渲染纹理的宽度
 * @param height int 渲染纹理的高度
 * @return RenderTexture2D 加载的渲染纹理对象
 */
RenderTexture2D LoadRenderTexture(int width, int height);

/**
 * @brief 检查纹理是否有效 (已加载到GPU)
 *
 * @param texture Texture2D 要检查的纹理对象
 * @return bool 如果纹理有效则返回true，否则返回false
 */
bool IsTextureValid(Texture2D texture);

/**
 * @brief 从GPU内存 (VRAM) 卸载纹理
 *
 * @param texture Texture2D 要卸载的纹理对象
 */
void UnloadTexture(Texture2D texture);

/**
 * @brief 检查渲染纹理是否有效 (已加载到GPU)
 *
 * @param target RenderTexture2D 要检查的渲染纹理对象
 * @return bool 如果渲染纹理有效则返回true，否则返回false
 */
bool IsRenderTextureValid(RenderTexture2D target);

/**
 * @brief 从GPU内存 (VRAM) 卸载渲染纹理
 *
 * @param target RenderTexture2D 要卸载的渲染纹理对象
 */
void UnloadRenderTexture(RenderTexture2D target);

/**
 * @brief 用新数据更新GPU纹理
 *
 * @param texture Texture2D 要更新的纹理对象
 * @param pixels const void* 新像素数据指针
 */
void UpdateTexture(Texture2D texture, const void *pixels);

/**
 * @brief 用新数据更新GPU纹理的矩形区域
 *
 * @param texture Texture2D 要更新的纹理对象
 * @param rec Rectangle 更新的矩形区域
 * @param pixels const void* 新像素数据指针
 */
void UpdateTextureRec(Texture2D texture, Rectangle rec, const void *pixels);

/**
 * @brief 为纹理生成GPU多级渐远纹理
 *
 * @param texture Texture2D* 指向Texture2D结构的指针，表示要生成多级渐远纹理的纹理
 * @return void
 */
void GenTextureMipmaps(Texture2D *texture);

/**
 * @brief 设置纹理缩放过滤模式
 *
 * @param texture Texture2D 要设置过滤模式的纹理
 * @param filter int 过滤模式（例如：LINEAR, NEAREST）
 * @return void
 */
void SetTextureFilter(Texture2D texture, int filter);

/**
 * @brief 设置纹理环绕模式
 *
 * @param texture Texture2D 要设置环绕模式的纹理
 * @param wrap int 环绕模式（例如：REPEAT, CLAMP）
 * @return void
 */
void SetTextureWrap(Texture2D texture, int wrap);

/**
 * @brief 绘制一个Texture2D
 *
 * @param texture Texture2D 要绘制的纹理
 * @param posX int X轴位置
 * @param posY int Y轴位置
 * @param tint Color 应用于纹理的颜色混合
 * @return void
 */
void DrawTexture(Texture2D texture, int posX, int posY, Color tint);

/**
 * @brief 以Vector2定义的位置绘制一个Texture2D
 *
 * @param texture Texture2D 要绘制的纹理
 * @param position Vector2 位置向量
 * @param tint Color 应用于纹理的颜色混合
 * @return void
 */
void DrawTextureV(Texture2D texture, Vector2 position, Color tint);

/**
 * @brief 用扩展参数绘制一个Texture2D
 *
 * @param texture Texture2D 要绘制的纹理
 * @param position Vector2 位置向量
 * @param rotation float 旋转角度（度）
 * @param scale float 缩放比例
 * @param tint Color 应用于纹理的颜色混合
 * @return void
 */
void DrawTextureEx(Texture2D texture, Vector2 position, float rotation, float scale, Color tint);

/**
 * @brief 绘制由矩形定义的纹理的一部分
 *
 * @param texture Texture2D 要绘制的纹理
 * @param source Rectangle 来源矩形，定义了要绘制的纹理区域
 * @param position Vector2 位置向量
 * @param tint Color 应用于纹理的颜色混合
 * @return void
 */
void DrawTextureRec(Texture2D texture, Rectangle source, Vector2 position, Color tint);

/**
 * @brief 用'pro'参数绘制由矩形定义的纹理的一部分
 *
 * @param texture Texture2D 要绘制的纹理
 * @param source Rectangle 来源矩形，定义了要绘制的纹理区域
 * @param dest Rectangle 目标矩形，定义了在屏幕上显示的区域
 * @param origin Vector2 旋转中心点
 * @param rotation float 旋转角度（度）
 * @param tint Color 应用于纹理的颜色混合
 * @return void
 */
void DrawTexturePro(Texture2D texture, Rectangle source, Rectangle dest, Vector2 origin, float rotation, Color tint);

/**
 * @brief 绘制一个可以很好地拉伸或收缩的纹理（或其一部分）
 *
 * @param texture Texture2D 要绘制的纹理
 * @param nPatchInfo NPatchInfo N-Patch信息，描述如何拉伸或收缩
 * @param dest Rectangle 目标矩形，定义了在屏幕上显示的区域
 * @param origin Vector2 旋转中心点
 * @param rotation float 旋转角度（度）
 * @param tint Color 应用于纹理的颜色混合
 * @return void
 */
void DrawTextureNPatch(Texture2D texture, NPatchInfo nPatchInfo, Rectangle dest, Vector2 origin, float rotation, Color tint);

// ------纹理加载函数end-------------------------------------

// ------颜色/像素相关函数-------------------------------------

/**
 * @brief 检查两种颜色是否相等
 *
 * @param col1 Color 第一种颜色
 * @param col2 Color 第二种颜色
 * @return bool 如果两种颜色相等则返回true，否则返回false
 */
bool ColorIsEqual(Color col1, Color col2);

/**
 * @brief 获取应用了透明度的颜色，透明度取值范围为 0.0f 到 1.0f
 *
 * @param color Color 原始颜色
 * @param alpha float 透明度值
 * @return Color 应用了透明度后的颜色
 */
Color Fade(Color color, float alpha);

/**
 * @brief 获取颜色的十六进制值 (0xRRGGBBAA)
 *
 * @param color Color 颜色
 * @return int 十六进制表示的颜色值
 */
int ColorToInt(Color color);

/**
 * @brief 获取颜色归一化后的浮点值 [0..1]
 *
 * @param color Color 颜色
 * @return Vector4 归一化后的颜色分量
 */
Vector4 ColorNormalize(Color color);

/**
 * @brief 从归一化的值 [0..1] 获取颜色
 *
 * @param normalized Vector4 归一化后的颜色分量
 * @return Color 对应的颜色
 */
Color ColorFromNormalized(Vector4 normalized);

/**
 * @brief 获取颜色的 HSV 值，色调 [0..360]，饱和度/明度 [0..1]
 *
 * @param color Color 颜色
 * @return Vector3 HSV 表示的颜色值
 */
Vector3 ColorToHSV(Color color);

/**
 * @brief 从 HSV 值获取颜色，色调 [0..360]，饱和度/明度 [0..1]
 *
 * @param hue float 色调
 * @param saturation float 饱和度
 * @param value float 明度
 * @return Color 对应的颜色
 */
Color ColorFromHSV(float hue, float saturation, float value);

/**
 * @brief 获取与另一种颜色相乘后的颜色
 *
 * @param color Color 原始颜色
 * @param tint Color 相乘的颜色
 * @return Color 相乘后的颜色
 */
Color ColorTint(Color color, Color tint);

/**
 * @brief 获取经过亮度校正后的颜色，亮度因子取值范围为 -1.0f 到 1.0f
 *
 * @param color Color 原始颜色
 * @param factor float 亮度因子
 * @return Color 校正后的颜色
 */
Color ColorBrightness(Color color, float factor);

/**
 * @brief 获取经过对比度校正后的颜色，对比度值介于 -1.0f 和 1.0f 之间
 *
 * @param color Color 原始颜色
 * @param contrast float 对比度值
 * @return Color 校正后的颜色
 */
Color ColorContrast(Color color, float contrast);

/**
 * @brief 获取应用了透明度的颜色，透明度取值范围为 0.0f 到 1.0f
 *
 * @param color Color 原始颜色
 * @param alpha float 透明度值
 * @return Color 应用了透明度后的颜色
 */
Color ColorAlpha(Color color, float alpha);

/**
 * @brief 获取源颜色以指定色调与目标颜色进行 alpha 混合后的颜色
 *
 * @param dst Color 目标颜色
 * @param src Color 源颜色
 * @param tint Color 色调
 * @return Color 混合后的颜色
 */
Color ColorAlphaBlend(Color dst, Color src, Color tint);

/**
 * @brief 获取两种颜色之间的线性插值颜色，插值因子 [0.0f..1.0f]
 *
 * @param color1 Color 第一种颜色
 * @param color2 Color 第二种颜色
 * @param factor float 插值因子
 * @return Color 线性插值后的颜色
 */
Color ColorLerp(Color color1, Color color2, float factor);

/**
 * @brief 从十六进制值获取颜色结构体
 *
 * @param hexValue unsigned int 十六进制颜色值
 * @return Color 对应的颜色
 */
Color GetColor(unsigned int hexValue);

/**
 * @brief 从特定格式的源像素指针获取颜色
 *
 * @param srcPtr void* 源像素指针
 * @param format int 像素格式
 * @return Color 获取到的颜色
 */
Color GetPixelColor(void *srcPtr, int format);

/**
 * @brief 将格式化后的颜色设置到目标像素指针
 *
 * @param dstPtr void* 目标像素指针
 * @param color Color 颜色
 * @param format int 像素格式
 * @return void
 */
void SetPixelColor(void *dstPtr, Color color, int format);

/**
 * @brief 获取特定格式的像素数据大小（以字节为单位）
 *
 * @param width int 宽度
 * @param height int 高度
 * @param format int 像素格式
 * @return int 像素数据大小
 */
int GetPixelDataSize(int width, int height, int format);

// ------颜色/像素相关函数end-------------------------------------

// ------字体加载/卸载函数-------------------------------------

/**
 * @brief 获取默认字体
 *
 * @return Font 默认字体
 */
Font GetFontDefault(void);

/**
 * @brief 从文件加载字体到GPU内存 (VRAM)
 *
 * @param fileName const char* 字体文件路径
 * @return Font 加载的字体
 */
Font LoadFont(const char *fileName);

/**
 * @brief 从文件加载字体并带有扩展参数，若codepoints为NULL且codepointCount为0则加载默认字符集，字体大小以像素高度提供
 *
 * @param fileName const char* 字体文件路径
 * @param fontSize int 字体大小（像素高度）
 * @param codepoints int* 要加载的字符点数组
 * @param codepointCount int 要加载的字符点数量
 * @return Font 加载的字体
 */
Font LoadFontEx(const char *fileName, int fontSize, int *codepoints, int codepointCount);

/**
 * @brief 从图像加载字体 (XNA风格)
 *
 * @param image Image 图像
 * @param key Color 键颜色
 * @param firstChar int 第一个字符的ASCII码
 * @return Font 加载的字体
 */
Font LoadFontFromImage(Image image, Color key, int firstChar);

/**
 * @brief 从内存缓冲区加载字体，fileType指文件扩展名，例如: '.ttf'
 *
 * @param fileType const char* 文件类型（扩展名）
 * @param fileData const unsigned char* 文件数据
 * @param dataSize int 数据大小
 * @param fontSize int 字体大小（像素高度）
 * @param codepoints int* 要加载的字符点数组
 * @param codepointCount int 要加载的字符点数量
 * @return Font 加载的字体
 */
Font LoadFontFromMemory(const char *fileType, const unsigned char *fileData, int dataSize, int fontSize, int *codepoints, int codepointCount);

/**
 * @brief 检查字体是否有效 (字体数据已加载，警告: 未检查GPU纹理)
 *
 * @param font Font 要检查的字体
 * @return bool 如果字体有效返回true，否则返回false
 */
bool IsFontValid(Font font);

/**
 * @brief 加载字体数据以供后续使用
 *
 * @param fileData const unsigned char* 文件数据
 * @param dataSize int 数据大小
 * @param fontSize int 字体大小（像素高度）
 * @param codepoints int* 要加载的字符点数组
 * @param codepointCount int 要加载的字符点数量
 * @param type int 字体类型
 * @return GlyphInfo* 字体信息
 */
GlyphInfo *LoadFontData(const unsigned char *fileData, int dataSize, int fontSize, int *codepoints, int codepointCount, int type);

/**
 * @brief 使用字符信息生成图像字体图集
 *
 * @param glyphs const GlyphInfo* 字符信息数组
 * @param glyphRecs Rectangle** 输出的字符矩形区域数组
 * @param glyphCount int 字符数量
 * @param fontSize int 字体大小（像素高度）
 * @param padding int 填充
 * @param packMethod int 打包方法
 * @return Image 字体图集图像
 */
Image GenImageFontAtlas(const GlyphInfo *glyphs, Rectangle **glyphRecs, int glyphCount, int fontSize, int padding, int packMethod);

/**
 * @brief 卸载字体字符信息数据 (RAM)
 *
 * @param glyphs GlyphInfo* 字体信息数组
 * @param glyphCount int 字体信息数量
 * @return void
 */
void UnloadFontData(GlyphInfo *glyphs, int glyphCount);

/**
 * @brief 从GPU内存 (VRAM) 卸载字体
 *
 * @param font Font 要卸载的字体
 * @return void
 */
void UnloadFont(Font font);

/**
 * @brief 将字体导出为代码文件，成功返回true
 *
 * @param font Font 要导出的字体
 * @param fileName const char* 导出的文件名
 * @return bool 成功导出返回true，否则返回false
 */
bool ExportFontAsCode(Font font, const char *fileName);

// ------字体加载/卸载函数-------------------------------------

// ------文本绘制函数-------------------------------------

/**
 * @brief 绘制FPS计数器
 *
 * @param posX int 计数器的X坐标
 * @param posY int 计数器的Y坐标
 * @return void
 */
void DrawFPS(int posX, int posY);

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

/**
 * @brief 使用字体和附加参数绘制文本
 *
 * @param font Font 字体
 * @param text const char* 要绘制的文本
 * @param position Vector2 文本的位置
 * @param fontSize float 文本的字体大小
 * @param spacing float 文本的字符间距
 * @param tint Color 文本的颜色
 * @return void
 */
void DrawTextEx(Font font, const char *text, Vector2 position, float fontSize, float spacing, Color tint);

/**
 * @brief 使用字体和专业参数 (旋转) 绘制文本
 *
 * @param font Font 字体
 * @param text const char* 要绘制的文本
 * @param position Vector2 文本的位置
 * @param origin Vector2 文本的原点
 * @param rotation float 文本的旋转角度
 * @param fontSize float 文本的字体大小
 * @param spacing float 文本的字符间距
 * @param tint Color 文本的颜色
 * @return void
 */
void DrawTextPro(Font font, const char *text, Vector2 position, Vector2 origin, float rotation, float fontSize, float spacing, Color tint);

/**
 * @brief 绘制一个字符 (代码点)
 *
 * @param font Font 字体
 * @param codepoint int 字符的代码点
 * @param position Vector2 字符的位置
 * @param fontSize float 字符的字体大小
 * @param tint Color 字符的颜色
 * @return void
 */
void DrawTextCodepoint(Font font, int codepoint, Vector2 position, float fontSize, Color tint);

/**
 * @brief 绘制多个字符 (代码点)
 *
 * @param font Font 字体
 * @param codepoints const int* 字符的代码点数组
 * @param codepointCount int 字符的数量
 * @param position Vector2 字符的位置
 * @param fontSize float 字符的字体大小
 * @param spacing float 字符之间的间距
 * @param tint Color 字符的颜色
 * @return void
 */
void DrawTextCodepoints(Font font, const int *codepoints, int codepointCount, Vector2 position, float fontSize, float spacing, Color tint);

// ------文本绘制函数end-------------------------------------

// ------文本字体信息函数-------------------------------------

/**
 * @brief 设置绘制带换行符文本时的垂直行间距
 *
 * @param spacing int 行间距大小
 * @return void
 */
void SetTextLineSpacing(int spacing);

/**
 * @brief 测量默认字体下字符串的宽度
 *
 * @param text const char* 要测量的文本
 * @param fontSize int 字体大小（像素）
 * @return int 文本宽度（像素）
 */
int MeasureText(const char *text, int fontSize);

/**
 * @brief 测量指定字体下字符串的大小
 *
 * @param font Font 使用的字体
 * @param text const char* 要测量的文本
 * @param fontSize float 字体大小（像素）
 * @param spacing float 字符间距
 * @return Vector2 包含文本宽度和高度的向量
 */
Vector2 MeasureTextEx(Font font, const char *text, float fontSize, float spacing);

/**
 * @brief 获取字体中代码点 (Unicode字符) 的字形索引位置，若未找到则回退到 '?'
 *
 * @param font Font 使用的字体
 * @param codepoint int Unicode字符代码点
 * @return int 字形索引位置
 */
int GetGlyphIndex(Font font, int codepoint);

/**
 * @brief 获取字体中代码点 (Unicode字符) 的字形信息数据，若未找到则回退到 '?'
 *
 * @param font Font 使用的字体
 * @param codepoint int Unicode字符代码点
 * @return GlyphInfo 字形信息
 */
GlyphInfo GetGlyphInfo(Font font, int codepoint);

/**
 * @brief 获取字体图集中代码点 (Unicode字符) 的字形矩形，若未找到则回退到 '?'
 *
 * @param font Font 使用的字体
 * @param codepoint int Unicode字符代码点
 * @return Rectangle 字形在字体图集中的矩形区域
 */
Rectangle GetGlyphAtlasRec(Font font, int codepoint);

// ------文本字体信息函数end-------------------------------------

// ------文本代码点管理函数 (Unicode字符)-------------------------------------

/**
 * @brief 从代码点数组加载UTF-8编码的文本
 *
 * @param codepoints const int* Unicode字符代码点数组
 * @param length int 数组长度
 * @return char* 加载的UTF-8文本
 */
char *LoadUTF8(const int *codepoints, int length);

/**
 * @brief 卸载从代码点数组编码的UTF-8文本
 *
 * @param text char* 需要卸载的UTF-8文本
 * @return void
 */
void UnloadUTF8(char *text);

/**
 * @brief 从UTF-8文本字符串加载所有代码点，代码点数量通过参数返回
 *
 * @param text const char* UTF-8编码的文本
 * @param count int* 返回代码点的数量
 * @return int* 加载的代码点数组
 */
int *LoadCodepoints(const char *text, int *count);

/**
 * @brief 从内存中卸载代码点数据
 *
 * @param codepoints int* 需要卸载的代码点数组
 * @return void
 */
void UnloadCodepoints(int *codepoints);

/**
 * @brief 获取UTF-8编码字符串中的代码点总数
 *
 * @param text const char* UTF-8编码的文本
 * @return int 代码点的总数
 */
int GetCodepointCount(const char *text);

/**
 * @brief 获取UTF-8编码字符串中的下一个代码点，失败时返回 0x3f('?')
 *
 * @param text const char* UTF-8编码的文本
 * @param codepointSize int* 返回当前代码点的大小（字节数）
 * @return int 下一个代码点或0x3f在失败情况下
 */
int GetCodepoint(const char *text, int *codepointSize);

/**
 * @brief 获取UTF-8编码字符串中的下一个代码点，失败时返回 0x3f('?')
 *
 * 注：此函数与GetCodepoint功能相同。
 *
 * @param text const char* UTF-8编码的文本
 * @param codepointSize int* 返回当前代码点的大小（字节数）
 * @return int 下一个代码点或0x3f在失败情况下
 */
int GetCodepointNext(const char *text, int *codepointSize);

/**
 * @brief 获取UTF-8编码字符串中的上一个代码点，失败时返回 0x3f('?')
 *
 * @param text const char* UTF-8编码的文本
 * @param codepointSize int* 返回当前代码点的大小（字节数）
 * @return int 上一个代码点或0x3f在失败情况下
 */
int GetCodepointPrevious(const char *text, int *codepointSize);

/**
 * @brief 将一个代码点编码为UTF-8字节数组 (数组长度作为参数返回)
 *
 * @param codepoint int 要编码的Unicode代码点
 * @param utf8Size int* 返回生成的UTF-8字节数组的长度
 * @return const char* 编码后的UTF-8字节数组
 */
const char *CodepointToUTF8(int codepoint, int *utf8Size);

// ------文本代码点管理函数 (Unicode字符)end-------------------------------------

// ------文本字符串管理函数 (非UTF-8字符串，仅字节字符)-------------------------------------
// 注意: 某些字符串会在内部为返回的字符串分配内存，请小心使用!

/**
 * @brief 将一个字符串复制到另一个字符串，返回复制的字节数
 *
 * @param dst char* 目标字符串缓冲区
 * @param src const char* 源字符串
 * @return int 复制的字节数
 */
int TextCopy(char *dst, const char *src);

/**
 * @brief 检查两个文本字符串是否相等
 *
 * @param text1 const char* 第一个文本字符串
 * @param text2 const char* 第二个文本字符串
 * @return bool 如果两个字符串内容相同则返回true，否则返回false
 */
bool TextIsEqual(const char *text1, const char *text2);

/**
 * @brief 获取文本长度，检查 '\0' 结尾
 *
 * @param text const char* 要测量长度的文本
 * @return unsigned int 文本的长度（不包括终止空字符）
 */
unsigned int TextLength(const char *text);

/**
 * @brief 用变量进行文本格式化 (sprintf() 风格)
 *
 * @param text const char* 格式化的模板字符串
 * @param ... 可变参数列表
 * @return const char* 格式化后的文本字符串
 */
const char *TextFormat(const char *text, ...);

/**
 * @brief 获取文本字符串的一部分
 *
 * @param text const char* 原始文本
 * @param position int 开始位置
 * @param length int 子串长度
 * @return const char* 子串
 */
const char *TextSubtext(const char *text, int position, int length);

/**
 * @brief 替换文本字符串 (警告: 必须释放内存!)
 *
 * @param text const char* 原始文本
 * @param replace const char* 要替换的子串
 * @param by const char* 替换为的子串
 * @return char* 替换后的新文本字符串
 */
char *TextReplace(const char *text, const char *replace, const char *by);

/**
 * @brief 在指定位置插入文本 (警告: 必须释放内存!)
 *
 * @param text const char* 原始文本
 * @param insert const char* 要插入的文本
 * @param position int 插入的位置
 * @return char* 插入文本后的新字符串
 */
char *TextInsert(const char *text, const char *insert, int position);

/**
 * @brief 用分隔符连接文本字符串
 *
 * @param textList const char** 文本字符串数组
 * @param count int 数组中的元素数量
 * @param delimiter const char* 分隔符
 * @return const char* 连接后的文本字符串
 */
const char *TextJoin(const char **textList, int count, const char *delimiter);

/**
 * @brief 将文本拆分为多个字符串
 *
 * @param text const char* 要拆分的文本
 * @param delimiter char 用于拆分文本的分隔符
 * @param count int* 返回分割后的字符串数量
 * @return const char** 拆分后的字符串数组
 */
const char **TextSplit(const char *text, char delimiter, int *count);

/**
 * @brief 在特定位置追加文本并移动光标!
 *
 * @param text char* 目标文本字符串
 * @param append const char* 要追加的文本
 * @param position int* 光标位置指针
 * @return void
 */
void TextAppend(char *text, const char *append, int *position);

/**
 * @brief 在字符串中查找第一个文本出现的位置
 *
 * @param text const char* 源字符串
 * @param find const char* 要查找的子串
 * @return int 找到的第一个匹配项的位置，如果未找到则返回-1
 */
int TextFindIndex(const char *text, const char *find);

/**
 * @brief 获取提供字符串的大写版本
 *
 * @param text const char* 要转换为大写的源字符串
 * @return const char* 大写版本的字符串
 */
const char *TextToUpper(const char *text);

/**
 * @brief 获取提供字符串的小写版本
 *
 * @param text const char* 要转换为小写的源字符串
 * @return const char* 小写版本的字符串
 */
const char *TextToLower(const char *text);

/**
 * @brief 获取提供字符串的帕斯卡命名法版本
 *
 * @param text const char* 要转换的源字符串
 * @return const char* 帕斯卡命名法版本的字符串
 */
const char *TextToPascal(const char *text);

/**
 * @brief 获取提供字符串的蛇形命名法版本
 *
 * @param text const char* 要转换的源字符串
 * @return const char* 蛇形命名法版本的字符串
 */
const char *TextToSnake(const char *text);

/**
 * @brief 获取提供字符串的驼峰命名法版本
 *
 * @param text const char* 要转换的源字符串
 * @return const char* 驼峰命名法版本的字符串
 */
const char *TextToCamel(const char *text);

/**
 * @brief 从文本中获取整数值 (不支持负值)
 *
 * @param text const char* 包含数字的文本
 * @return int 提取的整数值
 */
int TextToInteger(const char *text);

/**
 * @brief 从文本中获取浮点数值 (不支持负值)
 *
 * @param text const char* 包含数字的文本
 * @return float 提取的浮点数值
 */
float TextToFloat(const char *text);

// ------文本字符串管理函数 (非UTF-8字符串，仅字节字符)end-------------------------------------

// ------3D模型加载和绘制函数-------------------------------------

/**
 * @brief 从文件加载模型（网格和材质）
 *
 * @param fileName const char* 模型文件的路径
 * @return Model 加载的模型对象
 */
Model LoadModel(const char *fileName);

/**
 * @brief 从生成的网格加载模型（默认材质）
 *
 * @param mesh Mesh 要加载的网格数据
 * @return Model 加载的模型对象
 */
Model LoadModelFromMesh(Mesh mesh);

/**
 * @brief 检查模型是否有效（已加载到GPU，VAO/VBO）
 *
 * @param model Model 要检查的模型对象
 * @return bool 如果模型有效返回true，否则返回false
 */
bool IsModelValid(Model model);

/**
 * @brief 从内存（RAM和/或VRAM）卸载模型（包括网格）
 *
 * @param model Model 要卸载的模型对象
 * @return void
 */
void UnloadModel(Model model);

/**
 * @brief 计算模型的边界框限制（考虑所有网格）
 *
 * @param model Model 要计算边界的模型对象
 * @return BoundingBox 模型的边界框
 */
BoundingBox GetModelBoundingBox(Model model);

/**
 * @brief 绘制一个模型（如果设置了纹理）
 *
 * @param model Model 要绘制的模型对象
 * @param position Vector3 模型的位置
 * @param scale float 缩放比例
 * @param tint Color 颜色叠加
 * @return void
 */
void DrawModel(Model model, Vector3 position, float scale, Color tint);

/**
 * @brief 用扩展参数绘制一个模型
 *
 * @param model Model 要绘制的模型对象
 * @param position Vector3 模型的位置
 * @param rotationAxis Vector3 旋转轴
 * @param rotationAngle float 旋转角度
 * @param scale Vector3 缩放向量
 * @param tint Color 颜色叠加
 * @return void
 */
void DrawModelEx(Model model, Vector3 position, Vector3 rotationAxis, float rotationAngle, Vector3 scale, Color tint);

/**
 * @brief 绘制模型的线框（如果设置了纹理）
 *
 * @param model Model 要绘制的模型对象
 * @param position Vector3 模型的位置
 * @param scale float 缩放比例
 * @param tint Color 颜色叠加
 * @return void
 */
void DrawModelWires(Model model, Vector3 position, float scale, Color tint);

/**
 * @brief 用扩展参数绘制模型的线框（如果设置了纹理）
 *
 * @param model Model 要绘制的模型对象
 * @param position Vector3 模型的位置
 * @param rotationAxis Vector3 旋转轴
 * @param rotationAngle float 旋转角度
 * @param scale Vector3 缩放向量
 * @param tint Color 颜色叠加
 * @return void
 */
void DrawModelWiresEx(Model model, Vector3 position, Vector3 rotationAxis, float rotationAngle, Vector3 scale, Color tint);

/**
 * @brief 将模型绘制为点
 *
 * @param model Model 要绘制的模型对象
 * @param position Vector3 模型的位置
 * @param scale float 缩放比例
 * @param tint Color 颜色叠加
 * @return void
 */
void DrawModelPoints(Model model, Vector3 position, float scale, Color tint);

/**
 * @brief 用扩展参数将模型绘制为点
 *
 * @param model Model 要绘制的模型对象
 * @param position Vector3 模型的位置
 * @param rotationAxis Vector3 旋转轴
 * @param rotationAngle float 旋转角度
 * @param scale Vector3 缩放向量
 * @param tint Color 颜色叠加
 * @return void
 */
void DrawModelPointsEx(Model model, Vector3 position, Vector3 rotationAxis, float rotationAngle, Vector3 scale, Color tint);

/**
 * @brief 绘制边界框（线框）
 *
 * @param box BoundingBox 要绘制的边界框
 * @param color Color 边界框的颜色
 * @return void
 */
void DrawBoundingBox(BoundingBox box, Color color);

/**
 * @brief 绘制一个广告牌纹理
 *
 * @param camera Camera 相机对象
 * @param texture Texture2D 要绘制的纹理
 * @param position Vector3 广告牌的位置
 * @param scale float 缩放比例
 * @param tint Color 颜色叠加
 * @return void
 */
void DrawBillboard(Camera camera, Texture2D texture, Vector3 position, float scale, Color tint);

/**
 * @brief 绘制由源矩形定义的广告牌纹理
 *
 * @param camera Camera 相机对象
 * @param texture Texture2D 要绘制的纹理
 * @param source Rectangle 源矩形
 * @param position Vector3 广告牌的位置
 * @param size Vector2 广告牌大小
 * @param tint Color 颜色叠加
 * @return void
 */
void DrawBillboardRec(Camera camera, Texture2D texture, Rectangle source, Vector3 position, Vector2 size, Color tint);

/**
 * @brief 绘制由源矩形和旋转定义的广告牌纹理
 *
 * @param camera Camera 相机对象
 * @param texture Texture2D 要绘制的纹理
 * @param source Rectangle 源矩形
 * @param position Vector3 广告牌的位置
 * @param up Vector3 上方向向量
 * @param size Vector2 广告牌大小
 * @param origin Vector2 广告牌原点
 * @param rotation float 旋转角度
 * @param tint Color 颜色叠加
 * @return void
 */
void DrawBillboardPro(Camera camera, Texture2D texture, Rectangle source, Vector3 position, Vector3 up, Vector2 size, Vector2 origin, float rotation, Color tint);

/**
 * @brief 将网格顶点数据上传到GPU并提供VAO/VBO ID
 *
 * @param mesh Mesh* 网格指针
 * @param dynamic bool 是否动态使用
 * @return void
 */
void UploadMesh(Mesh *mesh, bool dynamic);

/**
 * @brief 更新GPU中特定缓冲区索引的网格顶点数据
 *
 * @param mesh Mesh 网格对象
 * @param index int 缓冲区索引
 * @param data const void* 数据指针
 * @param dataSize int 数据大小
 * @param offset int 偏移量
 * @return void
 */
void UpdateMeshBuffer(Mesh mesh, int index, const void *data, int dataSize, int offset);

/**
 * @brief 从CPU和GPU卸载网格数据
 *
 * @param mesh Mesh 要卸载的网格对象
 * @return void
 */
void UnloadMesh(Mesh mesh);

/**
 * @brief 用材质和变换绘制一个3D网格
 *
 * @param mesh Mesh 网格对象
 * @param material Material 材质对象
 * @param transform Matrix 变换矩阵
 * @return void
 */
void DrawMesh(Mesh mesh, Material material, Matrix transform);

/**
 * @brief 用材质和不同的变换绘制多个网格实例
 *
 * @param mesh Mesh 网格对象
 * @param material Material 材质对象
 * @param transforms const Matrix* 变换矩阵数组
 * @param instances int 实例数量
 * @return void
 */
void DrawMeshInstanced(Mesh mesh, Material material, const Matrix *transforms, int instances);

/**
 * @brief 计算网格的边界框限制
 *
 * @param mesh Mesh 网格对象
 * @return BoundingBox 网格的边界框
 */
BoundingBox GetMeshBoundingBox(Mesh mesh);

/**
 * @brief 计算网格的切线
 *
 * @param mesh Mesh* 网格指针
 * @return void
 */
void GenMeshTangents(Mesh *mesh);

/**
 * @brief 将网格数据导出到文件，成功返回true
 *
 * @param mesh Mesh 网格对象
 * @param fileName const char* 文件名
 * @return bool 成功则返回true
 */
bool ExportMesh(Mesh mesh, const char *fileName);

/**
 * @brief 将网格导出为定义多个顶点属性数组的代码文件（.h）
 *
 * @param mesh Mesh 网格对象
 * @param fileName const char* 文件名
 * @return bool 成功则返回true
 */
bool ExportMeshAsCode(Mesh mesh, const char *fileName);

/**
 * @brief 生成多边形网格
 *
 * @param sides int 边的数量
 * @param radius float 半径大小
 * @return Mesh 生成的网格对象
 */
Mesh GenMeshPoly(int sides, float radius);

/**
 * @brief 生成平面网格（带有细分）
 *
 * @param width float 平面宽度
 * @param length float 平面长度
 * @param resX int X轴上的细分数量
 * @param resZ int Z轴上的细分数量
 * @return Mesh 生成的网格对象
 */
Mesh GenMeshPlane(float width, float length, int resX, int resZ);

/**
 * @brief 生成长方体网格
 *
 * @param width float 长方体宽度
 * @param height float 长方体高度
 * @param length float 长方体长度
 * @return Mesh 生成的网格对象
 */
Mesh GenMeshCube(float width, float height, float length);

/**
 * @brief 生成球体网格（标准球体）
 *
 * @param radius float 球体半径
 * @param rings int 环的数量
 * @param slices int 片段的数量
 * @return Mesh 生成的网格对象
 */
Mesh GenMeshSphere(float radius, int rings, int slices);

/**
 * @brief 生成半球体网格（无底部盖子）
 *
 * @param radius float 半球体半径
 * @param rings int 环的数量
 * @param slices int 片段的数量
 * @return Mesh 生成的网格对象
 */
Mesh GenMeshHemiSphere(float radius, int rings, int slices);

/**
 * @brief 生成圆柱体网格
 *
 * @param radius float 圆柱体半径
 * @param height float 圆柱体高度
 * @param slices int 片段的数量
 * @return Mesh 生成的网格对象
 */
Mesh GenMeshCylinder(float radius, float height, int slices);

/**
 * @brief 生成圆锥/棱锥网格
 *
 * @param radius float 底部半径
 * @param height float 高度
 * @param slices int 片段的数量
 * @return Mesh 生成的网格对象
 */
Mesh GenMeshCone(float radius, float height, int slices);

/**
 * @brief 生成圆环体网格
 *
 * @param radius float 主半径
 * @param size float 次级半径
 * @param radSeg int 主半径分割数
 * @param sides int 侧面数量
 * @return Mesh 生成的网格对象
 */
Mesh GenMeshTorus(float radius, float size, int radSeg, int sides);

/**
 * @brief 生成三叶结网格
 *
 * @param radius float 主半径
 * @param size float 次级半径
 * @param radSeg int 主半径分割数
 * @param sides int 侧面数量
 * @return Mesh 生成的网格对象
 */
Mesh GenMeshKnot(float radius, float size, int radSeg, int sides);

/**
 * @brief 根据图像数据生成高度图网格
 *
 * @param heightmap Image 高度图图像数据
 * @param size Vector3 网格大小
 * @return Mesh 生成的网格对象
 */
Mesh GenMeshHeightmap(Image heightmap, Vector3 size);

/**
 * @brief 根据图像数据生成基于立方体的地图网格
 *
 * @param cubicmap Image 立方体地图图像数据
 * @param cubeSize Vector3 立方体尺寸
 * @return Mesh 生成的网格对象
 */
Mesh GenMeshCubicmap(Image cubicmap, Vector3 cubeSize);

/**
 * @brief 从模型文件加载材质
 *
 * @param fileName const char* 文件名
 * @param materialCount int* 材质计数指针
 * @return Material* 加载的材质数组
 */
Material *LoadMaterials(const char *fileName, int *materialCount);

/**
 * @brief 加载默认材质（支持：漫反射、镜面反射、法线贴图）
 *
 * @return Material 默认材质对象
 */
Material LoadMaterialDefault(void);

/**
 * @brief 检查材质是否有效（已分配着色器，贴图纹理已加载到GPU）
 *
 * @param material Material 要检查的材质对象
 * @return bool 如果材质有效返回true，否则返回false
 */
bool IsMaterialValid(Material material);

/**
 * @brief 从GPU内存（VRAM）卸载材质
 *
 * @param material Material 要卸载的材质对象
 * @return void
 */
void UnloadMaterial(Material material);

/**
 * @brief 为材质贴图类型设置纹理（MATERIAL_MAP_DIFFUSE, MATERIAL_MAP_SPECULAR...）
 *
 * @param material Material* 材质指针
 * @param mapType int 贴图类型
 * @param texture Texture2D 纹理对象
 * @return void
 */
void SetMaterialTexture(Material *material, int mapType, Texture2D texture);

/**
 * @brief 为网格设置材质
 *
 * @param model Model* 模型指针
 * @param meshId int 网格ID
 * @param materialId int 材质ID
 * @return void
 */
void SetModelMeshMaterial(Model *model, int meshId, int materialId);

/**
 * @brief 从文件加载模型动画
 *
 * @param fileName const char* 文件名
 * @param animCount int* 动画计数指针
 * @return ModelAnimation* 加载的动画数组
 */
ModelAnimation *LoadModelAnimations(const char *fileName, int *animCount);

/**
 * @brief 更新模型动画姿势（CPU）
 *
 * @param model Model 模型对象
 * @param anim ModelAnimation 动画对象
 * @param frame int 帧编号
 * @return void
 */
void UpdateModelAnimation(Model model, ModelAnimation anim, int frame);

/**
 * @brief 更新模型动画网格骨骼矩阵（GPU蒙皮）
 *
 * @param model Model 模型对象
 * @param anim ModelAnimation 动画对象
 * @param frame int 帧编号
 * @return void
 */
void UpdateModelAnimationBones(Model model, ModelAnimation anim, int frame);

/**
 * @brief 卸载动画数据
 *
 * @param anim ModelAnimation 动画对象
 * @return void
 */
void UnloadModelAnimation(ModelAnimation anim);

/**
 * @brief 卸载动画数组数据
 *
 * @param animations ModelAnimation* 动画数组指针
 * @param animCount int 动画数量
 * @return void
 */
void UnloadModelAnimations(ModelAnimation *animations, int animCount);

/**
 * @brief 检查模型动画骨骼是否匹配
 *
 * @param model Model 模型对象
 * @param anim ModelAnimation 动画对象
 * @return bool 如果匹配返回true，否则返回false
 */
bool IsModelAnimationValid(Model model, ModelAnimation anim);

/**
 * @brief 检查两个球体之间的碰撞
 *
 * @param center1 Vector3 第一个球体中心位置
 * @param radius1 float 第一个球体半径
 * @param center2 Vector3 第二个球体中心位置
 * @param radius2 float 第二个球体半径
 * @return bool 如果发生碰撞返回true，否则返回false
 */
bool CheckCollisionSpheres(Vector3 center1, float radius1, Vector3 center2, float radius2);

/**
 * @brief 检查两个边界框之间的碰撞
 *
 * @param box1 BoundingBox 第一个边界框
 * @param box2 BoundingBox 第二个边界框
 * @return bool 如果发生碰撞返回true，否则返回false
 */
bool CheckCollisionBoxes(BoundingBox box1, BoundingBox box2);

/**
 * @brief 检查边界框和球体之间的碰撞
 *
 * @param box BoundingBox 边界框
 * @param center Vector3 球体中心位置
 * @param radius float 球体半径
 * @return bool 如果发生碰撞返回true，否则返回false
 */
bool CheckCollisionBoxSphere(BoundingBox box, Vector3 center, float radius);

/**
 * @brief 获取射线和球体之间的碰撞信息
 *
 * @param ray Ray 射线对象
 * @param center Vector3 球体中心位置
 * @param radius float 球体半径
 * @return RayCollision 射线与球体的碰撞信息
 */
RayCollision GetRayCollisionSphere(Ray ray, Vector3 center, float radius);

/**
 * @brief 获取射线和边界框之间的碰撞信息
 *
 * @param ray Ray 射线对象
 * @param box BoundingBox 边界框
 * @return RayCollision 射线与边界框的碰撞信息
 */
RayCollision GetRayCollisionBox(Ray ray, BoundingBox box);

/**
 * @brief 获取射线和网格之间的碰撞信息
 *
 * @param ray Ray 射线对象
 * @param mesh Mesh 网格对象
 * @param transform Matrix 变换矩阵
 * @return RayCollision 射线与网格的碰撞信息
 */
RayCollision GetRayCollisionMesh(Ray ray, Mesh mesh, Matrix transform);

/**
 * @brief 获取射线和三角形之间的碰撞信息
 *
 * @param ray Ray 射线对象
 * @param p1 Vector3 三角形的第一个顶点
 * @param p2 Vector3 三角形的第二个顶点
 * @param p3 Vector3 三角形的第三个顶点
 * @return RayCollision 射线与三角形的碰撞信息
 */
RayCollision GetRayCollisionTriangle(Ray ray, Vector3 p1, Vector3 p2, Vector3 p3);

/**
 * @brief 获取射线和四边形之间的碰撞信息
 *
 * @param ray Ray 射线对象
 * @param p1 Vector3 四边形的第一个顶点
 * @param p2 Vector3 四边形的第二个顶点
 * @param p3 Vector3 四边形的第三个顶点
 * @param p4 Vector3 四边形的第四个顶点
 * @return RayCollision 射线与四边形的碰撞信息
 */
RayCollision GetRayCollisionQuad(Ray ray, Vector3 p1, Vector3 p2, Vector3 p3, Vector3 p4);

// ------3D模型加载和绘制函数end-------------------------------------

// ------音频加载和播放函数 (模块: 音频)-------------------------------------
// 音频回调函数指针类型定义，用于处理音频数据
typedef void (*AudioCallback)(void *bufferData, unsigned int frames);

// 音频设备管理函数
/**
 * @brief 初始化音频设备和上下文
 *
 * @return void
 */
void InitAudioDevice(void);

/**
 * @brief 关闭音频设备和上下文
 *
 * @return void
 */
void CloseAudioDevice(void);

/**
 * @brief 检查音频设备是否已成功初始化
 *
 * @return bool 如果音频设备已经准备好返回true，否则返回false
 */
bool IsAudioDeviceReady(void);

/**
 * @brief 设置主音量 (监听器)
 *
 * @param volume float 音量值（0.0f到1.0f之间）
 * @return void
 */
void SetMasterVolume(float volume);

/**
 * @brief 获取主音量 (监听器)
 *
 * @return float 当前的主音量值
 */
float GetMasterVolume(void);

// 波形/声音加载/卸载函数
/**
 * @brief 从文件加载波形数据
 *
 * @param fileName const char* 波形文件的路径
 * @return Wave 返回加载的波形数据结构
 */
Wave LoadWave(const char *fileName);

/**
 * @brief 从内存缓冲区加载波形，fileType 指文件扩展名，例如: '.wav'
 *
 * @param fileType const char* 文件类型（扩展名）
 * @param fileData const unsigned char* 包含波形数据的内存缓冲区
 * @param dataSize int 缓冲区大小（字节数）
 * @return Wave 返回加载的波形数据结构
 */
Wave LoadWaveFromMemory(const char *fileType, const unsigned char *fileData, int dataSize);

/**
 * @brief 检查波形数据是否有效 (数据已加载且参数正确)
 *
 * @param wave Wave 波形数据结构
 * @return bool 如果波形数据有效返回 true，否则返回 false
 */
bool IsWaveValid(Wave wave);

/**
 * @brief 从文件加载声音
 *
 * @param fileName const char* 声音文件的路径
 * @return Sound 返回加载的声音数据结构
 */
Sound LoadSound(const char *fileName);

/**
 * @brief 从波形数据加载声音
 *
 * @param wave Wave 波形数据结构
 * @return Sound 返回加载的声音数据结构
 */
Sound LoadSoundFromWave(Wave wave);

/**
 * @brief 创建一个新的声音，与源声音共享相同的采样数据，不拥有声音数据
 *
 * @param source Sound 源声音数据结构
 * @return Sound 返回新的声音别名数据结构
 */
Sound LoadSoundAlias(Sound source);

/**
 * @brief 检查声音是否有效 (数据已加载且缓冲区已初始化)
 *
 * @param sound Sound 声音数据结构
 * @return bool 如果声音有效返回 true，否则返回 false
 */
bool IsSoundValid(Sound sound);

/**
 * @brief 用新数据更新声音缓冲区
 *
 * @param sound Sound 声音数据结构
 * @param data const void* 新的数据缓冲区
 * @param sampleCount int 样本数量
 */
void UpdateSound(Sound sound, const void *data, int sampleCount);

/**
 * @brief 卸载波形数据
 *
 * @param wave Wave 波形数据结构
 */
void UnloadWave(Wave wave);

/**
 * @brief 卸载声音
 *
 * @param sound Sound 声音数据结构
 */
void UnloadSound(Sound sound);

/**
 * @brief 卸载声音别名 (不释放采样数据)
 *
 * @param alias Sound 声音别名数据结构
 */
void UnloadSoundAlias(Sound alias);

/**
 * @brief 将波形数据导出到文件，成功返回 true
 *
 * @param wave Wave 波形数据结构
 * @param fileName const char* 导出文件的路径
 * @return bool 成功导出返回 true，否则返回 false
 */
bool ExportWave(Wave wave, const char *fileName);

/**
 * @brief 将波形数据导出为代码形式
 *
 * 注意：此处缺少函数 ExportWaveAsCode 的返回值说明。假设其返回值类型为 bool 并在成功时返回 true。
 *
 * @param wave Wave 波形数据结构
 * @param fileName const char* 导出文件的路径
 */
bool ExportWaveAsCode(Wave wave, const char *fileName);

// 波形/声音管理函数
/**
 * @brief 播放声音
 *
 * @param sound Sound 声音数据结构
 */
void PlaySound(Sound sound);

/**
 * @brief 停止播放声音
 *
 * @param sound Sound 声音数据结构
 */
void StopSound(Sound sound);

/**
 * @brief 暂停声音
 *
 * @param sound Sound 声音数据结构
 */
void PauseSound(Sound sound);

/**
 * @brief 恢复暂停的声音
 *
 * @param sound Sound 声音数据结构
 */
void ResumeSound(Sound sound);

/**
 * @brief 检查声音是否正在播放
 *
 * @param sound Sound 声音数据结构
 * @return bool 如果声音正在播放返回 true，否则返回 false
 */
bool IsSoundPlaying(Sound sound);

/**
 * @brief 设置声音的音量 (1.0 为最大级别)
 *
 * @param sound Sound 声音数据结构
 * @param volume float 音量级别（0.0 到 1.0）
 */
void SetSoundVolume(Sound sound, float volume);

/**
 * @brief 设置声音的音调 (1.0 为基础级别)
 *
 * @param sound Sound 声音数据结构
 * @param pitch float 音调级别
 */
void SetSoundPitch(Sound sound, float pitch);

/**
 * @brief 设置声音的声像 (0.5 为中心)
 *
 * @param sound Sound 声音数据结构
 * @param pan float 声像位置（0.0 到 1.0）
 */
void SetSoundPan(Sound sound, float pan);

/**
 * @brief 将波形复制到一个新的波形
 *
 * @param wave Wave 波形数据结构
 * @return Wave 返回新的波形副本
 */
Wave WaveCopy(Wave wave);

/**
 * @brief 将波形裁剪到定义的帧范围
 *
 * @param wave Wave* 波形数据结构指针
 * @param initFrame int 起始帧
 * @param finalFrame int 结束帧
 */
void WaveCrop(Wave *wave, int initFrame, int finalFrame);

/**
 * @brief 将波形数据转换为所需格式
 *
 * @param wave Wave* 波形数据结构指针
 * @param sampleRate int 采样率
 * @param sampleSize int 采样位数
 * @param channels int 声道数量
 */
void WaveFormat(Wave *wave, int sampleRate, int sampleSize, int channels);

/**
 * @brief 从波形加载采样数据作为 32 位浮点数据数组
 *
 * @param wave Wave 波形数据结构
 * @return float* 返回指向 32 位浮点数据数组的指针
 */
float *LoadWaveSamples(Wave wave);

/**
 * @brief 卸载使用 LoadWaveSamples() 加载的采样数据
 *
 * @param samples float* 采样数据数组
 */
void UnloadWaveSamples(float *samples);

// 音乐管理函数
/**
 * @brief 从文件加载音乐流
 *
 * @param fileName const char* 文件名路径
 * @return Music 返回加载的音乐流数据结构
 */
Music LoadMusicStream(const char *fileName);

/**
 * @brief 从数据加载音乐流
 *
 * @param fileType const char* 文件类型标识
 * @param data const unsigned char* 包含音乐数据的字节数组
 * @param dataSize int 数据大小（以字节为单位）
 * @return Music 返回加载的音乐流数据结构
 */
Music LoadMusicStreamFromMemory(const char *fileType, const unsigned char *data, int dataSize);

/**
 * @brief 检查音乐流是否有效 (上下文和缓冲区已初始化)
 *
 * @param music Music 音乐流数据结构
 * @return bool 如果音乐流有效返回 true，否则返回 false
 */
bool IsMusicValid(Music music);

/**
 * @brief 卸载音乐流
 *
 * @param music Music 音乐流数据结构
 */
void UnloadMusicStream(Music music);

/**
 * @brief 开始播放音乐
 *
 * @param music Music 音乐流数据结构
 */
void PlayMusicStream(Music music);

/**
 * @brief 检查音乐是否正在播放
 *
 * @param music Music 音乐流数据结构
 * @return bool 如果音乐正在播放返回 true，否则返回 false
 */
bool IsMusicStreamPlaying(Music music);

/**
 * @brief 更新音乐流的缓冲区
 *
 * @param music Music 音乐流数据结构
 */
void UpdateMusicStream(Music music);

/**
 * @brief 停止播放音乐
 *
 * @param music Music 音乐流数据结构
 */
void StopMusicStream(Music music);

/**
 * @brief 暂停播放音乐
 *
 * @param music Music 音乐流数据结构
 */
void PauseMusicStream(Music music);

/**
 * @brief 恢复暂停的音乐播放
 *
 * @param music Music 音乐流数据结构
 */
void ResumeMusicStream(Music music);

/**
 * @brief 将音乐定位到指定位置 (以秒为单位)
 *
 * @param music Music 音乐流数据结构
 * @param position float 定位时间点（秒）
 */
void SeekMusicStream(Music music, float position);

/**
 * @brief 设置音乐的音量 (1.0 为最大级别)
 *
 * @param music Music 音乐流数据结构
 * @param volume float 音量级别（0.0 到 1.0）
 */
void SetMusicVolume(Music music, float volume);

/**
 * @brief 设置音乐的音调 (1.0 为基础级别)
 *
 * @param music Music 音乐流数据结构
 * @param pitch float 音调级别
 */
void SetMusicPitch(Music music, float pitch);

/**
 * @brief 设置音乐的声像 (0.5 为中心)
 *
 * @param music Music 音乐流数据结构
 * @param pan float 声像位置（0.0 到 1.0）
 */
void SetMusicPan(Music music, float pan);

/**
 * @brief 获取音乐的总时长 (以秒为单位)
 *
 * @param music Music 音乐流数据结构
 * @return float 音乐总时长（秒）
 */
float GetMusicTimeLength(Music music);

/**
 * @brief 获取音乐已经播放的时间 (以秒为单位)
 *
 * @param music Music 音乐流数据结构
 * @return float 已播放时间（秒）
 */
float GetMusicTimePlayed(Music music);

// 音频流管理函数
/**
 * @brief 加载音频流 (用于流式传输原始音频 PCM 数据)
 *
 * @param sampleRate unsigned int 采样率（每秒样本数）
 * @param sampleSize unsigned int 每个样本的位数（8 或 16）
 * @param channels unsigned int 声道数（1 = 单声道, 2 = 立体声）
 * @return AudioStream 返回加载的音频流数据结构
 */
AudioStream LoadAudioStream(unsigned int sampleRate, unsigned int sampleSize, unsigned int channels);

/**
 * @brief 检查音频流是否有效 (缓冲区已初始化)
 *
 * @param stream AudioStream 音频流数据结构
 * @return bool 如果音频流有效返回 true，否则返回 false
 */
bool IsAudioStreamValid(AudioStream stream);

/**
 * @brief 卸载音频流并释放内存
 *
 * @param stream AudioStream 音频流数据结构
 */
void UnloadAudioStream(AudioStream stream);

/**
 * @brief 用数据更新音频流缓冲区
 *
 * @param stream AudioStream 音频流数据结构
 * @param data const void* 包含PCM数据的字节数组
 * @param frameCount int 要处理的数据帧数
 */
void UpdateAudioStream(AudioStream stream, const void *data, int frameCount);

/**
 * @brief 检查是否有音频流缓冲区需要重新填充
 *
 * @param stream AudioStream 音频流数据结构
 * @return bool 如果有缓冲区需要重新填充返回 true，否则返回 false
 */
bool IsAudioStreamProcessed(AudioStream stream);

/**
 * @brief 播放音频流
 *
 * @param stream AudioStream 音频流数据结构
 */
void PlayAudioStream(AudioStream stream);

/**
 * @brief 暂停音频流
 *
 * @param stream AudioStream 音频流数据结构
 */
void PauseAudioStream(AudioStream stream);

/**
 * @brief 恢复音频流
 *
 * @param stream AudioStream 音频流数据结构
 */
void ResumeAudioStream(AudioStream stream);

/**
 * @brief 检查音频流是否正在播放
 *
 * @param stream AudioStream 音频流数据结构
 * @return bool 如果音频流正在播放返回 true，否则返回 false
 */
bool IsAudioStreamPlaying(AudioStream stream);

/**
 * @brief 停止音频流
 *
 * @param stream AudioStream 音频流数据结构
 */
void StopAudioStream(AudioStream stream);

/**
 * @brief 设置音频流的音量 (1.0 为最大级别)
 *
 * @param stream AudioStream 音频流数据结构
 * @param volume float 音量级别（0.0 到 1.0）
 */
void SetAudioStreamVolume(AudioStream stream, float volume);

/**
 * @brief 设置音频流的音调 (1.0 为基础级别)
 *
 * @param stream AudioStream 音频流数据结构
 * @param pitch float 音调级别
 */
void SetAudioStreamPitch(AudioStream stream, float pitch);

/**
 * @brief 设置音频流的声像 (0.5 为中心)
 *
 * @param stream AudioStream 音频流数据结构
 * @param pan float 声像位置（0.0 到 1.0）
 */
void SetAudioStreamPan(AudioStream stream, float pan);

/**
 * @brief 设置新音频流的默认缓冲区大小
 *
 * @param size int 缓冲区大小（以帧为单位）
 */
void SetAudioStreamBufferSizeDefault(int size);

/**
 * @brief 音频线程回调，用于请求新数据
 *
 * @param stream AudioStream 音频流数据结构
 * @param callback AudioCallback 回调函数指针
 */
void SetAudioStreamCallback(AudioStream stream, AudioCallback callback);

/**
 * @brief 将音频流处理器附加到流，接收的样本为 'float' 类型
 *
 * @param stream AudioStream 音频流数据结构
 * @param processor AudioCallback 处理器函数指针
 */
void AttachAudioStreamProcessor(AudioStream stream, AudioCallback processor);

/**
 * @brief 从流中分离音频流处理器
 *
 * @param stream AudioStream 音频流数据结构
 * @param processor AudioCallback 处理器函数指针
 */
void DetachAudioStreamProcessor(AudioStream stream, AudioCallback processor);

/**
 * @brief 将音频流处理器附加到整个音频管道，接收的样本为 'float' 类型
 *
 * @param processor AudioCallback 处理器函数指针
 */
void AttachAudioMixedProcessor(AudioCallback processor);

/**
 * @brief 从整个音频管道中分离音频流处理器
 *
 * @param processor AudioCallback 处理器函数指针
 */
void DetachAudioMixedProcessor(AudioCallback processor);
// ------音频加载和播放函数 (模块: 音频)end-------------------------------------
