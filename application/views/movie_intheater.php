<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en-US" xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
	<title>Movies In theater</title>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	
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
				<div class="row-fluid">
            		<div class="span12">
						<div id="myCarousel" class="carousel slide">
							<div class="carousel-inner">
               		 			<div class="active item">
									<img src="<?=base_url()?>images/images.jpg" alt="" title="Barfi" />
									<div class="carousel-caption">Barfi</div>
								</div>
								<div class="item">
									<img src="<?=base_url()?>images/sk.jpg" alt="" title="Barfi" />
									<div class="carousel-caption">Ek Tha Tigar</div>
								</div>
								<div class="item">
									<img src="<?=base_url()?>images/image1.jpg" alt="" title="Barfi" />
									<div class="carousel-caption">Kya supoor cool hai hum</div>
								</div>
								<div class="item">
									<img src="<?=base_url()?>images/jism.jpg" alt="" title="Barfi" />
									<div class="carousel-caption">jism 2</div>
								</div>
								<div class="item">
									<img src="<?=base_url()?>images/images5.jpg" alt="" title="Barfi" />
									<div class="carousel-caption">The Expandables</div>
								</div>
					
			    			</div>	
		   				 </div>
					</div>
				</div>
	
			<div class="row-fluid">
			 				<div class="row-fluid" >
								<div class="well well-small">
										<div class="span4">RELEASEING IN THEATER</div>
										<div class="span1 offset7" >
											<?php if($movie_intheater_count > 3)
												echo '<a href="'.base_url().'index.php/movie/movie_intheater_see_all">See all</a>';
											?>
										</div>
								</div>
							</div>

					<div class="row-fluid">
							<ul class="thumbnails">
							<?php foreach($movie_intheater as $Movie_movies)
							{
			
								$rate= $Movie_movies->Movie_Rating * 12;
								
								echo '<li class="span4">
								
									<a href="'.base_url().'index.php/movie/movie_name/'.$Movie_movies->Movie_Id.'" class="thumbnail"><img src="'.base_url().'images/movie/'.$Movie_movies->Movie_Image.'" alt="" /></a>
								
								<div class="rating">
									<p>RATING</p>
									<div class="stars">
										<div class="stars-in" style="width:'.$rate.'px !important;">
											
										</div>
									</div>
									<span ><i class="icon-comment">'.$Movie_movies->cnt.'</i></span>
								</div>
							</li>';
									}?>
						</ul>
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
     <script src="<?=base_url()?>js/jquery.autocomplete.js" type="text/javascript"></script>
    <script>
	 	$('.carousel').carousel();
	 	$('.typeahead').typeahead({
		 select:function (item) {

        
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