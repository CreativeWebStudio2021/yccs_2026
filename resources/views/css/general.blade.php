<style>
	:root {
	  --azzurro: #009cff;
	  --grey: #F1F1F1;
	  --greyHalfDark: #a0a0a0;
	}

	.azzurro {
	  color: var(--azzurro);
	}
	.bgAzzurro {
	  background: var(--azzurro);
	}
	.grey {
	  color: var(--grey);
	}
	.bgGrey {
	  background: var(--grey);
	}	
	.greyHalfDark {
	  color: var(--greyHalfDark);
	}
	
	html, body{
		background:#fff;
		margin:0;
		padding:0;
		overflow-x:hidden;
	}
	a{
		text-decoration:none;
		color:#000;
	}
	
	.btnRoundedWhite {
		background: transparent;
		color: #fff;
		font-family: 'Montserrat', sans-serif;
		font-size: 15px;
		border: 1px solid #fff;
		border-radius: 999px; /* semicerchio */
		padding: 3px 15px;
		cursor: pointer;
		transition: all 0.3s ease;
		display: inline-block;
		white-space: nowrap;
	}

	.btnRoundedWhite:hover {
		background-color: #fff;
		color: #0062a0;
	}
	
	body, div, span, a, p, h1, h2, h3, h4, h5, h6 , ul, li{
		font-family: 'Montserrat', sans-serif;
	}
	
	h1, h2, h3, h4, h5, h6{
		margin:0; 
		padding:0;
	}
	
	h1{
		font-family: 'Montserrat', sans-serif;
		font-weight: 800;
		font-size: 64px;		
	}
	
	h3{
		font-family: 'Montserrat', sans-serif;
		font-weight: 300;
		font-size: 64px;		
	}
	
	h4{
		font-family: 'Montserrat', sans-serif;
		font-weight: 300;
		font-size: 40px;		
	}
	
	p{
		font-family: 'Montserrat', sans-serif;
		font-weight: 400;
		font-size: 16px;
		line-height:22px;
		color:#000 !important;
		margin-top:0 !important;
	}
	.page-container{
		width:calc(100% - 240px); 
		margin-left:120px; 
		margin-top:65px; 
		margin-bottom:36px;
	}
	.gradient-title {
		background: linear-gradient(to right, var(--azzurro) 0%, #0062a0 100%);
		-webkit-background-clip: text;
		-webkit-text-fill-color: transparent;
		background-clip: text;
		text-fill-color: transparent;
		display: inline-block;
	}
	
	.link-arrow {
		display: flex;
		align-items: center;
		gap: 20px;
		color: inherit;
		text-decoration: none;
		font-size: 16px;
		font-weight: 600;
		width:210px; 
		height:20px; 
		border-bottom:solid 2px;
		transition: all 0.9s ease;
	}

	.link-arrow:hover {
		color: var(--azzurro);
		border-bottom:solid 2px  var(--azzurro);
	}

	.link-arrow:hover .arrow-img {
		transform: rotate(45deg);
		content: url("{{ asset('web/images/arrow_azzurra.png') }}");
	}
	.link-arrow2 {
		display: flex;
		align-items: center;
		gap: 20px;
		color: inherit;
		text-decoration: none;
		font-size: 16px;
		font-weight: 600;
		width:210px; 
		height:20px; 
		border-bottom:solid 2px;
		transition: all 0.9s ease;
	}

	.link-arrow3 {
		display: flex;
		align-items: center;
		gap: 20px;
		color: inherit;
		text-decoration: none;
		font-size: 16px;
		font-weight: 600;
		width:210px; 
		height:20px; 
		transition: all 0.9s ease;
	}

	.link-arrow3:hover {
		color: var(--azzurro);
	}

	.link-arrow3:hover .arrow-img {
		transform: rotate(45deg);
		content: url("{{ asset('web/images/arrow_azzurra.png') }}");
	}

	.link-arrow3:hover .arrow-img-reflect {
		transform: rotate(-45deg) scaleX(-1);
		content: url("{{ asset('web/images/arrow_azzurra.png') }}");
	}
	.arrow-img {
		width: 13px;
		height: 13px;
		transition: transform 0.3s ease;
	}
	.arrow-img-reflect {
		width: 13px;
		height: 13px;
		transform: scaleX(-1);
		transition: transform 0.3s ease;
	}
	
	.list-link {
		display: flex;
		gap: 5px;
		align-items: center;
		cursor: pointer;
	}

	.list-link span {
		font-size: 12px;
		font-weight: 500;
		transition: font-weight 0.2s ease;
	}

	.list-link:hover span {
		font-weight: 700;
	}
	.list-link.no-hover:hover  {
		font-weight: 500;
	}

	.list-link:hover .list-icon {
		content: url("{{ asset('web/images/star_red.png') }}");
	}
	.list-link.no-hover:hover .list-icon {
		content: url("{{ asset('web/images/star_grey.png') }}"); /* resta grigia */
	}
	
	.list-icon{
		width:13px;
		height:15px;
	}
	
	.btnYccsWhite{
		border:solid 1px #000;
		background:#fff;
		color:#000;
		padding:5px 10px;
		border-radius:13px !important;
		font-size:12px;
		font-weight:600;
		text-align:center;
		cursor:pointer;
		transition: all 0.5s ease;
	}
	.btnYccsWhite:hover{
		border:solid 1px var(--azzurro);
		color:#fff;
		background: linear-gradient(to right, #009cff, #0062a0);
	}
	
	.btnYccsGradient{
		background: linear-gradient(to right, var(--azzurro) 0%, #0062a0 100%);
		color:#fff;
		padding:5px 10px;
		border-radius:13px !important;
		font-size:16px;
		font-weight:500;
		text-align:center;
		cursor:pointer;
		transition: all 0.5s ease;
	}
	.btnYccsGradient:hover{
		background: linear-gradient(to left, var(--azzurro) 0%, #0062a0 100%);
	}
	
	.btnYccsAnnulla{
		border:solid 1px #000;
		background:#000;
		color:#fff;
		padding:5px 10px;
		border-radius:13px !important;
		font-size:12px;
		font-weight:600;
		text-align:center;
		cursor:pointer;
		transition: all 0.5s ease;
	}
	.btnYccsAnnulla:hover{
		border:solid 1px grey;
		background: grey;
	}
	 
	form input[type="text"],
	form input[type="url"],
	form input[type="email"],
	form input[type="number"],
	form input[type="tel"],
	form input[type="password"],
	form select {
		width: 100%;
		padding: 9px 10px;
		border: 1px solid var(--grey);;
		background: var(--grey);
		border-radius: 6px;
		font-family: Montserrat, sans-serif;
		font-size: 12px;
		color: #000;
		box-sizing: border-box;
		margin-bottom: 8px;
		transition: border-color 0.2s, box-shadow 0.2s;
	}
	form textarea {
		width: 100%;
		padding: 9px 10px;
		border: 1px solid var(--grey);;
		background: var(--grey);
		border-radius: 6px;
		font-family:  Montserrat, sans-serif;
		font-size: 12px;
		color: #000;
		box-sizing: border-box;
		margin-bottom: 8px;
		transition: border-color 0.2s, box-shadow 0.2s;
		resize: vertical; /* o none / both */
		min-height: 80px; /* opzionale */
	}
	
	.noscrollbar {
	  overflow-y: scroll;      /* abilita lo scroll verticale */
	  scrollbar-width: none;   /* Firefox */
	  -ms-overflow-style: none;/* IE 10+ */
	}

	.noscrollbar::-webkit-scrollbar {
	  display: none;           /* Chrome, Safari */
	}
	
	#pagContainer{
		width:1400px; 
		margin:50px auto;
	}
	@media screen and (max-width: 1400px) {
		#pagContainer{
			width:calc(100% - 100px);
			margin:50px auto;
			padding:0 50px;
		}
	}
	
	@media screen and (max-width: 991px) {
		h3.gradient-title{
			font-size: 50px !important;
			line-height: 1.2 !important;
		}
	}
	@media screen and (max-width: 500px) {
		#pagContainer{
			width:calc(100% - 40px);
			padding:0 20px;
		}
		h3.gradient-title{
			font-size: 40px !important;
			line-height: 1.2 !important;
		}
	}
</style>