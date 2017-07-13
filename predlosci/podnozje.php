<div class="row" style="text-align: center">
	<hr />
	<?php echo date("Y", getdate()[0]); ?>
	<?php
	if($_SERVER["HTTP_HOST"]==="localhost"){
		echo", <span style=\"color: red\">LOKALNO</span>";
	}
	?>
</div>