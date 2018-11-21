<?php
	return [
		    // 应用调试模式
            'app_debug'              => true,
            // 默认模块名
		    'default_module'         => 'index',
		    // 禁止访问模块
		   // 'deny_module_list'       => ['common'],
		    // 默认控制器名
		    'default_controller'     => 'Index',
		    // 默认操作名
		    'default_action'         => 'index',


		    'captcha'  => [
		        // 验证码字符集合
		        'codeSet'  => '2345678abcdefhijkmnpqrstuvwxyzABCDEFGHJKLMNPQRTUVWXY', 
		        // 验证码字体大小(px)
		       'fontSize' => 15, 
		        // 是否画混淆曲线
		        'useCurve' => false, 
		        'useNoise' =>  false,
		         // 验证码图片高度
		        'imageH'   => 30,
		        // 验证码图片宽度
		        'imageW'   => 100, 
		        // 验证码位数
		        'length'   => 4, 
		        // 验证成功后是否重置        
		        'reset'    => true
            ],


	];

?>