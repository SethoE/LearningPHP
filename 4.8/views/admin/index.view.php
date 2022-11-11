<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h1 class="mt-5"> 
                <?= $view_bag['heading_text'] ?>
            </h1>
        </div>
    </div>
    <div class="row">
        <a href="create.php"> Create new term</a>
    </div>
    <div class="row">
        <table class="table table-striped">
        <?php foreach ($model as $item): ?>
            <tr>
                <td><?= $item->term ?></td>
                <td><?= $item->definition ?></td>
                <td><a href="edit.php?key=<?= $item->term ?>">Edit</a></td>
            </tr>
        <?php endforeach; ?>
    </div>
</div>
