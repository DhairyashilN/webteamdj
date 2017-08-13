<aside class="left-side sidebar-offcanvas">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url();?>assets/img/avatar04.png" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>Hello, Admin</p>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="<?php if($menu_active == 'Dashboard') echo 'active' ?>">
                <a href="<?php echo site_url('dashboard'); ?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="treeview <?php if($menu_active == 'pages') echo 'active';?>">
                <a href="#">
                    <i class="fa fa-bar-chart-o"></i>
                    <span>Pages</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/charts/morris.html"><i class="fa fa-angle-double-right"></i> Work</a></li>
                    <li><a href="<?php echo site_url('backend/events');?>"><i class="fa fa-angle-double-right"></i>Events</a></li>
                    <!-- <li><a href="pages/charts/inline.html"><i class="fa fa-angle-double-right"></i> Accessories</a></li> -->
                </ul>
            </li>
            <li class="treeview <?php if($menu_active == 'cattype') echo 'active' ?>">
                <a href="#">
                    <i class="fa fa-laptop"></i>
                    <span>Catalog</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php if($menu_active == 'cattype') echo 'active' ?>"><a href="<?php echo site_url('backend/products') ?>"><i class="fa fa-angle-double-right"></i> Product</a></li>
                    <li class="<?php if($menu_active == 'cattype') echo 'active' ?>"><a href="<?php echo site_url('backend/category');?>"><i class="fa fa-angle-double-right"></i> Category</a></li>
                    <li class="<?php if($menu_active == 'cattype') echo 'active' ?>"><a href="<?php echo site_url('backend/category_type');?>"><i class="fa fa-angle-double-right"></i> Category Type</a></li>
                </ul>
            </li>
            <li class="<?php if($menu_active == 'contacts') echo 'active' ?>">
                <a href="<?php echo site_url('backend/contacts');?>"><i class="fa fa-phone"></i> <span>Contacts</span></a>
            </li>
            <li class="<?php if($menu_active == 'enquiries') echo 'active' ?>">
                <a href="<?php echo site_url('backend/enquiries');?>"><i class="fa fa-envelope"></i> <span>Enquiries</span></a>
            </li>
            <li class="treeview <?php if($menu_active == 'stats') echo 'active';?>">
                <a href="#">
                    <i class="fa fa-bar-chart-o"></i>
                    <span>Statistics</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('backend/statistics');?>"><i class="fa fa-angle-double-right"></i>Statistics</a></li>
                    <!-- <li><a href="pages/charts/inline.html"><i class="fa fa-angle-double-right"></i> Accessories</a></li> -->
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>