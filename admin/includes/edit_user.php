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


    if(isset($_GET['edit_user'])){

        
        $the_user_id = $_GET['edit_user'];

        $query = "SELECT * FROM users WHERE user_id = $the_user_id ";

                            $query_users = mysqli_query($connection,$query);

                            while($row = mysqli_fetch_assoc($query_users)){

                                $id = $row['user_id'];
                                $username = $row['username'];
                                $password = $row['user_password'];
                                $firstname= $row['user_firstname'];
                                $lastname= $row['user_lastname'];
                                $email= $row['user_email'];
                                $role= $row['user_role'];
                                $image = $row['user_image'];


                            

                            }
    }


    if(isset($_POST['edit_user'])) {
       
            
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_role = $_POST['user_role'];

//            $post_image = $_FILES['image']['name'];
//            $post_image_temp = $_FILES['image']['tmp_name'];


        $username = $_POST['username'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];
//            $post_date = date('d-m-y');




        $query = "SELECT randSalt FROM users";
        $result_randsalt = mysqli_query($connection,$query);

        confirmQuery($result_randsalt);

        $row = mysqli_fetch_array($result_randsalt);

        $salt = $row['randSalt'];
        $hashed_password = crypt($user_password, $salt);


   
//        move_uploaded_file($post_image_temp, "./images/$post_image" );

    $query = "SELECT randSalt FROM users";
    $select_randsalt_query = mysqli_query($connection, $query);
    if(!$select_randsalt_query) {
    die("Query Failed" . mysqli_error($connection));

    }
   
    $row = mysqli_fetch_array($select_randsalt_query); 



      $query = "UPDATE users SET ";
      $query .="user_firstname  = '{$user_firstname}', ";
      $query .="user_lastname = '{$user_lastname}', ";
      $query .="user_role   =  '{$user_role}', ";
      $query .="username = '{$username}', ";
      $query .="user_email = '{$user_email}', ";
      $query .="user_password   = '{$hashed_password}' ";
      $query .= "WHERE user_id = '{$the_user_id}' ";
   
   
        $edit_user_query = mysqli_query($connection,$query);
   
        confirmQuery($edit_user_query);


}


?>

    
<form action="" method="post" enctype="multipart/form-data">


<div class="form-group">
<label for="post_author">Firstname</label>
<input type="text" class="form-control" name="user_firstname" value="<?php echo $firstname; ?>">
</div>

<div class="form-group">
<label for="post_status">Lastname</label>
<input type="text" class="form-control" name="user_lastname" value="<?php echo $lastname; ?>">
</div>


<div class="form-group">
<label for="post_category_id">User Role</label>
 
    <select class="form-control" name="user_role" id="user_role">
    
    <option value="<?php echo $role; ?>"><?php echo $role; ?></option>

        <?php if($role == 'admin'){
        
            echo "<option value='subscriber'>subscriber</option>";
            }
            else  {

                echo "<option value='admin'>admin</option>";
            }
        
        ?>
    
    </select>

</div>



<!-- <div class="form-group">
<label for="post_image">Post Image</label>
<input type="file" class="form-control" name="post_image">
</div> -->


<div class="form-group">
<label for="post_tags">Username</label>
<input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
</div>


<div class="form-group">
<label for="post_content">Email</label>
<input type="text" class="form-control" name="user_email" value="<?php echo $email;?>">
</div>

<div class="form-group">
<label for="post_content">Password</label>
<input type="password" class="form-control" name="user_password" value="<?php echo $password; ?>">
</div>

<div class="form-group">

<input type="submit" name="edit_user" class="btn btn-primary" value="Update User">
</div>


</form>






</body>
</html>