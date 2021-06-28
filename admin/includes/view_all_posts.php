<?php


    if(isset($_POST['checkBoxArray'])){

      foreach($_POST['checkBoxArray'] as $postValueId){

      $bulk_options = $_POST['bulk_options'];


        switch($bulk_options){

            case 'published':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}";
                $result = mysqli_query($connection,$query);
                 break;

            case 'draft':
            $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}";
            $result2 = mysqli_query($connection,$query);
                break;

            case 'delete':
            $query = "DELETE FROM posts WHERE post_id = {$postValueId}";
            $result3 = mysqli_query($connection,$query);
                break;

            case 'clone':
 
                
                $query = "SELECT * FROM posts WHERE post_id = '{$postValueId}' ";
                $select_post_query = mysqli_query($connection, $query);
    
    
              
                while ($row = mysqli_fetch_array($select_post_query)) {
                $post_title         = $row['post_title'];
                $post_category_id   = $row['post_category_id'];
                $post_date          = $row['post_date']; 
                $post_author        = $row['post_author'];
                $post_status        = $row['post_status'];
                $post_image         = $row['post_image'] ; 
                $post_tags          = $row['post_tags']; 
                $post_content       = $row['post_content'];
                
    
              }
    
              $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date,post_image,post_content,post_tags,post_status) ";
             
              $query .= "VALUES({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}', '{$post_status}') "; 

                $copy_query = mysqli_query($connection, $query);   






                break;
        }





       
      }

    }




?>




<form action="" method="post">

<div id="bulkOptionsContainer" class="col-xs-4">

    <select class="form-control" name="bulk_options" id="">

    <option value="">Select Options</option>
    <option value="published">Publish</option>
    <option value="draft">Draft</option>
    <option value="clone">Clone</option>
    <option value="delete">Delete</option>

    </select>


</div>

<div class="col-xs-4">

<input type="submit" name="submit" class="btn btn-success" value="Apply" onClick="javascript:return confirm('Are you sure you want to perform the action?')">
<a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>

</div>


<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="selectAllBoxes"></th>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Tags</th>
                                    <th>Comments</th>
                                    <th>Views</th>
                                    <th>Date</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                
                            </thead>
                            <tbody>

                            <?php 
                            
                            global $connection;
                            
                            $query = "SELECT * FROM posts";

                            $result = mysqli_query($connection,$query);

                            while($row = mysqli_fetch_assoc($result)){

                                $id = $row['post_id'];
                                $title= $row['post_title'];
                                $author= $row['post_author'];
                                $category = $row['post_category_id'];
                                $status = $row['post_status'];
                                $image= $row['post_image'];
                                $tags = $row['post_tags'];
                                $comments = $row['post_comment_count'];
                                $date = $row['post_date'];
                                $views = $row['post_views'];

                                global $connection;
                                $query = "SELECT * FROM categories WHERE cat_id = '$category'";
                                $select_category = mysqli_query($connection,$query);
    
                                while($row = mysqli_fetch_assoc($select_category)){
                                $catId = $row['cat_id'];
                                $catName = $row['cat_title']; 
                                
                                echo "<tr>" ; ?>


                                        <td><input type='checkbox' name='checkBoxArray[]' class='checkBoxes' value="<?php echo $id;  ?>"></td>



                                        <?php echo "
                                        <td>{$id}</td>
                                        <td><a href='../post.php?p_id=$id'> {$title}</a></td>
                                        <td>{$author}</td>
                                        <td>{$catName}</td>
                                        <td>{$status}</td>
                                        <td><img width='100px' src='../images/$image' alt='post image'></td>
                                        <td>{$tags}</td>
                                        <td>{$comments}</td>
                                        <td><a href='./posts.php?reset={$id}'> {$views}</a></td>
                                        <td>{$date}</td>
                                        <td><a href='./posts.php?source=edit_post&p_id={$id}' class='btn btn-primary'>Edit</a></th>
                                        <td><a onClick=\"javascript:return confirm('Are you sure you want to delete the post?') \" href='./posts.php?delete={$id}' class='btn btn-danger'>Delete</a></td>
                                
                                </tr>";

                                }
                            }

                            //delete query
                            if(isset($_GET['delete'])){

                                $id = $_GET['delete'];
                                $query = "DELETE FROM posts ";
                                $query .= "WHERE post_id = '$id'";
                                $result = mysqli_query($connection, $query);
                                header('location: ./posts.php');
                                confirmQuery($result);
                            }



                            //reset views counter query
                            if(isset($_GET['reset'])){

                                $id = $_GET['reset'];
                                $reset_query = "UPDATE posts SET post_views = 0 ";
                                $reset_query .= "WHERE post_id = " . mysqli_real_escape_string($connection, $_GET['reset']). "";
                                $result_reset = mysqli_query($connection, $reset_query);
                                header('location: ./posts.php');
                                confirmQuery($result);
                            }





                            ?>

                            </tbody>
                        </table>
</form>