<script type="text/javascript">
  $(document).ready(function(){
    $("#form1").validate();

  if($("#err").show())
  {
   setTimeout(function() {
  $("#err").fadeOut('slow');
   }, 5000); 
  }
  
  });
</script>
<style type="text/css">
#notices {
}

#notices div {
 border-radius: 5px;
 -moz-border-radius: 5px;
 -webkit-border-radius: 5px;
 padding: 4px 15px 4px 15px;
 text-align: center;
 display: inline;
 position: absolute;
 left: 50%;
 top: 20%;
 margin-left: -200px;
 width: 400px;
 z-index: 995;
}


#notices div.error {
 background-color: #b60000;
 color: #fff;
}

#notices div.notice {
 background-color: #52ad40;
 color: #fff;
}

#login_form {
 margin: 0 auto;
 width: 475px;
 padding: 20px;
 margin-top: 120px;
 background: url(../images/login.gif) no-repeat;
 height: 298px;
 position: relative;
}
.warning {background-color: #b60000; color: #fff; height:24px; -moz-border-radius: 5px;
 -webkit-border-radius: 5px; position: fixed; top:5px; width:450px; line-height:23px; }
</style>
<!--  start loginbox ................................................................................. -->
<div id="notices"></div>
<div id="loginbox">
<div align="center"><?php if ($this->session->flashdata('error')){ ?><div id="err" class="err warning"><?php echo $this->session->flashdata('error'); ?></div><?php } ?></div>
  <!--  start login-inner -->
  <div id="login-inner"> <?php echo form_open_multipart('user/chk_login','name="form1" id="form1" class="validate" enctype="multipart/form-data"'); ?>
    <table border="0" cellpadding="0" cellspacing="0">
      <tr>
        <th><label for="username">Username</label></th>
        <td><?php 
								$udata = array('name'=>'username','id'=>'username','class'=>'login-inp required email','size'=>15);
								echo form_input($udata);?></td>
      </tr>
      <tr>
        <th><label for="password">Password</label></th>
        <td><?php 
								$pdata = array('name'=>'password','id'=>'password','class'=>'login-inp required','size'=>15);
								echo form_password($pdata);?></td>
      </tr>
      <tr>
        <th></th>
        <td valign="top"><input type="checkbox" class="checkbox-size" id="login-check" />
          <label for="login-check">Remember me</label></td>
      </tr>
      <tr>
        <th></th>
        <td><?php 
								$pdata = array('name'=>'password','id'=>'p','class'=>'textfield required','size'=>15);
								echo form_submit('submit','login','class="submit-login"');?></td>
      </tr>
    </table>
    <?php echo form_close();?> </div>
  <!--  end login-inner -->
  <div class="clear"></div>
</div>
<!--  end loginbox -->
