<?php
include 'config.php';
if (!isset($_SESSION['user'])) { header("Location: index.php"); exit; }

$search = isset($_GET['search']) ? $_GET['search'] : '';

echo "<h2>Welcome, " . $_SESSION['user'] . "</h2>";
echo "<p>You searched for: " . $search . "</p>";

if ($search) {
    $sql = "SELECT * FROM courses WHERE title LIKE '%$search%'";
    $result = $conn->query($sql);
} else {
    $result = $conn->query("SELECT * FROM courses");
}
?>
<!DOCTYPE html>
<html>
<head><title>Dashboard</title></head>
<body>
<h2>Dashboard</h2>
<form method="GET">
    <input type="text" name="search" placeholder="Search courses...">
    <button type="submit">Search</button>
</form>

<h3>Courses:</h3>
<?php
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<h4>" . $row['title'] . "</h4>";
        echo "<p>" . $row['description'] . "</p>";
        echo "<a href='course.php?id=" . $row['id'] . "'>View Course</a>";
        echo "</div><hr>";
    }
}
?>
<a href="change_password.php">Change Password</a> |
<a href="dom_xss.php">DOM XSS Demo</a> |
<a href="logout.php">Logout</a>
</body>
</html>
