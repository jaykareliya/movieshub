


				<div class="well sidebar-nav">

                    <ul class="nav nav-list">                     
	                      	<?php 
	                      		foreach ($Movie_movietype as $movie_movietypes)
	                      			{
	                      				echo '<li><a href="'.base_url().'index.php/movie/movietype/'.$movie_movietypes->Movie_Type_Id.'">'.$movie_movietypes->Movie_Type_Name.'</a></li>';
	                      			}
	                      	?>

						
			           </ul>
					</div>
			
			<div class="well sidebar-nav">

                    <ul class="nav nav-list"> 
						<li>Most Commmented</li>
					 	<?php 
	                      		 foreach($most_comment_movie as $most_comment_movies)
          							{
          									$rate= $most_comment_movies->Movie_Rating * 12;
          									
	                      				echo ' <li>
	                      				
									<div class="movie_img"><a href="'.base_url().'index.php/movie/movie_name/'.$most_comment_movies->Movie_Id.'"><img src="'.base_url().'images/movie/small/'.$most_comment_movies->Movie_Image.'" alt="" /></a>
	                      					<a href="'.base_url().'index.php/movie/movie_name/'.$most_comment_movies->Movie_Id.'"><span>'.$most_comment_movies->Movie_Name.'</span></a> <br />

	                      					<div class="rating">
												<div class="stars">
													<div class="stars-in" style="width:'.$rate.'px !important;">
													
													</div>
												</div>
												
												<span ><i class="icon-comment">'.$most_comment_movies->cnt.'</i></span>
											</div>
										</div>
	                      				</li>';

	                      			}
	                      	?>

	                      	<?php if($mostcomment_count > 3)
	                      	{
	                      		echo'<div>'; 
								echo '<li class="nav-header">	<a href="'.base_url().'index.php/movie/most_comment_see_all"><u>See all</u></a></li>';
								echo'</div>';
							}

							?>
	                  </ul>
				</div>

				<div class="well sidebar-nav">

                    <ul class="nav nav-list"> 
						<li class="nav-header">Celebrity Birthday Today</li>
					 	<?php 
	                      	foreach ($actor_birthday as $actor_birthdays)
				 			{
          					     echo '<li>   
          					    	 <img src="'.$actor_birthdays->Avatar.'" alt=""/>             				
	                      			<a href="'.$actor_birthdays->page_link.'"><span>'.$actor_birthdays->Name.'</span></a>
	                      		</li>';

	                      			}
	                      	?>
	                      	

	                  </ul>
				</div>

		
			<!--end right-->	

				     	 
				    <!--end birth-->
			

		<!--	echo '<li class="nav-header">	<a style="pull-right" href="'.base_url().'index.php/movie/most_comment_see_all"><u>See all</u></a></li>';