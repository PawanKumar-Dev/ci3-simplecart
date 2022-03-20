<?php include 'header.php'; ?>

<div class="container">
	<h3 class="mt-3">Order Details</h3>
	<div class="row">
		<div class="col-md-8">
			<table class="table table-bordered table-light">
		      <thead>
		        <tr class="text-center">
		          <th scope="col">Product Image</th>
		          <th scope="col">Product Name</th>
		          <th scope="col">Price</th>
		          <th scope="col">Quantity</th>
		          <th scope="col">Sub Total</th>
		        </tr>
		      </thead>

		      <tbody>
		        <?php if (!empty($this->cart->contents())) : ?>
		          <?php foreach ($this->cart->contents() as $record) : ?>

		            <tr class="text-center bg-light">
		              <th><img height="70px" src="<?= base_url('assets/img/') . $record['image']; ?>"></th>
		              <td><?= $record['name']; ?></td>
		              <td>$ <?= $record['price']; ?></td>
		              <td><?php echo $record['qty']; ?></td>		              
		              <td>$ <?= $record['subtotal']; ?></td>
		            </tr>

		          <?php endforeach; ?>
		        <?php endif; ?>

		        <tr>
		          <td colspan="4"></td>
		          <td colspan="2">Grand Total: $ <?= $this->cart->format_number($this->cart->total()); ?></td>
		        </tr>
		      </tbody>

		    </table>
		    <a href="<?= base_url('products/cart'); ?>" class="btn btn-dark float-start">Back To Cart</a>
		</div>

		<div class="col-md-4">
			<h3>Shipping Info</h3>
			<form action="<?php echo base_url('products/checkout'); ?>" method="post">
				<div class="card border-primary mt-3">
				  <div class="card-body">
				    <form>
				    	<div class="form-group">
				    		<label class="col-form-label col-form-label-sm mt-4">Name</label>
					    	<input type="text" name="name" class="form-control form-control-sm" placeholder="Enter Name">
					    	<?php echo form_error('name'); ?>
					    </div>

					    <div class="form-group">
					    	<label class="col-form-label col-form-label-sm mt-4">Email</label>
					    	<input type="email" name="email" class="form-control form-control-sm" placeholder="Enter email">
					    	<?php echo form_error('email'); ?>      
					    </div>

					    <div class="form-group">
					    	<label class="col-form-label col-form-label-sm mt-4">Phone</label>
					    	<input type="number" name="phone" class="form-control form-control-sm" placeholder="Enter Phone">
					    	<?php echo form_error('phone'); ?>
					    </div>

					    <div class="form-group">
					    	<label class="col-form-label col-form-label-sm mt-4">Address</label>
					    	<input type="text" name="address" class="form-control form-control-sm" placeholder="Enter Address">
					    	<?php echo form_error('address'); ?>
					    </div>

					    <br>
					    <button type="submit" class="btn btn-success float-end">Place Order</button>
					</form>
				  </div>
				</div>
			</form>
		</div>
	</div>
</div>

<?php include 'footer.php'; ?>