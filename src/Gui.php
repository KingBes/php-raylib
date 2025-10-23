<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib;

use \FFI\CData;
use Kingbes\Raylib\Utils\Font;
use Kingbes\Raylib\Utils\Rectangle;
use Kingbes\Raylib\Utils\Color;
use Kingbes\Raylib\Utils\Vector3;
use Kingbes\Raylib\Utils\Vector2;

/**
 * Gui类
 */
class Gui extends Base
{

    /**
     * 启用gui控件（全局状态）
     *
     * @return void
     */
    public static function enable(): void
    {
        self::ffi()->GuiEnable();
    }

    /**
     * 禁用gui控件（全局状态）
     *
     * @return void
     */
    public static function disable(): void
    {
        self::ffi()->GuiDisable();
    }

    /**
     * 锁定gui控件（全局状态）
     *
     * @return void
     */
    public static function lock(): void
    {
        self::ffi()->GuiLock();
    }

    /**
     * 解锁gui控件（全局状态）
     *
     * @return void
     */
    public static function unLock(): void
    {
        self::ffi()->GuiUnlock();
    }

    /**
     * 是否锁定gui控件（全局状态）
     *
     * @return bool
     */
    public static function isLocked(): bool
    {
        return self::ffi()->GuiIsLock();
    }

    /**
     * 设置gui控件透明度（全局状态）
     *
     * @param float $alpha 透明度（0.0 - 1.0）
     * @return void
     */
    public static function setAlpha(float $alpha): void
    {
        self::ffi()->GuiSetAlpha($alpha);
    }

    /**
     * 设置gui控件状态（全局状态）
     *
     * @param bool $state 状态（true: 禁用, false: 正常）
     * @return void
     */
    public static function setState(bool $state): void
    {
        self::ffi()->GuiSetState($state ? 1 : 0);
    }

    /**
     * 获取gui控件状态（全局状态）
     *
     * @return bool
     */
    public static function getState(): bool
    {
        return self::ffi()->GuiGetState() === 1;
    }

    /**
     * 设置gui字体（全局状态）
     *
     * @param Font $font 字体
     * @return void
     */
    public static function setFont(Font $font): void
    {
        self::ffi()->GuiSetFont($font->struct());
    }

    /**
     * 获取gui字体（全局状态）
     *
     * @return Font
     */
    public static function getFont(): Font
    {
        return new Font(self::ffi()->GuiGetFont());
    }

    /**
     * 设置一个样式属性（全局状态）
     *
     * @param int $control 控件类型
     * @param int $property 属性
     * @param int $value 值
     * @return void
     */
    public static function setStyle(int $control, int $property, int $value): void
    {
        self::ffi()->GuiSetStyle($control, $property, $value);
    }

    /**
     * 获取一个样式属性
     *
     * @param int $control 控件类型
     * @param int $property 属性
     * @return int
     */
    public static function getStyle(int $control, int $property): int
    {
        return self::ffi()->GuiGetStyle($control, $property);
    }

    /**
     * 将样式文件加载到全局样式变量（.rgs）中
     *
     * @param string $filename 文件名（.rgs格式）
     * @return void
     */
    public static function loadStyle(string $filename): void
    {
        self::ffi()->GuiLoadStyle($filename);
    }

    /**
     * 加载样式默认值覆盖全局样式
     *
     * @return void
     */
    public static function loadStyleDefault(): void
    {
        self::ffi()->GuiLoadStyleDefault();
    }

    /**
     * 启用工具提示（全局状态）
     *
     * @return void
     */
    public static function enableTooltip(): void
    {
        self::ffi()->GuiEnableTooltip();
    }

    /**
     * 禁用工具提示（全局状态）
     *
     * @return void
     */
    public static function disableTooltip(): void
    {
        self::ffi()->GuiDisableTooltip();
    }

    /**
     * 设置工具提示
     *
     * @param string $text 工具提示文本
     * @return void
     */
    public static function setTooltip(string $text): void
    {
        self::ffi()->GuiSetTooltip($text);
    }


    /**
     * 图标文本
     *
     * @param int $iconId 图标ID
     * @param string $text 文本
     * @return int
     */
    public static function iconText(
        int $iconId,
        string $text
    ): int {
        return self::ffi()->GuiIconText($iconId, $text);
    }

    /**
     * 设置图标缩放比例
     *
     * @param int $scale 缩放比例（默认值：1）
     * @return void
     */
    public static function setIconScale(int $scale = 1): void
    {
        self::ffi()->GuiSetIconScale($scale);
    }

    /**
     * 获取图标数据指针
     *
     * @return CData
     */
    public static function getIcons(): CData
    {
        return self::ffi()->GuiGetIcons();
    }

    /**
     * 图标文件（.rgi）加载到内部图标数据中
     *
     * @param string $filename 文件名（.rgi格式）
     * @param bool $loadIconsName 是否加载图标名称（默认值：false）
     * @return CData
     */
    public static function loadIcons(string $filename, bool $loadIconsName = false): CData
    {
        return self::ffi()->GuiLoadIcons($filename, $loadIconsName);
    }

    /**
     * 绘制图标
     *
     * @param int $iconId 图标ID
     * @param int $posX 图标X位置
     * @param int $posY 图标Y位置
     * @param int $pixelSize 图标像素大小
     * @param Color $color 图标颜色
     * @return void
     */
    public static function drawIcon(int $iconId, int $posX, int $posY, int $pixelSize, Color $color): void
    {
        self::ffi()->GuiDrawIcon($iconId, $posX, $posY, $pixelSize, $color->struct());
    }

    /**
     * 窗口框控件，会显示一个可以关闭的窗口。
     *
     * @param Rectangle $bounds 窗口框位置
     * @param string $title 窗口标题
     * @return int
     */
    public static function windowBox(Rectangle $bounds, string $title): int
    {
        return self::ffi()->GuiWindowBox($bounds->struct(), $title);
    }

    /**
     * 带有文本名称的组框控件
     *
     * @param Rectangle $bounds 分组框位置
     * @param string $title 分组框标题
     * @return int
     */
    public static function groupBox(Rectangle $bounds, string $title): int
    {
        return self::ffi()->GuiGroupBox($bounds->struct(), $title);
    }

    /**
     * 行分隔符控件功能，可以包含文本内容
     *
     * @param Rectangle $bounds 行分隔符位置
     * @param string $text 行分隔符文本
     * @return int
     */
    public static function line(Rectangle $bounds, string $text): int
    {
        return self::ffi()->GuiLine($bounds->struct(), $text);
    }

    /**
     * 面板控件，用于组织其他控件
     *
     * @param Rectangle $bounds 面板位置
     * @param string $title 面板标题
     * @return int
     */
    public static function panel(Rectangle $bounds, string $title): int
    {
        return self::ffi()->GuiPanel($bounds->struct(), $title);
    }

    /**
     * 标签栏控件，返回“TAB”以表示关闭或返回 -1
     *
     * @param Rectangle $bounds 标签栏位置
     * @param array<int,string> $titles 标签栏标题数组
     * @param int &$active 当前激活标签索引
     * @return int
     */
    public static function tabBar(
        Rectangle $bounds,
        array $titles,
        int &$active
    ): int {
        $c_titles = self::ffi()->new('char*[' . count($titles) . ']', false);
        foreach ($titles as $i => $str) {
            $c_str = self::ffi()->new('char[' . strlen($str) + 1 . ']', false);
            self::ffi()::memcpy($c_str, $str, strlen($str));
            $c_titles[$i] = self::ffi()->cast('char *', $c_str);
        }
        $c_active = self::ffi()->new('int[1]', false);
        $c_active[0] = $active;
        $c_active_ptr = self::ffi()->cast('int *', $c_active);
        $res =  self::ffi()->GuiTabBar(
            $bounds->struct(),
            self::ffi()->cast('char **', $c_titles),
            count($titles),
            $c_active_ptr,
        );
        $active = $c_active_ptr[0];
        unset($c_active); // 释放内存
        unset($c_active_ptr); // 释放内存
        unset($c_titles); // 释放内存
        return $res;
    }

    /**
     * 滚动面板控件，用于包含多个子控件
     *
     * @param Rectangle Rectangle $bounds 滚动面板位置
     * @param string $title 滚动面板标题
     * @param Rectangle $content 滚动面板内容
     * @param Vector2 &$scroll 滚动条位置
     * @param Rectangle &$view 视图位置
     * @return int
     */
    public static function scrollPanel(Rectangle $bounds, string $title, Rectangle $content, Vector2 &$scroll, Rectangle &$view): int
    {
        $c_scroll = self::ffi()->cast('Vector2 *', $scroll->struct());
        $c_view = self::ffi()->cast('Rectangle *', $view->struct());
        $res = self::ffi()->GuiScrollPanel(
            $bounds->struct(),
            $title,
            $content->struct(),
            $c_scroll,
            $c_view
        );
        $scroll = new Vector2($c_scroll[0]->x, $c_scroll[0]->y);
        $view = new Rectangle(
            $c_view[0]->x,
            $c_view[0]->y,
            $c_view[0]->width,
            $c_view[0]->height
        );
        unset($c_scroll); // 释放内存
        unset($c_view); // 释放内存
        return $res;
    }

    /**
     * 标签控件，用于显示文本
     *
     * @param Rectangle $bounds 标签位置
     * @param string $text 标签文本
     * @return int
     */
    public static function label(Rectangle $bounds, string $text): int
    {
        return self::ffi()->GuiLabel($bounds->struct(), $text);
    }

    /**
     * 按钮控件
     *
     * @param Rectangle $bounds 按钮位置
     * @param string $text 按钮文本
     * @return int
     */
    public static function button(Rectangle $bounds, string $text): int
    {
        return self::ffi()->GuiButton($bounds->struct(), $text);
    }

    /**
     * 标签按钮控件
     *
     * @param Rectangle $bounds 标签按钮位置
     * @param string $text 标签按钮文本
     * @return int
     */
    public static function labelButton(Rectangle $bounds, string $text): int
    {
        return self::ffi()->GuiLabelButton($bounds->struct(), $text);
    }

    /**
     * 切换按钮控件
     *
     * @param Rectangle $bounds 切换按钮位置
     * @param string $text 切换按钮文本
     * @param bool &$active 是否激活
     * @return int
     */
    public static function toggle(Rectangle $bounds, string $text, bool &$active): int
    {
        $c_active = self::ffi()->new('bool');
        $c_active = $active;
        $cc_active = self::ffi()->cast('bool *', $c_active);
        $res = self::ffi()->GuiToggle(
            $bounds->struct(),
            $text,
            $cc_active
        );
        $active = $cc_active[0];
        unset($c_active); // 释放内存
        unset($cc_active); // 释放内存
        return $res;
    }

    /**
     * 切换按钮组控件
     *
     * @param Rectangle $bounds 切换按钮组位置
     * @param string $text 切换按钮组文本
     * @param int &$active 激活按钮索引
     * @return int
     */
    public static function toggleGroup(Rectangle $bounds, string $text, int &$active): int
    {
        $c_active = self::ffi()->new('int');
        $c_active = $active;
        $cc_active = self::ffi()->cast('int *', $c_active);
        $res = self::ffi()->GuiToggleGroup(
            $bounds->struct(),
            $text,
            $cc_active
        );
        $active = $cc_active[0];
        unset($c_active); // 释放内存
        unset($cc_active); // 释放内存
        return $res;
    }

    /**
     * 切换滑块控件
     *
     * @param Rectangle $bounds 切换滑块位置
     * @param string $text 切换滑块文本
     * @param int &$active 是否激活
     * @return int
     */
    public static function toggleSlider(Rectangle $bounds, string $text, int &$active): int
    {
        $c_active = self::ffi()->new('int');
        $c_active = $active;
        $cc_active = self::ffi()->cast('int *', $c_active);
        $res = self::ffi()->GuiToggleSlider(
            $bounds->struct(),
            $text,
            $cc_active
        );
        $active = $cc_active[0];
        unset($c_active); // 释放内存
        unset($cc_active); // 释放内存
        return $res;
    }

    /**
     * 复选框控件
     *
     * @param Rectangle $bounds 复选框位置
     * @param string $text 复选框文本
     * @param bool &$active 是否激活
     * @return int
     */
    public static function checkBox(Rectangle $bounds, string $text, bool &$active): int
    {
        $c_active = self::ffi()->new('bool');
        $c_active = $active;
        $cc_active = self::ffi()->cast('bool *', $c_active);
        $res = self::ffi()->GuiCheckBox(
            $bounds->struct(),
            $text,
            $cc_active
        );
        $active = $cc_active[0];
        unset($c_active); // 释放内存
        unset($cc_active); // 释放内存
        return $res;
    }

    /**
     * 组合框控件
     *
     * @param Rectangle $bounds 组合框位置
     * @param string $text 组合框文本
     * @param array &$active 激活项索引
     * @return int
     */
    public static function comboBox(Rectangle $bounds, string $text, array &$active = []): int
    {
        $c_actives = self::ffi()->new('int[' . count($active) . ']');
        for ($i = 0; $i < count($active); $i++) {
            $c_actives[$i] = $active[$i];
        }
        $cc_actives = self::ffi()->cast('int *', $c_actives);
        $res = self::ffi()->GuiComboBox(
            $bounds->struct(),
            $text,
            $cc_actives
        );
        for ($i = 0; $i < count($active); $i++) {
            $active[$i] = $cc_actives[$i];
        }
        unset($c_actives); // 释放内存
        unset($cc_actives); // 释放内存
        return $res;
    }

    /**
     * 下拉框控件
     *
     * @param Rectangle $bounds 下拉框位置
     * @param string $text 下拉框文本 ‘;’分隔
     * @param int &$active 激活项索引
     * @param bool $editMode 是否编辑模式，默认值为false
     * @return int
     */
    public static function dropdownBox(Rectangle $bounds, string $text, int &$active, bool $editMode = false): int
    {
        $c_actives = self::ffi()->new('int[1]');
        $c_actives[0] = $active;
        $cc_actives = self::ffi()->cast('int *', $c_actives);
        $res = self::ffi()->GuiDropdownBox(
            $bounds->struct(),
            $text,
            $cc_actives,
            $editMode
        );
        $active = $cc_actives[0];
        unset($c_actives); // 释放内存
        unset($cc_actives); // 释放内存
        return $res;
    }

    /**
     * 微调框控件
     *
     * @param Rectangle $bounds 微调框位置
     * @param string $text 微调框文本
     * @param int &$value 微调框值
     * @param int $min 最小值
     * @param int $max 最大值
     * @param bool $editMode 是否编辑模式，默认值为false
     * @return int
     */
    public static function spinner(Rectangle $bounds, string $text, int &$value, int $minValue, int $maxValue, bool $editMode = false): int
    {
        $c_value = self::ffi()->new('int[1]');
        $c_value[0] = $value;
        $cc_value = self::ffi()->cast('int *', $c_value);
        $res = self::ffi()->GuiSpinner(
            $bounds->struct(),
            $text,
            $cc_value,
            $minValue,
            $maxValue,
            $editMode
        );
        $value = $cc_value[0];
        unset($c_value); // 释放内存
        unset($cc_value); // 释放内存
        return $res;
    }

    /**
     * 值框控件
     *
     * @param Rectangle $bounds 值框位置
     * @param string $text 值框文本
     * @param int &$value 值框值
     * @param int $min 最小值
     * @param int $max 最大值
     * @param bool $editMode 是否编辑模式，默认值为false
     * @return int
     */
    public static function valueBox(Rectangle $bounds, string $text, int &$value, int $minValue, int $maxValue, bool $editMode = false): int
    {
        $c_value = self::ffi()->new('int[1]');
        $c_value[0] = $value;
        $cc_value = self::ffi()->cast('int *', $c_value);
        $res = self::ffi()->GuiValueBox(
            $bounds->struct(),
            $text,
            self::ffi()::addr($c_value),
            $minValue,
            $maxValue,
            $editMode
        );
        $value = $cc_value[0];
        unset($c_value); // 释放内存
        unset($cc_value); // 释放内存
        return $res;
    }

    /**
     * 文本框控件
     *
     * @param Rectangle $bounds 文本框位置
     * @param string &$text 文本框文本
     * @param int $textSize 文本框大小
     * @param bool $editMode 是否编辑模式，默认值为false
     * @return int
     */
    public static function textBox(Rectangle $bounds, string &$text, int $textSize, bool $editMode = false): int
    {
        $c_text = self::ffi()->new('char[' . strlen($text) + 1  . ']');
        self::ffi()::memcpy($c_text, $text, strlen($text));
        $cc_text = self::ffi()->cast('char *', $c_text);
        $res = self::ffi()->GuiTextBox(
            $bounds->struct(),
            $cc_text,
            $textSize,
            $editMode
        );
        $text = self::ffi()::string($cc_text);
        unset($c_text); // 释放内存
        unset($cc_text); // 释放内存
        return $res;
    }

    /**
     * 滑块控件
     *
     * @param Rectangle $bounds 滑块位置
     * @param string $textLeft 滑块左侧文本
     * @param string $textRight 滑块右侧文本
     * @param float &$value 滑块值
     * @param float $min 最小值
     * @param float $max 最大值
     * @return int
     */
    public static function slider(Rectangle $bounds, string $textLeft, string $textRight, float &$value, float $minValue, float $maxValue): int
    {
        $c_value = self::ffi()->new('float[1]');
        $c_value[0] = $value;
        $cc_value = self::ffi()->cast('float *', $c_value);
        $res = self::ffi()->GuiSlider(
            $bounds->struct(),
            $textLeft,
            $textRight,
            $cc_value,
            $minValue,
            $maxValue
        );
        $value = $cc_value[0];
        unset($c_value); // 释放内存
        unset($cc_value); // 释放内存
        return $res;
    }

    /**
     * 滑块条控件
     *
     * @param Rectangle $bounds 滑块条位置
     * @param string $textLeft 滑块条左侧文本
     * @param string $textRight 滑块条右侧文本
     * @param float &$value 滑块条值
     * @param float $min 最小值
     * @param float $max 最大值
     * @return int
     */
    public static function sliderBar(Rectangle $bounds, string $textLeft, string $textRight, float &$value, float $minValue, float $maxValue): int
    {
        $c_value = self::ffi()->new('float[1]');
        $c_value[0] = $value;
        $cc_value = self::ffi()->cast('float *', $c_value);
        $res = self::ffi()->GuiSliderBar(
            $bounds->struct(),
            $textLeft,
            $textRight,
            $cc_value,
            $minValue,
            $maxValue
        );
        $value = $cc_value[0];
        unset($c_value); // 释放内存
        unset($cc_value); // 释放内存
        return $res;
    }

    /**
     * 进度条控件
     *
     * @param Rectangle $bounds 进度条位置
     * @param string $textLeft 进度条左侧文本
     * @param string $textRight 进度条右侧文本
     * @param float &$value 进度条值
     * @param float $min 最小值
     * @param float $max 最大值
     * @return int
     */
    public static function progressBar(Rectangle $bounds, string $textLeft, string $textRight, float &$value, float $minValue, float $maxValue): int
    {
        $c_value = self::ffi()->new('float[1]');
        $c_value[0] = $value;
        $cc_value = self::ffi()->cast('float *', $c_value);
        $res = self::ffi()->GuiProgressBar(
            $bounds->struct(),
            $textLeft,
            $textRight,
            $cc_value,
            $minValue,
            $maxValue
        );
        $value = $cc_value[0];
        unset($c_value); // 释放内存
        unset($cc_value); // 释放内存
        return $res;
    }

    /**
     * 状态条控件
     *
     * @param Rectangle $bounds 状态条位置
     * @param string $text 状态条文本
     * @return int
     */
    public static function statusBar(Rectangle $bounds, string $text): int
    {
        return self::ffi()->GuiStatusBar($bounds->struct(), $text);
    }

    /**
     * 占位符的虚拟控制
     *
     * @param Rectangle $bounds 空矩形位置
     * @param string $text 空矩形文本
     * @return int
     */
    public static function dummyRect(Rectangle $bounds, string $text): int
    {
        return self::ffi()->GuiDummyRect($bounds->struct(), $text);
    }

    /**
     * 网格控件
     *
     * @param Rectangle $bounds 网格位置
     * @param string $text 网格文本
     * @param float $spacing 网格间距
     * @param int $subdivs 网格子分
     * @param Vector2 $mouseCell 鼠标所在单元格
     * @return void
     */
    public static function grid(Rectangle $bounds, string $text, float $spacing, int $subdivs, Vector2 &$mouseCell = new Vector2(0, 0)): void
    {
        $c_mouseCell = self::ffi()->new('Vector2[1]');
        $c_mouseCell[0] = $mouseCell->struct();
        $cc_mouseCell = self::ffi()->cast('Vector2 *', $c_mouseCell);
        self::ffi()->GuiGrid(
            $bounds->struct(),
            $text,
            $spacing,
            $subdivs,
            $cc_mouseCell
        );
        $mouseCell->x = $cc_mouseCell[0]->x;
        $mouseCell->y = $cc_mouseCell[0]->y;
        unset($c_mouseCell); // 释放内存
        unset($cc_mouseCell); // 释放内存
    }

    /**
     * 列表视图控件
     *
     * @param Rectangle $bounds 列表视图位置
     * @param string $text 列表视图文本
     * @param int &$scrollIndex 滚动索引
     * @param int &$active 活动索引
     * @return void
     */
    public static function listView(Rectangle $bounds, string $text, int &$scrollIndex = 0, int &$active = -1): void
    {
        $c_scrollIndex = self::ffi()->new('int[1]');
        $c_scrollIndex[0] = $scrollIndex;
        $cc_scrollIndex = self::ffi()->cast('int *', $c_scrollIndex);
        $c_active = self::ffi()->new('int[1]');
        $c_active[0] = $active;
        $cc_active = self::ffi()->cast('int *', $c_active);
        self::ffi()->GuiListView(
            $bounds->struct(),
            $text,
            $cc_scrollIndex,
            $cc_active
        );
        $scrollIndex = $cc_scrollIndex[0];
        $active = $cc_active[0];
        unset($c_scrollIndex); // 释放内存
        unset($cc_scrollIndex); // 释放内存
        unset($c_active); // 释放内存
        unset($cc_active); // 释放内存
    }

    /**
     * 列表视图扩展控件
     *
     * @param Rectangle $bounds 列表视图位置
     * @param array<int,string> &$text 列表视图文本
     * @param int &$scrollIndex 滚动索引
     * @param int &$active 活动索引
     * @param int &$focus 焦点索引
     * @return void
     */
    public static function listViewEx(Rectangle $bounds, array &$text, int &$scrollIndex, int &$active, int &$focus): void
    {
        $c_texts = self::ffi()->new("char *[" . count($text) . "]", false);
        foreach ($text as $i => $item) {
            $c_text = self::ffi()->new("char[" . strlen($item) + 1 . "]", false);
            self::ffi()::memcpy($c_text, $item, strlen($item));
            $c_texts[$i] = self::ffi()->cast('char *', $c_text);
        }
        $c_scrollIndex = self::ffi()->new('int[1]');
        $c_scrollIndex[0] = $scrollIndex;
        $cc_scrollIndex = self::ffi()->cast('int *', $c_scrollIndex);
        $c_active = self::ffi()->new('int[1]');
        $c_active[0] = $active;
        $cc_active = self::ffi()->cast('int *', $c_active);
        $c_focus = self::ffi()->new('int[1]');
        $c_focus[0] = $focus;
        $cc_focus = self::ffi()->cast('int *', $c_focus);
        self::ffi()->GuiListViewEx(
            $bounds->struct(),
            $c_texts,
            count($text),
            $cc_scrollIndex,
            $cc_active,
            $cc_focus
        );
        for ($i = 0; $i < count($text); $i++) {
            $text[$i] = self::ffi()::string($c_texts[$i]);
        }
        $scrollIndex = $cc_scrollIndex[0];
        $active = $cc_active[0];
        $focus = $cc_focus[0];
        unset($c_texts); // 释放内存
        unset($c_scrollIndex); // 释放内存
        unset($cc_scrollIndex); // 释放内存
        unset($c_active); // 释放内存
        unset($cc_active); // 释放内存
        unset($c_focus); // 释放内存
        unset($cc_focus); // 释放内存
    }

    /**
     * 消息框控件
     *
     * @param CData $bounds 消息框位置
     * @param string $title 消息框标题
     * @param string $message 消息框文本
     * @param string $buttons 消息框按钮
     * @return int
     */
    public static function messageBox(
        Rectangle $bounds,
        string $title,
        string $message,
        string $buttons
    ): int {
        return self::ffi()->GuiMessageBox($bounds->struct(), $title, $message, $buttons);
    }

    /**
     * 文本输入框控件
     *
     * @param Rectangle $bounds 文本输入框位置
     * @param string $title 文本输入框标题
     * @param string $message 文本输入框消息
     * @param string $buttons 文本输入框按钮
     * @param string $text 文本输入框值
     * @param int $textMaxSize 最大字符数
     * @param bool &$secretViewActive 密码视图激活
     * @return int
     */
    public static function textInputBox(
        Rectangle $bounds,
        string $title,
        string $message,
        string $buttons,
        string $text,
        int $textMaxSize,
        bool &$secretViewActive
    ): int {
        $c_secretViewActive = self::ffi()->new('bool[1]');
        $c_secretViewActive[0] = $secretViewActive;
        $cc_secretViewActive = self::ffi()->cast('bool *', $c_secretViewActive);
        $res = self::ffi()->GuiTextInputBox(
            $bounds->struct(),
            $title,
            $message,
            $buttons,
            $text,
            $textMaxSize,
            $cc_secretViewActive
        );
        $secretViewActive = $cc_secretViewActive[0];
        unset($c_secretViewActive); // 释放内存
        unset($cc_secretViewActive); // 释放内存
        return $res;
    }

    /**
     * 颜色选择器控件
     *
     * @param Rectangle $bounds 颜色选择器位置
     * @param string $title 颜色选择器标题
     * @param color $color 颜色选择器值
     * @return int
     */
    public static function colorPicker(Rectangle $bounds, string $title, color &$color): int
    {
        $c_color = self::ffi()->new('color [1]');
        $c_color[0] = $color->struct();
        $cc_color = self::ffi()->cast('color *', $c_color);
        $res = self::ffi()->GuiColorPicker(
            $bounds->struct(),
            $title,
            $cc_color
        );
        $color->r = $cc_color[0]->r;
        $color->g = $cc_color[0]->g;
        $color->b = $cc_color[0]->b;
        $color->a = $cc_color[0]->a;
        unset($c_color); // 释放内存
        unset($cc_color); // 释放内存
        return $res;
    }

    /**
     * 颜色面板控件
     *
     * @param Rectangle $bounds 颜色面板位置
     * @param string $title 颜色面板标题
     * @param color $color 颜色面板值
     * @return int
     */
    public static function colorPanel(Rectangle $bounds, string $title, color &$color): int
    {
        $c_color = self::ffi()->new('color [1]');
        $c_color[0] = $color->struct();
        $cc_color = self::ffi()->cast('color *', $c_color);
        $res = self::ffi()->GuiColorPanel($bounds->struct(), $title, $cc_color);
        $color->r = $cc_color[0]->r;
        $color->g = $cc_color[0]->g;
        $color->b = $cc_color[0]->b;
        $color->a = $cc_color[0]->a;
        unset($c_color); // 释放内存
        unset($cc_color); // 释放内存
        return $res;
    }

    /**
     * 颜色条控件
     *
     * @param Rectangle $bounds 颜色条位置
     * @param string $title 颜色条标题
     * @param float $alpha 颜色条值
     * @return int
     */
    public static function colorBarAlpha(Rectangle $bounds, string $title, float &$alpha): int
    {
        $c_alpha = self::ffi()->new('float[1]');
        $c_alpha[0] = $alpha;
        $cc_alpha = self::ffi()->cast('float *', $c_alpha);
        $res = self::ffi()->GuiColorBarAlpha(
            $bounds->struct(),
            $title,
            $cc_alpha
        );
        $alpha = $cc_alpha[0];
        unset($c_alpha); // 释放内存
        unset($cc_alpha); // 释放内存
        return $res;
    }

    /**
     * 颜色条控件
     *
     * @param Rectangle $bounds 颜色条位置
     * @param string $title 颜色条标题
     * @param float $value 颜色条值
     * @return int
     */
    public static function colorBarHue(Rectangle $bounds, string $title, float $value): int
    {
        $c_value = self::ffi()->new('float[1]');
        $c_value[0] = $value;
        $cc_value = self::ffi()->cast('float *', $c_value);
        $res = self::ffi()->GuiColorBarHue($bounds->struct(), $title, $cc_value);
        $value = $cc_value[0];
        unset($c_value); // 释放内存
        unset($cc_value); // 释放内存
        return $res;
    }

    /**
     * 颜色选择器HSV控件
     *
     * @param Rectangle $bounds 颜色选择器HSV位置
     * @param string $title 颜色选择器HSV标题
     * @param Vector3 $colorHsv 颜色选择器HSV值
     * @return int
     */
    public static function colorPickerHSV(Rectangle $bounds, string $title, Vector3 &$colorHsv): int
    {
        $c_colorHsv = self::ffi()->new('Vector3[1]');
        $c_colorHsv[0] = $colorHsv->struct();
        $cc_colorHsv = self::ffi()->cast('Vector3 *', $c_colorHsv);
        $res = self::ffi()->GuiColorPickerHSV($bounds->struct(), $title, $cc_colorHsv);
        $colorHsv->x = $cc_colorHsv[0]->x;
        $colorHsv->y = $cc_colorHsv[0]->y;
        $colorHsv->z = $cc_colorHsv[0]->z;
        unset($c_colorHsv); // 释放内存
        unset($cc_colorHsv); // 释放内存
        return $res;
    }

    /**
     * 颜色面板HSV控件
     *
     * @param Rectangle $bounds 颜色面板HSV位置
     * @param string $title 颜色面板HSV标题
     * @param Vector3 $colorHsv 颜色面板HSV值
     * @return int
     */
    public static function colorPanelHSV(Rectangle $bounds, string $title, Vector3 &$colorHsv): int
    {
        $c_colorHsv = self::ffi()->new('Vector3[1]');
        $c_colorHsv[0] = $colorHsv->struct();
        $cc_colorHsv = self::ffi()->cast('Vector3 *', $c_colorHsv);
        $res = self::ffi()->GuiColorPanelHSV($bounds->struct(), $title, $cc_colorHsv);
        $colorHsv->x = $cc_colorHsv[0]->x;
        $colorHsv->y = $cc_colorHsv[0]->y;
        $colorHsv->z = $cc_colorHsv[0]->z;
        unset($c_colorHsv); // 释放内存
        unset($cc_colorHsv); // 释放内存
        return $res;
    }
}
