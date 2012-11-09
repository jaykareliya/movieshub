<script type="text/javascript">
$(document).ready(function(){
	$("#frmUser").validate();
	$(".txtAddress").keydown(function(event) {
		var charLength = $(this).val().length;
		if(charLength+1 > 200)
		{
			return false
		}
		else
		{
			return true;
		}
	});
	$(".onlyNumbers").keydown(function(event) {
	
   if(event.shiftKey)
        event.preventDefault();
   if (event.keyCode == 46 || event.keyCode == 8) {
   }
   else {
        if (event.keyCode < 95) {
          if (event.keyCode < 48 || event.keyCode > 57) {
                event.preventDefault();
          }
        } 
        else {
              if (event.keyCode < 96 || event.keyCode > 105  ) {
        if(event.keyCode == 190 && event.keyCode == 110)
        {
                       event.preventDefault();
      }
              }
        }
      }
   });
});
</script>

<form action="update_user?id=<?=$user_details[0]->id?>" name="frmUser" id="frmUser" method="post" enctype="multipart/form-data">
  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
<!--    <tr>
      <th valign="top">User Name: <span class="red">*</span></th>
      <td><input type="text" name="txtUserName" maxlength="100" readonly="readonly" value="<?=$user_details[0]->user_name?>" class="inp-form required"></td>
      <td style="padding-left:5px;"><div id="msgbox" style="display:none"></div></td>
    </tr>
    <tr>
      <th valign="top">First Name: <span class="red">*</span></th>
      <td><input type="text" name="txtFirstName" maxlength="100" value="<?=$user_details[0]->first_name?>" class="inp-form required"></td>
      <td style="padding-left:5px;"><div id="msgbox" style="display:none"></div></td>
    </tr>
    <tr>
      <th valign="top">Last Name: <span class="red">*</span></th>
      <td><input type="text" name="txtLastName" maxlength="100" value="<?=$user_details[0]->last_name?>" class="inp-form required"></td>
      <td style="padding-left:5px;"><div id="msgbox" style="display:none"></div></td>
    </tr>
    <tr>
      <th valign="top">Phone: <span class="red">*</span></th>
      <td><input type="text" maxlength="50" name="txtphone" value="<? if($user_details[0]->phone != 0){ echo $user_details[0]->phone;}?>" class="inp-form required onlyNumbers"></td>
      <td style="padding-left:5px;"><div id="msgbox" style="display:none"></div></td>
    </tr>-->
    <tr>
      <th valign="top">Email Id: <span class="red">*</span></th>
      <td><input type="text" name="txtEmailId" maxlength="100" readonly="readonly" value="<?=$user_details[0]->email?>" class="inp-form required email"></td>
      <td style="padding-left:5px;"><div id="msgbox" style="display:none"></div></td>
    </tr>
<!--    <tr>
      <th valign="top">Comapny: </th>
      <td><input type="text" name="txtCompany"  maxlength="100" value="<?=$user_details[0]->company?>" class="inp-form"></td>
      <td style="padding-left:5px;"><div id="msgbox" style="display:none"></div></td>
    </tr>
    <tr>
      <th valign="top">Address:</th>
      <td><textarea name="txtAddress" rows="12" class="form-textarea txtAddress"><?=$user_details[0]->address?>
</textarea>
      </td>
      <td></td>
    </tr>-->
    <tr>
      <th>&nbsp;</th>
      <td valign="top"><input type="submit" value="Save" class="form-submit" id="btnSave" onClick="TestFileType(this.form.sub_category_image.value, ['gif', 'jpg', 'png', 'jpeg']);" />
        <a id="btnreset" class="form-reset" href="<?=base_url()?>index.php/page/manage_user">Cancle</a> </td>
      <td></td>
    </tr>
  </table>
</form>
