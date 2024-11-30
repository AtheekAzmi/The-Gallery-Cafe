<?php
include 'config.php'; 

$category = isset($_GET['category']) ? mysqli_real_escape_string($conn, $_GET['category']) : '';
$type = isset($_GET['type']) ? mysqli_real_escape_string($conn, $_GET['type']) : '';

$query = "SELECT * FROM products WHERE 1"; // Base query

if (!empty($category)) {
    $query .= " AND category = '$category'";
}

if (!empty($type)) {
    $query .= " AND f_type = '$type'";
}

$select_products = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="menustyle.css">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <title>Food Menu</title>
</head>

<style>
/* Grid Layout for Menu Items */
.menu-items {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-top: 30px;
}

.menu-item {
    background-color: white;
    padding: 20px;
    text-align: center;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.menu-item img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 10px;
}

.menu-item h3 {
    font-size: 1.5rem;
    margin: 10px 0;
}

.menu-item p {
    font-size: 1.2rem;
    color: #333;
}

.btn {
    background-color: #ffb259;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    font-size: 1rem;
    color: white;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.btn:hover {
    background-color: #ff8038;
}

/* Cart Sidebar */
.cart-sidebar {
    position: fixed;
    top: 100px;
    right: 30px;
    width: 300px;
    background-color: white;
    padding: 20px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
    border-radius: 10px;
}

.cart-sidebar h2 {
    font-size: 1.8rem;
    margin-bottom: 20px;
}

.cart-item {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
}

.cart-item p {
    font-size: 1.2rem;
}

.cart-summary {
    margin-top: 20px;
    font-size: 1.5rem;
}

.checkout-btn {
    background-color: #28a745;
    border: none;
    padding: 10px;
    width: 100%;
    color: white;
    cursor: pointer;
    border-radius: 5px;
    margin-top: 20px;
}

.checkout-btn:hover {
    background-color: #218838;
}

/* Pagination */
.pagination {
    display: flex;
    justify-content: center;
    margin: 20px 0;
}

.pagination a {
    margin: 0 10px;
    padding: 10px 15px;
    background-color: #fff;
    border: 1px solid #ccc;
    color: #333;
    text-decoration: none;
    border-radius: 5px;
}

.pagination a:hover {
    background-color: #ff8038;
    color: white;
}
</style>

<body>
<!-- Navigation Bar -->
<div class="header">
    <!-- Navigation Bar Code Here -->
</div>

<!-- Slider for Daily Offers -->
<div class="swiper-container offer-slider">
    <div class="swiper-wrapper">
        <!-- Add Slider Items Here -->
    </div>
    <div class="swiper-pagination"></div>
</div>

<!-- Main Content -->
<div class="menu-container">
    <h1>Our Food Menu</h1>

    <!-- Dropdown for sorting -->
    <form method="GET" class="sort-form">
        <select name="category" onchange="this.form.submit()">
            <!-- Options for Categories -->
        </select>

        <select name="type" onchange="this.form.submit()">
            <!-- Options for Types -->
        </select>
    </form>

    <!-- Product Grid -->
    <div class="menu-items">
        <?php
        if (mysqli_num_rows($select_products) > 0) {
            while ($row = mysqli_fetch_assoc($select_products)) {
        ?>
                <div class="menu-item">
                    <img src="uploadedimage/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
                    <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                    <p>Price: LKR <?php echo htmlspecialchars($row['price']); ?></p>
                    <button class="btn" onclick="addToCart('<?php echo htmlspecialchars($row['name']); ?>', <?php echo htmlspecialchars($row['price']); ?>)">Order Now</button>
                </div>
        <?php
            }
        } else {
            echo '<p>No food items available yet.</p>';
        }
        ?>
    </div>

    <!-- Pagination -->
    <div class="pagination">
        <a href="#">1</a>
        <a href="#">2</a>
        <a href="#">3</a>
    </div>
</div>

<!-- Cart Sidebar -->
<div class="cart-sidebar" id="cart-sidebar">
    <h2>Ordered Items</h2>
    <div id="cart-items"></div>
    <div class="cart-summary">Total: LKR <span id="cart-total">0.00</span></div>
    <button class="checkout-btn">Checkout</button>
</div>

<script>
  var swiper = new Swiper('.offer-slider', {
    loop: true,
    autoplay: {
      delay: 5000, 
      disableOnInteraction: false,
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
  });

  // Cart Functionality
  let cart = [];
  function addToCart(itemName, itemPrice) {
    cart.push({ name: itemName, price: itemPrice });
    updateCart();
  }

  function updateCart() {
    let cartItems = document.getElementById('cart-items');
    cartItems.innerHTML = '';
    let total = 0;
    cart.forEach(item => {
      total += item.price;
      cartItems.innerHTML += `<div class="cart-item"><p>${item.name}</p><p>LKR ${item.price}</p></div>`;
    });
    document.getElementById('cart-total').innerText = total.toFixed(2);
  }
</script>

</body>
</html>
