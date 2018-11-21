<?php
namespace app\index\controller;
use  think\Db;
use  think\Controller;

class Cat extends Controller
{
    public function index()
    {
      //接cat_id
      $cat_id = input("cat_id");
     //查询出所有的分类
      $catList = Db::name("cat")->where('is_show = 1')->select();
      //处理分类
      $cat = getThree($catList);

      //面包屑导航
      $path = Db::name("cat")->where("cat_id = $cat_id")->value("path");
      //转数组
      $path = explode('-',$path);
      //删掉第一个
      array_shift($path);
      //加一个当前cat_id
      array_push($path,$cat_id);
      foreach ($path as $key => $val) {
         $bread[] = Db::name("cat")->where("cat_id = $val")->find();
      }
      //p($bread);

     //显示商品
  
     //找孩子
     $son = getSon($catList,$cat_id);
   
     $in = '';
     foreach ($son as $key => $val) {
     	$in .= ','.$val['cat_id'];
     }

     //去掉第一个，
     $in = substr($in,1);
     //包含当前分类
     $in = $in.','.$cat_id;

     $where['cat_id'] =array('in',$in);
     $where['is_on_sale'] = 1;
     $where['is_delete'] = 0;
     $goodsList = Db::name("goods")->field('goods_id,goods_name,shop_price,goods_thumb')->where($where)->select();
    



      $flag = 0;
      
      $this->assign("cat",$cat);
      $this->assign("flag",$flag);
      $this->assign("bread",$bread);
      $this->assign("goodsList",$goodsList);

 
       return view();
    }
}
