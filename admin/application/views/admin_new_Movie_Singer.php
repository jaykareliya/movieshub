<?php 
$Movie_Id = "";

$frmAction='save_Movie_Singer';
$Singer_Id="";


if(isset($_REQUEST['Movie_Singer_id']))
{
	$Movie_Id =  $Movie_Singer_details[0]->Movie_Id;
	$Singer_Id = $Movie_Singer_details[0]->Singer_Id;
	$frmAction='update_Movie_Singer?Movie_Singer_id='.$Movie_Singer_details[0]->Movie_Singer_Id;

}

?>
<script type="text/javascript">


function getSinger(MovieId)
{

	$.ajax({
				type: "POST",
				url: "<?=base_url()?>/admin/index.php/Singer/bind_Singer?Movie_id="+MovieId,
				data:'',
				cache: false,
				success: function(result) {
				document.getElementById('div_Singer_wrapper').innerHTML=result;
				},
				 error:function (xhr, ajaxOptions, thrownError){
                    alert(xhr.status);
                    alert(thrownError);
                }    
   
		});
}
</script>
<script>
  $(document).ready(function(){
    $("#frmMovie").validate();
  });
  </script>
<form name="frmMovie" id="frmMovie" action=<?php echo $frmAction;?> method="post" onsubmit="return validateForm()" enctype="multipart/form-data" >
  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
    
         <tr >
        <th valign="top">Movie: </th>
        <td>
             <?php echo form_dropdown('ddlMovie',$bind_Movie,$Movie_Id,'id="ddlMovie" onchange="getSinger(this.value)" class="ddlSelection required" '); ?> 
          </td>
        <td></td>
      </tr>
     <tr >
        <th valign="top">Singer: </th>
        <td>
            <div id="div_Singer_wrapper"><?php echo form_dropdown('ddlSinger',$bind_Singer,$Singer_Id,'id="ddlSinger" class="ddlSelection required" '); ?> </div>
          </td>
        <td></td>
      </tr>
   <tr>
      <th>&nbsp;</th>
      <td valign="top"><input type="submit" value="Save" class="form-submit" id="btnSave" />
        <a id="btnreset" class="form-reset" href="<?=base_url()?>index.php/Movie_Singer/manage_Movie_Singer">Cancle</a>
      </td>
      <td></td>
    </tr>

  </table>
</form>
