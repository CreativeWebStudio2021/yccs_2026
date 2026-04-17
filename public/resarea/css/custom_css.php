<style>
	:root {
	  --azzurro: #009cff;
	  --azzurro-dark: #0062a0;
	  --grey: #F1F1F1;
	  --grey-dark: #F1F1F1;
	}
	body, #mws-container {
		background:#fff !important;
		background-color:#fff !important;
	}
	a{color:#333;}
	a:hover{color: #333;}
	.mws-panel .mws-panel-header{
		background: #333;
	}
	.mws-panel .mws-panel-header span{
		color:#fff;
	}
	.mws-panel .mws-panel-header{
		border:none;
		border-radius:0 !important;
	}
	.mws-panel .mws-form-inline{
		background:#fff;
	}
	.mws-form .mws-button-row {
		background:#f0f0f0;
		border-top:1px solid #f0f0f0;
	}
	
	table.mws-datatable-fn tbody tr:nth-of-type(even) {
		background-color: #f9f9f9;
	}

	table.mws-datatable-fn tbody tr:nth-of-type(odd) {
		background-color: #ffffff;
	}
	
	table.mws-datatable-fn tbody tr:hover {
		background-color: #e0f7fa;
	}
	.mws-table tbody tr.odd:hover td, .mws-table tbody tr.even:hover td{
		background-color: #e0f7fa;
	}
	.mws-table thead tr, .btn{
		background-image:none !important;
		border-radius:0 !important;
	}
	.newAdminBott{
		padding:10px 15px;
		background: linear-gradient(to right, var(--azzurro) 0%, var(--azzurro-dark) 100%);
		color:#fff;
		margin-bottom:10px;
		display:flex; gap:5px; align-items:center;
		transition:all 0.5s ease;
	}
	.newAdminBott2{
		padding:10px 15px;
		background: linear-gradient(to right, #333 0%, #8e8e8e 100%);
		color:#fff;
		margin-bottom:10px;
		display:flex; gap:5px; align-items:center;
		transition:all 0.5s ease;
	}
	a:hover{
		text-decoration:none;
	}
	.newAdminBott:hover{
		background: linear-gradient(to right, var(--azzurro) 0%, var(--azzurro-dark) 60%);
		color:#fff;
	}
	.newAdminBott2:hover{
		background: linear-gradient(to right, #333 0%, #8e8e8e 60%);
	}
	#mws-sidebar{
		background: linear-gradient(to right, var(--azzurro-dark) 40%, var(--azzurro) 100%);
		padding-top:0;
	}
	#mws-navigation{
		position:fixed; 
		left:0; 
		bottom:0; 
		//width:200px; 
		width:60px; 
		height:calc(100vh - 84px); 
		overflow-y:scroll;
		overflow-x:hidden;
		background: var(--azzurro-dark);
		scrollbar-width: none;
		-ms-overflow-style: none;
		transition:all 0.5s ease;
	}
	#mws-navigation::-webkit-scrollbar {
	  display: none;
	}
	#mws-header{
		width:100%;
		position:fixed; 
		left:0; 
		top:0; 
	}
	.scritte_menu{
		//display:none;
		opacity:0;
		transition:opacity 0.3s ease;
	}
	#mws-navigation > ul > li{
		min-height:45px !important; 
		//height:45px;
	}
	#mws-container{
		margin-left:60px;
		transition:all 0.5s ease;
	}
	#mws-navigation > ul > li > ul > li > a{
		width:100%;
	}
	.mws-inset{
		border-radius:0;
	}
	
	select, 
	textarea, 
	input[type="text"], 
	input[type="password"], 
	input[type="datetime"], 
	input[type="datetime-local"], 
	input[type="date"], 
	input[type="month"], 
	input[type="time"], 
	input[type="week"], 
	input[type="number"], 
	input[type="email"], 
	input[type="url"], 
	input[type="search"], 
	input[type="tel"], 
	input[type="color"] {
		border-radius:0;
		z-index:0; 
	}
	
	.dataTables_wrapper .dataTables_paginate{
		border-radius:0;
	}
	
	.popup{
		position:fixed; 
		width:90%; 
		height:80%; 
		background:#fff; 
		top:100px; 
		left:5%; 
		display:none; 
		border:solid 1px #808080; 
		border-radius:2px; 
		text-align:center;  
		z-index:0; 
		box-shadow:3px 3px 3px 3px #0062a0;
	}
	
	#cancella_sel{
		position:fixed;
		bottom:5px;
		left:65px;
		padding:10px 15px;
		background: linear-gradient(to right, #333 0%, #8e8e8e 100%);
		color:#fff;
		display:flex; gap:5px; align-items:center;
		transition:all 0.5s ease;
		transition:all 0.5s ease;
	}
	
	#cancella_sel input{
		background:none;
		border:none;
		color:#fff;
	}
	
	.btn-danger{
		border:none;
	}
 </style>