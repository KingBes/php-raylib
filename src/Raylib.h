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

typedef char *va_list;

// Callbacks to hook some internal functions
// WARNING: These callbacks are intended for advanced users
typedef void (*TraceLogCallback)(int logLevel, const char *text, va_list args);       // Logging: Redirect trace log messages
typedef unsigned char *(*LoadFileDataCallback)(const char *fileName, int *dataSize);  // FileIO: Load binary data
typedef bool (*SaveFileDataCallback)(const char *fileName, void *data, int dataSize); // FileIO: Save binary data
typedef char *(*LoadFileTextCallback)(const char *fileName);                          // FileIO: Load text data
typedef bool (*SaveFileTextCallback)(const char *fileName, char *text);               // FileIO: Save text data

// 核心RCORE 函数--------------------------------------------------------

// 窗口相关函数
void InitWindow(int width, int height, const char *title); // 初始化窗口和OpenGL上下文
void CloseWindow(void);                                    // 关闭窗口并卸载OpenGL上下文
bool WindowShouldClose(void);                              // 检查应用是否应关闭（按下ESC键或点击窗口关闭图标）
bool IsWindowReady(void);                                  // 检查窗口是否已成功初始化
bool IsWindowFullscreen(void);                             // 检查窗口当前是否处于全屏模式
bool IsWindowHidden(void);                                 // 检查窗口当前是否隐藏
bool IsWindowMinimized(void);                              // 检查窗口当前是否最小化
bool IsWindowMaximized(void);                              // 检查窗口当前是否最大化
bool IsWindowFocused(void);                                // 检查窗口当前是否获得焦点
bool IsWindowResized(void);                                // 检查窗口是否在上一帧被调整大小
bool IsWindowState(unsigned int flag);                     // 检查是否启用了特定窗口标志
void SetWindowState(unsigned int flags);                   // 使用标志设置窗口配置状态
void ClearWindowState(unsigned int flags);                 // 清除窗口配置状态标志
void ToggleFullscreen(void);                               // 切换全屏/窗口化模式（根据窗口分辨率调整显示器）
void ToggleBorderlessWindowed(void);                       // 切换无边框窗口模式（根据显示器分辨率调整窗口）
void MaximizeWindow(void);                                 // 最大化窗口（如果可调整大小）
void MinimizeWindow(void);                                 // 最小化窗口（如果可调整大小）
void RestoreWindow(void);                                  // 恢复窗口（取消最小化/最大化状态）
void SetWindowIcon(Image image);                           // 设置窗口图标（单张RGBA 32位图像）
void SetWindowIcons(Image *images, int count);             // 设置窗口图标（多张RGBA 32位图像）
void SetWindowTitle(const char *title);                    // 设置窗口标题
void SetWindowPosition(int x, int y);                      // 设置窗口在屏幕上的位置
void SetWindowMonitor(int monitor);                        // 设置当前窗口的显示器
void SetWindowMinSize(int width, int height);              // 设置窗口最小尺寸（用于FLAG_WINDOW_RESIZABLE）
void SetWindowMaxSize(int width, int height);              // 设置窗口最大尺寸（用于FLAG_WINDOW_RESIZABLE）
void SetWindowSize(int width, int height);                 // 设置窗口尺寸
void SetWindowOpacity(float opacity);                      // 设置窗口不透明度 [0.0f..1.0f]
void SetWindowFocused(void);                               // 设置窗口获得焦点
void *GetWindowHandle(void);                               // 获取原生窗口句柄
int GetScreenWidth(void);                                  // 获取当前屏幕宽度
int GetScreenHeight(void);                                 // 获取当前屏幕高度
int GetRenderWidth(void);                                  // 获取当前渲染宽度（考虑HiDPI）
int GetRenderHeight(void);                                 // 获取当前渲染高度（考虑HiDPI）
int GetMonitorCount(void);                                 // 获取连接的显示器数量
int GetCurrentMonitor(void);                               // 获取窗口所在的当前显示器
Vector2 GetMonitorPosition(int monitor);                   // 获取指定显示器的位置
int GetMonitorWidth(int monitor);                          // 获取指定显示器的宽度（当前使用的视频模式）
int GetMonitorHeight(int monitor);                         // 获取指定显示器的高度（当前使用的视频模式）
int GetMonitorPhysicalWidth(int monitor);                  // 获取指定显示器的物理宽度（毫米）
int GetMonitorPhysicalHeight(int monitor);                 // 获取指定显示器的物理高度（毫米）
int GetMonitorRefreshRate(int monitor);                    // 获取指定显示器的刷新率
Vector2 GetWindowPosition(void);                           // 获取窗口在显示器上的XY位置
Vector2 GetWindowScaleDPI(void);                           // 获取窗口DPI缩放因子
const char *GetMonitorName(int monitor);                   // 获取指定显示器的UTF-8编码可读名称
void SetClipboardText(const char *text);                   // 设置剪贴板文本内容
const char *GetClipboardText(void);                        // 获取剪贴板文本内容
Image GetClipboardImage(void);                             // 获取剪贴板图像
void EnableEventWaiting(void);                             // 启用在EndDrawing()时等待事件（禁用自动事件轮询）
void DisableEventWaiting(void);                            // 禁用等待事件（启用自动事件轮询）

// 光标相关函数
void ShowCursor(void);       // 显示光标
void HideCursor(void);       // 隐藏光标
bool IsCursorHidden(void);   // 检查光标是否不可见
void EnableCursor(void);     // 启用光标（解锁光标）
void DisableCursor(void);    // 禁用光标（锁定光标）
bool IsCursorOnScreen(void); // 检查光标是否在屏幕上

// 绘图相关函数
void ClearBackground(Color color);                          // 设置背景颜色（帧缓冲清除颜色）
void BeginDrawing(void);                                    // 初始化绘图画布（帧缓冲）
void EndDrawing(void);                                      // 结束画布绘制并交换缓冲（双缓冲）
void BeginMode2D(Camera2D camera);                          // 开启自定义2D相机模式
void EndMode2D(void);                                       // 结束2D相机模式
void BeginMode3D(Camera3D camera);                          // 开启自定义3D相机模式
void EndMode3D(void);                                       // 结束3D模式并返回默认2D正交模式
void BeginTextureMode(RenderTexture2D target);              // 开始绘制到渲染纹理
void EndTextureMode(void);                                  // 结束渲染纹理绘制
void BeginShaderMode(Shader shader);                        // 开启自定义着色器绘制
void EndShaderMode(void);                                   // 结束自定义着色器绘制（使用默认着色器）
void BeginBlendMode(int mode);                              // 开启混合模式（透明、叠加、相乘、相减、自定义）
void EndBlendMode(void);                                    // 结束混合模式（重置为默认透明混合）
void BeginScissorMode(int x, int y, int width, int height); // 开启裁剪模式（定义后续绘制的屏幕区域）
void EndScissorMode(void);                                  // 结束裁剪模式
void BeginVrStereoMode(VrStereoConfig config);              // 开启VR立体渲染（需要VR模拟器）
void EndVrStereoMode(void);                                 // 结束VR立体渲染

// VR立体配置函数（用于VR模拟器）
VrStereoConfig LoadVrStereoConfig(VrDeviceInfo device); // 加载VR模拟器设备的立体配置
void UnloadVrStereoConfig(VrStereoConfig config);       // 卸载VR立体配置

// 着色器管理函数
// 注意：OpenGL 1.1不支持着色器功能
Shader LoadShader(const char *vsFileName, const char *fsFileName);                                // 从文件加载着色器并绑定默认位置
Shader LoadShaderFromMemory(const char *vsCode, const char *fsCode);                              // 从代码字符串加载着色器并绑定默认位置
bool IsShaderValid(Shader shader);                                                                // 检查着色器是否有效（已加载到GPU）
int GetShaderLocation(Shader shader, const char *uniformName);                                    // 获取着色器uniform位置
int GetShaderLocationAttrib(Shader shader, const char *attribName);                               // 获取着色器属性位置
void SetShaderValue(Shader shader, int locIndex, const void *value, int uniformType);             // 设置着色器uniform值
void SetShaderValueV(Shader shader, int locIndex, const void *value, int uniformType, int count); // 设置着色器uniform值（向量）
void SetShaderValueMatrix(Shader shader, int locIndex, Matrix mat);                               // 设置着色器uniform值（4x4矩阵）
void SetShaderValueTexture(Shader shader, int locIndex, Texture2D texture);                       // 设置着色器纹理uniform值（sampler2d）
void UnloadShader(Shader shader);                                                                 // 从GPU显存卸载着色器

// 屏幕空间相关函数
#define GetMouseRay GetScreenToWorldRay                                             // 旧版本raylib的兼容性定义
Ray GetScreenToWorldRay(Vector2 position, Camera camera);                           // 获取屏幕位置（如鼠标）对应的世界空间射线
Ray GetScreenToWorldRayEx(Vector2 position, Camera camera, int width, int height);  // 在视口中获取屏幕位置对应的世界空间射线
Vector2 GetWorldToScreen(Vector3 position, Camera camera);                          // 将3D世界坐标转换为屏幕空间坐标
Vector2 GetWorldToScreenEx(Vector3 position, Camera camera, int width, int height); // 在视口中将3D世界坐标转换为屏幕空间坐标
Vector2 GetWorldToScreen2D(Vector2 position, Camera2D camera);                      // 将2D相机世界坐标转换为屏幕空间坐标
Vector2 GetScreenToWorld2D(Vector2 position, Camera2D camera);                      // 将2D相机屏幕坐标转换为世界空间坐标
Matrix GetCameraMatrix(Camera camera);                                              // 获取相机变换矩阵（视图矩阵）
Matrix GetCameraMatrix2D(Camera2D camera);                                          // 获取2D相机变换矩阵

// 时间相关函数
void SetTargetFPS(int fps); // 设置目标FPS（最大值）
float GetFrameTime(void);   // 获取上一帧的绘制时间（增量时间）
double GetTime(void);       // 获取自InitWindow()以来的运行时间（秒）
int GetFPS(void);           // 获取当前FPS

// 自定义帧控制函数
// 注意：这些函数供需要完全控制帧处理的高级用户使用
// 默认情况下EndDrawing()会自动处理：绘制内容+交换缓冲+帧时间管理+轮询输入事件
// 要手动控制帧流程，请在config.h中启用SUPPORT_CUSTOM_FRAME_CONTROL
void SwapScreenBuffer(void);   // 交换前后缓冲（屏幕绘制）
void PollInputEvents(void);    // 轮询所有输入事件
void WaitTime(double seconds); // 等待指定时间（暂停程序执行）

// 随机数生成函数
void SetRandomSeed(unsigned int seed);                         // 设置随机数生成器种子
int GetRandomValue(int min, int max);                          // 获取[min, max]范围内的随机值（包含两端）
int *LoadRandomSequence(unsigned int count, int min, int max); // 加载不重复的随机数序列
void UnloadRandomSequence(int *sequence);                      // 卸载随机数序列

// 杂项函数
void TakeScreenshot(const char *fileName); // 截取屏幕截图（文件名扩展名决定格式）
void SetConfigFlags(unsigned int flags);   // 设置初始化配置标志（参考FLAGS）
void OpenURL(const char *url);             // 用默认浏览器打开URL（如果可用）

// 注意：以下函数在[utils]模块中实现
//------------------------------------------------------------------
void TraceLog(int logLevel, const char *text, ...); // 输出日志信息（LOG_DEBUG, LOG_INFO, LOG_WARNING, LOG_ERROR...）
void SetTraceLogLevel(int logLevel);                // 设置最低日志级别
void *MemAlloc(unsigned int size);                  // 内部内存分配器
void *MemRealloc(void *ptr, unsigned int size);     // 内部内存重新分配器
void MemFree(void *ptr);                            // 内部内存释放器

// 设置自定义回调
// 警告：回调设置仅供高级用户使用
void SetTraceLogCallback(TraceLogCallback callback);         // 设置自定义日志回调
void SetLoadFileDataCallback(LoadFileDataCallback callback); // 设置自定义二进制文件加载回调
void SetSaveFileDataCallback(SaveFileDataCallback callback); // 设置自定义二进制文件保存回调
void SetLoadFileTextCallback(LoadFileTextCallback callback); // 设置自定义文本文件加载回调
void SetSaveFileTextCallback(SaveFileTextCallback callback); // 设置自定义文本文件保存回调

// 文件管理函数
unsigned char *LoadFileData(const char *fileName, int *dataSize);                     // 以字节数组形式加载文件数据（读取）
void UnloadFileData(unsigned char *data);                                             // 卸载由LoadFileData()分配的文件数据
bool SaveFileData(const char *fileName, void *data, int dataSize);                    // 将字节数组数据保存到文件（写入），成功返回true
bool ExportDataAsCode(const unsigned char *data, int dataSize, const char *fileName); // 将数据导出为代码文件(.h)，成功返回true
char *LoadFileText(const char *fileName);                                             // 加载文本文件数据（读取），返回'\0'终止的字符串
void UnloadFileText(char *text);                                                      // 卸载由LoadFileText()分配的文本数据
bool SaveFileText(const char *fileName, char *text);                                  // 保存文本数据到文件（写入），字符串需'\0'终止，成功返回true
//------------------------------------------------------------------

// 文件系统函数
bool FileExists(const char *fileName);                                                         // 检查文件是否存在
bool DirectoryExists(const char *dirPath);                                                     // 检查目录路径是否存在
bool IsFileExtension(const char *fileName, const char *ext);                                   // 检查文件扩展名（需包含点：.png, .wav）
int GetFileLength(const char *fileName);                                                       // 获取文件字节长度（注意：GetFileSize与windows.h冲突）
const char *GetFileExtension(const char *fileName);                                            // 获取文件名扩展名指针（包含点：'.png'）
const char *GetFileName(const char *filePath);                                                 // 获取路径中的文件名指针
const char *GetFileNameWithoutExt(const char *filePath);                                       // 获取不带扩展名的文件名（使用静态字符串）
const char *GetDirectoryPath(const char *filePath);                                            // 获取完整路径（使用静态字符串）
const char *GetPrevDirectoryPath(const char *dirPath);                                         // 获取上级目录路径（使用静态字符串）
const char *GetWorkingDirectory(void);                                                         // 获取当前工作目录（使用静态字符串）
const char *GetApplicationDirectory(void);                                                     // 获取应用程序所在目录（使用静态字符串）
int MakeDirectory(const char *dirPath);                                                        // 创建目录（完整路径），成功返回0
bool ChangeDirectory(const char *dir);                                                         // 更改工作目录，成功返回true
bool IsPathFile(const char *path);                                                             // 检查路径是文件还是目录
bool IsFileNameValid(const char *fileName);                                                    // 检查文件名在平台/OS中是否有效
FilePathList LoadDirectoryFiles(const char *dirPath);                                          // 加载目录文件路径列表
FilePathList LoadDirectoryFilesEx(const char *basePath, const char *filter, bool scanSubdirs); // 加载带扩展名过滤和递归扫描的目录文件路径，使用'DIR'过滤包含目录
void UnloadDirectoryFiles(FilePathList files);                                                 // 卸载文件路径列表
bool IsFileDropped(void);                                                                      // 检查是否有文件被拖入窗口
FilePathList LoadDroppedFiles(void);                                                           // 加载被拖放的文件路径
void UnloadDroppedFiles(FilePathList files);                                                   // 卸载被拖放的文件路径
long GetFileModTime(const char *fileName);                                                     // 获取文件修改时间（最后写入时间）

// 压缩/编码功能
unsigned char *CompressData(const unsigned char *data, int dataSize, int *compDataSize);       // 压缩数据（DEFLATE算法），需用MemFree()释放
unsigned char *DecompressData(const unsigned char *compData, int compDataSize, int *dataSize); // 解压数据（DEFLATE算法），需用MemFree()释放
char *EncodeDataBase64(const unsigned char *data, int dataSize, int *outputSize);              // 将数据编码为Base64字符串，需用MemFree()释放
unsigned char *DecodeDataBase64(const unsigned char *data, int *outputSize);                   // 解码Base64字符串数据，需用MemFree()释放
unsigned int ComputeCRC32(unsigned char *data, int dataSize);                                  // 计算CRC32哈希值
unsigned int *ComputeMD5(unsigned char *data, int dataSize);                                   // 计算MD5哈希值，返回静态int[4]（16字节）
unsigned int *ComputeSHA1(unsigned char *data, int dataSize);                                  // 计算SHA1哈希值，返回静态int[5]（20字节）

// 自动化事件功能
AutomationEventList LoadAutomationEventList(const char *fileName);              // 从文件加载自动化事件列表，NULL表示空列表，容量=MAX_AUTOMATION_EVENTS
void UnloadAutomationEventList(AutomationEventList list);                       // 卸载自动化事件列表
bool ExportAutomationEventList(AutomationEventList list, const char *fileName); // 将自动化事件列表导出为文本文件
void SetAutomationEventList(AutomationEventList *list);                         // 设置要记录的自动化事件列表
void SetAutomationEventBaseFrame(int frame);                                    // 设置自动化事件记录的基准帧
void StartAutomationEventRecording(void);                                       // 开始记录自动化事件（需先设置列表）
void StopAutomationEventRecording(void);                                        // 停止记录自动化事件
void PlayAutomationEvent(AutomationEvent event);                                // 执行记录的自动化事件

// 输入处理函数

// 键盘输入相关函数
bool IsKeyPressed(int key);       // 检查按键是否被按下一次
bool IsKeyPressedRepeat(int key); // 检查按键是否被重复按下（支持重复触发）
bool IsKeyDown(int key);          // 检查按键是否正被按住
bool IsKeyReleased(int key);      // 检查按键是否被释放一次
bool IsKeyUp(int key);            // 检查按键是否未被按下
int GetKeyPressed(void);          // 获取队列中的按下按键（键码），队列空时返回0
int GetCharPressed(void);         // 获取队列中的输入字符（Unicode），队列空时返回0
void SetExitKey(int key);         // 设置自定义退出键（默认ESC）

// 游戏手柄输入相关函数
bool IsGamepadAvailable(int gamepad);                                                     // 检查指定索引的游戏手柄是否可用
const char *GetGamepadName(int gamepad);                                                  // 获取游戏手柄内部名称标识
bool IsGamepadButtonPressed(int gamepad, int button);                                     // 检查游戏手柄按钮是否被按下一次
bool IsGamepadButtonDown(int gamepad, int button);                                        // 检查游戏手柄按钮是否正被按住
bool IsGamepadButtonReleased(int gamepad, int button);                                    // 检查游戏手柄按钮是否被释放一次
bool IsGamepadButtonUp(int gamepad, int button);                                          // 检查游戏手柄按钮是否未被按下
int GetGamepadButtonPressed(void);                                                        // 获取最后按下的游戏手柄按钮
int GetGamepadAxisCount(int gamepad);                                                     // 获取游戏手柄的轴数量
float GetGamepadAxisMovement(int gamepad, int axis);                                      // 获取游戏手柄轴的移动值（范围-1.0到1.0）
int SetGamepadMappings(const char *mappings);                                             // 设置自定义游戏手柄映射（SDL_GameControllerDB格式）
void SetGamepadVibration(int gamepad, float leftMotor, float rightMotor, float duration); // 设置游戏手柄震动（左右马达强度，持续秒数）

// 鼠标输入相关函数
bool IsMouseButtonPressed(int button);          // 检查鼠标按钮是否被按下一次
bool IsMouseButtonDown(int button);             // 检查鼠标按钮是否正被按住
bool IsMouseButtonReleased(int button);         // 检查鼠标按钮是否被释放一次
bool IsMouseButtonUp(int button);               // 检查鼠标按钮是否未被按下
int GetMouseX(void);                            // 获取鼠标X坐标（屏幕坐标系）
int GetMouseY(void);                            // 获取鼠标Y坐标（屏幕坐标系）
Vector2 GetMousePosition(void);                 // 获取鼠标XY坐标（Vector2类型）
Vector2 GetMouseDelta(void);                    // 获取帧间鼠标移动增量
void SetMousePosition(int x, int y);            // 设置鼠标位置（屏幕坐标系）
void SetMouseOffset(int offsetX, int offsetY);  // 设置鼠标坐标偏移量
void SetMouseScale(float scaleX, float scaleY); // 设置鼠标移动缩放比例
float GetMouseWheelMove(void);                  // 获取鼠标滚轮垂直滚动量
Vector2 GetMouseWheelMoveV(void);               // 获取鼠标滚轮XY双向滚动量（Vector2类型）
void SetMouseCursor(int cursor);                // 设置鼠标图标样式

// 触摸输入相关函数
int GetTouchX(void);                 // 获取触摸点0的X坐标（屏幕坐标系）
int GetTouchY(void);                 // 获取触摸点0的Y坐标（屏幕坐标系）
Vector2 GetTouchPosition(int index); // 获取指定索引触摸点的坐标
int GetTouchPointId(int index);      // 获取指定索引触摸点的唯一ID
int GetTouchPointCount(void);        // 获取当前活跃触摸点数量

//------------------------------------------------------------------------------------
// 手势识别函数（模块：rgestures）
//------------------------------------------------------------------------------------
void SetGesturesEnabled(unsigned int flags);  // 启用指定类型的手势检测（按位标志组合）
bool IsGestureDetected(unsigned int gesture); // 检查特定手势是否被检测到
int GetGestureDetected(void);                 // 获取最新检测到的手势类型
float GetGestureHoldDuration(void);           // 获取长按手势的持续时间（秒）
Vector2 GetGestureDragVector(void);           // 获取拖拽手势的移动向量
float GetGestureDragAngle(void);              // 获取拖拽手势的移动角度（弧度）
Vector2 GetGesturePinchVector(void);          // 获取捏合手势的缩放向量（手指间距变化）
float GetGesturePinchAngle(void);             // 获取捏合手势的旋转角度（弧度）

// 相机系统函数（模块：rcamera）

void UpdateCamera(Camera *camera, int mode);                                          // 根据选定模式更新相机位置（第一人称/第三人称等）
void UpdateCameraPro(Camera *camera, Vector3 movement, Vector3 rotation, float zoom); // 高级相机控制（自定义移动/旋转/缩放）

// 模块:rShapes ---------------------------------------------------------------------------

// 设置形状绘制使用的纹理和矩形
// 注意：当使用基本形状和单一字体时，此功能可能有用，
// 定义字体字符的白色矩形可以在单次绘制调用中完成所有绘制
void SetShapesTexture(Texture2D texture, Rectangle source); // 设置形状绘制使用的纹理和源矩形
Texture2D GetShapesTexture(void);                           // 获取形状绘制使用的纹理
Rectangle GetShapesTextureRectangle(void);                  // 获取形状绘制使用的纹理源矩形

// 基本形状绘制函数
void DrawPixel(int posX, int posY, Color color);                                                                                       // 绘制像素（几何方式绘制，慎用性能影响）
void DrawPixelV(Vector2 position, Color color);                                                                                        // 向量版像素绘制（几何方式）
void DrawLine(int startPosX, int startPosY, int endPosX, int endPosY, Color color);                                                    // 绘制直线（两点式）
void DrawLineV(Vector2 startPos, Vector2 endPos, Color color);                                                                         // 向量版直线绘制（使用GL线条）
void DrawLineEx(Vector2 startPos, Vector2 endPos, float thick, Color color);                                                           // 绘制带粗细的直线（使用三角形/四边形）
void DrawLineStrip(const Vector2 *points, int pointCount, Color color);                                                                // 绘制连续折线（使用GL线条）
void DrawLineBezier(Vector2 startPos, Vector2 endPos, float thick, Color color);                                                       // 绘制三次贝塞尔曲线路径的线段
void DrawCircle(int centerX, int centerY, float radius, Color color);                                                                  // 绘制实心圆形（整数坐标中心）
void DrawCircleSector(Vector2 center, float radius, float startAngle, float endAngle, int segments, Color color);                      // 绘制圆形扇形区域
void DrawCircleSectorLines(Vector2 center, float radius, float startAngle, float endAngle, int segments, Color color);                 // 绘制圆形扇形轮廓线
void DrawCircleGradient(int centerX, int centerY, float radius, Color inner, Color outer);                                             // 绘制渐变填充圆形（整数坐标中心）
void DrawCircleV(Vector2 center, float radius, Color color);                                                                           // 向量版实心圆形
void DrawCircleLines(int centerX, int centerY, float radius, Color color);                                                             // 绘制圆形轮廓线（整数坐标中心）
void DrawCircleLinesV(Vector2 center, float radius, Color color);                                                                      // 向量版圆形轮廓线
void DrawEllipse(int centerX, int centerY, float radiusH, float radiusV, Color color);                                                 // 绘制实心椭圆（水平/垂直半径）
void DrawEllipseLines(int centerX, int centerY, float radiusH, float radiusV, Color color);                                            // 绘制椭圆轮廓线
void DrawRing(Vector2 center, float innerRadius, float outerRadius, float startAngle, float endAngle, int segments, Color color);      // 绘制环形区域
void DrawRingLines(Vector2 center, float innerRadius, float outerRadius, float startAngle, float endAngle, int segments, Color color); // 绘制环形轮廓线
void DrawRectangle(int posX, int posY, int width, int height, Color color);                                                            // 绘制实心矩形（整数坐标）
void DrawRectangleV(Vector2 position, Vector2 size, Color color);                                                                      // 向量版实心矩形
void DrawRectangleRec(Rectangle rec, Color color);                                                                                     // 矩形对象版实心绘制
void DrawRectanglePro(Rectangle rec, Vector2 origin, float rotation, Color color);                                                     // 高级参数矩形绘制（支持旋转和原点）
void DrawRectangleGradientV(int posX, int posY, int width, int height, Color top, Color bottom);                                       // 垂直渐变填充矩形
void DrawRectangleGradientH(int posX, int posY, int width, int height, Color left, Color right);                                       // 水平渐变填充矩形
void DrawRectangleGradientEx(Rectangle rec, Color topLeft, Color bottomLeft, Color topRight, Color bottomRight);                       // 四角颜色渐变填充矩形
void DrawRectangleLines(int posX, int posY, int width, int height, Color color);                                                       // 绘制矩形轮廓线（整数坐标）
void DrawRectangleLinesEx(Rectangle rec, float lineThick, Color color);                                                                // 扩展参数矩形轮廓线（支持线宽）
void DrawRectangleRounded(Rectangle rec, float roundness, int segments, Color color);                                                  // 绘制圆角矩形（可调圆角半径）
void DrawRectangleRoundedLines(Rectangle rec, float roundness, int segments, Color color);                                             // 绘制圆角矩形轮廓线
void DrawRectangleRoundedLinesEx(Rectangle rec, float roundness, int segments, float lineThick, Color color);                          // 扩展参数圆角矩形轮廓线
void DrawTriangle(Vector2 v1, Vector2 v2, Vector2 v3, Color color);                                                                    // 绘制实心三角形（顶点逆时针顺序）
void DrawTriangleLines(Vector2 v1, Vector2 v2, Vector2 v3, Color color);                                                               // 绘制三角形轮廓线
void DrawTriangleFan(const Vector2 *points, int pointCount, Color color);                                                              // 绘制三角形扇（第一个顶点为中心）
void DrawTriangleStrip(const Vector2 *points, int pointCount, Color color);                                                            // 绘制三角形带
void DrawPoly(Vector2 center, int sides, float radius, float rotation, Color color);                                                   // 绘制正多边形（向量中心版）
void DrawPolyLines(Vector2 center, int sides, float radius, float rotation, Color color);                                              // 绘制正多边形轮廓线
void DrawPolyLinesEx(Vector2 center, int sides, float radius, float rotation, float lineThick, Color color);                           // 扩展参数多边形轮廓线

// 样条曲线绘制函数
void DrawSplineLinear(const Vector2 *points, int pointCount, float thick, Color color);                      // 绘制线性样条（至少2个点）
void DrawSplineBasis(const Vector2 *points, int pointCount, float thick, Color color);                       // 绘制B样条曲线（至少4个点）
void DrawSplineCatmullRom(const Vector2 *points, int pointCount, float thick, Color color);                  // 绘制Catmull-Rom样条（至少4个点）
void DrawSplineBezierQuadratic(const Vector2 *points, int pointCount, float thick, Color color);             // 绘制二次贝塞尔样条（至少3个点，1个控制点）
void DrawSplineBezierCubic(const Vector2 *points, int pointCount, float thick, Color color);                 // 绘制三次贝塞尔样条（至少4个点，2个控制点）
void DrawSplineSegmentLinear(Vector2 p1, Vector2 p2, float thick, Color color);                              // 绘制线性样条段（2个点）
void DrawSplineSegmentBasis(Vector2 p1, Vector2 p2, Vector2 p3, Vector2 p4, float thick, Color color);       // 绘制B样条段（4个点）
void DrawSplineSegmentCatmullRom(Vector2 p1, Vector2 p2, Vector2 p3, Vector2 p4, float thick, Color color);  // 绘制Catmull-Rom样条段（4个点）
void DrawSplineSegmentBezierQuadratic(Vector2 p1, Vector2 c2, Vector2 p3, float thick, Color color);         // 绘制二次贝塞尔段（2个点+1控制点）
void DrawSplineSegmentBezierCubic(Vector2 p1, Vector2 c2, Vector2 c3, Vector2 p4, float thick, Color color); // 绘制三次贝塞尔段（2个点+2控制点）

// 样条曲线点插值计算函数（t范围[0.0f, 1.0f]）
Vector2 GetSplinePointLinear(Vector2 startPos, Vector2 endPos, float t);                    // 线性样条点插值计算
Vector2 GetSplinePointBasis(Vector2 p1, Vector2 p2, Vector2 p3, Vector2 p4, float t);       // B样条点插值计算
Vector2 GetSplinePointCatmullRom(Vector2 p1, Vector2 p2, Vector2 p3, Vector2 p4, float t);  // Catmull-Rom样条点插值计算
Vector2 GetSplinePointBezierQuad(Vector2 p1, Vector2 c2, Vector2 p3, float t);              // 二次贝塞尔点插值计算
Vector2 GetSplinePointBezierCubic(Vector2 p1, Vector2 c2, Vector2 c3, Vector2 p4, float t); // 三次贝塞尔点插值计算

// 基本形状碰撞检测函数
bool CheckCollisionRecs(Rectangle rec1, Rectangle rec2);                                                                   // 检测两个矩形是否碰撞
bool CheckCollisionCircles(Vector2 center1, float radius1, Vector2 center2, float radius2);                                // 检测两个圆形是否碰撞
bool CheckCollisionCircleRec(Vector2 center, float radius, Rectangle rec);                                                 // 检测圆形与矩形是否碰撞
bool CheckCollisionCircleLine(Vector2 center, float radius, Vector2 p1, Vector2 p2);                                       // 检测圆形与线段是否碰撞
bool CheckCollisionPointRec(Vector2 point, Rectangle rec);                                                                 // 检测点是否在矩形内
bool CheckCollisionPointCircle(Vector2 point, Vector2 center, float radius);                                               // 检测点是否在圆形内
bool CheckCollisionPointTriangle(Vector2 point, Vector2 p1, Vector2 p2, Vector2 p3);                                       // 检测点是否在三角形内
bool CheckCollisionPointLine(Vector2 point, Vector2 p1, Vector2 p2, int threshold);                                        // 检测点是否在线段上（带像素阈值）
bool CheckCollisionPointPoly(Vector2 point, const Vector2 *points, int pointCount);                                        // 检测点是否在多边形内
bool CheckCollisionLines(Vector2 startPos1, Vector2 endPos1, Vector2 startPos2, Vector2 endPos2, Vector2 *collisionPoint); // 检测两线段是否相交，返回碰撞点
Rectangle GetCollisionRec(Rectangle rec1, Rectangle rec2);                                                                 // 获取两个矩形的碰撞重叠区域

// 模块：rTextures ------------------------------------------------

// 图像加载函数
// 注意：这些函数不需要GPU访问
Image LoadImage(const char *fileName);                                                                         // 从文件加载图像到CPU内存(RAM)
Image LoadImageRaw(const char *fileName, int width, int height, int format, int headerSize);                   // 从RAW文件数据加载图像
Image LoadImageAnim(const char *fileName, int *frames);                                                        // 从文件加载图像序列(帧数据追加到image.data)
Image LoadImageAnimFromMemory(const char *fileType, const unsigned char *fileData, int dataSize, int *frames); // 从内存缓冲区加载图像序列
Image LoadImageFromMemory(const char *fileType, const unsigned char *fileData, int dataSize);                  // 从内存缓冲区加载图像(fileType指扩展名如.png)
Image LoadImageFromTexture(Texture2D texture);                                                                 // 从GPU纹理数据加载图像
Image LoadImageFromScreen(void);                                                                               // 从屏幕缓冲区加载图像(截图)
bool IsImageValid(Image image);                                                                                // 检查图像是否有效(数据和参数)
void UnloadImage(Image image);                                                                                 // 从CPU内存卸载图像
bool ExportImage(Image image, const char *fileName);                                                           // 导出图像数据到文件，成功返回true
unsigned char *ExportImageToMemory(Image image, const char *fileType, int *fileSize);                          // 导出图像到内存缓冲区
bool ExportImageAsCode(Image image, const char *fileName);                                                     // 将图像导出为字节数组代码文件，成功返回true

// 图像生成函数
Image GenImageColor(int width, int height, Color color);                                        // 生成纯色图像
Image GenImageGradientLinear(int width, int height, int direction, Color start, Color end);     // 生成线性渐变图像(方向0-360度，0=垂直渐变)
Image GenImageGradientRadial(int width, int height, float density, Color inner, Color outer);   // 生成径向渐变图像
Image GenImageGradientSquare(int width, int height, float density, Color inner, Color outer);   // 生成方形渐变图像
Image GenImageChecked(int width, int height, int checksX, int checksY, Color col1, Color col2); // 生成棋盘格图像
Image GenImageWhiteNoise(int width, int height, float factor);                                  // 生成白噪点图像
Image GenImagePerlinNoise(int width, int height, int offsetX, int offsetY, float scale);        // 生成Perlin噪声图像
Image GenImageCellular(int width, int height, int tileSize);                                    // 生成细胞自动机图像(瓦片尺寸越大细胞越大)
Image GenImageText(int width, int height, const char *text);                                    // 从文本生成灰度图像

// 图像处理函数
Image ImageCopy(Image image);                                                                            // 创建图像副本(用于变换操作)
Image ImageFromImage(Image image, Rectangle rec);                                                        // 从图像中截取区域创建新图像
Image ImageFromChannel(Image image, int selectedChannel);                                                // 从指定通道创建灰度图像
Image ImageText(const char *text, int fontSize, Color color);                                            // 使用默认字体生成文本图像
Image ImageTextEx(Font font, const char *text, float fontSize, float spacing, Color tint);               // 使用自定义字体生成文本图像
void ImageFormat(Image *image, int newFormat);                                                           // 转换图像数据到指定格式
void ImageToPOT(Image *image, Color fill);                                                               // 将图像转换为2的幂次方尺寸(用颜色填充)
void ImageCrop(Image *image, Rectangle crop);                                                            // 按矩形区域裁剪图像
void ImageAlphaCrop(Image *image, float threshold);                                                      // 根据alpha通道阈值裁剪图像
void ImageAlphaClear(Image *image, Color color, float threshold);                                        // 用指定颜色替换低于阈值的alpha区域
void ImageAlphaMask(Image *image, Image alphaMask);                                                      // 应用alpha遮罩到图像
void ImageAlphaPremultiply(Image *image);                                                                // 预乘alpha通道
void ImageBlurGaussian(Image *image, int blurSize);                                                      // 应用高斯模糊(基于盒模糊近似)
void ImageKernelConvolution(Image *image, const float *kernel, int kernelSize);                          // 应用自定义卷积核处理图像
void ImageResize(Image *image, int newWidth, int newHeight);                                             // 调整图像尺寸(双三次插值算法)
void ImageResizeNN(Image *image, int newWidth, int newHeight);                                           // 调整图像尺寸(最近邻插值算法)
void ImageResizeCanvas(Image *image, int newWidth, int newHeight, int offsetX, int offsetY, Color fill); // 调整画布尺寸并用颜色填充
void ImageMipmaps(Image *image);                                                                         // 生成图像多级渐远纹理
void ImageDither(Image *image, int rBpp, int gBpp, int bBpp, int aBpp);                                  // 将图像颜色深度降低至16位或更低(弗洛伊德-斯坦伯格抖动)
void ImageFlipVertical(Image *image);                                                                    // 垂直翻转图像
void ImageFlipHorizontal(Image *image);                                                                  // 水平翻转图像
void ImageRotate(Image *image, int degrees);                                                             // 旋转图像(-359到359度)
void ImageRotateCW(Image *image);                                                                        // 顺时针旋转90度
void ImageRotateCCW(Image *image);                                                                       // 逆时针旋转90度
void ImageColorTint(Image *image, Color color);                                                          // 给图像着色
void ImageColorInvert(Image *image);                                                                     // 反相图像颜色
void ImageColorGrayscale(Image *image);                                                                  // 将图像转为灰度
void ImageColorContrast(Image *image, float contrast);                                                   // 调整图像对比度(-100到100)
void ImageColorBrightness(Image *image, int brightness);                                                 // 调整图像亮度(-255到255)
void ImageColorReplace(Image *image, Color color, Color replace);                                        // 替换图像中的指定颜色
Color *LoadImageColors(Image image);                                                                     // 从图像加载颜色数组(RGBA 32位)
Color *LoadImagePalette(Image image, int maxPaletteSize, int *colorCount);                               // 从图像加载调色板颜色数组
void UnloadImageColors(Color *colors);                                                                   // 卸载LoadImageColors()加载的颜色数据
void UnloadImagePalette(Color *colors);                                                                  // 卸载LoadImagePalette()加载的调色板
Rectangle GetImageAlphaBorder(Image image, float threshold);                                             // 获取图像alpha通道边界矩形
Color GetImageColor(Image image, int x, int y);                                                          // 获取图像(x,y)位置像素颜色

// 图像绘制函数
// 注意：这些是CPU软件渲染函数
void ImageClearBackground(Image *dst, Color color);                                                                         // 用指定颜色清除图像背景
void ImageDrawPixel(Image *dst, int posX, int posY, Color color);                                                           // 在图像上绘制像素
void ImageDrawPixelV(Image *dst, Vector2 position, Color color);                                                            // 向量版像素绘制
void ImageDrawLine(Image *dst, int startPosX, int startPosY, int endPosX, int endPosY, Color color);                        // 在图像上绘制直线
void ImageDrawLineV(Image *dst, Vector2 start, Vector2 end, Color color);                                                   // 向量版直线绘制
void ImageDrawLineEx(Image *dst, Vector2 start, Vector2 end, int thick, Color color);                                       // 绘制带粗细的直线
void ImageDrawCircle(Image *dst, int centerX, int centerY, int radius, Color color);                                        // 绘制实心圆
void ImageDrawCircleV(Image *dst, Vector2 center, int radius, Color color);                                                 // 向量版实心圆绘制
void ImageDrawCircleLines(Image *dst, int centerX, int centerY, int radius, Color color);                                   // 绘制圆形轮廓
void ImageDrawCircleLinesV(Image *dst, Vector2 center, int radius, Color color);                                            // 向量版圆形轮廓绘制
void ImageDrawRectangle(Image *dst, int posX, int posY, int width, int height, Color color);                                // 绘制实心矩形
void ImageDrawRectangleV(Image *dst, Vector2 position, Vector2 size, Color color);                                          // 向量版矩形绘制
void ImageDrawRectangleRec(Image *dst, Rectangle rec, Color color);                                                         // 矩形对象版绘制
void ImageDrawRectangleLines(Image *dst, Rectangle rec, int thick, Color color);                                            // 绘制矩形轮廓线
void ImageDrawTriangle(Image *dst, Vector2 v1, Vector2 v2, Vector2 v3, Color color);                                        // 绘制实心三角形
void ImageDrawTriangleEx(Image *dst, Vector2 v1, Vector2 v2, Vector2 v3, Color c1, Color c2, Color c3);                     // 绘制颜色插值三角形
void ImageDrawTriangleLines(Image *dst, Vector2 v1, Vector2 v2, Vector2 v3, Color color);                                   // 绘制三角形轮廓
void ImageDrawTriangleFan(Image *dst, Vector2 *points, int pointCount, Color color);                                        // 绘制三角形扇
void ImageDrawTriangleStrip(Image *dst, Vector2 *points, int pointCount, Color color);                                      // 绘制三角形带
void ImageDraw(Image *dst, Image src, Rectangle srcRec, Rectangle dstRec, Color tint);                                      // 在目标图像上绘制源图像区域(应用色调)
void ImageDrawText(Image *dst, const char *text, int posX, int posY, int fontSize, Color color);                            // 用默认字体绘制文本到图像
void ImageDrawTextEx(Image *dst, Font font, const char *text, Vector2 position, float fontSize, float spacing, Color tint); // 用自定义字体绘制文本到图像

// 纹理加载函数
// 注意：这些函数需要GPU访问
Texture2D LoadTexture(const char *fileName);                                 // 从文件加载纹理到GPU显存(VRAM)
Texture2D LoadTextureFromImage(Image image);                                 // 从图像数据加载纹理
TextureCubemap LoadTextureCubemap(Image image, int layout);                  // 加载立方体贴图(支持多种布局)
RenderTexture2D LoadRenderTexture(int width, int height);                    // 创建渲染纹理(帧缓冲)
bool IsTextureValid(Texture2D texture);                                      // 检查纹理是否有效(已加载到GPU)
void UnloadTexture(Texture2D texture);                                       // 从GPU显存卸载纹理
bool IsRenderTextureValid(RenderTexture2D target);                           // 检查渲染纹理是否有效
void UnloadRenderTexture(RenderTexture2D target);                            // 卸载渲染纹理
void UpdateTexture(Texture2D texture, const void *pixels);                   // 更新纹理像素数据
void UpdateTextureRec(Texture2D texture, Rectangle rec, const void *pixels); // 更新纹理部分区域像素数据

// 纹理配置函数
void GenTextureMipmaps(Texture2D *texture);           // 生成纹理多级渐远
void SetTextureFilter(Texture2D texture, int filter); // 设置纹理缩放过滤模式
void SetTextureWrap(Texture2D texture, int wrap);     // 设置纹理环绕模式

// 纹理绘制函数
void DrawTexture(Texture2D texture, int posX, int posY, Color tint);                                                          // 绘制纹理(整数坐标)
void DrawTextureV(Texture2D texture, Vector2 position, Color tint);                                                           // 向量版纹理绘制
void DrawTextureEx(Texture2D texture, Vector2 position, float rotation, float scale, Color tint);                             // 扩展参数纹理绘制(旋转/缩放)
void DrawTextureRec(Texture2D texture, Rectangle source, Vector2 position, Color tint);                                       // 绘制纹理指定区域
void DrawTexturePro(Texture2D texture, Rectangle source, Rectangle dest, Vector2 origin, float rotation, Color tint);         // 高级参数纹理绘制(支持旋转/原点)
void DrawTextureNPatch(Texture2D texture, NPatchInfo nPatchInfo, Rectangle dest, Vector2 origin, float rotation, Color tint); // 绘制支持九宫格拉伸的纹理

// 颜色/像素相关函数
bool ColorIsEqual(Color col1, Color col2);                    // 检查两个颜色是否相等
Color Fade(Color color, float alpha);                         // 应用alpha值到颜色(0.0f到1.0f)
int ColorToInt(Color color);                                  // 将颜色转为十六进制值(0xRRGGBBAA)
Vector4 ColorNormalize(Color color);                          // 将颜色归一化为[0..1]范围
Color ColorFromNormalized(Vector4 normalized);                // 从归一化值创建颜色
Vector3 ColorToHSV(Color color);                              // 转换颜色到HSV空间(色相0-360度，饱和度/明度0-1)
Color ColorFromHSV(float hue, float saturation, float value); // 从HSV值创建颜色
Color ColorTint(Color color, Color tint);                     // 颜色叠加色调
Color ColorBrightness(Color color, float factor);             // 调整颜色亮度(-1.0f到1.0f)
Color ColorContrast(Color color, float contrast);             // 调整颜色对比度(-1.0f到1.0f)
Color ColorAlpha(Color color, float alpha);                   // 设置颜色透明度
Color ColorAlphaBlend(Color dst, Color src, Color tint);      // 源颜色与目标颜色alpha混合
Color ColorLerp(Color color1, Color color2, float factor);    // 颜色线性插值(插值因子0.0f-1.0f)
Color GetColor(unsigned int hexValue);                        // 从十六进制值获取颜色
Color GetPixelColor(void *srcPtr, int format);                // 从指定格式的像素指针获取颜色
void SetPixelColor(void *dstPtr, Color color, int format);    // 将颜色设置到指定格式的像素指针
int GetPixelDataSize(int width, int height, int format);      // 计算指定格式的像素数据大小(字节)

// 模块：rtext ---------------------------------------------------------------------------

// 字体加载/卸载函数
Font GetFontDefault(void);                                                                                                                     // 获取默认字体
Font LoadFont(const char *fileName);                                                                                                           // 从文件加载字体到GPU显存(VRAM)
Font LoadFontEx(const char *fileName, int fontSize, int *codepoints, int codepointCount);                                                      // 扩展参数加载字体（codepoints传NULL且codepointCount为0时加载默认字符集，字号单位为像素高度）
Font LoadFontFromImage(Image image, Color key, int firstChar);                                                                                 // 从图像加载字体(XNA风格)
Font LoadFontFromMemory(const char *fileType, const unsigned char *fileData, int dataSize, int fontSize, int *codepoints, int codepointCount); // 从内存缓冲区加载字体(fileType指扩展名如.ttf)
bool IsFontValid(Font font);                                                                                                                   // 检查字体是否有效（仅检查字体数据，不检查GPU纹理）
GlyphInfo *LoadFontData(const unsigned char *fileData, int dataSize, int fontSize, int *codepoints, int codepointCount, int type);             // 加载字体数据供后续使用
Image GenImageFontAtlas(const GlyphInfo *glyphs, Rectangle *glyphRecs, int glyphCount, int fontSize, int padding, int packMethod);         // 根据字形信息生成字体图集
void UnloadFontData(GlyphInfo *glyphs, int glyphCount);                                                                                        // 卸载字体字形数据(RAM)
void UnloadFont(Font font);                                                                                                                    // 从GPU显存卸载字体
bool ExportFontAsCode(Font font, const char *fileName);                                                                                        // 将字体导出为代码文件，成功返回true

// 文本绘制函数
void DrawFPS(int posX, int posY);                                                                                                           // 绘制当前FPS
void DrawText(const char *text, int posX, int posY, int fontSize, Color color);                                                             // 使用默认字体绘制文本
void DrawTextEx(Font font, const char *text, Vector2 position, float fontSize, float spacing, Color tint);                                  // 使用字体和额外参数绘制文本
void DrawTextPro(Font font, const char *text, Vector2 position, Vector2 origin, float rotation, float fontSize, float spacing, Color tint); // 使用字体和高级参数绘制文本（支持旋转）
void DrawTextCodepoint(Font font, int codepoint, Vector2 position, float fontSize, Color tint);                                             // 绘制单个字符（码位）
void DrawTextCodepoints(Font font, const int *codepoints, int codepointCount, Vector2 position, float fontSize, float spacing, Color tint); // 绘制多个字符（码位）

// 字体信息函数
void SetTextLineSpacing(int spacing);                                              // 设置换行时的垂直行间距
int MeasureText(const char *text, int fontSize);                                   // 测量默认字体文本宽度
Vector2 MeasureTextEx(Font font, const char *text, float fontSize, float spacing); // 测量指定字体文本尺寸
int GetGlyphIndex(Font font, int codepoint);                                       // 获取字符码位对应的字形索引（未找到返回'?'索引）
GlyphInfo GetGlyphInfo(Font font, int codepoint);                                  // 获取字符码位的字形信息（未找到返回'?'信息）
Rectangle GetGlyphAtlasRec(Font font, int codepoint);                              // 获取字符码位在图集中的矩形区域（未找到返回'?'区域）

// 码位管理函数（Unicode字符）
char *LoadUTF8(const int *codepoints, int length);              // 从码位数组生成UTF-8编码文本
void UnloadUTF8(char *text);                                    // 卸载UTF-8编码文本
int *LoadCodepoints(const char *text, int *count);              // 从UTF-8文本加载所有码位（通过参数返回数量）
void UnloadCodepoints(int *codepoints);                         // 卸载码位数据
int GetCodepointCount(const char *text);                        // 获取UTF-8文本的码位总数
int GetCodepoint(const char *text, int *codepointSize);         // 获取当前码位（失败返回0x3f '?'）
int GetCodepointNext(const char *text, int *codepointSize);     // 获取下一个码位（失败返回0x3f '?'）
int GetCodepointPrevious(const char *text, int *codepointSize); // 获取前一个码位（失败返回0x3f '?'）
const char *CodepointToUTF8(int codepoint, int *utf8Size);      // 将码位编码为UTF-8字节数组（通过参数返回数组长度）

// 文本字符串管理函数（非UTF-8，仅字节字符）
// 注意：部分函数会分配内存，使用时需谨慎管理！
int TextCopy(char *dst, const char *src);                                     // 拷贝字符串，返回复制的字节数
bool TextIsEqual(const char *text1, const char *text2);                       // 检查字符串是否相等
unsigned int TextLength(const char *text);                                    // 获取文本长度（检测'\0'结尾）
const char *TextFormat(const char *text, ...);                                // 格式化文本（支持变量，类似sprintf风格）
const char *TextSubtext(const char *text, int position, int length);          // 截取子字符串
char *TextReplace(const char *text, const char *replace, const char *by);     // 替换文本内容（警告：必须释放内存！）
char *TextInsert(const char *text, const char *insert, int position);         // 插入文本到指定位置（警告：必须释放内存！）
const char *TextJoin(const char *textList, int count, const char *delimiter); // 用分隔符连接多个文本
const char *TextSplit(const char *text, char delimiter, int *count);          // 按分隔符分割文本
void TextAppend(char *text, const char *append, int *position);               // 追加文本到指定位置并移动光标
int TextFindIndex(const char *text, const char *find);                        // 查找文本首次出现位置
const char *TextToUpper(const char *text);                                    // 获取大写版本字符串
const char *TextToLower(const char *text);                                    // 获取小写版本字符串
const char *TextToPascal(const char *text);                                   // 转换为帕斯卡命名法
const char *TextToSnake(const char *text);                                    // 转换为蛇形命名法
const char *TextToCamel(const char *text);                                    // 转换为驼峰命名法

int TextToInteger(const char *text); // 将文本转为整数值（不支持负数）
float TextToFloat(const char *text); // 将文本转为浮点值（不支持负数）

// 模块：Rmodels --------------------------------------------------------------------------

// 基本3D几何形状绘制函数
void DrawLine3D(Vector3 startPos, Vector3 endPos, Color color);                                                         // 绘制3D空间直线
void DrawPoint3D(Vector3 position, Color color);                                                                        // 绘制3D空间点（实际显示为小线段）
void DrawCircle3D(Vector3 center, float radius, Vector3 rotationAxis, float rotationAngle, Color color);                // 绘制3D空间圆形（可旋转）
void DrawTriangle3D(Vector3 v1, Vector3 v2, Vector3 v3, Color color);                                                   // 绘制3D实心三角形（顶点逆时针顺序）
void DrawTriangleStrip3D(const Vector3 *points, int pointCount, Color color);                                           // 绘制3D三角形带
void DrawCube(Vector3 position, float width, float height, float length, Color color);                                  // 绘制立方体
void DrawCubeV(Vector3 position, Vector3 size, Color color);                                                            // 向量版立方体绘制
void DrawCubeWires(Vector3 position, float width, float height, float length, Color color);                             // 绘制立方体线框
void DrawCubeWiresV(Vector3 position, Vector3 size, Color color);                                                       // 向量版立方体线框
void DrawSphere(Vector3 centerPos, float radius, Color color);                                                          // 绘制球体
void DrawSphereEx(Vector3 centerPos, float radius, int rings, int slices, Color color);                                 // 扩展参数球体绘制（经线/纬线细分）
void DrawSphereWires(Vector3 centerPos, float radius, int rings, int slices, Color color);                              // 绘制球体线框
void DrawCylinder(Vector3 position, float radiusTop, float radiusBottom, float height, int slices, Color color);        // 绘制圆柱/圆锥
void DrawCylinderEx(Vector3 startPos, Vector3 endPos, float startRadius, float endRadius, int sides, Color color);      // 绘制自定义端点圆柱
void DrawCylinderWires(Vector3 position, float radiusTop, float radiusBottom, float height, int slices, Color color);   // 绘制圆柱线框
void DrawCylinderWiresEx(Vector3 startPos, Vector3 endPos, float startRadius, float endRadius, int sides, Color color); // 绘制自定义端点圆柱线框
void DrawCapsule(Vector3 startPos, Vector3 endPos, float radius, int slices, int rings, Color color);                   // 绘制胶囊体（球帽中心位于起点和终点）
void DrawCapsuleWires(Vector3 startPos, Vector3 endPos, float radius, int slices, int rings, Color color);              // 绘制胶囊体线框
void DrawPlane(Vector3 centerPos, Vector2 size, Color color);                                                           // 绘制XZ平面
void DrawRay(Ray ray, Color color);                                                                                     // 绘制射线
void DrawGrid(int slices, float spacing);                                                                               // 绘制坐标网格（中心在原点）

//------------------------------------------------------------------------------------
// 3D模型加载与绘制函数（模块：models）
//------------------------------------------------------------------------------------

// 模型管理函数
Model LoadModel(const char *fileName);        // 从文件加载模型（包含网格和材质）
Model LoadModelFromMesh(Mesh mesh);           // 从生成的网格加载模型（使用默认材质）
bool IsModelValid(Model model);               // 检查模型是否有效（已加载到GPU）
void UnloadModel(Model model);                // 卸载模型（包含网格数据）
BoundingBox GetModelBoundingBox(Model model); // 计算模型包围盒（包含所有网格）

// 模型绘制函数
void DrawModel(Model model, Vector3 position, float scale, Color tint);                                                                                            // 绘制模型（带纹理）
void DrawModelEx(Model model, Vector3 position, Vector3 rotationAxis, float rotationAngle, Vector3 scale, Color tint);                                             // 扩展参数模型绘制
void DrawModelWires(Model model, Vector3 position, float scale, Color tint);                                                                                       // 绘制模型线框（带纹理）
void DrawModelWiresEx(Model model, Vector3 position, Vector3 rotationAxis, float rotationAngle, Vector3 scale, Color tint);                                        // 扩展参数线框绘制
void DrawModelPoints(Model model, Vector3 position, float scale, Color tint);                                                                                      // 绘制模型点云
void DrawModelPointsEx(Model model, Vector3 position, Vector3 rotationAxis, float rotationAngle, Vector3 scale, Color tint);                                       // 扩展参数点云绘制
void DrawBoundingBox(BoundingBox box, Color color);                                                                                                                // 绘制包围盒线框
void DrawBillboard(Camera camera, Texture2D texture, Vector3 position, float scale, Color tint);                                                                   // 绘制广告牌纹理
void DrawBillboardRec(Camera camera, Texture2D texture, Rectangle source, Vector3 position, Vector2 size, Color tint);                                             // 指定源矩形的广告牌绘制
void DrawBillboardPro(Camera camera, Texture2D texture, Rectangle source, Vector3 position, Vector3 up, Vector2 size, Vector2 origin, float rotation, Color tint); // 专业级广告牌绘制（支持旋转）

// 网格管理函数
void UploadMesh(Mesh *mesh, bool dynamic);                                                     // 上传网格数据到GPU（生成VAO/VBO）
void UpdateMeshBuffer(Mesh mesh, int index, const void *data, int dataSize, int offset);       // 更新指定网格缓冲区数据
void UnloadMesh(Mesh mesh);                                                                    // 卸载网格数据（CPU/GPU）
void DrawMesh(Mesh mesh, Material material, Matrix transform);                                 // 绘制网格（带材质和变换矩阵）
void DrawMeshInstanced(Mesh mesh, Material material, const Matrix *transforms, int instances); // 批量绘制网格实例
BoundingBox GetMeshBoundingBox(Mesh mesh);                                                     // 计算网格包围盒
void GenMeshTangents(Mesh *mesh);                                                              // 生成网格切线数据
bool ExportMesh(Mesh mesh, const char *fileName);                                              // 导出网格数据到文件
bool ExportMeshAsCode(Mesh mesh, const char *fileName);                                        // 将网格导出为C代码（顶点属性数组）

// 网格生成函数
Mesh GenMeshPoly(int sides, float radius);                          // 生成多边形网格（参数：边数，半径）
Mesh GenMeshPlane(float width, float length, int resX, int resZ);   // 生成平面网格（带细分）
Mesh GenMeshCube(float width, float height, float length);          // 生成立方体网格
Mesh GenMeshSphere(float radius, int rings, int slices);            // 生成标准球体网格
Mesh GenMeshHemiSphere(float radius, int rings, int slices);        // 生成半球网格
Mesh GenMeshCylinder(float radius, float height, int slices);       // 生成圆柱网格
Mesh GenMeshCone(float radius, float height, int slices);           // 生成圆锥网格
Mesh GenMeshTorus(float radius, float size, int radSeg, int sides); // 生成圆环网格
Mesh GenMeshKnot(float radius, float size, int radSeg, int sides);  // 生成纽结网格
Mesh GenMeshHeightmap(Image heightmap, Vector3 size);               // 从高度图生成地形网格
Mesh GenMeshCubicmap(Image cubicmap, Vector3 cubeSize);             // 从体素图生成立方体地图

// 材质管理函数
Material *LoadMaterials(const char *fileName, int *materialCount);           // 从模型文件加载材质数组
Material LoadMaterialDefault(void);                                          // 加载默认材质（支持漫反射/高光/法线贴图）
bool IsMaterialValid(Material material);                                     // 检查材质有效性（已加载着色器和纹理）
void UnloadMaterial(Material material);                                      // 卸载材质数据
void SetMaterialTexture(Material *material, int mapType, Texture2D texture); // 设置材质贴图类型（漫反射/高光等）
void SetModelMeshMaterial(Model *model, int meshId, int materialId);         // 为指定网格设置材质

// 动画管理函数
ModelAnimation *LoadModelAnimations(const char *fileName, int *animCount);   // 加载模型动画数据
void UpdateModelAnimation(Model model, ModelAnimation anim, int frame);      // 更新模型动画姿态（CPU端）
void UpdateModelAnimationBones(Model model, ModelAnimation anim, int frame); // 更新骨骼矩阵（GPU蒙皮）
void UnloadModelAnimation(ModelAnimation anim);                              // 卸载单个动画
void UnloadModelAnimations(ModelAnimation *animations, int animCount);       // 卸载动画数组
bool IsModelAnimationValid(Model model, ModelAnimation anim);                // 检查动画与模型骨骼匹配性

// 碰撞检测函数
bool CheckCollisionSpheres(Vector3 center1, float radius1, Vector3 center2, float radius2); // 检测球体间碰撞
bool CheckCollisionBoxes(BoundingBox box1, BoundingBox box2);                               // 检测包围盒间碰撞
bool CheckCollisionBoxSphere(BoundingBox box, Vector3 center, float radius);                // 检测包围盒与球体碰撞
RayCollision GetRayCollisionSphere(Ray ray, Vector3 center, float radius);                  // 获取射线与球体碰撞信息
RayCollision GetRayCollisionBox(Ray ray, BoundingBox box);                                  // 获取射线与包围盒碰撞信息
RayCollision GetRayCollisionMesh(Ray ray, Mesh mesh, Matrix transform);                     // 获取射线与网格碰撞信息（需变换矩阵）
RayCollision GetRayCollisionTriangle(Ray ray, Vector3 p1, Vector3 p2, Vector3 p3);          // 获取射线与三角形碰撞信息
RayCollision GetRayCollisionQuad(Ray ray, Vector3 p1, Vector3 p2, Vector3 p3, Vector3 p4);  // 获取射线与四边形碰撞信息

// 模块：rAudio ----------------------------------------------

typedef void (*AudioCallback)(void *bufferData, unsigned int frames);

// 音频设备管理函数
void InitAudioDevice(void);         // 初始化音频设备和上下文
void CloseAudioDevice(void);        // 关闭音频设备和上下文
bool IsAudioDeviceReady(void);      // 检查音频设备是否初始化成功
void SetMasterVolume(float volume); // 设置主音量（监听器音量）
float GetMasterVolume(void);        // 获取主音量值

// Wave/Sound 加载/卸载函数
Wave LoadWave(const char *fileName);                                                        // 从文件加载Wave数据
Wave LoadWaveFromMemory(const char *fileType, const unsigned char *fileData, int dataSize); // 从内存加载Wave（fileType为扩展名，如.wav）
bool IsWaveValid(Wave wave);                                                                // 检查Wave数据有效性
Sound LoadSound(const char *fileName);                                                      // 从文件加载声音
Sound LoadSoundFromWave(Wave wave);                                                         // 从Wave数据加载声音
Sound LoadSoundAlias(Sound source);                                                         // 创建共享样本数据的声音别名
bool IsSoundValid(Sound sound);                                                             // 检查声音有效性
void UpdateSound(Sound sound, const void *data, int sampleCount);                           // 更新声音缓冲区数据
void UnloadWave(Wave wave);                                                                 // 卸载Wave数据
void UnloadSound(Sound sound);                                                              // 卸载声音
void UnloadSoundAlias(Sound alias);                                                         // 卸载声音别名（不释放样本数据）
bool ExportWave(Wave wave, const char *fileName);                                           // 导出Wave数据到文件
bool ExportWaveAsCode(Wave wave, const char *fileName);                                     // 将Wave采样数据导出为C代码(.h)

// Wave/Sound 管理函数
void PlaySound(Sound sound);                                               // 播放声音
void StopSound(Sound sound);                                               // 停止播放声音
void PauseSound(Sound sound);                                              // 暂停声音
void ResumeSound(Sound sound);                                             // 恢复暂停的声音
bool IsSoundPlaying(Sound sound);                                          // 检查声音是否正在播放
void SetSoundVolume(Sound sound, float volume);                            // 设置声音音量（1.0为最大）
void SetSoundPitch(Sound sound, float pitch);                              // 设置声音音高（1.0为基础值）
void SetSoundPan(Sound sound, float pan);                                  // 设置声音声像（0.5为居中）
Wave WaveCopy(Wave wave);                                                  // 复制Wave数据
void WaveCrop(Wave *wave, int initFrame, int finalFrame);                  // 裁剪Wave到指定帧范围
void WaveFormat(Wave *wave, int sampleRate, int sampleSize, int channels); // 转换Wave格式
float *LoadWaveSamples(Wave wave);                                         // 加载Wave采样数据（返回32位浮点数组）
void UnloadWaveSamples(float *samples);                                    // 卸载Wave采样数据

// 音乐流管理函数
Music LoadMusicStream(const char *fileName);                                                    // 从文件加载音乐流
Music LoadMusicStreamFromMemory(const char *fileType, const unsigned char *data, int dataSize); // 从内存加载音乐流
bool IsMusicValid(Music music);                                                                 // 检查音乐流有效性
void UnloadMusicStream(Music music);                                                            // 卸载音乐流
void PlayMusicStream(Music music);                                                              // 开始播放音乐
bool IsMusicStreamPlaying(Music music);                                                         // 检查音乐是否正在播放
void UpdateMusicStream(Music music);                                                            // 更新音乐流缓冲区
void StopMusicStream(Music music);                                                              // 停止音乐播放
void PauseMusicStream(Music music);                                                             // 暂停音乐播放
void ResumeMusicStream(Music music);                                                            // 恢复暂停的音乐
void SeekMusicStream(Music music, float position);                                              // 跳转到音乐指定位置（秒）
void SetMusicVolume(Music music, float volume);                                                 // 设置音乐音量
void SetMusicPitch(Music music, float pitch);                                                   // 设置音乐音高
void SetMusicPan(Music music, float pan);                                                       // 设置音乐声像
float GetMusicTimeLength(Music music);                                                          // 获取音乐总时长（秒）
float GetMusicTimePlayed(Music music);                                                          // 获取当前播放时间（秒）

// 音频流管理函数
AudioStream LoadAudioStream(unsigned int sampleRate, unsigned int sampleSize, unsigned int channels); // 加载音频流（用于原始PCM数据流）
bool IsAudioStreamValid(AudioStream stream);                                                          // 检查音频流有效性
void UnloadAudioStream(AudioStream stream);                                                           // 卸载音频流
void UpdateAudioStream(AudioStream stream, const void *data, int frameCount);                         // 更新音频流缓冲区数据
bool IsAudioStreamProcessed(AudioStream stream);                                                      // 检查音频流缓冲区是否需要填充
void PlayAudioStream(AudioStream stream);                                                             // 播放音频流
void PauseAudioStream(AudioStream stream);                                                            // 暂停音频流
void ResumeAudioStream(AudioStream stream);                                                           // 恢复音频流
bool IsAudioStreamPlaying(AudioStream stream);                                                        // 检查音频流是否正在播放
void StopAudioStream(AudioStream stream);                                                             // 停止音频流
void SetAudioStreamVolume(AudioStream stream, float volume);                                          // 设置音频流音量
void SetAudioStreamPitch(AudioStream stream, float pitch);                                            // 设置音频流音高
void SetAudioStreamPan(AudioStream stream, float pan);                                                // 设置音频流声像
void SetAudioStreamBufferSizeDefault(int size);                                                       // 设置新音频流的默认缓冲区大小
void SetAudioStreamCallback(AudioStream stream, AudioCallback callback);                              // 设置音频流回调函数（用于请求新数据）

void AttachAudioStreamProcessor(AudioStream stream, AudioCallback processor); // 附加音频流处理器（接收float格式采样）
void DetachAudioStreamProcessor(AudioStream stream, AudioCallback processor); // 分离音频流处理器

void AttachAudioMixedProcessor(AudioCallback processor); // 附加全局音频混合处理器
void DetachAudioMixedProcessor(AudioCallback processor); // 分离全局音频混合处理器