<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:64:"C:\phpStudy\WWW\tp50\public/../app/admin\view\goods\product.html";i:1539590693;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <base href="/admin/" />
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title></title>

	<!-- 引入日期插件 -->
	<script language="javascript" type="text/javascript" src="carlender/WdatePicker.js"></script>
	<!-- 引入编辑器插件 -->
	 <script type="text/javascript" charset="utf-8" src="ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="ueditor/ueditor.all.min.js"> </script>
  
    <script type="text/javascript" charset="utf-8" src="ueditor/lang/zh-cn/zh-cn.js"></script>

	<link href="styles/general.css" rel="stylesheet" type="text/css" />
	<link href="styles/main.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="js/utils.js"></script>
	<script type="text/javascript" src="js/selectzone.js"></script>
	<script type="text/javascript" src="js/colorselector.js"></script>
	<script type="text/javascript" src="js/calendar.php?lang="></script>
</head>

<body>
<h1>
  <span class="action-span1"><a href="index.php?act=main">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 商品列表 </span>
  <div style="clear:both"></div>
</h1>

<div class="form-div">
<form method="post" action="<?php echo url('product'); ?>" name="addForm" id="addForm">
  <input name="goods_id" value="<?php echo $goods_id; ?>" type="hidden">
  <!-- <input type="hidden" name="act" value="product_add_execute" /> -->
    <table id="table_list" width="100%" cellspacing="1" cellpadding="3">
      <tbody>
      <tr>
        <th colspan="20" scope="col"><?php echo $goodsInfo['goods_name']; ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $goodsInfo['goods_sn']; ?></th>
      </tr>
      <tr>
         <!-- 规格开始 -->
          <?php foreach($attr as $val): ?>
           <td align="center">
              <div align="center"><strong><?php echo $val['attr_name']; ?></strong></div>
            </td>
            <?php endforeach; ?>
           <!-- 规格结束 -->
       
   
      	 <td> <div align="center"><strong>货号</strong></div></td>
      	 <td> <div align="center"><strong>库存</strong></div></td>
      	 <td> <div align="center"><strong>价格</strong></div></td>

      </tr>
      <tr>
          <!-- 规格开始 -->
          <?php foreach($attr as $val): ?>
          <td align="center">
     

              <select name="product[0][attr_list][]">
                <?php if(is_array($val['attr_value']) || $val['attr_value'] instanceof \think\Collection || $val['attr_value'] instanceof \think\Paginator): if( count($val['attr_value'])==0 ) : echo "" ;else: foreach($val['attr_value'] as $k=>$v): ?>
              	  <option value="<?php echo $k; ?>"><?php echo $v; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
               </select>
            </td>
            <?php endforeach; ?>
           <!-- 规格结束 -->
          <td align="center">
             
              <input name="product[0][product_sn]" value="" size="20" type="text">
           </td>

        <td align="center">
            
            <input name="product[0][SKU]" size="10" type="text">
        </td>
         <td align="center">
           
            <input name="product[0][goods_price]" value="" size="20" type="text">
         </td>
        <td>
            <input class="button add" value="+" type="button">
        </td>
      </tr>


 
      
    </tbody></table>
     <div align="center"><input value=" 保存 " class="button" type="submit"></div>
</form>
</div>
<div id="footer">
  版权所有 © 2006-2013 软工教育 - 高级PHP - 
</div>
</body>
</html>
<script src="js/jquery-1.10.2.js"></script>
<script>
	$(function(){
		//加
		$(".add").click(function(){


			var _index  = $("tr").length-2;
			


		    //拿tr
		    var trs = "<tr>"+$(this).parents('tr').html()+"</tr>";
		    // +  换  -
		    trs = trs.replace('+',"-");
		    //add 换 del
		    trs = trs.replace('add',"del");
		    //换product[0]
		    trs = trs.replace(/product\[0\]/g,'product['+_index+']');
		    //放当前tr的下面
		    $(this).parents('tr').after(trs);
		    console.log(trs);
	
		})

		//减
		$(document).on('click',".del",function(){
            $(this).parents('tr').remove();
		})
	})
</script>