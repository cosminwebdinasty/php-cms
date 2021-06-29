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


            if(isset($_GET['category'])){

                $category_id = $_GET['category'];
            }

            $query = "SELECT * FROM posts WHERE post_category_id = '$category_id'";

            $result = mysqli_query($connection,$query);

            while($row = mysqli_fetch_assoc($result)){

                $post_id =  $row['post_id'];
                $title = $row['post_title'];
                $author = $row['post_author'];
                $date   = $row['post_date'];
                $image = $row['post_image'];
                $content = $row['post_content'];
                $tags = $row['post_tags'];
            ?>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"> <?php echo $title; ?></a>
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
                <?php } ?>
            </div> 
            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

 <?php include "includes/footer.php" ?>      