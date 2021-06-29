<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Username</th>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Change Role</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                
                            </thead>
                            <tbody>

                            <?php 
                            
                            global $connection;
                            
                            $query = "SELECT * FROM users";

                            $result = mysqli_query($connection,$query);

                            while($row = mysqli_fetch_assoc($result)){

                                $id = $row['user_id'];
                                $username = $row['username'];
                                $password = $row['user_password'];
                                $firstname= $row['user_firstname'];
                                $lastname= $row['user_lastname'];
                                $email= $row['user_email'];
                                $role= $row['user_role'];
                                $image = $row['user_image'];
                                
                                echo "<tr>";
                                echo " <td>{$id}</td>";
                                echo " <td>{$username}</td>";
                                echo "<td>{$firstname}</td>";
                                echo "<td>{$lastname}</td>";
                                echo " <td>{$email}</td>";
                                echo " <td>{$role}</td>";

                                echo "<td><a href='./users.php?change_to_admin={$id}' class='btn btn-info'>Admin</a> ";
                                echo "<a href='./users.php?change_to_sub={$id}' class='btn btn-info'>Subscriber</a></td>";

                                echo "<td><a href='./users.php?source=edit_user&edit_user={$id}' class='btn btn-primary'>Edit</a></td>";
                                echo "<td><a onClick=\"javascript:return confirm('Are you sure you want to delete the user?') \" href='./users.php?delete={$id}' class='btn btn-danger'>Delete</a></td>";
                                
                                echo "</tr>";
                                 
                            }
                        
                            //update role to admin
                            if(isset($_GET['change_to_admin'])){

                                $id = $_GET['change_to_admin'];

                                $query = "UPDATE users SET user_role = 'admin'";
                                $query .= "WHERE user_id = '$id'";
                                $result = mysqli_query($connection, $query);
                                header('location: ./users.php');
                                confirmQuery($result);
                            }

                            //update role to subscriber
                            if(isset($_GET['change_to_sub'])){

                                $id = $_GET['change_to_sub'];

                                $query = "UPDATE users SET user_role = 'subscriber'";
                                $query .= "WHERE user_id = '$id'";
                                $result = mysqli_query($connection, $query);
                                header('location: ./users.php');
                                confirmQuery($result);
                            }

                            //delete query
                            if(isset($_GET['delete'])){

                                if(isset($_SESSION['role'])){

                                    if($_SESSION['role'] == 'admin'){

                                $id = mysqli_real_escape_string($connection,$_GET['delete']);

                                $query = "DELETE FROM users ";
                                $query .= "WHERE user_id = '$id'";
                                $result = mysqli_query($connection, $query);
                                header('location: ./users.php');
                                confirmQuery($result);
                                    }
                              }
                            }


                            ?>

                            </tbody>
                        </table>