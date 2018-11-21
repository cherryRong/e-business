<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:60:"C:\phpStudy\WWW\tp50\public/../app/admin\view\admin\add.html";i:1542691991;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SHOP 管理中心 - 添加管理员 </title>
<base href="/admin/">
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles/general.css" rel="stylesheet" type="text/css" />
<link href="styles/main.css" rel="stylesheet" type="text/css" />
</head>
<body>

<h1>
<span class="action-span"><a href="<?php echo url('index'); ?>">管理员列表</a></span>
<span class="action-span1"><a href="">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 添加管理员 </span>
<div style="clear:both"></div>
</h1>
<!-- start add new category form -->
<div class="main-div">
  <form action="<?php echo url('add'); ?>" method="post" name="theForm" enctype="multipart/form-data" >
	 <table width="100%" id="general-table">
		<tbody>
			<tr>
				<td class="label">管理员名称:</td>
				<td><input type="text" name="admin_name" maxlength="20" value="" size="27"> <font color="red">*</font></td>
			</tr>
			<tr>
				<td class="label">管理员密码:</td>
				<td><input type="password" name="password" maxlength="20" value="" size="27"> <font color="red">*</font></td>
			</tr>
			<tr>
				<td class="label">添加角色:</td>
				<td>
				    <?php foreach($roleList as $val): ?>
						<input type="checkbox" name="role_id[]" value="<?php echo $val['role_id']; ?>"> <?php echo $val['role_name']; endforeach; ?>
					
				</td>
			</tr>		
      </tbody></table>
      <div class="button-div">
        <input type="submit" value=" 确定 ">
        <input type="reset" value=" 重置 ">
      </div>
  </form>
</div>


</div>

</body>
</html>