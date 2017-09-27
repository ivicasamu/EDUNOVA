<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>

//DVD
	$( "#uvjetDvd" ).autocomplete({
		source: "traziDvd.php?intervencija=<?php echo $_GET["sifra"] ?>",
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
		$.get( "dodajDvd.php?intervencija=<?php echo $_GET["sifra"] ?>&dvd=" + drustvo.sifra, 
			function( vratioServer ) {
			if(vratioServer=="OK"){
				$("#intervencijaDvd").append("<tr id=\"red_" + drustvo.sifra + "\" style=\"display: none\">" + 
				"<td>" + drustvo.naziv + "</td>" + 
				"<td><i id=\"b_" + drustvo.sifra + "\" title=\"Brisanje\" class=\"step fi-page-delete size-48 brisanjeDvd\"></i></td>" + 
				"</tr>");
				$("#dvd_" + drustvo.sifra).fadeIn();
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
		$.get( "obrisiDvd.php?intervencija=<?php echo $_GET["sifra"] ?>&dvd=" + id, 
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
	
	
	$( "#uvjetDvd" ).focus(function() {
		$('html,body').animate({ scrollTop: 1500 }, 'slow');
	})
	
//CLAN	
	$( "#uvjetClan" ).autocomplete({
		source: "traziClan.php?intervencija=<?php echo $_GET["sifra"] ?>",
		minLength: 3,
	    focus: function( event, ui ) {
	    	event.preventDefault;
	    },
	    select: function(event, ui) {
	        $(this).val('').blur();
	        event.preventDefault();
	        spremiUBazuClan(ui.item);
	    }
		}).data( "ui-autocomplete" )._renderItem = function( ul, objektClan ) {
	      return $( "<li><img style=\"width: 50px\" src=\"https://vignette.wikia.nocookie.net/mafiagame/images/2/23/Unknown_Person.png/revision/latest?cb=20151119092211\" />" )
	        .append( "<a>" + objektClan.imePrezime + " - " + objektClan.naziv + "</a>" )
	        .appendTo( ul );
	}
	
	function spremiUBazuClan(clan){
		console.log(clan.sifraClan);
		$.get( "dodajClan.php?intervencija=<?php echo $_GET["sifra"] ?>&clan=" + clan.sifra, 
			function( vratioServer ) {
			if(vratioServer=="OK"){
				$("#intervencijaClan").append("<tr id=\"red_" + clan.sifra + "\" style=\"display: none\">" + 
				"<td>" + clan.imePrezime + "</td>" + 
				"<td>" + clan.naziv + "</td>" + 
				"<td><i id=\"b_" + clan.sifra + "\" title=\"Brisanje\" class=\"step fi-page-delete size-48 brisanjeClan\"></i></td>" + 
				"</tr>");
				$("#clan_" + clan.sifra).fadeIn();
				definirajBrisanjeClan();
			}else{
				alert(vratioServer);
			}
		});
	}
	 function definirajBrisanjeClan(){
		$(".brisanjeClan").click(function(){
		var element = $(this);
		var id = element.attr("id").split("_")[1];
		$.get( "obrisiClan.php?intervencija=<?php echo $_GET["sifra"] ?>&clan=" + id, 
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
	
	definirajBrisanjeClan();
	
	
	$( "#uvjetClan" ).focus(function() {
		$('html,body').animate({ scrollTop: 1500 }, 'slow');
	})
	
	//VOZILO	
	$( "#uvjetVozilo" ).autocomplete({
		source: "traziVozilo.php?intervencija=<?php echo $_GET["sifra"] ?>",
		minLength: 3,
	    focus: function( event, ui ) {
	    	event.preventDefault;
	    },
	    select: function(event, ui) {
	        $(this).val('').blur();
	        event.preventDefault();
	        spremiUBazuVozilo(ui.item);
	    }
		}).data( "ui-autocomplete" )._renderItem = function( ul, objektVozilo ) {
	      return $( "<li><img style=\"width: 50px\" src=\"https://vignette.wikia.nocookie.net/mafiagame/images/2/23/Unknown_Person.png/revision/latest?cb=20151119092211\" />" )
	        .append( "<a>" + objektVozilo.vrsta_vozila + " - " + objektVozilo.reg_oznaka + " - "  + objektVozilo.naziv + "</a>" )
	        .appendTo( ul );
	}
	
	function spremiUBazuVozilo(vozilo){
		console.log(vozilo.sifraVozilo);
		$.get( "dodajVozilo.php?intervencija=<?php echo $_GET["sifra"] ?>&vozilo=" + vozilo.sifra, 
			function( vratioServer ) {
			if(vratioServer=="OK"){
				$("#intervencijaVozilo").append("<tr id=\"red_" + vozilo.sifra + "\" style=\"display: none\">" + 
				"<td>" + vozilo.vrsta_vozila + "</td>" + 
				"<td>" + vozilo.reg_oznaka + "</td>" + 
				"<td>" + vozilo.naziv + "</td>" + 
				"<td><i id=\"b_" + vozilo.sifra + "\" title=\"Brisanje\" class=\"step fi-page-delete size-48 brisanjeVozilo\"></i></td>" + 
				"</tr>");
				$("#vozilo_" + vozilo.sifra).fadeIn();
				definirajBrisanjeVozilo();
			}else{
				alert(vratioServer);
			}
		});
	}
	 function definirajBrisanjeVozilo(){
		$(".brisanjeVozilo").click(function(){
		var element = $(this);
		var id = element.attr("id").split("_")[1];
		$.get( "obrisiVozilo.php?intervencija=<?php echo $_GET["sifra"] ?>&vozilo=" + id, 
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
	
	definirajBrisanjeVozilo();
	
	
	$( "#uvjetVozilo" ).focus(function() {
		$('html,body').animate({ scrollTop: 1800 }, 'slow');
	});
	
</script>