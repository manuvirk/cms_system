
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html"> CMS Admin</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li><a href="">userlogin:<?php echo user_login();?></a></li>
                <li><a href="../index.php">Home Site</a></li>
                
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> 
                   <?php 
                   
                   if(isset($_SESSION['username'])){
                       echo $_SESSION['username'];
                   }
                   
                   ?> 
                    
                    
                    <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                       
                       
                        <li class="divider"></li>
                        <li>
                            <a href="../include/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                  
                    <li>
                        
                        <a href="#" data-toggle="collapse" data-target="#post_dropdown"><i class="fa fa-fw fa-arrows-v"></i> Posts <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="post_dropdown" class="collapse">
                            <li>
                                <a href="./posts.php">View All Posts</a>
                            </li>
                            <li>
                                <a href="posts.php?source=add_post">Add Post</a>
                                
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="category.php"><i class="fa fa-fw fa-wrench"></i> Categories</a>
                    </li>
                  
                    <!-- <li class="active">
                        <a href=""><i class="fa fa-fw fa-file"></i> Coments</a>
                        
                    </li>  -->
                    <li>
                        
                        <a href="#" data-toggle="collapse" data-target="#comment_dropdown"><i class="fa fa-fw fa-arrows-v"></i> comments <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="comment_dropdown" class="collapse">
                            <li>
                                <!-- <a href="./comment.php">View All Comments</a> -->
                                <a href="./comment.php">View All Comments</a>
                            </li>
                            <li>
                                <a href="comment.php?source=add_comment">Add Comment </a>
                                
                            </li>
                        </ul>
                    </li>

                   

                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#user_dropdown"><i class="fa fa-fw fa-arrows-v"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="user_dropdown" class="collapse">
                            <li>
                                <a href="./users.php">View all Users</a>
                            </li>
                            <li>
                                <a href="users.php?source=add_users">Add Users</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="./profile.php"><i class="fa fa-fw fa-dashboard"></i> Profile</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>