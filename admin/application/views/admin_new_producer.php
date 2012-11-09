<?php 
$Producer_name = "";
$is_male=1;
$frmAction='save_Producer';
$Date_Of_Birth="";
$Date_Of_Death ="";
$Birth_Place="";
$Producer_avatar="";

if(isset($_REQUEST['Producer_id']))
{
	$Producer_name =  $Producer_details[0]->Producer_Name;
	
	$frmAction='update_Producer?Producer_id='.$Producer_details[0]->Producer_Id;
	$Date_Of_Birth = date('d/m/Y',strtotime($Producer_details[0]->Producer_DOB));

	$Date_Of_Death = date('d/m/Y',strtotime($Producer_details[0]->Producer_Death_Date));
	
	$Producer_avatar = $Producer_details[0]->Producer_Avatar;

}
?>
<script type="text/javascript">
function validateForm()
{
	if($("#txtProducerName").val = '')
		return false;
}
$(document).ready(function() {
$("#frmProducer").validate();
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
	if(window.location.href.indexOf("Producer_id") != -1) 
	{
		Id= $.query.get('Producer_id');
	}
	var Producername = $('#txtProducerName').val();
	document.getElementById("msgbox").innerHTML='<img src="<?=base_url()?>images/loader_small.gif" />'; 
	
	$.ajax({
		type: "POST",
		url: "<?=base_url()?>/admin/index.php/page/get_duplicate_record?Id="+Id+"&TableName=Producer&FieldName=Producer_Name&FieldValue="+Producername+"&NameOfId=Producer_id",
		data:'',
		cache: false,
		success: function(result) {
			if(result != '0')
			{
				$("#msgbox").fadeTo(500,0.3,function() //start fading the messagebox
				{ 
				  $(this).html('<div class="bubble-left" style="margin-left:10px;"></div><div class="bubble-inner">Producer is already exists!</div><div class="bubble-right"></div>').fadeTo(300,1);
				  $('#txtProducerName').val('<?=$Producer_name?>');
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
<form name="frmProducer" id="frmProducer" action=<?php echo $frmAction;?> method="post" onsubmit="return validateForm()" enctype="multipart/form-data" >
  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
    <tr>
      <th valign="top">Producer Name: <span class="red">*</span></th>
      <td><input type="text" class="inp-form required" name="txtProducerName" id="txtProducerName" maxlength="100" onchange="return check_duplicate();"  value="<?=$Producer_name?>" /></td>
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
      <td><?php echo form_upload('Producer_avatar','','class="file_1" id="Producer_avatar"');?></td>
      <td><div class="bubble-left"></div>
        <div class="bubble-inner">JPEG, GIF 5MB max per image</div>
        <div class="bubble-right">
          <?php if($Producer_avatar!="") { ?>
          <img alt="" src="../../../images/Producer/small/<?=$Producer_avatar?>" />
          <?php }?>
        </div></td>
    </tr>
   <tr>
      <th>&nbsp;</th>
      <td valign="top"><input type="submit" value="Save" class="form-submit" id="btnSave" />
        <a id="btnreset" class="form-reset" href="<?=base_url()?>index.php/Producer/manage_Producer">Cancle</a>
      </td>
      <td></td>
    </tr>

  </table>
</form>
