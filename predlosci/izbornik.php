<div class="title-bar" data-responsive-toggle="app_menu" data-hide-for="large">
	<button class="menu-icon" type="button" data-toggle></button>
	<div class="title-bar-title">
		IZBORNIK
	</div>
</div>

<div class="top-bar" id="app_menu" data-animate="">
	<div class="top-bar-left">
		<ul class="vertical large-horizontal menu" data-responsive-menu="drilldown large-dropdown">
			<?php if(isset($_SESSION["logiran"])): ?>
				<li><a href="<?php echo $putanjaAPP ?>privatno/nadzornaPloca.php">NADZORNA PLOČA</a></li>
				<li><a href="#">MODULI</a>
					<ul class="vertical menu">
						<li><a href="<?php echo $putanjaAPP ?>privatno/drustvo/drustvo.php">DRUŠTVO</a></li>
						<li><a href="<?php echo $putanjaAPP ?>privatno/clan/clan.php">ČLANOVI</a></li>
						<li><a href="#">VOZILA</a></li>
					</ul>
				</li>
				<li><a href="#">INTERVENCIJE</a></li>
				<li><a href="#">KORISNI LINKOVI</a>
					<ul class="vertical menu">
					<li><a href="https://github.com/ivicasamu/EDUNOVA/tree/SummerProject01">GITHUB KOD</a></li>
					<li><a href="https://github.com/ivicasamu/EDUNOVA/blob/SummerProject01/database/ERA_DIAGRAM.png">ERA DIAGRAM</a></li>
				</ul>
			</li>
			<?php endif; ?>
			<li><a href="<?php echo $putanjaAPP ?>javno/kontakt.php">KONTAKT</a></li>
			<li>
				<?php if(!isset($_SESSION["logiran"])): ?>
					<a href="<?php echo $putanjaAPP; ?>javno/prijava.php" class="button expanded">PRIJAVA</a>
				<?php else: ?>
					<a href="<?php echo $putanjaAPP; ?>javno/odjava.php" class="alert button expanded">
					ODJAVA <?php echo $_SESSION["logiran"]->ime. " " .$_SESSION["logiran"]->prezime; ?></a>
				<?php endif; ?>
			</li>
		</ul>
	</div>
</div>
