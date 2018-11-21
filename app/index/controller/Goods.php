<?php
namespace app\index\controller;
use  think\Db;
use  think\Controller;

class Goods extends Controller
{
    public function index()
    {
    	//商品的信息
    	$goods_id = input("goods_id");
    	$ginfo = Db::name("goods")->where("goods_id = $goods_id")->find();
    	//相册的信息
    	$gallery = Db::name("gallery")->where("goods_id = $goods_id")->select();
        //品牌的信息
        $brand_id = $ginfo['brand_id'];
        $binfo = Db::name("brand")->where("brand_id = $brand_id")->find();
        //p($binfo);
    	//属性的信息
    	$attrList = Db::name("good_attr")->alias("g")->join("tp_attribute a","a.attr_id = g.attr_id")->field("g.attr_id,goods_attr_id,attr_name,attr_value,attr_index,attr_input_type")->where("goods_id = $goods_id")->select();
        $up = [];
        $down = [];
        foreach ($attrList as $key => $val) {
        	if($val['attr_index']==0 and $val['attr_input_type']>0){
        		//规格
        		$up[] = $val;
        	}else{
        		$down[] = $val;
        	}
        }
        //处理规格
        foreach ($up as $key => $v) {
        	$attr[$v['attr_id']]['attr_name'] = $v['attr_name'];
        	$attr[$v['attr_id']]['attr_value'][$v['goods_attr_id']] = $v['attr_value'];
        }
        //为了防止规格为空
        if(!isset($attr)){
           $attr = [];
        }
        $this->assign('attr',$attr);
        $this->assign('binfo',$binfo);
    	$this->assign('ginfo',$ginfo);
        $this->assign('goods_id',$goods_id);
    	$this->assign('gallery',$gallery);
    	$this->assign('down',$down);
    	return view();
    }
}