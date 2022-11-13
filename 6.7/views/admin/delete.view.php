<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h1 class="mt-5"> 
                <?= $view_bag['heading_text'] ?>
            </h1>
        </div>
    </div>
    <div class="row">
        <p>Are you sure you want to delete this item?: <span style="color: #1D9BF0; "> <b><?= $model->term ?></b> </span></p>
    </div>
    <div class="row">
        <form action="" method="POST">
            <input type="hidden" name="term" value="<?= $model->term_id ?>">
            <div class="form-group">
                <button type="submit">Delete</button>
            </div>
        </form>
    </div>
</div>
