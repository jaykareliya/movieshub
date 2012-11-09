<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"/>
  <?php $this->load->helper("form_helper"); $this->load->helper('url'); $this->load->library('session');
?> 
<title><?php echo $title; ?></title>
<link rel="stylesheet" href="<?=base_url(); ?>css/layout.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?=base_url(); ?>css/validationEngine.jquery.css"/>
<!--[if lt IE 9]>
	<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
<script src="<?=base_url();?>js/jquery-1.5.1.js" type="text/javascript"></script>
<script src="<?=base_url();?>js/hideshow.js" type="text/javascript"></script>
<script src="<?=base_url();?>js/jquery.tablesorter.min.js" type="text/javascript"></script>
<script src="<?=base_url();?>js/jquery.js"></script>
<script src="<?=base_url();?>js/jquery.validationEngine-en.js" type="text/javascript"></script>
<script src="<?=base_url();?>js/jquery.equalHeight.js" type="text/javascript"></script>
<script src="<?=base_url();?>js/jquery.validate.js" type="text/javascript"></script>
<link href="<?=base_url();?>css/jquery.ui.all.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url();?>css/demos.css" rel="stylesheet" type="text/css" />


<script type="text/javascript">
	
	$(document).ready(function() {


	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});
		
});
</script>
<script type="text/javascript">
    $(function(){

$('.column').equalHeight();

	

    });
</script>
</head>
<body>
 
<?php $this->load->view("includes/header");?>
<!-- end of header bar -->
<section id="secondary_bar">
  <div class="user">
    <p><?php echo $user_name; ?> </p>
    <!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
  </div>
  <div class="breadcrumbs_container">
    <article class="breadcrumbs"><a href="index.html">Website Admin</a>
      <div class="breadcrumb_divider"></div>
      <a class="current"><?php echo $title; ?></a></article>
  </div>
</section>
<!-- end of secondary bar -->
<aside id="sidebar" class="column" >
 <!-- <form class="quick_search">
    <input type="text" value="Quick Search" onFocus="if(!this._haschanged){this.value=''};this._haschanged=true;">
  </form>
  <hr/>-->
  <?php $this->load->view("includes/left_menu");?>
</aside>
<!-- end of sidebar -->
<section id="main" class="column">
  <?php $this->load->view($main_content); ?>
</section>
<?php $this->load->view("includes/footer");?>
</body>
</html>
