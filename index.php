<?php

require './Categories.php';

$category = new Category();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        
        // Update category
        $category->update((int)$_POST['id']);
    } else {
        
        // Insert new category
        $category->insert();
    }

    header("Location: index.php");
    exit();
}

if (isset($_GET['delete'])) {
    $category->delete((int)$_GET['delete']);
    header("Location: index.php");
    exit();
}

$categories = $category->findAll();
$currentCategory = null;

if (isset($_GET['edit'])) {
    $currentCategory = $category->findById((int)$_GET['edit']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category CRUD</title>
</head>
<body>
    <h1>Category CRUD</h1>

    <h2><?= $currentCategory ? 'Edit' : 'Add' ?> Category</h2>
    <form action="index.php" method = "POST">
        <?php if ($currentCategory): ?>
            <input 
                type  = "hidden" 
                name  = "id" 
                value = "<?= $currentCategory['id'] ?>">
        <?php endif; ?>
        <input 
            type        = "text" 
            name        = "name" 
            placeholder = "Category Name" 
            value       = "<?= $currentCategory['name'] ?? '' ?>" required>
        <button type="submit"><?= $currentCategory ? 'Update' : 'Add' ?></button>
    </form>

    <h2>Category List</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($categories) > 0): ?>
                <?php foreach ($categories as $category): ?>
                    <tr>
                        <td><?= $category['id'] ?></td>
                        <td><?= $category['name'] ?></td>
                        <td>
                            <a href="index.php?edit=<?= $category['id'] ?>">Edit</a>
                            <a href="index.php?delete=<?= $category['id'] ?>" 
                                onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">No categories found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
