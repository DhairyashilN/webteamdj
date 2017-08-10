<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
  if ($this->session->userdata('alogin')==1) {
    redirect('dashboard','refresh');
  }
?>
<!DOCTYPE html>
<html lang="en" class="bg-black">
<head>
  <title>Team DJ Customs | <?php echo !empty($title) ? $title : '' ?></title>
  <!-- CSS And JavaScript -->
  <meta charset="utf-8">
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <!-- Bootstrap Core CSS -->
  <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
  <!-- font Awesome -->
  <link href="<?php echo base_url();?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <!-- Ionicons -->
  <link href="<?php echo base_url();?>assets/css/ionicons.min.css" rel="stylesheet" type="text/css" />
  <!-- Theme style -->
  <link href="<?php echo base_url();?>assets/css/AdminLTE.css" rel="stylesheet" type="text/css" />
</head>
<body class="bg-black">
  <div class="form-box" id="login-box">
    <div class="margin text-center">
      <h2>TEAM DJ Customs</h2>
      <hr width="25%">
    </div>
    <div class="header">Admin Login</div>
    <?php echo form_open('backend/login', array('method'=>'post')); ?>
      <div class="body bg-gray">
        <div class="form-group">
          <input type="text" name="username" class="form-control" placeholder="Username"/>
        </div>
        <div class="form-group">
          <input type="password" name="password" class="form-control" placeholder="Password"/>
        </div>          
      </div>
      <div class="footer">                                                               
        <button type="submit" class="btn bg-green btn-block">Sign me in</button>  
        <p><a href="#">I forgot my password</a></p>
      </div>
      <div class="margin text-center">
        <span><?php echo(date('Y')); ?></span>
      </div>
    <?php echo form_close(); ?>
  </div>
  <!-- jQuery 2.0.2 -->
  <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="<?php echo base_url();?>assets/js/bootstrap.min.js" type="text/javascript"></script>        
</body>
</html>