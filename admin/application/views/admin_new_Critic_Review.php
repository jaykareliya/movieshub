
<?php 
$Creview_Title = "";

$frmAction='save_creview';
$Movie_Review_Desc ="";
$Movie_Name="";


if(isset($_REQUEST['Creview_Id']))
{
  $Movie_Name = $Creview_details[0]->Movie_Id;
	$Creview_Title =  $Creview_details[0]->Creview_Title;
	$Creview_Desc = $Creview_details[0]->Creview_Desc;
  $Creview_Date = $Creview_details[0]->Creview_Time;
	$frmAction='update_creview?Creview_Id='.$Creview_details[0]->Creview_Id;
		
}
?>
<script type="text/javascript">
function validateForm()
{
	if($("#txt_review_title").val = '')
		return false;
}


function check_duplicate()
{
	var Id =0;
	if(window.location.href.indexOf("Creview_Id") != -1) 
	{
		Id= $.query.get('Creview_Id');
	}
	var Review_Title = $('#txt_review_title').val();
  document.getElementById("msgbox").innerHTML='<img src="<?=base_url()?>images/loader_small.gif" />'; 
		
	$.ajax({
		type: "POST",
		url: "<?=base_url()?>/admin/index.php/page/get_duplicate_record?Id="+Id+"&TableName=critic_review&FieldName=Creview_Title&FieldValue="+Review_Title+"&NameOfId=Movie_News_Id",
		data:'',
		cache: false,
		success: function(result) {
			if(result != '0')
			{
				$("#msgbox").fadeTo(500,0.3,function() //start fading the messagebox
				{ 
				  $(this).html('<div class="bubble-left" style="margin-left:10px;"></div><div class="bubble-inner">Review Title is already exists!</div><div class="bubble-right"></div>').fadeTo(300,1);
				  $('#txt_review_title').val('<?=$Creview_Title?>');
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



<script>
  $(document).ready(function(){
    $("#frmCreview").validate();
  });
  </script>
<form name="frmCreview" id="frmCreview" action=<?php echo $frmAction;?> method="post" onsubmit="return validateForm()">
  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
    <tr >
        <th valign="top">Movie: </th>
        <td>
             <?php echo form_dropdown('ddlMovie',$bind_Movie,$Movie_Name,'id="ddlMovie" onchange="getActor(this.value)" class="ddlSelection required" '); ?> 
          </td>
        <td></td>
      </tr>
    <tr>
      <th valign="top">Review Title: <span class="red">*</span></th>
      <td><input type="text" class="inp-form required" name="txt_review_title" id="txt_review_title" maxlength="100" onchange="return check_duplicate();"  value="<?=$Creview_Title?>" /></td>
      <td style="padding-left:5px;"><div id="msgbox" style="display:none"></div></td>
    </tr>
    
   
        <tr >
        <th valign="top">Review Descritpion: <span class="red">*</span> </th>
        <td>

            <textarea name="txt_review_Description" id="txt_review_Description" class="indianDate inp-form required" ><?php if(isset($Creview_Desc))echo $Creview_Desc; ?></textarea>
          </td>
        <td></td>
      </tr>
      <tr >
        <th valign="top">Review Date</th>
        <td>
            <input type="text" name="txt_review_date" id="txt_review_date" class="indianDate inp-form required" value="<?php if(isset($Creview_Date))echo $Creview_Date; ?>">
          </td>
        <td></td>
      </tr>
          
   <tr>
      <th>&nbsp;</th>
      <td valign="top"><input type="submit" value="Save" class="form-submit" id="btnSave" />
        <a id="btnreset" class="form-reset" href="<?=base_url()?>index.php/Critic_Review/manage_creview">Cancle</a>
      </td>
      <td></td>
    </tr>

  </table>
</form>
</script>
  <script type="text/javascript">
  $(document).ready(function() {

$(function() {
    var dates = $( "#txt_review_date" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 3,
        dateFormat: 'dd-mm-yy',
        onSelect: function( selectedDate ) {
        var option = this.id == "txt_review_date" ? "minDate" : "maxDate",
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
  </script>