<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<?php  

    if(isset($_POST['create_post'])){

       $post_title = escape($_POST['post_title']);
        $post_author = escape($_POST['post_author']);
        $post_category_id =escape($_POST['post_category_id']);
        $post_status = escape($_POST['post_status']);

        $post_image = escape($_FILES['post_image']['name']);
        $post_image_temp = escape($_FILES['post_image']['tmp_name']);

        $post_tags = escape($_POST['post_tags']);
        $post_content = escape($_POST['post_content']);
        $post_date = date('d-m-y');

        move_uploaded_file($post_image_temp, "../images/$post_image");

        global $connection;

        $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
        $query .= "VALUES('$post_category_id','$post_title','$post_author','$post_date','$post_image','$post_content','$post_tags','$post_status')";


        $result = mysqli_query($connection, $query);

        echo "<div class='alert alert-success'>The post has been added  <a href='posts.php'> View posts</a></div>";

      confirmQuery($result);


    }


?>

    
<form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
<label for="post_title">Post Title</label>
    <input type="text" class="form-control" name="post_title">
</div>


<div class="form-group">
<label for="post_category_id">Post Category</label>
 
    <select class="form-control" name="post_category_id" id="post_category_id">
    
        <?php 
        
            global $connection;

            $query = "SELECT * FROM categories";
            $result = mysqli_query($connection,$query);


            while($row = mysqli_fetch_assoc($result)){

                $cat_title = $row['cat_title'];
                $cat_id = $row['cat_id'];

                echo "<option value='{$cat_id}'>{$cat_title}</option>";

            }
        
        
        ?>
    
    
    
    </select>

</div>

<div class="form-group">
<label for="post_author">Post Author</label>
<input type="text" class="form-control" name="post_author">
</div>






<div class="form-group">
<label for="post_status">Post Status</label>
<select class="form-control" name="post_status" id="post_status">
    
        <option value="draft">draft</option>
        <option value="published">published</option>
</select>   
</div>

<!-- <div class="form-group">
<label for="post_status">Post Status</label>
<input type="text" class="form-control" name="post_status">
</div>
 -->

<div class="form-group">
<label for="post_image">Post Image</label>
<input type="file" class="form-control" name="post_image">
</div>


<div class="form-group">
<label for="post_tags">Post Tags</label>
<input type="text" class="form-control" name="post_tags">
</div>


<div class="form-group">
<label for="post_content">Post Content</label>
    <textarea class="form-control" name="post_content" rows="5" id="body"></textarea>
</div>

<div class="form-group">

<input type="submit" name="create_post" class="btn btn-primary" value="Publish Post">
</div>


</form>






</body>
</html>