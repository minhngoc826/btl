<div class="box-center">
	<!-- The box-center product-->
	<div>
		<h2>Share file: <?php echo $this->session->userdata('filename');?></h2>
	</div>
	<div class="box-content-center product">
		<p style="color: red"><?php echo $this->session->flashdata('message') ?></p>
	</div>
	<div class="box-content-center product">
		<!-- The box-content-center -->
		<form class="t-form form_action" method="post"
			action="<?php echo site_url('file/share/'.$fileid)?>"
			enctype="multipart/form-data">
			
			<div class="form-row">
				<label for="param_email" class="form-label">Username:<span class="req">*</span></label>
				<div class="form-item">
					<input type="text" class="input" id="username" name="username"
						value="<?php echo set_value('username')?>">
					<div class="clear"></div>
					<div class="error" id="email_error"><?php echo form_error('username')?></div>
				</div>
				<div class="clear"></div>
				<p style="color: red"><?php echo $fileuser; ?></p>
			</div>
			
			<div class="form-row">
				<label for="param_password" class="form-label">Part name:<span
					class="req">*</span></label>
				<div class="form-item">
					<select name="partname" id="partname">
						<option value="0" selected="selected">Select</option>
                        <?php foreach ($list_part as $item): ?> {
                            <option value="<?php echo $item->id ?>"><?php echo $item->partname ?> </option>
                        <?php endforeach;?>
                    </select>
				</div>
				<div class="clear"></div>
				<p style="color: red"><?php echo $filepart; ?></p>
			</div>

			<div class="form-row">
				<label for="param_age" class="form-label">Độ tuổi:<span class="req">*</span></label>
				<div class="form-item">
					<select name="age" id="age">
						<option value="0" selected="selected">Select</option>
                        <?php foreach ($list_age as $item): ?> {
                            <option value="<?php echo $item->id ?>"><?php echo '>= '.$item->age ?> </option>
                        <?php endforeach;?>
                    </select>
				</div>
				<div class="clear"></div>
				<p style="color: red"><?php echo $fileage; ?></p>
			</div>
			
			<div class="form-row">
				<label class="form-label">&nbsp;</label>
				<div class="form-item">
					<input type="submit" class="button" value="Share" name="share">
				</div>
			</div>
			
		</form>
		<div class="clear"></div>
	</div>
	<!-- End box-content-center -->
	<div class="box-content-center product">
		<h2>Quay lại trang <a style="color: red" href="<?php echo base_url('file/myfile') ?>">my file</a></h2>
	</div>
</div>