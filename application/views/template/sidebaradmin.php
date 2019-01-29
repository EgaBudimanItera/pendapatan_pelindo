<?php
  $userHakakses=$this->session->userdata('userHakakses');
?>
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
          <p><?=$this->session->userdata('userNama')?></p>
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
       
        <li class="<?php if($link=='kapal' ||$link=="customer"||$link=="tarif"||$link=="pengguna"){echo'active';}?> treeview">
          <a href="#">
            <i class="fa fa-industry"></i>
            <span>Data Master</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if($link=='kapal'){echo'active';}?>"><a href="<?=base_url()?>kapal"><i class="fa fa-cubes"></i> Kapal</a></li>
            <li class="<?php if($link=='customer'){echo'active';}?>"><a href="<?=base_url()?>customer"><i class="fa fa-server"></i> Customer</a></li>
            <li class="<?php if($link=='tarif'){echo'active';}?>"><a href="<?=base_url()?>tarif"><i class="fa fa-bank"></i> Tarif</a></li>
            <li class="<?php if($link=='pengguna'){echo'active';}?>"><a href="<?=base_url()?>pengguna"><i class="fa fa-users"></i> Pengguna</a></li>
          </ul>
        </li>

        <li class="<?php if($link=='pranota' ||$link=="nota"){echo'active';}?> treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Data Transaksi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if($link=='pranota'){echo'active';}?>"><a href="<?=base_url()?>pranota"><i class="fa fa-gears"></i> Pranota</a></li>
            <li class="<?php if($link=='nota'){echo'active';}?>"><a href="<?=base_url()?>nota"><i class="fa fa-building"></i> Nota</a></li>
          </ul>
        </li>

        <li class="<?php if($link=='jpk' ||$link=="ju"||$link=="bb"){echo'active';}?> treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Akuntansi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if($link=='jpk'){echo'active';}?>"><a href="<?=base_url()?>jpk"><i class="fa fa-gears"></i> Jurnal Penerimaan Kas</a></li>
            <li class="<?php if($link=='ju'){echo'active';}?>"><a href="<?=base_url()?>ju"><i class="fa fa-gears"></i> Jurnal Umum</a></li>
            <li class="<?php if($link=='bb'){echo'active';}?>"><a href="<?=base_url()?>bb"><i class="fa fa-gears"></i> Buku Besar</a></li>
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
            <li><a href="<?=base_url()?>lpendapatan"><i class="fa fa-print"></i> Pendapatan</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>