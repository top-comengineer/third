<?php require APPROOT .'/views/components/header.php'; ?>
<?php flash('post_message') ?>
<div class="row d-flex align-items-center mb-3">
    <div class="col-md-10">
        <h1>Posts</h1>
    </div>
    <div class="col-md-2">
        <a href="<?php echo URLROOT ?>/posts/add" class="btn btn-primary float-right">
            <i class="fas fa-pencil-alt"></i> Add Post
        </a>
    </div>
</div>

<?php foreach($data['posts'] as $post) :?>
<div class="card card-body mb-3">
    <h4 class="card-title"><?php echo $post->title; ?></h4>
    <div class="bg-light p-2 mb-3">
        Written by <?php echo $post->username; ?> on <?php echo $post->postCreated; ?>
    </div>
    <p class="card-text"><?php echo $post->body; ?></p>
    <a href="<?php echo URLROOT; ?>/posts/show/<?php echo $post->postId; ?>" class="btn btn-dark">More</a>
</div>
<?php endforeach; ?>

<?php require APPROOT .'/views/components/footer.php'; ?>