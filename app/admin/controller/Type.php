<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
class Type extends Controller
{
	/**
	 * 类型的展示
	 * @author Rong
	 * @return [type] [description]
	 */
    public function index()
    {
    	$typeList = Db::name("type")->select();
    	foreach ($typeList as $key => $val) {
    		$where['type_id'] = $val['type_id'];
           //统计个数
           $typeList[$key]['num'] = Db::name("attribute")->where($where)->count();


    		if($val['is_show']==1){
    			$typeList[$key]['is_show'] = '<img src="images/yes.gif">';
    		}else{
    			$typeList[$key]['is_show'] = '<img src="images/no.gif">';
    		}
    	}
    	
    	$this->assign('typeList',$typeList);
        return view();
    }
    /**
     * 类型的添加
     * @author Rong
     */
    public function add(){
        if($_POST){
            $data = input("post.");
            $res = Db::name("type")->insert($data);
            if($res){
           		$this->success("添加成功",url('index'));
           	}else{
           		$this->error("添加失败");
           	}
        }else{
        	return view();
        }
    }
}