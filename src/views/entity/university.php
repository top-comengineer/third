<?php require APPROOT .'/views/layout/header.php'; ?>
<div class="table-responsive" style="margin-top:100px;">
  <div class="table-wrapper" style="border-radius:15px;">
    <a href="<?php echo URLROOT; ?>/entities" class="btn btn-warning"><i class="fa fa-backward"></i> Back</a>
    <div class="table-title">
      <div class="row">
        <div class="col-sm-8">
          <h2>University Expense</h2>
        </div>
        <div class="col-sm-4">
          <button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Add New</button>
        </div>
      </div>
    </div>
    <table class="table table-bordered table-stripe table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>Expense Name</th>
          <th>Expense Price</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php $totalPrice = 0;?>
        <?php foreach($data['uni_entities'] as $key => $uni_entity) :?>
        <tr>
          <td><?php echo ($key+1);?></td>
          <td><?php echo $uni_entity->name; ?></td>
          <td><?php echo $uni_entity->price; ?></td>
          <td>
            <a class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
            <a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
            <a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
          </td>
          <?php $totalPrice = $totalPrice + $uni_entity->price;?>
        </tr>
        <?php endforeach; ?>
        <tr>
          <td></td>
          <td style="font-weight:bold">Total Price</td>
          <td style="font-weight:bold"><?php echo $totalPrice?></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
  $('[data-toggle="tooltip"]').tooltip();
  var actions = $("table td:last-child").html();
  // Append table with add row form on add new button click
  $(".add-new").click(function() {
    $(this).attr("disabled", "disabled");
    var index = $("table tbody tr:last-child").index();
    var row = '<tr>' +
      '<td></td>' +
      '<td><input type="text" class="form-control" name="catName" id="catName"></td>' +
      '<td><input type="text" class="form-control" name="price" id="price"></td>' +
      '<td>' + actions + '</td>' +
      '</tr>';
    $("table").append(row);
    $("table tbody tr").eq(index + 1).find(".add, .edit").toggle();
    $('[data-toggle="tooltip"]').tooltip();
  });

  // Add row on add button click
  $(document).on("click", ".add", function() {
    var empty = false;
    var input = $(this).parents("tr").find('input[type="text"]');
    input.each(function() {
      if (!$(this).val()) {
        $(this).addClass("error");
        empty = true;
      } else {
        $(this).removeClass("error");
      }
    });
    $(this).parents("tr").find(".error").first().focus();
    if (!empty) {
      let tmpData = [];
      input.each(function() {
        tmpData.push($(this).parent("td").html($(this).val())[0].innerText)
      });
      $.ajax({
        type: "POST",
        url: '<?php echo URLROOT; ?>/entities/university',
        data: {
          addData: tmpData
        },
        success: function(res) {
          window.location.reload();
        }
      })
      $(this).parents("tr").find(".add, .edit").toggle();
      $(".add-new").removeAttr("disabled");
    }
  });

  // Edit row on edit button click
  $(document).on("click", ".edit", function() {
    $(this).parents("tr").find("td:not(:last-child)").each(function() {
      $(this).html('<input type="text" class="form-control" value="' + $(this).text() + '">');
    });
    $(this).parents("tr").find(".add, .edit").toggle();
    $(".add-new").attr("disabled", "disabled");
  });

  // Delete row on delete button click
  $(document).on("click", ".delete", function() {
    $(this).parents("tr").remove();
    $(".add-new").removeAttr("disabled");
  });
});
</script>