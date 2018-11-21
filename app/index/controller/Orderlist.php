<?php
namespace app\index\controller;
use  think\Db;
use  think\Controller;

class OrderList extends Controller
{
    public function index()
    {
       //接用户名
       $user_name = input("get.user_name",'');
       //接开始时间和结束时间
       $start = strtotime(input("get.start"));
       $end = strtotime(input("get.end"));
       if(!$start){
       	    //最小的10位数
       	 	$start = 1000000000;
       }
        if(!$end){
       	    //最大的10位数
       	 	$end = 9999999999;
       }else{
       	    //结束时间+一天
       	    $end = $end + 24*60*60;
       }
       //接排序
       $sort = input("get.sort","总价升序");
       if($sort =="总价升序"){
       		$sort = 'asc';
       }else{
       	    $sort = 'desc';
       }


       $where['add_time'] = array('between',"$start,$end");
      
       //查询的条件
       $where['user_name'] = array('like',"%$user_name%");
       $orderList = Db::name("order")->alias("o")->join("tp_user u","o.user_id = u.user_id")
    	            ->field('order_id,order_amount,add_time,pay_status,user_name,mobile_phone')
    	            ->where($where)->order("order_amount $sort")->paginate(2);
    	// 获取分页显示
        $page = $orderList->render();
    	//转数组
    	$orderList =  $orderList->toArray();
    	//拿数据
    	$orderList =  $orderList['data'];
      //存session
      foreach ($orderList as $key => $val) {
          //处理支付
          if($val['pay_status']==1){
            $orderList[$key]['pay_status'] = "是";
          }else{
            $orderList[$key]['pay_status'] = "否";
          }
        }
      session('orderList',$orderList);

    	//是否是ajax
    	if(request()->isAjax()){
    		foreach ($orderList as $key => $val) {
    			//处理日期
    			$orderList[$key]['add_time'] = date('Y-m-d H:i:s',$val['add_time']);
    		}
    		
            $result['data'] = $orderList;
            $result['page'] = $page;
            return json($result);
    	}
    	$this->assign("orderList",$orderList);
    	$this->assign("page",$page);
        return view();
    }

    /**
     * 获取订单的表格
     */
    function getOrder(){
       //取session
       $orderList = session("orderList");
      
       $header = array('订单号','下单时间','订单总金额','支付状态','会员名称','手机号');
       //拼成一个
       array_unshift($orderList,$header);
       //调用函数生成表格
       getExc($orderList,'order');
    }

  
}


    
?>