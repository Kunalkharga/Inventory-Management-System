<link rel="stylesheet" href="libs/css/input.css">
<div class="row">
  <div class="col-md-12">
    <form action="generate.php" method="POST" class="form-inline">
      <div class="form-group">
        <label for="customer_id">Customer ID:</label>
        <input type="text" name="customer_id" class="form-control" placeholder="Enter Customer ID" required>
      </div>
      <div class="form-group">
        <label for="customer_name">Customer Name:</label>
        <input type="text" name="customer_name" class="form-control" placeholder="Enter Customer Name" required>
      </div>
      <button type="submit" class="btn btn-info">Generate Bill</button>
    </form>
  </div>
</div>
<?php include_once('layouts/footer.php'); ?>