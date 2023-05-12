<?php require APPROOT . '/views/layout/header.php'; ?>

<div class=" d-flex justify-content-center">
  <div class="container emp-profile" style="padding: 50px;">
    <h2>Accoun Setting</h2>
    <div class="row">
      <div class="col-md-4">
        <div id="body-overlay">
          <div><img src="loading.gif" width="64px" height="64px" /></div>
        </div>
        <div class="bgColor">
          <form id="uploadForm" action="upload.php" method="post">
            <div id="targetOuter">
              <div id="targetLayer">
                <?php if (isset($_SESSION['user_avatar'])){?><img
                  src="<?php echo URLROOT?>/public/assets/img/<?php echo $_SESSION['user_avatar']?>" width="200px"
                  height="200px" class="upload-preview" /><?php }?>
              </div>
              <img src="<?php echo URLROOT; ?>/public/assets/img/no-avatar.png" class="icon-choose-image" />
              <div class="icon-choose-image" onClick="showUploadOption()"></div>
              <div id="profile-upload-option">
                <div class="profile-upload-option-list"><input name="userImage" id="userImage" type="file"
                    class="inputFile" onChange="showPreview(this);"></input><span>Choose</span></div>
                <div class="profile-upload-option-list" onClick="hideUploadOption(); window.location.reload();">Cancel
                </div>
              </div>
            </div>
            <div class="d-flex justify-content-center">
              <input type="submit" value="Change" class="btnSubmit" onClick="hideUploadOption();" />
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
function showPreview(objFileInput) {
  hideUploadOption();
  if (objFileInput.files[0]) {
    var fileReader = new FileReader();
    fileReader.onload = function(e) {
      $("#targetLayer").html('<img src="' + e.target.result +
        '" width="200px" height="200px" class="upload-preview" />');
      $("#targetLayer").css('opacity', '0.7');
      $(".icon-choose-image").css('opacity', '0');
    }
    fileReader.readAsDataURL(objFileInput.files[0]);
  }
}

function showUploadOption() {
  $("#profile-upload-option").css('display', 'block');
}

function hideUploadOption() {
  $("#profile-upload-option").css('display', 'none');
}

function removeProfilePhoto() {
  hideUploadOption();
  $("#userImage").val('');
  $.ajax({
    url: "remove.php",
    type: "POST",
    data: new FormData(this),
    beforeSend: function() {
      $("#body-overlay").show();
    },
    contentType: false,
    processData: false,
    success: function(data) {
      $("#targetLayer").html('');
      setInterval(function() {
        $("#body-overlay").hide();
      }, 500);
    },
    error: function() {}
  });
}
$(document).ready(function(e) {
  $("#uploadForm").on('submit', (function(e) {
    e.preventDefault();
    $.ajax({
      url: "<?php echo URLROOT; ?>/users/avatar",
      type: "POST",
      data: new FormData(this),
      beforeSend: function() {
        $("#body-overlay").show();
      },
      contentType: false,
      processData: false,
      success: function(data) {
        $("#targetLayer").css('opacity', '1');
        setInterval(function() {
          $("#body-overlay").hide();
        }, 500);
      },
      error: function() {}
    });
  }));
});

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
          window.location.reload();
        }
      })
    });
  })
})
</script>

<?php require APPROOT . '/views/layout/footer.php'; ?>