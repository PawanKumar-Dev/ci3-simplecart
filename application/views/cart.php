<?php include 'header.php'; ?>

<div class="container mt-2">
  <div class="row">
    <table class="table table-bordered table-light">
      <thead>
        <tr class="text-center">
          <th scope="col">Product Image</th>
          <th scope="col">Product Name</th>
          <th scope="col">Price</th>
          <th scope="col">Quantity</th>
          <th scope="col">Sub Total</th>
          <th scope="col">Action</th>
        </tr>
      </thead>

      <tbody>
        <?php if (!empty($this->cart->contents())) : ?>

          <?php foreach ($this->cart->contents() as $record) : ?>
            <tr class="text-center bg-light">
              <th><img height="100px" src="<?= base_url('assets/img/') . $record['image']; ?>"></th>
              <td><?= $record['name']; ?></td>
              <td>$ <?= $record['price']; ?></td>

              <td>
                <input type="number" min="1" name="qty" id="qty" value="<?php echo $record['qty']; ?>" class="form-control" onchange="updateCartItem(this.value, '<?php echo $record['rowid']; ?>');">
              </td>
              
              <td>$ <?= $record['subtotal']; ?></td>
              <td><a href="<?= base_url('products/removecart/') . $record['rowid']; ?>" class="text-danger"><i class="fa fa-2x fa-trash" aria-hidden="true"></i></a></td>
            </tr>

          <?php endforeach; ?>
        <?php endif; ?>

        <tr>
          <td colspan="4"></td>
          <td colspan="2">Grand Total: $ <?= $this->cart->format_number($this->cart->total()); ?></td>
        </tr>
      </tbody>

    </table>

    <div class="col-md-6">
      <a href="<?= base_url('products/index'); ?>" class="btn btn-dark float-start">Continue To Shop</a>
    </div>
    <div class="col-md-6">
      <?php if ($this->cart->total_items() > 0): ?>
      <a href="<?= base_url('products/checkout'); ?>" class="btn btn-success float-end">Checkout</a>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
<script>

  function updateCartItem(qty, rowid) {
    $.get("<?php echo base_url('products/updateCartItm'); ?>", {qty:qty, rowid: rowid}, function(resp){
      if (resp == "ok") {
        location.reload();
      } else {
        alert('Cart Update Failed');
      }
    });
  }
  
</script>