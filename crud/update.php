<?php
require 'config.php';

// UPDATE CUSTOMER
if (isset($_POST['update_customer'])) {
    $customer_id  = $_POST['customer_id'];
    $first_name   = $_POST['first_name'];
    $last_name    = $_POST['last_name'];
    $phone_number = !empty($_POST['phone_number']) ? $_POST['phone_number'] : null;

    $stmt = $pdo->prepare("UPDATE customers SET first_name = ?, last_name = ?, phone_number = ? WHERE customer_id = ?");
    $stmt->execute([$first_name, $last_name, $phone_number, $customer_id]);
    header("Location: landing.php?tab=customers");
    exit;
}

// UPDATE MENU ITEM
if (isset($_POST['update_menuitem'])) {
    $item_id   = $_POST['item_id'];
    $dish_name = $_POST['dish_name'];
    $price     = $_POST['price'];
    $category  = !empty($_POST['category']) ? $_POST['category'] : null;

    $stmt = $pdo->prepare("UPDATE menuitems SET dish_name = ?, price = ?, category = ? WHERE item_id = ?");
    $stmt->execute([$dish_name, $price, $category, $item_id]);
    header("Location: landing.php?tab=menuitems");
    exit;
}

// UPDATE ORDER
if (isset($_POST['update_order'])) {
    $order_id    = $_POST['order_id'];
    $customer_id = $_POST['customer_id'];
    $item_id     = $_POST['item_id'];
    $order_date  = $_POST['order_date'];
    $quantity    = $_POST['quantity'];

    $stmt = $pdo->prepare("UPDATE orders SET customer_id = ?, item_id = ?, order_date = ?, quantity = ? WHERE order_id = ?");
    $stmt->execute([$customer_id, $item_id, $order_date, $quantity, $order_id]);
    header("Location: landing.php?tab=orders");
    exit;
}
?>
