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
                Add Product 
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Add Product</li>
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
                                <a href="<?php echo site_url('backend/products');?>" title="Return">
                                    <button class="btn btn-info btn-flat"><i class="fa fa-arrow-circle-left"></i> Return to List</button>
                                </a>
                            </h3>                                     
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <?php if (validation_errors()) {
                                echo '<div class="alert alert-danger" role="alert">
                                <?php echo validation_errors(); ?>
                            </div>';
                        } ?>
                        <?php if (isset($ObjProduct) && !empty($ObjProduct)): ?>
                            <?php foreach ($ObjProduct as $product): ?>
                            <?php echo form_open_multipart('ProductController/store_product', array('id' => 'productForm', 'class' => 'form-horizontal','autocomplete' => 'off'));?>
                            <div class="box-body">
                                <input type="hidden" name="p_id" value="<?php echo $product->id;?>">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Product Name</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo $product->name;?>" tabindex="1" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Product Category</label>
                                    <div class="col-sm-7">
                                        <select class="form-control" name="product_category" id="product_category" tabindex="2" required>
                                            <option value="">Select Type</option>
                                            <?php if (isset($ArrCategory) && !empty($ArrCategory)): ?>
                                                <?php foreach ($ArrCategory as $cat): ?>
                                                    <option value="<?php echo $cat['id'];?>" <?php if ($product->category == $cat['id']) {
                                                                echo 'selected';} ?>>
                                                        <?php echo $cat['category']; ?>
                                                    </option>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Product Description</label>
                                    <div class="col-sm-7">
                                        <textarea class="form-control" id="product_desc" name="product_desc" rows="7" tabindex="3" required><?php echo $product->description;?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Product Images</label>
                                    <div class="col-sm-7">
                                        <?php foreach ($ArrProductImage as $pimage){ ?>
                                            <img src="../../<?php echo $pimage['image'];?>" style="height:100px;width:100px">
                                        <?php } ?><br><br>
                                        <input type="file" name="product_image[]" id="product_image" class="form-control" multiple tabindex="4">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Product Quantity</label>
                                    <div class="col-sm-7">
                                        <input type="number" class="form-control" id="product_quant" name="product_quant" value="<?php echo $product->quantity;?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Is Visible</label>
                                    <div class="col-sm-2">
                                        <input type="radio" id="product_visible" name="product_visible" value="1" required <?php if($product->isvisible == '1'){ echo 'checked';}?>> &nbsp;&nbsp;Yes
                                        <input type="radio" id="product_visible" name="product_visible" value="0" required <?php if($product->isvisible == '0'){ echo 'checked';}?>> &nbsp;&nbsp;No
                                    </div>
                                    <label for="inputEmail3" class="col-sm-2 control-label">Out Of Stock</label>
                                    <div class="col-sm-2">
                                        <input type="radio" id="product_ofs" name="product_ofs" value="1" <?php if($product->out_of_stock == '1'){ echo 'checked';}?>> &nbsp;&nbsp;Yes
                                        <input type="radio" id="product_ofs" name="product_ofs" value="0" <?php if($product->out_of_stock == '0'){ echo 'checked';}?>> &nbsp;&nbsp;No
                                    </div>
                                </div>
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                            <button type="Submit" class="btn btn-primary btn-flat productForm-submit" tabindex="2">Update</button>
                            </div>
                            <?php form_close(); ?>
                            <?php endforeach ?>
                        <?php else: ?>
                        <?php echo form_open_multipart('ProductController/store_product', array('id' => 'productForm', 'class' => 'form-horizontal','autocomplete' => 'off'));?>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Product Name</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="product_name" name="product_name" tabindex="1" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Product Category</label>
                                <div class="col-sm-7">
                                    <select class="form-control" name="product_category" id="product_category" tabindex="2" required>
                                        <option value="">Select Type</option>
                                        <?php if (isset($ArrCategory) && !empty($ArrCategory)): ?>
                                            <?php foreach ($ArrCategory as $cat): ?>
                                                <option value="<?php echo $cat['id'];?>">
                                                    <?php echo $cat['category']; ?>
                                                </option>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Product Description</label>
                                <div class="col-sm-7">
                                    <textarea class="form-control" id="product_desc" name="product_desc" rows="7" tabindex="3" required></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Product Images</label>
                                <div class="col-sm-7">
                                    <input type="file" name="product_image[]" id="product_image" class="form-control" multiple tabindex="4" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Product Quantity</label>
                                <div class="col-sm-7">
                                    <input type="number" class="form-control" id="product_quant" name="product_quant" value="1" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Is Visible</label>
                                <div class="col-sm-2">
                                    <input type="radio" id="product_visible" name="product_visible" value="1" required> &nbsp;&nbsp;Yes
                                    <input type="radio" id="product_visible" name="product_visible" value="0" required> &nbsp;&nbsp;No
                                </div>
                                <label for="inputEmail3" class="col-sm-2 control-label">Out Of Stock</label>
                                <div class="col-sm-2">
                                    <input type="radio" id="product_ofs" name="product_ofs" value="1" > &nbsp;&nbsp;Yes
                                    <input type="radio" id="product_ofs" name="product_ofs" value="0" > &nbsp;&nbsp;No
                                </div>
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <button cat="Add" class="btn btn-primary btn-flat productForm-submit" tabindex="2">Add</button>
                        </div>
                        <?php form_close(); ?>
                    <?php endif; ?>
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
