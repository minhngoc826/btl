<br>
<?php if (isset($error)) echo $error;?> 

<form action="<?php echo base_url('file/dupload')?>" method="post" enctype="multipart/form-data">
	<input type="file" name="userfile" /> <br />
	<br /> <input type="submit" value="upload" name="submit" />
</form>
