<script>
	document.querySelectorAll('.arrow-btn').forEach(img => {
		img.addEventListener('mouseenter', () => {
			img.src = `web/images/${img.dataset.hover}`;
		});
		img.addEventListener('mouseleave', () => {
			img.src = `web/images/${img.dataset.default}`;
		});
	});
</script>
<script>
	const scroller = document.getElementById('regata-scroller');
	const scrollerMob = document.getElementById('regata-scroller-mob');
	const upBtn = document.querySelector('img[src*="freccia_su.png"]');
	const downBtn = document.querySelector('img[src*="freccia_giu.png"]');
	const regataItems = document.querySelectorAll('#regata-scroller > div');

	let currentOffset = 0;
	const step = 1; // numero di rigate da scrollare
	
	const firstRow = document.querySelector('.regata-row-animate');
	const itemHeight = firstRow.offsetHeight - 24; // altezza stimata di una regata (modifica se serve)
	
	const maxItems = document.querySelectorAll('#regata-scroller > div').length;
	const maxOffset = Math.max(0, maxItems - 5);

	upBtn.addEventListener('click', () => {
		if (currentOffset > 0) {
			currentOffset--;
			updateScroll();
		}
	});

	downBtn.addEventListener('click', () => {
		if (currentOffset < maxOffset) {
			currentOffset++;
			updateScroll();
		}
	});
	
	function updateArrows() {
		if (currentOffset <= 0) {
			upBtn.classList.add('arrow-disabled');
		} else {
			upBtn.classList.remove('arrow-disabled');
		}

		if (currentOffset >= maxOffset) {
			downBtn.classList.add('arrow-disabled');
		} else {
			downBtn.classList.remove('arrow-disabled');
		}
	}
	
	function updateScroll() {
		const firstRow = scroller.querySelector('div');
		const firstRowMob = scrollerMob.querySelector('div');
		let h = firstRow ? firstRow.getBoundingClientRect().height : itemHeight;
		const gap = 30; // se hai margine fra le righe
		scroller.style.transform = `translateY(-${currentOffset * (h + gap)}px)`;
		scrollerMob.style.transform = `translateY(-${currentOffset * (h + gap)}px)`;
		updateArrows();
	}
	
	updateArrows();
</script>
<script>
	// Rende le righe invisibili prima del primo repaint
	const rows = document.querySelectorAll('#regata-scroller > div');
	rows.forEach(row => {
	  row.classList.add('regata-row-animate');
	  row.classList.remove('visible');
	});

	window.addEventListener('DOMContentLoaded', () => {
	  // Animazione sequenziale delle righe
	  rows.forEach((row, idx) => {
	    setTimeout(() => {
	      row.classList.add('visible');
	    }, 500 + idx * 200); // delay iniziale + intervallo tra le righe
	  });

	  // Dopo che tutte le righe sono visibili, mostra le linee animate
	  setTimeout(() => {
	    document.querySelectorAll('.border-animated').forEach((item, index) => {
	      setTimeout(() => {
	        item.classList.add('visible');
	      }, index * 220);
	    });
	  }, 500 + rows.length * 320 + 300); // attende la fine delle righe
	});
</script>
<script>
	const slides = document.querySelectorAll('.media-slide');
	const prevBtn = document.querySelector('.prev-slide');
	const nextBtn = document.querySelector('.next-slide');
	let current = 0, timer;

	function showSlide(idx) {console.log("AAA");
	  slides[current].classList.remove('active');
	  current = (idx + slides.length) % slides.length;
	  slides[current].classList.add('active');
	}

	function goNext() {
	  showSlide(current + 1);
	  resetTimer();
	}
	function goPrev() {
	  showSlide(current - 1);
	  resetTimer();
	}

	function resetTimer() {
	  clearInterval(timer);
	  timer = setInterval(goNext, 7000);
	}

	// hover swap immagini
	prevBtn.addEventListener('mouseenter', () => prevBtn.querySelector('img').src = 'web/images/freccia_sinistra_on.png');
	prevBtn.addEventListener('mouseleave', () => prevBtn.querySelector('img').src = 'web/images/freccia_sinistra.png');
	nextBtn.addEventListener('mouseenter', () => nextBtn.querySelector('img').src = 'web/images/freccia_destra_on.png');
	nextBtn.addEventListener('mouseleave', () => nextBtn.querySelector('img').src = 'web/images/freccia_destra.png');

	prevBtn.addEventListener('click', goPrev);
	nextBtn.addEventListener('click', goNext);

	resetTimer();
</script>