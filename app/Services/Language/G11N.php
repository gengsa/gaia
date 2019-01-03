<?php
namespace Gaia\Services\Language;

/**
 * Globalization
 */
class G11N
{

    const DEFAULT_LANGUAGE = 'en';

    public static $langCode2Id = array(
        'en' => 1,
        'ru' => 2,
        'es' => 3,
        'zh' => 4,
        'id' => 5
    );

    public static $langId2Code = array(
        1 => 'en',
        'ru',
        'es',
        'zh',
        'id'
    );

    public static function langId($langCode)
    {
        return self::$langCode2Id[$langCode];
    }

    public static function langCode($langId)
    {
        return self::$langId2Code[$langId];
    }

    public static function hasCode($langCode)
    {
        return !empty(self::$langCode2Id[$langCode]);
    }
}