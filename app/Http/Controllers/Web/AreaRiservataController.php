<?php
namespace App\Http\Controllers\Web;

use App\Models\Web\Currency;
use App\Models\Web\Index;
use App\Models\Web\Languages;
use App\Models\Web\News;
use App\Models\Web\Order;
use App\Models\Web\Products;
use Auth;
use Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Lang;
use View;
use DB;
use Cookie;
use Session;
use Config;
use App;
use App\Http\Controllers\MailController;
use App\Http\Controllers\Web\InvioMailController;
use App\Http\Controllers\Web\IndexController;
use App\Http\Controllers\CustomController;
use App\Http\Controllers\AdminControllers\AdminCustomController;

class AreaRiservataController extends Controller
{

    public function __construct(Index $index) 
	{
        $this->index = $index;
    }
	
	public function registrazioneAreaSoci(Request $request)
    {   
		$result = array();
		
		$CustomController = new CustomController();
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();	
		
        $cmd = "registrazione";
        $pagina = "registrazione";
		$bladeView="web.area_soci.".$pagina;		
		
		//Genero link per passaggio di lingua		
		$this_page_path_ita = Config::get('app.url')."/area-soci/$cmd.html";
		$this_page_path_eng = Config::get('app.url')."/en/area-soci/$cmd.html";	

		$metatag = array();
		$metatag['title'] = Lang::get('website.registrazione')." - ".Lang::get('website.area soci')." - ".config('app.name');
		$metatag['description'] = Lang::get('website.registrazione')." - ".Lang::get('website.area soci')." - ".config('app.name');	
				
		if(isset($_POST['nome'])) $nome=$_POST['nome']; else $nome="";
		if(isset($_POST['cognome'])) $cognome=$_POST['cognome']; else $cognome="";
		if(isset($_POST['email'])) $email=$_POST['email']; else $email="";
		if(isset($_POST['num_socio'])) $num_socio=$_POST['num_socio']; else $num_socio="";
		if(isset($_POST['password'])) $password=$_POST['password']; else $password="";
		$data=date("Y-m-d H:i:s");
		
		$secretKey = "6Lc8Fu0aAAAAAA_WeQ5MiPxz9OMrBI0l3T7t8pzl";
		$response = $_POST['g-recaptcha-response'];     
		$remoteIp = $_SERVER['REMOTE_ADDR'];

		$query_mailCheck = DB::table('clienti');
		$query_mailCheck = $query_mailCheck->select('id');
		$query_mailCheck = $query_mailCheck->WHERE('email','=',$email);
		$query_mailCheck = $query_mailCheck->get();
		$num_mailCheck = $query_mailCheck->count();	
		
		if($num_mailCheck>0){
			$message_color = "red";
			if($lingua=="ita") $message = "La mail inserita risulta gi&agrave; presente nel nostro database!";
			else $message = "The email entered is already present in our database!";
		}else{
			/*$reCaptchaValidationUrl = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response&remoteip=$remoteIp");
			$result = json_decode($reCaptchaValidationUrl, TRUE);				
					
			if($result['success'] == 1) {*/
			
			$captcha=$_POST['cf-turnstile-response'];
			$secretKey = "0x4AAAAAAADV408KKS7f7alVQVhqNkk4kC8";
			$ip = $_SERVER['REMOTE_ADDR'];

		   $url_path = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';
		   $data = array('secret' => $secretKey, 'response' => $captcha, 'remoteip' => $ip);
			
			$options = array(
				'http' => array(
					'method' => 'POST',
					'header' => 'Content-type:application/x-www-form-urlencoded',
					'content' => http_build_query($data)
				)
			);
			
			$stream = stream_context_create($options);
			
			$result = file_get_contents($url_path, false, $stream);
			
			$response =  $result;
		   
			$responseKeys = json_decode($response,true);
			if(intval($responseKeys["success"]) == 1) {
				//$password=crypt($password,$password);
				$password = password_hash($password, PASSWORD_DEFAULT);
				$string= array();
				$string["nome"]=$nome;
				$string["cognome"]=$cognome;
				$string["num_tessera"]=$num_socio;
				$string["livello"]="Registered";
				$string["email"]=$email;
				$string["password"]=$password;
				$string["data_registrazione"]=date("Y-m-d H:i:s");
				$string["abilitato"]='0';
				$string["confermato"]='0';
				$string["approvato"]='0';
				$id_reg = DB::table('clienti')->insertGetId($string); 
				
				$mail_sito = env('APP_EMAIL');
				$ind_sito = env('APP_URL');
				$nome_del_sito = env('APP_NAME');
				$logo_sito = $ind_sito."/".env('APP_LOGO');
				
				include(base_path('resources/views/web/common/body_mail.css.php'));
				
				$dati = "";
				$dati_eng = "";
				if($email!="") {
					$dati .= "<b>Email:&nbsp;</b>$email<br />";
					$dati_eng .= "<b>Email:&nbsp;</b>$email<br />";
				}
				if($num_socio!="") {
					$dati .= "<b>Tessera Socio n.:&nbsp;</b>$num_socio<br />";
					$dati_eng .= "<b>Surname:&nbsp;</b>$num_socio<br />";
				}
				
				$nome_cliente = ucfirst($nome);
				$cognome_cliente = ucfirst($cognome);
				
				$testo_azi ="
					<br><br><br>
					Un utente (<b>$cognome_cliente $nome_cliente</b>) si è iscritto al sito.
					<br><br>
					$dati
				";
				
				$testo_cli ="
					<br><br><br>
					Gentile <b>$cognome_cliente $nome_cliente</b> 
					<br><br>
					Abbiamo il piacere di informarLa che la Sua richiesta dovrà essere approvata dal nostro team amministrativo.
					<br><br>
					Il Suo account ha i seguenti dettagli:
					<br><br>
					$dati
					<br/><br/>
					Cordiali saluti,
				";
				$testo_cli_eng ="
					<br><br><br>
					Dear <b>$cognome_cliente $nome_cliente</b>
					<br><br>
					We are pleased to inform you that application has been activated by our administration team.
					<br><br>
					The details of your account are:
					<br><br>
					$dati_eng
					<br/><br/>
					Best regards,
				";
				
				$body_azi = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_azi , $body);
				$oggetto_azi = "Iscrizione nuovo utente";
				if($lingua=="ita"){
					$body_cli = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_cli, $body);			
					$oggetto_cli = "Yacht Club Costa Smeralda - La Registrazione è in attesa di Approvazione";
				}
				else {
					$body_cli = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_cli_eng, $body);			
					$oggetto_cli = "Yacht Club Costa Smeralda - Your Registration is Pending Approval";		
				}
				$MailController = new MailController();
				//sendMail($from_email, $from_name, $to_email, $to_name, $subject, $body, $file="")
				$invioMail_azi = $MailController->sendMail($mail_sito,$nome_del_sito,$mail_sito,$nome_del_sito, $oggetto_azi, $body_azi); 
				$invioMail_cli = $MailController->sendMail($mail_sito,$nome_del_sito,$email,$nome_del_sito, $oggetto_cli, $body_cli); 
				
				if($invioMail_azi=="OK"){
					$message_color = "#81c868";
					$message = Lang::get("Email inviata con successo");"";				
				}else{
					$message_color = "red";
					$message = "Error! $invioMail_azi";
				}
			}else{
				$message_color = "red";
				$message = "Error!";				
			}
		}
				
		$view = view($bladeView);
		$view = $view->with('result', $result);
		$view = $view->with('metatag', $metatag);
		$view = $view->with('cmd', $cmd);
		$view = $view->with('pagina', $pagina);
		$view = $view->with('lingua', $lingua);
		if(isset($nome) && $nome!="") $view = $view->with('nome', $nome);
		if(isset($cognome) && $cognome!="") $view = $view->with('cognome', $cognome);
		if(isset($email) && $email!="") $view = $view->with('email', $email);
		if(isset($num_socio) && $num_socio!="") $view = $view->with('num_socio', $num_socio);
		$view = $view->with('this_page_path_ita', $this_page_path_ita);
		$view = $view->with('this_page_path_eng', $this_page_path_eng);
		$view = $view->with('message_color', $message_color);
		$view = $view->withErrors($message);
        return $view;
	}
	
	public function loginAreaSoci(Request $request)
    {
		$CustomController = new CustomController();
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();	
		
        $cmd = "login";
        $pagina = "login";
		$bladeView="web.area_soci.".$pagina;		
		
		$metatag = array();		
				
		$metatag['title'] = Lang::get('website.accedi')." - ".Lang::get('website.area soci')." - ".config('app.name');
		$metatag['description'] = Lang::get('website.accedi')." - ".Lang::get('website.area soci')." - ".config('app.name');
		
		//Genero link per passaggio di lingua		
		$this_page_path_ita = Config::get('app.url')."/login.html";
		$this_page_path_eng = Config::get('app.url')."/en/login.html";		
        
		if(isset($_SESSION['set_loggato_yccs'])) $set_loggato_yccs=$_SESSION['set_loggato_yccs']; else $set_loggato_yccs=0;
		if(isset($_SESSION['id_loggato_yccs'])) $id_loggato_yccs=$_SESSION['id_loggato_yccs']; else $id_loggato_yccs="";
		if(isset($_POST['user_login'])) $user_login=$_POST['user_login']; else $user_login="";
		if(isset($_POST['pass_login'])) $pass_login=$_POST['pass_login']; else $pass_login="";
		if(isset($_SESSION['nome_utente_yccs'])) $nome_utente_yccs=$_SESSION['nome_utente_yccs']; else $nome_utente_yccs="";		
		if(isset($_POST['memorizza'])) $memorizza = $_POST['memorizza']; else $memorizza = false;
		
		$expires = time()+(60*60*24*60); /* exp in due mesi */
		
		$data_att = date("Y-m-d");
		$oggi = date('Ymd');
		$message = "";
		$message_color = "green";
		
		if($user_login && $pass_login && !$set_loggato_yccs){
			$query = DB::table('clienti');
            $query = $query->select('*');
			$query = $query->where('email', '=', $user_login);
			$query = $query->where('approvato', '=', '1');
			$query = $query->get();
			
			$num_rec = $query->count();
			
			if($num_rec>0) {
				$user = $query[0];
				$check_password = 0;
				
				if(Cookie::get('mio_user_yccs')===null || (Cookie::get('mio_user_yccs')!==null && $user_login!=Cookie::get('mio_user_yccs'))){
					
					$db_password = $user->password;

					// CONTROLLA IL FORMATO
					$is_new_format = false;
					if (strlen($db_password) > 50 && (strpos($db_password, '$2y$') === 0 || strpos($db_password, '$2a$') === 0 || strpos($db_password, '$argon2') === 0)) {
						$is_new_format = true;
					}
					
					//if(crypt($pass_login, $query[0]->password) ==  $query[0]->password || $pass_login ==  $query[0]->password)
					//	$check_password = 1;
					if ($is_new_format) {
						// Nuova password: password_hash()
						if (password_verify($pass_login, $db_password)) {
							$check_password = 1;
						}
					} else {
						if (crypt($pass_login, $db_password) == $db_password || $pass_login == $db_password) {
							$new_password = password_hash($pass_login, PASSWORD_DEFAULT);

							DB::table('clienti')
								->where('id', $user->id)
								->update(['password' => $new_password]);

							$check_password = 1;
						}
					}
				}
				if(Cookie::get('mio_user_yccs')!==null && $user_login==Cookie::get('mio_user_yccs'))
					$check_password = 1;
				
				if($check_password == 1){	
					$id_log = $query[0]->id;
					
					$_SESSION["user_loggato"] = "si";
					$_SESSION["user_id_login"] = $id_log;
					$_SESSION["user_nome_login"] = $query[0]->nome;
					
					if($memorizza=="on"){
						Cookie::queue('mio_user_yccs',$user_login, $expires);
					}
					
					$query_agg2 = DB::table('clienti')->where('id','=', $id_log)->update([
						'data_ultimo_accesso'	=>	date("Y-m-d H:i:s")
						]);
					
					$message_color = "green";
					if($lingua=="ita") $message = "Login effettuato";
					else $message = "Login successful";
				}else{
					$message_color = "red";
					if($lingua=="ita") $message = "Attenzione: la username o la password non corrispondono, oppure il tuo account non è ancora attivo!";
					else $message = "Attention: Wrong Username or Password, or your account is not active!";
				}
			}else{
				$message_color = "red";
				if($lingua=="ita") $message = "Attenzione: la username o la password non corrispondono, oppure il tuo account non è ancora attivo!";
				else $message = "Attention: Wrong Username or Password, or your account is not active!";				
				
			}
		} 
				
		$view = view($bladeView);
		$view = $view->with('metatag', $metatag);
		$view = $view->with('cmd', $cmd);
		$view = $view->with('pagina', $pagina);
		$view = $view->with('lingua', $lingua);
		
		$view = $view->with('this_page_path_ita', $this_page_path_ita);
		$view = $view->with('this_page_path_eng', $this_page_path_eng);
		$view = $view->with('message_color', $message_color);
		$view = $view->withErrors($message);
		
		return $view;
    }
	
	public function recuperaPasswordAreaSoci(Request $request)
    {   
		$result = array();
		
		$CustomController = new CustomController();
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();	
		
        $cmd = "recupera-password";
        $pagina = "recupera-password";
		$bladeView="web.area_soci.".$pagina;		
		
		//Genero link per passaggio di lingua		
		$this_page_path_ita = Config::get('app.url')."/area-soci/$cmd.html";
		$this_page_path_eng = Config::get('app.url')."/en/area-soci/$cmd.html";	

		$metatag = array();
		$metatag['title'] = Lang::get('website.recupera password')." - ".Lang::get('website.area soci')." - ".config('app.name');
		$metatag['description'] = Lang::get('website.recupera password')." - ".Lang::get('website.area soci')." - ".config('app.name');	
				
		if(isset($_POST['email_rec'])) $email=$_POST['email_rec']; else $email="";
		
		$secretKey = env('GOOGLE_RECAPTCHA_SECRET_KEY_V2');
		$response = $_POST['g-recaptcha-response'];     
		$remoteIp = $_SERVER['REMOTE_ADDR'];

		$query_mailCheck = DB::table('clienti');
		$query_mailCheck = $query_mailCheck->select('*');
		$query_mailCheck = $query_mailCheck->WHERE('email','=',$email);
		//dd($query_mailCheck->toSql(), $query_mailCheck->getBindings());
		$query_mailCheck = $query_mailCheck->get();
		$num_mailCheck = $query_mailCheck->count();	
		
		if($num_mailCheck>0){
			$reCaptchaValidationUrl = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response&remoteip=$remoteIp");
			$result = json_decode($reCaptchaValidationUrl, TRUE);				
					
			if($result['success'] == 1) {
				$nome=$query_mailCheck[0]->nome;
				$cognome=$query_mailCheck[0]->cognome;												
				$link_cambia="cambia-password-".$query_mailCheck[0]->id.".html";
				
				$mail_sito = env('APP_EMAIL');
				$ind_sito = env('APP_URL');
				$nome_del_sito = env('APP_NAME');
				$logo_sito = $ind_sito."/".env('APP_LOGO');
				
				include(base_path('resources/views/web/common/body_mail.css.php'));
				
				$dati = "";
				$dati_eng = "";
				if($email!="") {
					$dati .= "<b>Email:&nbsp;</b>$email<br />";
					$dati_eng .= "<b>Email:&nbsp;</b>$email<br />";
				}
				
				$nome_cliente = ucfirst($nome);
				$cognome_cliente = ucfirst($cognome);
				
				$testo_azi ="
					<br><br><br>
					Un utente (<b>$cognome_cliente $nome_cliente</b>) si è iscritto al sito.
					<br><br>
					$dati
				";
				
				$testo_cli ="
					<br><br><br>
					Gentile <b>$cognome_cliente $nome_cliente</b> 
					<br><br>
					Ti preghiamo di seguire il link sotto riportato per accedere alla procedura di cambio password:
					<br><br>
					<a href=\"".config('app.url')."/$link_cambia\">".config('app.url')."/$link_cambia</a>
					<br/><br/>
					Cordiali saluti,
				";
				$testo_cli_eng ="
					<br><br><br>
					Dear <b>$cognome_cliente $nome_cliente</b>
					<br><br>
					Please follow the link below to access the procedure for changing your password:
					<br><br>
					<a href=\"".config('app.url')."/en/$link_cambia\">".config('app.url')."/$link_cambia</a>
					<br/><br/>
					Best regards,
				";
				
				if($lingua=="ita"){
					$body_cli = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_cli, $body);			
					$oggetto_cli = "Yacht Club Costa Smeralda - Recupera Password";
				}
				else {
					$body_cli = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_cli_eng, $body);			
					$oggetto_cli = "Yacht Club Costa Smeralda - Password Recovery";		
				}
				$MailController = new MailController();
				//sendMail($from_email, $from_name, $to_email, $to_name, $subject, $body, $file="")
				$invioMail_cli = $MailController->sendMail($mail_sito,$nome_del_sito,$email,$nome_del_sito, $oggetto_cli, $body_cli); 
				
				if($invioMail_cli=="OK"){
					$message_color = "#81c868";
					$message = Lang::get("Email inviata con successo");"";				
				}else{
					$message_color = "red";
					$message = "Error!";
				}
			}else{
				$message_color = "red";
				$message = "Error!";
			}
		}else{
			$message_color = "red";
			if($lingua=="ita") $message = "Email Sconosciuta!<br/>La mail inserita non corrisponde a nessuno dei nostri soci iscritti.";
			else $message = "Email Unknown!<br/>The email entered does not correspond to any of our registered members.";
		}
		
		$view = view($bladeView);
		$view = $view->with('metatag', $metatag);
		$view = $view->with('cmd', $cmd);
		$view = $view->with('pagina', $pagina);
		$view = $view->with('lingua', $lingua);
		
		$view = $view->with('this_page_path_ita', $this_page_path_ita);
		$view = $view->with('this_page_path_eng', $this_page_path_eng);
		$view = $view->with('message_color', $message_color);
		$view = $view->withErrors($message);
		
		return $view;
	}
	
	public function logout(Request $request)
    {				
		
		$SESSION = array();
		session_destroy();		
		session_unset();
		$_SESSION['FBID'] = NULL;
		$_SESSION['EMAIL'] =  NULL;
		$_SESSION['LOGOUT'] = NULL;			
		
		return redirect()->back();
	}
	
	public function pagCambiaPasswordAreaSoci(Request $request,$id_cli="")
	{
		$IndexController = new IndexController();
		return $IndexController->index($request, $cmd="cambia-password","","",$id_cli);
	}
	public function iMieiOrdiniAreaSoci(Request $request,$status="")
	{
		$IndexController = new IndexController();
		return $IndexController->index($request, $cmd="i-miei-ordini","","",$status);
	}
		
	public function cambiaPasswordAreaSoci($id_dett)
    {
        $result = array();
		
		$CustomController = new CustomController();
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();	
				
        $cmd="cambia-password";
        $pagina="cambia-password";
		
		$metatag = array();
		$metatag['title'] = Lang::get('website.cambia password')." - ".Lang::get('website.area soci')." - ".config('app.name');
		$metatag['description'] = Lang::get('website.cambia password')." - ".Lang::get('website.area soci')." - ".config('app.name');	
		
		//Genero link per passaggio di lingua		
		$this_page_path_ita = Config::get('app.url')."/$cmd-$id_dett.html";
		$this_page_path_eng = Config::get('app.url')."/en/$cmd-$id_dett.html";		

		if(isset($_POST['stato']) && $_POST['stato']=="inviato") {
			if(isset($_POST['email'])) $email=$_POST['email']; else $email="";
			if(isset($_POST['password'])) $password=$_POST['password']; else $password="";
			if(isset($_POST['password_conf'])) $password_conf=$_POST['password_conf']; else $password_conf="";
			
			$query = DB::table('clienti');
            $query = $query->select('*');
			$query = $query->where('id', '=', $id_dett);
            //dd($query->toSql(), $query->getBindings());
			$query = $query->get();
			$num_email = $query->count();	
			
			if($num_email>0 && $email==$query[0]->email){
				
				//$password=crypt($password,$password);
				$password = password_hash($password, PASSWORD_DEFAULT);
				$query_up = DB::table('clienti')->where('id','=',$id_dett)->update([
						'password'	=>	$password
						]);
						
				$message_color = "#81c868";
				if($lingua=="ita") $message = "<b>
									La password &egrave; stata aggiornata con successo.<br/>
									Ora potrai accedere alla tua area riservata con la nuova password.
									</b>";				
				else $message = "<b>
									The password was successfully updated.<br/>
									Now you can access your reserved area with the new password
									</b>";				
				
			}else{
				$message_color = "red";
				if($lingua=="ita") $message = 	"<b>ATTENZIONE!!<br/>Non &egrave; possibile procedere con la procedura di cambio password.<br/><br/>
												La mail inserita non corrisponde all'account di cui si vuole cambiare la password.</b>";				
				else $message = 	"<b>ATTENTION!!<br/>It is not possible to proceed with the password change procedure.<br/><br/>
									The email entered does not correspond to the account whose password you want to change.</b>";				
			}
		}
		
        
		$view = view("web.area_soci.cambia-password");
		$view = $view->with('result', $result);
		$view = $view->with('metatag', $metatag);
		$view = $view->with('cmd', $cmd);
		$view = $view->with('pagina', $pagina);
		$view = $view->with('lingua', $lingua);
		$view = $view->with('this_page_path_ita', $this_page_path_ita);
		$view = $view->with('this_page_path_eng', $this_page_path_eng);
		$view = $view->with('message_color', $message_color);
		$view = $view->withErrors($message);
        return $view;
    }
	
	public function modificaProfiloAreaSoci()
    {
        $result = array();
		
		$CustomController = new CustomController();
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();	
				
        $cmd="profilo-socio";
        $pagina="profilo-socio";
		
		$metatag = array();
		$metatag['title'] = Lang::get('website.profilo socio')." - ".Lang::get('website.area soci')." - ".config('app.name');
		$metatag['description'] = Lang::get('website.profilo socio')." - ".Lang::get('website.area soci')." - ".config('app.name');	
		
		//Genero link per passaggio di lingua		
		$this_page_path_ita = Config::get('app.url')."/area-soci/$cmd.html";
		$this_page_path_eng = Config::get('app.url')."/en/area-soci/$cmd.html";

		if(isset($_POST['stato_mod']) && $_POST['stato_mod']=="1") {
			
			if(isset($_POST['nome'])) $nome=$_POST['nome'];
			if(isset($_POST['cognome'])) $cognome=$_POST['cognome'];
			if(isset($_POST['num_tessera'])) $num_tessera=$_POST['num_tessera'];
			
			$string_mod= array();
			if(isset($nome)) $string_mod['nome']=$nome;
			if(isset($cognome)) $string_mod['cognome']=$cognome;
			if(isset($num_tessera)) $string_mod['num_tessera']=$num_tessera;
			
			$query_mod = DB::table('clienti');
			$query_mod = $query_mod->where('id','=',$_SESSION["user_id_login"]);
			$query_mod = $query_mod->update($string_mod);
						
			$message_color = "#81c868";
			if($lingua=="ita") $message = "<b>
								I suoi dati sono stati correttamente modificati
								</b>";				
			else $message = "<b>
								Your data has been correctly modified
								</b>";			
		}
		
        
		$view = view("web.area_soci.".$pagina);
		$view = $view->with('result', $result);
		$view = $view->with('metatag', $metatag);
		$view = $view->with('cmd', $cmd);
		$view = $view->with('pagina', $pagina);
		$view = $view->with('lingua', $lingua);
		$view = $view->with('this_page_path_ita', $this_page_path_ita);
		$view = $view->with('this_page_path_eng', $this_page_path_eng);
		$view = $view->with('message_color', $message_color);
		$view = $view->withErrors($message);
        return $view;
    }
	
    public function boutique(Request $request, $nome_cat="", $id_cat="", $nome_sottocat="", $id_sottocat="", $nome_dett="", $id_dett="")
    {
		$result = array();
		
		$CustomController = new CustomController();
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();
		$mysidname = $CustomController->checkSession();	
        $cmd="la-boutique";
        $pagina="la-boutique";
		
		$metatag = array();
		$metatag['title'] = Lang::get('website.la boutique')." - ".Lang::get('website.area soci')." - ".config('app.name');
		
		//Genero link per passaggio di lingua		
		$this_page_path_ita = Config::get('app.url')."/area-soci/$cmd";
		if($nome_cat!="" && $id_cat!="") {
			$query_c = DB::table('categorie')
				->select('nome','nome_eng')
				->where('id','=',$id_cat)
				->get();
			$num_c=$query_c->count();
			if($num_c>0){
				$nome_c = $query_c[0]->nome;
				if($lingua=="eng" && isset($query_c[0]->nome_eng) && $query_c[0]->nome_eng!="") $nome_c = $query_c[0]->nome_eng;
				$metatag['title'] = $nome_c." - ".$metatag['title'];
				
				$this_page_path_ita .= "/".$nome_cat."-".$id_cat;
			}else{		
				if($lingua=="ita")
					return redirect(Config::get('app.url')."/404.html");
				else
					return redirect(Config::get('app.url')."/en/404.html");	
				
			}
		}
		if($nome_sottocat!="" && $id_sottocat!="") {
			$query_s = DB::table('sottocategorie')
				->select('nome','nome_eng')
				->where('id','=',$id_sottocat)
				->get();			
			$num_s=$query_s->count();
			
			if($num_s>0){
				$nome_s = $query_s[0]->nome;
				if($lingua=="eng" && isset($query_s[0]->nome_eng) && $query_s[0]->nome_eng!="") $nome_s = $query_s[0]->nome_eng;
				$metatag['title'] = $nome_s." - ".$metatag['title'];
				
				$this_page_path_ita .= "/".$nome_sottocat."-".$id_sottocat;
			}else{		
				if($lingua=="ita")
					return redirect(Config::get('app.url')."/404.html");
				else
					return redirect(Config::get('app.url')."/en/404.html");	
				
			}
		}
		if($nome_dett!="" && $id_dett!="") {
			$query_p = DB::table('prodotti')
				->select('nome','nome_eng')
				->where('id','=',$id_dett)
				->get();		
			$num_p=$query_p->count();
			
			if($num_p>0){
				$nome_p = $query_p[0]->nome;
				if($lingua=="eng" && isset($query_p[0]->nome_eng) && $query_p[0]->nome_eng!="") $nome_p = $query_p[0]->nome_eng;
				$metatag['title'] = $nome_p." - ".$metatag['title'];
				
				$this_page_path_ita .= "/".$nome_dett."-".$id_dett;
			}else{		
				if($lingua=="ita")
					return redirect(Config::get('app.url')."/404.html");
				else
					return redirect(Config::get('app.url')."/en/404.html");	
				
			}
		}
		$this_page_path_ita .= ".html";
		$this_page_path_eng = str_replace('area-soci/','en/area-soci/',$this_page_path_ita);
		
		$metatag['description'] = $metatag['title'];	
		
		$view = view("web.area_soci.".$pagina);
		$view = $view->with('result', $result);
		$view = $view->with('mysidname', $mysidname);
		$view = $view->with('metatag', $metatag);
		$view = $view->with('cmd', $cmd);
		$view = $view->with('pagina', $pagina);
		$view = $view->with('lingua', $lingua);
		$view = $view->with('this_page_path_ita', $this_page_path_ita);
		$view = $view->with('this_page_path_eng', $this_page_path_eng);
		if(isset($nome_cat)) $view = $view->with('nome_cat', $nome_cat);
		if(isset($id_cat)) $view = $view->with('id_cat', $id_cat);
		if(isset($nome_sottocat)) $view = $view->with('nome_sottocat', $nome_sottocat);
		if(isset($id_sottocat)) $view = $view->with('id_sottocat', $id_sottocat);
		if(isset($id_dett)) $view = $view->with('id_dett', $id_dett);
		if(isset($message_color)) $view = $view->with('message_color', $message_color);
		if(isset($message)) $view = $view->withErrors($message);
        return $view;
	}
	
    public function prodottiDett(Request $request, $nome_cat="", $id_cat="", $nome_sottocat="", $id_sottocat="", $nome_dett="", $id_dett="")
    {
		$result = array();
		
		$CustomController = new CustomController();
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();	
		$mysidname = $CustomController->checkSession();	
				
        $cmd="prodotti_dett";
        $pagina="prodotti_dett";
		
		$metatag = array();
		$metatag['title'] = Lang::get('website.la boutique')." - ".Lang::get('website.area soci')." - ".config('app.name');
		
		//Genero link per passaggio di lingua		
		$this_page_path_ita = Config::get('app.url')."/area-soci/la-boutique";
		if($nome_cat!="" && $id_cat!="") {
			$query_c = DB::table('categorie')
				->select('nome','nome_eng')
				->where('id','=',$id_cat)
				->get();
			$num_c=$query_c->count();
			if($num_c>0){
				$nome_c = $query_c[0]->nome;
				if($lingua=="eng" && isset($query_c[0]->nome_eng) && $query_c[0]->nome_eng!="") $nome_c = $query_c[0]->nome_eng;
				$metatag['title'] = $nome_c." - ".$metatag['title'];
				
				$this_page_path_ita .= "/".$nome_cat."-".$id_cat;
			}else{		
				if($lingua=="ita")
					return redirect(Config::get('app.url')."/404.html");
				else
					return redirect(Config::get('app.url')."/en/404.html");	
				
			}
		}
		if($nome_sottocat!="" && $id_sottocat!="" && $id_sottocat!="0") {
			$query_s = DB::table('sottocategorie')
				->select('nome','nome_eng')
				->where('id','=',$id_sottocat)
				->get();	
			$num_s=$query_s->count();
			
			if($num_s>0){
				$nome_s = $query_s[0]->nome;
				if($lingua=="eng" && isset($query_s[0]->nome_eng) && $query_s[0]->nome_eng!="") $nome_s = $query_s[0]->nome_eng;
				$metatag['title'] = $nome_s." - ".$metatag['title'];
				
				$this_page_path_ita .= "/".$nome_sottocat."-".$id_sottocat;
			}else{		
				if($lingua=="ita")
					return redirect(Config::get('app.url')."/404.html");
				else
					return redirect(Config::get('app.url')."/en/404.html");	
				
			}
		}
		if($nome_dett!="" && $id_dett!="") {
			$query_p = DB::table('prodotti')
				->select('*')
				->where('id','=',$id_dett)
				->get();	
			$num_p=$query_p->count();
			
			if($num_p>0){
				$nome_p = $query_p[0]->nome;
				if($lingua=="eng" && isset($query_p[0]->nome_eng) && $query_p[0]->nome_eng!="") $nome_p = $query_p[0]->nome_eng;
				$metatag['title'] = $nome_p." - ".$metatag['title'];
				
				$this_page_path_ita .= "/".$nome_dett."-".$id_dett;
			}else{		
				if($lingua=="ita")
					return redirect(Config::get('app.url')."/404.html");
				else
					return redirect(Config::get('app.url')."/en/404.html");	
				
			}
		}
		$this_page_path_ita .= ".html";
		$this_page_path_eng = str_replace('area-soci/','en/area-soci/',$this_page_path_ita);
		
		$metatag['description'] = $metatag['title'];	
		
		$view = view("web.area_soci.".$pagina);
		$view = $view->with('result', $result);
		$view = $view->with('mysidname', $mysidname);
		$view = $view->with('metatag', $metatag);
		$view = $view->with('cmd', $cmd);
		$view = $view->with('pagina', $pagina);
		$view = $view->with('lingua', $lingua);
		$view = $view->with('this_page_path_ita', $this_page_path_ita);
		$view = $view->with('this_page_path_eng', $this_page_path_eng);
		if(isset($nome_cat)) $view = $view->with('nome_cat', $nome_cat);
		if(isset($id_cat)) $view = $view->with('id_cat', $id_cat);
		if(isset($nome_sottocat)) $view = $view->with('nome_sottocat', $nome_sottocat);
		if(isset($id_sottocat)) $view = $view->with('id_sottocat', $id_sottocat);
		if(isset($id_dett)) $view = $view->with('id_dett', $id_dett);
		if(isset($query_p)) $view = $view->with('query_dett', $query_p);
		if(isset($message_color)) $view = $view->with('message_color', $message_color);
		if(isset($message)) $view = $view->withErrors($message);
        return $view;
	}
	
    public function guidoneAreaSoci(Request $request)
    {  
		$result = array();
		
		$CustomController = new CustomController();
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();	
		
        $cmd = "certificato-di-guidone";
        $pagina = "certificato-di-guidone";
		$bladeView="web.area_soci.".$pagina;		
		
		//Genero link per passaggio di lingua		
		$this_page_path_ita = Config::get('app.url')."/area-soci/$cmd.html";
		$this_page_path_eng = Config::get('app.url')."/en/area-soci/$cmd.html";	

		$metatag = array();
		$metatag['title'] = Lang::get('website.certificato di guidone')." - ".Lang::get('website.area soci')." - ".config('app.name');
		$metatag['description'] = Lang::get('website.certificato di guidone')." - ".Lang::get('website.area soci')." - ".config('app.name');	
				
		if(isset($_POST['nome'])) {
			$nome = $_POST['nome'];
		} else{
			$nome = "";
		}
		
		$preferenza = "";
		if(isset($_POST['p_posta'])) {
			$p_posta = $_POST['p_posta'];
		} else{
			$p_posta = "off";
		}
		if ($p_posta=="on") $preferenza .= "Posta"; 
		
		if(isset($_POST['p_email'])) {
			$p_email = $_POST['p_email'];
		} else{
			$p_email = "off";
		}
		if ($p_email=="on" && $preferenza!="") $preferenza .= " - Email"; 
			elseif ($p_email=="on") $preferenza .= "Email"; 
		
		if(isset($_POST['p_fax'])) {
			$p_fax = $_POST['p_fax'];
		} else{
			$p_fax = "off";
		}
		if ($p_fax=="on" && $preferenza!="") $preferenza .= " - Fax"; 
			elseif ($p_fax=="on") $preferenza .= "Fax";
			
		if(isset($_POST['p_tel'])) {
			$p_tel = $_POST['p_tel'];
		} else{
			$p_tel = "off";
		}
		if ($p_tel=="on" && $preferenza!="") $preferenza .= " - Telefono"; 
			elseif ($p_tel=="on") $preferenza .= "Telefono";
		
		if(isset($_POST['imbarcazione'])) {
			$imbarcazione = $_POST['imbarcazione'];
		} else{
			$imbarcazione = "";
		}
		
		if(isset($_POST['bandiera'])) {
			$bandiera = $_POST['bandiera'];
		} else{
			$bandiera = "";
		}
		
		$tipo = "";
		if(isset($_POST['t_vela'])) {
			$t_vela = $_POST['t_vela'];
		} else{
			$t_vela = "off";
		}
		if ($t_vela=="on") $tipo = "Vela";

		if(isset($_POST['t_motore'])) {
			$t_motore = $_POST['t_motore'];
		} else{
			$t_motore = "off";
		}
		if ($t_motore=="on") $tipo = "a Motore";
		
		if(isset($_POST['colore'])) {
			$colore = $_POST['colore'];
		} else{
			$colore = "";
		}
		
		if(isset($_POST['cantiere'])) {
			$cantiere = $_POST['cantiere'];
		} else{
			$cantiere = "";
		}
		
		if(isset($_POST['email'])) {
			$email = $_POST['email'];
		} else{
			$email = "";
		}
		
		if(isset($_POST['progettista'])) {
			$progettista = $_POST['progettista'];
		} else{
			$progettista = "";
		}
		
		if(isset($_POST['modello'])) {
			$modello = $_POST['modello'];
		} else{
			$modello = "";
		}
				
		if(isset($_POST['anno'])) {
			$anno = $_POST['anno'];
		} else{
			$anno = "";
		}
				
		if(isset($_POST['materiale'])) {
			$materiale = $_POST['materiale'];
		} else{
			$materiale = "";
		}
		
		if(isset($_POST['lunghezza'])) {
			$lunghezza = $_POST['lunghezza'];
		} else{
			$lunghezza = "";
		}
		
		if(isset($_POST['larghezza'])) {
			$larghezza = $_POST['larghezza'];
		} else{
			$larghezza = "";
		}
		
		if(isset($_POST['pescaggio'])) {
			$pescaggio = $_POST['pescaggio'];
		} else{
			$pescaggio = "";
		}
		
		if(isset($_POST['motore'])) {
			$motore = $_POST['motore'];
		} else{
			$motore = "";
		}
		
		if(isset($_POST['potenza'])) {
			$potenza = $_POST['potenza'];
		} else{
			$potenza = "";
		}
		
		if(isset($_POST['num_velico'])) {
			$num_velico = $_POST['num_velico'];
		} else{
			$num_velico = "";
		}
		
		$porto_cervo = "No";
		if(isset($_POST['posto_cervo_on'])) {
			$posto_cervo_on = $_POST['posto_cervo_on'];
		} else{
			$posto_cervo_on = "off";
		}
		if ($posto_cervo_on=="on") $porto_cervo = "Sì";
			
		if(isset($_POST['num_posto_cervo'])) {
			$num_posto_cervo = $_POST['num_posto_cervo'];
		} else{
			$num_posto_cervo = "";
		}

		$virgin_gorda = "No";
		if(isset($_POST['posto_gorda_on'])) {
			$posto_gorda_on = $_POST['posto_gorda_on'];
		} else{
			$posto_gorda_on = "off";
		}
		if ($posto_gorda_on=="on") $virgin_gorda = "Sì";

		if(isset($_POST['num_posto_gorda'])) {
			$num_posto_gorda = $_POST['num_posto_gorda'];
		} else{
			$num_posto_gorda = "";
		}
		
		$altra_marina = "";
		if(isset($_POST['posto_altro_on'])) {
			$posto_altro_on = $_POST['posto_altro_on'];
		} else{
			$posto_altro_on = "off";
		}
		if(isset($_POST['posto_altro_off'])) {
			$posto_altro_off = $_POST['posto_altro_off'];
		} else{
			$posto_altro_off = "off";
		}
		if ($posto_altro_on=="on") $altra_marina = "Sì";
			elseif ($posto_altro_off=="on") $altra_marina = "No";
		
		if(isset($_POST['citta'])) {
			$citta = $_POST['citta'];
		} else{
			$citta = "";
		}
		
		if(isset($_POST['manutenzione'])) {
			$manutenzione = $_POST['manutenzione'];
		} else{
			$manutenzione = "";
		}
		
		if(isset($_POST['permanenza'])) {
			$permanenza = $_POST['permanenza'];
		} else{
			$permanenza = "";
		}
		
		if(isset($_POST['comandante'])) {
			$comandante = $_POST['comandante'];
		} else{
			$comandante = "";
		}
		
		if(isset($_POST['contatti'])) {
			$contatti = $_POST['contatti'];
		} else{
			$contatti = "";
		}
		
		if(isset($_POST['note'])) {
			$note = $_POST['note'];
		} else{
			$note = "";
		}
		
		if(isset($_POST['posto_cervo_off'])) {
			$posto_cervo_off  = $_POST['posto_cervo_off'];
		} else{
			$posto_cervo_off  = "";
		}
		
		if(isset($_POST['num_cervo'])) {
			$num_cervo  = $_POST['num_cervo'];
		} else{
			$num_cervo  = "";
		}
		
		if(isset($_POST['posto_gorda_off'])) {
			$posto_gorda_off  = $_POST['posto_gorda_off'];
		} else{
			$posto_gorda_off  = "";
		}
		
		if(isset($_POST['num_gorda'])) {
			$num_gorda  = $_POST['num_gorda'];
		} else{
			$num_gorda  = "";
		}
		
		if(isset($_POST['privacy'])) $privacy=$_POST['privacy']; else $privacy="0";
		
		if (isset($_POST['stato_cert']) && $_POST['stato_cert']=="1") { 
			$secretKey = env('GOOGLE_RECAPTCHA_SECRET_KEY_V2');
			$response = $_POST['g-recaptcha-response'];     
			$remoteIp = $_SERVER['REMOTE_ADDR'];
			
			$reCaptchaValidationUrl = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response&remoteip=$remoteIp");
			$result = json_decode($reCaptchaValidationUrl, TRUE);				
					
			if($result['success'] == 1) {
				
				$mail_sito = env('APP_EMAIL');
				$ind_sito = env('APP_URL');
				$nome_del_sito = env('APP_NAME');
				$logo_sito = $ind_sito."/".env('APP_LOGO');
				
				include(base_path('resources/views/web/common/body_mail.css.php'));
				
				$dati = "";
				$dati = "<b>Nome e Cognome del Socio:&nbsp;</b>$nome<br />";
				
				if((isset($_POST['p_posta']) && $_POST['p_posta']!="off") || (isset($_POST['p_email']) && $_POST['p_email']!="off") || (isset($_POST['p_fax']) && $_POST['p_fax']!="off") || (isset($_POST['p_tel']) && $_POST['p_tel']!="off"))
				{
					$dati .= "<b>Preferenza per essere contattato:&nbsp;</b>$preferenza<br />";
				}
				
				$dati .= "<b>Nome imbarcazione:&nbsp;</b>$imbarcazione<br />";				
				$dati .= "<b>Bandiera:&nbsp;</b>$bandiera<br />";				
				$dati .= "<b>Tipo Imbarcazione:&nbsp;</b>$tipo<br />";
				
				if(isset($_POST['colore']) && $_POST['colore']!="")
				{
					$colore = stripslashes($_POST['colore']);
					$dati .= "<b>Colore:&nbsp;</b>$colore<br />";
				}
				
				$dati .= "<b>Cantiere:&nbsp;</b>$cantiere<br />";				
				$dati .= "<b>Progettista:&nbsp;</b>$progettista<br />";
				
				if(isset($_POST['modello']) && $_POST['modello']!="")
				{
					$modello = stripslashes($_POST['modello']);
					$dati .= "<b>Modello:&nbsp;</b>$modello<br />";
				}
				
				$dati .= "<b>Anno:&nbsp;</b>$anno<br />";
				
				if(isset($_POST['materiale']) && $_POST['materiale']!="")
				{
					$materiale = stripslashes($_POST['materiale']);
					$dati .= "<b>Materiale di costruzione:&nbsp;</b>$materiale<br />";
				}
				
				$dati .= "<b>Lunghezza:&nbsp;</b>$lunghezza<br />";				
				$dati .= "<b>Larghezza:&nbsp;</b>$larghezza<br />";				
				$dati .= "<b>Pescaggio:&nbsp;</b>$pescaggio<br />";
				
				if(isset($_POST['motore']) && $_POST['motore']!="")
				{
					$motore = stripslashes($_POST['motore']);
					$dati .= "<b>Motore:&nbsp;</b>$motore<br />";
				}
				
				if(isset($_POST['potenza']) && $_POST['potenza']!="")
				{
					$potenza = stripslashes($_POST['potenza']);
					$dati .= "<b>Potenza cavalli:&nbsp;</b>$potenza<br />";
				}
				
				if(isset($_POST['num_velico']) && $_POST['num_velico']!="")
				{
					$num_velico = stripslashes($_POST['num_velico']);
					$dati .= "<b>Nr. Velico:&nbsp;</b>$num_velico<br />";
				}
				
				$dati .= "<b>Posto barca a Porto Cervo:&nbsp;</b>$porto_cervo<br />";
				
				if(isset($_POST['num_cervo']) && $_POST['num_cervo']!="")
				{
					$num_cervo = stripslashes($_POST['num_cervo']);
					$dati .= "<b>Nr.:&nbsp;</b>$num_cervo<br />";
				}
				
				if(isset($_POST['porto_gorda']) && $_POST['porto_gorda']!="")
				{
					$dati .= "<b>Posto barca a Virgin Gorda:&nbsp;</b>$porto_gorda<br />";
				}
								
				if(isset($_POST['num_gorda']) && $_POST['num_gorda']!="")
				{
					$num_gorda = stripslashes($_POST['num_gorda']);
					$dati .= "<b>Nr. VG:&nbsp;</b>$num_gorda<br />";
				}
				
				if($altra_marina!="")
				{
					$dati .= "<b>Posto barca altra Marina:&nbsp;</b>$altra_marina<br />";
				}
					
				if(isset($_POST['citta']) && $_POST['citta']!="")
				{
					$citta = stripslashes($_POST['citta']);
					$dati .= "<b>Citt&agrave;/Paese:&nbsp;</b>$citta<br />";
				}
				
				if(isset($_POST['manutenzione']) && $_POST['manutenzione']!="")
				{
					$manutenzione = stripslashes($_POST['manutenzione']);
					$dati .= "<b>Nome cantiere di manutenzione di fiducia:&nbsp;</b>$manutenzione<br />";
				}
				
				if(isset($_POST['permanenza']) && $_POST['permanenza']!="")
				{
					$permanenza = stripslashes($_POST['permanenza']);
					$dati .= "<b>Porto di abituale permanenza:&nbsp;</b>$permanenza<br />";
				}
				
				if(isset($_POST['comandante']) && $_POST['comandante']!="")
				{
					$comandante = stripslashes($_POST['comandante']);
					$dati .= "<b>Nome Comandante:&nbsp;</b>$comandante<br />";
				}
				
				$dati .= "<b>Contatti:&nbsp;</b>$contatti<br />";				
				$dati .= "<b>Email:&nbsp;</b>$email<br />";				
				$dati .= "<b>Note Aggiuntive:</b><br/><br />$note<br /><br /><br />";
				
				$nome_cliente = ucfirst($nome);
				
				$testo_azi ="
					<br><br><br>
					Report di Notifica del sito Web - Un Socio ha inviato una richiesta di emissione del <b>'Certificato di Guidone'</b>:
					<br><br>
					$dati
				";
				
				$testo_cli ="
					<br><br><br>
					Gentile <b>$nome_cliente</b> 
					<br><br>
					La sua richiesta è stata ricevuta: provvederemo al più presto a contattarla in risposta.
					<br><br>
					Questi sono i dati che ha fornito:
					<br><br>
					$dati
					<br/><br/>
					Cordiali saluti,
				";
				
				$body_azi = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_azi , $body);
				$oggetto_azi = "Richiesta Certificato di Guidone";
				
				$body_cli = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_cli, $body);			
				$oggetto_cli = "Yacht Club Costa Smeralda - Richiesta Certificato di Guidone";
				
				$MailController = new MailController();
				//sendMail($from_email, $from_name, $to_email, $to_name, $subject, $body, $file="")
				//$invioMail_azi = $MailController->sendMail($mail_sito,$nome_del_sito,"f.denegri@cwstudio.it",$nome_del_sito, $oggetto_azi, $body_azi); 
				$invioMail_azi = $MailController->sendMail($mail_sito,$nome_del_sito,"centrosportivo@yccs.it",$nome_del_sito, $oggetto_azi, $body_azi); 
				$invioMail_azi = $MailController->sendMail($mail_sito,$nome_del_sito,"members@yccs.it",$nome_del_sito, $oggetto_azi, $body_azi); 
				$invioMail_cli = $MailController->sendMail($mail_sito,$nome_del_sito,$email,$nome_del_sito, $oggetto_cli, $body_cli); 
				
				if($invioMail_azi=="OK"){
					$message_color = "#81c868";
					$message = Lang::get("Email inviata con successo");"";				
				}else{
					$message_color = "red";
					$message = "Error!";
				}
			}else{
				$message_color = "red";
				$message = "Error!";				
			}			
		}else{
			$message_color = "red";
			$message = "Error!";	
		}
				
		$view = view($bladeView);
		$view = $view->with('result', $result);
		$view = $view->with('metatag', $metatag);
		$view = $view->with('cmd', $cmd);
		$view = $view->with('pagina', $pagina);
		$view = $view->with('lingua', $lingua);
		if(isset($nome) && $nome!="") $view = $view->with('nome', $nome);
		if(isset($cognome) && $cognome!="") $view = $view->with('cognome', $cognome);
		if(isset($email) && $email!="") $view = $view->with('email', $email);
		if(isset($num_socio) && $num_socio!="") $view = $view->with('num_socio', $num_socio);
		$view = $view->with('this_page_path_ita', $this_page_path_ita);
		$view = $view->with('this_page_path_eng', $this_page_path_eng);
		$view = $view->with('message_color', $message_color);
		$view = $view->withErrors($message);
        return $view;
	}
	
}