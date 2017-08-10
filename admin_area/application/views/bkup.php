<div class="product-box">
										<?php foreach ($proimages as $pimage){ 
											if($pimage['product_id'] == $pro['id']) {
										?>
										<img src="<?php echo base_url()?><?php echo $pimage['image'];?>" style="height:200px;width:100%">
										<?php }}  ?>
										<a href="#"><p><?php echo $pro['name']; ?></p></a>
										<span>
											<a href="#" data-toggle="modal" data-target="#<?php echo $pro['id']?>"><button class="btn btn-green">Details</button></a>
											&nbsp;&nbsp;&nbsp;&nbsp;
											<a href="#" data-toggle="modal" data-target="#enq<?php echo $pro['id']?>""><button class="btn btn-red">Send Enquiry</button></a>
										</span>
									</div>