<?php 
$Singer_name = "";
$is_male=1;
$frmAction='save_Singer';
$Date_Of_Birth="";
$Date_Of_Death ="";
$Birth_Place="";
$Singer_avatar="";

if(isset($_REQUEST['Singer_id']))
{
	$Singer_name =  $Singer_details[0]->Singer_Name;
	
	$frmAction='update_Singer?Singer_id='.$Singer_details[0]->Singer_Id;

	$Date_Of_Birth = date('d/m/Y',strtotime($Singer_details[0]->Singer_DOB));
	$Date_Of_Death = date('d/m/Y',strtotime($Singer_details[0]->Singer_Death_Date));;
	
	$Singer_avatar = $Singer_details[0]->Singer_Avatar;

}
?>
<script type="text/javascript">
function validateForm()
{
	if($("#txtSingerName").val = '')
		return false;
}
$(document).ready(function() {
$("#frmSinger").validate();
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
	if(window.location.href.indexOf("Singer_id") != -1) 
	{
		Id= $.query.get('Singer_id');
	}
	var Singername = $('#txtSingerName').val();
	document.getElementById("msgbox").innerHTML='<img src="<?=base_url()?>images/loader_small.gif" />'; 
	
	$.ajax({
		type: "POST",
		url: "<?=base_url()?>/admin/index.php/page/get_duplicate_record?Id="+Id+"&TableName=Singer&FieldName=Singer_Name&FieldValue="+Singername+"&NameOfId=Singer_id",
		data:'',
		cache: false,
		success: function(result) {
			if(result != '0')
			{
				$("#msgbox").fadeTo(500,0.3,function() //start fading the messagebox
				{ 
				  $(this).html('<div class="bubble-left" style="margin-left:10px;"></div><div class="bubble-inner">Singer is already exists!</div><div class="bubble-right"></div>').fadeTo(300,1);
				  $('#txtSingerName').val('<?=$Singer_name?>');
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
<form name="frmSinger" id="frmSinger" action=<?php echo $frmAction;?> method="post" onsubmit="return validateForm()" enctype="multipart/form-data" >
  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
    <tr>
      <th valign="top">Singer Name: <span class="red">*</span></th>
      <td><input type="text" class="inp-form required" name="txtSingerName" id="txtSingerName" maxlength="100" onchange="return check_duplicate();"  value="<?=$Singer_name?>" /></td>
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
            <input type="text" name="txtDOB" id="txtDOB" class="indianDate inp-form" value="<?=$Date_Of_Birth?>">
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
      <th valign="top">Image:</th>
      <td><?php echo form_upload('Singer_avatar','','class="file_1" id="Singer_avatar"');?></td>
      <td><div class="bubble-left"></div>
        <div class="bubble-inner">JPEG, GIF 5MB max per image</div>
        <div class="bubble-right">
          <?php if($Singer_avatar!="") { ?>
          <img alt="" src="../../../images/Singer/small/<?=$Singer_avatar?>" />
          <?php }?>
        </div></td>
    </tr>
   <tr>
      <th>&nbsp;</th>
      <td valign="top"><input type="submit" value="Save" class="form-submit" id="btnSave" />
        <a id="btnreset" class="form-reset" href="<?=base_url()?>index.php/Singer/manage_Singer">Cancle</a>
      </td>
      <td></td>
    </tr>

  </table>
</form>
