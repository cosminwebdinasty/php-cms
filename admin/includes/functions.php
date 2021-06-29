<?php 

function insert_categories(){

global $connection;    

if(isset($_POST['submit'])){
                    
    $cat_title = $_POST['cat_title'];

    if($cat_title == "" || empty($cat_title)){

        echo "<div class='alert alert-danger'>This field should not be empty</div>";
    }
        
        else{
            echo "<div class='alert alert-success'>Category added</div>";

            $query = "INSERT INTO categories (cat_title) ";
            $query .= "VALUE('$cat_title')";

            $result = mysqli_query($connection, $query);

            if(!$result){
                die("query failed " . mysqli_error());
            }
        }
    }

}


function findAllCategories(){
    global $connection;

    $query = "SELECT * FROM categories";
    $result = mysqli_query($connection,$query);

    while($row = mysqli_fetch_assoc($result)){

        $catId = $row['cat_id'];
        $catName = $row['cat_title'];

        echo "<tr><td>{$catId}</td>
        <td>{$catName}</td>
        <td><a class='btn btn-primary' href='categories.php?edit={$catId}'>Edit</a></td>
        <td><a class='btn btn-danger' onClick=\"javascript:return confirm('Are you sure you want to delete the category?') \" href='categories.php?delete={$catId}'>Delete</a></td></tr>";
    }

}


function deleteCategory(){
    global $connection;

    if(isset($_GET['delete'])){
        $the_cat_id = $_GET['delete'];

        $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";
        $result = mysqli_query($connection, $query);
        
        header("Location: categories.php");
        
    }
}



function updateCategories(){

    global $connection;

    if(isset($_POST['update'])){
        $cat_title = $_POST['cat_title'];
        $cat_id = $_GET['edit'];
        $query = "UPDATE categories SET cat_title = '{$cat_title}'  WHERE cat_id = {$cat_id}";
        $result = mysqli_query($connection, $query);
        header("Location: categories.php"); 
        
    }
}


function confirmQuery($result){
    
    global $connection;

    if(!$result){
        die("query failed" . mysqli_error($connection));
    }
}



function users_online() {

    global $connection;

        $session = session_id();
        $time = time();
        $time_out_in_seconds = 05;
        $time_out = $time - $time_out_in_seconds;

        $query = "SELECT * FROM users_online WHERE session = '$session'";
        $send_query = mysqli_query($connection, $query);
        $count = mysqli_num_rows($send_query);

            if($count == NULL) {

            mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session','$time')");


            } else {

            mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");

            }

        $users_online_query =  mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
        return $count_user = mysqli_num_rows($users_online_query);

}


    function escape($string){
        global $connection;

        mysqli_real_escape_string($connection, trim($string));
    }


    function query($query){
        global $connection;
        return mysqli_query($connection,$query);
    }


    function isLoggedIn(){

        if(isset($_SESSION['role'])){
            return true;
        }

    }


    function loggedInUserId(){

        if(isLoggedIn()){

            $result = query("SELECT * FROM users WHERE username ='" . $_SESSION['username'] . "'");
            $user = mysqli_fetch_array($result);
            return mysqli_num_rows($result) >= 1 ? $user['user_id'] : false;

           
        }
        return false;
    }


    function userLikedThisPost($post_id = ''){

      $result = query("SELECT * FROM likes WHERE user_id =" . loggedInUserId() . " AND post_id = $post_id");

        return mysqli_num_rows($result) >= 1 ? true : false;
    }


?>