<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en-US" xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
    <title>Home Page</title>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    
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

            <div class='row-fluid'>
                         <div class='span12'>
                                <h6 class='well well-small'>Review</h6>
                             </div>

            <?php $display = ($this->ion_auth->logged_in())?'block': 'none';
                            ?>
                    
                    <div id="comment-box" style="display:<?=$display?>;" >
                        <textarea  id="txtWallmsg" style="width:320px !important;height:100px !important;" onkeypress="javascript:return checknewtextboxReviewInputKey(event,<?=$this->uri->segment(3)?>);"  name="txtWallmsg" type="text" class="required contact_textarea" ></textarea>

                        <input type="submit" class="btn btn-info" Value="Give Review" onclick="javascript:return checknewReviewInputKey(<?=$this->uri->segment(3);?>);"/>
                
                   </div>
     
                    <?php 
                    
                    
                         
                         if(count($movie_review) > 0)
                         {
                            foreach($movie_review as $review)
                               

                            {
                                echo "<div class='span12 cmnt_bg'>";
                               
                               if($review->user_image)
                                 {
                                   echo"<div class='span1 img_margine'><img  src='".base_url()."images/user/small/".$review->user_image."' alt='' /></div>";
                                }
                                else
                                {
                                     echo "<div  class='span1 img_margine'><img src='".base_url()."images/user/small/default_image.jpg' alt='' /></div>";
                                }
                                echo'<div class="span9"><small class="text-info">'.$review->first_name.' '.$review->last_name.'';
                               echo "<div class='time_info'>";
                                if($review->hr > 24)
                                    echo "&nbsp; &nbsp;".date('d/m/Y',strtotime($review->Review_Time))."</small>";
                                  
                                elseif($review->hr > 0 && $review->hr < 24)
                                    echo " &nbsp; &nbsp; ".$review->hr." Hours ".substr($review->min-(60 * $review->hr),0,2)." minutes ".substr($review->sec-(60 * $review->min),0,2)." Seconds ago</span>";
                                 elseif($review->min > 0 && $review->min < 60)
                                    echo " &nbsp; &nbsp; ".$review->min." minutes ".substr($review->sec-(60 * $review->min),0,2)." Seconds ago</span>";
                                else
                                    echo "&nbsp; &nbsp;".($review->sec)."Seconds ago</span>";
                                echo "</div>";
                           echo "<p class='wrp'>".$review->Review_Desc."</p>";
                            echo'</div> <br />
                        </div> ';
                        }
                       
                        }
                        else
                            {
                                echo "&nbsp;";
                            }
                            echo '</div>';
                            ?>
          

          <div class="span9">
          <table id="paging-table" border="0" cellspacing="0" cellpadding="0" >
            <tbody>
              <tr>
                <td>
                  <?php echo $pagination; ?>
                </td>
                
              </tr>
            </tbody>
          </table>
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