<div class="title-bar" data-responsive-toggle="example-animated-menu" data-hide-for="medium">
  <button class="menu-icon" type="button" data-toggle></button>
  <div class="title-bar-title">IZBORNIK</div>
</div>

<div class="top-bar" id="example-animated-menu" data-animate="hinge-in-from-top spin-out">
  <div class="top-bar-left">
    <ul class="dropdown menu" data-dropdown-menu>
      <li>
      		<a href="<?php echo $putanjaAPP ?>index.php"><?php echo $naslovAPP; ?></a>
      </li>
      <li><a href="<?php echo $putanjaAPP ?>javno/onama.php">O NAMA</a></li>
      <li>
        <a href="#">One</a>
        <ul class="menu vertical">
          <li><a href="#">One</a></li>
          <li><a href="#">Two</a></li>
          <li><a href="#">Three</a></li>
        </ul>
      </li>
      <li><a href="#">Two</a></li>
      <li><a href="#">Three</a></li>
      <li>
      	<a href="<?php echo $putanjaAPP; ?>javno/prijava.php" class="button expanded">PRIJAVA</a>
      </li>
    </ul>
  </div>
</div>