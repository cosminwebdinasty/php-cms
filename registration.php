<?php  include "includes/db.php"; ?>
<?php  include "admin/includes/functions.php"; ?>
<?php  include "includes/header.php"; ?>


<?php 
    if(isset($_GET['lang']) && !empty($_GET['lang'])){

        $_SESSION['lang'] = $_GET['lang'];

        if(isset($_SESSION['lang']) &&  $_SESSION['lang'] != $_GET['lang']){

            echo "<script type='text/javascript'> location.reload();</script>";
        }

    }
        if(isset($_SESSION['lang'])){

            include "includes/languages/" . $_SESSION['lang']. ".php";
        }
        else {
            include "includes/languages/en.php";
        }
?>

<?php 

    if(isset($_POST['submit'])){

        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];

        $username = mysqli_real_escape_string($connection,$username);
        $password = mysqli_real_escape_string($connection,$password);
        $email = mysqli_real_escape_string($connection,$email);
        $firstname = mysqli_real_escape_string($connection,$firstname);
        $lastname = mysqli_real_escape_string($connection,$lastname);

        $query = "SELECT randSalt FROM users";
        $result = mysqli_query($connection,$query);

        confirmQuery($result);
    
    $row = mysqli_fetch_array($result);

        $salt = $row['randSalt'];
        $password = crypt($password, $salt);

        $query = "INSERT INTO users (username, user_email, user_password, user_firstname, user_lastname, user_role) ";
        $query .= "VALUES ('{$username}', '{$email}', '{$password}','{$firstname}','{$lastname}',  'subscriber')";

        $register_result = mysqli_query($connection,$query);

        confirmQuery($register_result);

        echo "<div class='alert alert-success'>Your registration has been submited</div>";
        }
?>

    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
    <!-- Page Content -->
    <div class="container">

    <form class="navbar-form navbar-right" action="" method="get" id="language_form">
        <div class="form-group">
            <select name="lang"  onchange="changeLanguage()">
                <option value="en" <?php if(isset($_SESSION['lang']) && $_SESSION['lang'] == 'en'){ echo "selected";} ?>>EN</option>
                <option value="ro" <?php if(isset($_SESSION['lang']) && $_SESSION['lang'] == 'ro'){ echo "selected";} ?>>RO</option>
            </select>
        </div>
    </form>

<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1><?php echo _REGISTER; ?></h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder=" <?php echo _USERNAME; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="firstname" class="sr-only">Firstname</label>
                            <input type="text" name="firstname" id="firstname" class="form-control" placeholder=" <?php echo _FIRSTNAME; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="lastname" class="sr-only">Lastname</label>
                            <input type="text" name="lastname" id="lastname" class="form-control" placeholder=" <?php echo _LASTNAME; ?>" required>
                        </div>

                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="<?php echo _EMAIL; ?>"" required>
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="<?php echo _PASSWORD; ?>"" required>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-primary btn-lg btn-block" value=" <?php echo _REGISTER; ?>"> 
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>

        <hr>

<script>

    function changeLanguage(){

       document.getElementById('language_form').submit();
    }

</script>

<?php include "includes/footer.php";?>
