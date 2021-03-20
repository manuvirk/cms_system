  <nav class="navbar navbar-inverse navbar-fixed-top collapse navbar-collapse" role="navigation">
        <div class="container ">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header ">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand " href="index.php">CMS Front</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                <?php
                    $query = "SELECT * FROM categories";

                    $select_all_categories = mysqli_query($connection, $query);
                   
                    while($row = mysqli_fetch_assoc($select_all_categories)){
                    $cat_title = $row['cat_Title'];
                    $cat_id = $row['cat_Id'];
                     $category_class = '';
                    $registration_class = '';
                    $contact_class = '';
                    $contact ='contact.php';
                    $registration='registration.php';
                    $pageName = basename($_SERVER['PHP_SELF']);


                    if(isset($_GET['category']) && $_GET['category']== $cat_id ){
                        $category_class = 'active';}
                    elseif($pageName==$registration){
                        $registration_class ='active';
                    }elseif($pageName == $contact){
                        $contact_class = 'active';
                    }
                    echo "<li class = '$category_class'><a href ='category.php?category={$cat_id}'>{$cat_title}</a></li>";
                    }
                
                
                  ?>
                    <li>
                            <a href="admin">Admin</a></li>
                            <li class='<?php echo $registration_class;?>'>
                            <a href="registration.php">Registration</a>
                        </li>
                         <li class=''>
                            <a href="login.php?login=''">Login</a>
                        </li>
                        <li class='<?php echo $contact_class;?>'>
                            <a href="contact.php">Contact</a>
                        </li>
                        <!-- </li>admin
                        
                        <li>
                        <a href="#">Contact</a>
                    </li> -->
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    