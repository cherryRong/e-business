<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;

class Admin extends Controller
{  
      public function index(){
      	$adminList = Db::name("admin")->select();
      	$this->assign('adminList',$adminList);
      	return view();
      }

    /**
     * 添加管理员
     */
    public function add(){
      	if($_POST){
            $data = input("post.");
            $data['add_time'] = time();
            $data['password'] = md5($data['password']);
            $role_id = $data['role_id'];
            
            //添加用户
            $adminId = Db::name("admin")->strict(false)->insertGetId($data);
            if($adminId){
                    
                    foreach ($role_id as $key => $val) {
                    	$temp[$key]['role_id'] = $val;
                    	$temp[$key]['admin_id'] = $adminId;
                    }

                    //添加用户角色
                    $res = Db::name("admin_role")->insertAll($temp);
                    if($res){
                    	$this->success("添加成功",url('index'));
                    }else{
                    	$this->error("添加失败");
                    }
	                
	        }else{
	                $this->error("添加失败1");
	        }
      	}else{
      		$roleList = Db::name("role")->where('is_start = 1')->select();
      		$this->assign('roleList',$roleList);
      		return view();
      	}
    }
}
?>