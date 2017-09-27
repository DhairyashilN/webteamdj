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
                Add Event 
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Add Event</li>
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
                        <?php if (isset($ObjEvent) && !empty($ObjEvent)): ?>
                            <?php foreach ($ObjEvent as $event): 
                            $event_id = $event->id;
                            ?>
                            <?php echo form_open_multipart('EventController/store_event', array('id' => 'productForm', 'class' => 'form-horizontal','autocomplete' => 'off'));?>
                            <div class="box-body">
                                <input type="hidden" name="event_id" value="<?php echo $event->id;?>">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Event Name</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="event_name" name="event_name" tabindex="1" value="<?php echo $event->title; ?>" onkeyup="addslash();" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Event URL</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="event_url" name="event_url" tabindex="2" value="<?php echo $event->url; ?>" readonly required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Event Category</label>
                                    <div class="col-sm-7">
                                        <select class="form-control" name="event_category" id="product_category" tabindex="2" required>
                                            <option value="">Select Type</option>
                                            <?php if (isset($ArrCategory) && !empty($ArrCategory)): ?>
                                                <?php foreach ($ArrCategory as $cat): ?>
                                                    <option value="<?php echo $cat['id'];?>" <?php if($cat['id'] == $event->category){ echo 'selected';}?>>
                                                        <?php echo $cat['category']; ?>
                                                    </option>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Event Description</label>
                                    <div class="col-sm-7">
                                        <textarea class="form-control" id="product_desc" name="event_desc" rows="7" tabindex="3" required><?php echo $event->description;?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Event Poster</label>
                                    <div class="col-sm-7">
                                        <img src="../../<?php echo $event->poster_image;?>" style="height:100px;width:100px"><br><br>
                                        <input type="file" name="event_poster" id="event_poster" class="form-control" tabindex="4"  accept="Image/*">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Event Images</label>
                                    <div class="col-sm-7">
                                        <?php foreach ($ArrEventImage as $pimage){ ?>
                                        <div class="thumbnail">
                                            <img src="../../<?php echo $pimage['image'];?>" style="height:100px;width:100px">
                                            <button type="button" class="btn btn-danger btn-xs btn-flat" onclick="if(confirm('Are you want to delete this image?'))delete_img('<?php echo $pimage['id'];?>','<?php echo $pimage['image_name'];?>')">Delete</button>
                                        </div>
                                        <?php } ?><br><br>
                                        <input type="file" name="event_image[]" id="event_image" class="form-control" tabindex="4" multiple  accept="Image/*">
                                    </div>
                                </div>
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <button type="Submit" class="btn btn-primary btn-flat productForm-submit" tabindex="2">Update</button>
                            </div>
                            <?php form_close(); ?>
                        <?php endforeach ?>
                    <?php else: ?>
                        <?php echo form_open_multipart('EventController/store_event', array('id' => 'eventForm', 'class' => 'form-horizontal','autocomplete' => 'off'));?>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Event Name</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="event_name" name="event_name" tabindex="1" onkeyup="addslash();" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Event URL</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="event_url" name="event_url" tabindex="2" readonly required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Event Category</label>
                                <div class="col-sm-7">
                                    <select class="form-control" name="event_category" id="product_category" tabindex="2" required>
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
                                <label for="inputEmail3" class="col-sm-2 control-label">Event Description</label>
                                <div class="col-sm-7">
                                    <textarea class="form-control" id="product_desc" name="event_desc" rows="7" tabindex="3" required></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Event Poster</label>
                                <div class="col-sm-7">
                                    <input type="file" name="event_poster" id="event_poster" class="form-control" tabindex="4" required accept="Image/*">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Event Images</label>
                                <div class="col-sm-7">
                                    <input type="file" name="event_image[]" id="event_image" class="form-control" tabindex="4" multiple required accept="Image/*">
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
<script type="text/javascript">
    function addslash(){
        var str = document.getElementById('event_name').value;
        result = str.replace(/\s+/g, '-').toLowerCase()
        document.getElementById('event_url').value = result;
    }
    function delete_img(id,image){
        if(id!=''){
            $.ajax({
                type : 'POST',
                url  : '<?php echo site_url('EventController/remove_event_image'); ?>',
                data : {image:id,event:<?php echo isset($event_id)?$event_id:'a';?>,<?php echo $this->security->get_csrf_token_name(); ?>:'<?php echo $this->security->get_csrf_hash();?>',image_name:image},
                success:function(data) {
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
