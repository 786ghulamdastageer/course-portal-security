<?php
include 'config.php';
if (!isset($_SESSION['user'])) { header("Location: index.php"); exit; }

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_password = $_POST['new_password'];
    $username = $_SESSION['user'];

    // VULNERABLE: No CSRF token
    $sql = "UPDATE users SET password='$new_password' WHERE username='$username'";
    if ($conn->query($sql)) {
        $message = "Password changed successfully!";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Change Password</title></head>
<body>
<h2>Change Password</h2>
<?php if ($message) echo "<p style='color:green'>$message</p>"; ?>
<form method="POST">
    New Password: <input type="password" name="new_password"><br><br>
    <button type="submit">Change Password</button>
</form>
</body>
</html>
