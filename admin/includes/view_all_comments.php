<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Comment</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>In Response to</th>
                                    <th>Date</th>
                                    <th>Approve</th>
                                    <th>Unapprove</th>
                                    <th>Delete</th>
                                
                            </thead>
                            <tbody>

                            <?php 
                            
                            global $connection;
                            
                            $query = "SELECT * FROM comments";

                            $result = mysqli_query($connection,$query);

                            while($row = mysqli_fetch_assoc($result)){

                                $id = $row['comment_id'];
                                $post_id = $row['comment_post_id'];
                                $author= $row['comment_author'];
                                $email= $row['comment_email'];
                                $content= $row['comment_content'];
                                $status= $row['comment_status'];
                                $date= $row['comment_date'];
                               

                                

                                echo "<tr>";
                                
                                echo       " <td>{$id}</td>";
                                echo      " <td>{$author}</td>";
                                echo      "<td>{$content}</td>";
                                echo     " <td>{$email}</td>";
                                echo     " <td>{$status}</td>";

                                $query_posts = "SELECT * FROM posts WHERE post_id = '$post_id'";
                                $select_posts = mysqli_query($connection,$query_posts);
                              
                                while($row = mysqli_fetch_assoc($select_posts)){

                                    $post_id = $row['post_id'];
                                    $post_title = $row['post_title'];

                                echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";
                                }
                                echo "<td>{$date}</td>";
                                echo "<td><a href='./comments.php?approve={$id}' class='btn btn-primary'>Approve</a></th>";
                                echo "<td><a href='./comments.php?unapprove={$id}' class='btn btn-primary'>Unapprove</a></th>";
                                echo "<td><a onClick=\"javascript:return confirm('Are you sure you want to delete the comment?') \" href='./comments.php?delete={$id}' class='btn btn-danger'>Delete</a></td>";
                                
                                echo "</tr>";

                                 
                            }
                        


                            //approve comment
                            if(isset($_GET['approve'])){

                                $id = $_GET['approve'];

                                $query = "UPDATE comments SET comment_status = 'approved'";
                                $query .= "WHERE comment_id = '$id'";
                                $result = mysqli_query($connection, $query);
                                header('location: ./comments.php');
                                confirmQuery($result);
                            }





                            //unapprove comment
                            if(isset($_GET['unapprove'])){

                                $id = $_GET['unapprove'];

                                $query = "UPDATE comments SET comment_status = 'unapproved'";
                                $query .= "WHERE comment_id = '$id'";
                                $result = mysqli_query($connection, $query);
                                header('location: ./comments.php');
                                confirmQuery($result);
                            }







                            //delete query
                            if(isset($_GET['delete'])){

                                $id = $_GET['delete'];

                                $query = "DELETE FROM comments ";
                                $query .= "WHERE comment_id = '$id'";
                                $result = mysqli_query($connection, $query);
                                header('location: ./comments.php');
                                confirmQuery($result);
                            }



                            //edit query

                            if(isset($_GET['edit'])){

                                $id = $_GET['edit'];


                            }




                            ?>

                            </tbody>
                        </table>