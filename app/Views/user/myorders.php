<h2>Mes commandes</h2>

<?php foreach($orders as $order): ?>

  <ul>
    <li><a href="<?= $order->url; ?>"><?= $order->reference; ?></a></li>
    <li><?= $order->date; ?></li>
    <li><?= $order->statement; ?></li>
    <li><?= $order->total_price; ?></li>
  </ul>

<?php endforeach; ?>
