<?php
include 'config.php';
if (!isset($_SESSION['user'])) { header("Location: index.php"); exit; }

$course_id = intval($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $comment = $_POST['comment'];
    $username = $_SESSION['user'];


    $stmt = $conn->prepare("INSERT INTO comments (course_id, username, comment) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $course_id, $username, $comment);
    $stmt->execute();
}

$stmt = $conn->prepare("SELECT * FROM courses WHERE id=?");
$stmt->bind_param("i", $course_id);
$stmt->execute();
$course = $stmt->get_result()->fetch_assoc();

$stmt = $conn->prepare("SELECT * FROM comments WHERE course_id=?");
$stmt->bind_param("i", $course_id);
$stmt->execute();
$comments = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head><title><?php echo htmlspecialchars($course['title']); ?></title></head>
<body>
<h2><?php echo htmlspecialchars($course['title']); ?></h2>
<p><?php echo htmlspecialchars($course['description']); ?></p>

<h3>Comments:</h3>
<?php
while ($row = $comments->fetch_assoc()) {

    echo "<p><b>" . htmlspecialchars($row['username']) . ":</b> " . htmlspecialchars($row['comment']) . "</p>";
}
?>

<h3>Add Comment:</h3>
<form method="POST">
    <textarea name="comment" rows="4" cols="50"></textarea><br>
    <button type="submit">Post Comment</button>
</form>
</body>
</html>
