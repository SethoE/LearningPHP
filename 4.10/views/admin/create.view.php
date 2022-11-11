<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h1 class="mt-5"> 
                <?= $view_bag['heading_text'] ?>
            </h1>
        </div>
    </div>

    <div class="row">
        <form action="" method="POST">
            <div class="form-group">
                <label for="term">Term:</label>
                <input class="form-control" type="text" name="term" id="term">
            </div>
            <div class="form-group">
                <label for="definition">Definition:</label>
                <textarea class="form-control" name="definition" id="definition"></textarea>
            </div>
            <div class="form-group">
                <button type="submit">Create term</button>
            </div>
        </form>
    </div>
</div>
