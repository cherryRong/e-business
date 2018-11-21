<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;

class Login extends Controller
{ 
	/**
	 * 登录
	 */
    public function index(){
       if($_POST){
             $data = input("post.");
             dump($data);
            
             $code = $data['code'];
                if(!captcha_check($code)){
                     echo "true";
                 }else{
                     echo "false";
                 }
       }else{
            return view('login');
       }

      	
    }
}
?>