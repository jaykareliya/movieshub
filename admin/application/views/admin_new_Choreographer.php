<?php 
$Choreographer_name = "";

$frmAction='save_Choreographer';

$Choreographer_avatar="";

if(isset($_REQUEST['Choreographer_id']))
{
	$Choreographer_name =  $Choreographer_details[0]->Choreographer_Name;
	
	$frmAction='update_Choreographer?Choreographer_id='.$Choreographer_details[0]->Choreographer_Id;
	
	
	$Choreographer_avatar = $Choreographer_details[0]->Choreographer_Avatar;

}
?>
<script type="text/javascript">
function validateForm()
{
	if($("#txtChoreographerName").val = '')
		return false;
}
$(document).ready(function() {
$("#frmChoreographer").validate();


});
function check_duplicate()
{
	var Id =0;
	if(window.location.href.indexOf("Choreographer_id") != -1) 
	{
		Id= $.query.get('Choreographer_id');
	}
	var Choreographername = $('#txtChoreographerName').val();
	document.getElementById("msgbox").innerHTML='<img src="<?=base_url()?>images/loader_small.gif" />'; 
	
	$.ajax({
		type: "POST",
		url: "<?=base_url()?>/admin/index.php/page/get_duplicate_record?Id="+Id+"&TableName=Choreographer&FieldName=Choreographer_Name&FieldValue="+Choreographername+"&NameOfId=Choreographer_Id",
		data:'',
		cache: false,
		success: function(result) {
			if(result != '0')
			{
				$("#msgbox").fadeTo(500,0.3,function() //start fading the messagebox
				{ 
				  $(this).html('<div class="bubble-left" style="margin-left:10px;"></div><div class="bubble-inner">Choreographer is already exists!</div><div class="bubble-right"></div>').fadeTo(300,1);
				  $('#txtChoreographerName').val('<?=$Choreographer_name?>');
				  $('#msgbox').fadeOut(5000);
				 });	
			}
			else
			{
				$("#msgbox").removeClass().text('').fadeIn("slow");
				
			}
		},
		error: function(result) {
		 alert("error");
		 alert(result);
		}
   });
}
</script>
<form name="frChoreographer" id="frmChoreographer" action=<?php echo $frmAction;?> method="post" onsubmit="return validateForm()" enctype="multipart/form-data" >
  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
    <tr>
      <th valign="top">Choreographer Name:<span class="red">*</span></th>
      <td>  <input type="text" class="inp-form required" name="txtChoreographerName" id="txtChoreographerName" maxlength="100" onchange="return check_duplicate();"  value="<?=$Choreographer_name?>" /></td>
      <td style="padding-left:5px;"><div id="msgbox" style="display:none"></div></td>
    </tr>
  
      
    <tr>
      <th valign="top">Image:</th>
      <td><?php echo form_upload('Choreographer_avatar','','class="file_1" id="Choreographer_avatar"');?></td>
      <td><div class="bubble-left"></div>
        <div class="bubble-inner">JPEG, GIF 5MB max per image</div>
        <div class="bubble-right">
          <?php if($Choreographer_avatar!="") { ?>
          <img alt="" src="../../../images/Choreographer/small/<?=$Choreographer_avatar?>" />
          <?php }?>
        </div></td>
    </tr>
   <tr>
      <th>&nbsp;</th>
      <td valign="top"><input type="submit" value="Save" class="form-submit" id="btnSave" />
        <a id="btnreset" class="form-reset" href="<?=base_url()?>index.php/Choreographer/manage_Choreographer">Cancle</a>
      </td>
      <td></td>
    </tr>

  </table>
</form>
