<?php $this->load->view('header');?>
<div id="wrapper">
	<section class="page-breadcrumb">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-xs-6">
					<h3>Contact</h3>
				</div>
				<div class="col-lg-6 col-xs-6">
					<ol class="breadcrumb">
						<li><a href="<?php echo base_url() ?>">Home</a></li>
						<li class="active">Contact</li>
					</ol>
				</div>
			</div>
		</div>
	</section>
	<!-- ======== Contact Details Section ========= -->
	<section class="contact-details">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-sm-4">
					<div class="contact-box">
						<h2><i class="fa fa-envelope fa-lg" aria-hidden="true"></i></h2>
						<h3>Email</h3>
						<p>contact@teamdjcustoms.com</p>
					</div>
				</div>
				<div class="col-lg-4 col-sm-4">
					<div class="contact-box">
						<h2><i class="fa fa-map-marker fa-lg" aria-hidden="true"></i></h2>
						<h3>Contact</h3>
						<p>1046, E Bagal Chowk, Kolhapur,</p>
						<p>Maharashtra, (INDIA) 416 008.</p>
					</div>
				</div>
				<div class="col-lg-4 col-sm-4">
					<div class="contact-box">
						<h2><i class="fa fa-phone-square fa-lg" aria-hidden="true"></i></h2>
						<h3>Call Us</h3>
						<p>+91 9922 558 855, +91 9765 858 855</p>
					</div>
				</div>
			</div>
			<hr class="star-light">
			<div class="row">
				<div class="col-lg-6 col-sm-6">
					<div class="contact-map">
						<h3>Our Location</h3><br>
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1031.476203563863!2d74.23818579999997!3d16.6979979!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bc10014e7a6a86f%3A0xc4e4624e31432372!2sTeam+DJ+(Royal+Enfield)!5e0!3m2!1sen!2s!4v1501667528975" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
					</div>
				</div>
				<div class="col-lg-6 col-sm-6">
					<div class="contatct-form">
						<h3>Send us a message </h3><br>
						<!-- <form name="sentMessage" id="contactForm" method="post" novalidate> -->
						<?php echo form_open('', array( 'id' => 'contactForm', 'class' => '' ));?>
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
							<button type="submit"  class="btn btn-red submit-contact">Send Message</button>
							<!-- For success/fail messages -->
							 &nbsp;&nbsp;&nbsp;<span id="success"></span>
							 &nbsp;&nbsp;&nbsp;<span id="error"></span>
							 <?php echo validation_errors(); ?>
						<!-- </form> -->
						<?php form_close(); ?>
					</div>
				</div>
			</div>

		</div>
	</section>
	<!-- ======== End Contact Details Section ========= -->
</div>
<?php $this->load->view('footer');?>
