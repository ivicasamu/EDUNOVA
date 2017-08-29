<div class="large-3 medium-4 columns end">
	<div class="callout">
		<div class="row">
			<div class="large-4 medium-4 columns hide-for-small-only"style="min-height: 130px;"><img src="<?php echo $putanjaAPP; ?>img/nemaSliku.png" /></div>
			<div class="large-8 medium-8 columns" style="font-size: 1.5em; font-weight: bold; text-align: center;"><?php echo $red->ime; ?><br /><?php echo $red->prezime; ?></div>
			<div class="large-8 medium-8 columns"><b>Čin:</b> <?php echo $red->cin; ?></div>
			<div class="large-8 medium-8 columns"><b>Funkcija:</b> <?php echo $red->funkcija; ?></div>
			<div class="large-12 medium-12 columns"><b>OIB:</b><?php echo $red->oib; ?></div>
			<div class="large-12 medium-12 columns"><b>Adresa:</b> <?php echo $red->adresa; ?></div>
			<hr />
			<div class="large-6 medium-6 small-6 columns" style="text-align: center;">
				<a class="button" href="clanPromjena.php?sifra=
					<?php 
						echo $red->sifra; 
  						if(isset($_GET["uvjet"])){
  							echo "&uvjet=" . $_GET["uvjet"];
  						}
  					?>">Promjeni
  				</a>
			</div class="large-6 medium-6 small-6 columns" style="text-align: center;">
			<div>
				<a class="button alert"
					<?php if($red->clan !=0){
						echo "disabled";
					}?> 
					href="clanBrisanje.php?sifra=
					<?php 
						echo $red->sifra; 
  						if(isset($_GET["uvjet"])){
  							echo"&uvjet=". $_GET["uvjet"];
  					}?>">Obriši</a>
			</div>
		</div>
	</div>
</div>