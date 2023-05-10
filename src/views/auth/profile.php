<?php require APPROOT . '/views/layout/header.php'; ?>

<div class=" d-flex justify-content-center">
  <div class="container emp-profile" style="padding: 5%;">
    <div class="row">
      <div class="col-md-12s">
        <div class="profile-head">
          <h3>
            Profile
          </h3>
          <br />
        </div>
      </div>

    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tab-content profile-tab" id="myTabContent">
          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

            <div class="row">
              <div class="col-md-6">
                <label>Name</label>
              </div>
              <div class="col-md-6">
                <p><?php echo $_SESSION['user_name'] ?></p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label>Email</label>
              </div>
              <div class="col-md-6">
                <p><?php echo $_SESSION['user_email'] ?></p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label>Created Date</label>
              </div>
              <div class="col-md-6">
                <p>05/08/2023</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require APPROOT . '/views/layout/footer.php'; ?>