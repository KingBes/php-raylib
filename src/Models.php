<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib;

/**
 * Models类
 */
class Models extends Base
{

    //### 基本3D几何形状绘制函数

    /**
     * 绘制3D空间直线
     *
     * @param \FFI\CData $startPos Vector3对象
     * @param \FFI\CData $endPos Vector3对象
     * @param \FFI\CData $color Color对象
     * @return void
     */
    public static function drawLine3D(\FFI\CData $startPos, \FFI\CData $endPos, \FFI\CData $color): void
    {
        self::ffi()->DrawLine3D($startPos, $endPos, $color);
    }

    /**
     * 绘制3D空间点（实际显示为小线段）
     *
     * @param \FFI\CData $position Vector3对象
     * @param \FFI\CData $color Color对象
     * @return void
     */
    public static function drawPoint3D(\FFI\CData $position, \FFI\CData $color): void
    {
        self::ffi()->DrawPoint3D($position, $color);
    }

    /**
     * 绘制3D空间圆形（可旋转）
     *
     * @param \FFI\CData $center Vector3对象
     * @param float $radius 半径
     * @param \FFI\CData $rotationAxis Vector3对象
     * @param float $rotationAngle 旋转角度
     * @param \FFI\CData $color Color对象
     * @return void
     */
    public static function drawCircle3D(\FFI\CData $center, float $radius, \FFI\CData $rotationAxis, float $rotationAngle, \FFI\CData $color): void
    {
        self::ffi()->DrawCircle3D($center, $radius, $rotationAxis, $rotationAngle, $color);
    }

    /**
     * 绘制3D实心三角形（顶点逆时针顺序）
     *
     * @param \FFI\CData $v1 Vector3对象
     * @param \FFI\CData $v2 Vector3对象
     * @param \FFI\CData $v3 Vector3对象
     * @param \FFI\CData $color Color对象
     * @return void
     */
    public static function drawTriangle3D(\FFI\CData $v1, \FFI\CData $v2, \FFI\CData $v3, \FFI\CData $color): void
    {
        self::ffi()->DrawTriangle3D($v1, $v2, $v3, $color);
    }

    /**
     * 绘制3D三角形带
     *
     * @param array $points Vector3对象数组
     * @param int $pointCount 点的数量
     * @param \FFI\CData $color Color对象
     * @return void
     */
    public static function drawTriangleStrip3D(array $points, int $pointCount, \FFI\CData $color): void
    {
        // 将PHP数组转换为C指针
        $cPoints = self::ffi()->new("Vector3[$pointCount]");
        foreach ($points as $i => $p) {
            $cPoints[$i] = $p;
        }
        self::ffi()->DrawTriangleStrip3D($cPoints, $pointCount, $color);
    }

    /**
     * 绘制立方体
     *
     * @param \FFI\CData $position Vector3对象
     * @param float $width 宽度
     * @param float $height 高度
     * @param float $length 长度
     * @param \FFI\CData $color Color对象
     * @return void
     */
    public static function drawCube(\FFI\CData $position, float $width, float $height, float $length, \FFI\CData $color): void
    {
        self::ffi()->DrawCube($position, $width, $height, $length, $color);
    }

    /**
     * 向量版立方体绘制
     *
     * @param \FFI\CData $position Vector3对象
     * @param \FFI\CData $size Vector3对象
     * @param \FFI\CData $color Color对象
     * @return void
     */
    public static function drawCubeV(\FFI\CData $position, \FFI\CData $size, \FFI\CData $color): void
    {
        self::ffi()->DrawCubeV($position, $size, $color);
    }

    /**
     * 绘制立方体线框
     *
     * @param \FFI\CData $position Vector3对象
     * @param float $width 宽度
     * @param float $height 高度
     * @param float $length 长度
     * @param \FFI\CData $color Color对象
     * @return void
     */
    public static function drawCubeWires(\FFI\CData $position, float $width, float $height, float $length, \FFI\CData $color): void
    {
        self::ffi()->DrawCubeWires($position, $width, $height, $length, $color);
    }

    /**
     * 向量版立方体线框
     *
     * @param \FFI\CData $position Vector3对象
     * @param \FFI\CData $size Vector3对象
     * @param \FFI\CData $color Color对象
     * @return void
     */
    public static function drawCubeWiresV(\FFI\CData $position, \FFI\CData $size, \FFI\CData $color): void
    {
        self::ffi()->DrawCubeWiresV($position, $size, $color);
    }

    /**
     * 绘制球体
     *
     * @param \FFI\CData $centerPos Vector3对象
     * @param float $radius 半径
     * @param \FFI\CData $color Color对象
     * @return void
     */
    public static function drawSphere(\FFI\CData $centerPos, float $radius, \FFI\CData $color): void
    {
        self::ffi()->DrawSphere($centerPos, $radius, $color);
    }

    /**
     * 扩展参数球体绘制（经线/纬线细分）
     *
     * @param \FFI\CData $centerPos Vector3对象
     * @param float $radius 半径
     * @param int $rings 经线数
     * @param int $slices 纬线数
     * @param \FFI\CData $color Color对象
     * @return void
     */
    public static function drawSphereEx(\FFI\CData $centerPos, float $radius, int $rings, int $slices, \FFI\CData $color): void
    {
        self::ffi()->DrawSphereEx($centerPos, $radius, $rings, $slices, $color);
    }

    /**
     * 绘制球体线框
     *
     * @param \FFI\CData $centerPos Vector3对象
     * @param float $radius 半径
     * @param int $rings 经线数
     * @param int $slices 纬线数
     * @param \FFI\CData $color Color对象
     * @return void
     */
    public static function drawSphereWires(\FFI\CData $centerPos, float $radius, int $rings, int $slices, \FFI\CData $color): void
    {
        self::ffi()->DrawSphereWires($centerPos, $radius, $rings, $slices, $color);
    }

    /**
     * 绘制圆柱/圆锥
     *
     * @param \FFI\CData $position Vector3对象
     * @param float $radiusTop 顶部半径
     * @param float $radiusBottom 底部半径
     * @param float $height 高度
     * @param int $slices 切片数
     * @param \FFI\CData $color Color对象
     * @return void
     */
    public static function drawCylinder(\FFI\CData $position, float $radiusTop, float $radiusBottom, float $height, int $slices, \FFI\CData $color): void
    {
        self::ffi()->DrawCylinder($position, $radiusTop, $radiusBottom, $height, $slices, $color);
    }

    /**
     * 绘制自定义端点圆柱
     *
     * @param \FFI\CData $startPos 起始位置
     * @param \FFI\CData $endPos 结束位置
     * @param float $startRadius 起始半径
     * @param float $endRadius 结束半径
     * @param int $sides 边数
     * @param \FFI\CData $color Color对象
     * @return void
     */
    public static function drawCylinderEx(\FFI\CData $startPos, \FFI\CData $endPos, float $startRadius, float $endRadius, int $sides, \FFI\CData $color): void
    {
        self::ffi()->DrawCylinderEx($startPos, $endPos, $startRadius, $endRadius, $sides, $color);
    }

    /**
     * 绘制圆柱线框
     *
     * @param \FFI\CData $position Vector3对象
     * @param float $radiusTop 顶部半径
     * @param float $radiusBottom 底部半径
     * @param float $height 高度
     * @param int $slices 切片数
     * @param \FFI\CData $color Color对象
     * @return void
     */
    public static function drawCylinderWires(\FFI\CData $position, float $radiusTop, float $radiusBottom, float $height, int $slices, \FFI\CData $color): void
    {
        self::ffi()->DrawCylinderWires($position, $radiusTop, $radiusBottom, $height, $slices, $color);
    }

    /**
     * 绘制自定义端点圆柱线框
     *
     * @param \FFI\CData $startPos 起始位置
     * @param \FFI\CData $endPos 结束位置
     * @param float $startRadius 起始半径
     * @param float $endRadius 结束半径
     * @param int $sides 边数
     * @param \FFI\CData $color Color对象
     * @return void
     */
    public static function drawCylinderWiresEx(\FFI\CData $startPos, \FFI\CData $endPos, float $startRadius, float $endRadius, int $sides, \FFI\CData $color): void
    {
        self::ffi()->DrawCylinderWiresEx($startPos, $endPos, $startRadius, $endRadius, $sides, $color);
    }

    /**
     * 绘制胶囊体（球帽中心位于起点和终点）
     *
     * @param \FFI\CData $startPos Vector3对象，起始位置
     * @param \FFI\CData $endPos Vector3对象，结束位置
     * @param float $radius 半径
     * @param int $slices 切片数
     * @param int $rings 环数
     * @param \FFI\CData $color Color对象
     * @return void
     */
    public static function drawCapsule(\FFI\CData $startPos, \FFI\CData $endPos, float $radius, int $slices, int $rings, \FFI\CData $color): void
    {
        self::ffi()->DrawCapsule($startPos, $endPos, $radius, $slices, $rings, $color);
    }

    /**
     * 绘制胶囊体线框
     *
     * @param \FFI\CData $startPos Vector3对象，起始位置
     * @param \FFI\CData $endPos Vector3对象，结束位置
     * @param float $radius 半径
     * @param int $slices 切片数
     * @param int $rings 环数
     * @param \FFI\CData $color Color对象
     * @return void
     */
    public static function drawCapsuleWires(\FFI\CData $startPos, \FFI\CData $endPos, float $radius, int $slices, int $rings, \FFI\CData $color): void
    {
        self::ffi()->DrawCapsuleWires($startPos, $endPos, $radius, $slices, $rings, $color);
    }

    /**
     * 绘制XZ平面
     *
     * @param \FFI\CData $centerPos Vector3对象，中心位置
     * @param \FFI\CData $size Vector2对象，尺寸
     * @param \FFI\CData $color Color对象
     * @return void
     */
    public static function drawPlane(\FFI\CData $centerPos, \FFI\CData $size, \FFI\CData $color): void
    {
        self::ffi()->DrawPlane($centerPos, $size, $color);
    }

    /**
     * 绘制射线
     *
     * @param \FFI\CData $ray Ray对象
     * @param \FFI\CData $color Color对象
     * @return void
     */
    public static function drawRay(\FFI\CData $ray, \FFI\CData $color): void
    {
        self::ffi()->DrawRay($ray, $color);
    }

    /**
     * 绘制坐标网格（中心在原点）
     *
     * @param int $slices 切片数
     * @param float $spacing 间距
     * @return void
     */
    public static function drawGrid(int $slices, float $spacing): void
    {
        self::ffi()->DrawGrid($slices, $spacing);
    }

    //### 模型管理函数

    /**
     * 从文件加载模型（包含网格和材质）
     *
     * @param string $fileName 文件名
     * @return \FFI\CData Model对象
     */
    public static function loadModel(string $fileName): \FFI\CData
    {
        return self::ffi()->LoadModel($fileName);
    }

    /**
     * 从生成的网格加载模型（使用默认材质）
     *
     * @param \FFI\CData $mesh Mesh对象
     * @return \FFI\CData Model对象
     */
    public static function loadModelFromMesh(\FFI\CData $mesh): \FFI\CData
    {
        return self::ffi()->LoadModelFromMesh($mesh);
    }

    /**
     * 检查模型是否有效（已加载到GPU）
     *
     * @param \FFI\CData $model Model对象
     * @return bool 是否有效
     */
    public static function isModelValid(\FFI\CData $model): bool
    {
        return self::ffi()->IsModelValid($model);
    }

    /**
     * 卸载模型（包含网格数据）
     *
     * @param \FFI\CData $model Model对象
     * @return void
     */
    public static function unloadModel(\FFI\CData $model): void
    {
        self::ffi()->UnloadModel($model);
    }

    /**
     * 计算模型包围盒（包含所有网格）
     *
     * @param \FFI\CData $model Model对象
     * @return \FFI\CData BoundingBox对象
     */
    public static function getModelBoundingBox(\FFI\CData $model): \FFI\CData
    {
        return self::ffi()->GetModelBoundingBox($model);
    }

    /**
     * 绘制模型（带纹理）
     *
     * @param \FFI\CData $model Model对象
     * @param \FFI\CData $position Vector3对象，位置
     * @param float $scale 缩放比例
     * @param \FFI\CData $tint Color对象，颜色
     * @return void
     */
    public static function drawModel(\FFI\CData $model, \FFI\CData $position, float $scale, \FFI\CData $tint): void
    {
        self::ffi()->DrawModel($model, $position, $scale, $tint);
    }

    /**
     * 扩展参数模型绘制
     *
     * @param \FFI\CData $model Model对象
     * @param \FFI\CData $position Vector3对象，位置
     * @param \FFI\CData $rotationAxis Vector3对象，旋转轴
     * @param float $rotationAngle 旋转角度
     * @param \FFI\CData $scale Vector3对象，缩放比例
     * @param \FFI\CData $tint Color对象，颜色
     * @return void
     */
    public static function drawModelEx(\FFI\CData $model, \FFI\CData $position, \FFI\CData $rotationAxis, float $rotationAngle, \FFI\CData $scale, \FFI\CData $tint): void
    {
        self::ffi()->DrawModelEx($model, $position, $rotationAxis, $rotationAngle, $scale, $tint);
    }

    /**
     * 绘制模型线框（带纹理）
     *
     * @param \FFI\CData $model Model对象
     * @param \FFI\CData $position Vector3对象，位置
     * @param float $scale 缩放比例
     * @param \FFI\CData $tint Color对象，颜色
     * @return void
     */
    public static function drawModelWires(\FFI\CData $model, \FFI\CData $position, float $scale, \FFI\CData $tint): void
    {
        self::ffi()->DrawModelWires($model, $position, $scale, $tint);
    }

    /**
     * 扩展参数线框绘制
     *
     * @param \FFI\CData $model Model对象
     * @param \FFI\CData $position Vector3对象，位置
     * @param \FFI\CData $rotationAxis Vector3对象，旋转轴
     * @param float $rotationAngle 旋转角度
     * @param \FFI\CData $scale Vector3对象，缩放比例
     * @param \FFI\CData $tint Color对象，颜色
     * @return void
     */
    public static function drawModelWiresEx(\FFI\CData $model, \FFI\CData $position, \FFI\CData $rotationAxis, float $rotationAngle, \FFI\CData $scale, \FFI\CData $tint): void
    {
        self::ffi()->DrawModelWiresEx($model, $position, $rotationAxis, $rotationAngle, $scale, $tint);
    }

    /**
     * 绘制模型点云
     *
     * @param \FFI\CData $model Model对象
     * @param \FFI\CData $position Vector3对象，位置
     * @param float $scale 缩放比例
     * @param \FFI\CData $tint Color对象，颜色
     * @return void
     */
    public static function drawModelPoints(\FFI\CData $model, \FFI\CData $position, float $scale, \FFI\CData $tint): void
    {
        self::ffi()->DrawModelPoints($model, $position, $scale, $tint);
    }

    /**
     * 扩展参数点云绘制
     *
     * @param \FFI\CData $model Model对象
     * @param \FFI\CData $position Vector3对象，位置
     * @param \FFI\CData $rotationAxis Vector3对象，旋转轴
     * @param float $rotationAngle 旋转角度
     * @param \FFI\CData $scale Vector3对象，缩放比例
     * @param \FFI\CData $tint Color对象，颜色
     * @return void
     */
    public static function drawModelPointsEx(\FFI\CData $model, \FFI\CData $position, \FFI\CData $rotationAxis, float $rotationAngle, \FFI\CData $scale, \FFI\CData $tint): void
    {
        self::ffi()->DrawModelPointsEx($model, $position, $rotationAxis, $rotationAngle, $scale, $tint);
    }

    /**
     * 绘制包围盒线框
     *
     * @param \FFI\CData $box BoundingBox对象
     * @param \FFI\CData $color Color对象，颜色
     * @return void
     */
    public static function drawBoundingBox(\FFI\CData $box, \FFI\CData $color): void
    {
        self::ffi()->DrawBoundingBox($box, $color);
    }

    /**
     * 绘制广告牌纹理
     *
     * @param \FFI\CData $camera Camera对象
     * @param \FFI\CData $texture Texture2D对象
     * @param \FFI\CData $position Vector3对象，位置
     * @param float $scale 缩放比例
     * @param \FFI\CData $tint Color对象，颜色
     * @return void
     */
    public static function drawBillboard(\FFI\CData $camera, \FFI\CData $texture, \FFI\CData $position, float $scale, \FFI\CData $tint): void
    {
        self::ffi()->DrawBillboard($camera, $texture, $position, $scale, $tint);
    }

    /**
     * 指定源矩形的广告牌绘制
     *
     * @param \FFI\CData $camera Camera对象
     * @param \FFI\CData $texture Texture2D对象
     * @param \FFI\CData $source Rectangle对象，源矩形
     * @param \FFI\CData $position Vector3对象，位置
     * @param \FFI\CData $size Vector2对象，尺寸
     * @param \FFI\CData $tint Color对象，颜色
     * @return void
     */
    public static function drawBillboardRec(\FFI\CData $camera, \FFI\CData $texture, \FFI\CData $source, \FFI\CData $position, \FFI\CData $size, \FFI\CData $tint): void
    {
        self::ffi()->DrawBillboardRec($camera, $texture, $source, $position, $size, $tint);
    }

    /**
     * 专业级广告牌绘制（支持旋转）
     *
     * @param \FFI\CData $camera Camera对象
     * @param \FFI\CData $texture Texture2D对象
     * @param \FFI\CData $source Rectangle对象，源矩形
     * @param \FFI\CData $position Vector3对象，位置
     * @param \FFI\CData $up Vector3对象，向上向量
     * @param \FFI\CData $size Vector2对象，尺寸
     * @param \FFI\CData $origin Vector2对象，原点
     * @param float $rotation 旋转角度
     * @param \FFI\CData $tint Color对象，颜色
     * @return void
     */
    public static function drawBillboardPro(\FFI\CData $camera, \FFI\CData $texture, \FFI\CData $source, \FFI\CData $position, \FFI\CData $up, \FFI\CData $size, \FFI\CData $origin, float $rotation, \FFI\CData $tint): void
    {
        self::ffi()->DrawBillboardPro($camera, $texture, $source, $position, $up, $size, $origin, $rotation, $tint);
    }

    //### 网格管理函数

    /**
     * 上传网格数据到GPU（生成VAO/VBO）
     *
     * @param \FFI\CData $mesh Mesh对象引用
     * @param bool $dynamic 是否动态
     * @return void
     */
    public static function uploadMesh(\FFI\CData &$mesh, bool $dynamic): void
    {
        self::ffi()->UploadMesh($mesh, $dynamic);
    }

    /**
     * 更新指定网格缓冲区数据
     *
     * @param \FFI\CData $mesh Mesh对象
     * @param int $index 缓冲区索引
     * @param \FFI\CData $data 数据指针
     * @param int $dataSize 数据大小
     * @param int $offset 偏移量
     * @return void
     */
    public static function updateMeshBuffer(\FFI\CData $mesh, int $index, \FFI\CData $data, int $dataSize, int $offset): void
    {
        self::ffi()->UpdateMeshBuffer($mesh, $index, $data, $dataSize, $offset);
    }

    /**
     * 卸载网格数据（CPU/GPU）
     *
     * @param \FFI\CData $mesh Mesh对象
     * @return void
     */
    public static function unloadMesh(\FFI\CData $mesh): void
    {
        self::ffi()->UnloadMesh($mesh);
    }

    /**
     * 绘制网格（带材质和变换矩阵）
     *
     * @param \FFI\CData $mesh Mesh对象
     * @param \FFI\CData $material Material对象
     * @param \FFI\CData $transform Matrix对象，变换矩阵
     * @return void
     */
    public static function drawMesh(\FFI\CData $mesh, \FFI\CData $material, \FFI\CData $transform): void
    {
        self::ffi()->DrawMesh($mesh, $material, $transform);
    }

    /**
     * 批量绘制网格实例
     *
     * @param \FFI\CData $mesh Mesh对象
     * @param \FFI\CData $material Material对象
     * @param \FFI\CData $transforms Matrix数组，变换矩阵列表
     * @param int $instances 实例数量
     * @return void
     */
    public static function drawMeshInstanced(\FFI\CData $mesh, \FFI\CData $material, \FFI\CData $transforms, int $instances): void
    {
        self::ffi()->DrawMeshInstanced($mesh, $material, $transforms, $instances);
    }

    /**
     * 计算网格包围盒
     *
     * @param \FFI\CData $mesh Mesh对象
     * @return \FFI\CData BoundingBox对象
     */
    public static function getMeshBoundingBox(\FFI\CData $mesh): \FFI\CData
    {
        return self::ffi()->GetMeshBoundingBox($mesh);
    }

    /**
     * 生成网格切线数据
     *
     * @param \FFI\CData $mesh Mesh对象引用
     * @return void
     */
    public static function genMeshTangents(\FFI\CData &$mesh): void
    {
        self::ffi()->GenMeshTangents($mesh);
    }

    /**
     * 导出网格数据到文件
     *
     * @param \FFI\CData $mesh Mesh对象
     * @param string $fileName 文件名
     * @return bool 是否成功
     */
    public static function exportMesh(\FFI\CData $mesh, string $fileName): bool
    {
        return self::ffi()->ExportMesh($mesh, $fileName);
    }

    /**
     * 将网格导出为C代码（顶点属性数组）
     *
     * @param \FFI\CData $mesh Mesh对象
     * @param string $fileName 文件名
     * @return bool 是否成功
     */
    public static function exportMeshAsCode(\FFI\CData $mesh, string $fileName): bool
    {
        return self::ffi()->ExportMeshAsCode($mesh, $fileName);
    }

    //### 网格生成函数

    /**
     * 生成多边形网格（参数：边数，半径）
     *
     * @param int $sides 边数
     * @param float $radius 半径
     * @return \FFI\CData Mesh对象
     */
    public static function genMeshPoly(int $sides, float $radius): \FFI\CData
    {
        return self::ffi()->GenMeshPoly($sides, $radius);
    }

    /**
     * 生成平面网格（带细分）
     *
     * @param float $width 宽度
     * @param float $length 长度
     * @param int $resX X轴细分数量
     * @param int $resZ Z轴细分数量
     * @return \FFI\CData Mesh对象
     */
    public static function genMeshPlane(float $width, float $length, int $resX, int $resZ): \FFI\CData
    {
        return self::ffi()->GenMeshPlane($width, $length, $resX, $resZ);
    }

    /**
     * 生成立方体网格
     *
     * @param float $width 宽度
     * @param float $height 高度
     * @param float $length 长度
     * @return \FFI\CData Mesh对象
     */
    public static function genMeshCube(float $width, float $height, float $length): \FFI\CData
    {
        return self::ffi()->GenMeshCube($width, $height, $length);
    }

    /**
     * 生成标准球体网格
     *
     * @param float $radius 半径
     * @param int $rings 环数
     * @param int $slices 切片数
     * @return \FFI\CData Mesh对象
     */
    public static function genMeshSphere(float $radius, int $rings, int $slices): \FFI\CData
    {
        return self::ffi()->GenMeshSphere($radius, $rings, $slices);
    }

    /**
     * 生成半球网格
     *
     * @param float $radius 半径
     * @param int $rings 环数
     * @param int $slices 切片数
     * @return \FFI\CData Mesh对象
     */
    public static function genMeshHemiSphere(float $radius, int $rings, int $slices): \FFI\CData
    {
        return self::ffi()->GenMeshHemiSphere($radius, $rings, $slices);
    }

    /**
     * 生成圆柱网格
     *
     * @param float $radius 半径
     * @param float $height 高度
     * @param int $slices 切片数
     * @return \FFI\CData Mesh对象
     */
    public static function genMeshCylinder(float $radius, float $height, int $slices): \FFI\CData
    {
        return self::ffi()->GenMeshCylinder($radius, $height, $slices);
    }

    /**
     * 生成圆锥网格
     *
     * @param float $radius 半径
     * @param float $height 高度
     * @param int $slices 切片数
     * @return \FFI\CData Mesh对象
     */
    public static function genMeshCone(float $radius, float $height, int $slices): \FFI\CData
    {
        return self::ffi()->GenMeshCone($radius, $height, $slices);
    }

    /**
     * 生成圆环网格
     *
     * @param float $radius 半径
     * @param float $size 尺寸
     * @param int $radSeg 径向分割数
     * @param int $sides 边数
     * @return \FFI\CData Mesh对象
     */
    public static function genMeshTorus(float $radius, float $size, int $radSeg, int $sides): \FFI\CData
    {
        return self::ffi()->GenMeshTorus($radius, $size, $radSeg, $sides);
    }

    /**
     * 生成纽结网格
     *
     * @param float $radius 半径
     * @param float $size 尺寸
     * @param int $radSeg 径向分割数
     * @param int $sides 边数
     * @return \FFI\CData Mesh对象
     */
    public static function genMeshKnot(float $radius, float $size, int $radSeg, int $sides): \FFI\CData
    {
        return self::ffi()->GenMeshKnot($radius, $size, $radSeg, $sides);
    }

    /**
     * 从高度图生成地形网格
     *
     * @param \FFI\CData $heightmap Image对象，高度图
     * @param \FFI\CData $size Vector3对象，尺寸
     * @return \FFI\CData Mesh对象
     */
    public static function genMeshHeightmap(\FFI\CData $heightmap, \FFI\CData $size): \FFI\CData
    {
        return self::ffi()->GenMeshHeightmap($heightmap, $size);
    }

    /**
     * 从体素图生成立方体地图
     *
     * @param \FFI\CData $cubicmap Image对象，体素图
     * @param \FFI\CData $cubeSize Vector3对象，立方体大小
     * @return \FFI\CData Mesh对象
     */
    public static function genMeshCubicmap(\FFI\CData $cubicmap, \FFI\CData $cubeSize): \FFI\CData
    {
        return self::ffi()->GenMeshCubicmap($cubicmap, $cubeSize);
    }

    //### 材质管理函数

    /**
     * 从模型文件加载材质数组
     *
     * @param string $fileName 文件名
     * @param int &$materialCount 材质数量引用
     * @return \FFI\CData Material对象数组
     */
    public static function loadMaterials(string $fileName, int &$materialCount): \FFI\CData
    {
        return self::ffi()->LoadMaterials($fileName, \FFI::addr(\FFI::new('int', false, true)));
    }

    /**
     * 加载默认材质（支持漫反射/高光/法线贴图）
     *
     * @return \FFI\CData Material对象
     */
    public static function loadMaterialDefault(): \FFI\CData
    {
        return self::ffi()->LoadMaterialDefault();
    }

    /**
     * 检查材质有效性（已加载着色器和纹理）
     *
     * @param \FFI\CData $material Material对象
     * @return bool 是否有效
     */
    public static function isMaterialValid(\FFI\CData $material): bool
    {
        return self::ffi()->IsMaterialValid($material);
    }

    /**
     * 卸载材质数据
     *
     * @param \FFI\CData $material Material对象
     * @return void
     */
    public static function unloadMaterial(\FFI\CData $material): void
    {
        self::ffi()->UnloadMaterial($material);
    }

    /**
     * 设置材质贴图类型（漫反射/高光等）
     *
     * @param \FFI\CData $material Material对象引用
     * @param int $mapType 贴图类型
     * @param \FFI\CData $texture Texture2D对象
     * @return void
     */
    public static function setMaterialTexture(\FFI\CData &$material, int $mapType, \FFI\CData $texture): void
    {
        self::ffi()->SetMaterialTexture($material, $mapType, $texture);
    }

    /**
     * 为指定网格设置材质
     *
     * @param \FFI\CData $model Model对象引用
     * @param int $meshId 网格ID
     * @param int $materialId 材质ID
     * @return void
     */
    public static function setModelMeshMaterial(\FFI\CData &$model, int $meshId, int $materialId): void
    {
        self::ffi()->SetModelMeshMaterial($model, $meshId, $materialId);
    }

    //### 动画管理函数

    /**
     * 加载模型动画数据
     *
     * @param string $fileName 文件名
     * @param int &$animCount 动画数量引用
     * @return \FFI\CData ModelAnimation对象数组
     */
    public static function loadModelAnimations(string $fileName, int &$animCount): \FFI\CData
    {
        return self::ffi()->LoadModelAnimations($fileName, \FFI::addr(\FFI::new('int', false, true)));
    }

    /**
     * 更新模型动画姿态（CPU端）
     *
     * @param \FFI\CData $model Model对象
     * @param \FFI\CData $anim ModelAnimation对象
     * @param int $frame 帧号
     * @return void
     */
    public static function updateModelAnimation(\FFI\CData $model, \FFI\CData $anim, int $frame): void
    {
        self::ffi()->UpdateModelAnimation($model, $anim, $frame);
    }

    /**
     * 更新骨骼矩阵（GPU蒙皮）
     *
     * @param \FFI\CData $model Model对象
     * @param \FFI\CData $anim ModelAnimation对象
     * @param int $frame 帧号
     * @return void
     */
    public static function updateModelAnimationBones(\FFI\CData $model, \FFI\CData $anim, int $frame): void
    {
        self::ffi()->UpdateModelAnimationBones($model, $anim, $frame);
    }

    /**
     * 卸载单个动画
     *
     * @param \FFI\CData $anim ModelAnimation对象
     * @return void
     */
    public static function unloadModelAnimation(\FFI\CData $anim): void
    {
        self::ffi()->UnloadModelAnimation($anim);
    }

    /**
     * 卸载动画数组
     *
     * @param \FFI\CData $animations ModelAnimation对象数组
     * @param int $animCount 动画数量
     * @return void
     */
    public static function unloadModelAnimations(\FFI\CData $animations, int $animCount): void
    {
        self::ffi()->UnloadModelAnimations($animations, $animCount);
    }

    /**
     * 检查动画与模型骨骼匹配性
     *
     * @param \FFI\CData $model Model对象
     * @param \FFI\CData $anim ModelAnimation对象
     * @return bool 是否匹配
     */
    public static function isModelAnimationValid(\FFI\CData $model, \FFI\CData $anim): bool
    {
        return self::ffi()->IsModelAnimationValid($model, $anim);
    }

    //### 碰撞检测函数

    /**
     * 检测球体间碰撞
     *
     * @param \FFI\CData $center1 Vector3对象，第一个球体中心
     * @param float $radius1 第一个球体半径
     * @param \FFI\CData $center/XMLSchema$center2 Vector3对象，第二个球体中心
     * @param float $radius2 第二个球体半径
     * @return bool 是否碰撞
     */
    public static function checkCollisionSpheres(\FFI\CData $center1, float $radius1, \FFI\CData $center2, float $radius2): bool
    {
        return self::ffi()->CheckCollisionSpheres($center1, $radius1, $center2, $radius2);
    }

    /**
     * 检测包围盒间碰撞
     *
     * @param \FFI\CData $box1 BoundingBox对象，第一个包围盒
     * @param \FFI\CData $box2 BoundingBox对象，第二个包围盒
     * @return bool 是否碰撞
     */
    public static function checkCollisionBoxes(\FFI\CData $box1, \FFI\CData $box2): bool
    {
        return self::ffi()->CheckCollisionBoxes($box1, $box2);
    }

    /**
     * 检测包围盒与球体碰撞
     *
     * @param \FFI\CData $box BoundingBox对象，包围盒
     * @param \FFI\CData $center Vector3对象，球体中心
     * @param float $radius 球体半径
     * @return bool 是否碰撞
     */
    public static function checkCollisionBoxSphere(\FFI\CData $box, \FFI\CData $center, float $radius): bool
    {
        return self::ffi()->CheckCollisionBoxSphere($box, $center, $radius);
    }

    /**
     * 获取射线与球体碰撞信息
     *
     * @param \FFI\CData $ray Ray对象，射线
     * @param \FFI\CData $center Vector3对象，球体中心
     * @param float $radius 球体半径
     * @return \FFI\CData RayCollision对象
     */
    public static function getRayCollisionSphere(\FFI\CData $ray, \FFI\CData $center, float $radius): \FFI\CData
    {
        return self::ffi()->GetRayCollisionSphere($ray, $center, $radius);
    }

    /**
     * 获取射线与包围盒碰撞信息
     *
     * @param \FFI\CData $ray Ray对象，射线
     * @param \FFI\CData $box BoundingBox对象，包围盒
     * @return \FFI\CData RayCollision对象
     */
    public static function getRayCollisionBox(\FFI\CData $ray, \FFI\CData $box): \FFI\CData
    {
        return self::ffi()->GetRayCollisionBox($ray, $box);
    }

    /**
     * 获取射线与网格碰撞信息（需变换矩阵）
     *
     * @param \FFI\CData $ray Ray对象，射线
     * @param \FFI\CData $mesh Mesh对象，网格
     * @param \FFI\CData $transform Matrix对象，变换矩阵
     * @return \FFI\CData RayCollision对象
     */
    public static function getRayCollisionMesh(\FFI\CData $ray, \FFI\CData $mesh, \FFI\CData $transform): \FFI\CData
    {
        return self::ffi()->GetRayCollisionMesh($ray, $mesh, $transform);
    }

    /**
     * 获取射线与三角形碰撞信息
     *
     * @param \FFI\CData $ray Ray对象，射线
     * @param \FFI\CData $p1 Vector3对象，三角形顶点1
     * @param \FFI\CData $p2 Vector3对象，三角形顶点2
     * @param \FFI\CData $p3 Vector3对象，三角形顶点3
     * @return \FFI\CData RayCollision对象
     */
    public static function getRayCollisionTriangle(\FFI\CData $ray, \FFI\CData $p1, \FFI\CData $p2, \FFI\CData $p3): \FFI\CData
    {
        return self::ffi()->GetRayCollisionTriangle($ray, $p1, $p2, $p3);
    }

    /**
     * 获取射线与四边形碰撞信息
     *
     * @param \FFI\CData $ray Ray对象，射线
     * @param \FFI\CData $p1 Vector3对象，四边形顶点1
     * @param \FFI\CData $p2 Vector3对象，四边形顶点2
     * @param \FFI\CData $p3 Vector3对象，四边形顶点3
     * @param \FFI\CData $p4 Vector3对象，四边形顶点4
     * @return \FFI\CData RayCollision对象
     */
    public static function getRayCollisionQuad(\FFI\CData $ray, \FFI\CData $p1, \FFI\CData $p2, \FFI\CData $p3, \FFI\CData $p4): \FFI\CData
    {
        return self::ffi()->GetRayCollisionQuad($ray, $p1, $p2, $p3, $p4);
    }
}
