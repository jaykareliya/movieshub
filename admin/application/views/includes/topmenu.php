<?php
$currentpage = $this->uri->segment(1);
$page_section = $this->uri->segment(2);

?>
<!--  start nav-outer-repeat................................................................................................. START -->
<div class="nav-outer-repeat">
  <!--  start nav-outer -->
  <div class="nav-outer">
    <!-- start nav-right -->
    <div id="nav-right">
      <div class="nav-divider">&nbsp;</div>
      <div class="showhide-account"><a href="<?=base_url()?>index.php/page/change_password"><img src="<?=base_url(); ?>images/shared/nav/nav_myaccount.gif" width="93" height="14" alt="" /></a></div>
      <div class="nav-divider">&nbsp;</div>
      <a href="<?=base_url()?>index.php/page/logout" id="logout"><img src="<?=base_url(); ?>images/shared/nav/nav_logout.gif" width="64" height="14" alt="" /></a>
      <div class="clear">&nbsp;</div>
    </div>
    <!-- end nav-right -->
    <!--  start nav -->
    <div class="nav">
      <div class="table">
       
        <div class="nav-divider">&nbsp;</div>
         <ul class="<?php if($currentpage=="category" || $currentpage=="subcategory"){echo "current";}else{echo "select";}?>">
          <li><a href="<?=base_url()?>index.php/Actor/manage_Actor"><b>Actors</b>
            <!--[if IE 7]><!-->
            </a>
            <!--<![endif]-->
            <!--[if lte IE 6]><table><tr><td><![endif]-->
           
            <!--[if lte IE 6]></td></tr></table></a><![endif]-->
          </li>
        </ul>
        <div class="nav-divider">&nbsp;</div>
		<ul class="<?php if($currentpage=="product" || $currentpage=="flavour"){echo "current";}else{echo "select";}?>">
          <li><a href="<?=base_url()?>index.php/director/manage_director"><b>Director</b>
            <!--[if IE 7]><!-->
            </a>
            <!--<![endif]-->
            <!--[if lte IE 6]><table><tr><td><![endif]-->
           
            <!--[if lte IE 6]></td></tr></table></a><![endif]-->
          </li>
        </ul>
           <div class="nav-divider">&nbsp;</div>
    <ul class="<?php if($currentpage=="product" || $currentpage=="flavour"){echo "current";}else{echo "select";}?>">
          <li><a href="<?=base_url()?>index.php/producer/manage_producer"><b>Producer</b>
            <!--[if IE 7]><!-->
            </a>
            <!--<![endif]-->
            <!--[if lte IE 6]><table><tr><td><![endif]-->
           
            <!--[if lte IE 6]></td></tr></table></a><![endif]-->
          </li>
        </ul>
           <div class="nav-divider">&nbsp;</div>
    <ul class="<?php if($currentpage=="product" || $currentpage=="flavour"){echo "current";}else{echo "select";}?>">
          <li><a href="<?=base_url()?>index.php/Singer/manage_singer"><b>Singer</b>
            </a>
          </li>
        </ul>
                   <div class="nav-divider">&nbsp;</div>
    <ul class="<?php if($currentpage=="product" || $currentpage=="flavour"){echo "current";}else{echo "select";}?>">
          <li><a href="<?=base_url()?>index.php/movie/manage_movie"><b>Movie</b>

            </a>
             <div class="select_sub<?php if($currentpage=="category" || $currentpage=="subcategory"){echo " show";}?>">
              <ul class="sub">
                <li><a href="<?=base_url()?>index.php/movie/manage_movie"><b>Movie</b>

            </a></li>
                <li><a href="<?=base_url()?>index.php/Movie_Actor/manage_Movie_Actor">Movie Actor</a></li>
                <li><a href="<?=base_url()?>index.php/Movie_Director/manage_Movie_Director">Movie Director</a></li>
                  <li><a href="<?=base_url()?>index.php/Movie_Producer/manage_Movie_Producer">Movie Producer</a></li>
                  <li><a href="<?=base_url()?>index.php/Movie_Singer/manage_Movie_Singer">Movie Singer</a></li>
                   <li><a href="<?=base_url()?>index.php/Movie_Lyrics/manage_Movie_Lyrics">Movie Lyrics</a></li>
                 <li><a href="<?=base_url()?>index.php/Movie_Choreographer/manage_Movie_Choreographer">Movie Choreographer</a></li>
                     <li><a href="<?=base_url()?>index.php/Movie_Script_writer/manage_Movie_Script_writer">Movie Script writer</a></li>
                     <li><a href="<?=base_url()?>index.php/Movie_Special_Appereance/manage_Movie_Special_Appereance">Movie Special Appreance</a></li>
                 <li><a href="<?=base_url()?>index.php/Movie_News/manage_Movie_News">Movie News</a></li>
                 <li><a href="<?=base_url()?>index.php/Critic_Review/manage_Creview">Critic Review</a></li>
                 
                
              </ul>
            </div>
          </li>
        </ul>
                  <div class="nav-divider">&nbsp;</div>
    <ul class="<?php if($currentpage=="product" || $currentpage=="flavour"){echo "current";}else{echo "select";}?>">
          <li><a href="<?=base_url()?>index.php/Lyrics/manage_Lyrics"><b>Lyrics</b>
            </a>
          </li>
        </ul>
                   <div class="nav-divider">&nbsp;</div>
    <ul class="<?php if($currentpage=="product" || $currentpage=="flavour"){echo "current";}else{echo "select";}?>">
          <li><a href="<?=base_url()?>index.php/Choreographer/manage_Choreographer"><b>Choreographer</b>
            </a>
          </li>
        </ul>
                   <div class="nav-divider">&nbsp;</div>
    <ul class="<?php if($currentpage=="product" || $currentpage=="flavour"){echo "current";}else{echo "select";}?>">
          <li><a href="<?=base_url()?>index.php/Script_writer/manage_Script_writer"><b>Script Writer</b>
            </a>
          </li>
        </ul>
                   <div class="nav-divider">&nbsp;</div>
    <ul class="<?php if($currentpage=="product" || $currentpage=="flavour"){echo "current";}else{echo "select";}?>">
          <li><a href="<?=base_url()?>index.php/page/manage_User"><b>User</b>
            </a>
          </li>
        </ul>
                   <div class="nav-divider">&nbsp;</div>
    <ul class="<?php if($currentpage=="product" || $currentpage=="flavour"){echo "current";}else{echo "select";}?>">
          <li><a href="<?=base_url()?>index.php/Movie_Type/manage_Movie_Type"><b>Movie Types</b>
            </a>
          </li>
        </ul>
		    <div class="clear"></div>
      </div>
      <div class="clear"></div>
    </div>
    <!--  start nav -->
  </div>
  <div class="clear"></div>
  <!--  start nav-outer -->
</div>
<!--  start nav-outer-repeat................................................... END -->
