<?php

require dirname(__DIR__) . '/vendor/autoload.php';

/**
 * 获取类的所有方法信息（包含方法名、标题、注释和类型）
 * @param string $className 类名
 * @return array 结构化方法数据
 */
function getClassMethodsWithComments(string $className): array
{
    if (!class_exists($className)) {
        trigger_error("[{$className}] 类不存在", E_USER_WARNING);
        return [];
    }

    $reflection = new ReflectionClass($className);
    $result = [];

    foreach ($reflection->getMethods() as $method) {
        $rawComment = $method->getDocComment();
        $title = '无说明';
        $comment = '无注释';

        if ($rawComment !== false) {
            // 按行分割注释（跳过首行 /**）
            $lines = explode("\n", $rawComment);
            array_shift($lines); // 丢弃第一行 "/**"

            // 处理剩余行
            $cleanedLines = [];
            foreach ($lines as $line) {
                $line = trim(preg_replace('/^[\s*\/*]+/', '', trim($line))); // 清理行首符号
                if ($line !== '') $cleanedLines[] = $line;
            }

            // 提取标题和注释主体
            if (!empty($cleanedLines)) {
                $title = array_shift($cleanedLines);
                $comment = $rawComment;
            }
        }

        // 构建结果
        $result[] = [
            'method'  => $method->getName(),
            'title'   => $title ?: '无说明',
            'comment' => $comment ?: '无注释',
            'type'    => implode(' ', Reflection::getModifierNames($method->getModifiers()))
        ];
    }

    return $result;
}

use Kingbes\Raylib\Core; //核心类
use Kingbes\Raylib\Audio; //音频类
use Kingbes\Raylib\Shapes; //图形类
use Kingbes\Raylib\Text; //文本类
use Kingbes\Raylib\Textures; //纹理类
use Kingbes\Raylib\Models; //模型类
use Kingbes\Raylib\Utils; //工具类

$Core = getClassMethodsWithComments(Core::class);

$Core_md = "";
foreach ($Core as $method) {
    $Core_md .= "#### {$method['title']}\n\n";
    $Core_md .= "方法 `{$method['method']}`\n\n";
    $Core_md .= "```php\n";
    $Core_md .= "{$method['comment']}\n";
    $Core_md .= "```\n\n";
}

file_put_contents(dirname(__DIR__) . '/markdown/Core.md', $Core_md);

$Audio = getClassMethodsWithComments(Audio::class);
$Audio_md = "";
foreach ($Audio as $method) {
    $Audio_md .= "#### {$method['title']}\n\n";
    $Audio_md .= "方法 `{$method['method']}`\n\n";
    $Audio_md .= "```php\n";
    $Audio_md .= "{$method['comment']}\n";
    $Audio_md .= "```\n\n";
}
file_put_contents(dirname(__DIR__) . '/markdown/Audio.md', $Audio_md);

$Shapes = getClassMethodsWithComments(Shapes::class);
$Shapes_md = "";
foreach ($Shapes as $method) {
    $Shapes_md .= "#### {$method['title']}\n\n";
    $Shapes_md .= "方法 `{$method['method']}`\n\n";
    $Shapes_md .= "```php\n";
    $Shapes_md .= "{$method['comment']}\n";
    $Shapes_md .= "```\n\n";
}
file_put_contents(dirname(__DIR__) . '/markdown/Shapes.md', $Shapes_md);

$Text = getClassMethodsWithComments(Text::class);
$Text_md = "";
foreach ($Text as $method) {
    $Text_md .= "#### {$method['title']}\n\n";
    $Text_md .= "方法 `{$method['method']}`\n\n";
    $Text_md .= "```php\n";
    $Text_md .= "{$method['comment']}\n";
    $Text_md .= "```\n\n";
}
file_put_contents(dirname(__DIR__) . '/markdown/Text.md', $Text_md);

$Textures = getClassMethodsWithComments(Textures::class);
$Textures_md = "";
foreach ($Textures as $method) {
    $Textures_md .= "#### {$method['title']}\n\n";
    $Textures_md .= "方法 `{$method['method']}`\n\n";
    $Textures_md .= "```php\n";
    $Textures_md .= "{$method['comment']}\n";
    $Textures_md .= "```\n\n";
}
file_put_contents(dirname(__DIR__) . '/markdown/Textures.md', $Textures_md);

$Models = getClassMethodsWithComments(Models::class);
$Models_md = "";
foreach ($Models as $method) {
    $Models_md .= "#### {$method['title']}\n\n";
    $Models_md .= "方法 `{$method['method']}`\n\n";
    $Models_md .= "```php\n";
    $Models_md .= "{$method['comment']}\n";
    $Models_md .= "```\n\n";
}
file_put_contents(dirname(__DIR__) . '/markdown/Models.md', $Models_md);

$Utils = getClassMethodsWithComments(Utils::class);
$Utils_md = "";
foreach ($Utils as $method) {
    $Utils_md .= "#### {$method['title']}\n\n";
    $Utils_md .= "方法 `{$method['method']}`\n\n";
    $Utils_md .= "```php\n";
    $Utils_md .= "{$method['comment']}\n";
    $Utils_md .= "```\n\n";
}
file_put_contents(dirname(__DIR__) . '/markdown/Utils.md', $Utils_md);
