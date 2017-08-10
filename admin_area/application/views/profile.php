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
                Profile 
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Profile</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-12 col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">
                            </h3>                                    
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <?php echo form_open('', array( 'id' => 'profileForm', 'class' => 'form-horizontal' ));?>
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="username" name="username" value="<?php echo $username;?>"  required >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">New Password</label>
                                    <div class="col-sm-7">
                                        <input type="password" class="form-control" id="password" name="password" value="" required >
                                        <span id="notify"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Confirm New Password</label>
                                    <div class="col-sm-7">
                                        <input type="password" class="form-control" id="cpassword" name="cpassword" required >
                                        <span id="notify"></span>
                                    </div>
                                </div>
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <button cat="submit" class="btn btn-primary btn-flat profileForm-submit" tabindex="2">Update</button>
                            </div>
                            <?php form_close(); ?>
                            <span id="error"></span>
                            <span id="success"></span>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- ./col -->
            </div><!-- /.row -->
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div><!-- ./wrapper -->
<script cat="text/javascript">
    $(document).ready(function() {
        $('.profileForm-submit').on('click',function(e) {
            e.preventDefault();
            if ($('#name,#password,#cpassword').val() == '') {
                $('#error').text('All fields are required');
                $('#success').text('');
            } else if($('#password').val() != $('#cpassword').val()){
                $('#error').text('Password and Confirm Password is not matching');
                $('#success').text('');
            } else {
                $('#error').text('');
                $('#success').text('Updating Profile');
                $.ajax({
                    type : 'POST',
                    url  : '<?php echo site_url('ProfileController/update_profile');?>',
                    data : $('#profileForm').serialize(),
                    success:function(data) {
                        var result = $.parseJSON(data);
                        if (result['success'] == 1) {
                            $('#success').text('Profile Updated Successfully');
                            $('#profileForm')[0].reset();
                            window.setTimeout(function(){
                                window.location.href = "<?php echo site_url('LoginController/logout');?>";
                            }, 5000);
                        } else{
                            $('#success').text('');
                            $('#error').text('Password and Confirm Password are not matching');
                        }
                    }
                });
            }
        });
    });
</script>
<?php $this->load->view('footer'); ?>
