<?php 
$Movie_Id = "";

$frmAction='save_Movie_Director';
$Director_Id="";


if(isset($_REQUEST['Movie_Director_id']))
{
	$Movie_Id =  $Movie_Director_details[0]->Movie_Id;
	$Director_Id = $Movie_Director_details[0]->Director_Id;
	$frmAction='update_Movie_Director?Movie_Director_id='.$Movie_Director_details[0]->Movie_Director_Id;

}

?>
<script type="text/javascript">


function getDirector(MovieId)
{

	$.ajax({
				type: "POST",
				url: "<?=base_url()?>/admin/index.php/Director/bind_Director?Movie_id="+MovieId,
				data:'',
				cache: false,
				success: function(result) {
				document.getElementById('div_Director_wrapper').innerHTML=result;
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
             <?php echo form_dropdown('ddlMovie',$bind_Movie,$Movie_Id,'id="ddlMovie" onchange="getDirector(this.value)" class="ddlSelection required" '); ?> 
          </td>
        <td></td>
      </tr>
     <tr >
        <th valign="top">Director: </th>
        <td>
            <div id="div_Director_wrapper"><?php echo form_dropdown('ddlDirector',$bind_Director,$Director_Id,'id="ddlDirector" class="ddlSelection required" '); ?> </div>
          </td>
        <td></td>
      </tr>
   <tr>
      <th>&nbsp;</th>
      <td valign="top"><input type="submit" value="Save" class="form-submit" id="btnSave" />
        <a id="btnreset" class="form-reset" href="<?=base_url()?>index.php/Movie_Director/manage_Movie_Director">Cancle</a>
      </td>
      <td></td>
    </tr>

  </table>
</form>
