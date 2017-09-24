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
		$.get( "dodajClan.php?intervencija=<?php echo $_GET["sifra"] ?>&clan=" + clan.sifraClan + "&dvd=" + clan.sifraDvd, 
			function( vratioServer ) {
			if(vratioServer=="OK"){
				$("#intervencijaClan").append("<tr id=\"red_" + clan.sifra + "\" style=\"display: none\">" + 
				"<td>" + clan.imePrezime + "</td>" + 
				"<td><i id=\"b_" + clan.sifra + "\" title=\"Brisanje\" class=\"step fi-page-delete size-48 brisanjeClan\"></i></td>" + 
				"</tr>");
				$("#red_" + clan.sifra).fadeIn();
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
	});
	
</script>