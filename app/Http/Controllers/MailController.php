<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
//use Mail;

use App\Http\Requests; 
use App\Http\Controllers\Controller;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Percorsi assoluti: evita errori "Failed to open stream" se cambia la working directory
require_once base_path('vendor/PHPMailer/src/Exception.php');
require_once base_path('vendor/PHPMailer/src/PHPMailer.php');
require_once base_path('vendor/PHPMailer/src/SMTP.php');

class MailController extends Controller {
   public function sendMail($from_email, $from_name, $to_email, $to_name, $subject, $body, $file="") {
		//dd($request->all());

		/*$validator = \Validator::make($request->all(), [
									'name' => 'required|max:255',
									'email' => 'required|email|max:255',
									'subject' => 'required',
									'bodymessage' => 'required']
		);

		if ($validator->fails()) {
			return redirect('contact')->withInput()->withErrors($validator);
		}*/
		
		$send_mail_azi = new PHPMailer(TRUE);
		$send_mail_azi->CharSet = "UTF-8";
		try {
			//PHP Simple Server settings
			/**/$send_mail_azi->IsSMTP();
			$send_mail_azi->SMTPDebug = 0;
			$send_mail_azi->SMTPAuth = true;
			$send_mail_azi->SMTPSecure = 'ssl';
			$send_mail_azi->Host = "smtps.aruba.it";
			$send_mail_azi->Port = 465;
			$send_mail_azi->Username = "sailingschool@yccs.it";
			$send_mail_azi->Password = "Ssych0-!!827:";
			
		 
			//PHP Files Attachments
			if ($file!="" && is_file($file)){
				$send_mail_azi->addAttachment($file);
			}
			 
			//Content
			$send_mail_azi->setFrom($from_email, $from_name);
			$send_mail_azi->addAddress($to_email, $to_name);
			//$send_mail_azi->addAddress('recipient2@yourdomain_name.com');
			//$send_mail_azi->addReplyTo('f.denegri@cwstudio.it', "Flavio De Negri");
			//$send_mail_azi->addCC('cc@yourdomain_name.com');
			//$send_mail_azi->addBCC('bcc@yourdomain_name.com');
			$send_mail_azi->isHTML(true); 
			$send_mail_azi->Subject = $subject;
			$send_mail_azi->Body    = $body; 			
			$send_mail_azi->AltBody  =  strip_tags($body);
			$send_mail_azi->send();
			//echo 'Good Luck Your Message has been sent';
			return "OK";
		} catch (Exception $e) {
			/*echo 'Sorry Dear, Message could not be sent.';
			echo 'Mailer Error: ' . $send_mail_azi->ErrorInfo;*/
			return "KO - Mailer Error: ".$send_mail_azi->ErrorInfo;
		}

		//return redirect('contact')->with('status', 'You have successfully sent an email to the admin!');

	}
}