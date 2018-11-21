<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:69:"C:\phpStudy\WWW\tp50\public/../app/admin\view\attribute\get_attr.html";i:1539325796;}*/ ?>
<tbody>
<?php foreach($attrList as $val): if($val['attr_input_type'] == 0): ?>
    	<tr>
		<td class="label"><?php echo $val['attr_name']; ?></td>
		<td>	
			
			<input name="attr_value_list[<?php echo $val['attr_id']; ?>]" type="text"  size="40">  
			
		</td>
	  </tr>
	<?php elseif($val['attr_input_type'] == 1): ?>
		<tr>
		<td class="label"><?php echo $val['attr_name']; ?></td>
		<td>
			
				<select name="attr_value_list[<?php echo $val['attr_id']; ?>]">
					<option value="">请选择...</option>
					<?php foreach($val['attr_values'] as $v): ?>
					<option value="<?php echo $v; ?>"><?php echo $v; ?></option>
					<?php endforeach; ?>
				</select>  
		</td>
	   </tr>
    <?php else: ?>
    	<tr>
		<td class="label"><?php echo $val['attr_name']; ?></td>
		<td>
			
				
		<?php foreach($val['attr_values'] as $v): ?>
		   <input type="checkbox" name="attr_value_list[<?php echo $val['attr_id']; ?>][]" value="<?php echo $v; ?>"><?php echo $v; endforeach; ?>
				 
		</td>
	 </tr>
	
    <?php endif; endforeach; ?>
	
							
</tbody>