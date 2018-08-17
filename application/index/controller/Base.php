<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/29/029
 * Time: 3:17
 */

namespace app\index\controller;


use think\Controller;
use think\captcha\Captcha;

class Base extends Controller
{
    //生成验证码
    public function chack(){
        $config = [
            // 验证码字体大小
            'fontSize'    =>    30,
            // 验证码位数
            'length'      =>    4,
            // 关闭验证码杂点
            'useNoise'    =>    false,
        ];

        $captcha = new Captcha($config);
        return $captcha->entry();
    }

    //校验验证码
    public function chack_code($code){
        $captcha = new Captcha();
        return $captcha->check($code);
    }

    public function cToken(){
        return $this->request->token();
    }
}