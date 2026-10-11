<?php
include 'config.php';
if (!isset($_SESSION['user'])) { header("Location: index.php"); exit; }

$search = isset($_GET['search']) ? $_GET['search'] : '';


echo "<h2>Welcome, " . htmlspecialchars($_SESSION['user']) . "</h2>";
echo "<p>You searched for: " . htmlspecialchars($search) . "</p>";


if ($search) {
    $stmt = $conn->prepare("SELECT * FROM courses WHERE title LIKE ?");
    $like = "%" . $search . "%";
    $stmt->bind_param("s", $like);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query("SELECT * FROM courses");
}
?>
<!DOCTYPE html>
<html>
<head><title>Dashboard (Safe)</title></head>
<body>
<h2>Dashboard (Safe)</h2>
<form method="GET">
    <input type="text" name="search" placeholder="Search courses...">
    <button type="submit">Search</button>
</form>

<h3>Courses:</h3>
<?php
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<h4>" . htmlspecialchars($row['title']) . "</h4>";
        echo "<p>" . htmlspecialchars($row['description']) . "</p>";
        echo "<a href='course.php?id=" . intval($row['id']) . "'>View Course</a>";
        echo "</div><hr>";
    }
}
?>
<a href="change_password.php">Change Password</a> |
<a href="dom_xss.php">DOM XSS Demo</a> |
<a href="logout.php">Logout</a>
</body>
</html>
