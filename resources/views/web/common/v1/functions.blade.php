<?php  
function to_htaccess_url($str_in, $sito="", $subdir="",$len="",$words="")
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

function puntini($str, $len=200, $up=0)
{
	$tit = trim($str);
	$tit = substr($tit,0,$len); 
	if(strlen($str)>$len)
		$tit .= "...";
	if($up) $tit=ucfirst($tit);	
		
	return $tit;	
}

function date_to_data($date,$sep='-')
{
	$data = '0000-00-00';
	$sep_n = $sep;

	if(empty($sep_n))
		$sep_n ='-';
				
	if(!empty($date))
	{
		$dates = explode("-",$date);
		if(count($dates)<3)
			return $data;
		else
			$data = $dates[2].$sep_n.$dates[1].$sep_n.$dates[0];
	}
	return $data;
}

function verificaDisponibili($id_ver, $mysidname)
{
	$query_disp = DB::table('prodotti');
	$query_disp = $query_disp->select('quantita','codice','disponibilita');
	$query_disp = $query_disp->where('codice','=',$id_ver);
	//dd($query_disp->toSql(), $query_disp->getBindings());
	$query_disp = $query_disp->get();
	
	$conf = $query_disp[0]->quantita;
	$ver_cat = $query_disp[0]->codice;
	$quantita = $query_disp[0]->disponibilita;
	
	// totali, quantita presa dalla tabella 'fissa' PRODOTTI 
	$disponibili = $disponibili_tot = $quantita;
	
	// togli quelli in magazzino già ordinati, solo di ordini confermati e non evasi
	$query_ordinati = DB::table('prodotti_ordinati AS po');
	$query_ordinati = $query_ordinati->join('ordini AS o','po.id_rife','=','o.id' );
	$query_ordinati = $query_ordinati->where('po.id_prodotto','=',$id_ver );
	$query_ordinati = $query_ordinati->sum('po.quantita');
	
	$ordinati = $query_ordinati;
	if($ordinati > 0){
		$disponibili = $disponibili-$ordinati;
	}
	
	// togli ora le giacenze di tutti 
	$giacenze = DB::table('prodotti_carr');
	$giacenze = $giacenze->where('id_prodotto','=',$id_ver);
	$giacenze = $giacenze->sum('quantita');
	
	if($giacenze > 0){
		$disponibili = $disponibili-$giacenze;
	}

	$disponibili_tot = $disponibili;
		
	$nel_tuo_carrello = 0;
	if(isset($_SESSION["carrello_".$mysidname]))
	{
		$carrello = $_SESSION["carrello_".$mysidname];
		if(isset($carrello[$id_ver]))
		{
			$nel_tuo_carrello = $carrello[$id_ver];
		}
	}
}