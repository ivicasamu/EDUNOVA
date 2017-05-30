<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<?php
		include_once 'head.php';
		?>
	</head>
	<body>
		<div class="row columns">
			<h1>Domaća zadaća 02</h1>
			<h2>2017-05-30</h2>
		</div>
		<div class="row">
			<div class="large-12 medium-6 small-12 columns">
				<div class="callout">
					<h4>Upisani brojevi:</h4>
						Broj 1: <?php echo $_GET['broj1']; ?>,<br>
						Broj 2: <?php echo $_GET['broj2']; ?>,<br>
						Broj 3: <?php echo $_GET['broj3']; ?>,<br>
						Broj 4: <?php echo $_GET['broj4']; ?>,<br>
						Broj 5: <?php echo $_GET['broj5']; ?>
				</div>
			</div>
			<div class="large-6 medium-6 small-12 columns">
				<div class="callout">
					<h4 >Zbroj upisanih brojeva:</h4>
						<?php $zbroj = $_GET["broj1"]+$_GET["broj2"]+$_GET["broj3"]+$_GET["broj4"]+$_GET["broj5"]; ?>
						<?php echo $_GET['broj1']; ?> +
						<?php echo $_GET['broj2']; ?> +
						<?php echo $_GET['broj3']; ?> +
						<?php echo $_GET['broj4']; ?> +
						<?php echo $_GET['broj5']; ?> =
						<?php echo $zbroj;?>
				</div>
			</div>
			<div class="large-6 medium-6 small-12 columns">
				<div class="callout">
					<h4>Razlika upisanih brojeva:</h4>
						<?php $razlika = $_GET["broj1"]-$_GET["broj2"]-$_GET["broj3"]-$_GET["broj4"]-$_GET["broj5"]; ?>
						<?php echo $_GET['broj1']; ?> -
						<?php echo $_GET['broj2']; ?> -
						<?php echo $_GET['broj3']; ?> -
						<?php echo $_GET['broj4']; ?> -
						<?php echo $_GET['broj5']; ?> =
						<?php echo $razlika; ?>
				</div>
			</div>
			<div class="large-6 medium-6 small-12 columns">
				<div class="callout">
					<h4>Umnožak upisanih brojeva:</h4>
						<?php $umnozak = $_GET["broj1"]*$_GET["broj2"]*$_GET["broj3"]*$_GET["broj4"]*$_GET["broj5"]; ?>
						<?php echo $_GET['broj1']; ?> *
						<?php echo $_GET['broj2']; ?> *
						<?php echo $_GET['broj3']; ?> *
						<?php echo $_GET['broj4']; ?> *
						<?php echo $_GET['broj5']; ?> =
						<?php echo $umnozak; ?>
				</div>
			</div>
			<div class="large-6 medium-6 small-12 columns">
				<div class="callout">
					<h4>Količnik rezultata umnoška i rezultata zbroja:</h4>
						<?php $kolicnik = $umnozak / $zbroj; ?>
						<?php echo $umnozak; ?> /
						<?php echo $zbroj; ?> =
						<?php echo $kolicnik; ?>
				</div>
			</div>
		</div>
		<?php include_once 'podnozje.php' ?>
		<?php
		include_once 'skripte.php';
		?>
	</body>
</html>
