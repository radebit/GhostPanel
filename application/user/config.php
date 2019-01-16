<?php
//配置文件
return [
    'view_replace_str' => [
        '__css__'=>'/public/static/user/css',
        '__js__'=>'/public/static/user/js',
        '__img__'=>'/public/static/user/img',
        '__fonts__'=>'/public/static/user/fonts',
        '__i__'=>'/public/static/user/i',
        '__layer__'=>'/public/static/user/layer',
    ],
    // +----------------------------------------------------------------------
    // | 验证码设置
    // +----------------------------------------------------------------------
    'captcha'  => [
        // 验证码字符集合
        'codeSet'  => '2345678abcdefhijkmnpqrstuvwxyzABCDEFGHJKLMNPQRTUVWXY',
        // 验证码字体大小(px)
        'fontSize' => 25,
        // 是否画混淆曲线
        'useCurve' => true,
        // 验证码图片高度
        'imageH'   => 60,
        // 验证码图片宽度
        'imageW'   => 200,
        // 验证码位数
        'length'   => 5,
        // 验证成功后是否重置
        'reset'    => true
    ],
];