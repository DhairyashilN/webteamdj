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


		<!-- Modal -->
		<div class="modal fade" id="<?php echo $pro['id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
						<h4 class="modal-title" id="myModalLabel"><?php echo $pro['name']; ?></h4>
					</div>
					<div class="modal-body">
						<div class="product-deatail-box">
							<?php foreach ($proimages as $pimage){ 
								if($pimage['product_id'] == $pro['id']) {
									?>
									<div class="text-center">
										<img src="<?php echo base_url(); ?><?php echo str_replace('../','',$pimage['image'])?>" style="height:300px;width:400px;margin:10px auto;" class="img img-responsive">
									</div>
									<?php }}?>
									<p><b>Information - </b></p>
									<p><?php echo $pro['description']; ?></p>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-red" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
				<!-- Modal -->
				<div class="modal fade" id="<?php echo $enq;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
								<h4 class="modal-title" id="myModalLabel">Spare Enquiry</h4>
							</div>
							<div class="modal-body">
								<div class="product-deatail-box">
									<?php echo form_open('', array( 'id' => 'enqForm', 'class' => '' ));?>
									<input type="hidden" name="pid" value="<?php echo $enq;?>">
									<div class="control-group form-group">
										<div class="controls">
											<label>Full Name</label>
											<input type="text" class="form-control" name="name" id="name" required>
										</div>
									</div>
									<div class="control-group form-group">
										<div class="controls">
											<label>Phone Number</label>
											<input type="tel" class="form-control" name="phone" id="phone" required>
										</div>
									</div>
									<div class="control-group form-group">
										<div class="controls">
											<label>Email Address</label>
											<input type="email" class="form-control" name="email" id="email" required>
										</div>
									</div>
									<div class="control-group form-group">
										<div class="controls">
											<label>Message</label>
											<textarea rows="10" cols="100" class="form-control" name="message" id="message" required maxlength="999" style="resize:none"></textarea>
										</div>
									</div>
									<!-- For success/fail messages -->
									<span id="success"></span>
									<span id="error"></span>&nbsp;&nbsp;&nbsp;
									<button type="submit" class=" submit-enq btn btn-green">Send Enquiry</button>
									<?php form_close(); ?>
									<?php echo validation_errors(); ?>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-red" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
