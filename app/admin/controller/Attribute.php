<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
class Attribute extends Controller
{
	/**
	 * 属性的展示
	 * @author Rong
	 * @return [type] [description]
	 */
    public function index()
    {
    	//接type_id
    	$type_id = input("type_id");
    	$where['type_id'] = $type_id;
        $attrList = Db::name('attribute')->where($where)->select();
        foreach ($attrList as $key => $val) {
             //录入方式
        	if($val['attr_input_type']==0){
                $attrList[$key]['attr_input_type'] = '手工录入';
        	}else if($val['attr_input_type']==1){
        		$attrList[$key]['attr_input_type'] = ' 从下面的列表中选择（一行代表一个可选值）';
        	}else{
        		$attrList[$key]['attr_input_type'] = '多行文本框';

        	}
        }
         $this->assign('type_id',$type_id);
        $this->assign('attrList',$attrList);
    	return view();
    }

    public function add(){
        if($_POST){
           $data = input("post.");
           $type_id = $data['type_id'];
           $res = Db::name("attribute")->insert($data);
           if($res){
           		$this->success("添加成功",url('index',['type_id'=>$type_id]));
           	}else{
           		$this->error("添加失败");
           	}
        }else{
        	$type_id = input('type_id');
        	$typeList = Db::name("type")->select();
        	$this->assign('typeList',$typeList);
        	$this->assign('type_id',$type_id);
        	return view();
        }
    }

    public function getAttr(){
        $type_id = input('type_id');
        $where['type_id'] = $type_id;
        $attrList = Db::name('attribute')->where($where)->select();
        foreach ($attrList as $key => $val) {
            if($val['attr_input_type']!=0){
              $attrList[$key]['attr_values'] =   explode("\r\n",$val['attr_values']);
            }
        }
       
        $this->assign('attrList',$attrList);
        return view();
        
    }
}