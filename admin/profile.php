<?php include "includes/admin_header.php"; ?>

<?php
    if(isset($_SESSION['username'])){

    $username = $_SESSION['username'];

    $query = "SELECT * FROM users WHERE username = '$username'";
    
    $result = mysqli_query($connection,$query);


    while($row = mysqli_fetch_assoc($result)){

        $id = $row['user_id'];
        $user = $row['username'];
        $password = $row['user_password'];
        $firstname= $row['user_firstname'];
        $lastname= $row['user_lastname'];
        $email= $row['user_email'];
        $role= $row['user_role'];
      
     }
    
    }

?>

<?php  

if(isset($_POST['update_user'])) {
       
            
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];

//            $post_image = $_FILES['image']['name'];
//            $post_image_temp = $_FILES['image']['tmp_name'];


    $user = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
//            $post_date = date('d-m-y');


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
  $query .="username = '{$user}', ";
  $query .="user_email = '{$user_email}', ";
  $query .="user_password   = '{$user_password}' ";
  $query .= "WHERE username = '{$username}' ";

    $edit_user_query = mysqli_query($connection,$query);

    confirmQuery($edit_user_query);
}


?>

    <div id="wrapper">

        <!-- Navigation -->
  
            <?php include "includes/admin_navigation.php" ?>

            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">

                        <h1 class="page-header">
                            User Profile
                        </h1>

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

<input type="submit" name="update_user" class="btn btn-primary" value="Update Profile">
</div>


</form>
                 
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include "includes/admin_footer.php" ?>