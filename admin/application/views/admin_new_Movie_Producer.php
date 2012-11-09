<?php 
$Movie_Id = "";

$frmAction='save_Movie_Producer';
$Producer_Id="";


if(isset($_REQUEST['Movie_Producer_id']))
{
	$Movie_Id =  $Movie_Producer_details[0]->Movie_Id;
	$Producer_Id = $Movie_Producer_details[0]->Producer_Id;
	$frmAction='update_Movie_Producer?Movie_Producer_id='.$Movie_Producer_details[0]->Movie_Producer_Id;

}

?>
<script type="text/javascript">


function getProducer(MovieId)
{

	$.ajax({
				type: "POST",
				url: "<?=base_url()?>/admin/index.php/Producer/bind_Producer?Movie_id="+MovieId,
				data:'',
				cache: false,
				success: function(result) {
				document.getElementById('div_Producer_wrapper').innerHTML=result;
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
             <?php echo form_dropdown('ddlMovie',$bind_Movie,$Movie_Id,'id="ddlMovie" onchange="getProducer(this.value)" class="ddlSelection required" '); ?> 
          </td>
        <td></td>
      </tr>
     <tr >
        <th valign="top">Producer: </th>
        <td>
            <div id="div_Producer_wrapper"><?php echo form_dropdown('ddlProducer',$bind_Producer,$Producer_Id,'id="ddlProducer" class="ddlSelection required" '); ?> </div>
          </td>
        <td></td>
      </tr>
   <tr>
      <th>&nbsp;</th>
      <td valign="top"><input type="submit" value="Save" class="form-submit" id="btnSave" />
        <a id="btnreset" class="form-reset" href="<?=base_url()?>index.php/Movie_Producer/manage_Movie_Producer">Cancle</a>
      </td>
      <td></td>
    </tr>

  </table>
</form>
