<?php
include 'partials/header.php';

// get back form data if there is an error
$firstname = $_SESSION['add-user-data']['firstname'] ?? null;
$lastname = $_SESSION['add-user-data']['lastname']  ?? null;
$username = $_SESSION['add-user-data']['username']  ?? null;
$email = $_SESSION['add-user-data']['email']  ?? null;
$createpassword = $_SESSION['add-user-data']['createpassword']  ?? null;
$confirmpassword = $_SESSION['add-user-data']['confirmpassword']  ?? null;

// delete add-user data session
unset($_SESSION['add-user-data']);
?>

<section class="form-section">
  <div class="container form-section-container">
    <h2>Add User</h2>
    <?php if (isset($_SESSION['add-user'])) : ?>
      <div class="alert-message error">
        <p>
          <?= $_SESSION['add-user'];
          unset($_SESSION['add-user']); ?>
        </p>
      </div>
    <?php endif ?>
    <form action="<?= ROOT_URL ?>admin/add-user-logic.php" enctype="multipart/form-data" method="POST">
      <input type="text" name="firstname" value="<?= $firstname ?>" id="" placeholder="First Name">
      <input type="text" name="lastname" value="<?= $lastname ?>" id="" placeholder="Last Name">
      <input type="text" name="username" value="<?= $username ?>" id="" placeholder="Username">
      <input type="email" name="email" value="<?= $email ?>" id="" placeholder="Email">
      <input type="password" name="createpassword" value="<?= $createpassword ?>" id="" placeholder="Create Psassword">
      <input type="password" name="confirmpassword" value="<?= $confirmpassword ?>" id="" placeholder="Confirm Password">
      <select name="userrole" id="">
        <option value="0">Author</option>
        <option value="1">Admin</option>
      </select>
      <div class="form-control">
        <label for="avatar">Add Avatar</label>
        <input type="file" name="avatar" id="avatar">
      </div>
      <button type="submit" name="submit" class="btn">Add User</button>
    </form>
  </div>
</section>

<?php
include '../partials/footer.php';
?>