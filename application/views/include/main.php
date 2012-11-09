<div id="main">
		<!-- Content -->
		<div id="content_left">
                
            
  					<div class="main">
			
			<div id="slideshow" class="rs-slideshow">
				<div class="slide-container">
					<img src="<?=base_url()?>images/images.jpg" alt="" title="Barfi" />
					<span class="slide-caption">Barfi</span>
				</div>
				<ol class="slides">
					<li>
						<a href="<?=base_url()?>images/images.jpg" 
							title="Barfi">Barfi</a>
					</li>
					<li>
						<a href="<?=base_url()?>images/ek.jpg" 
							title="Ek Tha Tigar">Ek Tha Tigar</a>
					</li>
					<li>
						<a href="<?=base_url()?>images/image1.jpg" 
							title="Kya Super Cool Hai Hum" >
							Kya Super Cool Hai Hum</a>
					</li>
					
					<li>
						<a href="<?=base_url()?>images/jism.jpg" 
							title="Jism2">
							Jism2</a>
				    </li>
					
				    <li>
						<a href="<?=base_url()?>images/images5.jpg" 
							title="The Expandables">
							The Expandables</a>
				    </li>
				    <li>
						<a href="<?=base_url()?>images/gio.jpg" 
							title="Gi joe">
							Gi Joe</a>
				    </li>
				    
				    <li>
						<a href="<?=base_url()?>images/omg.jpg" 
							title="Oh My God">
							Oh My God</a>
				    </li>
				     <li>
						<a href="<?=base_url()?>images/razz.jpg" 
							title="RAZZ3">
							RAZZ3</a>
				    </li>
				    <li>
						<a href="<?=base_url()?>images/heroine.jpg" 
							title="Heroine">
							Heroine</a>
				    </li>
				    <li>
						<a href="<?=base_url()?>images/image4.jpg" 
							title="shirin-farhad-ki-toh-nikal-padi">
							shirin-farhad-ki-toh-nikal-padi</a>
				    </li>

				  </ol>			
			    </div>	
		    </div><!--end slideshow-->

		</div>
		<!--end content_left-->


			<!--content_middle-->
					<?php $this->load->view('include/content_middle'); ?>
			<!--end content_middle-->

<!--start content_right-->
		    <div id="content_right">

					<!-- Box -->
			 <div class="box">
				<div class="head">
					<h2>LATEST MOVIES</h2>
					<p class="text-right"><a href="#">See all</a></p>
				</div>

				<!-- Movie -->
				
				<!-- end Movie -->
				
				<!-- Movie -->
				<?php foreach($movie_commingsoon as $Movie_movies)
				{
					echo '<div class="movie">
					<div class="movie-image">
						<a href="'.base_url().'index.php/movie/movie_name/'.$Movie_movies->Movie_Id.'"><span class="play"><span class="name">'.$Movie_movies->Movie_Name.'</span></span><img src="'.base_url().'images/movie/'.$Movie_movies->Movie_Image.'" alt="" /></a>
					</div>
					<div class="rating">
						<p>RATING</p>
						<div class="stars">
							<div class="stars-in">
								
							</div>
						</div>
						<span class="comments">12</span>
					</div>
				</div>';
			}?>
				<!-- end Movie -->
				
			
				<!-- end Movie -->
				
				<!-- Movie -->
 				
				<!-- end Movie -->
				<div class="cl">&nbsp;</div>
			</div>
			<!-- end Box -->

			

			</div>		    
			<!--end content_right-->
			
			
		

		<!-- NEWS -->
	
		<!-- end NEWS -->


		<div class="cl">&nbsp;</div>
	</div>
	<!-- end Main -->
