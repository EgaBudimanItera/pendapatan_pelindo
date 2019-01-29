
<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?=base_url()?>assets/dist/img/admin.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Admin</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
     
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION Admin</li>
        <li class="<?php if($link=='' ||$link=="dashboard"){echo'active';}?> treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
       
        <li class="<?php if($link=='produk' ||$link=="bahanbaku"||$link=="tenagakerjalangsung"||$link=="op"||$link=="user"){echo'active';}?> treeview">
          <a href="#">
            <i class="fa fa-industry"></i>
            <span>Data Master</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if($link=='produk'){echo'active';}?>"><a href="<?=base_url()?>produk"><i class="fa fa-cubes"></i> Produk</a></li>
            <li class="<?php if($link=='bahanbaku'){echo'active';}?>"><a href="<?=base_url()?>bahanbaku"><i class="fa fa-server"></i> Bahan Baku</a></li>
            <li class="<?php if($link=='tenagakerjalangsung'){echo'active';}?>"><a href="<?=base_url()?>tenagakerjalangsung"><i class="fa fa-users"></i> Tenaga Kerja Langsung</a></li>
            <li class="<?php if($link=='op'){echo'active';}?>"><a href="<?=base_url()?>op"><i class="fa fa-bank"></i> Overhead Pabrik</a></li>
            <li class="<?php if($link=='user'){echo'active';}?>"><a href="<?=base_url()?>user"><i class="fa fa-users"></i> Users</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Data Transaksi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?=base_url()?>produksi"><i class="fa fa-gears"></i> Produksi</a></li>
            
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-user-secret"></i>
            <span>Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?=base_url()?>produksi/formlaporanproduksi"><i class="fa fa-print"></i> Produksi</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>