<?php
include './partials/header.php';

// fetch all posts from posts table
$query = "SELECT * FROM posts ORDER BY date_time DESC";
$posts = mysqli_query($connnection, $query);
?>


<section class="search-bar">
  <form action="<?= ROOT_URL ?>search.php" class="container search-bar-container" method="GET">
    <div>
      <i class="fa-solid fa-magnifying-glass"></i>
      <input type="search" name="search" placeholder="Search">
      <button class="btn" name="submit">Go</button>
    </div>
  </form>
</section>

<!-- Posts -->
<section class="posts">
  <div class="container posts-container">
    <?php while ($post = mysqli_fetch_assoc($posts)) : ?>
      <article class="post">
        <div class="post-thumbnail">
          <img src="./images/<?= $post['thumbnail'] ?>">
        </div>
        <div class="post-info">
          <?php
          // fetch category from categories table using category_id of post
          $category_id = $post['category_id'];
          $category_query = "SELECT * FROM categories WHERE id=$category_id";
          $category_result = mysqli_query($connnection, $category_query);
          $category = mysqli_fetch_assoc($category_result);
          ?>
          <a href="<?= ROOT_URL ?>category-posts.php?id=<?= $category['id'] ?>" class="category-button"><?= $category['title'] ?></a>
          <h3 class="post-title"><a href="<?= ROOT_URL ?>post.php?id=<?= $post['id'] ?>"><?= $post['title'] ?></a></h3>
          <p class="post-body"><?= substr($post['body'], 0, 150) ?>...</p>
          <div class="post-author">
            <?php
            // fetch author from users table using author_id
            $author_id = $post['author_id'];
            $author_query = "SELECT * FROM users WHERE id=$author_id";
            $author_result = mysqli_query($connnection, $author_query);
            $author = mysqli_fetch_assoc($author_result);
            ?>
            <div class="post-author-avatar">
              <img src="./images/<?= $author['avatar'] ?>">
            </div>
            <div class="post-author-info">
              <h5>By: <?= "{$author['firstname']} {$author['lastname']}" ?><h5>
                  <small><?= date("M,D,Y -H:i", strtotime($post['date_time'])) ?></small>
            </div>
          </div>
      </article>
    <?php endwhile ?>
  </div>
</section>

<!-- Category buttons -->
<section class="category-buttons">
  <div class="container category-buttons-container">
    <?php
    $categories_query = "SELECT * FROM categories";
    $categories = mysqli_query($connnection, $categories_query);
    ?>
    <?php while ($category = mysqli_fetch_assoc($categories)) :  ?>
      <a href="<?= ROOT_URL ?>category-posts.php?id=<?= $category['id'] ?>" class="category-button"><?= $category['title'] ?></a>
    <?php endwhile ?>
  </div>
</section>

<?php
include './partials/footer.php';

?>