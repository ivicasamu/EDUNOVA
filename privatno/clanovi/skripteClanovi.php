<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    	<script>
			$( "#uvjetDvd" ).autocomplete({
			    source: "traziDvd.php?clan=<?php echo $_GET["sifra"] ?>",
			    minLength: 3,
			    focus: function( event, ui ) {
			    	event.preventDefault();
			    	},
			    select: function(event, ui) {
			        $(this).val('').blur();
			        event.preventDefault();
			        //spremiUBazu(ui.item);
			        console.log(ui.item);
			    }
				}).data( "ui-autocomplete" )._renderItem = function( ul, objekt ) {
			      return $( "<li>" )
			      	.data( "item.autocomplete", objekt )
			        .append( "<a>" + objekt.naziv + "</a>" )
			        .appendTo( ul );
		    }
		    
		    $(".brisanjeDvd").click(function(){
		    	var element = $(this);
				var id = element.attr("id").split("_")[1];
				$.get( "obrisiDvd.php?clan=<?php echo $_GET["sifra"] ?>&dvd=" + id, 
					function( vratioServer ) {
					if(vratioServer=="OK"){
						element.parent().parent().remove();
					}else{
						alert(vratioServer);
					}
				});
		    	return false;
		    });
		    
		    $( "#uvjetCin" ).autocomplete({
			    source: "traziCin.php?clan=<?php echo $_GET["sifra"] ?>",
			    minLength: 3,
			    focus: function( event, ui ) {
			    	event.preventDefault();
			    	},
			    select: function(event, ui) {
			        $(this).val('').blur();
			        event.preventDefault();
			        //spremiUBazu(ui.item);
			        console.log(ui.item);
			    }
				}).data( "ui-autocomplete" )._renderItem = function( ul, objekt ) {
			      return $( "<li>" )
			      	.data( "item.autocomplete", objekt )
			        .append( "<a>" + objekt.naziv_cina + "</a>" )
			        .appendTo( ul );
		    }
		    
		    $(".brisanjeCin").click(function(){
		    	var element = $(this);
				var id = element.attr("id").split("_")[1];
				$.get( "obrisiCin.php?clan=<?php echo $_GET["sifra"] ?>&cin=" + id, 
					function( vratioServer ) {
					if(vratioServer=="OK"){
						element.parent().parent().remove();
					}else{
						alert(vratioServer);
					}
				});
		    	return false;
		    });
		    
		   $( "#uvjetFunkcija" ).autocomplete({
			    source: "traziFunkciju.php?clan=<?php echo $_GET["sifra"] ?>",
			    minLength: 3,
			    focus: function( event, ui ) {
			    	event.preventDefault();
			    	},
			    select: function(event, ui) {
			        $(this).val('').blur();
			        event.preventDefault();
			        //spremiUBazu(ui.item);
			        console.log(ui.item);
			    }
				}).data( "ui-autocomplete" )._renderItem = function( ul, objekt ) {
			      return $( "<li>" )
			      	.data( "item.autocomplete", objekt )
			        .append( "<a>" + objekt.funkcija + "</a>" )
			        .appendTo( ul );
		    }
		    
		    $(".brisanjeFunkcija").click(function(){
		    	var element = $(this);
				var id = element.attr("id").split("_")[1];
				$.get( "obrisiDvd.php?clan=<?php echo $_GET["sifra"] ?>&dvd=" + id, 
					function( vratioServer ) {
					if(vratioServer=="OK"){
						element.parent().parent().remove();
					}else{
						alert(vratioServer);
					}
				});
		    	return false;
		    });

		   
		</script>