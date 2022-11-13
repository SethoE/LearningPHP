<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PHP Fundamentals: <?= $view_bag['title']; ?></title>
    <link href="/LearningPHP/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/LearningPHP/assets/css/php-fundamentals.css" rel="stylesheet" />
  </head>

  <body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="/LearningPHP/5.4/">PHP Fundamentals: <?= $view_bag['title']; ?></a>
        <?php if (is_user_authenticated() === false): ?>
          <a class="navbar-brand" href="/LearningPHP/6.1/login.php">Login</a>
        <?php else: ?>
          <a class="navbar-brand" href="/LearningPHP/6.1/logout.php">Logout</a>
        <?php endif ?>
      </div>
    </nav>
      <?php require("$name.view.php"); ?>
  
  </body>
</html>