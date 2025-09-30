<?php
require dirname(__DIR__) . "/vendor/autoload.php";

use Kingbes\Raylib\Core;
use Kingbes\Raylib\Shapes;
use Kingbes\Raylib\Text;
use Kingbes\Raylib\Utils;

// 游戏常量
const SCREEN_WIDTH = 800;
const SCREEN_HEIGHT = 700;
const GRID_WIDTH = 10;    // 游戏网格宽度
const GRID_HEIGHT = 20;   // 游戏网格高度
const BLOCK_SIZE = 30;    // 方块大小
const SIDEBAR_WIDTH = 200; // 侧边栏宽度

// 初始化窗口
Core::initWindow(SCREEN_WIDTH, SCREEN_HEIGHT, "tetris - php-raylib");
Core::setTargetFPS(60);

// 颜色定义
$colors = [
    Utils::color(0, 0, 0, 100),         // 空
    Utils::color(0, 255, 255, 255),     // I
    Utils::color(255, 255, 0, 255),     // O
    Utils::color(128, 0, 128, 255),     // T
    Utils::color(255, 165, 0, 255),     // L
    Utils::color(0, 0, 255, 255),       // J
    Utils::color(0, 255, 0, 255),       // S
    Utils::color(255, 0, 0, 255)        // Z
];

// 方块形状定义 (I, O, T, L, J, S, Z)
$shapes = [
    [[1, 1, 1, 1]],  // I
    [[1, 1], [1, 1]], // O
    [[0, 1, 0], [1, 1, 1]], // T
    [[0, 0, 1], [1, 1, 1]], // L
    [[1, 0, 0], [1, 1, 1]], // J
    [[0, 1, 1], [1, 1, 0]], // S
    [[1, 1, 0], [0, 1, 1]]  // Z
];

// 游戏变量
$board = array_fill(0, GRID_HEIGHT, array_fill(0, GRID_WIDTH, 0));
$currentShape = [];
$currentColor = 0;
$currentX = 0;
$currentY = 0;
$nextShape = [];
$nextColor = 0;
$score = 0;
$gameOver = false;
$fallTime = 0;
$fallSpeed = 0.5; // 秒
$lastFall = 0;

// 初始化游戏
function initGame(&$board, &$currentShape, &$currentColor, &$currentX, &$currentY, &$nextShape, &$nextColor, $shapes) {
    $board = array_fill(0, GRID_HEIGHT, array_fill(0, GRID_WIDTH, 0));
    $currentShape = $shapes[array_rand($shapes)];
    $currentColor = array_rand($shapes) + 1;
    $currentX = (int)(GRID_WIDTH / 2) - (int)(count($currentShape[0]) / 2);
    $currentY = 0;
    $nextShape = $shapes[array_rand($shapes)];
    $nextColor = array_rand($shapes) + 1;
    return 0;
}

// 检查碰撞
function checkCollision($board, $shape, $x, $y) {
    foreach ($shape as $row => $cols) {
        foreach ($cols as $col => $cell) {
            if ($cell) {
                $newX = $x + $col;
                $newY = $y + $row;
                if ($newX < 0 || $newX >= GRID_WIDTH || $newY >= GRID_HEIGHT || 
                    ($newY >= 0 && $board[$newY][$newX] != 0)) {
                    return true;
                }
            }
        }
    }
    return false;
}

// 旋转方块
function rotateShape($shape) {
    $rows = count($shape);
    $cols = count($shape[0]);
    $rotated = [];
    
    for ($i = 0; $i < $cols; $i++) {
        $newRow = [];
        for ($j = $rows - 1; $j >= 0; $j--) {
            $newRow[] = $shape[$j][$i];
        }
        $rotated[] = $newRow;
    }
    return $rotated;
}

// 锁定当前方块到棋盘
function lockShape(&$board, $shape, $x, $y, $color) {
    foreach ($shape as $row => $cols) {
        foreach ($cols as $col => $cell) {
            if ($cell) {
                $newY = $y + $row;
                $newX = $x + $col;
                if ($newY >= 0) {
                    $board[$newY][$newX] = $color;
                }
            }
        }
    }
}

// 消除填满的行
function clearLines(&$board, &$score) {
    $linesCleared = 0;
    for ($i = GRID_HEIGHT - 1; $i >= 0; $i--) {
        $filled = true;
        for ($j = 0; $j < GRID_WIDTH; $j++) {
            if ($board[$i][$j] == 0) {
                $filled = false;
                break;
            }
        }
        if ($filled) {
            // 移除当前行并在顶部添加新行
            array_splice($board, $i, 1);
            array_unshift($board, array_fill(0, GRID_WIDTH, 0));
            $i++; // 检查新移下来的行
            $linesCleared++;
        }
    }
    
    // 根据消除的行数加分
    switch ($linesCleared) {
        case 1: $score += 100; break;
        case 2: $score += 300; break;
        case 3: $score += 500; break;
        case 4: $score += 800; break;
    }
}

// 初始化游戏
initGame($board, $currentShape, $currentColor, $currentX, $currentY, $nextShape, $nextColor, $shapes);

// 游戏主循环
while (!Core::windowShouldClose()) {
    $currentTime = Core::getTime();
    
    // 处理输入
    if (Core::isKeyPressed(263)) { // 左箭头
        if (!checkCollision($board, $currentShape, $currentX - 1, $currentY)) {
            $currentX--;
        }
    }
    if (Core::isKeyPressed(262)) { // 右箭头
        if (!checkCollision($board, $currentShape, $currentX + 1, $currentY)) {
            $currentX++;
        }
    }
    if (Core::isKeyPressed(264)) { // 下箭头
        if (!checkCollision($board, $currentShape, $currentX, $currentY + 1)) {
            $currentY++;
        }
    }
    if (Core::isKeyPressed(265)) { // 上箭头旋转
        $rotated = rotateShape($currentShape);
        if (!checkCollision($board, $rotated, $currentX, $currentY)) {
            $currentShape = $rotated;
        }
    }
    if (Core::isKeyPressed(32) && $gameOver) { // 空格键重新开始
        $score = 0;
        $gameOver = false;
        initGame($board, $currentShape, $currentColor, $currentX, $currentY, $nextShape, $nextColor, $shapes);
    }

    // 自动下落
    if ($currentTime - $lastFall > $fallSpeed && !$gameOver) {
        if (!checkCollision($board, $currentShape, $currentX, $currentY + 1)) {
            $currentY++;
        } else {
            // 锁定当前方块
            lockShape($board, $currentShape, $currentX, $currentY, $currentColor);
            clearLines($board, $score);
            
            // 生成新方块
            $currentShape = $nextShape;
            $currentColor = $nextColor;
            $currentX = (int)(GRID_WIDTH / 2) - (int)(count($currentShape[0]) / 2);
            $currentY = 0;
            $nextShape = $shapes[array_rand($shapes)];
            $nextColor = array_rand($shapes) + 1;
            
            // 检查游戏结束
            if (checkCollision($board, $currentShape, $currentX, $currentY)) {
                $gameOver = true;
            }
        }
        $lastFall = $currentTime;
    }

    // 开始绘制
    Core::beginDrawing();
    Core::clearBackground(Utils::color(30, 30, 30, 255));
    
    // 绘制游戏区域边框
    $gameAreaX = (SCREEN_WIDTH - SIDEBAR_WIDTH - GRID_WIDTH * BLOCK_SIZE) / 2;
    $gameAreaY = (SCREEN_HEIGHT - GRID_HEIGHT * BLOCK_SIZE) / 2;
    Shapes::drawRectangleLines(
        $gameAreaX - 2, 
        $gameAreaY - 2, 
        GRID_WIDTH * BLOCK_SIZE + 4, 
        GRID_HEIGHT * BLOCK_SIZE + 4, 
        Utils::color(255, 255, 255, 255)
    );
    
    // 绘制已落下的方块
    for ($y = 0; $y < GRID_HEIGHT; $y++) {
        for ($x = 0; $x < GRID_WIDTH; $x++) {
            if ($board[$y][$x] != 0) {
                Shapes::drawRectangle(
                    $gameAreaX + $x * BLOCK_SIZE,
                    $gameAreaY + $y * BLOCK_SIZE,
                    BLOCK_SIZE - 1,
                    BLOCK_SIZE - 1,
                    $colors[$board[$y][$x]]
                );
            }
        }
    }
    
    // 绘制当前方块
    foreach ($currentShape as $row => $cols) {
        foreach ($cols as $col => $cell) {
            if ($cell) {
                $drawX = $gameAreaX + ($currentX + $col) * BLOCK_SIZE;
                $drawY = $gameAreaY + ($currentY + $row) * BLOCK_SIZE;
                if ($currentY + $row >= 0) { // 只绘制可见的方块
                    Shapes::drawRectangle(
                        $drawX,
                        $drawY,
                        BLOCK_SIZE - 1,
                        BLOCK_SIZE - 1,
                        $colors[$currentColor]
                    );
                }
            }
        }
    }
    
    // 绘制侧边栏
    $sidebarX = SCREEN_WIDTH - SIDEBAR_WIDTH + 20;
    $sidebarY = 100;
    
    // 分数
    Text::drawText("Score: " . $score, $sidebarX, $sidebarY, 20, Utils::color(255, 255, 255, 255));
    
    // 下一个方块
    Text::drawText("Next:", $sidebarX, $sidebarY + 60, 20, Utils::color(255, 255, 255, 255));
    foreach ($nextShape as $row => $cols) {
        foreach ($cols as $col => $cell) {
            if ($cell) {
                Shapes::drawRectangle(
                    $sidebarX + 30 + $col * BLOCK_SIZE,
                    $sidebarY + 100 + $row * BLOCK_SIZE,
                    BLOCK_SIZE - 1,
                    BLOCK_SIZE - 1,
                    $colors[$nextColor]
                );
            }
        }
    }
    
    // 游戏说明
    Text::drawText("Controls:", $sidebarX, $sidebarY + 200, 20, Utils::color(255, 255, 255, 255));
    Text::drawText("Move", $sidebarX, $sidebarY + 230, 18, Utils::color(255, 255, 255, 255));
    Text::drawText("Rotate", $sidebarX, $sidebarY + 255, 18, Utils::color(255, 255, 255, 255));
    Text::drawText("Drop", $sidebarX, $sidebarY + 280, 18, Utils::color(255, 255, 255, 255));
    
    // 游戏结束提示
    if ($gameOver) {
        Shapes::drawRectangle(0, 0, SCREEN_WIDTH, SCREEN_HEIGHT, Utils::color(0, 0, 0, 150));
        Text::drawText("Game Over!", SCREEN_WIDTH / 2 - 100, SCREEN_HEIGHT / 2 - 30, 30, Utils::color(255, 0, 0, 255));
        Text::drawText("Press Space to Restart", SCREEN_WIDTH / 2 - 150, SCREEN_HEIGHT / 2 + 20, 20, Utils::color(255, 255, 255, 255));
    }
    
    Core::endDrawing();
}

Core::closeWindow();