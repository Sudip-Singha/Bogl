<?php
include 'partials/header.php';

// get back form data if invalid 
$title = $_SESSION['add-category-data']['title'] ?? null ;
$description = $_SESSION['add-category-data']['description'] ?? null ;

unset($_SESSION['add-category-data']);
?>

<section class="form-section">
  <div class="container form-section-container">
    <h2>Add Category</h2>
    <?php if (isset($_SESSION['add-category'])) : ?>
      <div class="alert-message error">
      <p>
        <?= $_SESSION['add-category'];
          unset($_SESSION['add-category']); ?>
      </p>
    </div>
    <?php endif ?>
    <form action="<?= ROOT_URL ?>admin/add-category-logic.php" method="POST">
      <input type="text" value="<?= $title ?>" name="title" id="" placeholder="Title">
      <textarea name="description" rows="4" placeholder="Description"><?= $description ?></textarea>
      <button type="submit" name="submit" class="btn">Add Category</button>
    </form>
  </div>
</section>

<?php
include '../partials/footer.php';
?>