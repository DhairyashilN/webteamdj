<?php $this->load->view('header');?>
<?php $this->load->view('topheader');?>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <?php $this->load->view('sidebar');?>
    <!-- Right side column. Contains the navbar and content of the page -->
    <aside class="right-side">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Settings
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Settings</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-12 col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <?php if (validation_errors()) {
                                echo '<div class="alert alert-danger" role="alert">'.
                                validation_errors().'
                                </div>';
                            } ?>
                            <?php if ($this->session->flashdata('msg')): ?>
                                <div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong><?php echo $this->session->flashdata('msg');?></strong>
                                </div>
                            <?php endif ?> 
                            <?php foreach ($site_data as $srow){ ?> 
                            <?php echo form_open('StatisticsController/save_settings', array('id' => 'settingsForm', 'class' => 'form-horizontal','autocomplete' => 'off'));?>
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Site Title</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="site_title" name="site_title" tabindex="1" required="" value="<?php echo $srow['site_title'];?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Site Meta Description</label>
                                    <div class="col-sm-7">
                                        <textarea class="form-control" id="site_meta" name="site_meta" tabindex="2" maxlength="160" rows="5" required=""><?php echo $srow['site_meta_desc'];?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Site Meta Keywords</label>
                                    <div class="col-sm-7">
                                        <textarea class="form-control" id="site_keywords" name="site_keywords" tabindex="3" rows="7"  required=""><?php echo $srow['site_meta_keywords'];?></textarea>
                                    </div>
                                </div>
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <button cat="Add" class="btn btn-primary btn-flat productForm-submit" tabindex="2">Save</button>
                            </div>
                            <?php form_close(); ?>
                            <?php } ?>
                            <span id="error"></span>
                            <span id="success"></span>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- ./col -->
            </div><!-- /.row -->
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div><!-- ./wrapper -->
<?php $this->load->view('footer'); ?>
