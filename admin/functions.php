<?php

require ("../includes/db.php");

function confirm($connection, $result)
{

  if (!$result) {
    die('QUERY FAILED' . mysqli_error($connection));
  }
}

function insert_categories($connection)
{

  if (isset($_POST['submit'])) {
    $cat_title = $_POST['cat_title'];

    if ($cat_title == "" || empty($cat_title)) {
      echo "This field should not be empty";
    } else {
      $query = "INSERT INTO categories(cat_title) VALUE ('{$cat_title}')";
      $create_category_query = mysqli_query($connection, $query);
      // echo "Data inserted";

      if (!$create_category_query) {
        die('QUERY FAILED' . mysqli_error($connection));
      }
    }
  }
}

function findAllCategories($connection)
{

  $query = "SELECT * FROM categories";
  $result = mysqli_query($connection, $query);

  while ($row = mysqli_fetch_assoc($result)) {
    $cat_title = $row['cat_title'];
    $cat_id = $row['cat_id'];

    echo "<tr>";
    echo "<td>{$cat_id}</td>";
    echo "<td>{$cat_title}</td>";
    echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
    echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
    echo "</tr>";
  }
}

function deleteCategories($connection)
{
  if (isset($_GET['delete'])) {
    $the_cat_id = $_GET['delete'];
    $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";
    $delete_query = mysqli_query($connection, $query);
    header("Location: categories.php");
  }
}

function deletePosts($connection)
{
  if (isset($_GET['delete'])) {
    $the_post_id = $_GET['delete'];
    $query = "DELETE FROM posts WHERE post_id = {$the_post_id} ";
    $delete_query = mysqli_query($connection, $query);
    header("Location: posts.php");
  }
}
