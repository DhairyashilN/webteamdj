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
						<li class="active">Spares and Accessories</li>
					</ol>
				</div>
			</div>
		</div>
	</section>
	<!-- ======== Spares Section ========= -->
	<section class="spares">
		<div class="container">
			<div class="row">
				<div class="col-lg-3">
					<div class="panel panel-default spares-category">
						<div class="panel-heading">
							<h3 class="panel-title">Filter by Category</h3>
						</div>
						<div class="panel-body">
							<ul type="none">
								<?php foreach ($categories as $cat){?>
								<li><a href="<?php echo site_url('spares-and-accessorie/spares/'.$cat['id']);?>"><i class="fa fa-plus" aria-hidden="true"></i> <?php echo $cat['category'];?></a></li>
								<?php } ?>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-lg-9">
					<div class="row">
						<?php if (isset($products) && !empty($products)){ 
							foreach ($products as $pro) {
								$enq = 'enq'.$pro['id'];
								?>
								<div class="col-lg-4">
									<div class="product-box thumbnail">
										<?php foreach ($proimages as $pimage){ 
											if($pimage['product_id'] == $pro['id']) {
												?>
												<img src="<?php echo base_url(); ?><?php echo str_replace('../','',$pimage['image'])?>" style="height:200px;width:100%">
												<?php }}?>
												<p style="color:#000;"><?php echo $pro['name']; ?></p>
												<a href="<?php echo site_url('spares-and-accessorie/spare/'.$pro['url']);?>"><button class="btn btn-green btn-block">Details</button></a>
												<!-- <a href="#"><button class="btn btn-red">Send Enquiry</button></a> -->
											</div>
										</div>
										<?php }}else{?>
										<h4 class="text-center" style="color:#fff">No Spare found for selected category</h4>
										<?php } ?>
									</div><br>
								</div>
							</div>
						</div>
					</section>
					<!-- ======== End Spares Section ========= -->
				</div>
				<?php $this->load->view('footer');?>