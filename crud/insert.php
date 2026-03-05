<?php
require 'config.php';

// INSERT CUSTOMER
if (isset($_POST['add_customer'])) {
    $first_name   = $_POST['first_name'];
    $last_name    = $_POST['last_name'];
    $phone_number = !empty($_POST['phone_number']) ? $_POST['phone_number'] : null;

    $stmt = $pdo->prepare("INSERT INTO customers (first_name, last_name, phone_number) VALUES (?, ?, ?)");
    $stmt->execute([$first_name, $last_name, $phone_number]);
    header("Location: landing.php?tab=customers");
    exit;
}

// INSERT MENU ITEM
if (isset($_POST['add_menuitem'])) {
    $dish_name = $_POST['dish_name'];
    $price     = $_POST['price'];
    $category  = !empty($_POST['category']) ? $_POST['category'] : null;

    $stmt = $pdo->prepare("INSERT INTO menuitems (dish_name, price, category) VALUES (?, ?, ?)");
    $stmt->execute([$dish_name, $price, $category]);
    header("Location: landing.php?tab=menuitems");
    exit;
}

// INSERT ORDER
if (isset($_POST['add_order'])) {
    $customer_id = $_POST['customer_id'];
    $item_id     = $_POST['item_id'];
    $order_date  = $_POST['order_date'];
    $quantity    = $_POST['quantity'];

    $stmt = $pdo->prepare("INSERT INTO orders (customer_id, item_id, order_date, quantity) VALUES (?, ?, ?, ?)");
    $stmt->execute([$customer_id, $item_id, $order_date, $quantity]);
    header("Location: landing.php?tab=orders");
    exit;
}
?>
