<div class="box-center">
	<!-- The box-center product-->
	<div>
		<h2>Chỉnh sửa thông tin thành viên</h2>
	</div>
	<div class="box-content-center product">
		<!-- The box-content-center -->
		<form class="t-form form_action" method="post"
			action="<?php echo site_url('user/edit')?>"
			enctype="multipart/form-data">
			<div class="form-row">
				<label for="param_email" class="form-label">Username:</label>
				<div class="form-item">
        							 <?php echo $user->username?>
        						</div>
				<div class="clear"></div>
			</div>

			<div class="form-row">
				<label for="param_password" class="form-label">Pasword:</label>
				<div class="form-item">
					<input type="password" class="input" id="password" name="password">
					<div class="clear"></div>
					<p>Nếu thay đổi mật khẩu thì nhập dữ liệu</p>
					<div class="error" id="password_error"><?php echo form_error('password')?></div>
				</div>
				<div class="clear"></div>
			</div>

			<div class="form-row">
				<label for="param_re_password" class="form-label">Repeat password:</label>
				<div class="form-item">
					<input type="password" class="input" id="re_password"
						name="re_password">
					<div class="clear"></div>
					<div class="error" id="re_password_error"><?php echo form_error('re_password')?></div>
				</div>
				<div class="clear"></div>
			</div>

			<div class="form-row">
				<label for="param_name" class="form-label">Age:<span
					class="req">*</span></label>
				<div class="form-item">
					<input type="text" class="input" id="age" name="age"
						value="<?php echo $user->age ?>">
					<div class="clear"></div>
					<div class="error" id="age_error"><?php echo form_error('age')?></div>
				</div>
				<div class="clear"></div>
			</div>
			
			<div class="form-row">
				<label class="form-label">&nbsp;</label>
				<div class="form-item">
					<input type="submit" class="button" value="Chỉnh sửa thông tin"
						name="submit">
				</div>
			</div>
		</form>
		<div class="clear"></div>
	</div>
	<!-- End box-content-center -->

</div>
