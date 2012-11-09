<?php
									 $display = ($this->ion_auth->logged_in())?'block': 'none';
									 
								?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en-US" xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
<title><?php foreach ($Movie_movie as $movie_movies) {echo ($movie_movies->Movie_Name);}?></title>
<link href="<?=base_url()?>css/bootstrap.css" rel="stylesheet">
<!--[if IE 6]>
		<link rel="stylesheet" href="css/ie6.css" type="text/css" media="all" />
	<![endif]-->
<style type="text/css">
#hint, #hint-out, #hint-function, #hint-format, #mouseover-target { background-color: #F0F0F0; border-radius: 3px; 
	float: left; height: 15px; margin-left: 5px; padding-bottom: 2px; padding-left: 8px; padding-right: 8px; text-align: center; 
color: #000000;	width: 70px; }
.rating1{float: left;}
#hint-format { width: 120px; }

	</style>
<script src="<?=base_url()?>js/jquery-1.7.1.js" type="text/javascript"></script>
<script src="<?=base_url()?>js/bootstrap-typeahead.js" type="text/javascript"></script>
<script src="<?=base_url()?>js/bootstrap.js"></script>
<script src="<?=base_url()?>js/jquery.autocomplete.js" type="text/javascript"></script>
<script src="<?=base_url()?>js/jquery.raty.min.js" type="text/javascript"></script>
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
<script type ="text/javascript">
	$(document).ready(function(){
	    $("button").click(function () 
	    {
	    $("#display").toggle();

	    });
	});
</script>
<script type="text/javascript">
	$(function() {
		var islogin='<?=$display?>';
		
		$('.rating1').raty({
				targetKeep:	true,
				start: 5,
				target:		'#hint-function',
				targetText:	'0',
				number:	10,
				hintList: ['1','2','3','4','5','6','7','8','9','10'],
				path:  '<?=base_url()?>images/',
				starOff: 'star-off.png',
				starOn: 'star-on.png',
				size:18,
				scoreName:'score1',
				click:	function(score, evt) {
					if(islogin=='none')
							{
								window.location="<?=base_url()?>index.php/user/login";
							}
							else
							{
	
						$.ajax({
							
									type: "POST",
									url: "<?=base_url()?>index.php/movie/rating?Movie_Id="+<?=$this->uri->segment(3)?>+"&score="+score,
									data:'',
									cache: false,
									success: function(result) {
                    $("#comment-box").attr("style","display:block;");
										$(this).fadeOut(function() { $(this).fadeIn(); });
										
										},
									error: function(result) {
									 
									 alert("error");
									 alert(result);
									},
                  complete:function(){

                                      }
							  	
							 });
					}
					}


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
                                  $("#txtWallmsg").val('');

                                },
                                    error: function(xhr, ajaxOptions, thrownError) {
                                        alert(xhr.status);
                                          alert(thrownError);

                                }
                       
                            });
                        }
                    }

	function checknewcmmtInputKey(Movie_id)
	{
        message = $("#txtmsg").val();
        message = message.replace(/^\s+|\s+$/g,"");

        if (message != '') {
             $.ajax({
                type: "POST",
                url: "<?=base_url()?>index.php/user/sendnew_comment?Movie_id="+Movie_id+"&message="+message,
                data:'',
                cache: false,
                success: function(result) {
                  location.reload();
                    $("#divcmnt").html(result);
                  $("#txtmsg").val('');
                  //return false;
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
                                  $("#txtWallmsg").val('');
                                   $("#comment-box").attr("style","display:block;");

                                },
                                    error: function(xhr, ajaxOptions, thrownError) {
                                        alert(xhr.status);
                                          alert(thrownError);

                                }
                       
                            });
                        }
            
        }
}

  
	function checknewtextboxcmmtInputKey(event,Movie_id)
{
    if(event.keyCode == 13 && event.shiftKey == 0)  {
       message = $("#txtmsg").val();
        message = message.replace(/^\s+|\s+$/g,"");

        if (message != '') {
             $.ajax({
                type: "POST",
                url: "<?=base_url()?>index.php/user/sendnew_comment?Movie_id="+Movie_id+"&message="+message,
                data:'',
                cache: false,
                success: function(result) {
                    $("#divcmnt").html(result);
                  $("#txtmsg").val('');
                 // return false;
                },
                error: function(result) {
                 
                    }
       
            });
                
            
        }
    }
}

</script>
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
 
              <div id="content_video" style="">
                <div>
                  <?php 

								function parse_youtube_url($url,$return='embed',$width='',$height='',$rel=0){
						    $urls = parse_url($url);
						 
						    
						    if($urls['host'] == 'youtu.be'){ 
						        $id = ltrim($urls['path'],'/');
						    }
						    //url is http://www.youtube.com/embed/xxxx
						    else if(strpos($urls['path'],'embed') == 1){ 
						        $id = end(explode('/',$urls['path']));
						    }
						     //url is xxxx only
						    else if(strpos($url,'/')===false){
						        $id = $url;
						    }
						    //http://www.youtube.com/watch?feature=player_embedded&v=m-t4pcO99gI
						    //url is http://www.youtube.com/watch?v=xxxx
						    else{
						        parse_str($urls['query']);
						        $id = $v;
						        if(!empty($feature)){
						            $id = end(explode('v=',$urls['query']));
						        }
						    }
						   
						    if($return == 'embed'){
						        return '
						<iframe src="http://www.youtube.com/embed/'.$id.'?rel='.$rel.'" frameborder="0" width="'.($width?$width:560).'" height="'.($height?$height:349).'"></iframe>
						';
						    }
						    
						    else if($return == 'thumb'){
						        return 'http://i1.ytimg.com/vi/'.$id.'/default.jpg';
						    }
						    
						    else if($return == 'hqthumb'){
						        return 'http://i1.ytimg.com/vi/'.$id.'/hqdefault.jpg';
						    }
						    
						    else{
						        return $id;
						    }
						}

						foreach ($Movie_movie as $movie_movies) {
						   echo parse_youtube_url($movie_movies->Movie_Url,'embed','100%');
						  }?>
                </div>
              </div>
         
            </div>
          </div>
		  <div class="row-fluid"><div class="span12" ></div></div>
          <div class="row-fluid">
            <div class="span3">
              <?php	
								foreach ($Movie_movie as $movie_movies) {
						echo'<img src="'.base_url().'images/Movie/'.$movie_movies->Movie_Image.'"> </img>';
					}?>
            </div>
       
            <div class="span9">
              <div class="row-fluid">
			  <div class="span12">
                <div class="well well-small">
                  <?php	
										foreach ($Movie_movie as $movie_movies) {
											echo  "<h6>".$movie_movies->Movie_Name."</h6>";
									}?>
                </div>
				</div>
              </div>
              <div id="rating">
                <div class="rating1" onclick="document.getElementById('user').style.visibility= 'visible';"></div>
                <div id="hint-function"></div>
                <input type="hidden" name="score1">
                </input>
              </div>
              <div class="clear"></div>
              <div class="span9"> <b>Review : </b> <a href="<?=base_url()?>index.php/movie/movie_review/<?=$this->uri->segment(3)?>">User (<?=$Movie_review_count?>)</a> 
			 		     / 
			         <a href="<?=base_url()?>index.php/movie/critic_review/<?=$this->uri->segment(3)?>">Critic (<?=$critic_review_count?>)</a>
				
                <div id="comment-box" style="display:none;" >
                  <textarea  id="txtWallmsg" style="width:320px !important;height:100px !important;" onkeypress="javascript:return checknewtextboxReviewInputKey(event,<?=$this->uri->segment(3)?>);"  name="txtWallmsg" type="text" class="required contact_textarea" ></textarea>
                </div>
              </div>
             
              <br />
              <div class="span9">
                <div class="movie-desctext"> <b>Release Date</b> :
                  <?php	
											foreach ($Movie_movie as $movie_movies) {
												echo '<span itemprop="genre">'.date('d/m/Y',strtotime($movie_movies->Movie_Release_Date)).'</span>';
										}?>
                </div>
                <div class="movie-desctext"> <b>Genre</b> :
                  <?php	
												foreach ($Movie_movietype_detail as $Movie_movietype_details) {
													echo '<a href="'.base_url().'index.php/movie/movietype/'.$Movie_movietype_details->Movie_Type_Id.'">
														<span itemprop="genre">'.$Movie_movietype_details->Movie_Type_Name.'</span></a>';
											}?>
                </div>
                <div class="movie-desctext"> <b>Director</b> :
                  <?php 
												foreach($Movie_director as $movie_directors)
												{
													echo '<span itemprop="director">
													  		<a href="'.base_url().'index.php/director/director_name/'.$movie_directors->Director_Id.'">'.$movie_directors->Director_Name.'</a>
													 	</span>';
													 	echo'<br />';
											 }?>
                </div>
                <div class="movie-desctext"> <b>Producer</b> :
                  <?php
												foreach ($Movie_producer as $Movie_producers)
												{
													echo '<span itemprop="producer">
													 <a href="'.base_url().'index.php/producer/producer_name/'.$Movie_producers->Producer_Id.'">'.$Movie_producers->Producer_Name.'</a>
													</span>';
													echo'<br />';
												}?>
                </div>
                <div class="movie-desctext"> <b>Cast</b> :
                  <?php 
												foreach($Movie_actor as $movie_actors)
												{
													echo '<span itemprop="producer"><a href="'.base_url().'index.php/actor/actor_name/'.$movie_actors->Actor_Id.'">'.$movie_actors->Actor_Name.'</a></span>';
													echo '<br />';
												}
											?>
                </div>
               
              </div>
             
              <div id="movie-display">
                <button class="btn btn-info"><b>More Cast & Crew</b></button>
                <div id="display" style="display: none;">
                  <div>
                    <div class="movie-desctext"> <b>Singer</b> :
                      <?php
														foreach ($Movie_singer as $movie_singers)
															 {
															echo'<span itemprop="producer">
															<a href="'.base_url().'index.php/singer/singer_name/'.$movie_singers->Singer_Id.'">'.$movie_singers->Singer_Name.'</a>';
															echo '<br /></span>';
														}?>
                    </div>
                  </div>
                  <div>
                    <div class="movie-desctext"> <b>Script_Writer</b> :
                      <?php
														foreach ($Movie_script_writer as $movie_script_writers)
														 {
														echo '<span itemprop="producer">
														<a href="'.base_url().'index.php/script_writer/script_writer_name/'.$movie_script_writers->Script_Writer_Id.'">'.$movie_script_writers->Script_Writer_Name. '</a></span>';
														echo '<br />';
														}?>
                    </div>
                  </div>
                  <div>
                    <div class="movie-desctext"> <b>Movie Duration</b> : <span itemprop="producer">
                      <?php	
										foreach ($Movie_movie as $movie_movies) {
													echo $movie_movies->Movie_Duration;
												}?>
                      </span> </div>
                  </div>
                  <div>
                    <div class="movie-desctext"> <b>movie is in Theatre</b> : <span itemprop="producer">
                      <?php	
										foreach ($Movie_movie as $movie_movies) {
													if($movie_movies->Movie_In_Theater == 1)
														echo "Yes";
													else
														echo "No";
												}?>
                      </span> </div>
                  </div>
                  <div>
                    <div class="movie-desctext"> <b>Speacial Apparence</b> : <span itemprop="producer">
                      <?php	
										foreach ($Movie_special_appereance as $Movie_special_appereances) {
													echo $Movie_special_appereances->special_appereance_name."<br />";
												}?>
                      </span> </div>
                  </div>
                  <div>
                    <div class="movie-desctext"> <b>Choreography</b> :
                      <?php
													foreach ($Movie_choreographer as $movie_choreographers) 
														{
															echo '<span itemprop="producer">
																     <a href="'.base_url().'index.php/choreographer/choreographer_name/'.$movie_choreographers->Choreographer_Id.'">'.$movie_choreographers->Choreographer_Name. '</a></span>';
																	echo'<br />';
																
														}?>
                    </div>
                  </div>
                  <div>
                    <div class="movie-desctext"> <b>lyrics</b> :
                      <?php
													foreach ($Movie_lyrics as $movie_lyrics) 
														{
															 echo '<span itemprop="producer">
																		   <a href="'.base_url().'index.php/lyrics/lyrics_name/'.$movie_lyrics->Lyrics_Id.'">'.$movie_lyrics->Lyrics_Name.'</a></span>';
															echo '<br />';	   
														}?>
                    </div>
                   
                  </div>
                  <div>
                    <div id="movie-descstory" style="font-size: 12px;"> <b>Description</b> :
                      <?php	
												foreach ($Movie_movie as $movie_movies) {
													echo '<div class="description">
															'.$movie_movies->Movie_Description.'
													    </div>';
												}?>
                    </div>
                  </div>
                </div>
               
              </div>
             
              <div class="clear"></div>
             
              <div class="clear"></div>
             
            </div>
           
          </div>
          <div class="row-fluid">
            <div class="span9" >
              <?php	
									foreach ($Movie_movie as $movie_movies) {
									$rate= $movie_movies->Movie_Rating * 12;
									echo'<div class="rating">
											<p>RATING</p>
												<div class="stars">
													<div class="stars-in" style="width:'.$rate.'px !important;">
													</div>
												</div>
											<span ><i class="icon-comment">'.$movie_movies->cnt.'</i></span>
										</div>';
									}
								?>
              <br />
              <div class="clear"></div>
              <?php $display = ($this->ion_auth->logged_in())?'block': 'none';
							?>
              <div id="comment-box" style="display:<?=$display?>;" >
                <textarea id="txtmsg" style="width:320px !important;height:100px !important;" onkeypress="javascript:return checknewtextboxcmmtInputKey(event,<?=$this->uri->segment(3)?>);" name="txtmsg" type="text" class="required contact_textarea" ></textarea>
                <input type="submit" class="btn btn-info"  Value="Send Comment" onclick='javascript:return checknewcmmtInputKey(<?=$this->uri->segment(3)?>);' />
              </div>
              <?php 
					
					 echo "<div class='row-fluid'>";
  						echo "<div class='span12'>
                                <h6 class='well well-small'>Comments</h6>
                             </div>";
                         if(count($movie_comment) > 0)
                         {
                         	foreach($movie_comment as $commnet)
                        	{
                            	echo "<div class='span12 cmnt_bg'>";
                            	if($commnet->user_image)
                                {
                                    echo"<div class='span1 img_margine'><img src='".base_url()."images/user/small/".$commnet->user_image."' alt='' /></div>";
                                }
                                else
                                {
                                     echo "<div class='span1 img_margine'><img src='".base_url()."images/user/small/default_image.jpg' alt='' /></div>";
                                }
                            	echo'<div class="span9"><small class="text-info">'.$commnet->first_name.' '.$commnet->Last_Name.'</small>';
		                          echo "<div class='comment_info'>";
                                if($commnet->hr > 24)
    		                            echo "&nbsp; &nbsp;".date('d/m/Y',strtotime($commnet->time))." ";

    		                        elseif($commnet->hr > 0 && $commnet->hr < 24)
    		                            echo " &nbsp; &nbsp; ".$commnet->hr." Hours ".substr($commnet->min-(60 * $commnet->hr),0,2)." minutes ".substr($commnet->sec-(60 * $commnet->min),0,2)." Seconds ago</span>";
    		                         elseif($commnet->min > 0 && $commnet->min < 60)
    		                            echo " &nbsp; &nbsp; ".$commnet->min." minutes ".substr($commnet->sec-(60 * $commnet->min),0,2)." Seconds ago</span>";
    		                        else
    		                            echo "&nbsp; &nbsp;".($commnet->sec)." Seconds ago</span>";
                                	 echo "</div>";
                              		 echo' <p class="wrp">'.$commnet->Comment.'</p>
								 </div>
                        </div> <br />';
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
      </div>
      <div class="row-fluid">
        <div class="span12">
        
          <?php $this->load->view('include/footer.php'); ?>
          
        </div>
      </div>
    </div>
  </div>
  
</div>

</body>
</html>
