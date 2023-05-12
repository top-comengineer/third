<nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#165424;">
  <div class="container">
    <a class="navbar-brand" href="<?php echo URLROOT;?>">
      <img src="<?php echo URLROOT; ?>/public/assets/img/logo.png" width="60px" alt="logo" />
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
      aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav mr-auto">
        <!-- <li class="nav-item ">
          <a class="nav-link" href="<?php echo URLROOT;?>">Home</a>
        </li> -->
        <!-- <li class="nav-item">
          <a class="nav-link" href="<?php echo URLROOT;?>/pages/about">About</a>
        </li> -->
        <?php if(isset($_SESSION['user_id'])): ?>
        <li class="nav-item ">
          <a class="nav-link" href="<?php echo URLROOT;?>/entities">Dashboard</a>
        </li>
        <?php endif; ?>
      </ul>

      <ul class="navbar-nav ml-auto">
        <?php if(isset($_SESSION['user_role'])): ?>
        <?php if($_SESSION['user_role'] === 1): ?>

        <li class="nav-item">
          <a class="nav-link" href="<?php echo URLROOT; ?>/users/admin">Admin</a>
        </li>

        <?php endif; ?>
        <?php endif; ?>

        <?php if(isset($_SESSION['user_id'])): ?>

        <li class="nav-item">
          <a class="nav-link" href="<?php echo URLROOT; ?>/users/profile">Profile </a>
        </li>

        <li class="nav-item ">
          <a class="nav-link" href="<?php echo URLROOT;?>/users/logout">Logout</a>
        </li>

        <?php else :?>

        <li class="nav-item ">
          <a class="nav-link" href="<?php echo URLROOT;?>/users/register">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo URLROOT;?>/users/login">Login</a>
        </li>

        <?php endif; ?>
      </ul>
    </div>
  </div>

</nav>