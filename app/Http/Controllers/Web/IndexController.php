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

class IndexController extends Controller
{

    /*public function __construct(Index $index) 
	{
        $this->index = $index;
    }*/

    public function verificaDisponibili() 
	{
		
		$CustomController = new CustomController();
		$mysidname = $CustomController->checkSession();		
		
		return $mysidname;
	}

    public function checkConferenza() 
	{
		
		$data_conferenza = "2022-04-06 09:00:00";
		if(date("Y-m-d H:i:s")<$data_conferenza) $conferenza=0;
		else $conferenza=1;	
		
		if($_SERVER['REMOTE_ADDR']=="93.45.34.21"){
			//$conferenza=1;	
		}
		return $conferenza;
	}
	
	public function index(Request $request, $cmd="",$pag_att="1",$pag_dett="",$id_dett="",$anno_risultati="", $variables="")
    {	
		$result = array();
       
		$CustomController = new CustomController();		
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();	
		$mysidname = $CustomController->checkSession();
		$pag="";
		
		$conferenza=$this->checkConferenza();
		
		if($cmd=="registrazione-step2" || $cmd=="registration-step2" || $cmd=="registrazione-step3" || $cmd=="registration-step3"){
			if($cmd=="registrazione-step2" || $cmd=="registrazione-step3")
				return redirect(Config::get('app.url')."/".Lang::get("website.Registrazione link",[],"it"));
			elseif($cmd=="registration-step2" || $cmd=="registration-step3")
				return redirect(Config::get('app.url')."/en/".Lang::get("website.Registrazione link",[],"en"));
		}else{
			if(isset($_GET['ric_reg'])) $ric_reg=$_GET['ric_reg']; else $ric_reg="";
			if(isset($_GET['ric_prov'])) $ric_prov=$_GET['ric_prov']; else $ric_prov="";
			if(isset($_GET['ric_citta'])) $ric_citta=$_GET['ric_citta']; else $ric_citta="";
			if($pag_att=="1"){
				if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att="1";
			}
			
			$metatag = array();
			
			$pagina = "";
			
			if($cmd=="" || $cmd=="home"){
				$pagina = "home";
				$bladeView="web.home";
				$this_page_path_ita = Config::get('app.url')."/";
				$this_page_path_eng = Config::get('app.url')."/en";
			}
			
			// IL CLUB
			elseif($cmd=="la-storia" || $cmd=="history"){
				$pagina = "la_storia";
				$bladeView="web.".$pagina;
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/lo-yccs/$cmd.html";
				$this_page_path_eng = Config::get('app.url')."/en/lo-yccs/$cmd.html";					
			}
			elseif($cmd=="lo-yccs-oggi" || $cmd=="yccs-today"){
				$pagina = "lo_yccs_oggi";
				$bladeView="web.".$pagina;		
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/il-club/$cmd.html";
				$this_page_path_eng = Config::get('app.url')."/en/il-club/$cmd.html";		
			}
			elseif($cmd=="consiglio_direttivo" || $cmd=="board-of-directors"){
				$pagina = "consiglio_direttivo";
				$bladeView="web.".$pagina;		
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/lo-yccs/$cmd.html";
				$this_page_path_eng = Config::get('app.url')."/en/lo-yccs/$cmd.html";		
			}
			elseif($cmd=="club_gemellati" || $cmd=="twinned_clubs"){
				$pagina = "club_gemellati";
				$bladeView="web.".$pagina;		
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/lo-yccs/$cmd.html";
				$this_page_path_eng = Config::get('app.url')."/en/lo-yccs/$cmd.html";		
			}
			elseif($cmd=="club_con_reciprocita" || $cmd=="club_con_reciprocita"){
				$pagina = "club_con_reciprocita";
				$bladeView="web.".$pagina;		
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/lo-yccs/$cmd.html";
				$this_page_path_eng = Config::get('app.url')."/en/lo-yccs/$cmd.html";		
			}
			
			// YCCS PORTO CERVO
			elseif($cmd=="hotel-yacht-club-costa-smeralda"){
				$pagina = "hotel-yacht-club-costa-smeralda";
				$bladeView="web.".$pagina;		
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/servizi/$cmd.html";
				$this_page_path_eng = Config::get('app.url')."/en/servizi/$cmd.html";	
			}
			elseif($cmd=="la-piazza-azzurra" || $cmd=="piazza-azzurra"){
				$pagina = "la_piazza_azzurra";
				$bladeView="web.".$pagina;		
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/servizi/$cmd.html";
				$this_page_path_eng = Config::get('app.url')."/en/servizi/$cmd.html";	
			}
			elseif($cmd=="yccs-wellness-center"){
				$pagina = "yccs_wellness_center";
				$bladeView="web.".$pagina;		
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/servizi/$cmd.html";
				$this_page_path_eng = Config::get('app.url')."/en/servizi/$cmd.html";	
			}
			elseif($cmd=="yccs-sailing-school"){
				$pagina = "yccs_sailing_school";
				$bladeView="web.".$pagina;		
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/$cmd.html";
				$this_page_path_eng = Config::get('app.url')."/en/$cmd.html";	
			}
			elseif($cmd=="centro-sportivo" || $cmd=="sports-centre"){
				$pagina = "centro_sportivo";
				$bladeView="web.area_soci.".$pagina;		
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/area-soci/$cmd.html";
				$this_page_path_eng = Config::get('app.url')."/en/area-soci/$cmd.html";	
			}
			elseif($cmd=="reservation-request"){
				$pagina = "reservation-request";
				$bladeView="web.area_soci.".$pagina;		
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/area-soci/$cmd.html";
				$this_page_path_eng = Config::get('app.url')."/en/area-soci/$cmd.html";	

				$metatag['title'] = "Reservation Request - ".config('app.name');
				$metatag['description'] = config('app.name')." - Reservation Request";
			}
			elseif($cmd=="comunicati" || $cmd=="press-office"){
				$pagina = "comunicati";
				$bladeView="web.".$pagina;		
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/yccs-porto-cervo/$cmd.html";
				$this_page_path_eng = Config::get('app.url')."/en/yccs-porto-cervo/$cmd.html";	
			}
			elseif($cmd=="registrazione-giornalisti"){
				$pagina = "registrazione_giornalisti";
				$bladeView="web.".$pagina;		
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/yccs-porto-cervo/$cmd.html";
				$this_page_path_eng = Config::get('app.url')."/en/yccs-porto-cervo/$cmd.html";	
			}
			elseif($cmd=="meteo"){
				$pagina = "meteo";
				$bladeView="web.".$pagina;		
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/$cmd.html";
				$this_page_path_eng = Config::get('app.url')."/en/$cmd.html";	
			}
			elseif($cmd=="press"){
				$pagina = "press";
				$bladeView="web.".$pagina;		
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/$cmd.html";
				$this_page_path_eng = Config::get('app.url')."/en/$cmd.html";
					
			}
			elseif($cmd=="registrazione-giornalisti"){
				$pagina = "registrazione_giornalisti";
				$bladeView="web.".$pagina;		
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/$cmd.html";
				$this_page_path_eng = Config::get('app.url')."/en/$cmd.html";	
			}
			elseif($cmd=="yccs-sailing-school-iscrizioni"){
				$pagina = "yccs-sailing-school-iscrizioni";
				$bladeView="web.".$pagina;		
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/$cmd.html";
				$this_page_path_eng = Config::get('app.url')."/en/$cmd.html";	
			}
			elseif($cmd=="yccs-sailing-school-conferma-iscrizione"){
				$pagina = "yccs-sailing-school-conferma-iscrizione";
				$bladeView="web.".$pagina;		
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/$cmd.html";
				$this_page_path_eng = Config::get('app.url')."/en/$cmd.html";	
			}
			
			
			// ONE OCEAN
			elseif($cmd=="one-ocean"){
				$pagina = "one_ocean";
				$bladeView="web.".$pagina;		
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/yccs-porto-cervo/$cmd.html";
				$this_page_path_eng = Config::get('app.url')."/en/yccs-porto-cervo/$cmd.html";	
			}
			elseif($cmd=="yccs_sostenibilita"){
				$pagina = "yccs_sostenibilita";
				$bladeView="web.".$pagina;		
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/yccs_e_sostenibilita/$cmd.html";
				$this_page_path_eng = Config::get('app.url')."/en/yccs_e_sostenibilita/$cmd.html";	
			}
			elseif($cmd=="charta_smeralda"){
				$pagina = "charta_smeralda";
				$bladeView="web.".$pagina;		
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/yccs_e_sostenibilita/$cmd.html";
				$this_page_path_eng = Config::get('app.url')."/en/yccs_e_sostenibilita/$cmd.html";	
			}
			elseif($cmd=="yccs_clean_beach_day"){
				$pagina = "yccs_clean_beach_day";
				$bladeView="web.".$pagina;		
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/yccs_e_sostenibilita/$cmd.html";
				$this_page_path_eng = Config::get('app.url')."/en/yccs_e_sostenibilita/$cmd.html";	
			}
			elseif($cmd=="10_eco_consigli_per_i_velisti"){
				$pagina = "10_eco_consigli_per_i_velisti";
				$bladeView="web.".$pagina;		
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/yccs_e_sostenibilita/$cmd.html";
				$this_page_path_eng = Config::get('app.url')."/en/yccs_e_sostenibilita/$cmd.html";	
			}
			
			// AZZURRA
			elseif($cmd=="40_anni_di_azzurra"){
				$pagina = "40_anni_di_azzurra";
				$bladeView="web.".$pagina;		
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/azzurra/$cmd.html";
				$this_page_path_eng = Config::get('app.url')."/en/azzurra/$cmd.html";	
				
				$tit_pag = "40 Anni di Azzurra";
				if($lingua=="eng") $tit_pag = "40 Years of Azzurra";
				
				$metatag['title'] = "$tit_pag - Azzurra - ".config('app.name');
				$metatag['description'] = config('app.name')." - Azzurra - $tit_pag";
			}
			elseif($cmd=="azzurra-pagine"){
				$pagina = "azzurra-pagine";
				$bladeView="web.".$pagina;	

				$id_pagina = ltrim(strrchr($pag_dett, '-'), '-');
				
				$value_pag = DB::table('azzurra_pagine')
					->select('*')
					->WHERE('id',$id_pagina)
					->first();
					
				$pagina_esiste=0;
				if ($value_pag) {
					$pagina_esiste=1;
					
					$id_dett = $id_pagina;
					
					$url_ita = $CustomController->to_htaccess_url($value_pag->titolo, "");
					$url_eng = $CustomController->to_htaccess_url($value_pag->titolo_eng, "");
					
					$tit_pag = $value_pag->titolo;
					$tit_pag_eng = trim($value_pag->titolo_eng) != "" ? $value_pag->titolo_eng : $value_pag->titolo;
					
					if ($lingua == "eng") {
						$tit_pag = $tit_pag_eng;
					}
					
					// Definizione percorsi (ITA e ENG)
					$baseUrl = Config::get('app.url');
					$this_page_path_ita = $baseUrl . "/azzurra/" . $url_ita . "-" .$id_pagina. ".html";
					$this_page_path_eng = $baseUrl . "/en/azzurra/" . $url_eng . "-" .$id_pagina. ".html";
					
					// Metatag
					$metatag['title'] = "$tit_pag - Azzurra - " . config('app.name');
					$metatag['description'] = config('app.name') . " - Azzurra - $tit_pag";
				}
				
				if($pagina_esiste==0){
					if($lingua=="ita")
						return redirect(Config::get('app.url')."/404.html");
					else
						return redirect(Config::get('app.url')."/en/404.html");
				}
			}
			
			// YOUNG AZZURRA
			elseif($cmd=="young-azzurra"){
				$pagina = "young-azzurra";
				$bladeView="web.".$pagina;		
			}
			elseif($cmd=="team"){
				$pagina = "young-azzurra-team";
				$bladeView="web.".$pagina;		
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/young-azzurra/$cmd.html";
				$this_page_path_eng = Config::get('app.url')."/en/young-azzurra/$cmd.html";	
				
				if($id_dett!=""){
					$this_page_path_ita = Config::get('app.url')."/young-azzurra/$cmd/$pag_dett-$id_dett.html";
					$this_page_path_eng = Config::get('app.url')."/en/young-azzurra/$cmd/$pag_dett-$id_dett.html";
						
					$metatag['title'] = ucWords(str_replace("_"," ",$pag_dett))." - ".Lang::get("website.$pagina title");
					$metatag['description'] = ucWords(str_replace("_"," ",$pag_dett))." - ".Lang::get("website.$pagina description");
				}
			}
			elseif($cmd=="atleti"){
				$pagina = "young-azzurra-atleti";
				$bladeView="web.".$pagina;		
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/young-azzurra/$cmd";
				$this_page_path_eng = Config::get('app.url')."/en/young-azzurra/$cmd";	
				
				$metatag['title'] = Lang::get("website.$pagina nome pagina");
				$metatag['description'] = ucWords(str_replace("_"," ",$pag_dett));
				
				if($anno_risultati!=""){
					$this_page_path_ita .= "-".$anno_risultati;
					$this_page_path_eng .= "-".$anno_risultati;
					
					$metatag['title'] .= " - ".$anno_risultati;
					$metatag['description'] .= " - ".$anno_risultati;
				}
				$this_page_path_ita .= ".html";
				$this_page_path_eng .= ".html";	
					
				$metatag['title'] .= " - ".config('app.name');
				$metatag['description'] .= " - ".config('app.name');
				
				
				
				if($id_dett!=""){
					$this_page_path_ita = Config::get('app.url')."/young-azzurra/$cmd";
					$this_page_path_eng = Config::get('app.url')."/en/young-azzurra/$cmd";
					if($anno_risultati!=""){
						$this_page_path_ita .= "-".$anno_risultati;
						$this_page_path_eng .= "-".$anno_risultati;
					}
					$this_page_path_ita .= "/$pag_dett-$id_dett.html";
					$this_page_path_eng .= "/$pag_dett-$id_dett.html";	
						
					$metatag['title'] = ucWords(str_replace("_"," ",$pag_dett))." - ".$anno_risultati." - ".Lang::get("website.$pagina title");
					$metatag['description'] = ucWords(str_replace("_"," ",$pag_dett))." - ".$anno_risultati." - ".Lang::get("website.$pagina description");
				}
			}
			elseif($cmd=="news" && str_contains(url()->full(), 'young-azzurra')){
				$pagina = "young-azzurra-news";
				$bladeView="web.".$pagina;		
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/young-azzurra/$cmd.html";
				$this_page_path_eng = Config::get('app.url')."/en/young-azzurra/$cmd.html";	
				if($pag_att!=1){
					$this_page_path_ita = Config::get('app.url')."/young-azzurra/".$cmd."_pag".$pag_att.".html";
					$this_page_path_eng = Config::get('app.url')."/en/young-azzurra/".$cmd."_pag".$pag_att.".html";	
				}
				
				if($id_dett!=""){
					$pagina = "young-azzurra-news_dett";
					$bladeView="web.".$pagina;		
					
					//Genero link per passaggio di lingua		
					if($pag_att!=1){
						$this_page_path_ita = Config::get('app.url')."/young-azzurra/".$cmd."-pag".$pag_att."/".$pag_dett."-".$id_dett.".html";
						$this_page_path_eng = Config::get('app.url')."/en/young-azzurra/".$cmd."-pag".$pag_att."/".$pag_dett."-".$id_dett.".html";	
					}
				}
			}
			elseif($cmd=="photogallery"){
				$pagina = "young-azzurra-gallery";
				$bladeView="web.".$pagina;		
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/young-azzurra/$cmd.html";
				$this_page_path_eng = Config::get('app.url')."/en/young-azzurra/$cmd.html";	
			}
			elseif($cmd=="video_gallery"){
				$pagina = "young-azzurra-video";
				$bladeView="web.".$pagina;		
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/young-azzurra/$cmd.html";
				$this_page_path_eng = Config::get('app.url')."/en/young-azzurra/$cmd.html";	
			}
			elseif($cmd=="risultati"){
				$pagina = "young-azzurra-risultati";
				$bladeView="web.".$pagina;		
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/young-azzurra/$cmd.html";
				$this_page_path_eng = Config::get('app.url')."/en/young-azzurra/$cmd.html";	
			}
			
			// AREA SOCI
			elseif($cmd=="login"){
				$pagina = "login";
				$bladeView="web.area_soci.".$pagina;		
				
				$metatag['title'] = Lang::get('website.accedi')." - ".Lang::get('website.area soci')." - ".config('app.name');
				$metatag['description'] = Lang::get('website.accedi')." - ".Lang::get('website.area soci')." - ".config('app.name');
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/area-soci/$cmd.html";
				$this_page_path_eng = Config::get('app.url')."/en/area-soci/$cmd.html";	
			}
			elseif($cmd=="registrazione"){
				$pagina = "registrazione";
				$bladeView="web.area_soci.".$pagina;	
				
				$metatag['title'] = Lang::get('website.registrazione')." - ".Lang::get('website.area soci')." - ".config('app.name');
				$metatag['description'] = Lang::get('website.registrazione')." - ".Lang::get('website.area soci')." - ".config('app.name');	
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/area-soci/$cmd.html";
				$this_page_path_eng = Config::get('app.url')."/en/area-soci/$cmd.html";	
			}
			elseif($cmd=="recupera-password"){
				$pagina = "recupera-password";
				$bladeView="web.area_soci.".$pagina;		
				
				$metatag['title'] = Lang::get('website.recupera password')." - ".Lang::get('website.area soci')." - ".config('app.name');
				$metatag['description'] = Lang::get('website.recupera password')." - ".Lang::get('website.area soci')." - ".config('app.name');	
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/area-soci/$cmd.html";
				$this_page_path_eng = Config::get('app.url')."/en/area-soci/$cmd.html";	
			}
			elseif($cmd=="cambia-password"){
				$pagina = "cambia-password";
				$bladeView="web.area_soci.".$pagina;		
				
				$metatag['title'] = Lang::get('website.cambia password')." - ".Lang::get('website.area soci')." - ".config('app.name');
				$metatag['description'] = Lang::get('website.cambia password')." - ".Lang::get('website.area soci')." - ".config('app.name');	
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/$cmd-$id_dett.html";
				$this_page_path_eng = Config::get('app.url')."/en/$cmd-$id_dett.html";	
			}
			elseif($cmd=="carrello"){
				$pagina = "carrello";
				$bladeView="web.area_soci.".$pagina;		
				
				$metatag['title'] = Lang::get('website.carrello')." - ".Lang::get('website.area soci')." - ".config('app.name');
				$metatag['description'] = Lang::get('website.carrello')." - ".Lang::get('website.area soci')." - ".config('app.name');	
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/area-soci/$cmd.html";
				$this_page_path_eng = Config::get('app.url')."/en/area-soci/$cmd.html";	
			}
			elseif($cmd=="checkout"){
				$pagina = "checkout";
				$bladeView="web.area_soci.".$pagina;		
				
				$metatag['title'] = "Checkout - ".Lang::get('website.area soci')." - ".config('app.name');
				$metatag['description'] = "Checkout - ".Lang::get('website.area soci')." - ".config('app.name');	
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/area-soci/$cmd.html";
				$this_page_path_eng = Config::get('app.url')."/en/area-soci/$cmd.html";	
			}
			elseif($cmd=="comunicazioni-ai-soci"){
				$pagina = "comunicazioni-ai-soci";
				$bladeView="web.area_soci.".$pagina;		
				
				$metatag['title'] = Lang::get('website.comunicazioni ai soci')." - ".Lang::get('website.area soci')." - ".config('app.name');
				$metatag['description'] = Lang::get('website.comunicazioni ai soci')." - ".Lang::get('website.area soci')." - ".config('app.name');	
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/area-soci/$cmd.html";
				$this_page_path_eng = Config::get('app.url')."/en/area-soci/$cmd.html";	
			}
			elseif($cmd=="la-boutique"){
				$pagina = "la-boutique";
				$bladeView="web.area_soci.".$pagina;		
				
				$metatag['title'] = Lang::get('website.la boutique')." - ".Lang::get('website.area soci')." - ".config('app.name');
				$metatag['description'] = Lang::get('website.la boutique')." - ".Lang::get('website.area soci')." - ".config('app.name');	
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/area-soci/$cmd.html";
				$this_page_path_eng = Config::get('app.url')."/en/area-soci/$cmd.html";	
			}
			elseif($cmd=="i-miei-ordini"){
				$pagina = "i-miei-ordini";
				$bladeView="web.area_soci.".$pagina;		
				
				$metatag['title'] = Lang::get('website.i miei ordini')." - ".Lang::get('website.area soci')." - ".config('app.name');
				$metatag['description'] = Lang::get('website.i miei ordini')." - ".Lang::get('website.area soci')." - ".config('app.name');	
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/area-soci/$cmd.html";
				$this_page_path_eng = Config::get('app.url')."/en/area-soci/$cmd.html";	
			}
			elseif($cmd=="profilo-socio"){
				$pagina = "profilo-socio";
				$bladeView="web.area_soci.".$pagina;		
				
				$metatag['title'] = Lang::get('website.profilo socio')." - ".Lang::get('website.area soci')." - ".config('app.name');
				$metatag['description'] = Lang::get('website.profilo socio')." - ".Lang::get('website.area soci')." - ".config('app.name');	
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/area-soci/$cmd.html";
				$this_page_path_eng = Config::get('app.url')."/en/area-soci/$cmd.html";	
			}
			elseif($cmd=="certificato-di-guidone"){
				$pagina = "certificato-di-guidone";
				$bladeView="web.area_soci.".$pagina;		
				
				$metatag['title'] = Lang::get('website.certificato di guidone')." - ".Lang::get('website.area soci')." - ".config('app.name');
				$metatag['description'] = Lang::get('website.certificato di guidone')." - ".Lang::get('website.area soci')." - ".config('app.name');	
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/area-soci/$cmd.html";
				$this_page_path_eng = Config::get('app.url')."/en/area-soci/$cmd.html";	
			}
			elseif($cmd=="regate-interclub"){
				$pagina = "regate-interclub";
				$bladeView="web.area_soci.".$pagina;		
				
				$metatag['title'] = Lang::get('website.regate interclub')." - ".Lang::get('website.area soci')." - ".config('app.name');
				$metatag['description'] = Lang::get('website.regate interclub')." - ".Lang::get('website.area soci')." - ".config('app.name');	
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/area-soci/$cmd.html";
				$this_page_path_eng = Config::get('app.url')."/en/area-soci/$cmd.html";	
			}
			elseif($cmd=="pagamento-quota"){
				$pagina = "pagamento-quota";
				$bladeView="web.area_soci.".$pagina;		
				
				$metatag['title'] = Lang::get('website.pagamento quota')." - ".Lang::get('website.area soci')." - ".config('app.name');
				$metatag['description'] = Lang::get('website.pagamento quota')." - ".Lang::get('website.area soci')." - ".config('app.name');	
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/area-soci/$cmd.html";
				$this_page_path_eng = Config::get('app.url')."/en/area-soci/$cmd.html";	
			}			
				
			elseif($cmd=="news"){
				$pagina = "news";
				$bladeView="web.".$pagina;		
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/$cmd.html";
				$this_page_path_eng = Config::get('app.url')."/en/$cmd.html";	
				if($pag_att!=1){
					$this_page_path_ita = Config::get('app.url')."/".$cmd."_pag".$pag_att.".html";
					$this_page_path_eng = Config::get('app.url')."/en/".$cmd."_pag".$pag_att.".html";	
				}
				
				$metatag['title'] = "News - Pag $pag_att - ".config('app.name');
				$metatag['description'] = "News - Pag $pag_att - ".config('app.name');	
								
				if($id_dett!=""){
					$pagina = "news_dett";
					$bladeView="web.".$pagina;		
					
					$query_dett=DB::table('news')
						->select('*')
						->where('id','=',$id_dett)
						->where('news','=','1')
						->where('covid','=','0')
						->get();
					$num_dett=$query_dett->count();
					
					if($num_dett>0){	
						$titolo_dett = $query_dett[0]->titolo;
						$titolo_dett_eng = $query_dett[0]->titolo;
						if(isset($query_dett[0]->titolo_eng) && $query_dett[0]->titolo_eng!="") $titolo_dett_eng = $query_dett[0]->titolo_eng;
						if(!isset($pag_att) || $pag_att=="") $pag_att=1;
						
						$tit_n = $titolo_dett;
						if($lingua=="en") $tit_n = $titolo_dett_eng;
						$metatag['title'] = $tit_n." - News - ".config('app.name');
						$metatag['description'] = $tit_n." - News - ".config('app.name');	
						
						//Genero link per passaggio di lingua							
						$this_page_path_ita = Config::get('app.url')."/".$cmd."-pag".$pag_att."/".$CustomController->to_htaccess_url($titolo_dett)."-".$id_dett.".html";
						$this_page_path_eng = Config::get('app.url')."/en/".$cmd."-pag".$pag_att."/".$CustomController->to_htaccess_url($titolo_dett_eng)."-".$id_dett.".html";
					}else{
						if($lingua=="ita")
							return redirect(Config::get('app.url')."/404.html");
						else
							return redirect(Config::get('app.url')."/en/404.html");	
					}
					
				}			
			}
			elseif($cmd=="news_private"){
				$pagina = "news_private";
				$bladeView="web.".$pagina;		
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/$cmd.html";
				$this_page_path_eng = Config::get('app.url')."/en/$cmd.html";	
				if($pag_att!=1){
					$this_page_path_ita = Config::get('app.url')."/".$cmd."_pag".$pag_att.".html";
					$this_page_path_eng = Config::get('app.url')."/en/".$cmd."_pag".$pag_att.".html";	
				}
				
				$metatag['title'] = "News Private - Pag $pag_att - ".config('app.name');
				$metatag['description'] = "News Private - Pag $pag_att - ".config('app.name');	
								
				if($id_dett!=""){
					$pagina = "news_private_dett";
					$bladeView="web.".$pagina;	

					$query_dett=DB::table('news_private')
						->select('*')
						->where('id','=',$id_dett)
						->get();
					$num_dett=$query_dett->count();
					
					if($num_dett>0){	
						$titolo_dett = $query_dett[0]->titolo;
						$titolo_dett_eng = $query_dett[0]->titolo;
						if(isset($query_dett[0]->titolo_eng) && $query_dett[0]->titolo_eng!="") $titolo_dett_eng = $query_dett[0]->titolo_eng;
						if(!isset($pag_att) || $pag_att=="") $pag_att=1;
						
						$tit_n = $titolo_dett;
						if($lingua=="en") $tit_n = $titolo_dett_eng;
						$metatag['title'] = $tit_n." - News Private - ".config('app.name');
						$metatag['description'] = $tit_n." - News Private - ".config('app.name');
						
						//Genero link per passaggio di lingua	
						$this_page_path_ita = Config::get('app.url')."/".$cmd."-pag".$pag_att."/".$CustomController->to_htaccess_url($titolo_dett)."-".$id_dett.".html";
						$this_page_path_eng = Config::get('app.url')."/en/".$cmd."-pag".$pag_att."/".$CustomController->to_htaccess_url($titolo_dett_eng)."-".$id_dett.".html";
					}else{
						if($lingua=="ita")
							return redirect(Config::get('app.url')."/404.html");
						else
							return redirect(Config::get('app.url')."/en/404.html");	
					}					
				}			
			}
			elseif($cmd=="yccs-app"){
				$pagina = "yccs-app";
				$bladeView="web.".$pagina;		
				
				$metatag['title'] = "YCCS APP - ".config('app.name');
				$metatag['description'] = "YCCS APP - ".config('app.name');	
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/$cmd.html";
				$this_page_path_eng = Config::get('app.url')."/en/$cmd.html";	
			}
			elseif($cmd=="links"){
				$pagina = "links";
				$bladeView="web.".$pagina;		
				
				$metatag['title'] = "Links - ".config('app.name');
				$metatag['description'] = "Links - ".config('app.name');	
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/$cmd.html";
				$this_page_path_eng = Config::get('app.url')."/en/$cmd.html";	
			}
			elseif($cmd=="links_dev"){
				$pagina = "links_dev";
				$bladeView="web.".$pagina;		
				
				$metatag['title'] = "Links - ".config('app.name');
				$metatag['description'] = "Links - ".config('app.name');	
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/$cmd.html";
				$this_page_path_eng = Config::get('app.url')."/en/$cmd.html";	
			}
			elseif($cmd=="magazine"){
				$pagina = "magazine";
				$bladeView="web.".$pagina;		
				
				$metatag['title'] = "Magazine - ".config('app.name');
				$metatag['description'] = "Magazine - ".config('app.name');	
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/$cmd.html";
				$this_page_path_eng = Config::get('app.url')."/en/$cmd.html";	
			}
			
			elseif($cmd=="contatti" || $cmd=="contacts"){
				$pagina = "contatti";
				$bladeView="web.".$pagina;	

				$metatag['title'] = Lang::get('website.contatti')." - ".config('app.name');
				$metatag['description'] = Lang::get('website.contatti')." - ".config('app.name');
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/$cmd.html";
				$this_page_path_eng = Config::get('app.url')."/en/$cmd.html";	
			}
			
			elseif($cmd=="lavora-con-noi"){
				$pagina = "lavora-con-noi";
				$bladeView="web.".$pagina;	

				$metatag['title'] = Lang::get('website.lavora con noi')." - ".config('app.name');
				$metatag['description'] = Lang::get('website.lavora con noi')." - ".config('app.name');
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/$cmd.html";
				$this_page_path_eng = Config::get('app.url')."/en/$cmd.html";	
			}
			elseif($cmd=="condizioni-di-vendita" || $cmd=="terms-of-sale"){
				$pagina = "condizioni-di-vendita";
				$bladeView="web.".$pagina;			
			}
			elseif($cmd=="il-mio-account" || $cmd=="my-account"){
				$pagina = "il-mio-account";
				$bladeView="web.".$pagina;			
			}
			
			elseif($cmd=="carrello" || $cmd=="cart"){
				$pagina = "carrello";
				$bladeView="web.".$pagina;			
			}
			elseif($cmd=="conferma-ordine" || $cmd=="order-confirmation"){
				$pagina = "ordina";
				$bladeView="web.".$pagina;			
			}
			elseif($cmd=="sitemap" || $cmd=="sitemap"){
				$pagina = "sitemap";
				$bladeView="web.".$pagina;			
			}
			elseif($cmd=="privacy"){
				$pagina = "privacy";
				$bladeView="web.".$pagina;	
				
				$metatag['title'] = "Privacy - ".config('app.name');
				$metatag['description'] = $metatag['title'];
				
				$this_page_path_ita = Config::get('app.url')."/".$pagina.".html";
				$this_page_path_eng = Config::get('app.url')."/en/".$pagina.".html";					
			}
			elseif($cmd=="privacy_giornalisti"){
				$pagina = "privacy_giornalisti";
				$bladeView="web.".$pagina;	
				
				if($lingua=="ita") $metatag['title'] = "Privacy - YCCS GIORNALISTI - ".config('app.name');
				else  $metatag['title'] = "Privacy - YCCS JOURNALISTS - ".config('app.name');
				$metatag['description'] = $metatag['title'];
				
				$this_page_path_ita = Config::get('app.url')."/".$pagina.".html";
				$this_page_path_eng = Config::get('app.url')."/en/".$pagina.".html";					
			}
			elseif($cmd=="privacy_members"){
				$pagina = "privacy_members";
				$bladeView="web.".$pagina;	
				
				$metatag['title'] = "Privacy - YCCS MEMBERS - ".config('app.name');
				$metatag['description'] = $metatag['title'];
				
				$this_page_path_ita = Config::get('app.url')."/".$pagina.".html";
				$this_page_path_eng = Config::get('app.url')."/en/".$pagina.".html";					
			}
			elseif($cmd=="il-meteo-livewebcam"){
				$pagina = "il-meteo-livewebcam";
				$bladeView="web.".$pagina;	
				
				$metatag['title'] = "Livewebcam - ".config('app.name');
				$metatag['description'] = $metatag['title'];				
			}
			elseif($cmd=="benvenuto"){
				$pagina = "benvenuto";
				$bladeView="web.area_soci.".$pagina;	
				
				$metatag['title'] = Lang::get('website.benvenuto')." - ".config('app.name');
				$metatag['description'] = Lang::get('website.benvenuto')." - ".config('app.name');
				
				$this_page_path_ita = Config::get('app.url')."/".$pagina.".html";
				$this_page_path_eng = Config::get('app.url')."/en/".$pagina.".html";					
			}
			
			if(!isset($metatag['title'])) $metatag['title'] = Lang::get("website.$pagina title");
			if(!isset($metatag['description'])) $metatag['description'] = Lang::get("website.$pagina description");							
			
			if(!isset($this_page_path_ita) && !isset($this_page_path_eng)){
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/".Lang::get("website.$pagina slug",[],"it").$pag.".html";
				$this_page_path_eng = Config::get('app.url')."/en/".Lang::get("website.$pagina slug",[],"en").$pag.".html";		
			}
			
			if(!isset($bladeView)){
				$bladeView = "web.404";
				$cmd="404";
			
				$metatag['title'] = "Error 404 - Page not Found";
				$metatag['description'] = "Error 404 - Page not Found";
				
				//Genero link per passaggio di lingua		
				$this_page_path_ita = Config::get('app.url')."/404.html";
				$this_page_path_eng = Config::get('app.url')."/en/404.html";
			}
			
			$view = view($bladeView);
			$view = $view->with('result', $result);
			$view = $view->with('metatag', $metatag);
			$view = $view->with('cmd', $cmd);
			$view = $view->with('pagina', $pagina);
			$view = $view->with('lingua', $lingua);
			$view = $view->with('pag_att', $pag_att);
			if(isset($id_dett)) $view = $view->with('id_dett', $id_dett);
			if(isset($pag_dett)) $view = $view->with('pag_dett', $pag_dett);
			if(isset($conferenza)) $view = $view->with('conferenza', $conferenza);
			$view = $view->with('variables', $variables);
			$view = $view->with('anno_risultati', $anno_risultati);
			$view = $view->with('mysidname', $mysidname);
			
			$view = $view->with('this_page_path_ita', $this_page_path_ita);
			$view = $view->with('this_page_path_eng', $this_page_path_eng);
			
			return $view;
		}
    }
	
	public function aiuti(Request $request, $anno)
	{
		$result = array();
       
		$CustomController = new CustomController();		
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();	
		$mysidname = $CustomController->checkSession();
		
		$pagina = "aiuti_di_stato";
		$cmd = $pagina;
		$bladeView="web.".$pagina;			
		
		//Genero link per passaggio di lingua		
		$this_page_path_ita = Config::get('app.url')."/aiuti-di-stato/$anno.html";
		$this_page_path_eng = Config::get('app.url')."/en/aiuti-di-stato/$anno.html";
		
		$metatag['title'] = "Aiuti di Stato - $anno - ".config('app.name');
		$metatag['description'] = config('app.name')." - Aiuti di Stato - $anno";
		
		$view = view($bladeView);
		$view = $view->with('result', $result);
		$view = $view->with('metatag', $metatag);
		$view = $view->with('cmd', $cmd);
		$view = $view->with('pagina', $pagina);
		$view = $view->with('lingua', $lingua);
		$view = $view->with('anno', $anno);
		$view = $view->with('mysidname', $mysidname);
		
		$view = $view->with('this_page_path_ita', $this_page_path_ita);
		$view = $view->with('this_page_path_eng', $this_page_path_eng);
		
		return $view;
	}
	
	public function pressConference(Request $request, $id_dett, $active_tab="foto")
	{
		$result = array();
       
		$CustomController = new CustomController();		
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();	
		$mysidname = $CustomController->checkSession();
		
		$pagina = "press_conference";
		$cmd = $pagina;
		$bladeView="web.".$pagina;			
		
		//Genero link per passaggio di lingua		
		$this_page_path_ita = Config::get('app.url')."/press-conference-$id_dett/$active_tab.html";
		$this_page_path_eng = Config::get('app.url')."/en/press-conference-$id_dett/$active_tab.html";
		
		$query_ras = DB::table('rassegna')
			->select('*')
			->where('id','=',$id_dett)
			->get();

		$titolo = $query_ras[0]->titolo_eng;
		if($lingua=="ita" && $query_ras[0]->titolo_eng && $query_ras[0]->titolo_eng!="") $titolo = $query_ras[0]->titolo;
		
		$metatag['title'] = "$titolo - Press Conference - ".config('app.name');
		$metatag['description'] = config('app.name')." - Press Conference - $titolo";
		
		$view = view($bladeView);
		$view = $view->with('result', $result);
		$view = $view->with('metatag', $metatag);
		$view = $view->with('cmd', $cmd);
		$view = $view->with('pagina', $pagina);
		$view = $view->with('lingua', $lingua);
		$view = $view->with('query_ras', $query_ras[0]);
		$view = $view->with('titolo', $titolo);
		$view = $view->with('mysidname', $mysidname);
		$view = $view->with('id_dett', $id_dett);
		$view = $view->with('active_tab', $active_tab);
		
		$view = $view->with('this_page_path_ita', $this_page_path_ita);
		$view = $view->with('this_page_path_eng', $this_page_path_eng);
		
		return $view;
	}
	
	public function dati_iscrizione_scuola(Request $request)
	{
		if(isset($_GET['id_pers'])) $id_pers=$_GET['id_pers']; else $id_pers="1";
		if(isset($_GET['id_ute'])) $id_ute=$_GET['id_ute']; else $id_ute="";
		if(isset($_GET['lingua'])) $lingua=$_GET['lingua']; else $lingua="ita";
		if(isset($_GET['fam'])) $fam=$_GET['fam']; else $fam="";
		
		$view = view("web.yccs_sailing_school_dati_iscrizione_scuola");
		$view = $view->with('id_pers', $id_pers);
		$view = $view->with('id_ute', $id_ute);
		$view = $view->with('lingua', $lingua);
		$view = $view->with('fam', $fam);
		return $view;
	}
	
	public function invioFormScuola(Request $request)
	{
		$result = array();
		
		$CustomController = new CustomController();
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();	
		
        $cmd="yccs-sailing-school";
		$metatag = array();
		$metatag['title'] = Lang::get("website.yccs-sailing-school title");
		$metatag['description'] = Lang::get("website.yccs-sailing-school description");				
		
		//Genero link per passaggio di lingua		
		$this_page_path_ita = Config::get('app.url')."/yccs-porto-cervo/yccs-sailing-school.html";
		$this_page_path_eng = Config::get('app.url')."/en/yccs-porto-cervo/yccs-sailing-school.html";	
				
		if(isset($_POST['richiesta_scuola'])) $richiesta_scuola=$_POST['richiesta_scuola']; else $richiesta_scuola="";
		if(isset($_POST['nome'])) $nome=$_POST['nome']; else $nome="";
		if(isset($_POST['email'])) $email=$_POST['email']; else $email="";
		if(isset($_POST['messaggio'])) $messaggio=$_POST['messaggio']; else $messaggio="";
		
		if($richiesta_scuola=="inviata" && isset($_POST['g-recaptcha-response'])){
			$secretKey = env('GOOGLE_RECAPTCHA_SECRET_KEY_V2');
			$response = $_POST['g-recaptcha-response'];     
			$remoteIp = $_SERVER['REMOTE_ADDR'];

			$reCaptchaValidationUrl = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response&remoteip=$remoteIp");
			$result = json_decode($reCaptchaValidationUrl, TRUE);				
			if($result['success'] == 1) {
				
				$mail_sito = env('APP_EMAIL');
				$ind_sito = env('APP_URL');
				$nome_del_sito = env('APP_NAME');
				$logo_scuola = $ind_sito."/".env('APP_LOGO_SCUOLA_VELA');
				
				include(base_path('resources/views/web/common/body_mail_scuola_vela.css.php'));
				
				$nome_cliente = ucfirst($nome);
				
				$testo_az = "<br><br><br>L'utente <b>$nome_cliente</b> ha inviato una richiesta di contatto.
				<br><br>		
				Questi sono i dati che ci ha fornito<br/>";	
				$testo_az .= "<b>Nome</b> : $nome<br>		
				<b>Email</b> : $email<br>
				<b>Messaggio</b> : $messaggio<br>";				
				
				$oggetto_azi = "YCCS Sailing School - Richiesta contatto";
				
				$testo_cli = "<br><br><br>Gentile <b>$nome_cliente</b><br/>La sua richiesta è stata ricevuta: provvederemo al più presto a contattarla in risposta.</b>
				<br><br>		
				Questi sono i dati che ci ha fornito<br/>";	
				$testo_cli .= "<b>Nome</b> : $nome<br>		
				<b>Email</b> : $email<br>
				<b>Messaggio</b> : $messaggio<br>";
		
				$testo_cli_eng = "<br><br><br>Dear <b>$nome_cliente</b><br/>Thanks for your request</b>
				<br><br>
				This is the data you gave us:<br/>";	
				$testo_cli_eng .= "<b>Name</b> : $nome<br>		
				<b>Email</b> : $email<br>
				<b>Message</b> : $messaggio<br>";
				
				$body_azi = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_az, $body);			
				if($lingua=="ita"){
					$body_cli = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_cli, $body);			
					$oggetto_cli = "YCCS Sailing School - Grazie per la richiesta d'iscrizione";
				}
				else {
					$body_cli = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_cli_eng, $body);			
					$oggetto_cli = "YCCS Sailing School - Thanks for your request";		
				}
				
				$MailController = new MailController();
				//sendMail($from_email, $from_name, $to_email, $to_name, $subject, $body, $file="")
				//$invioMail_azi = $MailController->sendMail($mail_sito,$nome_del_sito,"f.denegri@cwstudio.it",$nome_del_sito, $oggetto_azi, $body_azi); 
				$invioMail_azi = $MailController->sendMail($mail_sito,$nome_del_sito,"sailingschool@yccs.it",$nome_del_sito, $oggetto_azi, $body_azi); 
				$invioMail_cli = $MailController->sendMail($mail_sito,$nome_del_sito,$email,$nome_cliente, $oggetto_cli, $body_cli); 
				
				if($invioMail_cli=="OK"){
					$message_color = "#81c868";
					if($lingua=="ita")
						$message = 'Email inviata con successio!';
					else
						$message = 'Successful email!';			
				}else{
					$message_color = "red";
					if($lingua=="ita")
						$message = 'Errore! Si prega di riprovare';
					else
						$message = 'Error! Please retry';	
				}
			}else{
				$message_color = "red";
				if($lingua=="ita")
					$message = 'Errore! Si prega di riprovare';
				else
					$message = 'Error! Please retry';
			}
		}else{
			$message_color = "red";
			if($lingua=="ita")
				$message = 'Errore! Si prega di riprovare';
			else
				$message = 'Error! Please retry';
		}
		
		$view = view("web.yccs_sailing_school");
		$view = $view->with('result', $result);
		$view = $view->with('metatag', $metatag);
		$view = $view->with('cmd', $cmd);
		$view = $view->with('lingua', $lingua);
		$view = $view->with('this_page_path_ita', $this_page_path_ita);
		$view = $view->with('this_page_path_eng', $this_page_path_eng);
		
		if($nome!="") $view->with('nome', $nome);
		if($email!="") $view->with('email', $email);
		if($messaggio!="") $view->with('messaggio', $messaggio);
		if($richiesta_scuola!="") $view->with('richiesta_scuola', $richiesta_scuola);
		
		$view = $view->with('message_color', $message_color);
		$view = $view->withErrors($message);
		return $view;
	}
	public function invioIscrizioneScuola(Request $request)
	{
		$result = array();
		
		$CustomController = new CustomController();
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();	
		
        $cmd="yccs-sailing-school-iscrizioni";
		$metatag = array();
		$metatag['title'] = Lang::get("website.yccs-sailing-school-iscrizioni title");
		$metatag['description'] = Lang::get("website.yccs-sailing-school-iscrizioni description");				
		
		//Genero link per passaggio di lingua		
		$this_page_path_ita = Config::get('app.url')."/yccs-sailing-school-iscrizioni.html";
		$this_page_path_eng = Config::get('app.url')."/en/yccs-sailing-school-iscrizioni.html";	

		if(isset($_POST['stato'])) $stato=$_POST['stato']; else $stato="";
		if(isset($_POST['recuperopassword'])) $recuperopassword=$_POST['recuperopassword']; else $recuperopassword="";
		if(isset($_POST['recupero'])) $recupero=$_POST['recupero']; else $recupero="";
		
		if($recupero=="inviato"){
			if(isset($_POST['email'])) $email=$_POST['email']; else $email="";
			if(isset($_POST['password'])) $password=$_POST['password']; else $password="";
		
			$query_rec = DB::table('iscritti_scuola')
				->select('*')
				->where('email','=',$email)
				->get();
			$num_rec = $query_rec->count();
			
			if($num_rec>0){
				//if ((crypt($password, $query_rec[0]->password) == $query_rec[0]->password) || ($password == $query_rec[0]->password)) {
				if ((password_verify($password, $query_rec[0]->password)) || ($password == $query_rec[0]->password)) {
					$query_isc = DB::table('iscrizioni_scuola')
						->select('*')
						->where('id_utente','=',$query_rec[0]->id)
						->where('id_rife','=','0')
						->orderby('id','DESC')
						->limit('1')
						->get();
					$num_isc = $query_isc->count();
					
					if($num_isc>0){
						$x=1;
						//dd($query_isc[0]);
						foreach($query_isc[0] as $key => $value) {
							//if($x==1){
								$$key = $value;
								//echo "$key is at $value<br/>";
							//}
							$x++;
							if($x==3) $x=1;				
						}
						$message_color = "#81c868";
						if($lingua=="ita")
							$message = 'Dati recuperati con successo!';
						else
							$message = 'Data successfully recovered!';
					}else{
						$message_color = "red";
						if($lingua=="ita")
							$message = 'Nessun dato da recuperare con questa email';
						else
							$message = 'No data to recover with this email';
					}
				}else{
					$message_color = "red";
					if($lingua=="ita")
						$message = 'Password errata';
					else
						$message = 'Wrong Password';
					
				}
			}else{
				$message_color = "red";
				if($lingua=="ita")
					$message = 'Nessun dato da recuperare con questa email';
				else
					$message = 'No data to recover with this email';	
			}
		}
		elseif($recuperopassword=="inviato"){
			if(isset($_POST['email'])) $email=$_POST['email']; else $email="";
			
			$query_rec = DB::table('iscritti_scuola')
				->select('*')
				->where('email','=',$email)
				->get();
			$num_rec = $query_rec->count();
			
			if($num_rec>0){
				$mail_sito = env('APP_EMAIL');
				$ind_sito = env('APP_URL');
				$nome_del_sito = env('APP_NAME');
				$logo_scuola = $ind_sito."/".env('APP_LOGO_SCUOLA_VELA');
				
				include(base_path('resources/views/web/common/body_mail_scuola_vela.css.php'));
				$link_cambia="yccs-sailing-school-cambia-password-".$query_rec[0]->codice.".html";
				if($lingua=="eng") $link_cambia="en/".$link_cambia;
				
				$testo_cli = "Gentile utente,
					<br><br>
					Ti preghiamo di seguire il link sotto riportato per accedere alla procedura di cambio password:<br><br>
					<a href=\"".config('app.url')."/$link_cambia\">".config('app.url')."/$link_cambia</a>
					<br/><br/>";
					
				if($lingua=="ita"){
					$body_cli = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_cli, $body);			
					$oggetto_cli = "YCCS Sailing School - Recupera Password";
				}
				else {
					$body_cli = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_cli, $body);			
					$oggetto_cli = "YCCS Sailing School - Password Recovery";		
				}
				
				$MailController = new MailController();
				//sendMail($from_email, $from_name, $to_email, $to_name, $subject, $body, $file="")
				$invioMail_cli = $MailController->sendMail($mail_sito,$nome_del_sito,$email,$email, $oggetto_cli, $body_cli); 
				
				if($invioMail_cli=="OK"){
					$message_color = "#81c868";
					if($lingua=="ita")
						$message = 'A breve riceverai una email contenente il link per accedere alla procedura di cambio password.';
					else
						$message = 'Shortly you will receive an email containing the link to access the password change procedure';			
				}else{
					$message_color = "red";
					if($lingua=="ita")
						$message = 'Errore! Si prega di riprovare';
					else
						$message = 'Error! Please retry';	
				}
			}else{
				$message_color = "red";
				if($lingua=="ita")
					$message = 'Email non presente nei nostri database';
				else
					$message = 'This Email is not in our database';	
			}
		}elseif(($stato=="inviato" || $stato=="salva" || $stato=="salva_e_invia" || $stato=="conferma") && isset($_POST['g-recaptcha-response'])){
			if(isset($_POST['recupero'])) $recupero=$_POST['recupero']; else $recupero="";
			if(isset($_POST['recuperopassword'])) $recuperopassword=$_POST['recuperopassword']; else $recuperopassword="";
			if(isset($_POST['nome'])) $nome=$_POST['nome']; else $nome="";
			if(isset($_POST['cognome'])) $cognome=$_POST['cognome']; else $cognome="";
			if(isset($_POST['indirizzo'])) $indirizzo=$_POST['indirizzo']; else $indirizzo="";
			if(isset($_POST['cap'])) $cap=$_POST['cap']; else $cap="";
			if(isset($_POST['citta'])) $citta=$_POST['citta']; else $citta="";
			if(isset($_POST['provincia'])) $provincia=$_POST['provincia']; else $provincia="";
			if(isset($_POST['nazione'])) $nazione=$_POST['nazione']; else $nazione="";
			if(isset($_POST['luogo_nascita'])) $luogo_nascita=$_POST['luogo_nascita']; else $luogo_nascita="";
			if(isset($_POST['nazione_nascita'])) $nazione_nascita=$_POST['nazione_nascita']; else $nazione_nascita="";
			if(isset($_POST['data_nascita'])) $data_nascita=$_POST['data_nascita']; else $data_nascita="";
			if(isset($_POST['codice_fiscale'])) $codice_fiscale=$_POST['codice_fiscale']; else $codice_fiscale="";
			if(isset($_POST['telefono1'])) $telefono1=$_POST['telefono1']; else $telefono1="";
			if(isset($_POST['prefix_telefono1'])) $prefix_telefono1=$_POST['prefix_telefono1']; else $prefix_telefono1="";
			if(isset($_POST['telefono2'])) $telefono2=$_POST['telefono2']; else $telefono2="";
			if(isset($_POST['prefix_telefono2'])) $prefix_telefono2=$_POST['prefix_telefono2']; else $prefix_telefono2="";
			if(isset($_POST['fax'])) $fax=$_POST['fax']; else $fax="";
			if(isset($_POST['prefix_fax'])) $prefix_fax=$_POST['prefix_fax']; else $prefix_fax="";
			if(isset($_POST['email'])) $email=$_POST['email']; else $email="";
			if(isset($_POST['telefono'])) $telefono=$_POST['telefono']; else $telefono="";
			if(isset($_POST['tipo'])) $tipo=$_POST['tipo']; else $tipo="";
			if(isset($_POST['extraJ24'])) $extraJ24=$_POST['extraJ24']; else $extraJ24="";
			if(isset($_POST['durata'])) $durata=$_POST['durata']; else $durata="";
			if(isset($_POST['note'])) $note=$_POST['note']; else $note="";
			if(isset($_POST['dal'])) $dal=$_POST['dal']; else $dal="";
			if(isset($_POST['al'])) $al=$_POST['al']; else $al="";
			if(isset($_POST['tesseramento'])) $tesseramento=$_POST['tesseramento']; else $tesseramento="no";
			if(isset($_POST['transfer'])) $transfer=$_POST['transfer']; else $transfer="no";
			if(isset($_POST['indirizzo_transfer'])) $indirizzo_transfer=$_POST['indirizzo_transfer']; else $indirizzo_transfer="";
			if(isset($_POST['totale'])) $totale=$_POST['totale']; else $totale="0";
			if(isset($_POST['gia_tesserato'])) $gia_tesserato=$_POST['gia_tesserato']; else $gia_tesserato="";
			if(isset($_POST['circolo'])) $circolo=$_POST['circolo']; else $circolo="";
			if(isset($_POST['pagamento'])) $pagamento=$_POST['pagamento']; else $pagamento="";
			if(isset($_POST['nome_socio_pagamento'])) $nome_socio_pagamento=$_POST['nome_socio_pagamento']; else $nome_socio_pagamento="";
			if(isset($_POST['cognome_socio_pagamento'])) $cognome_socio_pagamento=$_POST['cognome_socio_pagamento']; else $cognome_socio_pagamento="";
			if(isset($_POST['costo_prima_sett'])) $costo_prima_sett=$_POST['costo_prima_sett']; else $costo_prima_sett="0";
			if(isset($_POST['costo_mezza_settimana'])) $costo_mezza_settimana=$_POST['costo_mezza_settimana']; else $costo_mezza_settimana="0";
			if(isset($_POST['costo_settimane_in_piu'])) $costo_settimane_in_piu=$_POST['costo_settimane_in_piu']; else $costo_settimane_in_piu="0";
			if(isset($_POST['costo_giorni_in_piu'])) $costo_giorni_in_piu=$_POST['costo_giorni_in_piu']; else $costo_giorni_in_piu="0";
			if(isset($_POST['num_settimane'])) $num_settimane=$_POST['num_settimane']; else $num_settimane="0";
			if(isset($_POST['num_giorni'])) $num_giorni=$_POST['num_giorni']; else $num_giorni="0";
			if(isset($_POST['num_mesi'])) $num_mesi=$_POST['num_mesi']; else $num_mesi="0";
			if(isset($_POST['num_extra'])) $num_extra=$_POST['num_extra']; else $num_extra="0";
			if(isset($_POST['costo_mesi'])) $costo_mesi=$_POST['costo_mesi']; else $costo_mesi="0";
			if(isset($_POST['password'])) $password=$_POST['password']; else $password="";
			if(isset($_POST['CI'])) $CI=$_POST['CI']; else $CI="";
			if(isset($_POST['CF'])) $CF=$_POST['CF']; else $CF="";
			if(isset($_POST['CM'])) $CM=$_POST['CM']; else $CM="";
			if(isset($_POST['codice_old'])) $codice_old=$_POST['codice_old']; else $codice_old="";
			
			$data=date("Y-m-d H:i:s");
			$secretKey = env('GOOGLE_RECAPTCHA_SECRET_KEY_V2');
			$response = $_POST['g-recaptcha-response'];     
			$remoteIp = $_SERVER['REMOTE_ADDR'];

			$reCaptchaValidationUrl = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response&remoteip=$remoteIp");
			$result = json_decode($reCaptchaValidationUrl, TRUE);				
			if($result['success'] == 1) {
			//if(1) {
				$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$codice = '';
				for ($i = 0; $i < 15; $i++) {
					$codice .= $characters[rand(0, strlen($characters)-1)];
				}
				$_POST['codice'] = $codice;
				
				$id_rec_psw = "";		
				if(isset($_POST['password']) && $_POST['password']!=""){
					//$_POST['password']=crypt($_POST['password'],$_POST['password']);
					$_POST['password']=password_hash($_POST['password'], PASSWORD_BCRYPT, [10]);
					
					$query_ut = DB::table('iscritti_scuola')
						->select('id')
						->where('email','=',$_POST['email'])
						->get();
					$num_ut = $query_ut->count();
					
					if($num_ut==0){
						$string= array();
						$string["email"]=$_POST['email'];
						$string["password"]=$_POST['password'];
						$string["codice"]=$codice;
						$id_rec_psw = DB::table('iscritti_scuola')->insertGetId($string); 
					}else{
						$id_rec_psw = $query_ut[0]->id;
						$string_mod= array();
						$string_mod['password']=$_POST['password'];
						
						$query_mod = DB::table('iscritti_scuola');
						$query_mod = $query_mod->where('id','=',$id_rec_psw);
						$query_mod = $query_mod->update($string_mod);
					}
				}
				
				/* questo ciclo serve a recuperare i dati da post*/		
				$array_pers= array();
				$z=0;
				foreach($_POST AS $key=>$value){
					if(str_replace("_nome","",$key)!=$key){
						$array_pers[$z]=str_replace("_nome","",$key);
						$z++;
					}
				}
								
				$num_file = count($_FILES) ;
				reset($_FILES);
				
				$num_post= count($_POST);
				reset($_POST);
				// questo ciclo serve a recuperare i dati da post
				$arr_no['_token']=1;
				$arr_no['stato']=1;
				$arr_no['num_pers']=1;
				$arr_no['commento']=1;
				$arr_no['privacy']=1;
				$arr_no['checkTransfer']=1;
				$arr_no['checkTesseramento']=1;
				$arr_no['diffusione_dati_val']=1;
				$arr_no['g-recaptcha-response']=1;
				$arr_no['pagamento_val']=1;
				$arr_no['tipo_val']=1;
				$arr_no['durata_val']=1;
				$arr_no['password']=1;
				$arr_no['checkpassword']=1;
				$arr_no['email_conf']=1;
				$arr_no['codice_old']=1;
		
				for($i=0; $i<count($array_pers); $i++){
					$string= array();
					if($id_rec_psw!="") $string['id_utente']=$id_rec_psw;
					foreach($_POST AS $key=>$value){					
						if($key == $array_pers[$i].'_dal' || $key == $array_pers[$i].'_al'){ 
							if(isset($value) && trim($value)!=""){
								$value = $CustomController->date_to_data($value); 
							}
						}					
						
						if( !isset($arr_no[$key]) && $value!=""){
							if($key!=$array_pers[$i]."_tipo_val" && $key!=$array_pers[$i]."_durata_val"){
								if(str_replace($array_pers[$i]."_","",$key)!=$key || (strpos($key,"_")==false || strpos($key,"_")>2)){
									$nome_campo = str_replace($array_pers[$i]."_","",$key);
									$string[$nome_campo]=$value;
								}
							}
						}
					}
					reset($_POST);
					if(isset($string['nome']) && $string['nome']!=""){
						$string['data_invio']=date('Y-m-d H:i:s');
						$lastId = DB::table('iscrizioni_scuola')->insertGetId($string); 
					
						if($i==0) $id_rife = $lastId;
						if($i>0) {
							$string_mod= array();
							$string_mod['id_rife']=$id_rife;
							
							$query_mod = DB::table('iscrizioni_scuola');
							$query_mod = $query_mod->where('id','=',$lastId);
							$query_mod = $query_mod->update($string_mod);
						}
						
						for($x=0; $x<$num_file; $x++){
						
							$key = key($_FILES);
							$nome_campo = $key;
							$nome_file = $_FILES[$key]['name'];
							$dim = $_FILES[$key]['size'];
							$tmp_file    = $_FILES[$key]['tmp_name'];
							if(str_replace($array_pers[$i]."_","",$nome_campo)!=$nome_campo){
								$nome_campo_br = str_replace($array_pers[$i]."_","",$nome_campo);	
								if($dim!=0)
								{
									//trovo la posizione del punto
									$exts = explode(".", $nome_file);
									$finale = strtolower($exts[count($exts)-1]);				
										
									if($finale=="jpg" || $finale=="jpeg" || $finale=="gif" || $finale=="png" || $finale=="doc" || $finale=="docx" || $finale=="pdf")
									{		
										$path = public_path()."/resarea/files/iscrizioni/".$lastId;
										
										if(!is_dir ($path)) {
											mkdir($path);
										}
										
										while( is_file("$path/$nome_file") )
										{
											$titolo = str_replace(".$finale", "", $nome_file);
											$titolo1 = $titolo.$CustomController->random_char();
											$nome_file = $titolo1 . ".".$finale ;
										}
										
										$nome_file = $CustomController->scrivi_file($nome_file , $tmp_file, $path);	
										
										$string_up= array();
										$string_up[$nome_campo_br]=$nome_file;
										
										$query_up = DB::table('iscrizioni_scuola');
										$query_up = $query_up->where('id','=',$lastId);
										$query_up = $query_up->update($string_up);
									}				
								}
							}
							
							next($_FILES); 
						}
						reset($_FILES);
					}
				}
				if($id_rec_psw!=""){
					$string_up= array();
					$string_up['id_utente']=$id_rec_psw;
					
					$query_up = DB::table('iscrizioni_scuola');
					$query_up = $query_up->where('id','=',$id_rife);
					$query_up = $query_up->update($string_up);
				}
				
				if($stato=="inviato"){
					
					$mail_sito = env('APP_EMAIL');
					$ind_sito = env('APP_URL');
					$nome_del_sito = env('APP_NAME');
					$logo_scuola = $ind_sito."/".env('APP_LOGO_SCUOLA_VELA');
					
					$link = config('app.url')."/yccs-sailing-school-conferma-iscrizione_$codice.html";
					$link_eng =  config('app.url')."/en/yccs-sailing-school-conferma-iscrizione_$codice.html";
					include(base_path('resources/views/web/common/body_mail_scuola_vela.css.php'));
					
					$dati="";
					$dati_eng="";
					
					$query_dati = DB::table('iscrizioni_scuola')
						->select('*')
						->where('id','=',$id_rife)
						->get();
					
					$nome_cliente = ucfirst($query_dati[0]->nome);
					$cognome_cliente = ucfirst($query_dati[0]->cognome);
					
					$dati.="
					<b>Dati Personali</b><br/>";
					if($query_dati[0]->dal &&$query_dati[0]->dal!="") $dati .= "<b>Dal</b> : ".$CustomController->date_to_data($query_dati[0]->dal)."<br>";
					if($query_dati[0]->al && $query_dati[0]->al!="") $dati .= "<b>Al</b> : ".$CustomController->date_to_data($query_dati[0]->al)."<br>";
					$dati.="
					<b>Nome</b> : ".$query_dati[0]->nome."<br/>
					<b>Cognome</b> : ".$query_dati[0]->cognome."<br/>
					<b>Indirizzo</b> : ".$query_dati[0]->indirizzo."<br/>
					<b>Cap</b> : ".$query_dati[0]->cap."<br/>
					<b>Citta</b> : ".$query_dati[0]->citta."<br/>
					<b>Provincia</b> : ".$query_dati[0]->provincia."<br/>
					<b>Nazione</b> : ".$query_dati[0]->nazione."<br/>
					<b>Luogo di nascita</b> : ".$query_dati[0]->luogo_nascita."<br/>
					<b>Nazione di nascita</b> : ".$query_dati[0]->nazione_nascita."<br/>
					<b>Data di nascita</b> : ".$query_dati[0]->data_nascita."<br/>
					<b>Codice fiscale</b> : ".$query_dati[0]->codice_fiscale."<br/>
					<b>Tessera Fiv</b> : ".$query_dati[0]->tesseramento."<br/>
					<b>Gi&agrave; tesserato</b> : ".$query_dati[0]->gia_tesserato."<br/>
					";
					if($query_dati[0]->circolo && $query_dati[0]->circolo!="") $dati .= "<b>Tesserato con il circolo</b> : ".$query_dati[0]->circolo."<br>";
					if($query_dati[0]->tipo && $query_dati[0]->tipo!=""){
						$dati .= "<b>Tipologia del corso</b> : ".$query_dati[0]->tipo."<br>";
						$dati .= "<b>Durata</b> : ".$query_dati[0]->durata;
						if($query_dati[0]->durata=="" || $query_dati[0]->durata=="Prima settimana" || $query_dati[0]->durata=="First week") $dati .= " (".$query_dati[0]->costo_prima_sett."  &euro;)";
						if($query_dati[0]->durata=="Solo mezza settimana" || $query_dati[0]->durata=="Only half a week") $dati .= " (".$query_dati[0]->costo_mezza_settimana."  &euro;)";
						$dati .= "<br>";
						if($query_dati[0]->mezza_settimana_val && $query_dati[0]->mezza_settimana_val!="") $dati .= "<b>Mezza Settimana</b> : ".$query_dati[0]->mezza_settimana_val." (".$query_dati[0]->costo_mezza_settimana." &euro;)<br>";
						if($query_dati[0]->num_settimane>0) $dati .= "<b>N. settimane successive alla prima</b> : ".$query_dati[0]->num_settimane." (".$query_dati[0]->costo_settimane_in_piu." &euro; a settimana)<br>";
						if($query_dati[0]->num_giorni>0) $dati .= "<b>N. giorni in pi&ugrave; successivi alla prima settimana </b> : ".$query_dati[0]->num_giorni." (".$query_dati[0]->costo_giorni_in_piu." &euro; al giorno)<br>";
						if($query_dati[0]->num_settimane_2>0) $dati .= "<b>N. settimane successive alla prima</b> : ".$query_dati[0]->num_settimane_2." (".$query_dati[0]->costo_settimane_in_piu." &euro; a settimana)<br>";
						if($query_dati[0]->num_giorni_2>0) $dati .= "<b>N. giorni in pi&ugrave; successivi alla prima settimana </b> : ".$query_dati[0]->num_giorni_2." (".$query_dati[0]->costo_giorni_in_piu." &euro; al giorno)<br>";
						if($query_dati[0]->num_mesi>0) $dati .= "<b>N. di mesi </b> : ".$query_dati[0]->num_mesi." (".$query_dati[0]->costo_mesi." &euro; al mese)<br>";
					}
					if(isset($query_dati[0]->extraJ24) && $query_dati[0]->extraJ24=="1" && $query_dati[0]->num_extra>0){
						$dati .= "<b>N. settimane con extra per intergrazione corso full time</b> : ".$query_dati[0]->num_extra." (".$query_dati[0]->costo_extra." &euro; a settimana)<br>";
					}
					if($query_dati[0]->CI && $query_dati[0]->CI!="") $dati .= "<b>Carta d'identità: </b> : ".$query_dati[0]->CI."<br/>";
					if($query_dati[0]->CF && $query_dati[0]->CF!="") $dati .= "<b>Codice Fiscale: </b> : ".$query_dati[0]->CF."<br/>";
					if(isset($query_dati[0]->CM) && $query_dati[0]->CM!="") $dati .= "<b>Certificato medico: </b> : ".$query_dati[0]->CM."<br/>";
					
					
					$dati_eng.="
					<b>Personal Data</b><br/>";
					if($query_dati[0]->dal && $query_dati[0]->dal!="") $dati_eng .= "<b>From</b> : ".$query_dati[0]->dal."<br>";
					if($query_dati[0]->al && $query_dati[0]->al!="") $dati_eng .= "<b>To</b> : ".$query_dati[0]->al."<br>";
					$dati_eng.="
					<b>Name</b> : ".$query_dati[0]->nome."<br/>
					<b>Surname</b> : ".$query_dati[0]->cognome."<br/>
					<b>Address</b> : ".$query_dati[0]->indirizzo."<br/>
					<b>Postcode</b> : ".$query_dati[0]->cap."<br/>
					<b>Town</b> : ".$query_dati[0]->citta."<br/>
					<b>County</b> : ".$query_dati[0]->provincia."<br/>
					<b>Country</b> : ".$query_dati[0]->nazione."<br/>
					<b>Place of Birth</b> : ".$query_dati[0]->luogo_nascita."<br/>
					<b>Birth Country</b> : ".$query_dati[0]->nazione_nascita."<br/>
					<b>Date of Birth</b> : ".$query_dati[0]->data_nascita."<br/>
					<b>Tax Code</b> : ".$query_dati[0]->codice_fiscale."<br/>
					<b>Fiv Card</b> : ".$query_dati[0]->tesseramento."<br/>
					<b>Current Italian Sailing Federation (FIV) membership</b> : ".$query_dati[0]->gia_tesserato."<br/>
					";
					if($query_dati[0]->circolo && $query_dati[0]->circolo!="") $dati_eng .= "<b>Club</b> : ".$query_dati[0]->circolo."<br>";
					if($query_dati[0]->tipo && $query_dati[0]->tipo!=""){
						$dati_eng .= "<b>Type of Courses</b> : ".$query_dati[0]->tipo."<br>";
						$dati_eng .= "<b>Duration</b> : ".$query_dati[0]->durata;
						if($query_dati[0]->durata=="" || $query_dati[0]->durata=="Prima settimana" || $query_dati[0]->durata=="First week") $dati_eng .= " (".$query_dati[0]->costo_prima_sett."  &euro;)";
						if($query_dati[0]->durata=="Solo mezza settimana" || $query_dati[0]->durata=="Only half a week") $dati_eng .= " (".$query_dati[0]->costo_mezza_settimana."  &euro;)";
						$dati_eng .= "<br>";
						if($query_dati[0]->mezza_settimana_val && $query_dati[0]->mezza_settimana_val!="") $dati_eng .= "<b>Half a Week</b> : ".$query_dati[0]->mezza_settimana_val." (".$query_dati[0]->costo_mezza_settimana." &euro;)<br>";
						if($query_dati[0]->num_settimane>0) $dati_eng .= "<b>Number of weeks following the first week</b> : ".$query_dati[0]->num_settimane." (".$query_dati[0]->costo_settimane_in_piu." &euro; at week)<br>";
						if($query_dati[0]->num_giorni>0) $dati_eng .= "<b>Number of days following the first week</b> : ".$query_dati[0]->num_giorni." (".$query_dati[0]->costo_giorni_in_piu." &euro; at day)<br>";
						if($query_dati[0]->num_settimane_2>0) $dati_eng .= "<b>Number of weeks following the first week</b> : ".$query_dati[0]->num_settimane_2." (".$query_dati[0]->costo_settimane_in_piu." &euro; at week)<br>";
						if($query_dati[0]->num_giorni_2>0) $dati_eng .= "<b>Number of days following the first week</b> : ".$query_dati[0]->num_giorni_2." (".$query_dati[0]->costo_giorni_in_piu." &euro; at day)<br>";
						if($query_dati[0]->num_mesi>0) $dati_eng .= "<b>Number of months </b> : ".$query_dati[0]->num_mesi." (".$query_dati[0]->costo_mesi." &euro; per month)<br>";
					}
					if(isset($query_dati[0]->extraJ24) && $query_dati[0]->extraJ24=="1" && $query_dati[0]->num_extra>0){
						$dati_eng .= "<b>Number of weeks with extra for full time course integration</b> : ".$query_dati[0]->num_extra." (".$query_dati[0]->costo_extra." &euro; per weeh)<br>";
					}
					if($query_dati[0]->CI && $query_dati[0]->CI!="") $dati_eng .= "<b>Identity document: </b> : ".$query_dati[0]->CI."<br/>";
					if($query_dati[0]->CF && $query_dati[0]->CF!="") $dati_eng .= "<b>Tax code: </b> : ".$query_dati[0]->CF."<br/>";
					if(isset($query_dati[0]->CM) && $query_dati[0]->CM!="") $dati_eng .= "<b>Medical certificate: </b> : ".$query_dati[0]->CM."<br/>";
					
					$x=1;
					$query_dati2 = DB::table('iscrizioni_scuola')
						->select('*')
						->where('id_rife','=',$id_rife)
						->get();
					
					foreach($query_dati2 AS $key_dati2=>$value_dati2){
						if(isset($value_dati2->nome) && $value_dati2->nome!=""){
							$dati.="
							<br/><b>Dati Familiare Aggiuntivo $x</b><br/>";
							if($value_dati2->dal &&$value_dati2->dal!="") $dati .= "<b>Dal</b> : ".$CustomController->date_to_data($value_dati2->dal)."<br>";
							if($value_dati2->al && $value_dati2->al!="") $dati .= "<b>Al</b> : ".$CustomController->date_to_data($value_dati2->al)."<br>";
							$dati.="
							<b>Nome</b> : ".$value_dati2->nome."<br/>
							<b>Cognome</b> : ".$value_dati2->cognome."<br/>
							<b>Indirizzo</b> : ".$value_dati2->indirizzo."<br/>
							<b>Cap</b> : ".$value_dati2->cap."<br/>
							<b>Citta</b> : ".$value_dati2->citta."<br/>
							<b>Provincia</b> : ".$value_dati2->provincia."<br/>
							<b>Nazione</b> : ".$value_dati2->nazione."<br/>
							<b>Luogo di nascita</b> : ".$value_dati2->luogo_nascita."<br/>
							<b>Nazione di nascita</b> : ".$value_dati2->nazione_nascita."<br/>
							<b>Data di nascita</b> : ".$value_dati2->data_nascita."<br/>
							<b>Codice fiscale</b> : ".$value_dati2->codice_fiscale."<br/>
							<b>Tessera Fiv</b> : ".$value_dati2->tesseramento."<br/>
							<b>Gi&agrave; tesserato</b> : ".$value_dati2->gia_tesserato."<br/>
							";
							if($value_dati2->circolo && $value_dati2->circolo!="") $dati .= "<b>Tesserato con il circolo</b> : ".$value_dati2->circolo."<br>";
							if($value_dati2->tipo && $value_dati2->tipo!=""){
								$dati .= "<b>Tipologia del corso</b> : ".$value_dati2->tipo."<br>";
								$dati .= "<b>Durata</b> : ".$value_dati2->durata;
								if($value_dati2->durata=="" || $value_dati2->durata=="Prima settimana" || $value_dati2->durata=="First week") $dati .= " (".$value_dati2->costo_prima_sett."  &euro;)";
								if($value_dati2->durata=="Solo mezza settimana" || $value_dati2->durata=="Only half a week") $dati .= " (".$value_dati2->costo_mezza_settimana."  &euro;)";
								$dati .= "<br>";
								if($value_dati2->mezza_settimana_val && $value_dati2->mezza_settimana_val!="") $dati .= "<b>Mezza Settimana</b> : ".$value_dati2->mezza_settimana_val." (".$value_dati2->costo_mezza_settimana." &euro;)<br>";
								if($value_dati2->num_settimane>0) $dati .= "<b>N. settimane successive alla prima</b> : ".$value_dati2->num_settimane." (".$value_dati2->costo_settimane_in_piu." &euro; a settimana)<br>";
								if($value_dati2->num_giorni>0) $dati .= "<b>N. giorni in pi&ugrave; successivi alla prima settimana </b> : ".$value_dati2->num_giorni." (".$value_dati2->costo_giorni_in_piu." &euro; a settimana)<br>";
								if($value_dati2->num_settimane_2>0) $dati .= "<b>N. settimane successive alla prima</b> : ".$value_dati2->num_settimane_2." (".$value_dati2->costo_settimane_in_piu." &euro; a settimana)<br>";
								if($value_dati2->num_giorni_2>0) $dati .= "<b>N. giorni in pi&ugrave; successivi alla prima settimana </b> : ".$value_dati2->num_giorni_2." (".$value_dati2->costo_giorni_in_piu." &euro; al giorno)<br>";
								if($value_dati2->num_mesi>0) $dati .= "<b>N. mesi </b> : ".$value_dati2->num_mesi." (".$value_dati2->costo_mesi." &euro; al giorno)<br>";
							}
							if(isset($value_dati2->extraJ24) && $value_dati2->extraJ24=="1" && $value_dati2->num_extra>0){
								$dati .= "<b>N. settimane con extra per intergrazione corso full time</b> : ".$value_dati2->num_extra." (".$value_dati2->costo_extra." &euro; a settimana)<br>";
							}
							if($value_dati2->CI && $value_dati2->CI!="") $dati .= "<b>Carta d'identità: </b> : ".$value_dati2->CI."<br/>";
							if($value_dati2->CF && $value_dati2->CF!="") $dati .= "<b>Codice Fiscale: </b> : ".$value_dati2->CF."<br/>";
							if(isset($value_dati2->CM) && $value_dati2->CM!="") $dati .= "<b>Certificato medico: </b> : ".$value_dati2->CM."<br/>";
							
							$dati_eng.="
							<br/><b>Additional member of the family $x</b><br/>";
							if($value_dati2->dal &&$value_dati2->dal!="") $dati_eng .= "<b>From</b> : ".$value_dati2->dal."<br>";
							if($value_dati2->al && $value_dati2->al!="") $dati_eng .= "<b>To</b> : ".$value_dati2->al."<br>";
							$dati_eng.="
							<b>Name</b> : ".$value_dati2->nome."<br/>
							<b>Surname</b> : ".$value_dati2->cognome."<br/>
							<b>Address</b> : ".$value_dati2->indirizzo."<br/>
							<b>Postcode</b> : ".$value_dati2->cap."<br/>
							<b>Town</b> : ".$value_dati2->citta."<br/>
							<b>County</b> : ".$value_dati2->provincia."<br/>
							<b>Country</b> : ".$value_dati2->nazione."<br/>
							<b>Place of Birth</b> : ".$value_dati2->luogo_nascita."<br/>
							<b>Birth Country</b> : ".$value_dati2->nazione_nascita."<br/>
							<b>Date of Birth</b> : ".$value_dati2->data_nascita."<br/>
							<b>Tax Code</b> : ".$value_dati2->codice_fiscale."<br/>
							<b>Fiv Card</b> : ".$value_dati2->tesseramento."<br/>
							<b>Current Italian Sailing Federation (FIV) membership</b> : ".$value_dati2->gia_tesserato."<br/>
							";
							if($value_dati2->circolo && $value_dati2->circolo!="") $dati_eng .= "<b>Club</b> : ".$value_dati2->circolo."<br>";
							if($value_dati2->tipo && $value_dati2->tipo!=""){
								$dati_eng .= "<b>Type of Courses</b> : ".$value_dati2->tipo." (".$value_dati2->costo_prima_sett." &euro;)<br>";
								$dati_eng .= "<b>Duration</b> : ".$value_dati2->durata;
								if($value_dati2->durata=="" || $value_dati2->durata=="Prima settimana" || $value_dati2->durata=="First week") $dati_eng .= " (".$value_dati2->costo_prima_sett."  &euro;)";
								if($value_dati2->durata=="Solo mezza settimana" || $value_dati2->durata=="Only half a week") $dati_eng .= " (".$value_dati2->costo_mezza_settimana."  &euro;)";
								$dati_eng .= "<br>";
								if($value_dati2->mezza_settimana_val && $value_dati2->mezza_settimana_val!="") $dati_eng .= "<b>Half a Week</b> : ".$value_dati2->mezza_settimana_val." (".$value_dati2->costo_mezza_settimana." &euro;)<br>";
								if($value_dati2->num_settimane>0) $dati_eng .= "<b>Number of weeks following the first week</b> : ".$value_dati2->num_settimane." (".$value_dati2->costo_settimane_in_piu." &euro; a settimana)<br>";
								if($value_dati2->num_giorni>0) $dati_eng .= "<b>Number of days following the first week</b> : ".$value_dati2->num_giorni." (".$value_dati2->costo_giorni_in_piu." &euro; a settimana)<br>";
								if($value_dati2->num_settimane_2>0) $dati_eng .= "<b>Number of weeks following the first week</b> : ".$value_dati2->num_settimane_2." (".$value_dati2->costo_settimane_in_piu." &euro; at week)<br>";
								if($value_dati2->num_giorni_2>0) $dati_eng .= "<b>Number of days following the first week</b> : ".$value_dati2->num_giorni_2." (".$value_dati2->costo_giorni_in_piu." &euro; at day)<br>";
								if($value_dati2->num_mesi>0) $dati_eng .= "<b>Number of months</b> : ".$value_dati2->num_mesi." (".$value_dati2->costo_mesi." &euro; at day)<br>";
							}
							if(isset($value_dati2->extraJ24) && $value_dati2->extraJ24=="1" && $value_dati2->num_extra>0){
								$dati_eng .= "<b>Number of weeks with extra for full time course integration</b> : ".$value_dati2->num_extra." (".$value_dati2->costo_extra." &euro; per week)<br>";
							}
							if($value_dati2->CI && $value_dati2->CI!="") $dati_eng .= "<b>Identity document: </b> : ".$value_dati2->CI."<br/>";
							if($value_dati2->CF && $value_dati2->CF!="") $dati_eng .= "<b>Tax code: </b> : ".$value_dati2->CF."<br/>";
							if(isset($value_dati2->CM) && $value_dati2->CM!="") $dati_eng .= "<b>Medical certificate: </b> : ".$value_dati2->CM."<br/>";
							
							$x++;
						}
					}
					
					$dati .= "
					<br/><b>Cell</b> : ".$query_dati[0]->prefix_telefono1." - ".$query_dati[0]->telefono1."<br/>
					<b>Tel 2</b> : ".$query_dati[0]->prefix_telefono2." - ".$query_dati[0]->telefono2."<br/>
					<b>Fax</b> : ".$query_dati[0]->prefix_fax." - ".$query_dati[0]->fax."<br/>
					<b>Email</b> : ".$query_dati[0]->email."<br/>
					<b>Servizio di transfer</b> : ".$query_dati[0]->transfer."<br/>";
					if($query_dati[0]->transfer=="si" && $query_dati[0]->indirizzo_transfer && $query_dati[0]->indirizzo_transfer!="") $dati .= "<b>Indirizzo transfer</b> : ".$query_dati[0]->indirizzo_transfer."<br/>";
					if($query_dati[0]->sconto>0) $dati .= "<b>Sconto applicato</b> : ".$query_dati[0]->sconto." &euro;<br/>";
					$dati .= "<b>Totale dovuto</b> : ".$query_dati[0]->totale." &euro;<br/>
					<b>Metodo Pagamento</b> : ".$query_dati[0]->pagamento."<br/>";
					if($query_dati[0]->pagamento=="Addebito" && $query_dati[0]->nome_socio_pagamento && $query_dati[0]->nome_socio_pagamento!="" && $query_dati[0]->cognome_socio_pagamento && $query_dati[0]->cognome_socio_pagamento!="") $dati .= "<b>Addebito sul conto del socio YCCS</b> : ".$query_dati[0]->nome_socio_pagamento." ".$query_dati[0]->cognome_socio_pagamento."<br/>";
					if($query_dati[0]->pagamento=="Bonifico") $dati .= "<b>Coordinate bancarie per il pagamento con bonifico</b>:<br>IBAN: IT33F0306984902100000000071<br>BIC/SWIFT: BCITITMM<br>";
					$dati .= "<b>Note</b> : ".$query_dati[0]->note."<br/>	<br>";
					
					$dati_eng .= "
					<br/><b>Cell</b> : ".$query_dati[0]->prefix_telefono1." - ".$query_dati[0]->telefono1."<br/>
					<b>Tel 2</b> : ".$query_dati[0]->prefix_telefono2." - ".$query_dati[0]->telefono2."<br/>
					<b>Fax</b> : ".$query_dati[0]->prefix_fax." - ".$query_dati[0]->fax."<br/>
					<b>Email</b> : ".$query_dati[0]->email."<br/>
					<b>Free transfer service</b> : ".$query_dati[0]->transfer."<br/>";
					if($transfer=="si" && $indirizzo_transfer && $indirizzo_transfer!="") $dati_eng .= "<b>Transfer address</b> : ".$query_dati[0]->indirizzo_transfer."<br/>";
					if($query_dati[0]->sconto>0) $dati_eng .= "<b>Discount applied</b> : ".$query_dati[0]->sconto." &euro;<br/>";
					$dati_eng .= "<b>Total to be paid</b> : ".$query_dati[0]->totale." &euro;<br/>
					<b>Payment method</b> : ".$query_dati[0]->pagamento."<br/>";
					if($query_dati[0]->pagamento=="Addebito" && $query_dati[0]->nome_socio_pagamento && $query_dati[0]->nome_socio_pagamento!="" && $query_dati[0]->cognome_socio_pagamento && $query_dati[0]->cognome_socio_pagamento!="") $dati_eng .= "<b>YCCS member</b> : $nome_socio_pagamento $cognome_socio_pagamento<br>";
					if($query_dati[0]->pagamento=="Bonifico") $dati_eng .= "<b>Wire transfer details</b>:<br>IBAN: IT33F0306984902100000000071<br>BIC/SWIFT: BCITITMM<br>";
					$dati_eng .= "<b>Note</b> : ".$query_dati[0]->note."<br/>	<br>";
				
					$testo_azi ="<p class=\"menu\">
						Report di Notifica del sito Web - Un Utente ha inviato una mail dalla sezione <b>'contatti'</b></p>
						$dati
					</p>";
					
					$testo_cli ="<br><br><br>Gentile <b>$nome_cliente</b><br/>grazie per aver inviato una richiesta di iscrizione</b>
								<br><br>
								 I dati da te inseriti sono quelli riportati di seguito. Per confermare i dati e la presa visione dell'informativa ai sensi del Regolamento (UE) 2016/679 premere il pulsante sotto riportato.<br/>
								 In caso di errata compilazione dei dati, <a href='https://www.yccs.it/yccs-sailing-school-iscrizioni.html'>ripetere la procedura di registrazione sul sito</a>.
								<br/><br/>
								<a href='$link'><div style='width:200px; border-radius:3px; background:#005cb9; text-align:center;'><div style='padding:4px 0px; color:#fff'><b>CONFERMA ISCRIZIONE</b></div></div></a>";
					$testo_cli .= "<br><br>
									Questi sono i dati che ci hai fornito<br/><br/>
									$dati
									";	
									
					$testo_cli_eng ="<br><br><br>Dear <b>$nome_cliente</b><br/>Thank you for your registration request</b>
									<br><br>
									Please find below the data you entered. To confirm the data and confirm having read the informative note pursuant to EU Regulation 2016/679 click the button below.<br/>
									In case of errors in the data please <a href='https://www.yccs.it/en/yccs-sailing-school-iscrizioni.html'>repeat the registration process on the website</a>.
									<br/><br/>
									<a href='$link_eng'><div style='width:250px; border-radius:3px; background:#005cb9; text-align:center;'><div style='padding:4px 0px; color:#fff'><b>CONFIRM YOUR REGISTRATION</b></div></div></a>";
					$testo_cli_eng .= "<br><br>
									Below is the data you provided:<br/><br/>
									$dati_eng
									";
					
					if($lingua=="ita"){
						$body_cli = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_cli, $body);			
						$oggetto_cli = "YCCS Sailing School - Grazie per la richiesta d'iscrizione";
					}
					else {
						$body_cli = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_cli_eng, $body);			
						$oggetto_cli = "YCCS Sailing School - Thanks for your request";		
					}
					$MailController = new MailController();
					//sendMail($from_email, $from_name, $to_email, $to_name, $subject, $body, $file="")
					//$invioMail_azi = $MailController->sendMail($mail_sito,$nome_del_sito,$mail_sito,$nome_del_sito, $oggetto_azi, $body_azi); 
					$invioMail_cli = $MailController->sendMail($mail_sito,$nome_del_sito,$query_dati[0]->email,$nome_cliente." ".$cognome_cliente, $oggetto_cli, $body_cli); 
					
					if($invioMail_cli=="OK"){
						$message_color = "#81c868";
						if($lingua=="ita")
							$message = 'Grazie per la sua richiesta di iscrizione<br/>
										A breve riceverà una mail con un link che dovrà seguire per completare la richiesta<br/>
										Se non dovesse ricevere l’email, la invitiamo a <b>controllare nella cartella spam</b> o a scrivere a <a href="mailto:sailingschool@yccs.it">sailingschool@yccs.it</a>';
						else
							$message = 'Thanks for your request<br/>
										Shortly you will receive an email with a link that will have to follow to complete the request<br/>
										If you do not receive an email, <b>check your spam folder</b> or contact <a href="mailto:sailingschool@yccs.it">sailingschool@yccs.it</a>';			
					}else{
						$message_color = "red";
						// Mostra il dettaglio di PHPMailer per capire perché l'invio SMTP fallisce
						$message = (string)$invioMail_cli;
					}
				}elseif($stato=="salva"){
					$message_color = "#81c868";
					$message = "Nuova iscrizione salvata";
				}elseif($stato=="salva_e_invia"){?>
						<script>
							window.location='<?php echo config('app.url');?>/mail_invio_dati.php?codice_iscrizione=<?php echo $codice;?>&id_rife=<?php echo $id_rife;?>&lingua=<?php echo $lingua;?>';
						</script>
				<?php 
				}elseif($stato=="conferma"){
					$message_color = "#81c868";
					$message = "Nuova iscrizione confermata";
					
					$query_del = DB::table('iscrizioni_scuola')->where('codice','=',$codice_old)->delete();					
					$query_up = DB::table('iscrizioni_scuola')->where('id','=',$id_rife)->update([
						'mail_iscrizione'	=>	'1',
						'stato_accettazione'	=>	'1',
						'data_accettazione'	=>	date("Y-m-d H:i:s")
						]);
					
					$mail_sito = env('APP_EMAIL');
					$ind_sito = env('APP_URL');
					$nome_del_sito = env('APP_NAME');
					$logo_sito = $ind_sito."/".env('APP_LOGO');
					
					include(base_path('resources/views/web/common/body_mail.css.php'));
					
					$dati="";
					$dati_eng="";
					$foresteria=0;
					
					$query_dati = DB::table('iscrizioni_scuola')
						->select('*')
						->where('id','=',$id_rife)
						->get();
					
					$nome_cliente = ucfirst($query_dati[0]->nome);
					$cognome_cliente = ucfirst($query_dati[0]->cognome);
					
					$dati.="
					<b>Dati Personali</b><br/>";
					if($query_dati[0]->dal && $query_dati[0]->dal!="") $dati .= "<b>Dal</b> : ".$CustomController->date_to_data($query_dati[0]->dal)."<br>";
					if($query_dati[0]->al && $query_dati[0]->al!="") $dati .= "<b>Al</b> : ".$CustomController->date_to_data($query_dati[0]->al)."<br>";
					$dati.="
					<b>Nome</b> : ".$query_dati[0]->nome."<br/>
					<b>Cognome</b> : ".$query_dati[0]->cognome."<br/>
					<b>Indirizzo</b> : ".$query_dati[0]->indirizzo."<br/>
					<b>Cap</b> : ".$query_dati[0]->cap."<br/>
					<b>Citta</b> : ".$query_dati[0]->citta."<br/>
					<b>Provincia</b> : ".$query_dati[0]->provincia."<br/>
					<b>Nazione</b> : ".$query_dati[0]->nazione."<br/>
					<b>Luogo di nascita</b> : ".$query_dati[0]->luogo_nascita."<br/>
					<b>Nazione di nascita</b> : ".$query_dati[0]->nazione_nascita."<br/>
					<b>Data di nascita</b> : ".$query_dati[0]->data_nascita."<br/>
					<b>Codice fiscale</b> : ".$query_dati[0]->codice_fiscale."<br/>
					<b>Tessera Fiv</b> : ".$query_dati[0]->tesseramento."<br/>
					<b>Gi&agrave; tesserato</b> : ".$query_dati[0]->gia_tesserato."<br/>
					";
					if($query_dati[0]->circolo && $query_dati[0]->circolo!="") $dati .= "<b>Tesserato con il circolo</b> : ".$query_dati[0]->circolo."<br>";
					if($query_dati[0]->tipo && $query_dati[0]->tipo!=""){
						$dati .= "<b>Tipologia del corso</b> : ".$query_dati[0]->tipo."<br>";
						if($query_dati[0]->tipo=="Corsi j24 con alloggio" || $query_dati[0]->tipo=="Courses j24 with accommodation") $foresteria=1;
						$dati .= "<b>Durata</b> : ".$query_dati[0]->durata;
						if($query_dati[0]->durata=="" || $query_dati[0]->durata=="Prima settimana" || $query_dati[0]->durata=="First week") $dati .= " (".$query_dati[0]->costo_prima_sett."  &euro;)";
						if($query_dati[0]->durata=="Solo mezza settimana" || $query_dati[0]->durata=="Only half a week") $dati .= " (".$query_dati[0]->costo_mezza_settimana."  &euro;)";
						$dati .= "<br>";
						if($query_dati[0]->mezza_settimana_val && $query_dati[0]->mezza_settimana_val!="") $dati .= "<b>Mezza Settimana</b> : ".$query_dati[0]->mezza_settimana_val." (".$query_dati[0]->costo_mezza_settimana." &euro;)<br>";
						if($query_dati[0]->num_settimane>0) $dati .= "<b>N. settimane successive alla prima</b> : ".$query_dati[0]->num_settimane." (".$query_dati[0]->costo_settimane_in_piu." &euro; a settimana)<br>";
						if($query_dati[0]->num_giorni>0) $dati .= "<b>N. giorni in pi&ugrave; successivi alla prima settimana </b> : ".$query_dati[0]->num_giorni." (".$query_dati[0]->costo_giorni_in_piu." &euro; al giorno)<br>";
						if($query_dati[0]->num_settimane_2>0) $dati .= "<b>N. settimane successive alla prima</b> : ".$query_dati[0]->num_settimane_2." (".$query_dati[0]->costo_settimane_in_piu." &euro; a settimana)<br>";
						if($query_dati[0]->num_giorni_2>0) $dati .= "<b>N. giorni in pi&ugrave; successivi alla prima settimana </b> : ".$query_dati[0]->num_giorni_2." (".$query_dati[0]->costo_giorni_in_piu." &euro; al giorno)<br>";
					}
					if(isset($query_dati[0]->extraJ24) && $query_dati[0]->extraJ24=="1" && $query_dati[0]->num_extra>0){
						$foresteria=1;
						$dati .= "<b>N. settimane con extra per intergrazione corso full time</b> : ".$query_dati[0]->num_extra." (".$query_dati[0]->costo_extra." &euro; a settimana)<br>";
					}
					if($query_dati[0]->CI && $query_dati[0]->CI!="") $dati .= "<b>Carta d'identità: </b> : ".$query_dati[0]->CI."<br/>";
					if($query_dati[0]->CF && $query_dati[0]->CF!="") $dati .= "<b>Codice Fiscale: </b> : ".$query_dati[0]->CF."<br/>";
					if(isset($query_dati[0]->CM) && $query_dati[0]->CM!="") $dati .= "<b>Certificato medico: </b> : ".$query_dati[0]->CM."<br/>";
					
					
					$dati_eng.="
					<b>Personal Data</b><br/>";
					if($query_dati[0]->dal && $query_dati[0]->dal!="") $dati_eng .= "<b>From</b> : ".$query_dati[0]->dal."<br>";
					if($query_dati[0]->al && $query_dati[0]->al!="") $dati_eng .= "<b>To</b> : ".$query_dati[0]->al."<br>";
					$dati_eng.="
					<b>Name</b> : ".$query_dati[0]->nome."<br/>
					<b>Surname</b> : ".$query_dati[0]->cognome."<br/>
					<b>Address</b> : ".$query_dati[0]->indirizzo."<br/>
					<b>Postcode</b> : ".$query_dati[0]->cap."<br/>
					<b>Town</b> : ".$query_dati[0]->citta."<br/>
					<b>County</b> : ".$query_dati[0]->provincia."<br/>
					<b>Country</b> : ".$query_dati[0]->nazione."<br/>
					<b>Place of Birth</b> : ".$query_dati[0]->luogo_nascita."<br/>
					<b>Birth Country</b> : ".$query_dati[0]->nazione_nascita."<br/>
					<b>Date of Birth</b> : ".$query_dati[0]->data_nascita."<br/>
					<b>Tax Code</b> : ".$query_dati[0]->codice_fiscale."<br/>
					<b>Fiv Card</b> : ".$query_dati[0]->tesseramento."<br/>
					<b>Current Italian Sailing Federation (FIV) membership</b> : ".$query_dati[0]->gia_tesserato."<br/>
					";
					if($query_dati[0]->circolo && $query_dati[0]->circolo!="") $dati_eng .= "<b>Club</b> : ".$query_dati[0]->circolo."<br>";
					if($query_dati[0]->tipo && $query_dati[0]->tipo!=""){
						$dati_eng .= "<b>Type of Courses</b> : ".$query_dati[0]->tipo."<br>";
						if($query_dati[0]->tipo=="Corsi j24 con alloggio" || $query_dati[0]->tipo=="Courses j24 with accommodation") $foresteria=1;
						$dati_eng .= "<b>Duration</b> : ".$query_dati[0]->durata;
						if($query_dati[0]->durata=="" || $query_dati[0]->durata=="Prima settimana" || $query_dati[0]->durata=="First week") $dati_eng .= " (".$query_dati[0]->costo_prima_sett."  &euro;)";
						if($query_dati[0]->durata=="Solo mezza settimana" || $query_dati[0]->durata=="Only half a week") $dati_eng .= " (".$query_dati[0]->costo_mezza_settimana."  &euro;)";
						$dati_eng .= "<br>";
						if($query_dati[0]->mezza_settimana_val && $query_dati[0]->mezza_settimana_val!="") $dati_eng .= "<b>Half a Week</b> : ".$query_dati[0]->mezza_settimana_val." (".$query_dati[0]->costo_mezza_settimana." &euro;)<br>";
						if($query_dati[0]->num_settimane>0) $dati_eng .= "<b>Number of weeks following the first week</b> : ".$query_dati[0]->num_settimane." (".$query_dati[0]->costo_settimane_in_piu." &euro; at week)<br>";
						if($query_dati[0]->num_giorni>0) $dati_eng .= "<b>Number of days following the first week</b> : ".$query_dati[0]->num_giorni." (".$query_dati[0]->costo_giorni_in_piu." &euro; at day)<br>";
						if($query_dati[0]->num_settimane_2>0) $dati_eng .= "<b>Number of weeks following the first week</b> : ".$query_dati[0]->num_settimane_2." (".$query_dati[0]->costo_settimane_in_piu." &euro; at week)<br>";
						if($query_dati[0]->num_giorni_2>0) $dati_eng .= "<b>Number of days following the first week</b> : ".$query_dati[0]->num_giorni_2." (".$query_dati[0]->costo_giorni_in_piu." &euro; at day)<br>";
					}
					if(isset($query_dati[0]->extraJ24) && $query_dati[0]->extraJ24=="1" && $query_dati[0]->num_extra>0){
						$foresteria=1;
						$dati_eng .= "<b>Number of weeks with extra for full time course integration</b> : ".$query_dati[0]->num_extra." (".$query_dati[0]->costo_extra." &euro; per weeh)<br>";
					}
					if($query_dati[0]->CI && $query_dati[0]->CI!="") $dati_eng .= "<b>Identity document: </b> : ".$query_dati[0]->CI."<br/>";
					if($query_dati[0]->CF && $query_dati[0]->CF!="") $dati_eng .= "<b>Tax code: </b> : ".$query_dati[0]->CF."<br/>";
					if(isset($query_dati[0]->CM) && $query_dati[0]->CM!="") $dati_eng .= "<b>Medical certificate: </b> : ".$query_dati[0]->CM."<br/>";
					
					$x=1;
					$query_dati2 = DB::table('iscrizioni_scuola')
						->select('*')
						->where('id_rife','=',$id_rife)
						->get();
					
					foreach($query_dati2 AS $key_dati2=>$value_dati2){
						if(isset($value_dati2->nome) && $value_dati2->nome!=""){
							$dati.="
							<br/><b>Dati Familiare Aggiuntivo $x</b><br/>";
							if($value_dati2->dal &&$value_dati2->dal!="") $dati .= "<b>Dal</b> : ".$CustomController->date_to_data($value_dati2->dal)."<br>";
							if($value_dati2->al && $value_dati2->al!="") $dati .= "<b>Al</b> : ".$CustomController->date_to_data($value_dati2->al)."<br>";
							$dati.="
							<b>Nome</b> : ".$value_dati2->nome."<br/>
							<b>Cognome</b> : ".$value_dati2->cognome."<br/>
							<b>Indirizzo</b> : ".$value_dati2->indirizzo."<br/>
							<b>Cap</b> : ".$value_dati2->cap."<br/>
							<b>Citta</b> : ".$value_dati2->citta."<br/>
							<b>Provincia</b> : ".$value_dati2->provincia."<br/>
							<b>Nazione</b> : ".$value_dati2->nazione."<br/>
							<b>Luogo di nascita</b> : ".$value_dati2->luogo_nascita."<br/>
							<b>Nazione di nascita</b> : ".$value_dati2->nazione_nascita."<br/>
							<b>Data di nascita</b> : ".$value_dati2->data_nascita."<br/>
							<b>Codice fiscale</b> : ".$value_dati2->codice_fiscale."<br/>
							<b>Tessera Fiv</b> : ".$value_dati2->tesseramento."<br/>
							<b>Gi&agrave; tesserato</b> : ".$value_dati2->gia_tesserato."<br/>
							";
							if($value_dati2->circolo && $value_dati2->circolo!="") $dati .= "<b>Tesserato con il circolo</b> : ".$value_dati2->circolo."<br>";
							if($value_dati2->tipo && $value_dati2->tipo!=""){
								$dati .= "<b>Tipologia del corso</b> : ".$value_dati2->tipo."<br>";
								if($value_dati2->tipo=="Corsi j24 con alloggio" || $value_dati2->tipo=="Courses j24 with accommodation") $foresteria=1;
								$dati .= "<b>Durata</b> : ".$value_dati2->durata;
								if($value_dati2->durata=="" || $value_dati2->durata=="Prima settimana" || $value_dati2->durata=="First week") $dati .= " (".$value_dati2->costo_prima_sett."  &euro;)";
								if($value_dati2->durata=="Solo mezza settimana" || $value_dati2->durata=="Only half a week") $dati .= " (".$value_dati2->costo_mezza_settimana."  &euro;)";
								$dati .= "<br>";
								if($value_dati2->mezza_settimana_val && $value_dati2->mezza_settimana_val!="") $dati .= "<b>Mezza Settimana</b> : ".$value_dati2->mezza_settimana_val." (".$value_dati2->costo_mezza_settimana." &euro;)<br>";
								if($value_dati2->num_settimane>0) $dati .= "<b>N. settimane successive alla prima</b> : ".$value_dati2->num_settimane." (".$value_dati2->costo_settimane_in_piu." &euro; a settimana)<br>";
								if($value_dati2->num_giorni>0) $dati .= "<b>N. giorni in pi&ugrave; successivi alla prima settimana </b> : ".$value_dati2->num_giorni." (".$value_dati2->costo_giorni_in_piu." &euro; a settimana)<br>";
								if($value_dati2->num_settimane_2>0) $dati .= "<b>N. settimane successive alla prima</b> : ".$value_dati2->num_settimane_2." (".$value_dati2->costo_settimane_in_piu." &euro; a settimana)<br>";
								if($value_dati2->num_giorni_2>0) $dati .= "<b>N. giorni in pi&ugrave; successivi alla prima settimana </b> : ".$value_dati2->num_giorni_2." (".$value_dati2->costo_giorni_in_piu." &euro; al giorno)<br>";
							}
							if(isset($value_dati2->extraJ24) && $value_dati2->extraJ24=="1" && $value_dati2->num_extra>0){
								$foresteria=1;
								$dati .= "<b>N. settimane con extra per intergrazione corso full time</b> : ".$value_dati2->num_extra." (".$value_dati2->costo_extra." &euro; a settimana)<br>";
							}
							if($value_dati2->CI && $value_dati2->CI!="") $dati .= "<b>Carta d'identità: </b> : ".$value_dati2->CI."<br/>";
							if($value_dati2->CF && $value_dati2->CF!="") $dati .= "<b>Codice Fiscale: </b> : ".$value_dati2->CF."<br/>";
							if(isset($value_dati2->CM) && $value_dati2->CM!="") $dati .= "<b>Certificato medico: </b> : ".$value_dati2->CM."<br/>";
							
							$dati_eng.="
							<br/><b>Additional member of the family $x</b><br/>";
							if($value_dati2->dal &&$value_dati2->dal!="") $dati_eng .= "<b>From</b> : ".$value_dati2->dal."<br>";
							if($value_dati2->al && $value_dati2->al!="") $dati_eng .= "<b>To</b> : ".$value_dati2->al."<br>";
							$dati_eng.="
							<b>Name</b> : ".$value_dati2->nome."<br/>
							<b>Surname</b> : ".$value_dati2->cognome."<br/>
							<b>Address</b> : ".$value_dati2->indirizzo."<br/>
							<b>Postcode</b> : ".$value_dati2->cap."<br/>
							<b>Town</b> : ".$value_dati2->citta."<br/>
							<b>County</b> : ".$value_dati2->provincia."<br/>
							<b>Country</b> : ".$value_dati2->nazione."<br/>
							<b>Place of Birth</b> : ".$value_dati2->luogo_nascita."<br/>
							<b>Birth Country</b> : ".$value_dati2->nazione_nascita."<br/>
							<b>Date of Birth</b> : ".$value_dati2->data_nascita."<br/>
							<b>Tax Code</b> : ".$value_dati2->codice_fiscale."<br/>
							<b>Fiv Card</b> : ".$value_dati2->tesseramento."<br/>
							<b>Current Italian Sailing Federation (FIV) membership</b> : ".$value_dati2->gia_tesserato."<br/>
							";
							if($value_dati2->circolo && $value_dati2->circolo!="") $dati_eng .= "<b>Club</b> : ".$value_dati2->circolo."<br>";
							if($value_dati2->tipo && $value_dati2->tipo!=""){
								$dati_eng .= "<b>Type of Courses</b> : ".$value_dati2->tipo." (".$value_dati2->costo_prima_sett." &euro;)<br>";
								if($value_dati2->tipo=="Corsi j24 con alloggio" || $value_dati2->tipo=="Courses j24 with accommodation") $foresteria=1;
								$dati_eng .= "<b>Duration</b> : ".$value_dati2->durata;
								if($value_dati2->durata=="" || $value_dati2->durata=="Prima settimana" || $value_dati2->durata=="First week") $dati_eng .= " (".$value_dati2->costo_prima_sett."  &euro;)";
								if($value_dati2->durata=="Solo mezza settimana" || $value_dati2->durata=="Only half a week") $dati_eng .= " (".$value_dati2->costo_mezza_settimana."  &euro;)";
								$dati_eng .= "<br>";
								if($value_dati2->mezza_settimana_val && $value_dati2->mezza_settimana_val!="") $dati_eng .= "<b>Half a Week</b> : ".$value_dati2->mezza_settimana_val." (".$value_dati2->costo_mezza_settimana." &euro;)<br>";
								if($value_dati2->num_settimane>0) $dati_eng .= "<b>Number of weeks following the first week</b> : ".$value_dati2->num_settimane." (".$value_dati2->costo_settimane_in_piu." &euro; a settimana)<br>";
								if($value_dati2->num_giorni>0) $dati_eng .= "<b>Number of days following the first week</b> : ".$value_dati2->num_giorni." (".$value_dati2->costo_giorni_in_piu." &euro; a settimana)<br>";
								if($value_dati2->num_settimane_2>0) $dati_eng .= "<b>Number of weeks following the first week</b> : ".$value_dati2->num_settimane_2." (".$value_dati2->costo_settimane_in_piu." &euro; at week)<br>";
								if($value_dati2->num_giorni_2>0) $dati_eng .= "<b>Number of days following the first week</b> : ".$value_dati2->num_giorni_2." (".$value_dati2->costo_giorni_in_piu." &euro; at day)<br>";
							}
							if(isset($value_dati2->extraJ24) && $value_dati2->extraJ24=="1" && $value_dati2->num_extra>0){
								$foresteria=1;
								$dati_eng .= "<b>Number of weeks with extra for full time course integration</b> : ".$value_dati2->num_extra." (".$value_dati2->costo_extra." &euro; per week)<br>";
							}
							if($value_dati2->CI && $value_dati2->CI!="") $dati_eng .= "<b>Identity document: </b> : ".$value_dati2->CI."<br/>";
							if($value_dati2->CF && $value_dati2->CF!="") $dati_eng .= "<b>Tax code: </b> : ".$value_dati2->CF."<br/>";
							if(isset($value_dati2->CM) && $value_dati2->CM!="") $dati_eng .= "<b>Medical certificate: </b> : ".$value_dati2->CM."<br/>";
							
							$x++;
						}
					}
					
					$dati .= "
					<br/><b>Cell</b> : ".$query_dati[0]->prefix_telefono1." - ".$query_dati[0]->telefono1."<br/>
					<b>Tel 2</b> : ".$query_dati[0]->prefix_telefono2." - ".$query_dati[0]->telefono2."<br/>
					<b>Fax</b> : ".$query_dati[0]->prefix_fax." - ".$query_dati[0]->fax."<br/>
					<b>Email</b> : ".$query_dati[0]->email."<br/>
					<b>Servizio di transfer</b> : ".$query_dati[0]->transfer."<br/>";
					if($query_dati[0]->transfer=="si" && $query_dati[0]->indirizzo_transfer && $query_dati[0]->indirizzo_transfer!="") $dati .= "<b>Indirizzo transfer</b> : ".$query_dati[0]->indirizzo_transfer."<br/>";
					if($query_dati[0]->sconto>0) $dati .= "<b>Sconto applicato</b> : ".$query_dati[0]->sconto." &euro;<br/>";
					$dati .= "<b>Totale dovuto</b> : ".$query_dati[0]->totale." &euro;<br/>
					<b>Metodo Pagamento</b> : ".$query_dati[0]->pagamento."<br/>";
					if($query_dati[0]->pagamento=="Addebito" && $query_dati[0]->nome_socio_pagamento && $query_dati[0]->nome_socio_pagamento!="" && $query_dati[0]->cognome_socio_pagamento && $query_dati[0]->cognome_socio_pagamento!="") $dati .= "<b>Addebito sul conto del socio YCCS</b> : ".$query_dati[0]->nome_socio_pagamento." ".$query_dati[0]->cognome_socio_pagamento."<br/>";
					if($query_dati[0]->pagamento=="Bonifico") $dati .= "<b>Coordinate bancarie per il pagamento con bonifico</b>:<br>IBAN: IT33F0306984902100000000071<br>BIC/SWIFT: BCITITMM<br>";
					$dati .= "<b>Note</b> : ".$query_dati[0]->note."<br/>	<br>";
					
					$dati_eng .= "
					<br/><b>Cell</b> : ".$query_dati[0]->prefix_telefono1." - ".$query_dati[0]->telefono1."<br/>
					<b>Tel 2</b> : ".$query_dati[0]->prefix_telefono2." - ".$query_dati[0]->telefono2."<br/>
					<b>Fax</b> : ".$query_dati[0]->prefix_fax." - ".$query_dati[0]->fax."<br/>
					<b>Email</b> : ".$query_dati[0]->email."<br/>
					<b>Free transfer service</b> : ".$query_dati[0]->transfer."<br/>";
					if(isset($transfer) && $transfer=="si" && isset($indirizzo_transfer)  && $indirizzo_transfer!="") $dati_eng .= "<b>Transfer address</b> : ".$query_dati[0]->indirizzo_transfer."<br/>";
					if($query_dati[0]->sconto>0) $dati_eng .= "<b>Discount applied</b> : ".$query_dati[0]->sconto." &euro;<br/>";
					$dati_eng .= "<b>Total to be paid</b> : ".$query_dati[0]->totale." &euro;<br/>
					<b>Payment method</b> : ".$query_dati[0]->pagamento."<br/>";
					if($query_dati[0]->pagamento=="Addebito" && isset($query_dati[0]->nome_socio_pagamento) && $query_dati[0]->nome_socio_pagamento!="" && isset($query_dati[0]->cognome_socio_pagamento) && $query_dati[0]->cognome_socio_pagamento!="") $dati_eng .= "<b>YCCS member</b> : $nome_socio_pagamento $cognome_socio_pagamento<br>";
					if($query_dati[0]->pagamento=="Bonifico") $dati_eng .= "<b>Wire transfer details</b>:<br>IBAN: IT33F0306984902100000000071<br>BIC/SWIFT: BCITITMM<br>";
					$dati_eng .= "<b>Note</b> : ".$query_dati[0]->note."<br/>	<br>";
					
					
					$testo_azi ="<br><br><br>Un utente (<b>$cognome_cliente $nome_cliente</b>) ha confermato una richiesta dalla sezione <b>YCCS Sailing School iscrizioni</b>
								<br><br>
								$dati";
						
					$testo_cli ="<br><br><br>Gentile <b>$nome_cliente</b><br/>grazie per aver confermato una richiesta di iscrizione</b>
								<br><br>	
								Di seguito i dati forniti:<br/>
								$dati";	
									
					$testo_cli_eng ="<br><br><br>Dear <b>$nome_cliente</b><br/> thanks for your confirm</b>
									<br><br>	
									Below is the data you provided:<br/>
									$dati_eng";
					
					$oggetto_azi = "Conferma Iscrizione Scuola Vela - $cognome_cliente $nome_cliente";
					$body_azi = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_azi, $body);
					
					if($lingua=="ita"){
						$body_cli = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_cli, $body);			
						$oggetto_cli = "YCCS Sailing School - Grazie per la conferma d'iscrizione";
					}
					else {
						$body_cli = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_cli_eng, $body);			
						$oggetto_cli = "YCCS Sailing School - Thanks for your confirm";		
					}
					$MailController = new MailController();
					//sendMail($from_email, $from_name, $to_email, $to_name, $subject, $body, $file="")
					$invioMail_cli = $MailController->sendMail($mail_sito,$nome_del_sito,$query_dati[0]->email,$nome_cliente." ".$cognome_cliente, $oggetto_cli, $body_cli); 
					//$invioMail_azi = $MailController->sendMail($mail_sito,$nome_del_sito,"f.denegri@cwstudio.it",$nome_del_sito, $oggetto_azi, $body_azi); 
					$invioMail_azi = $MailController->sendMail($mail_sito,$nome_del_sito,"sailingschool@yccs.it",$nome_del_sito, $oggetto_azi, $body_azi); 
					$invioMail_azi = $MailController->sendMail($mail_sito,$nome_del_sito,"secretariat@yccs.it",$nome_del_sito, $oggetto_azi, $body_azi); 
					$invioMail_azi = $MailController->sendMail($mail_sito,$nome_del_sito,"members@yccs.it",$nome_del_sito, $oggetto_azi, $body_azi); 
					$invioMail_azi = $MailController->sendMail($mail_sito,$nome_del_sito,"amministrazione@yccs.it",$nome_del_sito, $oggetto_azi, $body_azi); 
					if($foresteria==1) {
						$invioMail_azi = $MailController->sendMail($mail_sito,$nome_del_sito,"co.ge@yccs.it",$nome_del_sito, $oggetto_azi, $body_azi); 
						$invioMail_azi = $MailController->sendMail($mail_sito,$nome_del_sito,"centrosportivo@yccs.it",$nome_del_sito, $oggetto_azi, $body_azi); 
						$invioMail_azi = $MailController->sendMail($mail_sito,$nome_del_sito,"acquisti@yccs.it",$nome_del_sito, $oggetto_azi, $body_azi); 
					}
					
					if($invioMail_cli=="OK"){
						$message_color = "#81c868";
						if($lingua=="ita")
							$message = 'Grazie per aver confermato l\'iscrizione';
						else
							$message = 'Thank you for confirming the inscription';			
					}else{
						$message_color = "red";
						$message = "Error_1!";
					}
				}
			}else{
				$message_color = "red";
				$message = "Error_2!";				
			}
		}else{
			$message_color = "red";
			$message = "Error_3!";	
		}
		
		$view = view("web.yccs-sailing-school-iscrizioni");
		$view = $view->with('result', $result);
		$view = $view->with('metatag', $metatag);
		$view = $view->with('cmd', $cmd);
		$view = $view->with('lingua', $lingua);
		$view = $view->with('this_page_path_ita', $this_page_path_ita);
		$view = $view->with('this_page_path_eng', $this_page_path_eng);
		
		if(isset($nome) && $nome!='') $view->with('nome', $nome);
		if(isset($cognome) && $cognome!='') $view->with('cognome', $cognome);
		if(isset($indirizzo) && $indirizzo!='') $view->with('indirizzo', $indirizzo);
		if(isset($cap) && $cap!='') $view->with('cap', $cap);
		if(isset($citta) && $citta!='') $view->with('citta', $citta);
		if(isset($provincia) && $provincia!='') $view->with('provincia', $provincia);
		if(isset($nazione) && $nazione!='') $view->with('nazione', $nazione);
		if(isset($luogo_nascita) && $luogo_nascita!='') $view->with('luogo_nascita', $luogo_nascita);
		if(isset($nazione_nascita) && $nazione_nascita!='') $view->with('nazione_nascita', $nazione_nascita);
		if(isset($data_nascita) && $data_nascita!='') $view->with('data_nascita', $data_nascita);
		if(isset($codice_fiscale) && $codice_fiscale!='') $view->with('codice_fiscale', $codice_fiscale);
		if(isset($telefono1) && $telefono1!='') $view->with('telefono1', $telefono1);
		if(isset($prefix_telefono1) && $prefix_telefono1!='') $view->with('prefix_telefono1', $prefix_telefono1);
		if(isset($telefono2) && $telefono2!='') $view->with('telefono2', $telefono2);
		if(isset($prefix_telefono2) && $prefix_telefono2!='') $view->with('prefix_telefono2', $prefix_telefono2);
		if(isset($fax) && $fax!='') $view->with('fax', $fax);
		if(isset($prefix_fax) && $prefix_fax!='') $view->with('prefix_fax', $prefix_fax);
		if(isset($email) && $email!='') $view->with('email', $email);
		if(isset($telefono) && $telefono!='') $view->with('telefono', $telefono);
		if(isset($tipo) && $tipo!='') $view->with('tipo', $tipo);
		if(isset($durata) && $durata!='') $view->with('durata', $durata);
		if(isset($note) && $note!='') $view->with('note', $note);
		if(isset($dal) && $dal!='') $view->with('dal', $dal);
		if(isset($al) && $al!='') $view->with('al', $al);
		if(isset($tesseramento) && $tesseramento!='') $view->with('tesseramento', $tesseramento);
		if(isset($transfer) && $transfer!='') $view->with('transfer', $transfer);
		if(isset($indirizzo_transfer) && $indirizzo_transfer!='') $view->with('indirizzo_transfer', $indirizzo_transfer);
		if(isset($totale) && $totale!='') $view->with('totale', $totale);
		if(isset($gia_tesserato) && $gia_tesserato!='') $view->with('gia_tesserato', $gia_tesserato);
		if(isset($circolo) && $circolo!='') $view->with('circolo', $circolo);
		if(isset($pagamento) && $pagamento!='') $view->with('pagamento', $pagamento);
		if(isset($nome_socio_pagamento) && $nome_socio_pagamento!='') $view->with('nome_socio_pagamento', $nome_socio_pagamento);
		if(isset($cognome_socio_pagamento) && $cognome_socio_pagamento!='') $view->with('cognome_socio_pagamento', $cognome_socio_pagamento);
		if(isset($password) && $password!='') $view->with('password', $password);
		if(isset($CI) && $CI!='') $view->with('CI', $CI);
		if(isset($CF) && $CF!='') $view->with('CF', $CF);
		if(isset($CM) && $CM!='') $view->with('CM', $CM);
		
		$view = $view->with('message_color', $message_color);
		$view = $view->withErrors($message);
		return $view;		
	}
	
	public function invioIscrizioneScuolaConferma(Request $request, $codice_iscrizione, $id_ute)
	{
		return $this->index($request, $cmd="yccs-sailing-school-iscrizioni","",$codice_iscrizione,$id_ute,"","&fam=1&conferma=1");
	}
	public function invioIscrizioneScuolaConferma2(Request $request, $codice_iscrizione, $id_ute, $fam, $admin)
	{
		return $this->index($request, $cmd="yccs-sailing-school-iscrizioni","",$codice_iscrizione,$id_ute,"","&fam=$fam&admin=$admin");
	}
	
	public function confermaIscrizioneSailingSchool(Request $request, $codice="")
    { 
		$result = array();
		
		$CustomController = new CustomController();
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();	
		
        $cmd="yccs-sailing-school-conferma-iscrizione";
		$metatag = array();
		$metatag['title'] = Lang::get("website.yccs-sailing-school-iscrizione-conferma title");
		$metatag['description'] = Lang::get("website.yccs-sailing-school-iscrizione-conferma description");				
		
		//Genero link per passaggio di lingua		
		$this_page_path_ita = Config::get('app.url')."/yccs-sailing-school-conferma-iscrizione_$codice.html";
		$this_page_path_eng = Config::get('app.url')."/en/yccs-sailing-school-conferma-iscrizione_$codice.html";	
		
		$error_isc=0;

		if($codice!=""){
			$query_d = DB::table('iscrizioni_scuola')
				->select('*')
				->where('id_rife','=','0')
				->where('codice','=',$codice)
				->get();
			$num_cod = $query_d->count();
			$id_rife = $query_d[0]->id;
			
			if($num_cod>0) $error_isc=0;
			else $error_isc=1;
		}else{$error_isc=1;}
		
		if($error_isc==0){
			if($query_d[0]->stato_accettazione==1){
				$message_color = "#81c868";
				if($lingua=="ita") $message = "Iscrizione confermata";
				else $message = "Registration confirmed";
			}else{				
				$query_up = DB::table('iscrizioni_scuola')->where('codice','=',$codice)->update([
					'stato_accettazione'	=>	'1',
					'data_accettazione'	=>	date("Y-m-d H:i:s")
					]);
				
				$mail_sito = env('APP_EMAIL');
				$ind_sito = env('APP_URL');
				$nome_del_sito = env('APP_NAME');
				$logo_sito = $ind_sito."/".env('APP_LOGO');
				
				include(base_path('resources/views/web/common/body_mail.css.php'));
				
				$dati="";
				$dati_eng="";
				$foresteria=0;
				
				$query_dati = DB::table('iscrizioni_scuola')
					->select('*')
					->where('id','=',$id_rife)
					->get();
				
				$nome_cliente = ucfirst($query_dati[0]->nome);
				$cognome_cliente = ucfirst($query_dati[0]->cognome);
				
				$dati.="
				<b>Dati Personali</b><br/>";
				if($query_dati[0]->dal && $query_dati[0]->dal!="") $dati .= "<b>Dal</b> : ".$CustomController->date_to_data($query_dati[0]->dal)."<br>";
				if($query_dati[0]->al && $query_dati[0]->al!="") $dati .= "<b>Al</b> : ".$CustomController->date_to_data($query_dati[0]->al)."<br>";
				$dati.="
				<b>Nome</b> : ".$query_dati[0]->nome."<br/>
				<b>Cognome</b> : ".$query_dati[0]->cognome."<br/>
				<b>Indirizzo</b> : ".$query_dati[0]->indirizzo."<br/>
				<b>Cap</b> : ".$query_dati[0]->cap."<br/>
				<b>Citta</b> : ".$query_dati[0]->citta."<br/>
				<b>Provincia</b> : ".$query_dati[0]->provincia."<br/>
				<b>Nazione</b> : ".$query_dati[0]->nazione."<br/>
				<b>Luogo di nascita</b> : ".$query_dati[0]->luogo_nascita."<br/>
				<b>Nazione di nascita</b> : ".$query_dati[0]->nazione_nascita."<br/>
				<b>Data di nascita</b> : ".$query_dati[0]->data_nascita."<br/>
				<b>Codice fiscale</b> : ".$query_dati[0]->codice_fiscale."<br/>
				<b>Tessera Fiv</b> : ".$query_dati[0]->tesseramento."<br/>
				<b>Gi&agrave; tesserato</b> : ".$query_dati[0]->gia_tesserato."<br/>
				";
				if($query_dati[0]->circolo && $query_dati[0]->circolo!="") $dati .= "<b>Tesserato con il circolo</b> : ".$query_dati[0]->circolo."<br>";
				if($query_dati[0]->tipo && $query_dati[0]->tipo!=""){
					$dati .= "<b>Tipologia del corso</b> : ".$query_dati[0]->tipo."<br>";
					if($query_dati[0]->tipo=="Corsi j24 con alloggio" || $query_dati[0]->tipo=="Courses j24 with accommodation") $foresteria=1;
					$dati .= "<b>Durata</b> : ".$query_dati[0]->durata;
					if($query_dati[0]->durata=="" || $query_dati[0]->durata=="Prima settimana" || $query_dati[0]->durata=="First week") $dati .= " (".$query_dati[0]->costo_prima_sett."  &euro;)";
					if($query_dati[0]->durata=="Solo mezza settimana" || $query_dati[0]->durata=="Only half a week") $dati .= " (".$query_dati[0]->costo_mezza_settimana."  &euro;)";
					$dati .= "<br>";
					if($query_dati[0]->mezza_settimana_val && $query_dati[0]->mezza_settimana_val!="") $dati .= "<b>Mezza Settimana</b> : ".$query_dati[0]->mezza_settimana_val." (".$query_dati[0]->costo_mezza_settimana." &euro;)<br>";
					if($query_dati[0]->num_settimane>0) $dati .= "<b>N. settimane successive alla prima</b> : ".$query_dati[0]->num_settimane." (".$query_dati[0]->costo_settimane_in_piu." &euro; a settimana)<br>";
					if($query_dati[0]->num_giorni>0) $dati .= "<b>N. giorni in pi&ugrave; successivi alla prima settimana </b> : ".$query_dati[0]->num_giorni." (".$query_dati[0]->costo_giorni_in_piu." &euro; al giorno)<br>";
					if($query_dati[0]->num_settimane_2>0) $dati .= "<b>N. settimane successive alla prima</b> : ".$query_dati[0]->num_settimane_2." (".$query_dati[0]->costo_settimane_in_piu." &euro; a settimana)<br>";
					if($query_dati[0]->num_giorni_2>0) $dati .= "<b>N. giorni in pi&ugrave; successivi alla prima settimana </b> : ".$query_dati[0]->num_giorni_2." (".$query_dati[0]->costo_giorni_in_piu." &euro; al giorno)<br>";
				}
				if(isset($query_dati[0]->extraJ24) && $query_dati[0]->extraJ24=="1" && $query_dati[0]->num_extra>0){
					$foresteria=1;
					$dati .= "<b>N. settimane con extra per intergrazione corso full time</b> : ".$query_dati[0]->num_extra." (".$query_dati[0]->costo_extra." &euro; a settimana)<br>";
				}
				if($query_dati[0]->CI && $query_dati[0]->CI!="") $dati .= "<b>Carta d'identità: </b> : ".$query_dati[0]->CI."<br/>";
				if($query_dati[0]->CF && $query_dati[0]->CF!="") $dati .= "<b>Codice Fiscale: </b> : ".$query_dati[0]->CF."<br/>";
				if(isset($query_dati[0]->CM) && $query_dati[0]->CM!="") $dati .= "<b>Certificato medico: </b> : ".$query_dati[0]->CM."<br/>";
				
				
				$dati_eng.="
				<b>Personal Data</b><br/>";
				if($query_dati[0]->dal && $query_dati[0]->dal!="") $dati_eng .= "<b>From</b> : ".$query_dati[0]->dal."<br>";
				if($query_dati[0]->al && $query_dati[0]->al!="") $dati_eng .= "<b>To</b> : ".$query_dati[0]->al."<br>";
				$dati_eng.="
				<b>Name</b> : ".$query_dati[0]->nome."<br/>
				<b>Surname</b> : ".$query_dati[0]->cognome."<br/>
				<b>Address</b> : ".$query_dati[0]->indirizzo."<br/>
				<b>Postcode</b> : ".$query_dati[0]->cap."<br/>
				<b>Town</b> : ".$query_dati[0]->citta."<br/>
				<b>County</b> : ".$query_dati[0]->provincia."<br/>
				<b>Country</b> : ".$query_dati[0]->nazione."<br/>
				<b>Place of Birth</b> : ".$query_dati[0]->luogo_nascita."<br/>
				<b>Birth Country</b> : ".$query_dati[0]->nazione_nascita."<br/>
				<b>Date of Birth</b> : ".$query_dati[0]->data_nascita."<br/>
				<b>Tax Code</b> : ".$query_dati[0]->codice_fiscale."<br/>
				<b>Fiv Card</b> : ".$query_dati[0]->tesseramento."<br/>
				<b>Current Italian Sailing Federation (FIV) membership</b> : ".$query_dati[0]->gia_tesserato."<br/>
				";
				if($query_dati[0]->circolo && $query_dati[0]->circolo!="") $dati_eng .= "<b>Club</b> : ".$query_dati[0]->circolo."<br>";
				if($query_dati[0]->tipo && $query_dati[0]->tipo!=""){
					$dati_eng .= "<b>Type of Courses</b> : ".$query_dati[0]->tipo."<br>";
					if($query_dati[0]->tipo=="Corsi j24 con alloggio" || $query_dati[0]->tipo=="Courses j24 with accommodation") $foresteria=1;
					$dati_eng .= "<b>Duration</b> : ".$query_dati[0]->durata;
					if($query_dati[0]->durata=="" || $query_dati[0]->durata=="Prima settimana" || $query_dati[0]->durata=="First week") $dati_eng .= " (".$query_dati[0]->costo_prima_sett."  &euro;)";
					if($query_dati[0]->durata=="Solo mezza settimana" || $query_dati[0]->durata=="Only half a week") $dati_eng .= " (".$query_dati[0]->costo_mezza_settimana."  &euro;)";
					$dati_eng .= "<br>";
					if($query_dati[0]->mezza_settimana_val && $query_dati[0]->mezza_settimana_val!="") $dati_eng .= "<b>Half a Week</b> : ".$query_dati[0]->mezza_settimana_val." (".$query_dati[0]->costo_mezza_settimana." &euro;)<br>";
					if($query_dati[0]->num_settimane>0) $dati_eng .= "<b>Number of weeks following the first week</b> : ".$query_dati[0]->num_settimane." (".$query_dati[0]->costo_settimane_in_piu." &euro; at week)<br>";
					if($query_dati[0]->num_giorni>0) $dati_eng .= "<b>Number of days following the first week</b> : ".$query_dati[0]->num_giorni." (".$query_dati[0]->costo_giorni_in_piu." &euro; at day)<br>";
					if($query_dati[0]->num_settimane_2>0) $dati_eng .= "<b>Number of weeks following the first week</b> : ".$query_dati[0]->num_settimane_2." (".$query_dati[0]->costo_settimane_in_piu." &euro; at week)<br>";
					if($query_dati[0]->num_giorni_2>0) $dati_eng .= "<b>Number of days following the first week</b> : ".$query_dati[0]->num_giorni_2." (".$query_dati[0]->costo_giorni_in_piu." &euro; at day)<br>";
				}
				if(isset($query_dati[0]->extraJ24) && $query_dati[0]->extraJ24=="1" && $query_dati[0]->num_extra>0){
					$foresteria=1;
					$dati_eng .= "<b>Number of weeks with extra for full time course integration</b> : ".$query_dati[0]->num_extra." (".$query_dati[0]->costo_extra." &euro; per weeh)<br>";
				}
				if($query_dati[0]->CI && $query_dati[0]->CI!="") $dati_eng .= "<b>Identity document: </b> : ".$query_dati[0]->CI."<br/>";
				if($query_dati[0]->CF && $query_dati[0]->CF!="") $dati_eng .= "<b>Tax code: </b> : ".$query_dati[0]->CF."<br/>";
				if(isset($query_dati[0]->CM) && $query_dati[0]->CM!="") $dati_eng .= "<b>Medical certificate: </b> : ".$query_dati[0]->CM."<br/>";
				
				$x=1;
				$query_dati2 = DB::table('iscrizioni_scuola')
					->select('*')
					->where('id_rife','=',$query_d[0]->id)
					->get();
				
				foreach($query_dati2 AS $key_dati2=>$value_dati2){
					if(isset($value_dati2->nome) && $value_dati2->nome!=""){
						$dati.="
						<br/><b>Dati Familiare Aggiuntivo $x</b><br/>";
						if($value_dati2->dal &&$value_dati2->dal!="") $dati .= "<b>Dal</b> : ".$CustomController->date_to_data($value_dati2->dal)."<br>";
						if($value_dati2->al && $value_dati2->al!="") $dati .= "<b>Al</b> : ".$CustomController->date_to_data($value_dati2->al)."<br>";
						$dati.="
						<b>Nome</b> : ".$value_dati2->nome."<br/>
						<b>Cognome</b> : ".$value_dati2->cognome."<br/>
						<b>Indirizzo</b> : ".$value_dati2->indirizzo."<br/>
						<b>Cap</b> : ".$value_dati2->cap."<br/>
						<b>Citta</b> : ".$value_dati2->citta."<br/>
						<b>Provincia</b> : ".$value_dati2->provincia."<br/>
						<b>Nazione</b> : ".$value_dati2->nazione."<br/>
						<b>Luogo di nascita</b> : ".$value_dati2->luogo_nascita."<br/>
						<b>Nazione di nascita</b> : ".$value_dati2->nazione_nascita."<br/>
						<b>Data di nascita</b> : ".$value_dati2->data_nascita."<br/>
						<b>Codice fiscale</b> : ".$value_dati2->codice_fiscale."<br/>
						<b>Tessera Fiv</b> : ".$value_dati2->tesseramento."<br/>
						<b>Gi&agrave; tesserato</b> : ".$value_dati2->gia_tesserato."<br/>
						";
						if($value_dati2->circolo && $value_dati2->circolo!="") $dati .= "<b>Tesserato con il circolo</b> : ".$value_dati2->circolo."<br>";
						if($value_dati2->tipo && $value_dati2->tipo!=""){
							$dati .= "<b>Tipologia del corso</b> : ".$value_dati2->tipo."<br>";
							if($query_dati[0]->tipo=="Corsi j24 con alloggio" || $query_dati[0]->tipo=="Courses j24 with accommodation") $foresteria=1;
							$dati .= "<b>Durata</b> : ".$value_dati2->durata;
							if($value_dati2->durata=="" || $value_dati2->durata=="Prima settimana" || $value_dati2->durata=="First week") $dati .= " (".$value_dati2->costo_prima_sett."  &euro;)";
							if($value_dati2->durata=="Solo mezza settimana" || $value_dati2->durata=="Only half a week") $dati .= " (".$value_dati2->costo_mezza_settimana."  &euro;)";
							$dati .= "<br>";
							if($value_dati2->mezza_settimana_val && $value_dati2->mezza_settimana_val!="") $dati .= "<b>Mezza Settimana</b> : ".$value_dati2->mezza_settimana_val." (".$value_dati2->costo_mezza_settimana." &euro;)<br>";
							if($value_dati2->num_settimane>0) $dati .= "<b>N. settimane successive alla prima</b> : ".$value_dati2->num_settimane." (".$value_dati2->costo_settimane_in_piu." &euro; a settimana)<br>";
							if($value_dati2->num_giorni>0) $dati .= "<b>N. giorni in pi&ugrave; successivi alla prima settimana </b> : ".$value_dati2->num_giorni." (".$value_dati2->costo_giorni_in_piu." &euro; a settimana)<br>";
							if($value_dati2->num_settimane_2>0) $dati .= "<b>N. settimane successive alla prima</b> : ".$value_dati2->num_settimane_2." (".$value_dati2->costo_settimane_in_piu." &euro; a settimana)<br>";
							if($value_dati2->num_giorni_2>0) $dati .= "<b>N. giorni in pi&ugrave; successivi alla prima settimana </b> : ".$value_dati2->num_giorni_2." (".$value_dati2->costo_giorni_in_piu." &euro; al giorno)<br>";
						}
						if(isset($value_dati2->extraJ24) && $value_dati2->extraJ24=="1" && $value_dati2->num_extra>0){
							$foresteria=1;
							$dati .= "<b>N. settimane con extra per intergrazione corso full time</b> : ".$value_dati2->num_extra." (".$value_dati2->costo_extra." &euro; a settimana)<br>";
						}
						if($value_dati2->CI && $value_dati2->CI!="") $dati .= "<b>Carta d'identità: </b> : ".$value_dati2->CI."<br/>";
						if($value_dati2->CF && $value_dati2->CF!="") $dati .= "<b>Codice Fiscale: </b> : ".$value_dati2->CF."<br/>";
						if(isset($value_dati2->CM) && $value_dati2->CM!="") $dati .= "<b>Certificato medico: </b> : ".$value_dati2->CM."<br/>";
						
						$dati_eng.="
						<br/><b>Additional member of the family $x</b><br/>";
						if($value_dati2->dal &&$value_dati2->dal!="") $dati_eng .= "<b>From</b> : ".$value_dati2->dal."<br>";
						if($value_dati2->al && $value_dati2->al!="") $dati_eng .= "<b>To</b> : ".$value_dati2->al."<br>";
						$dati_eng.="
						<b>Name</b> : ".$value_dati2->nome."<br/>
						<b>Surname</b> : ".$value_dati2->cognome."<br/>
						<b>Address</b> : ".$value_dati2->indirizzo."<br/>
						<b>Postcode</b> : ".$value_dati2->cap."<br/>
						<b>Town</b> : ".$value_dati2->citta."<br/>
						<b>County</b> : ".$value_dati2->provincia."<br/>
						<b>Country</b> : ".$value_dati2->nazione."<br/>
						<b>Place of Birth</b> : ".$value_dati2->luogo_nascita."<br/>
						<b>Birth Country</b> : ".$value_dati2->nazione_nascita."<br/>
						<b>Date of Birth</b> : ".$value_dati2->data_nascita."<br/>
						<b>Tax Code</b> : ".$value_dati2->codice_fiscale."<br/>
						<b>Fiv Card</b> : ".$value_dati2->tesseramento."<br/>
						<b>Current Italian Sailing Federation (FIV) membership</b> : ".$value_dati2->gia_tesserato."<br/>
						";
						if($value_dati2->circolo && $value_dati2->circolo!="") $dati_eng .= "<b>Club</b> : ".$value_dati2->circolo."<br>";
						if($value_dati2->tipo && $value_dati2->tipo!=""){
							$dati_eng .= "<b>Type of Courses</b> : ".$value_dati2->tipo." (".$value_dati2->costo_prima_sett." &euro;)<br>";
							if($query_dati[0]->tipo=="Corsi j24 con alloggio" || $query_dati[0]->tipo=="Courses j24 with accommodation") $foresteria=1;
							$dati_eng .= "<b>Duration</b> : ".$value_dati2->durata;
							if($value_dati2->durata=="" || $value_dati2->durata=="Prima settimana" || $value_dati2->durata=="First week") $dati_eng .= " (".$value_dati2->costo_prima_sett."  &euro;)";
							if($value_dati2->durata=="Solo mezza settimana" || $value_dati2->durata=="Only half a week") $dati_eng .= " (".$value_dati2->costo_mezza_settimana."  &euro;)";
							$dati_eng .= "<br>";
							if($value_dati2->mezza_settimana_val && $value_dati2->mezza_settimana_val!="") $dati_eng .= "<b>Half a Week</b> : ".$value_dati2->mezza_settimana_val." (".$value_dati2->costo_mezza_settimana." &euro;)<br>";
							if($value_dati2->num_settimane>0) $dati_eng .= "<b>Number of weeks following the first week</b> : ".$value_dati2->num_settimane." (".$value_dati2->costo_settimane_in_piu." &euro; a settimana)<br>";
							if($value_dati2->num_giorni>0) $dati_eng .= "<b>Number of days following the first week</b> : ".$value_dati2->num_giorni." (".$value_dati2->costo_giorni_in_piu." &euro; a settimana)<br>";
							if($value_dati2->num_settimane_2>0) $dati_eng .= "<b>Number of weeks following the first week</b> : ".$value_dati2->num_settimane_2." (".$value_dati2->costo_settimane_in_piu." &euro; at week)<br>";
							if($value_dati2->num_giorni_2>0) $dati_eng .= "<b>Number of days following the first week</b> : ".$value_dati2->num_giorni_2." (".$value_dati2->costo_giorni_in_piu." &euro; at day)<br>";
						}
						if(isset($value_dati2->extraJ24) && $value_dati2->extraJ24=="1" && $value_dati2->num_extra>0){
							$foresteria=1;
							$dati_eng .= "<b>Number of weeks with extra for full time course integration</b> : ".$value_dati2->num_extra." (".$value_dati2->costo_extra." &euro; per week)<br>";
						}
						if($value_dati2->CI && $value_dati2->CI!="") $dati_eng .= "<b>Identity document: </b> : ".$value_dati2->CI."<br/>";
						if($value_dati2->CF && $value_dati2->CF!="") $dati_eng .= "<b>Tax code: </b> : ".$value_dati2->CF."<br/>";
						if(isset($value_dati2->CM) && $value_dati2->CM!="") $dati_eng .= "<b>Medical certificate: </b> : ".$value_dati2->CM."<br/>";
						
						$x++;
					}
				}
				
				$dati .= "
				<br/><b>Cell</b> : ".$query_dati[0]->prefix_telefono1." - ".$query_dati[0]->telefono1."<br/>
				<b>Tel 2</b> : ".$query_dati[0]->prefix_telefono2." - ".$query_dati[0]->telefono2."<br/>
				<b>Fax</b> : ".$query_dati[0]->prefix_fax." - ".$query_dati[0]->fax."<br/>
				<b>Email</b> : ".$query_dati[0]->email."<br/>
				<b>Servizio di transfer</b> : ".$query_dati[0]->transfer."<br/>";
				if($query_dati[0]->transfer=="si" && $query_dati[0]->indirizzo_transfer && $query_dati[0]->indirizzo_transfer!="") $dati .= "<b>Indirizzo transfer</b> : ".$query_dati[0]->indirizzo_transfer."<br/>";
				if($query_dati[0]->sconto>0) $dati .= "<b>Sconto applicato</b> : ".$query_dati[0]->sconto." &euro;<br/>";
				$dati .= "<b>Totale dovuto</b> : ".$query_dati[0]->totale." &euro;<br/>
				<b>Metodo Pagamento</b> : ".$query_dati[0]->pagamento."<br/>";
				if($query_dati[0]->pagamento=="Addebito" && $query_dati[0]->nome_socio_pagamento && $query_dati[0]->nome_socio_pagamento!="" && $query_dati[0]->cognome_socio_pagamento && $query_dati[0]->cognome_socio_pagamento!="") $dati .= "<b>Addebito sul conto del socio YCCS</b> : ".$query_dati[0]->nome_socio_pagamento." ".$query_dati[0]->cognome_socio_pagamento."<br/>";
				if($query_dati[0]->pagamento=="Bonifico") $dati .= "<b>Coordinate bancarie per il pagamento con bonifico</b>:<br>IBAN: IT33F0306984902100000000071<br>BIC/SWIFT: BCITITMM<br>";
				$dati .= "<b>Note</b> : ".$query_dati[0]->note."<br/>	<br>";
				
				$dati_eng .= "
				<br/><b>Cell</b> : ".$query_dati[0]->prefix_telefono1." - ".$query_dati[0]->telefono1."<br/>
				<b>Tel 2</b> : ".$query_dati[0]->prefix_telefono2." - ".$query_dati[0]->telefono2."<br/>
				<b>Fax</b> : ".$query_dati[0]->prefix_fax." - ".$query_dati[0]->fax."<br/>
				<b>Email</b> : ".$query_dati[0]->email."<br/>
				<b>Free transfer service</b> : ".$query_dati[0]->transfer."<br/>";
				if(isset($transfer) && $transfer=="si" && isset($indirizzo_transfer)  && $indirizzo_transfer!="") $dati_eng .= "<b>Transfer address</b> : ".$query_dati[0]->indirizzo_transfer."<br/>";
				if($query_dati[0]->sconto>0) $dati_eng .= "<b>Discount applied</b> : ".$query_dati[0]->sconto." &euro;<br/>";
				$dati_eng .= "<b>Total to be paid</b> : ".$query_dati[0]->totale." &euro;<br/>
				<b>Payment method</b> : ".$query_dati[0]->pagamento."<br/>";
				if($query_dati[0]->pagamento=="Addebito" && isset($query_dati[0]->nome_socio_pagamento) && $query_dati[0]->nome_socio_pagamento!="" && isset($query_dati[0]->cognome_socio_pagamento) && $query_dati[0]->cognome_socio_pagamento!="") $dati_eng .= "<b>YCCS member</b> : $nome_socio_pagamento $cognome_socio_pagamento<br>";
				if($query_dati[0]->pagamento=="Bonifico") $dati_eng .= "<b>Wire transfer details</b>:<br>IBAN: IT33F0306984902100000000071<br>BIC/SWIFT: BCITITMM<br>";
				$dati_eng .= "<b>Note</b> : ".$query_dati[0]->note."<br/>	<br>";
				
				
				$testo_azi ="<br><br><br>Un utente (<b>$cognome_cliente $nome_cliente</b>) ha inviato una richiesta dalla sezione <b>YCCS Sailing School iscrizioni</b>
							<br><br>
							$dati";
					
				$testo_cli ="<br><br><br>Gentile <b>$nome_cliente</b><br/>grazie per aver inviato una richiesta di iscrizione</b>
							<br><br>	
							Di seguito i dati forniti:<br/>
							$dati";	
								
				$testo_cli_eng ="<br><br><br>Dear <b>$nome_cliente</b><br/> thanks for your request</b>
								<br><br>	
								Below is the data you provided:<br/>
								$dati_eng";
				
				$oggetto_azi = "Richiesta Iscrizione Scuola Vela - $cognome_cliente $nome_cliente";
				$body_azi = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_azi, $body);
				
				if($lingua=="ita"){
					$body_cli = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_cli, $body);			
					$oggetto_cli = "YCCS Sailing School - Grazie per la richiesta d'iscrizione";
				}
				else {
					$body_cli = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_cli_eng, $body);			
					$oggetto_cli = "YCCS Sailing School - Thanks for your request";		
				}
				$MailController = new MailController();
				//sendMail($from_email, $from_name, $to_email, $to_name, $subject, $body, $file="")
				$invioMail_cli = $MailController->sendMail($mail_sito,$nome_del_sito,$query_dati[0]->email,$nome_cliente." ".$cognome_cliente, $oggetto_cli, $body_cli); 
				//$invioMail_azi = $MailController->sendMail($mail_sito,$nome_del_sito,"f.denegri@cwstudio.it",$nome_del_sito, $oggetto_azi, $body_azi); 
				$invioMail_azi = $MailController->sendMail($mail_sito,$nome_del_sito,"sailingschool@yccs.it",$nome_del_sito, $oggetto_azi, $body_azi); 
				$invioMail_azi = $MailController->sendMail($mail_sito,$nome_del_sito,"secretariat@yccs.it",$nome_del_sito, $oggetto_azi, $body_azi); 
				$invioMail_azi = $MailController->sendMail($mail_sito,$nome_del_sito,"members@yccs.it",$nome_del_sito, $oggetto_azi, $body_azi); 
				$invioMail_azi = $MailController->sendMail($mail_sito,$nome_del_sito,"amministrazione@yccs.it",$nome_del_sito, $oggetto_azi, $body_azi); 
				if($foresteria==1) {
					$invioMail_azi = $MailController->sendMail($mail_sito,$nome_del_sito,"co.ge@yccs.it",$nome_del_sito, $oggetto_azi, $body_azi); 
					$invioMail_azi = $MailController->sendMail($mail_sito,$nome_del_sito,"centrosportivo@yccs.it",$nome_del_sito, $oggetto_azi, $body_azi); 
					$invioMail_azi = $MailController->sendMail($mail_sito,$nome_del_sito,"acquisti@yccs.it",$nome_del_sito, $oggetto_azi, $body_azi); 
				}
				
				if($invioMail_cli=="OK"){
					$message_color = "#81c868";
					if($lingua=="ita")
						$message = 'Grazie per aver confermato l\'iscrizione';
					else
						$message = 'Thank you for confirming the inscription';			
				}else{
					$message_color = "red";
					$message = "Error1!";
				}
			}
		}else{
			$message_color = "red";
			if($lingua=="ita") $message = "Errore!<br/>
											Si prega di seguire nuovamente il link indicato nell'email";
			else $message = "Error!<br/>
							Please follow the link received in the email ";
		}
		
		if(isset($query_d[0]->status)) $status=$query_d[0]->status; else $status="";
		$view = view("web.yccs-sailing-school-conferma-iscrizione");
		$view = $view->with('result', $result);
		$view = $view->with('metatag', $metatag);
		$view = $view->with('cmd', $cmd);
		$view = $view->with('lingua', $lingua);
		$view = $view->with('this_page_path_ita', $this_page_path_ita);
		$view = $view->with('this_page_path_eng', $this_page_path_eng);
		if(isset($query_d[0]->pagamento)) $view = $view->with('pagamento', $query_d[0]->pagamento);
		if(isset($query_d[0]->totale)) $view = $view->with('totale', $query_d[0]->totale);
		if(isset($query_dati[0]->email)) $view = $view->with('email_sped', $query_dati[0]->email);
		if(isset($codice)) $view = $view->with('codice', $codice);
		$view = $view->with('status', $query_d[0]->status);
		$view = $view->with('id_dett', $query_d[0]->id);
		$view = $view->with('message_color', $message_color);
		$view = $view->withErrors($message);
		return $view;
	}
	
	public function cambiaPasswordSailingSchool(Request $request, $codice="")
    { 
		$result = array();
		
		$CustomController = new CustomController();
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();	
		
        $cmd="yccs-sailing-school-cambia-password";
		$metatag = array();
		$metatag['title'] = Lang::get("website.yccs-sailing-school-cambia-password title");
		$metatag['description'] = Lang::get("website.yccs-sailing-school-cambia-password description");				
		
		//Genero link per passaggio di lingua		
		$this_page_path_ita = Config::get('app.url')."/yccs-sailing-school-cambia-password-$codice.html";
		$this_page_path_eng = Config::get('app.url')."/en/yccs-sailing-school-cambia-password-$codice.html";
		
		$view = view("web.yccs-sailing-school-cambia-password");
		$view = $view->with('result', $result);
		$view = $view->with('metatag', $metatag);
		$view = $view->with('cmd', $cmd);
		$view = $view->with('lingua', $lingua);
		$view = $view->with('this_page_path_ita', $this_page_path_ita);
		$view = $view->with('this_page_path_eng', $this_page_path_eng);
		if(isset($message_color)) $view = $view->with('message_color', $message_color);
		if(isset($message)) $view = $view->withErrors($message);
		return $view;
	}
	
	public function cambiaPasswordSailingSchoolPost(Request $request, $codice="")
    { 
		$result = array();
		
		$CustomController = new CustomController();
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();	
		
        $cmd="yccs-sailing-school-cambia-password";
		$metatag = array();
		$metatag['title'] = Lang::get("website.yccs-sailing-school-cambia-password title");
		$metatag['description'] = Lang::get("website.yccs-sailing-school-cambia-password description");				
		
		//Genero link per passaggio di lingua		
		$this_page_path_ita = Config::get('app.url')."/yccs-sailing-school-cambia-password-$codice.html";
		$this_page_path_eng = Config::get('app.url')."/en/yccs-sailing-school-cambia-password-$codice.html";
		
		if(isset($_POST['stato'])) $stato=$_POST['stato']; else $stato="";
		if(isset($_POST['email'])) $email=$_POST['email']; else $email="";
		if(isset($_POST['password'])) $password=$_POST['password']; else $password="";
		
		$query_att = DB::table('iscritti_scuola')
			->select('email','id')
			->where('codice','=',$codice)
			->where('email','=',$email)
			->get();
		$num_att=$query_att->count();
		
		if($num_att==1){
			//$password=crypt($password,$password);
			$password=password_hash($password, PASSWORD_BCRYPT, [10]);
			
			$query_agg = DB::table('iscritti_scuola')->where('id','=',$query_att[0]->id)->update([
						'password'	=>	$password
						]);			
			
			$message_color = "#81c868";
			$message = "La password &egrave; stata aggiornata con successo.";
		}else{
			$message_color = "red";
			$message = "<b>ATTENZIONE!!<br/>Non &egrave; possibile procedere con la procedura di cambio password.<br/><br/>
						La mail inserita non corrisponde all'account di cui si vuole cambiare la password.</b>";
		}		
		
		$view = view("web.yccs-sailing-school-cambia-password");
		$view = $view->with('result', $result);
		$view = $view->with('metatag', $metatag);
		$view = $view->with('cmd', $cmd);
		$view = $view->with('lingua', $lingua);
		$view = $view->with('this_page_path_ita', $this_page_path_ita);
		$view = $view->with('this_page_path_eng', $this_page_path_eng);
		if(isset($message_color)) $view = $view->with('message_color', $message_color);
		if(isset($message)) $view = $view->withErrors($message);
		return $view;
	}
	
	public function indexVideoPag(Request $request,$pag_att="1")
	{
		return $this->index($request, $cmd="video_gallery",$pag_att,"","");
	}
	
	public function yaRisultatiAnno(Request $request,$anno_risultati="")
	{
		return $this->index($request, $cmd="risultati","","","",$anno_risultati);
	}
	
	public function teamDett(Request $request,$pag_dett="",$id_dett="")
	{
		return $this->index($request, $cmd="team","",$pag_dett,$id_dett);
	}
	
	public function atletiAnno(Request $request,$anno="",$pag_dett="",$id_dett="")
	{
		return $this->index($request, $cmd="atleti","",$pag_dett,$id_dett,$anno);
	}
	
	public function atletiDett(Request $request,$pag_dett="",$id_dett="")
	{
		return $this->index($request, $cmd="atleti","",$pag_dett,$id_dett);
	}
	
	public function atletiDettAnno(Request $request,$anno="",$pag_dett="",$id_dett="")
	{
		return $this->index($request, $cmd="atleti","",$pag_dett,$id_dett,$anno);
	}
	
	public function azzurra(Request $request,$pag_dett="")
	{
		return $this->index($request, $cmd="azzurra-pagine","",$pag_dett);
	}
	
	public function azzurra_40(Request $request,$pag_dett="")
	{
		return $this->index($request, $cmd="40_anni_di_azzurra","",$pag_dett);
	}
	
	public function NewsPag(Request $request,$pag_att="1",$pag_dett="",$id_dett="")
    { 
		return $this->index($request, $cmd="news",$pag_att,$pag_dett,$id_dett);
	}
	
	public function NewsPrivatePag(Request $request,$pag_att="1",$pag_dett="",$id_dett="")
    { 
		return $this->index($request, $cmd="news_private",$pag_att,$pag_dett,$id_dett);
	}
	
	public function magazine(Request $request, $pag_att="1",$anno_ric="",$arg_ric_nome="",$arg_ric="",$cat_ric_nome="",$cat_ric="")
    {   
		$result = array();
       
		$CustomController = new CustomController();		
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();	
		$mysidname = $CustomController->checkSession();
		
		$cmd = $pagina = "magazine";
		$bladeView="web.".$pagina;		
		
		//Genero link per passaggio di lingua		
		$this_page_path_ita = str_replace("/en/","/",url()->full());
		$this_page_path_eng = str_replace("/magazine.html","/en/magazine.html",$this_page_path_ita);
		$this_page_path_eng = str_replace("/magazine/","/en/magazine/",$this_page_path_eng);
		$this_page_path_eng = str_replace("/magazine-pag","/en/magazine-pag",$this_page_path_eng);
		
		$metatag = array();
		$metatag['title'] = "Magazine - ".config('app.name');
		$metatag['description'] = $metatag['title'];
		if($anno_ric!="" && $arg_ric_nome!="" && $arg_ric!=""){
			$query_a = DB::table('magazine_macrocategorie')
				->select('id', 'nome', 'nome_eng')
				->where('id', '=', $arg_ric)
				->get();
			$nome_arg = $query_a[0]->nome;
			if($lingua=="eng" && isset($query_a[0]->nome_eng) && $query_a[0]->nome_eng!="") $nome_arg = $query_a[0]->nome_eng;
			$metatag['title'] = "Magazine - $anno_ric - $nome_arg - ".config('app.name');
			$metatag['description'] = $metatag['title'];
		}		

		$query_stato = DB::table('magazine_stato')
					->select('stato')
					->where('id','=','1')
					->get();
		$stato = $query_stato[0]->stato;
		
		$view = view($bladeView);
		$view = $view->with('result', $result);
		$view = $view->with('metatag', $metatag);
		$view = $view->with('cmd', $cmd);
		$view = $view->with('pagina', $pagina);
		$view = $view->with('lingua', $lingua);
		$view = $view->with('mysidname', $mysidname);
		$view = $view->with('pag_att', $pag_att);
		$view = $view->with('anno_ric', $anno_ric);
		$view = $view->with('arg_ric', $arg_ric);
		if(isset($nome_arg)) $view = $view->with('nome_arg', $nome_arg);
		$view = $view->with('cat_ric', $cat_ric);
		$view = $view->with('stato', $stato);
		
		$view = $view->with('this_page_path_ita', $this_page_path_ita);
		$view = $view->with('this_page_path_eng', $this_page_path_eng);
		
		return $view;
	}
	
	public function magazineDett(Request $request, $anno_ric="",$arg_ric_nome="",$art_nome="",$art_dett="",$codice="")
    {   
		$result = array();
       
		$CustomController = new CustomController();		
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();	
		$mysidname = $CustomController->checkSession();
		
		$cmd = $pagina = "magazine_dett";
		$bladeView="web.".$pagina;		
		
		$query_dett = DB::table('magazine_articolo')
					->select('*')
					->where('id','=',$art_dett)
					->get();
		$num_mag = $query_dett->count();
		
		if($num_mag>0){
			$titolo_mag = $query_dett[0]->titolo;
			if ($lingua=="eng" && $query_dett[0]->titolo_eng && $query_dett[0]->titolo_eng!="") $titolo_mag = $query_dett[0]->titolo_eng;
						
			$anno_ric = $query_dett[0]->anno;			
			
			//Genero link per passaggio di lingua		
			$this_page_path_ita = str_replace("/en/","/",url()->full());
			$this_page_path_eng = str_replace("/magazine/","/en/magazine/",$this_page_path_ita);
			
			$metatag = array();
			$metatag['title'] = $titolo_mag." - Magazine - ".config('app.name');
			$metatag['description'] = $metatag['title'];		

			$query_stato = DB::table('magazine_stato')
						->select('stato')
						->where('id','=','1')
						->get();
			$stato = $query_stato[0]->stato;
			
			$view = view($bladeView);
			$view = $view->with('result', $result);
			$view = $view->with('metatag', $metatag);
			$view = $view->with('cmd', $cmd);
			$view = $view->with('pagina', $pagina);
			$view = $view->with('lingua', $lingua);
			$view = $view->with('mysidname', $mysidname);
			$view = $view->with('anno_ric', $anno_ric);
			$view = $view->with('art_nome', $art_nome);
			$view = $view->with('id_dett', $art_dett);
			$view = $view->with('stato', $stato);
			$view = $view->with('codice', $codice);
			
			$view = $view->with('this_page_path_ita', $this_page_path_ita);
			$view = $view->with('this_page_path_eng', $this_page_path_eng);
			
			return $view;
		}else{
			if($lingua=="ita")
				return redirect(Config::get('app.url')."/404.html");
			else
				return redirect(Config::get('app.url')."/en/404.html");	
		}
	}
	
	public function magazineDettCat(Request $request, $anno_ric="", $arg_ric_nome="", $arg_cat_nome="",$art_nome="",$art_dett="")
    { 
		return $this->magazineDett($request, $anno_ric,"","",$art_dett);
	}
	
	public function magazineDettCodex(Request $request, $codice="",$art_dett="")
    { 
		return $this->magazineDett($request, "","","",$art_dett,$codice);
	}
	
	public function sailTalk(Request $request, $pag_att="1",$arg_ric_nome="",$arg_ric="",$cat_ric_nome="",$cat_ric="")
    {   
		$result = array();
       
		$CustomController = new CustomController();		
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();	
		$mysidname = $CustomController->checkSession();
		
		$cmd = $pagina = "sail_talk";
		$bladeView="web.".$pagina;		
		
		//Genero link per passaggio di lingua		
		$this_page_path_ita = str_replace("/en/","/",url()->full());
		$this_page_path_eng = str_replace("/sail_talk.html","/en/sail_talk.html",$this_page_path_ita);
		$this_page_path_eng = str_replace("/sail_talk/","/en/sail_talk/",$this_page_path_eng);
		$this_page_path_eng = str_replace("/sail_talk-pag","/en/sail_talk-pag",$this_page_path_eng);
		
		$metatag = array();
		$metatag['title'] = "Sail Talk - ".config('app.name');
		$metatag['description'] = $metatag['title'];
		if($arg_ric_nome!="" && $arg_ric!=""){
			$query_a = DB::table('sail_talk_macrocategorie')
				->select('id', 'nome', 'nome_eng')
				->where('id', '=', $arg_ric)
				->get();
			$nome_arg = $query_a[0]->nome;
			if($lingua=="eng" && isset($query_a[0]->nome_eng) && $query_a[0]->nome_eng!="") $nome_arg = $query_a[0]->nome_eng;
			$metatag['title'] = "Sail Talk - $nome_arg - ".config('app.name');
			$metatag['description'] = $metatag['title'];
		}		

		$query_stato = DB::table('sail_talk_stato')
					->select('stato')
					->where('id','=','1')
					->get();
		$stato = $query_stato[0]->stato;
		
		$view = view($bladeView);
		$view = $view->with('result', $result);
		$view = $view->with('metatag', $metatag);
		$view = $view->with('cmd', $cmd);
		$view = $view->with('pagina', $pagina);
		$view = $view->with('lingua', $lingua);
		$view = $view->with('mysidname', $mysidname);
		$view = $view->with('pag_att', $pag_att);
		$view = $view->with('arg_ric', $arg_ric);
		if(isset($nome_arg)) $view = $view->with('nome_arg', $nome_arg);
		$view = $view->with('cat_ric', $cat_ric);
		$view = $view->with('stato', $stato);
		
		$view = $view->with('this_page_path_ita', $this_page_path_ita);
		$view = $view->with('this_page_path_eng', $this_page_path_eng);
		
		return $view;
	}
	
	public function sailTalkDett(Request $request, $art_nome="", $id_dett="",$codice="")
    {   
		$result = array();
       
		$CustomController = new CustomController();		
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();	
		$mysidname = $CustomController->checkSession();
		
		$cmd = $pagina = "sail_talk_dett";
		$bladeView="web.".$pagina;		
		
		$query_dett = DB::table('sail_talk_articolo')
					->select('*')
					->where('id','=',$id_dett)
					->get();
		$num_mag = $query_dett->count();
		
		if($num_mag>0){
		
			$titolo_mag = $query_dett[0]->titolo;
			if ($lingua=="eng" && $query_dett[0]->titolo_eng && $query_dett[0]->titolo_eng!="") $titolo_mag = $query_dett[0]->titolo_eng;
						
						
			//Genero link per passaggio di lingua		
			$this_page_path_ita = str_replace("/en/","/",url()->full());
			$this_page_path_eng = str_replace("/sail_talk/","/en/sail_talk/",$this_page_path_ita);
			$this_page_path_eng = str_replace("/sail_talk-pag","/en/sail_talk-pag",$this_page_path_eng);
			
			$metatag = array();
			$metatag['title'] = $titolo_mag." - Sail Talk - ".config('app.name');
			$metatag['description'] = $metatag['title'];		

			$query_stato = DB::table('sail_talk_stato')
						->select('stato')
						->where('id','=','1')
						->get();
			$stato = $query_stato[0]->stato;
			
			$view = view($bladeView);
			$view = $view->with('result', $result);
			$view = $view->with('metatag', $metatag);
			$view = $view->with('cmd', $cmd);
			$view = $view->with('pagina', $pagina);
			$view = $view->with('lingua', $lingua);
			$view = $view->with('mysidname', $mysidname);
			$view = $view->with('art_nome', $art_nome);
			$view = $view->with('id_dett', $id_dett);
			$view = $view->with('stato', $stato);
			$view = $view->with('codice', $codice);
			
			$view = $view->with('this_page_path_ita', $this_page_path_ita);
			$view = $view->with('this_page_path_eng', $this_page_path_eng);
			
			return $view;
		}else{
			if($lingua=="ita")
				return redirect(Config::get('app.url')."/404.html");
			else
				return redirect(Config::get('app.url')."/en/404.html");	
		}
	}
	
	public function sailTalkCatDett(Request $request, $arg_ric_nome="",$art_nome="",$id_dett="")
    { 
		return $this->sailTalkDett($request, "", $id_dett);
	}
	public function sailTalkSottocatDett(Request $request, $arg_ric_nome="",$cat_ric_nome="",$art_nome="",$id_dett="")
    { 
		return $this->sailTalkDett($request, "", $id_dett);
	}
	public function sailTalkDettCodex(Request $request, $codice="",$id_dett="")
    { 
		return $this->sailTalkDett($request, "", $id_dett, $codice);
	}
	
	
	public function comunicatiDett(Request $request, $tit="",$id_dett="")
    {   
		$result = array();
       
		$CustomController = new CustomController();		
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();	
		$mysidname = $CustomController->checkSession();
		
		$cmd = $pagina = "comunicati_dett";
		$bladeView="web.".$pagina;		
		
		//Genero link per passaggio di lingua		
		$this_page_path_ita = Config::get('app.url')."/press/$tit-$id_dett.html";
		$this_page_path_eng = Config::get('app.url')."/en/press/$tit-$id_dett.html";
		
		$query_dett = DB::table('stampa');
		$query_dett = $query_dett->select('*');
		$query_dett = $query_dett->where('id','=',$id_dett);
		$query_dett = $query_dett->get();
		$num_dett = $query_dett->count();
		
		if($num_dett>0){		
			$tit_com = $query_dett[0]->titolo;
			if($lingua=="eng" && isset($query_dett[0]->titolo_eng) && $query_dett[0]->titolo_eng!="") $tit_com = $query_dett[0]->titolo_eng;
			
			$metatag = array();
			$metatag['title'] = $tit_com." - ".Lang::get("website.comunicati nome pagina")." - ".config('app.name');
			$metatag['description'] = $metatag['title'];							
			
			$view = view($bladeView);
			$view = $view->with('result', $result);
			$view = $view->with('metatag', $metatag);
			$view = $view->with('cmd', $cmd);
			$view = $view->with('pagina', $pagina);
			$view = $view->with('lingua', $lingua);
			$view = $view->with('mysidname', $mysidname);
			$view = $view->with('id_dett', $id_dett);
			$view = $view->with('query_dett', $query_dett);
			
			$view = $view->with('this_page_path_ita', $this_page_path_ita);
			$view = $view->with('this_page_path_eng', $this_page_path_eng);
			
			return $view;
		}else{			
			if($lingua=="ita")
				return redirect(Config::get('app.url')."/404.html");
			else
				return redirect(Config::get('app.url')."/en/404.html");				
		}
	}
	
	public function comunicatiDettTipo(Request $request, $tipo="", $tit="",$id_dett="")
    {   
		$result = array();
       
		$CustomController = new CustomController();		
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();	
		$mysidname = $CustomController->checkSession();
		
		$cmd = $pagina = "comunicati_dett";
		$bladeView="web.".$pagina;		
		
		//Genero link per passaggio di lingua		
		$this_page_path_ita = Config::get('app.url')."/comunicati/$tit-$id_dett.html";
		$this_page_path_eng = Config::get('app.url')."/en/comunicati/$tit-$id_dett.html";
		
		$query_dett = DB::table('stampa');
		$query_dett = $query_dett->select('*');
		$query_dett = $query_dett->where('id','=',$id_dett);
		$query_dett = $query_dett->get();
		$num_dett = $query_dett->count();
		
		if($num_dett>0){		
			$tit_com = $query_dett[0]->titolo;
			if($lingua=="eng" && isset($query_dett[0]->titolo_eng) && $query_dett[0]->titolo_eng!="") $tit_com = $query_dett[0]->titolo_eng;
			
			$metatag = array();
			$metatag['title'] = $tit_com." - ".Lang::get("website.comunicati nome pagina")." - ".config('app.name');
			$metatag['description'] = $metatag['title'];							
			
			$view = view($bladeView);
			$view = $view->with('result', $result);
			$view = $view->with('metatag', $metatag);
			$view = $view->with('cmd', $cmd);
			$view = $view->with('pagina', $pagina);
			$view = $view->with('lingua', $lingua);
			$view = $view->with('mysidname', $mysidname);
			$view = $view->with('id_dett', $id_dett);
			$view = $view->with('tipo', $tipo);
			$view = $view->with('query_dett', $query_dett);
			
			$view = $view->with('this_page_path_ita', $this_page_path_ita);
			$view = $view->with('this_page_path_eng', $this_page_path_eng);
			
			return $view;
		}else{			
			if($lingua=="ita")
				return redirect(Config::get('app.url')."/404.html");
			else
				return redirect(Config::get('app.url')."/en/404.html");				
		}
	}
	
	
	
	public function yaVideogallery(Request $request, $tit="",$id_dett="",$pag_att="1")
    {   
		$result = array();
       
		$CustomController = new CustomController();		
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();	
		$mysidname = $CustomController->checkSession();
		
		$cmd = $pagina = "young-azzurra-video-dett";
		$bladeView="web.".$pagina;		
		
		//Genero link per passaggio di lingua		
		$this_page_path_ita = Config::get('app.url')."/young-azzurra/video_gallery/$tit-$id_dett.html";
		$this_page_path_eng = Config::get('app.url')."/en/young-azzurra/video_gallery/$tit-$id_dett.html";
		
		$query_dett = DB::table('ya_video');
		$query_dett = $query_dett->select('*');
		$query_dett = $query_dett->where('id','=',$id_dett);
		$query_dett = $query_dett->get();
		$num_dett = $query_dett->count();
		
		if($num_dett>0){				
			$tit_com = $query_dett[0]->titolo;
			if($lingua=="eng" && isset($query_dett[0]->titolo_eng) && $query_dett[0]->titolo_eng!="") $tit_com = $query_dett[0]->titolo_eng;
			
			$metatag = array();
			$metatag['title'] = $tit_com." - Video Gallery - Young Azzurra - ".config('app.name');
			$metatag['description'] = $metatag['title'];							
			
			$view = view($bladeView);
			$view = $view->with('result', $result);
			$view = $view->with('metatag', $metatag);
			$view = $view->with('cmd', $cmd);
			$view = $view->with('pagina', $pagina);
			$view = $view->with('lingua', $lingua);
			$view = $view->with('mysidname', $mysidname);
			$view = $view->with('id_dett', $id_dett);
			$view = $view->with('query_dett', $query_dett);
			$view = $view->with('pag_att', $pag_att);
			
			$view = $view->with('this_page_path_ita', $this_page_path_ita);
			$view = $view->with('this_page_path_eng', $this_page_path_eng);
			
			return $view;
		}else{			
			if($lingua=="ita")
				return redirect(Config::get('app.url')."/404.html");
			else
				return redirect(Config::get('app.url')."/en/404.html");				
		}
	}
	
	public function yaVideogalleryPag(Request $request,$pag_att="1", $tit="",$id_dett="")
    {   
		$result = array();
       
		$CustomController = new CustomController();		
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();	
		$mysidname = $CustomController->checkSession();
		
		$cmd = $pagina = "young-azzurra-video-dett";
		$bladeView="web.".$pagina;		
		
		//Genero link per passaggio di lingua		
		$this_page_path_ita = Config::get('app.url')."/young-azzurra/video_gallery-pag$pag_att/$tit-$id_dett.html";
		$this_page_path_eng = Config::get('app.url')."/en/young-azzurra/video_gallery-pag$pag_att/$tit-$id_dett.html";
		
		$query_dett = DB::table('ya_video');
		$query_dett = $query_dett->select('*');
		$query_dett = $query_dett->where('id','=',$id_dett);
		$query_dett = $query_dett->get();
		
		$tit_com = $query_dett[0]->titolo;
		if($lingua=="eng" && isset($query_dett[0]->titolo_eng) && $query_dett[0]->titolo_eng!="") $tit_com = $query_dett[0]->titolo_eng;
		
		$metatag = array();
		$metatag['title'] = $tit_com." - Video Gallery - Young Azzurra - ".config('app.name');
		$metatag['description'] = $metatag['title'];							
		
		$view = view($bladeView);
		$view = $view->with('result', $result);
		$view = $view->with('metatag', $metatag);
		$view = $view->with('cmd', $cmd);
		$view = $view->with('pagina', $pagina);
		$view = $view->with('lingua', $lingua);
		$view = $view->with('mysidname', $mysidname);
		$view = $view->with('id_dett', $id_dett);
		$view = $view->with('query_dett', $query_dett);
		$view = $view->with('pag_att', $pag_att);
		
		$view = $view->with('this_page_path_ita', $this_page_path_ita);
		$view = $view->with('this_page_path_eng', $this_page_path_eng);
		
		return $view;
	}
	
	public function yaNewsPag(Request $request,$pag_att="1", $tit="",$id_dett="")
    {   
		$result = array();
       
		$CustomController = new CustomController();		
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();	
		$mysidname = $CustomController->checkSession();
		
		$cmd = $pagina = "young-azzurra-news-dett";
		$bladeView="web.".$pagina;		
		
		//Genero link per passaggio di lingua		
		$this_page_path_ita = Config::get('app.url')."/young-azzurra/news-pag$pag_att/$tit-$id_dett.html";
		$this_page_path_eng = Config::get('app.url')."/en/young-azzurra/news-pag$pag_att/$tit-$id_dett.html";
		
		$query_dett = DB::table('news');
		$query_dett = $query_dett->select('*');
		$query_dett = $query_dett->where('id','=',$id_dett);
		$query_dett = $query_dett->where('YA','=','1');
		$query_dett = $query_dett->get();
		$num_dett = $query_dett->count();
		
		if($num_dett>0){
			$tit_com = $query_dett[0]->titolo;
			if($lingua=="eng" && isset($query_dett[0]->titolo_eng) && $query_dett[0]->titolo_eng!="") $tit_com = $query_dett[0]->titolo_eng;
			
			$metatag = array();
			$metatag['title'] = $tit_com." - News - Young Azzurra - ".config('app.name');
			$metatag['description'] = $metatag['title'];							
			
			$view = view($bladeView);
			$view = $view->with('result', $result);
			$view = $view->with('metatag', $metatag);
			$view = $view->with('cmd', $cmd);
			$view = $view->with('pagina', $pagina);
			$view = $view->with('lingua', $lingua);
			$view = $view->with('mysidname', $mysidname);
			$view = $view->with('id_dett', $id_dett);
			$view = $view->with('query_dett', $query_dett);
			$view = $view->with('pag_att', $pag_att);
			
			$view = $view->with('this_page_path_ita', $this_page_path_ita);
			$view = $view->with('this_page_path_eng', $this_page_path_eng);
			
			return $view;
		}else{
			if($lingua=="ita")
				return redirect(Config::get('app.url')."/404.html");
			else
				return redirect(Config::get('app.url')."/en/404.html");
		}
		
	}
	
	public function yaPhotogalleryCategory(Request $request, $tit="",$id_dett="",$pag_att="1")
    {  
		$result = array();
       
		$CustomController = new CustomController();		
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();	
		$mysidname = $CustomController->checkSession();
		
		$conferenza=$this->checkConferenza();
		
		$cmd = "young-azzurra-gallery-cat";
		$pagina = "young-azzurra-gallery-cat";
		$bladeView="web.".$pagina;		
		
		$query_cat = DB::table("ya_gallery_cat")
			->select('*')
			->where('id','=',$id_dett)
			->get();
			
		$nome_ita = $query_cat[0]->nome;
		$nome_eng = $query_cat[0]->nome;
		if(isset($query_cat[0]->nome_eng) && $query_cat[0]->nome_eng!="") $nome_eng = $query_cat[0]->nome_eng;
		
		if($lingua=="ita") $nome_cat = $nome_ita;
		else $nome_cat = $nome_eng;
		
		//Genero link per passaggio di lingua		
		$this_page_path_ita = Config::get('app.url')."/young-azzurra/photogallery-category/".$CustomController->to_htaccess_url($nome_ita)."-".$id_dett.".html";
		$this_page_path_eng = Config::get('app.url')."/en/young-azzurra/photogallery-category/".$CustomController->to_htaccess_url($nome_eng)."-".$id_dett.".html";
		
		$metatag = array();
		$metatag['title'] = $nome_cat." - Photogallery - Young Azzurra - ".config('app.name');
		$metatag['description'] = $metatag['title'];
		
		
		$view = view($bladeView);
		$view = $view->with('result', $result);
		$view = $view->with('metatag', $metatag);
		$view = $view->with('cmd', $cmd);
		$view = $view->with('pagina', $pagina);
		$view = $view->with('lingua', $lingua);
		$view = $view->with('pag_att', $pag_att);
		if(isset($id_dett)) $view = $view->with('id_dett', $id_dett);
		if(isset($nome_cat)) $view = $view->with('nome_cat', $nome_cat);
		if(isset($pag_dett)) $view = $view->with('pag_dett', $pag_dett);
			if(isset($conferenza)) $view = $view->with('conferenza', $conferenza);
		$view = $view->with('mysidname', $mysidname);
		
		$view = $view->with('this_page_path_ita', $this_page_path_ita);
		$view = $view->with('this_page_path_eng', $this_page_path_eng);
		
		return $view;
	}
	
	public function yaPhotogallery(Request $request, $tit="",$id_dett="",$pag_att="1")
    {  
		$result = array();
       
		$CustomController = new CustomController();		
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();	
		$mysidname = $CustomController->checkSession();
		
		$conferenza=$this->checkConferenza();
		
		$cmd = $pagina = "young-azzurra-gallery-dett";
		$bladeView="web.".$pagina;		
		
		//Genero link per passaggio di lingua		
		$this_page_path_ita = Config::get('app.url')."/young-azzurra/photogallery/$tit-$id_dett.html";
		$this_page_path_eng = Config::get('app.url')."/en/young-azzurra/photogallery/$tit-$id_dett.html";
		
		$query_dett = DB::table('ya_gallery');
		$query_dett = $query_dett->select('*');
		$query_dett = $query_dett->where('id','=',$id_dett);
		$query_dett = $query_dett->get();
		$num_dett = $query_dett->count();
		
		if($num_dett>0){	

			if($query_dett[0]->id_rife!='0'){
				$query_cat = DB::table('ya_gallery_cat')
					->select('*')
					->where('id','=',$query_dett[0]->id_rife)
					->get();
				$nome_cat = $query_cat[0]->nome;
				if($lingua=="eng" && isset($query_cat[0]->nome_eng) && $query_cat[0]->nome_eng!="") $nome_cat = $query_cat[0]->nome_eng;
			}
			
			$tit_com = $query_dett[0]->titolo;
			if($lingua=="eng" && isset($query_dett[0]->titolo_eng) && $query_dett[0]->titolo_eng!="") $tit_com = $query_dett[0]->titolo_eng;
			
			$metatag = array();
			$metatag['title'] = $tit_com;
			if(isset($nome_cat)) $metatag['title'] .= " - ".$nome_cat;
			$metatag['title'] .= " - Photogallery - Young Azzurra - ".config('app.name');
			$metatag['description'] = $metatag['title'];							
			
			$view = view($bladeView);
			$view = $view->with('result', $result);
			$view = $view->with('metatag', $metatag);
			$view = $view->with('cmd', $cmd);
			$view = $view->with('pagina', $pagina);
			$view = $view->with('lingua', $lingua);
			$view = $view->with('mysidname', $mysidname);
			$view = $view->with('id_dett', $id_dett);
			$view = $view->with('query_dett', $query_dett);
			if(isset($nome_cat)) $view = $view->with('nome_cat', $nome_cat);
			if(isset($conferenza)) $view = $view->with('conferenza', $conferenza);
			$view = $view->with('pag_att', $pag_att);
			
			$view = $view->with('this_page_path_ita', $this_page_path_ita);
			$view = $view->with('this_page_path_eng', $this_page_path_eng);
			
			return $view;
		}else{			
			if($lingua=="ita")
				return redirect(Config::get('app.url')."/404.html");
			else
				return redirect(Config::get('app.url')."/en/404.html");				
		}
	}
	
	public function yaPhotogalleryPag(Request $request, $pag_att=1, $tit="",$id_dett="")
    {   
		$result = array();
       
		$CustomController = new CustomController();		
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();	
		$mysidname = $CustomController->checkSession();
		
		$cmd = $pagina = "young-azzurra-gallery-dett";
		$bladeView="web.".$pagina;		
		
		//Genero link per passaggio di lingua		
		$this_page_path_ita = Config::get('app.url')."/young-azzurra/photogallery-pag$pag_att/$tit-$id_dett.html";
		$this_page_path_eng = Config::get('app.url')."/en/young-azzurra/photogallery-pag$pag_att/$tit-$id_dett.html";
		
		$query_dett = DB::table('ya_gallery');
		$query_dett = $query_dett->select('*');
		$query_dett = $query_dett->where('id','=',$id_dett);
		$query_dett = $query_dett->get();
		
		
		$tit_com = $query_dett[0]->titolo;
		if($lingua=="eng" && isset($query_dett[0]->titolo_eng) && $query_dett[0]->titolo_eng!="") $tit_com = $query_dett[0]->titolo_eng;
		
		$metatag = array();
		$metatag['title'] = $tit_com." - ".$nome_cat." - Photogallery - Young Azzurra - ".config('app.name');
		$metatag['description'] = $metatag['title'];							
		
		$view = view($bladeView);
		$view = $view->with('result', $result);
		$view = $view->with('metatag', $metatag);
		$view = $view->with('cmd', $cmd);
		$view = $view->with('pagina', $pagina);
		$view = $view->with('lingua', $lingua);
		$view = $view->with('mysidname', $mysidname);
		$view = $view->with('id_dett', $id_dett);
		$view = $view->with('query_dett', $query_dett);
		$view = $view->with('pag_att', $pag_att);
		
		$view = $view->with('this_page_path_ita', $this_page_path_ita);
		$view = $view->with('this_page_path_eng', $this_page_path_eng);
		
		return $view;
	}
	
	public function carrello(Request $request, $cmd="carrello",$pag_att="1")
    {
		$result = array();
        $result['commonContent'] = $this->index->commonContent();
		$CustomController = new CustomController();
		$mysidname = $CustomController->checkSession();
		
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();		
		$pag="";
		
		if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att="1";						
        
		$pagina = "carrello";
		$bladeView="web.".$pagina;			
		
		$metatag = array();
		$metatag['title'] = Lang::get("website.$pagina title");
		$metatag['description'] = Lang::get("website.$pagina description");				
		
		//Genero link per passaggio di lingua		
		$this_page_path_ita = Config::get('app.url')."/".Lang::get("website.$pagina slug",[],"it").$pag.".html";
		$this_page_path_eng = Config::get('app.url')."/en/".Lang::get("website.$pagina slug",[],"en").$pag.".html";				
		
		$view = view($bladeView);
		$view = $view->with('result', $result);
		$view = $view->with('metatag', $metatag);
		$view = $view->with('cmd', $cmd);
		$view = $view->with('lingua', $lingua);
		$view = $view->with('pag_att', $pag_att);
		$view = $view->with('mysidname', $mysidname);
		
		$view = $view->with('this_page_path_ita', $this_page_path_ita);
		$view = $view->with('this_page_path_eng', $this_page_path_eng);
        return $view;
    }
	
	public function news($pag_att)
    {
		$result = array();
        $result['commonContent'] = $this->index->commonContent();
		
		$CustomController = new CustomController();
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();		
		
        $cmd="news";
		
		$metatag = array();
		$metatag['title'] = Lang::get("website.news title")." - Pag ".$pag_att;
		$metatag['description'] = Lang::get("website.news description")." - Pag ".$pag_att;		
		
		//Genero link per passaggio di lingua		
		$this_page_path_ita = Config::get('app.url')."/news-pag".$pag_att.".html";
		$this_page_path_eng = Config::get('app.url')."/en/news-pag".$pag_att.".html";		
        
		$view = view("web.news");
		$view = $view->with('result', $result);
		$view = $view->with('metatag', $metatag);
		$view = $view->with('cmd', $cmd);
		$view = $view->with('pag_att', $pag_att);
		$view = $view->with('lingua', $lingua);
		$view = $view->with('this_page_path_ita', $this_page_path_ita);
		$view = $view->with('this_page_path_eng', $this_page_path_eng);
        return $view;
    }
	
	public function news_dett($dammi, $id_dett)
    {
		$result = array();
        $result['commonContent'] = $this->index->commonContent();
		
		$CustomController = new CustomController();

		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();		
		
        $cmd="news_dett";
		
		$query_dett=DB::table('eventi');
		$query_dett=$query_dett->select('*');
		$query_dett=$query_dett->WHERE('id','=',$id_dett);
		$query_dett=$query_dett->get();
		
		$id_n = $query_dett[0]->id;
		$data_n = $query_dett[0]->data_ev;
		if ($data_n!="") $data_n = $CustomController->date_to_data($data_n,".");
		$tit_n = utf8_encode($query_dett[0]->titolo);
		if($lingua=="en" && $query_dett[0]->titolo_eng && trim($query_dett[0]->titolo_eng)!="") $tit_n = utf8_encode($query_dett[0]->titolo_eng);
		$testo_n = $query_dett[0]->testo;
		if($lingua=="en" && $query_dett[0]->testo_eng && trim($query_dett[0]->testo_eng)!="") $testo_n = utf8_encode($query_dett[0]->testo_eng);
		$testo_n = ucfirst(utf8_encode(strip_tags($testo_n)));
		
		$metatag = array();
		$metatag['title'] = $tit_n." - ".Lang::get("website.news title");
		$metatag['description'] = $tit_n." - ".Lang::get("website.news description");
		
		//Genero link per passaggio di lingua		
		$this_page_path_ita = Config::get('app.url')."/dettaglio-news-pag1/".$CustomController->to_htaccess_url($query_dett[0]->titolo)."-".$id_dett.".html";
		if($query_dett[0]->titolo_eng && trim($query_dett[0]->titolo_eng)!="")
			$this_page_path_eng = Config::get('app.url')."/en/news-detail-pag1/".$CustomController->to_htaccess_url($query_dett[0]->titolo_eng)."-".$id_dett.".html";
		else
			$this_page_path_eng = Config::get('app.url')."/en/news-detail-pag1/".$CustomController->to_htaccess_url($query_dett[0]->titolo)."-".$id_dett.".html";
        
		$view = view("web.news_dett");
		$view = $view->with('result', $result);
		$view = $view->with('metatag', $metatag);
		$view = $view->with('cmd', $cmd);
		$view = $view->with('id_dett', $id_dett);
		$view = $view->with('testo_n', $testo_n);
		$view = $view->with('tit_n', $tit_n);
		$view = $view->with('data_n', $data_n);
		$view = $view->with('lingua', $lingua);
		$view = $view->with('this_page_path_ita', $this_page_path_ita);
		$view = $view->with('this_page_path_eng', $this_page_path_eng);
        return $view;
    }
	
		
	 public function prodotti($pag_att="", $nome_macro="",$ric_cat="",$nome_cat="",$ric_sottocat="",$prov="")
    {
		
        $result = array();
        $result['commonContent'] = $this->index->commonContent();
		
		$CustomController = new CustomController();
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();		
		
		if(isset($_GET['cmd'])) $cmd=$_GET['cmd']; else $cmd="";
		if(isset($_GET['ric_novita'])) $ric_novita=$_GET['ric_novita']; else $ric_novita="";
		if(isset($_GET['ric_offerte'])) $ric_offerte=$_GET['ric_offerte']; else $ric_offerte="";
		if(isset($_GET['rec_pag'])) $rec_pag=$_GET['rec_pag']; else $rec_pag="20";
		if(isset($_GET['ric_tag'])) $ric_tag=$_GET['ric_tag']; else $ric_tag="";
		if(isset($_GET['ric_nome'])) $ric_nome=$_GET['ric_nome']; else $ric_nome="";
		if(isset($_GET['ord'])) $ord=$_GET['ord']; else $ord="nome_desc";
	
        $metatag = array();
		$metatag['title'] = Lang::get("website.prodotti title");
		$metatag['description'] = Lang::get("website.prodotti description");				
		
		if($pag_att!="" || $ric_cat!="" || $ric_sottocat!=""){
			$link_pag = "prodotti";
			$link_pag_eng = "products";
			if($pag_att!="") {
				$link_pag.="-pag".$pag_att; 
				$link_pag_eng.="-pag".$pag_att; 
			}else {
				$link_pag.="-pag1";
				$link_pag_eng.="-pag1";
			}
			
			if($ric_cat!="") {
				$query_cp = DB::table('macrocategorie');
				$query_cp = $query_cp->select('nome','nome_ing');
				$query_cp = $query_cp->where('id', '=', $ric_cat);
				$query_cp = $query_cp->get();
				$CustomController = new CustomController();
				$link_pag.="/".$CustomController->to_htaccess_url($query_cp[0]->nome,"")."-".$ric_cat;
				$link_pag_eng.="/".$CustomController->to_htaccess_url($query_cp[0]->nome_ing,"")."-".$ric_cat;
			}
			if($ric_sottocat!="") {
				$query_sp = DB::table('categorie');
				$query_sp = $query_sp->select('nome','nome_ing');
				$query_sp = $query_sp->where('id', '=', $ric_sottocat);
				$query_sp = $query_sp->get();
				
				$link_pag.="/".$CustomController->to_htaccess_url($query_sp[0]->nome,"")."-".$ric_sottocat;
				$link_pag_eng.="/".$CustomController->to_htaccess_url($query_sp[0]->nome_ing,"")."-".$ric_sottocat;
			}
			$link_pag.=".html";
			$link_pag_eng.=".html";
		}else{
			if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att="1";
			if(isset($_GET['ric_cat'])) $ric_cat=$_GET['ric_cat']; else $ric_cat="";
			if(isset($_GET['ric_sottocat'])) $ric_sottocat=$_GET['ric_sottocat']; else $ric_sottocat="";
			$link_pag = "index.php?cmd=$cmd";
			if($ric_novita!="") $link_pag .= "&ric_novita=$ric_novita";
			if($ric_offerte!="") $link_pag .= "&ric_offerte=$ric_offerte";
			if($rec_pag!="") $link_pag .= "&rec_pag=$rec_pag";
			if($pag_att!="") $link_pag .= "&pag_att=$pag_att";
			if($ric_tag!="") $link_pag .= "&ric_tag=$ric_tag";
			if($ric_cat!="") $link_pag .= "&ric_cat=$ric_cat";
			if($ric_sottocat!="") $link_pag .= "&ric_sottocat=$ric_sottocat";
			if($ric_nome!="") $link_pag .= "&ric_nome=$ric_nome";
			if($ord!="") $link_pag .= "&ord=$ord";
			$link_pag_eng = $link_pag;
		}
		
		//Genero link per passaggio di lingua		
		$this_page_path_ita = Config::get('app.url')."/$link_pag";
		$this_page_path_eng = Config::get('app.url')."/en/$link_pag_eng";		
        
		$view = view("web.prodotti");
		$view = $view->with('result', $result);
		$view = $view->with('metatag', $metatag);
		$view = $view->with('cmd', $cmd);
		if($ric_novita!="") $view = $view->with('ric_novita', $ric_novita);
		if($ric_offerte!="") $view = $view->with('ric_offerte', $ric_offerte);
		if($rec_pag!="") $view = $view->with('rec_pag', $rec_pag);
		if($pag_att!="") $view = $view->with('pag_att', $pag_att);
		if($ric_tag!="") $view = $view->with('ric_tag', $ric_tag);
		if($ric_cat!="") $view = $view->with('ric_cat', $ric_cat);
		if($ric_sottocat!="") $view = $view->with('ric_sottocat', $ric_sottocat);
		if($ric_nome!="") $view = $view->with('ric_nome', $ric_nome);
		if($ord!="") $view = $view->with('ord', $ord);
		$view = $view->with('lingua', $lingua);
		$view = $view->with('this_page_path_ita', $this_page_path_ita);
		$view = $view->with('this_page_path_eng', $this_page_path_eng);
        return $view;
    }
	
	public function prodotti_dett($pag_att="", $nome_macro="",$ric_cat="",$nome_cat="",$ric_sottocat="",$nome_gruppo="",$id_gruppo="",$prov="")
    {
        $result = array();
        $result['commonContent'] = $this->index->commonContent();
		
		$CustomController = new CustomController();
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();
		$mysidname = $CustomController->checkSession();
		
		if(isset($_GET['cmd'])) $cmd=$_GET['cmd']; else $cmd="";
		if(isset($_GET['ric_novita'])) $ric_novita=$_GET['ric_novita']; else $ric_novita="";
		if(isset($_GET['ric_offerte'])) $ric_offerte=$_GET['ric_offerte']; else $ric_offerte="";
		if(isset($_GET['rec_pag'])) $rec_pag=$_GET['rec_pag']; else $rec_pag="20";
		if(isset($_GET['ric_tag'])) $ric_tag=$_GET['ric_tag']; else $ric_tag="";
		if(isset($_GET['ric_nome'])) $ric_nome=$_GET['ric_nome']; else $ric_nome="";
		if(isset($_GET['ord'])) $ord=$_GET['ord']; else $ord="nome_desc";
		
		//Genero link per passaggio di lingua		
		$this_page_path_ita = Config::get('app.url')."/dettaglio-prodotto-pag1/";
		$this_page_path_eng = Config::get('app.url')."/en/product-detail-pag1/";
		
		
		if (isset($ric_cat) && $ric_cat!="") {
			$query_cp = DB::table('macrocategorie');
			$query_cp = $query_cp->select('nome','nome_ing');
			$query_cp = $query_cp->where('id', '=', $ric_cat);
			$query_cp = $query_cp->get();
			
			$num_mac = $query_cp->count();
			$dammi = "";
			if($num_mac>0)
				$dammi = utf8_encode($query_cp[0]->nome);
				if($lingua=="en" && isset($query_cp[0]->nome_ing) && $query_cp[0]->nome_ing!="") $dammi = utf8_encode($query_cp[0]->nome_ing);
				
				$this_page_path_ita .= $CustomController->to_htaccess_url($query_cp[0]->nome)."-".$ric_cat."/";
				if(isset($query_cp[0]->nome_ing) && $query_cp[0]->nome_ing!="")$this_page_path_eng .= $CustomController->to_htaccess_url($query_cp[0]->nome_ing)."-".$ric_cat."/";
				else $this_page_path_eng .= $CustomController->to_htaccess_url($query_cp[0]->nome)."-".$ric_cat."/";
		}
		
		if (isset($ric_sottocat) && $ric_sottocat!="") {
			$query_sp = DB::table('categorie');
			$query_sp = $query_sp->select('nome','nome_ing');
			$query_sp = $query_sp->where('id', '=', $ric_sottocat);
			$query_sp = $query_sp->get();
			
			$num_sp = $query_sp->count();
			$dammi1 = "";
			if($num_sp>0){
				$dammi1 = utf8_encode($query_sp[0]->nome);
				if($lingua=="en" && isset($query_sp[0]->nome_ing) && $query_sp[0]->nome_ing!="") $dammi1 = utf8_encode($query_sp[0]->nome_ing);
				$dammi1 = str_replace("\'","'",$dammi1);
				
				$this_page_path_ita .= $CustomController->to_htaccess_url($query_sp[0]->nome)."-".$ric_sottocat."/";
				if(isset($query_sp[0]->nome_ing) && $query_sp[0]->nome_ing!="")$this_page_path_eng .= $CustomController->to_htaccess_url($query_sp[0]->nome_ing)."-".$ric_sottocat."/";
				else $this_page_path_eng .= $CustomController->to_htaccess_url($query_sp[0]->nome)."-".$ric_sottocat."/";
			}
		}else{
			$query_sp = DB::table('categorie AS c');
			$query_sp = $query_sp->select('c.id','c.nome','c.nome_ing','a.id_cat');
			$query_catl = $query_catl->join('assegnazioni AS a','a.id_macro','=',$ric_cat );
			$query_sp = $query_sp->get();
			
			$num_sp = $query_sp->count();
			$dammi1 = "";
			if($num_sp>0){
				$dammi1 = utf8_encode($query_sp[0]->nome);
				if($lingua=="en" && isset($query_sp[0]->nome_ing) && $query_sp[0]->nome_ing!="") $dammi1 = utf8_encode($query_sp[0]->nome_ing);
				$dammi1 = str_replace("\'","'",$dammi1);
				
				$this_page_path_ita .= $CustomController->to_htaccess_url($query_sp[0]->nome)."-".$ric_cat."/";				
				if(isset($query_sp[0]->nome_ing) && $query_sp[0]->nome_ing!="") $this_page_path_eng .= $CustomController->to_htaccess_url($query_sp[0]->nome_ing)."-".$ric_cat."/";
				else $this_page_path_eng .= $CustomController->to_htaccess_url($query_sp[0]->nome)."-".$ric_cat."/";
			}
		}
		
		
		if (isset($id_gruppo) && $id_gruppo!="") {
			$query_gp = DB::table('gruppi');
			$query_gp = $query_gp->select('nome');
			$query_gp = $query_gp->where('id', '=', $id_gruppo);
			$query_gp = $query_gp->get();
			
			$num_cp = $query_gp->count();
			$dammi2 = "";
			if($num_cp>0)
				$dammi2 = utf8_encode($query_gp[0]->nome);
			$this_page_path_ita .= $CustomController->to_htaccess_url($dammi2)."-".$id_gruppo;
			$this_page_path_eng .= $CustomController->to_htaccess_url($dammi2)."-".$id_gruppo;
		}
		
		if($prov!="") {
			$this_page_path_ita .= "/".$prov;
			$this_page_path_eng .= "/".$prov;
		}
		$this_page_path_ita .= ".html";
		$this_page_path_eng .= ".html";
		
		if (!isset($ric_offerte)) $ric_offerte="";
		if (!isset($ric_novita)) $ric_novita="";
		if (!isset($ric_nome)) $ric_nome="";
		if (!isset($ric_cat)) $ric_cat="";
		if (!isset($ric_sottocat)) $ric_sottocat="";
		if (!isset($ric_tag)) $ric_tag="";
		if (!isset($ord)) $ord="";
		
		$query_dett = DB::table('gruppi');
		$query_dett = $query_dett->select('*');
		$query_dett = $query_dett->where('id', '=', $id_gruppo);
		$query_dett = $query_dett->get();		
		
		$foto_dett = "m_".$query_dett[0]->immagine;
		$nome_dett = ucfirst($query_dett[0]->nome);
		$novita_dett = $query_dett[0]->novita_paben;
		
		$num_off_gr = 0;
		$query_off_gr = DB::table('prodotti');
		$query_off_gr = $query_off_gr->select('id');
		$query_off_gr = $query_off_gr->where('id_rife', '=', $id_gruppo);
		$query_off_gr = $query_off_gr->where('prezzo_offerta', '<>', '0.00000');
		$query_off_gr = $query_off_gr->get();
		$num_off_gr = $query_off_gr->count();
		
		if ($novita_dett=="1") $title_dett = ucfirst($nome_dett)." - ".ucfirst(str_replace("_"," ",$dammi1))." - ".ucfirst(str_replace("_"," ",$dammi))." - ".Lang::get("website.Dettaglio prodotto")." - ".Lang::get('website.novita menu')." - ".config('app.name');
		else $title_dett = ucfirst($nome_dett)." - ".ucfirst(str_replace("_"," ",$dammi1))." - ".ucfirst(str_replace("_"," ",$dammi))." - ".Lang::get("website.Dettaglio prodotto")." - ".Lang::get('website.profotti menu')." - ".config('app.name');
	
		$link_pag = "index.php?cmd=prodotti";
		if($ric_cat!="") $link_pag .= "&ric_cat=".$ric_cat;
		if($ric_sottocat!="") $link_pag .= "&ric_sottocat=".$ric_sottocat;
		if($ric_nome!="") $link_pag .= "&ric_nome=".$ric_nome;
		if($ric_cat!="") $link_pag .= "&ric_cat=".$ric_cat;
		if($ric_sottocat!="") $link_pag .= "&ric_sottocat=".$ric_sottocat;
		if($ric_nome!="") $link_pag .= "&ric_nome=".$ric_nome;
		if($ric_novita!="") $link_pag .= "&ric_novita=".$ric_novita;
		if($ric_offerte!="") $link_pag .= "&ric_offerte=".$ric_offerte;
		if($rec_pag!="") $link_pag .= "&rec_pag=".$rec_pag;
		if($ric_tag!="") $link_pag .= "&ric_tag=".$ric_tag;
		if($ord!="") $link_pag .= "&ord=".$ord;
		
		$metatag = array();
		$metatag['title'] = $title_dett;
		$metatag['description'] = Lang::get("website.Default description")." - ".ucfirst(str_replace("_"," ",$dammi))." - ".ucfirst(str_replace("_"," ",$dammi1))." - ".ucfirst($nome_dett);	
				
        
		$view = view("web.prodotti_dett");
		$view = $view->with('result', $result);
		$view = $view->with('metatag', $metatag);
		$view = $view->with('cmd', $cmd);	
		if($ric_novita!="") $view = $view->with('ric_novita', $ric_novita);
		$view = $view->with('ric_offerte', $ric_offerte);
		if($rec_pag!="") $view = $view->with('rec_pag', $rec_pag);
		if($pag_att!="") $view = $view->with('pag_att', $pag_att);
		if($ric_tag!="") $view = $view->with('ric_tag', $ric_tag);
		if($ric_cat!="") $view = $view->with('ric_cat', $ric_cat);
		if($dammi!="") $view = $view->with('dammi', $dammi);
		if($dammi1!="") $view = $view->with('dammi1', $dammi1);
		if($dammi2!="") $view = $view->with('dammi2', $dammi2);
		if($foto_dett!="") $view = $view->with('foto_dett', $foto_dett);
		if($title_dett!="") $view = $view->with('title_dett', $title_dett);
		if($prov!="") $view = $view->with('prov', $prov);
		if($ric_sottocat!="") $view = $view->with('ric_sottocat', $ric_sottocat);
		if($id_gruppo!="") $view = $view->with('id_gruppo', $id_gruppo);
		if($ric_nome!="") $view = $view->with('ric_nome', $ric_nome);
		if($ord!="") $view = $view->with('ord', $ord);	
		$view = $view->with('link_pag', $link_pag);	
		$view = $view->with('lingua', $lingua);
		$view = $view->with('mysidname', $mysidname);
		$view = $view->with('this_page_path_ita', $this_page_path_ita);
		$view = $view->with('this_page_path_eng', $this_page_path_eng);
        return $view;
	}
	
	
	public function ajaxListaProvince(Request $request)
    {
		$response = array(
		'status' => 'success',
		'msg' => $request->message,
		);
		if(isset($_GET['regione'])) $regione=$_GET['regione']; else $regione="";
		if(isset($_GET['ric_prov'])) $ric_prov=$_GET['ric_prov']; else $ric_prov="";
		
		$string='<label for="email">'.Lang::get('website.Provincia').'</label>';
		$string.='<select name="ric_prov" id="ric_prov">';
		$string.='<option value="">'.Lang::get('website.Seleziona Provincia').'</option>';
		
		if($regione!=""){
			$query_reg = DB::table('regioni');
			$query_reg = $query_reg->select('id_regione');
			$query_reg = $query_reg->where('regione', '=', $regione);
			$query_reg = $query_reg->get();
			
			$query_prov = DB::table('province');
			$query_prov = $query_prov->select('sigla', 'provincia');
			$query_prov = $query_prov->where('id_regione', '=', $query_reg[0]->id_regione);
			$query_prov = $query_prov->orderBy('sigla');
			$query_prov = $query_prov->get();
			
			foreach ($query_prov as $ket_prov=>$campo_prov){
				$string.='<option value="'.$campo_prov->sigla.'"';
				if((isset($ric_prov) && $campo_prov->sigla==$ric_prov)) $string.=' selected="selected"';
				$string.='>'.$campo_prov->provincia.' ('.$campo_prov->sigla.')</option>';
			}
		}
		
		$string.='</select>';
		
		return $string;
	}
	
	public function invioFormWellness(Request $request)
    {   
		$result = array();
		
		$CustomController = new CustomController();
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();	
		
        $cmd = "yccs-wellness-center";
        $pagina = "yccs_wellness_center";
		$bladeView="web.".$pagina;		
		
		//Genero link per passaggio di lingua		
		$this_page_path_ita = Config::get('app.url')."/yccs-porto-cervo/$cmd.html";
		$this_page_path_eng = Config::get('app.url')."/en/yccs-porto-cervo/$cmd.html";	

		$metatag = array();
		$metatag['title'] = Lang::get("website.$pagina title");
		$metatag['description'] = Lang::get("website.$pagina description");							
		
		if(isset($_POST['nome'])) $nome=$_POST['nome']; else $nome="";
		if(isset($_POST['cognome'])) $cognome=$_POST['cognome']; else $cognome="";
		if(isset($_POST['email'])) $email=$_POST['email']; else $email="";
		if(isset($_POST['telefono'])) $telefono=$_POST['telefono']; else $telefono="";
		if(isset($_POST['messaggio'])) $messaggio=$_POST['messaggio']; else $messaggio="";
		if(isset($_POST['stato'])) $stato=$_POST['stato']; else $stato="";
		$data=date("Y-m-d H:i:s");
		
		$secretKey = env('GOOGLE_RECAPTCHA_SECRET_KEY_V2');
		$response = $_POST['g-recaptcha-response'];     
		$remoteIp = $_SERVER['REMOTE_ADDR'];

		$reCaptchaValidationUrl = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response&remoteip=$remoteIp");
		$result = json_decode($reCaptchaValidationUrl, TRUE);				
				
		if($result['success'] == 1) {
			$mail_sito = env('APP_EMAIL');
			$ind_sito = env('APP_URL');
			$nome_del_sito = env('APP_NAME');
			$logo_sito = $ind_sito."/".env('APP_LOGO');
			
			include(base_path('resources/views/web/common/body_mail.css.php'));
			
			$dati = "";
			$dati_eng = "";
			if($nome!="") {
				$dati .= "<b>Nome:&nbsp;</b>$nome<br />";
				$dati_eng .= "<b>Name:&nbsp;</b>$nome<br />";
			}
			if($cognome!="") {
				$dati .= "<b>Cognome:&nbsp;</b>$cognome<br />";
				$dati_eng .= "<b>Surname:&nbsp;</b>$cognome<br />";
			}			
			if($email!="") {
				$dati .= "<b>Email:&nbsp;</b>$email<br />";
				$dati_eng .= "<b>Email:&nbsp;</b>$email<br />";
			}
			if($telefono!="") {
				$dati .= "<b>Telefono:&nbsp;</b>$telefono<br />";
				$dati_eng .= "<b>Phone:&nbsp;</b>$telefono<br />";
			}
			if($messaggio!="") {
				$dati .= "<b>Messaggio:&nbsp;</b>$messaggio<br />";
				$dati_eng .= "<b>Message:&nbsp;</b>$messaggio<br />";
			}
			
			$nome_cliente = ucfirst($nome);
			$cognome_cliente = ucfirst($cognome);
			
			$testo_azi ="
				<br><br><br>
				Un utente (<b>$cognome_cliente $nome_cliente</b>) ha inviato una richiesta dalla sezione Wellness Center
				<br><br>
				$dati
			";
			
			$testo_cli ="
				<br><br><br>
				Gentile <b>$cognome_cliente $nome_cliente</b> 
				<br><br>
				La sua richiesta e' stata ricevuta. Provvederemo al piu' presto a contattarla per la risposta.
				Di seguito trovera' i dati della sua richiesta:
				<br><br>
				$dati
				<br/><br/>
				Cordiali saluti,
			";
			$testo_cli_eng ="
				<br><br><br>
				Dear <b>$cognome_cliente $nome_cliente</b>
				<br><br>
				we have received your request. We will get back to you as soon as possible.
				Here below the details of you request:
				<br><br>
				$dati_eng
				<br/><br/>
				Best regards,
			";
			
			$body_azi = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_azi , $body);
			$oggetto_azi = "Richiesta Wellness Center";
			if($lingua=="ita"){
				$body_cli = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_cli, $body);			
				$oggetto_cli = "Grazie per averci contattato - Yccs Wellness Center & Spa";
			}
			else {
				$body_cli = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_cli_eng, $body);			
				$oggetto_cli = "Thanks for contacting us - Yccs Wellness Center & Spa";		
			}
			$MailController = new MailController();
			//sendMail($from_email, $from_name, $to_email, $to_name, $subject, $body, $file="")
			$invioMail_azi = $MailController->sendMail($mail_sito,$nome_del_sito,"wellness.center@yccs.it",$nome_del_sito, $oggetto_azi, $body_azi); 
			//$invioMail_azi = $MailController->sendMail($mail_sito,$nome_del_sito,"f.denegri@cwstudio.it",$nome_del_sito, $oggetto_azi, $body_azi); 
			$invioMail_cli = $MailController->sendMail($mail_sito,$nome_del_sito,$email,$nome_del_sito, $oggetto_cli, $body_cli); 
			
			if($invioMail_azi=="OK"){
				$message_color = "#81c868";
				$message = Lang::get("form_contatti.Email inviata con successo");"";				
			}else{
				$message_color = "red";
				$message = "Error_5!";
			}
		}else{
			$message_color = "red";
			$message = "Error_6!";				
		}
				
		$view = view("web.".$pagina);
		$view = $view->with('result', $result);
		$view = $view->with('metatag', $metatag);
		$view = $view->with('cmd', $cmd);
		$view = $view->with('pagina', $pagina);
		$view = $view->with('lingua', $lingua);
		if(isset($nome) && $nome!="") $view = $view->with('nome', $nome);
		if(isset($cognome) && $cognome!="") $view = $view->with('cognome', $cognome);
		if(isset($email) && $email!="") $view = $view->with('email', $email);
		if(isset($telefono) && $telefono!="") $view = $view->with('telefono', $telefono);
		if(isset($messaggio) && $messaggio!="") $view = $view->with('messaggio', $messaggio);
		$view = $view->with('this_page_path_ita', $this_page_path_ita);
		$view = $view->with('this_page_path_eng', $this_page_path_eng);
		$view = $view->with('message_color', $message_color);
		$view = $view->withErrors($message);
        return $view;
	}
	
	public function invioFormGiornalisti(Request $request)
    {  
		$result = array();
		
		$CustomController = new CustomController();
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();	
		
        $cmd = "registrazione-giornalisti";
        $pagina = "registrazione_giornalisti";
		$bladeView="web.".$pagina;		
		
		//Genero link per passaggio di lingua		
		$this_page_path_ita = Config::get('app.url')."/$cmd.html";
		$this_page_path_eng = Config::get('app.url')."/en/$cmd.html";	

		$metatag = array();
		$metatag['title'] = Lang::get("website.$pagina title");
		$metatag['description'] = Lang::get("website.$pagina description");							
		
		if(isset($_POST['nome'])) $nome = $_POST['nome']; else $nome = "";
		if(isset($_POST['cognome'])) $cognome = $_POST['cognome']; else $cognome = "";
		if(isset($_POST['pubblicazione'])) $pubblicazione = $_POST['pubblicazione']; else $pubblicazione = "";
		if(isset($_POST['regata'])) $regata = $_POST['regata']; else $regata = "";
		if(isset($_POST['indirizzo'])) $indirizzo = $_POST['indirizzo']; else $indirizzo = "";
		if(isset($_POST['cap'])) $cap = $_POST['cap']; else $cap = "";
		if(isset($_POST['paese'])) $paese = $_POST['paese']; else $paese = "";
		if(isset($_POST['ruolo'])) $ruolo = $_POST['ruolo']; else $ruolo = "";
		if(isset($_POST['comunicazioni'])) $comunicazioni = $_POST['comunicazioni']; else $comunicazioni = "";
		if(isset($_POST['data_arrivo'])) $data_arrivo = $_POST['data_arrivo']; else $data_arrivo = "";
		if(isset($_POST['data_partenza'])) $data_partenza = $_POST['data_partenza']; else $data_partenza = "";
		if(isset($_POST['barca_stampa'])) $barca_stampa = $_POST['barca_stampa']; else $barca_stampa = "";
		if(isset($_POST['giornate'])) $giornate = $_POST['giornate']; else $giornate = "";
		if(isset($_POST['email'])) $email = $_POST['email']; else $email = "";
		if(isset($_POST['email2'])) $email2 = $_POST['email2']; else $email2 = "";
		if(isset($_POST['telefono'])) $telefono = $_POST['telefono']; else $telefono = "";
		if(isset($_POST['cellulare'])) $cellulare = $_POST['cellulare']; else $cellulare = "";
		if(isset($_POST['fax'])) $fax = $_POST['fax']; else $fax = "";
		if(isset($_POST['privacy'])) $privacy=$_POST['privacy']; else $privacy="0";
		
		$secretKey = env('GOOGLE_RECAPTCHA_SECRET_KEY_V2');
		$response = $_POST['g-recaptcha-response'];     
		$remoteIp = $_SERVER['REMOTE_ADDR'];

		$reCaptchaValidationUrl = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response&remoteip=$remoteIp");
		$result = json_decode($reCaptchaValidationUrl, TRUE);				
				
		if($result['success'] == 1) {
			$mail_sito = env('APP_EMAIL');
			$ind_sito = env('APP_URL');
			$nome_del_sito = env('APP_NAME');
			$logo_sito = $ind_sito."/".env('APP_LOGO');
			
			include(base_path('resources/views/web/common/body_mail.css.php'));
			
			$dati = "";
			$dati_eng = "";
			if($regata!="") {
				$dati .= "<b>Regata:&nbsp;</b>$regata<br />";
				$dati_eng .= "<b>Regatta:&nbsp;</b>$regata<br />";
			}
			if($nome!="") {
				$dati .= "<b>Nome:&nbsp;</b>$nome<br />";
				$dati_eng .= "<b>Name:&nbsp;</b>$nome<br />";
			}
			if($cognome!="") {
				$dati .= "<b>Cognome:&nbsp;</b>$cognome<br />";
				$dati_eng .= "<b>Surname:&nbsp;</b>$cognome<br />";
			}
			if($pubblicazione!="") {
				$pubblicazione = stripslashes($_POST['pubblicazione']);
				$dati .= "<b>Testata:&nbsp;</b>$pubblicazione<br />";
				$dati_eng .= "<b>Company name:&nbsp;</b>$pubblicazione<br />";
			}	
			if($indirizzo!="") {
				$indirizzo = stripslashes($_POST['indirizzo']);
				$dati .= "<b>Indirizzo:&nbsp;</b>$indirizzo<br />";
				$dati_eng .= "<b>Address:&nbsp;</b>$indirizzo<br />";
			}		
			if($cap!="") {
				$dati .= "<b>Cap:&nbsp;</b>$cap<br />";
				$dati_eng .= "<b>Postcode:&nbsp;</b>$cap<br />";
			}		
			if($paese!="") {
				$dati .= "<b>Paese di Residenza:&nbsp;</b>$paese<br />";
				$dati_eng .= "<b>Country of Residence:&nbsp;</b>$paese<br />";
			}		
			if($ruolo!="") {
				$dati .= "<b>Ruolo:&nbsp;</b>$ruolo<br />";
				$dati_eng .= "<b>Occupation:&nbsp;</b>$ruolo<br />";
			}		
			if($comunicazioni!="") {
				$dati .= "<b>Vorrei ricevere i comunicati stampa  per questo e per altri eventi YCCS:&nbsp;</b>$comunicazioni<br />";
				$dati_eng .= "<b>I would like to receive YCCS press releases for this and other events:&nbsp;</b>$comunicazioni<br />";
			}		
			if($data_arrivo!="") {
				$dati .= "<b>Giorno di arrivo:&nbsp;</b>$data_arrivo<br />";
				$dati_eng .= "<b>Arrival Date:&nbsp;</b>$data_arrivo<br />";
			}		
			if($data_partenza!="") {
				$dati .= "<b>Giorno di partenza:&nbsp;</b>$data_partenza<br />";
				$dati_eng .= "<b>Departure Date:&nbsp;</b>$data_partenza<br />";
			}		
			if($barca_stampa!="") {
				$dati .= "<b>Richiesta barca stampa:&nbsp;</b>$barca_stampa<br />";
				$dati_eng .= "<b>Request press boat:&nbsp;</b>$barca_stampa<br />";
			}		
			if($giornate!="") {
				$dati .= "<b>Specificare per quali giornate si ha necessità della barca stampa:&nbsp;</b>$giornate<br />";
				$dati_eng .= "<b>Specify for which days you need the press boat:&nbsp;</b>$giornate<br />";
			}			
			if($email!="") {
				$dati .= "<b>Email:&nbsp;</b>$email<br />";
				$dati_eng .= "<b>Email:&nbsp;</b>$email<br />";
			}		
			if($email2!="") {
				$dati .= "<b>E-mail 2:&nbsp;</b>$email2<br />";
				$dati_eng .= "<b>E-mail 2:&nbsp;</b>$email2<br />";
			}
			if($telefono!="") {
				$dati .= "<b>Tel. (Uff.):&nbsp;</b>$telefono<br />";
				$dati_eng .= "<b>Phone:&nbsp;</b>$telefono<br />";
			}
			if($cellulare!="") {
				$dati .= "<b>Tel. (Cell.):&nbsp;</b>$cellulare<br />";
				$dati_eng .= "<b>Tel. Mobile:&nbsp;</b>$cellulare<br />";
			}
			if($fax!="") {
				$dati .= "<b>Fax:&nbsp;</b>$fax<br />";
				$dati_eng .= "<b>Fax:&nbsp;</b>$fax<br />";
			}
			
			$nome_cliente = ucfirst($nome);
			$cognome_cliente = ucfirst($cognome);
			
			$testo_azi ="
				<br><br><br>
				Report di Notifica del sito Web - Un utente (<b>$cognome_cliente $nome_cliente</b>) ha inviato una richiesta di registrazione (come Giornalista) dalla sezione <b>'Ufficio Stampa'</b>:
				<br><br>
				$dati
			";
			
			$testo_cli ="
				<br><br><br>
				Gentile <b>$cognome_cliente $nome_cliente</b> 
				<br><br>
				La sua richiesta è stata ricevuta: provvederemo al più presto a contattarla in risposta.
				Questi sono i dati che ha fornito:
				<br><br>
				$dati
				<br/><br/>
				Distinti saluti,
			";
			$testo_cli_eng ="
				<br><br><br>
				Dear <b>$cognome_cliente $nome_cliente</b>
				<br><br>
				We're glad to inform you we receive your info request and will contact you to respond to you as soon as possible.
				You can read a copy of the data we received here following:
				<br><br>
				$dati_eng
				<br/><br/>
				Best regards,
			";
			
			$body_azi = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_azi , $body);
			$oggetto_azi = "Registrazione Giornalisti dal sito";
			if($lingua=="ita"){
				$body_cli = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_cli, $body);			
				$oggetto_cli = "Conferma Registrazione Giornalisti";
			}
			else {
				$body_cli = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_cli_eng, $body);			
				$oggetto_cli = "Thank you for taking the time to contact us";		
			}
			$MailController = new MailController();
			//sendMail($from_email, $from_name, $to_email, $to_name, $subject, $body, $file="")
		//	$invioMail_azi = $MailController->sendMail($mail_sito,$nome_del_sito,"f.denegri@cwstudio.it",$nome_del_sito, $oggetto_azi, $body_azi); 
			$invioMail_azi = $MailController->sendMail($mail_sito,$nome_del_sito,"pressoffice@yccs.it",$nome_del_sito, $oggetto_azi, $body_azi); 
			$invioMail_cli = $MailController->sendMail($mail_sito,$nome_del_sito,$email,$nome_del_sito, $oggetto_cli, $body_cli); 
			
			if($invioMail_azi=="OK"){
				$message_color = "#81c868";
				$message = Lang::get("form_contatti.Email inviata con successo");"";				
			}else{
				$message_color = "red";
				$message = "Error_7!";
			}
		}else{
			$message_color = "red";
			$message = "Error_8!";				
		}
				
		$view = view("web.".$pagina);
		$view = $view->with('result', $result);
		$view = $view->with('metatag', $metatag);
		$view = $view->with('cmd', $cmd);
		$view = $view->with('pagina', $pagina);
		$view = $view->with('lingua', $lingua);
		if(isset($nome) && $nome!="") $view = $view->with('nome', $nome);
		if(isset($cognome) && $cognome!="") $view = $view->with('cognome', $cognome);
		if(isset($pubblicazione) && $pubblicazione!="") $view = $view->with('pubblicazione', $pubblicazione);
		if(isset($regata) && $regata!="") $view = $view->with('regata', $regata);
		if(isset($indirizzo) && $indirizzo!="") $view = $view->with('indirizzo', $indirizzo);
		if(isset($cap) && $cap!="") $view = $view->with('cap', $cap);
		if(isset($paese) && $paese!="") $view = $view->with('paese', $paese);
		if(isset($email) && $email!="") $view = $view->with('email', $email);
		if(isset($email2) && $email2!="") $view = $view->with('email2', $email2);
		if(isset($telefono) && $telefono!="") $view = $view->with('telefono', $telefono);
		if(isset($cellulare) && $cellulare!="") $view = $view->with('cellulare', $cellulare);
		if(isset($fax) && $fax!="") $view = $view->with('fax', $fax);
		if(isset($privacy) && $privacy!="") $view = $view->with('privacy', $privacy);
		$view = $view->with('this_page_path_ita', $this_page_path_ita);
		$view = $view->with('this_page_path_eng', $this_page_path_eng);
		$view = $view->with('message_color', $message_color);
		$view = $view->withErrors($message);
        return $view;
	}
	
	public function invioFormReservation(Request $request)
    {  
		$result = array();
		
		$CustomController = new CustomController();
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();	
		
        $cmd = "reservation-request";
        $pagina = "reservation-request";
		$bladeView="web.".$pagina;		
		
		//Genero link per passaggio di lingua		
		$this_page_path_ita = Config::get('app.url')."/$cmd.html";
		$this_page_path_eng = Config::get('app.url')."/en/$cmd.html";	

		$metatag = array();
		$metatag['title'] = "Reservation Request Confirmation - ".config('app.name');
		$metatag['description'] = config('app.name')." - Reservation Request Confirmation";				
		
		foreach($_POST AS $key=>$value){
			$$key=$value;
		}
		
		$club = "";
		if(isset($_POST['yccs'])) {$yccs = $_POST['yccs'];} else{$yccs = "off";}
		if ($yccs=="on") $club .= "YCCS"; 
		
		if(isset($_POST['nyyc'])) {$nyyc = $_POST['nyyc'];} else{$nyyc = "off";}
		if ($nyyc=="on" && $club!="") $club .= " - NYYC"; elseif ($nyyc=="on") $club .= "NYYC"; 
		
		if(isset($_POST['ycm'])) {$ycm = $_POST['ycm'];} else{$ycm = "off";}
		if ($ycm=="on" && $club!="") $club .= " - YCM"; elseif ($ycm=="on") $club .= "YCM"; 
		
		if(isset($_POST['regatta'])) {$regatta = $_POST['regatta'];} else{$regatta = "off";}
		if ($regatta=="on" && $club!="") $club .= " - REGATTA"; elseif ($regatta=="on") $club .= "REGATTA"; 
		
		
		$type = "";
		if(isset($_POST['owner'])) {$owner = $_POST['owner'];} else{$owner = "off";}
		if ($owner=="on") $type .= "OWNER"; 
		
		if(isset($_POST['company'])) {$company = $_POST['company'];} else{$company = "off";}
		if ($company=="on" && $type!="") $type .= " - COMPANY"; elseif ($company=="on") $type .= "COMPANY"; 
		
		if(isset($_POST['captain'])) {$captain = $_POST['captain'];} else{$captain = "off";}
		if ($captain=="on" && $type!="") $type .= " - CAPTAIN"; elseif ($captain=="on") $type .= "CAPTAIN"; 
		
		
		$shore = "";
		if(isset($_POST['amp16'])) {$amp16 = $_POST['amp16'];} else{$amp16 = "off";}
		if ($amp16=="on") $shore .= "16 AMP"; 
		
		if(isset($_POST['amp32'])) {$amp32 = $_POST['amp32'];} else{$amp32 = "off";}
		if ($amp32=="on" && $shore!="") $shore .= " - 32 AMP"; 	elseif ($amp32=="on") $shore .= "32 AMP"; 
		
		if(isset($_POST['v230'])) {$v230 = $_POST['v230'];} else{$v230 = "off";}
		if ($v230=="on" && $shore!="") $shore .= " - 230v"; elseif ($v230=="on") $shore .= "230v"; 
		
		if(isset($_POST['v320'])) {$v320 = $_POST['v320'];} else{$v320 = "off";}
		if ($v320=="on" && $shore!="") $shore .= " - 320v"; elseif ($v320=="on") $shore .= "320v"; 
			
		
		$secretKey = env('GOOGLE_RECAPTCHA_SECRET_KEY_V2');
		$response = $_POST['g-recaptcha-response'];     
		$remoteIp = $_SERVER['REMOTE_ADDR'];

		$reCaptchaValidationUrl = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response&remoteip=$remoteIp");
		$result = json_decode($reCaptchaValidationUrl, TRUE);				
				
		if($result['success'] == 1) {
			$mail_sito = env('APP_EMAIL');
			$ind_sito = env('APP_URL');
			$nome_del_sito = env('APP_NAME');
			$logo_sito = $ind_sito."/".env('APP_LOGO');
			
			include(base_path('resources/views/web/common/body_mail.css.php'));
			
			$dati = "";
			$dati_eng = "";
			if(isset($name) && $name!="") {
				$dati .= "<b>Vessel Name:&nbsp;</b>$name<br />";
			}
			if(isset($model) && $model!="") {
				$dati .= "<b>Vessel Model:&nbsp;</b>$model<br />";
			}
			if(isset($flag) && $flag!="") {
				$dati .= "<b>Vessel Flag:&nbsp;</b>$flag<br />";
			}
			if(isset($loa) && $loa!="") {
				$dati .= "<b>L.O.A.:&nbsp;</b>$loa<br />";
			}	
			if(isset($beam) && $beam!="") {
				$dati .= "<b>Beam:&nbsp;</b>$beam<br />";
			}		
			if(isset($draft) && $draft!="") {
				$dati .= "<b>Draft:&nbsp;</b>$draft<br />";
			}		
			if((isset($_POST['yccs']) && $_POST['yccs']!="off") || (isset($_POST['nyyc']) && $_POST['nyyc']!="off") || (isset($_POST['ycm']) && $_POST['ycm']!="off") || (isset($_POST['regatta']) && $_POST['regatta']!="off"))
			{	
				$dati .= "<b>Club Member:&nbsp;</b>$club<br />";
			}			
			if((isset($_POST['owner']) && $_POST['owner']!="off") || (isset($_POST['company']) && $_POST['company']!="off") || (isset($_POST['captain']) && $_POST['captain']!="off"))
			{
				$dati .= "<b>Name and Surname:&nbsp;</b>$surname<br />";
			}		
			if(isset($type) && $type!="") {
				$dati .= "<b>></b>$type<br />";
			}
			if(isset($phone) && $phone!="") {
				$dati .= "<b>Contact Number:&nbsp;</b>$phone<br />";
			}
			if(isset($email) && $email!="") {
				$dati .= "<b>Contact Email Address:&nbsp;</b>$email<br />";
			}
			if(isset($arrival) && $arrival!="") {
				$dati .= "<b>Arrival Date:&nbsp;</b>$arrival<br />";
			}
			if(isset($departure) && $departure!="") {
				$dati .= "<b>Departure Date:&nbsp;</b>$departure<br />";
			}
			if(isset($address) && $address!="") {
				$address = stripslashes($address);
				$dati .= "<b>Billing Address (For non-members only):&nbsp;</b>$address<br />";
			}
			if(isset($town) && $town!="") {
				$town = stripslashes($town);
				$dati .= "<b>Town:&nbsp;</b>$town<br />";
			}
			if(isset($region) && $region!="") {
				$region = stripslashes($region);
				$dati .= "<b>Region/State:&nbsp;</b>$region<br />";
			}
			if(isset($zipcode) && $zipcode!="") {
				$dati .= "<b>Zip Code:&nbsp;</b>$zipcode<br />";
			}
			if(isset($country) && $country!="") {
				$dati .= "<b>Country:&nbsp;</b>$country<br />";
			}
			if((isset($_POST['amp16']) && $_POST['amp16']!="off") || (isset($_POST['amp32']) && $_POST['amp32']!="off") || (isset($_POST['v230']) && $_POST['v230']!="off") || (isset($_POST['v320']) && $_POST['v320']!="off"))
			{
				$dati .= "<b>Shore Power Options:&nbsp;</b>$shore<br />";
			}
			if(isset($note) && $note!="") {
				$region = stripslashes($note);
				$dati .= "<b>Special Requests/Comments:&nbsp;</b>$note<br />";
			}
			$dati_eng = $dati;
			
			$cognome_cliente = ucfirst($surname);
			
			$testo_azi ="
				<br><br><br>
				Report di Notifica del sito Web - Un Utente ha inviato una richiesta dalla sezione <b>'Centro Sportivo'</b>:
				<br><br>
				$dati
			";
			
			$testo_cli ="
				<br><br><br>
				Gentile <b>$cognome_cliente</b> 
				<br><br>
				La sua richiesta è stata ricevuta: provvederemo al più presto a contattarla in risposta.
				Questi sono i dati che ha fornito:
				<br><br>
				$dati
				<br/><br/>
				Distinti saluti,
			";
			$testo_cli_eng ="
				<br><br><br>
				Dear <b>$cognome_cliente</b>
				<br><br>
				We're glad to inform you we receive your request and will contact you to respond to you as soon as possible.
				You can read a copy of the data we received here following:
				<br><br>
				$dati_eng
				<br/><br/>
				Best regards,
			";
			
			$body_azi = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_azi , $body);
			$oggetto_azi = "Richiesta di prenotazione dal sito";
			if($lingua=="ita"){
				$body_cli = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_cli, $body);			
				$oggetto_cli = "Grazie per averci contattato";
			}
			else {
				$body_cli = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_cli_eng, $body);			
				$oggetto_cli = "Thank you for taking the time to contact us";		
			}
			$MailController = new MailController();
			//sendMail($from_email, $from_name, $to_email, $to_name, $subject, $body, $file="")
			//$invioMail_azi = $MailController->sendMail($mail_sito,$nome_del_sito,"f.denegri@cwstudio.it",$nome_del_sito, $oggetto_azi, $body_azi); 
			$invioMail_azi = $MailController->sendMail($mail_sito,$nome_del_sito,"centrosportivo@yccs.it",$nome_del_sito, $oggetto_azi, $body_azi); 
			$invioMail_cli = $MailController->sendMail($mail_sito,$nome_del_sito,$email,$nome_del_sito, $oggetto_cli, $body_cli); 
			
			if($invioMail_azi=="OK"){
				$message_color = "#81c868";
				$message = Lang::get("Email inviata con successo");"";				
			}else{
				$message_color = "red";
				$message = "Error_9!";
			}
		}else{
			$message_color = "red";
			$message = "Error_10!";				
		}
				
		$view = view("web.area_soci.".$pagina);
		$view = $view->with('result', $result);
		$view = $view->with('metatag', $metatag);
		$view = $view->with('cmd', $cmd);
		$view = $view->with('pagina', $pagina);
		$view = $view->with('lingua', $lingua);
		foreach($_POST AS $key=>$value){
			$view = $view->with($key, $value);
		}
		$view = $view->with('this_page_path_ita', $this_page_path_ita);
		$view = $view->with('this_page_path_eng', $this_page_path_eng);
		$view = $view->with('message_color', $message_color);
		$view = $view->withErrors($message);
        return $view;
	}
	
	
	
	
	
	
	
	public function recupero_password()
    {
        $result = array();
        $result['commonContent'] = $this->index->commonContent();
		
		$CustomController = new CustomController();
		// recupero lingua corrente	
		$lingua = $CustomController->checkLanguage();		
		
        $cmd="login-registrati";
		$metatag = array();
		$metatag['title'] = Lang::get("website.Login/Registrati title");
		$metatag['description'] = Lang::get("website.Login/Registrati description");				
		
		//Genero link per passaggio di lingua		
		$this_page_path_ita = Config::get('app.url')."/login-registrati.html";
		$this_page_path_eng = Config::get('app.url')."/uk/login-sign-up.html";	

		if(isset($_POST['stato_recupera']) && $_POST['stato_recupera']=="inviato") {
			if(isset($_POST['email_rec'])) $email_rec = $_POST['email_rec']; else $email_rec = "";
			
			$query = DB::table('iscritti');
            $query = $query->select('*');
			$query = $query->where('email', '=', $email_rec);
            //dd($query->toSql(), $query->getBindings());
			$query = $query->get();
			$num_email = $query->count();	
			
			if($num_email>0){
				$nome_rec=$query[0]->ragione_sociale;
				$user_rec=$query[0]->username;
				$pswd_rec=$query[0]->password;
				
				$mail_sito = env('APP_EMAIL');
				$ind_sito = env('APP_URL');
				$nome_del_sito = env('APP_NAME');
				$logo_sito = $ind_sito."/".env('APP_LOGO');
				
				include(base_path('resources/views/web/common/body_mail.css.php'));
				
				$testo_cli ="<p class=\"menu\">
								<b>Gentile&nbsp;$nome_rec</b>,<br />
								qui di seguito ti riportiamo i dati che gi&agrave; ti permettono di accedere alla tua area riservata ed acquistare i nostri prodotti.
								<br/><br/>
								Username: $user_rec<br/>
								Password: $pswd_rec
								<br/><br/>Distinti saluti,
							</p>";
				$testo_cli_eng ="<p class=\"menu\">
								<b>Dear&nbsp;$nome_rec</b>,<br />
								below you can find the credentials that already allow you to access your reserved area and buy our products.
								<br/><br/>
								Username: $user_rec<br/>
								Password: $pswd_rec
								<br/><br/>
							</p>";
				
				
				if($lingua=="ita"){
					$body_cli = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_cli, $body);			
					$oggetto_cli = "Recupera dati";
				}
				else {
					$body_cli = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_cli_eng, $body);			
					$oggetto_cli = "Forgot your password?";		
				}
				$MailController = new MailController();
				$invioMail_cli = $MailController->sendMail($mail_sito,$nome_del_sito,$email_rec,$nome_del_sito, $oggetto_cli, $body_cli); 
				
				if($invioMail_cli=="OK"){
					$message_color = "#81c868";
					if($lingua=="ita") $message = "Email inviata con successo!";				
					else $message = "Email successfully sent!";				
				}else{
					$message_color = "red";
					$message = "Error_11! ".$invioMail_cli;				
				}
			}else{
				$message_color = "red";
				if($lingua=="ita") $message = "L'email non è presente nel nostro database!";				
				else $message = "The email is not in our database!";				
			}
		}
		
        
		$view = view("web.login-registrati");
		$view = $view->with('result', $result);
		$view = $view->with('metatag', $metatag);
		$view = $view->with('cmd', $cmd);
		$view = $view->with('lingua', $lingua);
		$view = $view->with('this_page_path_ita', $this_page_path_ita);
		$view = $view->with('this_page_path_eng', $this_page_path_eng);
		$view = $view->with('message_color', $message_color);
		$view = $view->withErrors($message);
        return $view;
    }
	
	public function indexError(Request $request, $cmd)
	{
		return $this->index($request, $cmd="404");
	}
	
	
	
    public function maintance()
    {
        return view('errors.maintance');
    }

    public function error()
    {
        return view('errors.general_error', ['msg' => $msg]);
    }
    
    //setcookie
    public function setcookie(Request $request)
    {
        Cookie::queue('cookies_data', 1, 4000);
        return json_encode(array('accept'=>'yes'));
    }

    //setsession
    public function setSession(Request $request){
        session(['device_id'=>$request->device_id]);
        
    }
    

}
 