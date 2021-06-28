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



?>