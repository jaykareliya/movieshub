<?php 
$Script_writer_name = "";

$frmAction='save_Script_writer';

$Script_writer_avatar="";

if(isset($_REQUEST['Script_writer_id']))
{
	$Script_writer_name =  $Script_writer_details[0]->Script_Writer_Name;
	
	$frmAction='update_Script_writer?Script_writer_id='.$Script_writer_details[0]->Script_Writer_Id;
	
	
	$Script_writer_avatar = $Script_writer_details[0]->Script_Writer_Avatar;

}
?>
<script type="text/javascript">
function validateForm()
{
	if($("#txtScript_writerName").val = '')
		return false;
}
$(document).ready(function() {
$("#frmScript_writer").validate();


});
function check_duplicate()
{
	var Id =0;
	if(window.location.href.indexOf("Script_writer_id") != -1) 
	{
		Id= $.query.get('Script_writer_id');
	}
	var Script_writername = $('#txtScript_writerName').val();
	document.getElementById("msgbox").innerHTML='<img src="<?=base_url()?>images/loader_small.gif" />'; 
	
	$.ajax({
		type: "POST",
		url: "<?=base_url()?>/admin/index.php/page/get_duplicate_record?Id="+Id+"&TableName=Script_writer&FieldName=Script_writer_Name&FieldValue="+Script_writername+"&NameOfId=Script_writer_Id",
		data:'',
		cache: false,
		success: function(result) {
			if(result != '0')
			{
				$("#msgbox").fadeTo(500,0.3,function() //start fading the messagebox
				{ 
				  $(this).html('<div class="bubble-left" style="margin-left:10px;"></div><div class="bubble-inner">Script Writer is already exists!</div><div class="bubble-right"></div>').fadeTo(300,1);
				  $('#txtScript_writerName').val('<?=$Script_writer_name?>');
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
<form name="frmScript_writer" id="frmScript_writer" action=<?php echo $frmAction;?> method="post" onsubmit="return validateForm()" enctype="multipart/form-data" >
  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
    <tr>
      <th valign="top">Script Writer Name: <span class="red">*</span></th>
      <td><input type="text" class="inp-form required" name="txtScript_writerName" id="txtScript_writerName" maxlength="100" onchange="return check_duplicate();"  value="<?=$Script_writer_name?>" /></td>
      <td style="padding-left:5px;"><div id="msgbox" style="display:none"></div></td>
    </tr>
  
      
    <tr>
      <th valign="top">Image:</th>
      <td><?php echo form_upload('Script_writer_avatar','','class="file_1" id="Script_writer_avatar"');?></td>
      <td><div class="bubble-left"></div>
        <div class="bubble-inner">JPEG, GIF 5MB max per image</div>
        <div class="bubble-right">
          <?php if($Script_writer_avatar!="") { ?>
          <img alt="" src="../../../images/Script_writer/small/<?=$Script_writer_avatar?>" />
          <?php }?>
        </div></td>
    </tr>
   <tr>
      <th>&nbsp;</th>
      <td valign="top"><input type="submit" value="Save" class="form-submit" id="btnSave" />
        <a id="btnreset" class="form-reset" href="<?=base_url()?>index.php/Script_writer/manage_Script_writer">Cancle</a>
      </td>
      <td></td>
    </tr>

  </table>
</form>
