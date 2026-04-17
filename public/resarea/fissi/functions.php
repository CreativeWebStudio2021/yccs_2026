<?php 
function pulisci_description($description, $lunghezza="")
	{
		$prov=explode("<", $description);
		$num=count($prov);
		$def="";
		for($i=0; $i<$num; $i++){
			$prov2=explode(">", $prov[$i]);
			if(count($prov2)>1) $def.=$prov2[1];
			else $def.=$prov2[0];
			
		}
		
		if($lunghezza!=""){
			$subdef=substr($def, 0, $lunghezza);
			if($subdef!=$def) $def=$subdef.("...");
		}
		return $def;
		

	}

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
	$str_out = str_replace("é", "e", $str_out);
	$str_out = str_replace("à", "a", $str_out);
	$str_out = str_replace("ì", "i", $str_out);
	$str_out = str_replace("ò", "o", $str_out);
	$str_out = str_replace("ù", "u", $str_out);	
	
	/* 
	togli i caratteri speciali che nelle url non vengono accettati o sono comunque inestetici;
	accetta solo numeri, lettere,  e il trattino (-) ; l'underscore DEVE essere convertito in trattino e usato solo come separatore per le regole
	*/
  $str = "";
	for($s=0;$s<strlen($str_out);$s++)
	{
		if(ctype_alnum($str_out[$s]) || in_array($str_out[$s],$caratteri_permessi))
			$str .= $str_out[$s];
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


	function taglia($str, $len=90)
	{
		$txt = $str;
		$txt = str_replace("\r","", $txt);
		$txt = str_replace("\n","", $txt);
		$txt = str_replace(".",". ", $txt);
		$txt = str_replace(",",", ", $txt);
		$txt = str_replace("!","! ", $txt);
		$txt = str_replace("?","? ", $txt);
		$txt = str_replace("  "," ", $txt);
		$txt = ucfirst(strtolower(puntini($txt,$len)));
		return $txt;
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
	

	/* 
	per i link presi da database, che non è detto abbiano sempre l' http:// per uscire dal sito.
	Non raddoppia http:// per i link già di secondo livello
	*/
	function out_url($url)
	{
		$http = "http://";
		$www = "www.";
		$ftp = "ftp.";
			
		$link =$url;
			
		if(!strstr($link, $http) && !strstr($link, $www) && !strstr($link, $ftp))
			$link = $www.$link;
			
		$link = str_replace(" ","",$link);	
			
		if(!strstr($link, $http))
			return ($http.$link);
		else
			return $link;	
	}

	
	/*
	da  aaaa-mm-gg a gg-mm-aaaa
	cambia il separatore se indicato (default: trattino '-'
	*/
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
	
	function data_ita(){
	
		$date=date("D d M Y");
		
		/*mesi*/
		$date=str_replace("Jan","Gennaio",$date);
		$date=str_replace("Feb","Febbraio",$date);
		$date=str_replace("Mar","Marzo",$date);
		$date=str_replace("Apr","Aprile",$date);
		$date=str_replace("May","Maggio",$date);
		$date=str_replace("Jun","Giugno",$date);
		$date=str_replace("Jul","Luglio",$date);
		$date=str_replace("Aug","Agosto",$date);
		$date=str_replace("Sep","Settembre",$date);
		$date=str_replace("Oct","Ottobre",$date);
		$date=str_replace("Nov","Novembre",$date);
		$date=str_replace("Dec","Dicembre",$date);	
		
		/*giorni*/	
		$date=str_replace("Mon","<span style=\"color:#9d9ea2\">Lun</span>",$date);
		$date=str_replace("Tue","<span style=\"color:#9d9ea2\">Mar</span>",$date);
		$date=str_replace("Wed","<span style=\"color:#9d9ea2\">Mer</span>",$date);
		$date=str_replace("Thu","<span style=\"color:#9d9ea2\">Gio</span>",$date);
		$date=str_replace("Fri","<span style=\"color:#9d9ea2\">Ven</span>",$date);
		$date=str_replace("Sat","<span style=\"color:#9d9ea2\">Sab</span>",$date);
		$date=str_replace("Sun","<span style=\"color:#9d9ea2\">Dom</span>",$date);
				
		echo $date;

	}
	
	function ridimensiona_anteprima($immagine,$larghezza,$altezza) {
		$dim=getimagesize("resarea/img_up/".$immagine);
		$w=$larghezza;
		$h=($dim[1]*$w)/$dim[0];
		if($h<$altezza){
			while($h<$altezza){
				$w++;
				$h=($dim[1]*$w)/$dim[0];	
			}
		} else {
			$h=$altezza;
			$w=($dim[0]*$h)/$dim[1];
		}
		$stile="width:".$w."px; height:".$h."px;";
		if($w>$larghezza){
			$margine=($larghezza-$w)/2;
			$stile.=" margin-left:".$margine."px;";
		}
		if($h>$altezza){
			$margine=($altezza-$h)/2;
			$stile.=" margin-top:".$margine."px;";
		}
		return $stile;
	}
?>	