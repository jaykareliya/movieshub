<?php 
$Movie_name = "";

$frmAction='save_Movie';
$Movie_Release_Date="";
$Movie_Type ="";
$Movie_url="";
$Movie_Image="";
$Movie_Description="";
$movie_duration="";
$movie_Description="";
$is_theater=1;
if(isset($_REQUEST['Movie_id']))
{
	$Movie_name =  $Movie_details[0]->Movie_Name;
	$Movie_Release_Date = date('d/m/Y',strtotime($Movie_details[0]->Movie_Release_Date));

	$frmAction='update_Movie?Movie_id='.$Movie_details[0]->Movie_Id;
	$Movie_Type = $Movie_details[0]->Movie_Type;
	$Movie_url = $Movie_details[0]->Movie_Url;
	$Movie_Description = $Movie_details[0]->Movie_Description;
	$Movie_Image = $Movie_details[0]->Movie_Image;
	$movie_duration = $Movie_details[0]->Movie_Duration;
	$Movie_Description=$Movie_details[0]->Movie_Description;
	$is_theater=$Movie_details[0]->Movie_In_Theater;
}
?>
<script type="text/javascript">
function validateForm()
{
	if($("#txtMovieName").val = '')
		return false;
}
$(document).ready(function() {
$("#frmMovie").validate();
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
	if(window.location.href.indexOf("Movie_id") != -1) 
	{
		Id= $.query.get('Movie_id');
	}
	var Moviename = $('#txtMovieName').val();
	
	document.getElementById("msgbox").innerHTML='<img src="<?=base_url()?>images/loader_small.gif" />'; 
	
	$.ajax({
		type: "POST",
		url: "<?=base_url()?>/admin/index.php/page/get_duplicate_record?Id="+Id+"&TableName=Movie&FieldName=Movie_Name&FieldValue="+Moviename+"&NameOfId=Movie_Id",
		data:'',
		cache: false,
		success: function(result) {
			if(result != '0')
			{
				$("#msgbox").fadeTo(500,0.3,function() //start fading the messagebox
				{ 
				  $(this).html('<div class="bubble-left" style="margin-left:10px;"></div><div class="bubble-inner">Movie is already exists!</div><div class="bubble-right"></div>').fadeTo(300,1);
				  $('#txtMovieName').val('<?=$Movie_name?>');
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
<form name="frmMovie" id="frmMovie" action=<?php echo $frmAction;?> method="post" onsubmit="return validateForm()" enctype="multipart/form-data" >
  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
    <tr>
      <th valign="top">Movie Name: <span class="red">*</span></th>
      <td><input type="text" class="inp-form required" name="txtMovieName" id="txtMovieName" maxlength="100" onchange="return check_duplicate();"  value="<?=$Movie_name?>" /></td>
      <td style="padding-left:5px;"><div id="msgbox" style="display:none"></div></td>
    </tr>
   
        <tr >
        <th valign="top">Release Date: </th>
        <td>
            <input type="text" name="txtDOB" id="txtDOB" class="indianDate inp-form" value="<?=$Movie_Release_Date?>">
          </td>
        <td></td>
      </tr>
         <tr >
        <th valign="top">Movie Type: </th>
        <td>
             <?php echo form_dropdown('ddlMovie_Type',$bind_Movie_Type,$Movie_Type,'id="ddlMovie_Type" class="ddlSelection required" '); ?> 
          </td>
        <td></td>
      </tr>
        <tr>
      <th valign="top">Movie Url:</th>
      <td><input type="text" name="txtMovie_url" id="txtMovie_url" class="inp-form" value="<?=$Movie_url?>"></td>
      <td style="padding-left:5px;"><div id="msgbox" style="display:none"></div></td>
    </tr>
     <tr>
      <th valign="top">Movie Duration:</th>
      <td><input type="text" class="inp-form" name="txtMovie_Duration" id="txtMovie_Duration" maxlength="100"  value="<?=$movie_duration?>" /></td>
      <td style="padding-left:5px;"><div id="msgbox" style="display:none"></div></td>
    </tr>
     <tr>
      <th valign="top">Movie Description:</th>
      <td><textarea class="inp-form" name="txtMovie_Description" id="txtMovie_Description" maxlength="100"  value="<?=$Movie_Description?>" ></textarea></td>
      <td style="padding-left:5px;"><div id="msgbox" style="display:none"></div></td>
    </tr>
    <tr>
      <th valign="top">Movie Image:</th>
      <td><?php echo form_upload('Movie_Image','','class="file_1" id="Movie_Image"');?></td>
      <td><div class="bubble-left"></div>
        <div class="bubble-inner">JPEG, GIF 5MB max per image</div>
        <div class="bubble-right">
          <?php if($Movie_Image!="") { ?>
          <img alt="" src="../../../images/Movie/small/<?=$Movie_Image?>" />
          <?php }?>
        </div></td>
    </tr>
     <tr>
      <th valign="top">In theater:</th>
      <td><?php if($is_theater==1) { echo "<input type='checkbox' name='chkIntheater' id='chkIntheater' checked='checked'>";}
	  else echo "<input type='checkbox' name='chkIntheater' id='chkIntheater' unchecked='unchecked'>"
	  ?></td>
      <td></td>
    </tr>
   <tr>
      <th>&nbsp;</th>
      <td valign="top"><input type="submit" value="Save" class="form-submit" id="btnSave" />
        <a id="btnreset" class="form-reset" href="<?=base_url()?>index.php/Movie/manage_Movie">Cancle</a>
      </td>
      <td></td>
    </tr>

  </table>
</form>
