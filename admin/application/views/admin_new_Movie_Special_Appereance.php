<?php 
$Movie_Id = "";

$frmAction='save_Movie_Special_Appereance';
$Special_Appereance_Id="";


if(isset($_REQUEST['Movie_Special_Appereance_id']))
{
	$Movie_Id =  $Movie_Special_Appereance_details[0]->Movie_Id;
	$Special_Appereance_Id = $Movie_Special_Appereance_details[0]->Special_Appereance_Id;
	$frmAction='update_Movie_Special_Appereance?Movie_Special_Appereance_id='.$Movie_Special_Appereance_details[0]->Movie_Special_Appereance_Id;

}

?>
<script type="text/javascript">


function getSpecial_Appereance(MovieId)
{

	$.ajax({
				type: "POST",
				url: "<?=base_url()?>/admin/index.php/Movie_Special_Appereance/bind_Special_Appereance?Movie_id="+MovieId,
				data:'',
				cache: false,
				success: function(result) {
				document.getElementById('div_Special_Appereance_wrapper').innerHTML=result;
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
             <?php echo form_dropdown('ddlMovie',$bind_Movie,$Movie_Id,'id="ddlMovie" onchange="getSpecial_Appereance(this.value)" class="ddlSelection required" '); ?> 
          </td>
        <td></td>
      </tr>
     <tr >
        <th valign="top">Special_Appereance: </th>
        <td>
            <div id="div_Special_Appereance_wrapper">  <?php echo form_dropdown('ddlSpecial_Appereance',$bind_Special_Appereance,$Special_Appereance_Id,'id="ddlSpecial_Appereance" class="ddlSelection required" '); ?> </div>
          </td>
        <td></td>
      </tr>
   <tr>
      <th>&nbsp;</th>
      <td valign="top"><input type="submit" value="Save" class="form-submit" id="btnSave" />
        <a id="btnreset" class="form-reset" href="<?=base_url()?>index.php/Movie_Special_Appereance/manage_Movie_Special_Appereance">Cancle</a>
      </td>
      <td></td>
    </tr>

  </table>
</form>
