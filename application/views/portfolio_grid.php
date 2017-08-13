<?php $this->load->view('header');?>
<div id="wrapper">
	<section class="page-breadcrumb">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<h3>Work</h3>
				</div>
				<div class="col-lg-6">
					<ol class="breadcrumb">
						<li><a href="<?php echo base_url() ?>">Home</a></li>
						<li><a href="#">Work</a></li>
						<li class="active"><?php echo ucfirst($this->uri->segment(2));?></li>
					</ol>
				</div>
			</div>
		</div>
	</section>
	<!-- ======== Spares Section ========= -->
	<section class="spares">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="row">
						<?php if (isset($ArrPortfolio) && !empty($ArrPortfolio)){ 
							foreach ($ArrPortfolio as $po){ ?>
							<div class="col-lg-4">
								<div class="product-box thumbnail">
									<a href="<?php echo site_url('work/'.$this->uri->segment(2).'/'.$po['purl']);?>">
										<img src="<?php echo base_url(); ?><?php echo str_replace('../','',$po['pimage'])?>" style="height:200px;width:100%">
										<p style="color:#000;"><?php echo $po['ptitle']; ?></p>
									</a>
								</div>
							</div>
							<?php }}else{?>
							<h3 class="text-center" style="color:#fff">No data found for selected category</h3>
							<?php } ?>
						</div><br>
					</div>
				</div>
			</div>
		</section>
		<!-- ======== End Spares Section ========= -->
	</div>
	<?php $this->load->view('footer');?>
