<hr />
<!-- Footer -->
	<?php $url=$_SERVER['REQUEST_URI'];
			?>
<footer>
		<p class="footer_menu">
			<a <?php if($url == "/index.php/home" || $url == ""){echo 'class="active  text-info"';}?> href="<?=base_url()?>index.php/home">HOME</a> <span>|</span>
			<a <?php if($url == "/index.php/home/news"){echo 'class="active  text-info"';}?> href="<?=base_url()?>index.php/home/news">NEWS</a> <span>|</span>
			<a <?php if($url == "/index.php/movie/movie_intheater"){echo 'class="active  text-info"';}?> href="<?=base_url()?>index.php/movie/movie_intheater">MOVIES IN THEATERS</a> <span>|</span>
			<a <?php if($url == "/index.php/movie/movie_commingsoon"){echo 'class="active  text-info"';}?> href="<?=base_url()?>index.php/movie/movie_commingsoon">COMING SOON </a> <span>|</span>
			<a <?php if($url == "/index.php/movie/latest_movie"){echo 'class="active  text-info"';}?> href="<?=base_url()?>index.php/movie/latest_movie">LATEST MOVIES</a> <span>|</span>
			<a <?php if($url == "/index.php/movie/top_rated"){echo 'class="active  text-info"';}?> href="<?=base_url()?>index.php/movie/top_rated">TOP RATED MOVIES</a> <span>|</span>
			<a <?php if($url == "/index.php/movie/most_comment"){echo 'class="active  text-info"';}?> href="<?=base_url()?>index.php/movie/most_comment">MOST COMMENTED TRAILERS</a> <span>|</span>
			<a <?php if($url == "/index.php/home/contact"){echo 'class="active  text-info"';}?> href="<?=base_url()?>index.php/home/contact">CONTACT </a>
		</p>

<!--		<p class="pull-right">
			<span>FOLLOW US ON:</span>
			<br />
			    <a class="twitter" href="#">twitter</a></li>| 
			    <a class="facebook" href="#">facebook</a></li> |
			    <a class="vimeo" href="#">vimeo</a></li>|
			    <a class="rss" href="#">rss</a></li>

		</p>-->
		
	</footer>
	<!-- end Footer -->