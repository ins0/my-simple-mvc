<!doctype html>
<html>
  <head>
  </head>
  <body>
    <h1>
      <?= $title ?>
    </h1>
    <ul>
        <?php foreach ($array as $value) : ?>
        <li><?= $value ?>
        <?php endforeach ?>
    </ul>
  </body>
</html>
