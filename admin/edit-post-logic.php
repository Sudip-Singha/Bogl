<?php
require 'config/database.php';

// make sure edit post button was clicked
if (isset($_POST['submit'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $previous_thumbnail_name = filter_var($_POST['previous_thumbnail_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['thumbnail'];

    // set is_featured to 0 if it is unchecked
    $is_featured = $is_featured == 1 ?: 0;

    // check and validate input values
    if (!$title) {
        $_SESSION['edit-post'] = "Couldn't update post. Invalid form data.";
    } elseif (!$category_id) {
        $_SESSION['edit-post'] = "Couldn't update post. Invalid form data.";
    } elseif (!$body) {
        $_SESSION['edit-post'] = "Couldn't update post. Invalid form data.";
    } else {
        // deleting exsisting thumbnail if new thumbnail is available
        if ($thumbnail['name']) {
            $previous_thumbnail_path = '../images/' . $previous_thumbnail_name;
            if ($previous_thumbnail_path) {
                unlink($previous_thumbnail_path);
            }

            // work on new thumbnail
            // rename the image
            $time = time(); // make each image name unique
            $thumbnail_name = $time . $thumbnail['name'];
            $thumbnail_tmp_name = $thumbnail['tmp_name'];
            $thumbnail_destination_path = '../images/' . $thumbnail_name;

            // make sure file is an image
            $allowed_files = ['png', 'jpg', 'jpeg'];
            $extension = explode('.', $thumbnail_name);
            $extension = end($extension);
            if (in_array($extension, $allowed_files)) {
                // make sure image is not too big
                if ($thumbnail['size'] < 2000000) {
                    // upload thumbnail
                    move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
                } else {
                    $_SESSION['add-post'] = 'File size too big. Should be less than 2mb.';
                }
            } else {
                $_SESSION['add-post'] = 'File should be png, jpg or jpeg';
            }
        }
    }

    if ($_SESSION['edit-post']) {
        // redirect to manage form page if form was invalid
        header('location: ' . ROOT_URL . 'admin/');
        die();
    } else {
        // set is_featured of all post 0 if is_featured of this post is 1
        if ($is_featured == 1) {
            $zero_all_is_featured_query = "UPDATE posts SET is_featured=0";
            $zero_all_is_featured_result = mysqli_query($connnection, $zero_all_is_featured_query);
        }

        // set thumbnail name if new one was uploaded, else keep old thumbnail name
        $thumnail_to_insert = $thumbnail_name ?? $previous_thumbnail_name;

        $query = "UPDATE posts SET title='$title',body='$body',thumbnail='$thumnail_to_insert',category_id=$category_id,is_featured=$is_featured WHERE id=$id LIMIT 1";
        $result = mysqli_query($connnection, $query);
    }

    if (!mysqli_errno($connnection)) {
        $_SESSION['edit-post-success'] = "Post updated successfully";
    }
}

header('location: ' . ROOT_URL . 'admin/');
die();
