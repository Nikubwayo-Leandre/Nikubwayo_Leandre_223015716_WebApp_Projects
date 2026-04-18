<?php
session_start();
require_once 'db.php';
$msg = '';
$msgClass = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $location = trim($_POST['location']);
    $message_text = trim($_POST['message']);
    if ($full_name && $email && $phone && $location && $message_text) {
        $stmt = $conn->prepare("INSERT INTO messages (full_name, email, phone, location, message) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $full_name, $email, $phone, $location, $message_text);
        if ($stmt->execute()) {
            $msg = "Message sent successfully! We'll reply shortly.";
            $msgClass = "success";
        } else {
            $msg = "Error sending message. Please try again.";
            $msgClass = "error";
        }
        $stmt->close();
    } else {
        $msg = "All fields are required.";
        $msgClass = "error";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>Contact - Leandre Bwan Hotel</title><link rel="stylesheet" href="css/style.css"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"></head>
<body>
<header class="header">... same header ...</header>
<section class="hero" style="min-height: 50vh;"><div class="hero-content"><h1>Contact <span>Us</span></h1><p>We'd love to hear from you</p></div></section>
<section class="section"><div class="container"><div class="form-card">
<?php if($msg): ?><div class="form-message <?php echo $msgClass; ?>"><?php echo $msg; ?></div><?php endif; ?>
<form method="POST">
    <div class="form-group"><label>Full Name *</label><input type="text" name="full_name" required></div>
    <div class="form-group"><label>Email *</label><input type="email" name="email" required></div>
    <div class="form-group"><label>Phone *</label><input type="tel" name="phone" required></div>
    <div class="form-group"><label>Location *</label><input type="text" name="location" placeholder="City/Area" required></div>
    <div class="form-group"><label>Message *</label><textarea name="message" rows="4" required></textarea></div>
    <button type="submit" class="btn btn-primary" style="width:100%">Send Message</button>
</form>
</div></div></section>
<footer class="footer">... same ...</footer>
<script src="js/script.js"></script>
</body>
</html>