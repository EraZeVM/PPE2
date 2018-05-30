<h1><?= $product->title; ?></h1>

<p><em><?= $product->category; ?></em></p>

<p><?= $product->price; ?></p>

<p><?= $product->description; ?></p>

<button type="button" name="button"><a href="index.php?view=shop.add&id=<?= $product->id; ?>">Ajouter</a></button>
