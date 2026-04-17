<script language="javascript">		
    $(document).ready(function() {

        // Data Tables
        if( $.fn.dataTable ) {
            $(".mws-datatable").dataTable();
            var uTable = $(".mws-datatable-fn").dataTable({
                sPaginationType: "full_numbers",
				bFilter: false,
				aoColumns: [
					null, 
					null,
					null, 
					null, 
					{ bSortable: false }
				]
            });
			
			<?php  if($azione=="cancella" && $id_canc) { ?>
			var r = confirm('Sei sicuro di voler cancellare questo record?');
			if (r) {
				var nexturl = "admin.php?cmd=<?php echo $cmd?>&id_rife=<?php echo $id_rife?>&id_riferimento=<?php echo $id_riferimento?>&pag_att=<?php echo $pag_att?>";
				var thisid = "<?php echo $id_canc?>";
				/* perchè non funziona sempre il post di ajax ?? 
				$.post( nexturl, {conferma: thisid} ) ;*/
				window.location= nexturl+"&id_canc="+thisid+"&conferma=yes";
			}	
			<?php  } elseif ($id_canc=="") { ?>
			uTable.fnPageChange('first',true);
			<?php  } ?>
        }

    });
</script>