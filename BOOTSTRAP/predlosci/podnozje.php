<div class="row" style="text-align: center">
	<hr />
	<?php echo date("Y", getdate()[0]); ?>
	<?php
	if($produkcija){
		echo", <span style=\"color: red\">LOKALNO</span>";
	}
	?>
</div>