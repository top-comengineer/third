<?php require APPROOT .'/views/layout/header.php'; ?>

<div class="login-dark">
  <form action="<?php echo URLROOT; ?>/users/login" method="post">
    <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
    <div class="form-group">
      <input class="form-control <?php echo (!empty($data['email_error'])) ? 'is-invalid' : ''; ?>" type="email"
        name="email" placeholder="Email" value="<?php echo $data['email']; ?>">
      <span class="invalid-feedback"><?php echo $data['email_error']; ?></span>
    </div>
    <div class="form-group">
      <input type="password" name="password" placeholder="Password"
        class="form-control <?php echo (!empty($data['password_error'])) ? 'is-invalid' : ''; ?>"
        value="<?php echo $data['password']; ?>">
      <span class="invalid-feedback"><?php echo $data['password_error']; ?></span>
    </div>
    <div class="row">
      <div class="col">
        <input type="submit" value="Login" class="btn btn-primary btn-block">
      </div>
      <div class="col">
        <a href="<?php echo URLROOT; ?>/users/register" class="btn btn-secondary btn-block">Register</a>
      </div>
    </div>
  </form>
</div>

<?php require APPROOT .'/views/layout/footer.php'; ?>