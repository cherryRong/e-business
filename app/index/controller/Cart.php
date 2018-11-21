<?php
namespace app\index\controller;
use  think\Db;
use  think\Controller;
class Cart extends Controller
{
    public function index()
    {
        $user_id = session("user_id");
        $cartList = Db::name("cart")->where("user_id = $user_id")->select();
        $money = 0;
        //取所路途
        foreach ($cartList as $key => $val) {
           //取所路途
           $goods_id = $val['goods_id'];
            
           $cartList[$key]['goods_thumb'] =  Db::name("goods")->where("goods_id = $goods_id")->value("goods_thumb");
           //小计
           $cartList[$key]['small_total']  = $val['buy_number'] * $val['shop_price'];
           //总钱
           $money +=  $cartList[$key]['small_total'] ;
           //获取属性
           $goods_attr_id = $val['goods_attr_id'];

           if(!empty($goods_attr_id)){
                
               $attr = Db::name("attribute")->alias("a")->join("tp_good_attr g","g.attr_id = a.attr_id")->field("attr_name,attr_value")->where("goods_attr_id in ( $goods_attr_id)")->select();
               $str = '';
               foreach ($attr as $k => $v) {
                  $str .= $v['attr_name'].":".$v['attr_value']."<br>";
               }
                $cartList[$key]['attr'] =  $str;
           }else{
                 $cartList[$key]['attr'] =  '';
           }
           
        }

        //存商品信息的session
        session("cartList",$cartList);
        session("money",$money);
        $this->assign("cartList",$cartList);
        $this->assign("money",$money);
        return view();
    }
   /**
    * 购物车的添加
    * @author Rong
    */
    public function add()
    {
    	//用户id从session取
    	$user_id = session("user_id");
        if(isset($user_id)){
            $result['flag'] = 1;
        }else{
            //没登陆
            $result['flag'] = 0;
            return  json($result);
        }
    	//购物车信息
    	$cinfo = $this->getCinfo($user_id);
        $data = input();
        $data['user_id'] = $user_id;
        $goods_id = $data['goods_id'];
        $gdata = Db::name("goods")->field("goods_sn,shop_price,goods_name")->where("goods_id = $goods_id")->find();
        //合成一个数组
        $data = array_merge($data,$gdata);
        //添加之前查数据库已有当前种类的商品
        $where['goods_id'] = $goods_id;
        $where['user_id'] = $user_id;
        $where['goods_attr_id'] = $data['goods_attr_id'];
        $res = Db::name("cart")->where($where)->find();
        if($res){
        	//有了   修改
        	$save['buy_number'] = $res['buy_number'] + $data['buy_number'];
        	$sres = Db::name("cart")->where($where)->update($save);
        	if($sres){
        		//数据库变了
        		//购物车里数据变的话重新获取信息
	        	$cinfo = $this->getCinfo($user_id);
	        	$result['message'] = "宝贝已成功添加到购物车save";
	        	$result['cinfo'] = $cinfo;
        	}else{
        		$result['message'] = "宝贝添加失败，请重试save";
	        	$result['cinfo'] = $cinfo;
        	}
        }else{
        	//没有  添加
        	//添加
	        $info = Db::name("cart")->insert($data);
	        if($info){
	        	//添加成功
	        	//购物车里数据变的话重新获取信息
	        	$cinfo = $this->getCinfo($user_id);
	        
	        	$result['message'] = "宝贝已成功添加到购物车add";
	        	$result['cinfo'] = $cinfo;

	        	
	        }else{
	        	//添加失败
	        
	        	$result['message'] = "宝贝添加失败，请重试";
	        	$result['cinfo'] = $cinfo;
	        }
        }
        
        return json($result);
    }
   /**
    * 获取购物车的种数、件数、总钱数
    * @author Rong
    * @param  [type] $user_id [description]
    * @return [type]          [description]
    */
    public function getCinfo($user_id){
        $info = Db::name("cart")->where("user_id = $user_id")->select();
        //种数
        $num = count($info);
        //件数
        $sumNum = 0; 
        //总钱数
        $money = 0;
        foreach ($info as $key => $val) {
        	$sumNum += $val['buy_number'];
        	$money += $val['buy_number'] * $val['shop_price'];

        }
        return array("num"=>$num,"sumNum"=>$sumNum,"money"=>$money);
    }
    /**
     * 购物车的登录
     * @author Rong
     * @return [type] [description]
     */
    function login(){
        $data = input();
        $where['user_name'] = $data['uname'];
        $where['password'] = $data['pass'];
        $uinfo = Db::name("user")->where($where)->find();
        if($uinfo){
            //登录成功
            session("user_id",$uinfo['user_id']);
            $flag = 1;
        }else{
            $flag = 0;
        }
        return json($flag); 
    }
}