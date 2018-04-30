<?php foreach($products as $product): ?>

  <h2><a href="<?= $product->url; ?>"><?= $product->title; ?></a></h2>
  <p><em><?= $product->category; ?></em></p>
  <p><?= $product->extract; ?></p>

<?php endforeach; ?>
