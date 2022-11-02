<?php
include 'partials/header.php';

// fetch categories from database
$query = "SELECT * FROM categories";
$categories = mysqli_query($connnection, $query);
?>

<section class="form-section">
  <div class="container form-section-container">
    <h2>Add Post</h2>
    <?php if (isset($_SESSION['add-post'])) : // shows if invalid input
    ?>
      <div class="alert-message error">
        <p>
          <?= $_SESSION['add-post'];
          unset($_SESSION['add-post']);
          ?>
        </p>
      </div>
    <?php endif ?>
    <form action="<?= ROOT_URL ?>admin/add-post-logic.php" enctype="multipart/form-data" method="POST">
      <input type="text" name="title" id="" placeholder="Title">
      <select name="category" id="">
        <?php while ($category = mysqli_fetch_assoc($categories)) : ?>
          <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
        <?php endwhile ?>
      </select>
      <textarea name="body" rows="10" placeholder="Body"></textarea>
      <?php if (isset($_SESSION['user_is_admin'])) : ?>
        <div class="form-control is_featured">
          <label for="is_featured">Featured</label>
          <input type="checkbox" name="is_featured" value="1" id="is_featured" checked>
        </div>
      <?php endif ?>
      <div class="form-control">
        <label for="thumbnail">Add Thumbnail</label>
        <input type="file" name="thumbnail" id="thumbnail">
      </div>
      <button type="submit" name="submit" class="btn">Add Post</button>
    </form>
  </div>
</section>

<?php
include '../partials/footer.php';
?>