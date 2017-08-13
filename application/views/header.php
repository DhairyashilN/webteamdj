<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Team DJ Customs | <?php echo !empty($title) ? $title : '' ?></title>
  <!-- CSS And JavaScript -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="<?php echo base_url();?>assets/images/favicon.png" type="image/png" sizes="16x16">
  <!-- Bootstrap Core CSS -->
  <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link href="<?php echo base_url();?>assets/css/custom_styles.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/css/hover-min.css" rel="stylesheet">
  <!-- XZOOM JQUERY PLUGIN  -->
  <script src="<?php echo base_url();?>assets/js/xzoom/dist/xzoom.css"></script>
</head>
<body>
  <div class="se-pre-con"></div>
  <nav class="navbar navbar-inverse navbar-fixed-top navbar-black">
    <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets/images/logo.png"></a>
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right navbar-black-right">
          <li><a href="<?php echo base_url();?>" class="<?php if (!empty($title) && ($title == 'Home')) { echo 'active';} ?>">Home</a></li>
          <li><a href="<?php echo site_url('about');?>" class="<?php if (!empty($title) && ($title == 'About')) { echo 'active';} ?>">About</a></li>
          <li><a href="<?php echo site_url('services');?>" class="<?php if (!empty($title) && ($title == 'Services')) { echo 'active';} ?>">Services</a></li>
          <!-- <li><a href="<?php echo site_url('work');?>">Work</a></li> -->
          <li class="dropdown works-dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Work</a>
            <ul class="dropdown-menu works-menu">
              <?php 
                $this->db->where('category_type',3);
                $this->db->where('isdelete',0);
                $ArrCategory = $this->db->get('category_tbl')->result_array();
                if (isset($ArrCategory)&&!empty($ArrCategory)){
                  foreach ($ArrCategory as $cat) {
              ?>
              <li><a href="<?php echo site_url('work/'.$cat['url']);?>"><?php echo $cat['category'];?></a></li>
              <?php }} ?>
            </ul>
          </li>
          <li><a href="<?php echo site_url('spares-and-accessories');?>" class="<?php if (!empty($title) && ($title == 'Spares and Accessories')) { echo 'active';} ?>">Spares</a></li>
          <li><a href="<?php echo site_url('media');?>" class="<?php if (!empty($title) && ($title == 'Media')) { echo 'active';} ?>">Media</a></li>
          <li><a href="<?php echo site_url('events');?>" class="<?php if (!empty($title) && ($title == 'Events')) { echo 'active';} ?>">Events</a></li>
          <li><a href="<?php echo site_url('contact');?>" class="<?php if (!empty($title) && ($title == 'Contact')) { echo 'active';} ?>">Contact</a></li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>