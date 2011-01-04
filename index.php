<?php

/*
 * TB_Contactform
 *	http://labs.thinkbright.nl/tb_contactform/
 *
 * 	A semantic and usable contact form for Wolf CMS
 *  by Marijn Scholtus (http://thinkbright.nl)
 *  
 *  Please keep this comment block intact when redistributing this Wolf CMS Plugin.
 */
 
/* Security measure */
if (!defined('IN_CMS')) { exit(); }

 /**
 * @package wolf
 * @subpackage plugin.tb_contactform
 * @author Marijn Scholtus (Thinkbright)
 * @version 1.0
 * @since Wolf version 0.5.5
 * @license http://creativecommons.org/licenses/by-sa/3.0/nl/deed.en
 * @copyright Marijn Scholtus, 2009
 */
 
Plugin::setInfos(array(
    'id'          => 'tb_contactform',
    'title'       => 'TB_Contactform',
    'description' => 'A semantic and usable contact form with proper input validation.',
    'version'     => '1.0.2',
    'license'     => 'MIT',
    'author'      => 'Marijn Scholtus (Thinkbright)',
    'require_wolf_version' => '0.5.5',
    'website'     => 'http://labs.thinkbright.nl/tb_contactform/',
    'update_url'  => 'http://labs.thinkbright.nl/frog-plugin-versions.xml'
));

function TB_Contactform($emailTo, $emailCC = FALSE, $sentHeading='Your message was sent successfully', $sentMessage='Please allow up to three days for a reply.') {

	if(isset($_POST['submit']))
	{
		$error = "";		
		$name 		= makeSafe($_POST['name']);
		$email		= makeSafe($_POST['email']);
		$message 	= makeSafe($_POST['message']);
		$subject 	= makesafe($_POST['subject']);
		
		if(empty($name))
		{ $error['name'] = "Please fill in your name."; }
		if(empty($email) || !isValidEmail($email))
		{ $error['email'] = "Please fill in a valid email address."; }
		if(empty($subject))
		{ $error['subject'] = "Please fill in the subject of your message."; }
		if(empty($message))
		{ $error['message'] = "Please fill in your message."; }
		
		if(!empty($_POST['antispam']))
		{
			echo '<p>We don&rsquo;t appreciate spam.</p>';
		}
		elseif(!empty($error))
		{
			TB_Displayform($error);
		}
		else
		{
			$content = $name . ' (' . $email . ') wrote the following on ' . date("r") . "\n\n";
			$content .= $message ."\n\n";
			$content .= 'IP: '. $_SERVER['REMOTE_ADDR'];
		
			$headers = 'From: '.$name.' <'.$email.'>'."\r\n";
			if($emailCC)
			{
				$headers .= 'CC: '.$emailCC."\r\n";
			}
			$headers .= 'Reply-To: ' . $email . "\r\n";
			$headers .= 'Content-type: text/plain; charset=UTF8';
				
			if(mail($emailTo, $subject, $content, $headers))
			{
				echo '<h3>'.$sentHeading.'</h3>'."\n";
				echo '<p>'.$sentMessage.'</p>'."\n";
			}
		}
	}
	else
	{
		TB_Displayform();
	}
}

function TB_Displayform($error = false) {

	echo '<div class="tbContactform">'."\n";
	if($error)
	{
		echo '	<div class="tbErrors">'."\n";
		foreach($error as $err)
		{
			echo '		<p>'. $err . '</p>'."\n";
		}
		echo '	</div>'."\n";
	}
	echo '	<form id="tbContactform" method="post" action="">'."\n";
	
	echo '	<p>'."\n";
	echo '		<label for="tbname">Name:</label>'."\n";
	echo '		<input type="text" class="text" id="tbname" name="name"';
	if(isset($error) && !empty($_POST['name'])) { echo ' value="'.$_POST['name'].'"'; }
	echo '/>'."\n";
	echo '	</p>'."\n";
	
	echo '	<p>'."\n";
	echo '		<label for="tbemail">Email:</label>'."\n";
	echo '		<input type="text" class="text" id="tbemail" name="email"';
	if(isset($error) && !empty($_POST['email'])) { echo ' value="'.$_POST['email'].'"'; }
	echo '/>'."\n";
	echo '	</p>'."\n";
	
	echo '	<p>'."\n";
	echo '		<label for="tbsubject">Subject:</label>'."\n";
	echo '		<input type="text" class="text" id="tbsubject" name="subject"';
	if(isset($error) && !empty($_POST['subject'])) { echo ' value="'.$_POST['subject'].'"'; }
	echo '/>'."\n";
	echo '	</p>'."\n";
	
	echo '	<p>'."\n";
	echo '		<label for="tbmessage">Message:</label>'."\n";
	echo '		<textarea id="tbmessage" name="message">';
	if(isset($error) && !empty($_POST['message'])) { echo $_POST['message']; }
	echo '</textarea>'."\n";
	echo '	</p>'."\n";
	
	echo '	<p class="antispam">'."\n";
	echo '		<label for="tbantispam">Please don&rsquo;t fill in the following text-field, it&rsquo;s used as an anti-spam measure.</label>'."\n";
	echo '		<input type="text" id="tbantispam" name="antispam" />'."\n";
	echo '	</p>'."\n";
	
	echo '	<p class="submit">'."\n";
	echo '		<input type="submit" id="tbsubmit" class="submit" name="submit" value="Send" />'."\n";
	echo '	</p>'."\n";
	echo '	</form>'."\n".'</div>'."\n";
}

function isValidEmail($email){
	return eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email);
}

function makeSafe($data)
{
	return trim(addslashes(htmlentities(htmlspecialchars(strip_tags($data),ENT_QUOTES,"UTF-8"))));
}

?>