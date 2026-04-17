<script>
document.addEventListener("DOMContentLoaded", function () {
    const titles = document.querySelectorAll(".list-title");

    titles.forEach(title => {
        title.addEventListener("click", function () {
            const container = this.nextElementSibling;
            const arrow = this.querySelector(".row-doc-arrow");

            // Chiude tutti gli altri (accordion)
            document.querySelectorAll(".list-container").forEach(c => {
                if (c !== container) {
                    c.classList.remove("open");
                    c.style.maxHeight = null;
                }
            });
            document.querySelectorAll(".row-doc-arrow").forEach(a => {
                if (a !== arrow) a.classList.remove("rotate");
            });

            // Toggle per quello cliccato
            if (container.classList.contains("open")) {
                container.classList.remove("open");
                container.style.maxHeight = null;
                arrow.classList.remove("rotate");
            } else {
                container.classList.add("open");
                // Calcola e imposta l'altezza reale del contenuto
                container.style.maxHeight = container.scrollHeight + "px";

                arrow.classList.add("rotate");
            }
        });
    });
	
	//const sezioni = ["Iscritti", "Programma", "Albo", "Crew", "Info", "Risultati"];
	const sezioni = ["Iscritti", "Crew", "Info", "Risultati"];
	
	const altezze = {};
	sezioni.forEach(nome => {
	  const el = document.querySelector(".text-link-regata-" + nome);
	  if (el) {
		altezze[nome] = el.offsetHeight;
	  }
	});
	const crewFormEl = document.getElementById('crewForm');
	if (crewFormEl) altezze['Crew'] = crewFormEl.offsetHeight;
	
	sezioni.forEach(nome => {
		const el = document.querySelector(".text-link-regata-"+nome);
		if (el) el.style.height = "0px";
	});

	const links3 = document.querySelectorAll(".link-regata");
	links3.forEach(link_init => {
		
		link_init.style.marginTop="0px";
		link_init.style.marginBottom="0px";
		
		const arrowRegata3 = link_init.querySelector(".arrow-link-regata");
		const closeRegata3 = link_init.querySelector(".close-link-regata");
		if (arrowRegata3) arrowRegata3.style.display="inline";
		if (closeRegata3) closeRegata3.style.display="none";
		
		const flex3 = link_init.dataset.space.split("-");
		const colLeft = document.querySelector(".colLeft");
		const colRight = document.querySelector(".colRight");
		if (colLeft) colLeft.style.flex = "1";
		if (colRight) colRight.style.flex = "1";
	});
		
	const links = document.querySelectorAll(".link-regata");
    links.forEach(link => {
		
		link.addEventListener("click", function () {		
			const links2 = document.querySelectorAll(".link-regata");
			links2.forEach(link_default => {
				if(link.dataset.title!=link_default.dataset.title){
					link_default.style.marginTop="0px";
					link_default.style.marginBottom="0px";
					
					const arrowRegata2 = link_default.querySelector(".arrow-link-regata");
					const closeRegata2 = link_default.querySelector(".close-link-regata");
					if (arrowRegata2) arrowRegata2.style.display="inline";
					if (closeRegata2) closeRegata2.style.display="none";
					
					const colLeft2 = document.querySelector(".colLeft");
					const colRight2 = document.querySelector(".colRight");
					if (colLeft2) colLeft2.style.flex="1";
					if (colRight2) colRight2.style.flex="1";
				}
			});
			sezioni.forEach(nome => {
				const textRegata = document.querySelector(".text-link-regata-"+nome);
				if (textRegata) {
					textRegata.style.marginTop="0px";
					textRegata.style.visibility="hidden";
					textRegata.style.height="0px";
				}
			});

			if(link.style.marginTop=="0px"){
				const nomeSez = link.dataset.title;
				link.style.marginTop=-link.dataset.margin+"px";	
				link.style.marginBottom=link.dataset.margin+"px";
				
				const arrowRegata = this.querySelector(".arrow-link-regata");
				const closeRegata = this.querySelector(".close-link-regata");
				if (arrowRegata) arrowRegata.style.display="none";
				if (closeRegata) closeRegata.style.display="inline";
				
				const flex = link.dataset.space.split("-");
				const colLeft = document.querySelector(".colLeft");
				const colRight = document.querySelector(".colRight");
				if (colLeft) colLeft.style.flex=flex[0];
				if (colRight) colRight.style.flex=flex[1];
				
				
				const textRegata = document.querySelector(".text-link-regata-"+link.dataset.title);
				if (textRegata) {
					if(link.dataset.title == "Info"){
						textRegata.style.marginTop=-(link.dataset.margin - 104)+"px";
					}else if(link.dataset.title == "Risultati" || link.dataset.title == "Edizioni"){
						textRegata.style.marginTop=-(link.dataset.margin - 105)+"px";
					}else{
						textRegata.style.marginTop=-link.dataset.margin+"px";
					}
					setTimeout(() => {
						textRegata.style.visibility="visible";
						if(link.dataset.title=="Crewc"){
							textRegata.style.height=altezze['crewForm']+"px";
						}else{
							textRegata.style.height=altezze[link.dataset.title]+"px";
						}
					}, 500);
				}
			}else{
				link.style.marginTop="0px";
				link.style.marginBottom="0px";
				
				const arrowRegata = this.querySelector(".arrow-link-regata");
				const closeRegata = this.querySelector(".close-link-regata");
				if (arrowRegata) arrowRegata.style.display="inline";
				if (closeRegata) closeRegata.style.display="none";
				
				const colLeft = document.querySelector(".colLeft");
				const colRight = document.querySelector(".colRight");
				if (colLeft) colLeft.style.flex='1';
				if (colRight) colRight.style.flex='1';
				
				const textRegata = document.querySelector(".text-link-regata-"+link.dataset.title);
				if (textRegata) {
					textRegata.style.visibility="hidden";
					textRegata.style.height="0px";
					textRegata.style.marginTop="0px";
				}
			}			
        });
    });
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const wrapper = document.getElementById("news-scroll-wrapper");
  if (!wrapper) return; // pagina senza sezione News
  const rows = [...wrapper.children]; // ogni riga = 3 colonne
  const upBtn = document.getElementById("arrowUp");
  const downBtn = document.getElementById("arrowDown");

  const visibleRows = 2;
  let currentIndex = 0;
  const totalRows = rows.length;
  
  function getTranslateY(el) {
	  const style = window.getComputedStyle(el);
	  const matrix = new DOMMatrixReadOnly(style.transform);
	  return matrix.m42; // translateY
	}

  /** 🔹 Aggiorna lo sfalsamento solo sulla prima riga visibile */
  function updateOffsets() {
    rows.forEach((row, i) => {
      const left = row.querySelector(".news-item-left > div");
      const right = row.querySelector(".news-item-right > div");
      
      if (left) left.style.marginTop = "60px";
      if (right) right.style.marginTop = "60px";
    });
  }

  /** 🔹 Applica animazione a una riga intera */
  function animateRow(row, action, direction, indice="") {
	  
	  const items = [
		row.querySelector(".news-item-left"),
		row.querySelector(".news-item-center"),
		row.querySelector(".news-item-right")
	  ];

	  items.forEach((el, i) => {
		if (!el) return;
		el.style.transition = "transform 1s ease, opacity 1s ease";
		const currentY = getTranslateY(el);
		
		setTimeout(() => {
			if (action === "enter") {
				transY = el.style.transform;
				transY = transY.replace("translateY(", "");
				transY = transY.replace("px)", "");
			  el.style.opacity = "1";
				  el.style.transform = (direction === "down")
					? "translateY("+(transY-407)+"px)"
					: "translateY("+(parseInt(transY)+parseInt(407))+"px)";
			}
			
			if (action === "first") {
			  el.style.opacity = "1";
			  el.style.transform = "translateY(0px)";
			}
		}, (i+1)*200);
	  });
	}


  /** 🔹 Aggiorna lo stato visibile */
  function updateRows(direction) {
    if (direction === "first") {
      rows.forEach((row, i) => {
        if (i < 2) animateRow(row, "first", "primo");
      });
    } else {
      rows.forEach((row) => {
        animateRow(row, "enter", direction);
      });
    }
    updateOffsets();
    updateButtons();
  }

  /** 🔹 Aggiorna stato frecce */
  function updateButtons() {
    upBtn.classList.toggle("disabled", currentIndex <= 0);
    downBtn.classList.toggle("disabled", currentIndex >= totalRows - visibleRows);
  }

  /** 🔹 Eventi */
  downBtn.addEventListener("click", () => {
    if (currentIndex < totalRows - visibleRows) {
      currentIndex++;
      updateRows("down");
    }
  });

  upBtn.addEventListener("click", () => {
    if (currentIndex > 0) {
	  currentIndex--;
      updateRows("up");
    }
  });
	
  /** ✅ Avvia animazione solo quando #regateNews diventa visibile */
  const regateNews = document.getElementById("regateNews");
  if (regateNews) {
    const observer = new IntersectionObserver((entries, obs) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          updateRows("first");
          updateOffsets();
          updateButtons();
          obs.disconnect(); // esegui solo la prima volta
        }
      });
    }, { threshold: 0.2 });
    observer.observe(regateNews);
  }
});


</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
  const gallerySections = document.querySelectorAll(".gallery-section");

  gallerySections.forEach((section) => {
    const overlay = section.querySelector(".gallery-overlay");
	const prevBtn = section.querySelector(".prev-slide");
	const nextBtn = section.querySelector(".next-slide");
	const items = Array.from(section.querySelectorAll(".item img.img-gallery")); // 🔹 solo img-gallery

	let currentPage = 0;
	const totalPages = 3;

	/** 🔹 Mischia solo le immagini con classe img-gallery */
	function shuffleImages() {
	  const shuffled = [...items];
	  for (let i = shuffled.length - 1; i > 0; i--) {
		const j = Math.floor(Math.random() * (i + 1));
		[shuffled[i].src, shuffled[j].src] = [shuffled[j].src, shuffled[i].src];
	  }
	  return shuffled;
	}

    /** 🔹 Mostra overlay + mischia immagini */
    function showPage() {
	  // Riporta overlay iniziale con fade-in
	  overlay.style.transition = "none";
	  overlay.style.opacity = "0";
	  overlay.style.transform = "translateX(0)";

	  if (currentPage > 0) {
		const shuffled = shuffleImages();
		const galleryImages = document.querySelectorAll('.img-gallery');

		setTimeout(() => {
		  shuffled.forEach((img, i) => {
			if (galleryImages[i]) {
			  galleryImages[i].src = img.src;
			}
		  });
		}, 50);
	  }

      // Fade-in + animazione scorrimento
      
	overlay.style.transition = "opacity 0.6s ease";
	overlay.style.opacity = "1";
  

      setTimeout(() => {
        overlay.style.transition = "transform 3.5s ease";
        overlay.style.transform = "translateX(-150%)";
      }, 200);

      updateButtons();
    }

    /** 🔹 Aggiorna stato frecce */
    function updateButtons() {
      if (!prevBtn || !nextBtn) return;
      prevBtn.classList.toggle("disabled", currentPage === 0);
      nextBtn.classList.toggle("disabled", currentPage === totalPages - 1);
    }

    /** 🔹 Eventi bottoni */
    if (prevBtn && nextBtn) {
      prevBtn.addEventListener("click", () => {
        if (currentPage > 0) {
          currentPage--;
          showPage();
        }
      });

      nextBtn.addEventListener("click", () => {
        if (currentPage < totalPages - 1) {
          currentPage++;
          showPage();
        }
      });
    }

    /** ✅ Avvia overlay solo quando diventa visibile */
    const observer = new IntersectionObserver((entries, obs) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          showPage();
          obs.unobserve(entry.target); // solo alla prima entrata
        }
      });
    }, { threshold: 0.2 });

    observer.observe(section);
  });
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
  const arrowButtons = document.querySelectorAll(".nav-arrow-button img");

  arrowButtons.forEach(img => {
    const defaultSrc = img.getAttribute("data-default");
    const hoverSrc = img.getAttribute("data-hover");

    // Imposto la transizione morbida via JS
    img.style.transition = "opacity 0.3s ease";

    img.addEventListener("mouseenter", () => {
      if (!img.closest(".nav-arrow-button").classList.contains("disabled")) {
        img.style.opacity = "0";
        setTimeout(() => {
          img.src = hoverSrc;
          img.style.opacity = "1";
        }, 150); // metà della durata per evitare flash
      }
    });

    img.addEventListener("mouseleave", () => {
      img.style.opacity = "0";
      setTimeout(() => {
        img.src = defaultSrc;
        img.style.opacity = "1";
      }, 150);
    });
  });
});

const crewHeight = document.getElementById("regataCrew").style.height;
function vediForm(){
	document.getElementById("regataForm").style.visibility="visible";
	document.getElementById("regataForm").style.opacity="1";
	document.getElementById("regataCrew").style.visibility="hidden";
	document.getElementById("regataCrew").style.height="0px";
	document.getElementById("regataCrew").style.opacity="0";	
}
function vediCrew(){
	document.getElementById("regataCrew").style.visibility="visible";
	document.getElementById("regataCrew").style.opacity="1";
	document.getElementById("regataCrew").style.height=crewHeight;
	document.getElementById("regataForm").style.visibility="hidden";
	document.getElementById("regataForm").style.opacity="0";	
}
function vediAsk(id, pos){
	const boxContatti = document.getElementById("boxContatti"+pos);
	boxContatti.classList.add("active");
	$.ajax({
		url: '{{ route("ajax.contatti") }}',
		method: 'GET',		
		data: { 
		  id:        id,
		  pos:        pos,
		  lingua: '<?=$lingua;?>',
		},
		success: function(response) {
		  $("#boxContatti"+pos).html(response);
		},
		error: function(xhr, status, err) {
		  $("#boxContatti"+pos).html("Si è verificato un errore: " + error);
		}
	});
}
function vediBoardRequest(pos){
	const boxContatti = document.getElementById("boxContatti"+pos);
	boxContatti.classList.remove("active");
}
</script>




