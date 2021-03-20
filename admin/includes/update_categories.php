                       <form action="" method="post">
                          <div class="form-group">
                          <label for="cat_title">Edit Category</label>

                         <?php

                            if(isset($_GET['edit'])){
                                $edit_cat_id = $_GET['edit'];

                            $query = "SELECT * FROM categories WHERE cat_Id = {$edit_cat_id} ";
                            $edit_categories = mysqli_query($connection, $query); 
                            
                            while($row = mysqli_fetch_assoc($edit_categories)){
                                
                                    $cat_Title = $row['cat_Title'];
                            ?>
                            
                
                          <input value="<?php if(isset($cat_Title)){echo $cat_Title;} ?>" class= "form-control" type="text" name = "cat_title">



                            <?php } } ?>
                          </div>
                          <input class = "btn btn-primary" type="submit" name="Update" value="Update Category" id="">
                          
                          </form>

                        <?php updatecategories(); ?>


                          


