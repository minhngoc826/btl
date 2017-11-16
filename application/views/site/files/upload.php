<div class="box-center">
	<!-- The box-center product-->
	<div>
		<h2>Upload file (size <= 8MB)</h2>
	</div>
	<div class="box-content-center product">
		<p style="color: red"><?php echo $this->session->flashdata('message') ?></p>
		<div>
			<?php if(isset($error_upload)) echo $error_upload; ?>
		</div>
	</div>
	<div class="box-content-center product">
		<!-- The box-content-center -->
		<form class="t-form form_action" method="post"
			action="<?php echo site_url('file/upload')?>"
			enctype="multipart/form-data">
			
			<div class="form-row">
				<label for="param_email" class="form-label">Tên file:<span class="req">*</span></label>
				<div class="form-item">
					<input type="text" class="input" id="filename" name="filename"
						value="<?php echo set_value('filename')?>">
					<div class="clear"></div>
					<div class="error" id="email_error"><?php echo form_error('filename')?></div>
				</div>
				<div class="clear"></div>
			</div>

			<div class="form-row">
				<label for="param_password" class="form-label">Danh mục:<span
					class="req">*</span></label>
				<div class="form-item">
					<input type="text" class="input" id="cat" name="cat">
					<div class="clear"></div>
					<div class="error" id="password_error"><?php echo form_error('cat')?></div>
				</div>
				<div class="clear"></div>
			</div>

			<div class="form-row">
				<label for="param_age" class="form-label">Mode:<span class="req">*</span></label>
				<div class="form-item">
					<input type="text" class="input" id="mode" name="mode"
						value="<?php echo set_value('mode')?>">
					<div class="clear"></div>
					<div class="error" id="age_error"><?php echo form_error('mode')?></div>
				</div>
				<div class="clear"></div>
			</div>
			
			<div class="form-row">
				<label for="param_age" class="form-label">Chọn file:<span class="req">*</span></label>
				<div class="form-item">
					<input type="file" class="" id="userfile" name="userfile"
						value="<?php echo set_value('userfile')?>">
					<div class="clear"></div>
					<div class="error" id="age_error"><?php echo form_error('userfile')?></div>
				</div>
				<div class="clear"></div>
			</div>
			
			<div class="form-row">
				<label class="form-label">&nbsp;</label>
				<div class="form-item">
					<input type="submit" class="button" value="Upload" name="upload">
				</div>
			</div>
		</form>
		<div class="clear"></div>
	</div>
	<!-- End box-content-center -->
</div>