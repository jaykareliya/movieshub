<?php 
$Actor_name = "";
$is_male=1;
$frmAction='save_ACtor';
$Date_Of_Birth="";
$Date_Of_Death ="";
$Birth_Place="";
$Actor_avatar="";

if(isset($_REQUEST['Actor_id']))
{
	$Actor_name =  $Actor_details[0]->Actor_Name;
	$is_male = $Actor_details[0]->Gender;
	$frmAction='update_Actor?actor_id='.$Actor_details[0]->Actor_Id;
	$Date_Of_Birth = date('d/m/Y',strtotime($Actor_details[0]->Actor_DOB));
	$Date_Of_Death = date('d/m/Y',strtotime($Actor_details[0]->Actor_Death_Date));
	$Birth_Place = $Actor_details[0]->Actor_Birth_Place;
	$Actor_avatar = $Actor_details[0]->Actor_Avatar;
}
?>
<script type="text/javascript">
function validateForm()
{
	if($("#txtActorName").val = '')
		return false;
}
$(document).ready(function() {
$("#frmActor").validate();
$(function() {
		var dates = $( "#txtDOB, #txtDOD" ).datepicker({
				defaultDate: "+1w",
				changeMonth: true,
				numberOfMonths: 3,
				dateFormat: 'dd-mm-yy',
				onSelect: function( selectedDate ) {
				var option = this.id == "txtDOB" ? "minDate" : "maxDate",
					instance = $( this ).data( "datepicker" ),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				dates.not( this ).datepicker( "option", option, date);
			}
		});
	});
});

function check_duplicate()
{
	var Id =0;
	if(window.location.href.indexOf("Actor_id") != -1) 
	{
		Id= $.query.get('Actor_id');
	}
	var Actorname = $('#txtActorName').val();
	
	document.getElementById("msgbox").innerHTML='<img src="<?=base_url()?>images/loader_small.gif" />'; 
	
	$.ajax({
		type: "POST",
		url: "<?=base_url()?>/admin/index.php/page/get_duplicate_record?Id="+Id+"&TableName=Actor&FieldName=Actor_Name&FieldValue="+Actorname+"&NameOfId=Actor_Id",
		data:'',
		cache: false,
		success: function(result) {
			if(result != '0')
			{
				$("#msgbox").fadeTo(500,0.3,function() //start fading the messagebox
				{ 
				  $(this).html('<div class="bubble-left" style="margin-left:10px;"></div><div class="bubble-inner">Actor is already exists!</div><div class="bubble-right"></div>').fadeTo(300,1);
				  $('#txtActorName').val('<?=$Actor_name?>');
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
<form name="frmActor" id="frmActor" action=<?php echo $frmAction;?> method="post" onsubmit="return validateForm()" enctype="multipart/form-data" >
  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
    <tr>
      <th valign="top">Actor Name: <span class="red">*</span></th>
      <td><input type="text" class="inp-form required" name="txtActorName" id="txtActorName" maxlength="100" onchange="return check_duplicate();"  value="<?=$Actor_name?>" /></td>
      <td style="padding-left:5px;"><div id="msgbox" style="display:none"></div></td>
    </tr>
   <tr>
      <th valign="top">Is Male:</th>
      <td><?php if($is_male==1) { echo "<input type='checkbox' name='chkIsMale' id='chkIsActive' checked='checked'>";}
	  else echo "<input type='checkbox' name='chkIsMale' id='chkIsActive' unchecked='unchecked'>"
	  ?></td>
      <td></td>
    </tr>
        <tr >
        <th valign="top">Date Of Birth: </th>
        <td>
            <input type="text" name="txtDOB" id="txtDOB" class="indianDate inp-form required" value="<?=$Date_Of_Birth?>">
          </td>
        <td></td>
      </tr>
         <tr >
        <th valign="top">Date Of Death: </th>
        <td>
            <input type="text" name="txtDOD" id="txtDOD" class="indianDate inp-form" value="<?=$Date_Of_Death?>">
          </td>
        <td></td>
      </tr>
        <tr>
      <th valign="top">Birth Place:</th>
      <td><input type="text" class="inp-form required" name="txtBirthPlace" id="txtBirthPlace" maxlength="100"  value="<?=$Birth_Place?>" /></td>
      <td style="padding-left:5px;"><div id="msgbox" style="display:none"></div></td>
    </tr>
    <tr>
      <th valign="top">Image:</th>
      <td><?php echo form_upload('actor_avatar','','class="file_1" id="actor_avatar"');?></td>
      <td><div class="bubble-left"></div>
        <div class="bubble-inner">JPEG, GIF 5MB max per image</div>
        <div class="bubble-right">
          <?php if($Actor_avatar!="") { ?>
          <img alt="" src="../../../images/Actor/small/<?=$Actor_avatar?>" />
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
