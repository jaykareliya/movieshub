<?php 
$Movie_News_Title = "";

$frmAction='save_Movie_News';
$Movie_News_Description="";
$Movie_News_Type ="";
$Movie_News_Image="";


if(isset($_REQUEST['Movie_News_id']))
{
	$Movie_News_Title =  $Movie_News_details[0]->Movie_News_Title;
	$Movie_News_Description = $Movie_News_details[0]->Movie_News_Description;
	$frmAction='update_Movie_News?Movie_News_id='.$Movie_News_details[0]->Movie_News_Id;
	$Movie_News_Type = $Movie_News_details[0]->Movie_News_Type;
	$Movie_News_Image =$Movie_News_details[0]->Movie_News_Image;
	
}
?>
<script type="text/javascript">
function validateForm()
{
	if($("#txtMovie_NewsName").val = '')
		return false;
}
$(document).ready(function() {
$("#frmMovie_News").validate();

});

function check_duplicate()
{
	var Id =0;
	if(window.location.href.indexOf("Movie_News_id") != -1) 
	{
		Id= $.query.get('Movie_News_id');
	}
	var Movie_News_title = $('#txtMovie_NewsTitle').val();
	
	document.getElementById("msgbox").innerHTML='<img src="<?=base_url()?>images/loader_small.gif" />'; 
	
	$.ajax({
		type: "POST",
		url: "<?=base_url()?>/admin/index.php/page/get_duplicate_record?Id="+Id+"&TableName=Movie_News&FieldName=Movie_News_Title&FieldValue="+Movie_News_title+"&NameOfId=Movie_News_Id",
		data:'',
		cache: false,
		success: function(result) {
			if(result != '0')
			{
				$("#msgbox").fadeTo(500,0.3,function() //start fading the messagebox
				{ 
				  $(this).html('<div class="bubble-left" style="margin-left:10px;"></div><div class="bubble-inner">Movie News Title is already exists!</div><div class="bubble-right"></div>').fadeTo(300,1);
				  $('#txtMovie_NewsTitle').val('<?=$Movie_News_Title?>');
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
<form name="frmMovie_News" id="frmMovie_News" action=<?php echo $frmAction;?> method="post" onsubmit="return validateForm()" enctype="multipart/form-data" >
  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
    <tr>
      <th valign="top">Movie News Title: <span class="red">*</span></th>
      <td><input type="text" class="inp-form required" name="txtMovie_NewsTitle" id="txtMovie_NewsTitle" maxlength="100" onchange="return check_duplicate();"  value="<?=$Movie_News_Title?>" /></td>
      <td style="padding-left:5px;"><div id="msgbox" style="display:none"></div></td>
    </tr>
    
   <tr>
      <th valign="top">Movie News Type:</th>
      <td><select id="ddlMovie_Type" class="ddlSelection required" name="ddlMovie_Type">
<option <?php if ($Movie_News_Type == '0') echo ' selected="selected"'; ?> value="">Select</option>
<option <?php if ($Movie_News_Type == '1') echo ' selected="selected"'; ?> value="1">BollyWood</option>
<option <?php if ($Movie_News_Type == '2') echo ' selected="selected"'; ?> value="2">HollyWood</option>
</select></td>
     
    </tr>
        <tr >
        <th valign="top">Movie News Descritpion </th>
        <td>

            <textarea name="txtMovie_NewsDescription" id="txtMovie_NewsDescription" class="indianDate inp-form" ><?=$Movie_News_Description?></textarea>
          </td>
        <td></td>
      </tr>
       <tr>
      <th valign="top">News Image:</th>
      <td><?php echo form_upload('Movie_News_Image','','class="file_1" id="Movie_News_Image"');?></td>
      <td><div class="bubble-left"></div>
        <div class="bubble-inner">JPEG, GIF 5MB max per image</div>
        <div class="bubble-right">
          <?php if($Movie_News_Image!="") { ?>
          <img alt="" src="../../../images/Movie_News/small/<?=$Movie_News_Image?>" />
          <?php }?>
        </div></td>
    </tr>
     
   <tr>
      <th>&nbsp;</th>
      <td valign="top"><input type="submit" value="Save" class="form-submit" id="btnSave" />
        <a id="btnreset" class="form-reset" href="<?=base_url()?>index.php/Actor/manage_Actor">Cancle</a>
      </td>
      <td></td>
    </tr>

  </table>
</form>
