<?php
include 'config.php'; // Include your database connection settings

ob_start(); // To prevent header issues

if (isset($_POST['add_to_cart'])) {
    $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
    $product_image = mysqli_real_escape_string($conn, $_POST['product_image']);
    $product_quantity = 1;

    // Check if the product is already in the cart
    $check_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name'");

    if (mysqli_num_rows($check_cart) > 0) {
        echo "<script>alert('Product already in the cart!');</script>";
    } else {
        $insert_product = mysqli_query($conn, "INSERT INTO `cart` (name, price, image, quantity) VALUES ('$product_name', '$product_price', '$product_image', '$product_quantity')");

        if ($insert_product) {
            echo "<script>alert('Product added to cart!');</script>";
        } else {
            echo "<script>alert('Failed to add product to cart!');</script>";
        }
    }

    header('Location: cart.php');
    exit;
}

// Updating cart item quantity
if (isset($_POST['update_update_btn'])) {
    $update_value = mysqli_real_escape_string($conn, $_POST['update_quantity']);
    $update_id = mysqli_real_escape_string($conn, $_POST['update_quantity_id']);

    if ($update_value > 0) {
        $update_quantity_query = mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_value' WHERE cart_id = '$update_id'");
        if (!$update_quantity_query) {
            echo "<script>alert('Failed to update quantity!');</script>";
        }
        header('Location: cart.php');
        exit;
    } else {
        echo "<script>alert('Quantity must be at least 1');</script>";
    }
}

// Removing an item from the cart
if (isset($_GET['remove'])) {
    $remove_id = mysqli_real_escape_string($conn, $_GET['remove']);

    if (mysqli_query($conn, "DELETE FROM `cart` WHERE cart_id = '$remove_id'")) {
        header('Location: cart.php');
        exit;
    } else {
        echo "<script>alert('Failed to remove item from cart!');</script>";
    }
}

// Deleting all items from the cart
if (isset($_GET['delete_all'])) {
    if (mysqli_query($conn, "DELETE FROM `cart`")) {
        header('Location: cart.php');
        exit;
    } else {
        echo "<script>alert('Failed to delete all items from cart!');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="cart1.css">
    <title> Cart Page</title>
    

   
    
</head>



<body>

<div class="container">

<section class="shopping-cart">

    <h1 class="heading">Cart Page</h1>

    <table>

        <thead>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th>Action</th>
        </thead>

        <tbody>
            <?php 
            $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
            $grand_total = 0;

            if (mysqli_num_rows($select_cart) > 0) {
                while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                    $sub_total = $fetch_cart['price'] * $fetch_cart['quantity'];
                    $grand_total += $sub_total;
            ?>

            <tr>
                <td><img src="uploadedimage/<?php echo htmlspecialchars($fetch_cart['image']); ?>" height="100" alt="Product Image"></td>
                <td><?php echo htmlspecialchars($fetch_cart['name']); ?></td>
                <td>LKR <?php echo number_format($fetch_cart['price'], 2); ?>/-</td>
                <td>
                    <form action="" method="post">
                        <input type="hidden" name="update_quantity_id" value="<?php echo htmlspecialchars($fetch_cart['cart_id']); ?>">
                        <input type="number" name="update_quantity" min="1" value="<?php echo htmlspecialchars($fetch_cart['quantity']); ?>">
                        <button type="submit" name="update_update_btn"><i class='bx bx-refresh' style='color:#f5af68' ></i></button>
                    </form>   
                </td>
                <td>LKR<?php echo number_format($sub_total, 2); ?>/-</td>
                <td><a href="cart.php?remove=<?php echo htmlspecialchars($fetch_cart['cart_id']); ?>" onclick="return confirm('Remove item from cart?')" class="delete-btn"><i class='bx bxs-trash'></i></a></td>
            </tr>
            <?php
                }
            } else {
                echo '<tr><td colspan="6">No items in the cart. <a href="menu1.php">Return to Menu</a></td></tr>';
            }
            ?>
            <tr class="table-bottom">
                <td><a href="menu1.php" class="option-btn" style="margin-top: 0;"><i class='bx bxs-chevrons-left bx-lg'></i></a></td>
                <td colspan="3"> Total Amount</td>
                <td>LKR <?php echo number_format($grand_total, 2); ?>/-</td>
                <td><a href="cart.php?delete_all" onclick="return confirm('Are you sure you want to delete all?');" class="delete-btn"><i class='bx bxs-trash bx-md'></i></a></td>
            </tr>

        </tbody>

    </table>

    <div class="checkout-btn">
        <a href="checkout.php" class="btn <?= ($grand_total > 0) ? '' : 'disabled'; ?>">Proceed to Checkout</a>
    </div>

</section>

</div>

<!-- Custom JS File Link -->
<script src="js/script.js"></script>

</body>
</html>
