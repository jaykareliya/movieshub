
<?php
$action = "user_details/".$id."?edit";
$rdnly = "readonly";
$disabled = "disabled";
$disp = "none";

if(isset($_GET['edit']))
{
	$action = "update_user_details/".$id;
	$rdnly = "";
	$disabled= "";
	$disp = "block";
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en-US" xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
<title> <?php echo $title; ?></title>


<link href="<?=base_url()?>css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" href="<?=base_url()?>admin/css/jquery.ui.all.css">
<!--	<link rel="stylesheet" href="<?=base_url()?>admin/css/demos.css">
	<!--[if IE 6]>
		<link rel="stylesheet" href="css/ie6.css" type="text/css" media="all" />
	<![endif]-->
<!--	<style type="text/css">
* { font-family: Verdana; font-size: 96%; }
label { width: 10em; float: left; }
label.error { float: none; color: red; padding-left: .5em; vertical-align: top; }
p { clear: both; }
.submit { margin-left: 12em; }
em { font-weight: bold; padding-right: 1em; vertical-align: top; }
</style>
-->

<style type="text/css">
label.error { float: none; color: red; padding-left: .5em; vertical-align: top; }	
</style>


</head>

<body>

<!-- Shell -->
<div class="contenthome">
  <!-- Header -->
  <?php  $this->load->view('include/header.php'); ?>
  <!-- end Header -->
  <!-- Start: Main -->
 <div class="maincontent">
    <div class="container-fluid">
      <div class="row-fluid">
	  
        <div class="span3">
			  <!--content_middle-->
			  <?php $this->load->view('include/content_middle'); ?>
			  <!--end content_middle-->
        </div>

<!--start content_right-->

		<div class="span9">

		
			<form class="form-horizontal" id="form" name="form" enctype="multipart/form-data"  method="post" action="<?=base_url()?>index.php/user/<?=$action?>">



			 					<div class="row-fluid" >
									<div class="well well-small">
										<div class="span4">User Details</div>
									</div><!--end well well-small-->
								</div><!--end row fliud-->
								
						<div class="row-fluid">
							<?php if ($this->session->flashdata('success')){ 
							?>	
			    		<div class="alert alert-success">
							<?=$this->session->flashdata('success')?>
						</div>
  
							<?php
							}?>
							<?php if ($this->session->flashdata('error')){ 
							?>
						<div class="alert alert-error">
							<?=$this->session->flashdata('error')?>
						</div>
						<?php
						 }?>
						</div>
						
						
						<div class="article reg_form">
										<input type="hidden" name="id" value="<?=$id?>"> 
									  <div class="control-group">
											<label class="control-label" for="first_name">First name :</label>
											<div class="controls">
												<input type="text" id="first_name" <?=$rdnly?> placeholder="First name" class="required" name="first_name" minlength="3" maxlength="50" value="<?=$first_name?>">
											</div>
								    	</div>



									<div class="control-group">
										<label class="control-label" for="last_name">Last name :</label>
											<div class="controls">
												<input type="text" id="last_name" <?=$rdnly?> placeholder="Last name" class="required" name="last_name" minlength="3"  maxlength="50" value="<?=$last_name?>">
											</div>
									</div>


									<div class="control-group">
										<label class="control-label" for="gender">Gender :</label>
											<div class="controls">
												<?php 
												
												if($gender==1)
												{
													$check = "checked";
												}
												else
												{
													$check = "";
												}
												
												?>												
												<input id="gender_m" class="reg_radio" <?=$check?> <?=$disabled?> type="radio" value="1" name="gender"> Male
												<?php
												if($gender==2)
												{
													$check1 = "checked";
												}
												else
												{
													$check1 = "";
												}
												?>
												<input id="gender_f" class="reg_radio" <?=$check1?> <?=$disabled?> type="radio" value="2" name="gender"> Female
												<label id="forgender" class="error" for="gender" generated="true"></label>
												
											</div>
									</div>


									<div class="control-group">
										<label class="control-label" for="year">Date of birth :</label>
											<div class="controls">
												<input type="text" <?=$rdnly?> name="txtDOB" id="txtDOB" class="indianDate inp-form required" placeholder="Date of birth" value="<?=$dob?>">
											</div>
									</div>


									<div class="control-group">
										<label class="control-label" for="image">Image :</label>
											<?php if($image): ?>
											
												<img src="<?=base_url()?>images\User\medium\<?=$image?>" class="pro_img">
											
											<?php else:?>
											
												<img src="<?=base_url()?>images\User\medium\default_image.jpg" class="pro_img">
											<?php endif?>											
											<div class="controls" style="display: <?=$disp?>;">
												<input type="file" name="user_image" id="user_image" class="indianDate inp-form inp_img" >
											</div>
									</div>	


														<div class="control-group">
															<label class="control-label" for="country">Country :</label>
															<div class="controls">
														<select id="country" name="country" class="required" <?=$disabled?>>

														<option value="">Select Country</option>

														<option value="1">Afghanistan</option>
														<option value="2">Albania</option>
														<option value="3">Algeria</option>
														<option value="4">American Samoa</option>
														<option value="5">Andorra</option>
														<option value="6">Angola</option>
														<option value="7">Anguilla</option>
														<option value="8">Antarctica</option>
														<option value="9">Antigua and Barbuda</option>
														<option value="10">Argentina</option>
														<option value="11">Armenia</option>
														<option value="12">Aruba</option>
														<option value="13">Australia</option>
														<option value="14">Austria</option>
														<option value="15">Azerbaijan</option>
														<option value="16">Bahamas</option>
														<option value="17">Bahrain</option>
														<option value="18">Bangladesh</option>
														<option value="19">Barbados</option>
														<option value="20">Belarus</option>
														<option value="21">Belgium</option>
														<option value="22">Belize</option>
														<option value="23">Benin</option>
														<option value="24">Bermuda</option>
														<option value="25">Bhutan</option>
														<option value="26">Bolivia</option>
														<option value="27">Bosnia and Herzegovina</option>
														<option value="28">Botswana</option>
														<option value="29">Bouvet Island</option>
														<option value="30">Brazil</option>
														<option value="31">British Indian Ocean Territory</option>
														<option value="32">British Virgin Islands</option>
														<option value="33">Brunei Darussalam</option>
														<option value="34">Bulgaria</option>
														<option value="35">Burkina Faso</option>
														<option value="36">Burundi</option>
														<option value="37">Cambodia</option>
														<option value="38">Cameroon</option>
														<option value="39">Canada</option>
														<option value="40">Cape Verde</option>
														<option value="41">Cayman Islands</option>
														<option value="42">Central African Republic</option>
														<option value="43">Chad</option>
														<option value="44">Chile</option>
														<option value="45">China</option>
														<option value="46">Christmas Island</option>
														<option value="47">Cocos (Keeling) Islands</option>
														<option value="48">Colombia</option>
														<option value="49">Comoros</option>
														<option value="50">Congo</option>
														<option value="51">Cook Islands</option>
														<option value="52">Costa Rica</option>
														<option value="53">Croatia</option>
														<option value="54">Cuba</option>
														<option value="55">Cyprus</option>
														<option value="56">Czech Republic</option>
														<option value="57">Côte d'Ivoire</option>
														<option value="58">Democratic Republic of the Congo</option>
														<option value="59">Denmark</option>
														<option value="60">Djibouti</option>
														<option value="61">Dominica</option>
														<option value="62">Dominican Republic</option>
														<option value="63">Ecuador</option>
														<option value="64">Egypt</option>
														<option value="65">El Salvador</option>
														<option value="66">Equatorial Guinea</option>
														<option value="67">Eritrea</option>
														<option value="68">Estonia</option>
														<option value="69">Ethiopia</option>
														<option value="70">Falkland Islands</option>
														<option value="71">Faroe Islands</option>
														<option value="72">Federated States of Micronesia</option>
														<option value="73">Fiji</option>
														<option value="74">Finland</option>
														<option value="75">France</option>
														<option value="76">French Guiana</option>
														<option value="77">French Polynesia</option>
														<option value="78">French Southern Territories</option>
														<option value="79">Gabon</option>
														<option value="80">Gambia</option>
														<option value="81">Georgia</option>
														<option value="82">Germany</option>
														<option value="83">Ghana</option>
														<option value="84">Gibraltar</option>
														<option value="85">Greece</option>
														<option value="86">Greenland</option>
														<option value="87">Grenada</option>
														<option value="88">Guadeloupe</option>
														<option value="89">Guam</option>
														<option value="90">Guatemala</option>
														<option value="91">Guernsey</option>
														<option value="92">Guinea</option>
														<option value="93">Guinea-Bissau</option>
														<option value="94">Guyana</option>
														<option value="95">Haiti</option>
														<option value="96">Heard Island and McDonald Islands</option>
														<option value="97">Holy See (Vatican City State)</option>
														<option value="98">Honduras</option>
														<option value="99">Hong Kong</option>
														<option value="100">Hungary</option>
														<option value="101">Iceland</option>
														<option value="102">India</option>
														<option value="103">Indonesia</option>
														<option value="104">Iran</option>
														<option value="105">Iraq</option>
														<option value="106">Ireland</option>
														<option value="107">Isle of Man</option>
														<option value="108">Israel</option>
														<option value="109">Italy</option>
														<option value="110">Jamaica</option>
														<option value="111">Japan</option>
														<option value="112">Jersey</option>
														<option value="113">Jordan</option>
														<option value="114">Kazakhstan</option>
														<option value="115">Kenya</option>
														<option value="116">Kiribati</option>
														<option value="117">Kosovo</option>
														<option value="118">Kuwait</option>
														<option value="119">Kyrgyzstan</option>
														<option value="120">Laos</option>
														<option value="121">Latvia</option>
														<option value="122">Lebanon</option>
														<option value="123">Lesotho</option>
														<option value="124">Liberia</option>
														<option value="125">Libya</option>
														<option value="126">Liechtenstein</option>
														<option value="127">Lithuania</option>
														<option value="128">Luxembourg</option>
														<option value="129">Macao</option>
														<option value="130">Madagascar</option>
														<option value="131">Malawi</option>
														<option value="MY">Malaysia</option>
														<option value="MV">Maldives</option>
														<option value="ML">Mali</option>
														<option value="MT">Malta</option>
														<option value="MH">Marshall Islands</option>
														<option value="MQ">Martinique</option>
														<option value="MR">Mauritania</option>
														<option value="MU">Mauritius</option>
														<option value="YT">Mayotte</option>
														<option value="MX">Mexico</option>
														<option value="MD">Moldova</option>
														<option value="MC">Monaco</option>
														<option value="MN">Mongolia</option>
														<option value="ME">Montenegro</option>
														<option value="MS">Montserrat</option>
														<option value="MA">Morocco</option>
														<option value="MZ">Mozambique</option>
														<option value="MM">Myanmar</option>
														<option value="NA">Namibia</option>
														<option value="NR">Nauru</option>
														<option value="NP">Nepal</option>
														<option value="NL">Netherlands</option>
														<option value="AN">Netherlands Antilles</option>
														<option value="NC">New Caledonia</option>
														<option value="NZ">New Zealand</option>
														<option value="NI">Nicaragua</option>
														<option value="NE">Niger</option>
														<option value="NG">Nigeria</option>
														<option value="NU">Niue</option>
														<option value="NF">Norfolk Island</option>
														<option value="KP">North Korea</option>
														<option value="MP">Northern Mariana Islands</option>
														<option value="NO">Norway</option>
														<option value="OM">Oman</option>
														<option value="PK">Pakistan</option>
														<option value="PW">Palau</option>
														<option value="PS">Palestinian Territory</option>
														<option value="PA">Panama</option>
														<option value="PG">Papua New Guinea</option>
														<option value="PY">Paraguay</option>
														<option value="PE">Peru</option>
														<option value="PH">Philippines</option>
														<option value="PN">Pitcairn</option>
														<option value="PL">Poland</option>
														<option value="PT">Portugal</option>
														<option value="PR">Puerto Rico</option>
														<option value="QA">Qatar</option>
														<option value="MK">Republic of Macedonia</option>
														<option value="RO">Romania</option>
														<option value="RU">Russia</option>
														<option value="RW">Rwanda</option>
														<option value="RE">Réunion</option>
														<option value="BL">Saint Barthélemy</option>
														<option value="SH">Saint Helena</option>
														<option value="KN">Saint Kitts and Nevis</option>
														<option value="LC">Saint Lucia</option>
														<option value="MF">Saint Martin (French part)</option>
														<option value="PM">Saint Pierre and Miquelon</option>
														<option value="VC">Saint Vincent and the Grenadines</option>
														<option value="WS">Samoa</option>
														<option value="SM">San Marino</option>
														<option value="ST">Sao Tome and Principe</option>
														<option value="SA">Saudi Arabia</option>
														<option value="SN">Senegal</option>
														<option value="RS">Serbia</option>
														<option value="SC">Seychelles</option>
														<option value="SL">Sierra Leone</option>
														<option value="SG">Singapore</option>
														<option value="SK">Slovakia</option>
														<option value="SI">Slovenia</option>
														<option value="SB">Solomon Islands</option>
														<option value="SO">Somalia</option>
														<option value="ZA">South Africa</option>
														<option value="GS">South Georgia and the South Sandwich Islands</option>
														<option value="KR">South Korea</option>
														<option value="ES">Spain</option>
														<option value="LK">Sri Lanka</option>
														<option value="SD">Sudan</option>
														<option value="SR">Suriname</option>
														<option value="SJ">Svalbard and Jan Mayen</option>
														<option value="SZ">Swaziland</option>
														<option value="SE">Sweden</option>
														<option value="CH">Switzerland</option>
														<option value="SY">Syria</option>
														<option value="TW">Taiwan</option>
														<option value="TJ">Tajikistan</option>
														<option value="TZ">Tanzania</option>
														<option value="TH">Thailand</option>
														<option value="TL">Timor-Leste</option>
														<option value="TG">Togo</option>
														<option value="TK">Tokelau</option>
														<option value="TO">Tonga</option>
														<option value="TT">Trinidad and Tobago</option>
														<option value="TN">Tunisia</option>
														<option value="TR">Turkey</option>
														<option value="TM">Turkmenistan</option>
														<option value="TC">Turks and Caicos Islands</option>
														<option value="TV">Tuvalu</option>
														<option value="VI">U.S. Virgin Islands</option>
														<option value="UG">Uganda</option>
														<option value="UA">Ukraine</option>
														<option value="AE">United Arab Emirates</option>
														<option value="GB">United Kingdom</option>
														<option value="US">United States</option>
														<option value="UM">United States Minor Outlying Islands</option>
														<option value="UY">Uruguay</option>
														<option value="UZ">Uzbekistan</option>
														<option value="VU">Vanuatu</option>
														<option value="VE">Venezuela</option>
														<option value="VN">Vietnam</option>
														<option value="WF">Wallis and Futuna</option>
														<option value="EH">Western Sahara</option>
														<option value="YE">Yemen</option>
														<option value="ZM">Zambia</option>
														<option value="ZW">Zimbabwe</option>
														<option value="AX">Åland Islands</option>
														
													</select>
													
												</div><!--reg_right-->
											</div><!--end reg_input-->



											<div class="control-group">
													<label class="control-label" for="postal">Zip/Postal code :</label>
												<div class="controls"> 
													<input id="postal" <?=$rdnly?> class="reg_thick required number" type="text" name="postal" maxlength="6" placeholder="Postal code" value="<?=$postal?>">
													 e.g. 98104 
												</div>
											</div>
											<div class="control-group">
													<label class="control-label" for="phone">Phone No :</label>
													<div class="controls">
														<input id="phone" <?=$rdnly?> class="reg_thick required number" type="text" name="phone" maxlength="10" placeholder="Phone No" value="<?=$phone?>">
													</div>
											</div>


											 <div class="control-group">
													<label class="control-label"  for="email">E-mail :</label>
													<div class="controls">
														<input type="text" <?=$rdnly?> id="email" class="reg_thick required email" placeholder="Email" name="email" maxlength="100" value="<?=$Email?>">
													</div>
											</div>
											
											<div class="controls">
												<button class="btn btn-info" type="submit" id="submit" name="submit">Edit</button>
												<a href="<?=base_url()?>index.php/user/user_details/<?=$id?>" class="cnl_btn" style="display:<?=$disp?>;" >
													<button class="btn btn-info" type="button" name="back">Cancel</button>
												</a>
											</div>

							</div><!--article reg_form-->
							</form>
					


 </div><!--end span9-->
	</div><!--end row-fliud-->
			 <div class="row-fluid">
				<div class="span12">
				  <!-- Start: Footer -->
				  <?php $this->load->view('include/footer.php'); ?>
				  <!-- End: Footer -->
				 </div>
			 </div>
		</div><!--end contanier fluid-->
  	</div><!--end main content-->
  <!-- End: Main -->
</div><!--end contenthome-->
<!--end shell-->


   <script src="<?=base_url()?>js/jquery-1.7.1.js" type="text/javascript"></script>
   <script src="<?=base_url()?>js/jquery-latest.js"></script>
   <script type="text/javascript" src="<?=base_url()?>js/jquery.validate.js"></script>
	<script src="<?=base_url()?>js/bootstrap-typeahead.js" type="text/javascript"></script>
    <script src="<?=base_url()?>js/bootstrap.js"></script>

    <script src="<?=base_url()?>js/jquery.autocomplete.js" type="text/javascript"></script>
	<script src="<?=base_url()?>admin/js/jquery.ui.core.js" type="text/javascript"></script>
	<script src="<?=base_url()?>admin/js/jquery.ui.widget.js"></script>
	<script src="<?=base_url()?>admin/js/jquery.ui.datepicker.js"></script>
	 
   <script type="text/javascript" src="<?=base_url()?>js/jquery.validate.js"></script>
    <script>
	 	$('.carousel').carousel();
	 	$('.typeahead').typeahead({
		 select:function (item) {

        //item = selected item
        //do your stuff.

        //dont forget to return the item to reflect them into input
       alert(item);
    }
});
	 	</script>


	 <script>
  $(document).ready(function(){
    $("#form").validate({

		rules: {
                    gender: "required"
        },
        messages: {
            gender: "You must select an account type"
        },
        errorPlacement: function(error, element) { 
    		if ( element.is(":radio") ) {
                error.appendTo(forgender); 

            }
            else if ( element.is(":checkbox") )
				error.insertAfter(element); 
			else
			{
				error.insertAfter(element); 
			}
    	}
    });
  });
  </script>

	
	
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>js/jquery.autocomplete.css" />

	<?php       
    echo "<SCRIPT type=text/javascript >   var data = [";   
    
    $i=1;
    if($auto_count>0)
    {
        foreach($auto_array as $row)
        {   
            $urlredirect = base_url().'index.php/movie/movie_name/'.$row->movie_id;
            if($i<$auto_count)
            { 
                echo "{text:'".$row->movie_name."', url:'".$urlredirect."'},"; 
            }
            else
            {
                echo "{text:'".$row->movie_name."', url:'".$urlredirect."'}";  
            }
            $i++;
        } 
    }
    else
    {
        echo 'No Match Found';
    }
    echo "]; </script>";
?>


	<script type="text/javascript">
$().ready(function() 
{

    function findValueCallback(event, data, formatted) {
        $("<li>").html( !data ? "No match!" : "Selected: " + formatted).appendTo("#result");
    }
    
    function formatItem(row) {
        return row[0] + " (<strong>id: " + row[1] + "</strong>)";
    }
    
    function formatResult(row) {
        return row[0].replace(/(<.+?>)/gi, '');
    }
     
     
$('#txtSearch').autocomplete(data,{
  
  formatItem: function(item) { 
    return item.text;
  } 
  
}).result(function(event, item) {
  location.href = item.url;
});


 
});
</script>
	<script type="text/javascript">
	$(document).ready(function() {

$(function() {
		var dates = $( "#txtDOB" ).datepicker({
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
	</script>

  </body>
</html>