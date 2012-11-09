<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en-US" xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
    <title>Home Page</title>
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
                              <h6 class='well well-small'>Critic-Review</h6>
                          </div>
                          <div class="row-fluid">
					                   <?php 
                    					 if(count($critic_review) > 0)
                                             {
                                             	foreach($critic_review as $Creview)
                                                  
                                            	{
                                                	echo "<div class='span12 cmnt_bg'>";
                                                	
                                                    if($Creview->Movie_Image)
                                                    {
                                                        echo"<div class='span1 img_margine'><img src='".base_url()."images/movie/large/".$Creview->Movie_Image."' alt='' /></div>";
                                                    }
                                                    else
                                                    {
                                                         echo "<div class='span1 img_margine'><img src='".base_url()."images/movie/small/default_image.jpg' alt='' /></div>";
                                                    }
                                                    echo "<div class='span9'><strong class='text-info'>".$Creview->Movie_Name."</strong>";
                                                	
                                                    echo "&nbsp;&nbsp;<strong class='text-info'>".$Creview->Creview_Title."</strong>";
                    		                       
                                                    echo "<div class='comment_info'>";
                                                    echo "&nbsp; &nbsp;<small>".date('d/m/Y',strtotime($Creview->Creview_Time))."</small>";

                                                    echo "</div>";
                                                	echo '<br /><p>'.$Creview->Creview_Desc.'</p><br />';
                                                   echo ' </div> 
                                                </div> <br>';
                                            }
                                           
                                            }
                                            else
                                                {
                                                    echo "&nbsp;";
                                                }
                                                echo '</div>';
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
<script>
$('.carousel').carousel();
$('.typeahead').typeahead({
 select:function (item) {
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


<script type="text/javascript">

function checknewReviewInputKey(Movie_id)
{
    message = $("#txtWallmsg").val();
    message = message.replace(/^\s+|\s+$/g,"");

    if (message != '') {
         $.ajax({
            type: "POST",
            url: "<?=base_url()?>index.php/user/sendnew_review?Movie_id="+Movie_id+"&message="+message,
            data:'',
            cache: false,
            success: function(result) {
                
                $("#divcmnt").html(result);
                $("#txtWallmsg").val('');
                return false;
            },
                error: function(result) {

            }
   
        });
    }
}
    
function checknewtextboxReviewInputKey(event,Movie_id)
{
    if(event.keyCode == 13 && event.shiftKey == 0)  {
        message = $("#txtWallmsg").val();
        message = message.replace(/^\s+|\s+$/g,"");

        if (message != '') {
             $.ajax({
                type: "POST",
                url: "<?=base_url()?>index.php/user/sendnew_review?Movie_id="+Movie_id+"&message="+message,
                data:'',
                cache: false,
                success: function(result) {
                    $("#divcmnt").html(result);
                    $("#txtWallmsg").val('');
                    return false;
                },
                error: function(result) {
                 
                }
       
            });
        }
    }
}

</script>
</body>
</html>