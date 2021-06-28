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


if(isset($_GET['p_id'])){


    $edit_id = $_GET['p_id'];

}

$query = "SELECT * FROM posts WHERE post_id = '$edit_id'";
$result = mysqli_query($connection,$query);

while($row = mysqli_fetch_assoc($result)){

    $id = $row['post_id'];
    $title= $row['post_title'];
    $author= $row['post_author'];
    $category = $row['post_category_id'];
    $status = $row['post_status'];
    $image= $row['post_image'];
    $tags = $row['post_tags'];
    $content = $row['post_content'];
    $comments = $row['post_comment_count'];
    $date = $row['post_date'];
}

    if(isset($_POST['update_post'])){

        

        $post_title = $_POST['post_title'];
        $post_author = $_POST['post_author'];
        $post_category_id = $_POST['post_category_id'];
        $post_status = $_POST['post_status'];

        $post_image = $_FILES['post_image']['name'];
        $post_image_temp = $_FILES['post_image']['tmp_name'];

        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_date = date('d-m-y');
   
        move_uploaded_file($post_image_temp, "../images/$post_image");

        if(empty($post_image)){

           $query = "SELECT * FROM posts WHERE post_id = $edit_id";
           $select_image = mysqli_query($connection,$query);
            
           while($row = mysqli_fetch_assoc($select_image)){

                $post_image = $row['post_image'];

           }
           
        }


        $query = "UPDATE posts SET ";
        $query .="post_title  = '{$post_title}', ";
        $query .="post_category_id = '{$post_category_id}', ";
        $query .="post_date   =  now(), ";
        $query .="post_author = '{$post_author}', ";
        $query .="post_status = '{$post_status}', ";
        $query .="post_tags   = '{$post_tags}', ";
        $query .="post_content= '{$post_content}', ";
        $query .="post_image  = '{$post_image}' ";
        $query .= "WHERE post_id = $edit_id ";


            $result = mysqli_query($connection,$query);

            confirmQuery($result);

            header("location: ./posts.php?source=edit_post&p_id={$id}");

         echo "<div class='alert alert-info'>The post has been updated</div>"; 
    }



?>

<form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
<label for="post_title">Post Title</label>
    <input type="text" class="form-control" name="post_title" value="<?php echo $title; ?>">
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
<input type="text" class="form-control" name="post_author" value="<?php echo $author; ?>">
</div>

<div class="form-group">
<label for="post_status">Post Status</label>

<select class="form-control" name="post_status" id="post_status">

<option value="<?php echo $status; ?>" ><?php echo $status; ?> </option>

<?php    

    if($status == 'published'){


        echo "<option value = 'draft'>draft</option>";
    }

        else  echo "<option value = 'published'>published</option>";

?>

     
    </select>
</div>


<!-- <div class="form-group">
<label for="post_status">Post Status</label>
<input type="text" class="form-control" name="post_status" value="<?php echo $status; ?>">
</div> -->


<div class="form-group">



<label for="post_image">Post Image</label><br>
<img width="300px" src="../images/<?php echo $image; ?>">
<input type="file" class="form-control" name="post_image">
</div>


<div class="form-group">
<label for="post_tags">Post Tags</label>
<input type="text" class="form-control" name="post_tags" value="<?php echo $tags; ?>">
</div>


<div class="form-group">
<label for="post_content">Post Content</label>
    <textarea class="form-control" name="post_content" rows="5"  id="body">

   <?php echo $content; ?>

    </textarea>
</div>

<div class="form-group">

<input type="submit" name="update_post" class="btn btn-primary" value="Update Post">
</div>


</form>


</body>
</html>