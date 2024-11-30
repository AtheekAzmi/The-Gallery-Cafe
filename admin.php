<?php
include 'config.php'; // Include your database connection settings

// Check if the user is an admin
// if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
//     header('Location: login-admin.php'); // Redirect to login page if not an admin
//     exit;
// }

if (isset($_POST['add_product'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_FILES['product_image']['name'];
    $product_image_temp_name = $_FILES['product_image']['tmp_name'];
    $product_image_folder = 'uploadedimage/' . $product_image;
    $product_category = $_POST['product_category']; // Get category from form
    $product_type = $_POST['product_type']; // Get category from form

    if (empty($product_name) || empty($product_price) || empty($product_image) || empty($product_category) || empty($product_type)) {
        $message[] = 'Please fill out all fields.';
    } else {
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $stmt = $conn->prepare("INSERT INTO products (name, price, image, category, f_type) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sisss", $product_name, $product_price, $product_image, $product_category, $product_type);

        if ($stmt->execute()) {
            move_uploaded_file($product_image_temp_name, $product_image_folder);
            $message[] = 'New product added successfully!';
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            $message[] = 'Failed to add product: ' . mysqli_error($conn);
        }
        $stmt->close();
    }
}

// Handle deletion of a product
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']); // Ensure ID is an integer to prevent SQL injection

    if ($conn) {
        $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $message[] = 'Product deleted successfully!';
            header('Location: admin.php');
            exit();
        } else {
            $message[] = 'Failed to delete product: ' . mysqli_error($conn);
        }
        $stmt->close();
    } else {
        die("Connection failed: " . mysqli_connect_error());
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin1style.css">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Admin Page</title>
</head>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f0f4f7;
    display: flex;
    height: auto;
}

.sidebar {
    width: 250px;
    background-color: #333333b5;
    padding: 20px;
    color: white;
}

.sidebar-header {
    margin-bottom: 30px;
}

.sidebar h2 {
    color: #fcbe7c;
    font-size: 24px;
    text-align: center;
}

.nav-links {
    list-style: none;
    padding-left: 0;
}

.nav-links li {
    margin: 15px 0;
}

.nav-links a {
    text-decoration: none;
    color: white;
    font-size: 18px;
    padding: 10px;
    display: block;
    transition: background-color 0.3s ease;
    font-weight: 500;
}

.nav-links a:hover {
    background-color: #fcbe7c;
    color: #333;
}

.logout {
    margin-top: 50px;
}

.logout a {
    text-decoration: none;
    color: white;
    padding: 10px 15px;
    background-color: #ff6f00;
    display: inline-block;
    border-radius: 5px;
    transition: background-color 0.3s ease;
    font-weight: 500;
}

.logout a:hover {
    background-color: #e65c00;
}

.productdisplay {
    margin-top: 20px;
    border-radius: 10px;
    height: 350px;
    overflow: auto;
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

    <aside class="sidebar">
        <div class="sidebar-header">
            <h2>Admin Dashboard</h2>
        </div>
        <ul class="nav-links">
            <li><a href="manage_orders.php">Manage Orders</a></li>
            <li><a href="manage_bookings.php">Manage Bookings</a></li>
            <li><a href="manage_users.php">Manage Users</a></li>
            <li><a href="manage_reservations.php">Manage Reservations</a></li>
            <li><a href="admin.php">Manage Menu</a></li>
            <li><a href="manage_events.php">Manage Events</a></li>

            <li><a href="index.php">Home</a></li>
        </ul>
        
        <div class="logout">
            <a href="logout.php">Logout</a>
        </div>
    </aside>

<div class="admin_product_form_container">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
        <h3>Add New Product</h3>
        
        <label for="product_name">Product Name</label>
        <input type="text" id="product_name" placeholder="Enter the product name" name="product_name" class="box">
        
        <label for="product_price">Product Price</label>
        <input type="number" id="product_price" placeholder="Enter the product price" name="product_price" class="box">
        
        <label for="product_image">Product Image</label>
        <input type="file" id="product_image" accept="image" name="product_image" class="box">
        
        <label for="product_category">Food Category</label>
        <select name="product_category" id="product_category" class="box">
            <option value="Sri Lankan">Sri Lankan</option>
            <option value="Chinese">Chinese</option>
            <option value="Italian">Italian</option>
            <option value="Indian">Indian</option>
            <option value="Arabian">Arabian</option>
        </select>

        <label for="product_type">Food Type</label>
        <select name="product_type" id="product_type" class="box">
            <option value="Food">Food</option>
            <option value="Beverages">Beverages</option>
            <option value="Salad">Salad</option>
            <option value="Special">Special</option>
            <option value="Side Dish">Side Dish</option>
            <option value="Desserts">Desserts</option>
        </select>
        
        <div>
            <input type="submit" name="add_product" class="btn" value="Add Product">
        </div>
    </form>

    <?php
    $select = mysqli_query($conn, "SELECT * FROM products"); // Query to select all products
    ?>

    <div class="productdisplay">
        <table class="productdisplaytable">
            <thead>
                <tr>
                    <td>Product Image</td>
                    <td>Product Name</td>
                    <td>Product Price</td>
                    <td>Product Category</td>
                    <td>Product Type</td>
                    <td colspan="2">Action</td>
                </tr>
            </thead>
            <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($select)) {
                ?>
                <tr>
                    <td><img src="uploadedimage/<?php echo htmlspecialchars($row['image']); ?>" height="100" alt=""></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td>LKR <?php echo htmlspecialchars($row['price']); ?></td>
                    <td><?php echo htmlspecialchars($row['category']); ?></td>
                    <td><?php echo htmlspecialchars($row['f_type']); ?></td>
                    <td>
                        <a href="adminupdate.php?edit=<?php echo $row['id']; ?>" class="btn"><i class='bx bx-edit-alt'></i></a>
                        <a href="admin.php?delete=<?php echo $row['id']; ?>" class="btn" onclick="return confirm('Are you sure you want to delete this product?');">
                            <i class='bx bx-trash'></i>
                        </a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
