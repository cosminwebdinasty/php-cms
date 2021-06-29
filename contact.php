<?php  include "includes/db.php"; ?>
<?php  include "admin/includes/functions.php"; ?>
 <?php  include "includes/header.php"; ?>
<?php 

    // the message
$msg = "First line of text\nSecond line of text";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
mail("cosmin@webdinasty.ro","My subject",$msg);

    if(isset($_POST['submit'])){

        $to = "cosmin@webdinasty.ro";
        $subject = $_POST['subject'];
        $body = $_POST['body'];
     
        }

?>

    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact</h1>
                    <form role="form" action="" method="post" id="login-form" autocomplete="off">
                     
                         <div class="form-group">
                            <label for="email" class="sr-only">Your Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                        </div>

                        <div class="form-group">
                            <label for="username" class="sr-only">Subject</label>
                            <input type="text" name="subject" id="username" class="form-control" placeholder="Enter Subject" required>
                        </div>

                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <textarea name="body" id="key" class="form-control" placeholder="Message"></textarea>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Send"> 
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>

        <hr>

<?php include "includes/footer.php";?>
