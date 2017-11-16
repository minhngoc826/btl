<!-- head -->
<?php $this->load->view('admin/age/head', $this->data)?>

<div class="line"></div>

<div class="wrapper">
      <div class="widget">
           <div class="title">
			<h6>Thêm mới nhóm tuổi</h6>
		</div>
		
		 
      <form id="form" class="form" enctype="multipart/form-data" method="post" action="<?php echo admin_url('age/add') ?>">
          <fieldset>
                 <div class="formRow">
                	<label for="param_age" class="formLeft">Age:<span class="req">*</span></label>
                	<div class="formRight">
                		<span class="oneTwo"><input type="text" _autocheck="true" value="<?php echo set_value('age')?>" id="param_age" name="age"></span>
                		<span class="autocheck" name="name_autocheck"></span>
                		<div class="clear error" name="name_error"><?php echo form_error('age')?></div>
                	</div>
                	<div class="clear"></div>
                </div>
                <div class="formSubmit">
	           			<input type="submit" class="redB" value="Thêm mới">
	           	</div>
          </fieldset>
      </form>
      
      </div>
</div>