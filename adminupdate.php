<?php
include 'config.php'; // Include your database connection settings

// Check if edit parameter is set
if (isset($_GET['edit'])) {
    $id = intval($_GET['edit']);

    // Fetch product details based on ID
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $stmt->close();

    // Update product when form is submitted
    if (isset($_POST['update_product'])) {
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_category = $_POST['product_category'];
        $product_type = $_POST['product_type'];
        $product_image = $_FILES['product_image']['name'];
        $product_image_temp_name = $_FILES['product_image']['tmp_name'];
        $product_image_folder = 'uploadedimage/' . $product_image;

        // Check if all fields are filled
        if (empty($product_name) || empty($product_price) || empty($product_category) || empty($product_type)){
            $message[] = 'Please fill out all fields.';
        } else {
            // Update with or without image
            if (!empty($product_image)) {
                move_uploaded_file($product_image_temp_name, $product_image_folder);
                $stmt = $conn->prepare("UPDATE products SET name = ?, price = ?, image = ?, category = ?, f_type = ? WHERE id = ?");
                $stmt->bind_param("sisssi", $product_name, $product_price, $product_image, $product_category, $product_type, $id);
            } else {
                $stmt = $conn->prepare("UPDATE products SET name = ?, price = ?, category = ?, f_type = ? WHERE id = ?");
                $stmt->bind_param("sissi", $product_name, $product_price, $product_category, $product_type, $id);
            }

            // Execute the update statement
            if ($stmt->execute()) {
                $message[] = 'Product updated successfully!';
                header("Location: admin.php");
                exit();
            } else {
                $message[] = 'Failed to update product: ' . mysqli_error($conn);
            }
            $stmt->close();
        }
    }
} else {
    // Redirect to admin page if no edit ID is set
    header("Location: admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="admin1style.css">
    <title>Edit Product</title>
</head>

<style>
    .update_img{
        margin-bottom: 15px;
        border-radius: 13px;
        box-shadow: 0 0 8px 2px gray;
        transition: 0.4s ease-in;
        width:20%;
    }
    .update_img:hover{
        transform: scale(1.03);
    }

</style>

<body>

<?php
if (isset($message)) {
    foreach ($message as $msg) {
        echo '<span class="message">' . htmlspecialchars($msg) . '</span>';
    }
}
?>

<div class="admin_product_form_container">
    <form action="" method="post" enctype="multipart/form-data">
        <h3>Edit Product</h3>
        
        <label for="product_name">Product Name</label>
        <input type="text" id="product_name" name="product_name" class="box" value="<?php echo htmlspecialchars($product['name']); ?>">

        <label for="product_price">Product Price</label>
        <input type="number" id="product_price" name="product_price" class="box" value="<?php echo htmlspecialchars($product['price']); ?>">

        <label for="product_image">Product Image</label>
        <input type="file" id="product_image" accept="image" name="product_image" class="box">
        <img src="uploadedimage/<?php echo htmlspecialchars($product['image']); ?>" alt="" class="update_img">

        <label for="product_category">Product Category</label>
        <select name="product_category" id="product_category" class="box">
            <option value="Sri Lankan" <?php if ($product['category'] == 'Sri Lankan') echo 'selected'; ?>>Sri Lankan</option>
            <option value="Chinese" <?php if ($product['category'] == 'Chinese') echo 'selected'; ?>>Chinese</option>
            <option value="Italian" <?php if ($product['category'] == 'Italian') echo 'selected'; ?>>Italian</option>
            <option value="Indian" <?php if ($product['category'] == 'Indian') echo 'selected'; ?>>Indian</option>
            <option value="Arabian" <?php if ($product['category'] == 'Arabian') echo 'selected'; ?>>Arabian</option>
        </select>

        <label for="product_type">Product Type</label>
        <select name="product_type" id="product_type" class="box">
            <option value="Food" <?php if ($product['f_type'] == 'Food') echo 'selected'; ?>>Food</option>
            <option value="Beverages" <?php if ($product['f_type'] == 'Beverages') echo 'selected'; ?>>Beverages</option>
            <option value="Salad" <?php if ($product['f_type'] == 'Salad') echo 'selected'; ?>>Salad</option>
            <option value="Special" <?php if ($product['f_type'] == 'Special') echo 'selected'; ?>>Special</option>
            <option value="Side Dish" <?php if ($product['f_type'] == 'Side Dish') echo 'selected'; ?>>Side Dish</option>
            <option value="Desserts" <?php if ($product['f_type'] == 'Desserts') echo 'selected'; ?>>Desserts</option>
        </select>
        
        <input type="submit" name="update_product" class="btn" value="Update Product">
    </form>
</div>

</body>
</html>
