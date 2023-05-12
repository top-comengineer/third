<?php require APPROOT .'/views/layout/header.php'; ?>

<div class="login-dark signup-dark">
  <form action="<?php echo URLROOT; ?>/users/register" method="post">
    <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
    <div class="form-group">
      <label for="name">Name: <sup>*</sup></label>
      <input type="text" name="username"
        class="form-control form-control-lg <?php echo (!empty($data['username_error'])) ? 'is-invalid' : ''; ?>"
        value="<?php echo $data['username']; ?>">
      <span class="invalid-feedback"><?php echo $data['username_error']; ?></span>
    </div>
    <div class="form-group">
      <label for="email">Email: <sup>*</sup></label>
      <input type="email" name="email"
        class="form-control form-control-lg <?php echo (!empty($data['email_error'])) ? 'is-invalid' : ''; ?>"
        value="<?php echo $data['email']; ?>">
      <span class="invalid-feedback"><?php echo $data['email_error']; ?></span>
    </div>
    <div class="form-group">
      <label for="password">Password: <sup>*</sup></label>
      <input type="password" name="password"
        class="form-control form-control-lg <?php echo (!empty($data['password_error'])) ? 'is-invalid' : ''; ?>"
        value="<?php echo $data['password']; ?>">
      <span class="invalid-feedback"><?php echo $data['password_error']; ?></span>
    </div>
    <div class="form-group">
      <label for="confirm_password">Confirm Password: <sup>*</sup></label>
      <input type="password" name="confirm_password"
        class="form-control form-control-lg <?php echo (!empty($data['confirm_password_error'])) ? 'is-invalid' : ''; ?>"
        value="<?php echo $data['confirm_password']; ?>">
      <span class="invalid-feedback"><?php echo $data['confirm_password_error']; ?></span>
    </div>
    <div class="row">
      <div class="col">
        <input type="submit" value="Register" class="btn btn-primary btn-block">
      </div>
      <div class="col">
        <a href="<?php echo URLROOT; ?>/users/login" class="btn btn-secondary btn-block"
          class="btn btn-secondary btn-block">Login</a>
      </div>
    </div>
  </form>
</div>


<?php require APPROOT .'/views/layout/footer.php'; ?>