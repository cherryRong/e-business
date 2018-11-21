<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:62:"C:\phpStudy\WWW\tp50\public/../app/admin\view\brand\index.html";i:1539229577;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SHOP 管理中心 - 品牌管理 </title>
<base href="/admin/" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles/general.css" rel="stylesheet" type="text/css" />
<link href="styles/main.css" rel="stylesheet" type="text/css" />
<link href="styles/page.css" rel="stylesheet" type="text/css" />


</head>
<body>

<h1>
<span class="action-span"><a href="<?php echo url('add'); ?>">添加品牌</a></span>
<span class="action-span1"><a href="index.php?act=main">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 商品品牌 </span>
<div style="clear:both"></div>
</h1>

<div class="form-div">
  <form action="<?php echo url('index'); ?>" name="searchForm">
    <img src="images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH">
     <input type="text" name="brand_name" size="15" value="<?php echo $brand_name; ?>">
    <input  type="submit" value=" 搜索 " class="button">
  </form>
</div>

<form method="post" action="" name="listForm">
<!-- start brand list -->
<div class="list-div" id="listDiv">

  <table cellpadding="3" cellspacing="1" class="tab">
    <tbody>
		<tr>
			<th>品牌名称</th>
			<th>品牌网址</th>
			<th>品牌描述</th>
			<th>排序</th>
			<th>是否显示</th>
			<th>操作</th>
		</tr>
     <?php foreach($brandList as $val): ?>
    <tr class="trs">
			<td class="first-cell">
        <span style="float:right">
          <a href="../data/brandlogo/1240803062307572427.gif" target="_brank">
          <img src="/uploads/<?php echo $val['brand_logo']; ?>" width="30" height="30" border="0" alt="品牌LOGO"></a>
        </span>
			   <span title="点击修改内容" style=""><?php echo $val['brand_name']; ?></span>
			</td>
			<td><a href="<?php echo $val['site_url']; ?>" target="_brank"><?php echo $val['site_url']; ?></a></td>
			<td align="left" ><?php echo $val['brand_desc']; ?></td>
			<td align="right"><span onclick="javascript:listTable.edit(this, 'edit_sort_order', 1)">50</span></td>
			<td align="center"><img src="images/yes.gif" onclick="listTable.toggle(this, 'toggle_show', 1)"></td>
			<td align="center">
				<a href="brand.php?act=edit&amp;id=1" title="编辑">编辑</a> |
				<a href="javascript:;" onclick="listTable.remove(1, '你确认要删除选定的商品品牌吗？')" title="编辑">移除</a> 
			</td>
		</tr>
	 <?php endforeach; ?>
    
  </tbody></table>

<!-- end brand list -->
</div>
</form>
<div id='page'><?php echo $page; ?></div>

<div id="footer">
	版权所有 &copy; 2006-2013 软工教育 - 高级PHP - </div>
</div>

</body>
</html>
<script src="js/jquery-1.10.2.js"></script>
<script>
  $(function(){
      $(document).on('click',".pagination li a",function(){
      //$(".pagination li a").click(function(){
         //搜索
         var brand_name = $('[name="brand_name"]').val();
         var url = $(this).attr('href');
         var str = '';
         //ajax请求
         $.get(url,{'brand_name':brand_name},function(msg){
          
             //删掉原先的
             $(".trs").empty();
             //换上新的
             $.each(msg.data,function(k,val){
              //json拼接
                str += '<tr class="trs"><td class="first-cell"><span style="float:right"><a href="../data/brandlogo/1240803062307572427.gif" target="_brank"><img src="/uploads/'+val.brand_logo+'" width="30" height="30" border="0" alt="品牌LOGO"></a></span><span title="点击修改内容" style="">'+val.brand_name+'</span></td><td><a href="'+val.site_url+'" target="_brank">'+val.site_url+'</a></td><td align="left" >'+val.brand_desc+'</td><td align="right"><span >50</span></td><td align="center"><img src="images/yes.gif"></td><td align="center"><a href="brand.php?act=edit&amp;id=1" title="编辑">编辑</a> |<a href="javascript:;"  title="编辑">移除</a> </td></tr>';
               
             })
            //放到表格里
             $('.tab').append(str);
             //换分页
             $("#page").html(msg.page);
         })
        
         //禁止a标签跳转
          return false;
      })
  })
</script>