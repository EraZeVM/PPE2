<h1><?= $category->title; ?></h1>
<?php foreach($products as $product): ?>

  <h2><a href="<?= $product->url; ?>"><?= $product->title; ?></a></h2>

  <p><em><?= $product->category; ?></em></p>

  <p><?= $product->extract; ?></p>

<?php endforeach; ?>

<ul>
  <?php foreach($categories as $category): ?>
    <li><a href="<?= $category->url; ?>"><?= $category->title; ?></a></li>
  <?php endforeach; ?>
</ul>
