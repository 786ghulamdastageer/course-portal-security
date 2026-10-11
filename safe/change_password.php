<?php
include 'config.php';
if (!isset($_SESSION['user'])) { header("Location: index.php"); exit; }


if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die("CSRF token validation failed!");
    }

    $new_password = $_POST['new_password'];
    $username = $_SESSION['user'];

    $stmt = $conn->prepare("UPDATE users SET password=? WHERE username=?");
    $stmt->bind_param("ss", $new_password, $username);
    $stmt->execute();
    $message = "Password changed successfully!";
}
?>
<!DOCTYPE html>
<html>
<head><title>Change Password (Safe)</title></head>
<body>
<h2>Change Password (Safe)</h2>
<?php if ($message) echo "<p style='color:green'>$message</p>"; ?>
<form method="POST">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
    New Password: <input type="password" name="new_password"><br><br>
    <button type="submit">Change Password</button>
</form>
</body>
</html>
