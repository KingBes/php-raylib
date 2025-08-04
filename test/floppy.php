<?php

// 根据实际引入
require dirname(__DIR__) . '/vendor/autoload.php';

use Kingbes\Raylib\Core; // 核心类
use Kingbes\Raylib\Utils; // 工具类
use Kingbes\Raylib\Shapes; // 形状类
use Kingbes\Raylib\Text; // 文本类

const MAX_TUBES = 100; // 最大管道数
const FLOPPY_RADIUS = 24; // 小鸟半径
const TUBES_WIDTH = 80; // 管道宽度
const SCREEN_WIDTH = 800; //屏幕宽度
const SCREEN_HEIGHT = 450; // 屏幕高度


/**
 * 小鸟类
 */
class Floppy
{
    public $position; // 小鸟位置(x,y)
    public int $radius; // 小鸟碰撞半径
    public $color; // 小鸟颜色

    /**
     * 初始化小鸟
     *
     */
    public function __construct()
    {
        // 小鸟半径
        $this->radius = FLOPPY_RADIUS;
        // 初始位置
        $this->position = Utils::vector2(80, SCREEN_HEIGHT / 2 - $this->radius);
        // 默认颜色深灰色
        $this->color = Utils::color(200, 200, 200);
    }
}

/**
 * 管道类
 */
class Tubes
{
    public $rec;
    public $color;
    public bool $active;

    public function __construct()
    {
        // 初始化矩形
        $this->rec = Utils::rectangle(0, 0, TUBES_WIDTH, 255);
        // 默认灰色
        $this->color = Utils::color(100, 100, 100);
        // 不激活
        $this->active = false;
    }
}

/**
 * 主游戏类 - 封装游戏逻辑和渲染
 */
class FlappyGame
{
    // 游戏状态变量
    public bool $gameOver = false; // 游戏结束标志
    public bool $pause = false;    // 游戏暂停标志
    public int $score = 0;         // 当前分数
    public int $hiScore = 0;       // 历史最高分

    // 游戏对象
    public Floppy $floppy;         // 小鸟实例
    public array $tubes;           // 管道对象数组（每个管道对包含上下两个）
    public array $tubesPos;        // 管道位置数组（每个管道对的位置）

    // 游戏参数
    public int $tubesSpeedX = 0;   // 管道水平移动速度

    public function __construct()
    {
        Core::initWindow(SCREEN_WIDTH, SCREEN_HEIGHT, 'Flappy Bird');
        Core::setTargetFPS(60); // 设置目标帧率为60
        $this->initGame(); // 初始化游戏状态
    }

    public function initGame()
    {
        // 初始化小鸟
        $this->floppy = new Floppy();

        // 重置游戏状态
        $this->tubes = [];
        $this->tubesPos = [];
        $this->tubesSpeedX = 2;
        $this->gameOver = false;
        $this->pause = false;
        $this->score = 0;
        // var_dump($this->tubes);
        // 初始化管道位置 - 水平间隔分布
        for ($i = 0; $i < MAX_TUBES; $i++) {
            $this->tubesPos[$i] = Utils::vector2(
                400 + 280 * $i,                 // 水平位置：间隔280像素
                -Core::getRandomValue(0, 120) // 垂直位置：随机偏移
            );
        }

        // 初始化管道对象（上下成对）
        for ($i = 0; $i < MAX_TUBES * 2; $i++) {
            $tube = new Tubes();

            if ($i % 2 == 0) {
                // 上管道位置计算
                $tube->rec->x = $this->tubesPos[(int)($i / 2)]->x;
                $tube->rec->y = $this->tubesPos[(int)($i / 2)]->y;
            } else {
                // 下管道位置计算（与上管道保持固定间距）
                $tube->rec->x = $this->tubesPos[(int)($i / 2)]->x;
                $tube->rec->y = 600 + $this->tubesPos[(int)($i / 2)]->y - 255;
            }

            $tube->active = true; // 激活管道
            $this->tubes[$i] = $tube;
        }
    }

    /**
     * 更新游戏状态
     */
    public function updateGame(): void
    {
        // 游戏结束处理
        if ($this->gameOver) {
            // 按回车键重新开始游戏
            if (Core::isKeyPressed(257)) {
                $this->initGame(); // 重置游戏
                $this->gameOver = false;
            }
            return;
        }

        // 暂停/继续游戏（P键切换）
        if (Core::isKeyPressed(80)) {
            $this->pause = !$this->pause;
        }

        // 如果游戏暂停则跳过后续更新
        if ($this->pause) {
            return;
        }

        // 移动管道（向左滚动）
        foreach ($this->tubesPos as $pos) {
            $pos->x -= $this->tubesSpeedX;
        }

        // 更新管道对象的实际位置
        for ($i = 0; $i < MAX_TUBES * 2; $i++) {
            $this->tubes[$i]->rec->x = $this->tubesPos[(int)($i / 2)]->x;
        }

        // 小鸟控制逻辑
        if (Core::isKeyDown(32)) {
            // 按空格键上升
            $this->floppy->position->y -= 3;
        } else {
            // 自然下落
            $this->floppy->position->y += 1;
        }

        // 碰撞检测
        $this->checkCollisions();
    }
    /**
     * 碰撞检测逻辑
     */
    private function checkCollisions(): void
    {
        // 遍历所有管道
        for ($i = 0; $i < MAX_TUBES * 2; $i++) {
            $tube = $this->tubes[$i];
            $pairIndex = (int)($i / 2); // 管道对索引

            // 跳过非激活管道
            if (!$tube->active) continue;

            // 检测小鸟与管道碰撞
            if (Shapes::checkCollisionCircleRec(
                $this->floppy->position,
                $this->floppy->radius,
                $tube->rec
            )) {
                $this->gameOver = true; // 触发游戏结束
                return;
            }

            // 计分检测：当小鸟飞过管道对时 ,小鸟完全穿过管道
            if ($this->tubesPos[$pairIndex]->x < ($this->floppy->position->x - TUBES_WIDTH - $this->floppy->radius)) {
                // 计分并禁用该管道对
                $this->score += 100;
                $this->tubes[$pairIndex * 2]->active = false;   // 上管道
                $this->tubes[$pairIndex * 2 + 1]->active = false; // 下管道

                // 更新最高分
                if ($this->score > $this->hiScore) {
                    $this->hiScore = $this->score;
                }
            }
        }
    }

    /**
     * 渲染游戏画面
     */
    public function drawGame(): void
    {
        Core::beginDrawing(); // 开始渲染

        // 清空背景
        Core::clearBackground(Utils::color(255, 255, 255, 255));

        // 游戏进行中渲染
        if (!$this->gameOver) {
            // 绘制小鸟
            Shapes::drawCircle(
                (int)$this->floppy->position->x,
                (int)$this->floppy->position->y,
                $this->floppy->radius,
                $this->floppy->color
            );

            // 绘制所有激活的管道
            foreach ($this->tubes as $tube) {
                if ($tube->active) {
                    Shapes::drawRectangleRec($tube->rec, $tube->color);
                }
            }

            // 绘制当前分数
            Text::drawText(
                sprintf("%04d", $this->score), // 格式化分数为4位数
                20,
                20,
                40,
                // 红色
                Utils::color(255, 0, 0)
            );

            // 绘制历史最高分
            Text::drawText(
                "HI-SCORE: " . sprintf("%04d", $this->hiScore),
                20,
                70,
                20,
                // 绿色
                Utils::color(0, 255, 0)
            );

            // 暂停状态显示
            if ($this->pause) {
                $text = "GAME PAUSED";
                $textWidth = Text::measureText($text, 40);
                Text::drawText(
                    $text,
                    (SCREEN_WIDTH - $textWidth) / 2, // 水平居中
                    SCREEN_HEIGHT / 2 - 40, // 垂直居中
                    40,
                    //灰色
                    Utils::color(100, 100, 100, 255)
                );
            }
        } else {
            // 游戏结束画面
            $text = "PRESS [ENTER] TO PLAY AGAIN";
            $textWidth = Text::measureText($text, 20);
            Text::drawText(
                $text,
                (SCREEN_WIDTH - $textWidth) / 2, // 水平居中
                SCREEN_HEIGHT / 2 - 50, // 垂直居中
                20,
                Utils::color(100, 100, 100, 255)
            );
        }

        Core::endDrawing(); // 结束渲染
    }

    /**
     * 游戏主循环
     */
    public function run(): void
    {
        // 主游戏循环（检测窗口关闭按钮）
        while (!Core::windowShouldClose()) {
            $this->updateGame(); // 更新游戏逻辑
            $this->drawGame();   // 渲染游戏画面
        }

        // 游戏结束，关闭窗口
        Core::closeWindow();
    }
}

// 启动游戏
$game = new FlappyGame();
$game->run();
