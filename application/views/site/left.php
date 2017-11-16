<div class="box-left">
	<div class="title tittle-box-left">
		<h2>Danh mục</h2>
	</div>
	<div class="content-box">
		<!-- The content-box -->
		<ul class="catalog-main">
            <?php foreach ($category_list as $row): ?>
                <li><span><a
					href="<?php echo base_url('file/category/' . $row->id) ?>"
					title="<?php echo $row->catname ?>"><?php echo $row->catname ?></a></span>
                    <?php if (!empty($row->subs)): ?>
                        <!-- lay danh sach danh muc con -->
				<ul class="catalog-sub">  
                            <?php foreach ($row->subs as $sub): ?>    					                    
                                <li><a
						href="<?php echo base_url('file/category/' . $sub->id) ?>"
						title="<?php echo $sub->catname ?>"> 
                                        <?php echo $sub->catname ?></a></li>
                            <?php endforeach; ?>		 			                    
                        </ul>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>      
        </ul>
	</div>
	<!-- End content-box -->
</div>
