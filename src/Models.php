<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib;

use Kingbes\Raylib\Utils\Vector2;
use Kingbes\Raylib\Utils\Vector3;
use Kingbes\Raylib\Utils\Color;
use Kingbes\Raylib\Utils\Ray;
use Kingbes\Raylib\Utils\Mesh;
use Kingbes\Raylib\Utils\Model;
use Kingbes\Raylib\Utils\BoundingBox;
use Kingbes\Raylib\Utils\Camera3D;
use Kingbes\Raylib\Utils\Texture;
use Kingbes\Raylib\Utils\Matrix;
use Kingbes\Raylib\Utils\Material;
use Kingbes\Raylib\Utils\Image;
use Kingbes\Raylib\Utils\ModelAnimation;
use Kingbes\Raylib\Utils\RayCollision;

/**
 * Models类
 */
class Models extends Base
{

    //### 基本3D几何形状绘制函数

    /**
     * 绘制3D空间直线
     *
     * @param Vector3 $startPos Vector3对象
     * @param Vector3 $endPos Vector3对象
     * @param Color $color Color对象
     * @return void
     */
    public static function drawLine3D(Vector3 $startPos, Vector3 $endPos, Color $color): void
    {
        self::ffi()->DrawLine3D($startPos->struct(), $endPos->struct(), $color->struct());
    }

    /**
     * 绘制3D空间点（实际显示为小线段）
     *
     * @param Vector3 $position Vector3对象
     * @param Color $color Color对象
     * @return void
     */
    public static function drawPoint3D(Vector3 $position, Color $color): void
    {
        self::ffi()->DrawPoint3D($position->struct(), $color->struct());
    }

    /**
     * 绘制3D空间圆形（可旋转）
     *
     * @param Vector3 $center Vector3对象
     * @param float $radius 半径
     * @param Vector3 $rotationAxis Vector3对象
     * @param float $rotationAngle 旋转角度
     * @param Color $color Color对象
     * @return void
     */
    public static function drawCircle3D(Vector3 $center, float $radius, Vector3 $rotationAxis, float $rotationAngle, Color $color): void
    {
        self::ffi()->DrawCircle3D($center->struct(), $radius, $rotationAxis->struct(), $rotationAngle, $color->struct());
    }

    /**
     * 绘制3D实心三角形（顶点逆时针顺序）
     *
     * @param Vector3 $v1 Vector3对象
     * @param Vector3 $v2 Vector3对象
     * @param Vector3 $v3 Vector3对象
     * @param Color $color Color对象
     * @return void
     */
    public static function drawTriangle3D(Vector3 $v1, Vector3 $v2, Vector3 $v3, Color $color): void
    {
        self::ffi()->DrawTriangle3D($v1->struct(), $v2->struct(), $v3->struct(), $color->struct());
    }

    /**
     * 绘制3D三角形带
     *
     * @param array<int,Vector3> $points Vector3对象数组
     * @param int $pointCount 点的数量
     * @param Color $color Color对象
     * @return void
     */
    public static function drawTriangleStrip3D(array $points, int $pointCount, Color $color): void
    {
        // 将PHP数组转换为C指针
        $cPoints = self::ffi()->new("Vector3[$pointCount]");
        foreach ($points as $i => $p) {
            $cPoints[$i] = $p->struct();
        }
        self::ffi()->DrawTriangleStrip3D(self::ffi()->cast("Vector3*", $cPoints), $pointCount, $color->struct());
    }

    /**
     * 绘制立方体
     *
     * @param Vector3 $position Vector3对象
     * @param float $width 宽度
     * @param float $height 高度
     * @param float $length 长度
     * @param Color $color Color对象
     * @return void
     */
    public static function drawCube(Vector3 $position, float $width, float $height, float $length, Color $color): void
    {
        self::ffi()->DrawCube($position->struct(), $width, $height, $length, $color->struct());
    }

    /**
     * 向量版立方体绘制
     *
     * @param Vector3 $position Vector3对象
     * @param Vector3 $size Vector3对象
     * @param Color $color Color对象
     * @return void
     */
    public static function drawCubeV(Vector3 $position, Vector3 $size, Color $color): void
    {
        self::ffi()->DrawCubeV($position->struct(), $size->struct(), $color->struct());
    }

    /**
     * 绘制立方体线框
     *
     * @param Vector3 $position Vector3对象
     * @param float $width 宽度
     * @param float $height 高度
     * @param float $length 长度
     * @param Color $color Color对象
     * @return void
     */
    public static function drawCubeWires(Vector3 $position, float $width, float $height, float $length, Color $color): void
    {
        self::ffi()->DrawCubeWires($position->struct(), $width, $height, $length, $color->struct());
    }

    /**
     * 向量版立方体线框
     *
     * @param Vector3 $position Vector3对象
     * @param Vector3 $size Vector3对象
     * @param Color $color Color对象
     * @return void
     */
    public static function drawCubeWiresV(Vector3 $position, Vector3 $size, Color $color): void
    {
        self::ffi()->DrawCubeWiresV($position->struct(), $size->struct(), $color->struct());
    }

    /**
     * 绘制球体
     *
     * @param Vector3 $centerPos Vector3对象
     * @param float $radius 半径
     * @param Color $color Color对象
     * @return void
     */
    public static function drawSphere(Vector3 $centerPos, float $radius, Color $color): void
    {
        self::ffi()->DrawSphere($centerPos->struct(), $radius, $color->struct());
    }

    /**
     * 扩展参数球体绘制（经线/纬线细分）
     *
     * @param Vector3 $centerPos Vector3对象
     * @param float $radius 半径
     * @param int $rings 经线数
     * @param int $slices 纬线数
     * @param Color $color Color对象
     * @return void
     */
    public static function drawSphereEx(Vector3 $centerPos, float $radius, int $rings, int $slices, Color $color): void
    {
        self::ffi()->DrawSphereEx($centerPos->struct(), $radius, $rings, $slices, $color->struct());
    }

    /**
     * 绘制球体线框
     *
     * @param Vector3 $centerPos Vector3对象
     * @param float $radius 半径
     * @param int $rings 经线数
     * @param int $slices 纬线数
     * @param Color $color Color对象
     * @return void
     */
    public static function drawSphereWires(Vector3 $centerPos, float $radius, int $rings, int $slices, Color $color): void
    {
        self::ffi()->DrawSphereWires($centerPos->struct(), $radius, $rings, $slices, $color->struct());
    }

    /**
     * 绘制圆柱/圆锥
     *
     * @param Vector3 $position Vector3对象
     * @param float $radiusTop 顶部半径
     * @param float $radiusBottom 底部半径
     * @param float $height 高度
     * @param int $slices 切片数
     * @param Color $color Color对象
     * @return void
     */
    public static function drawCylinder(Vector3 $position, float $radiusTop, float $radiusBottom, float $height, int $slices, Color $color): void
    {
        self::ffi()->DrawCylinder($position->struct(), $radiusTop, $radiusBottom, $height, $slices, $color->struct());
    }

    /**
     * 绘制自定义端点圆柱
     *
     * @param Vector3 $startPos 起始位置
     * @param Vector3 $endPos 结束位置
     * @param float $startRadius 起始半径
     * @param float $endRadius 结束半径
     * @param int $sides 边数
     * @param Color $color Color对象
     * @return void
     */
    public static function drawCylinderEx(Vector3 $startPos, Vector3 $endPos, float $startRadius, float $endRadius, int $sides, Color $color): void
    {
        self::ffi()->DrawCylinderEx($startPos->struct(), $endPos->struct(), $startRadius, $endRadius, $sides, $color->struct());
    }

    /**
     * 绘制圆柱线框
     *
     * @param Vector3 $position Vector3对象
     * @param float $radiusTop 顶部半径
     * @param float $radiusBottom 底部半径
     * @param float $height 高度
     * @param int $slices 切片数
     * @param Color $color Color对象
     * @return void
     */
    public static function drawCylinderWires(Vector3 $position, float $radiusTop, float $radiusBottom, float $height, int $slices, Color $color): void
    {
        self::ffi()->DrawCylinderWires($position->struct(), $radiusTop, $radiusBottom, $height, $slices, $color->struct());
    }

    /**
     * 绘制自定义端点圆柱线框
     *
     * @param Vector3 $startPos 起始位置
     * @param Vector3 $endPos 结束位置
     * @param float $startRadius 起始半径
     * @param float $endRadius 结束半径
     * @param int $sides 边数
     * @param Color $color Color对象
     * @return void
     */
    public static function drawCylinderWiresEx(Vector3 $startPos, Vector3 $endPos, float $startRadius, float $endRadius, int $sides, Color $color): void
    {
        self::ffi()->DrawCylinderWiresEx($startPos->struct(), $endPos->struct(), $startRadius, $endRadius, $sides, $color->struct());
    }

    /**
     * 绘制胶囊体（球帽中心位于起点和终点）
     *
     * @param Vector3 $startPos Vector3对象，起始位置
     * @param Vector3 $endPos Vector3对象，结束位置
     * @param float $radius 半径
     * @param int $slices 切片数
     * @param int $rings 环数
     * @param Color $color Color对象
     * @return void
     */
    public static function drawCapsule(Vector3 $startPos, Vector3 $endPos, float $radius, int $slices, int $rings, Color $color): void
    {
        self::ffi()->DrawCapsule($startPos->struct(), $endPos->struct(), $radius, $slices, $rings, $color->struct());
    }

    /**
     * 绘制胶囊体线框
     *
     * @param Vector3 $startPos Vector3对象，起始位置
     * @param Vector3 $endPos Vector3对象，结束位置
     * @param float $radius 半径
     * @param int $slices 切片数
     * @param int $rings 环数
     * @param Color $color Color对象
     * @return void
     */
    public static function drawCapsuleWires(Vector3 $startPos, Vector3 $endPos, float $radius, int $slices, int $rings, Color $color): void
    {
        self::ffi()->DrawCapsuleWires($startPos->struct(), $endPos->struct(), $radius, $slices, $rings, $color->struct());
    }

    /**
     * 绘制XZ平面
     *
     * @param Vector3 $centerPos Vector3对象，中心位置
     * @param Vector2 $size Vector2对象，尺寸
     * @param Color $color Color对象
     * @return void
     */
    public static function drawPlane(Vector3 $centerPos, Vector2 $size, Color $color): void
    {
        self::ffi()->DrawPlane($centerPos->struct(), $size->struct(), $color->struct());
    }

    /**
     * 绘制射线
     *
     * @param Ray $ray Ray对象
     * @param Color $color Color对象
     * @return void
     */
    public static function drawRay(Ray $ray, Color $color): void
    {
        self::ffi()->DrawRay($ray->struct(), $color->struct());
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
     * @return Model Model对象
     */
    public static function loadModel(string $fileName): Model
    {
        return new Model(self::ffi()->LoadModel($fileName));
    }

    /**
     * 从生成的网格加载模型（使用默认材质）
     *
     * @param Mesh $mesh Mesh对象
     * @return Model Model对象
     */
    public static function loadModelFromMesh(Mesh $mesh): Model
    {
        return new Model(self::ffi()->LoadModelFromMesh($mesh->struct()));
    }

    /**
     * 检查模型是否有效（已加载到GPU）
     *
     * @param Model $model Model对象
     * @return bool 是否有效
     */
    public static function isModelValid(Model $model): bool
    {
        return self::ffi()->IsModelValid($model->struct());
    }

    /**
     * 卸载模型（包含网格数据）
     *
     * @param Model $model Model对象
     * @return void
     */
    public static function unloadModel(Model $model): void
    {
        self::ffi()->UnloadModel($model->struct());
    }

    /**
     * 计算模型包围盒（包含所有网格）
     *
     * @param Model $model Model对象
     * @return BoundingBox BoundingBox对象
     */
    public static function getModelBoundingBox(Model $model): BoundingBox
    {
        return new BoundingBox(self::ffi()->GetModelBoundingBox($model->struct()));
    }

    /**
     * 绘制模型（带纹理）
     *
     * @param Model $model Model对象
     * @param Vector3 $position Vector3对象，位置
     * @param float $scale 缩放比例
     * @param Color $tint Color对象，颜色
     * @return void
     */
    public static function drawModel(Model $model, Vector3 $position, float $scale, Color $tint): void
    {
        self::ffi()->DrawModel($model->struct(), $position->struct(), $scale, $tint->struct());
    }

    /**
     * 扩展参数模型绘制
     *
     * @param Model $model Model对象
     * @param Vector3 $position Vector3对象，位置
     * @param Vector3 $rotationAxis Vector3对象，旋转轴
     * @param float $rotationAngle 旋转角度
     * @param Vector3 $scale Vector3对象，缩放比例
     * @param Color $tint Color对象，颜色
     * @return void
     */
    public static function drawModelEx(Model $model, Vector3 $position, Vector3 $rotationAxis, float $rotationAngle, Vector3 $scale, Color $tint): void
    {
        self::ffi()->DrawModelEx($model->struct(), $position->struct(), $rotationAxis->struct(), $rotationAngle, $scale->struct(), $tint->struct());
    }

    /**
     * 绘制模型线框（带纹理）
     *
     * @param Model $model Model对象
     * @param Vector3 $position Vector3对象，位置
     * @param float $scale 缩放比例
     * @param Color $tint Color对象，颜色
     * @return void
     */
    public static function drawModelWires(Model $model, Vector3 $position, float $scale, Color $tint): void
    {
        self::ffi()->DrawModelWires($model->struct(), $position->struct(), $scale, $tint->struct());
    }

    /**
     * 扩展参数线框绘制
     *
     * @param Model $model Model对象
     * @param Vector3 $position Vector3对象，位置
     * @param Vector3 $rotationAxis Vector3对象，旋转轴
     * @param float $rotationAngle 旋转角度
     * @param Vector3 $scale Vector3对象，缩放比例
     * @param Color $tint Color对象，颜色
     * @return void
     */
    public static function drawModelWiresEx(Model $model, Vector3 $position, Vector3 $rotationAxis, float $rotationAngle, Vector3 $scale, Color $tint): void
    {
        self::ffi()->DrawModelWiresEx($model->struct(), $position->struct(), $rotationAxis->struct(), $rotationAngle, $scale->struct(), $tint->struct());
    }

    /**
     * 绘制模型点云
     *
     * @param Model $model Model对象
     * @param Vector3 $position Vector3对象，位置
     * @param float $scale 缩放比例
     * @param Color $tint Color对象，颜色
     * @return void
     */
    public static function drawModelPoints(Model $model, Vector3 $position, float $scale, Color $tint): void
    {
        self::ffi()->DrawModelPoints($model->struct(), $position->struct(), $scale, $tint->struct());
    }

    /**
     * 扩展参数点云绘制
     *
     * @param Model $model Model对象
     * @param Vector3 $position Vector3对象，位置
     * @param Vector3 $rotationAxis Vector3对象，旋转轴
     * @param float $rotationAngle 旋转角度
     * @param Vector3 $scale Vector3对象，缩放比例
     * @param Color $tint Color对象，颜色
     * @return void
     */
    public static function drawModelPointsEx(Model $model, Vector3 $position, Vector3 $rotationAxis, float $rotationAngle, Vector3 $scale, Color $tint): void
    {
        self::ffi()->DrawModelPointsEx($model->struct(), $position->struct(), $rotationAxis->struct(), $rotationAngle, $scale->struct(), $tint->struct());
    }

    /**
     * 绘制包围盒线框
     *
     * @param BoundingBox $box BoundingBox对象
     * @param Color $color Color对象，颜色
     * @return void
     */
    public static function drawBoundingBox(BoundingBox $box, Color $color): void
    {
        self::ffi()->DrawBoundingBox($box->struct(), $color->struct());
    }

    /**
     * 绘制广告牌纹理
     *
     * @param Camera3D $camera Camera3D对象
     * @param Texture2D $texture Texture2D对象
     * @param Vector3 $position Vector3对象，位置
     * @param float $scale 缩放比例
     * @param Color $tint Color对象，颜色
     * @return void
     */
    public static function drawBillboard(Camera3D $camera, Texture2D $texture, Vector3 $position, float $scale, Color $tint): void
    {
        self::ffi()->DrawBillboard($camera->struct(), $texture->struct(), $position->struct(), $scale, $tint->struct());
    }

    /**
     * 指定源矩形的广告牌绘制
     *
     * @param Camera3D $camera Camera3D对象
     * @param Texture2D $texture Texture2D对象
     * @param Rectangle $source Rectangle对象，源矩形
     * @param Vector3 $position Vector3对象，位置
     * @param Vector2 $size Vector2对象，尺寸
     * @param Color $tint Color对象，颜色
     * @return void
     */
    public static function drawBillboardRec(Camera3D $camera, Texture2D $texture, Rectangle $source, Vector3 $position, Vector2 $size, Color $tint): void
    {
        self::ffi()->DrawBillboardRec($camera->struct(), $texture->struct(), $source->struct(), $position->struct(), $size->struct(), $tint->struct());
    }

    /**
     * 专业级广告牌绘制（支持旋转）
     *
     * @param Camera3D $camera Camera3D对象
     * @param Texture $texture Texture2D对象
     * @param Rectangle $source Rectangle对象，源矩形
     * @param Vector3 $position Vector3对象，位置
     * @param Vector3 $up Vector3对象，向上向量
     * @param Vector2 $size Vector2对象，尺寸
     * @param Vector2 $origin Vector2对象，原点
     * @param float $rotation 旋转角度
     * @param Color $tint Color对象，颜色
     * @return void
     */
    public static function drawBillboardPro(Camera3D $camera, Texture $texture, Rectangle $source, Vector3 $position, Vector3 $up, Vector2 $size, Vector2 $origin, float $rotation, Color $tint): void
    {
        self::ffi()->DrawBillboardPro($camera->struct(), $texture->struct(), $source->struct(), $position->struct(), $up->struct(), $size->struct(), $origin->struct(), $rotation, $tint->struct());
    }

    //### 网格管理函数

    /**
     * 上传网格数据到GPU（生成VAO/VBO）
     *
     * @param Mesh $mesh Mesh对象
     * @param bool $dynamic 是否动态
     * @return void
     */
    public static function uploadMesh(Mesh $mesh, bool $dynamic): void
    {
        self::ffi()->UploadMesh($mesh->struct(), $dynamic);
    }

    /**
     * 更新指定网格缓冲区数据
     *
     * @param Mesh $mesh Mesh对象
     * @param int $index 缓冲区索引
     * @param \FFI\CData $data 数据指针
     * @param int $dataSize 数据大小
     * @param int $offset 偏移量
     * @return void
     */
    public static function updateMeshBuffer(Mesh $mesh, int $index, \FFI\CData $data, int $dataSize, int $offset): void
    {
        self::ffi()->UpdateMeshBuffer($mesh->struct(), $index, $data, $dataSize, $offset);
    }

    /**
     * 卸载网格数据（CPU/GPU）
     *
     * @param Mesh $mesh Mesh对象
     * @return void
     */
    public static function unloadMesh(Mesh $mesh): void
    {
        self::ffi()->UnloadMesh($mesh->struct());
    }

    /**
     * 绘制网格（带材质和变换矩阵）
     *
     * @param Mesh $mesh Mesh对象
     * @param Material $material Material对象
     * @param Matrix $transform Matrix对象，变换矩阵
     * @return void
     */
    public static function drawMesh(Mesh $mesh, Material $material, Matrix $transform): void
    {
        self::ffi()->DrawMesh($mesh->struct(), $material->struct(), $transform->struct());
    }

    /**
     * 批量绘制网格实例
     *
     * @param Mesh $mesh Mesh对象
     * @param Material $material Material对象
     * @param Matrix[] $transforms Matrix数组，变换矩阵列表
     * @param int $instances 实例数量
     * @return void
     */
    public static function drawMeshInstanced(Mesh $mesh, Material $material, array $transforms, int $instances): void
    {
        self::ffi()->DrawMeshInstanced($mesh->struct(), $material->struct(), $transforms, $instances);
    }

    /**
     * 计算网格包围盒
     *
     * @param Mesh $mesh Mesh对象
     * @return BoundingBox BoundingBox对象   
     */
    public static function getMeshBoundingBox(Mesh $mesh): BoundingBox
    {
        return self::ffi()->GetMeshBoundingBox($mesh->struct());
    }

    /**
     * 生成网格切线数据
     *
     * @param Mesh $mesh Mesh对象引用
     * @return void
     */
    public static function genMeshTangents(Mesh $mesh): void
    {
        self::ffi()->GenMeshTangents($mesh);
    }

    /**
     * 导出网格数据到文件
     *
     * @param Mesh $mesh Mesh对象
     * @param string $fileName 文件名
     * @return bool 是否成功
     */
    public static function exportMesh(Mesh $mesh, string $fileName): bool
    {
        return self::ffi()->ExportMesh($mesh->struct(), $fileName);
    }

    /**
     * 将网格导出为C代码（顶点属性数组）
     *
     * @param Mesh $mesh Mesh对象
     * @param string $fileName 文件名
     * @return bool 是否成功
     */
    public static function exportMeshAsCode(Mesh $mesh, string $fileName): bool
    {
        return self::ffi()->ExportMeshAsCode($mesh->struct(), $fileName);
    }

    //### 网格生成函数

    /**
     * 生成多边形网格（参数：边数，半径）
     *
     * @param int $sides 边数
     * @param float $radius 半径
     * @return Mesh Mesh对象
     */
    public static function genMeshPoly(int $sides, float $radius): Mesh
    {
        return new Mesh(self::ffi()->GenMeshPoly($sides, $radius));
    }

    /**
     * 生成平面网格（带细分）
     *
     * @param float $width 宽度
     * @param float $length 长度
     * @param int $resX X轴细分数量
     * @param int $resZ Z轴细分数量
     * @return Mesh Mesh对象
     */
    public static function genMeshPlane(float $width, float $length, int $resX, int $resZ): Mesh
    {
        return new Mesh(self::ffi()->GenMeshPlane($width, $length, $resX, $resZ));
    }

    /**
     * 生成立方体网格
     *
     * @param float $width 宽度
     * @param float $height 高度
     * @param float $length 长度
     * @return Mesh Mesh对象
     */
    public static function genMeshCube(float $width, float $height, float $length): Mesh
    {
        return new Mesh(self::ffi()->GenMeshCube($width, $height, $length));
    }

    /**
     * 生成标准球体网格
     *
     * @param float $radius 半径
     * @param int $rings 环数
     * @param int $slices 切片数
     * @return Mesh Mesh对象
     */
    public static function genMeshSphere(float $radius, int $rings, int $slices): Mesh
    {
        return new Mesh(self::ffi()->GenMeshSphere($radius, $rings, $slices));
    }

    /**
     * 生成半球网格
     *
     * @param float $radius 半径
     * @param int $rings 环数
     * @param int $slices 切片数
     * @return Mesh Mesh对象
     */
    public static function genMeshHemiSphere(float $radius, int $rings, int $slices): Mesh
    {
        return new Mesh(self::ffi()->GenMeshHemiSphere($radius, $rings, $slices));
    }

    /**
     * 生成圆柱网格
     *
     * @param float $radius 半径
     * @param float $height 高度
     * @param int $slices 切片数
     * @return Mesh Mesh对象
     */
    public static function genMeshCylinder(float $radius, float $height, int $slices): Mesh
    {
        return new Mesh(self::ffi()->GenMeshCylinder($radius, $height, $slices));
    }

    /**
     * 生成圆锥网格
     *
     * @param float $radius 半径
     * @param float $height 高度
     * @param int $slices 切片数
     * @return Mesh Mesh对象
     */
    public static function genMeshCone(float $radius, float $height, int $slices): Mesh
    {
        return new Mesh(self::ffi()->GenMeshCone($radius, $height, $slices));
    }

    /**
     * 生成圆环网格
     *
     * @param float $radius 半径
     * @param float $size 尺寸
     * @param int $radSeg 径向分割数
     * @param int $sides 边数
     * @return Mesh Mesh对象
     */
    public static function genMeshTorus(float $radius, float $size, int $radSeg, int $sides): Mesh
    {
        return new Mesh(self::ffi()->GenMeshTorus($radius, $size, $radSeg, $sides));
    }

    /**
     * 生成纽结网格
     *
     * @param float $radius 半径
     * @param float $size 尺寸
     * @param int $radSeg 径向分割数
     * @param int $sides 边数
     * @return Mesh Mesh对象
     */
    public static function genMeshKnot(float $radius, float $size, int $radSeg, int $sides): Mesh
    {
        return new Mesh(self::ffi()->GenMeshKnot($radius, $size, $radSeg, $sides));
    }

    /**
     * 从高度图生成地形网格
     *
     * @param Image $heightmap 高度图
     * @param Vector3 $size 尺寸
     * @return Mesh Mesh对象
     */
    public static function genMeshHeightmap(Image $heightmap, Vector3 $size): Mesh
    {
        return new Mesh(self::ffi()->GenMeshHeightmap($heightmap->struct(), $size->struct()));
    }

    /**
     * 从体素图生成立方体地图
     *
     * @param Image $cubicmap 体素图
     * @param Vector3 $cubeSize 立方体大小
     * @return Mesh Mesh对象
     */
    public static function genMeshCubicmap(Image $cubicmap, Vector3 $cubeSize): Mesh
    {
        return new Mesh(self::ffi()->GenMeshCubicmap($cubicmap->struct(), $cubeSize->struct()));
    }

    //### 材质管理函数

    /**
     * 从模型文件加载材质数组
     *
     * @param string $fileName 文件名
     * @param int &$materialCount 材质数量引用
     * @return Material[] Material对象数组
     */
    public static function loadMaterials(string $fileName, int &$materialCount): array
    {
        $materialCount = 0;
        $materials = self::ffi()->LoadMaterials($fileName, \FFI::addr(\FFI::new('int', false, true)));
        $materialCount = $materials[0];
        return array_map(fn($material) => new Material($material), array_slice($materials, 1));
    }

    /**
     * 加载默认材质（支持漫反射/高光/法线贴图）
     *
     * @return Material Material对象
     */
    public static function loadMaterialDefault(): Material
    {
        return new Material(self::ffi()->LoadMaterialDefault());
    }

    /**
     * 检查材质有效性（已加载着色器和纹理）
     *
     * @param Material $material Material对象
     * @return bool 是否有效
     */
    public static function isMaterialValid(Material $material): bool
    {
        return self::ffi()->IsMaterialValid($material->struct());
    }

    /**
     * 卸载材质数据
     *
     * @param Material $material Material对象
     * @return void
     */
    public static function unloadMaterial(Material $material): void
    {
        self::ffi()->UnloadMaterial($material->struct());
    }

    /**
     * 设置材质贴图类型（漫反射/高光等）
     *
     * @param Material $material Material对象引用
     * @param int $mapType 贴图类型
     * @param Texture2D $texture Texture2D对象
     * @return void
     */
    public static function setMaterialTexture(Material &$material, int $mapType, Texture2D $texture): void
    {
        self::ffi()->SetMaterialTexture($material->struct(), $mapType, $texture->struct());
    }

    /**
     * 为指定网格设置材质
     *
     * @param Model $model Model对象引用
     * @param int $meshId 网格ID
     * @param int $materialId 材质ID
     * @return void
     */
    public static function setModelMeshMaterial(Model &$model, int $meshId, int $materialId): void
    {
        self::ffi()->SetModelMeshMaterial($model->struct(), $meshId, $materialId);
    }

    //### 动画管理函数

    /**
     * 加载模型动画数据
     *
     * @param string $fileName 文件名
     * @param int &$animCount 动画数量引用
     * @return ModelAnimation[] ModelAnimation对象数组
     */
    public static function loadModelAnimations(string $fileName, int &$animCount): array
    {
        $animCount = 0;
        $animations = self::ffi()->LoadModelAnimations($fileName, \FFI::addr(\FFI::new('int', false, true)));
        $animCount = $animations[0];
        return array_map(fn($animation) => new ModelAnimation($animation), array_slice($animations, 1));
    }

    /**
     * 更新模型动画姿态（CPU端）
     *
     * @param Model $model Model对象
     * @param ModelAnimation $anim ModelAnimation对象
     * @param int $frame 帧号
     * @return void
     */
    public static function updateModelAnimation(Model &$model, ModelAnimation &$anim, int $frame): void
    {
        self::ffi()->UpdateModelAnimation($model->struct(), $anim->struct(), $frame);
    }

    /**
     * 更新骨骼矩阵（GPU蒙皮）
     *
     * @param Model $model Model对象
     * @param ModelAnimation $anim ModelAnimation对象
     * @param int $frame 帧号
     * @return void
     */
    public static function updateModelAnimationBones(Model &$model, ModelAnimation &$anim, int $frame): void
    {
        self::ffi()->UpdateModelAnimationBones($model->struct(), $anim->struct(), $frame);
    }

    /**
     * 卸载单个动画
     *
     * @param ModelAnimation $anim ModelAnimation对象
     * @return void
     */
    public static function unloadModelAnimation(ModelAnimation &$anim): void
    {
        self::ffi()->UnloadModelAnimation($anim->struct());
    }

    /**
     * 卸载动画数组
     *
     * @param ModelAnimation[] $animations ModelAnimation对象数组
     * @param int $animCount 动画数量
     * @return void
     */
    public static function unloadModelAnimations(array $animations, int $animCount): void
    {
        self::ffi()->UnloadModelAnimations(array_map(fn($animation) => $animation->struct(), $animations), $animCount);
    }

    /**
     * 检查动画与模型骨骼匹配性
     *
     * @param Model $model Model对象
     * @param ModelAnimation $anim ModelAnimation对象
     * @return bool 是否匹配
     */
    public static function isModelAnimationValid(Model &$model, ModelAnimation &$anim): bool
    {
        return self::ffi()->IsModelAnimationValid($model->struct(), $anim->struct());
    }

    //### 碰撞检测函数

    /**
     * 检测球体间碰撞
     *
     * @param Vector3 $center1 Vector3对象，第一个球体中心
     * @param float $radius1 第一个球体半径
     * @param Vector3 $center2 Vector3对象，第二个球体中心
     * @param float $radius2 第二个球体半径
     * @return bool 是否碰撞
     */
    public static function checkCollisionSpheres(Vector3 $center1, float $radius1, Vector3 $center2, float $radius2): bool
    {
        return self::ffi()->CheckCollisionSpheres($center1->struct(), $radius1, $center2->struct(), $radius2);
    }

    /**
     * 检测包围盒间碰撞
     *
     * @param BoundingBox $box1 BoundingBox对象，第一个包围盒
     * @param BoundingBox $box2 BoundingBox对象，第二个包围盒
     * @return bool 是否碰撞
     */
    public static function checkCollisionBoxes(BoundingBox $box1, BoundingBox $box2): bool
    {
        return self::ffi()->CheckCollisionBoxes($box1->struct(), $box2->struct());
    }

    /**
     * 检测包围盒与球体碰撞
     *
     * @param BoundingBox $box BoundingBox对象，包围盒
     * @param Vector3 $center Vector3对象，球体中心
     * @param float $radius 球体半径
     * @return bool 是否碰撞
     */
    public static function checkCollisionBoxSphere(BoundingBox $box, Vector3 $center, float $radius): bool
    {
        return self::ffi()->CheckCollisionBoxSphere($box->struct(), $center->struct(), $radius);
    }

    /**
     * 获取射线与球体碰撞信息
     *
     * @param Ray $ray Ray对象，射线
     * @param Vector3 $center Vector3对象，球体中心
     * @param float $radius 球体半径
     * @return RayCollision RayCollision对象
     */
    public static function getRayCollisionSphere(Ray $ray, Vector3 $center, float $radius): RayCollision
    {
        $res = self::ffi()->GetRayCollisionSphere($ray->struct(), $center->struct(), $radius);
        return new RayCollision(
            $res->hit,
            $res->distance,
            new Vector3($res->point->x, $res->point->y, $res->point->z),
            new Vector3($res->normal->x, $res->normal->y, $res->normal->z),
        );
    }

    /**
     * 获取射线与包围盒碰撞信息
     *
     * @param Ray $ray Ray对象，射线
     * @param BoundingBox $box BoundingBox对象，包围盒
     * @return RayCollision RayCollision对象
     */
    public static function getRayCollisionBox(Ray $ray, BoundingBox $box): RayCollision
    {
        $res = self::ffi()->GetRayCollisionBox($ray->struct(), $box->struct());
        return new RayCollision(
            $res->hit,
            $res->distance,
            new Vector3($res->point->x, $res->point->y, $res->point->z),
            new Vector3($res->normal->x, $res->normal->y, $res->normal->z),
        );
    }

    /**
     * 获取射线与网格碰撞信息（需变换矩阵）
     *
     * @param Ray $ray Ray对象，射线
     * @param Mesh $mesh Mesh对象，网格
     * @param Matrix $transform Matrix对象，变换矩阵
     * @return RayCollision RayCollision对象
     */
    public static function getRayCollisionMesh(Ray $ray, Mesh $mesh, Matrix $transform): RayCollision
    {
        $res = self::ffi()->GetRayCollisionMesh($ray->struct(), $mesh->struct(), $transform->struct());
        return new RayCollision(
            $res->hit,
            $res->distance,
            new Vector3($res->point->x, $res->point->y, $res->point->z),
            new Vector3($res->normal->x, $res->normal->y, $res->normal->z),
        );
    }

    /**
     * 获取射线与三角形碰撞信息
     *
     * @param Ray $ray Ray对象，射线
     * @param Vector3 $p1 Vector3对象，三角形顶点1
     * @param Vector3 $p2 Vector3对象，三角形顶点2
     * @param Vector3 $p3 Vector3对象，三角形顶点3
     * @return RayCollision RayCollision对象
     */
    public static function getRayCollisionTriangle(Ray $ray, Vector3 $p1, Vector3 $p2, Vector3 $p3): RayCollision
    {
        $res = self::ffi()->GetRayCollisionTriangle($ray->struct(), $p1->struct(), $p2->struct(), $p3->struct());
        return new RayCollision(
            $res->hit,
            $res->distance,
            new Vector3($res->point->x, $res->point->y, $res->point->z),
            new Vector3($res->normal->x, $res->normal->y, $res->normal->z),
        );
    }

    /**
     * 获取射线与四边形碰撞信息
     *
     * @param Ray $ray Ray对象，射线
     * @param Vector3 $p1 Vector3对象，四边形顶点1
     * @param Vector3 $p2 Vector3对象，四边形顶点2
     * @param Vector3 $p3 Vector3对象，四边形顶点3
     * @param Vector3 $p4 Vector3对象，四边形顶点4
     * @return RayCollision RayCollision对象
     */
    public static function getRayCollisionQuad(Ray $ray, Vector3 $p1, Vector3 $p2, Vector3 $p3, Vector3 $p4): RayCollision
    {
        $res = self::ffi()->GetRayCollisionQuad($ray->struct(), $p1->struct(), $p2->struct(), $p3->struct(), $p4->struct());
        return new RayCollision(
            $res->hit,
            $res->distance,
            new Vector3($res->point->x, $res->point->y, $res->point->z),
            new Vector3($res->normal->x, $res->normal->y, $res->normal->z),
        );
    }
}
