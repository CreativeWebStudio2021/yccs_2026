<div class="row">							
	<div class="col-md-6" style="padding:0 5px; margin:0;">							
		<div data-lightbox-type="gallery" class="row col-no-margin list-group">
			<span class="list-group-item active" style="font-size:0.9em"> <?php if($lingua=="ita"){?>EQUIPAGGIO IN CERCA DI UNA BARCA<?php }else{?>CREW LOOKING FOR A BOAT<?php }?> </span>
			@php
				$query_c = DB::table('crew_board')
					->select('*')
					->where('id_rife','=',$id_dett)
					->where('tipo','=','Cerco barca')
					->where('attivo','=','1')
					->orderby('data','ASC')
					->get();
				$x=1;	
			@endphp
			@foreach($query_c AS $key_c=>$value_c)
				<span class="list-group-item" style="background:#<?php if($x==1){?>f9f9f9<?php }else{?>fff<?php }?>; font-size:0.8em; line-height:14px">
					<i><?php if($lingua=="ita"){?><?php echo date_to_data(substr($value_c->data,0,10));?><?php }else{?><?php echo substr($value_c->data,0,10);?><?php }?></i><br/>
					<?php 
					$temp=explode("@@",$value_c->posizione);
					$num_pos=count($temp);
					?>
					<b><?php if($lingua=="ita"){?>Posizione<?php }else{?>Position<?php }?></b>: <?php if($num_pos==10){?><?php if($lingua=="ita"){?>Tutte<?php }else{?>All<?php }?><?php }else{?><?php echo substr(str_replace("@@",", ",$value_c->posizione),2);?><?php }?><br/>
					<b><?php if($lingua=="ita"){?>Esperienza<?php }else{?>Experience<?php }?></b>: <?php echo $value_c->esperienza;?><br/>
					<b><?php if($lingua=="ita"){?>Commenti<?php }else{?>Comments<?php }?></b>: <?php echo $value_c->commento;?>
				</span>
				@php $x++; if($x==3) $x=1; @endphp
			@endforeach			
		</div>
	</div>

	<div class="col-md-6" style="padding:0 5px;  margin:0;">							
		<div data-lightbox-type="gallery" class="row col-no-margin list-group">
			<span class="list-group-item active" style="font-size:0.9em"> <?php if($lingua=="ita"){?>BARCHE IN CERCA DI EQUIPAGGIO<?php }else{?>BOATS LOOKING FOR CREW<?php }?> </span>
			@php
				$query_c = DB::table('crew_board')
					->select('*')
					->where('id_rife','=',$id_dett)
					->where('tipo','=','Cerco equipaggio')
					->where('attivo','=','1')
					->orderby('data','ASC')
					->get();
				$x=1;	
			@endphp
			@foreach($query_c AS $key_c=>$value_c)
				<span class="list-group-item" style="background:#<?php if($x==1){?>f9f9f9<?php }else{?>fff<?php }?>; font-size:0.8em; line-height:14px">
					<i><?php if($lingua=="ita"){?><?php echo date_to_data(substr($value_c->data,0,10));?><?php }else{?><?php echo substr($value_c->data,0,10);?><?php }?></i><br/>
					<b><?php echo $value_c->nome_barca;?></i>" - <?php echo $value_c->tipo_barca;?></b><br/>					
					<?php 
					$temp=explode("@@",$value_c->posizione);
					$num_pos=count($temp);
					?>
					<b><?php if($lingua=="ita"){?>Posizioni Cercate<?php }else{?>Positions Needed<?php }?></b>: <?php if($num_pos==10){?><?php if($lingua=="ita"){?>Tutte<?php }else{?>All<?php }?><?php }else{?><?php echo substr(str_replace("@@",", ",$value_c->posizione),2);?><?php }?><br/>
					<b><?php if($lingua=="ita"){?>Esperienza Richiesta<?php }else{?>Experience Desired<?php }?></b>: <?php echo $value_c->esperienza;?><br/>
					<b><?php if($lingua=="ita"){?>Commenti<?php }else{?>Comments<?php }?></b>: <?php echo $value_c->commento;?>
				</span>
				@php $x++; if($x==3) $x=1; @endphp
			@endforeach	
		</div>
	</div>
</div>