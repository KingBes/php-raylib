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

// ------文本绘制函数-------------------------------------
