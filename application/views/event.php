<?php $this->load->view('header');?>
<div id="wrapper">
	<section class="page-breadcrumb">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-xs-6">
					<h3>Events</h3>
				</div>
				<div class="col-lg-6 col-xs-6">
					<ol class="breadcrumb">
						<li><a href="<?php echo base_url() ?>">Home</a></li>
						<li class="active">Events</li>
					</ol>
				</div>
			</div>
		</div>
	</section>
	<!-- ======== Events Section ========= -->
	<section class="events">
		<div class="container">
			<div class="row">
			<?php if(isset($ArrEvents) && !empty($ArrEvents)){
				$col=0; 
				foreach ($ArrEvents as $event){?>
				<div class="col-lg-4 col-sm-4">
					<div class="event-box">
						<img src="<?php echo base_url(); ?><?php echo str_replace('../','',$event['poster_image'])?>" style="height:250px;width:100%" class="img img-responsive">
						<a href="<?php echo site_url('events/'.$event['url']);?>">
							<h4><?php echo $event['title']; ?></h4>
						</a>
					</div>
				</div>
			<?php }} ?>
			</div>
		</div>
	</section>
	<!-- ======== End Events Section ========= -->
</div>
<?php $this->load->view('footer');?>
