<script>
	document.addEventListener('DOMContentLoaded', function() {
		let altezza = $(".boxRegateAnno1").outerHeight();
		document.getElementById('boxRegate').style.height=altezza+"px";
		
		const calendarioRegate = document.getElementById('calendarioRegate');
		const observer = new IntersectionObserver((entries, observer) => {
		  entries.forEach(entry => {
			if (entry.isIntersecting) {
				const groups = document.querySelectorAll('.anno-container');				 
				let indice=0;
				groups.forEach((el, idx) => {
					if(el.dataset.year<2021){
						el.classList.add('visible');
					}else{
						setTimeout(() => {
							el.classList.add('visible');
							if(el.dataset.year==<?php echo date("Y");?>){
								document.querySelector('.cursor-anno').classList.add('visible');
							}
						}, 200 + indice * 100);
						indice++;
					}
				});
				observer.disconnect();
			}
		  });
		}, { threshold: 0.1 });
		observer.observe(calendarioRegate);
		 
		function showListaRegateContent() {
			var colLeft = document.querySelector('.colLeft');
			if (colLeft && !colLeft.classList.contains('visible')) {
				colLeft.classList.add('visible');
				var regateLeft = document.querySelectorAll('.colRegLeft .regata');
				regateLeft.forEach(function(el, idx) {
					setTimeout(function() { el.classList.add('visible'); }, 400 + idx * 220);
				});
				var regateRight = document.querySelectorAll('.colRegRight .regata');
				regateRight.forEach(function(el, idx) {
					setTimeout(function() { el.classList.add('visible'); }, 400 + idx * 220);
				});
			}
		}

		window.showListaRegateContent = showListaRegateContent;
		const colLeftEl = document.querySelector('.colLeft');
		if (colLeftEl) {
			const observer2 = new IntersectionObserver(function(entries, obs) {
				entries.forEach(function(entry) {
					if (entry.isIntersecting) {
						showListaRegateContent();
						obs.disconnect();
					}
				});
			}, { root: null, rootMargin: '0px', threshold: 0 });
			observer2.observe(colLeftEl);
		}

		// Scroll con trascinamento per lista anni mobile
		var mobContainer = document.querySelector('.lista-anni-mob-container');
		if (mobContainer) {
			var isDown = false, startX, scrollLeft, didDrag = false, justDragged = false;
			mobContainer.addEventListener('mousedown', function(e) {
				isDown = true;
				didDrag = false;
				mobContainer.classList.add('active-drag');
				startX = e.pageX - mobContainer.offsetLeft;
				scrollLeft = mobContainer.scrollLeft;
			});
			mobContainer.addEventListener('mouseleave', function() {
				if (isDown) justDragged = didDrag;
				isDown = false;
				mobContainer.classList.remove('active-drag');
			});
			mobContainer.addEventListener('mouseup', function() {
				if (isDown) justDragged = didDrag;
				isDown = false;
				mobContainer.classList.remove('active-drag');
				setTimeout(function() { justDragged = false; }, 50);
			});
			mobContainer.addEventListener('mousemove', function(e) {
				if (!isDown) return;
				didDrag = true;
				e.preventDefault();
				var x = e.pageX - mobContainer.offsetLeft;
				var walk = (x - startX);
				mobContainer.scrollLeft = scrollLeft - walk;
			});
			mobContainer.addEventListener('click', function(e) {
				if (justDragged && e.target.closest('a')) e.preventDefault();
			}, true);
			// Al caricamento (e al resize) centra l'anno evidenziato
			function centerAnnoMob() {
				if (window.innerWidth > 800) return;
				var current = mobContainer.getAttribute('data-current-anno');
				if (!current) return;
				var el = mobContainer.querySelector('.anno-container-mob[data-anno="' + current + '"]');
				if (!el) return;
				var container = mobContainer;
				var scrollLeft = el.offsetLeft - (container.clientWidth / 2) + (el.offsetWidth / 2);
				var maxScroll = container.scrollWidth - container.clientWidth;
				container.scrollLeft = Math.max(0, Math.min(scrollLeft, maxScroll));
			}
			setTimeout(centerAnnoMob, 50);
			window.addEventListener('resize', function() {
				var t;
				clearTimeout(t);
				t = setTimeout(centerAnnoMob, 100);
			});
		}
	});

	var _regateFotoResizeT;
	window.addEventListener('resize', function() {
		clearTimeout(_regateFotoResizeT);
		_regateFotoResizeT = setTimeout(function() {
			setupRegateFotoMobile();
			if (typeof updateBloccoBottoniPosition === 'function') updateBloccoBottoniPosition();
		}, 150);
	});
	
	const years = document.querySelectorAll('.anno-container');
	const allYears = Array.from(years).map(el => parseInt(el.dataset.anno));
	const cursor = document.getElementById('cursor-anno');
	let selectedYear = <?php echo date("Y")?>;
	const startYear = <?php echo date("Y")?>;
	const yearWidth = 125; 
	const offsetStart = 100;
	let selectedPosition = 0; 
	let startPosition = 0; 
	let distanza = 199;
	let newTranslate = 0;		
	setTimeout(() => {
		selectedPosition = document.querySelector('.anno-container .year-label.selected').getBoundingClientRect().left + window.scrollX;
		startPosition = document.querySelector('.anno-container.start').getBoundingClientRect().left + window.scrollX;
		const el2025 = document.querySelector('.anno-container[data-year="2025"]');
		const el2024 = document.querySelector('.anno-container[data-year="2024"]');
		if (el2025 && el2024) {
		  const pos2025 = el2025.getBoundingClientRect().left + window.scrollX;
		  const pos2024 = el2024.getBoundingClientRect().left + window.scrollX;

		  distanza = Math.abs(pos2025 - pos2024 - 1);
		} 
	}, 3000);
		
	function opacizzaPallini(selectedYear){
		years.forEach(el => {
			el.style.opacity="1";
		});
		years.forEach(el => {
			const year = parseInt(el.dataset.year);
			if((selectedYear - year) > 4) el.style.opacity="0";
			if((selectedYear - year) == 4) el.style.opacity="0.5";
			if((selectedYear - year) == 3) el.style.opacity="0.8";
			if((selectedYear - year) == -2) el.style.opacity="0.6";
			if((selectedYear - year) < -2) el.style.opacity="0";
		});
	}
		
	function initYearsPosition(selectedYear, startYear, distanza) {
		const years = document.querySelectorAll('.anno-container');
		years.forEach(el => {
			const year = parseInt(el.dataset.year);
			const label = el.querySelector('.year-label');
			label.classList.remove('selected');
			if (year === selectedYear) {
				label.classList.add('selected');
			}
			
			let diff="";
			if(selectedYear<startYear){
				diff = Math.abs(startYear - selectedYear);
				el.style.transform = `translateX(${(diff*distanza)}px)`;						
			}
		});
		//opacizzaPallini(selectedYear);
	}
	
	function setupRegateFotoMobile() {
		var container = document.getElementById('listaRegateFoto1');
		if (!container) return;
		if (window.innerWidth > 800) {
			container.classList.remove('regate-grid-mob');
			var regate = container.querySelectorAll('.regata');
			regate.forEach(function(el) { el.style.order = ''; el.classList.remove('regata-inview'); });
			if (window._regateFotoObserver) {
				window._regateFotoObserver.disconnect();
				window._regateFotoObserver = null;
			}
			return;
		}
		container.classList.add('regate-grid-mob');
		var regate = container.querySelectorAll('.regata');
		regate.forEach(function(el) {
			var order = el.getAttribute('data-grid-order');
			if (order) el.style.order = order;
			el.classList.remove('regata-inview');
		});
		if (window._regateFotoObserver) {
			window._regateFotoObserver.disconnect();
		}
		window._regateFotoObserver = new IntersectionObserver(function(entries) {
			entries.forEach(function(entry) {
				if (entry.isIntersecting) {
					entry.target.classList.add('regata-inview');
				}
			});
		}, { root: null, rootMargin: '0px 0px -40px 0px', threshold: 0.1 });
		regate.forEach(function(el) {
			window._regateFotoObserver.observe(el);
		});
	}

	function updateBloccoBottoniPosition() {
		var firstCard = document.querySelector('#listaRegateFoto1 .regata');
		if (!firstCard) return;
		var cardHeight = firstCard.getBoundingClientRect().height;
		var top2 = (cardHeight + 60) * 2;
		document.querySelectorAll('.blocco-bottoni-2').forEach(function(el) {
			el.style.top = top2 + 'px';
		});
	}
	function scheduleBloccoBottoniShow() {
		document.querySelectorAll('.blocco-bottoni').forEach(function(el) {
			el.classList.remove('blocco-bottoni-visible');
		});
		setTimeout(function() {
			updateBloccoBottoniPosition();
			setTimeout(function() {
				document.querySelectorAll('.blocco-bottoni').forEach(function(el) {
					el.classList.add('blocco-bottoni-visible');
				});
			}, 1200);
		}, 100);
	}

	function initBoxes(year) {
		// Inizializza Box Regate
		$(".boxRegateAnno1").css({
			"top": "0",
			"left": "0px",
			"opacity": "1",
			"visibility": "visible"
		});
		$(".boxRegateAnno2, .boxRegateAnno3").css({
			"top": "-300px",
			"left": "0px",
			"opacity": "0",
			"visibility": "hidden"
		});

		// Carica la prima lista regate
		$.ajax({
			url: 'ajax/regate_lista_ajax',
			method: 'GET',
			data: { 
				box: 'boxRegateAnno1',
				anno: year,
				lingua: '{{ $lingua }}'
			},
			success: function(response) {
				$(".boxRegateAnno1").html(response);
				setTimeout(function() {
					if (window.showListaRegateContent) {
						var colLeft = document.querySelector('.colLeft');
						if (colLeft) {
							var r = colLeft.getBoundingClientRect();
							if (r.top < window.innerHeight && r.bottom > 0) {
								window.showListaRegateContent();
							}
						}
					}
				}, 150);
			}
		});

		// Inizializza Foto
		$("#listaRegateFoto1").css({
			"top": "0",
			"opacity": "1",
			"visibility": "visible",
			"transition": "all 1s ease"
		});
		/*$("#listaRegateFoto2").css({
			"top": "100%",
			"opacity": "0",
			"visibility": "hidden",
			"transition": "all 0s ease"
		});*/

		// Carica la prima lista foto
		$.ajax({
			url: 'ajax/regate_listaFoto_ajax',
			method: 'GET',
			data: { 
				anno: year,
				lingua: '{{ $lingua }}'
			},
			success: function(response) {
				$("#listaRegateFoto1").html(response);
				setTimeout(function() { setupRegateFotoMobile(); }, 50);
				if (typeof scheduleBloccoBottoniShow === 'function') scheduleBloccoBottoniShow();
			}
		});
		
		// Carica bottone calendario Regate
		$.ajax({
			url: 'ajax/regate_bottone_calendario_ajax',
			method: 'GET',
			data: { 
				anno: year,
				lingua: '{{ $lingua }}'
			},
			success: function(response) {
				$("#bottone_calendario_regate").html(response);
			}
		});
		
		// Carica loghi
		$.ajax({
			url: 'ajax/regate_loghi_ajax',
			method: 'GET',
			data: { 
				anno: year,
			},
			success: function(response) {
				$("#loghi_regate").html(response);
			}
		});
	}


	setTimeout(() => {
		const yearInit = {{ $anno_regata }};
		selectedYear = yearInit;
		initYearsPosition(selectedYear, startYear, distanza);
		initBoxes(yearInit);
	}, 1000);
	
	
	let contClick = 0;
	let listaRegateClick = 1;
	let topRelativo1 = $("#listaRegateFoto1").position().top="100%";
	// let topRelativo2 = $("#listaRegateFoto2").position().top="100%";
	
	years.forEach(el => {
		const year = parseInt(el.dataset.year);
		
		el.addEventListener('click', function() {
		  var year = parseInt(el.dataset.year);
		  document.querySelectorAll(".arrow-down").forEach(function(el) { el.setAttribute("onclick", "sali('"+year+"')"); });
		  document.querySelectorAll(".arrow-up").forEach(function(el) { el.setAttribute("onclick", "scendi('"+year+"')"); });
		  
		  if (year !== selectedYear) {
			// Cambio anno: aggiorna timeline, carica sempre l'anno cliccato in box1 + foto, mostra box1 (niente rotazione 3 box)
			years.forEach(function(e) {
				var lbl = e.querySelector('.year-label');
				if (lbl) lbl.classList.remove('selected');
				var transform = window.getComputedStyle(e).transform;
				var translateX = 0;
				if (transform && transform !== 'none') {
				  var m = transform.match(/matrix.*\((.+)\)/);
				  if (m && m[1]) {
					var values = m[1].split(', ');
					if (values.length >= 6) translateX = parseFloat(values[4]);
				  }
				}
				var diff;
				if (selectedYear > year) {
				  diff = Math.abs(startYear - year);
				  e.style.transform = "translateX(" + (diff * distanza) + "px)";
				} else {
				  diff = Math.abs(year - selectedYear);
				  e.style.transform = "translateX(" + (translateX - (diff * distanza)) + "px)";
				}
			});
			selectedYear = year;
			opacizzaPallini(selectedYear);
			var clickedLabel = el.querySelector('.year-label');
			if (clickedLabel) clickedLabel.classList.add('selected');
			var newUrl = window.location.href.replace(/regate-\d+\.html/, "regate-" + year + ".html");
			history.pushState({ year: year }, "", newUrl);
			// Carica l'anno cliccato in box1 e listaRegateFoto1, poi mostra box1 (reset rotazione)
			initBoxes(year);
			$(".boxRegateAnno1").css({ "top": "0", "left": "0px", "opacity": "1", "visibility": "visible" });
			$(".boxRegateAnno2").css({ "top": "-300px", "left": "0px", "opacity": "0", "visibility": "hidden" });
			$(".boxRegateAnno3").css({ "top": "0", "left": "-100%", "opacity": "0", "visibility": "hidden" });
			$("#listaRegateFoto1").css({ "top": "0", "opacity": "1", "visibility": "visible", "transition": "all 1s ease" });
			listaRegateClick = 1;
			topRelativo1 = $("#listaRegateFoto1").position().top;
			setTimeout(function() {
			  changeListaRegate(1, topRelativo1, '', year);
			}, 50);
			contClick = 0;
			return;
		  }
		  
		  // Stesso anno: rotazione dei 3 box (lista) + changeListaRegate (foto)
		  contClick++;
		  if (contClick > 3) contClick = 1;
			
		  if (contClick == 1) {
				$(".boxRegateAnno1").css({
				  "top": "-300px",
				  "left": "0px",
				  "opacity": "0",
				  "visibility": "hidden",
				});
				
				$(".boxRegateAnno2").css({
				  "top": "0",
				  "left": "0px",
				  "opacity": "1",
				  "visibility": "visible",
				});
				
				$(".boxRegateAnno3").css({
				  "top": "0",
				  "left": "-100%",
				  "opacity": "0",
				  "visibility": "hidden",
				});
				
				$.ajax({
					url: 'ajax/regate_lista_ajax',
					method: 'GET',		
					data: { 
					  box:  'boxRegateAnno2',
					  anno:  year,
					  lingua:  '{{ $lingua }}'
					},
					success: function(response) {
					  	$(".boxRegateAnno2").html(response);		  
					}
				});
				$(".boxRegateAnno2 .list-link").css({
				  "transform": "translateY(300px)",
				  "opacity": "0.3",
				});
			}else if(contClick==2){
				$(".boxRegateAnno1").css({
				  "top": "0",
				  "left": "-100%",
				  "opacity": "0",
				  "visibility": "hidden",
				});
				
				$(".boxRegateAnno2").css({				  
				  "top": "-300px",
				  "left": "0px",
				  "opacity": "0",
				  "visibility": "hidden",
				});
				
				$(".boxRegateAnno3").css({
				  "top": "0",
				  "left": "0px",
				  "opacity": "1",
				  "visibility": "visible",
				});
				
				$.ajax({
					url: 'ajax/regate_lista_ajax',
					method: 'GET',		
					data: { 
					  box:  'boxRegateAnno3',
					  anno:  year
					},
					success: function(response) {
					  	$(".boxRegateAnno3").html(response);		  
					}
				});
			}else if(contClick==3){
				$(".boxRegateAnno1").css({
				  "top": "0",
				  "left": "0px",
				  "opacity": "1",
				  "visibility": "visible",	
				});
				
				$(".boxRegateAnno2").css({	
				  "top": "0",
				  "left": "-100%",
				  "opacity": "0",
				  "visibility": "hidden",
				});
				
				$(".boxRegateAnno3").css({			  
				  "top": "-300px",
				  "left": "0px",
				  "opacity": "0",
				  "visibility": "hidden",
				});
				
				$.ajax({
					url: 'ajax/regate_lista_ajax',
					method: 'GET',		
					data: { 
					  box:  'boxRegateAnno1',
					  anno:  year
					},
					success: function(response) {
					  	$(".boxRegateAnno1").html(response);		  
					}
				});
			}
			
			listaRegateClick++;
			if(listaRegateClick>2) listaRegateClick=1;
			
			topRelativo1 = $("#listaRegateFoto1").position().top;
			// = $("#listaRegateFoto2").position().top;
			
			// Carica bottone calendario Regate
			$.ajax({
				url: 'ajax/regate_bottone_calendario_ajax',
				method: 'GET',
				data: { 
					anno: year,
					lingua: '{{ $lingua }}'
				},
				success: function(response) {
					$("#bottone_calendario_regate").html(response);
				}
			});
			
			changeListaRegate(listaRegateClick, topRelativo1, '', year);
			
		});
		
	});
	setTimeout(() => {				
		changeListaRegate(listaRegateClick, topRelativo1, '', '{{ $anno_regata }}');
	}, 500);
	
	function changeListaRegate(listaRegateClick, topRelativo1, topRelativo2, anno){		
		if(listaRegateClick==1){
			if(topRelativo1<0){
				$("#listaRegateFoto1").css({			  
				  "top": "100%",
				  "opacity": "0",
				  "visibility": "visible",					  
				  "transition": "all 0s ease",
				});
			}
			setTimeout(() => {
				$("#listaRegateFoto1").css({			  
				  "top": "0",
				  "opacity": "1",
				  "visibility": "visible",	
				  "transition": "all 1s ease",
				});
			}, 50);
			
			/*if(topRelativo2==0){
				$("#listaRegateFoto2").css({			  
				  "top": "-100%",
				  "opacity": "0",				  
				  "transition": "all 1s ease",
				});
				setTimeout(() => {
					$("#listaRegateFoto2").css({
					  "visibility": "hidden"
					});
				}, 100);
			}*/
		}else if (listaRegateClick==2){
			$("#listaRegateFoto1").css({			  
			  "top": "-100%",
			  "opacity": "0",
			  "transition": "all 1s ease",
			});
			setTimeout(() => {
				$("#listaRegateFoto1").css({
				  "visibility": "hidden"
				});
			}, 100);
			
			/*if(topRelativo2<0){
				$("#listaRegateFoto2").css({			  
				  "top": "100%",
				  "opacity": "0",		
				  "visibility": "visible",					  
				  "transition": "all 0s ease",
				});
			}
			setTimeout(() => {
				$("#listaRegateFoto2").css({			  
				  "top": "0",
				  "opacity": "1",					  
				  "visibility": "visible",	
				  "transition": "all 1s ease",
				});
			}, 50);*/
		}
		setTimeout(() => {
			topRelativo1 = $("#listaRegateFoto1").position().top;
			// topRelativo2 = $("#listaRegateFoto2").position().top;
		}, 1000);
		
		$.ajax({
			url: 'ajax/regate_listaFoto_ajax',
			method: 'GET',		
			data: { 
			  anno:  anno,
			  lingua:  '{{ $lingua }}'
			},
			success: function(response) {
				$("#listaRegateFoto"+listaRegateClick).html(response);
				if (listaRegateClick === 1 && typeof scheduleBloccoBottoniShow === 'function') scheduleBloccoBottoniShow();
			}
		});
		
	}
	
	



</script>
