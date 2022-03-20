<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Products</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <?= link_tag('assets/css/bootstrap.min.css'); ?>
  <?= link_tag('assets/css/style.css'); ?>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand" href="<?php echo base_url(); ?>">Products</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link active" href="#">Home</a>
          </li>
          </li>
        </ul>

        <form class="d-flex">
          <a href="<?php echo base_url('products/cart'); ?>" class="text-white text-decoration-none">            
            <span class="badge bg-secondary"><?php echo $this->cart->total_items(); ?></span>
            <i class="fa fa-2x fa-cart-arrow-down" aria-hidden="true"></i>
          </a>
        </form>
      </div>
    </div>
  </nav>