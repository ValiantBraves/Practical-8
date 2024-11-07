<?php
// index.php
require_once 'db.php';

$conn = getDbConnection();
$query = "SELECT * FROM posts ORDER BY created_at DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple CMS</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <h1>Simple Content Management System</h1>
        <nav>
            <a href="create.php">Create Post</a>
        </nav>
    </header>

    <main>
        <h2>All Posts</h2>
        <ul>
            <?php while ($row = $result->fetch_assoc()): ?>
                <li>
                    <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                    <p><?php echo nl2br(htmlspecialchars(substr($row['content'], 0, 150))); ?>...</p>
                    <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a> |
                    <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this post?')">Delete</a>
                </li>
            <?php endwhile; ?>
        </ul>
    </main>

</body>
</html>
