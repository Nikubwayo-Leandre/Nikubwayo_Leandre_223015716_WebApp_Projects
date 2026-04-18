<?php
session_start();
require_once 'db.php';
$message = '';
$msgClass = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $menu_item = trim($_POST['menu_item']);
    $address = trim($_POST['address']);
    $order_date = trim($_POST['order_date']);
    if (!empty($full_name) && !empty($email) && !empty($phone) && !empty($menu_item) && !empty($address) && !empty($order_date)) {
        $stmt = $conn->prepare("INSERT INTO orders (full_name, email, phone, menu_item, address, order_date) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $full_name, $email, $phone, $menu_item, $address, $order_date);
        if ($stmt->execute()) {
            $message = "Order placed successfully! We'll contact you soon.";
            $msgClass = "success";
        } else {
            $message = "Error: please try again.";
            $msgClass = "error";
        }
        $stmt->close();
    } else {
        $message = "All fields are required.";
        $msgClass = "error";
    }
}
$selectedItem = isset($_GET['item']) ? htmlspecialchars($_GET['item']) : '';
?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>Order - Leandre Bwan Hotel</title><link rel="stylesheet" href="css/style.css"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"></head>
<body>
<header class="header">... same header ...</header>
<section class="hero" style="min-height: 50vh;"><div class="hero-content"><h1>Place Your <span>Order</span></h1><p>Delicious food delivered to your doorstep</p></div></section>
<section class="section"><div class="container"><div class="form-card">
<?php if($message): ?><div class="form-message <?php echo $msgClass; ?>"><?php echo $message; ?></div><?php endif; ?>
<form method="POST">
    <div class="form-group"><label>Full Name *</label><input type="text" name="full_name" required></div>
    <div class="form-group"><label>Email *</label><input type="email" name="email" required></div>
    <div class="form-group"><label>Phone *</label><input type="tel" name="phone" required></div>
    <div class="form-group"><label>Select Menu Item *</label>
        <select name="menu_item" required>
            <option value="">-- Choose --</option>
            <optgroup label="Fish Dishes">
                <option <?php echo $selectedItem=='Grilled Tilapia'?'selected':''; ?>>Grilled Tilapia</option>
                <option <?php echo $selectedItem=='Salmon Steak'?'selected':''; ?>>Salmon Steak</option>
                <option <?php echo $selectedItem=='Whole Fried Fish'?'selected':''; ?>>Whole Fried Fish</option>
            </optgroup>
            <optgroup label="Fresh Juices">
                <option <?php echo $selectedItem=='Fresh Orange Juice'?'selected':''; ?>>Fresh Orange Juice</option>
                <option <?php echo $selectedItem=='Mango Tango'?'selected':''; ?>>Mango Tango</option>
                <option <?php echo $selectedItem=='Pineapple Splash'?'selected':''; ?>>Pineapple Splash</option>
            </optgroup>
            <optgroup label="Drinks">
                <option <?php echo $selectedItem=='Classic Mojito'?'selected':''; ?>>Classic Mojito</option>
                <option <?php echo $selectedItem=='House Red Wine'?'selected':''; ?>>House Red Wine</option>
                <option <?php echo $selectedItem=='Rwandan Tea'?'selected':''; ?>>Rwandan Tea</option>
            </optgroup>
        </select>
    </div>
    <div class="form-group"><label>Delivery Address *</label><textarea name="address" rows="3" required></textarea></div>
    <div class="form-group"><label>Delivery Date *</label><input type="date" name="order_date" required></div>
    <button type="submit" class="btn btn-primary" style="width:100%"><i class="fas fa-paper-plane"></i> Place Order</button>
</form>
</div></div></section>
<footer class="footer">... same ...</footer>
<script src="js/script.js"></script>
</body>
</html>