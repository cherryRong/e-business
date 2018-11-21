<?php
namespace app\index\controller;
use  think\Db;
use  think\Controller;
class Index extends Controller
{
    public function index()
    {
      //热门商品
      $where['is_hot'] = 1;
      $where['is_on_sale'] = 1;
      $where['is_delete'] = 0;
      $hotGoods = Db::name("goods")->field('goods_id,goods_name,goods_brief,goods_thumb,shop_price')->where($where)->select();
   
      //查询出所有的分类
      $catList = Db::name("cat")->where('is_show = 1')->select();
      //处理分类
      $cat = getThree($catList);

      //获取楼层
      $floor = 1;
      $floor = $this->getFloor($catList,$floor);
     

      //标志
      $flag = 1;
      $this->assign("cat",$cat);
      $this->assign("hotGoods",$hotGoods);
      $this->assign("floor",$floor);
      $this->assign("flag",$flag);
     // p($cat);
       return view();
    }
    /**
     * 获取楼层
     * @author Rong
     * @param  [type]  $catList 所有分类
     * @param  integer $floor   楼层所对应的cat_id
     * @return [type]           [description]
     */
    public function getFloor($catList,$floor=1){
        //1.1级分类的名子
        $oneName = Db::name("cat")->where("cat_id = $floor")->value("cat_name");
      
        //2.2级分类的名字
        foreach ($catList as $key => $val) {
           if($val['parent_id'] == $floor){
              $twoList[] = $val;
           }
        }
     
        //3.商品
         $son = getSon($catList,$floor);
         $in = '';
         foreach ($son as $key => $val) {
            $in .= ',' . $val['cat_id'];
         }
         //去掉第一个，
         $in = substr($in,1);
         $where['is_on_sale'] = 1;
         $where['is_delete'] = 0;
         $where['cat_id'] = array("in",$in);
         $goods = Db::name("goods")->field('goods_id,goods_name,goods_brief,goods_thumb,shop_price')->where($where)->select();
         return array("oneName"=>$oneName,"twoList"=>$twoList,"goods"=>$goods);
         
    }
}
