<ol class="breadcrumb">
      <i class="fa fa-dashboard"></i> &nbsp;
      <?php 
        $stopbreadcrumb=0;
        foreach ($breadcrumb as $label => $link) {
          if ($stopbreadcrumb++ < count($breadcrumb)-1) {
      ?>
              <li><a href="<?php echo $link?>"> <?php echo $label?> </a></li>
      <?php
          }else{
      ?>
              <li><?php echo $label?></li>
      <?php
          }
        }
      ?>
</ol>