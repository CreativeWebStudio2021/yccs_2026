<?
function to_htaccess_url($str_in, $sito, $subdir="",$len="",$words="")
{
	$caratteri_permessi = array("_","(",")");
	
	/*togli spazi iniziali, \r e \t */
	$str_out = trim($str_in);	
	/*tutto minuscolo */
	$str_out = strtolower($str_out);
	

	/* se è valido il quarto parametro indica che voglio la stringa troncata dopo $words parole */
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
	
	/* visualizza spazi come trattini */
	$str_out = str_replace(" ", "_", $str_out);
	
	/*altro*/
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
	
	/* 
	togli i caratteri speciali che nelle url non vengono accettati o sono comunque inestetici;
	accetta solo numeri, lettere,  e il trattino (-) ; l'underscore DEVE essere convertito in trattino e usato solo come separatore per le regole
	*/
  $str = "";
	for($s=0;$s<strlen($str_out);$s++)
	{
		if(ctype_alnum($str_out{$s}) || in_array($str_out{$s},$caratteri_permessi))
			$str .= $str_out{$s};
	}
	$str_out = $str;		
	
	/* se è valido il terzo parametro indica che voglio la stringa troncata ad un massimo arbitrario */
	if($len)
	{
		$str_out = substr($str_out, 0, $len);
	}
	else 
	/*
	altrimenti	la stringa in totale nell'url non deve comunque superare 255 caratteri, 
	quindi va troncata ad un valore di default (in genere può essere un txt fino a 250 caratteri) 
	*/
	{
		$caratteri_occupati   = 7; /* http:// iniziale*/		
		$caratteri_occupati += strlen($sito); /* lunghezza dell'url del sito: es www.emporiodellapesca.it */
		if($subdir) /* se la pagina va sotto una finta directory (es diving/fotogallery/yyyy_yyy_yyyyy.html), e io la conosco, togline la lunghezza */
		{
			$caratteri_occupati += strlen($subdir);
		}
		else /* altrimenti togli comunque un valore di precauzione */
		{
			$caratteri_occupati += 40;
		}		
		$caratteri_occupati += 7; /*considero un'eventuale paginazione, sempre del tipo '-pag-XX' o '_pag_XX' */
		$caratteri_occupati += 5; /*.html finale */	

		$caratteri_url = $caratteri_disponibili = 255;
		/*
		ne prendo i 2/3 perchè nel rewrite mi serve la variabile get html_title=$str_out
		e quindi anche se nascosto ha meno spazio del finto .html ricavato
		*/
		$caratteri_disponibli = ceil($caratteri_url-$caratteri_occupati)*2/3;
		$lunghezza_originale = strlen($str_out);
		if($lunghezza_originale >= $caratteri_disponibili)
			$str_out = substr($str_out, 0, $caratteri_disponibili-1);
	}		
			
	return $str_out;	
}