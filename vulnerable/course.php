<?php
include 'config.php';
if (!isset($_SESSION['user'])) { header("Location: index.php"); exit; }

$course_id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $comment = $_POST['comment'];
    $username = $_SESSION['user'];

    $sql = "INSERT INTO comments (course_id, username, comment)
            VALUES ($course_id, '$username', '$comment')";
    $conn->query($sql);
}

$course = $conn->query("SELECT * FROM courses WHERE id=$course_id")->fetch_assoc();
$comments = $conn->query("SELECT * FROM comments WHERE course_id=$course_id");
?>
<!DOCTYPE html>
<html>
<head><title><?php echo $course['title']; ?></title></head>
<body>
<h2><?php echo $course['title']; ?></h2>
<p><?php echo $course['description']; ?></p>

<h3>Comments:</h3>
<?php
while ($row = $comments->fetch_assoc()) {
    echo "<p><b>" . $row['username'] . ":</b> " . $row['comment'] . "</p>";
}
?>

<h3>Add Comment:</h3>
<form method="POST">
    <textarea name="comment" rows="4" cols="50"></textarea><br>
    <button type="submit">Post Comment</button>
</form>
</body>
</html>
