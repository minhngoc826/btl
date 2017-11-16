
<div id="leftSide" style="padding-top: 30px;">

	<!-- Account panel -->

	<div class="sideProfile">
		<a href="#" title="" class="profileFace"><img
			src="<?php echo public_url('admin')?>/images/user.png" width="40"></a>
		<span>Xin chào: <strong><?php echo $this->session->userdata('admin_role') ?>!</strong></span>
		<span><?php echo $this->session->userdata('admin_name'); ?></span>
		<div class="clear"></div>
	</div>
	<div class="sidebarSep"></div>
	<!-- Left navigation -->

	<ul id="menu" class="nav">

		<li class="home"><a href="<?php echo admin_url()?>" class="active" id="current"> <span>Bảng điều khiển</span> <strong></strong></a></li>
		<li class="tran"><a href="admin/tran.html" class="exp inactive"><span>Quản lý hệ thống</span> <strong>2</strong></a>
			<ul style="display: none;" class="sub">
				<li><a href="<?php echo admin_url('part')?>"> Quản lý part </a></li>
				<li><a href="<?php echo admin_url('age')?>"> Quản lý nhóm tuổi </a></li>
			</ul>
		</li>
		<li class="product"><a href="admin/product.html" class="exp inactive"><span>Quản lý tài liệu</span> <strong>3</strong></a>
			<ul style="display: none;" class="sub">
				<li><a href="<?php echo admin_url('file')?>">Quản lý file </a></li>
				<li><a href="<?php echo admin_url('category')?>">Quản lý danh mục file </a></li>
			</ul>
		</li>
		<li class="product"><a href="admin/product.html" class="exp inactive"><span>Quản lý account</span> <strong>5</strong></a>
			<ul style="display: none;" class="sub">
				<li><a href="<?php echo admin_url('admin/account')?>"> Tài khoản </a></li>
				<li><a href="<?php echo admin_url('admin')?>"> Ban quản trị </a></li>
				<li><a href="<?php echo admin_url('users')?>"> Thành viên </a></li>
				<li><a href="<?php echo admin_url('role')?>"> Nhóm role </a></li>
				<li><a href="<?php echo admin_url('permission')?>"> Phân quyền </a></li>
			</ul>
		</li>
		<li class="support"><a href="admin/support.html" class="exp inactive"><span>Hỗ trợ và liên hệ</span> <strong>2</strong></a>
			<ul style="display: none;" class="sub">
				<li><a href="admin/support.html"> Hỗ trợ </a></li>
				<li><a href="admin/contact.html"> Liên hệ </a></li>
			</ul>
		</li>
		<li class="content"><a href="admin/content.html" class="exp inactive"><span>Nội dung</span> <strong>4</strong></a>
			<ul style="display: none;" class="sub">
				<li><a href="<?php echo admin_url('slide')?>"> Slide </a></li>
				<li><a href="<?php echo admin_url('news')?>"> Tin tức </a></li>
				<li><a href="admin/info.html"> Trang thông tin </a></li>
				<li><a href="admin/video.html"> Video </a></li>
			</ul>
		</li>
	</ul>
</div>
<div class="clear"></div>
