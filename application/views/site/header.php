<!-- The box-header-->
<link rel="stylesheet"
	href="<?php echo public_url() ?>/js/jquery/autocomplete/css/smoothness/jquery-ui-1.8.16.custom.css"
	type="text/css">
<script
	src="<?php echo public_url() ?>/js/jquery/autocomplete/jquery-ui-1.8.16.custom.min.js"
	type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        $("#text-search").autocomplete({
            source: "<?php echo site_url('file/search/1') ?>",
        });
    });
</script>


<div class="top">
	<!-- The top -->
	<div id="logo">
		<!-- the logo -->
		<a title="Xem tài liệu" href="<?php echo base_url() ?>"> <img
			alt="Xem tài liệu"
			src="<?php echo public_url() ?>/site/images/logo_1.jpg"
			style="width: 250px">
		</a>
		
	</div>
	<!-- End logo -->
	
	<!--  search -->
	<div id="search">
		<!-- the search -->
		<form action="<?php echo site_url('file/search') ?>" method="get">
			<input type="text" aria-haspopup="true" aria-autocomplete="list"
				role="textbox" autocomplete="off" class="ui-autocomplete-input"
				placeholder="Tìm kiếm tài liệu ..."
				value="<?php echo isset($key) ? $key : '' ?>" name="key-search"
				id="text-search"> <input type="submit" value="" name="but" id="but">
		</form>
	</div>
	<!-- End search -->

	<div class="clear"></div>
	<!-- clear float -->
</div>
<!-- End top -->
<!-- End box-header  -->

<!-- The box-header-->
<div id="menu">
	<!-- the menu -->
	<ul class="menu_top">
		<li class="active index-li"><a href="<?php echo base_url() ?>">Trangchủ</a></li>
		<li class=""><a href="<?php echo site_url('home/gioithieu') ?>">Giới thiệu</a></li>
		<li class=""><a href="<?php echo site_url('home/huongdan') ?>">Hướng dẫn</a></li>
		<li class=""><a href="<?php echo site_url('home/lienhe') ?>">Liên hệ</a></li>
		<li class=""><a href="<?php echo site_url('file/myfile') ?>">My Files</a></li>
		<li class=""><a href="<?php echo site_url('file/upload') ?>">Upload</a></li>
		<li class=""><a href="<?php echo site_url('file/index') ?>">Share file</a></li>
		<li class=""><a href="<?php echo base_url('admin') ?>">Admin</a></li>
        
        <?php if (isset($user_info)): ?>
            <li class=""><a href="<?php echo site_url('user') ?>">Xin chào: <i><?php echo $user_info->username ?></i></a></li>
		<li class=""><a href="<?php echo site_url('user/logout') ?>">Thoát</a></li>
        <?php else: ?>
            <li class=""><a
			href="<?php echo site_url('user/register') ?>">Đăng ký</a></li>
		<li class=""><a href="<?php echo site_url('user/login') ?>">Đăng nhập</a></li>
        <?php endif; ?>
    </ul>
</div>
<!-- End menu -->
<!-- End box-header  -->
