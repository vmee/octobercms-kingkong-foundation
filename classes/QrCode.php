<?php

namespace Kingkong\Foundation\Classes;

/**
 * Created by PhpStorm.
 * User: kingkong
 * Date: 2017/2/10
 * Time: 下午3:48
 */
class QrCode
{
    private static $qrBaseUrl = 'http://pan.baidu.com/share/qrcode';

    /**
     * 获取二维码图片地址
     * @param $text
     * @param int $width
     * @param string $logo 	logo图片
     * @param int $margin 静区（外边距）
     */
    public static function imageUrl($text, $width=200, $logo='', $margin = 0)
    {
        $params = [
            'url' => $text,
            'w' => $width,
            'h' => $width,
        ];

        if($margin) $params['m'] = $margin;
        if($logo) $params['logo'] = urlencode($logo);

        return self::$qrBaseUrl.'?'.http_build_query($params);
    }
}