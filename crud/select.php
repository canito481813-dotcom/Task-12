<?php
require 'config.php';

// Fetch all customers
$stmt = $pdo->query("SELECT * FROM customers");
$customers = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch all menu items
$stmt = $pdo->query("SELECT * FROM menuitems");
$menuitems = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch all orders with customer name, dish name, and total price via JOIN
$stmt = $pdo->query("
    SELECT o.order_id, 
           CONCAT(c.first_name, ' ', c.last_name) AS customer_name, 
           m.dish_name, 
           o.order_date, 
           o.quantity,
           (o.quantity * m.price) AS total_price
    FROM orders o
    JOIN customers c ON o.customer_id = c.customer_id
    JOIN menuitems m ON o.item_id = m.item_id
");
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
