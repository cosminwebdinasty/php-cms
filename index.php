<?php include "includes/header.php";
      include "includes/db.php";?>


    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>

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

            




            $posts_count = "SELECT * FROM posts";
            $count_result = mysqli_query($connection,$posts_count);
            $count = mysqli_num_rows($count_result);
           
            $count = ceil($count / 5);




            if(isset($_GET['page'])){

                $page = $_GET['page'];

            }
            else{
                $page = "";
            }


            if($page == "" || $page == 1){

                $page_1 = 0;
            }
            else {
                $page_1 = ($page * 5) - 5;
            }


            $query = "SELECT * FROM posts LIMIT $page_1, 5";

            $result = mysqli_query($connection,$query);

            while($row = mysqli_fetch_assoc($result)){

                $post_id =  $row['post_id'];
                $title = $row['post_title'];
                $author = $row['post_author'];
                $date   = $row['post_date'];
                $image = $row['post_image'];
                $content = substr( $row['post_content'],0, 200 );
                $tags = $row['post_tags'];
                $post_status = $row['post_status'];


                if($post_status == 'published'){

            ?>


             

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"> <?php echo $title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_posts.php?author=<?php echo $author; ?>&p_id=<?php echo $post_id; ?>"><?php echo $author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $image; ?>" alt="">
                <hr>
                <p><?php echo $content; ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
               

                <hr>
                <?php } }?>
            </div> 
            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

        

        </div>
        <!-- /.row -->

        <hr>

                    <ul class="pager">
                    
                     <?php 
                     
                        for($i = 1; $i <= $count; $i++){


                            if($i == $page){

                                echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";

                            }else{

                                echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";

                            }


                        }


                     ?>
                    
                    </ul>


 <?php include "includes/footer.php" ?>      