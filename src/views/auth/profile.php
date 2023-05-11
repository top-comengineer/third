<?php require APPROOT . '/views/layout/header.php'; ?>

<div class=" d-flex justify-content-center">
  <div class="container emp-profile" style="padding: 50px;">
    <h2>Accoun Setting</h2>
    <div class="row">
      <div class="col-md-4 frame">
        <div class="avatar">
          <img src="<?php echo URLROOT; ?>/public/assets/img/avatar.png" alt="avatar">
          <form method="POST" enctype="multipart/form-data" name="myForm" id="uploadAvatar">
            <div id="uploadBtn" onclick="getFile()">Change</div>
            <div style='height: 0px;width: 0px; overflow:hidden;'>
              <input id="upFile" type="file" value="upload" onchange="sub(this)" />
            </div>
          </form>
        </div>
      </div>
      <div class="col-md-8">
        <div class="profile-info">
          <h3>Basic Information</h3>
          <form class="was-validated" id="profileForm">
            <div class="form-group" id="name-form">
              <label for="uname">Username:</label>
              <input type="text" class="form-control" id="uname" placeholder="Enter username" name="uname"
                value="<?php echo $_SESSION['user_name']?>" required>
              <div class="valid-feedback">Valid.</div>
              <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group" id="email-form">
              <label for="uname">Email:</label>
              <input type="email" class="form-control" id="email" placeholder="Enter email" name="email"
                value="<?php echo $_SESSION['user_email']?>" required>
              <div class="valid-feedback">Valid.</div>
              <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group" id="password-form">
              <label for="pwd">Password:</label>
              <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd" required>
              <div class="valid-feedback">Valid.</div>
              <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="d-flex justify-content-around">
              <button title="Change" data-toggle="tooltip" type="button" class="btn btn-primary" id="change-btn"
                style="display:flex;"><i class="material-icons">&#xE254;</i>
                Change</button>
              <button type="submit" class="btn btn-success" id="save-btn" style="display:flex;"><span
                  class="material-icons">save</span>
                Save</button>
              <button type="button" class="btn btn-warning" id="cancel-btn" style="display:flex;"><span
                  class="material-icons">cancel</span>
                Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
function getFile() {
  document.getElementById("upFile").click();
}

function sub(obj) {
  var file = obj.value;
  var fileName = file.split("\\");
  document.getElementById("uploadBtn").innerHTML = fileName[fileName.length - 1];
  document.myForm.submit();
  event.preventDefault();
}
$(document).ready(function() {
  // hide password input when load this page
  $("#password-form").hide();
  $("#cancel-btn").hide();
  $("#save-btn").hide();

  // change button status when "Change" button is clicked
  $("#change-btn").on("click", function() {
    $(this).css("display", "none");
    $("#password-form").show();
    $("#cancel-btn").show();
    $("#save-btn").show();
    // when click cancel button
    $("#cancel-btn").on("click", function() {
      window.location.reload();
    })

    // when click save button
    $(document).on('submit', '#profileForm', function(event) {
      event.preventDefault();
      $.ajax({
        type: "POST",
        url: "<?php echo URLROOT; ?>/users/update",
        data: $(this).serialize(),
        success: function() {
          window.location.href = "<?php echo URLROOT; ?>/users/login";
        }
      })
    });
  })
})
</script>

<?php require APPROOT . '/views/layout/footer.php'; ?>