<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib;

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
     * @return \FFI\CData Wave对象
     */
    public static function loadWave(string $fileName): \FFI\CData
    {
        return self::ffi()->LoadWave($fileName);
    }

    /**
     * 从内存加载Wave（fileType为扩展名，如.wav）
     *
     * @param string $fileType 文件类型（例如".wav"）
     * @param \FFI\CData $fileData 文件数据
     * @param int $dataSize 数据大小
     * @return \FFI\CData Wave对象
     */
    public static function loadWaveFromMemory(string $fileType, \FFI\CData $fileData, int $dataSize): \FFI\CData
    {
        return self::ffi()->LoadWaveFromMemory($fileType, $fileData, $dataSize);
    }

    /**
     * 检查Wave数据有效性
     *
     * @param \FFI\CData $wave Wave对象
     * @return bool 是否有效
     */
    public static function isWaveValid(\FFI\CData $wave): bool
    {
        return self::ffi()->IsWaveValid($wave);
    }

    /**
     * 从文件加载声音
     *
     * @param string $fileName 文件名
     * @return \FFI\CData Sound对象
     */
    public static function loadSound(string $fileName): \FFI\CData
    {
        return self::ffi()->LoadSound($fileName);
    }

    /**
     * 从Wave数据加载声音
     *
     * @param \FFI\CData $wave Wave对象
     * @return \FFI\CData Sound对象
     */
    public static function loadSoundFromWave(\FFI\CData $wave): \FFI\CData
    {
        return self::ffi()->LoadSoundFromWave($wave);
    }

    /**
     * 创建共享样本数据的声音别名
     *
     * @param \FFI\CData $source Sound对象
     * @return \FFI\CData Sound对象（别名）
     */
    public static function loadSoundAlias(\FFI\CData $source): \FFI\CData
    {
        return self::ffi()->LoadSoundAlias($source);
    }

    /**
     * 检查声音有效性
     *
     * @param \FFI\CData $sound Sound对象
     * @return bool 是否有效
     */
    public static function isSoundValid(\FFI\CData $sound): bool
    {
        return self::ffi()->IsSoundValid($sound);
    }

    /**
     * 更新声音缓冲区数据
     *
     * @param \FFI\CData $sound Sound对象
     * @param \FFI\CData $data 数据指针
     * @param int $sampleCount 样本数量
     * @return void
     */
    public static function updateSound(\FFI\CData $sound, \FFI\CData $data, int $sampleCount): void
    {
        self::ffi()->UpdateSound($sound, $data, $sampleCount);
    }

    /**
     * 卸载Wave数据
     *
     * @param \FFI\CData $wave Wave对象
     * @return void
     */
    public static function unloadWave(\FFI\CData $wave): void
    {
        self::ffi()->UnloadWave($wave);
    }

    /**
     * 卸载声音
     *
     * @param \FFI\CData $sound Sound对象
     * @return void
     */
    public static function unloadSound(\FFI\CData $sound): void
    {
        self::ffi()->UnloadSound($sound);
    }

    /**
     * 卸载声音别名（不释放样本数据）
     *
     * @param \FFI\CData $alias Sound对象（别名）
     * @return void
     */
    public static function unloadSoundAlias(\FFI\CData $alias): void
    {
        self::ffi()->UnloadSoundAlias($alias);
    }

    /**
     * 导出Wave数据到文件
     *
     * @param \FFI\CData $wave Wave对象
     * @param string $fileName 文件名
     * @return bool 是否成功
     */
    public static function exportWave(\FFI\CData $wave, string $fileName): bool
    {
        return self::ffi()->ExportWave($wave, $fileName);
    }

    /**
     * 将Wave采样数据导出为C代码(.h)
     *
     * @param \FFI\CData $wave Wave对象
     * @param string $fileName 文件名
     * @return bool 是否成功
     */
    public static function exportWaveAsCode(\FFI\CData $wave, string $fileName): bool
    {
        return self::ffi()->ExportWaveAsCode($wave, $fileName);
    }

    //### Wave/Sound 管理函数

    /**
     * 播放声音
     *
     * @param \FFI\CData $sound Sound对象
     * @return void
     */
    public static function playSound(\FFI\CData $sound): void
    {
        self::ffi()->PlaySound($sound);
    }

    /**
     * 停止播放声音
     *
     * @param \FFI\CData $sound Sound对象
     * @return void
     */
    public static function stopSound(\FFI\CData $sound): void
    {
        self::ffi()->StopSound($sound);
    }

    /**
     * 暂停声音
     *
     * @param \FFI\CData $sound Sound对象
     * @return void
     */
    public static function pauseSound(\FFI\CData $sound): void
    {
        self::ffi()->PauseSound($sound);
    }

    /**
     * 恢复暂停的声音
     *
     * @param \FFI\CData $sound Sound对象
     * @return void
     */
    public static function resumeSound(\FFI\CData $sound): void
    {
        self::ffi()->ResumeSound($sound);
    }

    /**
     * 检查声音是否正在播放
     *
     * @param \FFI\CData $sound Sound对象
     * @return bool 是否正在播放
     */
    public static function isSoundPlaying(\FFI\CData $sound): bool
    {
        return self::ffi()->IsSoundPlaying($sound);
    }

    /**
     * 设置声音音量（1.0为最大）
     *
     * @param \FFI\CData $sound Sound对象
     * @param float $volume 音量值，范围通常为0.0到1.0
     * @return void
     */
    public static function setSoundVolume(\FFI\CData $sound, float $volume): void
    {
        self::ffi()->SetSoundVolume($sound, $volume);
    }

    /**
     * 设置声音音高（1.0为基础值）
     *
     * @param \FFI\CData $sound Sound对象
     * @param float $pitch 音高值
     * @return void
     */
    public static function setSoundPitch(\FFI\CData $sound, float $pitch): void
    {
        self::ffi()->SetSoundPitch($sound, $pitch);
    }

    /**
     * 设置声音声像（0.5为居中）
     *
     * @param \FFI\CData $sound Sound对象
     * @param float $pan 声像值，范围通常为0.0到1.0
     * @return void
     */
    public static function setSoundPan(\FFI\CData $sound, float $pan): void
    {
        self::ffi()->SetSoundPan($sound, $pan);
    }

    /**
     * 复制Wave数据
     *
     * @param \FFI\CData $wave Wave对象
     * @return \FFI\CData Wave对象（复制）
     */
    public static function waveCopy(\FFI\CData $wave): \FFI\CData
    {
        return self::ffi()->WaveCopy($wave);
    }

    /**
     * 裁剪Wave到指定帧范围
     *
     * @param \FFI\CData &$wave Wave对象引用
     * @param int $initFrame 初始帧
     * @param int $finalFrame 最终帧
     * @return void
     */
    public static function waveCrop(\FFI\CData &$wave, int $initFrame, int $finalFrame): void
    {
        self::ffi()->WaveCrop($wave, $initFrame, $finalFrame);
    }

    /**
     * 转换Wave格式
     *
     * @param \FFI\CData &$wave Wave对象引用
     * @param int $sampleRate 采样率
     * @param int $sampleSize 采样大小（位数）
     * @param int $channels 声道数
     * @return void
     */
    public static function waveFormat(\FFI\CData &$wave, int $sampleRate, int $sampleSize, int $channels): void
    {
        self::ffi()->WaveFormat($wave, $sampleRate, $sampleSize, $channels);
    }

    /**
     * 加载Wave采样数据（返回32位浮点数组）
     *
     * @param \FFI\CData $wave Wave对象
     * @return \FFI\CData 浮点数组指针
     */
    public static function loadWaveSamples(\FFI\CData $wave): \FFI\CData
    {
        return self::ffi()->LoadWaveSamples($wave);
    }

    /**
     * 卸载Wave采样数据
     *
     * @param \FFI\CData $samples 浮点数组指针
     * @return void
     */
    public static function unloadWaveSamples(\FFI\CData $samples): void
    {
        self::ffi()->UnloadWaveSamples($samples);
    }

    //### 音乐流管理函数

    /**
     * 从文件加载音乐流
     *
     * @param string $fileName 文件名
     * @return \FFI\CData Music对象
     */
    public static function loadMusicStream(string $fileName): \FFI\CData
    {
        return self::ffi()->LoadMusicStream($fileName);
    }

    /**
     * 从内存加载音乐流
     *
     * @param string $fileType 文件类型（例如".ogg", ".mp3"）
     * @param \FFI\CData $data 数据指针
     * @param int $dataSize 数据大小
     * @return \FFI\CData Music对象
     */
    public static function loadMusicStreamFromMemory(string $fileType, \FFI\CData $data, int $dataSize): \FFI\CData
    {
        return self::ffi()->LoadMusicStreamFromMemory($fileType, $data, $dataSize);
    }

    /**
     * 检查音乐流有效性
     *
     * @param \FFI\CData $music Music对象
     * @return bool 是否有效
     */
    public static function isMusicValid(\FFI\CData $music): bool
    {
        return self::ffi()->IsMusicValid($music);
    }

    /**
     * 卸载音乐流
     *
     * @param \FFI\CData $music Music对象
     * @return void
     */
    public static function unloadMusicStream(\FFI\CData $music): void
    {
        self::ffi()->UnloadMusicStream($music);
    }

    /**
     * 开始播放音乐
     *
     * @param \FFI\CData $music Music对象
     * @return void
     */
    public static function playMusicStream(\FFI\CData $music): void
    {
        self::ffi()->PlayMusicStream($music);
    }

    /**
     * 检查音乐是否正在播放
     *
     * @param \FFI\CData $music Music对象
     * @return bool 是否正在播放
     */
    public static function isMusicStreamPlaying(\FFI\CData $music): bool
    {
        return self::ffi()->IsMusicStreamPlaying($music);
    }

    /**
     * 更新音乐流缓冲区
     *
     * @param \FFI\CData $music Music对象
     * @return void
     */
    public static function updateMusicStream(\FFI\CData $music): void
    {
        self::ffi()->UpdateMusicStream($music);
    }

    /**
     * 停止音乐播放
     *
     * @param \FFI\CData $music Music对象
     * @return void
     */
    public static function stopMusicStream(\FFI\CData $music): void
    {
        self::ffi()->StopMusicStream($music);
    }

    /**
     * 暂停音乐播放
     *
     * @param \FFI\CData $music Music对象
     * @return void
     */
    public static function pauseMusicStream(\FFI\CData $music): void
    {
        self::ffi()->PauseMusicStream($music);
    }

    /**
     * 恢复暂停的音乐
     *
     * @param \FFI\CData $music Music对象
     * @return void
     */
    public static function resumeMusicStream(\FFI\CData $music): void
    {
        self::ffi()->ResumeMusicStream($music);
    }

    /**
     * 跳转到音乐指定位置（秒）
     *
     * @param \FFI\CData $music Music对象
     * @param float $position 位置（秒）
     * @return void
     */
    public static function seekMusicStream(\FFI\CData $music, float $position): void
    {
        self::ffi()->SeekMusicStream($music, $position);
    }

    /**
     * 设置音乐音量
     *
     * @param \FFI\CData $music Music对象
     * @param float $volume 音量值，范围通常为0.0到1.0
     * @return void
     */
    public static function setMusicVolume(\FFI\CData $music, float $volume): void
    {
        self::ffi()->SetMusicVolume($music, $volume);
    }

    /**
     * 设置音乐音高
     *
     * @param \FFI\CData $music Music对象
     * @param float $pitch 音高值
     * @return void
     */
    public static function setMusicPitch(\FFI\CData $music, float $pitch): void
    {
        self::ffi()->SetMusicPitch($music, $pitch);
    }

    /**
     * 设置音乐声像
     *
     * @param \FFI\CData $music Music对象
     * @param float $pan 声像值，范围通常为0.0到1.0
     * @return void
     */
    public static function setMusicPan(\FFI\CData $music, float $pan): void
    {
        self::ffi()->SetMusicPan($music, $pan);
    }

    /**
     * 获取音乐总时长（秒）
     *
     * @param \FFI\CData $music Music对象
     * @return float 总时长（秒）
     */
    public static function getMusicTimeLength(\FFI\CData $music): float
    {
        return self::ffi()->GetMusicTimeLength($music);
    }

    /**
     * 获取当前播放时间（秒）
     *
     * @param \FFI\CData $music Music对象
     * @return float 当前播放时间（秒）
     */
    public static function getMusicTimePlayed(\FFI\CData $music): float
    {
        return self::ffi()->GetMusicTimePlayed($music);
    }

    //### 音频流管理函数

    /**
     * 加载音频流（用于原始PCM数据流）
     *
     * @param int $sampleRate 采样率
     * @param int $sampleSize 采样大小（位数）
     * @param int $channels 声道数
     * @return \FFI\CData AudioStream对象
     */
    public static function loadAudioStream(int $sampleRate, int $sampleSize, int $channels): \FFI\CData
    {
        return self::ffi()->LoadAudioStream($sampleRate, $sampleSize, $channels);
    }

    /**
     * 检查音频流有效性
     *
     * @param \FFI\CData $stream AudioStream对象
     * @return bool 是否有效
     */
    public static function isAudioStreamValid(\FFI\CData $stream): bool
    {
        return self::ffi()->IsAudioStreamValid($stream);
    }

    /**
     * 卸载音频流
     *
     * @param \FFI\CData $stream AudioStream对象
     * @return void
     */
    public static function unloadAudioStream(\FFI\CData $stream): void
    {
        self::ffi()->UnloadAudioStream($stream);
    }

    /**
     * 更新音频流缓冲区数据
     *
     * @param \FFI\CData $stream AudioStream对象
     * @param \FFI\CData $data 数据指针
     * @param int $frameCount 帧数
     * @return void
     */
    public static function updateAudioStream(\FFI\CData $stream, \FFI\CData $data, int $frameCount): void
    {
        self::ffi()->UpdateAudioStream($stream, $data, $frameCount);
    }

    /**
     * 检查音频流缓冲区是否需要填充
     *
     * @param \FFI\CData $stream AudioStream对象
     * @return bool 是否需要填充
     */
    public static function isAudioStreamProcessed(\FFI\CData $stream): bool
    {
        return self::ffi()->IsAudioStreamProcessed($stream);
    }

    /**
     * 播放音频流
     *
     * @param \FFI\CData $stream AudioStream对象
     * @return void
     */
    public static function playAudioStream(\FFI\CData $stream): void
    {
        self::ffi()->PlayAudioStream($stream);
    }

    /**
     * 暂停音频流
     *
     * @param \FFI\CData $stream AudioStream对象
     * @return void
     */
    public static function pauseAudioStream(\FFI\CData $stream): void
    {
        self::ffi()->PauseAudioStream($stream);
    }

    /**
     * 恢复音频流
     *
     * @param \FFI\CData $stream AudioStream对象
     * @return void
     */
    public static function resumeAudioStream(\FFI\CData $stream): void
    {
        self::ffi()->ResumeAudioStream($stream);
    }

    /**
     * 检查音频流是否正在播放
     *
     * @param \FFI\CData $stream AudioStream对象
     * @return bool 是否正在播放
     */
    public static function isAudioStreamPlaying(\FFI\CData $stream): bool
    {
        return self::ffi()->IsAudioStreamPlaying($stream);
    }

    /**
     * 停止音频流
     *
     * @param \FFI\CData $stream AudioStream对象
     * @return void
     */
    public static function stopAudioStream(\FFI\CData $stream): void
    {
        self::ffi()->StopAudioStream($stream);
    }

    /**
     * 设置音频流音量
     *
     * @param \FFI\CData $stream AudioStream对象
     * @param float $volume 音量值，范围通常为0.0到1.0
     * @return void
     */
    public static function setAudioStreamVolume(\FFI\CData $stream, float $volume): void
    {
        self::ffi()->SetAudioStreamVolume($stream, $volume);
    }

    /**
     * 设置音频流音高
     *
     * @param \FFI\CData $stream AudioStream对象
     * @param float $pitch 音高值
     * @return void
     */
    public static function setAudioStreamPitch(\FFI\CData $stream, float $pitch): void
    {
        self::ffi()->SetAudioStreamPitch($stream, $pitch);
    }

    /**
     * 设置音频流声像
     *
     * @param \FFI\CData $stream AudioStream对象
     * @param float $pan 声像值，范围通常为0.0到1.0
     * @return void
     */
    public static function setAudioStreamPan(\FFI\CData $stream, float $pan): void
    {
        self::ffi()->SetAudioStreamPan($stream, $pan);
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
     * @param \FFI\CData $stream AudioStream对象
     * @param callable $callback 回调函数
     * @return void
     */
    public static function setAudioStreamCallback(\FFI\CData $stream, callable $callback): void
    {
        self::ffi()->SetAudioStreamCallback($stream, $callback);
    }

    /**
     * 附加音频流处理器（接收float格式采样）
     *
     * @param \FFI\CData $stream AudioStream对象
     * @param callable $processor 处理器函数
     * @return void
     */
    public static function attachAudioStreamProcessor(\FFI\CData $stream, callable $processor): void
    {
        self::ffi()->AttachAudioStreamProcessor($stream, $processor);
    }

    /**
     * 分离音频流处理器
     *
     * @param \FFI\CData $stream AudioStream对象
     * @param callable $processor 处理器函数
     * @return void
     */
    public static function detachAudioStreamProcessor(\FFI\CData $stream, callable $processor): void
    {
        self::ffi()->DetachAudioStreamProcessor($stream, $processor);
    }

    /**
     * 附加全局音频混合处理器
     *
     * @param callable $processor 处理器函数
     * @return void
     */
    public static function attachAudioMixedProcessor(callable $processor): void
    {
        self::ffi()->AttachAudioMixedProcessor($processor);
    }

    /**
     * 分离全局音频混合处理器
     *
     * @param callable $processor 处理器函数
     * @return void
     */
    public static function detachAudioMixedProcessor(callable $processor): void
    {
        self::ffi()->DetachAudioMixedProcessor($processor);
    }
}
