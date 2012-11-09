<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en-US" xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
<title><?php foreach ($Actor_detail as $Actor_details)
								{ echo $Actor_details->Actor_Name. "'s Profile";}?></title>


	<link href="<?=base_url()?>css/bootstrap.css" rel="stylesheet">


	

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
					 	<div class="span3">
							<?php
								foreach ($Actor_detail as $Actor_details)
								 {
									echo '<img alt="" title="Ek Tha Tiger" src="'.base_url().'images/Actor/large/'.$Actor_details->Actor_Avatar.'">';
									echo'<br />';
								}
							?>
						</div>
						
			

		 		<div class="span9">
					<h5>Date of Birth</h5>
							<?php 
								foreach ($Actor_detail as $Actor_details)
								{
									
								if(date('d/m/Y',strtotime($Actor_details->Actor_DOB)) != "00/00/0000" && date('d/m/Y',strtotime($Actor_details->Actor_DOB)) != "01/01/1970")	
								   {
										echo  date('d/m/Y',strtotime($Actor_details->Actor_DOB));
								   }
									else
									{
										
									}
								

								echo'<h5>Actor Name</h5>';
								
								echo ' '.$Actor_details->Actor_Name.'							
									<br>
									<br>';


								echo '<h5>Birth Place</h5>';

							
									
								echo ' '.$Actor_details->Actor_Birth_Place.'							
									<br>
									<br>';
							

								echo '<h5>Death Date</h5>';
							
									
								if(date('d/m/Y',strtotime($Actor_details->Actor_Death_Date)) != "00/00/0000")	
								   {

								   }
									else
									{
										echo  date('d/m/Y',strtotime($Actor_details->Actor_Death_Date));
									}
									
																
							  	 echo '<h5>Description</h5>';
									echo $Actor_details->Actor_Description;	


								echo'</div>';
								echo'<div class="row-fluid"><div class="span12" ></div></div>';
								echo '<div class="row-fluid">
							 		<div class="well well-small">
										<div class="span4">'.$Actor_details->Actor_Name.'\'s Movies List</div>

										<div class="span1 offset7">';
							}
				 			?>
							<?php if($actors_movie_count > 3)
								echo '<a href="'.base_url().'index.php/movie/actor_see_all/'.$this->uri->segment(3).'">See all</a>';
							?>

						</div><!--span1 offset7-->
					</div><!--end well well-small-->
				</div><!--end span12-->
			



							<div class="span9">
								<?php foreach ($actor_movie as $actor_movies)
								{
										echo '<div class="span3">
												<div class="actress-thumb">
													<a rel="bookmark" title="'.$actor_movies->movie_name.'" href="'.base_url().'index.php/movie/movie_name/'.$actor_movies->movie_id.'">
														<img width="100" height="75" border="0" src="'.base_url().'images/movie/'.$actor_movies->movie_image.'">
													</a>
												</div>
								
												<div class="actress-title">
													<a rel="bookmark" title="'.$actor_movies->movie_name.'" href="'.base_url().'index.php/movie/movie_name/'.$actor_movies->movie_id.'">'.$actor_movies->movie_name.'</a>
												</div>
										   	</div>';
										}?>
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
	<script src="<?=base_url()?>js/bootstrap-typeahead.js" type="text/javascript"></script>
    <script src="<?=base_url()?>js/bootstrap.js"></script>
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

		<script src="<?=base_url()?>js/jquery.autocomplete.js" type="text/javascript"></script>
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
	
</body>


</html>