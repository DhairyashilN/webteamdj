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
                Add Portfolio 
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Add Portfolio</li>
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
                                <a href="<?php echo site_url('backend/events');?>" title="Return">
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
                        <?php if (isset($ObjPortfolio) && !empty($ObjPortfolio)): ?>
                            <?php foreach ($ObjPortfolio as $pof): 
                            $pof_id = $pof->id;
                            ?>
                            <?php echo form_open_multipart('PortfolioController/store_portfolio', array('id' => 'productForm', 'class' => 'form-horizontal','autocomplete' => 'off'));?>
                            <div class="box-body">
                                <input type="hidden" name="pof_id" value="<?php echo $pof->id;?>">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="pof_name" name="pof_name" tabindex="1" value="<?php echo $pof->ptitle; ?>" onkeyup="addslash();" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">URL</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="pof_url" name="pof_url" tabindex="2" value="<?php echo $pof->purl; ?>" readonly required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Category</label>
                                    <div class="col-sm-7">
                                        <select class="form-control" name="pof_category" id="pof_category" tabindex="3" required>
                                            <option value="">Select Type</option>
                                            <?php if (isset($ArrCategory) && !empty($ArrCategory)):?>
                                                <?php foreach ($ArrCategory as $cat): ?>
                                                    <option value="<?php echo $cat['id'];?>" <?php if($cat['id'] == $pof->pcategory){ echo 'selected';}?>>
                                                        <?php echo $cat['category']; ?>
                                                    </option>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Description</label>
                                    <div class="col-sm-7">
                                        <textarea class="form-control" id="product_desc" name="pof_desc" rows="7" tabindex="4" required><?php echo $pof->pdescription;?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Thumbnail Image</label>
                                    <div class="col-sm-7">
                                        <img src="../../<?php echo $pof->pimage;?>" style="height:100px;width:100px"><br><br>
                                        <input type="file" name="pof_poster" id="pof_poster" class="form-control" tabindex="5"  accept="Image/*">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Portfolio Images</label>
                                    <div class="col-sm-7">
                                        <?php foreach ($ArrPortfolioImage as $pimage){ ?>
                                        <div class="thumbnail">
                                            <img src="../../<?php echo $pimage['image'];?>" style="height:100px;width:100px">
                                            <button type="button" class="btn btn-danger btn-xs btn-flat" onclick="if(confirm('Are you want to delete this image?'))delete_img(<?php echo $pimage['id'];?>)">Delete</button>
                                        </div>
                                        <?php } ?><br><br>
                                        <input type="file" name="pof_image[]" id="pof_image" class="form-control" tabindex="6" multiple  accept="Image/*">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Customer Name</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="pof_cname" name="pof_cname" value="<?php echo $pof->pcust_name;?>" tabindex="7" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Customer's Review</label>
                                    <div class="col-sm-7">
                                        <textarea class="form-control" id="pof_creview" name="pof_creview" rows="10" tabindex="8" required><?php echo $pof->pcust_review;?></textarea>
                                    </div>
                                </div>
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <button type="Submit" class="btn btn-primary btn-flat porfolioForm-submit" tabindex="9">Update</button>
                            </div>
                            <?php form_close(); ?>
                        <?php endforeach ?>
                    <?php else: ?>
                        <?php echo form_open_multipart('PortfolioController/store_portfolio', array('id' => 'portfolioForm', 'class' => 'form-horizontal','autocomplete' => 'off'));?>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="pof_name" name="pof_name" tabindex="1" onkeyup="addslash();" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">URL</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="pof_url" name="pof_url" tabindex="2" readonly required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Category</label>
                                <div class="col-sm-7">
                                    <select class="form-control" name="pof_category" id="pof_category" tabindex="3" required>
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
                                <label for="inputEmail3" class="col-sm-2 control-label">Description</label>
                                <div class="col-sm-7">
                                    <textarea class="form-control" id="product_desc" name="pof_desc" rows="7" tabindex="4" required></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Thumbnail Image</label>
                                <div class="col-sm-7">
                                    <input type="file" name="pof_poster" id="pof_poster" class="form-control" tabindex="5" required accept="Image/*">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Portfolio Images</label>
                                <div class="col-sm-7">
                                    <input type="file" name="pof_image[]" id="pof_image" class="form-control" tabindex="6" multiple required accept="Image/*">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Customer Name</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="pof_cname" name="pof_cname" tabindex="7" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Customer's Review</label>
                                <div class="col-sm-7">
                                    <textarea class="form-control" id="pof_creview" name="pof_creview" rows="10" tabindex="8" required></textarea>
                                </div>
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <button cat="Add" class="btn btn-primary btn-flat portfolioForm-submit" tabindex="9">Add</button>
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
<script type="text/javascript">
    function addslash(){
        var str = document.getElementById('pof_name').value;
        result = str.replace(/\s+/g, '-').toLowerCase()
        document.getElementById('pof_url').value = result;
    }
    function delete_img(id){
        if(id!=''){
            $.ajax({
                type:'POST',
                url:'<?php echo site_url('PortfolioController/remove_portfolio_image'); ?>',
                data:{image:id,portfolio:<?php echo isset($pof_id)?$pof_id:'a';?>,<?php echo $this->security->get_csrf_token_name();?>:'<?php echo $this->security->get_csrf_hash();?>'},
                success:function(data){
                    var result = $.parseJSON(data);
                    if(result['success'] == 1){
                        location.reload();
                    }             
                }
            });
        }
    }
</script>
<?php $this->load->view('footer'); ?>
