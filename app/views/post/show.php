<?php require APPROOT . '/views/components/header.php'; ?>

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

        <a href="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['post']->id; ?>" class="btn btn-dark mx-2">Edit</a>

        <form class="float-left" action="<?php echo URLROOT; ?>/posts/delete/<?php echo $data['post']->id; ?>"
            method="post">
            <input type="submit" value="Delete" class="btn btn-danger">
        </form>

        <?php endif; ?>
    </div>

</div>

<?php require APPROOT . '/views/components/footer.php'; ?>