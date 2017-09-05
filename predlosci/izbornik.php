<div class="title-bar" data-responsive-toggle="example-menu" data-hide-for="medium">
  <button class="menu-icon" type="button" data-toggle="example-menu"></button>
  <div id="RWDmenuTitle" class="title-bar-title"><?php echo $naslovAPP; ?></div>
</div>

<div class="top-bar" id="example-menu">
  <div class="top-bar-left">
    <ul class="dropdown menu" data-dropdown-menu>
    <?php if(!isset($_SESSION["logiran"])): ?>
    	<li class="menu-text" onclick="location.href='<?php echo $putanjaAPP;  ?>index.php';" style="cursor: pointer;">
    		<i title="Početna stranica" class="step fi-home size-60"></i>
    	</li>
    <?php endif; ?>		
   	<?php if(isset($_SESSION["logiran"])):  ?>
      	<li>
      		<a href="<?php echo $putanjaAPP ?>privatno/nadzornaPloca.php">
      			<i title="Nadzorna ploča" class="step fi-graph-bar size-60"></i>
      			<span class="hide-for-small-only"> Nadzorna ploča</span>
      		</a>
      	</li>
      	<li>
	        <a href="#">
	        	<i title="Moduli" class="step fi-asl size-60"></i>
      			<span class="hide-for-small-only"> Moduli</span>
	        </a>
	        <ul class="menu vertical">
	       		<li><a href="<?php echo $putanjaAPP ?>privatno/drustvo/index.php">Društvo</a></li>
	      		<li><a href="<?php echo $putanjaAPP ?>privatno/clan/index.php">Članovi</a></li>
	      		<li><a href="<?php echo $putanjaAPP ?>privatno/intervencije/index.php">Intervencije</a></li>
	       		<li><a href="#">Vozila</a></li>
	      	</ul>
	   	</li>
      	<?php if(isset($_SESSION["logiran"]) && $_SESSION["logiran"]->uloga==="Administrator"): ?>
      		<li>
	        <a href="#">
	        	<i title="Administracija" class="step fi-widget size-60"></i>
      			<span class="hide-for-small-only"> Administracija</span>
	        </a>
	        <ul class="menu vertical">
	        	<li><a href="<?php echo $putanjaAPP ?>privatno/operater/index.php"> Operateri</a></li>
	       		<li><a href="<?php echo $putanjaAPP ?>privatno/vrstaIntervencije/index.php"> Šifrarnik vatrogasnih intervencija</a></li>
	       		<li><a href="<?php echo $putanjaAPP ?>privatno/kategorizacijaVozila/index.php"> Šifrarnik vatrogasnih vozila</a></li>
	       		<li><a href="<?php echo $putanjaAPP ?>privatno/cin/index.php"> Šifrarnik činova u vatrogastvu</a></li>
	      		<li><a href="<?php echo $putanjaAPP ?>privatno/funkcija/index.php"> Šifrarnik funkcija u vatrogastvu</a></li>
	      		<li><a href="<?php echo $putanjaAPP ?>privatno/sredstva/index.php"> Sredstva za gašenje</a></li>
	      	</ul>
	   	</li>

      	<?php endif; ?>
      	<li>
	        <a href="#">
	        	<i title="GitHub" class="step fi-social-github size-60"></i>
      			<span class="hide-for-small-only"> GitHub</span>
	        </a>
	        <ul class="menu vertical">
	          <li><a href="https://github.com/ivicasamu/EDUNOVA/tree/SummerProject01">GitHub kod</a></li>
	          <li><a href="https://github.com/ivicasamu/EDUNOVA/blob/SummerProject01/database/ERA_DIAGRAM.png">ERA diagram</a></li>
	        </ul>
      	</li>
      <?php endif; ?>
      <li>
      		<a href="<?php echo $putanjaAPP ?>javno/kontakt.php">
      			<i title="Kontakt" class="step fi-map size-60"></i>
      			<span class="hide-for-small-only"> Kontakt</span>
      		</a>
      </li>
      <?php if(isset($_SESSION["logiran"]) && $_SESSION["logiran"]->uloga==="Korisnik"): ?>
      	<li>
      		<a href="<?php echo $putanjaAPP;  ?>privatno/operater/operaterProfil.php">
      			<i title="Profil" class="step fi-widget size-60"></i>
      			<span class="hide-for-small-only"> Profil</span>		
      		</a>
      	</li>
      <?php endif; ?>
    </ul>
  </div>
  <div class="top-bar-right">
    <ul class="menu">
      	<?php if(!isset($_SESSION["logiran"])): ?>
			<a href="<?php echo $putanjaAPP; ?>javno/prijava.php" class="button expanded">Prijava</a>
		<?php else: ?>
			<a href="<?php echo $putanjaAPP; ?>javno/odjava.php" class="alert button expanded">
			Odjava: <?php echo $_SESSION["logiran"]->ime. " " .$_SESSION["logiran"]->prezime; ?></a>
		<?php endif; ?>
    </ul>
  </div>
</div>