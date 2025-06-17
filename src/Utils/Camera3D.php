<?php

namespace Kingbes\Raylib\Utils;

use \FFI\CData;
use Kingbes\Raylib\Base;

class Camera3D extends Base
{
    public Vector3 $offset;
    public Vector3 $target;
    public Vector3 $up;
    public float $fovy = 0;
    public int $projection = 0;
}
