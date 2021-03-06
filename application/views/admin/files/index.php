<!-- head -->
<?php $this->load->view('admin/files/head', $this->data)?>

<div class="line"></div>

<div id="main_file" class="wrapper">
	<div class="widget">
	
		<div class="title">
			<span class="titleIcon"><input type="checkbox" name="titleCheck" id="titleCheck"></span>
			<h6>
				Danh sách file			
			</h6>
		 	<div class="num f12">Số lượng: <b><?php echo $total_rows?></b></div>
		</div>
		
		
		<table width="100%" cellspacing="0" cellpadding="0" id="checkAll" class="sTable mTable myTable">
			
			<thead class="filter"><tr><td colspan="6">
				<form method="get" action="<?php echo admin_url('file')?>" class="list_filter form">
					<table width="80%" cellspacing="0" cellpadding="0"><tbody>
					
						<tr>
							<td class="item">
								<select name="catalog">
									<option value=""></option>
										<!-- kiem tra danh muc co danh muc con hay khong -->
										<?php foreach ($catalogs as $row):?>
										<?php if(count($row->subs) > 1):?>
    				      				<optgroup label="<?php echo $row->catname?>">
    				      				    <?php foreach ($row->subs as $sub):?>
    				               			<option value="<?php echo $sub->id?>" <?php echo ($this->input->get('catalog') == $sub->id) ? 'selected' : ''?>> <?php echo $sub->catname?> </option>
    						                <?php endforeach;?>
    				               		</optgroup>
    				               		<?php else:?>
    				               		  <option value="<?php echo $row->id?>" <?php echo ($this->input->get('catalog') == $row->id) ? 'selected' : ''?>><?php echo $row->catname?></option>
    				               		<?php endif;?>
    				               		<?php endforeach;?>
								</select>
							</td>
						</tr>
					</tbody></table>
				</form>
			</td></tr></thead>
			
			<thead>
				<tr>
					<td style="width:21px;"><img src="<?php echo public_url('admin/images')?>/icons/tableArrows.png"></td>
					<td style="width:60px;">Mã số</td>
					<td>Tên file</td>
					<td>Ngày tạo</td>
					<td style="width:120px;">Hành động</td>
				</tr>
			</thead>
			
 			<tfoot class="auto_check_pages">
				<tr>
					<td colspan="6">
						 <div class="list_action itemActions">
								<a url="<?php echo admin_url('file/delete_all')?>" class="button blueB" id="submit" href="#submit">
									<span style="color:white;">Xóa hết</span>
								</a>
						 </div>
							
					     <div class="pagination">
					          <?php echo $this->pagination->create_links()?>
			             </div>
					</td>
				</tr>
			</tfoot>
			
			<tbody class="list_item">
			     <?php foreach ($list as $row):?>
			     <tr class="row_<?php echo $row->id?>">
					<td><input type="checkbox" value="<?php echo $row->id?>" name="id[]"></td>
					
					<td class="textC"><?php echo $row->id?></td>
					
					<td>
					<div class="image_thumb">
						<img height="50" src="<?php echo base_url('upload/images/'.$row->image)?>">
						<div class="clear"></div>
					</div>
					
					<a target="_blank" title="" class="tipS" href="">
					    <b><?php echo $row->filename?></b>
					</a>
					</td>
					
					<td class="textC"><?php echo $row->create?></td>
					
					<td class="option textC">
						<a title="Xem chi tiết file" class="tipS" target="_blank" href="<?php echo admin_url('file/view/'.$row->id)?>">
								<img src="<?php echo public_url('admin/images')?>/icons/color/view.png">
						 </a>
						 
						 <a class="tipS" title="Chỉnh sửa" href="<?php echo admin_url('file/edit/'.$row->id)?>">
							<img src="<?php echo public_url('admin/images')?>/icons/color/edit.png">
						</a>
						
						<a class="tipS verify_action" title="Xóa" href="<?php echo admin_url('file/del/'.$row->id)?>">
						    <img src="<?php echo public_url('admin/images')?>/icons/color/delete.png">
						</a>
					</td>
				</tr>
				<?php endforeach;?>
		   </tbody>
			
		</table>
	</div>
	
</div>


