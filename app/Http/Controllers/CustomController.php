<?php 

namespace App\Http\Controllers;

use App;
use Illuminate\Support\Facades\DB;

class CustomController extends Controller
{
	public function checkLanguage() 
	{
		// Determina il locale in base all'URL (/en o /en/ o /en/qualcosa)
		$path = request()->path();
		$urlForzaLingua = ($path === 'en' || str_starts_with($path, 'en/'));
		if ($urlForzaLingua) {
			$locale = "en";
		} else {
			$locale = "ita";
		}

		// Gestione della sessione di primo accesso
		if (!isset($_SESSION['primo_accesso_lingua'])) {
			$_SESSION['primo_accesso_lingua'] = 0;
		} else {
			$_SESSION['primo_accesso_lingua'] = 1;
		}

		// Controlla la lingua dell'intestazione solo al primo accesso
		// e solo quando l'URL NON impone già una lingua (es. /en/...).
		if ($_SESSION['primo_accesso_lingua'] == 0 && !$urlForzaLingua) {
			// Verifica la presenza di HTTP_ACCEPT_LANGUAGE
			$languageHeader = $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? null;

			if ($languageHeader) {
				$preferredLanguages = explode(',', $languageHeader);
				$primaryLanguage = explode('-', $preferredLanguages[0])[0]; // Estrae il codice della lingua principale

				// Cambia il locale in base alla lingua preferita
				if ($locale == "ita" && $primaryLanguage != 'it') {
					$locale = "en";
				}
			}
		}

		// Imposta la lingua per il bot di Facebook (opzionale)
		if (isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'], 'facebookexternalhit') !== false) {
			if ($path === 'en' || str_starts_with($path, 'en/')) {
				$locale = "en";
			} else {
				$locale = "ita";
			}
		}

		// Imposta la lingua in Laravel
		App::setLocale($locale);
		session()->put('locale', $locale);

		// Ritorna il formato del locale richiesto
		if ($locale == "en") {
			$locale = "eng";
		}

		return $locale;
	}


    public function checkSession() 
	{
		
		if(!isset($ses_id)) $ses_id = session_id(); 
		
		
		if(!isset($_SESSION['mysidname'])){
			$mysidname = "yccs_".(time()+rand(1,10000)-rand(1,10000));
			$_SESSION['mysidname'] = $mysidname; 
		}else{
			$mysidname = $_SESSION['mysidname']; 
		}

		if(!isset($_SESSION['mysidname1']))	{
			$mysidname1 = "ordine_".(time()+rand(1,10000)-rand(1,10000));
			$_SESSION['mysidname1'] = $mysidname1; 
		}else{	$mysidname1 = $_SESSION['mysidname1']; 	}
		
		if(isset($_SESSION['user_id_login'])){
			$query_carr = DB::table('carrelli');
			$query_carr = $query_carr->select('id','sessione');
			$query_carr = $query_carr->where('sessione','=',$mysidname);
			$query_carr = $query_carr->get();
			if($query_carr->count()>0){
				//$mysidname = $query_carr[0]->sessione;
				$id_carrello = $query_carr[0]->id;
				//$_SESSION['mysidname'] = $mysidname; 
				
				if(!isset($_SESSION["carrello_$mysidname"])){
					$carrello = array();
					$query_p = DB::table('prodotti_carr');
					$query_p = $query_p->select('*');
					$query_p = $query_p->where('id_carrello','=',$id_carrello);
					$query_p = $query_p->get();
					if($query_p->count()>0){
						foreach($query_p AS $key_p=>$value_p){
							$carrello[$value_p->id_prodotto] = $value_p->quantita;
						}
						$_SESSION["carrello_$mysidname"] = $carrello;
					}
				}
			}else{
				if(isset($_SESSION["carrello_$mysidname"])){
					unset($_SESSION["carrello_$mysidname"]);
					$carrello="";
				}
			}
			
		}
		
		//dd($mysidname);
		return $mysidname;
	}
	
	
	public function date_to_data($data)
    {
		$temp = explode("-",$data);
		$newData = $temp[2]."-".$temp[1]."-".$temp[0];
		return $newData;
	}
	
	public function to_htaccess_url($str_in, $sito="", $subdir="",$len="",$words="")
	{
		$caratteri_permessi = array("_","(",")");
		
		//togli spazi iniziali, \r e \t 
		$str_out = trim($str_in);	
		//tutto minuscolo 
		$str_out = strtolower($str_out);
		

		// se è valido il quarto parametro indica che voglio la stringa troncata dopo $words parole 
		if($words)
		{
			$warr = explode(" ",$str_out);
			$str_out= "";
			for($w=0;$w<min($words,count($warr));$w++)
			{
					if($w) $str_out .= "_";
					$str_out .= $warr[$w];
			}
		}
		
		// visualizza spazi come trattini 
		$str_out = str_replace(" ", "_", $str_out);
		
		//	altro
		$str_out = str_replace("è", "e", $str_out);
		$str_out = str_replace("&egrave;", "e", $str_out);
		$str_out = str_replace("é", "e", $str_out);
		$str_out = str_replace("&eacute;", "e", $str_out);
		$str_out = str_replace("à", "a", $str_out);
		$str_out = str_replace("&agrave;", "a", $str_out);
		$str_out = str_replace("ì", "i", $str_out);
		$str_out = str_replace("&igrave;", "i", $str_out);
		$str_out = str_replace("ò", "o", $str_out);
		$str_out = str_replace("&ograve;", "o", $str_out);
		$str_out = str_replace("ù", "u", $str_out);	
		$str_out = str_replace("&ugrave;", "u", $str_out);
		
		
		//togli i caratteri speciali che nelle url non vengono accettati o sono comunque inestetici;
		//accetta solo numeri, lettere,  e il trattino (-) ; l'underscore DEVE essere convertito in trattino e usato solo come separatore per le regole
		
	  $str = "";
		for($s=0;$s<strlen($str_out);$s++)
		{
			if(ctype_alnum($str_out[$s]) || in_array($str_out[$s],$caratteri_permessi))
				$str .= $str_out[$s];
		}
		$str_out = $str;		
		
		// se è valido il terzo parametro indica che voglio la stringa troncata ad un massimo arbitrario 
		if($len)
		{
			$str_out = substr($str_out, 0, $len);
		}
		else 
		
		//altrimenti	la stringa in totale nell'url non deve comunque superare 255 caratteri, 
		//quindi va troncata ad un valore di default (in genere può essere un txt fino a 250 caratteri) 
		
		{
			$caratteri_occupati   = 7; // http:// iniziale	
			$caratteri_occupati += strlen($sito); // lunghezza dell'url del sito: es www.emporiodellapesca.it 
			if($subdir) // se la pagina va sotto una finta directory (es diving/fotogallery/yyyy_yyy_yyyyy.html), e io la conosco, togline la lunghezza 
			{
				$caratteri_occupati += strlen($subdir);
			}
			else // altrimenti togli comunque un valore di precauzione 
			{
				$caratteri_occupati += 40;
			}		
			$caratteri_occupati += 7; //considero un'eventuale paginazione, sempre del tipo '-pag-XX' o '_pag_XX' 
			$caratteri_occupati += 5; //.html finale 

			$caratteri_url = $caratteri_disponibili = 255;
			
			//ne prendo i 2/3 perchè nel rewrite mi serve la variabile get html_title=$str_out
			//e quindi anche se nascosto ha meno spazio del finto .html ricavato
			
			$caratteri_disponibli = ceil($caratteri_url-$caratteri_occupati)*2/3;
			$lunghezza_originale = strlen($str_out);
			if($lunghezza_originale >= $caratteri_disponibili)
				$str_out = substr($str_out, 0, $caratteri_disponibili-1);
		}		
				
		return $str_out;	
	}
	
	public function genera_password($tabella, $campo)
	{
		$pass="";
		if(!$campo) $campo2 = "password";
		else $campo2 = $campo;
		$caratteri = '0123456789abcdefghijklmnopqrstuvwxyz';
		for($i=0;$i<8;$i++)
		{
			$pass .= $caratteri[rand(0, strlen($caratteri)-1)];
		}	
		
		$num = 0;
		$query = DB::table($tabella);
		$query = $query->select('*');
		$query = $query->where($campo2,'=',$pass);
		$query = $query->get();
		$num = $query->count();
		
		if($num)
			$pass=genera_password($tabella, $campo2);
			
		return $pass;	
	}
	
	public function geocode($address){
		// url encode the address
		$address = urlencode($address);
		// google map geocode api url
		$url = "https://maps.google.com/maps/api/geocode/json?key=AIzaSyAMap-4lyIIPrOgmU4mQMKMOeX1XjJbubk&address={$address}";
		// get the json response
		$resp_json = file_get_contents($url);
		// decode the json
		$resp = json_decode($resp_json, true);
	 
		// response status will be 'OK', if able to geocode given address 
		if($resp['status']=='OK'){
			// get the important data
			$lati = $resp['results'][0]['geometry']['location']['lat'];
			$longi = $resp['results'][0]['geometry']['location']['lng'];
			$formatted_address = $resp['results'][0]['formatted_address'];
			 
			// verify if data is complete
			if($lati && $longi && $formatted_address){
				// put the data in the array
				$data_arr = array();            
				 
				array_push(
				$data_arr, 
					$lati, 
					$longi, 
					$formatted_address
				);
				 
				return $data_arr;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	
	public static function verificaDisponibilita($id_ver, $mysidname, $id_tg="")
	{
		$disponibili_tot = 0;			
		$nel_tuo_carrello = 0;
		
		$now = time();
		$carrelli = DB::table('carrelli')
			->select('id', 'momento')
			->get();
		$num_carrelli = $carrelli->count();
		
		if($num_carrelli > 0 ){
			foreach($carrelli AS $key_carr=>$value_varr){
				$id_carr = $value_varr->id;
				$past = $value_varr->momento;
				
				$past = substr($past,0,4)."-".substr($past,4,2)."-".substr($past,6,2)." ".substr($past,8,2).":".substr($past,10,2).":".substr($past,12,2);
				$past = strtotime($past);
				
				if( ($now-$past) > 7200) // il carrello dura circa due ore
				{
					$query_del = DB::table('prodotti_carr')
						->where('id_carrello',$id_carr)
						->delete();
					$query_del = DB::table('carrelli')
						->where('id',$id_carr)
						->delete();
					
					// vedi se è scaduto anche questo carrello 
					$mio_carrello = DB::table('carrelli')
						->select('id')
						->where('sessione','=',$mysidname)
						->get();
					$num_mio_carrello = $mio_carrello->count();
					
					if($num_mio_carrello==0)
					{					
						unset($_SESSION["carrello_$mysidname"]);
						unset($_SESSION['mysidname']);
						unset($carrello);			
					}
				}
			}
		}
		
		if($id_ver!=""){
			$quantita = 0;
			$valore_tg=0;
			
			$query_disp = DB::table('prodotti');
			$query_disp = $query_disp->select('quantita','tipo_taglia');
			$query_disp = $query_disp->where('id','=',$id_ver);
			//dd($query_disp->toSql(), $query_disp->getBindings());
			$query_disp = $query_disp->get();
			$quantita = $query_disp[0]->quantita;
			$tipo_taglia = $query_disp[0]->tipo_taglia;
			
			if(isset($tipo_taglia) && $tipo_taglia!=""){
				$query_disp = DB::table('quantita_taglie')
					->select('quantita', 'id_valore')
					->where('id_valore', '=', $id_tg)
					->where('id_prodotto', '=', $id_ver)
					->get();
				if(isset($query_disp[0]->quantita)) $quantita = $query_disp[0]->quantita;
				if(isset($query_disp[0]->id_valore)) $valore_tg = $query_disp[0]->id_valore;
			}
			
			$disponibili = $disponibili_tot = $quantita;	// totali, quantita presa dalla tabella 'fissa' PRODOTTI
			
			// togli quelli in magazzino già ordinati, solo di ordini confermati e non evasi
			$query_ordinati = DB::table('ordini_prod');
			$query_ordinati = $query_ordinati->join('ordini','ordini_prod.id_ord','=','ordini.id' );
			$query_ordinati = $query_ordinati->where('ordini_prod.id_prod','=',$id_ver );
			if(isset($tipo_taglia) && $tipo_taglia!="") $query_ordinati = $query_ordinati->where('ordini_prod.taglia','=',$valore_tg );
			$query_ordinati = $query_ordinati->where('ordini.status','=','3');
			$query_ordinati = $query_ordinati->sum('ordini_prod.quantita');
			$num_ordinati = $query_ordinati;
			
			if($num_ordinati > 0)
			{
				$disponibili = max(0, $disponibili-$num_ordinati);
			}
			
			
			// togli ora le giacenze di tutti 
			$giacenze = DB::table('prodotti_carr');
			$giacenze = $giacenze->where('id_prodotto','=',$id_ver );
			if(isset($tipo_taglia) && $tipo_taglia!="") $giacenze = $giacenze->where('taglia','=',$valore_tg );
			$giacenze = $giacenze->sum('quantita');
			$tot_giac = $giacenze;
			
			if($tot_giac>0){
				$disponibili = max($disponibili-$tot_giac,0);  
			}

			$disponibili_tot = $disponibili;
			
			
			if(isset($_SESSION["carrello_$mysidname"]))
			{
				$carrello = $_SESSION["carrello_$mysidname"];
				if(isset($carrello[$id_ver][$valore_tg]))
				{
					$nel_tuo_carrello = $carrello[$id_ver][$valore_tg];
				}
			}
		}
		
		$verifica_disponibilita['nel_tuo_carrello']=$nel_tuo_carrello;
		$verifica_disponibilita['disponibili']=$disponibili_tot;
		return $verifica_disponibilita;
	}
		
	public static function puliziaCarrelli($mysidname)
	{
		$now = date('YmdHis');
		$query_carrelli = DB::table('carrelli');
		$query_carrelli = $query_carrelli->select('id', 'momento', 'sessione');
		$query_carrelli = $query_carrelli->get();
		$num_carrelli = $query_carrelli->count();
		if($num_carrelli>0){
			foreach($query_carrelli AS $key=>$campo){
				$id_carr = $campo->id;
				$past = $campo->momento;
				$sess = $campo->sessione;
				
				if( ($now-$past) > 7200) // il carrello dura due ore 
				{
					$query_del = DB::table('prodotti_carr');
					$query_del = $query_del->where('id_carrello',$id_carr);
					$query_del = $query_del->delete();
					
					$query_del = DB::table('carrelli');
					$query_del = $query_del->where('id',$id_carr);
					$query_del = $query_del->delete();
						
					// vedi se è scaduto anche questo carrello 
					if($sess==$mysidname)
					{
						unset($_SESSION["carrello_$mysidname"]);
						unset($_SESSION['mysidname']);
						unset($carrello);
			
						$mysidname = "yccs_".(time()+rand(1,10000)-rand(1,10000));
						$_SESSION['mysidname'] = $mysidname; 
						$carrello = array();
						?>
						<script type="text/javascript">
							alert("Attenzione! Il carrello è scaduto: tutti i prodotti precedentemente inseriti verranno cancellati");
							window.parent.location.reload();
						</script>				
					<?php }
				}
			}
		}
	}
		
	public function random_char()
	{
		$str = "abcdefghiyklmnopqrstuvwz1234567890";
		$lun = strlen($str);
		$pos = mt_rand(0, $lun - 1);
		return($str[$pos]);
	}
	
		
	public static function hex2rgb($hex)
	{
		$hex = str_replace("#", "", $hex);

		if(strlen($hex) == 3) {
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} else {
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2));
		}
		$rgb = array($r, $g, $b);
		return $rgb; // returns an array with the rgb values
	}
	
	
	public function scrivi_file($nomef,$file, $direi="")
    {
		if($direi)	$dire = $direi;	else $dire = "resarea/files";
		
		/*togli gli apostrofi che impediscono di caricare e rileggere i file imamgine.
		Questo codice comporta che i nomi con aggiunta della lettera (per non sovrascrivere) 
		avranno un doppio punto alla fine (es: ninfee.jv.jpg invece di ninfeev.jpg)*/
		$nome = str_replace("\\","",$nomef);
		$nome = str_replace("'","",$nome);
		/*altra pulizia, non si sa mai */
		$nome = str_replace(" ","_",$nome);
		$nome = str_replace("è", "e", $nome);
		$nome = str_replace("é", "e", $nome);
		$nome = str_replace("à", "a", $nome);
		$nome = str_replace("ì", "i", $nome);
		$nome = str_replace("ò", "o", $nome);
		$nome = str_replace("ù", "u", $nome);	
		$nome = str_replace("`", "", $nome);
		$nome = str_replace("€", "", $nome);
		$nome = str_replace("#", "", $nome);	
		$nome = str_replace("~", "", $nome);
		
		if(is_file("$dire/$nome")){
			while((is_file("$dire/$nome"))==true){
				$exts = explode(".", $nome);
				$finale = $exts[count($exts)-1];
				$titolo = str_replace(".$finale", "", $nome);
				$titolo .= $this->random_char();
				$nome = $titolo.".$finale";
			}
			if(!copy($file, "$dire/$nome"))
			{
				/*echo "<br>fallito copy in scrivi_img";*/
				if(!move_uploaded_file($file,"$dire/$nome"))
				{
					/*echo "<br>fallito move_uploaded in scrivi_img per $file";
					exit();*/
				}
			}
		}
		else
		{
			if(!copy($file, "$dire/$nome"))
			{
				/*echo "<br>fallito copy in scrivi_img";*/
				if(!move_uploaded_file($file,"$dire/$nome"))
				{
					/*echo "<br>fallito move_uploaded in scrivi_img per $file";
					exit();*/
				}
			}
		}
		return ($nome);
	}
	
	
}