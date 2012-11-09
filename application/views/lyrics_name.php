<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en-US" xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
<title> <?php foreach ($lyrics_detail as $lyrics_details) 
								{ echo $lyrics_details->Lyrics_Name. "'s Profile";}?>  </title>


<link href="<?=base_url()?>css/bootstrap.css" rel="stylesheet">
	<!--[if IE 6]>
		<link rel="stylesheet" href="css/ie6.css" type="text/css" media="all" />
	<![endif]-->
	
	
	
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
						foreach ($lyrics_detail as $lyrics_details) 
						{
							echo '<img alt="" title="Ek Tha Tiger" src="'.base_url().'images/lyrics/large/'.$lyrics_details->Lyrics_Avatar.'">';
						}?>
				</div>
				<div class="span9">
					<?php
						foreach ($lyrics_detail as $lyrics_details) 
							{
								echo'<h5>Lyrics Name</h5>';
								echo ' '.$lyrics_details->Lyrics_Name.'							
								<br>
								<br>';
								echo'</div>';			
					 			echo '</div> 
								<div class="row-fluid"><div class="span12" ></div></div>
								<div class="row-fluid">
							 	<div class="well well-small">
								<div class="span4">'.$lyrics_details->Lyrics_Name.'\'s Movies List</div>
								</div>
								<div class="span1 offset7">';
							}?>
					
							<?php if($lyrics_movie_count > 4)
								echo '<p class="text-left"><a href="'.base_url().'index.php/movie/lyrics_see_all/'.$this->uri->segment(3).'">See all</a></p>';
							?> 
					
				</div>
			</div>
		</div>
		<div class="span9">
			<?php
				foreach ($lyrics_movie as $lyrics_movies)
				  {	
					echo '<div class="span3">
						<div class="actress-thumb">
						<a rel="bookmark" title="'.$lyrics_movies->movie_name.'" href="'.base_url().'index.php/movie/movie_name/'.$lyrics_movies->movie_id.'">
						<img width="100" height="75" border="0" src="'.base_url().'images/movie/'.$lyrics_movies->movie_image.'">
						</a>
						</div>
						<div class="actress-title">
						<a rel="bookmark" title="'.$lyrics_movies->movie_name.'" href="'.base_url().'index.php/movie/movie_name/'.$lyrics_movies->movie_id.'">'.$lyrics_movies->movie_name.'</a>
						</div>
						</div>';
					}
			?>
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
	<script src="<?=base_url()?>js/jquery.autocomplete.js" type="text/javascript"></script>
	
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

	
		
</body>
</html>