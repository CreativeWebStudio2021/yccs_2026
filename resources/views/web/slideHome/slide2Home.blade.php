@include('web.slideHome.assets.slide2Home_css')

<style>
	#slide2Home{
		width:calc(100% - 200px);
		margin-left:100px;
		/* height:100vh; */
		display:flex;
		position:relative;
	}
	@media screen AND (max-width:1024px){
		#slide2Home{
			width:calc(100% - 40px);
			margin-left:20px;
		}
	}
	@media screen AND (max-width:850px){
		#slide2Home{
			flex-direction: column;
		}
		#slide2Home > div:last-of-type{
			width: 100%;
			flex: 0 0 auto;
		}
		#slide2Home > div:last-of-type > div:first-of-type{
			padding: 30px 10px 0;
		}
	}
</style>
<div id="slide2Home" class="bgGrey">
	<div style="flex:1">
		<div style="padding:37px 20px 0px 29px;">
			@php
					// HERO: prendo la più recente tra news e stampa, e la userò anche per escluderla dal carosello
					$heroLink = "";
					$heroTitle = "";
					$heroAnte = "https://www.yccs.it/web/images/testate/ufficio_stampa.jpg";
					$heroDate = "";
					$heroText = "";

					function extractYoutubeIdSlide2Hero($url) {
						$url = trim((string)$url);
						if ($url === "") return "";
						if (preg_match('~[?&]v=([a-zA-Z0-9_-]{11})~', $url, $m)) return $m[1];
						if (preg_match('~youtu\\.be/([a-zA-Z0-9_-]{11})~', $url, $m)) return $m[1];
						if (preg_match('~youtube\\.com/(?:embed|v)/([a-zA-Z0-9_-]{11})~', $url, $m)) return $m[1];
						if (preg_match('~^[a-zA-Z0-9_-]{11}$~', $url)) return $url;
						return "";
					}

					$dir_up = "resarea/img_up";

					$query_newsHero = DB::table('news')
						->select('*')
						->where('covid', '=', '0')
						->where('news', '=', '1');
					if($lingua=="eng") $query_newsHero = $query_newsHero->where('titolo_eng', '<>', '');
					$query_newsHero = $query_newsHero->orderBy('data_news', 'DESC')
						->limit(1)
						->first();

					$query_stampaHero = DB::table('stampa')
						->where('visibile', '1');
					if($lingua=="eng") $query_stampaHero = $query_stampaHero->where('titolo_eng', '<>', "''");
					$query_stampaHero = $query_stampaHero->orderBy('data_stampa', 'DESC')
						->limit(1)
						->first();

					$newsTs = ($query_newsHero && !empty($query_newsHero->data_news)) ? strtotime($query_newsHero->data_news) : 0;
					$stampaTs = ($query_stampaHero && !empty($query_stampaHero->data_stampa)) ? strtotime($query_stampaHero->data_stampa) : 0;

					// Scegli quello più recente
					if ($stampaTs > 0 && ($newsTs == 0 || $stampaTs >= $newsTs)) {
						// HERO STAMPA
						$heroTitle = ucfirst($lingua=="ita" && !empty($query_stampaHero->titolo) ? $query_stampaHero->titolo : $query_stampaHero->titolo_eng);
						$heroDate = convertDateFormat($query_stampaHero->data_stampa,"Y-m-d","d/m/Y");
						$descrRaw = $lingua=="ita" ? ($query_stampaHero->descr ?? '') : ($query_stampaHero->descr_eng ?? ($query_stampaHero->descr ?? ''));
						$heroText = substr(strip_tags((string)$descrRaw),0,200);

						$heroLink = ($lingua=="eng" ? "en/" : "") . "press/" . creaSlug($heroTitle,"") . "-" . $query_stampaHero->id . ".html";

						// immagine o anteprima youtube
						if (!empty($query_stampaHero->img)) {
							$heroAnte = "$dir_up/stampa/".$query_stampaHero->img;
						} elseif (!empty($query_stampaHero->video)) {
							$ytId = extractYoutubeIdSlide2Hero($query_stampaHero->video);
							if (!empty($ytId)) $heroAnte = "https://img.youtube.com/vi/".$ytId."/hqdefault.jpg";
						}
					} elseif ($query_newsHero) {
						// HERO NEWS
						$heroTitle = ucfirst($lingua=="ita" && !empty($query_newsHero->titolo) ? $query_newsHero->titolo : $query_newsHero->titolo_eng);

						$heroLink = "";
						if($lingua=="eng") $heroLink.="en/";
						$heroLink.="news-pag".$pag_att."/";
						if($lingua=="ita" && !empty($query_newsHero->titolo)) $heroLink.=creaSlug($query_newsHero->titolo,"");
						else $heroLink.=creaSlug($query_newsHero->titolo_eng,"");
						$heroLink.="-".$query_newsHero->id.".html";

						$img = "";
						if(!empty($query_newsHero->img)) {
							$img = "$dir_up/".$query_newsHero->img;
						} else {
							$temp=explode('src="',$query_newsHero->testo ?: $query_newsHero->testo_eng);
							if(count($temp)>1){
								$temp2=explode('"',$temp[1]);
								$img=$temp2[0];
							}
						}
						if (!empty($img)) {
							if (str_starts_with($img, 'http')) $heroAnte = $img;
							else $heroAnte = file_exists(public_path()."/$img") ? $img : "https://www.yccs.it/$img";
						}

						$heroDate = convertDateFormat($query_newsHero->data_news,"Y-m-d","d/m/Y");
						$newsTextRaw = $lingua=="ita" ? ($query_newsHero->testo ?? '') : ($query_newsHero->testo_eng ?? ($query_newsHero->testo ?? ''));
						$heroText = substr(strip_tags((string)$newsTextRaw),0,200);
					}
				@endphp
			<a href="{{ $heroLink }}" title="{{ $heroTitle }} - News - {{ config('app.name') }}">
				<div class="news-hero-container">
					<div style="position:absolute; width:100%; height:100%; top:0; left:0; background:rgba(0,0,0,0.3); z-index:1"></div>
				    <img src="{{ $heroAnte }}" alt="" class="news-hero-image" />
				    <div class="news-hero-content" style="z-index:2">
						<div class="news-hero-date">{{ $heroDate }}</div>
						<div class="news-hero-title news-hero-title-w">
							{{ $heroTitle }}
						</div>
						<div class="news-hero-text">
							{!! $heroText !!}...
						</div>
				    </div>
				</div>
			</a>
			<style>
				#newsTitleContainer{
					display:flex;
					justify-content:space-between;
				}
				.gradient-title{
					margin:0;
					padding:0;
					margin-bottom:30px;
					font-weight:100;
				}
				#newsLinkArrow{
					width:145px;
					margin-top:12px;
					margin-right:20px;
					justify-content:space-between;
				}	
				@media screen AND (max-width:500px){
					#newsTitleContainer{
						flex-direction: column;
						justify-content:start;
						align-items:start;
						gap:0px;
					}
					.gradient-title{
						margin-bottom:0px;
						margin-left:-5px;
					}	
				}
			</style>
			<div id="newsTitleContainer">
				<h3 class="gradient-title">
					NEWS
				</h3>
				<a href="{{ ($lingua=='eng' || $lingua=='en') ? 'en/' : '' }}news.html" class="link-arrow" id="newsLinkArrow" title="{{ ($lingua=='eng' || $lingua=='en') ? 'All news' : 'Tutte le news' }}">
					<span>
						@if($lingua=='eng' || $lingua=='en')
							All news
						@else 
							Tutte le news 
						@endif</span>
					<img src="{{ asset('web/images/arrow.png') }}" alt="freccia" class="arrow-img"/>
				</a>
			</div>
			<div style="font-size:29px; margin-top:20px;">
				@if($lingua=='eng' || $lingua=='en')
					Stay updated on the sailing world!
				@else 
					Resta aggiornato sul mondo della vela! 
				@endif
			</div>
			<div style="font-size:20px; margin-top:12px;">
				@if($lingua=='eng' || $lingua=='en')	
					Discover the latest news, events, races and insights from the sailing scene.
				@else 
					Scopri le ultime novità, eventi, regate e curiosità dal panorama velico. 
				@endif
			</div>
		</div>
	</div>
	
	@php
	$query_news = DB::table('news')
		->where('covid', '0')
		->where('news', '1')
		->when($lingua == 'eng', fn($q) => $q->where('titolo_eng', '<>', ''))
		->orderBy('data_news', 'DESC')
		->offset(0) // l'esclusione dell'hero avviene dopo (via $heroLink), non qui
		->limit(20)
		->get();

	$query_stampa = DB::table('stampa')
		->where('visibile', '1')
		->when($lingua == 'eng', function($q) {
			return $q->where('titolo_eng', '<>', "''");
		})
		->orderBy('data_stampa', 'DESC')
		->limit(20)
		->get();
	@endphp

	@php
		function parseNewsItem($item, $lingua, $pag_att) {
			$dir = "resarea/img_up";
			$titolo = ucfirst($lingua == 'ita' && $item->titolo ? $item->titolo : $item->titolo_eng);
			
			$link = ($lingua == 'eng' ? 'en/' : '') . "news-pag{$pag_att}/";
			$slug = $lingua == 'ita' && $item->titolo ? creaSlug($item->titolo, '') : creaSlug($item->titolo_eng, '');
			$link .= "{$slug}-{$item->id}.html";
			
			$img = '';
			if (!empty($item->img)) {
				$img = "$dir/{$item->img}";
			} else {
				preg_match('/src="([^"]+)"/', $item->testo ?: $item->testo_eng, $matches);
				$img = $matches[1] ?? '';
			}

			if (empty($img)) return null;

			$anteprima = str_starts_with($img, 'http') ? $img : "https://www.yccs.it/$img";
			if (empty($anteprima)) return null;

			$data = '';
			if (!empty($item->data_news)) {
				$data = convertDateFormat($item->data_news, 'Y-m-d', 'd/m/Y');
			}

			$data_ts = !empty($item->data_news) ? strtotime($item->data_news) : 0;
			$testoRaw = $lingua == 'ita' ? ($item->testo ?? '') : ($item->testo_eng ?? ($item->testo ?? ''));
			$testo = substr(strip_tags($testoRaw), 0, 100) . '...';

			return [
				'titolo' => $titolo,
				'link' => $link,
				'img' => $anteprima,
				'testo' => $testo,
				'data' => $data,
				'data_ts' => $data_ts,
			];
		}

		function extractYoutubeId($videoUrl) {
			$videoUrl = trim((string)$videoUrl);
			if ($videoUrl === '') return '';

			// v=VIDEOID
			if (preg_match('~[?&]v=([a-zA-Z0-9_-]{11})~', $videoUrl, $m)) return $m[1];
			// youtu.be/VIDEOID
			if (preg_match('~youtu\\.be/([a-zA-Z0-9_-]{11})~', $videoUrl, $m)) return $m[1];
			// embed/VIDEOID
			if (preg_match('~youtube\\.com/(?:embed|v)/([a-zA-Z0-9_-]{11})~', $videoUrl, $m)) return $m[1];

			// Se è già il codice
			if (preg_match('~^[a-zA-Z0-9_-]{11}$~', $videoUrl)) return $videoUrl;

			return '';
		}

		function parseStampaItem($item, $lingua) {
			$titolo = ucfirst($lingua == 'ita' && !empty($item->titolo) ? $item->titolo : $item->titolo_eng);
			$data = '';
			$data_ts = 0;
			if (!empty($item->data_stampa)) {
				$data = convertDateFormat($item->data_stampa, 'Y-m-d', 'd/m/Y');
				$data_ts = strtotime($item->data_stampa);
			}

			$link = ($lingua == 'eng' ? 'en/' : '') . "press/" . creaSlug($titolo, "") . "-" . $item->id . ".html";

			$img = '';
			if (!empty($item->img)) {
				$img = "resarea/img_up/stampa/" . $item->img;
			} elseif (!empty($item->video)) {
				$ytId = extractYoutubeId($item->video);
				if (!empty($ytId)) {
					$img = "https://img.youtube.com/vi/" . $ytId . "/hqdefault.jpg";
				}
			}

			if (empty($img)) return null;
			$anteprima = str_starts_with($img, 'http') ? $img : "https://www.yccs.it/$img";

			$descrRaw = $lingua == 'ita'
				? ($item->descr ?? '')
				: ($item->descr_eng ?? ($item->descr ?? ''));
			$testo = substr(strip_tags((string)$descrRaw), 0, 100) . '...';

			return [
				'titolo' => $titolo,
				'link' => $link,
				'img' => $anteprima,
				'testo' => $testo,
				'data' => $data,
				'data_ts' => $data_ts,
			];
		}

		$items = [];

		foreach ($query_news as $item) {
			$parsed = parseNewsItem($item, $lingua, $pag_att);
			if ($parsed) {
				if (!empty($heroLink) && isset($parsed['link']) && $parsed['link'] === $heroLink) continue;
				$items[] = $parsed;
			}
		}

		foreach ($query_stampa as $item) {
			$parsed = parseStampaItem($item, $lingua);
			if ($parsed) {
				if (!empty($heroLink) && isset($parsed['link']) && $parsed['link'] === $heroLink) continue;
				$items[] = $parsed;
			}
		}

		usort($items, function($a, $b) {
			return ($b['data_ts'] <=> $a['data_ts']);
		});

		// Manteniamo un numero pari di elementi (sinistra/destra) per non rompere il JS
		$items = array_slice($items, 0, 8);
		if (count($items) % 2 == 1) array_pop($items);

		$newsHome = [];
		foreach ($items as $idx => $item) {
			$newsHome[$idx + 1] = $item;
		}
	@endphp

	
	<style>
		#newsScrollContainer{
			padding:37px 29px 0px 0px;
		}
		@media screen AND (max-width:850px){
			#newsScrollContainer{
				padding:30px 10px 0;
			}
		}
	</style>
	<div style="flex:1">
		<div id="newsScrollContainer">
			<div class="news-scroll-container" id="newsScrollable">
				<div class="news-scroll-wrapper" id="newsScrollWrapper">
					@foreach(array_chunk($newsHome, 2, true) as $pair)
						<div style="display:flex; gap:29px;">
							@foreach($pair as $news)
								<a href="{{ $news['link'] }}" title="{{ $news['titolo'] }}" style="flex:1; display:block; text-decoration:none; color:inherit;">
									<div class="news-item-{{ $loop->first ? 'left' : 'right' }} news-item news-hero-container news-hero-container2" style="flex:1">
										<div style="width:100%; height:210px; position:relative; overflow:hidden;">
											<img style="width:100%; height:100%; object-fit:cover;" src="{{ $news['img'] }}" class="news-hero-image">
										</div>
										<div class="news-hero-date" style="position:relative !important; color:#000; border-color:#000; margin-top:10px;">{{ $news['data'] }}</div>
										<div class="news-hero-title" style="color:#000;">{{ $news['titolo'] }}</div>
										<div class="news-hero-text" style="color:#000;">{{ $news['testo'] }}</div>
									</div>
								</a>
							@endforeach
						</div>
					@endforeach
				</div>
			</div>
		</div>
		<div class="scroll-arrows-container">
		  <img src="{{ asset('web/images/freccia_thin_up.png') }}" id="arrowUp" class="scroll-arrow-btn" alt="Up" />
		  <img src="{{ asset('web/images/freccia_thin_down.png') }}" id="arrowDown" class="scroll-arrow-btn" alt="Down" />
		</div>
	</div>

	
</div>

@include('web.slideHome.assets.slide2Home_js')