<link rel="stylesheet" type="text/css" href="<?=base_url()?>js/jquery.autocomplete.css" />
<?php       

if(!isset($user))
{
	$user = "";
	$id = "";
}
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
	<!-- Header -->
	
							<?php $display = ($this->ion_auth->logged_in())?'none': 'block';
								$display1 = ($this->ion_auth->logged_in())?'block': 'none';
							?>
								<?php $url=$_SERVER['REQUEST_URI'];
			?>
					
				<div class="navbar navbar-inverse">
			    <div class="navbar-inner">
			      <div class="container-fluid"> 
			      	<div class="row-fluid">
			      		<div class="span3"><a class="brand" href="<?=base_url()?>index.php/home">Movie Mania</a></div>
			      		<div class="pull-right">
			      			<div class="row-fluid">
			      				<div class="span12"><p class="navbar-text pull-right" style="display:<?=$display?>"><a href="<?=base_url()?>index.php/user/register" class="text-info">Register</a>|<a href="<?=base_url()?>index.php/user/login" class="text-info" onclick="">Login</a></p>
			           <p class="navbar-text pull-right" style="display:<?=$display1?>"><a href="".base_url()."index.php/user/user_details/".$id." " class="text-info"><span class="muted"><?php echo  strtoupper($user); ?></span></a> | <a href="<?=base_url()?>index.php/user/changepasswordview" class="text-info">changepassword</a> | <a href="<?=base_url()?>index.php/user/logout" class="text-error" onclick="">Log Out</a> </p></div>
			      			</div>
			      			<div class="row-fluid">
			      				<div class="span12">
			      					<p class="pull-right">
							<a  <?php if($url == "/index.php/home" || $url == ""){echo 'class="active text-info"';} ?> href="<?=base_url()?>index.php/home">HOME</a> |
						   <a <?php if($url == "/index.php/home/news"){echo 'class="active  text-info"';}?>href="<?=base_url()?>index.php/home/news">NEWS</a> |
						   <a  <?php if($url == "/index.php/movie/movie_intheater"){echo 'class="active  text-info"';}?> href="<?=base_url()?>index.php/movie/movie_intheater">IN THEATERS</a> |
						   <a <?php if($url == "/index.php/movie/movie_commingsoon"){echo 'class="active  text-info"';}?> href="<?=base_url()?>index.php/movie/movie_commingsoon">COMING SOON</a> |
						   <a <?php if($url == "/index.php/home/contact"){echo 'class="active  text-info"';}?>href="<?=base_url()?>index.php/home/contact">CONTACT</a>
						</p>
			      				</div>
			      			</div>
			      		</div>
			      	</div>
			      	
			      </div>
			      </div>
			</div>
			    	<!-- Navigation -->
		
		  
		
		 <div class="navbar">
			    <div class="navbar-inner">
			      <div class="container"> 
				  <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> 
				  <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a>
			        <div class="nav-collapse">
			          <ul class="nav">
			            <li <?php if($url == "/index.php/movie/latest_movie"){echo 'class="active"';}?> ><a href="<?=base_url()?>index.php/movie/latest_movie">LATEST MOVIES</a></li>
			            <li <?php if($url == "/index.php/movie/top_rated"){echo 'class="active"';}?>><a  href="<?=base_url()?>index.php/movie/top_rated">TOP RATED</a></li>
			            <li <?php if($url == "/index.php/movie/most_comment"){echo 'class="active"';}?>><a  href="<?=base_url()?>index.php/movie/most_comment">MOST COMMENTED</a></li>
			            </ul>
			          <div class="input-append pull-right">
					  
					  	<form  class="navbar-search pull-left" name="frmMovie" id="frmMovie" action="<?=base_url()?>index.php/movie/movie_search" method="post" onsubmit="return validateForm()" enctype="multipart/form-data" >
			            <input type="text" id="txtSearch" name="txtSearch"
			           data-items="4" data-provide="typeahead" style="margin: 0 auto;" class="span3">
			       </input>
			       <button class="btn" type="button">Go!</button>
			          </form>
					  </div>
			        </div>
			        <!-- /.nav-collapse -->
			      </div>
			    </div>
			    <!-- /navbar-inner -->
  		</div>

		<script src="<?=base_url()?>js/jquery.autocomplete.js" type="text/javascript"></script>