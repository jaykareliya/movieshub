<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en-US" xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
	<title>Contact Us</title>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	
	<link href="<?=base_url()?>css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" href="<?=base_url()?>admin/css/jquery.ui.all.css">
	<!--[if IE 6]>
		<link rel="stylesheet" href="css/ie6.css" type="text/css" media="all" />
	<![endif]-->
	<style type="text/css">
label.error { float: none; color: red; padding-left: .5em; vertical-align: top; }	
</style>

</head>
<body>
	<div class="contenthome">
 		<?php  $this->load->view('include/header.php'); ?>
 		<div class="maincontent">
    		<div class="container-fluid">
     			<div class="row-fluid">
	  
        		<div class="span3">
					  <!--content_middle-->
					  <?php $this->load->view('include/content_middle'); ?>
					  <!--end content_middle-->
     		   </div>
		   	    <div class="span9">
					<div class="row-fluid">
			 			<div class="row-fluid" >
							<div class="well well-small">
								<div class="span4">Contact</div>
							</div>
						</div>
						<div class="row-fluid">
							<form id='form' method='post' name='frmContact'>
									<div class="control-group">
										<input id="txtName" class="form-text contact_input watermark required" type="text" name="txtName"  placeholder="Enter Your Name">
									</div>
									 <div class="control-group">
										<input id="txtEmailId" class="form-text contact_input email watermark required email" type="text" name="txtEmailId"  placeholder="Enter Your Email">
									</div>
									 <div class="control-group">
										<input id="txtPhone" class="form-text contact_input watermark required number" type="text" name="txtPhone"  placeholder="Enter Your Phone">
									</div>

									 <div class="control-group">
										<textarea id="txtMessage" rows="6" class="contact_textarea watermark required" minlength="" name="txtMessage" placeholder="Enter Message" ></textarea>
									</div>
									
									<button class='btn btn-info' type="submit" id="submit" name="submit" type="submit" >Submit</button>
							</form>
						</div>
					</div>
       			</div>
			</div>
			<div class="row-fluid">
				<div class="span12">
				    <?php $this->load->view('include/footer.php'); ?>
				 </div>
			 </div>
		</div>
  	</div>
</div>



	

		
	
		<script src="<?=base_url()?>js/jquery-1.7.1.js" type="text/javascript"></script>
		<script src="<?=base_url()?>js/jquery-latest.js"></script>
   		<script type="text/javascript" src="<?=base_url()?>js/jquery.validate.js"></script>
		<script src="<?=base_url()?>js/bootstrap-typeahead.js" type="text/javascript"></script>
	    <script src="<?=base_url()?>js/bootstrap.js"></script>
		<script src="<?=base_url()?>js/jquery.watermark.js" type="text/javascript"></script>
		<script src="<?=base_url()?>js/jquery.autocomplete.js" type="text/javascript"></script>

		 <script>
	 	$('.carousel').carousel();
	 	$('.typeahead').typeahead({
		 select:function (item) {

        //item = selected item
        //do your stuff.

        //dont forget to return the item to reflect them into input
       alert(item);
    }
});
	 	</script>
	
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>js/jquery.autocomplete.css" />


	<?php       
    echo "<SCRIPT type=text/javascript >   var data = [";   
    
    $i=1;
    if($auto_count>0)
    {
        foreach($auto_array as $row)
        {   
            $urlredirect = base_url().'index.php/movie/movie_name/'.$row->movie_id;
            if($i<$auto_count)
            { 
                echo "{text:'".$row->movie_name."', url:'".$urlredirect."'},"; 
            }
            else
            {
                echo "{text:'".$row->movie_name."', url:'".$urlredirect."'}";  
            }
            $i++;
        } 
    }
    else
    {
        echo 'No Match Found';
    }
    echo "]; </script>";
?>


	<script type="text/javascript">
$().ready(function() 
{

    function findValueCallback(event, data, formatted) {
        $("<li>").html( !data ? "No match!" : "Selected: " + formatted).appendTo("#result");
    }
    
    function formatItem(row) {
        return row[0] + " (<strong>id: " + row[1] + "</strong>)";
    }
    
    function formatResult(row) {
        return row[0].replace(/(<.+?>)/gi, '');
    }
     
     
$('#txtSearch').autocomplete(data,{
  
  formatItem: function(item) { 
    return item.text;
  } 
  
}).result(function(event, item) {
  location.href = item.url;
});


 
});

</script> 
  	<script type="text/javascript">
	
				$(document).ready(function(){
				$("#txtName").watermark("Enter your name");
				$("#txtEmailId").watermark("Enter email");
				$("#txtPhone").watermark("Enter Phone Number");
				$("#txtCompany").watermark("Enter name of your company");
				$("#txtMessage").watermark("Enter message");
				}); 
			</script>
	<script>
  $(document).ready(function(){
    $("#form").validate();
  });
  </script>

</body>
</html>