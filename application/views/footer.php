<footer>
	<div class="container">
		<div class="row ">
			<div class="col-lg-4 col-sm-4 col-sm-12">
				<h3 class="footer-headings">Company</h3>
				<ul class="footer-lists">
					<li><a href="<?php echo site_url('home');?>">Home</a></li>
					<li><a href="<?php echo site_url('about');?>">About</a></li>
					<li><a href="<?php echo site_url('services');?>">Services</a></li>
					<li><a href="<?php echo '#';?>">Work</a></li>
					<li><a href="<?php echo site_url('spares-and-accessories');?>">Spares</a></li>
					<li><a href="<?php echo site_url('media');?>">Media</a></li>
					<li><a href="<?php echo site_url('events');?>">Events</a></li>
					<li><a href="<?php echo site_url('contact');?>">Contact</a></li>
				</ul>
			</div>
			<div class="col-lg-4 col-sm-4 col-sm-12">
				<h3 class="footer-headings">Stay Connected</h3>
				<ul class="list-inline"> 
					<li><a href="https://www.facebook.com/Team-DJ-708194855925782/" target="_blank" class="social-icons"><i class="fa fa-facebook-square fa-lg" aria-hidden="true"></i></a></li>
					<li><a href="https://www.linkedin.com/company-beta/18083345/" target="_blank" class="social-icons"><i class="fa fa-linkedin-square fa-lg" aria-hidden="true"></i></a></li>
					<li><a href="https://www.linkedin.com/company-beta/18083345/" target="_blank" class="social-icons"><i class="fa fa-instagram fa-lg" aria-hidden="true"></i></a></li>
				</ul>
			</div>
			<div class="col-lg-4 col-sm-4 col-sm-12">
				<h3 class="footer-headings">Contact Us</h3>
				<address>
					<p>1046, E Bagal Chowk, Kolhapur,</p><p>Maharashtra (INDIA) 416 008.</p>
					<p><i class="fa fa-phone-square" aria-hidden="true"></i> +91 9922 558 855, +91 9765 858 855</p>
					<p><i class="fa fa-envelope" aria-hidden="true"></i> contact@teamdjcustoms.com</p>
				</address>
			</div>
		</div>
	</div>
</footer>
<div class="footer-bottom">
	<div class="container">
		<div class="row hidden-xs hidden-sm">
			<div class="col-lg-5 col-sm-5">
				<p class="">&copy; <?php echo date('Y') ?> TEAM DJ Customs. All Rights Reserved.</p>
			</div>
			<div class="col-lg-3 col-sm-3">
				<!-- <div>Icons made by <a href="http://www.freepik.com" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div> -->
			</div>
			<div class="col-lg-4 col-sm-4">
				<p class="text-right">Handcrafted in <img src="https://png.icons8.com/india/color/48" title="India" width="24" height="24"> by DhairYASHil  </p>
			</div>
		</div>
		<div class="row visible-xs visible-sm">
			<div class="col-xs-12">
				<div class="text-center">
					<p>&copy; <?php echo date('Y') ?> TEAM DJ Customs. All Rights Reserved.</p>
					<p>Handcrafted by DhairYASHil </p>
				</div>
			</div>
		</div>
	</div>
</div>
<a href="#" class="scrollToTop" title="Go To Top" style="color: #fff"><i class="fa fa-chevron-up fa-lg" aria-hidden="true"></i></a>
<!-- jQuery -->
<script src="<?php echo base_url();?>assets/js/jquery.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/js/image_loader.js"></script>
<!-- Image Gallery PLUGIN  -->
<script src="<?php echo base_url();?>assets/js/jquery.swipebox.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.swipebox').swipebox();
		$(".works-dropdown").mouseover(function () {
			$(".works-menu").slideDown('slow');
		});

		$(".works-dropdown").mouseleave(function () {
			$(".works-menu").slideUp('slow');
		});
	//Check to see if the window is top if not then display button
	$(window).scroll(function(){
		if ($(this).scrollTop() > 800) {
			$('.scrollToTop').fadeIn();
		} else {
			$('.scrollToTop').fadeOut();
		}
	});
	
	//Click event to scroll to top
	$('.scrollToTop').click(function(){
		$('html, body').animate({scrollTop : 0},800);
		return false;
	});
	$(window).scroll(function() {
		if ($(document).scrollTop() > 50) {
			$('.navbar-black').css('display','none');
			$('.navbar-black-2').css('display','block');
		} else {
			// $('nav').removeClass('shrink');
			$('.navbar-black').css('display','block');
			$('.navbar-black-2').css('display','none');
		}
	});
	$('.submit-contact').on('click',function(e) {
		e.preventDefault();
		if ($('#name,#phone,#email,#message').val() == '') {
			$('#error').text('All fields are required');
		} else {
			$('#error').text('');
			$('#success').text('Sending your message.');
			$.ajax({
				type : 'POST',
				url  : 'submit_contact',
				data : $('#contactForm').serialize(),
				success:function(data) {
					var result = $.parseJSON(data);
					if (result['success'] == 1) {
						$('#success').text('Thank you for contacting with us.');
						$('#contactForm')[0].reset();
					} else{
						$('#success').text('');
						$('#error').text('Error occured...');
					}
				}
			});
		}
	});
});
</script>
</body>
</html>