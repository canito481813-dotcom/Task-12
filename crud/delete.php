<?php
require 'config.php';

// DELETE CUSTOMER
if (isset($_GET['delete_customer'])) {
    $customer_id = $_GET['delete_customer'];
    // Check if there are orders referencing this customer
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM orders WHERE customer_id = ?");
    $stmt->execute([$customer_id]);
    $count = $stmt->fetchColumn();
    if ($count > 0) {
        // Cannot delete, redirect with error
        header("Location: landing.php?tab=customers&error=cannot_delete_customer");
        exit;
    }
    $stmt = $pdo->prepare("DELETE FROM customers WHERE customer_id = ?");
    $stmt->execute([$customer_id]);
    header("Location: landing.php?tab=customers");
    exit;
}

// DELETE MENU ITEM
if (isset($_GET['delete_menuitem'])) {
    $item_id = $_GET['delete_menuitem'];
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM orders WHERE Item_id = ?");
    $stmt->execute([$item_id]);
    $count = $stmt->fetchColumn();
    if ($count > 0) {

        header("Location: landing.php?tab=menuitems&error=cannot_delete_menuitem");
        exit;
    }
    $stmt = $pdo->prepare("DELETE FROM menuitems WHERE item_id = ?");
    $stmt->execute([$item_id]);
    header("Location: landing.php?tab=menuitems");
    exit;
}

// DELETE ORDER
if (isset($_GET['delete_order'])) {
    $order_id = $_GET['delete_order'];
    $stmt = $pdo->prepare("DELETE FROM orders WHERE order_id = ?");
    $stmt->execute([$order_id]);
    header("Location: landing.php?tab=orders");
    exit;
}
?>
