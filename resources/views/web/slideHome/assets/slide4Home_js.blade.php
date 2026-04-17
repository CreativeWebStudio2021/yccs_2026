<script>
document.addEventListener('DOMContentLoaded', function() {
  const slide4 = document.getElementById('slide4Home');
  const video = slide4.querySelector('.slide4-bg-video');
  const whiteBox = slide4.querySelector('.slide4-white-box');
  const blocks = document.querySelectorAll('.slide4-block');

  // Animazione iniziale video e whitebox
  const observer1 = new IntersectionObserver((entries, obs) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        video.classList.add('video-animate-in');
        setTimeout(() => whiteBox.classList.add('whitebox-animate-in'), 350);
        obs.disconnect();
      }
    });
  }, { threshold: 0.3 });
  observer1.observe(slide4);

  // Animazione per i due blocchi extra
  const observer2 = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        blocks.forEach(block => block.classList.add('animate-in'));
      }
    });
  }, { threshold: 0.1 });
  observer2.observe(document.querySelector('.slide4-extra-section'));
});

</script> 