<!-- head -->
<?php $this->load->view('admin/users/head', $this->data)?>

<div class="line"></div>

<div class="wrapper">
      <div class="widget">
           <div class="title">
			<h6>Cập nhật thông tin thành viên</h6>
		   </div>
 
      <form id="form" class="form" enctype="multipart/form-data" method="post" action="<?php echo admin_url('users/edit'.$info->id) ?>">
          <fieldset>
                <div class="formRow">
                	<label for="param_name" class="formLeft">Username:<span class="req">*</span></label>
                	<div class="formRight">
                		<span class="oneTwo"><?php echo $info->username?></span>
                	</div>
                	<div class="clear"></div>
                </div>
                
                <div class="formRow">
                	<label for="param_name" class="formLeft">Tên:<span class="req">*</span></label>
                	<div class="formRight">
                		<span class="oneTwo"><?php echo $info->name?></span>
                	</div>
                	<div class="clear"></div>
                </div>
                
                <div class="form-row">
    				<label for="param_password" class="form-label">Part name:<span
    					class="req">*</span></label>
    				<div class="form-item">
    					<select name="partname" id="partname">
                            <?php foreach ($list_part as $item): ?> {
                                <option value="<?php echo $item->id ?>"><?php echo $item->partname ?> </option>
                            <?php endforeach;?>
                        </select>
    				</div>
    				<div class="clear"></div>
				</div>
                
                 <div class="form-row">
    				<label for="param_password" class="form-label">Role name:<span
    					class="req">*</span></label>
    				<div class="form-item">
    					<select name="rolename" id="rolename">
                            <?php foreach ($list_role as $item): ?> {
                                <option value="<?php echo $item->id ?>"><?php echo $item->rolename ?> </option>
                            <?php endforeach;?>
                        </select>
    				</div>
    				<div class="clear"></div>
				</div>
                
                <div class="formSubmit">
	           			<input type="submit" class="redB" value="Cập nhật">
	           	</div>
          </fieldset>
      </form>
      
      </div>
</div>
