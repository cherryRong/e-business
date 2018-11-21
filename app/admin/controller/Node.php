<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;

class Node extends Controller
{  
    public function index(){
    	$nodeList = Db::name("node")->select();
    	$nodeList = getCatSon($nodeList,"node_id");

      	$this->assign('nodeList',$nodeList);
      	return view();
    }
     /**
     * 添加节点
     */
    public function add(){
      	if($_POST){
            $data = input("post.");
            $res = Db::name("node")->insert($data);
            if($res){
	                $this->success("添加成功",url('index'));
	        }else{
	                $this->error("添加失败");
	        }
      	}else{
      		$nodeList = Db::name("node")->select();
	    	$nodeList = getCatSon($nodeList,"node_id");
	      	$this->assign('nodeList',$nodeList);
      		return view();
      	}
    }
}
?>