<?php 
require_once('../Connections/members_only.php');
  ?>
<?php require_once('../Connections/members.php'); ?>
<?php require_once('../includes/config-paypal.php'); ?>
<?php require_once('../includes/PayPal.php'); ?>  
  
  <!-- header starts -->
  <?php include('../include/header_secure.php'); ?>
 
  <!-- header ends -->

  
  <?php
  @error_reporting(0);
  @error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
  @ini_set('display_errors', 0);
//initialize the session
session_start();

// ** Logout the current user. **//



$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}



if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
 unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_MemberID']);
  unset($_SESSION['MM_UserGroup']);
	
  $logoutGoTo = "default.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
} 


?>
<?php

session_start();
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page

function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    //$arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    //if (in_array($UserGroup, $arrGroups)) { 
    //  $isValid = true; 
    //} 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}


$MM_restrictGoTo = "default.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
   //header("Location: ". $MM_restrictGoTo); 
  echo '<script>window.location.assign("default2.php")</script>';
  exit;
} 


?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

session_start();
$loginMemberID = $_SESSION['MM_MemberID'];



$membertype = $loginMemberID{0};
if ($membertype == "F") {
  $loginMemberType = "full";
  
  $loginMemberid = substr($loginMemberID, 1);
	$query_rsFullMember = sprintf("SELECT * FROM full_members WHERE member_id = '$loginMemberid'");
	$resultFullMember = mysqli_query($conn,$query_rsFullMember) or die(mysqli_error($conn));
	$memberData = mysqli_fetch_assoc($resultFullMember);

	$name_first = $memberData['name_first'];	
	$name_middle = $studentData['name_middle'];
	$name_last = $memberData['name_last'];	
	$email = $memberData['email'];	
	$mail_street = $memberData['mail_street'];	
	$mail_postal_zip = $memberData['mail_postal_zip'];	
	
	$mail_city = $studentData['mail_city'];	
	$phone_voice = $studentData['phone_voice'];
	
	if(isset($_POST['incomelow'])){
		$amount=45.00;
		$_SESSION['AMOUNT']=$amount;
	}else{
		$amount=90.00;
		$_SESSION['AMOUNT']=$amount;
	}
	$desc = 'Member Renewal description';
	$custom = 'Member Renewal';
  
} else {
  $loginMemberType = "student";
  
  $loginstudentid = substr($loginMemberID, 1);
	$query_rsFullStudent = sprintf("SELECT * FROM student_members WHERE member_id = '$loginstudentid'");
	$resultFullStudent = mysqli_query($conn,$query_rsFullStudent) or die(mysqli_error());
	$studentData = mysqli_fetch_assoc($resultFullStudent);

	$name_first = $studentData['name_first'];
	$name_middle = $studentData['name_middle'];	
	$name_last = $studentData['name_last'];	
	$email = $studentData['email'];	
	$mail_street = $studentData['mail_street'];	
	$mail_postal_zip = $studentData['mail_postal_zip'];
	
	$mail_city = $studentData['mail_city'];	
	$phone_voice = $studentData['phone_voice'];
	$amount = '45.00';
	$_SESSION['AMOUNT']=$amount;
	
	$desc = 'Student Renewal description';
	$custom = 'Student Renewal';
  
}

$query_rsFullAdd = sprintf("SELECT * FROM renewal WHERE member_id = '$loginMemberID'");
$rsFullAdd = mysqli_query($conn,$query_rsFullAdd) or die(mysqli_error($conn));
$row_rsFullAdd = mysqli_fetch_assoc($rsFullAdd);
$totalRows_rsFullAdd = mysqli_num_rows($rsFullAdd);

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "fullUpdate")) {
	
	
if ($_POST['vpb_captcha_code'] == $_SESSION['vpb_captcha_code']) {
	
	
  $is_new = "no";
  $card_type = $_POST['card_type'];
  $card_number = $_POST['card_number'];
  $card_name = $_POST['card_name'];
  $exp_date = $_POST['exp_date_month'] . $_POST['exp_date_year'];
  $zip = $_POST['zip'];
  $type_pay = $_POST['type_pay'];
  $check_num = $_POST['check_num'];
  $renewal_date = date("Y-m-d");
  $confirmation = $_POST['confirmation'];
  
  $PayPalConfig = array(
					'Sandbox' => $sandbox,
					'APIUsername' => $api_username,
					'APIPassword' => $api_password,
					'APISignature' => $api_signature
					);

$PayPal = new PayPal($PayPalConfig);

$DPFields = array(
					'paymentaction' => 'Sale', 					
					'ipaddress' => $_SERVER['REMOTE_ADDR'], 	
					'returnfmfdetails' => '1' 				
				);
				
$CCDetails = array(
					'creditcardtype' => $card_type, 					
					'acct' => $card_number, 					
					'expdate' => $exp_date, 					
					'cvv2' => $_POST['cvv'], 						
					'startdate' => '', 						
					'issuenumber' => ''						
				);
				
$PayerInfo = array(
					'email' => $email, 	
					'payerid' => '', 						
					'payerstatus' => '', 					
					'business' => '' 						
				);
				
$PayerName = array(
					'salutation' => '', 					
					'firstname' => $_POST['card_name'], 				
					'middlename' => $name_middle, 					
					'lastname' => $name_last, 				
					'suffix' => ''							
				);
				
$BillingAddress = array(
						'street' => $_POST['billing_address_street'], 						
						'street2' => '', 						
						'city' => $_POST['city'], 						
						'state' => $_POST['state'], 					
						'countrycode' => $_POST['country'],  				
						'zip' => $mail_postal_zip, 					
						'phonenum' => $phone_voice 					
					);
					

					
$PaymentDetails = array(
						'amt' => $amount, 					
						'currencycode' => 'USD', 			
						'itemamt' => '', 					
						'shippingamt' => '', 				
						'handlingamt' => '', 				
						'taxamt' => '', 					
						'desc' => $desc, 
						'custom' => $custom, 						
						'invnum' => '', 						
						'buttonsource' => '', 					
						'notifyurl' => ''					
					);

$OrderItems = array();		

$PayPalRequestData = array(
						   'DPFields' => $DPFields, 
						   'CCDetails' => $CCDetails, 
						   'PayerInfo' => $PayerInfo,
						   'PayerName' => $PayerName, 
						   'BillingAddress' => $BillingAddress, 
						   'PaymentDetails' => $PaymentDetails, 
						   'OrderItems' => $OrderItems
						   );

$PayPalResult = $PayPal -> DoDirectPayment($PayPalRequestData);

$_SESSION['transaction_id'] = isset($PayPalResult['TRANSACTIONID']) ? $PayPalResult['TRANSACTIONID'] : '';
//var_dump($PayPalResult);
if($PayPalResult['ACK'] == 'Success' || $PayPalResult['ACK'] == 'SuccessWithWarning'){

 
unset($_SESSION['SESS_MSG']);
unset($_SESSION['CARD_TYPE']); 		
unset($_SESSION['CARD_NUMBER']); 		
unset($_SESSION['CARD_NAME']); 		
unset($_SESSION['MM']);			
unset($_SESSION['YYYY']);		
unset($_SESSION['ZIP']);				
unset($_SESSION['CONFIRMATION']);
unset($_SESSION['cvv_1']);	
unset($_SESSION['incomelow_1']);	

unset($_SESSION['INVALID_DATA']); 
unset($_SESSION['LONG_MESSAGE']);
unset($_SESSION['ERROR']);

/*unset($_SESSION['BILLING_ADDRESS_STREET']);
unset($_SESSION['CITY']);
unset($_SESSION['STATE']);
unset($_SESSION['COUNTRY']);*/

$name_first = $studentData['name_first'];
	$name_middle = $studentData['name_middle'];	
	$name_last = $studentData['name_last'];	
	$email = $studentData['email'];	
	$mail_street = $studentData['mail_street'];	
	$mail_postal_zip = $studentData['mail_postal_zip'];
	
	$mail_city = $studentData['mail_city'];	
	$phone_voice = $studentData['phone_voice'];


 $_SESSION['NAME_FIRST'] 	= 	$name_first;
  $_SESSION['NAME_LAST'] 	= 	$name_last;
  $_SESSION['MAIL_STREET'] 	= 	$mail_street;
  $_SESSION['PHONE_VOICE'] = 	$phone_voice;
  $_SESSION['MAIL_CITY'] 	= 	$mail_city;
 $_SESSION['ZIP'] 				= $_POST['zip'];
 $_SESSION['BILLING_ADDRESS_STREET'] = $_POST['billing_address_street'];
 $_SESSION['CITY'] 		= 	$_POST['city'];
 $_SESSION['STATE'] 		=	$_POST['state'];
 $_SESSION['COUNTRY'] 	= 	$_POST['country'];


$ack_status=$PayPalResult['ACK'];

if(isset($ack_status)){

$_SESSION['SESS_MSG'] ="Your transaction is sucess";
$_SESSION['ACK'] 	  = $PayPalResult['ACK'];
}
   $card_type_val = $_POST['card_type'];
  if ($totalRows_rsFullAdd == 0) {
     $updateSQL = "INSERT INTO renewal (member_id, is_new, type_member, zip, type_pay, check_num, renewal_date, confirmation) VALUES ('$loginMemberID', '$is_new', '$loginMemberType', '$zip', '$type_pay', '$check_num', '$renewal_date', '$confirmation')";
     $Result1 = mysqli_query($conn,$updateSQL) or die(mysqli_error($conn));
  } else {
     $updateSQL = "UPDATE renewal SET type_member = '$loginMemberType', zip = '$zip', type_pay = '$type_pay', check_num = '$check_num', renewal_date = '$renewal_date', confirmation = '$confirmation' WHERE member_id = '$loginMemberID'";
     $Result1 = mysqli_query($conn,$updateSQL) or die(mysqli_error($conn));
  }
     
		//22-04-19 $to = 'attud@cce-global.org,boyd@nbcc.org';
  //$to = 'foodcorner@gmail.com';
  $to = 'testing40@iwesh.com';

		$subject = 'ATTUD Member Renewal';
		//22-04-19 $headers = 'From: info@attud.org' . "\r\n" . 'Reply-To: info@attud.org' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
		$headers = 'From: info@attud.org' . "\r\n" . 'Reply-To: testing30@iwesh.com' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
		$message = $_SESSION['MM_Username'] . " has renewed their membership. Their member type is: " . $loginMemberType . ", their member ID is: " . $loginMemberID;

		if (mail($to, $subject, $message, $headers)) {
			  echo("<p>Thank you for your application/renewal and payment. You will be emailed a receipt in the next few days once your payment has cleared.</p>");
			 } else {
			  echo("<p>Message delivery failed...</p>");
		}
     
  $updateGoTo = "members_main.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  //header(sprintf("Location: %s", $updateGoTo));
  echo '<script>window.location.assign("/secure/members_only/thank-you.php")</script>';

}else{
/*************************************************************/
if($PayPalResult['ACK']=='Failure'){
 

 $_SESSION['CARD_TYPE'] 		= $_POST['card_type'];
 $_SESSION['CARD_NUMBER'] 		= $_POST['card_number'];	
 $_SESSION['CARD_NAME'] 		= $_POST['card_name'];
 $_SESSION['MM']				= $_POST['exp_date_month'];
 $_SESSION['YYYY']				= $_POST['exp_date_year'];
 $_SESSION['cvv_1']				= $_POST['cvv'];
 $_SESSION['ZIP'] 				= $_POST['zip'];
 $_SESSION['CONFIRMATION']		= $_POST['confirmation'];
 
 $_SESSION['incomelow_1']		= isset($_POST['incomelow']) ? $_POST['incomelow'] : '';
 
 $_SESSION['BILLING_ADDRESS_STREET'] = $_POST['billing_address_street'];
 $_SESSION['CITY'] 		= 	$_POST['city'];
 $_SESSION['STATE'] 		=	$_POST['state'];
 $_SESSION['COUNTRY'] 	= 	$_POST['country'];
 
 $_SESSION['INVALID_DATA'] 		= $PayPalResult['L_SHORTMESSAGE0'];
 $_SESSION['LONG_MESSAGE'] 		= $PayPalResult['L_LONGMESSAGE0'];
 $_SESSION['ERROR'] 			= $PayPalResult['L_SEVERITYCODE0'];
 
 echo '<script>window.location.assign("https://secure1.securewebexchange.com/attud.org/members_only/new_renew_membership.php)</script>';
}

/************************************************************/

}
}

}
?>
  
  
  <div class="container clearfix">
    <div class="sixteen columns"></div>
  <div class="sixteen columns">
      <h1 class="page-title">Renew Membership</h1>
    </div>
	<!-- Page Title --> 
	<link href="../css/attud_css.css" rel="stylesheet" type="text/css" />
    <SCRIPT LANGUAGE="JavaScript">
	
	

	
function validate2(){

	var name=document.fullUpdate.card_type.value;
	if(name=="")
	{
		alert("Please Select Card Type");
		document.fullUpdate.card_type.focus();
		return false;
	}




	var name=document.fullUpdate.card_number.value;
	if(name=="")
	{
		alert("Please Enter Card Number");
		document.fullUpdate.card_number.focus();
		return false;
	}
	
	var name=document.fullUpdate.card_name.value;
	if(name=="")
	{
		alert("Please Enter Card Name");
		document.fullUpdate.card_name.focus();
		return false;
	}	
	

	

	
	var name=document.fullUpdate.exp_date_month.value;
	if(name=="")
	{
		alert("Please Select Month");
		document.fullUpdate.exp_date_month.focus();
		return false;
	}


	var name=document.fullUpdate.exp_date_year.value;
	if(name=="")
	{
		alert("Please Select Year");
		document.fullUpdate.exp_date_year.focus();
		return false;
	}	


	var name=document.fullUpdate.zip.value;
	if(name=="")
	{
		alert("Please Enter Zip");
		document.fullUpdate.zip.focus();
		return false;
	}
		


	if (document.fullUpdate.confirmation.checked == false) 
	{
		alert ('Please check the confirmation statement');
		return false;
	} 		
	
		
}
  
  

	
	
	
	
	
	
	
	
	
	
      <!-- Begin

      function disableFields() {
        var typeSelection;
        typeSelection = document.fullUpdate.type_pay.value;
        
        switch (typeSelection) {
          case "pchk", "ichk":
            document.fullUpdate.check_num.disabled = false
            document.fullUpdate.card_type.disabled = true
            document.fullUpdate.card_number.disabled = true
            document.fullUpdate.card_name.disabled = true
            document.fullUpdate.exp_date_month.disabled = true
            document.fullUpdate.exp_date_year.disabled = true
            document.fullUpdate.zip.disabled = true
          break;
          case "mo":
            document.fullUpdate.check_num.disabled = true
            document.fullUpdate.card_type.disabled = true
            document.fullUpdate.card_number.disabled = true
            document.fullUpdate.card_name.disabled = true
            document.fullUpdate.exp_date_month.disabled = true
            document.fullUpdate.exp_date_year.disabled = true
            document.fullUpdate.zip.disabled = true
          break;
          case "cc":
            document.fullUpdate.check_num.disabled = true
            document.fullUpdate.card_type.disabled = false
            document.fullUpdate.card_number.disabled = false
            document.fullUpdate.card_name.disabled = false
            document.fullUpdate.exp_date_month.disabled = false
            document.fullUpdate.exp_date_year.disabled = false
            document.fullUpdate.zip.disabled = false
          break;
        }
      }
      //  End -->
      </script>


	    
	 <div class="eight columns top bottom"> 
	
	<div class="post gallery bottom">
	<!-- CURRENT MEMBERS -->
	
 <table width="740" border="0" cellpadding="3" id="main">
          <tr>
            <td width="125" align="left" valign="top">
              
            </td>
            <td width="378" align="center" valign="middle">
              <p class="myHeadSmall">Renew Membership</p>
            <p class="myHeadSmall"><font face="Arial, Helvetica, sans-serif"><a href="members_main.php"><font size="2">Return to Members Only Menu</font></a></font></p>
            <p class="myHeadSmall"><font size="2" face="Arial, Helvetica, sans-serif"><a href="member_edit.php">Update Your Information </a></font></p></td>
          </tr>
          <tr align="left" valign="top">
  </tr>
  <tr align="left" valign="top">
    <td colspan="2"><form name="fullUpdate" id="fullUpdate" method="POST" action="<?php echo($editFormAction); ?>" onSubmit="return validate2();">
      <table width="740" border="0" cellpadding="3" id="formTable">
		<? if(isset($_SESSION['LONG_MESSAGE'])){?>
	 <tr>
        <td colspan="3" align="left" valign="top" class="myHeadSmall" style="color:#FF0000;">
		<? if(isset($_SESSION['ERROR'])){echo '<b>'.$_SESSION['ERROR'].':</b>'; ?><? echo $_SESSION['LONG_MESSAGE']; }?></td>
      </tr>
	  
	    
	  <? }?>
	  <tr>
        <td colspan="3" align="left" valign="top" class="myHeadSmall">ATTUD Renewal: $90 Members, $45 Students, $45 Emeritus, $45 Quitline Counselors </td>
      </tr>
      <tr><td colspan="3" align="left" valign="top" class="myHeadSmall">
        
      <tr>
        <td colspan="3" align="left" valign="top" class="myBody">
          There are two ways to renew:

            <br>
            1.  Complete the form below, enter credit card information and submit electronically.<br>  
(Once you submit your information you will receive a confirmation message that appears at the top of the screen).

 <br>
 <br>
 2.  Complete the form below, print and send paper copy  with check or purchase order to:

 <br>
 ATTUD Management Services Administrator
 <br>
 3 Terrace Way
 <br>
 Greensboro, NC 27403



 
 
 
 </td>
      </tr>
	  <tr>
        <td colspan="3" align="right" valign="top" class="dblabel"><div align="left"><span class="myBody"> 
		<input name="incomelow" type="checkbox" <? if(isset($_SESSION['incomelow_1']) && $_SESSION['incomelow_1']=='yes'){?>checked="checked"<? }?> class="dblabel" id="incomelow" value="yes" />Select check box if you are from low income based country </span></div></td>
       </tr>
       <tr>
        <td colspan="3" align="right" valign="top" class="dblabel"><div align="left"><span class="myBody"> 
		<input name="emeritus" type="checkbox" <? if(isset($_SESSION['emeritus_1']) && $_SESSION['emeritus_1']=='yes'){?>checked="checked"<? }?> class="dblabel" id="emeritus" value="yes" />I am currently retired and requesting emeritus status. </span></div></td>
        </tr>
       <tr>
        <td colspan="3" align="right" valign="top" class="dblabel"><div align="left"><span class="myBody"> 
		<input name="quitline" type="checkbox" <? if(isset($_SESSION['quitline_1']) && $_SESSION['quitline_1']=='yes'){?>checked="checked"<? }?> class="dblabel" id="quitline" value="yes" />Select check box if you are a Quitline Counselor. </span></div></td>
       </tr>
      <tr>
        <td colspan="3" align="right" valign="top" class="dblabel"><div align="left"><span class="myBody">Credit Card Payment: </span></div></td>
      </tr>
      <tr>
        <td width="300" align="right" valign="top" class="dblabel">Card Type:</td>
        <td width="440" colspan="2" align="left" valign="top">
          &nbsp;<select name="card_type">
            <option value=""></option>
            <option value="visa" <? if(isset($_SESSION['CARD_TYPE']) && $_SESSION['CARD_TYPE']=='visa'){?>selected="selected"<? }?>> Visa</option>
            <option value="MasterCard" <? if(isset($_SESSION['CARD_TYPE']) && $_SESSION['CARD_TYPE']=='MasterCard'){?>selected="selected"<? }?>>MasterCard</option>
          </select>
        </td>
      </tr>
      <tr>
        <td align="right" valign="top" class="dblabel">Card Number:</td>
        <td colspan="2" align="left" valign="top">
          <input name="card_number" type="text" class="myBody" id="card_number" value="<? if(isset($_SESSION['CARD_NUMBER'])){echo $_SESSION['CARD_NUMBER']; }?>" size="16" maxlength="16"/>
          </td>
        </tr>
        <tr>
          <td align="right" valign="top" class="dblabel">Name on Card:</td>
          <td colspan="2" align="left" valign="top">
            <input name="card_name" type="text" class="myBody" id="card_name" value="<? if(isset($_SESSION['CARD_NAME'])){ echo $_SESSION['CARD_NAME']; }?>" size="25" maxlength="25"/>
          </td>
        </tr>
		
		<tr>
            <td align="right" valign="top" class="dblabel">Billing Address Street:</td>
            <td colspan="2" align="left" valign="top">
			  <input name="billing_address_street" type="text" value="<?php echo $_SESSION['BILLING_ADDRESS_STREET']?>" class="myBody" id="billing_address_street" size="25" maxlength="25"/>
            </td>
          </tr>
		  
		  <tr>
            <td align="right" valign="top" class="dblabel">City</td>
            <td colspan="2" align="left" valign="top">
             <input name="city" value="<?php echo $_SESSION['CITY']?>" type="text" class="myBody" id="city" value="" size=""/>
            </td>
          </tr>
		  
		   <tr>
            <td align="right" valign="top" class="dblabel">State</td>
            <td colspan="2" align="left" valign="top">
             <input name="state" value="<?php echo $_SESSION['STATE']?>" type="text" class="myBody" id="state" value="" size=""/>
            </td>
          </tr>
		  
		   <tr>
            <td align="right" valign="top" class="dblabel">Country</td>
            <td colspan="2" align="left" valign="top">
             <input name="country" value="<?php echo $_SESSION['COUNTRY']?>" type="text" class="myBody" id="country" value="" size=""/>
            </td>
          </tr>
		
		 <tr>
          <td align="left" valign="top" class="dblabel">Zip Code:</td>
          <td colspan="2" align="left" valign="top">
            <input name="zip" type="text" class="myBody" id="zip" value="<? if(isset($_SESSION['ZIP'])){ echo $_SESSION['ZIP'];}?>" size="10" maxlength="10"/>
          </td>
        </tr>
		
        <tr>
          <td align="left" valign="top" class="dblabel">Expiration Date:</td>
          <td colspan="2" align="left" valign="top">
            &nbsp;<select name="exp_date_month"/  style="width:70px;">
              <option value="">Month</option>
             <? for($i=1;$i<=12; $i++){?>
              <option value="<?php echo $i;?>"<? if(isset($_SESSION['MM']) && $_SESSION['MM']==$i){?>selected="selected"<? }?>><?php echo $i; ?></option>
			  <? }?>
			  
            </select>
            &nbsp;&nbsp;<select name="exp_date_year" style="width:70px;"/>
              <option value="">Year</option>
              <? for($i=date("Y"); $i<=date("Y")+10; $i++){?>
			  <option value="<?=$i?>"<? if(isset($_SESSION['YYYY']) && $_SESSION['YYYY']==$i){?>selected="selected"<? }?>><?=$i?></option>
              <? }?>
            </select>
          </td>
        </tr>
		<tr>
            <td align="right" valign="top" class="dblabel">CVV No.:</td>
            <td colspan="2" align="left" valign="top">
              <input name="cvv" type="text" value="<?php echo $_SESSION['cvv_1']?>" style="width:35px;" class="myBody" id="cvv" value="" maxlength="3"/>
            </td>
          </tr>
		  
       
        <tr><td colspan="3"><Hr></Hr></td></tr>
		
		<tr>
			<td align="right" valign="top" class="dblabel">Captcha:</td>
            <td colspan="2" align="left" valign="top" class="dblabel">
				  <div class="fb-captcha fb-item-alignment-left" id="fb-captcha_control" style="">
					<input type="text" id="vpb_captcha_code" name="vpb_captcha_code" class="myBody">
					<div style=" margin:10px 0px 0px 0px;"  align="left"><div class="vpb_captcha_wrapper"><img src="vasplusCaptcha.php?rand=<?php echo rand(); ?>" id='captchaimg' ></div><br clear="all">
					<div style=" padding-top:5px;" align="left"><font style="font-family:Verdana, Geneva, sans-serif; font-size:11px;">Can't read the above security code? <a href="javascript:void(0);" style="text-decoration:none;" onClick="vpb_refresh_aptcha();">Refresh</a></font></div>

					</div></div>
					
					<?php 
					if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "fullUpdate")) {
					if ($_POST['vpb_captcha_code'] != $_SESSION['vpb_captcha_code']) {
						echo "<span class='style1' style='color:red'>Please re-enter captcha</span>";
					}
					}
					?>
					<script type="text/javascript">
					function vpb_refresh_aptcha()
					{
						return document.getElementById("vpb_captcha_code").value="",document.getElementById("vpb_captcha_code").focus(),document.images['captchaimg'].src = document.images['captchaimg'].src.substring(0,document.images['captchaimg'].src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
					}
					</script>
					
            </td>
          </tr>
		
		
		
        <tr>
          <td colspan="3" align="left" valign="top" class="dblabel">No application can be processed until payment is received.<br><br>
            The Membership Committee Chairperson will review all information received. Once the renewal has been processed, the membership committee will send confirmation and an e-receipt for the renewal fee. If an applicant does not receive the confirmation, they are encouraged to contact the Membership Committee Chairperson.
          </br></br>
        </td>
        </tr>
        <tr><td colspan="3"><Hr></Hr></td></tr>
        <tr align="left" valign="top" class="dblabel">
          <td colspan="3">
              <input name="confirmation" type="checkbox"  id="confirmation" <? if(isset($_SESSION['CONFIRMATION'])){?>checked="checked" <? }?> value="yes" />
              I confirm that I am currently active or have been historically active in the treatment of tobacco use and dependence.
          <br><p><font size="3" face="Arial, Helvetica, sans-serif"><STRONG>NOTE: When you submit your credit card information, a confirmation message will appear at the top of this screen. Please only submit once.</STRONG></font></p></td>
          </tr>
        <tr align="left" valign="top">
          <td colspan="3" align="center">
            <input name="Submit" type="submit" class="myBody" value="Submit Form"  />
            <input name="Cancel" type="button" class="myBody" value="Cancel Without Submitting" onClick="window.location='members_main.php'" />
          </td>
          </tr>
      </table>
      <input type="hidden" name="MM_update" value="fullUpdate">
    </form></td>
  </tr>
</table>	
	
	 
	
	
	
	<!-- MEMBERS-->
  </div>
  </div>
    
	<div class="clearfix"></div>
	</div>
	  <!-- <<< End Container >>> --> 
 
 
 <!-- footer starts -->
<?php include('../include/footer_secure.php'); ?>
 <!-- footer ends -->
	
	 <?php mysqli_free_result($rsFullAdd); ?>
