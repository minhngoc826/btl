<!-- video -->
<script type='text/javascript'
	src='<?php echo public_url() ?>/site/tivi/jwplayer.js'></script>
<script type='text/javascript'>
    jQuery('document').ready(function () {
        jwplayer('mediaspace').setup({
            'flashplayer': '<?php echo public_url() ?>/site/tivi/player.swf',
            'files': 'https://www.youtube.com/watch?v=zAEYQ6FDO5U',
            'controlbar': 'bottom',
            'width': '560',
            'height': '315',
            'autoplay': true
        });
    })
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('a.tab').click(function () {
            var an_di = $('a.selected').attr('rel');//lấy title của thẻ <a class='active'>
            $('div#' + an_di).hide();//ẩn thẻ <div id='an_di'>
            $('a.selected').removeClass('selected');
            $(this).addClass('selected');
            var hien_thi = $(this).attr('rel');//lấy title của thẻ <a> khi ta kick vào nó
            $('div#' + hien_thi).show();//hiện lên thẻ <div id='hien_thi'>
        });
    });
</script>

<!-- zoom image -->
<script
	src="<?php echo public_url() ?>/site/jqzoom_ev/js/jquery.jqzoom-core.js"
	type="text/javascript"></script>
<link rel="stylesheet"
	href="<?php echo public_url() ?>/site/jqzoom_ev/css/jquery.jqzoom.css"
	type="text/css">
<script type="text/javascript">
    $(document).ready(function () {
        $('.jqzoom').jqzoom({
            zoomType: 'standard',
        });
    });
</script>
<!-- end zoom image -->

<!-- Raty -->
<script type="text/javascript">
    $(document).ready(function () {
        //raty
        $('.raty_detailt').raty({
            score: function () {
                return $(this).attr('data-score');
            },
            half: true,
            click: function (score, evt) {
                var rate_count = $('.rate_count');
                var rate_count_total = rate_count.text();
                $.ajax({
                    url: 'http://localhost/webphp/files/raty.html',
                    type: 'POST',
                    data: {'id': '9', 'score': score},
                    dataType: 'json',
                    success: function (data)
                    {
                        if (data.complete)
                        {
                            var total = parseInt(rate_count_total) + 1;
                            rate_count.html(parseInt(total));
                        }
                        alert(data.msg);
                    }
                });
            }
        });
    });
</script>
<!--End Raty -->

<div class="box-center">
	<!-- The box-center files-->
	<div class="tittle-box-center">
		<h2>Chi tiết file</h2>
	</div>
	<div class="box-content-center files">
		<!-- The box-content-center -->
		<div class='files_view_img'>
			<a href="<?php echo base_url('upload/files/' . $files->image) ?>"
				class="jqzoom" rel='gal1' title="triumph"> <img
				src="<?php echo base_url('upload/files/' . $files->image) ?>"
				alt="<?php echo $files->filename ?>" style="width: 280px !important">
			</a>
			<div class='clear' style='height: 10px'></div>
			<div class="clearfix"></div>
		</div>

		<div class='files_view_content'>
			<h1><?php echo $files->filename ?></h1>

			<p class='option'>
                <?php ?>
            </p>

			<p class='option'>
				Danh mục: <a
					href="<?php echo base_url('file/category/' . $category->id) ?>"
					title="<?php echo $category->catname ?>"> <b><?php echo $category->catname ?></b>
				</a>
			</p>

			<p class='option'>
				Lượt xem: <b><?php echo $files->luotxem ?></b>
			</p>
			Đánh giá &nbsp; <span class='raty_detailt' style='margin: 5px' id='9'
				data-score='4'></span> | Tổng số: <b class='rate_count'>1</b>

		</div>
		<div class='clear' style='height: 15px'></div>
	</div>
</div>