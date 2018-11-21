<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;

class Cat extends Controller
{  
	/**
	 * 分类的展示
	 * @author Rong
	 * @return [type] [description]
	 */
    public function index()
    { 

    	$catList = Db::query("select  *,concat(path,'-',cat_id) as depath from tp_cat order by depath");
       
        foreach ($catList as $key => $val) {
         	if($val['is_show']==1){
                $catList[$key]['is_show'] = '<img src="images/yes.gif">';
         	}else{
         		 $catList[$key]['is_show'] = '<img src="images/no.gif">';
         	}
        }
       
    	$this->assign("catList",$catList);
    	return view();
    }
    /**
     * 分类的添加
     * @author Rong
     */
    public function add(){
        if($_POST){
           $data = input('post.');
           $parent_id = $data['parent_id'];
           if($parent_id!=0){
                   $where['cat_id'] = $parent_id ;
                   $fpath = Db::name('cat')->where($where)->value('path');
                   //path: 父类的path-父类的id
                   $data['path'] = $fpath.'-'.$parent_id;
           }else{
              $data['path'] = 0;
           }
           $res = Db::name('cat')->insert($data);
           if($res){
                $this->success("添加成功",url('index'));
           }else{
                $this->error("添加失败");
           }
        }else{
            $catList = Db::name('cat')->select();
            $catList = getCatSon( $catList);
            $this->assign("catList",$catList);
        	return view();
        }
    }


}