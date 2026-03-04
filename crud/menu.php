<?php include "connection.php"; ?>

<h2>Add Menu Item</h2>


<form method="POST">

  <input type="text" name="dish" placeholder="Dish Name" required>
  <input type="text" name="category" placeholder="Category" required>
  <input type="number" step="0.01" name="price" placeholder="Price" required>
  <button name="save">Save Item</button>

</form>



<?php

if(isset($_POST['save'])){
  $dish_name = $_POST['dish_name'];
  $category = $_POST['category'];
  $price = $_POST['price'];



  mysqli_query($conn, "INSERT INTO menuitems (dish_name, category, price)
             VALUES ('$dish_name','$category','$price')");

}

?>

<h3>Menu List</h3>
<table>
<tr>

  <th>Dish</th>
  <th>Category</th>
  <th>Price</th>
  <th>Action</th>

</tr>



<?php

$result = mysqli_query($conn, "SELECT * FROM menuitems");



while($row = mysqli_fetch_assoc($result)){

?>

<tr>

  <td><?php echo $row['dish_name']; ?></td>
  <td><?php echo $row['category']; ?></td>
  <td>₱<?php echo $row['price']; ?></td>

  <td>

    <a href="delete_menu.php?id=<?php echo $row['id']; ?>">Delete</a>

  </td>

</tr>

<?php } ?>

</table>

