<h2>Panier</h2>

<?php foreach($products as $product): ?>

  <ul>
    <li><a href="<?= $product->url; ?>"><?= $product->title; ?></a></li>
    <li><?= $product->format_price; ?></li>
    <li><?= $_SESSION['cart'][$product->id]['quantity']; ?></li>
  </ul>

<?php endforeach; ?>

<?= $cart->total(); ?>

<button type="button" name="button"><a href="index.php?view=shop.orderconfirm">Commander mon panier</a></button>
