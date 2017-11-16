<!-- head -->
<?php $this->load->view('admin/part/head', $this->data)?>

<div class="line"></div>

<div class="wrapper">

    <?php $this->load->view('admin/message', $this->data);?>
    
	<div class="widget">
	
		<div class="title">
			
			<h6>Danh sách part</h6>
		 	<div class="num f12">Tổng số: <b><?php echo $total?></b></div>
		</div>
		
		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
			<thead>
				<tr>
					
					<td style="width:80px;">Mã số</td>
					<td>Partname</td>
					<td style="width:100px;">Hành động</td>
				</tr>
			</thead>
			
			<tbody>
			<?php foreach ($list as $row):?>
			<tr>
						
						<td class="textC"><?php echo $row->id?></td>

						<td><span title="<?php echo $row->partname?>" class="tipS">
							<?php echo $row->partname?>					
						</span></td>
						
						
						<td class="option">
							<a href="<?php echo admin_url('part/edit/'.$row->id)?>" title="Chỉnh sửa" class="tipS ">
							   <img src="<?php echo public_url('admin')?>/images/icons/color/edit.png" />
							</a>
							
							<a href="<?php echo admin_url('part/delete/'.$row->id)?>" title="Xóa" class="tipS verify_action" >
							    <img src="<?php echo public_url('admin')?>/images/icons/color/delete.png" />
							</a>
						</td>
					</tr>
					<?php endforeach;?>
					</tbody>
				</table>
	</div>
</div>

<div class="clear mt30"></div>
