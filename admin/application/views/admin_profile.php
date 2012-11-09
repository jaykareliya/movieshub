
<script type="text/javascript">
$(document).ready(function() 
     { 	
	 $("#frmProfile").validate();
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

<div class="clear"></div>
  <article class="module width_full">
    <header>
      <h3>Admin Profile</h3>
    </header>
	<form name="frmProfile" id="frmProfile" action="update_profile" method="post" enctype="multipart/form-data" >
    <div class="module_content">
	
      <fieldset>
      <label>Name</label>
	  <input type="text" name="txtCompanyName" maxlength="100" id="txtCompanyName" value="<?=$admin_profile[0]->company_name?>" class="required">
      </fieldset>
      <fieldset>
      <label>Address</label>
	  <textarea id="txtAddress" class="txtAddress" name="txtAddress" rows="8"><?=$admin_profile[0]->address?></textarea>
      </fieldset>
	  <fieldset>
      <label>Contact Person</label>
	  <input type="text" maxlength="50" name="txtContactPerson" id="txtContactPerson" value="<?=$admin_profile[0]->contact_person?>" class="required">
      </fieldset>
	  <fieldset>
      <label>Number</label>
	  <input type="text" name="txtNumber" maxlength="15" id="txtNumber" value="<?=$admin_profile[0]->number?>" class="required onlyNumbers">
      </fieldset>
	  <fieldset>
      <label>Fax</label>
	  <input type="text" name="txtFax" id="txtFax" maxlength="20" value="<?=$admin_profile[0]->fax?>" class="required onlyNumbers">
      </fieldset>
	  <fieldset>
      <label>Email</label>
	  <input type="text" name="txtEmail" maxlength="50" id="txtEmail" value="<?=$admin_profile[0]->email?>" class="required">
      </fieldset>
      <div class="clear"></div>
    </div>
    <footer>
      <div class="submit_link" style="float:none; margin-left:3%">
        <input type="submit" value="Update" id="btnUpdate" class="alt_btn" />
        <input type="button" value="Cancle" id="btnCancle" onclick="location.replace('manage_profile')">
      </div>
    </footer>
	</form>
  </article>
  <!-- end of post new article -->
  <div class="spacer"></div>