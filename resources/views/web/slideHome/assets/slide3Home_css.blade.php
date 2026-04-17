<style>
	#slide3Home {
		--slide3-spacer: 245px;
		--timeline-start: 50px;
		--timeline-gap: 217px;
		--year-label-font: 22px;
	}

	@keyframes slideInFromRight {
		from {
			transform: translateX(100%);
			opacity: 0;
		}
		to {
			transform: translateX(0);
			opacity: 1;
		}
	}

	@keyframes fadeIn {
		from {
			opacity: 0;
		}
		to {
			opacity: 1;
		}
	}

	.slide-in-right {
		animation: slideInFromRight 1.5s ease-out forwards;
	}

	.fade-in {
		animation: fadeIn 1.5s ease-out forwards;
	}

	.slide3-spacer {
		width: var(--slide3-spacer);
		flex-shrink: 0;
	}
	.slide3-timeline-wrap {
		width: calc(100% - var(--slide3-spacer));
		position: absolute;
		right: 0;
		bottom: 15px;
		height: 2px;
		background: #606060;
	}
	#slide3Home.slide3-lang-en .slide3-timeline-wrap {
		width: calc(100% - var(--slide3-spacer) - 60px);
	}
	/* Riduzione gap e start in inglese per tenere l'anno corrente sempre visibile */
	#slide3Home.slide3-lang-en {
		--timeline-gap: 175px;
		--timeline-start: 35px;
	}
	.slide3-timeline-line {
		width: 100%;
		height: 100%;
		position: relative;
	}

	.year-group-animate {
		opacity: 0;
		transform: translateX(400px);
		transition: opacity 1.2s ease, transform 1.2s ease;
	}
	.year-group-animate.visible {
		opacity: 1;
		transform: translateX(0);
	}
	.pallino-anno {
		background: #009fe3;
		width: 15px;
		height: 15px;
		position: absolute;
		border-radius: 8px;
		top: -7px;
	}
	.pallino-anno-1 { left: var(--timeline-start); }
	.pallino-anno-2 { left: calc(var(--timeline-start) + var(--timeline-gap)); }
	.pallino-anno-3 { left: calc(var(--timeline-start) + var(--timeline-gap) * 2); }
	.pallino-anno-4 { left: calc(var(--timeline-start) + var(--timeline-gap) * 3); }
	.pallino-anno-current {
		width: 60px;
		height: 22px;
		position: absolute;
		left: calc(var(--timeline-start) + var(--timeline-gap) * 4);
		top: -11px;
		border-radius: 11px;
	}
	.year-label {
		position: absolute;
		top: -29px;
		left: -20px;
		min-width: 60px;
		height: 1.2em;
		font-size: var(--year-label-font);
		line-height: 1.2;
		text-decoration: none;
		color: inherit;
		cursor: pointer;
	}
	a.year-label:hover {
		text-decoration: underline;
	}
	.pallino-anno-current .year-label-current {
		top: -26px;
		left: 2px;
		font-weight: bold;
	}

	.slide3-title .slide3-title-line1,
	.slide3-title .slide3-title-line2 {
		display: block;
	}
	.slide3-header-block {
		min-height: 120px;
	}

	@media screen and (max-width: 1400px) {
		#slide3Home {
			--slide3-spacer: 200px;
			--slide3-spacer-en: 250px;
			--timeline-gap: 180px;
		}
		#slide3Home.slide3-lang-en {
			--timeline-gap: 145px;
			--timeline-start: 28px;
		}
		.slide3-timeline-wrap {
			width: calc(100% - var(--slide3-spacer) - 50px);
		}
		#slide3Home.slide3-lang-en .slide3-timeline-wrap {
			width: calc(100% - var(--slide3-spacer-en) - 50px);
		}
	}
	@media screen and (max-width: 1200px) {
		#slide3Home {
			--slide3-spacer: 150px;
			--timeline-gap: 140px;
			--year-label-font: 20px;
		}
		#slide3Home.slide3-lang-en {
			--timeline-gap: 115px;
			--timeline-start: 22px;
		}
		.slide3-timeline-wrap {
			width: calc(100% - var(--slide3-spacer) - 100px);
		}
		#slide3Home.slide3-lang-en .slide3-timeline-wrap {
			width: calc(100% - var(--slide3-spacer) - 100px - 60px);
		}
	}
	@media screen and (max-width: 1024px) {
		#slide3Home {
			--slide3-spacer: 20px;
			--slide3-spacer-en: 300px;
			--timeline-gap: 145px;
			--timeline-start: 40px;
			--year-label-font: 18px;
		}
		#slide3Home.slide3-lang-en {
			--slide3-spacer-en: 300px;
			--timeline-gap: 120px;
			--timeline-start: 20px;
		}
		#slide3Home .slide3-timeline-wrap {
			width: calc(100% - 250px);
		}
		#slide3Home.slide3-lang-en .slide3-timeline-wrap {
			width: calc(100% - var(--slide3-spacer-en));
		}
	}
	@media screen and (max-width: 900px) {
		#slide3Home {
			--slide3-spacer: 20px;
			--timeline-gap: 145px;
			--timeline-start: 40px;
			--year-label-font: 18px;
		}
		#slide3Home.slide3-lang-en {
			--timeline-gap: 120px;
			--timeline-start: 20px;
		}
		#slide3Home .slide3-timeline-wrap {
			width: 100% ;
		}
		#slide3Home.slide3-lang-en .slide3-timeline-wrap {
			width: 100% ;
		}
		.slide3-header-block {
			display: flex;
			flex-direction: column;
			min-height: 0;
		}
		.slide3-title {
			display: flex;
			flex-direction: row;
			flex-wrap: wrap;
			align-items: baseline;
			gap: 0.25em;
			line-height: 1.2;
			padding-bottom: 0;
		}
		.slide3-title .slide3-title-line1,
		.slide3-title .slide3-title-line2 {
			display: inline;
			line-height:53px;
		}
		.slide3-timeline-wrap {
			position: static;
			margin-top: 40px;
			width: 100%;
		}
	}
	@media screen and (max-width: 800px) {
		#slide3Home {
			--timeline-gap: 130px;
			--timeline-start: 36px;
		}
		#slide3Home.slide3-lang-en {
			--timeline-gap: 105px;
			--timeline-start: 18px;
		}
	}
	@media screen and (max-width: 700px) {
		#slide3Home {
			--timeline-gap: 110px;
			--timeline-start: 30px;
			--year-label-font: 17px;
		}
		#slide3Home.slide3-lang-en {
			--timeline-gap: 90px;
			--timeline-start: 18px;
		}
		.pallino-anno-1 {
			display: none;
		}
	}
	@media screen and (max-width: 600px) {
		#slide3Home {
			--timeline-gap: 90px;
			--timeline-start: 25px;
			--year-label-font: 16px;
		}
		#slide3Home.slide3-lang-en {
			--timeline-gap: 72px;
			--timeline-start: 15px;
		}
	}
	@media screen and (max-width: 500px) {
		#slide3Home {
			--year-label-font: 14px;
		}
		.pallino-anno-2 {
			display: none;
		}
		.pallino-anno {
			width: 12px;
			height: 12px;
			border-radius: 6px;
			top: -5px;
		}
		.pallino-anno-current {
			width: 50px;
			height: 18px;
			top: -9px;
			border-radius: 9px;
		}
		/* Sotto 500px: posizionamento in % così linea e pallini si adattano e non si tagliano */
		.pallino-anno-3 {
			left: 0;
		}
		.pallino-anno-4 {
			left: 50%;
		}
		.pallino-anno-4:not(.visible) {
			transform: translateX(400px);
		}
		.pallino-anno-4.visible {
			transform: translateX(-50%);
		}
		.pallino-anno-current {
			left: auto;
			right: 0;
		}
	}
</style> 