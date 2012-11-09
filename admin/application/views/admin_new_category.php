<?php 
$category_name = "";
$is_active=1;
$frmAction='save_category';

if(isset($_REQUEST['id']))
{
	$category_name =  $category_details[0]->Name;
	$is_active = $category_details[0]->Is_active;
	$frmAction='update_category?id='.$category_details[0]->Id;
}
?>
<script type="text/javascript">
function validateForm()
{
	if($("#txtCategoryName").val = '')
		return false;
}
$(document).ready(function() {
$("#frmCategory").validate();
function check_duplicate()
{
	var Id =0;
	if(window.location.href.indexOf("id") != -1) 
	{
		Id= $.query.get('id');
	}
	var categoryname = $('#txtCategoryName').val();
	document.getElementById("msgbox").innerHTML='<img src="<?=base_url()?>images/loader_small.gif" />'; 
	
	$.ajax({
		type: "POST",
		url: "http://www.citypulse.com/admin/index.php/page/get_duplicate_record?Id="+Id+"&TableName=Category&FieldName=Name&FieldValue="+categoryname+"&NameOfId=id",
		data:'',
		cache: false,
		success: function(result) {
			if(result != '0')
			{
				$("#msgbox").fadeTo(500,0.3,function() //start fading the messagebox
				{ 
				  $(this).html('<div class="bubble-left" style="margin-left:10px;"></div><div class="bubble-inner">Category is already exists!</div><div class="bubble-right"></div>').fadeTo(300,1);
				  $('#txtCategoryName').val('<?=$category_name?>');
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
});
</script>

<form class="cssform" name="property" id="property" method="POST" action="save_video"  enctype="multipart/form-data" >
	<table>
	<tr>
		<td>Select Video :</td>
		<td><input type="file" id="video" name="video" ></td>
	</tr>
	<tr>
		<td> <input type="submit" id="button" name="submit" value="Submit" /></td>
	</tr>
</table>
</form>