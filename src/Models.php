<?php
// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib;

/**
 * Models类
 */
class Models extends Base
{
    /**
     * 从文件加载模型（网格和材质）
     *
     * @param string $fileName 模型文件的路径
     * @return \FFI\CData 加载的模型对象
     */
    public static function loadModel(string $fileName): \FFI\CData
    {
        return self::ffi()->LoadModel($fileName);
    }

    /**
     * 从生成的网格加载模型（默认材质）
     *
     * @param \FFI\CData $mesh 要加载的网格数据
     * @return \FFI\CData 加载的模型对象
     */
    public static function loadModelFromMesh(\FFI\CData $mesh): \FFI\CData
    {
        return self::ffi()->LoadModelFromMesh($mesh);
    }

    /**
     * 检查模型是否有效（已加载到GPU，VAO/VBO）
     *
     * @param \FFI\CData $model 要检查的模型对象
     * @return bool 如果模型有效返回true，否则返回false
     */
    public static function isModelValid(\FFI\CData $model): bool
    {
        return self::ffi()->IsModelValid($model);
    }

    /**
     * 从内存（RAM和/或VRAM）卸载模型（包括网格）
     *
     * @param \FFI\CData $model 要卸载的模型对象
     * @return void
     */
    public static function unloadModel(\FFI\CData $model): void
    {
        self::ffi()->UnloadModel($model);
    }

    /**
     * 计算模型的边界框限制（考虑所有网格）
     *
     * @param \FFI\CData $model 要计算边界的模型对象
     * @return \FFI\CData 模型的边界框
     */
    public static function getModelBoundingBox(\FFI\CData $model): \FFI\CData
    {
        return self::ffi()->GetModelBoundingBox($model);
    }

    /**
     * 绘制一个模型（如果设置了纹理）
     *
     * @param \FFI\CData $model 要绘制的模型对象
     * @param \FFI\CData $position 模型的位置
     * @param float $scale 缩放比例
     * @param \FFI\CData $tint 颜色叠加
     * @return void
     */
    public static function drawModel(\FFI\CData $model, \FFI\CData $position, float $scale, \FFI\CData $tint): void
    {
        self::ffi()->DrawModel($model, $position, $scale, $tint);
    }

    /**
     * 用扩展参数绘制一个模型
     *
     * @param \FFI\CData $model 要绘制的模型对象
     * @param \FFI\CData $position 模型的位置
     * @param \FFI\CData $rotationAxis 旋转轴
     * @param float $rotationAngle 旋转角度
     * @param \FFI\CData $scale 缩放向量
     * @param \FFI\CData $tint 颜色叠加
     * @return void
     */
    public static function drawModelEx(\FFI\CData $model, \FFI\CData $position, \FFI\CData $rotationAxis, float $rotationAngle, \FFI\CData $scale, \FFI\CData $tint): void
    {
        self::ffi()->DrawModelEx($model, $position, $rotationAxis, $rotationAngle, $scale, $tint);
    }

    /**
     * 绘制模型的线框（如果设置了纹理）
     *
     * @param \FFI\CData $model 要绘制的模型对象
     * @param \FFI\CData $position 模型的位置
     * @param float $scale 缩放比例
     * @param \FFI\CData $tint 颜色叠加
     * @return void
     */
    public static function drawModelWires(\FFI\CData $model, \FFI\CData $position, float $scale, \FFI\CData $tint): void
    {
        self::ffi()->DrawModelWires($model, $position, $scale, $tint);
    }

    /**
     * 用扩展参数绘制模型的线框（如果设置了纹理）
     *
     * @param \FFI\CData $model 要绘制的模型对象
     * @param \FFI\CData $position 模型的位置
     * @param \FFI\CData $rotationAxis 旋转轴
     * @param float $rotationAngle 旋转角度
     * @param \FFI\CData $scale 缩放向量
     * @param \FFI\CData $tint 颜色叠加
     * @return void
     */
    public static function drawModelWiresEx(\FFI\CData $model, \FFI\CData $position, \FFI\CData $rotationAxis, float $rotationAngle, \FFI\CData $scale, \FFI\CData $tint): void
    {
        self::ffi()->DrawModelWiresEx($model, $position, $rotationAxis, $rotationAngle, $scale, $tint);
    }

    /**
     * 将模型绘制为点
     *
     * @param \FFI\CData $model 要绘制的模型对象
     * @param \FFI\CData $position 模型的位置
     * @param float $scale 缩放比例
     * @param \FFI\CData $tint 颜色叠加
     * @return void
     */
    public static function drawModelPoints(\FFI\CData $model, \FFI\CData $position, float $scale, \FFI\CData $tint): void
    {
        self::ffi()->DrawModelPoints($model, $position, $scale, $tint);
    }

    /**
     * 用扩展参数将模型绘制为点
     *
     * @param \FFI\CData $model 要绘制的模型对象
     * @param \FFI\CData $position 模型的位置
     * @param \FFI\CData $rotationAxis 旋转轴
     * @param float $rotationAngle 旋转角度
     * @param \FFI\CData $scale 缩放向量
     * @param \FFI\CData $tint 颜色叠加
     * @return void
     */
    public static function drawModelPointsEx(\FFI\CData $model, \FFI\CData $position, \FFI\CData $rotationAxis, float $rotationAngle, \FFI\CData $scale, \FFI\CData $tint): void
    {
        self::ffi()->DrawModelPointsEx($model, $position, $rotationAxis, $rotationAngle, $scale, $tint);
    }

    /**
     * 绘制边界框（线框）
     *
     * @param \FFI\CData $box 要绘制的边界框
     * @param \FFI\CData $color 边界框的颜色
     * @return void
     */
    public static function drawBoundingBox(\FFI\CData $box, \FFI\CData $color): void
    {
        self::ffi()->DrawBoundingBox($box, $color);
    }

    /**
     * 绘制一个广告牌纹理
     *
     * @param \FFI\CData $camera 相机对象
     * @param \FFI\CData $texture 要绘制的纹理
     * @param \FFI\CData $position 广告牌的位置
     * @param float $scale 缩放比例
     * @param \FFI\CData $tint 颜色叠加
     * @return void
     */
    public static function drawBillboard(\FFI\CData $camera, \FFI\CData $texture, \FFI\CData $position, float $scale, \FFI\CData $tint): void
    {
        self::ffi()->DrawBillboard($camera, $texture, $position, $scale, $tint);
    }

    /**
     * 绘制由源矩形定义的广告牌纹理
     *
     * @param \FFI\CData $camera 相机对象
     * @param \FFI\CData $texture 要绘制的纹理
     * @param \FFI\CData $source 源矩形
     * @param \FFI\CData $position 广告牌的位置
     * @param \FFI\CData $size 广告牌大小
     * @param \FFI\CData $tint 颜色叠加
     * @return void
     */
    public static function drawBillboardRec(\FFI\CData $camera, \FFI\CData $texture, \FFI\CData $source, \FFI\CData $position, \FFI\CData $size, \FFI\CData $tint): void
    {
        self::ffi()->DrawBillboardRec($camera, $texture, $source, $position, $size, $tint);
    }

    /**
     * 绘制由源矩形和旋转定义的广告牌纹理
     *
     * @param \FFI\CData $camera 相机对象
     * @param \FFI\CData $texture 要绘制的纹理
     * @param \FFI\CData $source 源矩形
     * @param \FFI\CData $position 广告牌的位置
     * @param \FFI\CData $up 上方向向量
     * @param \FFI\CData $size 广告牌大小
     * @param \FFI\CData $origin 广告牌原点
     * @param float $rotation 旋转角度
     * @param \FFI\CData $tint 颜色叠加
     * @return void
     */
    public static function drawBillboardPro(\FFI\CData $camera, \FFI\CData $texture, \FFI\CData $source, \FFI\CData $position, \FFI\CData $up, \FFI\CData $size, \FFI\CData $origin, float $rotation, \FFI\CData $tint): void
    {
        self::ffi()->DrawBillboardPro($camera, $texture, $source, $position, $up, $size, $origin, $rotation, $tint);
    }

    /**
     * 将网格顶点数据上传到GPU并提供VAO/VBO ID
     *
     * @param \FFI\CData $mesh 网格指针
     * @param bool $dynamic 是否动态使用
     * @return void
     */
    public static function uploadMesh(\FFI\CData $mesh, bool $dynamic): void
    {
        self::ffi()->UploadMesh($mesh, $dynamic);
    }

    /**
     * 更新GPU中特定缓冲区索引的网格顶点数据
     *
     * @param \FFI\CData $mesh 网格对象
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
     * 从CPU和GPU卸载网格数据
     *
     * @param \FFI\CData $mesh 要卸载的网格对象
     * @return void
     */
    public static function unloadMesh(\FFI\CData $mesh): void
    {
        self::ffi()->UnloadMesh($mesh);
    }

    /**
     * 用材质和变换绘制一个3D网格
     *
     * @param \FFI\CData $mesh 网格对象
     * @param \FFI\CData $material 材质对象
     * @param \FFI\CData $transform 变换矩阵
     * @return void
     */
    public static function drawMesh(\FFI\CData $mesh, \FFI\CData $material, \FFI\CData $transform): void
    {
        self::ffi()->DrawMesh($mesh, $material, $transform);
    }

    /**
     * 用材质和不同的变换绘制多个网格实例
     *
     * @param \FFI\CData $mesh 网格对象
     * @param \FFI\CData $material 材质对象
     * @param \FFI\CData $transforms 变换矩阵数组
     * @param int $instances 实例数量
     * @return void
     */
    public static function drawMeshInstanced(\FFI\CData $mesh, \FFI\CData $material, \FFI\CData $transforms, int $instances): void
    {
        self::ffi()->DrawMeshInstanced($mesh, $material, $transforms, $instances);
    }

    /**
     * 计算网格的边界框限制
     *
     * @param \FFI\CData $mesh 网格对象
     * @return \FFI\CData 网格的边界框
     */
    public static function getMeshBoundingBox(\FFI\CData $mesh): \FFI\CData
    {
        return self::ffi()->GetMeshBoundingBox($mesh);
    }

    /**
     * 计算网格的切线
     *
     * @param \FFI\CData $mesh 网格指针
     * @return void
     */
    public static function genMeshTangents(\FFI\CData $mesh): void
    {
        self::ffi()->GenMeshTangents($mesh);
    }

    /**
     * 将网格数据导出到文件，成功返回true
     *
     * @param \FFI\CData $mesh 网格对象
     * @param string $fileName 文件名
     * @return bool 成功则返回true
     */
    public static function exportMesh(\FFI\CData $mesh, string $fileName): bool
    {
        return self::ffi()->ExportMesh($mesh, $fileName);
    }

    /**
     * 将网格导出为定义多个顶点属性数组的代码文件（.h）
     *
     * @param \FFI\CData $mesh 网格对象
     * @param string $fileName 文件名
     * @return bool 成功则返回true
     */
    public static function exportMeshAsCode(\FFI\CData $mesh, string $fileName): bool
    {
        return self::ffi()->ExportMeshAsCode($mesh, $fileName);
    }

    // 其他生成网格的方法类似，以下仅展示部分示例

    /**
     * 生成多边形网格
     *
     * @param int $sides 边的数量
     * @param float $radius 半径大小
     * @return \FFI\CData 生成的网格对象
     */
    public static function genMeshPoly(int $sides, float $radius): \FFI\CData
    {
        return self::ffi()->GenMeshPoly($sides, $radius);
    }

    /**
     * 生成平面网格（带有细分）
     *
     * @param float $width 平面宽度
     * @param float $length 平面长度
     * @param int $resX X轴上的细分数量
     * @param int $resZ Z轴上的细分数量
     * @return \FFI\CData 生成的网格对象
     */
    public static function genMeshPlane(float $width, float $length, int $resX, int $resZ): \FFI\CData
    {
        return self::ffi()->GenMeshPlane($width, $length, $resX, $resZ);
    }

    // 加载材质相关方法

    /**
     * 从模型文件加载材质
     *
     * @param string $fileName 文件名
     * @param int &$materialCount 材质计数指针
     * @return \FFI\CData 加载的材质数组
     */
    public static function loadMaterials(string $fileName, int &$materialCount): \FFI\CData
    {
        return self::ffi()->LoadMaterials($fileName, $materialCount);
    }

    /**
     * 加载默认材质（支持：漫反射、镜面反射、法线贴图）
     *
     * @return \FFI\CData 默认材质对象
     */
    public static function loadMaterialDefault(): \FFI\CData
    {
        return self::ffi()->LoadMaterialDefault();
    }

    // 动画相关方法

    /**
     * 从文件加载模型动画
     *
     * @param string $fileName 文件名
     * @param int &$animCount 动画计数指针
     * @return \FFI\CData 加载的动画数组
     */
    public static function loadModelAnimations(string $fileName, int &$animCount): \FFI\CData
    {
        return self::ffi()->LoadModelAnimations($fileName, $animCount);
    }

    /**
     * 更新模型动画姿势（CPU）
     *
     * @param \FFI\CData $model 模型对象
     * @param \FFI\CData $anim 动画对象
     * @param int $frame 帧编号
     * @return void
     */
    public static function updateModelAnimation(\FFI\CData $model, \FFI\CData $anim, int $frame): void
    {
        self::ffi()->UpdateModelAnimation($model, $anim, $frame);
    }

    // 碰撞检测相关方法

    /**
     * 检查两个球体之间的碰撞
     *
     * @param \FFI\CData $center1 第一个球体中心位置
     * @param float $radius1 第一个球体半径
     * @param \FFI\CData $center2 第二个球体中心位置
     * @param float $radius2 第二个球体半径
     * @return bool 如果发生碰撞返回true，否则返回false
     */
    public static function checkCollisionSpheres(\FFI\CData $center1, float $radius1, \FFI\CData $center2, float $radius2): bool
    {
        return self::ffi()->CheckCollisionSpheres($center1, $radius1, $center2, $radius2);
    }

    /**
     * 获取射线和球体之间的碰撞信息
     *
     * @param \FFI\CData $ray 射线对象
     * @param \FFI\CData $center 球体中心位置
     * @param float $radius 球体半径
     * @return \FFI\CData 射线与球体的碰撞信息
     */
    public static function getRayCollisionSphere(\FFI\CData $ray, \FFI\CData $center, float $radius): \FFI\CData
    {
        return self::ffi()->GetRayCollisionSphere($ray, $center, $radius);
    }

    /**
     * 获取射线和边界框之间的碰撞信息
     *
     * @param \FFI\CData $ray 射线对象
     * @param \FFI\CData $box 边界框
     * @return \FFI\CData 射线与边界框的碰撞信息
     */
    public static function getRayCollisionBox(\FFI\CData $ray, \FFI\CData $box): \FFI\CData
    {
        return self::ffi()->GetRayCollisionBox($ray, $box);
    }

    /**
     * 获取射线和网格之间的碰撞信息
     *
     * @param \FFI\CData $ray 射线对象
     * @param \FFI\CData $mesh 网格对象
     * @param \FFI\CData $transform 变换矩阵
     * @return \FFI\CData 射线与网格的碰撞信息
     */
    public static function getRayCollisionMesh(\FFI\CData $ray, \FFI\CData $mesh, \FFI\CData $transform): \FFI\CData
    {
        return self::ffi()->GetRayCollisionMesh($ray, $mesh, $transform);
    }

    /**
     * 获取射线和三角形之间的碰撞信息
     *
     * @param \FFI\CData $ray 射线对象
     * @param \FFI\CData $p1 三角形的第一个顶点
     * @param \FFI\CData $p2 三角形的第二个顶点
     * @param \FFI\CData $p3 三角形的第三个顶点
     * @return \FFI\CData 射线与三角形的碰撞信息
     */
    public static function getRayCollisionTriangle(\FFI\CData $ray, \FFI\CData $p1, \FFI\CData $p2, \FFI\CData $p3): \FFI\CData
    {
        return self::ffi()->GetRayCollisionTriangle($ray, $p1, $p2, $p3);
    }

    /**
     * 获取射线和四边形之间的碰撞信息
     *
     * @param \FFI\CData $ray 射线对象
     * @param \FFI\CData $p1 四边形的第一个顶点
     * @param \FFI\CData $p2 四边形的第二个顶点
     * @param \FFI\CData $p3 四边形的第三个顶点
     * @param \FFI\CData $p4 四边形的第四个顶点
     * @return \FFI\CData 射线与四边形的碰撞信息
     */
    public static function getRayCollisionQuad(\FFI\CData $ray, \FFI\CData $p1, \FFI\CData $p2, \FFI\CData $p3, \FFI\CData $p4): \FFI\CData
    {
        return self::ffi()->GetRayCollisionQuad($ray, $p1, $p2, $p3, $p4);
    }
}
