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
                                    <th>Email</th>
                                    <th>Mobile No.</th>
                                    <th>Message</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $srno=1;
                                if (isset($ArrContacts) && !empty($ArrContacts)):
                                    foreach ($ArrContacts as $contact): ?>
                                <tr>
                                    <td><?php echo $srno++; ?></td>
                                    <td><?php echo $contact['contact_name']; ?></td>
                                    <td><?php echo $contact['contact_no']; ?></td>
                                    <td><?php echo $contact['contact_email']; ?></td>
                                    <td><?php echo $contact['contact_message']; ?></td>
                                </tr>
                            <?php endforeach; 
                            endif; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile No.</th>
                                <th>Message</th>
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