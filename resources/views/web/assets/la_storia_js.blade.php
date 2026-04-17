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
	const slides = document.querySelectorAll('.media-slide');
	const prevBtn = document.querySelector('.prev-slide');
	const nextBtn = document.querySelector('.next-slide');
	let current = 0, timer;

	function showSlide(idx) {
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