<?php 
$Movie_Id = "";

$frmAction='save_Movie_actor';
$Actor_Id="";


if(isset($_REQUEST['Movie_Actor_id']))
{
	$Movie_Id =  $Movie_Actor_details[0]->Movie_Id;
	$Actor_Id = $Movie_Actor_details[0]->Actor_Id;
	$frmAction='update_Movie_actor?Movie_actor_id='.$Movie_Actor_details[0]->Movie_Actor_Id;

}

?>
<script type="text/javascript">


function getActor(MovieId)
{

	$.ajax({
				type: "POST",
				url: "<?=base_url()?>/admin/index.php/Actor/bind_Actor?Movie_id="+MovieId,
				data:'',
				cache: false,
				success: function(result) {
				document.getElementById('div_actor_wrapper').innerHTML=result;
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
             <?php echo form_dropdown('ddlMovie',$bind_Movie,$Movie_Id,'id="ddlMovie" onchange="getActor(this.value)" class="ddlSelection required" '); ?> 
          </td>
        <td></td>
      </tr>
     <tr >
        <th valign="top">Actor: </th>
        <td>
            <div id="div_actor_wrapper">  <?php echo form_dropdown('ddlActor',$bind_Actor,$Actor_Id,'id="ddlActor" class="ddlSelection required" '); ?> </div>
          </td>
        <td></td>
      </tr>
   <tr>
      <th>&nbsp;</th>
      <td valign="top"><input type="submit" value="Save" class="form-submit" id="btnSave" />
        <a id="btnreset" class="form-reset" href="<?=base_url()?>index.php/Movie_Actor/manage_Movie_Actor">Cancle</a>
      </td>
      <td></td>
    </tr>

  </table>
</form>
