<div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="search.php" method = "post">                 
                     <div class="input-group">
                        <input name = "search" type="text" class="form-control">
                        <span class="input-group-btn">
                            <button name = "submit" class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    </form> 
                    <!-- form for search -->
 
                    <!-- /.input-group -->
                </div>
               

                <!-- Login form-->
            <div class="well">
             <?php   if(isset($_SESSION['user_role'])): ?>
                  <h4>Logged as <?php echo $_SESSION['username'];?></h4>  
                  <a href="include/logout.php" class="btn btn-primary">logout</a>
              
              <?php else:?>
                
                    <h4>Login</h4>
                    <form action="login.php" method = "post">      
                     <div class="form-group">
                     
                        <input name = "username" type="text" class="form-control" placeholder = "Enter username">
                      </div>

                      <div class="input-group">
            
                      <input name = "password" type="password" class="form-control"  placeholder = "Enter password">
                     <span class = "input-group-btn">
                      <button name = "login" class="btn btn-primary" type="submit" name="login">Submit</button>
                      </span>
                      </div>
                      <div class="form-group"><a href="forgot.php?forget=''" >forgot passord</a>
                      </div>
                    </form> 
                    <!-- form for search -->
 
                    <!-- /.input-group -->
              
               
              <?php endif;?>
               
              </div>


 

                <!-- Blog Categories Well -->
                <div class="well">
                  <?php
                    $query = "SELECT * FROM categories ";

                    $select_categories_sidebar = mysqli_query($connection, $query);

                 ?>

                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                                
                                <?php
                                 while($row = mysqli_fetch_assoc($select_categories_sidebar)){
                                    $cat_id = $row['cat_Id'];
                                    $cat_title = $row['cat_Title'];
                                     echo "<li><a href ='category.php?category=$cat_id'>{$cat_title}</a></li>";
                                     }
               
                                
                                ?>
                               
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                        
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>

          



                <!-- Side Widget Well -->
                <?php include "widget.php";?>
            </div>

        </div>