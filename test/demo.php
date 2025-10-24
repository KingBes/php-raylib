<?php
// 配置字体文件路径
$fontFile = __DIR__ . DIRECTORY_SEPARATOR . "AlimamaShuHeiTi-Bold.ttf";

// 获取文件字符长度
$fontSize = filesize($fontFile);
var_dump($fontSize);
