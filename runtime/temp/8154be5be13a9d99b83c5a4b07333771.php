<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:62:"C:\phpStudy\WWW\tp50\public/../app/index\view\order\index.html";i:1539934942;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <base href="/index/" />
	<link type="text/css" rel="stylesheet" href="css/style.css" />
    <!--[if IE 6]>
    <script src="js/iepng.js" type="text/javascript"></script>
        <script type="text/javascript">
           EvPNG.fix('div, ul, img, li, input, a'); 
        </script>
    <![endif]-->
    
    <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="js/menu.js"></script>    
                
	<script type="text/javascript" src="js/n_nav.js"></script>   
    
    <script type="text/javascript" src="js/select.js"></script>
    
    <script type="text/javascript" src="js/num.js">
    	var jq = jQuery.noConflict();
    </script>     
    
    <script type="text/javascript" src="js/shade.js"></script>
    
<title>尤洪</title>
</head>
<body>  
<!--Begin Header Begin-->

<!--End Header End--> 
<!--Begin Menu Begin-->

<!--End Menu End--> 
<form action="<?php echo url('add'); ?>" method="post">
<div class="i_bg">  
    <div class="content mar_20">
    	<img src="images/img2.jpg" />        
    </div>
    
    <!--Begin 第二步：确认订单信息 Begin -->
    <div class="content mar_20">
    	<div class="two_bg">
        	<div class="two_t">
            	<span class="fr"><a href="#">修改</a></span>商品列表
            </div>
            <table border="0" class="car_tab" style="width:1110px;" cellspacing="0" cellpadding="0">
              <tr>
                <td class="car_th" width="550">商品名称</td>
                <td class="car_th" width="140">属性</td>
                <td class="car_th" width="150">购买数量</td>
                <td class="car_th" width="140">单价</td>
                <td class="car_th" width="130">小计</td>
               
              </tr>
              <?php foreach($cartList as $val): ?>
              <tr>
                <td>
                    <div class="c_s_img"><img src="/uploads/<?php echo $val['goods_thumb']; ?>" width="50" height="73" /></div>
                    <?php echo $val['goods_name']; ?>
                </td>
                <td align="center"><?php echo $val['attr']; ?></td>
                <td align="center"><?php echo $val['buy_number']; ?></td>
                <td align="center" style="color:#ff4e00;">￥<?php echo $val['shop_price']; ?></td>
                <td align="center" style="color:#ff4e00;">￥<?php echo $val['small_total']; ?></td>
              </tr>
              <?php endforeach; ?>
              <tr>
                <td colspan="5" align="right" style="font-family:'Microsoft YaHei';">
                    商品总价：￥<?php echo $money; ?> ；   
                </td>
              </tr>
            </table>
            
            <div class="two_t">
            	<span class="fr"><a href="#">修改</a></span>收货人信息
            </div>
            <table border="0" class="peo_tab" style="width:1110px;" cellspacing="0" cellpadding="0">
              <tr>
                <td class="p_td" width="160">省市区</td>
                <td width="395"><?php echo $addInfo['area']; ?></td>
                <td class="p_td" width="160">电子邮件</td>
                <td width="395"><?php echo $addInfo['email']; ?></td>
              </tr>
              <tr>
                <td class="p_td">详细信息</td>
                <td><?php echo $addInfo['address']; ?></td>
                <td class="p_td">邮政编码</td>
                <td><?php echo $addInfo['zipcode']; ?></td>
              </tr>
              <tr>
                <td class="p_td">收货人</td>
                <td><?php echo $addInfo['consignee']; ?></td>
                <td class="p_td">手机</td>
                <td><?php echo $addInfo['mobile']; ?></td>
              </tr>
              
            </table>

            
            <div class="two_t">
            	配送方式
            </div>
            <table border="0" class="car_tab" style="width:1110px;" cellspacing="0" cellpadding="0">
              <tr>
                <td class="car_th" width="80"></td>
                <td class="car_th" width="200">名称</td>
                <td class="car_th" width="370">订购描述</td>
                <td class="car_th" width="150">费用</td>
                <td class="car_th" width="175">保价费用</td>
              </tr>
              <?php foreach($shipList as $val): ?>
              <tr>
              	<td align="center"><input type="radio" name="ship" value="<?php echo $val['shipping_id']; ?>" /></td>
                <td align="center" style="font-size:14px;"><b><?php echo $val['shipping_name']; ?></b></td>
                <td><?php echo $val['shipping_desc']; ?></td>
                <td align="center">￥<?php echo $val['shipping_price']; ?></td>
                <td align="center">
                       <?php if($val['insure'] == 1): ?>
                            支持保价
                        <?php else: ?>
                            不支持保价
                        <?php endif; ?>
                </td>
              </tr>
              <?php endforeach; ?>
              <tr>
              	<td colspan="6">
                	<span class="fr"><label class="r_rad"><input type="checkbox" name="baojia" /></label><label class="r_txt">配送是否需要保价</label></span>
                </td>
              </tr>
            </table> 
            
            <div class="two_t">
            	支付方式
            </div>
            <ul class="pay">
              
                <li  class="checked">支付宝<div class="ch_img"></div></li>
                <input type="hidden"  name="pay_name" value="支付宝"/>
                 <input type="hidden"  name="pay_id" value="1"/>
            </ul>
            
         
         
            <div class="two_t">
            	其他信息
            </div>
            <table border="0" class="car_tab" style="width:1110px;" cellspacing="0" cellpadding="0">
              <tr>
                <td width="145" align="right" style="padding-right:0;"><b style="font-size:14px;">使用红包：</b></td>
                <td>
                	<span class="fl" style="margin-left:50px; margin-right:10px;">选择已有红包</span>
                    <select class="jj" name="bonus">
                      <option value="0" selected="selected">请选择</option>
                      <option value="50">50元</option>
                      <option value="30">30元</option>
                      <option value="20">20元</option>
                      <option value="10">10元</option>
                    </select>
                    <span class="fl" style="margin-left:50px; margin-right:10px;">或者输入红包序列号</span>
                    <span class="fl"><input type="text" value="" class="c_ipt" style="width:220px;" />
                    <span class="fr" style="margin-left:10px;"><input type="submit" value="验证红包" class="btn_tj" /></span>
                </td>
			  </tr>
              <tr valign="top">
                <td align="right" style="padding-right:0;"><b style="font-size:14px;">订单附言：</b></td>
                <td style="padding-left:0;"><textarea class="add_txt" name="message" style="width:860px; height:50px;"></textarea></td>
              </tr>
             
            </table>
            
            <table border="0" style="width:900px; margin-top:20px;" cellspacing="0" cellpadding="0">
              <tr>
                <td align="right">
               
                    商品总价: <font color="#ff4e00">￥<?php echo $money; ?>.00</font>  + 配送费用: <font color="#ff4e00" id="fee">￥00.00</font>
                </td>
              </tr>
              <tr height="70">
                <td align="right">
                	<b style="font-size:14px;">应付款金额：<span style="font-size:22px; color:#ff4e00;" id="sumFee">￥<?php echo $money; ?></span></b>
                </td>
              </tr>
              <tr height="70">
                <td align="right"><a href="#"  id="sorder" ><img src="images/btn_sure.gif" /></a></td>
              </tr>
            </table>

            
        	
        </div>
    </div>
	<!--End 第二步：确认订单信息 End-->
    
    
    <!--Begin Footer Begin -->
    <div class="b_btm_bg bg_color">
        <div class="b_btm">
            <table border="0" style="width:210px; height:62px; float:left; margin-left:75px; margin-top:30px;" cellspacing="0" cellpadding="0">
              <tr>
                <td width="72"><img src="images/b1.png" width="62" height="62" /></td>
                <td><h2>正品保障</h2>正品行货  放心购买</td>
              </tr>
            </table>
			<table border="0" style="width:210px; height:62px; float:left; margin-left:75px; margin-top:30px;" cellspacing="0" cellpadding="0">
              <tr>
                <td width="72"><img src="images/b2.png" width="62" height="62" /></td>
                <td><h2>满38包邮</h2>满38包邮 免运费</td>
              </tr>
            </table>
            <table border="0" style="width:210px; height:62px; float:left; margin-left:75px; margin-top:30px;" cellspacing="0" cellpadding="0">
              <tr>
                <td width="72"><img src="images/b3.png" width="62" height="62" /></td>
                <td><h2>天天低价</h2>天天低价 畅选无忧</td>
              </tr>
            </table>
            <table border="0" style="width:210px; height:62px; float:left; margin-left:75px; margin-top:30px;" cellspacing="0" cellpadding="0">
              <tr>
                <td width="72"><img src="images/b4.png" width="62" height="62" /></td>
                <td><h2>准时送达</h2>收货时间由你做主</td>
              </tr>
            </table>
        </div>
    </div>
    <div class="b_nav">
    	<dl>                                                                                            
        	<dt><a href="#">新手上路</a></dt>
            <dd><a href="#">售后流程</a></dd>
            <dd><a href="#">购物流程</a></dd>
            <dd><a href="#">订购方式</a></dd>
            <dd><a href="#">隐私声明</a></dd>
            <dd><a href="#">推荐分享说明</a></dd>
        </dl>
        <dl>
        	<dt><a href="#">配送与支付</a></dt>
            <dd><a href="#">货到付款区域</a></dd>
            <dd><a href="#">配送支付查询</a></dd>
            <dd><a href="#">支付方式说明</a></dd>
        </dl>
        <dl>
        	<dt><a href="#">会员中心</a></dt>
            <dd><a href="#">资金管理</a></dd>
            <dd><a href="#">我的收藏</a></dd>
            <dd><a href="#">我的订单</a></dd>
        </dl>
        <dl>
        	<dt><a href="#">服务保证</a></dt>
            <dd><a href="#">退换货原则</a></dd>
            <dd><a href="#">售后服务保证</a></dd>
            <dd><a href="#">产品质量保证</a></dd>
        </dl>
        <dl>
        	<dt><a href="#">联系我们</a></dt>
            <dd><a href="#">网站故障报告</a></dd>
            <dd><a href="#">购物咨询</a></dd>
            <dd><a href="#">投诉与建议</a></dd>
        </dl>
        <div class="b_tel_bg">
        	<a href="#" class="b_sh1">新浪微博</a>            
        	<a href="#" class="b_sh2">腾讯微博</a>
            <p>
            服务热线：<br />
            <span>400-123-4567</span>
            </p>
        </div>
        <div class="b_er">
            <div class="b_er_c"><img src="images/er.gif" width="118" height="118" /></div>
            <img src="images/ss.png" />
        </div>
    </div>    
    <div class="btmbg">
		<div class="btm">
        	备案/许可证编号：蜀ICP备12009302号-1-www.dingguagua.com   Copyright © 2015-2018 尤洪商城网 All Rights Reserved. 复制必究 , Technical Support: Dgg Group <br />
            <img src="images/b_1.gif" width="98" height="33" /><img src="images/b_2.gif" width="98" height="33" /><img src="images/b_3.gif" width="98" height="33" /><img src="images/b_4.gif" width="98" height="33" /><img src="images/b_5.gif" width="98" height="33" /><img src="images/b_6.gif" width="98" height="33" />
        </div>    	
    </div>
    <!--End Footer End -->    
</div>

</body>

</form>
<!--[if IE 6]>
<script src="//letskillie6.googlecode.com/svn/trunk/2/zh_CN.js"></script>
<![endif]-->
</html>
<script src='js/jquery-1.10.2.js'></script>
<script>  
    $(function(){
          //
          $("#sorder").click(function(){

            //验证是否选中快递方式
            var bol = checkShip();

            if(bol){
              //提交数据
              $("form").submit();
            }else{
                alert("请选快递");
            }

            //禁止a跳转
            
             return false;

          })

          //验证是否选中快递方式
          function checkShip(){
            var sign = false;
            var ship = $('[name="ship"]');
             ship.each(function(k,v){
                 if(ship.eq(k).prop("checked")==true){
                    sign =  true;
                 }
             })
             return sign;
          }

          //获取配送费用
          $('[name="ship"]').change(function(){
              var shipping_id = $(this).val();
              var url = "<?php echo url('getFee'); ?>";
              $.get(url,{'shipping_id':shipping_id},function(msg){
                  //放配送费用
                  $("#fee").html(msg);
                  var money = parseFloat("<?php echo $money; ?>")  + parseFloat(msg);
                  $("#sumFee").html(money);
              })
          })
    })
</script>

