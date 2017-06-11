<!DOCTYPE html>
<html class="no-js" lang="en">
	<head>
		<?php
		include_once 'head.php';
		?>
	</head>
	<body>
		<?php
		include_once 'zaglavlje.php';
		?>
		<div class="row page_wrap" style="margin-top:-2px">
			<!-- page wrap -->
			<div class="twelve columns">
				<!-- page wrap -->
				<?php
				include_once 'izbornik.php';
				?>

				<div class="show-for-large-up">
					<!-- Slider -->
					<div class="row">

						<div id="featured"><img src="images/demo1.jpg" alt="desc" /><img src="images/demo2.jpg" alt="desc" /><img src="images/demo3.jpg" alt="desc" />
						</div>

					</div>
				</div><!-- END Slider -->

				<div class="row">
					<div class="heading_dots hide-for-small">
						<h3 class="heading_supersize"><span class="heading_center_bg">PRIJAVA</span></h3>
					</div>
					<?php  
					if(isset($_GET["neuspio"])){
						echo"Neispravna kombinacija korisnika i lozinke";
					}
					if(isset($_GET["nemateOvlasti"])){
						echo "Morate se prvo logirati";
					}
					?>
					<div class="large-4 columns large-centered">
						<form method="post" action="autoriziraj.php">
							<label for="korisnik">Korisnik</label>
							<input type="text" name="korisnik" id="korisnik" value="<?php echo isset($_GET["korisnik"]) ? $_GET["korisnik"] : ""; ?>" />
							<label for="lozinka">Lozinka</label>
							<input type="text" name="lozinka" id="korisnik">
							<input type="submit" class="button expanded" value="Autoriziraj" />
						</form>
					</div>

				</div>

				

				</div><!-- end row -->

				<!-- end row -->
				<?php
				include_once 'podnozje.php';
				?>
				<script type="text/javascript">
					//<![CDATA[
					$('ul#menu3').nav - bar();
					//]]>
				</script>
			</div>
		</div>
		<?php
		include_once 'skripte.php';
		?>
	</body>
</html>
