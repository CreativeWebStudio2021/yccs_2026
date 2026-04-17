<?php 
$PS = DIRECTORY_SEPARATOR;
//require_once "config/config.php";

/* File con le funzioni per l'amministrazione */

class Functions_adm extends Config {
	
	public function __construct($array_s) {
		$this->mega_mesi = $array_s->get_Mesi();
		$this->mega_anni = $array_s->get_Anni();
	}

	public function trova_ordine($tabella, $id_rife="", $rife=""){		
		$open_connection = new dbnew();
	
		
		if(!$id_rife || !$rife) $wer = "";
		else  $wer = "where $id_rife='$rife'";
		
		$query = "select max(ordine) from $tabella $wer";
		//echo $query;
		$risu = $open_connection->connection->query($query);
		
		if($risu) list($ord)= $risu->fetch();
				
		if($ord)$ord +=1;
		else $ord = 1;
		
		return $ord;
	}
	
	public function trova_ordine2($tabella, $id_rife="", $rife="", $id_rife2="", $rife2="", $campo="ordine"){		
		$open_connection = new dbnew();
	
		if(!$campo) $campo='ordine';
		
		if(!$id_rife || !$rife) $wer = "";
		else  $wer = "where $id_rife='$rife'";
		
		if(!$id_rife2 || !$rife2) $wer2 = "";
		else  $wer2 = " and $id_rife2='$rife2'";
		
		$query = "select max($campo) from $tabella $wer $wer2";
		$risu = $open_connection->connection->query($query);
		
		if(!$risu)
		{
			/*echo $query;exit();*/
		}
		list($ord)= $risu->fetch();
		
		if($ord)$ord +=1;
		else $ord = 1;
		
		return $ord;
	}

	public function stringa_file($nome_file){
		$handle = fopen($nome_file, "r");
		$stringa_file = fread($handle, filesize($nome_file));
		fclose($handle);
		return $stringa_file;
	}

	public function aggiungi_zero($numero){
		
		$pos = strpos($numero , ".");
		$lun = strlen($numero);
		
		if($pos===false) return $numero.".00";
		else{
			if($pos == $lun-1) return $numero."00";
			else if($pos == ($lun-2)){
					return $numero."0";
			}
			
			else if($lun == ($pos + 3)){
				return $numero ;
			}
			else if($lun > ($pos + 3)){
				$taglio = $pos + 3;
				$numero = substr($numero , 0 , $taglio);
				return $numero ;
			}
			
		}
		
	}

	public function random_size($low){
		if($low==0)
			$str = "456";
		else
			$str = "12";
		$lun = strlen($str);
		$pos = mt_rand(0, $lun - 1);
		return($str[$pos]);
	}

	public function random_num(){
		$str = "123456789";
		$lun = strlen($str);
		$pos = mt_rand(0, $lun - 1);
		return($str[$pos]);
	}

	public function random_char(){
		$str = "abcdefghiyklmnopqrstuvwz1234567890";
		$lun = strlen($str);
		$pos = mt_rand(0, $lun - 1);
		return($str[$pos]);
	}

	public function random_special(){
		$str = "()!abcdefghiyklmnopqrstuvwz1234567890";
		$lun = strlen($str);
		$pos = mt_rand(0, $lun - 1);
		return($str[$pos]);
	}

	public function genera_password($tabella, $campo)
	{		
		$open_connection = new dbnew();
	
		$pass="";
		if(!$campo) $campo2 = "password";
		else $campo2 = $campo;
		for($i=0;$i<8;$i++)
		{
			$pass .= $this->random_char();
		}	
		
		$query = "select * from $tabella where $campo2='$pass'";
		$risu = $open_connection->connection->query($query);
		$num = 0;
		if($risu)
			$num = $risu->rowCount();
		if($num)
			$pass=$this->genera_password($tabella, $campo2);
			
		return $pass;	
	}

	public function scrivi_img($nomef,$file, $direi="")
	{
		if($direi)	$dire = $direi;	else $dire = "img_up";
		
		/*togli gli apostrofi che impediscono di caricare e rileggere i file imamgine.
		Questo codice comporta che i nomi con aggiunta della lettera (per non sovrascrivere) 
		avranno un doppio punto alla fine (es: ninfee.jv.jpg invece di ninfeev.jpg)*/
		$nome = str_replace("\\","",$nomef);
		$nome = str_replace("'","",$nome);
		/*altra pulizia, non si sa mai */
		$nome = str_replace(" ","_",$nome);
		$nome = str_replace("�", "e", $nome);
		$nome = str_replace("�", "e", $nome);
		$nome = str_replace("�", "a", $nome);
		$nome = str_replace("�", "i", $nome);
		$nome = str_replace("�", "o", $nome);
		$nome = str_replace("�", "u", $nome);	
		$nome = str_replace("`", "", $nome);
		$nome = str_replace("�", "", $nome);
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
				/**/echo "<br>fallito copy in scrivi_img";
				if(!move_uploaded_file($file,"$dire/$nome"))
				{
					echo "<br>fallito move_uploaded in scrivi_img per $file";
					/*exit();*/
				}
			}
		}
		return ($nome);
	}

	public function scrivi_file($nomef,$file, $diref="")
	{
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
		if($diref)
			$nuovo_nome = $this->scrivi_img($nome,$file, $diref);
		else	
			$nuovo_nome = $this->scrivi_img($nome,$file);
		return ( $nuovo_nome );
	}

	public function thumbjpg($larg, $file, $filename, $dir_imm = "", $start = "")
	{
		if ($start != "") {
			$start_file = $start;
		} else {
			$start_file = "s_";
		}

		$dir_pic = $dir_imm ?: "img_up";

		if ($larg > 0) {
			$exts = explode(".", $filename);
			$ext = strtolower(end($exts)); // più pulito

			if ($ext === "jpg" || $ext === "jpeg") {
				if (!file_exists($file)) {
					error_log("File not found: $file");
					return;
				}

				$src_img = @imagecreatefromjpeg($file); // usa @ per silenziare warning

				if (!$src_img) {
					error_log("Impossibile creare immagine da: $file");
					return;
				}

				$alte = ($larg * imagesy($src_img)) / imagesx($src_img);
				$alte = round($alte);

				$dst_img = imagecreatetruecolor($larg, $alte);
				imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $larg, $alte, imagesx($src_img), imagesy($src_img));
				// imageantialias($dst_img, true); // non serve, deprecata

				$thumb_path = $dir_pic . "/" . $start_file . $filename;

				if (is_file($thumb_path)) {
					unlink($thumb_path);
				}

				imagejpeg($dst_img, $thumb_path, 100);
			}
		}
	}

	
	public function thumbjpg_new( $larg ,  $file ,$filename, $dir_imm="")
	{
		global $HTTP_HOST ;
				
		if($dir_imm)	$dir_pic = $dir_imm;	else $dir_pic = "img_up";
		
		$start_file = "s_";
		
		if($larg>0)
		{
			$exts = explode(".",$filename);
			$ext = strtolower($exts[count($exts)-1]);
			if($ext == "jpg" || $ext=="jpeg")
			$src_img = imagecreatefromjpeg($file); 

			$alte = ($larg * imagesy($src_img)) /  imagesx($src_img) ;
			$alte = round($alte);
			
			$dst_img = imagecreatetruecolor($larg, $alte); 
			imagecopyresampled($dst_img,$src_img,0,0,0,0,$larg, $alte , imagesx($src_img),imagesy($src_img));
			/*imageantialias ( $dst_img, TRUE);*/

			if(is_file( $dir_pic."/$start_file". $filename)){
				unlink( $dir_pic."/$start_file". $filename);
			}
			imagejpeg($dst_img, $dir_pic."/".$filename, 100);	
		}		
	}
	
	public function thumbjpg2025(
						int $larg, 
						string $file, 
						string $filename, 
						string $dir_imm = 'img_up', 
						string $start = 's_'
					): void {
						// Supporta solo questi formati
						$supported_exts = ['jpg', 'jpeg', 'png', 'webp'];

						// Pulizia estensione
						$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

						// Verifica estensione supportata
						if (!in_array($ext, $supported_exts, true)) {
							error_log("Estensione non supportata: $ext");
							return;
						}

						// Verifica dimensione target
						if ($larg <= 0) {
							error_log("Larghezza non valida: $larg");
							return;
						}

						// Verifica esistenza file
						if (!is_file($file) || !is_readable($file)) {
							error_log("File non trovato o non leggibile: $file");
							return;
						}

						// Crea immagine sorgente in base all'estensione
						$src_img = match ($ext) {
							'jpg', 'jpeg' => @imagecreatefromjpeg($file),
							'png'        => @imagecreatefrompng($file),
							'webp'       => @imagecreatefromwebp($file),
							default      => null
						};

						if (!$src_img) {
							error_log("Errore nella creazione dell'immagine da: $file");
							return;
						}

						// Calcola altezza proporzionale
						$src_w = imagesx($src_img);
						$src_h = imagesy($src_img);
						$alte = (int) round(($larg * $src_h) / $src_w);

						// Crea immagine di destinazione
						$dst_img = imagecreatetruecolor($larg, $alte);

						// Se PNG o WebP, gestisci trasparenza
						if (in_array($ext, ['png', 'webp'], true)) {
							imagealphablending($dst_img, false);
							imagesavealpha($dst_img, true);
						}

						imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $larg, $alte, $src_w, $src_h);

						// Costruisce il path finale
						$safe_filename = basename($filename); // Protegge da path traversal
						$thumb_path = rtrim($dir_imm, '/\\') . '/' . $start . $safe_filename;

						// Elimina file esistente
						if (is_file($thumb_path)) {
							@unlink($thumb_path);
						}

						// Salva immagine con qualità massima
						$save_result = match ($ext) {
							'jpg', 'jpeg' => imagejpeg($dst_img, $thumb_path, 100),
							'png'        => imagepng($dst_img, $thumb_path, 0), // 0 = qualità max
							'webp'       => imagewebp($dst_img, $thumb_path, 100),
						};

						if (!$save_result) {
							error_log("Errore nel salvataggio dell'immagine in: $thumb_path");
						}

						// Libera memoria
						imagedestroy($src_img);
						imagedestroy($dst_img);
					}
	
	public function cambia($tabella, $id_nov, $new_pos, $campo_sel="", $id_campo_sel="", $campo_sel2="", $id_campo_sel2="" ){		
		$open_connection = new dbnew();
	
		
		$aggiunta ="";
		if($campo_sel){
			$aggiunta = " AND $campo_sel='$id_campo_sel' ";
		}
		
		$aggiunta2 ="";
		if($campo_sel2){
			$aggiunta2 = " AND $campo_sel2='$id_campo_sel2' ";
		}
		
		$query="SELECT ordine FROM $tabella WHERE id='$id_nov'";
		//echo $query."<br/>";
		$resu=$open_connection->connection->query($query);
		list($my_pos)=$resu->fetch();
		
		$query="SELECT ordine FROM $tabella WHERE 1 $aggiunta $aggiunta2 ORDER BY ordine DESC LIMIT ".($new_pos-1).",1";
		//echo $query."<br/>";
		$resu=$open_connection->connection->query($query);
		list($pos)=$resu->fetch();
		
		if($my_pos>$pos){
			$query="SELECT id,ordine FROM $tabella WHERE 1 $aggiunta $aggiunta2 AND ordine>=$pos ORDER BY ordine DESC";
			//echo $query;
			$resu=$open_connection->connection->query($query);
			
			while($risu=$resu->fetch()){
				$query_up="UPDATE $tabella SET ordine='".($risu['ordine']+2)."' WHERE id='".$risu['id']."'";
				$risu_up=$open_connection->connection->query($query_up);
			}
			
			$query_up="UPDATE $tabella SET ordine='".($pos+1)."' WHERE id='$id_nov'";
			$risu_up=$open_connection->connection->query($query_up);
		
		}elseif($my_pos<$pos){
			$query="SELECT id,ordine FROM $tabella WHERE 1 $aggiunta $aggiunta2 AND ordine>$pos ORDER BY ordine DESC";
			$resu=$open_connection->connection->query($query);
			
			while($risu=$resu->fetch()){
				$query_up="UPDATE $tabella SET ordine='".($risu['ordine']+2)."' WHERE id='".$risu['id']."'";
				$risu_up=$open_connection->connection->query($query_up);
			}
			
			$query_up="UPDATE $tabella SET ordine='".($pos+1)."' WHERE id='$id_nov'";
			$risu_up=$open_connection->connection->query($query_up);
		}
		
		$query="SELECT id FROM $tabella WHERE 1 $aggiunta $aggiunta2 ORDER BY ordine ASC";
		$resu=$open_connection->connection->query($query);
		$ind=1;
		while($risu=$resu->fetch()){
			$query_up="UPDATE $tabella SET ordine='$ind' WHERE id='".$risu['id']."'";
			$risu_up=$open_connection->connection->query($query_up);
			$ind++;
		}

	}
	
	public function cambia2($tabella, $campo_ordine="ordine", $id_nov, $new_pos, $campo_sel="", $id_campo_sel="", $campo_sel2="", $id_campo_sel2="" ){		
		$open_connection = new dbnew();
	
		
		$aggiunta ="";
		if($campo_sel){
			$aggiunta = " AND $campo_sel='$id_campo_sel' ";
		}
		
		$aggiunta2 ="";
		if($campo_sel2){
			$aggiunta2 = " AND $campo_sel2='$id_campo_sel2' ";
		}
		
		$query="SELECT $campo_ordine FROM $tabella WHERE id='$id_nov'";
		$resu=$open_connection->connection->query($query);
		list($my_pos)=$resu->fetch();
		//echo $query." - $my_pos<br/>";
		
		$query="SELECT $campo_ordine FROM $tabella WHERE 1 $aggiunta $aggiunta2 ORDER BY $campo_ordine DESC LIMIT ".($new_pos-1).",1";
		$resu=$open_connection->connection->query($query);
		list($pos)=$resu->fetch();
		//echo $query." - $pos<br/>";
		
		if($my_pos>$pos){
			$query="SELECT id,$campo_ordine FROM $tabella WHERE 1 $aggiunta $aggiunta2 AND $campo_ordine>=$pos ORDER BY $campo_ordine DESC";
			//echo $query."<br/>";
			$resu=$open_connection->connection->query($query);
			
			while($risu=$resu->fetch()){
				$query_up="UPDATE $tabella SET $campo_ordine='".($risu[$campo_ordine]+2)."' WHERE id='".$risu['id']."'";
				//echo $query_up."<br/>";
				$risu_up=$open_connection->connection->query($query_up);
			}
			
			$query_up="UPDATE $tabella SET $campo_ordine='".($pos+1)."' WHERE id='$id_nov'";
			//echo $query_up."<br/>";
			$risu_up=$open_connection->connection->query($query_up);
		
		}elseif($my_pos<$pos){
			$query="SELECT id,$campo_ordine FROM $tabella WHERE 1 $aggiunta $aggiunta2 AND $campo_ordine>$pos ORDER BY $campo_ordine DESC";
			//echo $query."<br/>";
			$resu=$open_connection->connection->query($query);
			
			while($risu=$resu->fetch()){
				$query_up="UPDATE $tabella SET $campo_ordine='".($risu[$campo_ordine]+2)."' WHERE id='".$risu['id']."'";
				//echo $query_up."<br/>";
				$risu_up=$open_connection->connection->query($query_up);
			}
			
			$query_up="UPDATE $tabella SET $campo_ordine='".($pos+1)."' WHERE id='$id_nov'";
			//echo $query_up."<br/>";
			$risu_up=$open_connection->connection->query($query_up);
		}
		
		$query="SELECT id FROM $tabella WHERE 1 $aggiunta $aggiunta2 ORDER BY $campo_ordine ASC";
		//echo $query."<br/>";
		$resu=$open_connection->connection->query($query);
		$ind=1;
		while($risu=$resu->fetch()){
			$query_up="UPDATE $tabella SET $campo_ordine='$ind' WHERE id='".$risu['id']."'";
			//echo $query_up."<br/>";
			$risu_up=$open_connection->connection->query($query_up);
			$ind++;
		}

	}
	
	public function primo($tabella, $id_nov, $campo_sel="", $id_campo_sel="", $campo_sel2="", $id_campo_sel2="" ){		
		$open_connection = new dbnew();
	
		
		$aggiunta ="";
		if($campo_sel){
			$aggiunta = " and $campo_sel='$id_campo_sel' ";
		}
		
		$aggiunta2 ="";
		if($campo_sel2){
			$aggiunta2 = " and $campo_sel2='$id_campo_sel2' ";
		}

		$quer = "select ordine from $tabella WHERE 1";
		if($aggiunta) $quer.= " and $campo_sel='$id_campo_sel' ";
		if($aggiunta2) $quer.= " and $campo_sel2='$id_campo_sel2' ";
		$quer.= " order by ordine desc ";
		
		$risu = $open_connection->connection->query($quer);
		$arra=  $risu->fetch();

		$ordine_max = $arra["ordine"];

		$quer = "select ordine from $tabella where id='$id_nov'";
		$risu = $open_connection->connection->query($quer);
		$arra=  $risu->fetch();
		$ordine_att = $arra["ordine"];
		
		if($ordine_att < $ordine_max){

			$quer = "select ordine,id from $tabella where 1 $aggiunta $aggiunta2 and ordine>$ordine_att";
			$risu = $open_connection->connection->query($quer);
			while($arrai= $risu->fetch()){
				$ordine_sop= $arrai["ordine"];
				$nuovo_ordine=$ordine_sop-1;
				$id_sopra = $arrai["id"];
				$quer = "update $tabella set ordine='".($nuovo_ordine)."' where id='$id_sopra'";
				$risu_up = $open_connection->connection->query($quer);
				
			}
			$quer = "update $tabella set ordine='$ordine_max' where id='$id_nov'";
			$risu = $open_connection->connection->query($quer);		
		}
		
		$query="SELECT id FROM $tabella WHERE 1 $aggiunta $aggiunta2 ORDER BY ordine ASC";
		$resu=$open_connection->connection->query($query);
		$ind=1;
		while($risu=$resu->fetch()){
			$query_up="UPDATE $tabella SET ordine='$ind' WHERE id='".$risu['id']."'";
			$risu_up=$open_connection->connection->query($query_up);
			$ind++;
		}

	}
	
	public function primo2($tabella, $campo_ordine="ordine", $id_nov, $campo_sel="", $id_campo_sel="", $campo_sel2="", $id_campo_sel2="" ){		
		$open_connection = new dbnew();
	
		
		$aggiunta ="";
		if($campo_sel){
			$aggiunta = " and $campo_sel='$id_campo_sel' ";
		}
		
		$aggiunta2 ="";
		if($campo_sel2){
			$aggiunta2 = " and $campo_sel2='$id_campo_sel2' ";
		}

		$quer = "select  $campo_ordine from $tabella WHERE 1";
		if($aggiunta) $quer.= " and $campo_sel='$id_campo_sel' ";
		if($aggiunta2) $quer.= " and $campo_sel2='$id_campo_sel2' ";
		$quer.= " order by  $campo_ordine desc ";
		
		$risu = $open_connection->connection->query($quer);
		$arra=  $risu->fetch();

		$ordine_max = $arra[$campo_ordine];

		$quer = "select  $campo_ordine from $tabella where id='$id_nov'";
		$risu = $open_connection->connection->query($quer);
		$arra=  $risu->fetch();
		$ordine_att = $arra[$campo_ordine];
		
		if($ordine_att < $ordine_max){

			$quer = "select $campo_ordine,id from $tabella where 1 $aggiunta $aggiunta2 and $campo_ordine>$ordine_att";
			$risu = $open_connection->connection->query($quer);
			while($arrai= $risu->fetch()){
				$ordine_sop= $arrai[$campo_ordine];
				$nuovo_ordine=$ordine_sop-1;
				$id_sopra = $arrai["id"];
				$quer = "update $tabella set $campo_ordine='".($nuovo_ordine)."' where id='$id_sopra'";
				$risu_up = $open_connection->connection->query($quer);
				
			}
			$quer = "update $tabella set $campo_ordine='$ordine_max' where id='$id_nov'";
			$risu = $open_connection->connection->query($quer);		
		}
		
		$query="SELECT id FROM $tabella WHERE 1 $aggiunta $aggiunta2 ORDER BY $campo_ordine ASC";
		$resu=$open_connection->connection->query($query);
		$ind=1;
		while($risu=$resu->fetch()){
			$query_up="UPDATE $tabella SET $campo_ordine='$ind' WHERE id='".$risu['id']."'";
			$risu_up=$open_connection->connection->query($query_up);
			$ind++;
		}

	}

	public function ultimo($tabella, $id_nov, $campo_sel="", $id_campo_sel="", $campo_sel2="", $id_campo_sel2="" ){		
		$open_connection = new dbnew();
	
		
		$aggiunta ="";
		if($campo_sel){
			$aggiunta = " and $campo_sel='$id_campo_sel' ";
		}
		
		$aggiunta2 ="";
		if($campo_sel2){
			$aggiunta2 = " and $campo_sel2='$id_campo_sel2' ";
		}

		$quer = "select ordine from $tabella where id='$id_nov'";
		$risu = $open_connection->connection->query($quer);
		$arra=  $risu->fetch();
		$ordine_att = $arra["ordine"];


		$quer = "select ordine,id from $tabella where 1 $aggiunta $aggiunta2 and ordine<$ordine_att";
		$risu = $open_connection->connection->query($quer);
		while($arrai= $risu->fetch()){
			$ordine_sop= $arrai["ordine"];
			$nuovo_ordine=$ordine_sop+1;
			$id_sopra = $arrai["id"];
			$quer = "update $tabella set ordine='".($nuovo_ordine)."' where id='$id_sopra'";
			$risu_up = $open_connection->connection->query($quer);
			
		}
		$quer = "update $tabella set ordine='1' where id='$id_nov'";
		$risu = $open_connection->connection->query($quer);	
		
		$query="SELECT id FROM $tabella WHERE 1 $aggiunta $aggiunta2 ORDER BY ordine ASC";
		$resu=$open_connection->connection->query($query);
		$ind=1;
		while($risu=$resu->fetch()){
			$query_up="UPDATE $tabella SET ordine='$ind' WHERE id='".$risu['id']."'";
			$risu_up=$open_connection->connection->query($query_up);
			$ind++;
		}	

	}

	public function ultimo2($tabella, $campo_ordine="ordine", $id_nov, $campo_sel="", $id_campo_sel="", $campo_sel2="", $id_campo_sel2="" ){		
		$open_connection = new dbnew();
	
		
		$aggiunta ="";
		if($campo_sel){
			$aggiunta = " and $campo_sel='$id_campo_sel' ";
		}
		
		$aggiunta2 ="";
		if($campo_sel2){
			$aggiunta2 = " and $campo_sel2='$id_campo_sel2' ";
		}

		$quer = "select $campo_ordine from $tabella where id='$id_nov'";
		$risu = $open_connection->connection->query($quer);
		$arra=  $risu->fetch();
		$ordine_att = $arra[$campo_ordine];


		$quer = "select $campo_ordine,id from $tabella where 1 $aggiunta $aggiunta2 and $campo_ordine<$ordine_att";
		$risu = $open_connection->connection->query($quer);
		while($arrai= $risu->fetch()){
			$ordine_sop= $arrai[$campo_ordine];
			$nuovo_ordine=$ordine_sop+1;
			$id_sopra = $arrai["id"];
			$quer = "update $tabella set $campo_ordine='".($nuovo_ordine)."' where id='$id_sopra'";
			$risu_up = $open_connection->connection->query($quer);
			
		}
		$quer = "update $tabella set $campo_ordine='1' where id='$id_nov'";
		$risu = $open_connection->connection->query($quer);	
		
		$query="SELECT id FROM $tabella WHERE 1 $aggiunta $aggiunta2 ORDER BY $campo_ordine ASC";
		$resu=$open_connection->connection->query($query);
		$ind=1;
		while($risu=$resu->fetch()){
			$query_up="UPDATE $tabella SET $campo_ordine='$ind' WHERE id='".$risu['id']."'";
			$risu_up=$open_connection->connection->query($query_up);
			$ind++;
		}	

	}

	/* i campi obligatori sono solo i primi due*/
	public function sali($tabella, $id_nov, $campo_sel="", $id_campo_sel="", $campo_sel1="", $id_campo_sel1=""){		
		$open_connection = new dbnew();
	
		
		$aggiunta ="";
		$aggiunta2 ="";
		if ($campo_sel && $campo_sel1){
			$aggiunta = " and $campo_sel='$id_campo_sel' and $campo_sel1='$id_campo_sel1'";
		}elseif($campo_sel){
			$aggiunta = " and $campo_sel='$id_campo_sel'";
		}
		
		if($aggiunta){
			$quer = "select ordine from $tabella where 1 $aggiunta order by ordine desc ";
			//$aggiunta .= " and";
		}
		else{
			$quer = "select ordine from $tabella order by ordine desc ";
		}
		$risu = $open_connection->connection->query($quer);
		$arra=  $risu->fetch();

		$ordine_max = $arra["ordine"];

		$quer = "select ordine from $tabella where id='$id_nov'";
		$risu = $open_connection->connection->query($quer);
		$arra=  $risu->fetch();

		$ordine_att = $arra["ordine"];

		if($ordine_att < $ordine_max){

			$quer = "select ordine,id from $tabella where 1 $aggiunta and ordine>'$ordine_att' order by ordine";
			$risu = $open_connection->connection->query($quer);
			$arrai=  $risu->fetch();
			$ordine_sop= $arrai["ordine"];
			$id_sopra = $arrai["id"];


			$quer = "update $tabella set ordine='$ordine_sop' where id='$id_nov'";
			//echo $quer."<br/>";
			$risu = $open_connection->connection->query($quer);
			$quer = "update $tabella set ordine='$ordine_att' where id='$id_sopra'";
			//echo $quer."<br/>";
			$risu = $open_connection->connection->query($quer);
		}
		
		$query="SELECT id FROM $tabella WHERE 1 $aggiunta $aggiunta2 ORDER BY ordine ASC";
		//echo $query;
		$resu=$open_connection->connection->query($query);
		$ind=1;
		while($risu=$resu->fetch()){
			$query_up="UPDATE $tabella SET ordine='$ind' WHERE id='".$risu['id']."'";
			//echo $query_up."<br/>";
			$risu_up=$open_connection->connection->query($query_up);
			$ind++;
		}

	}
	
	public function sali2($tabella, $campo_ordine="ordine", $id_nov, $campo_sel="", $id_campo_sel="", $campo_sel1="", $id_campo_sel1=""){		
		$open_connection = new dbnew();
	
		
		$aggiunta ="";
		if ($campo_sel && $campo_sel1){
			$aggiunta = " and $campo_sel='$id_campo_sel' and $campo_sel1='$id_campo_sel1'";
		}elseif($campo_sel){
			$aggiunta = " and $campo_sel='$id_campo_sel'";
		}
		
		if($aggiunta){
			$quer = "select $campo_ordine from $tabella where 1 $aggiunta order by $campo_ordine desc ";
			//$aggiunta .= " and";
		}
		else{
			$quer = "select $campo_ordine from $tabella order by $campo_ordine desc ";
		}
		//echo $quer;
		$risu = $open_connection->connection->query($quer);
		$arra=  $risu->fetch();

		$ordine_max = $arra[$campo_ordine];

		$quer = "select $campo_ordine from $tabella where id='$id_nov'";
		$risu = $open_connection->connection->query($quer);
		$arra=  $risu->fetch();

		$ordine_att = $arra[$campo_ordine];

		if($ordine_att < $ordine_max){

			$quer = "select $campo_ordine,id from $tabella where 1 $aggiunta and $campo_ordine>'$ordine_att' order by $campo_ordine";
			$risu = $open_connection->connection->query($quer);
			$arrai=  $risu->fetch();
			$ordine_sop= $arrai[$campo_ordine];
			$id_sopra = $arrai["id"];


			$quer = "update $tabella set $campo_ordine='$ordine_sop' where id='$id_nov'";
			//echo "1".$quer;
			$risu = $open_connection->connection->query($quer);
			$quer = "update $tabella set $campo_ordine='$ordine_att' where id='$id_sopra'";
			//echo "2".$quer;
			$risu = $open_connection->connection->query($quer);
		}
		
		$query="SELECT id FROM $tabella WHERE 1 $aggiunta $aggiunta2 ORDER BY $campo_ordine ASC";
		//echo $query."<br/>";
		$resu=$open_connection->connection->query($query);
		$ind=1;
		while($risu=$resu->fetch()){
			$query_up="UPDATE $tabella SET $campo_ordine='$ind' WHERE id='".$risu['id']."'";
			//echo "3".$query_up;
			$risu_up=$open_connection->connection->query($query_up);
			$ind++;
		}

	}

	public function scendi($tabella, $id_nov, $campo_sel="", $id_campo_sel="", $campo_sel1="", $id_campo_sel1=""){		
		$open_connection = new dbnew();
	
		
		$aggiunta="";
		
		if ($campo_sel && $campo_sel1){
			$aggiunta = " $campo_sel='$id_campo_sel' and $campo_sel1='$id_campo_sel1'";
		}elseif($campo_sel){
			$aggiunta = " $campo_sel='$id_campo_sel'";
		}
		
		if($aggiunta){
			$quer = "select ordine from $tabella where $aggiunta order by ordine";
			$aggiunta .= " and";
		}
		
		else{
			$quer = "select ordine from $tabella order by ordine ";
		}
		
		$risu = $open_connection->connection->query($quer);
		$arra=  $risu->fetch();


		$ordine_min = $arra["ordine"];


		$quer = "select ordine from $tabella where id='$id_nov'";
		$risu = $open_connection->connection->query($quer);
		$arra=  $risu->fetch();


		$ordine_att = $arra["ordine"];

		if($ordine_att > $ordine_min){


			$quer = "select ordine,id from $tabella where  $aggiunta ordine<'$ordine_att'  order by ordine desc";
			$risu = $open_connection->connection->query($quer);
			$arrai=  $risu->fetch();
			$ordine_sot= $arrai["ordine"];
			$id_sotto = $arrai["id"];


			$quer = "update $tabella set ordine='$ordine_sot' where id='$id_nov'";
			$risu = $open_connection->connection->query($quer);
			$quer = "update $tabella set ordine='$ordine_att' where id='$id_sotto'";
			$risu = $open_connection->connection->query($quer);
		}
	}
	
	public function scendi2($tabella, $campo_ordine="ordine", $id_nov, $campo_sel="", $id_campo_sel="", $campo_sel1="", $id_campo_sel1=""){		
		$open_connection = new dbnew();
	
		
		$aggiunta="";
		
		if ($campo_sel && $campo_sel1){
			$aggiunta = " $campo_sel='$id_campo_sel' and $campo_sel1='$id_campo_sel1'";
		}elseif($campo_sel){
			$aggiunta = " $campo_sel='$id_campo_sel'";
		}
		
		if($aggiunta){
			$quer = "select $campo_ordine from $tabella where $aggiunta order by $campo_ordine";
			$aggiunta .= " and";
		}
		
		else{
			$quer = "select $campo_ordine from $tabella order by $campo_ordine ";
		}
		
		$risu = $open_connection->connection->query($quer);
		$arra=  $risu->fetch();


		$ordine_min = $arra[$campo_ordine];


		$quer = "select $campo_ordine from $tabella where id='$id_nov'";
		$risu = $open_connection->connection->query($quer);
		$arra=  $risu->fetch();


		$ordine_att = $arra[$campo_ordine];

		if($ordine_att > $ordine_min){


			$quer = "select $campo_ordine,id from $tabella where  $aggiunta $campo_ordine<'$ordine_att'  order by $campo_ordine desc";
			$risu = $open_connection->connection->query($quer);
			$arrai=  $risu->fetch();
			$ordine_sot= $arrai[$campo_ordine];
			$id_sotto = $arrai["id"];


			$quer = "update $tabella set $campo_ordine='$ordine_sot' where id='$id_nov'";
			$risu = $open_connection->connection->query($quer);
			$quer = "update $tabella set $campo_ordine='$ordine_att' where id='$id_sotto'";
			$risu = $open_connection->connection->query($quer);
		}
	}
	 
	/*
	***********************************************
	** Questa � la funziona che fa l'inserimento **
	***********************************************

	E' importante che al nome dei campi corrisponda il nome delle colonne nella TABELLA DEL DB
	$arr_no � l'array che spiega quali campi non bisogna inserire
	$arr_thumb � l'array che  contiene i campi da trasformare in thumbnail
	$arr_thumb['nome_campo'] = "larghezza_thumb" (in pratica io controller� che l'array contiene un qualche valore, se lo contiene, allora lo passo a thumbjpg come larghezza) 
	$tabella � la tabella
	L'unico campo obligatorio � il primo gli altri sono facoltativi
	*/
	public function inserisci_campi ($tabella , $arr_no="no" ,  $arr_thumb="no", $dir_imm="", $dir_fil="", $max_w_img=1920 ){		
		$open_connection = new dbnew();
		
		global $_POST, $_FILES ;
		
		if($dir_imm)	$dir_img = $dir_imm;	else $dir_img = "img_up";
		if($dir_fil)	$dir_files = $dir_fil;	else $dir_files = "files";
		
//		print_r($arr_no);
		
		$campi['nome'] = "";
		$campi['valore']="";
		$num_post= count($_POST);
		reset($_POST);
		/* questo ciclo serve a recuperare i dati da post*/
		
		$campi = ['nome' => '', 'valore' => ''];
		$i = 0;

		foreach ($_POST as $key => $value) {
			if ($i >= $num_post) break; // Rispetta il numero massimo di post previsto

			if (!isset($arr_no[$key]) && $value !== '') {
				$campi['nome'] .= " $key ,";
				$value = str_replace('"', '\"', $value);
				$campi['valore'] .= " \"$value\" ,";
			}

			$i++;
		}

		
		/* questo ciclo serve a recuperare i dati da file*/
		$num_file = count($_FILES) ;
		
		reset($_FILES);
		
		for($x=0; $x<$num_file; $x++){
			
			$key = key($_FILES);
			$nome_campo = $key;
			$nome_file = $_FILES[$key]['name'];
			$dim = $_FILES[$key]['size'];
			$tmp_file    = $_FILES[$key]['tmp_name'];
			
			
			if($dim!=0 && !isset($arr_no[$nome_campo]))
			{
				/*trovo la posizione del punto*/
				$exts = explode(".", $nome_file);
				$finale = strtolower($exts[count($exts)-1]);
				/*
				*************************************************
				******* ZONA DEL CONTROLLO DELL'IMMAGINE ********
				*************************************************
				*/
					
				if($finale=="jpg" || $finale=="jpeg" || $finale=="gif" || $finale=="png")
				{
					$nome_file = $this->scrivi_img($nome_file , $tmp_file, $dir_img);
				
					/*
					questa � la zona dell'inserimento dell'immagine
					prima devo fare un controllo sulla larghezza...
					se l'immagine � + larga di $max_w_img allora la rimpicciolisco a $max_w_img
					*/
					list($larghezza_gr , $height, $type, $attr) = getimagesize($tmp_file);
					
					/* 
					foto abbastanza piccola o non jpg :
					non voglio o non posso crearla rimpicciolita
					mi tengo quella caricata all'inizio
					*/
					if($larghezza_gr<=$max_w_img || ($finale!="jpg" && $finale!="jpeg" ))
					{
						/* da creare la thumb, solo se jpg */
						if( isset($arr_thumb[$key]) && ($finale=="jpg" || $finale=="jpeg" ))
						{
							$this->thumbjpg2025( $arr_thumb[$key] , $tmp_file , $nome_file , $dir_img );
						}
					}
					/* foto grande, ma jpg (la rimpicciolisco) */
					else if ($larghezza_gr > $max_w_img && ($finale== "jpeg" || $finale=="jpg")) 
					{
						/*
						qui devo creare l'immagine rimpicciolita
						prima devo decidere il nome
						*/
						if(is_file("$dir_img/$nome_file")) /* sicuramente � cos�, l'ho appena caricata!!! */
						{
							/* e questo � il nome del file grande appena caricato */
							$big_file = "$dir_img/$nome_file";
							/* scelgo un altro nome per l'immagine rimpicciolita */
							while( is_file("$dir_img/$nome_file") )
							{
								$titolo = str_replace(".$finale", "", $nome_file);
								$titolo1 = $titolo.$this->random_char();
								$nome_file = $titolo1 . ".".$finale ;
								$nome_file = $titolo1 . ".".$finale ;
							}
							/* a questo punto ho il nome del file rimpicciolito e lo creo */
							$this->thumbjpg2025( $max_w_img ,  $tmp_file ,$nome_file, $dir_img, "YCCS_");
							$nome_file = "YCCS_$nome_file";

							/* se mi serve anche la thumb la faccio, con il nome dell'immagine rimpicciolita */
							if( $arr_thumb[$key])
							{
								$this->thumbjpg2025($arr_thumb[$key], $tmp_file ,$nome_file, $dir_img);
							}
							
							/* e ora cancello l'immagine troppo grande caricata all'inzio */
							unlink($big_file);
						}
					}
					
				/*
				*******************************************************
				******* FINE  ZONA DEL CONTROLLO DELL'IMMAGINE ********
				*******************************************************
				*/
				}
				else
				{
					/* questo � caso in cui non � una immagine ma � un documento*/
					$nome_file = $this->scrivi_file($nome_file , $tmp_file, $dir_files);
					echo $nome_file;
				}
					
				$campi['nome'] .= " $nome_campo ,";
				$campi['valore'] .= " '$nome_file' ,";
			}
			next($_FILES); 
		}
		
		$campi_n =substr( $campi['nome'], 0, -1);
		$campi_v =substr(  $campi['valore'], 0, -1);
				
		$query = "insert into $tabella ($campi_n) values ($campi_v) ";
		//echo $query;
		$risu    = $open_connection->connection->query($query);
		return $open_connection->connection->lastInsertId();
		if(!$risu)
		{
			echo $query;exit();
		}
	}

	/*
	***********************************************
	* Questa � la funziona che invece fa l'update *
	***********************************************
	*/
	public function modifica_campi( $tabella, $id_rec ,$arr_no="no", $arr_thumb="no", $dir_imm="", $dir_fil="", $max_w_img=1920 )
	{		
		$open_connection = new dbnew();
	
		global $_POST, $_FILES ;

		if($dir_imm)	$dir_img = $dir_imm;	else $dir_img = "img_up";
		if($dir_fil)	$dir_files = $dir_fil;	else $dir_files = "files";
		
		$query = "select * from $tabella where id='$id_rec'";
		$risu    = $open_connection->connection->query($query);
		$num_campi = $risu->rowCount();
		if($num_campi>0){
		
			/* questo � l'array con nome campi e valori del db */
			$arr_campi = $risu->fetch();
			
			/* questa contiene tutti i set che saranno necessari per la query update */
			$stringa = "";
			
			/* adesso devo scartabellare l'array post e prendermi tutti i dati */
			$num_post= count($_POST);
			reset($_POST);
			
			/* questo ciclo serve a recuperare i dati da post */
			$stringa = '';
			$i = 0;

			foreach ($_POST as $key => $value) {
				if ($i >= $num_post) break;

				if (!isset($arr_no[$key]) && $value !== '') {
					$value = str_replace('"', '\"', $value);
					$stringa .= " $key=\"$value\" ,";
				}

				$i++;
			}

			
			/* poi devo prendere i file cancellare i vecchi e scrivere i nuovi */
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
					/* trovo la posizione del punto */
					$exts = explode(".", $nome_file);
					$finale = strtolower($exts[count($exts)-1]);
			
					if($finale=="jpg" || $finale=="jpeg" || $finale=="gif" || $finale=="png")
					{			
						$nome_file = $this->scrivi_img($nome_file , $tmp_file, $dir_img);

						/* con questa prendo le dimensioni dell'immagine */
						list($larghezza_gr , $height, $type, $attr) = getimagesize($tmp_file);
							
						if($larghezza_gr<=$max_w_img || ($finale!="jpg" && $finale!="jpeg" ))
						{ 
							if( isset($arr_thumb[$key]) && ($finale=="jpg" || $finale=="jpeg" ))
							{
								$this->thumbjpg2025( $arr_thumb[$key] , $tmp_file , $nome_file , $dir_img );
							}
						}
						else if($larghezza_gr>$max_w_img && ($finale=="jpg" || $finale=="jpeg" ))
						{
							/*
							qui devo creare l'immagine rimpicciolita
							prima devo decidere il nome
							*/
							if(is_file("$dir_img/$nome_file")) 
							{
								/* e questo � il nome del file grande appena caricato */
								$big_file = "$dir_img/$nome_file";
								/* scelgo un altro nome per l'immagine rimpicciolita */
								while( is_file("$dir_img/$nome_file") )
								{
									$titolo = str_replace(".$finale", "", $nome_file);
									$titolo1 = $titolo.$this->random_char();
									$nome_file = $titolo1 . ".".$finale ;
								}
								/* a questo punto ho il nome del file rimpicciolito e lo creo */
								$this->thumbjpg2025( $max_w_img ,  $tmp_file ,$nome_file, $dir_img, "YCCS_");
								$nome_file = "YCCS_$nome_file";

								/* se mi serve anche la thumb la faccio, con il nome dell'immagine rimpicciolita */
								if( $arr_thumb[$key])
								{
									$this->thumbjpg2025($arr_thumb[$key], $tmp_file ,$nome_file, $dir_img);
								}
								
								/* e ora cancello l'immagine troppo grande caricata all'inzio */
								unlink($big_file);
							}
						}
						$dir_old = $dir_img;
					}
					else /*non � un'immagine */
					{
						$nome_file = $this->scrivi_file($nome_file , $tmp_file, $dir_files);
						$dir_old = $dir_files;
					}
					
					$stringa .= " $nome_campo='$nome_file' ,";
					
					/* a questo punto devo cancellare il vecchio file */
					$vecchio_file = $arr_campi[$nome_campo];
					/*
					prima faccio un controllo per capire se era stato inserito qualcosa o no nel vecchio campo
					echo "nome file $vecchio_file<br>";
					*/
					if($vecchio_file !="")
					{
						$pos_pvech = strpos($vecchio_file , ".") + 1;
						$finale_vecch = strtolower(substr($vecchio_file, $pos_pvech));
						/* questa � la cancellazione */
						if(is_file("$dir_old/$vecchio_file"))unlink("$dir_old/$vecchio_file");
						if(is_file("$dir_old/s_$vecchio_file"))unlink("$dir_old/s_$vecchio_file");
					}
				}
				next($_FILES); 
			}
			
			/* a questo punto devo fare la query e togliere la virgola finale da $stringa */
			$stringa =substr( $stringa, 0, -1);
			
			$query = "update $tabella set $stringa where id='$id_rec' ";
			echo $query;
			$risu = $open_connection->connection->query($query);
			if(!$risu)
			{
				echo $query;exit();
			}
		}
		else{
			echo "Attenzione : l'id inserito non corrisponde a nessun record!";
		}
		
	}

	/*
	*****************************************************************************
	*********** queste funzioni non mi piacciono sono troppo particolari*********
	***************** andrebbero rese pi� generiche e funzionali ****************
	*****************************************************************************
	primo valore la tabella in cui lavorare
	secondo valore il valore del campo unico (in genere il campo � id)
	terzo valore facoltativo il nome del campo id se non si chiama id
	*/
	public function cancella_record($tabella , $valore , $campo="id" ){		
		$open_connection = new dbnew();
	
		$query_del = "delete from $tabella where $campo='$valore'";
		$risu_del    = $open_connection->connection->query($query_del);
	}
	
	/*
	primo valore la tabella in cui lavorare
	secondo valore il valore del campo unico (in genere il campo � id)
	terzo valore facoltativo il nome del campo id se non si chiama id
	quarto valore facoltativo il nome della cartella img_up se non si chiama img_up
	*/
	public function cancella_record_foto($tabella , $valore , $campo="id", $cart="")
	{		
		$open_connection = new dbnew();
	
		if($cart)	$cartella = $cart;	else $cartella = "files";

		$query_img = "select foto from $tabella where $campo='$valore' ";
		$risu_img    = $open_connection->connection->query($query_img);
		list($foto_nome)= $risu_img->fetch();
		
		if($foto_nome){
			if(is_file("$cartella/$foto_nome"))unlink("$cartella/$foto_nome");
			if(is_file("$cartella/s_".$foto_nome))unlink("$cartella/s_".$foto_nome);
		}
		
		$query_del = "delete from $tabella where  $campo='$valore'";
		$risu_del    = $open_connection->connection->query($query_del);
	}

	public function campo_ins($titolo, $campo_nome, $tipo_campo, $nome_array="no", $style="", $value="", $field = "", $dir_imm = "", $dir_fil = "")
	{

		if($dir_imm)	$dir_img = $dir_imm;	else $dir_img = "img_up";
		if($dir_fil)	$dir_files = $dir_fil;	else $dir_files = "files";
		if($style)	$stile = $style;	else $stile = "";
		
		/* spaziatura iniziale 
		echo "<tr>
				<td colspan=2 height=10></td>
			</tr>";*/
			
		if($field) $fie = $field;
		else	$fie = $campo_nome;
			
		if($tipo_campo == 1){
			echo "
			<div class=\"mws-form-row\">
				<label class=\"mws-form-label\">$titolo</label>
				<div class=\"mws-form-item\">
					<input name=\"$campo_nome\" type=\"text\" class=\"medium\" value=\"$value\" id=\"$fie\">
				</div>
			</div>
			";
		}
		if($tipo_campo == 2){
			echo "
			<div class=\"mws-form-row\">
				<label class=\"mws-form-label\">$titolo</label>
				<div class=\"mws-form-item\">
					<input name=\"$campo_nome\" type=\"text\" class=\"small\" value=\"$value\" id=\"$fie\">
				</div>
			</div>
			";
		}
		else if($tipo_campo == 3){
			echo "
			<div class=\"mws-form-row\">
				<label class=\"mws-form-label\">$titolo</label>
				<div class=\"mws-form-item\">
					<textarea name=\"$campo_nome\" class=\"medium\" id=\"$fie\" cols=\"60\" rows=\"4\">$value</textarea>
				</div>
			</div>
			";
		}
		else if($tipo_campo == 4){
			echo "
			<div class=\"mws-form-row\">
				<label class=\"mws-form-label\">$titolo</label>
				<div class=\"mws-form-item\">
					<input name=\"$campo_nome\" type=\"file\" class=\"medium\" size=\"60\" id=\"$fie\">
				</div>
			</div>
			";
		}
		else if($tipo_campo == 42){
			echo "
			<div class=\"mws-form-row\">
				<label class=\"mws-form-label\">$titolo</label>
				<div class=\"mws-form-item\">
					<input name=\"".$campo_nome."[]\" type=\"file\" class=\"medium\" size=\"60\" id=\"$fie\" multiple>
				</div>
			</div>
			";
		}
		else if($tipo_campo == 5){
			echo "
			<div class=\"mws-form-row\">
				<label class=\"mws-form-label\">$titolo</label>
				<div class=\"mws-form-item\">
					<input name=\"$campo_nome\" type=\"file\" class=\"medium\" size=\"60\" id=\"$fie\">
				</div>
			</div>
			";		
		}
		
		else if($tipo_campo[0] == 6){
			echo "
			<div class=\"mws-form-row\">
				<label class=\"mws-form-label\">$titolo</label>
				<div class=\"mws-form-item\">
					<select name=\"$campo_nome\" class=\"small\" id=\"$fie\">";
					if($tipo_campo!='6o') echo "<option value=\"\">Seleziona</option>";
					$count_arr = count($nome_array);
					$i = 0;
					foreach ($nome_array as $kiave => $valore) {
						if ($i >= $count_arr) break;

						$sel = ($value == $kiave) ? 'selected="selected"' : '';
						echo "<option value=\"$kiave\" $sel>$valore</option>";

						$i++;
					}

					
					echo "</select>
				</div>
			</div>
			";		
		}
		
		/*
		******************************************
		* Questo serve ad inserire il campo data *
		******************************************
		*/
		
		else if($tipo_campo[0] == 7){
						
			echo "
			<script language=javascript>
				function ".$campo_nome."_aggiorna(){
					giorni_var = document.gino.".$campo_nome."_giorni.value
					mesi_var = document.gino.".$campo_nome."_mesi.value
					anni_var = document.gino.".$campo_nome."_anni.value
					
					/* se uno dei due campi non � selezionato la textarea deve essere vuota*/
					if(!anni_var || !mesi_var || !giorni_var){
						document.gino.".$campo_nome.".value=\"\";
						return
					}
					
					/* questa serve ad aggiornare il campo mesi*/
					if (mesi_var.lenght==1) mesi_var= \"0\" + mesi_var; 
					
					/* questa serve ad aggiornare il campo giorni*/
					if (giorni_var.lenght==1) giorni_var=\"0\" + giorni_var; 
					
					/* questa serve ad unire i pezzi*/
					data_comp = anni_var + \"-\" + mesi_var + \"-\" + giorni_var
					
					document.gino.".$campo_nome.".value=data_comp ;
				}
			</script>
			";
			
			echo	"<div class=\"mws-form-row\">
				<label class=\"mws-form-label\">$titolo</label>
				<div class=\"mws-form-item\">";
			/* questa � la parte che gestisce i giorni */
			echo "<select name=\"".$campo_nome."_giorni\" onchange=\"".$campo_nome."_aggiorna()\" class=\"small\" style=\"float:left;width:150px\">\n";
			if($tipo_campo != '7o')		echo "<option value=\"\">Seleziona</option>\n";
			for($x=1;$x<32;$x++){
				echo "<option value=\"$x\"> $x</option>\n";
			}
			echo "</select>&nbsp;&nbsp;";
			
			/* questa � la parte che gestisce i mesi */
			echo "<select name=\"".$campo_nome."_mesi\" onchange=\"".$campo_nome."_aggiorna()\" class=\"small\" style=\"float:left;width:150px\">\n";
			if($tipo_campo != '7o')	echo "<option value=\"\">Seleziona</option>\n";
			/*global $mega_mesi , $mega_anni;*/
						
			$num_mesi = count($this->mega_mesi);
			$i = 0;
			foreach ($this->mega_mesi as $kiave => $valore) {
				if ($i >= $num_mesi) break;

				echo "<option value=\"$kiave\">$valore</option>\n";
				$i++;
			}

			echo "</select>&nbsp;&nbsp;";
			
			/*questa � la parte che gestisce gli anni*/
			echo "<select name=\"".$campo_nome."_anni\" onchange=\"".$campo_nome."_aggiorna()\" class=\"small\" style=\"float:left;width:150px\">\n";
			if($tipo_campo != '7o')		echo "<option value=\"\">Seleziona</option>\n";
			$num_anni = count($this->mega_anni);

			$i = 0;
			foreach ($this->mega_anni as $kiave => $valore) {
				if ($i >= $num_anni) break;

				echo "<option value=\"$kiave\">$valore</option>\n";
				$i++;
			}

			echo "</select>";
			
			echo "</div>
			<input type=\"hidden\" name=\"$campo_nome\" value=\"\" id=\"$fie\">
			</div>
			";		
		}
		
		/******************************************
		** Questo serve ad inserire il campo ora **
		*******************************************/
		else if($tipo_campo ==8){
						
			echo "
			<script language=\"javascript\">
				function ".$campo_nome."_aggiorna(){
					ore_var = document.gino.".$campo_nome."_ore.value
					minuti_var = document.gino.".$campo_nome."_minuti.value
									
					// se uno dei due campi non � selezionato la textarea deve essere vuota
					if(!minuti_var || !ore_var){
						document.gino.".$campo_nome.".value=\"\";
						return
					}
					
					// questa serve ad aggiornare il campo minuti
					if (minuti_var.lenght==1) minuti_var= \"0\" + minuti_var; 
					
					// questa serve ad aggiornare il campo ore
					if (ore_var.lenght==1) ore_var=\"0\" + ore_var; 
					
					// questa serve ad unire i pezzi
					ora_comp = ore_var + \":\" + minuti_var
					
					document.gino.".$campo_nome.".value=ora_comp ;
				}
			</script>
			";
					
			echo	"<div class=\"mws-form-row\">
				<label class=\"mws-form-label\">$titolo</label>
				<div class=\"mws-form-item\">";
			/* questa � la parte che gestisce le ore */
			echo "<select name=\"".$campo_nome."_ore\" onchange=\"".$campo_nome."_aggiorna()\" class=\"small\" style=\"float:left;width:150px\">\n";
			echo "<option value=\"\">Ore</option>\n";
			for($x=0;$x<=23;$x++){
				if (strlen($x)<2) $x = "0".$x;
				echo "<option value=\"$x\"> $x</option>\n";
			}
			echo "</select>";
			
			/* questa � la parte che gestisce i minuti */
			echo "<select name=\"".$campo_nome."_minuti\" onchange=\"".$campo_nome."_aggiorna()\" class=\"small\" style=\"float:left;width:150px\">\n";
			echo "<option value=\"\">Minuti</option>\n";
			for($x=0;$x<=59;$x++){
				if (strlen($x)<2) $x = "0".$x;
				echo "<option value=\"$x\"> $x</option>\n";
			}
			echo "</select></div>";
					
			echo "<input type=\"hidden\" name=\"$campo_nome\" value=\"\">
			</div>
			";		
		}
		
		/*********************************************
		* Questo serve ad inserire un campo checkbox *
		**********************************************/
		else if($tipo_campo == 9){
			echo "
			<div class=\"mws-form-row\">
				<label class=\"mws-form-label\">$titolo</label>
				<div class=\"mws-form-item\">
					<input name=\"$campo_nome\" type=\"checkbox\" class=\"$style\" id=\"$fie\">
				</div>
			</div>
			";		
		}


	}

	public function campo_mod($titolo , $campo_nome , $value, $tipo_campo , $nome_array="no", $att_cmd, $att_rec, $style="", $field="",$dir_imm="", $dir_fil="", $no_canc=""){
		/* se il parametro $dir_fil � non null, si prende la directory indicata invece della default 'files' per caricare i files dinamici
		dev'essere accordata alla directory indicata in modifica_campi e inserisci_campi */
		if($dir_fil)	$dir_files = $dir_fil;	else $dir_files = "files";
		/* idem per le cartelle di caricamento delle immagini (default: img_up) */
		if($dir_imm)	$dir_img = $dir_imm;	else $dir_img = "img_up";
		/* stile dei campi */
		if($style)	$stile = $style;	else $stile = "";
		/* se $no_canc ha un qualunque value 'true' non � possibile cancellare la immagine o il file caricati, ma solo modificarli (sostituisce la validazione dell'obbligatoriet� dei campi file che nel _mod non pu� funzionare */
		if($no_canc) $noc = 1; else $noc=0;
						
		/* spaziatura iniziale 
		echo "<tr>
				<td colspan=\"2\" height=\"10\"></td>
			</tr>";*/
			
		if($field) $fie = $field;
		else $fie = $campo_nome;	
			
		if($tipo_campo == 1){
			echo "
			<div class=\"mws-form-row\">
				<label class=\"mws-form-label\">
					$titolo
					";
					if($value!="" && $noc==0){
						echo"<br/><a href=\"admin.php?cmd=$att_cmd&id_rec=$att_rec&campocanc=$campo_nome\" class=\"testo10\" alt=\"Cancella il contenuto del campo\" ><i style=\"font-size:1.5em;\" class=\"fa fa-eraser\" aria-hidden=\"true\"></i></a>";
					}
				echo "</label>
				<div class=\"mws-form-item\">
					<input name=\"$campo_nome\" type=\"text\" class=\"medium\" value=\"$value\" id=\"$fie\">
				</div>
			</div>
			";
		}
		else if($tipo_campo == 2){
			echo "
			<div class=\"mws-form-row\">
				<label class=\"mws-form-label\">$titolo</label>
				<div class=\"mws-form-item\">
					<input name=\"$campo_nome\" type=\"text\" class=\"small\" value=\"$value\" id=\"$fie\">
				</div>
			</div>
			";
		}
		else if($tipo_campo == 3){
			echo "
			<div class=\"mws-form-row\">
				<label class=\"mws-form-label\">$titolo</label>
				<div class=\"mws-form-item\">
					<textarea name=\"$campo_nome\" class=\"medium\" id=\"$fie\" cols=\"60\" rows=\"4\">$value</textarea>
				</div>
			</div>
			";
		}
		else if($tipo_campo == 4)
		{
			if(is_file("$dir_img/s_$value")) $src = "$dir_img/s_$value";
			else if(is_file("$dir_img/$value")) $src = "$dir_img/$value";
			else $src="";
			
			echo "
			<div class=\"mws-form-row\">
				<label class=\"mws-form-label\">$titolo</label>
				<div class=\"mws-form-item\">";
				if($src)
				{
					echo "<img  style=\"margin-left:20px; margin-right:10px; width:150px\" src=\"$src\" border=\"0\" align=\"absmiddle\">";
					if($value!="" && $noc==0)
					{
					echo"<a href=\"admin.php?cmd=$att_cmd&id_rec=$att_rec&campocanc=$campo_nome\" class=\"testo10\" > <i style=\"color:#29292c; font-size:1.3em\" class=\"fa fa-trash\" aria-hidden=\"true\"></i></a>
					";
					}
				}
				echo "
				<input name=\"$campo_nome\" type=\"file\" class=\"medium\" size=\"60\" id=\"$fie\">
				</div>
			</div>
			";
		}
		else if($tipo_campo == 5){
			echo "
			<div class=\"mws-form-row\">
				<label class=\"mws-form-label\">$titolo</label>
				<div class=\"mws-form-item\">
					<a href=\"$dir_files/$value\" target=\"_blank\" class=\"$stile\">Documento attuale :<br/><b>$value</b></a>";
				if($value!="" && $noc==0){
				echo"<a href=\"admin.php?cmd=$att_cmd&id_rec=$att_rec&campocanc=$campo_nome\" class=\"testo10\" > <i style=\"font-size:1.5em;\" class=\"fa fa-eraser\" aria-hidden=\"true\"></i></a>
				";}
				echo"<br>
				<input name=\"$campo_nome\" type=\"file\" class=\"medium\" size=\"60\" id=\"$fie\">
				</div>
			</div>
			";		
		}
		else if($tipo_campo[0] == 6){
			echo "
			<div class=\"mws-form-row\">
				<label class=\"mws-form-label\">$titolo</label>
				<div class=\"mws-form-item\"><select name=\"$campo_nome\" class=\"small\" id=\"$fie\">";
				if($tipo_campo!='6o') echo "<option value=\"\">Seleziona</option>";
				$count_arr = count($nome_array);
				$i = 0;
				foreach ($nome_array as $kiave => $valore) {
					if ($i >= $count_arr) break;

					if ($value == $kiave) {
						echo "<option value=\"$kiave\" selected=\"selected\">$valore</option>";
					} else {
						echo "<option value=\"$kiave\">$valore</option>";
					}

					$i++;
				}

				
			echo "</select></div>
			</div>
			";		
		}
		
		/*
		*********************************************
		** Questo serve a modificare il campo data **
		*********************************************
		*/
		else if($tipo_campo[0] == 7){
						
			echo "
			<script language=\"javascript\">
				function ".$campo_nome."_aggiorna(){
					giorni_var = document.gino.".$campo_nome."_giorni.value
					mesi_var = document.gino.".$campo_nome."_mesi.value
					anni_var = document.gino.".$campo_nome."_anni.value
					
					/* se uno dei due campi non � selezionato la textarea deve essere vuota*/
					if(!anni_var || !mesi_var || !giorni_var){
						document.gino.".$campo_nome.".value=\"\";
						return
					}
					
					/* questa serve ad aggiornare il campo mesi */
					if (mesi_var.lenght==1) mesi_var= \"0\" + mesi_var; 
					
					/* questa serve ad aggiornare il campo giorni */
					if (giorni_var.lenght==1) giorni_var=\"0\" + giorni_var; 
					
					/* questa serve ad unire i pezzi */
					data_comp = anni_var + \"-\" + mesi_var + \"-\" + giorni_var
					
					document.gino.".$campo_nome.".value=data_comp ;
				}
			</script>
			";
			
			$giorni_att = trim(substr($value,8,2));
			$mesi_att   = trim(substr($value,5,2));
			$anni_att   = trim(substr($value,0,4));
			
			echo	"<div class=\"mws-form-row\">
				<label class=\"mws-form-label\">$titolo</label>
				<div class=\"mws-form-item\">";
				
			/* questa � la parte che gestisce i giorni */
			echo "<select name=\"".$campo_nome."_giorni\" onchange=\"".$campo_nome."_aggiorna()\" class=\"small\" style=\"float:left;width:150px\">\n";
			if($tipo_campo != '7o')		echo "<option value=\"\">Seleziona</option>\n";
									
			if(strlen($giorni_att)==2 && substr($giorni_att,0,1)==0)$giorni_att = substr($giorni_att,1,1);
			for($x=1;$x<32;$x++){
				if($x==$giorni_att)echo "<option value=\"$x\" selected=\"selected\"> $x</option>\n";
				else echo "<option value=\"$x\"> $x</option>\n";
			}
			echo "</select>&nbsp;&nbsp;";
			
			/* questa � la parte che gestisce i mesi */			
			echo "<select name=\"".$campo_nome."_mesi\" onchange=\"".$campo_nome."_aggiorna()\" class=\"small\" style=\"float:left;width:150px\">\n";
			if($tipo_campo != '7o')		echo "<option value=\"\">Seleziona</option>\n";
			/*global $mega_mesi , $mega_anni;*/
			
			if(strlen($mesi_att)==2 && substr($mesi_att,0,1)==0)$mesi_att = substr($mesi_att,1,1);
			$num_mesi = count($this->mega_mesi);
			echo $mesi_att;
			$i = 0;
			foreach ($this->mega_mesi as $kiave => $valore) {
				if ($i >= $num_mesi) break;

				$sel = ($mesi_att == $kiave) ? 'selected="selected"' : '';
				echo "<option value=\"$kiave\" $sel>$valore</option>\n";

				$i++;
			}

			echo "</select>&nbsp;&nbsp;";
			
			/* questa � la parte che gestisce gli anni */			
			echo "<select name=\"".$campo_nome."_anni\" onchange=\"".$campo_nome."_aggiorna()\" class=\"small\" style=\"float:left;width:150px\">\n";
			if($tipo_campo != '7o')		echo "<option value=\"\">Seleziona</option>\n";
			$num_anni = count($this->mega_anni);
			$i = 0;
			foreach ($this->mega_anni as $kiave => $valore) {
				if ($i >= $num_anni) break;

				$sel = ($anni_att == $valore) ? 'selected="selected"' : '';
				echo "<option value=\"$kiave\" $sel>$valore</option>\n";

				$i++;
			}

			echo "</select>";
			
			echo "</div>
			<input type=\"hidden\" name=\"$campo_nome\" value=\"\"  id=\"$fie\">
			</div>
			<script language=\"javascript\">
				/* questa serve ad aggiornare la data */
				".$campo_nome."_aggiorna()
			</script>
			";		
		}
		
		/*******************************************
		** Questo serve a modificare il campo ora **
		********************************************/
		else if($tipo_campo ==8){
						
			echo "
			<script language=\"javascript\">
				function ".$campo_nome."_aggiorna(){
					ore_var = document.gino.".$campo_nome."_ore.value
					minuti_var = document.gino.".$campo_nome."_minuti.value
									
					/* se uno dei due campi non � selezionato la textarea deve essere vuota*/
					if(!ore_var || !minuti_var){
						document.gino.".$campo_nome.".value=\"\";
						return
					}
					
					/* questa serve ad aggiornare il campo ore*/
					if (ore_var.lenght==1) ore_var= \"0\" + ore_var; 
					
					/*questa serve ad aggiornare il campo minuti*/
					if (minuti_var.lenght==1) minuti_var=\"0\" + minuti_var; 
					
					/* questa serve ad unire i pezzi*/
					ora_comp = ore_var + \":\" + minuti_var
					
					document.gino.".$campo_nome.".value=ora_comp ;
				}
			</script>
			";
			$ore_att = trim(substr($value,0,2));
			$minuti_att = trim(substr($value,3,2));
							
			echo	"<div class=\"mws-form-row\">
				<label class=\"mws-form-label\">$titolo</label>
				<div class=\"mws-form-item\">";
				
			/* questa � la parte che gestisce le ore */
			echo "<select name=\"".$campo_nome."_ore\" onchange=\"".$campo_nome."_aggiorna()\" class=\"small\" style=\"float:left;width:150px\">\n";
			echo "<option value=\"\">Ore</option>\n";
			
			for($x=0;$x<24;$x++){
				if (strlen($x)<2) $x = "0".$x;
				if($x==$ore_att)echo "<option value=\"$x\" selected=\"selected\"> $x</option>\n";
				else echo "<option value=\"$x\"> $x</option>\n";
			}
			echo "</select>";
						
			/* questa � la parte che gestisce i minuti */
			echo "<select name=\"".$campo_nome."_minuti\" onchange=\"".$campo_nome."_aggiorna()\" class=\"small\" style=\"float:left;width:150px\">\n";
			echo "<option value=\"\">Minuti</option>\n";
					
			for($x=0;$x<60;$x++){
				if (strlen($x)<2) $x = "0".$x;
				if($x==$minuti_att)echo "<option value=\"$x\" selected=\"selected\"> $x</option>\n";
				else echo "<option value=\"$x\"> $x</option>\n";
			}
			
			echo "</select>";
			
			echo "</div>
			<input type=\"hidden\" name=\"$campo_nome\" value=\"\">
			</div>
			<script language=\"javascript\">
				/* questa serve ad aggiornare la data */
				".$campo_nome."_aggiorna()
			</script>
			";		
		}
		if($tipo_campo == 9){
			echo "
			<script language=\"javascript\">
				function ".$campo_nome."chk_aggiorna(){
					valore_check = document.gino.".$campo_nome."_chk.checked;
												
					/* questa serve ad aggiornare il campo hidden vero*/				
					if (valore_check) {
						nuovo_valore = \"on\"; 
					} else nuovo_valore = \"off\";
									
					document.gino.".$campo_nome.".value=nuovo_valore;
					}
			</script>";
		
			$stringa_check = "";
			if ($value=="on") $stringa_check = "checked";
					
			echo "
			<div class=\"mws-form-row\">
				<label class=\"mws-form-label\">$titolo</label>
				<div class=\"mws-form-item\"><input type=\"checkbox\" name=\"$campo_nome"."_chk\" $stringa_check onclick=\"".$campo_nome."chk_aggiorna()\"></div>
				<input type=\"hidden\" name=\"$campo_nome\" value=\"$value\">
			</div>";
		}

	}

	/* 
	Questa fondamentalmente � una revisione della funzione di inserimento campi dell'amministrazione
	Puo' essere usata nella parte pubblica in conncomitanza con l'array thumb per il recupero e il salvataggio di immagini sul filesystem e nel database
	*/
	public function inserimento_foto ( $arr_no="no" ,  $arr_thumb="no", $dir_imm="", $dir_fil="", $max_w_img=800 ){
		global $_FILES ;
		
		if($dir_imm)	$dir_img = $dir_imm;	else $dir_img = "img_up";
		if($dir_fil)	$dir_files = $dir_fil;	else $dir_files = "files";
		
		$array_ritorno="";
		/* questo ciclo serve a recuperare i dati da file */
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
				/* trovo la posizione del punto*/
				$pos_punto = strpos($nome_file , "." ) +1;
				$finale = strtolower(substr($nome_file, $pos_punto));
				
				/*
				*************************************************
				******* ZONA DEL CONTROLLO DELL'IMMAGINE ********
				*************************************************
				*/
				
				if($finale=="jpg" || $finale=="jpeg" || $finale=="gif" || $finale=="png")
				{		
					$nome_file = $this->scrivi_img($nome_file , $tmp_file, $dir_img);
					/*
					questa � la zona dell'inserimento dell'immagine
					prima devo fare un controllo sulla larghezza...
					se l'immagine � + larga di $max_w_img allora la rimpicciolisco a $max_w_img
					*/
					list($larghezza_gr , $height, $type, $attr) = getimagesize($tmp_file);
					
					/* questo � il caso della prima che va rimpicciolita o che non � ne jpg ne jpeg */
					if($larghezza_gr<=$max_w_img  || ($finale!= "jpeg" && $finale!="jpg"))
					{ 
						if( $arr_thumb[$key] && ($finale=="jpg" || $finale=="jpeg" ))
						{
							$this->thumbjpg( $arr_thumb[$key] , $tmp_file , $nome_file , $dir_img );
						}
					}
					/* questo � il caso che larghezza supera i $max_w_img e la foto � un jpg */
					else if ($larghezza_gr > $max_w_img && ($finale== "jpeg" || $finale=="jpg")) 
					{
						/*
						qu� devo creare l'immagine piccola
						prima devo decidere il nome
						*/
						if(is_file("$dir_img/$nome_file"))
						{
							$big_file = "$dir_img/$nome_file";
							while( is_file("$dir_img/$nome_file") )
							{
								$titolo = str_replace(".$finale", "", $nome_file);
								$titolo1 = $titolo.$this->random_char();
								$nome_file = $titolo1 . ".".$finale ;
								$array_ritorno[$x]=$nome_file;
							}
							/*
							a questo punto io ho il nome del file
							e creo la rimpicciolita
							*/
							$this->thumbjpg( $max_w_img ,  $tmp_file ,$nome_file, $dir_img, "YCCS_");
							$nome_file = "YCCS_$nome_file";
							/* anche la thumb se serve*/
							if( $arr_thumb[$key])
							{
							 $this->thumbjpg($arr_thumb[$key], $tmp_file ,$nome_file, $dir_img);
							}
							/* e cancello la prima grande caricata */
							unlink($big_file);
						}
					}
				
				/*
				*******************************************************
				******* FINE  ZONA DEL CONTROLLO DELL'IMMAGINE ********
				*******************************************************
				*/		
				}
								
				$campi['nome'] .= " $nome_campo ,";
				$campi['valore'] .= " '$nome_file' ,";
			}
			next($_FILES); 
		}
		return $array_ritorno;
		/*$arr_immagini=inserimento_img();*/
	}
	
	public function pulisci_description($description, $lunghezza="")
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

	public function to_htaccess_url($str_in, $sito, $subdir="",$len="",$words="")
	{
		$caratteri_permessi = array("_","(",")");
		
		/*togli spazi iniziali, \r e \t */
		$str_out = trim($str_in);	
		/*tutto minuscolo */
		$str_out = strtolower($str_out);
		
		/* se � valido il quarto parametro indica che voglio la stringa troncata dopo $words parole */
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
		$str_out = str_replace("�", "e", $str_out);
		$str_out = str_replace("�", "e", $str_out);
		$str_out = str_replace("�", "a", $str_out);
		$str_out = str_replace("�", "i", $str_out);
		$str_out = str_replace("�", "o", $str_out);
		$str_out = str_replace("�", "u", $str_out);	
		
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
		
		/* se � valido il terzo parametro indica che voglio la stringa troncata ad un massimo arbitrario */
		if($len)
		{
			$str_out = substr($str_out, 0, $len);
		}
		else 
		/*
		altrimenti	la stringa in totale nell'url non deve comunque superare 255 caratteri, 
		quindi va troncata ad un valore di default (in genere pu� essere un txt fino a 250 caratteri) 
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
			ne prendo i 2/3 perch� nel rewrite mi serve la variabile get html_title=$str_out
			e quindi anche se nascosto ha meno spazio del finto .html ricavato
			*/
			$caratteri_disponibli = ceil($caratteri_url-$caratteri_occupati)*2/3;
			$lunghezza_originale = strlen($str_out);
			if($lunghezza_originale >= $caratteri_disponibili)
				$str_out = substr($str_out, 0, $caratteri_disponibili-1);
		}		
				
		return $str_out;	
	}
	
	public function puntini($str, $len=200, $up=0)
	{
		$tit = trim($str);
		$tit = substr($tit,0,$len); 
		if(strlen($str)>$len)
			$tit .= "...";
		if($up) $tit=ucfirst($tit);	
			
		return $tit;	
	}

	public function taglia($str, $len=90)
	{
		$txt = $str;
		$txt = str_replace("\r","", $txt);
		$txt = str_replace("\n","", $txt);
		$txt = str_replace(".",". ", $txt);
		$txt = str_replace(",",", ", $txt);
		$txt = str_replace("!","! ", $txt);
		$txt = str_replace("?","? ", $txt);
		$txt = str_replace("  "," ", $txt);
		$txt = ucfirst(strtolower($this->puntini($txt,$len)));
		return $txt;
	}
		
	/* 
	per i link presi da database, che non � detto abbiano sempre l' http:// per uscire dal sito.
	Non raddoppia http:// per i link gi� di secondo livello
	*/
	public function out_url($url)
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
	public function date_to_data($date,$sep='-')
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
	
	public function data_ita(){
	
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
	
	public function ridimensiona_anteprima($immagine,$larghezza,$altezza) {
		$dim=getimagesize("$dir_up/".$immagine);
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
	
	public function numera($str)
	{
		$num = trim(str_replace(",",".",$str));
		return (float)($num);
	}

	public function pad($num, $pad=0, $trunc=2)
	{
		$out = numera($num);
		
		$out = str_replace(",",".",$out);
		
		while($out[0] == '0')
			$out = substr($out, 1, strlen($out)-1);
			
		if($out == "")
			$out = 0;

		while(strlen($out)<$pad) 	$out = "0".$out;
		
		$decs = explode(".",$out);
		
		if(count($decs)==1)
		{
			$post=0;
			while(strlen($post)<$trunc) 	$post .= "0";
			return($decs[0].".$post");
		}
		else if(count($decs)==2)
		{
			$decs[1] = substr($decs[1],0,$trunc);
			while(strlen($decs[1])<$trunc)
				$decs[1] .=0;
		
			return $decs[0].".".$decs[1];	
		}
		else
			return $out;
	}

	public function pulisci_frasedb($frase1) 
	{
		$cleanvalue = $frase1;
		if(get_magic_quotes_gpc()==0)
		{
			$cleanvalue = str_replace('"',"''",$cleanvalue);
			$cleanvalue = mysql_real_escape_string($cleanvalue);
		}
		return $cleanvalue;
	}
	
	public function clean_acc($str_in)
	{
		$str_out = str_replace("�", "e'", $str_in);
		$str_out = str_replace("�", "e'", $str_out);
		$str_out = str_replace("�", "a'", $str_out);
		$str_out = str_replace("�", "i'", $str_out);
		$str_out = str_replace("�", "o'", $str_out);
		$str_out = str_replace("�", "u'", $str_out);			
		
		return $str_out;
	}
}
   
?>