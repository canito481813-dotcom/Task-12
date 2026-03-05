<?php
require 'insert.php';
require 'update.php';
require 'delete.php';
require 'select.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>Kusina ni Manoy</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body class="bg-light">

<div class="container mt-4">

<h2 class="text-center mb-4">Kusina ni Manoy</h2>

<?php
$editCustomer = null;
if (isset($_GET['edit_customer'])) {
    $stmt = $pdo->prepare("SELECT * FROM customers WHERE customer_id = ?");
    $stmt->execute([$_GET['edit_customer']]);
    $editCustomer = $stmt->fetch(PDO::FETCH_ASSOC);
}

$editMenuItem = null;
if (isset($_GET['edit_menuitem'])) {
    $stmt = $pdo->prepare("SELECT * FROM menuitems WHERE item_id = ?");
    $stmt->execute([$_GET['edit_menuitem']]);
    $editMenuItem = $stmt->fetch(PDO::FETCH_ASSOC);
}

$editOrder = null;
if (isset($_GET['edit_order'])) {
    $stmt = $pdo->prepare("SELECT * FROM orders WHERE order_id = ?");
    $stmt->execute([$_GET['edit_order']]);
    $editOrder = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!-- ORDER SECTION -->
<div class="card mb-4">
<div class="card-body">

<h4><?= $editOrder ? 'Update Order' : 'Add Order' ?></h4>

<form method="POST">

<?php if (!empty($editOrder)): ?>
<input type="hidden" name="order_id" value="<?= $editOrder['order_id'] ?>">
<?php endif; ?>

<div class="mb-3">
<label class="form-label">Customer</label>
<select name="customer_id" class="form-select" required>
<option value="">-- Select Customer --</option>
<?php foreach ($customers as $customer): ?>
<option value="<?= $customer['customer_id'] ?>"
<?= (!empty($editOrder) && $editOrder['customer_id'] == $customer['customer_id']) ? 'selected' : '' ?>>
<?= $customer['first_name'] . ' ' . $customer['last_name'] ?>
</option>
<?php endforeach; ?>
</select>
</div>

<div class="mb-3">
<label class="form-label">Menu Item</label>
<select name="item_id" class="form-select" required>
<option value="">-- Select Item --</option>
<?php foreach ($menuitems as $item): ?>
<option value="<?= $item['item_id'] ?>"
<?= (!empty($editOrder) && $editOrder['item_id'] == $item['item_id']) ? 'selected' : '' ?>>
<?= $item['dish_name'] ?>
</option>
<?php endforeach; ?>
</select>
</div>

<div class="mb-3">
<label class="form-label">Order Date</label>
<input type="datetime-local" class="form-control" name="order_date"
value="<?= !empty($editOrder) ? date('Y-m-d\TH:i', strtotime($editOrder['order_date'])) : '' ?>" required>
</div>

<div class="mb-3">
<label class="form-label">Quantity</label>
<input type="number" class="form-control" name="quantity"
value="<?= !empty($editOrder) ? $editOrder['quantity'] : '' ?>" min="1" required>
</div>

<?php if (!empty($editOrder)): ?>
<button class="btn btn-warning" type="submit" name="update_order">Update</button>
<a href="landing.php" class="btn btn-secondary">Cancel</a>
<?php else: ?>
<button class="btn btn-primary" type="submit" name="add_order">Add Order</button>
<?php endif; ?>

</form>

</div>
</div>


<h4>Orders List</h4>

<div class="table-responsive mb-5">
<table class="table table-bordered table-striped">
<thead class="table-dark">
<tr>
<th>ID</th>
<th>Customer</th>
<th>Dish</th>
<th>Date</th>
<th>Total</th>
<th>Action</th>
</tr>
</thead>

<tbody>
<?php foreach ($orders as $order): ?>
<tr>
<td><?= $order['order_id'] ?></td>
<td><?= $order['customer_name'] ?></td>
<td><?= $order['dish_name'] ?></td>
<td><?= $order['order_date'] ?></td>
<td>₱<?= number_format($order['total_price'], 2) ?></td>
<td>
<a href="?edit_order=<?= $order['order_id'] ?>" class="btn btn-sm btn-warning">Edit</a>
<a href="?delete_order=<?= $order['order_id'] ?>" class="btn btn-sm btn-danger">Delete</a>
</td>
</tr>
<?php endforeach; ?>
</tbody>

</table>
</div>



<!-- CUSTOMER SECTION -->

<div class="card mb-4">
<div class="card-body">

<h4><?= $editCustomer ? 'Update Customer' : 'Add Customer' ?></h4>

<form method="POST">

<?php if (!empty($editCustomer)): ?>
<input type="hidden" name="customer_id" value="<?= $editCustomer['customer_id'] ?>">
<?php endif; ?>

<div class="mb-3">
<label class="form-label">First Name</label>
<input type="text" class="form-control" name="first_name"
value="<?= !empty($editCustomer) ? $editCustomer['first_name'] : '' ?>" required>
</div>

<div class="mb-3">
<label class="form-label">Last Name</label>
<input type="text" class="form-control" name="last_name"
value="<?= !empty($editCustomer) ? $editCustomer['last_name'] : '' ?>" required>
</div>

<div class="mb-3">
<label class="form-label">Phone Number</label>
<input type="text" class="form-control" name="phone_number"
value="<?= !empty($editCustomer) ? $editCustomer['phone_number'] : '' ?>">
</div>

<?php if (!empty($editCustomer)): ?>
<button class="btn btn-warning" type="submit" name="update_customer">Update</button>
<a href="landing.php" class="btn btn-secondary">Cancel</a>
<?php else: ?>
<button class="btn btn-success" type="submit" name="add_customer">Add Customer</button>
<?php endif; ?>

</form>

</div>
</div>



<h4>Customer List</h4>

<div class="table-responsive mb-5">
<table class="table table-bordered table-striped">

<thead class="table-dark">
<tr>
<th>ID</th>
<th>First</th>
<th>Last</th>
<th>Phone</th>
<th>Action</th>
</tr>
</thead>

<tbody>

<?php foreach ($customers as $customer): ?>
<tr>
<td><?= $customer['customer_id'] ?></td>
<td><?= $customer['first_name'] ?></td>
<td><?= $customer['last_name'] ?></td>
<td><?= $customer['phone_number'] ?></td>
<td>
<a href="?edit_customer=<?= $customer['customer_id'] ?>" class="btn btn-sm btn-warning">Edit</a>
<a href="?delete_customer=<?= $customer['customer_id'] ?>" class="btn btn-sm btn-danger">Delete</a>
</td>
</tr>
<?php endforeach; ?>

</tbody>
</table>
</div>



<!-- MENU ITEM SECTION -->

<div class="card mb-4">
<div class="card-body">

<h4><?= $editMenuItem ? 'Update Menu Item' : 'Add Menu Item' ?></h4>

<form method="POST">

<?php if (!empty($editMenuItem)): ?>
<input type="hidden" name="item_id" value="<?= $editMenuItem['item_id'] ?>">
<?php endif; ?>

<div class="mb-3">
<label class="form-label">Dish Name</label>
<input type="text" class="form-control" name="dish_name"
value="<?= !empty($editMenuItem) ? $editMenuItem['dish_name'] : '' ?>" required>
</div>

<div class="mb-3">
<label class="form-label">Price</label>
<input type="number" step="0.01" class="form-control" name="price"
value="<?= !empty($editMenuItem) ? $editMenuItem['price'] : '' ?>" required>
</div>

<div class="mb-3">
<label class="form-label">Category</label>
<input type="text" class="form-control" name="category"
value="<?= !empty($editMenuItem) ? $editMenuItem['category'] : '' ?>">
</div>

<?php if (!empty($editMenuItem)): ?>
<button class="btn btn-warning" type="submit" name="update_menuitem">Update</button>
<a href="landing.php" class="btn btn-secondary">Cancel</a>
<?php else: ?>
<button class="btn btn-primary" type="submit" name="add_menuitem">Add Menu Item</button>
<?php endif; ?>

</form>

</div>
</div>



<h4>Menu Items List</h4>

<div class="table-responsive">
<table class="table table-bordered table-striped">

<thead class="table-dark">
<tr>
<th>ID</th>
<th>Dish</th>
<th>Price</th>
<th>Category</th>
<th>Action</th>
</tr>
</thead>

<tbody>

<?php foreach ($menuitems as $item): ?>
<tr>
<td><?= $item['item_id'] ?></td>
<td><?= $item['dish_name'] ?></td>
<td>₱<?= $item['price'] ?></td>
<td><?= $item['category'] ?></td>
<td>
<a href="?edit_menuitem=<?= $item['item_id'] ?>" class="btn btn-sm btn-warning">Edit</a>
<a href="?delete_menuitem=<?= $item['item_id'] ?>" class="btn btn-sm btn-danger">Delete</a>
</td>
</tr>
<?php endforeach; ?>

</tbody>
</table>
</div>

</div>

</body>
</html>
