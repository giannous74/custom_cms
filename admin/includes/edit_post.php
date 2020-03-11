<?php
if (isset($_GET['p_id'])) {
  $the_post_id = $_GET['p_id'];
  $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
  $result = mysqli_query($connection, $query);
  while ($row = mysqli_fetch_assoc($result)) {
    $post_id = $row['post_id'];
    $post_author = $row['post_author'];
    $post_title = $row['post_title'];
    $post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_comment_count = $row['post_comment_count'];
    $post_date = $row['post_date'];
  }
}
?>



<form action="" method="post" enctype="multipart/form-data">
  <label for="cat-title">Update Posts</label>

  <div class="form-group">
    <label for="title">Post Title</label>
    <input type="text" class="form-control" name="post_title" value="<?php if (isset($post_title)) echo $post_title  ?>">
  </div>

  <div class="form-group">
    <select name="post_category" id="post_category">

      <?php
      $query = "SELECT * FROM categories";
      $result = mysqli_query($connection, $query);

      while ($row = mysqli_fetch_assoc($result)) {
        $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<option value='$cat_id'>$cat_title</option>";
      }


      ?>

    </select>
  </div>

  <div class="form-group">
    <label for="title">Post Author</label>
    <input type="text" class="form-control" name="post_author" value="<?php if (isset($post_author)) echo $post_author  ?>">
  </div>

  <div class="form-group">
    <label for="post_status">Post Status</label>
    <input type="text" class="form-control" name="post_status" value="<?php if (isset($post_status)) echo $post_status  ?>">
  </div>

  <div class="form-group">
    <img width="100" src="../images/<?php echo $post_image ?>" alt="">
  </div>

  <div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input type="text" class="form-control" name="post_tags" value="<?php if (isset($post_tags)) echo $post_tags  ?>">
  </div>

  <div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea class="form-control" name="post_content" id="" cols="30" rows="10" value="<?php if (isset($post_content)) echo $post_content  ?>"></textarea>

  </div>


  <div class="form-group">
    <input class "btn btn-primary" type="submit" name="update_post" value="Update post">
  </div>


  <?php
      if (isset($_POST['update_post'])) {
        $post_author = $_POST['post_author'];
        $post_category_id = $_POST['post_category'];
        $post_title = $_POST['post_title'];
        $post_status = $_POST['post_status'];
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];

        move_uploaded_file($post_image_temp, "../images/$post_image");


        $query = "UPDATE posts SET post_title = '{$post_title}', post_author = '{$post_author}' WHERE post_id = $post_id ";
        $update_query = mysqli_query($connection, $query);
        if (!$update_query) {
          die('QUERY FAILED' . mysqli_error($connection));
        } else {
          echo "updated successfully";
          // header("Location: posts.php");
        }
      }
    ?>

</form>

