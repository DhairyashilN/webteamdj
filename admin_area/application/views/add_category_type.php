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
                Category Type 
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Category Type</li>
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
                                <a href="<?php echo site_url('backend/category_type');?>" title="Return">
                                    <button class="btn btn-info btn-flat"><i class="fa fa-arrow-circle-left"></i> Return to List</button>
                                </a>
                            </h3>                                    
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <?php if (isset($ArrcatType) && !empty($ArrcatType)): ?>
                                <?php foreach ($ArrcatType as $type): ?>
                                    <?php echo form_open('', array( 'id' => 'cattypeForm', 'class' => 'form-horizontal' ));?>
                                    <input type="hidden" name="type_id" value="<?php echo $type['id']; ?>">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1" class="col-lg-2">Category Type Name</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" id="cat_type_name" placeholder="Category Type Name" name="cat_type_name" value="<?php echo $type['type']; ?>" tabindex="1">
                                            </div>
                                        </div>
                                    </div><!-- /.box-body -->
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary btn-flat cattypeForm-submit" tabindex="2">Update</button>
                                    </div>
                                    <?php form_close(); ?>
                                <?php endforeach ?>
                            <?php else: ?>
                                <?php echo form_open('', array( 'id' => 'cattypeForm', 'class' => 'form-horizontal' ));?>
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1" class="col-lg-2">Category Type Name</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" id="cat_type_name" placeholder="Category Type Name" name="cat_type_name" tabindex="1">
                                        </div>
                                    </div>
                                </div><!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary btn-flat cattypeForm-submit" tabindex="2">Add</button>
                                </div>
                                <?php form_close(); ?>
                            <?php endif ?>
                            <span id="error"></span>
                            <span id="success"></span>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- ./col -->
            </div><!-- /.row -->
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div><!-- ./wrapper -->
<script type="text/javascript">
    $(document).ready(function() {
        $('.cattypeForm-submit').on('click',function(e) {
            e.preventDefault();
            if ($('#cat_type_name').val() == '') {
                $('#error').text('All fields are required');
                $('#success').text('');
            } else {
                $('#error').text('');
                $('#success').text('Adding Category Type');
                $.ajax({
                    type : 'POST',
                    url  : '<?php echo site_url('CategoryController/store_cat_type'); ?>',
                    data : $('#cattypeForm').serialize(),
                    success:function(data) {
                        var result = $.parseJSON(data);
                        if (result['success'] == 1) {
                            $('#success').text('Category Type Added Successfully');
                            $('#cattypeForm')[0].reset();
                        } else if (result['update_success'] == 1) {
                            $('#success').text('Category Type Updated Successfully');
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
<?php $this->load->view('footer'); ?>
