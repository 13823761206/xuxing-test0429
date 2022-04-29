<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2022/4/29
 * Time: 20:36
 */
namespace app\helpers;

class Enum
{
    const STATUS_OK = 'ok';
    const STATUS_HOLD = 'hold';
    const STATUS_ALL = '';

    const STATUS_ARR = [
        self::STATUS_ALL => 'all',
        self::STATUS_OK => 'ok',
        self::STATUS_HOLD => 'hold',
    ];

}
