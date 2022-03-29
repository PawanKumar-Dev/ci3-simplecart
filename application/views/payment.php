<?php include 'header.php'; ?>

<div class="container mt-3">
  <div class="row">
    <table class="table table-light table-sm">
      <thead>
        <tr class="text-center">
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Phone</th>
          <th scope="col">Address</th>
          <th scope="col">Total Price</th>
          <th scope="col">Product Name</th>
        </tr>
      </thead>
      <tbody>
        <tr class="text-center">
        <td><?= $_SESSION['checkoutdata']['name']; ?></td>
        <td><?= $_SESSION['checkoutdata']['email']; ?></td>
        <td><?= $_SESSION['checkoutdata']['phone']; ?></td>
        <td><?= $_SESSION['checkoutdata']['address']; ?></td>
        <td>Rs. <?= $_SESSION['checkoutdata']['pricetopay']; ?></td>
        <td><?= $_SESSION['checkoutdata']['product_name']; ?></td>
        </tr>
      </tbody>
    </table>
  </div>


  <div class="row mt-4">
    <h1 class="mb-4">Choose Payment Mode</h1>

    <div class="col-md-4">
      <p>Instamojo Payment Gateway</p>
      <a href="<?php echo base_url('instamojo'); ?>" class="btn btn-outline-success">Pay with Instamojo</a>
    </div>
    <div class="col-md-4">
      <p>PayUMoney Payment Gateway</p>
      <a href="<?php echo base_url('payumoney'); ?>" class="btn btn-outline-success">Pay with PayUMoney</a>
    </div>
    <div class="col-md-4">
      <p>PayTM Payment Gateway</p>
      <a href="<?php echo base_url('paytm'); ?>" class="btn btn-outline-success">Pay with PayTM</a>
    </div>
  </div>

</div>
<?php include 'footer.php'; ?>