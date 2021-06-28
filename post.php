<?php include "includes/header.php";
      include "includes/db.php";?>

    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>


    <?php 
    
    
        if(isset($_POST['liked'])){
            $thepost_id = $_POST['post_id'];
            $theuser_id = $_POST['user_id'];

            $searchPost = "SELECT * FROM posts WHERE post_id = $thepost_id";
            $postResult = mysqli_query($connection,$searchPost);
            $post = mysqli_fetch_array($postResult);
            $likes = $post['likes'];


            if(mysqli_num_rows($postResult) >= 1){

                echo $post['post_id'];
            }
            

            mysqli_query($connection, "UPDATE posts SET likes = $likes + 1 WHERE post_id = $thepost_id");


            mysqli_query($connection, "INSERT INTO likes(user_id, post_id) VALUES($theuser_id, $thepost_id)");
            exit();
        }
    
    




        if(isset($_POST['unliked'])){
            $thepost_id = $_POST['post_id'];
            $theuser_id = $_POST['user_id'];

            $searchPost = "SELECT * FROM posts WHERE post_id = $thepost_id";
            $postResult = mysqli_query($connection,$searchPost);
            $post = mysqli_fetch_array($postResult);
            $likes = $post['likes'];

            mysqli_query($connection, "DELETE FROM likes WHERE post_id = $thepost_id AND user_id = $theuser_id");

            if(mysqli_num_rows($postResult) >= 1){

                echo $post['post_id'];
            }
            

            mysqli_query($connection, "UPDATE posts SET likes = $likes - 1 WHERE post_id = $thepost_id");
            exit(); 
        }




    
    ?>



    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->

            <div class="col-md-8">
            <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>
            <?php 


            if(isset($_GET['p_id'])){

                $post_id = $_GET['p_id'];

                
            $view_query = "UPDATE posts SET post_views = post_views + 1 WHERE post_id = {$post_id}";
            $views_result = mysqli_query($connection, $view_query);

               


            $query = "SELECT * FROM posts WHERE post_id = '$post_id' ";

            $result = mysqli_query($connection,$query);

            while($row = mysqli_fetch_assoc($result)){

                $title = $row['post_title'];
                $author = $row['post_author'];
                $date   = $row['post_date'];
                $image = $row['post_image'];
                $content = $row['post_content'];
                $tags = $row['post_tags'];
            ?>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"> <?php echo $title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $image; ?>" alt="">
                <hr>
                <p><?php echo $content; ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>



              <?php 
              
                    
              $likes_query = "SELECT * FROM likes WHERE post_id = $post_id ";

              $likes_result = mysqli_query($connection,$likes_query);

             if(mysqli_num_rows($likes_result) < 1) { 
              
              
         
          ?>

                <div class="row">
                    <p class="pull-right"><a class="like" href="#"><span class="glyphicon glyphicon-thumbs-up"></span> Like</a> </p>
                </div>

                <?php } else{  ?>

                <div class="row">
                    <p class="pull-right"><a class="unlike" href="#"><span class="glyphicon glyphicon-thumbs-down"></span> Unlike</a> </p>
                </div>

                    <?php } ?>

                <?php   
           
                
                $likes_query = "SELECT * FROM likes WHERE post_id = $post_id ";

                $likes_result = mysqli_query($connection,$likes_query);

               

               
                
                
                ?>


                <div class="row">
                    <p class="pull-right"><?php  echo mysqli_num_rows($likes_result); ?></a> </p>
                </div>

                <div class="clearfix"></div>


                <?php } }
                
                
                else {

                    header("Location: index.php");
                }





                ?>

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

                            die("error" . mysqli_error());
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

 <script>
 
    $(document).ready(function(){

        var post_id = <?php echo $post_id; ?>

            var user_id = 20;

         //like   
        $('.like').click(function(){
           $.ajax({
            url: "/cms/post.php?p_id=<?php echo $post_id; ?>",
            type:'post',
            data:{
                'liked': 1,
                'post_id': post_id,
                'user_id': user_id

            }

           });

        });

        //unlike
        $('.unlike').click(function(){
        $.ajax({

        url: "/cms/post.php?p_id=<?php echo $post_id; ?>",
        type:'post',
        data:{
            'unliked': 1,
            'post_id': post_id,
            'user_id': user_id

        }

     });

});




    });
 
 
 
 
 
 </script>