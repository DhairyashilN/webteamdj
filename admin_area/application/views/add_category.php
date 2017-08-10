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
                Category 
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Category</li>
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
                                <a href="<?php echo site_url('backend/category');?>" title="Return">
                                    <button class="btn btn-info btn-flat"><i class="fa fa-arrow-circle-left"></i> Return to List</button>
                                </a>
                            </h3>                                    
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <?php if (isset($ArrCategory) && !empty($ArrCategory)): ?>
                                <?php foreach ($ArrCategory as $cat): ?>
                                    <?php echo form_open('', array( 'id' => 'catForm', 'class' => 'form-horizontal' ));?>
                                    <input type="hidden" name="cat_id" value="<?php echo $cat['id']; ?>">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1" class="col-lg-2">Category Name</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" id="cat_name" placeholder="Category Name" name="cat_name" value="<?php echo $cat['category']; ?>" tabindex="1">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1" class="col-lg-2">Category Type</label>
                                            <div class="col-lg-10">
                                                <select class="form-control" name="cat_type" id="cat_type" tabindex="2">
                                                    <?php if (isset($ArrCategoryType) && !empty($ArrCategoryType)): ?>
                                                        <?php foreach ($ArrCategoryType as $type): ?>
                                                            <option value="<?php echo $type['id'];?>" <?php if ($type['id'] == $cat['category_type']) {
                                                                echo 'selected';} ?>>
                                                                <?php echo $type['type']; ?>
                                                            </option>
                                                        <?php endforeach ?>
                                                    <?php endif ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div><!-- /.box-body -->
                                    <div class="box-footer">
                                        <button cat="submit" class="btn btn-primary btn-flat catForm-submit" tabindex="2">Update</button>
                                    </div>
                                    <?php form_close(); ?>
                                <?php endforeach ?>
                            <?php else: ?>
                                <?php echo form_open('', array( 'id' => 'catForm', 'class' => 'form-horizontal' ));?>
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1" class="col-lg-2">Category Name</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" id="cat_name" placeholder="Category Name" name="cat_name" tabindex="1">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1" class="col-lg-2">Category Type</label>
                                        <div class="col-lg-10">
                                            <select class="form-control" name="cat_type" id="cat_type" tabindex="2">
                                                <option value="">Select Type</option>
                                                <?php if (isset($ArrCategoryType) && !empty($ArrCategoryType)): ?>
                                                    <?php foreach ($ArrCategoryType as $type): ?>
                                                        <option value="<?php echo $type['id'];?>">
                                                            <?php echo $type['type']; ?>
                                                        </option>
                                                    <?php endforeach ?>
                                                <?php endif ?>
                                            </select>
                                        </div>
                                    </div>
                                </div><!-- /.box-body -->
                                <div class="box-footer">
                                    <button cat="submit" class="btn btn-primary btn-flat catForm-submit" tabindex="2">Add</button>
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
<script cat="text/javascript">
    $(document).ready(function() {
        $('.catForm-submit').on('click',function(e) {
            e.preventDefault();
            if ($('#cat_name,#cat_type').val() == '') {
                $('#error').text('All fields are required');
                $('#success').text('');
            } else {
                $('#error').text('');
                $('#success').text('Adding Category');
                $.ajax({
                    type : 'POST',
                    url  : '<?php echo site_url('CategoryController/store_category'); ?>',
                    data : $('#catForm').serialize(),
                    success:function(data) {
                        var result = $.parseJSON(data);
                        if (result['success'] == 1) {
                            $('#success').text('Category Added Successfully');
                            $('#catForm')[0].reset();
                        } else if (result['update_success'] == 1) {
                            $('#success').text('Category Updated Successfully');
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
