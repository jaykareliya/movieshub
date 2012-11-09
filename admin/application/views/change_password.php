<script type="text/javascript">	
$(document).ready(function() {
	$("#frm1").validate({
		rules: {
			retype_newpass: { 
                required: true, equalTo: "#newpass"
          	}
		},
		messages: {
			equalTo: "*"
		}
	});
});	

</script>
  
<?php if ($this->session->flashdata('success')){ 
		?>
		<div id='message-green'>
    <table border='0' width='100%' cellpadding='0' cellspacing='0'>
      <tr>
        <td class='green-left'><?php if($this->session->flashdata('success')){echo $this->session->flashdata('success');} ?></td>
        <td class='green-right'><img src='<?=base_url()?>images/table/icon_close_green.gif'   alt='' /></td>
      </tr>
    </table>
  </div>
		<?php
		}?>
<?php if ($this->session->flashdata('error')){ 
		?>
		<div id="message-red">
				<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td class="red-left"><?=$this->session->flashdata('error')?></a></td>
					<td class="red-right"><a class="close-red"><img src="<?=base_url()?>images/table/icon_close_red.gif"   alt="" /></a></td>
				</tr>
				</table>
		</div>
		<?php
         }?>  

<form action="<?=base_url()?>/admin/index.php/page/change_password" id="frm1" name="frm1" method="post" enctype="multipart/form-data">
<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
    <tr>
      <th valign="top">Old Password: <span class="red">*</span></th>
      <td><?php echo form_password('oldpass','','class="inp-form required" id="oldpass"');  ?></td>
    </tr>
	
	<tr>
      <th valign="top">New Password: <span class="red">*</span></th>
      <td><?php echo form_password('newpass','','class="inp-form required" id="newpass"');  ?></td>
    </tr>
	
	<tr>
      <th valign="top">Confirm Passowrd: <span class="red">*</span></th>
      <td><?php echo form_password('retype_newpass','','class="inp-form required" id="retype_newpass"');  ?></td>
    </tr>
	
	<tr>
      <th>&nbsp;</th>
      <td valign="top"><input type="submit" value="Save" class="form-submit" id="btnSave" /></td>
    </tr>
</table>
</form>