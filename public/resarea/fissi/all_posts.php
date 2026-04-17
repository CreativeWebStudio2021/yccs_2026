<?php 
/*  di seguito la raccolta di tutte le variabili utilizzate nelle varie sezioni */
$cmd="home";
if(isset($_GET['cmd'])) $cmd = $_GET['cmd'];

$pag_att = 1;
if(isset($_GET['pag_att'])) $pag_att = $_GET['pag_att'];

$stato = "";
if(isset($_POST['stato'])) $stato = $_POST['stato'];

$azione = "";
if(isset($_GET['azione'])) $azione = $_GET['azione'];

$id_ute = "";
if(isset($_GET['id_ute'])) $id_ute = $_GET['id_ute'];

$arrivo = "";
if(isset($_POST['arrivo'])) $arrivo = $_POST['arrivo'];

$id_rec = "";
if(isset($_GET['id_rec'])) $id_rec = $_GET['id_rec'];

$id_canc = "";
if(isset($_GET['id_canc'])) $id_canc = $_GET['id_canc'];

$id_rep = 1;
if(isset($_GET['id_rep'])) $id_rep = $_GET['id_rep'];
else if(isset($_POST['id_rep'])) $id_rep = $_POST['id_rep'];

$id_sc = "";
if(isset($_POST['id_sc'])) $id_sc = $_POST['id_sc'];
else if(isset($_GET['id_sc'])) $id_sc = $_GET['id_sc'];

$or = "";
if(isset($_GET['or'])) $or = $_GET['or'];
$di = "asc";
if(isset($_GET['di'])) $di = $_GET['di'];

if(isset($_GET['id_rife'])) { 
	$id_rife = $_GET['id_rife'];
} elseif(isset($_POST['id_rife'])) { 
	$id_rife = $_POST['id_rife'];
} else $id_rife = "";

if(isset($_GET['id_riferimento'])) { 
	$id_riferimento = $_GET['id_riferimento'];
} elseif(isset($_POST['id_riferimento'])) { 
	$id_riferimento = $_POST['id_riferimento'];
} else $id_riferimento = "";

if(isset($_GET['nome_prod'])) { 
	$nome_prod = $_GET['nome_prod'];
} elseif(isset($_POST['nome_prod'])) { 
	$nome_prod = $_POST['nome_prod'];
} else $nome_prod = "nome, codice o marca";

$riferimento = "";
if($id_rife) $riferimento .= "&id_rife=$id_rife";
else if($id_rep) $riferimento .= "&id_rep=$id_rep";

if($id_sc) $riferimento .= "&id_sc=$id_sc";
if($or) $riferimento .= "&or=$or&di=$di";

$campocanc = "";
if(isset($_GET['campocanc'])) $campocanc = $_GET['campocanc'];

$conferma = "";
if(isset($_POST['conferma']) ) $conferma = $_POST['conferma'];
if(isset($_GET['conferma']) ) $conferma = $_GET['conferma'];		 

$nome = "";
if(isset($_POST['nome'])) $nome = $_POST['nome']; 
$descrizione = "";
if(isset($_POST['descrizione'])) $descrizione = $_POST['descrizione'];
 
$no="";

if($cmd=="prodotti" || $cmd=="prodotti_mod" || $cmd=="prodotti_ins" || $cmd=="prodotti_foto"){
	$rif="";

	if(isset($_GET['ric_tipologia'])) $ric_tipologia=$_GET['ric_tipologia']; else $ric_tipologia='';
	if(isset($_GET['ric_cat'])) $ric_cat=$_GET['ric_cat']; else $ric_cat='';
	if(isset($_GET['ric_sottocat'])) $ric_sottocat=$_GET['ric_sottocat']; else $ric_sottocat='';
	if(isset($_GET['ric_nome'])) $ric_nome=$_GET['ric_nome']; else $ric_nome='';
	if(isset($_GET['ric_vis'])) $ric_vis=$_GET['ric_vis']; else $ric_vis='';
	if(isset($_GET['ric_vis_ing'])) $ric_vis_ing=$_GET['ric_vis_ing']; else $ric_vis_ing='';
	if(isset($_GET['ric_off'])) $ric_off=$_GET['ric_off']; else $ric_off='';
	if(isset($_GET['ric_off_ing'])) $ric_off_ing=$_GET['ric_off_ing']; else $ric_off_ing='';
	if(isset($_GET['ric_ev'])) $ric_ev=$_GET['ric_ev']; else $ric_ev='';
	if(isset($_GET['ric_ev_ing'])) $ric_ev_ing=$_GET['ric_ev_ing']; else $ric_ev_ing='';
	if(isset($_GET['ric_marca'])) $ric_marca=$_GET['ric_marca']; else $ric_marca='';
	if(isset($_GET['prov'])) $prov=$_GET['prov']; else $prov='';

	if($ric_cat!="") {$rif.="&ric_cat=$ric_cat"; }
	if($ric_sottocat!="") {$rif.="&ric_sottocat=$ric_sottocat"; }
	if($ric_nome!="") {$rif.="&ric_nome=$ric_nome"; }
	if($ric_vis!="") {$rif.="&ric_vis=$ric_vis"; }
	if($ric_vis_ing!="") {$rif.="&ric_vis_ing=$ric_vis_ing"; }
	if($ric_off!="") {$rif.="&ric_off=$ric_off"; }
	if($ric_off_ing!="") {$rif.="&ric_off_ing=$ric_off_ing"; }
	if($ric_ev!="") {$rif.="&ric_ev=$ric_ev"; }
	if($ric_ev_ing!="") {$rif.="&ric_ev_ing=$ric_ev_ing"; }
	if($ric_marca!="") {$rif.="&ric_marca=$ric_marca"; }
	if($ric_tipologia!="") {$rif.="&ric_tipologia=$ric_tipologia"; }
	if($prov!="") {$rif.="&prov=$prov"; }
}
?>