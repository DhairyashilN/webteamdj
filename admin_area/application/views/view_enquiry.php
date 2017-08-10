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
                View Enquiry
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">View Enquiry</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-12 col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"><a href="<?php echo site_url('backend/enquiries');?>" title="Return to List"><button class="btn btn-success btn-flat"> <i class="fa fa-plus"></i> Return to List</button></a></h3>                                  
                        </div><!-- /.box-header -->
                        <div class="box-body table-responsive">
                            <table class="table table-bordered">
                                <?php foreach ($ObjEnquiry as $enquiry) {?>
                                <tr>
                                    <th>Name</th>
                                    <td><?php echo $enquiry->name;?></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td><?php echo $enquiry->email;?></td>
                                </tr>
                                <tr>
                                    <th>Contact No</th>
                                    <td><?php echo $enquiry->contact_no;?></td>
                                </tr>
                                <tr>
                                    <th>Message</th>
                                    <td><?php echo $enquiry->message;?></td>
                                </tr>
                                <tr>
                                    <th>Order Placed?</th>
                                    <td>
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <select class="form-control" id="order_status"  onchange="add_order();">
                                                    <option value="<?php echo $enquiry->is_order_placed;?>"<?php if ($enquiry->is_order_placed == 0) { echo 'selected';}?>><?php echo 'No';?></option>
                                                    <option value="<?php echo $enquiry->is_order_placed;?>" <?php if ($enquiry->is_order_placed == 1) { echo 'selected';} ?>><?php echo 'Yes';?></option>
                                                </select>
                                            </div>
                                        </div><br/>
                                        <div class="row">
                                            <div class="col-lg-9 order-div" style="display: none;">
                                                <?php echo form_open('', array('id'=>'orderForm','class'=>'form-inline')); ?>
                                                <input type="hidden" name="enquiry_id" value="<?php echo $enquiry->id;?>">
                                                <input type="hidden" name="product_id" value="<?php echo $enquiry->product_id;?>">
                                                <div class="form-group">
                                                <input type="text" name="order_date" id="order_date" class="form-control" placeholder="Date of Order DD/MM/YYYY"/>
                                              </div>
                                              <div class="form-group">
                                                <input type="text" name="order_quant" id="order_quant" class="form-control" placeholder="Order Quantity" />
                                            </div>
                                            <button type="submit" class="btn btn-success btn-flat submit-order">Add Order</button>
                                            <?php form_close(); ?>
                                            &nbsp;<span id="success"></span>
                                            &nbsp;<span id="error"></span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- ./col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</aside><!-- /.right-side -->
</div><!-- ./wrapper -->
<script type="text/javascript">
    function add_order(argument) {
        var order_status = $("#order_status option:selected").text();
        if (order_status == 'Yes'){
            $('.order-div').css('display','block');
        }else{ $('.order-div').css('display','none');}

    }
    $(document).ready(function() {
        $('.submit-order').on('click',function(e) {
            e.preventDefault();
            if ($('#order_date,#order_quant').val() == '') {
                $('#error').text('All fields are required');
                $('#success').text('');
            } else {
                $('#error').text('');
                $('#success').text('Processing Order');
                $.ajax({
                    type : 'POST',
                    url  : '<?php echo site_url('CommController/add_order'); ?>',
                    data : $('#orderForm').serialize(),
                    success:function(data) {
                        var result = $.parseJSON(data);
                        if (result['success'] == 1) {
                            $('#success').text('Order Added Successfully');
                            $('#orderForm')[0].reset();
                        } else if(result['out_of_stock'] == 1){
                            $('#success').text('');
                            $('#error').text('Product is Out of Stock');
                        }else{
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