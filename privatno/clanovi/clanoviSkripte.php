<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
//DVD
	$( "#uvjetDvd" ).autocomplete({
		source: "traziDvd.php?clan=<?php echo $_GET["sifra"] ?>",
		minLength: 3,
	    focus: function( event, ui ) {
	    	event.preventDefault;
	    },
	    select: function(event, ui) {
	        $(this).val('').blur();
	        event.preventDefault();
	        spremiUBazuDvd(ui.item);
	    }
		}).data( "ui-autocomplete" )._renderItem = function( ul, objektDvd ) {
	      return $( "<li><img style=\"width: 50px\" src=\"https://vignette.wikia.nocookie.net/mafiagame/images/2/23/Unknown_Person.png/revision/latest?cb=20151119092211\" />" )
	        .append( "<a>" + objektDvd.naziv + "</a>" )
	        .appendTo( ul );
	}
	
	function spremiUBazuDvd(drustvo){
		$.get( "dodajDvd.php?clan=<?php echo $_GET["sifra"] ?>&dvd=" + drustvo.sifra, 
			function( vratioServer ) {
			if(vratioServer=="OK"){
				$("#clanDvd").append("<tr id=\"red_" + drustvo.sifra + "\" style=\"display: none\">" + 
				"<td>" + drustvo.naziv + "</td>" + 
				"<td><i id=\"b_" + drustvo.sifra + "\" title=\"Brisanje\" class=\"step fi-page-delete size-48 brisanjeDvd\"></i></td>" + 
				"</tr>");
				$("#red_" + drustvo.sifra).fadeIn();
				definirajBrisanjeDvd();
			}else{
				alert(vratioServer);
			}
		});
	}
	 function definirajBrisanjeDvd(){
		$(".brisanjeDvd").click(function(){
		var element = $(this);
		var id = element.attr("id").split("_")[1];
		$.get( "obrisiDvd.php?clan=<?php echo $_GET["sifra"] ?>&dvd=" + id, 
			function( vratioServer ) {
			if(vratioServer=="OK"){
				element.parent().parent().remove();
			}else{
				console.log(vratioServer);
			}
		});
		return false;
	});
	}
	
	definirajBrisanjeDvd();

	
//CIN
	$( "#uvjetCin" ).autocomplete({
		source: "traziCin.php?clan=<?php echo $_GET["sifra"] ?>",
		minLength: 3,
	    focus: function( event, ui ) {
	    	event.preventDefault;
	    },
	    select: function(event, ui) {
	        $(this).val('').blur();
	        event.preventDefault();
	        spremiUBazuCin(ui.item);
	    }
		}).data( "ui-autocomplete" )._renderItem = function( ul, objektCin ) {
	      return $( "<li><img style=\"width: 50px\" src=\"https://vignette.wikia.nocookie.net/mafiagame/images/2/23/Unknown_Person.png/revision/latest?cb=20151119092211\" />" )
	        .append( "<a>" + objektCin.naziv_cina + "</a>" )
	        .appendTo( ul );
	}
	
	function spremiUBazuCin(cin){
		$.get( "dodajCin.php?clan=<?php echo $_GET["sifra"] ?>&cin=" + cin.sifra, 
			function( vratioServer ) {
			if(vratioServer=="OK"){
				$("#clanCin").append("<tr id=\"red_" + cin.sifra + "\" style=\"display: none\">" + 
				"<td>" + cin.naziv_cina + "</td>" + 
				"<td>" + cin.datum_cina + "</td>" +
				"<td><i id=\"b_" + cin.sifra + "\" title=\"Brisanje\" class=\"step fi-page-delete size-48 brisanjeCin\"></i></td>" + 
				"</tr>");
				$("#red_" + cin.sifra).fadeIn();
				definirajBrisanjeCin();
			}else{
				alert(vratioServer);
			}
		});
	}
	 function definirajBrisanjeCin(){
		$(".brisanjeCin").click(function(){
		var element = $(this);
		var id = element.attr("id").split("_")[1];
		$.get( "obrisiCin.php?clan=<?php echo $_GET["sifra"] ?>&cin=" + id, 
			function( vratioServer ) {
			if(vratioServer=="OK"){
				element.parent().parent().remove();
			}else{
				console.log(vratioServer);
			}
		});
		return false;
	});
	}
	
	definirajBrisanjeCin();

	
	//FUNKCIJA
	$( "#uvjetFunkcija" ).autocomplete({
		source: "traziFunkcija.php?clan=<?php echo $_GET["sifra"] ?>",
		minLength: 3,
	    focus: function( event, ui ) {
	    	event.preventDefault;
	    },
	    select: function(event, ui) {
	        $(this).val('').blur();
	        event.preventDefault();
	        spremiUBazuFunkcija(ui.item);
	    }
		}).data( "ui-autocomplete" )._renderItem = function( ul, objektFunkcija ) {
	      return $( "<li><img style=\"width: 50px\" src=\"https://vignette.wikia.nocookie.net/mafiagame/images/2/23/Unknown_Person.png/revision/latest?cb=20151119092211\" />" )
	        .append( "<a>" + objektFunkcija.naziv_funkcije + "</a>" )
	        .appendTo( ul );
	}
	
	function spremiUBazuFunkcija(funkcija){
		$.get( "dodajFunkcija.php?clan=<?php echo $_GET["sifra"] ?>&funkcija=" + funkcija.sifra, 
			function( vratioServer ) {
			if(vratioServer=="OK"){
				$("#clanFunkcija").append("<tr id=\"red_" + funkcija.sifra + "\" style=\"display: none\">" + 
				"<td>" + funkcija.naziv_funkcije + "</td>" + 
				"<td>" + funkcija.datum_pocetka_funkcije + "</td>" +
				"<td>" + funkcija.datum_zavrsetka_funkcije + "</td>" +
				"<td><i id=\"b_" + funkcija.sifra + "\" title=\"Brisanje\" class=\"step fi-page-delete size-48 brisanjeFunkcija\"></i></td>" + 
				"</tr>");
				$("#red_" + funkcija.sifra).fadeIn();
				definirajBrisanjeFunkcija();
			}else{
				alert(vratioServer);
			}
		});
	}
	 function definirajBrisanjeFunkcija(){
		$(".brisanjeFunkcija").click(function(){
		var element = $(this);
		var id = element.attr("id").split("_")[1];
		$.get( "obrisiFunkcija.php?clan=<?php echo $_GET["sifra"] ?>&funkcija=" + id, 
			function( vratioServer ) {
			if(vratioServer=="OK"){
				element.parent().parent().remove();
			}else{
				console.log(vratioServer);
			}
		});
		return false;
	});
	}
	
	definirajBrisanjeFunkcija();
	
</script>