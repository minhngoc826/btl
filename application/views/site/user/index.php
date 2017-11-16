<style>
table td {
	padding: 10px;
	border: 1px solid #f0f0f0;
}
</style>
<div class="box-center">
	<!-- The box-center product-->
	<div>
		<h2>Thông tin thành viên</h2>
	</div>
	<div class="box-content-center product">
		<!-- The box-content-center -->
		<table>
			<tr>
				<td>Username</td>
				<td><?php echo $user->username?></td>
			</tr>
			<tr>
				<td>Age</td>
				<td><?php echo $user->age?></td>
			</tr>
		</table>
		<a href="<?php echo site_url('user/edit')?>" class="button">Sửa</a>
	</div>
</div>
