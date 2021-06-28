<div class="col-md-4">














<!-- Blog Search Well -->
<div class="well">
    <h4>Blog Search</h4>

    <form action="search.php" method="post">
    <div class="input-group">
        <input name="search" type="text" class="form-control">
        <span class="input-group-btn">
            <button name="submit" class="btn btn-default" type="submit">
                <span class="glyphicon glyphicon-search"></span>
        </button>
        </span>
    </div>
</form> <!-- search form -->
    <!-- /.input-group -->
</div>





<!-- Blog Search Well -->
<div class="well">
    <h4>Login</h4>

    <form action="includes/login.php" method="post">
    <div class="form-group">
        <input name="username" type="text" class="form-control" placeholder="Username">
    </div>

    <div class="input-group">
        <input name="password" type="password" class="form-control" placeholder="Password">
        <span class="input-group-btn">
            <button class="btn btn-primary" name="login" type="submit">Login</button>
        
        </span>
    </div>
</form> <!-- search form -->
    <!-- /.input-group -->
</div>











<!-- Blog Categories Well -->
<div class="well">
    <h4>Blog Categories</h4>
    <div class="row">
        <div class="col-lg-12">
            <ul class="list-unstyled">

            <?php 
                        $query = "SELECT * FROM categories";

                        $result = mysqli_query($connection,$query);

                        while($row = mysqli_fetch_assoc($result)){

                            $catName = $row['cat_title'];
                            $catId = $row['cat_id'];

                            echo "<li><a href='category.php?category={$catId}'>{$catName}</a></li>";
                        }
                    
                    ?>
            </ul>
        </div>
        <!-- /.col-lg-6 -->
      
    </div>
    <!-- /.row -->
</div>


<!-- Side Widget Well -->
<?php include "widget.php"; ?>

</div>