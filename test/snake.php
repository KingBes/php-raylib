<?php
require dirname(__DIR__) . "/vendor/autoload.php";

use Kingbes\Raylib\Core;
use Kingbes\Raylib\Shapes;
use Kingbes\Raylib\Text;
use Kingbes\Raylib\Utils;

// 游戏常量
const SCREEN_WIDTH = 800;
const SCREEN_HEIGHT = 600;
const GRID_SIZE = 20;        // 网格大小
const GRID_WIDTH = SCREEN_WIDTH / GRID_SIZE;  // 网格列数
const GRID_HEIGHT = SCREEN_HEIGHT / GRID_SIZE; // 网格行数

// 方向常量
const UP = 0;
const RIGHT = 1;
const DOWN = 2;
const LEFT = 3;

// 初始化窗口
Core::initWindow(SCREEN_WIDTH, SCREEN_HEIGHT, "贪吃蛇 - php-raylib");
Core::setTargetFPS(10); // 控制游戏速度

// 颜色定义
$black = Utils::color(0, 0, 0, 255);
$white = Utils::color(255, 255, 255, 255);
$red = Utils::color(255, 0, 0, 255);
$green = Utils::color(0, 255, 0, 255);
$blue = Utils::color(0, 0, 255, 255);

// 游戏变量
$snake = [];               // 蛇的身体部分
$food = [];                // 食物位置
$direction = RIGHT;        // 当前方向
$nextDirection = RIGHT;    // 下一个方向
$score = 0;                // 分数
$gameOver = false;         // 游戏是否结束

// 初始化游戏
function initGame(&$snake, &$food, &$direction, &$nextDirection, &$score) {
    // 初始化蛇的位置（中间位置开始）
    $snake = [
        ['x' => GRID_WIDTH / 2, 'y' => GRID_HEIGHT / 2],
        ['x' => GRID_WIDTH / 2 - 1, 'y' => GRID_HEIGHT / 2],
        ['x' => GRID_WIDTH / 2 - 2, 'y' => GRID_HEIGHT / 2]
    ];
    
    // 生成初始食物
    generateFood($snake, $food);
    
    // 重置方向和分数
    $direction = RIGHT;
    $nextDirection = RIGHT;
    $score = 0;
}

// 生成食物
function generateFood($snake, &$food) {
    do {
        // 随机生成食物位置
        $food['x'] = rand(0, GRID_WIDTH - 1);
        $food['y'] = rand(0, GRID_HEIGHT - 1);
        
        // 检查食物是否生成在蛇身上
        $onSnake = false;
        foreach ($snake as $segment) {
            if ($segment['x'] == $food['x'] && $segment['y'] == $food['y']) {
                $onSnake = true;
                break;
            }
        }
    } while ($onSnake); // 如果食物在蛇身上，重新生成
}

// 检查碰撞
function checkCollision($snake) {
    $head = $snake[0];
    
    // 检查是否撞墙
    if ($head['x'] < 0 || $head['x'] >= GRID_WIDTH || 
        $head['y'] < 0 || $head['y'] >= GRID_HEIGHT) {
        return true;
    }
    
    // 检查是否撞到自己
    for ($i = 1; $i < count($snake); $i++) {
        if ($head['x'] == $snake[$i]['x'] && $head['y'] == $snake[$i]['y']) {
            return true;
        }
    }
    
    return false;
}

// 初始化游戏
initGame($snake, $food, $direction, $nextDirection, $score);

// 游戏主循环
while (!Core::windowShouldClose()) {
    // 处理输入
    if (Core::isKeyPressed(265) && $direction != DOWN) { // 上箭头
        $nextDirection = UP;
    }
    if (Core::isKeyPressed(262) && $direction != LEFT) { // 右箭头
        $nextDirection = RIGHT;
    }
    if (Core::isKeyPressed(264) && $direction != UP) { // 下箭头
        $nextDirection = DOWN;
    }
    if (Core::isKeyPressed(263) && $direction != RIGHT) { // 左箭头
        $nextDirection = LEFT;
    }
    
    // 游戏结束时按空格键重新开始
    if (Core::isKeyPressed(32) && $gameOver) {
        $gameOver = false;
        initGame($snake, $food, $direction, $nextDirection, $score);
    }
    
    // 游戏逻辑更新（未结束状态）
    if (!$gameOver) {
        // 更新方向
        $direction = $nextDirection;
        
        // 获取蛇头位置
        $head = $snake[0];
        $newHead = ['x' => $head['x'], 'y' => $head['y']];
        
        // 根据方向移动蛇头
        switch ($direction) {
            case UP:
                $newHead['y']--;
                break;
            case RIGHT:
                $newHead['x']++;
                break;
            case DOWN:
                $newHead['y']++;
                break;
            case LEFT:
                $newHead['x']--;
                break;
        }
        
        // 将新头部添加到蛇的身体
        array_unshift($snake, $newHead);
        
        // 检查是否吃到食物
        if ($newHead['x'] == $food['x'] && $newHead['y'] == $food['y']) {
            $score += 10;
            generateFood($snake, $food);
            // 提高游戏速度（最多20FPS）
            $newSpeed = min(20, 10 + (int)($score / 100) * 2);
            Core::setTargetFPS($newSpeed);
        } else {
            // 如果没吃到食物，移除尾部（保持长度不变）
            array_pop($snake);
        }
        
        // 检查碰撞
        if (checkCollision($snake)) {
            $gameOver = true;
        }
    }
    
    // 绘制
    Core::beginDrawing();
    Core::clearBackground($black);
    
    // 绘制蛇
    foreach ($snake as $index => $segment) {
        // 蛇头用蓝色，身体用绿色
        $color = ($index == 0) ? $blue : $green;
        Shapes::drawRectangle(
            $segment['x'] * GRID_SIZE,
            $segment['y'] * GRID_SIZE,
            GRID_SIZE - 1, // 减1是为了显示网格线
            GRID_SIZE - 1,
            $color
        );
    }
    
    // 绘制食物
    Shapes::drawRectangle(
        $food['x'] * GRID_SIZE,
        $food['y'] * GRID_SIZE,
        GRID_SIZE - 1,
        GRID_SIZE - 1,
        $red
    );
    
    // 绘制分数
    Text::drawText("Score: " . $score, 10, 10, 20, $white);
    
    // 游戏结束提示
    if ($gameOver) {
        Shapes::drawRectangle(0, 0, SCREEN_WIDTH, SCREEN_HEIGHT, Utils::color(0, 0, 0, 150));
        Text::drawText("Game Over!", SCREEN_WIDTH / 2 - 100, SCREEN_HEIGHT / 2 - 30, 30, $red);
        Text::drawText("Score: " . $score, SCREEN_WIDTH / 2 - 100, SCREEN_HEIGHT / 2 + 10, 20, $white);
        Text::drawText("Press Space to Restart", SCREEN_WIDTH / 2 - 150, SCREEN_HEIGHT / 2 + 40, 20, $white);
    }
    
    Core::endDrawing();
}

Core::closeWindow();
