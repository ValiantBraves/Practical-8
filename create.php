<?php
// create.php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    if (empty($title) || empty($content)) {
        $error = "Please fill in all fields.";
    } else {
        $conn = getDbConnection();
        $stmt = $conn->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");
        $stmt->bind_param('ss', $title, $content);
        $stmt->execute();
        $stmt->close();
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <h1>Create New Post</h1>
        <nav>
            <a href="index.php">Back to Home</a>
        </nav>
    </header>

    <main>
        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="create.php" method="POST">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" required>

            <label for="content">Content</label>
            <textarea id="content" name="content" rows="5" required></textarea>

            <button type="submit">Create Post</button>
        </form>
    </main>

</body>
</html>
