<?php $this->load->view('header');?>
<div id="wrapper">
	<section class="page-breadcrumb">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<h3>Events</h3>
				</div>
				<div class="col-lg-6">
					<ol class="breadcrumb">
						<li><a href="<?php echo base_url() ?>">Home</a></li>
						<li><a href="<?php echo site_url('events') ?>">Events</a></li>
						<?php foreach ($ObjEvent as $event){ ?>
						<li class="active"><?php echo $event->title;?></li>
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
				<div class="col-lg-12">
					<?php
					if (isset($ObjEvent) && !empty($ObjEvent)) {
					foreach ($ObjEvent as $event){ ?>
					<p style="font-size: 22px;"><?php echo $event->title;?></p>
					<hr>
					<?php if(empty($ArrEventImage)){?><?php }else{?>
					<div id="carousel-example-generic" class="carousel slide carousel-fade"" data-ride="carousel">
						<!-- Wrapper for slides -->
						<?php $i = 1; ?>
						<div class="carousel-inner event-carousel" role="listbox">
							<?php foreach ($ArrEventImage as $pimage) {  ?>
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
					</a>
					<br>
					<?php } ?>
					<div class="text-justify">
						<p><?php echo $event->description;?></p>
					</div>					
				</div> 
				<?php }}else{ redirect('page-not-found');} ?>
			</div>
		</div>
	</section>
	<!-- ======== End Spares Section ========= -->
</div>
<?php $this->load->view('footer');?>
