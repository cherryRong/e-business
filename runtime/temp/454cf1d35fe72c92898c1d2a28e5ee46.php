<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:61:"C:\phpStudy\WWW\tp50\public/../app/admin\view\role\index.html";i:1542696728;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SHOP 管理中心 - 角色分类 </title>
<base href="/admin/">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles/general.css" rel="stylesheet" type="text/css" />
<link href="styles/main.css" rel="stylesheet" type="text/css" />
</head>
<body>

<h1>
<span class="action-span"><a href="<?php echo url('add'); ?>">添加角色</a></span>
<span class="action-span1"><a href="<?php echo url('Index/index'); ?>" target="parent">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 角色列表 </span>
<div style="clear:both"></div>
</h1>

<form method="post" action="" name="listForm">
<!-- start ad position list -->
	<div class="list-div" id="listDiv">
		<table width="100%" cellspacing="1" cellpadding="2" id="list-table">
			<tbody>
				<tr>
					<th>角色名称</th>					
					<th>是否启用</th>
					<th>角色介绍</th>
					<th>操作</th>
				</tr>
            <?php foreach($roleList as $val): ?>
		     <tr align="center" class="0" id="0_1">
                 <td><span><?php echo $val['role_name']; ?></span></td>

				 <td width="10%"><?php echo $val['is_start']; ?></td>
           
			     <td width="10%" align="right"><span ><?php echo $val['role_desc']; ?></span></td>
				 <td width="24%" align="center">
						<a href="<?php echo url('setPrivillage',['role_id'=>$val['role_id']]); ?>">赋权</a> |
						<a href="">编辑</a> |
						<a href="">移除</a>
				</td>
			</tr>
		   <?php endforeach; ?>
           
       
	
	</tbody>
  </table>
</div>
</form>

  </table>
</div>
</form>


<div id="footer">
	版权所有 &copy; 2006-2013 软工教育 - 高级PHP - </div>
</div>

</body>
</html>