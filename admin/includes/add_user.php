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

    if(isset($_POST['create_user'])){
      
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_role = $_POST['user_role'];

        /* $post_image = $_FILES['post_image']['name'];
        $post_image_temp = $_FILES['post_image']['tmp_name']; */

        $username = $_POST['username'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];


        /* $post_date = date('d-m-y');
 
       move_uploaded_file($post_image_temp, "../images/$post_image");
*/
        global $connection;

        $query = "INSERT INTO users(user_firstname, user_lastname, user_role, username, user_email, user_password) ";
        $query .= "VALUES('$user_firstname','$user_firstname','$user_role','$username','$user_email','$user_password')";


        $result = mysqli_query($connection, $query);

        confirmQuery($result); 

        echo "<div class='alert alert-success'>The user has been added / <a href='users.php'>View Users</a></div>";
    }

?>

<form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
<label for="post_author">Firstname</label>
<input type="text" class="form-control" name="user_firstname">
</div>

<div class="form-group">
<label for="post_status">Lastname</label>
<input type="text" class="form-control" name="user_lastname">
</div>

<div class="form-group">
<label for="post_category_id">User Role</label>
 
    <select class="form-control" name="user_role" id="user_role">
    
        <option value="subscriber">Select Options</option>
        <option value="admin">Admin</option>
        <option value="subscriber">Subscriber</option>
        
        <?php 
        
           /*  global $connection;

            $query = "SELECT * FROM users";
            $result = mysqli_query($connection,$query);

            while($row = mysqli_fetch_assoc($result)){

                $user_id = $row['user_id'];
                $user_role = $row['user_role'];

                echo "<option value='{$user_id}'>{$user_role}</option>";

            } */  
        ?>
    
    </select>

</div>


<!-- <div class="form-group">
<label for="post_image">Post Image</label>
<input type="file" class="form-control" name="post_image">
</div> -->

<div class="form-group">
<label for="post_tags">Username</label>
<input type="text" class="form-control" name="username">
</div>

<div class="form-group">
<label for="post_content">Email</label>
<input type="text" class="form-control" name="user_email">
</div>

<div class="form-group">
<label for="post_content">Password</label>
<input type="password" class="form-control" name="user_password">
</div>

<div class="form-group">

<input type="submit" name="create_user" class="btn btn-primary" value="Add User">
</div>

</form>

</body>
</html>