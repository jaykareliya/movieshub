<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en-US" xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
<title> Forget Password </title>


<link href="<?=base_url()?>css/bootstrap.css" rel="stylesheet">
	<!--[if IE 6]>
		<link rel="stylesheet" href="css/ie6.css" type="text/css" media="all" />
	<![endif]-->

	
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>js/jquery.autocomplete.css" />


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
					<form id="form" name="form" method="post" onSubmit="return Validate()" >
						<div class="row-fluid" >
							<div class="well well-small">
								<div class="span4">Forget Password</div>
							</div>
						</div>
						<div class="article reg_form">
								<div class="control-group">
									<label class="control-label" for="email">E-mail:</label>
									<div class="controls">
										<input id="email" class="reg_thick required email" type="text" name="email" maxlength="100">
									</div>
								</div>
								<div class="control-group">
									<div class="controls">
										<button class="btn btn-info" type="submit" id="submit" name="submit">Submit</button>
									</div>
								</div>
						</div>
					</form>		
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

    <script src="<?=base_url()?>js/jquery.autocomplete.js" type="text/javascript"></script>
	<script src="<?=base_url()?>admin/js/jquery.ui.core.js" type="text/javascript"></script>
	<script src="<?=base_url()?>admin/js/jquery.ui.widget.js"></script>
	<script src="<?=base_url()?>admin/js/jquery.ui.datepicker.js"></script>
	 
   <script type="text/javascript" src="<?=base_url()?>js/jquery.validate.js"></script>
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



<script>
	  $(document).ready(function(){
	  $("#form").validate()
	
  });
</script>


</body>		
</html>