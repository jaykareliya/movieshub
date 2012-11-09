<?php 
$Movie_Id = "";

$frmAction='save_Movie_Choreographer';
$Choreographer_Id="";


if(isset($_REQUEST['Movie_Choreographer_id']))
{
	$Movie_Id =  $Movie_Choreographer_details[0]->Movie_Id;
	$Choreographer_Id = $Movie_Choreographer_details[0]->Choreographer_Id;
	$frmAction='update_Movie_Choreographer?Movie_Choreographer_id='.$Movie_Choreographer_details[0]->Movie_Choreographer_Id;

}

?>
<script type="text/javascript">


function getChoreographer(MovieId)
{

	$.ajax({
				type: "POST",
				url: "<?=base_url()?>/admin/index.php/Choreographer/bind_Choreographer?Movie_id="+MovieId,
				data:'',
				cache: false,
				success: function(result) {
				document.getElementById('div_Choreographer_wrapper').innerHTML=result;
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
             <?php echo form_dropdown('ddlMovie',$bind_Movie,$Movie_Id,'id="ddlMovie" onchange="getChoreographer(this.value)" class="ddlSelection required" '); ?> 
          </td>
        <td></td>
      </tr>
     <tr >
        <th valign="top">Choreographer: </th>
        <td>
            <div id="div_Choreographer_wrapper"><?php echo form_dropdown('ddlChoreographer',$bind_Choreographer,$Choreographer_Id,'id="ddlChoreographer" class="ddlSelection required" '); ?> </div>
          </td>
        <td></td>
      </tr>
   <tr>
      <th>&nbsp;</th>
      <td valign="top"><input type="submit" value="Save" class="form-submit" id="btnSave" />
        <a id="btnreset" class="form-reset" href="<?=base_url()?>index.php/Movie_Choreographer/manage_Movie_Choreographer">Cancle</a>
      </td>
      <td></td>
    </tr>

  </table>
</form>
