<!-- head -->
<?php $this->load->view('admin/part/head', $this->data)?>

<div class="line"></div>

<div class="wrapper">
      <div class="widget">
           <div class="title">
			<h6>Cập nhật thông part</h6>
		   </div>
 
      <form id="form" class="form" enctype="multipart/form-data" method="post" action="<?php echo admin_url('part/edit').$info->id ?>">
          <fieldset>
                
                 <div class="formRow">
                	<label for="param_age" class="formLeft">Partname:<span class="req">*</span></label>
                	<div class="formRight">
                		<span class="oneTwo"><input type="text" _autocheck="true" value="<?php echo $info->partname?>" id="param_partname" name="partname"></span>
                		<span class="autocheck" name="name_autocheck"></span>
                		<div class="clear error" name="name_error"><?php echo form_error('partname')?></div>
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
