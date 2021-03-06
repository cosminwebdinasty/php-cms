<?php include "includes/admin_header.php"; ?>

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
                            Welcome to admin
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>

                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                            <i class="fa fa-home" aria-hidden="true"></i> <a style="color:#777;" href="../index.php"> Back to Home</a>
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <!-- /.row -->
                
                <div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

                    <?php 
                    
                        $query = "SELECT * FROM posts WHERE post_status = 'published'";
                        $result = mysqli_query($connection, $query);
                        $posts_count =  mysqli_num_rows($result);
                    ?>


                  <div class='huge'><?php echo $posts_count; ?></div>
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php 
                    $query = "SELECT * FROM comments";
                    $result = mysqli_query($connection, $query);
                    $comments_count =  mysqli_num_rows($result);
                ?>
                     <div class='huge'><?php echo $comments_count; ?></div>
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

                    <?php 
                    $query = "SELECT * FROM users";
                    $result = mysqli_query($connection, $query);
                    $users_count =  mysqli_num_rows($result);
                ?>
                    <div class='huge'><?php echo $users_count; ?></div>
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

                    <?php 
                    $query = "SELECT * FROM categories";
                    $result = mysqli_query($connection, $query);
                    $categories_count =  mysqli_num_rows($result);
                ?>
                        <div class='huge'><?php echo $categories_count; ?></div>
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
            <!-- /.row -->

<?php 

$query = "SELECT * FROM posts WHERE post_status = 'draft'";
$result = mysqli_query($connection, $query);
$draft_count =  mysqli_num_rows($result);

$query = "SELECT * FROM comments WHERE comment_status = 'approved'";
$result = mysqli_query($connection, $query);
$approved_count =  mysqli_num_rows($result);

$query = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
$result = mysqli_query($connection, $query);
$unapproved_count =  mysqli_num_rows($result);


$query = "SELECT * FROM users WHERE user_role = 'subscriber'";
$result = mysqli_query($connection, $query);
$subscribers_count =  mysqli_num_rows($result);


$query = "SELECT * FROM posts";
$result = mysqli_query($connection, $query);
$all_posts =  mysqli_num_rows($result);


?>

<div clas="row">


<script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'Count'],

            <?php 
            
            $element_text = ['All Posts','Active Posts', 'Draft Posts', 'Approved Comments' , 'Unapproved Comments' ,'Categories', 'Users', 'Subscribers', 'Comments'];
            $element_count = [$all_posts, $posts_count, $draft_count,$approved_count,$unapproved_count, $categories_count, $users_count ,$subscribers_count, $comments_count];
            
            for($i = 0; $i < 9; $i++){

                echo "['{$element_text[$i]}'" . "," . "'{$element_count[$i]}']," ;

            }
            
            ?>

          /* ['Posts', 1000], */
      
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>


<div id="columnchart_material" style="width:'auto'; height: 500px;"></div>

</div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include "includes/admin_footer.php" ?>