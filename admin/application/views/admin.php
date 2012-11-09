<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $title." - ".$dash_board; ?>  </title>
<?php $this->load->view("includes/scripts.php"); ?>
</head>
<body>
<!-- Start: page-top-outer -->
<div id="page-top-outer">
  <!-- Start: page-top -->
  <div id="page-top">
    <!-- start logo -->
    <div id="logo">
    
    </div>
    <!-- end logo -->
    <!--  start top-search -->
    <div id="top-search">
      <?php $this->load->view("includes/topsearch.php"); ?>
    </div>
    <!--  end top-search -->
    <div class="clear"></div>
  </div>
  <!-- End: page-top -->
</div>
<!-- End: page-top-outer -->
<div class="clear">&nbsp;</div>
<?php $this->load->view("includes/topmenu.php"); ?>
<div class="clear"></div>
<!-- start content-outer -->
<div id="content-outer">
  <!-- start content -->
  <div id="content">
    <div id="page-heading">
      <h1><?php echo $dash_board; ?></h1>
    </div>
    <table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
      <tr>
        <th rowspan="3" class="sized"><img src="<?=base_url(); ?>images/shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
        <th class="topleft"></th>
        <td id="tbl-border-top">&nbsp;</td>
        <th class="topright"></th>
        <th rowspan="3" class="sized"><img src="<?=base_url(); ?>images/shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
      </tr>
      <tr>
        <td id="tbl-border-left"></td>
        <td valign="top"><!--  start content-table-inner -->
          <div id="content-table-inner">
		  	<?php $this->load->view($main_content); ?>
            <div class="clear"></div>
          </div>
          <!--  end content-table-inner  -->
        </td>
        <td id="tbl-border-right"></td>
      </tr>
      <tr>
        <th class="sized bottomleft"></th>
        <td id="tbl-border-bottom">&nbsp;</td>
        <th class="sized bottomright"></th>
      </tr>
    </table>
    <div class="clear">&nbsp;</div>
  </div>
  <!--  end content -->
  <div class="clear">&nbsp;</div>
</div>
<!--  end content-outer -->
<div class="clear">&nbsp;</div>
<!-- start footer -->
<?php $this->load->view("includes/bottommenu.php"); ?>
<!-- end footer -->
</body>
</html>
