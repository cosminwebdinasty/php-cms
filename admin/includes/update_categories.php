<form action="" method="post">
                                <div class="form-group">
                                    <label for="cat_title">Edit Category</label>
                         
                         <?php     
                                if(isset($_GET['edit'])){
                                    $cat_edit_id = $_GET['edit'];
                            $query = "SELECT * FROM categories WHERE cat_id = $cat_edit_id";
                            $result = mysqli_query($connection,$query);

                            while($row = mysqli_fetch_assoc($result)){
                            $catId = $row['cat_id'];
                            $catName = $row['cat_title']; 
                            
                            ?>
                                    <input value="<?php if(isset($catName)){echo $catName;} ?>" class="form-control" type="text" name="cat_title">

                                    <?php } }?>

                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="update" value="Update Category">
                                </div>
                            </form>