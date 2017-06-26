<div class="top-bar">
	<div class="top-bar-title">
		<span data-responsive-toggle="responsive-menu" data-hide-for="medium"> <button class="menu-icon dark" type="button" data-toggle></button> </span>
		<strong> <a href="<?php echo $putanjaAPP; ?>index.php"> <?php echo $naslovAplikacije; ?></a> </strong>
	</div>
	<div id="responsive-menu">
		<div class="top-bar-left">
			<ul class="dropdown menu" data-dropdown-menu>
				<?php if(isset($_SESSION["logiran"])):
				?>
				<li>
					<a ref="<?php echo $putanjaAPP; ?>/privatno/nadzornaPloca.php">Nadzorna ploča</a>
				</li>
				<li>
					<a href="#">Moduli</a>
					<ul class="menu vertical">
						<li>
							<a href="#">Članovi</a>
						</li>
						<li>
							<a href="#">Vozila</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#">Intervencije</a>
				</li>
				<?php endif; ?>
				<li>
					<a href="<?php echo $putanjaAPP; ?>javno/onama.php">O nama</a>
				</li>
			</ul>
		</div>
		<div class="top-bar-right">
			<ul class="menu">
				<li>
					<?php if(!isset($_SESSION["logiran"])):?>
					<a href="<?php echo $putanjaAPP; ?>javno/login.php" class="button expanded">Login</a>
					<?php else: ?>
					<a href="<?php echo $putanjaAPP; ?>javno/logout.php" class="alert button expanded">Logout</a>
					<?php endif; ?>
				</li>
			</ul>
		</div>
	</div>
</div>