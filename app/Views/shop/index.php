<section class="shop__index">
  <div class="categories">
    <ul>
      <?php foreach($categories as $category): ?>
        <a href="<?= $category->url; ?>"><li><?= $category->title; ?></li></a>
      <?php endforeach; ?>
    </ul>
  </div>

  <div class="products">
    <?php foreach($products as $product): ?>
      <a href="<?= $product->url; ?>">
      <article class="product">
          <div class="product__header">
            <div class="product__img">
              <img src="img/1.jpg">
              <!--<img src="data:image;base64,<?= base64_encode($product->img); ?>">-->
            </div>
          </div>
          <div class="product__body">
            <div class="product__price">
              <span><?= $product->format_price; ?></span>
            </div>
            <div class="product__title">
              <h2><?= $product->format_title; ?></h2>
            </div>
            <div class="product__category">
              <?= $product->format_category; ?>
            </div>
            <!--<p class="product__description">
            <?= $product->description; ?>
          </p>-->
          </div>
      </article>
    </a>
    <?php endforeach; ?>
  </div>
</section>
