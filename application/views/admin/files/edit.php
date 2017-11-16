<!-- head -->
<?php $this->load->view('admin/files/head', $this->data)?>

<div class="line"></div>

<div class="wrapper">

	<!-- Form -->
	<form enctype="multipart/form-data" method="post" action="<?php echo admin_url('file/edit/'.$files->id) ?>" id="form"
		class="form">
		<fieldset>
			<div class="widget">
				<div class="title">
					<img class="titleIcon"
						src="<?php echo public_url('admin')?>/images/icons/dark/add.png">
					<h6>Cập nhật tên file</h6>
				</div>

				<div class="tab_container">
					<div class="tab_content pd0" id="tab1" style="display: block;">
						<div class="formRow">
							<label for="param_name" class="formLeft">Tên:<span class="req">*</span></label>
							<div class="formRight">
								<span class="oneTwo"><input type="text" _autocheck="true"
									id="param_name" value="<?php echo $files->filename?>"
									name="name"></span> <span class="autocheck"
									name="name_autocheck"></span>
								<div class="clear error" name="name_error"></div>
							</div>
							<div class="clear"></div>
						</div>
					</div>
				</div>
				<!-- End tab_container-->

				<div class="formSubmit">
					<input type="submit" class="redB" value="Cập nhật"> <input
						type="reset" class="basic" value="Hủy bỏ">
				</div>
				<div class="clear"></div>
			</div>
		</fieldset>
	</form>
</div>
<div class="clear mt30"></div>
