<?php
namespace app\index\controller;
use  think\Db;
use  think\Controller;
use  think\Session;
class Order extends Controller
{
    public function index()
    {
       //判断是否需要添加收货人信息
       $user_id = session("user_id");
       $where['user_id'] = $user_id;
       $where['is_default'] = 1;
       $addInfo = Db::name("address")->where($where)->find();
       if(!$addInfo){
       	     //查省
       	     $pList = Db::name("province")->select();
       	     $this->assign("pList",$pList);
       		 return view("address");
       }
      //存收货人信息
       session("addInfo",$addInfo);
      //查省
        $p = Db::name("province")->where("code = $addInfo[province]")->value("name");
      //市
       $c = Db::name("city")->where("code = $addInfo[city]")->value("name");
      //区
       $a = Db::name("area")->where("code = $addInfo[area]")->value("name");
       $addInfo['area'] = $p.$c.$a;
       //取商品
       $cartList = session("cartList");

      //取总价
       $money = session("money");
       //查快递公司
       $shipList = Db::name("shipping")->where("enabled = 1")->select();
       $this->assign("cartList",$cartList);
       $this->assign("addInfo",$addInfo);
       $this->assign("shipList",$shipList);
       $this->assign("money",$money);
       return view();

    }
    /**
     * 订单的添加
     * @author Rong
     */
    function add(){
   		$data = input("post.");
   		$shipping_id = $data['ship'];
   		$data['shipping_id'] = $shipping_id;
   		$user_id = session("user_id");
   		$data['user_id'] = $user_id;
   		//获取订单号
   		$data['order_sn'] = $this->createSn();
   		$data['add_time'] = time();
   		//配送费用
   		$ship = Db::name("shipping")->field("shipping_price,shipping_name")->where("shipping_id = $shipping_id ")->find();
   		//取收获人
   		$addInfo = session("addInfo");
   		//商品的总金额  goods_amount 
   		$data['goods_amount'] = session("money");
   		//应付款金额  order_amount   商品总价:  + 配送费用 - 红包金额
   		$data['order_amount'] = session("money") + $ship['shipping_price'] - $data['bonus'];
   		//合成一个数组
   		$insertData = array_merge($data,$addInfo,$ship);
   		$orderId = Db::name("order")->strict(false)->insertGetId($insertData);
   		if($orderId){

   			//订单添加成功，添加订单商品表
   			//取商品
   			 $cartList = session("cartList");
   			 foreach ($cartList as $key => $val) {
   			    $cartList[$key]['order_id'] = $orderId;
   			 }
   			 $res = Db::name("order_goods")->strict(false)->insertAll($cartList);
   			 if($res){
   			 	//清空购物车
   			 	Db::name("cart")->where("user_id = $user_id")->delete();
   			 	//删除session
   			 	Session::delete("cartList");
                $result['flag'] = 1;
                $result['order_sn'] =  $data['order_sn'];
                $result['shipping_name'] = $ship['shipping_name'];
                $result['pay_name'] = $data['pay_name'];
                $result['order_amount'] = $data['order_amount'];
   			 }else{
   			 	//删除原先的订单
   			 	Db::name("order")->where("order_id = $orderId")->delete();
   			 	$result['flag'] = 0;
   			 }

   			 $this->assign("result",$result);
   			 return view('done');
   			die;

   		}else{
   			$this->error("添加失败");
   		}
    }

    /**
     * 获取市
     * @author Rong
     * @return [type] [description]
     */
    function getCity(){
          $code = input("code");
          $cList = Db::name("city")->where("provincecode = $code")->select();
          return json($cList);
    }
    /**
     * 获取配送费用
     * @author Rong
     * @return [type] [description]
     */
    function getFee(){
        $shipping_id = input("shipping_id");
        $fee = Db::name("shipping")->where("shipping_id = $shipping_id")->value("shipping_price");
        return json( $fee);
    }

     /**
     * 获取区
     * @author Rong
     * @return [type] [description]
     */
    function getArea(){
          $code = input("code");
          $aList = Db::name("area")->where("citycode = $code")->select();
          return json($aList);
    }
    /**
     * 添加地址
     * @author Rong
     * @return [type] [description]
     */
    function  address(){
        $data = input("post.");
        $data['user_id'] =session("user_id");
        $res = Db::name("address")->insert($data);
         if($res){
                $this->success("添加成功",url('index'));
          }else{
                $this->error("添加失败");
          }
    }
    /**
    * 自动生成订单号
    * @author Rong
    * @return [type] [description]
    */
    public function createSn(){
        //ECS 000030
        $order_sn = 'ord'.rand(100000,999999);
     
        $res = Db::name("order")->where("order_sn = '$order_sn'")->find();
        if($res){
            //重复
            $this->createSn();
        }else{
          return $order_sn;
        }
    }

}