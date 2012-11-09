<?php 
$Movie_Type_name = "";

$frmAction='save_Movie_Type';


if(isset($_REQUEST['Movie_Type_id']))
{
	$Movie_Type_name =  $Movie_Type_details[0]->Movie_Type_Name;
	
	$frmAction='update_Movie_Type?Movie_Type_id='.$Movie_Type_details[0]->Movie_Type_Id;
	
	
	
}
?>
<script type="text/javascript">
function validateForm()
{
	if($("#txtMovie_TypeName").val = '')
		return false;
}
$(document).ready(function() {
$("#frmMovie_Type").validate();


});
function check_duplicate()
{
	var Id =0;
	if(window.location.href.indexOf("Movie_Type_id") != -1) 
	{
		Id= $.query.get('Movie_Type_id');
	}
	var Movie_Typename = $('#txtMovie_TypeName').val();
	document.getElementById("msgbox").innerHTML='<img src="<?=base_url()?>images/loader_small.gif" />'; 
	
	$.ajax({
		type: "POST",
		url: "<?=base_url()?>/admin/index.php/page/get_duplicate_record?Id="+Id+"&TableName=Movie_Type&FieldName=Movie_Type_Name&FieldValue="+Movie_Typename+"&NameOfId=Movie_Type_Id",
		data:'',
		cache: false,
		success: function(result) {
			if(result != '0')
			{
				$("#msgbox").fadeTo(500,0.3,function() //start fading the messagebox
				{ 
				  $(this).html('<div class="bubble-left" style="margin-left:10px;"></div><div class="bubble-inner">Movie Type is already exists!</div><div class="bubble-right"></div>').fadeTo(300,1);
				  $('#txtMovie_TypeName').val('<?=$Movie_Type_name?>');
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

<form name="frmMovie_Type" id="frmMovie_Type" action=<?php echo $frmAction;?> method="post" onsubmit="return validateForm()" enctype="multipart/form-data" >
  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
    <tr>
      <th valign="top">Movie Type Name: <span class="red">*</span></th>
      <td><input type="text" class="inp-form required" name="txtMovie_TypeName" id="txtMovie_TypeName" maxlength="100" onchange="return check_duplicate();"  value="<?=$Movie_Type_name?>" /></td>
      <td style="padding-left:5px;"><div id="msgbox" style="display:none"></div></td>
    </tr>
  
      
   
   <tr>
      <th>&nbsp;</th>
      <td valign="top"><input type="submit" value="Save" class="form-submit" id="btnSave" />
        <a id="btnreset" class="form-reset" href="<?=base_url()?>index.php/Movie_Type/manage_Movie_Type">Cancle</a>
      </td>
      <td></td>
    </tr>

  </table>
</form>
