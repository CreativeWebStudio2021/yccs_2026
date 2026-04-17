<?php

/* File di configurazione dove vengono definite tutte le variabili un tempo contenute nel file globals.php */

abstract class Config {
	const REC_PAG_ADM = 20;
	const REC_PAG_ADM2 = 40;
	const REC_PAG_F = 8;
	
	protected $dir_up;
	protected $host_db;
	protected $user_db;
	protected $pass_db;
	protected $db_name;
	protected $ind_sito;
	protected $mail_sito;
	protected $nome_del_sito;
}

?>