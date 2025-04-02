<?php

include 'vendor/autoload.php';

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

use Kingbes\Raylib\Audio;
use Kingbes\Raylib\Core;
use Kingbes\Raylib\Gestures;
use Kingbes\Raylib\Models;
use Kingbes\Raylib\Text;
use Kingbes\Raylib\Texture;
use Kingbes\Raylib\Utils;

$methods = getClassMethodsWithComments(Utils::class);

$md = "";
foreach ($methods as $method) {
    $md .= "#### {$method['title']}\n\n";
    $md .= "方法 `{$method['method']}`\n\n";
    $md .= "```php\n";
    $md.= "{$method['comment']}\n";
    $md.= "```\n\n";
}

file_put_contents('Audio.md', $md);