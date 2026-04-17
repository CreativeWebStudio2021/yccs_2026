<?php
$PS = DIRECTORY_SEPARATOR;
require_once dirname(dirname(__FILE__))."{$PS}config{$PS}config.php";

/* File per la connessione al database */

class Set_array extends Config {
	
	protected $mega_mesi = array(
		'1' => 'Gennaio',
        '2' => 'Febbraio',
        '3' => 'Marzo',
		'4' => 'Aprile',
		'5' => 'Maggio',
		'6' => 'Giugno',
		'7' => 'Luglio',
		'8' => 'Agosto',
		'9' => 'Settembre',
		'10' => 'Ottobre',
		'11' => 'Novembte',
		'12' => 'Dicembre');
		
	protected $mega_mesi2 = array(
		'01' => 'Gennaio',
        '02' => 'Febbraio',
        '03' => 'Marzo',
		'04' => 'Aprile',
		'05' => 'Maggio',
		'06' => 'Giugno',
		'07' => 'Luglio',
		'08' => 'Agosto',
		'09' => 'Settembre',
		'10' => 'Ottobre',
		'11' => 'Novembte',
		'12' => 'Dicembre');

	protected $mega_anni = array();
	
	protected $giornim = array(
		'01' => '31',
		'02' => '29',
		'03' => '31',
		'04' => '30',
		'05' => '31',
		'06' => '30',
		'07' => '31',
		'08' => '31',
		'09' => '30',
		'1' => '31',
		'2' => '29',
		'3' => '31',
		'4' => '30',
		'5' => '31',
		'6' => '30',
		'7' => '31',
		'8' => '31',
		'9' => '30',
		'10' => '31',
		'11' => '30',
		'12' => '31');
	
	protected $giorni = array(
		'1' => 'Lunedì',
        '2' => 'Martedì',
        '3' => 'Mercoledì',
		'4' => 'Giovedì',
		'5' => 'Venerdì',
		'6' => 'Sabato',
		'7' => 'Domenica');
		
	protected $boleano = array(
		'0' => 'no',
        '1' => 'si'
		);
		
	protected $pagamenti = array(
		//'1' => 'Bonifico bancario',
        '2' => 'Paypal o Carta di credito',
        //'3' => 'Contrassegno'
		);
	
	public function get_Mese($m) {
		return $this->mega_mesi[$m];
	}	
	
	public function get_Mesi() {
		return $this->mega_mesi;
	}	
	
	public function set_Anni($inizio_a,$fine_a) {
		for ($i=$inizio_a; $i<=$fine_a; $i++) $this->mega_anni[$i] = $i;
	}
	
	public function get_Anni() {
		return $this->mega_anni;
	}	
	
	public function get_Giorno($g) {
		return $this->giorni[$g];
	}	
	
	public function get_Giorni_Mese($m) {
		return $this->giornim[$m];
	}
	
	public function get_pagamenti($m) {
		return $this->pagamenti[$m];
	}	
	
	/*public function get_Anno($a) {
		return $this->mega_anni[$a];
	}*/	
}
/* inizializzazione array */
$array_sito = new Set_array();
$array_sito->set_Anni(2005,date('Y')+3); /* inizializzazione dell'array degli anni */


?>