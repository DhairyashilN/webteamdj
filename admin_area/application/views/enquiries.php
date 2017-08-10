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
                Enquiries 
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Enquiries</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-12 col-xs-12">
                    <div class="box">
                        <div class="box-header">
                        </div><!-- /.box-header -->
                        <div class="box-body table-responsive">
                          <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Name</th>
                                    <th>Contact Details</th>
                                    <th>Product</th>
                                    <th>Is Order Given</th>
                                    <th>Order Delivery Date</th>
                                    <th>Order Quantity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $srno=1;
                                if (isset($ArrEnquiries) && !empty($ArrEnquiries)){
                                    foreach ($ArrEnquiries as $enquiry){
                                        ?>
                                        <tr>
                                            <td><?php echo $srno++; ?></td>
                                            <td><?php echo $enquiry['name']; ?></td>
                                            <td>
                                                <ul>
                                                    <li><p>Contact: <?php echo $enquiry['contact_no']; ?></p></li>
                                                    <li><p>Email: <?php echo $enquiry['email']; ?></p></li>
                                                </ul>
                                            </td>
                                            <td>
                                                <?php foreach ($ArrProduct as $pro){
                                                    if ($pro['id'] == $enquiry['product_id']) {
                                                        echo $pro['name'];
                                                    }} ?>
                                                </td>
                                                <td>
                                                    <?php if ($enquiry['is_order_placed'] == 0) { echo 'No';}?>
                                                    <?php if ($enquiry['is_order_placed'] == 1) { echo 'Yes';}?>
                                                </select>
                                            </td>
                                            <td><?php echo $enquiry['order_delivery_date']; ?></td>
                                            <td><?php echo $enquiry['order_quantity']; ?></td>
                                            <td>
                                                <a href="<?php echo site_url('backend/view_enquiry/'.$enquiry['id']);?>">
                                                    <button class="btn btn-primary btn-sm btn-flat" title="View Enquiry">View</button>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php }} ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Name</th>
                                            <th>Contact Details</th>
                                            <th>Product</th>
                                            <th>Is Order Given</th>
                                            <th>Order Delivery Date</th>
                                            <th>Order Quantity</th>
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