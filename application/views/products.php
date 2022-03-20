<?php include 'header.php'; ?>

<div class="container">
  <div class="row">

    <?php foreach ($products as $pro) : ?>
      <div class="col-md-4">
        <div class="card mt-4 mb-3">
          <h3 class="card-header"><?= $pro->name; ?></h3>
          <img src="<?= base_url('assets/img/').$pro->image; ?>">

          <div class="card-body">
            <p class="card-text"><?= $pro->description; ?></p>
          </div>

          <div class="card-body">
            <a href="<?= base_url('products/addtocart/').$pro->id; ?>" class="btn btn-success">Add to Cart</a>
            <h2 class="float-end badge bg-warning">Price: $ <?= $pro->price; ?></h2>
          </div>
        </div>
      </div>
    <?php endforeach; ?>

  </div>
</div>

<?php include 'footer.php'; ?>