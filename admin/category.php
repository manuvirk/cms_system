<?php include "includes/admin_header.php";?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"; ?>
        <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
            <div class="col-lg-12">
            <h1 class="page-header">
                Welcome to Admin
                <small>Author</small>
            </h1>


            <div class="col-xs-6">

            <!-- //insert categories function -->
        
             <?php    insert_categories();?>

            <form action="" method="post">
                <div class="form-group">
                <label for="cat_title">Add Category</label>
                <input class= "form-control" type="text" name = "cat_title"></div>
                <input class = "btn btn-primary" type="submit" name="submit" value="Add Category" id="">
            
             </form>
                 <?php //Update and include category
    
                    if(isset($_GET['edit'])){

                    $edit_cat_id = $_GET['edit'];

                    include "includes/update_categories.php";
                
                    }
    
                 ?>
 
                
              </div>

            <div class="col-xs-6">

            <table class="table table-bordered table-hover">
            <thead>
            <tr>
            <th>Id</th>
            <th>Category Title</th>
            </tr>
            </thead>
            <tbody>

                          <!-- Find all categories querry-->
            <?php findallcategories(); ?>
                
     
                   <!-- Updat and edit equerry -->
          
             
         <!-- Delete categories querry-->            
                 <?php deletecategories();?>
                               
                          </tbody>
                          </table>


                        </div>

              </div>
                <!-- /.row -->

        </div>
            <!-- /.container-fluid -->

    </div>
        <?php include "includes/admin_footer.php";?>
