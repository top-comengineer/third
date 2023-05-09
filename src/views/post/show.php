<?php require APPROOT . '/views/layout/header.php'; ?>

<div class="row">

  <div class="col-md-12">
    <a href="<?php echo URLROOT; ?>/posts" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
    <br>

    <h1><?php echo $data['post']->title; ?></h1>
    <div class="bg-secondary text-white p-2 mb-3">
      Written by <?php echo $data['user']->username; ?> on <?php echo $data['post']->created_at; ?>
    </div>
    <p><?php echo $data['post']->body; ?></p>
  </div>

  <div class="col-md-12">
    <?php if($data['post']->user_id == $_SESSION['user_id']) : ?>

    <a href="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['post']->id; ?>" class="btn btn-dark mx-2"><i
        class="fas fa-pencil-alt"></i> Edit</a>

    <!-- <form class="float-left" action="<?php echo URLROOT; ?>/posts/delete/<?php echo $data['post']->id; ?>"
      method="post"> -->
    <button class="btn btn-danger" id="delBtn"><i class="fas fa-trash"></i>
      Delete</button>
    <!-- </form> -->

    <?php endif; ?>
  </div>

</div>

<?php require APPROOT . '/views/layout/footer.php'; ?>

<script type="text/javascript">
$(document).ready(function() {
  $("#delBtn").click(function() {
    $.ajax({
      type: "POST",
      url: "<?php echo URLROOT; ?>/posts/delete/<?php echo $data['post']->id; ?>",
      data: "<?php echo $data['post']->id; ?>",
      success: function(res) {
        location.href = '<?php echo URLROOT; ?>/posts';
      }
    })
  })
})
</script>