<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<?php
		include_once 'head.php';
		?>
	</head>
	<body>
		<div class="row">
			<?php include_once'izbornik.php' ?>
			<form method="post">
				<h1>Domaca zadaca 03</h1>
				<span>Počevši od donjeg desnog ruba ispisuj brojeve dok ne poponiš tablicu X x Y</span>
				<form method="post">
					<label for="redovi">X</label>
					<input type="text" name="redovi" id="redovi" value="" placeholder="Redovi" />
					<label for="stupci">Y</label>
					<input type="text" name="stupci" id="stupci" value="" placeholder="Stupci" />
					<input type="submit" value="Kreiraj" class="expanded button" />
				</form>
				</div>
				<table>
	<?php for($i=$_POST["redovi"];$i!=0;$i--){
	?>
	<tr>
		<?php for($j=$_POST["stupci"];$j!=0;$j--){
		?>
		<td><?php echo $i * $j; ?></td>
		<?php
		}
		?>
	</tr>
	<?php
	}
?>
</table>
		
		<?php include_once 'podnozje.php' ?>
		<?php
		include_once 'skripte.php';
		?>
	</body>
</html>
