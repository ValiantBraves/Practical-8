<?php
// edit.php
require_once 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn = getDbConnection();
    $stmt = $conn->prepare("SELECT * FROM posts WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $post = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'];
        $content = $_POST['content'];

        if (empty($title) || empty($content)) {
            $error = "Please fill in all fields.";
        } else {
            $stmt = $conn->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?");
            $stmt->bind_param('ssi', $title, $content, $id);
            $stmt->execute();
            header("Location: index.php");
            exit;
        }
    }
} else {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <h1>Edit Post</h1>
        <nav>
            <a href="index.php">Back to Home</a>
        </nav>
    </header>

    <main>
        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="edit.php?id=<?php echo $post['id']; ?>" method="POST">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required>

            <label for="content">Content</label>
            <textarea id="content" name="content" rows="5" required><?php echo htmlspecialchars($post['content']); ?></textarea>

            <button type="submit">Update Post</button>
        </form>
    </main>

</body>
</html>
