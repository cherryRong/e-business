<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;

class Role extends Controller
{ 
	/**
	 * 展示角色
	 */
    public function index(){
    	$roleList = Db::name("role")->select();
    	foreach ($roleList as $key => &$val) {
    		if($val['is_start']==1){
    			$val['is_start'] = '<img src="images/yes.gif">';
    		}else{
    			$val['is_start'] = '<img src="images/no.gif">';
    		}
    	}
    	$this->assign('roleList',$roleList);
      	return view();
    }
    /**
     * 添加角色
     */
    public function add(){
      	if($_POST){
            $data = input("post.");
            $res = Db::name("role")->insert($data);
            if($res){
	                $this->success("添加成功",url('index'));
	        }else{
	                $this->error("添加失败");
	        }
      	}else{
      		return view();
      	}
    }
    /**
     * 设置权限
     */
    public function setPrivillage(){
      $role_id = input("role_id");
      if($_POST){
          $data = input("post.");
          $node_id = $data["node_id"];
          $role_id = $data["role_id"];
          foreach ($node_id   as $key => $val) {
            $temp[$key]['role_id'] = $role_id;
            $temp[$key]['node_id'] =  $val;
          }
          //清空之前的
          $myNode = Db::name("privillage")->where("role_id = $role_id")->delete();
          //添加权限
          $res = Db::name("privillage")->insertAll($temp);
          if($res){
              $this->success("添加成功",url('index'));
          }else{
              $this->error("添加失败");
          }
      }else{
        //获取所有节点
         $nodeList = Db::name("node")->select();
        //获取已有节点
         $myNode = Db::name("privillage")->where("role_id = $role_id")->column("node_id");
        //标记已有的
         foreach ($nodeList as $key => &$val) {
           if(in_array($val['node_id'],$myNode)){
              $val['is_my'] = 1;
           }else{
              $val['is_my'] = 0;
           }
         }
         //处理成父子级
         $nodeList = getThree($nodeList,"node_id");
         $this->assign('nodeList',$nodeList);
         $this->assign('role_id',$role_id);
         return view("privillage");
      }
      
      
    }
}
?>