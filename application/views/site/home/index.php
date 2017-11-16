<?php $this->load->view('site/slide', $this->data);?>

<div class="box-center">
	<!-- The box-center product-->
	<div class="tittle-box-center">
		<h2>Danh sách files (<?php echo $total_rows ?> files)</h2>
	</div>
	<div class="box-content-center product">
		<!-- The box-content-center -->
	</div>
	<div class="box-content-center product">
		<!-- The box-content-center -->
        <?php foreach ($list as $row): ?>
            <div class="product_item">
			<h3>
				<a title="<?php echo $row->filename ?>"
					href="<?php echo base_url('file/view/' . $row->id) ?>">
                        <?php echo $row->filename ?>	                    
                    </a>
			</h3>
			<div class="product_img">
				<a title="<?php echo $row->filename ?>"
					href="<?php echo base_url('file/view/' . $row->id) ?>"> <img
					alt="<?php echo $row->filename ?>"
					src="<?php echo base_url('upload/images/' . $row->image) ?>">
				</a>
			</div>

			<p class="price">
                    <?php
            $mode = $this->modes_model->get_info($row->modeid);
            echo $mode->mode;
            ?>
                </p>

			<div class="action">
				<p style="float: left; margin-left: 10px">
					Lượt xem: <b><?php echo $row->luotxem ?></b>
				</p>
				<a title="Mua ngay"
					href="<?php echo base_url('file/view/' . $row->id) ?>"
					class="button">Xem file</a>
				<div class="clear"></div>
			</div>
		</div>
        <?php endforeach; ?>
        <div class="clear"></div>
	</div>
	<!-- End box-content-center -->
	
	  <div class="pagination">
        <?php echo $this->pagination->create_links() ?>
    </div>
	
</div>
