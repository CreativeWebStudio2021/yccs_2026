
<script>
(function() {
  const wrapper = document.getElementById('newsScrollWrapper');
  const container = document.getElementById('newsScrollable');
  const upBtn = document.getElementById('arrowUp');
  const downBtn = document.getElementById('arrowDown');

  const groups = [...wrapper.children];
  const totalGroups = groups.length;
  let groupHeight = 0;
  let maxScrollOffset = 0;
  let currentIndex = 0;

  function getGap() {
    const gap = getComputedStyle(wrapper).gap;
    return gap ? parseInt(gap, 10) || 29 : 29;
  }

  function getMaxScrollOffset() {
    return Math.max(0, wrapper.offsetHeight - container.clientHeight);
  }

  function refreshHeights() {
    const gap = getGap();
    groupHeight = groups[0].offsetHeight + gap;
    maxScrollOffset = getMaxScrollOffset();
  }

  // Funzione per attivare le animazioni iniziali con effetto sfalsato
  function showInitialGroups() {
    // Primo gruppo
    const left0 = groups[0].querySelector('.news-item-left');
    const right0 = groups[0].querySelector('.news-item-right');
    left0.classList.add('news-item-visible');
    setTimeout(() => {
      right0.classList.add('news-item-visible');
    }, 200);

    // Secondo gruppo (se esiste)
    if (groups[1]) {
      const left1 = groups[1].querySelector('.news-item-left');
      const right1 = groups[1].querySelector('.news-item-right');
      setTimeout(() => {
        left1.classList.add('news-item-visible');
        setTimeout(() => {
          right1.classList.add('news-item-visible');
        }, 200);
      }, 400); // parte dopo il primo gruppo
    }
  }

  // Usa IntersectionObserver per attivare le animazioni solo quando il blocco entra in viewport
  const slide2Home = document.getElementById('slide2Home');
  const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        showInitialGroups();
        observer.disconnect(); // Attiva solo la prima volta
      }
    });
  }, { threshold: 0.2 }); // 20% visibile

  observer.observe(slide2Home);

  const visibleGroups = () => Math.floor(container.clientHeight / groupHeight);

  function updateButtons() {
    const offset = Math.min(currentIndex * groupHeight, maxScrollOffset);
    const atBottom = offset >= maxScrollOffset - 1;
    upBtn.classList.toggle('disabled', currentIndex <= 0);
    downBtn.classList.toggle('disabled', atBottom || maxScrollOffset <= 0);
  }

  function scrollToIndex() {
    refreshHeights();
    const offset = Math.min(currentIndex * groupHeight, maxScrollOffset);
    wrapper.style.transform = `translateY(-${offset}px)`;

    groups.forEach((g, i) => {
      const left = g.querySelector('.news-item-left');
      const right = g.querySelector('.news-item-right');
      const visCount = visibleGroups() + 1;

      if (i >= currentIndex && i < currentIndex + visCount) {
        if (!g.classList.contains('shown')) {
          left.classList.add('news-item-visible');
          setTimeout(() => {
            right.classList.add('news-item-visible');
          }, 200);
          g.classList.add('shown');
        }
      } else if (i >= currentIndex + visCount) {
        setTimeout(() => {
          left.classList.remove('news-item-visible');
        }, 200);
        right.classList.remove('news-item-visible');
        g.classList.remove('shown');
      }
    });

    updateButtons();
  }

  upBtn.addEventListener('click', () => {
    if (currentIndex > 0) {
      currentIndex--;
      scrollToIndex();
    }
  });

  downBtn.addEventListener('click', () => {
    refreshHeights();
    if (currentIndex * groupHeight < maxScrollOffset) {
      currentIndex++;
      scrollToIndex();
    }
  });

  window.addEventListener('resize', () => {
    refreshHeights();
    const maxIndex = Math.ceil(maxScrollOffset / groupHeight) || 0;
    if (currentIndex > maxIndex) currentIndex = Math.max(0, maxIndex);
    scrollToIndex();
  });

  // Inizializza: calcola maxScrollOffset e posiziona
  refreshHeights();
  scrollToIndex();
})();

</script>