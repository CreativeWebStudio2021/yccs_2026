<?php 
require_once '../config/dbnew.php';	

if(isset($_GET['cmd'])) $cmd=$_GET['cmd']; else $cmd="home";
if(isset($_GET['blocco'])) $blocco=$_GET['blocco']; else $blocco="";
if(isset($_GET['id_rife'])) $id_rife=$_GET['id_rife']; else $id_rife="";
if(isset($_GET['id_riferimento'])) $id_riferimento=$_GET['id_riferimento']; else $id_riferimento="";
if(isset($_GET['id_rec'])) $id_rec=$_GET['id_rec']; else $id_rec="";

if($blocco!="")
	include("../fissi/blocchi_menu/$blocco.inc.php");	
?>