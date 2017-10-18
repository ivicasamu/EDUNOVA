<?php if($ukupnoStranica>1): ?>
	<ul class="pagination text-center" role="navigation" aria-label="Pagination">
		<?php if($ukupnoStranica>5): ?>
			<li class="pagination-previous"><a href="?stranica=1&uvjet=<?php echo $uvjet; ?>" aria-label="Prva stranica">Prva stranica</a></li>
		<?php endif; ?>
		<li class="pagination-previous"><a href="?stranica=<?php echo $stranica-1; ?>&uvjet=<?php echo $uvjet; ?>" aria-label="Prethodna stranica">Prethodna</a></li>
		<li class="current"> <?php echo $stranica . " / " . $ukupnoStranica; ?></li> 
		<li class="pagination-next"><a href="?stranica=<?php echo $stranica+1; ?>&uvjet=<?php echo $uvjet; ?>" aria-label="Sljedeća stranica">Sljedeća</a></li>
		<?php if($ukupnoStranica>5): ?>
			<li class="pagination-next"><a href="?stranica=<?php echo $ukupnoStranica; ?>&uvjet=<?php echo $uvjet; ?>" aria-label="Zadnja stranica">Zadnja stranica</a></li>
		<?php endif; ?>
	</ul>
<?php endif; ?>