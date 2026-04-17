<script>
	document.addEventListener('DOMContentLoaded', function() {
	  const slide5 = document.getElementById('slide5Home');
	  const barca = slide5.querySelector('.barca-vintage');
	  const texts = slide5.querySelectorAll('.text-block');

	  if (slide5 && barca && texts.length) {
		const observer = new IntersectionObserver((entries, obs) => {
		  entries.forEach(entry => {
			if (entry.isIntersecting) {
			  // Barca
			  barca.classList.add('animate-in');

			  // Testi (entrano contemporaneamente ma con transizioni differenti)
			  texts.forEach(text => text.classList.add('animate-in'));

			  obs.disconnect();
			}
		  });
		}, { threshold: 0.2 });

		observer.observe(slide5);
	  }
	});

</script>