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
use App\Http\Controllers\CustomController;
use App\Http\Controllers\AdminControllers\AdminCustomController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class RegateController extends Controller
{
	public function index($anno_regata="")
	{
		if($anno_regata==""){
			$CustomController = new CustomController();		
			// recupero lingua corrente	
			$lingua = $CustomController->checkLanguage();	
			$link_redirect = "regate-";
			if($lingua=="eng") $link_redirect = "en/regate-";
			$link_redirect .= date("Y");
			$link_redirect .= ".html";
			
			return redirect('/'.$link_redirect, 301);
		}else{
			$result = array();
	   
			$CustomController = new CustomController();		
			// recupero lingua corrente	
			$lingua = $CustomController->checkLanguage();		
			
			$mysidname = $CustomController->checkSession();
			
			$metatag = array();
			
			$cmd="regate";
			$pagina="regate";
			$bladeView="web.regate.regate";
			
			$this_page_path_ita = Config::get('app.url')."/regate-$anno_regata.html";
			$this_page_path_eng = Config::get('app.url')."/en/regate-$anno_regata.html";
			
			$metatag = array();
			$metatag['title'] = "Yacht Club Costa Smeralda - ".Lang::get("website.$pagina title")." ".$anno_regata;
			$metatag['description'] = $metatag['title']." - ".Lang::get("website.$pagina description");	
			
			$calendario_ed = $presentazione_ed = "";
			$link_fisso_calendario=0;
			
			
			$view = view($bladeView);
			$view = $view->with('result', $result);
			$view = $view->with('metatag', $metatag);
			$view = $view->with('cmd', $cmd);
			$view = $view->with('pagina', $pagina);
			$view = $view->with('lingua', $lingua);
			$view = $view->with('mysidname', $mysidname);
			$view = $view->with('anno_regata', $anno_regata);		
			$view = $view->with('calendario_ed', $calendario_ed);		
			$view = $view->with('link_fisso_calendario', $link_fisso_calendario);		
			$view = $view->with('presentazione_ed', $presentazione_ed);		
			if(isset($testo_lista) && $testo_lista!="") $view = $view->with('testo_lista', $testo_lista);		
			if(isset($pdf_lista) && $pdf_lista!="") $view = $view->with('pdf_lista', $pdf_lista);		
			$view = $view->with('pag_att', 1);		
			
			$view = $view->with('this_page_path_ita', $this_page_path_ita);
			$view = $view->with('this_page_path_eng', $this_page_path_eng);
			
			return $view;
		}
	}
	public function regate($anno_regata="", $nome_regata="",$id_dett="", $cmd="dettaglio_regata", $active="")
    {
		$result = array();
       
		$CustomController = new CustomController();		
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();		
		
		$mysidname = $CustomController->checkSession();
		
		$metatag = array();
		
		$pagina = "regate";
		
		$query_v = DB::table('edizioni_regate');
		$query_v = $query_v->select('id');
		$query_v = $query_v->where('visibile','=','1');
		$query_v = $query_v->where('id','=',$id_dett);
		//dd($query_v->toSql(), $query_v->getBindings());
		$query_v = $query_v->get();
		$num_v = $query_v->count();		
		
		if($num_v==0){
			$bladeView="web.404";
			$cmd="404";
			
			$metatag['title'] = "404";
			$metatag['description'] = "404";							
			
			//Genero link per passaggio di lingua		
			$this_page_path_ita = Config::get('app.url')."/404.html";
			$this_page_path_eng = Config::get('app.url')."/en/404.html";
		}else{					
			$query_ed = DB::table('edizioni_regate');
			$query_ed = $query_ed->select('*');
			$query_ed = $query_ed->where('id','=',$id_dett);
			$query_ed = $query_ed->where('visibile','=','1');
			//$query_ed = $query_ed->where('new','=','1');
			//dd($query_ed->toSql(), $query_ed->getBindings());
			$query_ed = $query_ed->get();
			$num_ed = $query_ed->count();
			
			$query_reg = DB::table('regate')
				->select('*')
				->where('id','=',$query_ed[0]->id_regata)
				->get();
			
			$link_esterno  = $query_ed[0]->link_esterno;
			if($lingua=="eng" &&  $query_ed[0]->link_esterno_eng && trim($query_ed[0]->link_esterno_eng!="")) $link_esterno = $query_ed[0]->link_esterno_eng;
			
			if($num_ed>0) {				
				if($query_ed[0]->new2==1) {						
					$bladeView="web.dettaglio_regata_v3";
					$cmd="dettaglio_regata";
				}elseif($query_ed[0]->new==1) {						
					$bladeView="web.dettaglio_regata_v2";
					$cmd="dettaglio_regata";
				}else{
					$cmd="dettaglio_regata";
					$bladeView="web.dettaglio_regata_v1";
				}
			}
			
			$pagina = $cmd; 
			
			$metatag['title'] = $query_ed[0]->nome_regata." - ".$anno_regata." - ".$query_ed[0]->luogo;
			$metatag['description'] = $query_ed[0]->nome_regata." - ".$anno_regata." - ".$query_ed[0]->luogo;			
			
			$active_tab="";
			if($active!="") $active_tab=$active."/";
			//Genero link per passaggio di lingua		
			$this_page_path_ita = Config::get('app.url')."/regate-".$anno_regata."/".$active_tab.$nome_regata."-".$id_dett.".html";
			$this_page_path_eng = Config::get('app.url')."/en/regattas-".$anno_regata."/".$active_tab.$nome_regata."-".$id_dett.".html";
			
			$colore_testo = $query_ed[0]->colore_testo;
			$colore = $query_ed[0]->colore;
			$colore_rgb=$CustomController->hex2rgb($colore);
			$colore_rgb=$colore_rgb[0].",".$colore_rgb[1].",".$colore_rgb[2];
			$colore_testo_rgb=$CustomController->hex2rgb($colore_testo);
			$colore_testo_rgb=$colore_testo_rgb[0].",".$colore_testo_rgb[1].",".$colore_testo_rgb[2];
		}
		
		
		if(isset($link_esterno) && trim($link_esterno!="")){
			return redirect($link_esterno);					
		}else{
			$view = view($bladeView);
			$view = $view->with('result', $result);
			$view = $view->with('metatag', $metatag);
			$view = $view->with('cmd', $cmd);
			$view = $view->with('pagina', $pagina);
			$view = $view->with('lingua', $lingua);
			$view = $view->with('mysidname', $mysidname);
			$view = $view->with('anno_regata', $anno_regata);
			$view = $view->with('nome_regata', $nome_regata);
			$view = $view->with('active', $active);
			if(isset($colore)) $view = $view->with('colore', $colore);
			if(isset($colore_testo)) $view = $view->with('colore_testo', $colore_testo);
			if(isset($colore_rgb)) $view = $view->with('colore_rgb', $colore_rgb);
			if(isset($colore_testo_rgb)) $view = $view->with('colore_testo_rgb', $colore_testo_rgb);
			$view = $view->with('id_dett', $id_dett);
			if($num_v>0) $view = $view->with('value_ed', $query_ed[0]);
			if($num_v>0) $view = $view->with('value_reg', $query_reg[0]);
			
			$view = $view->with('this_page_path_ita', $this_page_path_ita);
			$view = $view->with('this_page_path_eng', $this_page_path_eng);
			
			return $view;	
		}
	}
	public function galleryRegata($anno_regata="", $tipo="", $nome_regata="",$id_dett="")
    {
		$result = array();       
		$CustomController = new CustomController();		
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();			
		$lingua=="ita" ? $language="it" : $language="en";
		
		$mysidname = $CustomController->checkSession();		
		$metatag = array();
				
		$query_v = DB::table('edizioni_regate');
		$query_v = $query_v->select('id');
		$query_v = $query_v->where('visibile','=','1');
		$query_v = $query_v->where('id','=',$id_dett);
		$query_v = $query_v->get();
		$num_v = $query_v->count();
		if($num_v==0){
			if($lingua=="ita")
				return redirect(Config::get('app.url')."/404.html");
			else
				return redirect(Config::get('app.url')."/en/404.html");				
		}else{	
			$query_ed = DB::table('edizioni_regate');
			$query_ed = $query_ed->select('*');
			$query_ed = $query_ed->where('id','=',$id_dett);
			$query_ed = $query_ed->where('visibile','=','1');
			$query_ed = $query_ed->get();
			$num_ed = $query_ed->count();
			
			$cmd = $tipo."_regata";
			$pagina = $cmd; 
			$bladeView = "web.regate_".$tipo;
			
			$metatag['title'] = Lang::get("website.comunicati stampa",[],$language)." - ".$query_ed[0]->nome_regata." - ".$anno_regata." - ".$query_ed[0]->luogo;
			$metatag['description'] = Lang::get("website.comunicati stampa",[],$language)." - ".$query_ed[0]->nome_regata." - ".$anno_regata." - ".$query_ed[0]->luogo;			
			
			//Genero link per passaggio di lingua		
			$this_page_path_ita = Config::get('app.url')."/regate-".$anno_regata."/fotogallery/".$nome_regata."-".$id_dett.".html";
			$this_page_path_eng = Config::get('app.url')."/en/regattas-".$anno_regata."/fotogallery/".$nome_regata."-".$id_dett.".html";
		}
		
		if($lingua=="ita")
			$link_regata = Config::get('app.url')."/regate-".$anno_regata."/".$nome_regata."-".$id_dett.".html";
		else
			$link_regata = Config::get('app.url')."/en/regate-".$anno_regata."/".$nome_regata."-".$id_dett.".html";
		
		$view = view($bladeView);
		$view = $view->with('result', $result);
		$view = $view->with('metatag', $metatag);
		$view = $view->with('cmd', $cmd);
		$view = $view->with('lingua', $lingua);
		$view = $view->with('mysidname', $mysidname);
		$view = $view->with('anno_regata', $anno_regata);
		$view = $view->with('id_dett', $id_dett);
		$view = $view->with('link_regata', $link_regata);
		if($num_v>0) $view = $view->with('value_ed', $query_ed[0]);
		
		$view = $view->with('this_page_path_ita', $this_page_path_ita);
		$view = $view->with('this_page_path_eng', $this_page_path_eng);
		
		return $view;	
	}
	public function redirectPdf($anno_regata="", $nome_regata="", $id_dett="",$sez="", $id_doc="", $nome_doc="")
    {
		//dd($anno_regata,$nome_regata,$id_dett,$sez,$id_doc,$nome_doc,);
		$table = "edizioni_doc";
		$query = DB::table($table)
			->select('file','file_eng')
			->where('id_edizione','=',$id_dett)
			->where('id','=',$id_doc)
			->get();
		
		//$link_file = config('app.url')."/resarea/files/regate/doc/".$query[0]->file;
		//return redirect()->to($link_file);
			
		$url_file = public_path().DIRECTORY_SEPARATOR.'redirectPdf/'.$query[0]->file;
		$url_file = File::get($url_file);
		$response = Response::make($url_file,200);
		$response->header('Content-Type', 'application/pdf');
		return $response;	
	}
	
	public function regateFoto($anno_regata="", $nome_regata="",$id_dett="")
    {
		return $this->regate($anno_regata, $nome_regata,$id_dett, "dettaglio_regata", 'foto');
	}
	
	public function regateSez($anno_regata="", $sez="", $nome_regata="",$id_dett="")
    {
		return $this->regate($anno_regata, $nome_regata,$id_dett, "dettaglio_regata", $sez);
	}		
	
	public function ajaxRichiestaContatti(Request $request)
    {		
		$result = array();
		
		$bladeView="web.dettaglio_regata.crew_board_richiesta_contatti";
		
		if(isset($_GET['id_dett'])) $id_dett=$_GET['id_dett']; else $id_dett=""; 
		if(isset($_GET['ind'])) $ind=$_GET['ind']; else $ind=""; 
		if(isset($_GET['lingua'])) $lingua=$_GET['lingua']; else $lingua="ita"; 
		
		$view = view($bladeView);
		$view = $view->with('result', $result);
		$view = $view->with('lingua', $lingua);
		$view = $view->with('id_dett', $id_dett);
		$view = $view->with('ind', $ind);
		
		return $view;	
	}
	
	public function crewBoatInvioRichiestaContatti($anno_regata, $nome_regata, $id_dett){
		$CustomController = new CustomController();		
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();	
		$messaggio="";
		if(isset($_POST['statoAsk']) && $_POST['statoAsk']=="inviato"){
			
			$secretKey = '6LemiVIUAAAAAJUhoWV1HxBM7Pb-tDOeOLZXjQBS';
			$response = isset($_POST["g-recaptcha-response"]) ? $_POST['g-recaptcha-response'] : null;    
			$remoteIp = $_SERVER['REMOTE_ADDR'];


			$reCaptchaValidationUrl = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response&remoteip=$remoteIp");
			$result = json_decode($reCaptchaValidationUrl, TRUE);
			
			if($_POST["g-recaptcha-response"] && trim($_POST["g-recaptcha-response"])!="" && $result['success'] == 1) {
			
				if(isset($_POST['nomeAsk'])) $nomeAsk=$_POST['nomeAsk']; else $nomeAsk="";
				if(isset($_POST['cognomeAsk'])) $cognomeAsk=$_POST['cognomeAsk']; else $cognomeAsk="";
				if(isset($_POST['emailAsk'])) $emailAsk=$_POST['emailAsk']; else $emailAsk="";
				if(isset($_POST['telefonoAsk'])) $telefonoAsk=$_POST['telefonoAsk']; else $telefonoAsk="";
				if(isset($_POST['id_richiesta'])) $id_richiesta=$_POST['id_richiesta']; else $id_richiesta="";
				if(isset($_POST['messaggioAsk'])) $messaggioAsk=$_POST['messaggioAsk']; else $messaggioAsk="";
				
				$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$codiceAsk = '';
				for ($i = 0; $i < 15; $i++) {
					$codiceAsk .= $characters[rand(0, strlen($characters)-1)];
				}
				
				$string= array();
				$string["data"]=date('Y-m-d H:i:s');
				$string["nome"]=$nomeAsk;
				$string["cognome"]=$cognomeAsk;
				$string["email"]=$emailAsk;
				if(isset($telefonoAsk)) $string["telefono"]=$telefonoAsk;
				if(isset($messaggioAsk)) $string["messaggio"]=$messaggioAsk;
				$string["id_richiesta"]=$id_richiesta;
				$string["codice"]=$codiceAsk;
				$id_reg = DB::table('edizioni_richieste_contatti')->insertGetId($string); 
				
				$query_ut = DB::table('crew_board')
					->select('email', 'nome')
					->where('id', '=', $id_richiesta)
					->get();
				$email = $query_ut[0]->email;
				$nome_crew = $query_ut[0]->nome;
				
				$link_conferma=config('app.url')."/crew_boat_accept_request-".$codiceAsk;
				
				$dati="<b>Nome</b>:$nomeAsk<br/>";
				$dati_eng="<b>Name</b>:$nomeAsk<br/>";
				$dati.="<b>Cognome</b>:$cognomeAsk<br/>";
				$dati_eng.="<b>Surname</b>:$cognomeAsk<br/>";
				$dati.="<b>Email</b>:$emailAsk<br/>";
				$dati_eng.="<b>Email</b>:$emailAsk<br/>";
				$dati.="<b>Telefono</b>:$telefonoAsk<br/>";
				$dati_eng.="<b>Phone</b>:$telefonoAsk<br/>";
				$dati.="<b>Messaggio</b>:$messaggioAsk<br/>";
				$dati_eng.="<b>Message</b>:$messaggioAsk<br/>";
				
				$nome_cliente = ucfirst($nome_crew);
				
				if($lingua=="ita"){
					$oggetto_cli = "Richiesta Contatti";
					$testo_cliente ="<br><br><br>Gentile <b>$nome_cliente</b>,
					<br><br>L'utente $nomeAsk $cognomeAsk ha richiesto i suoi contatti.
					<br/>Segue riepilogo dei dati forniti dal richiedente:
					<br><br>
					$dati
					<br><br>
					<a href='$link_conferma'>
						<div style='width:200px; border-radius:3px; background:#005cb9; text-align:center;'>
							<div style='padding:4px 0px; color:#fff'><b>INVIA DATI</b></div>
						</div>
					</a>";
				}else{
					$oggetto_cli = "Contact Request";		
					$testo_cliente ="<br><br><br>Dear <b>$nome_cliente</b>,
					<br><br>The user $nomeAsk $cognomeAsk has requested your contacts.
					<br/>Summary of user-supplied data:
					<br><br>
					$dati_eng
					<br><br>
					<a href='$link_conferma'>
						<div style='width:200px; border-radius:3px; background:#005cb9; text-align:center;'>
							<div style='padding:4px 0px; color:#fff'><b>SEND DATA</b></div>
						</div>
					</a>";
				}
				
				$mail_sito = env('APP_EMAIL');
				$ind_sito = env('APP_URL');
				$nome_del_sito = env('APP_NAME');
				$logo_sito = $ind_sito."/".env('APP_LOGO');
				
				include("resources/views/web/common/body_mail_crew_boat.css.php");
				
				$body_cli = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_cliente, $body);							
				
				$MailController = new MailController();
				$invioMail_cli = $MailController->sendMail($mail_sito,$nome_del_sito,$email,$nome_del_sito, $oggetto_cli, $body_cli); 
				
				if($lingua=="ita"){
					$messaggio = "La richiesta di contatti è stata inviata.\n Se verra' accettata ricevera' i dati per email.";
				}else{
					$messaggio = "The contact request has been sent.\n If the request is accepted you will receive the data by email.";
				}
			}else{
				if($lingua=="ita"){
					$messaggio = "Errore! prego provare piu' tardi.";
				}else{
					$messaggio = "Error! Please retry later.";
				}
			}
		}elseif(isset($_POST['stato']) && $_POST['stato']=="inviato"){ 
			$secretKey = '6LemiVIUAAAAAJUhoWV1HxBM7Pb-tDOeOLZXjQBS';
			$response = isset($_POST["g-recaptcha-response"]) ? $_POST['g-recaptcha-response'] : null;    
			$remoteIp = $_SERVER['REMOTE_ADDR'];


			$reCaptchaValidationUrl = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response&remoteip=$remoteIp");
			$result = json_decode($reCaptchaValidationUrl, TRUE);
			
			if($_POST["g-recaptcha-response"] && trim($_POST["g-recaptcha-response"])!="" && $result['success'] == 1) {
				if(isset($_POST['nome'])) $nome=$_POST['nome']; else $nome="";
				if(isset($_POST['email'])) $email=$_POST['email']; else $email="";
				if(isset($_POST['telefono'])) $telefono=$_POST['telefono']; else $telefono="";
				if(isset($_POST['tipo'])) $tipo=$_POST['tipo']; else $tipo="";
				if(isset($_POST['nome_barca'])) $nome_barca=$_POST['nome_barca']; else $nome_barca="";
				if(isset($_POST['tipo_barca'])) $tipo_barca=$_POST['tipo_barca']; else $tipo_barca="";
				if(isset($_POST['esperienza'])) $esperienza=$_POST['esperienza']; else $esperienza="";
				if(isset($_POST['posizione'])) $posizione=$_POST['posizione']; else $posizione="";
				if(isset($_POST['commento'])) $commento=$_POST['commento']; else $commento="";
				if(isset($_POST['sailing_status'])) $sailing_status=$_POST['sailing_status']; else $sailing_status="";
				
				$commento=str_replace("'","\'",$commento);
				$nome=str_replace("'","\'",$nome);
				$nome_barca=str_replace("'","\'",$nome_barca);
				$tipo_barca=str_replace("'","\'",$tipo_barca);
				
				$commento=str_replace('"','\"',$commento);
				$nome=str_replace('"','\"',$nome);
				$nome_barca=str_replace('"','\"',$nome_barca);
				$tipo_barca=str_replace('"','\"',$tipo_barca);
				$data=date("Y-m-d H:i:s");
				
				$string= array();
				if(isset($id_dett)) $string["id_rife"]=$id_dett;
				if(isset($data)) $string["data"]=$data;
				if(isset($nome)) $string["nome"]=$nome;
				if(isset($email)) $string["email"]=$email;
				if(isset($telefono)) $string["telefono"]=$telefono;
				if(isset($tipo)) $string["tipo"]=$tipo;
				if(isset($nome_barca)) $string["nome_barca"]=$nome_barca;
				if(isset($tipo_barca)) $string["tipo_barca"]=$tipo_barca;
				if(isset($esperienza)) $string["esperienza"]=$esperienza;
				if(isset($posizione)) $string["posizione"]=$posizione;
				if(isset($commento)) $string["commento"]=$commento;
				if(isset($sailing_status)) $string["sailing_status"]=$sailing_status;
				$id_reg = DB::table('crew_board')->insertGetId($string); 
				
				$nome_cliente = ucfirst($nome);
						
				$temp=explode("@@",$posizione);
				$num_pos=count($temp);
				if($num_pos==10) $pos="tutte";
				else $pos=substr(str_replace("@@",", ",$posizione),2);
				
				$query_reg = DB::table('edizioni_regate')
					->select('id_regata','nome_regata')
					->where('id','=',$id_dett)
					->get();
				$id_reg = $query_reg[0]->id_regata;
				$nome_regata = $query_reg[0]->nome_regata;
				
				$link=config('app.url')."/resarea/admin.php?cmd=crew_board&id_rife=".$id_reg."&id_riferimento=$id_dett&pag_att=1";
					
				$testo_azi = "<br><br><br>Un utente (<b>$nome_cliente</b>) ha inviato una richiesta dalla sezione Crew/Boat Board per la regata <b>".$nome_regata." - $anno_regata</b>
					<br><br>
					Nome : $nome<br>
					Email : $email<br>
					Tipo di Iscrizione : $tipo<br>
					Esperienza : $esperienza<br>
					Nome della barca : $nome_barca<br>
					Tipo della barca : $tipo_barca<br>
					Sailing Status : $sailing_status<br>
					Posizione : $pos<br>
					Commento : $commento
					<br/><br/>
					Per attivare la candidatura andare nell'apposita sezione del backoffice:<br/>
					<a href=\"$link\">$link</a>
					";

				$mail_sito = env('APP_EMAIL');
				$ind_sito = env('APP_URL');
				$nome_del_sito = env('APP_NAME');
				$logo_sito = $ind_sito."/".env('APP_LOGO');
				
				include("resources/views/web/common/body_mail_crew_boat.css.php");
				
				$oggetto_azi = "Richiesta Crew/Boat Board";
				$body_azi = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_azi, $body);
				
				$MailController = new MailController();
				$invioMail_cli = $MailController->sendMail($mail_sito,$nome_del_sito,"secretariat@yccs.it",$nome_del_sito, $oggetto_azi, $body_azi);  
				//$invioMail_cli = $MailController->sendMail($mail_sito,$nome_del_sito,"f.denegri@cwstudio.it",$nome_del_sito, $oggetto_azi, $body_azi); 
				
				if($lingua=="ita"){
					$messaggio = "Email inviata correttamente!";
				}else{
					$messaggio = "Successful email!";
				}
			}else{
				if($lingua=="ita"){
					$messaggio = "Errore! prego provare piu' tardi.";
				}else{
					$messaggio = "Error! Please retry later.";
				}
			}
		}
		return back()->withErrors($messaggio);
	}
	
	public function crewBoatAcceptRequest($codice)
	{
		$result = array();
		
		$CustomController = new CustomController();
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();	
		
        $cmd="accept-request";
        $pagina="accept-request";
		$metatag = array();
		$metatag['title'] = "Richiesta Contatti";
		if($lingua=="eng") $metatag['title'] = "Request for contact details ";
		$metatag['description'] = $metatag['title'];
		
		//Genero link per passaggio di lingua		
		$this_page_path_ita = Config::get('app.url')."/crew_boat_accept_request-$codice";
		$this_page_path_eng = Config::get('app.url')."/en/crew_boat_accept_request-$codice";
		
		$view = view("web.dettaglio_regata.crew_boat_accept_request");
		$view = $view->with('result', $result);
		$view = $view->with('metatag', $metatag);
		$view = $view->with('cmd', $cmd);
		$view = $view->with('pagina', $pagina);
		$view = $view->with('lingua', $lingua);	
		$view = $view->with('this_page_path_ita', $this_page_path_ita);
		$view = $view->with('this_page_path_eng', $this_page_path_eng);
		
		$error_isc=0;
		if($codice!=""){
			$query_cod = DB::table('edizioni_richieste_contatti')
				->select('id_richiesta')
				->where('codice','=',$codice)
				->get();
			$num_cod = 	$query_cod->count();
			if($num_cod>0) {
				$error_isc=0;
				$id_richiesta = $query_cod[0]->id_richiesta;
			}
			else $error_isc=1;
		}else{$error_isc=1;}
		
		$post=0;
		if($error_isc==0){
			if(isset($_POST['stato_conf']) && $_POST['stato_conf']=='1'){
				$post=1;
				if(isset($_POST['email'])) $email=$_POST['email']; $email=trim($email);
				//dd($email);
				
				$query_ut = DB::table('crew_board')
					->select('*')
					->where('id','=',$id_richiesta)
					->get();	
				if($query_ut[0]->email == $email){
					
					$string_mod = array();
					$string_mod["accettato"] = '1';
					$query_up = DB::table('edizioni_richieste_contatti')	
						->where('codice','=',$codice)
						->update($string_mod);
					
					$dati="";
					$query_dati = DB::table('edizioni_richieste_contatti')
						->select('*')
						->where('codice','=',$codice)
						->get();
					
					$nome=$query_dati[0]->nome;
					$cognome=$query_dati[0]->cognome;
					$email_contatto=$query_dati[0]->email;
					$telefono=$query_dati[0]->telefono;
					
					$dati="";
					$dati_eng="";
					$dati.="Nome: <b>".$nome." - ".$cognome."</b><br/>";
					$dati_eng.="Name: <b>".$nome." - ".$cognome."</b><br/>";
					$dati.="Email: <b>".$email_contatto."</b><br/>";
					$dati_eng.="Email: <b>".$email_contatto."</b><br/>";
					$dati.="Telefono: <b>".$telefono."</b><br/>";
					$dati_eng.="Phone: <b>".$telefono."</b><br/>";
					
					$mail_sito = env('APP_EMAIL');
					$ind_sito = env('APP_URL');
					$nome_del_sito = env('APP_NAME');
					$logo_sito = $ind_sito."/".env('APP_LOGO');
					
					include("resources/views/web/common/body_mail_crew_boat.css.php");
					
					$nome_cliente = ucfirst($nome);
					$cognome_cliente = ucfirst($cognome);
					
					if($lingua=="ita"){
						$oggetto_ut = "Richiesta Contatti";
						$testo_cliente ="<br><br><br>Gentile <b>$nome_cliente</b> <b>$cognome_cliente</b>,
						<br><br>La sua richiesta dei dati di contatto è stata accettata.
						<br/>Ecco di seguito i dati richiesti:
						<br><br>
						$dati
						<br><br>";
					}else{
						$oggetto_ut = "Request for contact details";
						$testo_cliente ="<br><br><br>Dear <b>$nome_cliente</b> <b>$cognome_cliente</b>,
						<br><br>Your request for contact details has been accepted.
						<br/>Here is the data requested:
						<br><br>
						$dati_eng";
					}
					
					$body_cli = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_cliente, $body);
					$MailController = new MailController();
					//$invioMail_cli = $MailController->sendMail($mail_sito,$nome_del_sito,"f.denegri@cwstudio.it",$nome_del_sito, $oggetto_ut, $body_cli); 
					$invioMail_cli = $MailController->sendMail($mail_sito,$nome_del_sito,$email,$nome_del_sito, $oggetto_ut, $body_cli); 
					
					$message_color = "#81c868";
					if($lingua=="ita") $message = "I dati sono stati inviati correttamente";
					else $message = "The data was sent correctly";
				}else{	
					$post=0;
					$message_color = "red";
					if($lingua=="ita") $message = "Errore!<br/>
													L'indirizzo email per il quale si chiede conferma &egrave; errato";
					else $message = "Error!<br/>
									The email address for which you are asking for confirmation is incorrect";
				}
			}else{
				$post=0;
			}
		}else{
			$message_color = "red";
			if($lingua=="ita") $message = "Errore!<br/>
											Si prega di seguire nuovamente il link indicato nell'email";
			else $message = "Error!<br/>
							Please follow the link received in the email";
		}
		
		if(isset($post)) $view = $view->with('post', $post);
		if(isset($message_color)) $view = $view->with('message_color', $message_color);
		if(isset($message)) $view = $view->withErrors($message);
		
		return $view;
	}
	
	public function ajaxRegateList(Request $request)
    {		
		$CustomController = new CustomController();
		
		if(isset($_GET['anno'])) $anno=$_GET['anno']; else $anno="";
		if(isset($_GET['id_dett'])) $id_dett=$_GET['id_dett']; else $id_dett="";
		if(isset($_GET['lingua'])) $lingua=$_GET['lingua']; else $lingua="ita";
		
		$string='';
		
		$query_e = DB::table('edizioni_regate');
		$query_e = $query_e->select('id', 'id_regata', 'luogo', 'nome_regata');
		$query_e = $query_e->where('visibile', '=', '1');
		$query_e = $query_e->where('anno', '=', $anno);
		$query_e = $query_e->orderby('data_dal', 'ASC');
		$query_e = $query_e->orderby('ordine', 'DESC');
		//dd($query_e->toSql(), $query_e->getBindings());
		$query_e = $query_e->get();		
		$num_e = $query_e->count();
		if($num_e>0){
			foreach($query_e AS $key_e=>$value_e){
				$query_r = DB::table('regate');
				$query_r = $query_r->select('id', 'nome');
				$query_r = $query_r->where('id', '=', $value_e->id_regata);
				$query_r = $query_r->get();
				$num_r = $query_r->count();
				
				if($num_r>0){
					$titolo_regata=$value_e->nome_regata." - ".$value_e->luogo;
					$string.='<div style="width:100%; min-height:40px; border-bottom:solid 1px #fff; text-align:center;">';
						$string.='<div style="padding-top:6px;">';
							$string.='<a href="';
								if($lingua=="eng") $string.='en/';
								$string.='regate-'.$anno.'/'.$CustomController->to_htaccess_url($value_e->nome_regata).'-'.$value_e->id.'.html" style="color:#fff; font-size:14px" title="'.$titolo_regata.'">';
								if($id_dett==$value_e->id) $string.='<strong>';
									$string.=$value_e->nome_regata;
								if($id_dett==$value_e->id) $string.='</strong>';
							$string.='</a>';
						$string.='</div>';
					$string.='</div>';
				}
			}
		}
		return $string;
	}
	
	public function comunicati_regata($anno_regata="", $nome_regata="",$id_dett="", $cmd="new_comunicati")
    {
		$result = array();       
		$CustomController = new CustomController();		
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();			
		$lingua=="ita" ? $locale="it" : $locale="en";
		
		$mysidname = $CustomController->checkSession();		
		$metatag = array();
				
		$query_v = DB::table('edizioni_regate');
		$query_v = $query_v->select('id');
		$query_v = $query_v->where('visibile','=','1');
		$query_v = $query_v->where('id','=',$id_dett);
		$query_v = $query_v->get();
		$num_v = $query_v->count();
		if($num_v==0){
			if($lingua=="ita")
				return redirect(Config::get('app.url')."/404.html");
			else
				return redirect(Config::get('app.url')."/en/404.html");	
		}else{	
			$query_ed = DB::table('edizioni_regate');
			$query_ed = $query_ed->select('*');
			$query_ed = $query_ed->where('id','=',$id_dett);
			$query_ed = $query_ed->where('visibile','=','1');
			//$query_ed = $query_ed->where('new','=','1');
			//dd($query_ed->toSql(), $query_ed->getBindings());
			$query_ed = $query_ed->get();
			$num_ed = $query_ed->count();
			
			$colore_testo = $query_ed[0]->colore_testo;
			$colore = $query_ed[0]->colore;
			$colore_rgb=$CustomController->hex2rgb($colore);
			$colore_rgb=$colore_rgb[0].",".$colore_rgb[1].",".$colore_rgb[2];
			$colore_testo_rgb=$CustomController->hex2rgb($colore_testo);
			$colore_testo_rgb=$colore_testo_rgb[0].",".$colore_testo_rgb[1].",".$colore_testo_rgb[2];
			
			$bladeView="web.dettaglio_regata_v2.comunicati_list";
			
			$metatag['title'] = Lang::get("website.comunicati stampa",[],$locale)." - ".$query_ed[0]->nome_regata." - ".$anno_regata." - ".$query_ed[0]->luogo;
			$metatag['description'] = Lang::get("website.comunicati stampa",[],$locale)." - ".$query_ed[0]->nome_regata." - ".$anno_regata." - ".$query_ed[0]->luogo;			
			
			//Genero link per passaggio di lingua		
			$this_page_path_ita = Config::get('app.url')."/regate-".$anno_regata."/press/".$nome_regata."-".$id_dett.".html";
			$this_page_path_eng = Config::get('app.url')."/en/regattas-".$anno_regata."/press/".$nome_regata."-".$id_dett.".html";
		}
		
		$view = view($bladeView);
		$view = $view->with('result', $result);
		$view = $view->with('metatag', $metatag);
		$view = $view->with('cmd', $cmd);
		$view = $view->with('lingua', $lingua);
		$view = $view->with('mysidname', $mysidname);
		$view = $view->with('anno_regata', $anno_regata);
		$view = $view->with('colore', $colore);
		$view = $view->with('colore_testo', $colore_testo);
		$view = $view->with('colore_rgb', $colore_rgb);
		$view = $view->with('colore_testo_rgb', $colore_testo_rgb);
		$view = $view->with('id_dett', $id_dett);
		if($num_v>0) $view = $view->with('value_ed', $query_ed[0]);
		
		$view = $view->with('this_page_path_ita', $this_page_path_ita);
		$view = $view->with('this_page_path_eng', $this_page_path_eng);
		
		return $view;	
		
	}
	
	public function comunicati_regata_old($anno_regata="", $nome_regata="", $nome_dett="",$id_dett="", $cmd="comunicati_regate_old")
    {
		$result = array();       
		$CustomController = new CustomController();		
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();			
		$lingua=="ita" ? $language="it" : $language="en";
		
		$mysidname = $CustomController->checkSession();		
		$metatag = array();
				
		$query_v = DB::table('press');
		$query_v = $query_v->select('*');
		$query_v = $query_v->where('id','=',$id_dett);
		$query_v = $query_v->get();
		$num_v = $query_v->count();
		
		if($num_v==0){
			$bladeView="web.404";
			$cmd="404";
			$pagina = $cmd;
			
			$metatag['title'] = "404";
			$metatag['description'] = "404";							
			
			//Genero link per passaggio di lingua		
			$this_page_path_ita = Config::get('app.url')."/404.html";
			$this_page_path_eng = Config::get('app.url')."/en/404.html";
		}else{							
			$bladeView="web.dettaglio_regata_old.comunicati_post";
			$pagina = $cmd;
			
			$titolo = $query_v[0]->titolo;
			$titolo_eng = $titolo ;
			if($lingua=="eng" && isset($query_v[0]->titolo_eng) && $query_v[0]->titolo_eng!="") $titolo = $query_v[0]->titolo_eng;
			if($lingua=="eng" && isset($query_v[0]->titolo_eng) && $query_v[0]->titolo_eng!="") $titolo_eng = $query_v[0]->titolo_eng;
			
			$metatag['title'] = $titolo." - ".Lang::get('website.comunicati stampa')." - ".$anno_regata." - ".config('app.name');
			$metatag['description'] = $metatag['title'];			
			
			//Genero link per passaggio di lingua		
			$this_page_path_ita = Config::get('app.url')."/regate-".$anno_regata."/".$nome_regata."/comunicati/".$CustomController->to_htaccess_url($titolo)."-".$id_dett.".html";
			$this_page_path_eng = Config::get('app.url')."/en/regattas-".$anno_regata."/".$nome_regata."/comunicati/".$CustomController->to_htaccess_url($titolo_eng)."-".$id_dett.".html";
		}
		
		$view = view($bladeView);
		$view = $view->with('result', $result);
		$view = $view->with('metatag', $metatag);
		$view = $view->with('cmd', $cmd);
		$view = $view->with('pagina', $pagina);
		$view = $view->with('lingua', $lingua);
		$view = $view->with('mysidname', $mysidname);
		$view = $view->with('anno_regata', $anno_regata);
		$view = $view->with('id_press', $id_dett);
		if($num_v>0) $view = $view->with('value_press', $query_v[0]);
		
		$view = $view->with('this_page_path_ita', $this_page_path_ita);
		$view = $view->with('this_page_path_eng', $this_page_path_eng);
		
		return $view;	
		
	}
	
	public function post_regata($anno_regata="", $nome_regata="",$id_dett="",$titolo_press="",$id_press="", $cmd="new_post")
    {
		$result = array();       
		$CustomController = new CustomController();		
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();			
		$lingua=="ita" ? $language="it" : $language="en";
		
		$mysidname = $CustomController->checkSession();		
		$metatag = array();
		$query_v = DB::table('edizioni_regate');
		$query_v = $query_v->select('id');
		$query_v = $query_v->where('visibile','=','1');
		$query_v = $query_v->where('id','=',$id_dett);
		//dd($query_v->toSql(), $query_v->getBindings());
		$query_v = $query_v->get();
		$num_v = $query_v->count();
		
		if($num_v==0){
			if($lingua=="ita")
				return redirect(Config::get('app.url')."/404.html");
			else
				return redirect(Config::get('app.url')."/en/404.html");				
		}else{	
			$query_ed = DB::table('edizioni_regate');
			$query_ed = $query_ed->select('*');
			$query_ed = $query_ed->where('id','=',$id_dett);
			$query_ed = $query_ed->where('visibile','=','1');
			//$query_ed = $query_ed->where('new','=','1');
			//dd($query_ed->toSql(), $query_ed->getBindings());
			$query_ed = $query_ed->get();
			$num_ed = $query_ed->count();
						
			$bladeView="web.regate.regate_news";
			
			$query_press = DB::table('press')
				->select('*')
				->where('id','=',$id_press)
				->get();
			$num_press = $query_press->count();
			
			$testo = "";
			
			if($num_press==0){
				if($lingua=="ita")
					return redirect(Config::get('app.url')."/404.html");
				else
					return redirect(Config::get('app.url')."/en/404.html");				
			}else{
				$titolo_press = $query_press[0]->titolo;  
				$titolo_press_eng = $query_press[0]->titolo;
				if(isset($query_press[0]->titolo_eng) && $query_press[0]->titolo_eng!="") $titolo_press_eng = $query_press[0]->titolo_eng;
				$testo = $query_press[0]->testo;				
				
				if(!empty($query_press[0]->foto1)) $foto = $query_press[0]->foto1;
				else $foto = $query_press[0]->foto2;
									
				//$metatag['title'] = Lang::get("website.comunicati stampa",[],$language)." - ".$query_ed[0]->nome_regata." - ".$anno_regata." - ".$query_ed[0]->luogo;
				//$metatag['description'] = Lang::get("website.comunicati stampa",[],$language)." - ".$query_ed[0]->nome_regata." - ".$anno_regata." - ".$query_ed[0]->luogo;			
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/regate-".$anno_regata."/press/".$nome_regata."-".$id_dett."/".creaSlug($titolo_press,"")."-".$id_press.".html";
				$this_page_path_eng = Config::get('app.url')."/en/regattas-".$anno_regata."/press/".$nome_regata."-".$id_dett."/".creaSlug($titolo_press,"")."-".$id_press.".html";
			}
		}
		
		$view = view($bladeView);
		$view = $view->with('result', $result);
		//$view = $view->with('metatag', $metatag);
		$view = $view->with('cmd', $cmd);
		$view = $view->with('lingua', $lingua);
		//$view = $view->with('mysidname', $mysidname);
		$view = $view->with('anno_regata', $anno_regata);
		$view = $view->with('id_dett', $id_dett);
		$view = $view->with('id_press', $id_press);
		$view = $view->with('nome_regata', $nome_regata);
		$view = $view->with('titolo', $titolo_press);
		$view = $view->with('testo', $testo);
		$view = $view->with('foto', $foto);
		if($num_v>0) $view = $view->with('value_ed', $query_ed[0]);
		
		$view = $view->with('this_page_path_ita', $this_page_path_ita);
		$view = $view->with('this_page_path_eng', $this_page_path_eng);
		
		return $view;	
		
	}
	
	public function fotogallery_regata($anno_regata="", $nome_regata="",$id_dett="", $cmd="new_fotogallery")
    {
		$result = array();       
		$CustomController = new CustomController();		
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();			
		$lingua=="ita" ? $language="it" : $language="en";
		
		$mysidname = $CustomController->checkSession();		
		$metatag = array();
				
		$query_v = DB::table('edizioni_regate');
		$query_v = $query_v->select('id');
		$query_v = $query_v->where('visibile','=','1');
		$query_v = $query_v->where('id','=',$id_dett);
		$query_v = $query_v->get();
		$num_v = $query_v->count();
		if($num_v==0){
			if($lingua=="ita")
				return redirect(Config::get('app.url')."/404.html");
			else
				return redirect(Config::get('app.url')."/en/404.html");				
		}else{	
			$query_ed = DB::table('edizioni_regate');
			$query_ed = $query_ed->select('*');
			$query_ed = $query_ed->where('id','=',$id_dett);
			$query_ed = $query_ed->where('visibile','=','1');
			//$query_ed = $query_ed->where('new','=','1');
			//dd($query_ed->toSql(), $query_ed->getBindings());
			$query_ed = $query_ed->get();
			$num_ed = $query_ed->count();
			
			$colore_testo = $query_ed[0]->colore_testo;
			$colore = $query_ed[0]->colore;
			$colore_rgb=$CustomController->hex2rgb($colore);
			$colore_rgb=$colore_rgb[0].",".$colore_rgb[1].",".$colore_rgb[2];
			$colore_testo_rgb=$CustomController->hex2rgb($colore_testo);
			$colore_testo_rgb=$colore_testo_rgb[0].",".$colore_testo_rgb[1].",".$colore_testo_rgb[2];
			
			$bladeView="web.dettaglio_regata.foto_list";
			
			$metatag['title'] = Lang::get("website.comunicati stampa",[],$language)." - ".$query_ed[0]->nome_regata." - ".$anno_regata." - ".$query_ed[0]->luogo;
			$metatag['description'] = Lang::get("website.comunicati stampa",[],$language)." - ".$query_ed[0]->nome_regata." - ".$anno_regata." - ".$query_ed[0]->luogo;			
			
			//Genero link per passaggio di lingua		
			$this_page_path_ita = Config::get('app.url')."/regate-".$anno_regata."/fotogallery/".$nome_regata."-".$id_dett.".html";
			$this_page_path_eng = Config::get('app.url')."/en/regattas-".$anno_regata."/fotogallery/".$nome_regata."-".$id_dett.".html";
		}
		
		$view = view($bladeView);
		$view = $view->with('result', $result);
		$view = $view->with('metatag', $metatag);
		$view = $view->with('cmd', $cmd);
		$view = $view->with('lingua', $lingua);
		$view = $view->with('mysidname', $mysidname);
		$view = $view->with('anno_regata', $anno_regata);
		$view = $view->with('colore', $colore);
		$view = $view->with('colore_testo', $colore_testo);
		$view = $view->with('colore_rgb', $colore_rgb);
		$view = $view->with('colore_testo_rgb', $colore_testo_rgb);
		$view = $view->with('id_dett', $id_dett);
		if($num_v>0) $view = $view->with('value_ed', $query_ed[0]);
		
		$view = $view->with('this_page_path_ita', $this_page_path_ita);
		$view = $view->with('this_page_path_eng', $this_page_path_eng);
		
		return $view;	
		
	}
	
	public function entry_list_regata($anno_regata="", $nome_regata="",$id_dett="", $cmd="new_entry_list")
    {
		$result = array();       
		$CustomController = new CustomController();		
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();			
		$lingua=="ita" ? $language="it" : $language="en";
		
		$mysidname = $CustomController->checkSession();		
		$metatag = array();
				
		$query_v = DB::table('edizioni_regate');
		$query_v = $query_v->select('id');
		$query_v = $query_v->where('visibile','=','1');
		$query_v = $query_v->where('id','=',$id_dett);
		$query_v = $query_v->get();
		$num_v = $query_v->count();
		if($num_v==0){
			$bladeView="web.404";
			$cmd="404";
			
			$metatag['title'] = "404";
			$metatag['description'] = "404";							
			
			//Genero link per passaggio di lingua		
			$this_page_path_ita = Config::get('app.url')."/404.html";
			$this_page_path_eng = Config::get('app.url')."/en/404.html";
		}else{	
			$query_ed = DB::table('edizioni_regate');
			$query_ed = $query_ed->select('*');
			$query_ed = $query_ed->where('id','=',$id_dett);
			$query_ed = $query_ed->where('visibile','=','1');
			//$query_ed = $query_ed->where('new','=','1');
			//dd($query_ed->toSql(), $query_ed->getBindings());
			$query_ed = $query_ed->get();
			$num_ed = $query_ed->count();
			
			$colore_testo = $query_ed[0]->colore_testo;
			$colore = $query_ed[0]->colore;
			$colore_rgb=$CustomController->hex2rgb($colore);
			$colore_rgb=$colore_rgb[0].",".$colore_rgb[1].",".$colore_rgb[2];
			$colore_testo_rgb=$CustomController->hex2rgb($colore_testo);
			$colore_testo_rgb=$colore_testo_rgb[0].",".$colore_testo_rgb[1].",".$colore_testo_rgb[2];
			
			$bladeView="web.dettaglio_regata.entry_list";
			
			$metatag['title'] = Lang::get("website.comunicati stampa",[],$language)." - ".$query_ed[0]->nome_regata." - ".$anno_regata." - ".$query_ed[0]->luogo;
			$metatag['description'] = Lang::get("website.comunicati stampa",[],$language)." - ".$query_ed[0]->nome_regata." - ".$anno_regata." - ".$query_ed[0]->luogo;			
			
			//Genero link per passaggio di lingua		
			$this_page_path_ita = Config::get('app.url')."/regate-".$anno_regata."/entry_list/".$nome_regata."-".$id_dett.".html";
			$this_page_path_eng = Config::get('app.url')."/en/regattas-".$anno_regata."/entry_list/".$nome_regata."-".$id_dett.".html";
		}
		
		$view = view($bladeView);
		$view = $view->with('result', $result);
		$view = $view->with('metatag', $metatag);
		$view = $view->with('cmd', $cmd);
		$view = $view->with('lingua', $lingua);
		$view = $view->with('mysidname', $mysidname);
		$view = $view->with('anno_regata', $anno_regata);
		$view = $view->with('colore', $colore);
		$view = $view->with('colore_testo', $colore_testo);
		$view = $view->with('colore_rgb', $colore_rgb);
		$view = $view->with('colore_testo_rgb', $colore_testo_rgb);
		$view = $view->with('id_dett', $id_dett);
		if($num_v>0) $view = $view->with('value_ed', $query_ed[0]);
		
		$view = $view->with('this_page_path_ita', $this_page_path_ita);
		$view = $view->with('this_page_path_eng', $this_page_path_eng);
		
		return $view;	
		
	}
	
	public function modulo_iscrizione_regata($anno_regata="", $nome_regata="",$id_dett="", $cmd="new_modulo_iscrizione")
    {
		$result = array();       
		$CustomController = new CustomController();		
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();			
		$lingua=="ita" ? $language="it" : $language="en";
		
		$mysidname = $CustomController->checkSession();		
		$metatag = array();
				
		$query_v = DB::table('edizioni_regate');
		$query_v = $query_v->select('id');
		$query_v = $query_v->where('visibile','=','1');
		$query_v = $query_v->where('id','=',$id_dett);
		$query_v = $query_v->get();
		$num_v = $query_v->count();
		if($num_v==0){
			$bladeView="web.404";
			$cmd="404";
			
			$metatag['title'] = "404";
			$metatag['description'] = "404";							
			
			//Genero link per passaggio di lingua		
			$this_page_path_ita = Config::get('app.url')."/404.html";
			$this_page_path_eng = Config::get('app.url')."/en/404.html";
		}else{	
			$query_ed = DB::table('edizioni_regate');
			$query_ed = $query_ed->select('*');
			$query_ed = $query_ed->where('id','=',$id_dett);
			$query_ed = $query_ed->where('visibile','=','1');
			//$query_ed = $query_ed->where('new','=','1');
			//dd($query_ed->toSql(), $query_ed->getBindings());
			$query_ed = $query_ed->get();
			$num_ed = $query_ed->count();
			
			$colore_testo = $query_ed[0]->colore_testo;
			$colore = $query_ed[0]->colore;
			$colore_rgb=$CustomController->hex2rgb($colore);
			$colore_rgb=$colore_rgb[0].",".$colore_rgb[1].",".$colore_rgb[2];
			$colore_testo_rgb=$CustomController->hex2rgb($colore_testo);
			$colore_testo_rgb=$colore_testo_rgb[0].",".$colore_testo_rgb[1].",".$colore_testo_rgb[2];
			
			$bladeView="web.dettaglio_regata.modulo_iscrizioni";
			
			$metatag['title'] = Lang::get("website.modulo iscrizione",[],$language)." - ".$query_ed[0]->nome_regata." - ".$anno_regata." - ".$query_ed[0]->luogo;
			$metatag['description'] = Lang::get("website.modulo iscrizione",[],$language)." - ".$query_ed[0]->nome_regata." - ".$anno_regata." - ".$query_ed[0]->luogo;			
			
			//Genero link per passaggio di lingua		
			$this_page_path_ita = Config::get('app.url')."/regate-".$anno_regata."/modulo_iscrizione/".$nome_regata."-".$id_dett.".html";
			$this_page_path_eng = Config::get('app.url')."/en/regattas-".$anno_regata."/entry_form/".$nome_regata."-".$id_dett.".html";
		}
		
		$view = view($bladeView);
		$view = $view->with('result', $result);
		$view = $view->with('metatag', $metatag);
		$view = $view->with('cmd', $cmd);
		$view = $view->with('lingua', $lingua);
		$view = $view->with('mysidname', $mysidname);
		$view = $view->with('anno_regata', $anno_regata);
		$view = $view->with('colore', $colore);
		$view = $view->with('colore_testo', $colore_testo);
		$view = $view->with('colore_rgb', $colore_rgb);
		$view = $view->with('colore_testo_rgb', $colore_testo_rgb);
		$view = $view->with('id_dett', $id_dett);
		if($num_v>0) $view = $view->with('value_ed', $query_ed[0]);
		
		$view = $view->with('this_page_path_ita', $this_page_path_ita);
		$view = $view->with('this_page_path_eng', $this_page_path_eng);
		
		return $view;	
		
	}
	
	public function modulo_iscrizione_regata_inviato($anno_regata="", $nome_regata="",$id_dett="", $cmd="new_modulo_iscrizione")	
    {
		$result = array();       
		$CustomController = new CustomController();		
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();			
		$lingua=="ita" ? $language="it" : $language="en";
		
		$mysidname = $CustomController->checkSession();		
		$metatag = array();
				
		$query_v = DB::table('edizioni_regate');
		$query_v = $query_v->select('id');
		$query_v = $query_v->where('visibile','=','1');
		$query_v = $query_v->where('id','=',$id_dett);
		$query_v = $query_v->get();
		$num_v = $query_v->count();
		if($num_v==0){
			$bladeView="web.404";
			$cmd="404";
			
			$metatag['title'] = "404";
			$metatag['description'] = "404";							
			
			//Genero link per passaggio di lingua		
			$this_page_path_ita = Config::get('app.url')."/404.html";
			$this_page_path_eng = Config::get('app.url')."/en/404.html";
		}else{	
			$query_ed = DB::table('edizioni_regate');
			$query_ed = $query_ed->select('*');
			$query_ed = $query_ed->where('id','=',$id_dett);
			$query_ed = $query_ed->where('visibile','=','1');
			//$query_ed = $query_ed->where('new','=','1');
			//dd($query_ed->toSql(), $query_ed->getBindings());
			$query_ed = $query_ed->get();
			$num_ed = $query_ed->count();
			
			$colore_testo = $query_ed[0]->colore_testo;
			$colore = $query_ed[0]->colore;
			$colore_rgb=$CustomController->hex2rgb($colore);
			$colore_rgb=$colore_rgb[0].",".$colore_rgb[1].",".$colore_rgb[2];
			$colore_testo_rgb=$CustomController->hex2rgb($colore_testo);
			$colore_testo_rgb=$colore_testo_rgb[0].",".$colore_testo_rgb[1].",".$colore_testo_rgb[2];
			
			$bladeView="web.dettaglio_regata.modulo_iscrizioni";
			
			$metatag['title'] = Lang::get("website.modulo iscrizione",[],$language)." - ".$query_ed[0]->nome_regata." - ".$anno_regata." - ".$query_ed[0]->luogo;
			$metatag['description'] = Lang::get("website.modulo iscrizione",[],$language)." - ".$query_ed[0]->nome_regata." - ".$anno_regata." - ".$query_ed[0]->luogo;			
			
			//Genero link per passaggio di lingua		
			$this_page_path_ita = Config::get('app.url')."/regate-".$anno_regata."/modulo_iscrizione/".$nome_regata."-".$id_dett.".html";
			$this_page_path_eng = Config::get('app.url')."/en/regattas-".$anno_regata."/entry_form/".$nome_regata."-".$id_dett.".html";
			
			$message = "";
			if(isset($_POST['recupero']) && $_POST['recupero']=="inviato"){
				
				$query_rec = DB::table('edizioni_modulo_iscritti');
				$query_rec = $query_rec->select('*');
				$query_rec = $query_rec->where('email','=',$_POST['email']);
				$query_rec = $query_rec->get();
				$num_rec = $query_rec->count();
				
				if($num_rec>0){
					foreach($query_rec[0] AS $key_rec=>$value_rec){
						$risu_rec[$key_rec]=$value_rec;
					}
					if ((crypt($_POST['password'], $risu_rec['password']) == $risu_rec['password']) || ($_POST['password'] == $risu_rec['password'])) {
						$query_isc = DB::table('edizioni_iscrizioni_regata');
						$query_isc = $query_isc->select('*');
						$query_isc = $query_isc->where('id_utente','=',$risu_rec['id']);
						$query_isc = $query_isc->orderby('id','DESC');
						$query_isc = $query_isc->limit('1');
						$query_isc = $query_isc->get();
						$num_isc = $query_isc->count();
						
						if($num_isc>0){
							$x=1;
								foreach($query_isc[0] as $key => $value) {
									if($x==1){
										$$key = $value;
										if($key=="captain_cell"){
											$temp=explode(" ",$value);
											$captain_cell_prefix = $temp[0];
											$captain_cell="";
											for($i=1; $i<count($temp); $i++){
												$captain_cell.=" ".$temp[$i];
											}
										}
									}
									$x++;
									if($x==3) $x=1;				
								}
						}else{
							$message_color = "red";
							$message = 'Nessun dato da recuperare con questa email';
						}
					}else{
						$message_color = "red";
						$message = 'Password errata';
					}
				}else{
					$message_color = "red";
					$message = 'Nessun dato da recuperare con questa email';
				}
				
			}
			if(isset($_POST['recuperopassword']) && $_POST['recuperopassword']=="inviato"){				
				
				$query_rec = DB::table('edizioni_modulo_iscritti');
				$query_rec = $query_rec->select('*');
				$query_rec = $query_rec->where('email','=',$_POST['email']);
				$query_rec = $query_rec->get();
				$num_rec = $query_rec->count(); 
				
				if($num_rec>0){
					$link_cambia="regate-".$anno_regata."/modulo_iscrizione/".$CustomController->to_htaccess_url($nome_regata)."-".$id_dett."/cambia-password-".$query_rec[0]->codice.".html";
					
					$mail_sito = env('APP_EMAIL');
					$ind_sito = env('APP_URL');
					$nome_del_sito = env('APP_NAME');
					$logo_sito = $ind_sito."/".env('APP_LOGO');
					
					include("resources/views/web/common/body_mail.css.php");
					
					$testo_cli ="Gentile utente,
								<br><br>
								Ti preghiamo di seguire il link sotto riportato per accedere alla procedura di cambio password:<br><br>
								<a href=\"$ind_sito/$link_cambia\">$ind_sito/$link_cambia</a>
								<br/><br/>";
					$testo_cli_eng ="Gentile utente,
								<br><br>
								Ti preghiamo di seguire il link sotto riportato per accedere alla procedura di cambio password:<br><br>
								<a href=\"$ind_sito/$link_cambia\">$ind_sito/$link_cambia</a>
								<br/><br/>";
					if($lingua=="it"){
						$body_cli = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_cli, $body);			
						$oggetto_cli = "Yacht Club Costa Smeralda - Recupera Password";
					}
					else {
						$body_cli = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_cli_eng, $body);			
						$oggetto_cli = "Yacht Club Costa Smeralda - Password Recovery";		
					}
					$MailController = new MailController();
					$invioMail_cli = $MailController->sendMail($mail_sito,$nome_del_sito,$_POST['email'],$nome_del_sito, $oggetto_cli, $body_cli); 
					
					$message_color = "#81c868";
					$message = 'A breve riceverai una email contenente il link per accedere alla procedura di cambio password.';
				}else{
					$message_color = "red";
					$message = 'Email non presente nei nostri database';					
				}
			}
			if(isset($_POST['stato']) && $_POST['stato']=="inviato"){
				
				$secretKey = '6LemiVIUAAAAAJUhoWV1HxBM7Pb-tDOeOLZXjQBS';
				$response = $_POST['g-recaptcha-response'];     
				$remoteIp = $_SERVER['REMOTE_ADDR'];


				/**/$reCaptchaValidationUrl = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response&remoteip=$remoteIp");
				$result = json_decode($reCaptchaValidationUrl, TRUE);
				
				if($result['success'] == 1) {	
				//if(1) {	
					$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
					$codice = '';
					for ($i = 0; $i < 15; $i++) {
						$codice .= $characters[rand(0, strlen($characters)-1)];
					}
					
					$arr_no['_token']=1;
					$arr_no['stato']=1;
					$arr_no['privacy']=1;					
					$arr_no['g-recaptcha-response']=1;
					$arr_no['password']=1;
					$arr_no['checkpassword']=1;
					$arr_no['captain_cell_prefix']=1;
					$arr_no['owner_cell_prefix']=1;
					$arr_no['data_team_hours_value']=1;
					$arr_no['dichiarazione_tesseramento_equipaggio_check']=1;
					
					if(isset($_POST['captain_birth_data']) && $_POST['captain_birth_data']) $_POST['captain_birth_data'] = $CustomController->date_to_data($_POST['captain_birth_data']);
					if(isset($_POST['owner_birth_data']) && $_POST['owner_birth_data']) $_POST['owner_birth_data'] = $CustomController->date_to_data($_POST['owner_birth_data']);
					if(isset($_POST['data_team_value']) && $_POST['data_team_value']) $_POST['data_team_value'] = $CustomController->date_to_data($_POST['data_team_value']);
										
					if(isset($_POST['captain_cell']) && $_POST['captain_cell'] != "" && $_POST['captain_cell_prefix']){
						$_POST['captain_cell'] = $_POST['captain_cell_prefix']." ".$_POST['captain_cell'];
					}
					if(isset($_POST['owner_cell']) && $_POST['owner_cell'] != "" && $_POST['owner_cell_prefix']){
						$_POST['owner_cell'] = $_POST['owner_cell_prefix']." ".$_POST['owner_cell'];
					}
					if(isset($_POST['data_team_value']) && $_POST['data_team_value'] != "" && $_POST['data_team_hours_value']){
						$_POST['data_team_value'] = $_POST['data_team_value']." ".$_POST['data_team_hours_value'];
					}
					$_POST['member_nome']="";
					$_POST['member_cognome']="";
					$_POST['member_tessera']="";
					$_POST['member_taglia']="";
					for($cont=1; $cont<=10; $cont++){
						if(isset($_POST['member'.$cont.'_nome'])) $_POST['member_nome'].="@#".$_POST['member'.$cont.'_nome']."#@";
						if(isset($_POST['member'.$cont.'_cognome'])) $_POST['member_cognome'].="@#".$_POST['member'.$cont.'_cognome']."#@";
						if(isset($_POST['member'.$cont.'_tessera'])) $_POST['member_tessera'].="@#".$_POST['member'.$cont.'_tessera']."#@";
						if(isset($_POST['member'.$cont.'_taglia'])) $_POST['member_taglia'].="@#".$_POST['member'.$cont.'_taglia']."#@";
						
						$arr_no['member'.$cont.'_nome']=1;
						$arr_no['member'.$cont.'_cognome']=1;
						$arr_no['member'.$cont.'_tessera']=1;
						$arr_no['member'.$cont.'_taglia']=1;
					}
					
					$link = config('app.url')."/regate-".$anno_regata."/modulo_iscrizione/".$CustomController->to_htaccess_url($nome_regata,"")."-".$id_dett."/conferma-iscrizione_$codice.html";
					$link_eng = config('app.url')."/en/regattas-".$anno_regata."/entry_form/".$CustomController->to_htaccess_url($nome_regata,"")."-".$id_dett."/conferma-iscrizione_$codice.html";
					
					$_POST['id_utente'] = "";
					$_POST['id_edizione'] = $id_dett;
					
					if(isset($_POST['password']) && $_POST['password']!=""){
						$_POST['password']=crypt($_POST['password'],$_POST['password']);
						if($_POST['charterer_email'] && $_POST['charterer_email']!="") $email_recupero=$_POST['charterer_email'];
						else  $email_recupero=$_POST['captain_email'];
						
						$query_ut = DB::table('edizioni_modulo_iscritti');
						$query_ut = $query_ut->select('id');
						$query_ut = $query_ut->where('email','=',$email_recupero);
						$query_ut = $query_ut->get();
						$num_ut = $query_ut->count();
						
						if($num_ut==0){
							$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
							$codice = '';
							for ($i = 0; $i < 15; $i++) {
								$codice .= $characters[rand(0, strlen($characters)-1)];
							}
							
							$string_ins = array();
							$string_ins["email"]=$email_recupero;
							$string_ins["id_edizione"]=$id_dett;
							$string_ins["password"]=$ordine;
							$string_ins["codice"]=$codice;							
							$_POST['id_utente'] = DB::table('edizioni_modulo_iscritti')->insertGetId($string_ins); 
							
						}else{
							$string_mod = array();
							$string_mod["password"]=$_POST['password'];
							$query_up = DB::table('edizioni_modulo_iscritti');
							$query_up = $query_up->where('id','=',$query_ut[0]->id);
							$query_up = $query_up->update($string_mod);
							$_POST['id_utente'] = $query_ut[0]->id;
						}
						
						
					}
					$_POST['data'] = date("Y-m-d");
					$_POST['codice'] = $codice;
					
					$string_ins = array();
					foreach($_POST AS $key=>$value){
						if(!isset($arr_no[$key])){
							$string_ins[$key] = $value;
						}
					}
					//dd($_POST, $string_ins);
					$lastId = DB::table('edizioni_iscrizioni_regata')->insertGetId($string_ins); 
					
					
					$num_file = count($_FILES) ;
					reset($_FILES);
					
					for($x=0; $x<$num_file; $x++){
						
						$key = key($_FILES);
						$nome_campo = $key;
						$nome_file = $_FILES[$key]['name'];
						$dim = $_FILES[$key]['size'];
						$tmp_file    = $_FILES[$key]['tmp_name'];
									
						if($dim!=0)
						{
							//trovo la posizione del punto
							$exts = explode(".", $nome_file);
							$finale = strtolower($exts[count($exts)-1]);				
								
							if($finale=="jpg" || $finale=="jpeg" || $finale=="gif" || $finale=="png" || $finale=="doc" || $finale=="docx" || $finale=="pdf" || $finale=="txt")
							{						
								$path =  public_path()."/resarea/files/iscrizioni_regate/".$lastId;
								if(!is_dir ($path)) {
									mkdir($path);
								}
								$nome_file = $CustomController->scrivi_file($nome_file , $tmp_file, public_path()."/resarea/files/iscrizioni_regate/".$lastId);	
								$string_up= array();
								$string_up[$nome_campo]=$nome_file;
								
								$query_up = DB::table('edizioni_iscrizioni_regata');
								$query_up = $query_up->where('id','=',$lastId);
								$query_up = $query_up->update($string_up);
							}				
						}
						next($_FILES); 
					}
					
					$query_e = DB::table('edizioni_modulo_iscrizioni');
					$query_e = $query_e->select('intestazione_mail');
					$query_e = $query_e->where('id_edizione','=',$id_dett);
					$query_e = $query_e->get();
					$intestazione_mail = $query_e[0]->intestazione_mail;
					
					$mail_sito = env('APP_EMAIL');
					$ind_sito = env('APP_URL');
					$nome_del_sito = env('APP_NAME');
					$logo_sito = $ind_sito."/".env('APP_LOGO');
					
					include("resources/views/web/common/body_mail.css.php");
					
					//$nome_cliente = ucfirst($nome);
					//$cognome_cliente = ucfirst($cognome);
					
					$query_e = DB::table('edizioni_modulo_iscrizioni')
						->select('intestazione_mail','boat_details','yacht_club','yacht_club_valore')
						->where('id_edizione','=',$id_dett)
						->get();
					
					$intestazione_mail = $query_e[0]->intestazione_mail;
					$boat_details = $query_e[0]->boat_details;
					$yacht_club_check = $query_e[0]->yacht_club;
					$yacht_club_valore = $query_e[0]->yacht_club_valore;
					
					
					$dati="";
					$query_dati = DB::table('edizioni_iscrizioni_regata');
					$query_dati = $query_dati->select('*');
					$query_dati = $query_dati->where('id','=',$lastId);
					$query_dati = $query_dati->get();
					
					foreach($query_dati[0] AS $key=>$value){
						$value = str_replace("@##@","",$value);
						if($key!="id" && $key!="ordine" && $key!="intestazione_mail" && $key!="categories" && $key!="maxi" && $key!="provenienza" && $key!="id_edizione" && $key!="id_utente" && $key!="codice" && $key!="prezzo" && $key!="visibile" && $key!="status" && $key!="data_pagamento" && $key!="visibile"){
							if($key=="data") $value = $CustomController->date_to_data($value);
							$$key=$value;
							if($value && trim($value)!=""){
								if($key=="yccs_member" && $value=="on") $value="yes";
								if($key=="eta") $key="E.T.A.";
								$dati.="<b>".ucwords(str_replace("_"," ",$key))."</b>: ".$value."<br/>";
							}
						}
						if($key=="categories" && $value && $value!=""){
							$$key=$value;
							$dati.="<b>".ucfirst(str_replace("_"," ",$key))."</b>: ".$value."<br/>";
						}
						if($key=="maxi" && $value && $value!=""){
							$$key=$value;
							$dati.="<b>".ucfirst(str_replace("_"," ",$key))."</b>: ".$value."<br/>";
						}
						
						if($key=="yacht_club" && $value && $value!=""){
							$query_y = DB::table('edizioni_modulo_iscrizioni');
							$query_y = $query_y->select('yacht_club_valore');
							$query_y = $query_y->WHERE('id_edizione','=',$id_dett);
							$query_y = $query_y->get();
							$yc_value = $query_y[0]->yacht_club_valore;
							$dati=str_replace("Yacht Club",$yc_value,$dati);
						}
						if($key=="home_port" && $value && $value!=""){
							$query_y = DB::table('edizioni_modulo_iscrizioni');
							$query_y = $query_y->select('yacht_club_valore2');
							$query_y = $query_y->WHERE('id_edizione','=',$id_dett);
							$query_y = $query_y->get();
							$yc_value2 = $query_y[0]->yacht_club_valore2;
							$dati=str_replace("Home Port",$yc_value2,$dati);
						}
						if($key=="boat_captain" && $value && $value!=""){
							$query_c = DB::table('edizioni_modulo_iscrizioni');
							$query_c = $query_c->select('captain_valore');
							$query_c = $query_c->WHERE('id_edizione','=',$id_dett);
							$query_c = $query_c->get();
							$cp_value = $query_c[0]->captain_valore;
							$dati=str_replace("Boat Captain",$cp_value,$dati);
						}
						if($key=="captain_cell" && $value && $value!=""){
							$query_c = DB::table('edizioni_modulo_iscrizioni');
							$query_c = $query_c->select('captain_valore');
							$query_c = $query_c->WHERE('id_edizione','=',$id_dett);
							$query_c = $query_c->get();
							$cp_value = $query_c[0]->captain_valore;
							$dati=str_replace("Captain",$cp_value,$dati);
							$dati=str_replace("Cell","Mobile",$dati);
						}
						if($key=="captain_email" && $value && $value!=""){
							$query_c = DB::table('edizioni_modulo_iscrizioni');
							$query_c = $query_c->select('captain_valore');
							$query_c = $query_c->WHERE('id_edizione','=',$id_dett);
							$query_c = $query_c->get();
							$cp_value = $query_c[0]->captain_valore;
							$dati=str_replace("Captain",$cp_value,$dati);
						}
						if($key=="owner_name" && $value && $value!=""){
							$query_o = DB::table('edizioni_modulo_iscrizioni');
							$query_o = $query_o->select('owner_name_valore');
							$query_o = $query_o->WHERE('id_edizione','=',$id_dett);
							$query_o = $query_o->get();
							$o_value = $query_o[0]->owner_name_valore;
							$dati=str_replace("Owner Name",$o_value,$dati);
						}
					}
					
					$testo_cli = "<br><br><br>Gentile utente<br/>grazie per aver inviato una richiesta di iscrizione</b>
						<br><br>
						 I dati da te inseriti sono quelli riportati di seguito. Per confermare i dati e la presa visione dell'informativa ai sensi del Regolamento (UE) 2016/679 premere il pulsante sotto riportato.<br/>
						 In caso di errata compilazione dei dati, <a href='".config('app.url')."/regate-".$anno_regata."/modulo_iscrizione/".$CustomController->to_htaccess_url($nome_regata,"")."-".$id_dett.".html'>ripetere la procedura di registrazione sul sito</a>.
						<br/><br/>
						<a href='$link'><div style='width:200px; border-radius:3px; background:#005cb9; text-align:center;'><div style='padding:4px 0px; color:#fff'><b>CONFERMA ISCRIZIONE</b></div></div></a>
						<br><br>
						Questi sono i dati che ci hai fornito:<br/><br/>
						$dati		
						</br></br>	
						";
					$testo_cli_eng ="<br><br><br>Dear user<br/>Thanks for your request</b>
						<br><br>
						The data you entered are as follows. To confirm the data and the view of the information in accordance with Regulation (EU) 2016/679, press the button below.<br/>
						In case of incorrect compilation of the data, <a href='".config('app.url')."/en/regattas-".$anno_regata."/entry_form/".$CustomController->to_htaccess_url($nome_regata,"")."-".$id_dett.".html'>repeat the registration procedure on the website</a>.
						<br/><br/>
						<a href='$link_eng'><div style='width:250px; border-radius:3px; background:#005cb9; text-align:center;'><div style='padding:4px 0px; color:#fff'><b>CONFIRM YOUR REGISTRATION</b></div></div></a>
						<br><br>
						This is the data you gave us:<br/>
						$dati		
						</br></br>	
						";
						
					if($lingua=="ita"){
						$body_cli = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_cli, $body);			
						$oggetto_ut = "YCCS - Grazie per la richiesta d'iscrizione";
					}
					else {
						$body_cli = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_cli_eng, $body);			
						$oggetto_ut = "YCCS - Thanks for your request";
					}
					
					if(isset($charterer_email) && trim($charterer_email)!="") $email_invio = $charterer_email;
					else $email_invio = $captain_email;
					
					$MailController = new MailController();
					$invioMail_cli = $MailController->sendMail($mail_sito,$nome_del_sito,$email_invio,$nome_del_sito, $oggetto_ut, $body_cli); 
					//$invioMail_cli = $MailController->sendMail($mail_sito,$nome_del_sito,"secretariat@yccs.it",$nome_del_sito, $oggetto_ut, $body_cli); 
					
				}else{
					$message_color = "red";
					$message = 'Nessun dato da recuperare con questa email';
				}
			}
		}
		
		$view = view($bladeView);
		$view = $view->with('result', $result);
		$view = $view->with('metatag', $metatag);
		$view = $view->with('cmd', $cmd);
		$view = $view->with('lingua', $lingua);
		$view = $view->with('mysidname', $mysidname);
		$view = $view->with('anno_regata', $anno_regata);
		$view = $view->with('colore', $colore);
		$view = $view->with('colore_testo', $colore_testo);
		$view = $view->with('colore_rgb', $colore_rgb);
		$view = $view->with('colore_testo_rgb', $colore_testo_rgb);
		$view = $view->with('id_dett', $id_dett);
		if(isset($intestazione_mail)) $view = $view->with('intestazione_mail', $intestazione_mail);
		if(isset($boat_details)) $view = $view->with('boat_details', $boat_details);
		if(isset($yacht_club_check)) $view = $view->with('yacht_club_check', $yacht_club_check);
		if(isset($yacht_club_valore)) $view = $view->with('yacht_club_valore', $yacht_club_valore);
		if(isset($message)) $view = $view->with('message', $message);
		if(isset($message_color)) $view = $view->with('message_color', $message_color);
		if($num_v>0) $view = $view->with('value_ed', $query_ed[0]);
		if(isset($query_isc[0])) $view = $view->with('query_isc', $query_isc[0]);
		
		$view = $view->with('this_page_path_ita', $this_page_path_ita);
		$view = $view->with('this_page_path_eng', $this_page_path_eng);
		
		return $view;	
		
	}
	
	public function modulo_regata_conferma_iscrizione($anno_regata, $nome_regata, $id_dett, $codice, $stato_conf="0",$email="")
	{
		$result = array();
		
		$CustomController = new CustomController();
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();	
		
        $cmd="modulo-regata-conferma-iscrizione";
		$metatag = array();
		$metatag['title'] = "Modulo Iscrizione Regata - Conferma Iscrizione";
		if($lingua=="eng") $metatag['title'] = "Regatta Entry Form - Confirm Registration";
		$metatag['description'] = $metatag['title'];
		
		//Genero link per passaggio di lingua		
		$this_page_path_ita = Config::get('app.url')."/regate-$anno_regata/modulo_iscrizione/$nome_regata-$id_dett/conferma-iscrizione_$codice.html";
		$this_page_path_eng = Config::get('app.url')."/en/regattas-$anno_regata/entry_form/$nome_regata-$id_dett/conferma-iscrizione_$codice.html";
		
		$query_ed = DB::table('edizioni_regate')
			->select('*')
			->where('id','=',$id_dett)
			->get();
		$nome_regata = $query_ed[0]->nome_regata;
		
		$error_isc=0;
		
		if($codice!=""){
			$query_cod = DB::table('edizioni_iscrizioni_regata')
				->select('*')
				->where('codice','=',$codice)
				->get();
			$num_cod = $query_cod->count();
			
			if($num_cod>0) $error_isc=0;
			else $error_isc=1;
		}else{$error_isc=1;}
		
		if($error_isc==0){
			$stato_accettazione = $query_cod[0]->stato_accettazione;
			$payment_method = $query_cod[0]->payment_method;
			$status = $query_cod[0]->status;
			if(!isset($status)) $status=0;
			$prezzo = $query_cod[0]->prezzo;
			$final_price = $query_cod[0]->final_price;
			$id = $query_cod[0]->id;
			if($stato_accettazione==1){
				$stato_conf=1;
				$message_color = "#81c868";
				if($lingua=="ita") $message = "Iscrizione gi&agrave; confermata";
				else $message = "Registration already confirmed";
			}else{
				if($stato_conf==1){
					$query_em = DB::table('edizioni_iscrizioni_regata')
						->select('charterer_email', 'id_edizione')
						->where('codice','=',$codice)
						->where('charterer_email','=',$email)
						->get();
					$num_em=$query_em->count();
					if($num_em==0){
						$query_em = DB::table('edizioni_iscrizioni_regata')
							->select('charterer_email')
							->where('codice','=',$codice)
							->get();
						if(!isset($query_em[0]->charterer_email) || $query_em[0]->charterer_email==""){
							$query_em = DB::table('edizioni_iscrizioni_regata')
								->select('captain_email', 'id_edizione')
								->where('codice','=',$codice)
								->where('captain_email','=',$email)
								->get();
							$num_em=$query_em->count();
						}
					}
					
					if($num_em>0){			
						$string_mod= array();
						$string_mod['stato_accettazione']='1';
						$string_mod['data_accettazione']=date("Y-m-d H:i:s");
						
						$query_up = DB::table('edizioni_iscrizioni_regata')
							->where('codice','=',$codice)
							->update($string_mod);
							
						
						$mail_sito = env('APP_EMAIL');
						$ind_sito = env('APP_URL');
						$nome_del_sito = env('APP_NAME');
						$logo_sito = $ind_sito."/".env('APP_LOGO');
						
						include("resources/views/web/common/body_mail.css.php");
						
						$query_e = DB::table('edizioni_modulo_iscrizioni')
							->select('intestazione_mail','boat_details','yacht_club','yacht_club_valore')
							->where('id_edizione','=',$id_dett)
							->get();
						
						$intestazione_mail = $query_e[0]->intestazione_mail;
						$boat_details = $query_e[0]->boat_details;
						$yacht_club_check = $query_e[0]->yacht_club;
						$yacht_club_valore = $query_e[0]->yacht_club_valore;
						
						$dati="";
						$query_dati = DB::table('edizioni_iscrizioni_regata');
						$query_dati = $query_dati->select('*');
						$query_dati = $query_dati->where('id','=',$id);
						$query_dati = $query_dati->get();						
						
						foreach($query_dati[0] AS $key=>$value){
							$value = str_replace("@##@","",$value);
							if($key!="id" && $key!="ordine" && $key!="intestazione_mail" && $key!="categories" && $key!="maxi" && $key!="provenienza" && $key!="id_edizione" && $key!="id_utente" && $key!="codice" && $key!="prezzo" && $key!="visibile" && $key!="status" && $key!="data_pagamento" && $key!="visibile"){
								if($key=="data") $value = $CustomController->date_to_data($value);
								$$key=$value;
								if($value && trim($value)!=""){
									if($key=="yccs_member" && $value=="on") $value="yes";
									if($key=="eta") $key="E.T.A.";
									$dati.="<b>".ucwords(str_replace("_"," ",$key))."</b>: ".$value."<br/>";
								}
							}
							if($key=="categories" && $value && $value!=""){
								$$key=$value;
								$dati.="<b>".ucfirst(str_replace("_"," ",$key))."</b>: ".$value."<br/>";
							}
							if($key=="maxi" && $value && $value!=""){
								$$key=$value;
								$dati.="<b>".ucfirst(str_replace("_"," ",$key))."</b>: ".$value."<br/>";
							}
							
							if($key=="yacht_club" && $value && $value!=""){
								$query_y = DB::table('edizioni_modulo_iscrizioni');
								$query_y = $query_y->select('yacht_club_valore');
								$query_y = $query_y->WHERE('id_edizione','=',$id_dett);
								$query_y = $query_y->get();
								$yc_value = $query_y[0]->yacht_club_valore;
								$dati=str_replace("Yacht Club",$yc_value,$dati);
							}
							if($key=="home_port" && $value && $value!=""){
								$query_y = DB::table('edizioni_modulo_iscrizioni');
								$query_y = $query_y->select('yacht_club_valore2');
								$query_y = $query_y->WHERE('id_edizione','=',$id_dett);
								$query_y = $query_y->get();
								$yc_value2 = $query_y[0]->yacht_club_valore2;
								$dati=str_replace("Home Port",$yc_value2,$dati);
							}
							if($key=="boat_captain" && $value && $value!=""){
								$query_c = DB::table('edizioni_modulo_iscrizioni');
								$query_c = $query_c->select('captain_valore');
								$query_c = $query_c->WHERE('id_edizione','=',$id_dett);
								$query_c = $query_c->get();
								$cp_value = $query_c[0]->captain_valore;
								$dati=str_replace("Boat Captain",$cp_value,$dati);
							}
							if($key=="captain_cell" && $value && $value!=""){
								$query_c = DB::table('edizioni_modulo_iscrizioni');
								$query_c = $query_c->select('captain_valore');
								$query_c = $query_c->WHERE('id_edizione','=',$id_dett);
								$query_c = $query_c->get();
								$cp_value = $query_c[0]->captain_valore;
								$dati=str_replace("Captain",$cp_value,$dati);
								$dati=str_replace("Cell","Mobile",$dati);
							}
							if($key=="captain_email" && $value && $value!=""){
								$query_c = DB::table('edizioni_modulo_iscrizioni');
								$query_c = $query_c->select('captain_valore');
								$query_c = $query_c->WHERE('id_edizione','=',$id_dett);
								$query_c = $query_c->get();
								$cp_value = $query_c[0]->captain_valore;
								$dati=str_replace("Captain",$cp_value,$dati);
							}
							if($key=="owner_name" && $value && $value!=""){
								$query_o = DB::table('edizioni_modulo_iscrizioni');
								$query_o = $query_o->select('owner_name_valore');
								$query_o = $query_o->WHERE('id_edizione','=',$id_dett);
								$query_o = $query_o->get();
								$o_value = $query_o[0]->owner_name_valore;
								$dati=str_replace("Owner Name",$o_value,$dati);
							}
						}
						
						$testo_azi = "<br><br><br>E' stata inviata una richiesta di iscrizione della barca <b>$boat_name</b> alla regata <b>$nome_regata $anno_regata</b>
										<br><br>	
										$dati</br></br>
										";
						
						$testo_cli = "<br><br><br>Gentile utente<br/>grazie per aver inviato una richiesta di iscrizione della barca <b>$boat_name</b> per la regata <b>$nome_regata $anno_regata</b>
						<br><br>";
						if($payment_method == "Bank Transfer"){
							$testo_cli .= "
								<br><br>
								<b>DETTAGLI PER IL BONIFICO</b>:<br>
								Yacht Club Costa Smeralda<br>
								Banca Intesa San Paolo - Arzachena<br>
								BIC/SWIFT: BCITITMM<br>
								IBAN: IT33F0306984902100000000071<br>
								<b>IMPORTANTE</b>: Specificare nella causale: $nome_regata - "; 
								if($boat_details==1){ $testo_cli .= "Nome della barca";} elseif($yacht_club_check==1 && isset($yacht_club_valore) && trim($yacht_club_valore)!=""){ $testo_cli .= $yacht_club_valore;}
								$testo_cli .= "<br><br>
							";
						}
						$testo_cli .= "$dati</br></br>
						";
						
						$testo_cli_eng = "<br><br><br>Thanks for your request</b>
						<br><br>";
						if($payment_method == "Bank Transfer"){
							$testo_cli_eng .= "
								<br><br>
								<b>BANK DETAILS</b>:<br>
								Yacht Club Costa Smeralda<br>
								Banca Intesa San Paolo - Arzachena<br>
								BIC/SWIFT: BCITITMM<br>
								IBAN: IT33F0306984902100000000071<br>
								<b>IMPERATIVE</b>: specify as object: $nome_regata - "; 
								if($boat_details==1){ $testo_cli .= "Name of Boat";} elseif($yacht_club_check==1 && isset($yacht_club_valore) && trim($yacht_club_valore)!=""){ $testo_cli .= $yacht_club_valore;}
								$testo_cli .= "<br><br>
							";
						}
						$testo_cli_eng .= "$dati</br></br>
						";
						
						$body_azi = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_azi, $body);
						$oggetto_az = "Richiesta iscrizione della barca $boat_name alla regata $nome_regata $anno_regata";
						
						if($lingua=="ita"){
							$body_cli = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_cli, $body);			
							$oggetto_ut = "YCCS - Grazie per la richiesta d'iscrizione";
						}
						else {
							$body_cli = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_cli_eng, $body);			
							$oggetto_ut = "YCCS - Thanks for your request";
						}
						
						if(isset($charterer_email) && trim($charterer_email)!="") $email_invio = $charterer_email;
						else $email_invio = $captain_email;
						
						$MailController = new MailController();
						$invioMail_cli = $MailController->sendMail($mail_sito,$nome_del_sito,$email_invio,$nome_del_sito, $oggetto_ut, $body_cli); 
						$invioMail_azi = $MailController->sendMail($mail_sito,$nome_del_sito,"f.denegri@cwstudio.it",$nome_del_sito, $oggetto_az, $body_azi); 
						//$invioMail_azi = $MailController->sendMail($mail_sito,$nome_del_sito,"secretariat@yccs.it",$nome_del_sito, $oggetto_az, $body_azi); 
						//$invioMail_azi = $MailController->sendMail($mail_sito,$nome_del_sito,"amministrazione@yccs.it",$nome_del_sito, $oggetto_az, $body_azi); 
						
						
						
						$message_color = "#81c868";
						if($lingua=="ita") $message = "Iscrizione confermata";
						else $message = "Registration confirmed";					
					}else{
						$stato_conf=0;
						
						$message_color = "red";
						if($lingua=="ita") $message = "Errore!<br/>
														L'indirizzo email per il quale si chiede conferma &egrave; errato";
						else $message = "Error!<br/>
										The email address for which you are asking for confirmation is incorrect";
					}
				}
			}
		}else{
			$message_color = "red";
			if($lingua=="ita") $message = "Errore!<br/>
											Si prega di seguire nuovamente il link indicato nell'email";
			else $message = "Error!<br/>
							Please follow the link received in the email ";
		}
		
		//$stato_accettazione=1;
		//$payment_method="Paypal";
		//$status="pzxczxagato";
		$view = view("web.dettaglio_regata.modulo-regata-conferma-iscrizione");
		$view = $view->with('result', $result);
		$view = $view->with('metatag', $metatag);
		$view = $view->with('cmd', $cmd);
		$view = $view->with('lingua', $lingua);
		$view = $view->with('this_page_path_ita', $this_page_path_ita);
		$view = $view->with('this_page_path_eng', $this_page_path_eng);
		$view = $view->with('nome_regata', $nome_regata);
		$view = $view->with('anno_regata', $anno_regata);
		$view = $view->with('codice', $codice);
		$view = $view->with('id_dett', $id_dett);
		$view = $view->with('error_isc', $error_isc);
		$view = $view->with('stato_conf', $stato_conf);
		if(isset($stato_accettazione)) $view = $view->with('stato_accettazione', $stato_accettazione);
		if(isset($payment_method)) $view = $view->with('payment_method', $payment_method);
		if(isset($status)) $view = $view->with('status', $status);
		if(isset($prezzo)) $view = $view->with('prezzo', $prezzo);
		if(isset($final_price)) $view = $view->with('final_price', $final_price);
		if(isset($intestazione_mail)) $view = $view->with('intestazione_mail', $intestazione_mail);
		if(isset($boat_details)) $view = $view->with('boat_details', $boat_details);
		if(isset($yacht_club_check)) $view = $view->with('yacht_club_check', $yacht_club_check);
		if(isset($yacht_club_valore)) $view = $view->with('yacht_club_valore', $yacht_club_valore);
		if(isset($id)) $view = $view->with('id', $id);
		if(isset($email)) $view = $view->with('email', $email);
		if(isset($message_color)) $view = $view->with('message_color', $message_color);
		if(isset($message)) $view = $view->withErrors($message);
		return $view;
	}
	public function modulo_regata_conferma_iscrizionePost($anno_regata, $nome_regata, $id_dett, $codice)
	{
		if(isset($_POST['email'])) $email=$_POST['email']; $email=trim($email);
		return $this->modulo_regata_conferma_iscrizione($anno_regata, $nome_regata, $id_dett, $codice,'1',$email);
	}
	
	public function modulo_regata_cambia_password($anno_regata="", $nome_regata="",$id_dett="", $codice="", $cmd="modulo-regata-cambia-password")
	{
		$result = array();       
		$CustomController = new CustomController();		
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();			
		$lingua=="ita" ? $language="it" : $language="en";
		
		$mysidname = $CustomController->checkSession();		
		$metatag = array();
		
		$bladeView="web.dettaglio_regata.modulo_regata_cambia_password";
			
		$metatag['title'] = Lang::get("website.modulo iscrizione cambia password title",[],$language);
		$metatag['description'] = Lang::get("website.modulo iscrizione cambia password description",[],$language);			
		
		//Genero link per passaggio di lingua		
		$this_page_path_ita = Config::get('app.url')."/regate-".$anno_regata."/modulo_iscrizione/".$nome_regata."-".$id_dett."/cambia-password-".$codice.".html";		
		$this_page_path_eng = Config::get('app.url')."/en/regattas-".$anno_regata."/entry_form/".$nome_regata."-".$id_dett."/change-password-".$codice.".html";		
		
		$view = view($bladeView);
		$view = $view->with('result', $result);
		$view = $view->with('metatag', $metatag);
		$view = $view->with('cmd', $cmd);
		$view = $view->with('lingua', $lingua);
		$view = $view->with('mysidname', $mysidname);
		$view = $view->with('anno_regata', $anno_regata);
		$view = $view->with('nome_regata', $nome_regata);
		$view = $view->with('id_edizione', $id_dett);
		$view = $view->with('codice', $codice);
		
		$view = $view->with('this_page_path_ita', $this_page_path_ita);
		$view = $view->with('this_page_path_eng', $this_page_path_eng);
		
		return $view;	
	}
	
	public function entryList($anno_regata, $nome_regata, $id_dett, $slug)
	{
		$result = array();       
		$CustomController = new CustomController();		
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();			
		$lingua=="ita" ? $language="it" : $language="en";
		
		$query_file = DB::table('edizioni_iscritti')
			->select('file','file_eng')
			->where('id_edizione','=',$id_dett)
			->where('slug','=',$slug)
			->get('');
		$num_file = $query_file->count();
		
		if($num_file>0){
			if($lingua=="ita" && $query_file[0]->file && $query_file[0]->file!="") $pdf=$query_file[0]->file; 
			else  $pdf=$query_file[0]->file_eng;
			
			$pathToFile = "public/resarea/files/regate/iscritti/$pdf";
			return response()->file($pathToFile);	
		}else{			
			if($lingua=="ita") $link_regata = "regate-";
			else  $link_regata = "en/regattas-";
			$link_regata .= "$anno_regata/$nome_regata-$id_dett.html";

			return redirect($link_regata);
		}
	}
	
	public function linkFisso($anno_regata, $nome_regata, $id_dett, $tipo_doc, $id_doc, $nome_doc)
	{
		$CustomController = new CustomController();		
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();	
		
		$table="edizioni_".$tipo_doc;
		
		$query_file = DB::table($table)
			->select('file','file_eng')
			->where('id','=',$id_doc)
			->get('');
		$num_file = $query_file->count();
		
		$file = $query_file[0]->file_eng;
		if($lingua=="ita" && isset($query_file[0]->file) && $query_file[0]->file!="") $file = $query_file[0]->file;
		
		//return redirect("resarea/files/regate/".$tipo_doc."/".$file);
		if(file_exists('resarea/files/regate/'.$tipo_doc."/".$file))
			$url_file = public_path().DIRECTORY_SEPARATOR.'resarea/files/regate/'.$tipo_doc."/".$file;
		else
			$url_file = 'resarea/files/regate/'.$tipo_doc."/".$file;
			
		$url_file = File::get($url_file);
		$response = Response::make($url_file,200);
		$response->header('Content-Type', 'application/pdf');
		return $response;		
	}
	
	public function linkFissoCalendar($anno_regata="",$tipo_doc="")
	{
		$CustomController = new CustomController();		
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();		
		
		$table="lista";
		
		$query_file = DB::table($table)
			->select('pdf','pdf_eng')
			->get();
		$num_file = $query_file->count();
		
		$file = $query_file[0]->pdf_eng;
		if($lingua=="ita" && isset($query_file[0]->pdf) && $query_file[0]->pdf!="") $file = $query_file[0]->pdf;
			
		//return redirect("resarea/files/".$file);
		$url_file = public_path().DIRECTORY_SEPARATOR.'resarea/files/'.$file;
		
		if(file_exists('resarea/files/'.$file))
			$url_file = public_path().DIRECTORY_SEPARATOR.'resarea/files/'.$file;
		else
			$url_file = 'resarea/files/'.$file;
		
		$url_file = File::get($url_file);
		$response = Response::make($url_file,200);
		$response->header('Content-Type', 'application/pdf');
		return $response;
	}
	
	public function calendario_regate($anno_regata="")
	{
		$CustomController = new CustomController();		
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();		
		
		$table="documenti_edizioni";
		
		$query_file = DB::table($table)
			->select('pdf','pdf_eng')
			->where('tipo','calendario')
			->where('anno',$anno_regata)
			->where('link_fisso',"1")
			->get();
		$num_file = $query_file->count();
		
		if($num_file>0){
			$file = $query_file[0]->pdf;
			if($lingua=="eng" && isset($query_file[0]->pdf_eng) && $query_file[0]->pdf_eng!="") $file = $query_file[0]->pdf_eng;
			
			//return redirect("resarea/files/edizioni/".$file);							
			$url_file = public_path().DIRECTORY_SEPARATOR.'resarea/files/edizioni'.DIRECTORY_SEPARATOR.$file;
			$url_file = File::get($url_file);
			$response = Response::make($url_file,200);
			$response->header('Content-Type', 'application/pdf');
			return $response;
		}else{
			return redirect("404.html");
		}
	}
	
	public function presentazione_regate($anno_regata="")
	{
		$CustomController = new CustomController();		
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();		
		
		$table="documenti_edizioni";
		
		$query_file = DB::table($table)
			->select('pdf','pdf_eng')
			->where('tipo','presentazione')
			->where('anno',$anno_regata)
			->where('link_fisso',"1")
			->get();
		$num_file = $query_file->count();
		
		if($num_file>0){
			$file = $query_file[0]->pdf;
			if($lingua=="eng" && isset($query_file[0]->pdf_eng) && $query_file[0]->pdf_eng!="") $file = $query_file[0]->pdf_eng;
			
			//return redirect("resarea/files/edizioni/".$file);							
			$url_file = public_path().DIRECTORY_SEPARATOR.'resarea/files/edizioni'.DIRECTORY_SEPARATOR.$file;
			$url_file = File::get($url_file);
			$response = Response::make($url_file,200);
			$response->header('Content-Type', 'application/pdf');
			return $response;
		}else{
			return redirect("404.html");
		}
	}
}