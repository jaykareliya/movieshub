<?php 
$Movie_Id = "";

$frmAction='save_Movie_Lyrics';
$Lyrics_Id="";


if(isset($_REQUEST['Movie_Lyrics_id']))
{
	$Movie_Id =  $Movie_Lyrics_details[0]->Movie_Id;
	$Lyrics_Id = $Movie_Lyrics_details[0]->Lyrics_Id;
	$frmAction='update_Movie_Lyrics?Movie_Lyrics_id='.$Movie_Lyrics_details[0]->Movie_Lyrics_Id;

}

?>
<script type="text/javascript">


function getLyrics(MovieId)
{

	$.ajax({
				type: "POST",
				url: "<?=base_url()?>/admin/index.php/Lyrics/bind_Lyrics?Movie_id="+MovieId,
				data:'',
				cache: false,
				success: function(result) {
				document.getElementById('div_Lyrics_wrapper').innerHTML=result;
				},
				 error:function (xhr, ajaxOptions, thrownError){
                    alert(xhr.status);
                    alert(thrownError);
                }    
   
		});
}
</script>
<script>
  $(document).ready(function(){
    $("#frmMovie").validate();
  });
  </script>
<form name="frmMovie" id="frmMovie" action=<?php echo $frmAction;?> method="post" onsubmit="return validateForm()" enctype="multipart/form-data" >
  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
    
         <tr >
        <th valign="top">Movie: </th>
        <td>
             <?php echo form_dropdown('ddlMovie',$bind_Movie,$Movie_Id,'id="ddlMovie" onchange="getLyrics(this.value)" class="ddlSelection required" '); ?> 
          </td>
        <td></td>
      </tr>
     <tr >
        <th valign="top">Lyrics: </th>
        <td>
            <div id="div_Lyrics_wrapper"><?php echo form_dropdown('ddlLyrics',$bind_Lyrics,$Lyrics_Id,'id="ddlLyrics" class="ddlSelection required" '); ?> </div>
          </td>
        <td></td>
      </tr>
   <tr>
      <th>&nbsp;</th>
      <td valign="top"><input type="submit" value="Save" class="form-submit" id="btnSave" />
        <a id="btnreset" class="form-reset" href="<?=base_url()?>index.php/Movie_Lyrics/manage_Movie_Lyrics">Cancle</a>
      </td>
      <td></td>
    </tr>

  </table>
</form>
