<div class="container">
    <div class="row">
    <div class="col-lg-12 text-center">
        <h1 class="mt-5">
            <?php if (isset($_GET['search']) and $_GET['search'] != '') :?>
            <?= $view_bag['heading_text']?>
            <span style="color: #1D9BF0" ><?= $view_bag['heading_value'] ?></span>
            <?php else :?>
                <?= $view_bag['heading_text']?>
            <?php endif ?>
        </h1>
    </div>
    </div>
    <div class="row">
        <form class="form-inline" action="" method="GET">
            <div class="form-group">
                <input type="text" name="search" id="search_id">
                <button type="submit" value="search">Search</button>
            </div>
        </form>
    </div>
    <div class="row">
        <table class="table table-striped">
        <?php foreach ($model as $item) : ?>
            <tr>
                <td><a href="detail.php?term=<?= $item->term_id ?>"><?= $item->term ?></a></td>
                <td><?= $item->definition ?></td>
            </tr>
        <?php endforeach; ?>
    </div>
</div>
