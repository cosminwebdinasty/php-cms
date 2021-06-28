<?php include "includes/header.php";
      include "includes/db.php";?>

    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->

            <div class="col-md-8">
          
            <?php 


            if(isset($_GET['p_id']) && isset($_GET['author'])){

                $post_id = $_GET['p_id'];
                $post_author =  $_GET['author'];

            }

            $query = "SELECT * FROM posts WHERE post_author = '$post_author' ";

            $result = mysqli_query($connection,$query);

            while($row = mysqli_fetch_assoc($result)){

                $title = $row['post_title'];
                $author = $row['post_author'];
                $date   = $row['post_date'];
                $image = $row['post_image'];
                $content = $row['post_content'];
                $tags = $row['post_tags'];
            ?>
  <h1 class="page-header">
                   All Posts by
                    <small> <?php echo $post_author; ?></small>
                </h1>
                <!-- First Blog Post -->
                <h2>
                    <a href="#"> <?php echo $title; ?></a>
                </h2>
                <p class="lead">
                    by <?php echo $author; ?>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $image; ?>" alt="">
                <hr>
                <p><?php echo $content; ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
                <?php } ?>

                <!-- Blog Comments -->

                <?php 
                
                    if(isset($_POST['add_comment'])){

                        $post_id = $_GET['p_id'];

                        $author = $_POST['comment_author'];
                        $email = $_POST['comment_email'];
                        $content = $_POST['comment_content'];

                        $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date)";
                        $query .= "VALUES('$post_id', '$author' ,'$email', '$content' , 'unapproved', now() )";

                        $result = mysqli_query($connection, $query);

                        if(!$result){

                            die("error" . mysqli_error());
                        }


                        $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
                        $query .= "WHERE post_id = $post_id";

                        $result2 = mysqli_query($connection,$query);

                        if(!$result){

                            die("afsdf" . mysqli_error());
                        }




                    }
                
                ?>

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="post">

                    <div class="form-group">
                    <label for="comment_author">Author</label>
                            <input type="text" name="comment_author" class="form-control" rows="3" required>
                        </div>

                        <div class="form-group">
                        <label for="comment_email">Email</label>
                            <input type="email" name="comment_email" class="form-control" rows="3" required>
                        </div>


                        <div class="form-group">
                        <label for="comment_content">Your Comment</label>
                            <textarea name="comment_content" class="form-control" rows="3" required></textarea>
                        </div>
                        <button type="submit" name="add_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <?php 
                
                $query_comments = "SELECT * FROM comments WHERE comment_post_id = {$post_id} ";
                $query_comments .= "AND comment_status = 'approved' ";
                $query_comments .= "ORDER BY comment_id DESC";

                $comments_result = mysqli_query($connection,$query_comments);
        

                while($row = mysqli_fetch_assoc($comments_result)){

                    $id = $row['comment_id'];
                    $post_id = $row['comment_post_id'];
                    $author= $row['comment_author'];
                    $email= $row['comment_email'];
                    $content= $row['comment_content'];
                    $status= $row['comment_status'];
                    $date= $row['comment_date'];
                    

                
                
                
                ?>


                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $author; ?>
                            <small><?php echo $date; ?> </small>
                        </h4>
                        <?php echo $content; ?> 
                    </div>       
                    
                </div>

          <?php } ?>
            </div> 
            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

        

        </div>
        <!-- /.row -->

        <hr>

 <?php include "includes/footer.php" ?>      