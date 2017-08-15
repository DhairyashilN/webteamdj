<?php $this->load->view('header');?>
<div id="wrapper">
	<section class="page-breadcrumb">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<h3>Spares and Accessories</h3>
				</div>
				<div class="col-lg-6">
					<ol class="breadcrumb">
						<li><a href="<?php echo base_url() ?>">Home</a></li>
						<li><a href="<?php echo site_url('spares-and-accessories') ?>">Spares and Accessories</a></li>
						<?php foreach ($ObjProduct as $product){ ?>
						<li class="active"><?php echo $product->name;?></li>
						<?php } ?>
					</ol>
				</div>
			</div>
		</div>
	</section>
	<!-- ======== Spares Section ========= -->
	<section class="spares">
		<div class="container">
			<div class="row detail-box">
				<div class="col-lg-6">
					<div id="carousel-example-generic" class="carousel slide carousel-fade"" data-ride="carousel">
						<!-- Wrapper for slides -->
						<?php $i = 1; ?>
						<div class="carousel-inner spare-carousel" role="listbox">
							<?php foreach ($ArrProductImage as $pimage) {  ?>
							<div class="item <?php if ($i == 1){echo 'active';}?>">
								<img class="img img-responsive" src="<?php echo base_url(); ?><?php echo str_replace('../','',$pimage['image'])?>"/>
							</div>
							<?php $i++; ?>
							<?php } ?>
						</div>
					</div>
					<!-- Controls -->
					<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a><br>
					<div class="text-right">
						<a href="#" data-toggle="modal" data-target="#penq<?php echo $product->id;?>"><button class="btn btn-red btn-lg">Send Enquiry</button></a>
					</div>
				</div> 
				<div class="col-lg-6">
					<?php foreach ($ObjProduct as $product){ ?>
					<div class="spare-details">
						<h2><?php echo $product->name; ?></h2>
						<div class="text-justify"><?php echo $product->description; ?></div><br/>	
					</div>
					<!-- Modal -->
					<div class="modal fade" id="penq<?php echo $product->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
									<h4 class="modal-title" id="myModalLabel">Spare Enquiry</h4>
								</div>
								<div class="modal-body">
									<div class="product-deatail-box">
										<?php echo form_open('WelcomeController/create_enquiry', array( 'id' => 'enqForm', 'class' => '','method' => 'POST'));?>
										<input type="hidden" name="pid" value="<?php echo $product->id;?>">
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
					<?php }?>					
				</div>
			</div>
		</div>
	</section>
	<!-- ======== End Spares Section ========= -->
</div>
<?php $this->load->view('footer');?>
