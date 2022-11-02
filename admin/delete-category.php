<?php
require 'config/database.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // update category_id of posts that belong to this category to id og uncategorized category
    $update_query = "UPDATE posts SET category_id=8 WHERE category_id=$id";
    $update_result = mysqli_query($connnection, $update_query);

    if (!mysqli_errno($connnection)) {
        // delete category
        $query = "DELETE FROM categories WHERE id=$id LIMIT 1";
        $result = mysqli_query($connnection, $query);
        $_SESSION['delete-category-success'] = 'Category deleted suucessfully.';
    }
}

header('location: ' . ROOT_URL . 'admin/manage-categories.php');
die();
