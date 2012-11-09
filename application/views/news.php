<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en-US" xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
	<title>All News</title>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />

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
			
					
					
				<div class='row-fluid'>
					 <div class='span12'>
						<h6 class='well well-small'>News</h6>
					 </div>
						 
					 <div class="row-fluid">
							<?php
							 {
							 foreach($news as $movie_news)
							{
								echo "<div class='span12 cmnt_bg'>";
								if($movie_news->Movie_News_Image )
									{
										echo"<div class='span1 img_margine'><img  src='".base_url()."images/Movie_News/small/".$movie_news->Movie_News_Image."' alt='' /></div>";
									}
									else
									{
										 echo "<div class='span1 img_margine'><img  src='".base_url()."images/Movie_News/small/default_image.jpg' alt='' /></div>";
									}
								echo"<div class='span9'><strong class='text-info'>".$movie_news->Movie_News_Title." </strong> &nbsp; &nbsp;";
								 echo "<div class='comment_info'>";	
									if($movie_news->hr > 24)
										echo "&nbsp; &nbsp; <small>".date('d/m/Y',strtotime($movie_news->Movie_News_Date))." </small>";
									elseif($movie_news->hr > 0 && $movie_news->hr < 24)
										echo " &nbsp; &nbsp; <span>".$movie_news->hr." Hours ".substr($movie_news->min-(60 * $movie_news->hr),0,2)." minutes ".substr($movie_news->sec-(60 * $movie_news->min),0,2)." Seconds ago</span>";
									 elseif($movie_news->min > 0 && $movie_news->min < 60)
										echo " &nbsp; &nbsp; <span>".$movie_news->min." minutes ".substr($movie_news->sec-(60 * $movie_news->min),0,2)." Seconds ago</span>";
									else
										echo "&nbsp; &nbsp; <span>".($movie_news->sec)." Seconds ago</span>";
										 echo "</div>";
										echo'
										<p class="wrp">'.$movie_news->Movie_News_Description.'</p>
										</div> 
							</div> <br>';
							}
						   
							}
							 
							  echo '</div>';
							 ?>
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

      
       alert(item);
    }
});
        </script>
   
    
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>js/jquery.autocomplete.css" />
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