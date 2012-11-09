<?php 
$Lyrics_name = "";

$frmAction='save_Lyrics';

$Lyrics_avatar="";

if(isset($_REQUEST['Lyrics_id']))
{
	$Lyrics_name =  $Lyrics_details[0]->Lyrics_Name;
	
	$frmAction='update_Lyrics?Lyrics_id='.$Lyrics_details[0]->Lyrics_Id;
	
	
	$Lyrics_avatar = $Lyrics_details[0]->Lyrics_Avatar;

}
?>
<script type="text/javascript">
function validateForm()
{
	if($("#txtLyricsName").val = '')
		return false;
}
$(document).ready(function() {
$("#frmLyrics").validate();


});
function check_duplicate()
{
	var Id =0;
	if(window.location.href.indexOf("Lyrics_id") != -1) 
	{
		Id= $.query.get('Lyrics_id');
	}
	var Lyricsname = $('#txtLyricsName').val();
	document.getElementById("msgbox").innerHTML='<img src="<?=base_url()?>images/loader_small.gif" />'; 
	
	$.ajax({
		type: "POST",
		url: "<?=base_url()?>/admin/index.php/page/get_duplicate_record?Id="+Id+"&TableName=Lyrics&FieldName=Lyrics_Name&FieldValue="+Lyricsname+"&NameOfId=Lyrics_Id",
		data:'',
		cache: false,
		success: function(result) {
			if(result != '0')
			{
				$("#msgbox").fadeTo(500,0.3,function() //start fading the messagebox
				{ 
				  $(this).html('<div class="bubble-left" style="margin-left:10px;"></div><div class="bubble-inner">Lyrics is already exists!</div><div class="bubble-right"></div>').fadeTo(300,1);
				  $('#txtLyricsName').val('<?=$Lyrics_name?>');
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
<form name="frmLyrics" id="frmLyrics" action=<?php echo $frmAction;?> method="post" onsubmit="return validateForm()" enctype="multipart/form-data" >
  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
    <tr>
      <th valign="top">Lyrics Name: <span class="red">*</span></th>
      <td><input type="text" class="inp-form required" name="txtLyricsName" id="txtLyricsName" maxlength="100" onchange="return check_duplicate();"  value="<?=$Lyrics_name?>" /></td>
      <td style="padding-left:5px;"><div id="msgbox" style="display:none"></div></td>
    </tr>
  
      
    <tr>
      <th valign="top">Image:</th>
      <td><?php echo form_upload('Lyrics_avatar','','class="file_1" id="Lyrics_avatar"');?></td>
      <td><div class="bubble-left"></div>
        <div class="bubble-inner">JPEG, GIF 5MB max per image</div>
        <div class="bubble-right">
          <?php if($Lyrics_avatar!="") { ?>
          <img alt="" src="../../../images/Lyrics/small/<?=$Lyrics_avatar?>" />
          <?php }?>
        </div></td>
    </tr>
   <tr>
      <th>&nbsp;</th>
      <td valign="top"><input type="submit" value="Save" class="form-submit" id="btnSave" />
        <a id="btnreset" class="form-reset" href="<?=base_url()?>index.php/Lyrics/manage_Lyrics">Cancle</a>
      </td>
      <td></td>
    </tr>

  </table>
</form>
