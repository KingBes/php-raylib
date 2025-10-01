<?php
require dirname(__DIR__) . "/vendor/autoload.php";

use Kingbes\Raylib\Core;
use Kingbes\Raylib\Shapes;
use Kingbes\Raylib\Text;
use Kingbes\Raylib\Utils;

// 优化后的尺寸设置，解决网格遮挡文字问题
const SCREEN_WIDTH = 450;
const SCREEN_HEIGHT = 550;
const GRID_SIZE = 4;
const CELL_SIZE = 85;        // 减小方块尺寸
const CELL_SPACING = 14;     // 减小间距
const TOP_MARGIN = 80;       // 减小顶部边距

// 重新计算游戏区域位置（确保居中且不超出屏幕）
const GAME_AREA_X = (SCREEN_WIDTH - (GRID_SIZE * CELL_SIZE + (GRID_SIZE - 1) * CELL_SPACING)) / 2;
const GAME_AREA_Y = TOP_MARGIN;

// 颜色定义
$colors = [
    0 => Utils::color(187, 173, 160, 255),        // 空白格子
    2 => Utils::color(238, 228, 218, 255),        // 2
    4 => Utils::color(237, 224, 200, 255),        // 4
    8 => Utils::color(242, 177, 121, 255),        // 8
    16 => Utils::color(245, 149, 99, 255),        // 16
    32 => Utils::color(246, 124, 95, 255),        // 32
    64 => Utils::color(246, 94, 59, 255),         // 64
    128 => Utils::color(237, 207, 114, 255),      // 128
    256 => Utils::color(237, 204, 97, 255),       // 256
    512 => Utils::color(237, 200, 80, 255),       // 512
    1024 => Utils::color(237, 197, 63, 255),      // 1024
    2048 => Utils::color(237, 194, 46, 255),      // 2048
    'text' => [
        2 => Utils::color(119, 110, 101, 255),     // 2和4的文字颜色
        4 => Utils::color(119, 110, 101, 255),
        'default' => Utils::color(249, 246, 242, 255) // 其他数字的文字颜色
    ],
    'grid' => Utils::color(187, 173, 160, 255),    // 网格背景色
    'background' => Utils::color(250, 248, 239, 255), // 游戏背景色
    'title' => Utils::color(119, 110, 101, 255)    // 标题颜色
];

// 游戏变量
$grid = [];
$score = 0;
$gameOver = false;
$won = false;
$lastKeyPressed = 0;

// 初始化游戏
function initGame(&$grid, &$score, &$gameOver, &$won) {
    $grid = array_fill(0, GRID_SIZE, array_fill(0, GRID_SIZE, 0));
    spawnNewTile($grid);
    spawnNewTile($grid);
    $score = 0;
    $gameOver = false;
    $won = false;
}

// 生成新方块
function spawnNewTile(&$grid) {
    $emptyCells = [];
    for ($y = 0; $y < GRID_SIZE; $y++) {
        for ($x = 0; $x < GRID_SIZE; $x++) {
            if ($grid[$y][$x] == 0) {
                $emptyCells[] = ['x' => $x, 'y' => $y];
            }
        }
    }
    
    if (!empty($emptyCells)) {
        $cell = $emptyCells[array_rand($emptyCells)];
        $grid[$cell['y']][$cell['x']] = (rand(0, 9) == 0) ? 4 : 2;
        return true;
    }
    
    return false;
}

// 检查游戏是否结束
function checkGameOver($grid) {
    // 检查是否还有空白格子
    for ($y = 0; $y < GRID_SIZE; $y++) {
        for ($x = 0; $x < GRID_SIZE; $x++) {
            if ($grid[$y][$x] == 0) {
                return false;
            }
        }
    }
    
    // 检查是否还有可合并的方块
    for ($y = 0; $y < GRID_SIZE; $y++) {
        for ($x = 0; $x < GRID_SIZE; $x++) {
            $current = $grid[$y][$x];
            if ($x < GRID_SIZE - 1 && $grid[$y][$x + 1] == $current) {
                return false;
            }
            if ($y < GRID_SIZE - 1 && $grid[$y + 1][$x] == $current) {
                return false;
            }
        }
    }
    
    return true;
}

// 检查是否获胜
function checkWin($grid) {
    for ($y = 0; $y < GRID_SIZE; $y++) {
        for ($x = 0; $x < GRID_SIZE; $x++) {
            if ($grid[$y][$x] == 2048) {
                return true;
            }
        }
    }
    return false;
}

// 向左移动
function moveLeft(&$grid, &$score) {
    $moved = false;
    
    for ($y = 0; $y < GRID_SIZE; $y++) {
        for ($x = 1; $x < GRID_SIZE; $x++) {
            if ($grid[$y][$x] != 0) {
                $currentX = $x;
                while ($currentX > 0 && $grid[$y][$currentX - 1] == 0) {
                    $grid[$y][$currentX - 1] = $grid[$y][$currentX];
                    $grid[$y][$currentX] = 0;
                    $currentX--;
                    $moved = true;
                }
                
                if ($currentX > 0 && $grid[$y][$currentX - 1] == $grid[$y][$currentX]) {
                    $grid[$y][$currentX - 1] *= 2;
                    $score += $grid[$y][$currentX - 1];
                    $grid[$y][$currentX] = 0;
                    $moved = true;
                }
            }
        }
    }
    
    return $moved;
}

// 向右移动
function moveRight(&$grid, &$score) {
    $moved = false;
    
    for ($y = 0; $y < GRID_SIZE; $y++) {
        for ($x = GRID_SIZE - 2; $x >= 0; $x--) {
            if ($grid[$y][$x] != 0) {
                $currentX = $x;
                while ($currentX < GRID_SIZE - 1 && $grid[$y][$currentX + 1] == 0) {
                    $grid[$y][$currentX + 1] = $grid[$y][$currentX];
                    $grid[$y][$currentX] = 0;
                    $currentX++;
                    $moved = true;
                }
                
                if ($currentX < GRID_SIZE - 1 && $grid[$y][$currentX + 1] == $grid[$y][$currentX]) {
                    $grid[$y][$currentX + 1] *= 2;
                    $score += $grid[$y][$currentX + 1];
                    $grid[$y][$currentX] = 0;
                    $moved = true;
                }
            }
        }
    }
    
    return $moved;
}

// 向上移动
function moveUp(&$grid, &$score) {
    $moved = false;
    
    for ($x = 0; $x < GRID_SIZE; $x++) {
        for ($y = 1; $y < GRID_SIZE; $y++) {
            if ($grid[$y][$x] != 0) {
                $currentY = $y;
                while ($currentY > 0 && $grid[$currentY - 1][$x] == 0) {
                    $grid[$currentY - 1][$x] = $grid[$y][$x];
                    $grid[$y][$x] = 0;
                    $currentY--;
                    $moved = true;
                }
                
                if ($currentY > 0 && $grid[$currentY - 1][$x] == $grid[$y][$x]) {
                    $grid[$currentY - 1][$x] *= 2;
                    $score += $grid[$currentY - 1][$x];
                    $grid[$y][$x] = 0;
                    $moved = true;
                }
            }
        }
    }
    
    return $moved;
}

// 向下移动
function moveDown(&$grid, &$score) {
    $moved = false;
    
    for ($x = 0; $x < GRID_SIZE; $x++) {
        for ($y = GRID_SIZE - 2; $y >= 0; $y--) {
            if ($grid[$y][$x] != 0) {
                $currentY = $y;
                while ($currentY < GRID_SIZE - 1 && $grid[$currentY + 1][$x] == 0) {
                    $grid[$currentY + 1][$x] = $grid[$y][$x];
                    $grid[$y][$x] = 0;
                    $currentY++;
                    $moved = true;
                }
                
                if ($currentY < GRID_SIZE - 1 && $grid[$currentY + 1][$x] == $grid[$y][$x]) {
                    $grid[$currentY + 1][$x] *= 2;
                    $score += $grid[$currentY + 1][$x];
                    $grid[$y][$x] = 0;
                    $moved = true;
                }
            }
        }
    }
    
    return $moved;
}

// 初始化游戏
initGame($grid, $score, $gameOver, $won);

// 初始化窗口
Core::initWindow(SCREEN_WIDTH, SCREEN_HEIGHT, "2048 - php-raylib");
Core::setTargetFPS(60);

// 游戏主循环
while (!Core::windowShouldClose()) {
    // 处理输入
    if (!$gameOver) {
        $moved = false;
        
        // 左箭头
        if (Core::isKeyPressed(263) && $lastKeyPressed != 263) {
            $moved = moveLeft($grid, $score);
            $lastKeyPressed = 263;
        }
        // 右箭头
        elseif (Core::isKeyPressed(262) && $lastKeyPressed != 262) {
            $moved = moveRight($grid, $score);
            $lastKeyPressed = 262;
        }
        // 上箭头
        elseif (Core::isKeyPressed(265) && $lastKeyPressed != 265) {
            $moved = moveUp($grid, $score);
            $lastKeyPressed = 265;
        }
        // 下箭头
        elseif (Core::isKeyPressed(264) && $lastKeyPressed != 264) {
            $moved = moveDown($grid, $score);
            $lastKeyPressed = 264;
        }
        // 没有按键时重置最后按键记录
        elseif (!Core::isKeyDown(263) && !Core::isKeyDown(262) && 
                !Core::isKeyDown(265) && !Core::isKeyDown(264)) {
            $lastKeyPressed = 0;
        }
        
        // 如果有移动，生成新方块并检查游戏状态
        if ($moved) {
            spawnNewTile($grid);
            
            // 检查是否获胜
            if (!($won) && checkWin($grid)) {
                $won = true;
            }
            
            // 检查游戏是否结束
            if (checkGameOver($grid)) {
                $gameOver = true;
            }
        }
    }
    // 游戏结束或获胜时按R键重新开始
    elseif (Core::isKeyPressed(82)) { // R键
        initGame($grid, $score, $gameOver, $won);
    }
    
    // 绘制
    Core::beginDrawing();
    Core::clearBackground($colors['background']);
    
    // 绘制标题（调整大小和位置，避免被遮挡）
    Text::drawText("2048", 20, 20, 50, $colors['title']);
    
    // 绘制分数（右对齐，避免与标题重叠）
    Text::drawText("Score: " . $score, SCREEN_WIDTH - 150, 30, 22, $colors['title']);
    
    // 绘制网格背景
    Shapes::drawRectangle(
        GAME_AREA_X - CELL_SPACING, 
        GAME_AREA_Y - CELL_SPACING, 
        GRID_SIZE * CELL_SIZE + (GRID_SIZE + 1) * CELL_SPACING, 
        GRID_SIZE * CELL_SIZE + (GRID_SIZE + 1) * CELL_SPACING, 
        $colors['grid']
    );
    
    // 绘制格子和数字（优化文字大小和位置）
    for ($y = 0; $y < GRID_SIZE; $y++) {
        for ($x = 0; $x < GRID_SIZE; $x++) {
            $value = $grid[$y][$x];
            
            // 计算格子位置
            $posX = GAME_AREA_X + $x * (CELL_SIZE + CELL_SPACING);
            $posY = GAME_AREA_Y + $y * (CELL_SIZE + CELL_SPACING);
            
            // 选择格子颜色
            $colorKey = min($value, 2048);
            $cellColor = $colors[$colorKey];
            
            // 绘制格子
            Shapes::drawRectangle($posX, $posY, CELL_SIZE, CELL_SIZE, $cellColor);
            
            // 绘制数字（非零值）
            if ($value != 0) {
                // 选择文字颜色
                $textColor = ($value <= 4) ? $colors['text'][2] : $colors['text']['default'];
                
                // 优化：根据数字位数动态调整字体大小，确保完整显示
                $text = (string)$value;
                if (strlen($text) == 1) {
                    $textSize = 34;  // 1位数字(2,4)
                } elseif (strlen($text) == 2) {
                    $textSize = 30;  // 2位数字(8-64)
                } elseif (strlen($text) == 3) {
                    $textSize = 24;  // 3位数字(128-512)
                } else {
                    $textSize = 20;  // 4位数字(1024-2048)
                }
                
                // 计算文字位置（精确居中）
                $textWidth = Text::measureText($text, $textSize);
                $textX = $posX + (CELL_SIZE - $textWidth) / 2;
                $textY = $posY + (CELL_SIZE - $textSize) / 2 + 2;  // 微调Y轴位置
                
                // 绘制数字
                Text::drawText($text, $textX, $textY, $textSize, $textColor);
            }
        }
    }
    
    // 绘制获胜信息（优化位置，确保完整显示）
    if ($won && !$gameOver) {
        Shapes::drawRectangle(0, 0, SCREEN_WIDTH, SCREEN_HEIGHT, Utils::color(0, 0, 0, 100));
        Text::drawText("You Win!", SCREEN_WIDTH / 2 - 150, SCREEN_HEIGHT / 2 - 30, 30, Utils::color(255, 255, 255, 255));
        Text::drawText("Press R to Restart", SCREEN_WIDTH / 2 - 150, SCREEN_HEIGHT / 2 + 20, 20, Utils::color(255, 255, 255, 255));
    }
    
    // 绘制游戏结束信息（优化位置，确保完整显示）
    if ($gameOver) {
        Shapes::drawRectangle(0, 0, SCREEN_WIDTH, SCREEN_HEIGHT, Utils::color(0, 0, 0, 150));
        Text::drawText("Game Over!", SCREEN_WIDTH / 2 - 100, SCREEN_HEIGHT / 2 - 30, 30, Utils::color(255, 255, 255, 255));
        Text::drawText("Final Score: " . $score, SCREEN_WIDTH / 2 - 100, SCREEN_HEIGHT / 2 + 10, 20, Utils::color(255, 255, 255, 255));
        Text::drawText("Press R to Restart", SCREEN_WIDTH / 2 - 150, SCREEN_HEIGHT / 2 + 40, 20, Utils::color(255, 255, 255, 255));
    }
    
    Core::endDrawing();
}

Core::closeWindow();
    