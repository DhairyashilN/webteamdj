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
                            <h3 class="box-title"><a href="<?php echo site_url('backend/add_product');?>" title="Add New"><button class="btn btn-success btn-flat"> <i class="fa fa-plus"></i> Add New</button></a></h3>                                  
                        </div><!-- /.box-header -->
                        <div class="box-body table-responsive">
                            <?php if ($this->session->flashdata('msg')): ?>
                                <div class="alert alert-success alert-dismissable">
                                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                  <strong><?php echo $this->session->flashdata('msg');?></strong>
                              </div>
                          <?php endif ?>  
                          <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Visible</th>
                                    <th>Out of Stock</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $srno=1;
                                if (isset($ArrProducts) && !empty($ArrProducts)):
                                    foreach ($ArrProducts as $product): ?>
                                <tr>
                                    <td><?php echo $srno++; ?></td>
                                    <td>
                                        <?php if (isset($ArrProductsImages) && !empty($ArrProductsImages)){
                                            foreach ($ArrProductsImages as $pimage){
                                            if($pimage['product_id'] == $product['id']) { ?>
                                            <img src="../<?php echo $pimage['image'];?>" style="height:100px;width:100px"><br>
                                        </td>
                                        <?php }}} ?>
                                        <td><?php echo $product['name']; ?></td>
                                        <td><?php echo $product['quantity']; ?></td>
                                        <td><?php if($product['isvisible']==1){echo 'Yes';}else{echo 'No';}?></td>
                                        <td><?php if($product['out_of_stock']==1){echo 'Yes';}else{echo 'No';}?></td>
                                        <td>
                                            <a href="<?php echo site_url('backend/edit_product/'.$product['id']);?>" title="Edit"><button class="btn btn-primary btn-sm btn-flat"><i class="fa fa-fw fa-pencil"></i></button></a>
                                            <a href="" data-toggle="modal" data-target="#myModal" title="Delete"><button class="btn btn-danger btn-sm btn-flat"><i class="fa fa-fw fa-trash-o"></i></button></a>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Delete Confrimation</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="text-center">
                                                <h4>Are you want to delete this record?</h4>
                                                <span>
                                                    <a href="<?php echo site_url('backend/delete_product/'.$product['id']); ?>" class="btn btn-success">Yes</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <a href="#" data-dismiss="modal" class="btn btn-danger">No</a>
                                                </span>
                                            </div>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                        <?php endforeach; 
                        endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Visible</th>
                            <th>Out of Stock</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- ./col -->
</div><!-- /.row -->
</section><!-- /.content -->
</aside><!-- /.right-side -->
</div><!-- ./wrapper -->
<?php $this->load->view('footer'); ?>