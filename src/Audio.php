<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib;

use Kingbes\Raylib\Utils\Sound;
use Kingbes\Raylib\Utils\Wave;
use Kingbes\Raylib\Utils\Music;
use Kingbes\Raylib\Utils\AudioStream;

/**
 * Audio类
 */
class Audio extends Base
{
    //### 音频设备管理函数

    /**
     * 初始化音频设备和上下文
     *
     * @return void
     */
    public static function initAudioDevice(): void
    {
        self::ffi()->InitAudioDevice();
    }

    /**
     * 关闭音频设备和上下文
     *
     * @return void
     */
    public static function closeAudioDevice(): void
    {
        self::ffi()->CloseAudioDevice();
    }

    /**
     * 检查音频设备是否初始化成功
     *
     * @return bool 是否已准备好
     */
    public static function isAudioDeviceReady(): bool
    {
        return self::ffi()->IsAudioDeviceReady();
    }

    /**
     * 设置主音量（监听器音量）
     *
     * @param float $volume 音量值，范围通常为0.0到1.0
     * @return void
     */
    public static function setMasterVolume(float $volume): void
    {
        self::ffi()->SetMasterVolume($volume);
    }

    /**
     * 获取主音量值
     *
     * @return float 当前音量值
     */
    public static function getMasterVolume(): float
    {
        return self::ffi()->GetMasterVolume();
    }

    //### Wave/Sound 加载/卸载函数

    /**
     * 从文件加载Wave数据
     *
     * @param string $fileName 文件名
     * @return Wave Wave对象
     */
    public static function loadWave(string $fileName): Wave
    {
        return new Wave(self::ffi()->LoadWave($fileName));
    }

    /**
     * 从内存加载Wave（fileType为扩展名，如.wav）
     *
     * @param string $fileType 文件类型（例如".wav"）
     * @param string $fileData 文件数据
     * @param int $dataSize 数据大小
     * @return Wave Wave对象
     */
    public static function loadWaveFromMemory(string $fileType, string $fileData, int $dataSize): Wave
    {
        return new Wave(self::ffi()->LoadWaveFromMemory($fileType, $fileData, $dataSize));
    }

    /**
     * 检查Wave数据有效性
     *
     * @param Wave $wave Wave对象
     * @return bool 是否有效
     */
    public static function isWaveValid(Wave $wave): bool
    {
        return self::ffi()->IsWaveValid($wave->struct());
    }

    /**
     * 从文件加载声音
     *
     * @param string $fileName 文件名
     * @return Sound Sound对象
     */
    public static function loadSound(string $fileName): Sound
    {
        return new Sound(self::ffi()->LoadSound($fileName));
    }

    /**
     * 从Wave数据加载声音
     *
     * @param Wave $wave Wave对象
     * @return Sound Sound对象
     */
    public static function loadSoundFromWave(Wave $wave): Sound
    {
        return new Sound(self::ffi()->LoadSoundFromWave($wave->struct()));
    }

    /**
     * 创建共享样本数据的声音别名
     *
     * @param Sound $source Sound对象
     * @return Sound Sound对象（别名）
     */
    public static function loadSoundAlias(Sound $source): Sound
    {
        return new Sound(self::ffi()->LoadSoundAlias($source->struct()));
    }

    /**
     * 检查声音有效性
     *
     * @param Sound $sound Sound对象
     * @return bool 是否有效
     */
    public static function isSoundValid(Sound $sound): bool
    {
        return self::ffi()->IsSoundValid($sound->struct());
    }

    /**
     * 更新声音缓冲区数据
     *
     * @param Sound $sound Sound对象
     * @param string $data 数据指针
     * @param int $sampleCount 样本数量
     * @return void
     */
    public static function updateSound(Sound $sound, string $data, int $sampleCount): void
    {
        $c_data = self::ffi()->new("char[" . strlen($data) . "]");
        self::ffi()::memcpy($c_data, $data, strlen($data));
        self::ffi()->UpdateSound($sound->struct(), self::ffi()::addr($c_data), $sampleCount);
    }

    /**
     * 卸载Wave数据
     *
     * @param Wave $wave Wave对象
     * @return void
     */
    public static function unloadWave(Wave $wave): void
    {
        self::ffi()->UnloadWave($wave->struct());
    }

    /**
     * 卸载声音
     *
     * @param Sound $sound Sound对象
     * @return void
     */
    public static function unloadSound(Sound $sound): void
    {
        self::ffi()->UnloadSound($sound->struct());
    }

    /**
     * 卸载声音别名（不释放样本数据）
     *
     * @param Sound $alias Sound对象（别名）
     * @return void
     */
    public static function unloadSoundAlias(Sound $alias): void
    {
        self::ffi()->UnloadSoundAlias($alias->struct());
    }

    /**
     * 导出Wave数据到文件
     *
     * @param Wave $wave Wave对象
     * @param string $fileName 文件名
     * @return bool 是否成功
     */
    public static function exportWave(Wave $wave, string $fileName): bool
    {
        return self::ffi()->ExportWave($wave->struct(), $fileName);
    }

    /**
     * 将Wave采样数据导出为C代码(.h)
     *
     * @param Wave $wave Wave对象
     * @param string $fileName 文件名
     * @return bool 是否成功
     */
    public static function exportWaveAsCode(Wave $wave, string $fileName): bool
    {
        return self::ffi()->ExportWaveAsCode($wave->struct(), $fileName);
    }

    //### Wave/Sound 管理函数

    /**
     * 播放声音
     *
     * @param Sound $sound Sound对象
     * @return void
     */
    public static function playSound(Sound $sound): void
    {
        self::ffi()->PlaySound($sound->struct());
    }

    /**
     * 停止播放声音
     *
     * @param Sound $sound Sound对象
     * @return void
     */
    public static function stopSound(Sound $sound): void
    {
        self::ffi()->StopSound($sound->struct());
    }

    /**
     * 暂停声音
     *
     * @param Sound $sound Sound对象
     * @return void
     */
    public static function pauseSound(Sound $sound): void
    {
        self::ffi()->PauseSound($sound->struct());
    }

    /**
     * 恢复暂停的声音
     *
     * @param Sound $sound Sound对象
     * @return void
     */
    public static function resumeSound(Sound $sound): void
    {
        self::ffi()->ResumeSound($sound->struct());
    }

    /**
     * 检查声音是否正在播放
     *
     * @param Sound $sound Sound对象
     * @return bool 是否正在播放
     */
    public static function isSoundPlaying(Sound $sound): bool
    {
        return self::ffi()->IsSoundPlaying($sound->struct());
    }

    /**
     * 设置声音音量（1.0为最大）
     *
     * @param Sound $sound Sound对象
     * @param float $volume 音量值，范围通常为0.0到1.0
     * @return void
     */
    public static function setSoundVolume(Sound $sound, float $volume): void
    {
        self::ffi()->SetSoundVolume($sound->struct(), $volume);
    }

    /**
     * 设置声音音高（1.0为基础值）
     *
     * @param Sound $sound Sound对象
     * @param float $pitch 音高值
     * @return void
     */
    public static function setSoundPitch(Sound $sound, float $pitch): void
    {
        self::ffi()->SetSoundPitch($sound->struct(), $pitch);
    }

    /**
     * 设置声音声像（0.5为居中）
     *
     * @param Sound $sound Sound对象
     * @param float $pan 声像值，范围通常为0.0到1.0
     * @return void
     */
    public static function setSoundPan(Sound $sound, float $pan): void
    {
        self::ffi()->SetSoundPan($sound->struct(), $pan);
    }

    /**
     * 复制Wave数据
     *
     * @param Wave $wave Wave对象
     * @return Wave Wave对象（复制）
     */
    public static function waveCopy(Wave $wave): Wave
    {
        return new Wave(self::ffi()->WaveCopy($wave->struct()));
    }

    /**
     * 裁剪Wave到指定帧范围
     *
     * @param Wave &$wave Wave对象引用
     * @param int $initFrame 初始帧
     * @param int $finalFrame 最终帧
     * @return void
     */
    public static function waveCrop(Wave &$wave, int $initFrame, int $finalFrame): void
    {
        self::ffi()->WaveCrop($wave->struct(), $initFrame, $finalFrame);
    }

    /**
     * 转换Wave格式
     *
     * @param Wave &$wave Wave对象引用
     * @param int $sampleRate 采样率
     * @param int $sampleSize 采样大小（位数）
     * @param int $channels 声道数
     * @return void
     */
    public static function waveFormat(Wave &$wave, int $sampleRate, int $sampleSize, int $channels): void
    {
        self::ffi()->WaveFormat($wave->struct(), $sampleRate, $sampleSize, $channels);
    }

    /**
     * 加载Wave采样数据（返回32位浮点数组）
     *
     * @param Wave $wave Wave对象
     * @return array<float> 浮点数组
     */
    public static function loadWaveSamples(Wave $wave): array
    {
        $samples = self::ffi()->LoadWaveSamples($wave->struct());
        $arr = [];
        foreach ($samples as $sample) {
            $arr[] = $sample;
        }
        return $arr;
    }

    /**
     * 卸载Wave采样数据
     *
     * @param array<float> $samples 浮点数组指针
     * @return void
     */
    public static function unloadWaveSamples(array $samples): void
    {
        $c_floats = self::ffi()->new("float[" . count($samples) . "]");
        for ($i = 0; $i < count($samples); $i++) {
            $c_float = self::ffi()->new("float");
            $c_float->value = $samples[$i];
            $c_floats[$i] = $c_float;
        }
        self::ffi()->UnloadWaveSamples(self::ffi()::addr($c_floats));
    }

    //### 音乐流管理函数

    /**
     * 从文件加载音乐流
     *
     * @param string $fileName 文件名
     * @return Music Music对象
     */
    public static function loadMusicStream(string $fileName): Music
    {
        return new Music(self::ffi()->LoadMusicStream($fileName));
    }

    /**
     * 从内存加载音乐流
     *
     * @param string $fileType 文件类型（例如".ogg", ".mp3"）
     * @param string $data 数据指针
     * @param int $dataSize 数据大小
     * @return Music Music对象
     */
    public static function loadMusicStreamFromMemory(string $fileType, string $data, int $dataSize): Music
    {
        $c_data = self::ffi()->new("char[" . $dataSize . "]");
        for ($i = 0; $i < $dataSize; $i++) {
            $c_data[$i] = ord($data[$i]);
        }
        return new Music(self::ffi()->LoadMusicStreamFromMemory($fileType, self::ffi()::addr($c_data), $dataSize));
    }

    /**
     * 检查音乐流有效性
     *
     * @param Music $music Music对象
     * @return bool 是否有效
     */
    public static function isMusicValid(Music $music): bool
    {
        return self::ffi()->IsMusicValid($music->struct());
    }

    /**
     * 卸载音乐流
     *
     * @param Music $music Music对象
     * @return void
     */
    public static function unloadMusicStream(Music $music): void
    {
        self::ffi()->UnloadMusicStream($music->struct());
    }

    /**
     * 开始播放音乐
     *
     * @param Music $music Music对象
     * @return void
     */
    public static function playMusicStream(Music $music): void
    {
        self::ffi()->PlayMusicStream($music->struct());
    }

    /**
     * 检查音乐是否正在播放
     *
     * @param Music $music Music对象
     * @return bool 是否正在播放
     */
    public static function isMusicStreamPlaying(Music $music): bool
    {
        return self::ffi()->IsMusicStreamPlaying($music->struct());
    }

    /**
     * 更新音乐流缓冲区
     *
     * @param Music $music Music对象
     * @return void
     */
    public static function updateMusicStream(Music $music): void
    {
        self::ffi()->UpdateMusicStream($music->struct());
    }

    /**
     * 停止音乐播放
     *
     * @param Music $music Music对象
     * @return void
     */
    public static function stopMusicStream(Music $music): void
    {
        self::ffi()->StopMusicStream($music->struct());
    }

    /**
     * 暂停音乐播放
     *
     * @param Music $music Music对象
     * @return void
     */
    public static function pauseMusicStream(Music $music): void
    {
        self::ffi()->PauseMusicStream($music->struct());
    }

    /**
     * 恢复暂停的音乐
     *
     * @param Music $music Music对象
     * @return void
     */
    public static function resumeMusicStream(Music $music): void
    {
        self::ffi()->ResumeMusicStream($music->struct());
    }

    /**
     * 跳转到音乐指定位置（秒）
     *
     * @param Music $music Music对象
     * @param float $position 位置（秒）
     * @return void
     */
    public static function seekMusicStream(Music $music, float $position): void
    {
        self::ffi()->SeekMusicStream($music->struct(), $position);
    }

    /**
     * 设置音乐音量
     *
     * @param Music $music Music对象
     * @param float $volume 音量值，范围通常为0.0到1.0
     * @return void
     */
    public static function setMusicVolume(Music $music, float $volume): void
    {
        self::ffi()->SetMusicVolume($music->struct(), $volume);
    }

    /**
     * 设置音乐音高
     *
     * @param Music $music Music对象
     * @param float $pitch 音高值
     * @return void
     */
    public static function setMusicPitch(Music $music, float $pitch): void
    {
        self::ffi()->SetMusicPitch($music->struct(), $pitch);
    }

    /**
     * 设置音乐声像
     *
     * @param Music $music Music对象
     * @param float $pan 声像值，范围通常为0.0到1.0
     * @return void
     */
    public static function setMusicPan(Music $music, float $pan): void
    {
        self::ffi()->SetMusicPan($music->struct(), $pan);
    }

    /**
     * 获取音乐总时长（秒）
     *
     * @param Music $music Music对象
     * @return float 总时长（秒）
     */
    public static function getMusicTimeLength(Music $music): float
    {
        return self::ffi()->GetMusicTimeLength($music->struct());
    }

    /**
     * 获取当前播放时间（秒）
     *
     * @param Music $music Music对象
     * @return float 当前播放时间（秒）
     */
    public static function getMusicTimePlayed(Music $music): float
    {
        return self::ffi()->GetMusicTimePlayed($music->struct());
    }

    //### 音频流管理函数

    /**
     * 加载音频流（用于原始PCM数据流）
     *
     * @param int $sampleRate 采样率
     * @param int $sampleSize 采样大小（位数）
     * @param int $channels 声道数
     * @return AudioStream AudioStream对象
     */
    public static function loadAudioStream(int $sampleRate, int $sampleSize, int $channels): AudioStream
    {
        return new AudioStream(self::ffi()->LoadAudioStream($sampleRate, $sampleSize, $channels));
    }

    /**
     * 检查音频流有效性
     *
     * @param AudioStream $stream AudioStream对象
     * @return bool 是否有效
     */
    public static function isAudioStreamValid(AudioStream $stream): bool
    {
        return self::ffi()->IsAudioStreamValid($stream->struct());
    }

    /**
     * 卸载音频流
     *
     * @param AudioStream $stream AudioStream对象
     * @return void
     */
    public static function unloadAudioStream(AudioStream $stream): void
    {
        self::ffi()->UnloadAudioStream($stream->struct());
    }

    /**
     * 更新音频流缓冲区数据
     *
     * @param AudioStream $stream AudioStream对象
     * @param string $data 数据
     * @param int $frameCount 帧数
     * @return void
     */
    public static function updateAudioStream(AudioStream $stream, string $data, int $frameCount): void
    {
        $c_char = self::ffi()->new('char[' . strlen($data) . ']');
        self::ffi()::memcpy($c_char, $data, strlen($data));
        self::ffi()->UpdateAudioStream($stream->struct(), self::ffi()->cast('void*', $c_char), $frameCount);
    }

    /**
     * 检查音频流缓冲区是否需要填充
     *
     * @param AudioStream $stream AudioStream对象
     * @return bool 是否需要填充
     */
    public static function isAudioStreamProcessed(AudioStream $stream): bool
    {
        return self::ffi()->IsAudioStreamProcessed($stream->struct());
    }

    /**
     * 播放音频流
     *
     * @param AudioStream $stream AudioStream对象
     * @return void
     */
    public static function playAudioStream(AudioStream $stream): void
    {
        self::ffi()->PlayAudioStream($stream->struct());
    }

    /**
     * 暂停音频流
     *
     * @param AudioStream $stream AudioStream对象
     * @return void
     */
    public static function pauseAudioStream(AudioStream $stream): void
    {
        self::ffi()->PauseAudioStream($stream->struct());
    }

    /**
     * 恢复音频流
     *
     * @param AudioStream $stream AudioStream对象
     * @return void
     */
    public static function resumeAudioStream(AudioStream $stream): void
    {
        self::ffi()->ResumeAudioStream($stream->struct());
    }

    /**
     * 检查音频流是否正在播放
     *
     * @param AudioStream $stream AudioStream对象
     * @return bool 是否正在播放
     */
    public static function isAudioStreamPlaying(AudioStream $stream): bool
    {
        return self::ffi()->IsAudioStreamPlaying($stream->struct());
    }

    /**
     * 停止音频流
     *
     * @param AudioStream $stream AudioStream对象
     * @return void
     */
    public static function stopAudioStream(AudioStream $stream): void
    {
        self::ffi()->StopAudioStream($stream->struct());
    }

    /**
     * 设置音频流音量
     *
     * @param AudioStream $stream AudioStream对象
     * @param float $volume 音量值，范围通常为0.0到1.0
     * @return void
     */
    public static function setAudioStreamVolume(AudioStream $stream, float $volume): void
    {
        self::ffi()->SetAudioStreamVolume($stream->struct(), $volume);
    }

    /**
     * 设置音频流音高
     *
     * @param AudioStream $stream AudioStream对象
     * @param float $pitch 音高值
     * @return void
     */
    public static function setAudioStreamPitch(AudioStream $stream, float $pitch): void
    {
        self::ffi()->SetAudioStreamPitch($stream->struct(), $pitch);
    }

    /**
     * 设置音频流声像
     *
     * @param AudioStream $stream AudioStream对象
     * @param float $pan 声像值，范围通常为0.0到1.0
     * @return void
     */
    public static function setAudioStreamPan(AudioStream $stream, float $pan): void
    {
        self::ffi()->SetAudioStreamPan($stream->struct(), $pan);
    }

    /**
     * 设置新音频流的默认缓冲区大小
     *
     * @param int $size 缓冲区大小
     * @return void
     */
    public static function setAudioStreamBufferSizeDefault(int $size): void
    {
        self::ffi()->SetAudioStreamBufferSizeDefault($size);
    }

    /**
     * 设置音频流回调函数（用于请求新数据）
     *
     * @param AudioStream $stream AudioStream对象
     * @param callable $callback 回调函数
     * @return void
     */
    public static function setAudioStreamCallback(AudioStream $stream, callable $callback): void
    {
        self::ffi()->SetAudioStreamCallback($stream->struct(), $callback);
    }

    /**
     * 附加音频流处理器（接收float格式采样）
     *
     * @param AudioStream $stream AudioStream对象
     * @param callable $processor 处理器函数
     * @return void
     */
    public static function attachAudioStreamProcessor(AudioStream $stream, callable $processor): void
    {
        self::ffi()->AttachAudioStreamProcessor($stream->struct(), $processor);
    }

    /**
     * 分离音频流处理器
     *
     * @param AudioStream $stream AudioStream对象
     * @param callable $processor 处理器函数
     * @return void
     */
    public static function detachAudioStreamProcessor(AudioStream $stream, callable $processor): void
    {
        self::ffi()->DetachAudioStreamProcessor($stream->struct(), $processor);
    }

    /**
     * 附加全局音频混合处理器
     *
     * @param callable $processor 处理器函数
     * @return void
     */
    public static function attachAudioMixedProcessor(callable $processor): void
    {
        $c_processor = function ($buffer, int $frames) use ($processor) {
            $processor($buffer, $frames);
        };
        self::ffi()->AttachAudioMixedProcessor($c_processor);
    }

    /**
     * 分离全局音频混合处理器
     *
     * @param callable $processor 处理器函数
     * @return void
     */
    public static function detachAudioMixedProcessor(callable $processor): void
    {
        $c_processor = function ($buffer, int $frames) use ($processor) {
            $processor($buffer, $frames);
        };
        self::ffi()->DetachAudioMixedProcessor($c_processor);
    }
}
