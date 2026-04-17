<script>
document.addEventListener('DOMContentLoaded', function() {
  const slide3 = document.getElementById('slide3Home');
  const img = document.getElementById('calendarioImg');
  if (slide3 && img) {
    const observer = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          img.classList.add('slide-in-right');
          // Anni: animazione sequenziale dei gruppi da destra
          const groups = document.querySelectorAll('#slide3Home .year-group-animate');
          groups.forEach((el, idx) => {
            el.classList.remove('visible');
          });
          groups.forEach((el, idx) => {
            setTimeout(() => {
              el.classList.add('visible');
            }, 400 + idx * 220);
          });
          observer.disconnect();
        }
      });
    }, { threshold: 0.2 });
    observer.observe(slide3);
  }
});
</script> 