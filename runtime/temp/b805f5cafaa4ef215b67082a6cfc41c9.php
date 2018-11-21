<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:60:"C:\phpStudy\WWW\tp50\public/../app/admin\view\goods\add.html";i:1539588314;}*/ ?>
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
	<span class="action-span"><a href="<?php echo url('index'); ?>">商品列表</a></span>
	<span class="action-span1"><a href="index.php?act=main">SHOP 管理中心 </a> </span><span id="search_id" class="action-span1"> - 编辑商品信息 </span>
	<div style="clear:both"></div>
</h1>

<div class="tab-div">
    <!-- tab bar -->
    <div id="tabbar-div">
      <p>
        <span class="tab-front" id="general-tab">通用信息</span>
		<span class="tab-back" id="detail-tab">详细描述</span>
		<span class="tab-back" id="mix-tab">其他信息</span>
		<span class="tab-back" id="properties-tab">商品属性</span>
		<span class="tab-back" id="gallery-tab">商品相册</span>
      </p>
    </div>

    <!-- tab body -->
    <div id="tabbody-div">
      <form enctype="multipart/form-data" action="<?php echo url('add'); ?>" method="post" name="theForm"> 
        <input type="hidden" name="MAX_FILE_SIZE" value="2097152">
		 
		 <!-- 通用信息 -->
        <table width="90%" id="general-table" align="center" style="display: table;">
			<tbody>
				<tr>
					<td class="label">商品名称：</td>
					<td><input type="text" name="goods_name" size="30"><span class="require-field">*</span></td>
				</tr>
		
			<tr>
				<td class="label">商品分类：</td>
				<td>
					<select name="cat_id" >
						<option value="0">请选择...</option>
						<?php foreach($catList as $val): ?>
						<option value="<?php echo $val['cat_id']; ?>">
						   <?php
						   		echo str_repeat('&nbsp;',substr_count($val['depath'],'-')*2);
						   ?>
							<?php echo $val['cat_name']; ?>
						</option>
						<?php endforeach; ?>
					</select>
                 </td>
			</tr>
			<tr>
				<td class="label">商品品牌：</td>
				<td>
					<select name="brand_id" onchange="hideBrandDiv()">
						<option value="0">请选择...</option>
						<?php foreach($brandList as $val): ?>
							<option value="<?php echo $val['brand_id']; ?>" >
							  <?php echo $val['brand_name']; ?>
							 </option>
						<?php endforeach; ?>
					</select>
				</td>
			</tr>
           
            <tr>
				<td class="label">本店售价：</td>
				<td><input type="text" name="shop_price"  size="20" onblur="priceSetted()">
				<input type="button" value="按市场价计算" onclick="marketPriceSetted()">
				<span class="require-field">*</span></td>
			</tr>
			

          <tr>
            <td class="label">市场售价：</td>
            <td><input type="text" name="market_price"  size="20">
              <input type="button" value="取整数" onclick="integral_market_price()">
            </td>
          </tr>
    
          <tr>
            <td class="label">
                <label for="is_promote">
                	<input type="checkbox" id="is_promote" name="is_promote" value="1" checked="checked" > 促销价：
                </label>
             </td>
             <td id="promote_3"><input type="text" id="promote_1" name="promote_price" size="20"></td>
          </tr>
          <tr id="promote_4">
            <td class="label" id="promote_5">促销日期：</td>
            <td id="promote_6">
              <input name="promote_start_date" type="text" id="promote_start_date" size="12" onClick="WdatePicker()" readonly="readonly">
            
              - 
              <input name="promote_end_date" type="text" id="promote_end_date" size="12" onClick="WdatePicker()" readonly="readonly">
             
            </td>
          </tr>
          <tr>
            <td class="label">上传商品图片：</td>
            <td>
              <input type="file" name="goods_img" size="35">
                              <a href="goods.php?act=show_image&amp;img_url=images/200905/goods_img/32_G_1242110760868.jpg" target="_blank"><img src="images/yes.gif" border="0"></a>
                            <br><input type="text" size="40" value="商品图片外部URL" style="color:#aaa;" onfocus="if (this.value == '商品图片外部URL'){this.value='http://';this.style.color='#000';}" name="goods_img_url">
            </td>
          </tr>
          <tr id="auto_thumb_1">
            <td class="label"> 上传商品缩略图：</td>
            <td id="auto_thumb_3">
              <input type="file" name="goods_thumb" size="35" disabled="">
                              <a href="goods.php?act=show_image&amp;img_url=images/200905/thumb_img/32_thumb_G_1242110760196.jpg" target="_blank"><img src="images/yes.gif" border="0"></a>
                            <br><input type="text" size="40" value="商品缩略图外部URL" style="color:#aaa;" onfocus="if (this.value == '商品缩略图外部URL'){this.value='http://';this.style.color='#000';}" name="goods_thumb_url" disabled="">
                            <br><label for="auto_thumb"><input type="checkbox" id="auto_thumb" name="auto_thumb" checked="true" value="1" onclick="handleAutoThumb(this.checked)">自动生成商品缩略图</label>            </td>
          </tr>
        </tbody></table>

        <!-- 详细描述 -->
        <table width="90%" id="detail-table" style="display: none;">
          <tbody><tr>
            <td>
            	<textarea name="goods_desc" id="goods_desc" cols="30" rows="10"></textarea>
            </td>
          </tr>
        </tbody></table>

        <!-- 其他信息 -->
        <table width="90%" id="mix-table" style="display: none;" align="center">
         <tbody>
          <tr>
            <td class="label">商品重量：</td>
            <td><input type="text" name="goods_weight" value="" size="20"> <select name="weight_unit"><option value="1">千克</option><option value="0.001" selected="">克</option></select></td>
          </tr>
          <tr>
            <td class="label"><a href="javascript:showNotice('noticeStorage');" title="点击此处查看提示信息"><img src="images/notice.gif" width="16" height="16" border="0" alt="点击此处查看提示信息"></a> 商品库存数量：</td>

            <td><input type="text" name="goods_number" size="20"><br>
            <span class="notice-span" style="display:block" id="noticeStorage">库存在商品为虚货或商品存在货品时为不可编辑状态，库存数值取决于其虚货数量或货品数量</span></td>
          </tr>
          <tr>
            <td class="label">库存警告数量：</td>
            <td><input type="text" name="warn_number"  size="20"></td>
          </tr>
           <tr>
            <td class="label">加入推荐：</td>
            <td>
               <input type="checkbox" name="is_best" value="1" checked="checked">精品 
               <input type="checkbox" name="is_new" value="1" checked="checked">新品 
               <input type="checkbox" name="is_hot" value="1" checked="checked">热销
             </td>
          </tr>
          <tr id="alone_sale_1">
            <td class="label" id="alone_sale_2">上架：</td>
            <td id="alone_sale_3">
            <input type="checkbox" name="is_on_sale" value="1" checked="checked"> 打勾表示允许销售，否则不允许销售。
            </td>
          </tr>
          
          <tr>
            <td class="label">商品简单描述：</td>
            <td><textarea name="goods_brief" cols="40" rows="3"></textarea></td>
          </tr>
         
        </tbody>
       </table>

        <!-- 商品属性 -->
         <table width="90%" id="properties-table" style="display: none;" align="center">
			<tbody>
				<tr>
					<td class="label">商品类型：</td>
					<td>
						<select name="goods_type" >
							<option value="0">请选择商品类型</option>
							<?php foreach($typeList as $val): ?>
								<option value="<?php echo $val['type_id']; ?>"><?php echo $val['type_name']; ?></option>
							<?php endforeach; ?>               
						</select><br>
						<span class="notice-span" style="display:block" id="noticeGoodsType">请选择商品的所属类型，进而完善此商品的属性</span>
					</td>
				</tr>
				<tr>
				<td id="tbody-goodsAttr" colspan="2" style="padding:0">
					<table width="100%" id="attrTable">
						
					</table>
					</td>
			 </tr>
        </tbody>
	</table>
        
        <!-- 商品相册 -->
        <table width="90%" id="gallery-table" style="display: none;" align="center">
          <tbody>
          <tr>
            <td>
              <a href="javascript:;" onclick="addImg(this)">[+]</a>
              图片描述 <input type="text" name="img_desc[]" size="20">
              上传文件 <input type="file" name="img_url[]">
              <input type="text" size="40" value="或者输入外部图片链接地址" style="color:#aaa;" onfocus="if (this.value == '或者输入外部图片链接地址'){this.value='http://';this.style.color='#000';}" name="img_file[]">
            </td>
          </tr>
        </tbody></table>

        <div class="button-div">
          
         <input type="submit" value=" 确定 " class="button" >
          <input type="reset" value=" 重置 " class="button">
        </div>
       
      </form>
    </div>
</div>


<div id="footer">
	版权所有 &copy; 2006-2013 
</div>
<script type="text/javascript" src="js/tab.js"></script>
<script type="text/javascript">
	function addImg(obj){
      var src  = obj.parentNode.parentNode;
      var idx  = rowindex(src);
      var tbl  = document.getElementById('gallery-table');
      var row  = tbl.insertRow(idx + 1);
      var cell = row.insertCell(-1);
      cell.innerHTML = src.cells[0].innerHTML.replace(/(.*)(addImg)(.*)(\[)(\+)/i, "$1removeImg$3$4-");
  	}

    function removeImg(obj){
      var row = rowindex(obj.parentNode.parentNode);
      var tbl = document.getElementById('gallery-table');
      tbl.deleteRow(row);
  	}

   	function dropImg(imgId){
    	Ajax.call('goods.php?is_ajax=1&act=drop_image', "img_id="+imgId, dropImgResponse, "GET", "JSON");
  	}

  	function dropImgResponse(result){
      if (result.error == 0){
          document.getElementById('gallery_' + result.content).style.display = 'none';
      }
  	}

</script>
</body>
</html>
<script src="js/jquery-1.10.2.js"></script>
<script>	
	var ue = UE.getEditor('goods_desc');
	$(function(){
		$("[name = 'goods_type']").change(function(){
			var type_id = $(this).val();
			var url = "<?php echo url('Attribute/getAttr'); ?>";
			$.get(url,{'type_id':type_id},function(msg){
				$("#attrTable").empty();
				$("#attrTable").append(msg);
			})
		})
	})
</script>