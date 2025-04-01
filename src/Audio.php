<?php
// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib;

/**
 * Audio类
 */
class Audio extends Base
{
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
     * 检查音频设备是否已成功初始化
     *
     * @return bool 如果音频设备已经准备好返回true，否则返回false
     */
    public static function isAudioDeviceReady(): bool
    {
        return self::ffi()->IsAudioDeviceReady();
    }

    /**
     * 设置主音量 (监听器)
     *
     * @param float $volume 音量值（0.0f到1.0f之间）
     * @return void
     */
    public static function setMasterVolume(float $volume): void
    {
        self::ffi()->SetMasterVolume($volume);
    }

    /**
     * 获取主音量 (监听器)
     *
     * @return float 当前的主音量值
     */
    public static function getMasterVolume(): float
    {
        return self::ffi()->GetMasterVolume();
    }

    /**
     * 从文件加载波形数据
     *
     * @param string $fileName 波形文件的路径
     * @return \FFI\CData 返回加载的波形数据结构
     */
    public static function loadWave(string $fileName): \FFI\CData
    {
        return self::ffi()->LoadWave($fileName);
    }

    /**
     * 从内存缓冲区加载波形，fileType 指文件扩展名，例如: '.wav'
     *
     * @param string $fileType 文件类型（扩展名）
     * @param \FFI\CData $fileData 包含波形数据的内存缓冲区
     * @param int $dataSize 缓冲区大小（字节数）
     * @return \FFI\CData 返回加载的波形数据结构
     */
    public static function loadWaveFromMemory(string $fileType, \FFI\CData $fileData, int $dataSize): \FFI\CData
    {
        return self::ffi()->LoadWaveFromMemory($fileType, $fileData, $dataSize);
    }

    /**
     * 检查波形数据是否有效 (数据已加载且参数正确)
     *
     * @param \FFI\CData $wave 波形数据结构
     * @return bool 如果波形数据有效返回 true，否则返回 false
     */
    public static function isWaveValid(\FFI\CData $wave): bool
    {
        return self::ffi()->IsWaveValid($wave);
    }

    /**
     * 从文件加载声音
     *
     * @param string $fileName 声音文件的路径
     * @return \FFI\CData 返回加载的声音数据结构
     */
    public static function loadSound(string $fileName): \FFI\CData
    {
        return self::ffi()->LoadSound($fileName);
    }

    /**
     * 从波形数据加载声音
     *
     * @param \FFI\CData $wave 波形数据结构
     * @return \FFI\CData 返回加载的声音数据结构
     */
    public static function loadSoundFromWave(\FFI\CData $wave): \FFI\CData
    {
        return self::ffi()->LoadSoundFromWave($wave);
    }

    /**
     * 创建一个新的声音，与源声音共享相同的采样数据，不拥有声音数据
     *
     * @param \FFI\CData $source 源声音数据结构
     * @return \FFI\CData 返回新的声音别名数据结构
     */
    public static function loadSoundAlias(\FFI\CData $source): \FFI\CData
    {
        return self::ffi()->LoadSoundAlias($source);
    }

    /**
     * 检查声音是否有效 (数据已加载且缓冲区已初始化)
     *
     * @param \FFI\CData $sound 声音数据结构
     * @return bool 如果声音有效返回 true，否则返回 false
     */
    public static function isSoundValid(\FFI\CData $sound): bool
    {
        return self::ffi()->IsSoundValid($sound);
    }

    /**
     * 用新数据更新声音缓冲区
     *
     * @param \FFI\CData $sound 声音数据结构
     * @param \FFI\CData $data 新的数据缓冲区
     * @param int $sampleCount 样本数量
     */
    public static function updateSound(\FFI\CData $sound, \FFI\CData $data, int $sampleCount): void
    {
        self::ffi()->UpdateSound($sound, $data, $sampleCount);
    }

    /**
     * 卸载波形数据
     *
     * @param \FFI\CData $wave 波形数据结构
     */
    public static function unloadWave(\FFI\CData $wave): void
    {
        self::ffi()->UnloadWave($wave);
    }

    /**
     * 卸载声音
     *
     * @param \FFI\CData $sound 声音数据结构
     */
    public static function unloadSound(\FFI\CData $sound): void
    {
        self::ffi()->UnloadSound($sound);
    }

    /**
     * 卸载声音别名 (不释放采样数据)
     *
     * @param \FFI\CData $alias 声音别名数据结构
     */
    public static function unloadSoundAlias(\FFI\CData $alias): void
    {
        self::ffi()->UnloadSoundAlias($alias);
    }

    /**
     * 将波形数据导出到文件，成功返回 true
     *
     * @param \FFI\CData $wave 波形数据结构
     * @param string $fileName 导出文件的路径
     * @return bool 成功导出返回 true，否则返回 false
     */
    public static function exportWave(\FFI\CData $wave, string $fileName): bool
    {
        return self::ffi()->ExportWave($wave, $fileName);
    }

    /**
     * 将波形数据导出为代码形式
     *
     * @param \FFI\CData $wave 波形数据结构
     * @param string $fileName 导出文件的路径
     * @return bool 成功导出返回 true，否则返回 false
     */
    public static function exportWaveAsCode(\FFI\CData $wave, string $fileName): bool
    {
        return self::ffi()->ExportWaveAsCode($wave, $fileName);
    }

    // 其他函数类似，以下仅展示部分示例

    /**
     * 播放声音
     *
     * @param \FFI\CData $sound 声音数据结构
     */
    public static function playSound(\FFI\CData $sound): void
    {
        self::ffi()->PlaySound($sound);
    }

    /**
     * 停止播放声音
     *
     * @param \FFI\CData $sound 声音数据结构
     */
    public static function stopSound(\FFI\CData $sound): void
    {
        self::ffi()->StopSound($sound);
    }

    /**
     * 暂停声音
     *
     * @param \FFI\CData $sound 声音数据结构
     */
    public static function pauseSound(\FFI\CData $sound): void
    {
        self::ffi()->PauseSound($sound);
    }

    /**
     * 恢复暂停的声音
     *
     * @param \FFI\CData $sound 声音数据结构
     */
    public static function resumeSound(\FFI\CData $sound): void
    {
        self::ffi()->ResumeSound($sound);
    }

    /**
     * 检查声音是否正在播放
     *
     * @param \FFI\CData $sound 声音数据结构
     * @return bool 如果声音正在播放返回 true，否则返回 false
     */
    public static function isSoundPlaying(\FFI\CData $sound): bool
    {
        return self::ffi()->IsSoundPlaying($sound);
    }

    /**
     * 设置声音的音量 (1.0 为最大级别)
     *
     * @param \FFI\CData $sound 声音数据结构
     * @param float $volume 音量级别（0.0 到 1.0）
     */
    public static function setSoundVolume(\FFI\CData $sound, float $volume): void
    {
        self::ffi()->SetSoundVolume($sound, $volume);
    }

    /**
     * 设置声音的音调 (1.0 为基础级别)
     *
     * @param \FFI\CData $sound 声音数据结构
     * @param float $pitch 音调级别
     */
    public static function setSoundPitch(\FFI\CData $sound, float $pitch): void
    {
        self::ffi()->SetSoundPitch($sound, $pitch);
    }

    /**
     * 设置声音的声像 (0.5 为中心)
     *
     * @param \FFI\CData $sound 声音数据结构
     * @param float $pan 声像位置（0.0 到 1.0）
     */
    public static function setSoundPan(\FFI\CData $sound, float $pan): void
    {
        self::ffi()->SetSoundPan($sound, $pan);
    }

    /**
     * 将波形复制到一个新的波形
     *
     * @param \FFI\CData $wave 波形数据结构
     * @return \FFI\CData 返回新的波形副本
     */
    public static function waveCopy(\FFI\CData $wave): \FFI\CData
    {
        return self::ffi()->WaveCopy($wave);
    }

    /**
     * 将波形裁剪到定义的帧范围
     *
     * @param \FFI\CData $wave 波形数据结构指针
     * @param int $initFrame 起始帧
     * @param int $finalFrame 结束帧
     */
    public static function waveCrop(\FFI\CData &$wave, int $initFrame, int $finalFrame): void
    {
        self::ffi()->WaveCrop($wave, $initFrame, $finalFrame);
    }

    /**
     * 将波形数据转换为所需格式
     *
     * @param \FFI\CData $wave 波形数据结构指针
     * @param int $sampleRate 采样率
     * @param int $sampleSize 采样位数
     * @param int $channels 声道数量
     */
    public static function waveFormat(\FFI\CData &$wave, int $sampleRate, int $sampleSize, int $channels): void
    {
        self::ffi()->WaveFormat($wave, $sampleRate, $sampleSize, $channels);
    }

    /**
     * 从波形加载采样数据作为 32 位浮点数据数组
     *
     * @param \FFI\CData $wave 波形数据结构
     * @return \FFI\CData 返回指向 32 位浮点数据数组的指针
     */
    public static function loadWaveSamples(\FFI\CData $wave): \FFI\CData
    {
        return self::ffi()->LoadWaveSamples($wave);
    }

    /**
     * 卸载使用 LoadWaveSamples() 加载的采样数据
     *
     * @param \FFI\CData $samples 采样数据数组
     */
    public static function unloadWaveSamples(\FFI\CData $samples): void
    {
        self::ffi()->UnloadWaveSamples($samples);
    }

    /**
     * 从文件加载音乐流
     *
     * @param string $fileName 文件名路径
     * @return \FFI\CData 返回加载的音乐流数据结构
     */
    public static function loadMusicStream(string $fileName): \FFI\CData
    {
        return self::ffi()->LoadMusicStream($fileName);
    }

    /**
     * 从数据加载音乐流
     *
     * @param string $fileType 文件类型标识
     * @param \FFI\CData $data 包含音乐数据的字节数组
     * @param int $dataSize 数据大小（以字节为单位）
     * @return \FFI\CData 返回加载的音乐流数据结构
     */
    public static function loadMusicStreamFromMemory(string $fileType, \FFI\CData $data, int $dataSize): \FFI\CData
    {
        return self::ffi()->LoadMusicStreamFromMemory($fileType, $data, $dataSize);
    }

    /**
     * 检查音乐流是否有效 (上下文和缓冲区已初始化)
     *
     * @param \FFI\CData $music 音乐流数据结构
     * @return bool 如果音乐流有效返回 true，否则返回 false
     */
    public static function isMusicValid(\FFI\CData $music): bool
    {
        return self::ffi()->IsMusicValid($music);
    }

    /**
     * 卸载音乐流
     *
     * @param \FFI\CData $music 音乐流数据结构
     */
    public static function unloadMusicStream(\FFI\CData $music): void
    {
        self::ffi()->UnloadMusicStream($music);
    }

    /**
     * 开始播放音乐
     *
     * @param \FFI\CData $music 音乐流数据结构
     */
    public static function playMusicStream(\FFI\CData $music): void
    {
        self::ffi()->PlayMusicStream($music);
    }

    /**
     * 检查音乐是否正在播放
     *
     * @param \FFI\CData $music 音乐流数据结构
     * @return bool 如果音乐正在播放返回 true，否则返回 false
     */
    public static function isMusicStreamPlaying(\FFI\CData $music): bool
    {
        return self::ffi()->IsMusicStreamPlaying($music);
    }

    /**
     * 更新音乐流的缓冲区
     *
     * @param \FFI\CData $music 音乐流数据结构
     */
    public static function updateMusicStream(\FFI\CData $music): void
    {
        self::ffi()->UpdateMusicStream($music);
    }

    /**
     * 停止播放音乐
     *
     * @param \FFI\CData $music 音乐流数据结构
     */
    public static function stopMusicStream(\FFI\CData $music): void
    {
        self::ffi()->StopMusicStream($music);
    }

    /**
     * 暂停播放音乐
     *
     * @param \FFI\CData $music 音乐流数据结构
     */
    public static function pauseMusicStream(\FFI\CData $music): void
    {
        self::ffi()->PauseMusicStream($music);
    }

    /**
     * 恢复暂停的音乐播放
     *
     * @param \FFI\CData $music 音乐流数据结构
     */
    public static function resumeMusicStream(\FFI\CData $music): void
    {
        self::ffi()->ResumeMusicStream($music);
    }

    /**
     * 将音乐定位到指定位置 (以秒为单位)
     *
     * @param \FFI\CData $music 音乐流数据结构
     * @param float $position 定位时间点（秒）
     */
    public static function seekMusicStream(\FFI\CData $music, float $position): void
    {
        self::ffi()->SeekMusicStream($music, $position);
    }

    /**
     * 设置音乐的音量 (1.0 为最大级别)
     *
     * @param \FFI\CData $music 音乐流数据结构
     * @param float $volume 音量级别（0.0 到 1.0）
     */
    public static function setMusicVolume(\FFI\CData $music, float $volume): void
    {
        self::ffi()->SetMusicVolume($music, $volume);
    }

    /**
     * 设置音乐的音调 (1.0 为基础级别)
     *
     * @param \FFI\CData $music 音乐流数据结构
     * @param float $pitch 音调级别
     */
    public static function setMusicPitch(\FFI\CData $music, float $pitch): void
    {
        self::ffi()->SetMusicPitch($music, $pitch);
    }

    /**
     * 设置音乐的声像 (0.5 为中心)
     *
     * @param \FFI\CData $music 音乐流数据结构
     * @param float $pan 声像位置（0.0 到 1.0）
     */
    public static function setMusicPan(\FFI\CData $music, float $pan): void
    {
        self::ffi()->SetMusicPan($music, $pan);
    }

    /**
     * 获取音乐的总时长 (以秒为单位)
     *
     * @param \FFI\CData $music 音乐流数据结构
     * @return float 音乐总时长（秒）
     */
    public static function getMusicTimeLength(\FFI\CData $music): float
    {
        return self::ffi()->GetMusicTimeLength($music);
    }

    /**
     * 获取音乐已经播放的时间 (以秒为单位)
     *
     * @param \FFI\CData $music 音乐流数据结构
     * @return float 已播放时间（秒）
     */
    public static function getMusicTimePlayed(\FFI\CData $music): float
    {
        return self::ffi()->GetMusicTimePlayed($music);
    }

    /**
     * 加载音频流 (用于流式传输原始音频 PCM 数据)
     *
     * @param int $sampleRate 采样率（每秒样本数）
     * @param int $sampleSize 每个样本的位数（8 或 16）
     * @param int $channels 声道数（1 = 单声道, 2 = 立体声）
     * @return \FFI\CData 返回加载的音频流数据结构
     */
    public static function loadAudioStream(int $sampleRate, int $sampleSize, int $channels): \FFI\CData
    {
        return self::ffi()->LoadAudioStream($sampleRate, $sampleSize, $channels);
    }

    /**
     * 检查音频流是否有效 (缓冲区已初始化)
     *
     * @param \FFI\CData $stream 音频流数据结构
     * @return bool 如果音频流有效返回 true，否则返回 false
     */
    public static function isAudioStreamValid(\FFI\CData $stream): bool
    {
        return self::ffi()->IsAudioStreamValid($stream);
    }

    /**
     * 卸载音频流并释放内存
     *
     * @param \FFI\CData $stream 音频流数据结构
     */
    public static function unloadAudioStream(\FFI\CData $stream): void
    {
        self::ffi()->UnloadAudioStream($stream);
    }

    /**
     * 用数据更新音频流缓冲区
     *
     * @param \FFI\CData $stream 音频流数据结构
     * @param \FFI\CData $data 包含PCM数据的字节数组
     * @param int $frameCount 要处理的数据帧数
     */
    public static function updateAudioStream(\FFI\CData $stream, \FFI\CData $data, int $frameCount): void
    {
        self::ffi()->UpdateAudioStream($stream, $data, $frameCount);
    }

    /**
     * 检查是否有音频流缓冲区需要重新填充
     *
     * @param \FFI\CData $stream 音频流数据结构
     * @return bool 如果有缓冲区需要重新填充返回 true，否则返回 false
     */
    public static function isAudioStreamProcessed(\FFI\CData $stream): bool
    {
        return self::ffi()->IsAudioStreamProcessed($stream);
    }

    /**
     * 播放音频流
     *
     * @param \FFI\CData $stream 音频流数据结构
     */
    public static function playAudioStream(\FFI\CData $stream): void
    {
        self::ffi()->PlayAudioStream($stream);
    }

    /**
     * 暂停音频流
     *
     * @param \FFI\CData $stream 音频流数据结构
     */
    public static function pauseAudioStream(\FFI\CData $stream): void
    {
        self::ffi()->PauseAudioStream($stream);
    }

    /**
     * 恢复音频流
     *
     * @param \FFI\CData $stream 音频流数据结构
     */
    public static function resumeAudioStream(\FFI\CData $stream): void
    {
        self::ffi()->ResumeAudioStream($stream);
    }

    /**
     * 检查音频流是否正在播放
     *
     * @param \FFI\CData $stream 音频流数据结构
     * @return bool 如果音频流正在播放返回 true，否则返回 false
     */
    public static function isAudioStreamPlaying(\FFI\CData $stream): bool
    {
        return self::ffi()->IsAudioStreamPlaying($stream);
    }

    /**
     * 停止音频流
     *
     * @param \FFI\CData $stream 音频流数据结构
     */
    public static function stopAudioStream(\FFI\CData $stream): void
    {
        self::ffi()->StopAudioStream($stream);
    }

    /**
     * 设置音频流的音量 (1.0 为最大级别)
     *
     * @param \FFI\CData $stream 音频流数据结构
     * @param float $volume 音量级别（0.0 到 1.0）
     */
    public static function setAudioStreamVolume(\FFI\CData $stream, float $volume): void
    {
        self::ffi()->SetAudioStreamVolume($stream, $volume);
    }

    /**
     * 设置音频流的音调 (1.0 为基础级别)
     *
     * @param \FFI\CData $stream 音频流数据结构
     * @param float $pitch 音调级别
     */
    public static function setAudioStreamPitch(\FFI\CData $stream, float $pitch): void
    {
        self::ffi()->SetAudioStreamPitch($stream, $pitch);
    }

    /**
     * 设置音频流的声像 (0.5 为中心)
     *
     * @param \FFI\CData $stream 音频流数据结构
     * @param float $pan 声像位置（0.0 到 1.0）
     */
    public static function setAudioStreamPan(\FFI\CData $stream, float $pan): void
    {
        self::ffi()->SetAudioStreamPan($stream, $pan);
    }

    /**
     * 设置新音频流的默认缓冲区大小
     *
     * @param int $size 缓冲区大小（以帧为单位）
     */
    public static function setAudioStreamBufferSizeDefault(int $size): void
    {
        self::ffi()->SetAudioStreamBufferSizeDefault($size);
    }

    /**
     * 音频线程回调，用于请求新数据
     *
     * @param \FFI\CData $stream 音频流数据结构
     * @param callable $callback 回调函数指针
     */
    public static function setAudioStreamCallback(\FFI\CData $stream, callable $callback): void
    {
        // 注意：这里可能需要额外的FFI配置或包装来支持回调函数
        self::ffi()->SetAudioStreamCallback($stream, $callback);
    }

    /**
     * 将音频流处理器附加到流，接收的样本为 'float' 类型
     *
     * @param \FFI\CData $stream 音频流数据结构
     * @param callable $processor 处理器函数指针
     */
    public static function attachAudioStreamProcessor(\FFI\CData $stream, callable $processor): void
    {
        // 注意：这里可能需要额外的FFI配置或包装来支持处理器函数
        self::ffi()->AttachAudioStreamProcessor($stream, $processor);
    }

    /**
     * 从流中分离音频流处理器
     *
     * @param \FFI\CData $stream 音频流数据结构
     * @param callable $processor 处理器函数指针
     */
    public static function detachAudioStreamProcessor(\FFI\CData $stream, callable $processor): void
    {
        // 注意：这里可能需要额外的FFI配置或包装来支持处理器函数
        self::ffi()->DetachAudioStreamProcessor($stream, $processor);
    }

    /**
     * 将音频流处理器附加到整个音频管道，接收的样本为 'float' 类型
     *
     * @param callable $processor 处理器函数指针
     */
    public static function attachAudioMixedProcessor(callable $processor): void
    {
        // 注意：这里可能需要额外的FFI配置或包装来支持处理器函数
        self::ffi()->AttachAudioMixedProcessor($processor);
    }

    /**
     * 从整个音频管道中分离音频流处理器
     *
     * @param callable $processor 处理器函数指针
     */
    public static function detachAudioMixedProcessor(callable $processor): void
    {
        // 注意：这里可能需要额外的FFI配置或包装来支持处理器函数
        self::ffi()->DetachAudioMixedProcessor($processor);
    }
}
