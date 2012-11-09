<?php 
$Movie_Id = "";

$frmAction='save_Movie_Script_Writer';
$Script_Writer_Id="";


if(isset($_REQUEST['Movie_Script_Writer_id']))
{
	$Movie_Id =  $Movie_Script_Writer_details[0]->Movie_Id;
	$Script_Writer_Id = $Movie_Script_Writer_details[0]->Script_Writer_Id;
	$frmAction='update_Movie_Script_Writer?Movie_Script_Writer_id='.$Movie_Script_Writer_details[0]->Movie_Script_Writer_Id;

}

?>
<script type="text/javascript">


function getScript_Writer(MovieId)
{

	$.ajax({
				type: "POST",
				url: "<?=base_url()?>/admin/index.php/Script_Writer/bind_Script_Writer?Movie_id="+MovieId,
				data:'',
				cache: false,
				success: function(result) {
				document.getElementById('div_Script_Writer_wrapper').innerHTML=result;
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
             <?php echo form_dropdown('ddlMovie',$bind_Movie,$Movie_Id,'id="ddlMovie" onchange="getScript_Writer(this.value)" class="ddlSelection required" '); ?> 
          </td>
        <td></td>
      </tr>
     <tr >
        <th valign="top">Script Writer: </th>
        <td>
            <div id="div_Script_Writer_wrapper"><?php echo form_dropdown('ddlScript_Writer',$bind_Script_Writer,$Script_Writer_Id,'id="ddlScript_Writer" class="ddlSelection required" '); ?> </div>
          </td>
        <td></td>
      </tr>
   <tr>
      <th>&nbsp;</th>
      <td valign="top"><input type="submit" value="Save" class="form-submit" id="btnSave" />
        <a id="btnreset" class="form-reset" href="<?=base_url()?>index.php/Movie_Script_Writer/manage_Movie_Script_Writer">Cancle</a>
      </td>
      <td></td>
    </tr>

  </table>
</form>
