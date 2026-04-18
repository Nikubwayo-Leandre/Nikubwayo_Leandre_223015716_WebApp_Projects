<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: index.html");
    exit();
}
require_once 'db.php';
$orders = $conn->query("SELECT * FROM orders ORDER BY created_at DESC");
$messages = $conn->query("SELECT * FROM messages ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>Admin Dashboard - Leandre Bwan Hotel</title><link rel="stylesheet" href="css/style.css"></head>
<body>
<div class="admin-container">
    <div class="admin-header">
        <h1>Admin Dashboard</h1>
        <a href="logout.php">Logout</a>
    </div>
    <div class="admin-card">
        <h2>Customer Orders (<?php echo $orders->num_rows; ?>)</h2>
        <table class="data-table">
            <thead><tr><th>ID</th><th>Full Name</th><th>Email</th><th>Phone</th><th>Menu Item</th><th>Address</th><th>Order Date</th><th>Created At</th></tr></thead>
            <tbody><?php while($row = $orders->fetch_assoc()): ?><tr><td><?php echo $row['id']; ?></td><td><?php echo htmlspecialchars($row['full_name']); ?></td><td><?php echo htmlspecialchars($row['email']); ?></td><td><?php echo htmlspecialchars($row['phone']); ?></td><td><?php echo htmlspecialchars($row['menu_item']); ?></td><td><?php echo htmlspecialchars($row['address']); ?></td><td><?php echo $row['order_date']; ?></td><td><?php echo $row['created_at']; ?></td></tr><?php endwhile; ?></tbody>
        </table>
    </div>
    <div class="admin-card">
        <h2>Contact Messages (<?php echo $messages->num_rows; ?>)</h2>
        <table class="data-table">
            <thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Location</th><th>Message</th><th>Received</th></tr></thead>
            <tbody><?php while($msg = $messages->fetch_assoc()): ?><tr><td><?php echo $msg['id']; ?></td><td><?php echo htmlspecialchars($msg['full_name']); ?></td><td><?php echo htmlspecialchars($msg['email']); ?></td><td><?php echo htmlspecialchars($msg['phone']); ?></td><td><?php echo htmlspecialchars($msg['location']); ?></td><td><?php echo htmlspecialchars($msg['message']); ?></td><td><?php echo $msg['created_at']; ?></td></tr><?php endwhile; ?></tbody>
        </table>
    </div>
</div>
</body>
</html>