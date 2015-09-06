<?php

	define("WEBMASTER_EMAIL", 'waldemar@manorheating.co.uk');
	error_reporting (E_ALL ^ E_NOTICE);
	$post = (!empty($_POST)) ? true : false;

if($post)
	{
		include 'validate.php';
		$name = stripslashes($_POST['name']);
		$email = trim($_POST['email']);
		$phone = stripslashes($_POST['phone']);
		$type = $_POST['type'];
		$message = "Service Request : $type \n Contact Number: $phone \n Contact Name : $name \n Time : $time";
		$error = '';
		$date = date('l \T\h\e jS');
		$time = date('l jS \of F Y h:i:s A');
		$subject = "$type Enquiry On $date";

// Check name
if(!$name)
	{
		$error .= 'It seems you forget to enter your name.<br />';
	}
// Check email
if(!$email)
	{
		$error .= 'It seems you forget to enter your e-mail address.<br />';
	}
if($email && !ValidateEmail($email))
	{
		$error .= 'I don\'t think that is a real your e-mail address<br />';
	}
if(!$error)
	{
		$mail = mail(WEBMASTER_EMAIL, $subject, $message, 
     		"From: ".$name." <".$email.">\r\n"
    		."Reply-To: ".$email."\r\n"
    		."X-Mailer: PHP/" . phpversion());
if($mail)
	{
		echo 'OK';
	}
}
else
	{
		echo '<div class="notification">'.$error.'</div>';
	}
}
?>