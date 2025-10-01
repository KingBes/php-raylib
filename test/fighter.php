<?php
require dirname(__DIR__) . "/vendor/autoload.php";

use Kingbes\Raylib\Core;
use Kingbes\Raylib\Shapes;
use Kingbes\Raylib\Text;
use Kingbes\Raylib\Utils;
use Kingbes\Raylib\Audio;

// 游戏常量
const SCREEN_WIDTH = 800;
const SCREEN_HEIGHT = 600;
const PLAYER_WIDTH = 50;
const PLAYER_HEIGHT = 60;
const BULLET_WIDTH = 5;
const BULLET_HEIGHT = 15;
const ENEMY_WIDTH = 40;
const ENEMY_HEIGHT = 40;
const BULLET_SPEED = 10;
const ENEMY_SPEED = 2;
const PLAYER_SPEED = 7;
const SHOOT_DELAY = 15; // 射击延迟（帧）

// 初始化窗口和音频
Core::initWindow(SCREEN_WIDTH, SCREEN_HEIGHT, "雷霆战机 - php-raylib");
Core::setTargetFPS(60);
Audio::initAudioDevice();

// 颜色定义
$playerColor = Utils::color(0, 180, 255, 255);     // 玩家飞机颜色（亮蓝）
$bulletColor = Utils::color(255, 255, 0, 255);     // 子弹颜色（黄色）
$enemyColor = Utils::color(255, 50, 50, 255);      // 敌人颜色（红色）
$backgroundColor = Utils::color(10, 10, 30, 255);  // 背景颜色（深蓝）
$textColor = Utils::color(255, 255, 255, 255);     // 文字颜色（白色）

// 游戏变量
$player = [
    'x' => SCREEN_WIDTH / 2 - PLAYER_WIDTH / 2,
    'y' => SCREEN_HEIGHT - PLAYER_HEIGHT - 20,
    'width' => PLAYER_WIDTH,
    'height' => PLAYER_HEIGHT,
    'lives' => 3
];
$bullets = [];
$enemies = [];
$score = 0;
$shootTimer = 0;
$enemySpawnTimer = 0;
$enemySpawnRate = 60; // 敌人生成速率（帧）
$gameOver = false;

// 生成敌人
function spawnEnemy(&$enemies) {
    $x = rand(0, SCREEN_WIDTH - ENEMY_WIDTH);
    $enemies[] = [
        'x' => $x,
        'y' => -ENEMY_HEIGHT,
        'width' => ENEMY_WIDTH,
        'height' => ENEMY_HEIGHT,
        'speed' => ENEMY_SPEED + rand(0, 2) // 轻微随机速度
    ];
}

// 检测矩形碰撞
function checkCollision($rect1, $rect2) {
    return ($rect1['x'] < $rect2['x'] + $rect2['width'] &&
            $rect1['x'] + $rect1['width'] > $rect2['x'] &&
            $rect1['y'] < $rect2['y'] + $rect2['height'] &&
            $rect1['y'] + $rect1['height'] > $rect2['y']);
}

// 初始化游戏
function initGame(&$player, &$bullets, &$enemies, &$score, &$gameOver) {
    $player['x'] = SCREEN_WIDTH / 2 - PLAYER_WIDTH / 2;
    $player['y'] = SCREEN_HEIGHT - PLAYER_HEIGHT - 20;
    $player['lives'] = 3;
    $bullets = [];
    $enemies = [];
    $score = 0;
    $gameOver = false;
}

// 游戏主循环
while (!Core::windowShouldClose()) {
    // 处理输入
    if (!$gameOver) {
        // 玩家移动
        if (Core::isKeyDown(263) && $player['x'] > 0) { // 左箭头
            $player['x'] -= PLAYER_SPEED;
        }
        if (Core::isKeyDown(262) && $player['x'] < SCREEN_WIDTH - $player['width']) { // 右箭头
            $player['x'] += PLAYER_SPEED;
        }
        if (Core::isKeyDown(265) && $player['y'] > 0) { // 上箭头
            $player['y'] -= PLAYER_SPEED;
        }
        if (Core::isKeyDown(264) && $player['y'] < SCREEN_HEIGHT - $player['height']) { // 下箭头
            $player['y'] += PLAYER_SPEED;
        }
        
        // 射击控制
        $shootTimer++;
        if (Core::isKeyDown(32) && $shootTimer >= SHOOT_DELAY) { // 空格键射击
            // 发射子弹（从玩家飞机前端发出）
            $bullets[] = [
                'x' => $player['x'] + $player['width'] / 2 - BULLET_WIDTH / 2,
                'y' => $player['y'],
                'width' => BULLET_WIDTH,
                'height' => BULLET_HEIGHT
            ];
            $shootTimer = 0;
            
            // 可以在这里添加射击音效
            // Audio::playSound($shootSound);
        }
        
        // 生成敌人
        $enemySpawnTimer++;
        if ($enemySpawnTimer >= $enemySpawnRate) {
            spawnEnemy($enemies);
            $enemySpawnTimer = 0;
            // 随着分数增加提高难度（减小生成间隔）
            $enemySpawnRate = max(20, 60 - (int)($score / 1000));
        }
        
        // 更新子弹位置
        foreach ($bullets as $i => &$bullet) {
            $bullet['y'] -= BULLET_SPEED;
            // 移除超出屏幕的子弹
            if ($bullet['y'] + $bullet['height'] < 0) {
                unset($bullets[$i]);
            }
        }
        // 重置数组键
        $bullets = array_values($bullets);
        
        // 更新敌人位置
        foreach ($enemies as $i => &$enemy) {
            $enemy['y'] += $enemy['speed'];
            // 移除超出屏幕的敌人
            if ($enemy['y'] > SCREEN_HEIGHT) {
                unset($enemies[$i]);
            }
        }
        // 重置数组键
        $enemies = array_values($enemies);
        
        // 检测子弹与敌人碰撞
        foreach ($bullets as $bIndex => $bullet) {
            foreach ($enemies as $eIndex => $enemy) {
                if (checkCollision($bullet, $enemy)) {
                    // 移除被击中的敌人和子弹
                    unset($bullets[$bIndex]);
                    unset($enemies[$eIndex]);
                    $score += 100; // 击中加分
                    
                    // 可以在这里添加爆炸音效
                    // Audio::playSound($explosionSound);
                    
                    // 跳出循环，避免处理已删除的元素
                    break;
                }
            }
        }
        // 重置数组键
        $bullets = array_values($bullets);
        $enemies = array_values($enemies);
        
        // 检测玩家与敌人碰撞
        foreach ($enemies as $i => $enemy) {
            if (checkCollision($player, $enemy)) {
                // 移除碰撞的敌人
                unset($enemies[$i]);
                $player['lives']--; // 减少生命值
                
                // 可以在这里添加碰撞音效
                // Audio::playSound($hitSound);
                
                // 检查游戏是否结束
                if ($player['lives'] <= 0) {
                    $gameOver = true;
                }
                break;
            }
        }
        // 重置数组键
        $enemies = array_values($enemies);
    } else {
        // 游戏结束时按R键重新开始
        if (Core::isKeyPressed(82)) { // R键
            initGame($player, $bullets, $enemies, $score, $gameOver);
        }
    }
    
    // 绘制
    Core::beginDrawing();
    Core::clearBackground($backgroundColor);
    
    // 绘制玩家飞机
    Shapes::drawRectangle($player['x'], $player['y'], $player['width'], $player['height'], $playerColor);
    // 绘制玩家飞机的三角形头部
    Shapes::drawTriangle(
        Utils::vector2($player['x'] + $player['width'] / 2, $player['y']),
        Utils::vector2($player['x'], $player['y'] + $player['height'] / 3),
        Utils::vector2($player['x'] + $player['width'], $player['y'] + $player['height'] / 3),
        $playerColor
    );
    
    // 绘制子弹
    foreach ($bullets as $bullet) {
        Shapes::drawRectangle($bullet['x'], $bullet['y'], $bullet['width'], $bullet['height'], $bulletColor);
    }
    
    // 绘制敌人
    foreach ($enemies as $enemy) {
        Shapes::drawRectangle($enemy['x'], $enemy['y'], $enemy['width'], $enemy['height'], $enemyColor);
        // 绘制敌人的三角形底部
        Shapes::drawTriangle(
            Utils::vector2($enemy['x'] + $enemy['width'] / 2, $enemy['y'] + $enemy['height']),
            Utils::vector2($enemy['x'], $enemy['y'] + $enemy['height'] * 2 / 3),
            Utils::vector2($enemy['x'] + $enemy['width'], $enemy['y'] + $enemy['height'] * 2 / 3),
            $enemyColor
        );
    }
    
    // 绘制分数
    Text::drawText("Score: " . $score, 10, 10, 20, $textColor);
    
    // 绘制生命值
    Text::drawText("Lives: " . $player['lives'], SCREEN_WIDTH - 100, 10, 20, $textColor);
    
    // 绘制操作说明
    Text::drawText("Arrow Keys to Move  Space to Shoot", 10, SCREEN_HEIGHT - 30, 20, $textColor);
    
    // 游戏结束画面
    if ($gameOver) {
        Shapes::drawRectangle(0, 0, SCREEN_WIDTH, SCREEN_HEIGHT, Utils::color(0, 0, 0, 150));
        Text::drawText("Game Over!", SCREEN_WIDTH / 2 - 100, SCREEN_HEIGHT / 2 - 50, 30, Utils::color(255, 0, 0, 255));
        Text::drawText("Final Score: " . $score, SCREEN_WIDTH / 2 - 100, SCREEN_HEIGHT / 2, 20, $textColor);
        Text::drawText("Press R to Restart", SCREEN_WIDTH / 2 - 120, SCREEN_HEIGHT / 2 + 40, 20, $textColor);
    }
    
    Core::endDrawing();
}

// 清理资源
Audio::closeAudioDevice();
Core::closeWindow();
?>