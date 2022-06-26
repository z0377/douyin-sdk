<?php
namespace Douyin\Base;

class Base
{
    public static $config = [];

    public static function init($config)
    {
        self::$config = [
            'key' => $config['key'],
            'secret' => $config['secret'],
        ];
    }
}