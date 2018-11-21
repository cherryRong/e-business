<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:66:"C:\phpStudy\WWW\tp50\public/../app/admin\view\role\privillage.html";i:1542700022;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SHOP 管理中心 - 添加权限 </title>
<base href="/admin/">
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles/general.css" rel="stylesheet" type="text/css" />
<link href="styles/main.css" rel="stylesheet" type="text/css" />
</head>
<body>

<h1>
<span class="action-span"><a href="">角色列表</a></span>
<span class="action-span1"><a href="">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 分配权限【admin】 </span>
<div style="clear:both"></div>
</h1>
<!-- start add new category form -->
<div class="main-div">
  <form action="" method="post" name="theForm" enctype="multipart/form-data" >
	 <table width="100%" id="general-table">
		<tbody>
		    <?php foreach($nodeList as $val): ?>
			<tr>
				<td width="18%" valign="top" class="first-cell">
				     <input type="checkbox"  class="checkbox" name="node_id[]" value="<?php echo $val['node_id']; ?>"  <?php if($val['is_my'] == 1): ?>checked<?php endif; ?>> 
				     <?php echo $val['title']; ?> |
				</td>
				    
				<?php foreach($val['son'] as $v): ?>
				<td>
					<div style="width:200px;float:left" >
					      <input type="checkbox"  class="checkbox" name="node_id[]" value="<?php echo $v['node_id']; ?>"  <?php if($v['is_my'] == 1): ?>checked<?php endif; ?> ><?php echo $v['title']; ?>
					</div>
					
				</td>
				<?php endforeach; ?>
			</tr>
            <?php endforeach; ?>
			
			
			
      </tbody>
    </table>
      <div class="button-div">
        <input type="submit" value=" 确定 ">
        <input type="reset" value=" 重置 ">
      </div>
    <input type="hidden"  name="role_id" value="<?php echo $role_id; ?>">
  </form>
</div>


</div>

</body>
</html>